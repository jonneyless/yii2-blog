<?php

use ijony\admin\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '分类管理';
$this->params['breadcrumbs'][] = $this->title;
$this->params['buttons'] = [
    ['label' => '新增', 'url' => ['create'], 'options' => ['class' => 'btn btn-success']],
];
?>

<div class="ibox">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'layoutFix' => true,
        'columns' => [
            [
                'attribute' => 'id',
                'header' => '#',
            ],
            'name',
            [
                'attribute' => 'status',
                'format' => 'raw',
                'value' => function($data){
                    return $data->getStatusLabel();
                },
            ],

            [
                'class' => 'ijony\admin\grid\ActionColumn',
                'headerOptions' => [
                    'class' => 'text-right',
                ],
            ],
        ],
    ]); ?>
</div>
