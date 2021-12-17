<?php

namespace frontend\controllers;

use common\components\SBHelpers;
use Yii;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;

use common\models\Karyawan;
use common\models\Kgb;

use kartik\mpdf\Pdf;
use yii\db\Expression;

class KgbController extends \yii\web\Controller
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


    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Kgb::find()->orderBy(['tanggal_kenaikan' => SORT_ASC]),
            'sort' => false,
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionIndexKaryawan()
    {
        $arr_month = [];
        $currMonth = date('m');
        $nextMonth = $currMonth + 3;

        switch ($currMonth) {
            case 10:
                $arr_month = [10, 11, 12];
                break;
            case 11:
                $arr_month = [11, 12, 1];
                break;
            case 12:
                $arr_month = [12, 1, 2];
                break;
            default:
                for ($i = $currMonth; $i < $nextMonth; $i++) {
                    $arr_month = $i;
                }
        }

        $dataProvider = new ActiveDataProvider([
            'query' => Karyawan::find()->with('inProcessKgb')->orderBy(['tmt_gaji' => SORT_ASC])
                ->andWhere(['status_asn' => 10])
                ->andWhere(['IS NOT', 'tmt_gaji', null])
                ->andWhere(['>', new Expression('TIMESTAMPDIFF(YEAR, tmt_gaji, CURDATE())'), 2])
                ->andWhere(['in', new Expression('MONTH(tmt_gaji)'), $arr_month]),
        ]);


        // $query = Karyawan::find()->orderBy(['tmt_gaji' => SORT_ASC])
        //     ->andWhere(['status_asn' => 10])
        //     ->andWhere(['IS NOT', 'tmt_gaji', null])
        //     ->andWhere(['>', new Expression('TIMESTAMPDIFF(YEAR, tmt_gaji, CURDATE())'), 2])
        //     ->andWhere(['=', new Expression('MONTH(tmt_gaji)'), date('m') + 1]);
        // echo $query->createCommand()->sql;

        return $this->render('index_karyawan', [
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionKaryawan($id)
    {
        $karyawan = Karyawan::findOne($id);
        return $this->render('karyawan', [
            'model' => $karyawan,
        ]);
    }

    /**
     * Download a single Cuti model as PDF.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDownload($id)
    {
        $kgb = Kgb::find()->with('karyawan.golRuang')->where(['id' => $id])->one();
        $template_path = Yii::getAlias('@app/web/templates');
        $file = 'Kenaikan_Gaji_Berkala_' . $kgb->karyawan->nama . '.docx';

        $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor($template_path . '/surat_usulan_kenaikan_gaji_berkala.docx');

        $templateProcessor->setValues([
            'nama_karyawan' => $kgb->karyawan->nama,
            'nip_karyawan' => $kgb->karyawan->nip,
            'pangkat' => $kgb->karyawan->golRuang->pangkat,
            'gol_ruang' => $kgb->karyawan->golRuang->nama_golongan,
            'gaji_lama' => Yii::$app->formatter->asCurrency($kgb->karyawan->gaji_pokok),
            'gaji_baru' => Yii::$app->formatter->asCurrency($kgb->jumlah),
            'mkg' => $kgb->karyawan->masaKerja,
            'tanggal_kenaikan' => SBHelpers::getTanggal($kgb->tanggal_kenaikan),
            'tanggal_kenaikan_berikutnya' => SBHelpers::getTanggal(date('Y-m-d', strtotime('+2 years', strtotime($kgb->tanggal_kenaikan))))
        ]);

        $docx_path = Yii::getAlias('@app/web/media/doc');

        $templateProcessor->saveAs('media/doc/' . $file);
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
                    $karyawan = Karyawan::findOne($model->karyawan_id);
                    $karyawan->gaji_pokok = $model->jumlah;
                    $karyawan->tmt_gaji = $model->tanggal_kenaikan;
                    $karyawan->save();
                    return $this->redirect(['/kgb/view', 'id' => $model->id]);
                }
            }
        }

        return $this->goBack();
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
     * Displays a single Kgb model.
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
     * Creates a new Kgb model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Kgb();

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        $karyawan_id = Yii::$app->request->get('id', 0);
        if ($karyawan_id) {
            $karyawan = Karyawan::findOne($karyawan_id);
        } else {
            $karyawan = [];
        }

        return $this->render('create', [
            'model' => $model,
            'karyawan' => $karyawan
        ]);
    }

    /**
     * Updates an existing Kgb model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Kgb model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Kgb model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Kgb the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Kgb::findOne($id)) !== null) {
            return $model;
        }

        throw new yii\web\NotFoundHttpException('Data yang diminta tidak ditemukan.');
    }
}
