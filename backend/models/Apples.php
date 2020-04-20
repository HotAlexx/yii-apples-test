<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "apples".
 *
 * @property int $id
 * @property string $color
 * @property string|null $date_of_birth
 * @property string|null $date_of_fall
 * @property float $percent
 * @property int $is_fell
 * @property int $is_rotten
 */
class Apples extends \yii\db\ActiveRecord
{

    public function init()
    {
        parent::init();

        // Generate random date_of_birth
        $start = mktime(0,0,0,1,1,2020);
        $end  = time();
        $this->date_of_birth = rand($start,$end);

        $this->percent = 100;
        $this->is_fell = false;
        $this->is_rotten = false;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'apples';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['color', 'percent', 'is_fell', 'is_rotten'], 'required'],
            [['date_of_birth', 'date_of_fall'], 'safe'],
            [['is_fell', 'is_rotten'], 'boolean'],
            [['percent'], 'number'],
            [['color'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'color' => 'Цвет',
            'date_of_birth' => 'Дата появления',
            'date_of_fall' => 'Дата падения',
            'percent' => 'Целостность',
            'is_fell' => 'Упало с дерева',
            'is_rotten' => 'Гнилое',
        ];
    }
}
