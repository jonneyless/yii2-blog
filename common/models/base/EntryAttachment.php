<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "{{%entry_attachment}}".
 *
 * @property string $entry_id
 * @property string $attachment_id
 *
 * @property Entry $entry
 * @property Attachment $attachment
 */
class EntryAttachment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%entry_attachment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['entry_id', 'attachment_id'], 'required'],
            [['entry_id', 'attachment_id'], 'integer'],
            [['entry_id'], 'exist', 'skipOnError' => true, 'targetClass' => Entry::className(), 'targetAttribute' => ['entry_id' => 'id']],
            [['attachment_id'], 'exist', 'skipOnError' => true, 'targetClass' => Attachment::className(), 'targetAttribute' => ['attachment_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'entry_id' => '日志',
            'attachment_id' => '附件',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntry()
    {
        return $this->hasOne(Entry::className(), ['id' => 'entry_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttachment()
    {
        return $this->hasOne(Attachment::className(), ['id' => 'attachment_id']);
    }
}
