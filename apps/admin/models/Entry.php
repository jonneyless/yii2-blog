<?php
namespace admin\models;

use common\models\Category;
use Yii;

/**
 * 日志发布和管理
 *
 * @inheritdoc
 */
class Entry extends \common\models\Entry
{

    public function getCategorySelectDatas()
    {
        return Category::find()->select('name')->indexBy('id')->column();
    }
}
