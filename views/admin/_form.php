<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var \yii\web\View $this */
/* @var ActiveForm $form */
?>

<?php $form = ActiveForm::begin(['layout'=>'horizontal']); ?>
<fieldset>
    <?= $form->field($model, 'username')->textInput() ?>

    <?= $form->field($model, 'email')->input('email'); ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'status')->inline(true)->radioList(['1' => Yii::t('app', 'Enable'), '0' => Yii::t('app', 'Disable')]) ?>

</fieldset>
<div class="form-actions">
    <div class="row">
        <div class="col-md-12">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>

