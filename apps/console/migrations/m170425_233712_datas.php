<?php

use yii\db\Migration;

class m170425_233712_datas extends Migration
{
    public function up()
    {
        $model = new \common\models\User();
        $model->username = 'admin';
        $model->setPassword('123456');
        $model->generateAuthKey();
        $model->email = 'jonneyless@163.com';
        $model->is_admin = \common\models\User::IS_ADMIN_YES;
        $model->status = \common\models\User::STATUS_ACTIVE;
        $model->save();
    }

    public function down()
    {
        $this->truncateTable('{{%user}}');
    }
}
