<?php

namespace admin\models;

use ijony\helpers\Image;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * 日志发布和管理
 *
 * @inheritdoc
 *
 * @property array $tags;
 * @property array $imgs;
 */
class Entry extends \common\models\Entry
{

    // 标签合集
    public $tags;
    // 正文内图片合集
    private $imgs;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            ['tags', 'safe'],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'tags' => '标签',
        ]);
    }

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        $datas = Image::recoverImg($this->content);

        $this->content = $datas['content'];
        $this->imgs = $datas['imgs'];

        return parent::beforeSave($insert);
    }

    /**
     * @inheritdoc
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if(!$insert){
            EntryTag::deleteAll(['entry_id' => $this->id]);
        }

        if($this->tags){
            if(is_string($this->tags)){
                $tags = explode(",", $this->tags);
            }else{
                $tags = $this->tags;
            }

            $entryTag = new EntryTag();
            $entryTag->entry_id = $this->id;

            foreach($tags as $tag){
                $entryTag->setIsNewRecord(true);
                $entryTag->tag_id = Tag::getTagIdByName($tag);
                $entryTag->save();
            }
        }

        if($this->imgs){
            foreach($this->imgs as $img){
                $imgInfo = pathinfo($img);

                $attachment = new Attachment();
                $attachment->type = Attachment::TYPE_IMAGE;
                $attachment->name = $imgInfo['filename'];
                $attachment->file = $img;
                if($attachment->save()){
                    $relation = new EntryAttachment();
                    $relation->entry_id = $this->id;
                    $relation->attachment_id = $attachment->id;
                    if(!$relation->save()){
                        $attachment->delete();
                    }
                }
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function afterFind()
    {
        $this->tags = $this->getTags()->select('name')->column();
    }

    /**
     * 分类下拉表单数据
     * @return array
     */
    public function getCategorySelectDatas()
    {
        return Category::find()->select('name')->indexBy('id')->column();
    }

    /**
     * 获取状态表述
     *
     * @return mixed|string
     */
    public function getStatus()
    {
        $datas = $this->getStatusSelectDatas();

        return isset($datas[$this->status]) ? $datas[$this->status] : '';
    }

    /**
     * 获取状态标签
     *
     * @return mixed|string
     */
    public function getStatusLabel()
    {
        if($this->status == self::STATUS_ACTIVE){
            $class = 'label-primary';
        }else{
            $class = 'label-danger';
        }

        return Utils::label($this->getStatus(), $class);
    }

    /**
     * 获取完整状态数据
     *
     * @return array
     */
    public function getStatusSelectDatas()
    {
        return [
            self::STANUS_UNACTIVE => '禁用',
            self::STATUS_ACTIVE => '启用',
        ];
    }
}
