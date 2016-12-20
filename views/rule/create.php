<?php

use yii\helpers\Html;
use yuncms\admin\widgets\Jarvis;

/* @var \yii\web\View $this */
/* @var \yuncms\admin\models\AdminBizRule $model */

$this->title = Yii::t('admin/rule', 'Create Rule');
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin/rule', 'Manage Rule'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
                        'url' => ['/admin/rule/index'],
                    ],
                    [
                        'label' => Yii::t('admin/rule', 'Create Rule'),
                        'url' => ['/admin/rule/create'],
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