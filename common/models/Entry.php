<?php

namespace common\models;

use ijony\helpers\Image;
use Yii;

/**
 * 日志
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
 * @property array $imgs;
 *
 * @property EntryAttachment[] $entryAttachments
 * @property Attachment[] $attachments
 * @property EntryTag[] $entryTags
 * @property Tag[] $tags
 */
class Entry extends namespace\base\Entry
{

    private $imgs;

    public function beforeSave($insert)
    {
        $datas = Image::recoverImg($this->content);

        $this->content = $datas['content'];

        if($datas['imgs']){
            foreach($datas['imgs'] as $img){
                $imgInfo = pathinfo($img);

                $attachment = new Attachment();
                $attachment->type = Attachment::TYPE_IMAGE;
                $attachment->name = $imgInfo['filename'];
                $attachment->file = $img;
                $attachment->save();

                $this->imgs[] = $attachment->id;
            }
        }

        return parent::beforeSave($insert);
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if($this->imgs){
            foreach($this->imgs as $attachment_id){
                $relation = new EntryAttachment();
                $relation->entry_id = $this->id;
                $relation->attachment_id = $attachment_id;
                $relation->save();
            }
        }
    }
}
