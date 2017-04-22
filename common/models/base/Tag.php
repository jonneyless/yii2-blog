<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "{{%tag}}".
 *
 * @property string $id
 * @property string $name
 * @property string $slug
 *
 * @property EntryTag[] $entryTags
 * @property Entry[] $entries
 */
class Tag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tag}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 60],
            [['slug'], 'string', 'max' => 255],
            [['slug'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '标签 ID',
            'name' => '名称',
            'slug' => '识别字串',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntryTags()
    {
        return $this->hasMany(EntryTag::className(), ['tag_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntries()
    {
        return $this->hasMany(Entry::className(), ['id' => 'entry_id'])->viaTable('{{%entry_tag}}', ['tag_id' => 'id']);
    }
}
