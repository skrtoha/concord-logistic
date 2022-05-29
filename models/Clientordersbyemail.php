<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "clientordersbyemail".
 *
 * @property int $ClientOrderID
 * @property int $Year
 * @property int|null $DocNum
 * @property string|null $EMail
 * @property string|null $CreationDate
 * @property float $ValutaRatio
 * @property string $ValutaName
 * @property float|null $Summa
 * @property int|null $IsFinished
 * @property float $SummaInBaseValuta
 * @property float $PaidSumInBaseValuta
 * @property string $PaidState
 */
class Clientordersbyemail extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clientordersbyemail';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['ClientOrderID', 'Year', 'ValutaRatio', 'ValutaName', 'SummaInBaseValuta', 'PaidSumInBaseValuta', 'PaidState'], 'required'],
            [['ClientOrderID', 'Year', 'DocNum', 'IsFinished','IsInternetOrderExisting','IsInternetOrderEqual'], 'integer'],
            [['ValutaRatio', 'Summa', 'SummaInBaseValuta', 'PaidSumInBaseValuta'], 'number'],
            [['EMail'], 'string', 'max' => 150],
            [['CreationDate'], 'string', 'max' => 14],
            [['ValutaName','InternetOrderDocNum'], 'string', 'max' => 20],
            [['PaidState'], 'string', 'max' => 7],
            [['Year', 'DocNum'], 'unique', 'targetAttribute' => ['Year', 'DocNum']],
            [['ClientOrderID'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ClientOrderID' => 'Client Order ID',
            'Year' => 'Year',
            'DocNum' => 'Doc Num',
            'EMail' => 'E Mail',
            'CreationDate' => 'Creation Date',
            'ValutaRatio' => 'Valuta Ratio',
            'ValutaName' => 'Valuta Name',
            'Summa' => 'Summa',
            'IsFinished' => 'Is Finished',
            'SummaInBaseValuta' => 'Summa In Base Valuta',
            'PaidSumInBaseValuta' => 'Paid Sum In Base Valuta',
            'PaidState' => 'Paid State',
            'IsInternetOrderExisting' => 'IsInternetOrderExisting State',
            'IsInternetOrderEqual' => 'IsInternetOrderEqual State',
            'InternetOrderDocNum' => 'InternetOrderDocNum State',
        ];
    }
    public static function getOrderNumByOrderID($orderId)
    {
        $query = self::find()
            ->select(['DocNum'])
            ->where(['ClientOrderID' => $orderId])
            ->limit(1)
            ->all();
        $res = false;
        if (count($query) > 0) {
            foreach ($query as $item) {
                $res = $item['DocNum'];
            }
        }
        return $res;
    }
    public static function getOrdersByEmail($email)
    {
        $query = self::find()
            ->select(['DocNum','ClientOrderID','Year','CreationDate','Summa','ValutaName'])
            ->where(['Email' => $email])
            //->limit(1)
            ->orderBy(['CreationDate'=>SORT_DESC])
            ->all();
        $res = false;
        $i=0;
        if (count($query) > 0) {
            foreach ($query as $item) {
                $res[$i]['DocNum'] = $item['DocNum'];
                $res[$i]['ClientOrderID'] = $item['ClientOrderID'];
                $res[$i]['Year'] = $item['Year'];
                $res[$i]['CreationDate'] = $item['CreationDate'];
                $res[$i]['Summa'] = $item['Summa'];
                $res[$i]['ValutaName'] = $item['ValutaName'];
                $i++;
            }
        }
        return $res;
    }
    public function getOnhandacontent()
    {
        return $this->hasMany(OnhandaContent::className(), ['ClientOrderID' => 'ClientOrderID']);
    }
}
