<?php

namespace common\models;

use Yii;

/**
 * 日志与附件关联
 *
 * @property string $entry_id
 * @property string $attachment_id
 *
 * @property Entry $entry
 * @property Attachment $attachment
 */
class EntryAttachment extends namespace\base\EntryAttachment
{
}
