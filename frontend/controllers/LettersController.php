<?php

namespace frontend\controllers;

use Yii;
use common\models\Letters;
use common\models\LettersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

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
     * Lists all Letters models.
     * @return mixed
     */
    public function actionPangkat()
    {
        return $this->getLetters('pangkat');
    }

    public function getLetters($type)
    {
        $searchModel = new LettersSearch();
        $searchModel->type = $type;
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
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
        $phpWord = new \PhpOffice\PhpWord\PhpWord();

        $languageEnUs = new \PhpOffice\PhpWord\Style\Language(\PhpOffice\PhpWord\Style\Language::EN_US);

        $phpWord->getSettings()->setThemeFontLang($languageEnUs);

        $h1fontStyle = 'h1Style';
        $phpWord->addFontStyle($h1fontStyle, ['bold' => true, 'italic' => false, 'size' => 14, 'allCaps' => true]);

        $fontStyleName = 'rStyle';
        $phpWord->addFontStyle($fontStyleName, array('bold' => true, 'italic' => true, 'size' => 16, 'allCaps' => true, 'doubleStrikethrough' => true));

        $p1StyleName = 'p1Style';
        $phpWord->addParagraphStyle($p1StyleName, ['alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 100, 'lineHeight' => 1]);

        $paragraphStyleName = 'pStyle';
        $phpWord->addParagraphStyle($paragraphStyleName, array('alignment' => \PhpOffice\PhpWord\SimpleType\Jc::CENTER, 'spaceAfter' => 100));

        $phpWord->addTitleStyle(1, array('bold' => true), array('spaceAfter' => 240));

        // New portrait section
        $section = $phpWord->addSection(['marginTop' => 500]);

        $section->addText('KEMENTERIAN DALAM NEGERI', $h1fontStyle, $p1StyleName);
        $section->addText('Republik indonesia', $h1fontStyle, $p1StyleName);


        // Simple text
        $section->addTitle('Welcome to PhpWord', 1);

        // $pStyle = new Font();
        // $pStyle->setLang()
        $section->addText('Ce texte-ci est en français.', array('lang' => \PhpOffice\PhpWord\Style\Language::FR_BE));



        // Two text break
        $section->addTextBreak(2);

        // Define styles
        $section->addText('I am styled by a font style definition.', $fontStyleName);
        $section->addText('I am styled by a paragraph style definition.', null, $paragraphStyleName);
        $section->addText('I am styled by both font and paragraph style.', $fontStyleName, $paragraphStyleName);

        $section->addTextBreak();

        // Inline font style

        $fontStyle['name'] = 'Times New Roman';

        $fontStyle['size'] = 20;



        $textrun = $section->addTextRun();

        $textrun->addText('I am inline styled ', $fontStyle);

        $textrun->addText('with ');

        $textrun->addText('color', array('color' => '996699'));

        $textrun->addText(', ');

        $textrun->addText('bold', array('bold' => true));

        $textrun->addText(', ');

        $textrun->addText('italic', array('italic' => true));

        $textrun->addText(', ');

        $textrun->addText('underline', array('underline' => 'dash'));

        $textrun->addText(', ');

        $textrun->addText('strikethrough', array('strikethrough' => true));

        $textrun->addText(', ');

        $textrun->addText('doubleStrikethrough', array('doubleStrikethrough' => true));

        $textrun->addText(', ');

        $textrun->addText('superScript', array('superScript' => true));

        $textrun->addText(', ');

        $textrun->addText('subScript', array('subScript' => true));

        $textrun->addText(', ');

        $textrun->addText('smallCaps', array('smallCaps' => true));

        $textrun->addText(', ');

        $textrun->addText('allCaps', array('allCaps' => true));

        $textrun->addText(', ');

        $textrun->addText('fgColor', array('fgColor' => 'yellow'));

        $textrun->addText(', ');

        $textrun->addText('scale', array('scale' => 200));

        $textrun->addText(', ');

        $textrun->addText('spacing', array('spacing' => 120));

        $textrun->addText(', ');

        $textrun->addText('kerning', array('kerning' => 10));

        $textrun->addText('. ');



        // Link

        $section->addLink('https://github.com/PHPOffice/PHPWord', 'PHPWord on GitHub');

        $section->addTextBreak();


        // Save file
        $file = 'Usulan Kenaikan Pangkat.docx';

        header("Content-Description: File Transfer");
        header('Content-Disposition: attachment; filename="' . $file . '"');
        header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
        header('Content-Transfer-Encoding: binary');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Expires: 0');

        $phpWord = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $phpWord->save('media/doc/' . $file);
        Yii::$app->response->sendFile('media/doc/' . $file);
    }
    /**
     * Creates a new Letters model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Letters();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
}
