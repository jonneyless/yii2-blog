<?php

namespace common\models;

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
 * @property EntryAttachment[] $entryAttachments
 * @property Attachment[] $attachments
 * @property EntryTag[] $entryTags
 * @property Tag[] $tags
 */
class Entry extends namespace\base\Entry
{
}
