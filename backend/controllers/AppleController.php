<?php

namespace backend\controllers;

use backend\models\EatForm;
use Yii;
use app\models\Apples;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AppleController implements the CRUD actions for Apples model.
 */
class AppleController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
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
     * Lists all Apples models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->checkRotApples();

        $dataProvider = new ActiveDataProvider([
            'query' => Apples::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Apples model.
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
     * Creates a new Apples model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Apples();
        $model->load(Yii::$app->request->post());

        if ($model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Apples model.
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
     * Deletes an existing Apples model.
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

    public function actionFall($id)
    {
        $this->findModel($id)->fall();

        return $this->redirect(['index']);
    }

    public function actionEat($id)
    {

        $model = new EatForm();
        $apple = $this->findModel($id);
        $model->allowedPercent = $apple->percent;

        if ($apple->percent <=0 || !$apple->is_fell || $apple->is_rotten) {
            Yii::$app->session->setFlash('error', Yii::t('app', 'You can’t eat an apple that has not fallen, rotten, or has already been eaten!'));

            return $this->redirect(['index']);
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $apple->eat($model->percent);
            if ($apple->percent > 0) {
                $apple->save();
            } else {
                Yii::$app->session->setFlash('success', Yii::t('app', 'The apple is eaten completely and has been removed.'));
                $apple->delete();
            }

            return $this->redirect(['index']);
        }

        return $this->render('eat', [
            'model' => $model,
            'id' => $id,
        ]);
    }

    public function actionCreaterandom()
    {
        $quantity = rand(1, 10);
        for ($i = 1; $i <= $quantity; $i++) {
            $apple = new Apples();
            $apple->color = $apple->allowedColors[rand(0, count($apple->allowedColors) - 1)];
            $apple->save();
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Apples model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Apples the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Apples::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    protected function checkRotApples()
    {
        $apples = Apples::find()->all();
        foreach ($apples as $apple) {
            $apple->checkRot();
        }
    }
}
