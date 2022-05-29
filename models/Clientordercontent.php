<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clientordercontent".
 *
 * @property int $ClientOrderID
 * @property int $GoodID
 * @property string $InnerCode
 * @property string $OriginalCode
 * @property string $GoodNameRus
 * @property string $GoodNameEng
 * @property int $AmountCreated
 * @property int $AmountPrepared
 * @property int $AmountOrdered
 * @property int $AmountConfirmed
 * @property int $AmountInvoiced
 * @property int $AmountIncomed
 * @property int $AmountIncomed2
 * @property int $AmountReserved
 * @property int $AmountOutcomed
 * @property int $AmountOutcomed2
 * @property float $Price
 * @property float $Discount
 * @property float $Summa
 * @property string $StateCode
 * @property string $sGoodStatus
 */
class Clientordercontent extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clientordercontent';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ClientOrderID', 'GoodID', 'InnerCode', 'OriginalCode', 'GoodNameRus', 'GoodNameEng', 'AmountCreated', 'AmountPrepared', 'AmountOrdered', 'AmountConfirmed', 'AmountInvoiced', 'AmountIncomed', 'AmountIncomed2', 'AmountReserved', 'AmountOutcomed', 'AmountOutcomed2', 'Price', 'Discount', 'Summa', 'StateCode', 'sGoodStatus'], 'required'],
            [['ClientOrderID', 'GoodID', 'AmountCreated', 'AmountPrepared', 'AmountOrdered', 'AmountConfirmed', 'AmountInvoiced', 'AmountIncomed', 'AmountIncomed2', 'AmountReserved', 'AmountOutcomed', 'AmountOutcomed2','Amount'], 'integer'],
            [['Price', 'Discount', 'Summa'], 'number'],
            [['InnerCode'], 'string', 'max' => 20],
            [['OriginalCode','ManufacturerName','Einc_sDocNums_List'], 'string', 'max' => 50],
            [['GoodNameRus', 'GoodNameEng'], 'string', 'max' => 255],
            [['StateCode','sGoodStatus_Date'], 'string', 'max' => 10],
            [['sGoodStatus'], 'string', 'max' => 256],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ClientOrderID' => 'Client Order ID',
            'GoodID' => 'Good ID',
            'InnerCode' => 'Inner Code',
            'OriginalCode' => 'Original Code',
            'ManufacturerName' => 'ManufacturerName',
            'GoodNameRus' => 'Good Name Rus',
            'GoodNameEng' => 'Good Name Eng',
            'AmountCreated' => 'Amount Created',
            'AmountPrepared' => 'Amount Prepared',
            'AmountOrdered' => 'Amount Ordered',
            'AmountConfirmed' => 'Amount Confirmed',
            'AmountInvoiced' => 'Amount Invoiced',
            'AmountIncomed' => 'Amount Incomed',
            'AmountIncomed2' => 'Amount Incomed2',
            'AmountReserved' => 'Amount Reserved',
            'AmountOutcomed' => 'Amount Outcomed',
            'AmountOutcomed2' => 'Amount Outcomed2',
            'Amount' => 'Amount',
            'Price' => 'Price',
            'Discount' => 'Discount',
            'Summa' => 'Summa',
            'StateCode' => 'State Code',
            'sGoodStatus' => 'S Good Status',
            'Einc_sDocNums_List' => 'Einc_sDocNums_List',
            'sGoodStatus_Date' => 'sGoodStatus_Date',
        ];
    }
}
