<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use ijony\admin\widgets\ActiveField;

/* @var $this yii\web\View */
/* @var $model common\models\Category */
/* @var $form yii\bootstrap\ActiveForm  */
?>

<div class="ibox">
    <div class="ibox-content">

        <?php $form = ActiveForm::begin([
            'fieldClass' => ActiveField::className(),
            'layout' => 'horizontal',
        ]); ?>

        <?= $form->field($model, 'name')->textInput([
            'maxlength' => true,
            'data-ajax' => 'blur',
            'data-ajax-url' => \yii\helpers\Url::to(['ajax/get-slug']),
            'data-ajax-target' => Html::getInputId($model, 'slug')
        ]) ?>
        <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'sort')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'status')->switchery($model::STATUS_ACTIVE) ?>

        <div class="form-group">
            <div class="col-sm-6 col-sm-offset-3">
                <?= Html::submitButton('保存', ['class' => 'btn btn-primary']) ?>
                <?= Html::resetButton('重置', ['class' => 'btn btn-white']) ?>
            </div>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
