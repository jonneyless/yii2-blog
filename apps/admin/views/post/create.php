<?php

/* @var $this yii\web\View */
/* @var $model admin\models\Entry */

$this->title = '发布日志';
$this->params['breadcrumbs'][] = ['label' => '日志管理', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$this->params['buttons'] = [
    ['label' => '管理', 'url' => ['index'], 'options' => ['class' => 'btn btn-info']],
];
?>

<?= $this->render('_form', [
    'model' => $model,
]) ?>
