<?php

namespace frontend\controllers;

use Yii;
use common\models\Cuti;
use common\models\Karyawan;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

use kartik\mpdf\Pdf;

/**
 * CutisController implements the CRUD actions for Cuti model.
 */
class CutisController extends Controller
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
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Cuti models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Cuti::find()->orderBy(['status' => SORT_ASC, 'tanggal_cuti' => SORT_ASC]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cuti model.
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
            'format' => Pdf::FORMAT_A4,
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT,
            // stream to browser inline
            'destination' => Pdf::DEST_DOWNLOAD,
            'filename' => 'Surat_Cuti_' . str_pad($model->id, $model->code_width, "0", STR_PAD_LEFT) . '_' . $model->karyawan->nama . '.pdf',
            // your html content input
            'content' => $content,
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting
            // 'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            'cssFile' => '@frontend/web/css/pdf.css',
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
            'options' => ['title' => 'Cuti', 'subject' => 'Surat Cuti'],
            // call mPDF methods on the fly
            'methods' => [
                'SetHeader' => [''],
                'SetFooter' => ['{PAGENO}'],
            ]
        ]);

        // return the pdf output as per the destination setting
        return $pdf->render();
        // return $this->render('pdf', [
        //     'model' => $this->findModel($id),
        // ]);
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
                    return $this->redirect(['/cutis/view', 'id' => $model->id]);
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
     * Creates a new Cuti model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Cuti();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Cuti model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionRequest()
    {
        $model = new Cuti();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $karyawan = Karyawan::findOne(['user_id' => Yii::$app->user->id]);

        return $this->render('request', [
            'model' => $model,
            'karyawan' => $karyawan
        ]);
    }

    /**
     * Updates an existing Cuti model.
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
     * Deletes an existing Cuti model.
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
     * Finds the Cuti model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Cuti the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Cuti::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
