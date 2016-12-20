<?php

use yii\helpers\Html;
use yuncms\admin\widgets\Jarvis;

/* @var \yii\web\View $this */
/* @var \yuncms\admin\models\Admin $model */

$this->title = Yii::t('admin/admin', 'Update Admin') . ': ' . $model->username;
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('admin/admin', 'Manage Admin'),
    'url' => ['index']
];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<section id="widget-grid">
    <div class="row">
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <?php Jarvis::begin([
                'editbutton' => false,
                'deletebutton' => false,
                'header' => Html::encode($this->title),
                'bodyToolbarActions' => [
                    [
                        'label' => Yii::t('admin/admin', 'Manage Admin'),
                        'url' => ['/admin/admin/index'],
                    ],
                    [
                        'label' => Yii::t('admin/admin', 'Create Admin'),
                        'url' => ['/admin/admin/create'],
                    ],
                ]
            ]); ?>
            <?= $this->render('_form', ['model' => $model]) ?>
            <?php Jarvis::end(); ?>
        </article>
    </div>
</section>