<?php

namespace admin\models;

use ijony\helpers\File;
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
}
