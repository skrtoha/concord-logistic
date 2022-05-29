<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "onhanda_piecesattributes".
 *
 * @property int $OperationID
 * @property int $SortingNum
 * @property float $Weight_lb
 * @property float $Length_inch
 * @property float $Width_inch
 * @property float $Height_inch
 * @property float $Weight_kg
 * @property float $VolumeWeight_kg
 * @property float $OnHandA_VolumeWeightExceedsWeight
 */
class OnhandaPiecesattributes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'onhanda_piecesattributes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['OperationID', 'SortingNum', 'Weight_lb', 'Length_inch', 'Width_inch', 'Height_inch', 'Weight_kg', 'VolumeWeight_kg', 'OnHandA_VolumeWeightExceedsWeight'], 'required'],
            [['OperationID', 'SortingNum'], 'integer'],
            [['Weight_lb', 'Length_inch', 'Width_inch', 'Height_inch', 'Weight_kg', 'VolumeWeight_kg', 'OnHandA_VolumeWeightExceedsWeight'], 'number'],
            [['OperationID', 'SortingNum'], 'unique', 'targetAttribute' => ['OperationID', 'SortingNum']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'OperationID' => 'Operation ID',
            'SortingNum' => 'Sorting Num',
            'Weight_lb' => 'Weight Lb',
            'Length_inch' => 'Length Inch',
            'Width_inch' => 'Width Inch',
            'Height_inch' => 'Height Inch',
            'Weight_kg' => 'Weight Kg',
            'VolumeWeight_kg' => 'Volume Weight Kg',
            'OnHandA_VolumeWeightExceedsWeight' => 'On Hand A Volume Weight Exceeds Weight',
        ];
    }
}
