<?php

namespace common\models;

use Yii;

/**
 * 日志反馈表
 *
 * @property string $id
 * @property string $user_id
 * @property string $entry_id
 * @property string $parent_id
 * @property integer $type
 * @property string $author
 * @property string $email
 * @property string $website
 * @property string $content
 * @property string $created_at
 * @property string $updated_at
 * @property integer $status
 */
class Feedback extends namespace\base\Feedback
{
}
