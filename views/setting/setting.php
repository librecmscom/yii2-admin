<?php
/**
 * @link http://www.tintsoft.com/
 * @copyright Copyright (c) 2012 TintSoft Technology Co. Ltd.
 * @license http://www.tintsoft.com/license/
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yuncms\admin\widgets\Jarvis;

$this->title = Yii::t('admin', 'Site Setting');
$this->params['breadcrumbs'][] = $this->title;
?>
<section id="widget-grid">
    <div class="row">
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <?php Jarvis::begin([
                'editbutton' => false,
                'deletebutton' => false,
                'header' => Html::encode($this->title),
            ]); ?>
            <?php $form = ActiveForm::begin(['layout' => 'horizontal',]); ?>
            <fieldset>
                <?= $form->field($model, 'url') ?>
                <?= $form->field($model, 'name') ?>
                <?= $form->field($model, 'title') ?>
                <?= $form->field($model, 'keywords') ?>
                <?= $form->field($model, 'description') ?>
                <?= $form->field($model, 'copyright')->textarea() ?>
                <?= $form->field($model, 'close')->inline(true)->radioList(['1' => Yii::t('admin', 'Yes'), '0' => Yii::t('admin', 'No')]); ?>
                <?= $form->field($model, 'closeReason')->textarea() ?>
                <?= $form->field($model, 'analysisCode')->textarea() ?>
            </fieldset>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-12">
                        <?= Html::submitButton(Yii::t('admin', 'Save'), ['class' => 'btn btn-primary']) ?>
                    </div>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
            <?php Jarvis::end(); ?>
        </article>
    </div>
</section>