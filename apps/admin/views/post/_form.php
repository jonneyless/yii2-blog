<?php

use admin\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use ijony\admin\widgets\ActiveField;

/* @var $this yii\web\View */
/* @var $model admin\models\Entry */
/* @var $form yii\bootstrap\ActiveForm  */

AppAsset::register($this);

?>

<div class="ibox">
    <div class="ibox-title">
        <strong>基本信息</strong>
    </div>

    <div class="ibox-content">

    <?php $form = ActiveForm::begin([
        'fieldClass' => ActiveField::className(),
        'options'=>[
            'enctype'=>'multipart/form-data',
            'class' => 'tabs-container animated fadeInRight',
        ],
        'fieldConfig' => [
            'template' => "{label}\n{beginWrapper}\n{input}\n{hint}\n{error}\n{endWrapper}",
        ],
    ]); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'category_id')->dropDownList($model->getCategorySelectDatas()) ?>
        <?= $form->field($model, 'content')->editor() ?>
        <?= $form->field($model, 'trackback')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'tags')->tags(['maxlength' => true]) ?>

        <div class="form-group text-center">
            <?= Html::resetButton('重置', ['class' => 'btn btn-white']) ?>
            <?= Html::submitButton('保存', ['class' => 'btn btn-primary']) ?>
        </div>

    <?php ActiveForm::end(); ?>

    </div>
</div>