<?php

use yii\helpers\Html;
use yuncms\admin\widgets\Jarvis;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yuncms\admin\models\Banword;

/* @var $this yii\web\View */
/* @var $searchModel yuncms\admin\models\BanwordSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('admin/ban-word', 'Manage Ban Word');
$this->params['breadcrumbs'][] = $this->title;
?>
<section id="widget-grid">
    <div class="row">
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 badword-index">
            <?php Pjax::begin(); ?>
            <?php Jarvis::begin([
                'noPadding' => true,
                'editbutton' => false,
                'deletebutton' => false,
                'header' => Html::encode($this->title),
                'bodyToolbarActions' => [
                    [
                        'label' => Yii::t('admin/ban-word', 'Manage Ban Word'),
                        'url' => ['/admin/ban-word/index'],
                    ],
                    [
                        'label' => Yii::t('admin/ban-word', 'Create Ban Word'),
                        'url' => ['/admin/ban-word/create'],
                    ],
                ]
            ]); ?>
            <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'id',
                    'word',
                    'created_at:datetime',
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'header' => Yii::t('app', 'Operation')
                    ],
                ],
            ]); ?>
            <?php Jarvis::end(); ?>
            <?php Pjax::end(); ?>
        </article>
    </div>
</section>
