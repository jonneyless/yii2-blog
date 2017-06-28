<?php

use ijony\admin\widgets\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '商品管理';
$this->params['breadcrumbs'][] = $this->title;
$this->params['buttons'] = [
    ['label' => '新增', 'url' => ['create'], 'options' => ['class' => 'btn btn-success']],
    ['label' => '回收站', 'url' => ['recycle'], 'options' => ['class' => 'btn btn-default']],
];
?>

<?php Pjax::begin() ?>
<div class="ibox animated fadeInRight">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'id',
                'header' => '#',
            ],
            [
                'attribute' => 'preview',
                'format' => ['image', ['style' => 'max-width: 60px; max-height: 30px;']],
                'value' => function($data){
                    return $data->getPreview();
                },
            ],
            [
                'attribute' => 'region_id',
                'value' => function($data){
                    return $data->getRegionName();
                },
            ],
            [
                'attribute' => 'category_id',
                'value' => function($data){
                    return $data->getCategoryName();
                },
            ],
            'name',
            'info.stock',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function($data){
                    return $data->getStatusLabel();
                },
            ],
            [
                'attribute' => 'type_id',
                'format' => 'raw',
                'value' => function($data){
                    return $data->getTypeButtons();
                },
            ],
            'sort',

            [
                'class' => 'mtweb\widgets\ActionColumn',
                'headerOptions' => [
                    'class' => 'text-right',
                ],
                'template' => '{view} {update} {remove}',
            ],
        ],
    ]); ?>
</div>
<?php Pjax::end() ?>
