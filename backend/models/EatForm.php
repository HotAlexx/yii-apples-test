<?php

namespace backend\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class EatForm extends Model
{
    public $percent;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['percent', 'required'],
            ['percent', 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'percent' => Yii::t('app', 'Percent'),
        ];
    }

}
