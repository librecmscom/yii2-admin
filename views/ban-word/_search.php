<?php

use yii\helpers\Html;
use yuncms\admin\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model yuncms\admin\models\BanwordSearch */
/* @var $form yuncms\admin\widgets\ActiveForm */
?>

<div class="badword-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'word') ?>

    <?= $form->field($model, 'replace_word') ?>

    <?= $form->field($model, 'level') ?>

    <?= $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
