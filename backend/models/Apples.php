<?php

namespace app\models;

use Yii;
use yii\base\Exception;
use yii\web\HttpException;

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
    const TIME_TO_ROTE = 18000; // 5 hours

    public $allowedColors = ['red', 'green', 'yellow', 'white', 'unexpected'];

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
            [['color'], 'validColor'],
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

    public function validColor($attribute, $params)
    {
        if (!in_array($this->$attribute, $this->allowedColors)) {
            $this->addError($attribute, Yii::t('app', 'Undefined apple color'));
            return false;
        } else {
            return true;
        }

    }

    public function colorList() : array
    {
        $list = [];
        foreach ($this->allowedColors as $color) {
            $list[$color] = Yii::t('app', $color);
        }
        return $list;
    }

    public function fall()
    {
        $this->is_fell = true;
        $this->date_of_fall = time();
        $this->save();
        return true;
    }

    /**
     * @param $percent
     * @return bool
     * @throws Exception
     */
    public function eat($percent)
    {
        if ($this->is_fell && !$this->is_rotten && ($this->percent - $percent) >= 0) {
            $this->percent -= $percent;
            return true;
        } else {
            throw new Exception(Yii::t('app', 'Bad request.'), '400');
        }
    }

    public function checkRot()
    {
        if (!$this->is_rotten && $this->is_fell) {
            $time_falling = time() - $this->date_of_fall;
            if ($time_falling >= self::TIME_TO_ROTE) {
                $this->is_rotten = true;
                $this->save();
            }
        }
    }
}
