<?php

namespace common\models;

use Yii;

/**
 * 日志标签表
 *
 * @property string $id
 * @property string $name
 * @property string $slug
 *
 * @property EntryTag[] $entryTags
 * @property Entry[] $entries
 */
class Tag extends namespace\base\Tag
{
}
