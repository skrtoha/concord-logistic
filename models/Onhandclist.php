<?php

namespace app\models;

use Yii;
use yii\web\Response;

/**
 * This is the model class for table "onhandclist".
 *
 * @property int $Position
 * @property string $InnerCode
 * @property string $Manufacturer
 * @property string $Catalog
 * @property string $Description
 * @property int $Qty
 * @property float|null $Unit_Price_USD
 * @property float|null $Extended_Price_USD
 * @property string|null $Client
 * @property string|null $Email
 * @property int|null $ClientID
 * @property int $RangeID
 * @property int $DocNum
 * @property string $sDocNum
 * @property string|null $OnHandC_LoadingDate
 * @property string|null $ClientName
 * @property string $Forwarder
 * @property string $CreationDate
 * @property string $LastTransactionDate
 * @property string $UpdateDate
 */
class Onhandclist extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'onhandclist';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Position', 'InnerCode', 'Manufacturer', 'Catalog', 'Description', 'Qty', 'RangeID', 'DocNum', 'sDocNum', 'Forwarder', 'CreationDate', 'LastTransactionDate', 'UpdateDate'], 'required'],
            [['Position', 'Qty', 'ClientID', 'RangeID', 'DocNum'], 'integer'],
            [['Unit_Price_USD', 'Extended_Price_USD'], 'number'],
            [['CreationDate', 'LastTransactionDate', 'UpdateDate'], 'safe'],
            [['InnerCode', 'Catalog', 'Email'], 'string', 'max' => 50],
            [['Manufacturer', 'Description', 'Forwarder'], 'string', 'max' => 255],
            [['Client', 'ClientName'], 'string', 'max' => 150],
            [['sDocNum'], 'string', 'max' => 32],
            [['OnHandC_LoadingDate'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Position' => 'Position',
            'InnerCode' => 'Inner Code',
            'Manufacturer' => 'Manufacturer',
            'Catalog' => 'Catalog',
            'Description' => 'Description',
            'Qty' => 'Qty',
            'Unit_Price_USD' => 'Unit Price Usd',
            'Extended_Price_USD' => 'Extended Price Usd',
            'Client' => 'Client',
            'Email' => 'Email',
            'ClientID' => 'Client ID',
            'RangeID' => 'Range ID',
            'DocNum' => 'Doc Num',
            'sDocNum' => 'S Doc Num',
            'OnHandC_LoadingDate' => 'On Hand C Loading Date',
            'ClientName' => 'Client Name',
            'Forwarder' => 'Forwarder',
            'CreationDate' => 'Creation Date',
            'LastTransactionDate' => 'Last Transaction Date',
            'UpdateDate' => 'Update Date',
        ];
    }

    public static function getAllByClient($page=0,$onPage=25)
    {
        $res['total'] = 0;
        if (Yii::$app->user->isGuest) {
            return $res;
        }
        $EMail = Yii::$app->user->identity->username;
        //$total = Onhandclist::find()->where(['Email' => $EMail])->groupBy('sDocNum')->count();
        $queryAll = Onhandclist::find()
            ->select(['sDocNum'])
            ->where(['Email' => $EMail])
            ->groupBy('sDocNum')
            //->limit($onPage)
            //->offset($page*$onPage)
            //->orderBy('Position')
            ->orderBy(['RangeID'=>SORT_DESC,'DocNum'=>SORT_DESC])
            ->all();
        if(count($queryAll)>0){
            $count=0;
            $total=0;
            $start=$page*$onPage;
            $sDocNum=[];
            foreach ($queryAll as $item) {
                if(strlen($item['sDocNum'])>0) {
                    if($total>=$start && $count<$onPage) {
                        $sDocNum[] = $item['sDocNum'];
                        $count++;
                    }
                    $total++;
                }
            }
        }
        //print_r($sDocNum);
        $query = self::find()
            ->select(['Email', 'Extended_Price_USD', 'DocNum', 'RangeID', 'sDocNum', 'CreationDate', 'Manufacturer', 'Catalog', 'Description', 'Qty', 'Unit_Price_USD','Forwarder'])
            ->where(['sDocNum' => $sDocNum,'Email' => $EMail])
            ->orderBy(['RangeID'=>SORT_DESC,'DocNum'=>SORT_DESC])
            ->all();
        /*$queryOrderContUpd = OrdercontentUpdate::find()
            ->select(['OrderID'])
            ->andWhere(['like','Einc_sDocNums_List',$sDocNum])
            ->all();*/

        //User::find()->andWhere(['like', 'username', '89'])->all();
        if (count($queryAll) > 0) {
            $res = [];
            $invOrderID=[];
            //$res['res'][]=[];
            foreach ($query as $item) {
                $orderNum='';
                $linkOrderNum='';
                $queryClientordercontent = Clientordercontent::find()
                    ->select(['ClientOrderID'])
                    ->where(['ManufacturerName' => $item['Manufacturer'],'OriginalCode' => $item['Catalog'],'Einc_sDocNums_List'=>$item['sDocNum']])
                    //->andWhere(['like', 'Einc_sDocNums_List',  $item['sDocNum'] ])
                    //->andWhere([new \yii\db\Expression('Einc_sDocNums_List LIKE :param', [':param' => '%' . $item['sDocNum'] . '%']),])
                    ->all();
                if (count($queryClientordercontent) > 0) {
                    foreach ($queryClientordercontent as $oid) {
                        $linkOrderNum=$oid['ClientOrderID'];
                        $orderNum=Clientordersbyemail::getOrderNumByOrderID($oid['ClientOrderID']);
                    }
                }
                $queryOrderContUpd = OrdercontentUpdate::find()
                    ->select(['OrderID'])
                    ->where(['ManufacturerName' => $item['Manufacturer'],'OriginalCode' => $item['Catalog'],'Einc_sDocNums_List'=>$item['sDocNum']])
                    //->andWhere(['like', 'Einc_sDocNums_List',  $item['sDocNum'] ])
                    //->andWhere([new \yii\db\Expression('Einc_sDocNums_List LIKE :param', [':param' => '%' . $item['sDocNum'] . '%']),])
                    ->all();

                if (count($queryOrderContUpd) > 0) {
                    foreach ($queryOrderContUpd as $oid) {
                        $orderNum=Orders::getOrderNumByOrderID($oid['OrderID']);
                        $linkOrderNum=$orderNum;
                        //echo $orderNum."<br>";
                    }
                }

                $list[$item['DocNum'] . $item['RangeID']][] = array(
                    's' => $item['Extended_Price_USD'],
                    'doc' => $item['sDocNum'],
                    'man' => $item['Manufacturer'],
                    'mpn' => $item['Catalog'],
                    'd' => $item['Description'],
                    'q' => $item['Qty'],
                    'p' => $item['Unit_Price_USD'],
                    'o' => $orderNum,
                    'linkOrd' => $linkOrderNum,
                );
                $sum[$item['DocNum'] . $item['RangeID']] += $item['Extended_Price_USD'] * 1;
                $date[$item['DocNum'] . $item['RangeID']] = $item['CreationDate'];
                //$total += $item['Extended_Price_USD'] * 1;
                $res['total'] = $total;
            }
            $man = [];
            foreach ($query as $item) {
                if (!in_array($item['DocNum'] .  $item['RangeID'], $man)) {
                    $man[] = $item['DocNum'] .  $item['RangeID'];
                    $res['res'][$item['DocNum'] .  $item['RangeID']] = array(
                        'id'=>$item['DocNum'] ."(".  $item['RangeID'].")",
                        'sum'=>$sum[$item['DocNum'] .  $item['RangeID']],
                        'date'=>$date[$item['DocNum'] .  $item['RangeID']],
                        'f'=>$item['Forwarder'],
                        'list' => $list[$item['DocNum'] .  $item['RangeID']],
                    );
                }
            }
        }
        return $res;
    }

    public static function getInvoiceByNumber($invNum)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $res['error'][] = ['c' => '404', 'text' => 'Not Found','invNum'=>$invNum];
        if (Yii::$app->user->isGuest) {
            return $res;
        }
        $spec = Yii::$app->user->identity->spec;//Тип пользователя - если 10 то просмотр заказов определенного Email, запрет покупки
        $EMail = Yii::$app->user->identity->username;
        if ($spec == 10) {
            $EMail = Yii::$app->user->identity->email_order_source;
        }
        /*$queryAll = Onhandclist::find()
            ->select(['sDocNum'])
            ->where(['Email' => $EMail])
            ->groupBy('sDocNum')
            ->orderBy(['RangeID'=>SORT_DESC,'DocNum'=>SORT_DESC])
            ->all();
        if(count($queryAll)>0){
            $count=0;
            $total=0;
            $start=$page*$onPage;
            foreach ($queryAll as $item) {
                if(strlen($item['sDocNum'])>0) {
                    if($total>=$start && $count<$onPage) {
                        $sDocNum[] = $item['sDocNum'];
                        $count++;
                    }
                    $total++;
                }
            }
        }*/

        $query = self::find()
            ->select(['Email', 'Extended_Price_USD', 'DocNum', 'RangeID', 'sDocNum', 'CreationDate', 'Manufacturer', 'Catalog', 'Description', 'Qty', 'Unit_Price_USD','Forwarder'])
            ->where(['sDocNum' => $invNum,'Email' => $EMail])
            ->orderBy(['RangeID'=>SORT_DESC,'DocNum'=>SORT_DESC])
            ->all();

        if (count($query) > 0) {
            unset($res);
            $res = [];
            foreach ($query as $item) {
                $list[$item['DocNum'] . $item['RangeID']][] = array(
                    's' => $item['Extended_Price_USD'],
                    'doc' => $item['sDocNum'],
                    'man' => $item['Manufacturer'],
                    'mpn' => $item['Catalog'],
                    'd' => $item['Description'],
                    'q' => $item['Qty'],
                    'p' => $item['Unit_Price_USD'],
                );
                $sum[$item['DocNum'] . $item['RangeID']] += $item['Extended_Price_USD'] * 1;
                $date[$item['DocNum'] . $item['RangeID']] = $item['CreationDate'];

            }
            $man = [];
            foreach ($query as $item) {
                if (!in_array($item['DocNum'] .  $item['RangeID'], $man)) {
                    $man[] = $item['DocNum'] .  $item['RangeID'];
                    $res['res']['goods'] = array(
                        'id'=>$item['DocNum'] ."(".  $item['RangeID'].")",
                        'sum'=>$sum[$item['DocNum'] .  $item['RangeID']],
                        'date'=>$date[$item['DocNum'] .  $item['RangeID']],
                        'f'=>$item['Forwarder'],
                        'list' => $list[$item['DocNum'] .  $item['RangeID']],
                    );
                }
            }
        }
        return $res;
    }
}
