<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property string $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property string $created_at
 * @property string $updated_at
 * @property integer $is_admin
 * @property integer $status
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email'], 'required'],
            [['created_at', 'updated_at', 'is_admin', 'status'], 'integer'],
            [['username'], 'string', 'max' => 30],
            [['auth_key'], 'string', 'max' => 32],
            [['password_hash', 'password_reset_token'], 'string', 'max' => 255],
            [['email'], 'string', 'max' => 60],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['password_reset_token'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '用户 ID',
            'username' => '用户名',
            'auth_key' => '密钥',
            'password_hash' => '加密密码',
            'password_reset_token' => '密码重置 Token',
            'email' => '邮箱',
            'created_at' => '创建时间',
            'updated_at' => '修改时间',
            'is_admin' => '是否管理员',
            'status' => '状态',
        ];
    }
}
