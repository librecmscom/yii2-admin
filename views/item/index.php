<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\components\RouteRule;
use backend\widgets\Jarvis;

/* @var \yii\web\View $this */
/* @var \yii\data\ActiveDataProvider $dataProvider */
/* @var \backend\models\AdminAuthItemSearch $searchModel */
/* @var \backend\components\ItemController $context */

$labels = $this->context->labels();
if ($labels['Item'] == 'Role') {
    $this->title = Yii::t('backend/role', 'Manage Role');
    $actions = [
        [
            'label' => Yii::t('backend/role', 'Manage Role'),
            'url' => ['/role/index'],
        ],
        [
            'label' => Yii::t('backend/role', 'Create Role'),
            'url' => ['/role/create'],
        ],
    ];
} else {
    $this->title = Yii::t('backend/permission', 'Manage Permission');
    $actions = [
        [
            'label' => Yii::t('backend/permission', 'Manage Permission'),
            'url' => ['/permission/index'],
        ],
        [
            'label' => Yii::t('backend/permission', 'Create Permission'),
            'url' => ['/permission/create'],
        ],
    ];
}
$this->params['breadcrumbs'][] = $this->title;

$rules = array_keys(Yii::$app->getAuthManager()->getRules());
$rules = array_combine($rules, $rules);
unset($rules[RouteRule::RULE_NAME]);

?>
<section id="widget-grid">
    <div class="row">
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <?php Jarvis::begin([
                'noPadding' => true,
                'editbutton' => false,
                'deletebutton' => false,
                'header' => Html::encode($this->title),
                'bodyToolbarActions' => $actions
            ]); ?>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'name',
                        'label' => Yii::t('backend/role', 'Name'),
                    ],
                    [
                        'attribute' => 'ruleName',
                        'label' => Yii::t('backend/role', 'Rule Name'),
                        'filter' => $rules
                    ],
                    [
                        'attribute' => 'description',
                        'label' => Yii::t('backend/role', 'Description'),
                    ],
                    ['class' => 'yii\grid\ActionColumn',],
                ],
            ])
            ?>
            <?php Jarvis::end(); ?>
        </article>
    </div>
</section>