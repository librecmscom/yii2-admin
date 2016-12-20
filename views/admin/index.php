<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yuncms\admin\widgets\Jarvis;
use yuncms\admin\models\Admin;

/* @var $this */
/* @var \yuncms\admin\models\AdminSearch $searchModel */
/* @var \yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('admin/admin', 'Manage Admin');
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
                        'label' => Yii::t('admin/admin', 'Manage Admin'),
                        'url' => ['/admin/admin/index'],
                    ],
                    [
                        'label' => Yii::t('admin/admin', 'Create Admin'),
                        'url' => ['/admin/admin/create'],
                    ],
                ]
            ]); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn', 'header' => 'ID'],
                    'username',
                    'email:email',
                    [
                        'attribute' => 'status',
                        'value' => function ($model) {
                            return $model->status == Admin::STATUS_ACTIVE ? Yii::t('admin/admin', 'Active') : Yii::t('admin/admin', 'Disable');
                        },
                        'label' => Yii::t('app', 'Status'),
                    ],
                    'last_login_at:datetime',
                    'created_at:datetime',
                    'updated_at:datetime',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => Yii::t('app', 'Operation'),
                        'template' => '{assignment} {view} {update} {delete}',
                        'buttons' => ['assignment' => function ($url, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-dashboard"></span>',
                                Url::toRoute(['/admin/assignment/view', 'id' => $model->id]), [
                                    'title' => Yii::t('admin/admin', 'Assignment'),
                                    'aria-label' => Yii::t('admin/admin', 'Assignment'),
                                    'data-pjax' => '0',
                                ]);
                        }]
                    ]
                ]
            ]); ?>
            <?php Jarvis::end(); ?>
        </article>
    </div>
</section>