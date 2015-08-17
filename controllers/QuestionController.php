<?php

namespace app\controllers;

use Yii;
use app\models\Question;
use app\models\User;
use app\models\SearchQuestion;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\assets\Need;

/**
 * QuestionController implements the CRUD actions for Question model.
 */
class QuestionController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /*public function beforeAction($action) {
        if (QuestionController::beforeAction($action)) {
            if (!\Yii::$app->user->can($action->id)) {
                throw new ForbiddenHttpException('Access denied');
            }
            return true;
        } else {
            return false;
        }
    }*/

    /**
     * Lists all Question models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }
        if (!\Yii::$app->user->can( '7progress' )) {
            return $this->goBack(); // goHome
        }

        User::checkQ();

        $searchModel = new SearchQuestion();
        $dataProvider = $searchModel->allPotenc(Yii::$app->request->queryParams);
        $dataProvider1 = $searchModel->allDo(Yii::$app->request->queryParams);
        //$dataProvider1->andFilterWhere(['like', 'user_take', '0']);
            //->andFilterWhere(['like', 'tbl_country.name', $this->country]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataProvider1' => $dataProvider1,
            'countOwnQ' => Question::find()->where(['user_created'=>Yii::$app->user->id, 'npp'=>0])->count(),
        ]);
    }

    public function actionRecommendation() {
        return $this->render('recommendation');
    }

    /**
     * Displays a single Question model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        if (!\Yii::$app->user->can( '7progress' )) {
            return $this->goBack(); // goHome
        }
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Question model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        if (!\Yii::$app->user->can( '7progress' )) {
            return $this->goBack(); // goHome
        }
        $model = new Question();


        if ($model->load(Yii::$app->request->post())) {
            $model->user_created = Yii::$app->user->id;
            $model->created = time();
            $model->save();
            return $this->redirect(['index']);
            // return $this->redirect(['view', 'id' => $model->id]);
        } else {
            if (Yii::$app->request->isAjax) {
                return $this->renderAjax('create', [
                    'model' => $model,
                ]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                    'upDate' => true,
                ]);
            }
        }
    }

    /**
     * Updates an existing Question model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        if (!\Yii::$app->user->can( 'edit-7progress' ) && $model->user_created != Yii::$app->user->id) {
            Yii::$app->getSession()->setFlash('error', 'Вибачте, але у Вас недостатньо прав. Зверність до адміністратора.');
            return $this->goBack(); // goHome
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Question model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if (!\Yii::$app->user->can( 'edit-7progress' ) && $model->user_created != Yii::$app->user->id) {
            Yii::$app->getSession()->setFlash('error', 'Вибачте, але у Вас недостатньо прав. Зверність до адміністратора.');
            return $this->goBack(); // goHome
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Question model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Question the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Question::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
