<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "financeoperations".
 *
 * @property int $FO_ID
 * @property int $ConfirmationSortingColumn
 * @property string $EMail
 * @property int $FinOperTypeID
 * @property string $GuidType
 * @property int $Year
 * @property int $DocNum
 * @property string $TypeName
 * @property string $Date
 * @property float $ValutaRatio
 * @property string $ValutaName
 * @property int $OperSign
 * @property float $Summa
 * @property string $OperDocType
 * @property int $OperDocYear
 * @property int $OperDocNum
 * @property string $sOperDocsList
 * @property int $SaldoSign
 * @property string $SaldoType
 * @property string $SaldoTypeDetailed
 * @property string $CashType
 * @property string $Comment
 * @property float $Saldo
 * @property float $SaleSaldo
 * @property float $ConsignationSaldo
 * @property float $RealizationSaldo
 */
class Financeoperations extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'financeoperations';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['FO_ID', 'ConfirmationSortingColumn', 'EMail', 'FinOperTypeID', 'GuidType', 'Year', 'DocNum', 'TypeName', 'Date', 'ValutaRatio', 'ValutaName', 'OperSign', 'Summa', 'OperDocType', 'OperDocYear', 'OperDocNum', 'sOperDocsList', 'SaldoSign', 'SaldoType', 'SaldoTypeDetailed', 'CashType', 'Comment', 'Saldo', 'SaleSaldo', 'ConsignationSaldo', 'RealizationSaldo'], 'required'],
            [['FO_ID', 'ConfirmationSortingColumn', 'FinOperTypeID', 'Year', 'DocNum', 'OperSign', 'OperDocYear', 'OperDocNum', 'SaldoSign'], 'integer'],
            [['ValutaRatio', 'Summa', 'Saldo', 'SaleSaldo', 'ConsignationSaldo', 'RealizationSaldo'], 'number'],
            [['sOperDocsList', 'Comment'], 'string'],
            [['EMail', 'TypeName'], 'string', 'max' => 150],
            [['GuidType'], 'string', 'max' => 38],
            [['Date'], 'string', 'max' => 14],
            [['ValutaName'], 'string', 'max' => 20],
            [['OperDocType', 'SaldoType', 'SaldoTypeDetailed'], 'string', 'max' => 6],
            [['CashType'], 'string', 'max' => 1],
            [['FO_ID'], 'unique'],
            [['FinOperTypeID', 'Year', 'DocNum'], 'unique', 'targetAttribute' => ['FinOperTypeID', 'Year', 'DocNum']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'FO_ID' => 'Fo ID',
            'ConfirmationSortingColumn' => 'Confirmation Sorting Column',
            'EMail' => 'E Mail',
            'FinOperTypeID' => 'Fin Oper Type ID',
            'GuidType' => 'Guid Type',
            'Year' => 'Year',
            'DocNum' => 'Doc Num',
            'TypeName' => 'Type Name',
            'Date' => 'Date',
            'ValutaRatio' => 'Valuta Ratio',
            'ValutaName' => 'Valuta Name',
            'OperSign' => 'Oper Sign',
            'Summa' => 'Summa',
            'OperDocType' => 'Oper Doc Type',
            'OperDocYear' => 'Oper Doc Year',
            'OperDocNum' => 'Oper Doc Num',
            'sOperDocsList' => 'S Oper Docs List',
            'SaldoSign' => 'Saldo Sign',
            'SaldoType' => 'Saldo Type',
            'SaldoTypeDetailed' => 'Saldo Type Detailed',
            'CashType' => 'Cash Type',
            'Comment' => 'Comment',
            'Saldo' => 'Saldo',
            'SaleSaldo' => 'Sale Saldo',
            'ConsignationSaldo' => 'Consignation Saldo',
            'RealizationSaldo' => 'Realization Saldo',
        ];
    }

    public static function getAllByClient()
    {
        $res['total'] = 0;
        $res['vm'] = 'USD';
        if (Yii::$app->user->isGuest) {
            return $res;
        }
        $EMail = Yii::$app->user->identity->username;

        $query = self::find()
            ->select(['Saldo','ValutaName'])
            ->where(['EMail' => $EMail])
            ->orderBy(['FO_ID'=>SORT_DESC])
            ->limit(1)
            ->all();

        if (count($query) > 0) {
            $res = [];
            foreach ($query as $item) {
                $res['total'] = $item['Saldo']*1;
                $res['vm'] = $item['ValutaName'];
            }
        }
        return $res;
    }
}
