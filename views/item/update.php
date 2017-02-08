<?php

use yii\helpers\Html;
use yuncms\admin\widgets\Jarvis;

/* @var \yii\web\View $this */
/* @var \yuncms\admin\models\AdminAuthItem $model */
/* @var \yuncms\admin\components\ItemController $context */

$labels = $this->context->labels();
if ($labels['Item'] == 'Role') {
    $this->title = Yii::t('admin', 'Update Role') . ': ' . $model->name;
    $this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Manage Role'), 'url' => ['index']];
    $actions = [
        [
            'label' => Yii::t('admin', 'Manage Role'),
            'url' => ['/admin/role/index'],
        ],
        [
            'label' => Yii::t('admin', 'Create Role'),
            'url' => ['/admin/role/create'],
        ],
    ];
} else {
    $this->title = Yii::t('admin', 'Update Permission') . ': ' . $model->name;
    $this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Manage Permission'), 'url' => ['index']];
    $actions = [
        [
            'label' => Yii::t('admin', 'Manage Permission'),
            'url' => ['/admin/permission/index'],
        ],
        [
            'label' => Yii::t('admin', 'Create Permission'),
            'url' => ['/admin/permission/create'],
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
