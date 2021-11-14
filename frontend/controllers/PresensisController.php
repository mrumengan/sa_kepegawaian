<?php

namespace frontend\controllers;

use Yii;
use yii\filters\AccessControl;
use common\models\Presensi;
use common\models\PresensiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use common\components\SBHelpers;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

/**
 * PresensisController implements the CRUD actions for Presensi model.
 */
class PresensisController extends Controller
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
                        'actions' => ['report', 'download'],
                        'allow' => true,
                        'roles' => ['HRD'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Presensi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PresensiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Presensi model.
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
     * Creates a new Presensi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionWfo()
    {
        $model = new Presensi();

        $location = 'wfo';

        if ($model->load(Yii::$app->request->post())) {
            // if ($model->save()) {
            if ($model->upload()) {
                if ($model->save()) {
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }

            return $this->redirect(['view', 'id' => $model->id]);
            // }
        }

        return $this->render('create', [
            'model' => $model,
            'location' => $location
        ]);
    }

    /**
     * Creates a new Presensi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionWfh()
    {
        $model = new Presensi();

        $location = 'wfh';

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                if ($model->upload()) {
                    if ($model->save()) {
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                }

                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('create', [
            'model' => $model,
            'location' => $location
        ]);
    }

    /**
     * Updates an existing Presensi model.
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
            'location' => $model->work_from,
        ]);
    }

    /**
     * Deletes an existing Presensi model.
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
     * Displays Presensi report.
     * @return mixed
     */
    public function actionReport()
    {
        $searchModel = new PresensiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('reports', [
            'model' => $searchModel,
            'date_start' => Yii::$app->request->get('PresensiSearch')['created_at_start'] ? Yii::$app->request->get('PresensiSearch')['created_at_start'] : date('Y-m-d', strtotime('-29 days')),
            'date_end' => Yii::$app->request->get('PresensiSearch')['created_at_end'] ? Yii::$app->request->get('PresensiSearch')['created_at_end'] : date('Y-m-d'),
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays Presensi report download.
     * @return mixed
     */
    public function actionDownload()
    {
        $date_start = Yii::$app->request->get('start');
        $date_end = Yii::$app->request->get('end');
        $xlsx_path = Yii::getAlias('@app/web/media/xls');
        $file_name = 'laporan_kehadiran_' . $date_start . '_' . $date_end . '.xlsx';

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setCellValue('A1', 'Karyawan');
        $sheet->setCellValue('B1', 'NIP');
        $sheet->setCellValue('C1', 'Latitude');
        $sheet->setCellValue('D1', 'Longitude');
        $sheet->setCellValue('E1', 'Alamat');
        $sheet->setCellValue('F1', 'Tanggal & Jam');

        $model = Presensi::find()
            ->with(['karyawan'])
            ->where(['between', 'created_at', $date_start, $date_end])
            ->all();

        $row = 2;
        foreach ($model as $presensi) {
            $time = strtotime($presensi->created_at);
            $sheet->setCellValue('A' . $row, $presensi->karyawan->nama);
            $sheet->setCellValue('B' . $row, $presensi->karyawan->nip);
            $sheet->setCellValue('C' . $row, $presensi->latitude);
            $sheet->setCellValue('D' . $row, $presensi->latitude);
            $sheet->setCellValue('E' . $row, $presensi->address);
            $sheet->setCellValue('F' . $row, \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($time));
            $sheet->getStyle('F', $row)
                ->getNumberFormat()
                ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_DATE_DATETIME);
            $row++;
        }
        // echo '<pre>';
        // print_r($model);

        $writer = new Xlsx($spreadsheet);
        $writer->save($xlsx_path . '/' . $file_name);


        header("Content-Description: File Transfer");
        header('Content-Disposition: attachment; filename="' . $file_name);
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: ' . filesize($xlsx_path . '/' . $file_name));
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');

        Yii::$app->response->sendFile($xlsx_path . '/' . $file_name);

        // return $this->render('reports', [
        //     'model' => $searchModel,
        //     'date_start' => Yii::$app->request->get('PresensiSearch')['created_at_start'] ? Yii::$app->request->get('PresensiSearch')['created_at_start'] : date('Y-m-d', strtotime('-29 days')),
        //     'date_end' => Yii::$app->request->get('PresensiSearch')['created_at_end'] ? Yii::$app->request->get('PresensiSearch')['created_at_end'] : date('Y-m-d'),
        //     'dataProvider' => $dataProvider,
        // ]);
    }

    /**
     * Finds the Presensi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Presensi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Presensi::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionViewPhoto($id)
    {
        $model = $this->findModel($id);
        $photo_data = file_get_contents(Yii::getAlias('@frontend/web/media/img/presensi/') . $model->photo_file);

        return base64_encode($photo_data);
    }
}
