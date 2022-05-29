<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "income_main".
 *
 * @property int $Year
 * @property int $DocNum
 * @property int $OperationID
 * @property string $Description
 * @property string $SupplierName
 * @property string $CreationDate
 * @property string $ConfirmationDate
 */
class IncomeMain extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'income_main';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Year', 'DocNum', 'OperationID', 'Description', 'SupplierName', 'CreationDate', 'ConfirmationDate'], 'required'],
            [['Year', 'DocNum', 'OperationID'], 'integer'],
            [['Description'], 'string'],
            [['CreationDate', 'ConfirmationDate'], 'safe'],
            [['SupplierName'], 'string', 'max' => 255],
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
            'SupplierName' => 'Supplier Name',
            'CreationDate' => 'Creation Date',
            'ConfirmationDate' => 'Confirmation Date',
        ];
    }
}
