<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yuncms\admin\components\RouteRule;

/* @var yii\web\View $this */
/* @var yuncms\admin\models\AdminAuthItem $model */
/* @var backend\widgets\ActiveForm $form */
/* @var yuncms\admin\components\ItemController $context */

$labels = $this->context->labels();
$rules = array_keys(Yii::$app->getAuthManager()->getRules());
$rules = array_combine($rules, $rules);
unset($rules[RouteRule::RULE_NAME]);
?>

<?php $form = ActiveForm::begin(['layout' => 'horizontal',]); ?>
<fieldset>


    <?= $form->field($model, 'name')->textInput(['maxlength' => 64]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 2]) ?>

    <?= $form->field($model, 'ruleName')->dropDownList($rules, ['prompt' => '--' . Yii::t('backend/rule', 'Select Rule')]) ?>

    <?= $form->field($model, 'data')->textarea(['rows' => 6]) ?>
</fieldset>
<div class="form-actions">
    <div class="row">
        <div class="col-md-12">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), [
                'class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary',
                'name' => 'submit-button'])
            ?>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>

