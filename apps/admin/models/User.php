<?php
namespace admin\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * 用户
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
 * @property string $password write-only password
 */
class User extends \common\models\User implements IdentityInterface
{

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'is_admin' => parent::IS_ADMIN_YES, 'status' => parent::STATUS_ACTIVE]);
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'is_admin' => parent::IS_ADMIN_YES, 'status' => self::STATUS_ACTIVE]);
    }
}
