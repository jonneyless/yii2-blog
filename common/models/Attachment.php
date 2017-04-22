<?php

namespace common\models;

use ijony\helpers\File;
use Yii;

/**
 * 日志附件
 *
 * @property string $id
 * @property integer $type
 * @property string $name
 * @property string $file
 *
 * @property EntryAttachment[] $entryAttachments
 * @property Entry[] $entries
 */
class Attachment extends namespace\base\Attachment
{
    const TYPE_FILE = 0;
    const TYPE_IMAGE = 1;

    public function afterDelete()
    {
        parent::afterDelete();

        File::del($file, $this->checkIsImage());
    }

    public function checkIsImage()
    {
        return $this->type == self::TYPE_IMAGE;
    }
}
