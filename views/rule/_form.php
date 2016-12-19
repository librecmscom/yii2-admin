<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var \yii\web\View $this */
/* @var \common\models\AdminBizRule $model */
/* @var $form ActiveForm */
?>
<?php $form = ActiveForm::begin(['layout'=>'horizontal', ]); ?>
<fieldset>
    <?= $form->field($model, 'name')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'className')->textInput() ?>
</fieldset>
<div class="form-actions">
    <div class="row">
        <div class="col-md-12">
            <?php
            echo Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), [
                'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary'])
            ?>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>

