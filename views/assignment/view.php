<?php

use yii\helpers\Json;
use yii\helpers\ArrayHelper;
use yuncms\admin\helpers\Html;
use yuncms\admin\widgets\Jarvis;

/* @var yii\web\View $this */
/* @var \yuncms\admin\models\AdminAssignment $model */
/* @var string $fullnameField */

$userName = $model->{$usernameField};
if (!empty($fullnameField)) {
    $userName .= ' (' . ArrayHelper::getValue($model, $fullnameField) . ')';
}
$userName = Html::encode($userName);

$this->title = Yii::t('admin/assignment', 'Assignment') . ' : ' . $userName;
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin/assignment', 'Manage Assignment'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $userName;

$opts = Json::htmlEncode([
    'items' => $model->getItems()
]);
$this->registerJs("var _opts = {$opts};");
$this->registerJs($this->render('_script.js'));
$animateIcon = ' <i class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></i>';
?>
<section id="widget-grid">
    <div class="row">
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 assignment-view">
            <?php Jarvis::begin([
                'editbutton' => false,
                'deletebutton' => false,
                'header' => Html::encode($this->title),
                'bodyToolbarActions' => [
                    [
                        'label' => Yii::t('admin/assignment', 'Manage Assignment'),
                        'url' => ['/admin/assignment/index'],
                    ],
                    [
                        'label' => Yii::t('app', 'Create'),
                        'url' => ['/admin/admin/create'],
                    ],
                ]
            ]); ?>

            <div class="row">
                <div class="col-sm-5">
                    <input class="form-control search" data-target="avaliable"
                           placeholder="<?= Yii::t('admin/assignment', 'Search for avaliable') ?>">
                    <select multiple size="20" class="form-control list" data-target="avaliable">
                    </select>
                </div>
                <div class="col-sm-2" style="text-align:center">
                    <br>
                    <br>
                    <?=
                    Html::a('&gt;&gt;' . $animateIcon, ['assign', 'id' => (string)$model->id], [
                        'class' => 'btn btn-success btn-assign', 'data-target' => 'avaliable'])
                    ?>
                    <br>
                    <br>
                    <?=
                    Html::a('&lt;&lt;' . $animateIcon, ['revoke', 'id' => (string)$model->id], [
                        'class' => 'btn btn-danger btn-assign', 'data-target' => 'assigned'])
                    ?>
                </div>
                <div class="col-sm-5">
                    <input class="form-control search" data-target="assigned"
                           placeholder="<?= Yii::t('admin/assignment', 'Search for assigned') ?>">
                    <select multiple size="20" class="form-control list" data-target="assigned">
                    </select>
                </div>
            </div>
            <?php Jarvis::end(); ?>
        </article>
    </div>
</section>
