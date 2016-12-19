<?php

use backend\helpers\Html;
use yii\widgets\DetailView;
use backend\widgets\Jarvis;

/* @var $this yii\web\View */
/* @var $model common\models\Badword */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend/ban-word', 'Manage Ban Word'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<section id="widget-grid">
    <div class="row">
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12 ban-word-view">
            <?php Jarvis::begin([
                'noPadding' => true,
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
                    [
                        'label' => Yii::t('backend/ban-word', 'Update Ban Word'),
                        'url' => ['/ban-word/update', 'id' => $model->id],
                        'options' => ['class' => 'btn btn-primary btn-sm']
                    ],
                    [
                        'label' => Yii::t('backend/ban-word', 'Delete Ban Word'),
                        'url' => ['/ban-word/delete', 'id' => $model->id],
                        'options' => [
                            'class' => 'btn btn-danger btn-sm',
                            'data' => [
                                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                                'method' => 'post',
                            ],
                        ]
                    ],
                ]
            ]); ?>
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'word',
                    'created_at:datetime',
                ],
            ]) ?>
            <?php Jarvis::end(); ?>
        </article>
    </div>
</section>