<?php

namespace admin\controllers;

use admin\models\Entry;
use Yii;
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
     * 发布日志
     *
     * @return string
     */
    public function actionCreate()
    {
        $model = new Entry();

        return $this->render('create', [
            'model' => $model
        ]);
    }
}
