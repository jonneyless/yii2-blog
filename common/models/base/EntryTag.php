<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "{{%entry_tag}}".
 *
 * @property string $entry_id
 * @property string $tag_id
 *
 * @property Entry $entry
 * @property Tag $tag
 */
class EntryTag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%entry_tag}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['entry_id', 'tag_id'], 'required'],
            [['entry_id', 'tag_id'], 'integer'],
            [['entry_id'], 'exist', 'skipOnError' => true, 'targetClass' => Entry::className(), 'targetAttribute' => ['entry_id' => 'id']],
            [['tag_id'], 'exist', 'skipOnError' => true, 'targetClass' => Tag::className(), 'targetAttribute' => ['tag_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'entry_id' => '日志',
            'tag_id' => '标签',
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
    public function getTag()
    {
        return $this->hasOne(Tag::className(), ['id' => 'tag_id']);
    }
}
