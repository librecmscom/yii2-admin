<?php
use yii\widgets\DetailView;
use yii\helpers\Html;
use yuncms\admin\widgets\Jarvis;

/* @var $this yii\web\View */
/* @var $model yuncms\admin\models\Banword */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('admin', 'Manage Ban Word'), 'url' => ['index']];
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
                        'label' => Yii::t('admin', 'Manage Ban Word'),
                        'url' => ['/admin/ban-word/index'],
                    ],
                    [
                        'label' => Yii::t('admin', 'Create Ban Word'),
                        'url' => ['/admin/ban-word/create'],
                    ],
                    [
                        'label' => Yii::t('admin', 'Update Ban Word'),
                        'url' => ['/admin/ban-word/update', 'id' => $model->id],
                        'options' => ['class' => 'btn btn-primary btn-sm']
                    ],
                    [
                        'label' => Yii::t('admin', 'Delete Ban Word'),
                        'url' => ['/admin/ban-word/delete', 'id' => $model->id],
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