<?php

namespace frontend\controllers;

use common\components\SBHelpers;
use common\models\Karyawan;
use Yii;
use common\models\Letters;
use common\models\LettersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * LettersController implements the CRUD actions for Letters model.
 */
class LettersController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['download', 'upload'],
                        'allow' => true,
                        'roles' => ['Admin'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Letters models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LettersSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists surat usulan kenaikan pangkat Letters models.
     * @return mixed
     */
    public function actionPangkat()
    {
        return $this->getLetters('pangkat');
    }

    /**
     * Lists kartu suami / istri Letters models.
     * @return mixed
     */
    public function actionKarsuis()
    {
        return $this->getLetters('karsuis');
    }

    public function getLetters($type)
    {
        $searchModel = new LettersSearch();
        $searchModel->type = $type;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'type' => $type,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Letters model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Upload signed PDF file.
     * If upload is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionUpload($id)
    {
        if (Yii::$app->request->isPost) {
            $model = $this->findModel($id);
            $model->pdf_file = UploadedFile::getInstance($model, 'pdf_file');
            if ($model->upload()) {
                $model->pdf_file = null;
                $model->load(Yii::$app->request->post());
                if ($model->save()) {
                    $this->redirect(['/cutis/view', 'id' => $model->id]);
                }
            }
        }

        $this->goBack();
    }

    /**
     * View signed PDF file.
     * If upload is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionPdf($id)
    {
        $model = $this->findModel($id);
        $complete_path = Yii::getAlias('@frontend/web/media/pdf/' . $model->signed_pdf);
        // echo $complete_path . $model->signed_pdf;

        return Yii::$app->response->sendFile($complete_path, $model->signed_pdf, ['inline' => false]);
    }

    /**
     * Displays a single Letters model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDownload($id)
    {
        $letter = Letters::findOne($id);
        $template_path = Yii::getAlias('@app/web/templates');
        $file = 'Usulan_Kenaikan_Pangkat_' . $letter->id . '.docx';

        switch ($letter->type) {
            case 'pangkat':
                $letter->lampiran = 1;
                $file = 'Usulan_Kenaikan_Pangkat_' . $letter->id . '.docx';
                $docx_path = $this->createFilePangkat($letter, $template_path, $file);
                break;
            case 'karsuis':
                $letter->lampiran = 1;
                $file = 'Usulan_Kartu_Suami_Istri_' . $letter->id . '.docx';
                $docx_path = $this->createKarsuis($letter, $template_path, $file);
                break;
            default:
                throw new NotFoundHttpException('The requested page does not exist.');
                break;
        }
        // ob_clean();

        header("Content-Description: File Transfer");
        header('Content-Disposition: attachment; filename="' . $file . '"');
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . filesize($docx_path . '/' . $file));
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');

        // $phpWord = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        // $phpWord->save('media/doc/' . $file);
        Yii::$app->response->sendFile($docx_path . '/' . $file);
        // $templateProcessor->saveAs('php://output');
    }

    private function createFilePangkat($letter, $template_path, $file)
    {
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($template_path . '/surat_usulan_kenaikan_pangkat.docx');

        $templateProcessor->setValues([
            'nomor_surat' => $letter->nomor_surat,
            'attachment_int' => $letter->lampiran,
            'attachment_str' => SBHelpers::terbilang($letter->lampiran),
            'ref_asal_surat' => $letter->ref_nomor_surat,
            'ref_tanggal' => SBHelpers::getTanggal($letter->ref_tanggal),
            'ref_hal' => $letter->ref_hal,
            'hal_surat' => $letter->hal
        ]);

        $no_urut = 0;
        foreach ($letter->employees as $member) {
            $no_urut++;
            $members[] = [
                'noUrutLampiran' => $no_urut,
                'namaKaryawan' => $member->karyawan->nama,
                'nipKaryawan' => $member->karyawan->nip,
                'pangkatKaryawan' => $member->karyawan->golRuang->pangkat,
                'jabatanKaryawan' => $member->karyawan->jabatan,
                'keterangan' => ''
            ];
        }
        $templateProcessor->cloneRowAndSetValues('noUrutLampiran', $members);

        $docx_path = Yii::getAlias('@app/web/media/doc');

        $templateProcessor->saveAs('media/doc/' . $file);

        return $docx_path;
    }

    private function createKarsuis($letter, $template_path, $file)
    {
        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($template_path . '/surat_usulan_pembuatan_kartu_istri.docx');

        $templateProcessor->setValues([
            'nomor_surat' => $letter->nomor_surat,
            'attachment_int' => $letter->lampiran,
            'attachment_str' => SBHelpers::terbilang($letter->lampiran),
            'ref_asal_surat' => $letter->ref_nomor_surat,
            'ref_tanggal' => SBHelpers::getTanggal($letter->ref_tanggal),
            'ref_hal' => $letter->ref_hal,
            'hal_surat' => $letter->hal
        ]);

        $no_urut = 0;
        foreach ($letter->employees as $member) {
            $no_urut++;
            $members[] = [
                'noUrutLampiran' => $no_urut,
                'namaKaryawan' => $member->karyawan->nama,
                'nipKaryawan' => $member->karyawan->nip,
                'pangkatKaryawan' => $member->karyawan->golRuang->pangkat,
                'jabatanKaryawan' => $member->karyawan->jabatan,
                'keterangan' => ''
            ];
        }
        $templateProcessor->cloneRowAndSetValues('noUrutLampiran', $members);

        $docx_path = Yii::getAlias('@app/web/media/doc');

        $templateProcessor->saveAs('media/doc/' . $file);

        return $docx_path;
    }

    /**
     * Creates a new Letters model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $type = Yii::$app->request->get('type');
        $model = new Letters();
        $model->type = $type;

        if ($model->load(Yii::$app->request->post())) {
            // echo '<pre>';
            // print_r(Yii::$app->request->post('Letters')['members']);
            // print_r($model->attributes);
            $karyawans = json_decode(Yii::$app->request->post('Letters')['members']);

            if (is_array($karyawans) && $model->save()) {
                $members = [];
                foreach ($karyawans as $karyawan) {
                    $members[] = [$model->id, $karyawan->id];
                }
                Yii::$app->db->createCommand()->batchInsert('{{%letter_member}}', ['letter_id', 'karyawan_id'], $members)->execute();
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Letters model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $karyawans = json_decode(Yii::$app->request->post('Letters')['members']);

            if (is_array($karyawans) && $model->save()) {
                Yii::$app->db->createCommand()->delete('{{%letter_member}}', 'letter_id = :letter_id', [':letter_id' => $model->id])->execute();
                $members = [];
                foreach ($karyawans as $karyawan) {
                    $members[] = [$model->id, $karyawan->id];
                }
                Yii::$app->db->createCommand()->batchInsert('{{%letter_member}}', ['letter_id', 'karyawan_id'], $members)->execute();
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Letters model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        Yii::$app->db->createCommand()->delete('{{%letter_member}}', 'letter_id = :letter_id', [':letter_id' => $id])->execute();
        $model = $this->findModel($id);
        $type = $model->type;
        $model->delete();

        return $this->redirect([$type]);
    }

    /**
     * Finds the Letters model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Letters the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Letters::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionKaryawans($q)
    {
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $karyawans = [];
        foreach (Karyawan::find()
            ->select(['id', 'nama', 'foto'])
            ->where(['like', 'nama', $q])
            ->asArray()
            ->all() as $karyawan) {
            $karyawan['value'] = $karyawan['nama'];
            $karyawans[] = $karyawan;
        }
        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_JSON;
        $response->data = $karyawans;
    }
}
