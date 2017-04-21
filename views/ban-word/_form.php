<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yuncms\admin\models\Banword;

/* @var \yii\web\View $this */
/* @var yuncms\admin\models\Banword $model */
/* @var ActiveForm $form */
?>
<?php $form = ActiveForm::begin([
    'layout' => 'horizontal',
    'enableAjaxValidation' => true,
    'enableClientValidation' => false,
]); ?>
    <?= $form->field($model, 'word')->textInput(['maxlength' => true]) ?>
    <div class="hr-line-dashed"></div>

<div class="form-group">
    <div class="col-sm-4 col-sm-offset-2">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>

