<?php

use yuncms\admin\helpers\Html;
use yuncms\admin\widgets\Jarvis;

/* @var $this yii\web\View */
/* @var $model yuncms\admin\models\Banword */

$this->title = Yii::t('admin/ban-word', 'Create Ban Word');
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin/ban-word', 'Manage Ban Word'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section id="widget-grid">
    <div class="row">
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ban-word-create">
            <?php Jarvis::begin([
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

            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
            <?php Jarvis::end(); ?>
        </article>
    </div>
</section>
