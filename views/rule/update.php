<?php

use yuncms\admin\helpers\Html;
use yuncms\admin\widgets\Jarvis;

/* @var yii\web\View $this   */
/* @var yuncms\admin\models\AdminBizRule $model  */

$this->title = Yii::t('admin/rule', 'Update Rule') . ': ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin/rule', 'Manage Rule'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->name]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<section id="widget-grid">
    <div class="row">
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <?php Jarvis::begin([
                'editbutton' => false,
                'deletebutton' => false,
                'header' => Html::encode($this->title),
                'bodyToolbarActions' => [
                    [
                        'label' => Yii::t('admin/rule', 'Manage Rule'),
                        'url' => ['/rule/index'],
                    ],
                    [
                        'label' => Yii::t('admin/rule', 'Create Rule'),
                        'url' => ['/rule/create'],
                    ],
                ]
            ]); ?>
    <?=
    $this->render('_form', [
        'model' => $model,
    ]);
    ?>
    <?php Jarvis::end(); ?>
    </article>
</div>
</section>
