<?php

use backend\helpers\Html;
use backend\widgets\Jarvis;

/* @var \yii\web\View $this */
/* @var \common\models\AdminAuthItem $model */
/* @var \backend\components\ItemController $context */

$labels = $this->context->labels();
if ($labels['Item'] == 'Role') {
    $this->title = Yii::t('backend/role', 'Update Role') . ': ' . $model->name;
    $this->params['breadcrumbs'][] = ['label' => Yii::t('backend/role', 'Manage Role'), 'url' => ['index']];
    $actions = [
        [
            'label' => Yii::t('backend/role', 'Manage Role'),
            'url' => ['/role/index'],
        ],
        [
            'label' => Yii::t('backend/role', 'Create Role'),
            'url' => ['/role/create'],
        ],
    ];
} else {
    $this->title = Yii::t('backend/permission', 'Update Permission') . ': ' . $model->name;
    $this->params['breadcrumbs'][] = ['label' => Yii::t('backend/permission', 'Manage Permission'), 'url' => ['index']];
    $actions = [
        [
            'label' => Yii::t('backend/permission', 'Manage Permission'),
            'url' => ['/permission/index'],
        ],
        [
            'label' => Yii::t('backend/permission', 'Create Permission'),
            'url' => ['/permission/create'],
        ],
    ];
}


$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->name]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<section id="widget-grid">
    <div class="row">
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <?php Jarvis::begin([
                'editbutton' => false,
                'deletebutton' => false,
                'header' => Html::encode($this->title),
                'bodyToolbarActions' => $actions
            ]); ?>
            <?=
            $this->render('_form', [
                'model' => $model,
            ]);
            ?>
            <?php Jarvis::end(); ?>
        </article>
    </div>
</section>
