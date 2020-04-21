<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Apples');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apples-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Apple'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute'=> 'color',
                'value'=> function ($model){
                    return Yii::t('app', $model->color);
                },
            ],
            [
                'attribute'=> 'date_of_birth',
                'value'=> function ($model){
                    return ($model->date_of_birth === null ? Yii::t('app', 'No') : date('d.m.Y H:i:s', $model->date_of_birth));
                },
            ],
            [
                'attribute'=> 'date_of_fall',
                'value'=> function ($model){
                    return ($model->date_of_fall === null ? Yii::t('app', 'No') : date('d.m.Y H:i:s', $model->date_of_fall));
                },
            ],
            'percent',
            [
                'attribute'=> 'is_fell',
                'value'=> function ($model){
                    return ($model->is_fell ? Yii::t('app', 'Yes') : Yii::t('app', 'No'));
                },
            ],
            [
                'attribute'=> 'is_rotten',
                'value'=> function ($model){
                    return ($model->is_rotten ? Yii::t('app', 'Yes') : Yii::t('app', 'No'));
                },
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{fall} {eat}',
                'urlCreator'=>function($action, $model, $key, $index){
                    return [$action,'id'=>$model->id];
                },
                'visibleButtons' => [
                    'fall' => function ($model, $key, $index) {
                        return !$model->is_fell;
                    },
                    'eat' => function ($model, $key, $index) {
                        return ($model->is_fell && $model->percent > 0);
                    }
                ],
                'buttons' => [
                        'fall' => function ($url, $model) {
                            return Html::a(Yii::t('app', 'Fall'), $url, [
                                'title' => Yii::t('app', 'Fall'),
                                'data-confirm' => Yii::t('app', 'Are you sure to fall this apple?'),
                                'data-method' => 'post',
                            ]);
                        },
                        'eat' => function ($url, $model) {
                            return Html::a(Yii::t('app', 'Eat'), $url, [
                                'title' => Yii::t('app', 'Eat'),
                            ]);
                        }

                ],
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
