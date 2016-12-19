<?php

use backend\helpers\Html;
use yii\widgets\DetailView;
use backend\widgets\Jarvis;

/* @var \yii\web\View $this */
/* @var \common\models\AdminMenu $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend/menu', 'Manage Menu'), 'url' => ['index']];
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
                        'label' => Yii::t('backend/menu', 'Manage Menu'),
                        'url' => ['/menu/index'],
                    ],
                    [
                        'label' => Yii::t('backend/menu', 'Create Menu'),
                        'url' => ['/menu/create'],
                    ],
                    [
                        'label' => Yii::t('backend/menu', 'Update Menu'),
                        'url' => ['/menu/update', 'id' => $model->id],
                    ],
                    [
                        'label' => Yii::t('backend/menu', 'Delete Menu'),
                        'url' => ['/menu/delete', 'id' => $model->id],
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

            <?=
            DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'menuParent.name:text:Parent',
                    'name',
                    'route',
                    'sort',
                ],
            ])
            ?>
            <?php Jarvis::end(); ?>
        </article>
    </div>
</section>
