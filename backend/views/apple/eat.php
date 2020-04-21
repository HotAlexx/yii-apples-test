<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \backend\models\EatForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Eat');
$this->params['breadcrumbs'][] = ['url' => '/apple', 'label' => Yii::t('app', 'Apples')];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="apple-eat">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Yii::t('app', 'Enter a apple percent you want to eating.') ?>
    </p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'eating-form']); ?>

                <?= $form->field($model, 'percent')->textInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'allowedPercent')->hiddenInput()->label(false); ?>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Eat'), ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
