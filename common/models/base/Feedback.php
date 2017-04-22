<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "{{%feedback}}".
 *
 * @property string $id
 * @property string $user_id
 * @property string $entry_id
 * @property string $parent_id
 * @property integer $type
 * @property string $author
 * @property string $email
 * @property string $website
 * @property string $content
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 */
class Feedback extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%feedback}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'entry_id', 'parent_id', 'type', 'created_at', 'updated_at', 'status'], 'integer'],
            [['entry_id', 'author', 'content'], 'required'],
            [['content'], 'string'],
            [['author'], 'string', 'max' => 60],
            [['email'], 'string', 'max' => 120],
            [['website'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '反馈 ID',
            'user_id' => '作者',
            'entry_id' => '日志',
            'parent_id' => '父级反馈',
            'type' => '类型',
            'author' => '反馈人',
            'email' => '邮箱',
            'website' => '网址',
            'content' => '内容',
            'created_at' => '创建时间',
            'updated_at' => '修改时间',
            'status' => '状态',
        ];
    }
}
