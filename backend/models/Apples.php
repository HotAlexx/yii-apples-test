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
 * @property int $status
 * @property float $percent
 * @property int $is_fell
 * @property int $is_rotten
 */
class Apples extends \yii\db\ActiveRecord
{
    public function __construct($color, $config = [])
    {
        $this->color = $color;

        // Generate random date_of_birth
        $start = mktime(0,0,0,1,1,2020);
        $end  = time();
        $this->date_of_birth = rand($start,$end);

        $this->percent = 100;
        $this->is_fell = false;
        $this->is_rotten = false;

        parent::__construct($config);
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
            [['color', 'status', 'percent', 'is_fell', 'is_rotten'], 'required'],
            [['date_of_birth', 'date_of_fall'], 'safe'],
            [['status', 'is_fell', 'is_rotten'], 'integer'],
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
            'color' => 'Color',
            'date_of_birth' => 'Date Of Birth',
            'date_of_fall' => 'Date Of Fall',
            'status' => 'Status',
            'percent' => 'Percent',
            'is_fell' => 'Is Fell',
            'is_rotten' => 'Is Rotten',
        ];
    }
}
