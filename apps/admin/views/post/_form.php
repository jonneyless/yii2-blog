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

<div class="col-lg-10">
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
            <?= $form->field($model, 'content')->editor() ?>
            <?= $form->field($model, 'trackback')->textInput(['maxlength' => true]) ?>

            <div class="form-group text-center">
                <?= Html::resetButton('重置', ['class' => 'btn btn-white']) ?>
                <?= Html::submitButton('保存', ['class' => 'btn btn-primary']) ?>
            </div>

        <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>

<div class="col-lg-2">
    <div class="ibox">
        <div class="ibox-title">
            <strong>日志分类</strong>
        </div>

        <div class="ibox-content">
            <ul class="list-unstyled category-list">
                <li>
                    <label><i class="fa fa-check-square-o"></i> 测试分类</label>
                    <input type="checkbox" name=""
                </li>
                <li>
                    <label><i class="fa fa-square-o"></i> 测试分类</label>
                </li>
                <li><a href=""><i class="fa fa-plus-square"></i> 新增分类</a></li>
            </ul>
        </div>
    </div>
</div>