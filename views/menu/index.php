<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yuncms\admin\widgets\Jarvis;

/* @var \yii\web\View $this */
/* @var \yii\data\ActiveDataProvider $dataProvider */
/* @var \yuncms\admin\models\AdminMenuSearch $searchModel */

$this->title = Yii::t('admin/menu', 'Manage Menu');
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
                        'label' => Yii::t('admin/menu', 'Manage Menu'),
                        'url' => ['/admin/menu/index'],
                    ],
                    [
                        'label' => Yii::t('admin/menu', 'Create Menu'),
                        'url' => ['/admin/menu/create'],
                    ],
                ]
            ]); ?>
            <?php Pjax::begin(); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'name',
                    [
                        'attribute' => 'menuParent.name',
                        'filter' => Html::activeTextInput($searchModel, 'parent_name', [
                            'class' => 'form-control', 'id' => null
                        ]),
                        'label' => Yii::t('admin/menu', 'Parent Menu'),
                    ],
                    'route',
                    'icon',
                    'sort',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => Yii::t('app', 'Operation'),
                        'template' => '{add} {view} {update} {delete}',
                        'buttons' => ['add' => function ($url, $model, $key) {
                            return Html::a('<span class="fa fa-plus"></span>',
                                Url::toRoute(['/admin/menu/create', 'parent' => $model->id]), [
                                    'title' => Yii::t('admin/menu', 'Add subMenu'),
                                    'aria-label' => Yii::t('admin/menu', 'Add subMenu'),
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