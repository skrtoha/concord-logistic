<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "outcome_main".
 *
 * @property int $Year
 * @property int $DocNum
 * @property int $OperationID
 * @property string $Description
 * @property string $ClientName
 * @property string $CreationDate
 * @property string $ConfirmationDate
 */
class OutcomeMain extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'outcome_main';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Year', 'DocNum', 'OperationID', 'Description', 'ClientName', 'CreationDate', 'ConfirmationDate'], 'required'],
            [['Year', 'DocNum', 'OperationID'], 'integer'],
            [['Description'], 'string'],
            [['CreationDate', 'ConfirmationDate'], 'safe'],
            [['ClientName'], 'string', 'max' => 255],
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
            'ClientName' => 'Client Name',
            'CreationDate' => 'Creation Date',
            'ConfirmationDate' => 'Confirmation Date',
        ];
    }
}
