<?php

namespace admin\controllers;

use admin\models\Entry;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;

/**
 * Post controller
 */
class PostController extends Controller
{
    /**
     * @inheritdoc
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
        ];
    }

    /**
     * 日志列表
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Entry::find()->where(['is_short' => Entry::IS_SHORT_NO]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * 发布日志
     *
     * @return string
     */
    public function actionCreate()
    {
        $model = new Entry();
        $model->user_id = Yii::$app->user->id;
        $model->is_short = Entry::IS_SHORT_NO;
        $model->status = Entry::STATUS_ACTIVE;

        if($model->load(Yii::$app->request->post()) && $model->save()){
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model
        ]);
    }

    /**
     * 编辑日志
     *
     * @param $id
     *
     * @return string
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if($model->load(Yii::$app->request->post()) && $model->save()){
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model
        ]);
    }

    /**
     * 删除日志
     *
     * @param $id
     *
     * @return \yii\web\Response
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * 获取日志对象
     *
     * @param $id
     *
     * @return static
     * @throws \yii\web\NotFoundHttpException
     */
    protected function findModel($id)
    {
        if(($model = Entry::findOne($id)) !== NULL){
            return $model;
        }else{
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
