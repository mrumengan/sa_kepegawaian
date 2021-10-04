<?php

namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\data\ActiveDataProvider;
use yii\web\UploadedFile;

use common\models\Karyawan;
use common\models\Kgb;

use kartik\mpdf\Pdf;

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
        $dataProvider = new ActiveDataProvider([
            'query' => Karyawan::find()->orderBy(['tmt_gaji' => SORT_ASC])
                ->andWhere(['status_asn' => 10])
                ->andWhere(['IS NOT', 'tmt_gaji', null]),
        ]);

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
        $this->layout = 'clean';
        $model = $this->findModel($id);
        $content = $this->renderPartial('pdf', [
            'model' => $model,
        ]);

        // return $content;

        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE,
            // A4 paper format
            'format' => Pdf::FORMAT_LEGAL,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER,
            'filename' => 'Surat_KGB_' . str_pad($model->id, $model->code_width, "0", STR_PAD_LEFT) . '_' . $model->karyawan->nama . '.pdf',
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            // 'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            'cssFile' => '@frontend/web/css/kgb.pdf.css',
            // any css to be embedded if required
            'cssInline' => '
                .kv-heading-1 {
                    font-size:18px
                }
                body {
                    font-size: 12px;
                }
                td {
                    font-size: 1rem;
                }
                ',
            // set mPDF properties on the fly
            'options' => ['title' => 'KGB', 'subject' => 'Surat KGB'],
            // call mPDF methods on the fly
            'methods' => [
                'SetHeader' => [''],
                'SetFooter' => ['{PAGENO}'],
            ]
        ]);

        // return the pdf output as per the destination setting
        return $pdf->render();
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
