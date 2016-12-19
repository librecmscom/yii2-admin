<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use backend\widgets\Jarvis;

/**
 * @var \yii\web\View $this
 * @var \common\models\AdminAuthItem $model
 */
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend/rule', 'Manage Rule'), 'url' => ['index']];
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
                    [
                        'label' => Yii::t('backend/rule', 'Update Rule'),
                        'url' => ['/rule/update', 'id' => $model->name],
                    ],
                    [
                        'label' => Yii::t('backend/rule', 'Delete Rule'),
                        'url' => ['/rule/delete', 'id' => $model->name],
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

