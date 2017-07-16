<?php

use admin\assets\AppAsset;
use yii\helpers\Url;
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
        'layout' => 'horizontal',
    ]); ?>

        <?= $form->field($model, 'name')->textInput([
            'maxlength' => true,
            'data-ajax' => 'focus',
            'data-ajax-url' => Url::to(['ajax/get-slug']),
            'data-ajax-target' => Html::getInputId($model, 'slug')
        ]) ?>
        <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'category_id')->dropDownList($model->getCategorySelectDatas()) ?>
        <?= $form->field($model, 'content')->editor() ?>
        <?= $form->field($model, 'trackback')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'tags')->tags(['maxlength' => true]) ?>

        <div class="form-group">
            <div class="col-sm-6 col-sm-offset-3">
                <?= Html::submitButton('保存', ['class' => 'btn btn-primary']) ?>
                <?= Html::resetButton('重置', ['class' => 'btn btn-white']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

    </div>
</div>