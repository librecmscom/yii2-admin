<?php

use yii\widgets\Pjax;
use yuncms\admin\helpers\Html;
use yuncms\admin\widgets\Jarvis;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel \yuncms\admin\models\AdminAssignmentSearch */
/* @var $usernameField string */
/* @var $extraColumns string[] */

$this->title = Yii::t('admin/assignment', 'Manage Assignment');
$this->params['breadcrumbs'][] = $this->title;

$columns = [
    ['class' => 'yii\grid\SerialColumn'],
    $usernameField,
];
if (!empty($extraColumns)) {
    $columns = array_merge($columns, $extraColumns);
}
$columns[] = [
    'class' => 'yii\grid\ActionColumn',
    'template' => '{view}', 'header' => Yii::t('app', 'Operation')
];
?>
<section id="widget-grid">
    <div class="row">
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 assignment-view">
            <?php Jarvis::begin([
                'noPadding' => true,
                'editbutton' => false,
                'deletebutton' => false,
                'header' => Html::encode($this->title),
                'bodyToolbarActions' => [
                    [
                        'label' => Yii::t('admin/assignment', 'Manage Assignment'),
                        'url' => ['/admin/assignment/index'],
                    ],
                    [
                        'label' => Yii::t('admin/assignment', 'Create Admin'),
                        'url' => ['/admin/admin/create'],
                    ],
                ]
            ]); ?>
            <?php Pjax::begin(); ?>
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => $columns,
            ]);
            ?>
            <?php Pjax::end(); ?>
            <?php Jarvis::end(); ?>
        </article>
    </div>
</section>
