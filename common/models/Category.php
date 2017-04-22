<?php

namespace common\models;

use Yii;

/**
 * 日志分类
 *
 * @property string $id
 * @property string $parent_id
 * @property string $name
 * @property string $slug
 * @property integer $child
 * @property string $parent_arr
 * @property string $child_arr
 * @property integer $status
 */
class Category extends namespace\base\Category
{

    const STATUS_DELETE = 0;    // 删除
    const STANUS_UNACTIVE = 1;  // 禁用
    const STATUS_ACTIVE = 9;    // 启用

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['child', 'parent_id', 'parent_arr'], 'default', 'value' => 0],
            ['status', 'default', 'value' => self::STATUS_ACTIVE],
            ['status', 'in', 'range' => [self::STATUS_DELETE, self::STANUS_UNACTIVE, self::STATUS_ACTIVE]],
        ]);
    }

    public function beforeSave($insert)
    {
        if(!$insert){
            if(count(explode(",", $this->child_arr)) > 1){
                $this->child = 1;
            }else{
                $this->child = 0;
            }
        }

        return parent::beforeSave($insert);
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        if($insert){
            $this->child_arr = (string) $this->id;

            if($this->parent_id){
                $parent = static::findOne($this->parent_id);

                $parent->child_arr = $parent->child_arr . ',' . $this->id;
                $parent->save();

                $this->parent_arr = $parent->parent_arr . ',' . $this->parent_id;

                $parents = explode(",", $parent->parent_arr);
                foreach($parents as $parent_id){
                    if(!$parent_id) continue;

                    $parent = static::findOne($parent_id);
                    $parent->child_arr = $parent->child_arr . ',' . $this->id;
                    $parent->save();
                }
            }

            $this->save();
        }else{
            if(isset($changedAttributes['parent_id'])){
                $child_arr = explode(",", $this->child_arr);
                $old_parent_arr = $this->parent_arr;

                if($changedAttributes['parent_id']){
                    $parent_arr = explode(",", $this->parent_arr);
                    array_shift($parent_arr);

                    foreach($parent_arr as $parent_id){
                        $parent = static::findOne($parent_id);

                        $parent_child_arr = explode(",", $parent->child_arr);
                        $parent_child_arr = array_diff($parent_child_arr, $child_arr);
                        $parent_child_arr = join(",", $parent_child_arr);

                        $parent->child_arr = $parent_child_arr;
                        $parent->save();
                    }
                }

                if($this->parent_id){
                    $parent = static::findOne($this->parent_id);

                    $parent_child_arr = explode(",", $parent->child_arr);
                    $parent_child_arr = array_merge($parent_child_arr, $child_arr);
                    $parent_child_arr = join(",", $parent_child_arr);

                    $parent->child_arr = $parent_child_arr;
                    $parent->save();

                    $this->parent_arr = $parent->parent_arr . ',' . $this->parent_id;

                    $parents = explode(",", $parent->parent_arr);
                    foreach($parents as $parent_id){
                        if(!$parent_id) continue;

                        $parent = static::findOne($parent_id);

                        $parent_child_arr = explode(",", $parent->child_arr);
                        $parent_child_arr = array_merge($parent_child_arr, $child_arr);
                        $parent_child_arr = join(",", $parent_child_arr);

                        $parent->child_arr = $parent_child_arr;
                        $parent->save();
                    }
                }else{
                    $this->parent_arr = '0';
                }

                foreach($child_arr as $id){
                    if($id == $this->id) continue;

                    $child = static::findOne($id);
                    $child->parent_arr = str_replace($old_parent_arr, $this->parent_arr, $child->parent_arr);
                    $child->save();
                }

                $this->save();
            }

            if(isset($changedAttributes['status'])){
                if($this->child != 0){
                    static::updateAll(['status' => $this->status], ['parent_id' => $this->id]);
                }
            }
        }

        if(isset($changedAttributes['sort'])){
            if($this->parent_id){
                $parent = static::findOne($this->parent_id);
                $child_arr = $parent->id;
                $childs = static::find()->where(['parent_id' => $this->parent_id])->orderBy(['sort' => SORT_ASC])->all();
                foreach($childs as $child){
                    $child_arr .= "," . $child->child_arr;
                }
                $parent->child_arr = $child_arr;
                $parent->save();
            }
        }
    }

    public function afterDelete()
    {
        parent::afterDelete();

        $parent_arr = explode(",", $this->parent_arr);
        $child_arr = explode(",", $this->child_arr);

        array_shift($parent_arr);

        foreach($parent_arr as $parent_id){
            $parent = static::findOne($parent_id);

            $parent_child_arr = explode(",", $parent->child_arr);
            $parent_child_arr = array_diff($parent_child_arr, $child_arr);
            $parent_child_arr = join(",", $parent_child_arr);

            $parent->child_arr = $parent_child_arr;
            $parent->save();
        }

        static::deleteAll(['id' => $child_arr]);
    }
}
