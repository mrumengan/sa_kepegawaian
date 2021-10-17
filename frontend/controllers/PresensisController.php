<?php

namespace frontend\controllers;

use Yii;
use common\models\Presensi;
use common\models\PresensiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

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
