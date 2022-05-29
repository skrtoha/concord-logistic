<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ordercontent".
 *
 * @property int $OrderID
 * @property string $GoodID
 * @property string $InnerCode
 * @property string $GoodNameRus
 * @property string $GoodNameEng
 * @property string $UzelName
 * @property string $ManufacturerName
 * @property string $OriginalCode
 * @property int $quantity
 * @property float $price
 * @property string $BasePriceIs
 * @property float $discount_proc
 * @property float $valutaratio
 * @property int $IsForSale
 * @property float|null $good_discount
 * @property string $priceID
 * @property float $usedDiscount
 * @property int $etype
 * @property string $dtime
 */
class Ordercontent extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ordercontent';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['OrderID', 'GoodID', 'priceID', 'usedDiscount'], 'required'],
            [['OrderID', 'quantity', 'IsForSale', 'etype'], 'integer'],
            [['price', 'discount_proc', 'valutaratio', 'good_discount', 'usedDiscount'], 'number'],
            [['GoodID', 'OriginalCode'], 'string', 'max' => 50],
            [['InnerCode'], 'string', 'max' => 20],
            [['GoodNameRus', 'GoodNameEng', 'UzelName', 'ManufacturerName'], 'string', 'max' => 255],
            [['BasePriceIs'], 'string', 'max' => 2],
            [['priceID'], 'string', 'max' => 30],
            [['dtime'], 'string', 'max' => 10],
            [['OrderID', 'GoodID'], 'unique', 'targetAttribute' => ['OrderID', 'GoodID']],
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
            'GoodNameEng' => 'Good Name Eng',
            'UzelName' => 'Uzel Name',
            'ManufacturerName' => 'Manufacturer Name',
            'OriginalCode' => 'Original Code',
            'quantity' => 'Quantity',
            'price' => 'Price',
            'BasePriceIs' => 'Base Price Is',
            'discount_proc' => 'Discount Proc',
            'valutaratio' => 'Valutaratio',
            'IsForSale' => 'Is For Sale',
            'good_discount' => 'Good Discount',
            'priceID' => 'Price ID',
            'usedDiscount' => 'Used Discount',
            'etype' => 'Etype',
            'dtime' => 'Dtime',
        ];
    }
}
