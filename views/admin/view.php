<?php

use backend\helpers\Html;
use yii\widgets\DetailView;
use backend\widgets\Jarvis;
use common\models\Admin;

/* @var \yii\web\View $this */
/* @var \common\models\Admin $model */

$this->title = $model->username;
$this->params['breadcrumbs'][] = [
    'label' => Yii::t('backend/admin', 'Manage Admin'),
    'url' => ['index']
];
$this->params['breadcrumbs'][] = $this->title;
?>
<section id="widget-grid">
    <div class="row">
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <?php Jarvis::begin([
                'noPadding' => true,
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
                    [
                        'label' => Yii::t('backend/admin', 'Update Admin'),
                        'url' => ['/admin/update', 'id' => $model->id],
                    ],
                    [
                        'label' => Yii::t('backend/admin', 'Delete Admin'),
                        'url' => ['/admin/delete', 'id' => $model->id],
                        'options' => [
                            'class' => 'btn btn-danger btn-sm',
                            'data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                'method' => 'post',
                            ],
                        ]
                    ],
                ]
            ]); ?>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'username',
                    'email:email',
                    [
                        'value' => $model->status == Admin::STATUS_ACTIVE ? Yii::t('backend/admin', 'Active') : Yii::t('backend/admin', 'Disable'),
                        'label' => Yii::t('app', 'Status'),
                    ],
                    'created_at:datetime',
                    //'updated_at:datetime',
                ],
            ]) ?>
            <?php Jarvis::end(); ?>
        </article>
    </div>
</section>

