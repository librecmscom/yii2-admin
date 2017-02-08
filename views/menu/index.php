<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yuncms\admin\grid\TreeGrid;
use yuncms\admin\widgets\Jarvis;

/* @var \yii\web\View $this */
/* @var \yii\data\ActiveDataProvider $dataProvider */
/* @var \yuncms\admin\models\AdminMenuSearch $searchModel */

$this->title = Yii::t('admin', 'Manage Menu');
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
                        'label' => Yii::t('admin', 'Manage Menu'),
                        'url' => ['/admin/menu/index'],
                    ],
                    [
                        'label' => Yii::t('admin', 'Create Menu'),
                        'url' => ['/admin/menu/create'],
                    ],
                ]
            ]); ?>
            <?php Pjax::begin(); ?>
            <?= TreeGrid::widget([
                'dataProvider' => $dataProvider,
                'keyColumnName' => 'id',
                'parentColumnName' => 'parent',
                'parentRootValue' => null, //first parentId value
                'pluginOptions' => [
                    'initialState' => 'collapse',
                ],
                'columns' => [
                    'name',
                    'route',
                    [
                        'attribute' => 'icon',
                        'value' => function($model) {
                            return Html::icon($model->icon);
                        },
                        'format' => 'raw'
                    ],
                    [
                        'class' => 'yuncms\admin\grid\PositionColumn',
                        'attribute' => 'sort'
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => Yii::t('app', 'Operation'),
                        'template' => '{add} {view} {update} {delete}',
                        'buttons' => ['add' => function ($url, $model, $key) {
                            return Html::a('<span class="fa fa-plus"></span>',
                                Url::toRoute(['/admin/menu/create', 'parent' => $model->id]), [
                                    'title' => Yii::t('admin', 'Add subMenu'),
                                    'aria-label' => Yii::t('admin', 'Add subMenu'),
                                    'data-pjax' => '0',
                                ]);
                        }]
                    ]
                ],
            ]); ?>
            <?php Pjax::end(); ?>
            <?php Jarvis::end(); ?>
        </article>
    </div>
</section>