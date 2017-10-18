<?php

namespace admin\models;

use ijony\helpers\Utils;
use Yii;

/**
 * 日志标签表
 *
 * @inheritdoc
 */
class Tag extends \common\models\Tag
{

    /**
     * @inheritdoc
     */
    public function beforeSave($insert)
    {
        $this->slug = str_replace(' ', '-', $this->slug);

        return parent::beforeSave($insert);
    }

    /**
     * 根据标签获取标签 ID，不存在就创建
     *
     * @param $tag
     *
     * @return mixed|string
     */
    public static function getTagIdByName($tag)
    {
        $tag = trim($tag);
        $model = self::find()->where(['name' => $tag])->one();
        if(!$model){
            $model = new self();
            $model->name = $tag;
            $model->slug = Utils::pinyin()->permalink($tag);
            $model->save();
        }

        return $model->id;
    }
}
