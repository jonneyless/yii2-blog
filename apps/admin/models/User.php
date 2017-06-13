<?php
namespace admin\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * 用户
 *
 * @inheritdoc
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
