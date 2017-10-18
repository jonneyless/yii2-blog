<?php

namespace admin\models;

use ijony\helpers\File;
use ijony\helpers\Utils;
use Yii;

/**
 * 日志附件
 *
 * @inheritdoc
 */
class Attachment extends \common\models\Attachment
{

    /**
     * @inheritdoc
     */
    public function afterDelete()
    {
        parent::afterDelete();

        File::del($file, $this->checkIsImage());
    }

    /**
     * 更新日志内容的图片附件关联信息
     *
     * @param $id
     * @param $content
     */
    public function updateEntryFile($id, $content)
    {
        preg_match_all('/src="' . str_replace("/", "\/", STATIC_URL) . '\/([^"]+)"/', $content, $match);

        $imgs = [];
        if(isset($match[1])){
            foreach($match[1] as $key => $img){
                if(!in_array($img, $imgs)){
                    $imgs[] = $img;

                    $attachment = Attachment::find()->where(['file' => $img])->one();

                    if(!$attachment){
                        $imgInfo = pathinfo($img);

                        $attachment = new Attachment();
                        $attachment->type = Attachment::TYPE_IMAGE;
                        $attachment->name = $imgInfo['filename'];
                        $attachment->file = $img;
                        if(!$attachment->save()){
                            continue;
                        }
                    }

                    $relation = new EntryAttachment();
                    $relation->entry_id = $id;
                    $relation->attachment_id = $attachment->id;
                    $relation->save();
                }
            }
        }
    }
}
