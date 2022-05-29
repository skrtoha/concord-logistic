<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "onhanda_main".
 *
 * @property int $Year
 * @property int $DocNum
 * @property int $OperationID
 * @property string $Description
 * @property string $SupplierName
 * @property string $CreationDate
 * @property string $ChangingDate
 */
class OnhandaMain extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'onhanda_main';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Year', 'DocNum', 'OperationID', 'Description', 'SupplierName', 'CreationDate', 'ChangingDate'], 'required'],
            [['Year', 'DocNum', 'OperationID'], 'integer'],
            [['Description'], 'string'],
            [['CreationDate', 'ChangingDate'], 'safe'],
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
            'ChangingDate' => 'Changing Date',
        ];
    }

    public static function getAllByClient($page=0,$onPage=25)
    {
        $res['total'] = 0;
        if (Yii::$app->user->isGuest) {
            return $res;
        }
        $EMail = "jeep-land@mail.ru";//Yii::$app->user->identity->username;
        $EMail = "Linas@autoterpe.w3.lt";//Yii::$app->user->identity->username;

        $queryOnhandaContent = OnhandaContent::find()
            ->select('onhanda_content.OperationID')
            ->leftJoin('clientordersbyemail', '`clientordersbyemail`.`ClientOrderID` = `onhanda_content`.`ClientOrderID`')
            ->where(['clientordersbyemail.EMail' => $EMail])
            ->with('onhandaoperationid')
            ->all();
        $OperationID=[];
        foreach ($queryOnhandaContent as $item){
            if(!in_array($item['OperationID'],$OperationID)) {
                $OperationID[] = $item['OperationID'];
                //$ClientOrderID1[]=$item['ClientOrderID'];
            }
        }
        //return $OperationID;







        //$clientordersbyemail = Clientordersbyemail::findOne(['EMail'=>'Linas@autoterpe.w3.lt']);
        /*$clientordersbyemail = Clientordersbyemail::find()
            ->select(['DocNum','ClientOrderID','Year','CreationDate','Summa','ValutaName'])
            ->where(['Email' => $EMail])
            //->limit(1)
            ->orderBy(['CreationDate'=>SORT_DESC])
            ->all();
        //return $clientordersbyemail;
        foreach ($clientordersbyemail as $item) {
            $ClientOrderID[]=$item->getOnhandacontent();
        }

            //->select(['ClientOrderID', 'GoodID', 'Quantity', 'Quantity', 'InnerCode', 'OperationID', 'GoodNameRus', 'ManufacturerName'])
            //->where(['ClientOrderID' => $ClientOrderID])
            //->orderBy(['OperationID'=>SORT_DESC])
            //->all();
        return $ClientOrderID;*/






/*
        $queryClientorders=Clientordersbyemail::getOrdersByEmail($EMail);
        if($queryClientorders){
            $ClientOrderID=[];
            foreach ($queryClientorders as $item) {
                $ClientOrderID[]=$item['ClientOrderID'];
            }

            $queryOnhandaContent = OnhandaContent::find()
                //->select(['OperationID','ClientOrderID', 'GoodID', 'Quantity', 'Quantity', 'InnerCode', 'GoodNameRus', 'ManufacturerName'])
                ->select(['OperationID'])
                ->where(['ClientOrderID' => $ClientOrderID])
                ->orderBy(['OperationID'=>SORT_DESC])
                ->all();
            if(count($queryOnhandaContent)>0){
                $onhandaContent=[];
                $OperationID=[];
                $j=0;
                foreach ($queryOnhandaContent as $item) {
                    if(!in_array($item['OperationID'],$OperationID)) {
                        $OperationID[] = $item['OperationID'];
                        //$ClientOrderID1[]=$item['ClientOrderID'];
                    }
                    if(count($OperationID)>$onPage){
                        $OperationID[$onPage]=null;
                        break;
                    }
                    $onhandaContent[$item['OperationID']]['OperationID']=$item['OperationID'];
                    $onhandaContent[$item['OperationID']]['ClientOrderID']=$item['ClientOrderID'];
                    $onhandaContent[$item['OperationID']]['GoodID']=$item['GoodID'];
                    $onhandaContent[$item['OperationID']]['Quantity']=$item['Quantity'];
                    $onhandaContent[$item['OperationID']]['ActiveOriginalCode']=$item['ActiveOriginalCode'];
                    $onhandaContent[$item['OperationID']]['GoodNameRus']=$item['GoodNameRus'];
                    $onhandaContent[$item['OperationID']]['ManufacturerName']=$item['ManufacturerName'];
                }

            }


        }*/

        if(count($OperationID)>0){
            //return $onhandaContent;
            $queryOnhandaMain = OnhandaMain::find()
                ->select(['DocNum','Year','OperationID'])
                ->where(['OperationID' => $OperationID])
                //->groupBy('sDocNum')
                ->limit($onPage)
                //->offset($page*$onPage)
                //->orderBy('Position')
                ->orderBy(['OperationID'=>SORT_DESC,'DocNum'=>SORT_DESC])
                ->all();
            if(count($queryOnhandaMain)>0){
                $count=0;
                $total=0;
                $start=$page*$onPage;
                $sDocNum=[];
                foreach ($queryOnhandaMain as $item) {
                    //if(strlen($item['DocNum'])>0) {
                    //if($total>=$start && $count<$onPage) {
                    $res['DocNum'][] = $item['DocNum'];
                    $count++;
                    //}
                    $total++;
                    //}
                }
                $res['total']=$total;
            }
        }
        /*$queryAll = OnhandaMain::find()
            ->select(['DocNum','Year','OperationID'])
            //->where(['Email' => $EMail])
            //->groupBy('sDocNum')
            ->limit($onPage)
            //->offset($page*$onPage)
            //->orderBy('Position')
            ->orderBy(['OperationID'=>SORT_DESC,'DocNum'=>SORT_DESC])
            ->all();
        if(count($queryAll)>0){
            $count=0;
            $total=0;
            $start=$page*$onPage;
            $sDocNum=[];
            foreach ($queryAll as $item) {
                if(strlen($item['DocNum'])>0) {
                    //if($total>=$start && $count<$onPage) {
                        $res['DocNum'][] = $item['DocNum'];
                        $count++;
                    //}
                    $total++;
                }
            }
            $res['total']=$total;
        }
        //print_r($sDocNum);
        $query = OnhandaContent::find()
            ->select(['Email', 'Extended_Price_USD', 'DocNum', 'RangeID', 'sDocNum', 'CreationDate', 'Manufacturer', 'Catalog', 'Description', 'Qty', 'Unit_Price_USD','Forwarder'])
            ->where(['sDocNum' => $sDocNum,'Email' => $EMail])
            ->orderBy(['RangeID'=>SORT_DESC,'DocNum'=>SORT_DESC])
            ->all();


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
        }*/
        return $res;
    }

    public function getByemail()
    {
        return $this->hasMany(OnhandaContent::className(), ['customer_id' => 'id']);
    }
}
