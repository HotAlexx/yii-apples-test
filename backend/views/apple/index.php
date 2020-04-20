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
            'color',
            [
                'attribute'=> 'date_of_birth',
                'value'=> function ($model){
                    return ($model->date_of_birth === null ? "Нет" : date('d-m-Y H:i:s', $model->date_of_birth));
                },
            ],
            [
                'attribute'=> 'date_of_fall',
                'value'=> function ($model){
                    return ($model->date_of_fall === null ? "Нет" : date('d-m-Y H:i:s', $model->date_of_fall));
                },
            ],
            'percent',
            [
                'attribute'=> 'is_fell',
                'value'=> function ($model){
                    return ($model->is_fell ? "Да" : "Нет");
                },
            ],
            [
                'attribute'=> 'is_rotten',
                'value'=> function ($model){
                    return ($model->is_rotten ? "Да" : "Нет");
                },
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
