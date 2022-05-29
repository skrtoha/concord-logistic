<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ordercontent_update".
 *
 * @property int $OrderID
 * @property string $GoodID
 * @property string $InnerCode
 * @property string $GoodNameRus
 * @property string $ManufacturerName
 * @property string $OriginalCode
 * @property int $Quantity
 * @property int $Amount
 * @property float $Price
 * @property string $sOperDocsList
 * @property int $State
 * @property string $Status
 * @property string $DeliveryCompany
 * @property string $TrackCode
 */
class OrdercontentUpdate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ordercontent_update';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['OrderID', 'Quantity', 'Amount', 'State'], 'integer'],
            [['Price'], 'number'],
            [['sOperDocsList', 'State', 'Status'], 'required'],
            [['GoodID', 'OriginalCode'], 'string', 'max' => 50],
            [['InnerCode','Status_Date'], 'string', 'max' => 20],
            [['GoodNameRus', 'ManufacturerName', 'DeliveryCompany', 'TrackCode','Einc_sDocNums_List'], 'string', 'max' => 255],
            [['sOperDocsList', 'Status'], 'string', 'max' => 1024],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'OrderID' => 'Order ID',
            'GoodID' => 'Good ID',
            'InnerCode' => 'Inner Code',
            'GoodNameRus' => 'Good Name Rus',
            'ManufacturerName' => 'Manufacturer Name',
            'OriginalCode' => 'Original Code',
            'Quantity' => 'Quantity',
            'Amount' => 'Amount',
            'Price' => 'Price',
            'sOperDocsList' => 'S Oper Docs List',
            'State' => 'State',
            'Status' => 'Status',
            'DeliveryCompany' => 'Delivery Company',
            'TrackCode' => 'Track Code',
            'Einc_sDocNums_List' => 'Einc_sDocNums_List',
        ];
    }
}
