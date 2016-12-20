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
<fieldset>
    <?= $form->field($model, 'word')->textInput(['maxlength' => true]) ?>
</fieldset>
<div class="form-actions">
    <div class="row">
        <div class="col-md-12">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>
</div>


<?php ActiveForm::end(); ?>

