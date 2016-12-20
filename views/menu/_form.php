<?php
use yii\helpers\Json;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yuncms\admin\models\AdminMenu;
use backend\assets\JuiAsset;
use yuncms\admin\widgets\IconpIcker;
use xutl\typeahead\Bloodhound;
use xutl\typeahead\TypeAhead;

/* @var \yii\web\View $this */
/* @var \common\models\AdminMenu $model */
/* @var yii\bootstrap\ActiveForm $form */
$engine = new Bloodhound([
    'name' => 'countriesEngine',
    'clientOptions' => [
        'datumTokenizer' => new \yii\web\JsExpression("Bloodhound.tokenizers.obj.whitespace('name')"),
        'queryTokenizer' => new \yii\web\JsExpression("Bloodhound.tokenizers.whitespace"),
        'remote' => [
            'url' => Url::to(['auto-complete', 'query' => 'QRY']),
            'wildcard' => 'QRY'
        ]
    ]
]);


?>

<?php $form = ActiveForm::begin(['layout' => 'horizontal']); ?>
<?= Html::activeHiddenInput($model, 'parent', ['id' => 'parent_id']); ?>
<fieldset>
    <?= $form->field($model, 'name')->textInput(['maxlength' => 128]) ?>
    <?= $form->field($model, 'parent_name')->widget(
        TypeAhead::className(),
        [
            'options' => ['class' => 'form-control'],
            'engines' => [$engine],
            'clientOptions' => [
                'highlight' => true,
                'minLength' => 1,
            ],
            'dataSets' => [
                [
                    'name' => 'countries',
                    'display' => 'name',
                    'source' => $engine->getAdapterScript()
                ]
            ]
        ]
    ); ?>
    <?= $form->field($model, 'route')->textInput(['id' => 'route']) ?>
    <?= $form->field($model, 'visible')->inline(true)->radioList(['1' => Yii::t('backend', 'Yes'), '0' => Yii::t('backend', 'No')]) ?>

    <?= $form->field($model, 'sort')->input('number') ?>
    <?= $form->field($model, 'icon')->widget(IconpIcker::className()) ?>
    <?= $form->field($model, 'data')->textarea(['rows' => 4]) ?>
</fieldset>

<div class="form-actions">
    <div class="row">
        <div class="col-md-12">
            <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord
                ? 'btn btn-success' : 'btn btn-primary'])
            ?>
        </div>
    </div>
</div>

<?php ActiveForm::end(); ?>

