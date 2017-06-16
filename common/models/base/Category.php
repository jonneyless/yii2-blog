<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "{{%category}}".
 *
 * @property string $id
 * @property string $parent_id
 * @property string $name
 * @property string $slug
 * @property integer $child
 * @property string $parent_arr
 * @property string $child_arr
 * @property string $sort
 * @property integer $status
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%category}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent_id', 'child', 'sort', 'status'], 'integer'],
            [['name'], 'required'],
            [['child_arr'], 'string'],
            [['name'], 'string', 'max' => 60],
            [['slug', 'parent_arr'], 'string', 'max' => 255],
            [['slug'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '分类 ID',
            'parent_id' => '父级分类',
            'name' => '名称',
            'slug' => '识别字串',
            'child' => '是否有子级',
            'parent_arr' => '父级链',
            'child_arr' => '子级群',
            'sort' => '排序',
            'status' => '状态',
        ];
    }
}
