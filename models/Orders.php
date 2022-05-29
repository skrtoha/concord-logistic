<?php

namespace app\models;

use Yii;
use yii\data\Pagination;

/**
 * This is the model class for table "orders".
 *
 * @property int $OrderID
 * @property float $SummaWithoutDiscount
 * @property float $Summa
 * @property float $ValutaRatio
 * @property int $State
 * @property int $Year
 * @property string $DocNum
 * @property string $CreationDate
 * @property string $ConfirmationDate
 * @property int $ClientID
 * @property string $client_name
 * @property string $client_email
 * @property string|null $client_country
 * @property string|null $client_city
 * @property string|null $client_address
 * @property string|null $client_phone
 * @property string|null $client_description
 * @property string|null $client_firmname
 * @property string $client_email_order_target
 * @property string $client_email_order_subject
 * @property string $client_email_order_source
 * @property string|null $Comment
 * @property int $DeliveryID
 * @property string $Delivery
 * @property string $DeliveryType
 * @property string $Payment
 * @property string|null $ManagerComment
 * @property string|null $client_metro
 * @property int $usa
 * @property string $promocode
 * @property string $ValutaName
 * @property string $dostavka_price
 * @property string|null $ip
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['SummaWithoutDiscount', 'Summa', 'ValutaRatio'], 'number'],
            [['State', 'Year', 'ClientID', 'DeliveryID', 'usa'], 'integer'],
            [['client_address', 'client_description', 'Comment', 'ManagerComment'], 'string'],
            //[['Delivery'], 'required'],
            [['DocNum', 'client_country', 'client_city', 'Payment'], 'string', 'max' => 50],
            [['CreationDate', 'ConfirmationDate'], 'string', 'max' => 14],
            [['client_name', 'client_email', 'client_phone', 'client_firmname', 'client_email_order_target', 'client_email_order_subject', 'client_email_order_source'], 'string', 'max' => 150],
            [['Delivery', 'client_metro', 'ip'], 'string', 'max' => 100],
            [['DeliveryType'], 'string', 'max' => 10],
            [['promocode'], 'string', 'max' => 12],
            [['ValutaName', 'dostavka_price'], 'string', 'max' => 5],
            [['DocNum'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'OrderID' => 'Order ID',
            'SummaWithoutDiscount' => 'Summa Without Discount',
            'Summa' => 'Summa',
            'ValutaRatio' => 'Valuta Ratio',
            'State' => 'State',
            'Year' => 'Year',
            'DocNum' => 'Doc Num',
            'CreationDate' => 'Creation Date',
            'ConfirmationDate' => 'Confirmation Date',
            'ClientID' => 'Client ID',
            'client_name' => 'Client Name',
            'client_email' => 'Client Email',
            'client_country' => 'Client Country',
            'client_city' => 'Client City',
            'client_address' => 'Client Address',
            'client_phone' => 'Client Phone',
            'client_description' => 'Client Description',
            'client_firmname' => 'Client Firmname',
            'client_email_order_target' => 'Client Email Order Target',
            'client_email_order_subject' => 'Client Email Order Subject',
            'client_email_order_source' => 'Client Email Order Source',
            'Comment' => 'Comment',
            'DeliveryID' => 'Delivery ID',
            'Delivery' => 'Delivery',
            'DeliveryType' => 'Delivery Type',
            'Payment' => 'Payment',
            'ManagerComment' => 'Manager Comment',
            'client_metro' => 'Client Metro',
            'usa' => 'Usa',
            'promocode' => 'Promocode',
            'ValutaName' => 'Valuta Name',
            'dostavka_price' => 'Dostavka Price',
            'ip' => 'Ip',
        ];
    }

    public static function getLastDocNum()
    {
        $ClientID = Yii::$app->user->id;
        $query = self::find()
            ->select(['DocNum'])
            ->where(['ClientID' => $ClientID])
            ->limit(1)
            ->orderBy(['OrderID' => SORT_DESC])
            ->all();

        $res = 1;
        if (count($query) > 0) {
            foreach ($query as $item) {
                $ordNum = $item['DocNum'];
            }
            $DocNum = date('y') . $ClientID;
            $ordRazd = explode("-", $ordNum);
            if (!empty($ordRazd)) {
                if (trim($ordRazd[0]) == $DocNum) {
                    $res = $ordRazd[1] * 1 + 1;
                }
            }
        }
        return $res;
    }

    public static function getLastOrderID()
    {
        $ClientID = Yii::$app->user->id;
        $query = self::find()
            ->select(['OrderID'])
            ->where(['ClientID' => $ClientID])
            ->limit(1)
            ->orderBy(['OrderID' => SORT_DESC])
            ->all();

        $res = false;
        if (count($query) > 0) {
            foreach ($query as $item) {
                $res = $item['OrderID'];
            }
        }
        return $res;
    }
    public static function getOrderNumByOrderID($orderId)
    {
        $query = self::find()
            ->select(['DocNum'])
            ->where(['OrderID' => $orderId])
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

    public static function getAllByClient($page = 0, $onPage = 25)
    {
        if ($page * 1 > 0) {
            //$page=$page*1-1;
        }
        $offset = $page * $onPage;
        $res = false;
        $allOrders = [];
        $OrdersDocNum=[];
        $Orders=[];
        $ordCount = 0;
        $allCount = 0;


        if (Yii::$app->user->isGuest) {
            return $res;
        }
        $spec = Yii::$app->user->identity->spec;//Тип пользователя - если 10 то просмотр заказов определенного Email, запрет покупки
        $EMail = Yii::$app->user->identity->username;
        if ($spec == 10) {
            $EMail = Yii::$app->user->identity->email_order_source;
        }
        /*$query = Orders::find()->where(['client_email' => $EMail]);
        //$pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 20]);
        $pages = new Pagination(['totalCount' => $query->count(), 'pageSize' => 20, 'forcePageParam' => false, 'pageSizeParam' => false]);
        //$pages = new Pagination(['totalCount' => $query->count()]);
        $orders = $query->offset($pages->offset)
            ->select(['OrderID', 'DocNum', 'CreationDate', 'Summa'])
            ->where(['client_email' => $EMail])
            ->limit($pages->limit)
            ->orderBy(['OrderID'=>SORT_DESC])
            ->all();
        //return $this->render('index', compact('posts', 'pages'));*/
        $total = Orders::find()->where(['client_email' => $EMail])->count();
        $total += Clientordersbyemail::find()->where(['EMail' => $EMail, 'IsInternetOrderExisting' => 0])->count();
        //$model = Country::find()->where('id = :id', [':id' => $id])->andWhere('area = :area', [':area' => $area])->one();
        $clientorders = Clientordersbyemail::find()
            ->select(['ClientOrderID', 'DocNum', 'CreationDate', 'Summa', 'ValutaName'])
            //->where('Status != :st', ['st'=>'Deleted from Client Order'])
            //->andWhere(['EMail' => $EMail, 'IsInternetOrderExisting' => 0])
            //->limit($onPage)
            //->offset($offset)
            ->where(['EMail' => $EMail, 'IsInternetOrderExisting' => 0])
            ->orderBy(['CreationDate' => SORT_ASC])
            ->all();
        $orders = self::find()
            ->select(['OrderID', 'DocNum', 'CreationDate', 'Summa', 'ValutaName', 'Comment', 'DeliveryType'])
            //->where('Status != :st', ['st'=>'Deleted from Client Order'])
            //->andWhere(['client_email' => $EMail])
            //->limit($onPage)
            //->offset($offset)
            ->where(['client_email' => $EMail])
            ->orderBy(['OrderID' => SORT_DESC])
            ->all();
        $summArr = array();
        if (count($orders) > 0) {
            foreach ($orders as $order) {
                $date = $order['CreationDate'];
                $Orders[$order['OrderID']]['DocNum'] = $order['DocNum'];
                $allOrders[$date]['OrderID'] = $order['OrderID'];
                $allOrders[$date]['Type'] = 'Order';
                $allOrders[$date]['CreationDate'] = $order['CreationDate'];
                $allOrders[$date]['DocNum'] = $order['DocNum'];
                $allOrders[$date]['Summa'] = $order['Summa'];
                $allOrders[$date]['ValutaName'] = $order['ValutaName'];
                $allOrders[$date]['Comment'] = $order['Comment'];
                $allOrders[$date]['Delivery'] = $order['DeliveryType'];
                $summArr[] = $order['Summa'];
                $OrdersDocNum[] = $order['DocNum'];
                //$ordCount++;
            }
        }
        if (count($clientorders) > 0) {
            foreach ($clientorders as $clientorder) {
                if (!in_array($clientorder['Summa'], $summArr)) {
                    if ($clientorder['Summa'] > 0) {
                        $date = $clientorder['CreationDate'];
                        $allOrders[$date]['OrderID'] = $clientorder['ClientOrderID'];
                        $allOrders[$date]['Type'] = 'Client Order';
                        $allOrders[$date]['CreationDate'] = $clientorder['CreationDate'];
                        $allOrders[$date]['DocNum'] = $clientorder['DocNum'];
                        $allOrders[$date]['Summa'] = $clientorder['Summa'];
                        $allOrders[$date]['ValutaName'] = $clientorder['ValutaName'];
                        $allOrders[$date]['Comment'] = '';
                        $allOrders[$date]['Delivery'] = '';
                    } else {
                        $total--;
                    }
                } else {
                    $total--;
                }
                //$ordCount++;
            }
        }
        if (count($allOrders) > 0) {

            //ksort($allOrders,SORT_NUMERIC );
            krsort($allOrders, SORT_NUMERIC);
            //print_r($allOrders);exit();
        }
        if (count($allOrders) > 0) {
            $oIds = [];
            $cliOIds = [];
            foreach ($allOrders as $item) {
                if (!in_array($item['OrderID'], $oIds) && $allCount >= $offset && $ordCount < $onPage) {
                    $year = substr($item['CreationDate'], 0, 4);
                    $yearForCodes = substr($item['CreationDate'], 2, 2);
                    $month = substr($item['CreationDate'], 4, 2);
                    $numb = substr($item['CreationDate'], 6, 2);
                    $hour = substr($item['CreationDate'], 8, 2);
                    $minute = substr($item['CreationDate'], 10, 2);
                    $sec = substr($item['CreationDate'], 12, 2);
                    if ($item['Type'] == 'Order') {
                        $oIds[$item['CreationDate']] = $item['OrderID'];
                    } else {
                        $cliOIds[$item['CreationDate']] = $item['OrderID'];
                    }
                    $res['res'][$item['OrderID']] = array(
                        'id' => $item['OrderID'],
                        'sum' => $item['Summa'],
                        'type' => $item['Type'],
                        'doc' => $item['DocNum'],
                        'comment' => $item['Comment'],
                        'delivery' => $item['Delivery'],
                        'v' => $item['ValutaName'],
                        'date' => $numb . '.' . $month . '.' . $year,
                    );
                    $ordCount++;
                }
                $allCount++;
            }
            $queryCli = Clientordercontent::find()
                ->select(['ClientOrderID', 'GoodNameEng', 'OriginalCode', 'sGoodStatus', 'Amount', 'ManufacturerName', 'StateCode', 'Price', 'Einc_sDocNums_List', 'sGoodStatus_Date'])
                ->where(['ClientOrderID' => $cliOIds])
                ->all();

            $cache = Yii::$app->cache;

            if (count($queryCli) > 0) {
                foreach ($queryCli as $item) {
                    $color = "orange";
                    //if(stristr($one->Status,'')){$color="color-02918f";}
                    if (stristr($item['sGoodStatus'], 'processing')) {
                        $color = "#02918f";
                    }
                    if (stristr($item['sGoodStatus'], 'Processing')) {
                        $color = "#02918f";
                    }
                    if (stristr($item['sGoodStatus'], 'Ready to ship')) {
                        $color = "#bf7e00";
                    }
                    if (stristr($item['sGoodStatus'], 'Shipped')) {
                        $color = "#bf7e00";
                    }
                    //if(stristr($one->Status,'В пути')){$color="color-bf7e00";}
                    //if(stristr($one->Status,'отов к выдаче')){$color="color-00c417";}
                    //if(stristr($one->Status,'тгружен')){$color="color-168300";}
                    if (stristr($item['sGoodStatus'], 'Failure')) {
                        $color = "#c60000";
                    }
                    //if(stristr($one->Status,'Failure')){$color="color-c60000";}
                    //$dddd=$item['Amount'];
                    $pBrand = trim(strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $item['ManufacturerName'])));
                    $code = trim(strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $item['OriginalCode'])));
                    $key6 = 'arrayDimension1' . $code . "_" . $pBrand;
                    $arrayDimension = $cache->get($key6);
                    if ($arrayDimension === false) {
                        $arrayDimension = \app\models\Productdatasheet::getDimensionByUniqueData($code, $pBrand);
                        $cache->set($key6, $arrayDimension, 60 * 60 * 24 * 7);//неделя
                    }
                    $weight = '';
                    if ($arrayDimension != 0) {
                        if ($arrayDimension['Weight'] * 1 > 0)
                            $weight = round($arrayDimension['Weight'] * 0.45, 3) . " kg";

                    }
                    $res['res'][$item['ClientOrderID']]['list'][] = array(
                        'n' => $item['GoodNameEng'],
                        'man' => $item['ManufacturerName'],
                        'mpn' => $item['OriginalCode'],
                        'q' => $item['Amount'],
                        'cl' => $color,
                        's' => $item['sGoodStatus'],
                        'p' => $item['Price'],
                        'we' => $weight,
                        'stcode' => $item['StateCode'],
                        'inv' => $item['Einc_sDocNums_List'],
                        'std' => $item['sGoodStatus_Date'],
                    );
                }
            }
            /**
             * Ищем ClientOrderID для Manager Info для интернет заказов
             */
            $clientordersManInfo = Clientordersbyemail::find()
                ->select(['ClientOrderID','InternetOrderDocNum'])
                ->where(['EMail' => $EMail, 'IsInternetOrderExisting' => 1])
                ->all();

            $clOrdMI=[];
            $StateCodes=[];
            $ClientOrdersMI=[];
            if (count($clientordersManInfo) > 0) {
                foreach ($clientordersManInfo as $clientorderMI) {
                    $ClientOrdersMI[$clientorderMI['ClientOrderID']]['ClientOrderID'] = $clientorderMI['ClientOrderID'];
                    //$ClientOrdersMI[$clientorderMI['ClientOrderID']]['OrderDocNum'] = $clientorderMI['InternetOrderDocNum'];
                    $orderDocsArray=explode(",",$clientorderMI['InternetOrderDocNum']);
                    if(is_array($orderDocsArray) && count($orderDocsArray)>0) {
                        foreach ($orderDocsArray as $item) {
                            $currentDocNum=trim($item);
                            $ClientOrdersMI[$clientorderMI['ClientOrderID']]['OrderDocNum'][] = $currentDocNum;
                        }
                    }
                    $clOrdMI[]=$clientorderMI['ClientOrderID'];
                }
            }
            $queryCliMI = Clientordercontent::find()
                ->select(['ClientOrderID', 'OriginalCode', 'ManufacturerName', 'StateCode'])
                ->where(['ClientOrderID' => $clOrdMI])
                ->all();
            if (count($queryCliMI) > 0) {
                foreach ($queryCliMI as $item) {
                    $pBrand = trim(strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $item['ManufacturerName'])));
                    $code = trim(strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $item['OriginalCode'])));
                    /*if(@isset($ClientOrdersMI[$item['ClientOrderID']]['OrderDocNum'])) {
                        $StateCodes[$ClientOrdersMI[$item['ClientOrderID']]['OrderDocNum']][$code][$pBrand] = $item['StateCode'];
                    }*/
                    if(@isset($ClientOrdersMI[$item['ClientOrderID']]['OrderDocNum'])) {
                        if(count($ClientOrdersMI[$item['ClientOrderID']]['OrderDocNum'])>0) {
                            foreach ($ClientOrdersMI[$item['ClientOrderID']]['OrderDocNum'] as $doc) {
                                $StateCodes[$doc][$code][$pBrand] = $item['StateCode'];
                            }
                        }
                    }
                }
            }
            /*echo "<pre>";
            print_r($StateCodes);
            echo "</pre>";*/

            $query2 = OrdercontentUpdate::find()
                ->select(['OrderID', 'GoodNameRus', 'ManufacturerName', 'OriginalCode', 'sOperDocsList', 'Status', 'Status_Date', 'Quantity', 'Price', 'Einc_sDocNums_List'])
                ->where(['OrderID' => $oIds])
                ->all();
            if (count($query2) > 0) {
                $i = [];
                foreach ($query2 as $item) {
                    $color = "orange";

                    //if(stristr($one->Status,'')){$color="color-02918f";}
                    if (stristr($item['Status'], 'processing')) {
                        $color = "#02918f";
                    }
                    if (stristr($item['Status'], 'Processing')) {
                        $color = "#02918f";
                    }
                    if (stristr($item['Status'], 'Ready to ship')) {
                        $color = "#bf7e00";
                    }
                    if (stristr($item['Status'], 'Shipped')) {
                        $color = "#bf7e00";
                    }
                    //if(stristr($one->Status,'В пути')){$color="color-bf7e00";}
                    //if(stristr($one->Status,'отов к выдаче')){$color="color-00c417";}
                    //if(stristr($one->Status,'тгружен')){$color="color-168300";}
                    if (stristr($item['Status'], 'Failure')) {
                        $color = "#c60000";
                    }
                    //if(stristr($one->Status,'Failure')){$color="color-c60000";}

                    $pBrand = trim(strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $item['ManufacturerName'])));
                    $code = trim(strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $item['OriginalCode'])));
                    $stateCode='';
                    if(@isset($StateCodes[$Orders[$item['OrderID']]['DocNum']][$code][$pBrand])) {
                        $stateCode=$StateCodes[$Orders[$item['OrderID']]['DocNum']][$code][$pBrand];
                    }

                    $key6 = 'arrayDimension1' . $code . "_" . $pBrand;
                    $arrayDimension = $cache->get($key6);
                    if ($arrayDimension === false) {
                        $arrayDimension = \app\models\Productdatasheet::getDimensionByUniqueData($code, $pBrand);
                        $cache->set($key6, $arrayDimension, 60 * 60 * 24 * 7);//неделя
                    }
                    $weight = '';
                    if ($arrayDimension != 0) {
                        if ($arrayDimension['Weight'] * 1 > 0)
                            $weight = round($arrayDimension['Weight'] * 0.45, 3) . " kg";

                    }
                    //$arrayDimension = \app\models\Productdatasheet::getDimensionByUniqueData($code, $pBrand);
                    $res['res'][$item['OrderID']]['list'][] = array(
                        'n' => $item['GoodNameRus'],
                        'man' => $item['ManufacturerName'],
                        'mpn' => $item['OriginalCode'],
                        'q' => $item['Quantity'],
                        'cl' => $color,
                        's' => $item['Status'],
                        'p' => $item['Price'],
                        'we' => $weight,
                        'stcode' => $stateCode,
                        'inv' => $item['Einc_sDocNums_List'],
                        'std' => $item['Status_Date'],
                    );
                    if ($i[$item['OrderID']] * 1 == 0) {
                        $res['res'][$item['OrderID']]['sum'] = 0;
                    }
                    $i[$item['OrderID']]++;
                    $res['res'][$item['OrderID']]['sum'] += round($item['Quantity'] * $item['Price'], 2);
                    if (($key = array_search($item['OrderID'], $oIds)) !== false) {
                        unset($oIds[$key]);
                    }
                }
            }
            if (count($oIds) > 0) {
                $query2 = Ordercontent::find()
                    ->select(['OrderID', 'GoodNameEng', 'ManufacturerName', 'OriginalCode', 'quantity', 'price'])
                    ->where(['OrderID' => $oIds])
                    ->all();
                if (count($query2) > 0) {
                    foreach ($query2 as $item) {
                        $color = "orange";

                        $pBrand = trim(strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $item['ManufacturerName'])));
                        $code = trim(strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $item['OriginalCode'])));
                        $key6 = 'arrayDimension1' . $code . "_" . $pBrand;
                        $arrayDimension = $cache->get($key6);
                        if ($arrayDimension === false) {
                            $arrayDimension = \app\models\Productdatasheet::getDimensionByUniqueData($code, $pBrand);
                            $cache->set($key6, $arrayDimension, 60 * 60 * 24 * 7);//неделя
                        }
                        $weight = '';
                        if ($arrayDimension != 0) {
                            if ($arrayDimension['Weight'] * 1 > 0)
                                $weight = round($arrayDimension['Weight'] * 0.45, 3) . " kg";

                        }
                        //$arrayDimension = \app\models\Productdatasheet::getDimensionByUniqueData($code, $pBrand);
                        $res['res'][$item['OrderID']]['list'][] = array(
                            'n' => $item['GoodNameEng'],
                            'man' => $item['ManufacturerName'],
                            'mpn' => $item['OriginalCode'],
                            'q' => $item['quantity'],
                            'cl' => $color,
                            's' => 'Processing',
                            'p' => $item['price'],
                            'we' => $weight,
                            'inv' => '',
                            'std' => '',
                        );
                    }
                }
            }
            $res['total'] = $total;
        }
        return $res;
    }
    public static function getOrderByOrderNum($orderNum)
    {
        /*$queryCliInv = Clientordercontent::find()
            ->select(['ClientOrderID'])
            ->where(['ClientOrderID' => $orderNum])
            ->all();
        $queryOrdupdInv = OrdercontentUpdate::find()
            ->select(['OrderID'])
            ->where(['DocNum' => $orderNum])
            ->all();
        $orderNums=[];
        $cliOrderNums=[];
        if(count($queryCliInv)>0){
            foreach ($queryCliInv as $item){
                $cliOrderNums[]=$item['ClientOrderID'];
            }
        }
        if(count($queryOrdupdInv)>0){
            foreach ($queryOrdupdInv as $item){
                $orderNums[]=$item['OrderID'];
            }
        }
        $cliOrderNums=array_unique($cliOrderNums);
        $orderNums=array_unique($orderNums);*/

        //$offset = $page * $onPage;
        $res = false;
        $allOrders = [];
        $OrdersDocNum=[];
        $Orders=[];
        $ordCount = 0;
        $allCount = 0;


        if (Yii::$app->user->isGuest) {
            return $res;
        }
        $spec = Yii::$app->user->identity->spec;//Тип пользователя - если 10 то просмотр заказов определенного Email, запрет покупки
        $EMail = Yii::$app->user->identity->username;
        if ($spec == 10) {
            $EMail = Yii::$app->user->identity->email_order_source;
        }
        $total = 1;
        $clientorders = Clientordersbyemail::find()
            ->select(['ClientOrderID', 'DocNum', 'CreationDate', 'Summa', 'ValutaName'])
            //->where('Status != :st', ['st'=>'Deleted from Client Order'])
            //->andWhere(['EMail' => $EMail, 'IsInternetOrderExisting' => 0])
            //->limit($onPage)
            //->offset($offset)
            ->where(['EMail' => $EMail, 'ClientOrderID'=>$orderNum])
            ->all();
        $orders = self::find()
            ->select(['OrderID', 'DocNum', 'CreationDate', 'Summa', 'ValutaName', 'Comment', 'DeliveryType'])
            //->where('Status != :st', ['st'=>'Deleted from Client Order'])
            //->andWhere(['client_email' => $EMail])
            //->limit($onPage)
            //->offset($offset)
            ->where(['client_email' => $EMail,'DocNum'=>$orderNum])
            ->orderBy(['OrderID' => SORT_DESC])
            ->all();
        $summArr = array();
        //print_r( $orders);
        if (count($orders) > 0) {
            foreach ($orders as $order) {
                $date = $order['CreationDate'];
                $Orders[$order['OrderID']]['DocNum'] = $order['DocNum'];
                $allOrders[$date]['OrderID'] = $order['OrderID'];
                $allOrders[$date]['Type'] = 'Order';
                $allOrders[$date]['CreationDate'] = $order['CreationDate'];
                $allOrders[$date]['DocNum'] = $order['DocNum'];
                $allOrders[$date]['Summa'] = $order['Summa'];
                $allOrders[$date]['ValutaName'] = $order['ValutaName'];
                $allOrders[$date]['Comment'] = $order['Comment'];
                $allOrders[$date]['Delivery'] = $order['DeliveryType'];
                $summArr[] = $order['Summa'];
                $OrdersDocNum[] = $order['DocNum'];
                //$ordCount++;
            }
        }
        if (count($clientorders) > 0) {
            foreach ($clientorders as $clientorder) {
                if (!in_array($clientorder['Summa'], $summArr)) {
                    if ($clientorder['Summa'] > 0) {
                        $date = $clientorder['CreationDate'];
                        $allOrders[$date]['OrderID'] = $clientorder['ClientOrderID'];
                        $allOrders[$date]['Type'] = 'Client Order';
                        $allOrders[$date]['CreationDate'] = $clientorder['CreationDate'];
                        $allOrders[$date]['DocNum'] = $clientorder['DocNum'];
                        $allOrders[$date]['Summa'] = $clientorder['Summa'];
                        $allOrders[$date]['ValutaName'] = $clientorder['ValutaName'];
                        $allOrders[$date]['Comment'] = '';
                        $allOrders[$date]['Delivery'] = '';
                    } else {
                        $total--;
                    }
                } else {
                    $total--;
                }
                //$ordCount++;
            }
        }
        if (count($allOrders) > 0) {

            //ksort($allOrders,SORT_NUMERIC );
            krsort($allOrders, SORT_NUMERIC);
            //print_r($allOrders);exit();
        }
        //print_r($allOrders);exit();
        if (count($allOrders) > 0) {
            $oIds = [];
            $cliOIds = [];
            foreach ($allOrders as $item) {
                if (!in_array($item['OrderID'], $oIds) ) {
                    $year = substr($item['CreationDate'], 0, 4);
                    $yearForCodes = substr($item['CreationDate'], 2, 2);
                    $month = substr($item['CreationDate'], 4, 2);
                    $numb = substr($item['CreationDate'], 6, 2);
                    $hour = substr($item['CreationDate'], 8, 2);
                    $minute = substr($item['CreationDate'], 10, 2);
                    $sec = substr($item['CreationDate'], 12, 2);
                    if ($item['Type'] == 'Order') {
                        $oIds[$item['CreationDate']] = $item['OrderID'];
                    } else {
                        $cliOIds[$item['CreationDate']] = $item['OrderID'];
                    }
                    $res['res'][$item['OrderID']] = array(
                        'id' => $item['OrderID'],
                        'sum' => $item['Summa'],
                        'type' => $item['Type'],
                        'doc' => $item['DocNum'],
                        'comment' => $item['Comment'],
                        'delivery' => $item['Delivery'],
                        'v' => $item['ValutaName'],
                        'date' => $numb . '.' . $month . '.' . $year,
                    );
                    $ordCount++;
                }
                $allCount++;
            }
            $queryCli = Clientordercontent::find()
                ->select(['ClientOrderID', 'GoodNameEng', 'OriginalCode', 'sGoodStatus', 'Amount', 'ManufacturerName', 'StateCode', 'Price', 'Einc_sDocNums_List', 'sGoodStatus_Date'])
                ->where(['ClientOrderID' => $cliOIds])
                ->all();
            //print_r($cliOIds);
            $cache = Yii::$app->cache;

            if (count($queryCli) > 0) {
                foreach ($queryCli as $item) {
                    $color = "orange";
                    //if(stristr($one->Status,'')){$color="color-02918f";}
                    if (stristr($item['sGoodStatus'], 'processing')) {
                        $color = "#02918f";
                    }
                    if (stristr($item['sGoodStatus'], 'Processing')) {
                        $color = "#02918f";
                    }
                    if (stristr($item['sGoodStatus'], 'Ready to ship')) {
                        $color = "#bf7e00";
                    }
                    if (stristr($item['sGoodStatus'], 'Shipped')) {
                        $color = "#bf7e00";
                    }
                    //if(stristr($one->Status,'В пути')){$color="color-bf7e00";}
                    //if(stristr($one->Status,'отов к выдаче')){$color="color-00c417";}
                    //if(stristr($one->Status,'тгружен')){$color="color-168300";}
                    if (stristr($item['sGoodStatus'], 'Failure')) {
                        $color = "#c60000";
                    }
                    //if(stristr($one->Status,'Failure')){$color="color-c60000";}
                    //$dddd=$item['Amount'];
                    $pBrand = trim(strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $item['ManufacturerName'])));
                    $code = trim(strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $item['OriginalCode'])));
                    $key6 = 'arrayDimension1' . $code . "_" . $pBrand;
                    $arrayDimension = $cache->get($key6);
                    if ($arrayDimension === false) {
                        $arrayDimension = \app\models\Productdatasheet::getDimensionByUniqueData($code, $pBrand);
                        $cache->set($key6, $arrayDimension, 60 * 60 * 24 * 7);//неделя
                    }
                    $weight = '';
                    if ($arrayDimension != 0) {
                        if ($arrayDimension['Weight'] * 1 > 0)
                            $weight = round($arrayDimension['Weight'] * 0.45, 3) . " kg";

                    }
                    $res['res'][$item['ClientOrderID']]['list'][] = array(
                        'n' => $item['GoodNameEng'],
                        'man' => $item['ManufacturerName'],
                        'mpn' => $item['OriginalCode'],
                        'q' => $item['Amount'],
                        'cl' => $color,
                        's' => $item['sGoodStatus'],
                        'p' => $item['Price'],
                        'we' => $weight,
                        'stcode' => $item['StateCode'],
                        'inv' => $item['Einc_sDocNums_List'],
                        'std' => $item['sGoodStatus_Date'],
                    );
                }
            }
            /**
             * Ищем ClientOrderID для Manager Info для интернет заказов
             */
            $clientordersManInfo = Clientordersbyemail::find()
                ->select(['ClientOrderID','InternetOrderDocNum'])
                ->where(['EMail' => $EMail, 'IsInternetOrderExisting' => 1])
                ->all();

            $clOrdMI=[];
            $StateCodes=[];
            $ClientOrdersMI=[];
            if (count($clientordersManInfo) > 0) {
                foreach ($clientordersManInfo as $clientorderMI) {
                    $ClientOrdersMI[$clientorderMI['ClientOrderID']]['ClientOrderID'] = $clientorderMI['ClientOrderID'];
                    //$ClientOrdersMI[$clientorderMI['ClientOrderID']]['OrderDocNum'] = $clientorderMI['InternetOrderDocNum'];
                    $orderDocsArray=explode(",",$clientorderMI['InternetOrderDocNum']);
                    if(is_array($orderDocsArray) && count($orderDocsArray)>0) {
                        foreach ($orderDocsArray as $item) {
                            $currentDocNum=trim($item);
                            $ClientOrdersMI[$clientorderMI['ClientOrderID']]['OrderDocNum'][] = $currentDocNum;
                        }
                    }
                    $clOrdMI[]=$clientorderMI['ClientOrderID'];
                }
            }
            $queryCliMI = Clientordercontent::find()
                ->select(['ClientOrderID', 'OriginalCode', 'ManufacturerName', 'StateCode'])
                ->where(['ClientOrderID' => $clOrdMI])
                ->all();
            if (count($queryCliMI) > 0) {
                foreach ($queryCliMI as $item) {
                    $pBrand = trim(strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $item['ManufacturerName'])));
                    $code = trim(strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $item['OriginalCode'])));
                    /*if(@isset($ClientOrdersMI[$item['ClientOrderID']]['OrderDocNum'])) {
                        $StateCodes[$ClientOrdersMI[$item['ClientOrderID']]['OrderDocNum']][$code][$pBrand] = $item['StateCode'];
                    }*/
                    if(@isset($ClientOrdersMI[$item['ClientOrderID']]['OrderDocNum'])) {
                        if(count($ClientOrdersMI[$item['ClientOrderID']]['OrderDocNum'])>0) {
                            foreach ($ClientOrdersMI[$item['ClientOrderID']]['OrderDocNum'] as $doc) {
                                $StateCodes[$doc][$code][$pBrand] = $item['StateCode'];
                            }
                        }
                    }
                }
            }
            /*echo "<pre>";
            print_r($StateCodes);
            echo "</pre>";*/

            $query2 = OrdercontentUpdate::find()
                ->select(['OrderID', 'GoodNameRus', 'ManufacturerName', 'OriginalCode', 'sOperDocsList', 'Status', 'Status_Date', 'Quantity', 'Price', 'Einc_sDocNums_List'])
                ->where(['OrderID' => $oIds])
                ->all();
            if (count($query2) > 0) {
                $i = [];
                foreach ($query2 as $item) {
                    $color = "orange";

                    //if(stristr($one->Status,'')){$color="color-02918f";}
                    if (stristr($item['Status'], 'processing')) {
                        $color = "#02918f";
                    }
                    if (stristr($item['Status'], 'Processing')) {
                        $color = "#02918f";
                    }
                    if (stristr($item['Status'], 'Ready to ship')) {
                        $color = "#bf7e00";
                    }
                    if (stristr($item['Status'], 'Shipped')) {
                        $color = "#bf7e00";
                    }
                    //if(stristr($one->Status,'В пути')){$color="color-bf7e00";}
                    //if(stristr($one->Status,'отов к выдаче')){$color="color-00c417";}
                    //if(stristr($one->Status,'тгружен')){$color="color-168300";}
                    if (stristr($item['Status'], 'Failure')) {
                        $color = "#c60000";
                    }
                    //if(stristr($one->Status,'Failure')){$color="color-c60000";}

                    $pBrand = trim(strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $item['ManufacturerName'])));
                    $code = trim(strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $item['OriginalCode'])));
                    $stateCode='';
                    if(@isset($StateCodes[$Orders[$item['OrderID']]['DocNum']][$code][$pBrand])) {
                        $stateCode=$StateCodes[$Orders[$item['OrderID']]['DocNum']][$code][$pBrand];
                    }

                    $key6 = 'arrayDimension1' . $code . "_" . $pBrand;
                    $arrayDimension = $cache->get($key6);
                    if ($arrayDimension === false) {
                        $arrayDimension = \app\models\Productdatasheet::getDimensionByUniqueData($code, $pBrand);
                        $cache->set($key6, $arrayDimension, 60 * 60 * 24 * 7);//неделя
                    }
                    $weight = '';
                    if ($arrayDimension != 0) {
                        if ($arrayDimension['Weight'] * 1 > 0)
                            $weight = round($arrayDimension['Weight'] * 0.45, 3) . " kg";

                    }
                    //$arrayDimension = \app\models\Productdatasheet::getDimensionByUniqueData($code, $pBrand);
                    $res['res'][$item['OrderID']]['list'][] = array(
                        'n' => $item['GoodNameRus'],
                        'man' => $item['ManufacturerName'],
                        'mpn' => $item['OriginalCode'],
                        'q' => $item['Quantity'],
                        'cl' => $color,
                        's' => $item['Status'],
                        'p' => $item['Price'],
                        'we' => $weight,
                        'stcode' => $stateCode,
                        'inv' => $item['Einc_sDocNums_List'],
                        'std' => $item['Status_Date'],
                    );
                    if ($i[$item['OrderID']] * 1 == 0) {
                        $res['res'][$item['OrderID']]['sum'] = 0;
                    }
                    $i[$item['OrderID']]++;
                    $res['res'][$item['OrderID']]['sum'] += round($item['Quantity'] * $item['Price'], 2);
                    if (($key = array_search($item['OrderID'], $oIds)) !== false) {
                        unset($oIds[$key]);
                    }
                }
            }
            if (count($oIds) > 0) {
                $query2 = Ordercontent::find()
                    ->select(['OrderID', 'GoodNameEng', 'ManufacturerName', 'OriginalCode', 'quantity', 'price'])
                    ->where(['OrderID' => $oIds])
                    ->all();
                if (count($query2) > 0) {
                    foreach ($query2 as $item) {
                        $color = "orange";

                        $pBrand = trim(strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $item['ManufacturerName'])));
                        $code = trim(strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $item['OriginalCode'])));
                        $key6 = 'arrayDimension1' . $code . "_" . $pBrand;
                        $arrayDimension = $cache->get($key6);
                        if ($arrayDimension === false) {
                            $arrayDimension = \app\models\Productdatasheet::getDimensionByUniqueData($code, $pBrand);
                            $cache->set($key6, $arrayDimension, 60 * 60 * 24 * 7);//неделя
                        }
                        $weight = '';
                        if ($arrayDimension != 0) {
                            if ($arrayDimension['Weight'] * 1 > 0)
                                $weight = round($arrayDimension['Weight'] * 0.45, 3) . " kg";

                        }
                        //$arrayDimension = \app\models\Productdatasheet::getDimensionByUniqueData($code, $pBrand);
                        $res['res'][$item['OrderID']]['list'][] = array(
                            'n' => $item['GoodNameEng'],
                            'man' => $item['ManufacturerName'],
                            'mpn' => $item['OriginalCode'],
                            'q' => $item['quantity'],
                            'cl' => $color,
                            's' => 'Processing',
                            'p' => $item['price'],
                            'we' => $weight,
                            'inv' => '',
                            'std' => '',
                        );
                    }
                }
            }
            $res['total'] = $total;
        }
        return $res;
    }

    public static function getAllFailureByClient($page = 0, $onPage = 25)
    {
        if ($page * 1 > 0) {
            //$page=$page*1-1;
        }
        $offset = $page * $onPage;
        $res = false;

        if (Yii::$app->user->isGuest) {
            return $res;
        }
        $spec = Yii::$app->user->identity->spec;//Тип пользователя - если 10 то просмотр заказов определенного Email, запрет покупки
        $EMail = Yii::$app->user->identity->username;
        if ($spec == 10) {
            $EMail = Yii::$app->user->identity->email_order_source;
        }
        $clientorders = Clientordersbyemail::find()
            ->select(['ClientOrderID', 'DocNum', 'CreationDate', 'Summa', 'ValutaName'])
            //->where('Status != :st', ['st'=>'Deleted from Client Order'])
            //->andWhere(['EMail' => $EMail, 'IsInternetOrderExisting' => 0])
            //->limit($onPage)
            //->offset($offset)
            ->where(['EMail' => $EMail, 'IsInternetOrderExisting' => 0])
            ->all();


        $orders = self::find()
            ->select(['OrderID', 'DocNum', 'CreationDate', 'Summa', 'ValutaName', 'Comment', 'DeliveryType'])
            //->where('Status != :st', ['st'=>'Deleted from Client Order'])
            //->andWhere(['client_email' => $EMail])
            //->limit($onPage)
            //->offset($offset)
            ->where(['client_email' => $EMail])
            ->all();

        $OrderID = [];
        $ClientOrderID = [];
        $res['res']=[];
        $OrdersDocNum=[];
        $clOrdMI=[];
        $StateCodes=[];
        if (count($orders) > 0) {
            foreach ($orders as $order) {
                $OrderID[] = $order['OrderID'];
                $Orders[$order['OrderID']]['DocNum'] = $order['DocNum'];
                $OrdersDocNum[] = $order['DocNum'];
                $year = substr($order['CreationDate'], 0, 4);
                $month = substr($order['CreationDate'], 4, 2);
                $numb = substr($order['CreationDate'], 6, 2);
                $Orders[$order['OrderID']]['CreationDate'] = $numb . '.' . $month . '.' . $year;
            }
        }

        if (count($clientorders) > 0) {
            foreach ($clientorders as $clientorder) {
                $ClientOrderID[] = $clientorder['ClientOrderID'];
                $ClientOrders[$clientorder['ClientOrderID']]['DocNum'] = $clientorder['DocNum'];
                $year = substr($clientorder['CreationDate'], 0, 4);
                $month = substr($clientorder['CreationDate'], 4, 2);
                $numb = substr($clientorder['CreationDate'], 6, 2);
                $ClientOrders[$clientorder['ClientOrderID']]['CreationDate'] = $numb . '.' . $month . '.' . $year;
            }
        }

        /**
         * Ищем ClientOrderID для Manager Info для интернет заказов
         */
        $clientordersManInfo = Clientordersbyemail::find()
            ->select(['ClientOrderID','InternetOrderDocNum'])
            ->where(['EMail' => $EMail, 'IsInternetOrderExisting' => 1])
            ->all();
        if (count($clientordersManInfo) > 0) {
            foreach ($clientordersManInfo as $clientorderMI) {
                $ClientOrdersMI[$clientorderMI['ClientOrderID']]['ClientOrderID'] = $clientorderMI['ClientOrderID'];
                $orderDocsArray=explode(",",$clientorderMI['InternetOrderDocNum']);
                if(is_array($orderDocsArray) && count($orderDocsArray)>0) {
                    foreach ($orderDocsArray as $item) {
                        $currentDocNum=trim($item);
                        $ClientOrdersMI[$clientorderMI['ClientOrderID']]['OrderDocNum'][] = $currentDocNum;
                    }
                }
                $clOrdMI[]=$clientorderMI['ClientOrderID'];
            }
        }
        $queryCliMI = Clientordercontent::find()
            ->select(['ClientOrderID', 'OriginalCode', 'ManufacturerName', 'StateCode'])
            ->where(['ClientOrderID' => $clOrdMI])
            ->all();
        if (count($queryCliMI) > 0) {
            foreach ($queryCliMI as $item) {
                $pBrand = trim(strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $item['ManufacturerName'])));
                $code = trim(strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $item['OriginalCode'])));
                if(@isset($ClientOrdersMI[$item['ClientOrderID']]['OrderDocNum'])) {
                    if(count($ClientOrdersMI[$item['ClientOrderID']]['OrderDocNum'])>0) {
                        foreach ($ClientOrdersMI[$item['ClientOrderID']]['OrderDocNum'] as $doc) {
                            $StateCodes[$doc][$code][$pBrand] = $item['StateCode'];
                        }
                    }
                }
            }
        }

        $queryCli = Clientordercontent::find()
            ->select(['ClientOrderID', 'GoodNameEng', 'OriginalCode', 'sGoodStatus', 'Amount', 'ManufacturerName', 'StateCode', 'Price', 'Einc_sDocNums_List', 'sGoodStatus_Date'])
            ->where(['ClientOrderID' => $ClientOrderID, 'sGoodStatus' => 'Failure'])
            ->orderBy(['ClientOrderID' => SORT_DESC])
            ->all();

        $i=0;
        if (count($queryCli) > 0) {
            foreach ($queryCli as $item) {
                $color = "#c60000";
                $res['res'][$item['ClientOrderID']][] = array(
                    'doc' => $ClientOrders[$item['ClientOrderID']]['DocNum'],
                    'date' => $ClientOrders[$item['ClientOrderID']]['CreationDate'],
                    'n' => $item['GoodNameEng'],
                    'man' => $item['ManufacturerName'],
                    'mpn' => $item['OriginalCode'],
                    'q' => $item['Amount'],
                    'cl' => $color,
                    's' => $item['sGoodStatus'],
                    'p' => $item['Price'],
                    'we' => '',
                    'stcode' => $item['StateCode'],
                    'inv' => '',
                    'std' => $item['sGoodStatus_Date'],
                );
                $i++;
            }
        }

        $query2 = OrdercontentUpdate::find()
            ->select(['OrderID', 'GoodNameRus', 'ManufacturerName', 'OriginalCode', 'sOperDocsList', 'Status', 'Status_Date', 'Quantity', 'Price', 'Einc_sDocNums_List'])
            ->where(['OrderID' => $OrderID, 'Status' => 'Failure'])
            ->orderBy(['OrderID' => SORT_DESC])
            ->all();
        if (count($query2) > 0) {
            foreach ($query2 as $item) {
                $pBrand = trim(strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $item['ManufacturerName'])));
                $code = trim(strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $item['OriginalCode'])));
                $stateCode='';
                if(@isset($StateCodes[$Orders[$item['OrderID']]['DocNum']][$code][$pBrand])) {
                    $stateCode=$StateCodes[$Orders[$item['OrderID']]['DocNum']][$code][$pBrand];
                }
                $color = "#c60000";
                $res['res'][$item['OrderID']][] = array(
                    'doc' => $Orders[$item['OrderID']]['DocNum'],
                    'date' => $Orders[$item['OrderID']]['CreationDate'],
                    'n' => $item['GoodNameRus'],
                    'man' => $item['ManufacturerName'],
                    'mpn' => $item['OriginalCode'],
                    'q' => $item['Quantity'],
                    'cl' => $color,
                    's' => $item['Status'],
                    'p' => $item['Price'],
                    'we' => '',
                    'stcode' => $stateCode,
                    'inv' => '',
                    'std' => $item['Status_Date'],
                );
                $i++;
            }
        }
        $res['total'] = $i;
        return $res;
    }
}
