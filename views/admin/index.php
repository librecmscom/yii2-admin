<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use backend\widgets\Jarvis;
use common\models\Admin;

/* @var $this */
/* @var \backend\models\AdminSearch $searchModel */
/* @var \yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('backend/admin', 'Manage Admin');
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
                            return $model->status == Admin::STATUS_ACTIVE ? Yii::t('backend/admin', 'Active') : Yii::t('backend/admin', 'Disable');
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
                                Url::toRoute(['assignment/view', 'id' => $model->id]), [
                                    'title' => Yii::t('backend/admin', 'Assignment'),
                                    'aria-label' => Yii::t('backend/admin', 'Assignment'),
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