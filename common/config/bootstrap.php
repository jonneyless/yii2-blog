<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@home', dirname(dirname(__DIR__)) . '/apps/home');
Yii::setAlias('@admin', dirname(dirname(__DIR__)) . '/apps/admin');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/apps/console');
Yii::setAlias('@static', dirname(dirname(__DIR__)) . '/webs/static');

defined('UPLOAD_FOLDER') or define('UPLOAD_FOLDER', 'upload');
defined('THUMB_FOLDER') or define('THUMB_FOLDER', 'thumb');
defined('BUFFER_FOLDER') or define('BUFFER_FOLDER', 'buffer');
defined('STATIC_URL') or define('STATIC_URL', 'http://static.blog.lvh.me');
