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

    const IS_SHORT_NO = 0;        // 日志
    const IS_SHORT_YES = 1;       // 短消息

    const STANUS_UNACTIVE = 0;    // 禁用
    const STATUS_ACTIVE = 9;      // 启用

}
