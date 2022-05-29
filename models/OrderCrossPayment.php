<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order_cross_payment".
 *
 * @property int $ordYear
 * @property string $ordDocNum
 * @property string $odOperDocType
 * @property int $odRangeID
 * @property int $odDocNum
 * @property float $foMoneyAmount
 * @property string $foFinOperClass
 * @property int $foFO_ID
 * @property int $foOperSign
 * @property int $foValutaID
 * @property string $foValutaName
 * @property float $foValutaRatio
 */
class OrderCrossPayment extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order_cross_payment';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ordYear', 'ordDocNum', 'odOperDocType', 'odRangeID', 'odDocNum', 'foMoneyAmount', 'foFinOperClass', 'foFO_ID', 'foOperSign', 'foValutaID', 'foValutaName', 'foValutaRatio'], 'required'],
            [['ordYear', 'odRangeID', 'odDocNum', 'foFO_ID', 'foOperSign', 'foValutaID'], 'integer'],
            [['foMoneyAmount', 'foValutaRatio'], 'number'],
            [['ordDocNum'], 'string', 'max' => 50],
            [['odOperDocType'], 'string', 'max' => 6],
            [['foFinOperClass'], 'string', 'max' => 11],
            [['foValutaName'], 'string', 'max' => 10],
            [['ordYear', 'ordDocNum', 'odOperDocType', 'odRangeID', 'odDocNum', 'foFO_ID'], 'unique', 'targetAttribute' => ['ordYear', 'ordDocNum', 'odOperDocType', 'odRangeID', 'odDocNum', 'foFO_ID']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ordYear' => 'Ord Year',
            'ordDocNum' => 'Ord Doc Num',
            'odOperDocType' => 'Od Oper Doc Type',
            'odRangeID' => 'Od Range ID',
            'odDocNum' => 'Od Doc Num',
            'foMoneyAmount' => 'Fo Money Amount',
            'foFinOperClass' => 'Fo Fin Oper Class',
            'foFO_ID' => 'Fo Fo ID',
            'foOperSign' => 'Fo Oper Sign',
            'foValutaID' => 'Fo Valuta ID',
            'foValutaName' => 'Fo Valuta Name',
            'foValutaRatio' => 'Fo Valuta Ratio',
        ];
    }
}
