<?php

namespace common\models;

use Yii;

/**
 * 日志
 *
 * @inheritdoc
 */
class Entry extends namespace\base\Entry
{

    const STANUS_UNACTIVE = 0;    // 禁用
    const STATUS_ACTIVE = 9;      // 启用

}
