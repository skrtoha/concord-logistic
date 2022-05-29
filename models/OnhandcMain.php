<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "onhandc_main".
 *
 * @property int $Year
 * @property int $DocNum
 * @property int $OperationID
 * @property string $Description
 * @property string $CreationDate
 * @property string $ChangingDate
 * @property string|null $LoadingDate
 * @property string|null $DeliveryDate
 * @property string $ITC_Name_Rus
 * @property string $ITC_Name_Eng
 */
class OnhandcMain extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'onhandc_main';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Year', 'DocNum', 'OperationID', 'Description', 'CreationDate', 'ChangingDate', 'ITC_Name_Rus', 'ITC_Name_Eng'], 'required'],
            [['Year', 'DocNum', 'OperationID'], 'integer'],
            [['Description'], 'string'],
            [['CreationDate', 'ChangingDate', 'LoadingDate', 'DeliveryDate'], 'safe'],
            [['ITC_Name_Rus', 'ITC_Name_Eng'], 'string', 'max' => 255],
            [['OperationID'], 'unique'],
            [['Year', 'DocNum'], 'unique', 'targetAttribute' => ['Year', 'DocNum']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Year' => 'Year',
            'DocNum' => 'Doc Num',
            'OperationID' => 'Operation ID',
            'Description' => 'Description',
            'CreationDate' => 'Creation Date',
            'ChangingDate' => 'Changing Date',
            'LoadingDate' => 'Loading Date',
            'DeliveryDate' => 'Delivery Date',
            'ITC_Name_Rus' => 'Itc Name Rus',
            'ITC_Name_Eng' => 'Itc Name Eng',
        ];
    }
}
