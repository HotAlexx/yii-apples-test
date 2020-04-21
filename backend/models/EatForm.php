<?php

namespace backend\models;

use Yii;
use yii\base\Model;

/**
 * EatForm is the model for eating form.
 */
class EatForm extends Model
{
    public $percent;
    public $allowedPercent;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['percent', 'required'],
            ['percent', 'integer'],
            ['percent', 'percentValidation'],
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

    /**
     * Percent validation
     *
     * @param $attribute
     * @param $params
     * @return bool
     */
    public function percentValidation($attribute, $params)
    {
        if ($this->percent > $this->allowedPercent) {
            $this->addError($attribute, Yii::t('app', 'Too big percent!'));
            return false;
        } else {
            return true;
        }


    }

}
