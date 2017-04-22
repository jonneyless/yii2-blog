<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "{{%entry}}".
 *
 * @property string $id
 * @property string $category_id
 * @property string $user_id
 * @property string $name
 * @property string $slug
 * @property string $summary
 * @property string $content
 * @property string $trackback
 * @property string $created_at
 * @property string $updated_at
 * @property integer $is_short
 * @property integer $status
 *
 * @property EntryAttachment[] $entryAttachments
 * @property Attachment[] $attachments
 * @property EntryTag[] $entryTags
 * @property Tag[] $tags
 */
class Entry extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%entry}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'user_id', 'created_at', 'updated_at', 'is_short', 'status'], 'integer'],
            [['user_id', 'name', 'content'], 'required'],
            [['content'], 'string'],
            [['name', 'slug', 'summary', 'trackback'], 'string', 'max' => 255],
            [['slug'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '日志 ID',
            'category_id' => '分类',
            'user_id' => '作者',
            'name' => '标题',
            'slug' => '识别字串',
            'summary' => '概要',
            'content' => '正文',
            'trackback' => '引用',
            'created_at' => '创建时间',
            'updated_at' => '修改时间',
            'is_short' => '是否短文',
            'status' => '状态',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntryAttachments()
    {
        return $this->hasMany(EntryAttachment::className(), ['entry_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttachments()
    {
        return $this->hasMany(Attachment::className(), ['id' => 'attachment_id'])->viaTable('{{%entry_attachment}}', ['entry_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntryTags()
    {
        return $this->hasMany(EntryTag::className(), ['entry_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])->viaTable('{{%entry_tag}}', ['entry_id' => 'id']);
    }
}
