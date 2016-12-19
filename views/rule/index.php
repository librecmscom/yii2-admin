<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\widgets\Jarvis;

/* @var \yii\web\View $this */
/* @var \common\models\AdminBizRule $model */
/* @var \yii\data\ActiveDataProvider $dataProvider */
/* @var \backend\models\AdminBizRuleSearch $searchModel */

$this->title = Yii::t('backend/rule', 'Manage Rule');
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
                        'label' => Yii::t('backend/rule', 'Manage Rule'),
                        'url' => ['/rule/index'],
                    ],
                    [
                        'label' => Yii::t('backend/rule', 'Create Rule'),
                        'url' => ['/rule/create'],
                    ],
                ]
            ]); ?>
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'name',
                        'label' => Yii::t('backend/rule', 'Rule Name'),
                    ],
                    ['class' => 'yii\grid\ActionColumn', 'header' => Yii::t('app', 'Operation')],
                ],
            ]);
            ?>
            <?php Jarvis::end(); ?>
        </article>
    </div>
</section>
