<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "{{%attachment}}".
 *
 * @property string $id
 * @property integer $type
 * @property string $name
 * @property string $file
 *
 * @property EntryAttachment[] $entryAttachments
 * @property Entry[] $entries
 */
class Attachment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%attachment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'integer'],
            [['name', 'file'], 'required'],
            [['name', 'file'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '附件 ID',
            'type' => '类型',
            'name' => '名称',
            'file' => '文件',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntryAttachments()
    {
        return $this->hasMany(EntryAttachment::className(), ['attachment_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntries()
    {
        return $this->hasMany(Entry::className(), ['id' => 'entry_id'])->viaTable('{{%entry_attachment}}', ['attachment_id' => 'id']);
    }
}
