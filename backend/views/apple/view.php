<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Apples */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Apples'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="apples-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
        ],
    ]) ?>

</div>
