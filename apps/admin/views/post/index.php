<?php

use ijony\admin\widgets\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '商品管理';
$this->params['breadcrumbs'][] = $this->title;
$this->params['buttons'] = [
    ['label' => '新增', 'url' => ['create'], 'options' => ['class' => 'btn btn-success']],
];
?>

<?php Pjax::begin() ?>
<div class="ibox">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
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
