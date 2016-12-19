<?php

use yii\helpers\Html;
use backend\widgets\Jarvis;

/* @var \yii\web\View $this */
/* @var \common\models\Admin $model */

$this->title = Yii::t('backend/admin', 'Update Admin') . ': ' . $model->username;
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('backend/admin', 'Manage Admin'),
    'url' => ['index']
];
$this->params['breadcrumbs'][] = ['label' => $model->username, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
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
                        'label' => Yii::t('backend/admin', 'Manage Admin'),
                        'url' => ['/admin/index'],
                    ],
                    [
                        'label' => Yii::t('backend/admin', 'Create Admin'),
                        'url' => ['/admin/create'],
                    ],
                ]
            ]); ?>
            <?= $this->render('_form', ['model' => $model]) ?>
            <?php Jarvis::end(); ?>
        </article>
    </div>
</section>