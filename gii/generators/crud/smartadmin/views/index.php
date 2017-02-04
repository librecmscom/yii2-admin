<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();
$nameAttribute = $generator->getNameAttribute();

echo "<?php\n";
?>

use yii\helpers\Html;
use yuncms\admin\widgets\Jarvis;
use <?= $generator->indexWidgetType === 'grid' ? "yii\\grid\\GridView" : "yii\\widgets\\ListView" ?>;
<?= $generator->enablePjax ? 'use yii\widgets\Pjax;' : '' ?>

/* @var $this yii\web\View */
<?= !empty($generator->searchModelClass) ? "/* @var \$searchModel " . ltrim($generator->searchModelClass, '\\') . " */\n" : '' ?>
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = <?= $generator->generateString('Manage ' . Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>;
$this->params['breadcrumbs'][] = $this->title;
?>
<section id="widget-grid">
    <div class="row">
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 <?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-index">
            <?= $generator->enablePjax ? '<?php Pjax::begin(); ?>' : '' ?>
                <?php if ($generator->indexWidgetType === 'grid'): ?>

            <?= "<?php " ?>Jarvis::begin([
                'noPadding' => true,
                'editbutton' => false,
                'deletebutton' => false,
                'header' => Html::encode($this->title),
                'bodyToolbarActions' => [
                    [
                        'label' => <?= $generator->generateString('Manage ' . Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>,
                        'url' => ['/<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>/index'],
                    ],
                    [
                        'label' => <?= $generator->generateString('Create ' . Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>,
                        'url' => ['/<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>/create'],
                    ],
                ]
            ]); ?>
<?php if(!empty($generator->searchModelClass)): ?>
           <?= " <?php " . ($generator->indexWidgetType === 'grid' ? "// " : "") ?>echo $this->render('_search', ['model' => $searchModel]); ?>
<?php endif; ?>
            <?= "<?= " ?>GridView::widget([
                'dataProvider' => $dataProvider,
                <?= !empty($generator->searchModelClass) ? "'filterModel' => \$searchModel,\n                'columns' => [\n" : "'columns' => [\n"; ?>
                    ['class' => 'yii\grid\SerialColumn'],
<?php
$count = 0;
if (($tableSchema = $generator->getTableSchema()) === false) {
    foreach ($generator->getColumnNames() as $name) {
        if (++$count < 6) {
            echo "                    '" . $name . "',\n";
        } else {
            echo "                    // '" . $name . "',\n";
        }
    }
} else {
    foreach ($tableSchema->columns as $column) {
        $format = $generator->generateColumnFormat($column);
        if (++$count < 6) {
            echo "                    '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
        } else {
            echo "                    // '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
        }
    }
}
?>
                    ['class' => 'yii\grid\ActionColumn','header' => Yii::t('app', 'Operation'),],
                ],
            ]); ?>
            <?= "<?php " ?>Jarvis::end(); ?>
            <?php else: ?>
                <?= "<?= " ?>ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemOptions' => ['class' => 'item'],
                    'itemView' => function ($model, $key, $index, $widget) {
                        return Html::a(Html::encode($model-><?= $nameAttribute ?>), ['view', <?= $urlParams ?>]);
                    },
                ]) ?>
            <?php endif; ?><?= $generator->enablePjax ? '<?php Pjax::end(); ?>' : '' ?>

        </article>
    </div>
</section>
