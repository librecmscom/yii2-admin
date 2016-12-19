<?php

use backend\helpers\Html;
use backend\widgets\Jarvis;

/* @var $this yii\web\View */
/* @var $model common\models\Badword */

$this->title = Yii::t('backend/ban-word', 'Create Ban Word');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend/ban-word', 'Manage Ban Word'), 'url' => ['index']];
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
                        'label' => Yii::t('backend/ban-word', 'Manage Ban Word'),
                        'url' => ['/ban-word/index'],
                    ],
                    [
                        'label' => Yii::t('backend/ban-word', 'Create Ban Word'),
                        'url' => ['/ban-word/create'],
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
