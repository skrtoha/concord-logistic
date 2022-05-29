<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "onhanda_content".
 *
 * @property int $OperationID
 * @property int $ClientOrderID
 * @property int $GoodID
 * @property int $Quantity
 * @property string $InnerCode
 * @property string $ActiveOriginalCode
 * @property string $GoodNameRus
 * @property string $GoodNameEng
 * @property string $ManufacturerName
 * @property string $OnHandsB_List
 */
class OnhandaContent extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'onhanda_content';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['OperationID', 'ClientOrderID', 'GoodID', 'Quantity', 'InnerCode', 'ActiveOriginalCode', 'GoodNameRus', 'GoodNameEng', 'ManufacturerName', 'OnHandsB_List'], 'required'],
            [['OperationID', 'ClientOrderID', 'GoodID', 'Quantity'], 'integer'],
            [['OnHandsB_List'], 'string'],
            [['InnerCode'], 'string', 'max' => 10],
            [['ActiveOriginalCode'], 'string', 'max' => 50],
            [['GoodNameRus', 'GoodNameEng', 'ManufacturerName'], 'string', 'max' => 255],
            [['ClientOrderID', 'GoodID', 'OperationID'], 'unique', 'targetAttribute' => ['ClientOrderID', 'GoodID', 'OperationID']],
            [['OperationID', 'ClientOrderID', 'GoodID'], 'unique', 'targetAttribute' => ['OperationID', 'ClientOrderID', 'GoodID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'OperationID' => 'Operation ID',
            'ClientOrderID' => 'Client Order ID',
            'GoodID' => 'Good ID',
            'Quantity' => 'Quantity',
            'InnerCode' => 'Inner Code',
            'ActiveOriginalCode' => 'Active Original Code',
            'GoodNameRus' => 'Good Name Rus',
            'GoodNameEng' => 'Good Name Eng',
            'ManufacturerName' => 'Manufacturer Name',
            'OnHandsB_List' => 'On Hands B List',
        ];
    }
    public function getClientorderbyemailid()
    {
        return $this->hasMany(Clientordersbyemail::className(), ['ClientOrderID' => 'ClientOrderID']);
    }
    public function getOnhandaoperationid()
    {
        return $this->hasMany(OnhandaMain::className(), ['OperationID' => 'OperationID']);
    }
}
