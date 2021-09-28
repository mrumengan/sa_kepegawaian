<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use common\models\Karyawan;
use common\models\KaryawanSearch;

/**
 * KaryawansController implements the CRUD actions for Karyawan model.
 */
class KaryawansController extends Controller
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
     * Lists all Karyawan models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->listKaryawans(10);
    }

    /**
     * Lists all Karyawan ASN models.
     * @return mixed
     */
    public function actionAsn()
    {
        return $this->listKaryawans(10);
    }

    /**
     * Lists all Karyawan ASN models.
     * @return mixed
     */
    public function actionNonAsn()
    {
        return $this->listKaryawans(0);
    }

    /**
     * Lists all Karyawan models.
     * @return mixed
     */
    public function listKaryawans($status_asn = 0)
    {
        $searchModel = new KaryawanSearch();
        $searchModel->status_asn = $status_asn;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        if ($status_asn == 10) {
            $status = 'ASN';
            $status_asn = 'asn';
        } elseif ($status_asn == 0) {
            $status = 'Non ASN';
            $status_asn = 'non-asn';
        }

        return $this->render('index', [
            'status_asn' => $status_asn,
            'status' => $status,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Karyawan model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionProfile($id)
    {

        if (($model = Karyawan::find()->where(['user_id' => $id])->one()) !== null) {

            return $this->render('profile', [
                'model' => $model,
            ]);
        }

        throw new NotFoundHttpException('Profil yang dimaksud tidak ada.');
    }

    /**
     * Displays a single Karyawan model.
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
     * Creates a new Karyawan model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Karyawan();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Karyawan model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                Yii::$app->session->setFlash('danger', 'Gagal update.');
                echo '<pre>';
                print_r($model->getAttributes());
                print_r($model->errors);
                die();
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Karyawan model.
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
     * Finds the Karyawan model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Karyawan the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Karyawan::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
