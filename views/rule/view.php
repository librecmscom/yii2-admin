<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\widgets\Jarvis;

/**
 * @var \yii\web\View $this
 * @var \yuncms\admin\models\AdminAuthItem $model
 */
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Manage Rule'), 'url' => ['index']];
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
                        'label' => Yii::t('admin', 'Manage Rule'),
                        'url' => ['/admin/rule/index'],
                    ],
                    [
                        'label' => Yii::t('admin', 'Create Rule'),
                        'url' => ['/admin/rule/create'],
                    ],
                    [
                        'label' => Yii::t('admin', 'Update Rule'),
                        'url' => ['/admin/rule/update', 'id' => $model->name],
                    ],
                    [
                        'label' => Yii::t('admin', 'Delete Rule'),
                        'url' => ['/admin/rule/delete', 'id' => $model->name],
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

            <?php
            echo DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'name',
                    'className',
                ],
            ]);
            ?>
            <?php Jarvis::end(); ?>
        </article>
    </div>
</section>

