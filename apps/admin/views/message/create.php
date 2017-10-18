<?php

/* @var $this yii\web\View */
/* @var $model admin\models\Entry */

$this->title = '发布消息';
$this->params['breadcrumbs'][] = ['label' => '消息管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['buttons'] = [
    ['label' => '管理', 'url' => ['index'], 'options' => ['class' => 'btn btn-info']],
];
?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>
