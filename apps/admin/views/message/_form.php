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
    <div class="ibox-content">

        <?php $form = ActiveForm::begin([
            'fieldClass' => ActiveField::className(),
            'layout' => 'horizontal',
        ]); ?>

            <?= $form->field($model, 'content')->textarea() ?>
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