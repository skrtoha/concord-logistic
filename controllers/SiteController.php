<?php

namespace app\controllers;

use app\models\ChangepasswordForm;
use app\models\Clientbasket;
use app\models\Clientordercontent;
use app\models\Clientordersbyemail;
use app\models\Clients;
use app\models\DealerpricesMarkup;
use app\models\ForgotpassForm;
use app\models\MydataForm;
use app\models\OnhandaContent;
use app\models\OnhandaMain;
use app\models\OnhandcContent;
use app\models\OnhandcMain;
use app\models\OnhandaTracknumbers;
use app\models\Ordercontent;
use app\models\Orders;
use app\models\Tracktry;
use app\models\Paid;
use app\models\PaymentForm;
use app\models\PlaceorderForm;
use app\models\SavedOrders;
use app\models\SignupForm;
use app\models\PHPMailer;
use app\models\OtherFunctions;
use app\models\TracknumbersSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use yii\web\Response;

use net\authorize\api\contract\v1 as AnetAPI;
use net\authorize\api\controller as AnetController;

class SiteController extends Controller
{

    public $layout = 'main-uikit';
    public $loginForm;

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['get', 'post'],
                ],
            ],
            /*[
                'class' => 'yii\filters\HttpCache',
                'only' => ['cart'],
                'cacheControlHeader'=>'',

            ],*/
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        //error_reporting(E_ALL);
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                //'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
                //'fixedVerifyCode' => null,
            ],
        ];
    }

    public function beforeAction($action)
    {
        //print_r($action->id);
        /*if (\Yii::$app->user->isGuest && Yii::$app->params['redirectUserAutorizationUrl'] != "/".$action->id) {
            return \Yii::$app->getResponse()->redirect(Yii::$app->params['redirectUserAutorizationUrl'])->send();
        }*/
        $this->loginForm = new LoginForm();
        if ($this->loginForm->load(Yii::$app->request->post()) && $this->loginForm->login()) {

        }
        //$this->loginForm->password='';
        return parent::beforeAction($action);
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionTerms_and_conditions_of_personal_data()
    {
        return $this->render('terms_and_conditions_of_personal_data');
    }

    public function actionCookie_policy()
    {
        return $this->render('cookie_policy');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionSignin()
    {

        //$this->layout = '@app/views/layouts/base-uikit-layout';
        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            //return $this->goBack();
            //return $this->goHome();
            return $this->redirect(Yii::$app->params['redirectUserUrl']);
        }

        $model->password = '';
        return $this->render('signin', [
            'model' => $model,
        ]);
    }

    public function actionTrackinfo(){
        //$this->layout = 'basic';
        return $this->render('track');

    }
    public static function actionGetgoodsbyoid($o)
    {
        $oid = $o;
        Yii::$app->response->format = Response::FORMAT_JSON;
        $res['error'][] = ['c' => '404', 'text' => 'Not Found'];
        if (Yii::$app->user->isGuest) {
            return $res;
        }
        $oidV = strtolower(preg_replace("/[^a-zA-Z0-9]/", "", $oid));
        $EMail = "Linas@autoterpe.w3.lt";//Yii::$app->user->identity->username;
        $EMail = Yii::$app->user->identity->username;
        $ClientID = Yii::$app->user->id;
        $cache = Yii::$app->cache;

        $key = 'goods_1' . $ClientID . "_" . $oidV;
        $model = $cache->get($key);
        if ($model === false) {
            $model = OnhandaContent::find()
                ->select(['ActiveOriginalCode', 'OperationID', 'Quantity', 'GoodNameRus', 'GoodNameEng', 'OnHandsB_List', 'OnHandsC_List','ClientOrderID','GoodID'])
                ->where(['ClientEmail' => $EMail, 'OperationID' => $oid])
                //->andWhere(['like', 'TrackNumber', '%'.$oid.'%', false])
                //->leftJoin('onhanda_content', '`onhanda_content`.`OperationID` = `onhanda_tracknumbers`.`OperationID`')
                //->groupBy(['TrackNumber','OperationID'])
                ->orderBy('OperationID')
                ->all();
            $cache->set($key, $model, 10);//секунд
        }

        if ($model && count($model) > 0) {
            $listStatuses=[];
            foreach ($model as $item) {
                $listStatuses[$item['OperationID']]=OtherFunctions::getStepDeliveryLogistic($item['ClientOrderID'],$item['GoodID']);
            }
            $res = [];
            foreach ($model as $item) {
                $ohC = str_replace(';', '', $item['OnHandsC_List']);
                $ohcC = explode("-", $ohC);
                $res['res'][] = array(
                    'c' => $item['ActiveOriginalCode'],
                    'oid' => $item['OperationID'],
                    'q' => $item['Quantity'],
                    'n' => strlen($item['GoodNameRus']) > 0 ? $item['GoodNameRus'] : $item['GoodNameEng'],
                    'ohB' => $item['OnHandsB_List'],
                    'ohC' => $ohcC[0],
                    'st' => $listStatuses[$item['OperationID']],
                );
            }
        }
        return $res;
    }

    public static function actionGetgoodsbyoidohc($o)
    {
        $oid = $o;
        Yii::$app->response->format = Response::FORMAT_JSON;
        $res['error'][] = ['c' => '404', 'text' => 'Not Found'];
        if (Yii::$app->user->isGuest) {
            return $res;
        }
        $oidV = strtolower(preg_replace("/[^a-zA-Z0-9]/", "", $oid));
        $EMail = "Linas@autoterpe.w3.lt";//Yii::$app->user->identity->username;
        $EMail = Yii::$app->user->identity->username;
        $ClientID = Yii::$app->user->id;
        $cache = Yii::$app->cache;

        $key = 'goodsOHC_1' . $ClientID . "_" . $oidV;
        $model = $cache->get($key);
        if ($model === false) {
            $model = OnhandcContent::find()
                ->select(['ActiveOriginalCode', 'InnerCode', 'OperationID', 'Quantity', 'GoodNameRus', 'GoodNameEng', 'Quantity_Scanned', 'OnHandsA_List', 'OnHandsB_List'])
                ->where(['ClientEmail' => $EMail, 'OperationID' => $oid])
                //->andWhere(['like', 'TrackNumber', '%'.$oid.'%', false])
                //->leftJoin('onhanda_content', '`onhanda_content`.`OperationID` = `onhanda_tracknumbers`.`OperationID`')
                //->groupBy(['TrackNumber','OperationID'])
                ->orderBy('OperationID')
                ->all();
            $cache->set($key, $model, 10);//секунд
        }
        if ($model && count($model) > 0) {
            $res = [];
            foreach ($model as $item) {
                $ohA = str_replace(';', '', $item['OnHandsA_List']);
                $ohcA = explode("-", $ohA);
                $res['res'][] = array(
                    'c' => $item['ActiveOriginalCode'],
                    'oid' => $item['OperationID'],
                    'q' => $item['Quantity'],
                    'ic' => $item['InnerCode'],
                    'n' => strlen($item['GoodNameRus']) > 0 ? $item['GoodNameRus'] : $item['GoodNameEng'],
                    'w' => '',
                    's' => $item['Quantity_Scanned'],
                    'ohB' => $item['OnHandsB_List'],
                    'ohA' => $ohcA[0],
                    //'trnums' => $listTracks[$item['OperationID']],
                );
            }
        }
        return $res;
    }

    public static function actionGetgoodsbycliorder($o)
    {
        $oid = $o;
        Yii::$app->response->format = Response::FORMAT_JSON;
        $res['error'][] = ['c' => '404', 'text' => 'Not Found'];
        if (Yii::$app->user->isGuest) {
            return $res;
        }
        $oidV = strtolower(preg_replace("/[^a-zA-Z0-9]/", "", $oid));
        $EMail = "Linas@autoterpe.w3.lt";//Yii::$app->user->identity->username;
        $EMail = Yii::$app->user->identity->username;
        $ClientID = Yii::$app->user->id;
        $cache = Yii::$app->cache;

        $key = 'goodsClienorder_1' . $ClientID . "_" . $oidV;
        $model = $cache->get($key);
        if ($model === false) {
            $model = Clientordercontent::find()
                ->select(['ClientOrderID', 'OriginalCode', 'InnerCode', 'Amount', 'GoodNameRus', 'GoodNameEng', 'Summa', 'sGoodStatus'])
                ->where(['ClientOrderID' => $oid])
                //->andWhere(['like', 'TrackNumber', '%'.$oid.'%', false])
                //->leftJoin('onhanda_content', '`onhanda_content`.`OperationID` = `onhanda_tracknumbers`.`OperationID`')
                //->groupBy(['TrackNumber','OperationID'])
                ->orderBy('ClientOrderID')
                ->all();
            $cache->set($key, $model, 10);//секунд
        }
        if ($model && count($model) > 0) {
            $res = [];
            foreach ($model as $item) {
                $res['res'][] = array(
                    'c' => $item['OriginalCode'],
                    'oid' => $item['ClientOrderID'],
                    'q' => $item['Amount'],
                    'ic' => $item['InnerCode'],
                    'n' => strlen($item['GoodNameRus']) > 0 ? $item['GoodNameRus'] : $item['GoodNameEng'],
                    'sum' => $item['Summa'],
                    'state' => $item['sGoodStatus'],
                    //'trnums' => $listTracks[$item['OperationID']],
                );
            }
        }
        return $res;
    }

    public static function actionGetallclientorders()
    {

        Yii::$app->response->format = Response::FORMAT_JSON;
        $res['error'][] = ['c' => '404', 'text' => 'Not Found'];
        if (Yii::$app->user->isGuest) {
            return $res;
        }
        $EMail = "Linas@autoterpe.w3.lt";//Yii::$app->user->identity->username;
        $EMail = Yii::$app->user->identity->username;
        $ClientID = Yii::$app->user->id;
        $cache = Yii::$app->cache;

        $key = 'clientorders_' . $ClientID . "_1";
        $clientorders = $cache->get($key);
        if ($clientorders === false) {
            $clientorders = Clientordersbyemail::find()
                ->select(['ClientOrderID', 'DocNum', 'Year', 'CreationDate', 'Summa', 'ValutaName', 'FullState', 'PartialState'])
                //->where('Status != :st', ['st'=>'Deleted from Client Order'])
                //->andWhere(['EMail' => $EMail, 'IsInternetOrderExisting' => 0])
                //->limit(Yii::$app->params['onPageOrders'])
                //->offset($offset)
                ->where(['EMail' => $EMail])
                ->orderBy(['CreationDate' => SORT_DESC])
                ->all();
            $cache->set($key, $clientorders, 10);//секунд
        }
        if ($clientorders && count($clientorders) > 0) {
            $res = [];
            foreach ($clientorders as $item) {
                $year = substr($item['CreationDate'], 0, 4);
                $month = substr($item['CreationDate'], 4, 2);
                $day = substr($item['CreationDate'], 6, 2);
                $hour = substr($item['CreationDate'], 8, 2);
                $minute = substr($item['CreationDate'], 10, 2);
                $sec = substr($item['CreationDate'], 12, 2);
                $date = $day . "." . $month . "." . $year . " " . $hour . ":" . $minute;
                $st=0;
                if ($item['FullState'] == 10) {
                    $st=$item['FullState'];
                    $state = "Полная отгрузка";//Полная отгрузка
                } else if ($item['PartialState'] == 10) {
                    $st=9;
                    $state = "Частичная отгрузка";
                } else if ($item['PartialState'] == 2) {
                    $state = "Подготовлен";//Подготовлен
                } else if ($item['PartialState'] == 3) {
                    $state = "Заказан у поставщика";//Заказан у поставщика
                } else if ($item['PartialState'] == 0) {
                    $state = "недоступен к заказу";//недоступен к заказу
                } else {
                    $state = "Не отгружено";//Не отгружено, создан счет
                }

                $res['res'][] = array(
                    'cid' => $item['ClientOrderID'],
                    'doc' => $item['DocNum'],
                    'y' => "(" . substr($item['Year'], 2, 2) . ")",
                    'date' => $date,
                    'sum' => $item['Summa'],
                    'v' => $item['ValutaName'],
                    'state' => $state,
                    'st'=>$st,
                );
            }
        }
        return $res;
    }

    public static function actionGetonhandcbytrack($t)
    {
        $track = $t;
        Yii::$app->response->format = Response::FORMAT_JSON;
        $res['error'][] = ['c' => '404', 'text' => 'Not Found'];
        if (Yii::$app->user->isGuest) {
            return $res;
        }
        $trackV = strtolower(preg_replace("/[^a-zA-Z0-9]/", "", $track));
        $EMail = "Linas@autoterpe.w3.lt";//Yii::$app->user->identity->username;
        $EMail = Yii::$app->user->identity->username;
        $ClientID = Yii::$app->user->id;
        $cache = Yii::$app->cache;

        $key = 'onhandc_1' . $ClientID . "_" . $trackV;
        $model = $cache->get($key);
        if ($model === false) {
            $model = OnhandcContent::find()
                ->select(['ActiveOriginalCode', 'OperationID', 'Quantity', 'GoodNameRus', 'GoodNameEng'])
                ->where(['ClientEmail' => $EMail])
                ->andWhere(['like', 'ActiveOriginalCode', '%' . $track . '%', false])
                //->leftJoin('onhanda_content', '`onhanda_content`.`OperationID` = `onhanda_tracknumbers`.`OperationID`')
                //->groupBy(['TrackNumber','OperationID'])
                ->orderBy('OperationID')
                ->all();
            $cache->set($key, $model, 10);//секунд
        }
        if ($model && count($model) > 0) {
            $listTracks = [];
            $OperationID = [];
            foreach ($model as $item) {
                if (!in_array($item['OperationID'], $OperationID)) {
                    $OperationID[] = $item['OperationID'];
                }
            }

            $queryOnhandc = OnhandcMain::find()
                ->select('*')
                ->where(['OperationID' => $OperationID])
                //->leftJoin('onhandc_content', '`onhandc_content`.`OperationID` = `onhandc_main`.`OperationID`')
                //->where(['onhandc_main.OperationID' => $OperationID,'onhandc_content.ClientEmail' => $EMail])
                //->with('onhandaoperationid')
                ->all();
            //return $queryOnhanda;
            if ($queryOnhandc && count($queryOnhandc) > 0) {
                $res = [];
                foreach ($queryOnhandc as $item) {
                    $dateP=strlen($item['DeliveryDate'])>0?$item['DeliveryDate']:'';
                    $dateZ=strlen($item['LoadingDate'])>0?$item['LoadingDate']:'';
                    $res['res'][] = array(
                        'y' => "(" . substr($item['Year'], 2, 2) . ")",
                        'doc' => $item['DocNum'],
                        'opid' => $item['OperationID'],
                        't' => $item['ITC_Name_Eng'],
                        'd' => $item['Description'],
                        'dateZ' => $dateZ,
                        'dateP' => $dateP,
                        //'trnums' => $listTracks[$item['OperationID']],
                    );
                }
            }
        }
        return $res;
    }

    public static function actionGetallonhandc()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $res['error'][] = ['c' => '404', 'text' => 'Not Found'];
        if (Yii::$app->user->isGuest) {
            return $res;
        }
        $EMail = "Linas@autoterpe.w3.lt";//Yii::$app->user->identity->username;
        $EMail = Yii::$app->user->identity->username;
        $ClientID = Yii::$app->user->id;
        $cache = Yii::$app->cache;

        $key = 'Getallonhandc_1' . $ClientID;


        $queryOnhandc = $cache->get($key);
        if ($queryOnhandc === false) {
            $queryOnhandc = OnhandcMain::find()
                ->select('onhandc_main.*')
                ->leftJoin('onhandc_content', '`onhandc_content`.`OperationID` = `onhandc_main`.`OperationID`')
                ->where(['onhandc_content.ClientEmail' => $EMail])
                ->orderBy(['onhandc_main.OperationID' => SORT_DESC])
                //->with('onhandaoperationid')
                ->all();
            $cache->set($key, $queryOnhandc, 10);//секунд
        }
        if ($queryOnhandc && count($queryOnhandc) > 0) {
            $res = [];
            foreach ($queryOnhandc as $item) {
                $dateP=strlen($item['DeliveryDate'])>0?$item['DeliveryDate']:'';
                $dateZ=strlen($item['LoadingDate'])>0?$item['LoadingDate']:'';
                $res['res'][] = array(
                    'y' => "(" . substr($item['Year'], 2, 2) . ")",
                    'doc' => $item['DocNum'],
                    'opid' => $item['OperationID'],
                    't' => $item['ITC_Name_Eng'],
                    'd' => $item['Description'],
                    'dateZ' => $dateZ,
                    'dateP' => $dateP,
                    //'trnums' => $listTracks[$item['OperationID']],
                );
            }
        }

        return $res;
    }

    public static function actionGetonhandcoid($o)
    {
        $track = $o;
        Yii::$app->response->format = Response::FORMAT_JSON;
        $res['error'][] = ['c' => '404', 'text' => 'Not Found'];
        if (Yii::$app->user->isGuest) {
            return $res;
        }

        $trackV = strtolower(preg_replace("/[^a-zA-Z0-9\(\)]/", "", $track));

        if (strlen($trackV) == 0) {
            return $res;
        }
        $regexp = explode("(", $trackV);
        $docNum = $regexp[0];
        $year = "20" . str_replace(")", "", $regexp[1]);

        $yearV = preg_replace("/[^0-9]/", "", $year);
        if ((strlen($yearV) > 4) || !is_numeric($docNum)) {
            return $res;
        }
        $EMail = "Linas@autoterpe.w3.lt";//Yii::$app->user->identity->username;
        $EMail = Yii::$app->user->identity->username;
        $ClientID = Yii::$app->user->id;
        $cache = Yii::$app->cache;

        $key = 'onhandc_oid_1' . $ClientID . "_" . $trackV;
        $queryOnhandc = $cache->get($key);
        if ($queryOnhandc === false) {
            $queryOnhandc = OnhandcMain::find()
                ->select('*')
                ->where(['DocNum' => $docNum, 'Year' => $yearV])
                ->all();
            $cache->set($key, $queryOnhandc, 10);//секунд
        }

        if ($queryOnhandc && count($queryOnhandc) > 0) {
            $res = [];
            foreach ($queryOnhandc as $item) {
                $dateP=strlen($item['DeliveryDate'])>0?$item['DeliveryDate']:'';
                $dateZ=strlen($item['LoadingDate'])>0?$item['LoadingDate']:'';
                $res['res'][] = array(
                    'y' => "(" . substr($item['Year'], 2, 2) . ")",
                    'doc' => $item['DocNum'],
                    'opid' => $item['OperationID'],
                    't' => $item['ITC_Name_Eng'],
                    'd' => $item['Description'],
                    'dateZ' => $dateZ,
                    'dateP' => $dateP,
                    //'trnums' => $listTracks[$item['OperationID']],
                );
            }
        }

        return $res;
    }

    public static function actionGetallbytracknum($t)
    {
        $tracknum = $t;
        Yii::$app->response->format = Response::FORMAT_JSON;
        $res['error'][] = ['c' => '404', 'text' => 'Not Found'];
        if (Yii::$app->user->isGuest) {
            return $res;
        }
        $tracknumV = strtolower(preg_replace("/[^a-zA-Z0-9]/", "", $tracknum));
        $EMail = "Linas@autoterpe.w3.lt";//
        $EMail = Yii::$app->user->identity->username;
        $ClientID = Yii::$app->user->id;
        $cache = Yii::$app->cache;

        $key = 'track_type2_1' . $ClientID . "_" . $tracknumV;
        $model = $cache->get($key);
        if ($model === false) {
            $model = OnhandaTracknumbers::find()
                ->select(['TrackNumber', 'OperationID', 'SortingNum'])
                //->where(['ClientEmail' => $EMail])
                ->andWhere(['like', 'TrackNumber', '%' . $tracknum . '%', false])
                //->leftJoin('onhanda_content', '`onhanda_content`.`OperationID` = `onhanda_tracknumbers`.`OperationID`')
                ->groupBy(['TrackNumber', 'OperationID'])
                ->orderBy('OperationID')
                ->all();
            $cache->set($key, $model, 10);//секунд
        }

        /*$queryOnhanda = OnhandaTracknumbers::find()
            ->select('onhanda_tracknumbers.*')
            ->leftJoin('onhanda_content', '`onhanda_content`.`OperationID` = `onhanda_tracknumbers`.`OperationID`')
            ->where(['onhanda_content.ClientEmail' => $EMail])
            //->with('onhandaoperationid')
            ->all();
            foreach ($queryOnhanda as $item) {
                $ress .=";".$item['TrackNumber'];
            }
        return $ress;*/
        //";I847259694;40574016;5025161153;1z0122870393125161;1z0122870390978399;1z0122870394929498;i022831128;1z2044860355585894;5025185816;i319460202;923417692;9622042210000024047700489743051822;1z001fx80343048664;1Z7551370354642255;9622001900005350589000390383633168;9622001900005350589000390383633411;1z384t0t0373934907;1Z256R4F0331435911;420070809405508205497156635367;420070809400111899223360164160;1ze22a520307575494;1z377t9t0393274226;9612019145594783897800;9612019145594783901033;390392052908;9622001900008524261900390530688902;9612804301873613354091;9622001900007810085700777815200559;9622001900008496038900390644707543;9622001900009795283000390682003046;9622001900002615589000390644219977;9622001900009795283000390681299692;9622001900006228085800390654619306;9622001900009795283000390681700040;9622001900009795283000390681928405;9622001900004852776000390668235385;9622001900009736599100390657224325;9622001900001967569800390656587711;9622001900004063662000390652327314;1zx2w8320399306600;9612804305850411279715;9622001900008496038900390816091366;420070809400110200847200717825;9622001900008068136100390820963570;9622042210000024047700489743089079;9622001900000027882700390822770190;9622001900004063662000390826067443;420070809261290988246358553812;420070809400111899561071855282;420070809400110205974085834110;1z1759630367872984;391062269065;1z384t0t0373977255;1z384t0t0373977246;9622001900000329085000171526685954;9622001560009946289500770185429876;1z59fv32yw07568782;92612909840250571000698588;i710301699;1001910581230000708000392663061057;9622001900000329085000179731885782;9622001900006764333000731715674969;9622001900007858120000393351015339;9622001900007858120000393351015762;9622001900007858120000393351016942;393914932198;9622001560001345750400770800236118;9622001900002848018100395696572493;1ZA172X90302951511;9622001900006764333000731715693438;1z59fv320313891589;1z59fv320313889092;1z2e861f0396031758"


        /*$key = 'track_type1_1' . $ClientID . "_" . $tracknumV;
        $cache = Yii::$app->cache;
        $model = $cache->get($key);
        if ($model === false) {
            $model = TracknumbersSearch::find()
                ->select(['Tracknumber','OperationID'])
                ->where(['ClientEmail' => $EMail])
                ->andWhere(['like', 'Tracknumber', '%'.$tracknum.'%', false])
                ->groupBy(['Tracknumber','OperationID'])
                ->orderBy('OperationID')
                ->all();
            $cache->set($key, $model, 10);//секунд
        }*/

        //return $model;
        if ($model && count($model) > 0) {
            $listTracks = [];
            $OperationID = [];
            foreach ($model as $item) {
                $listTracks[$item['OperationID']][] = array(
                    'tn' => $item['TrackNumber'],
                );
                if (!in_array($item['OperationID'], $OperationID)) {
                    $OperationID[] = $item['OperationID'];
                }
            }
            //return $listTracks;
            /*$queryOnhandaContent = OnhandaContent::find()
                ->select('onhanda_content.OperationID')
                ->leftJoin('clientordersbyemail', '`clientordersbyemail`.`ClientOrderID` = `onhanda_content`.`ClientOrderID`')
                ->where(['clientordersbyemail.EMail' => $EMail])
                ->with('onhandaoperationid')
                ->all();*/


            $queryOnhanda = OnhandaMain::find()
                ->select('onhanda_main.*')
                ->leftJoin('onhanda_content', '`onhanda_content`.`OperationID` = `onhanda_main`.`OperationID`')
                ->where(['onhanda_main.OperationID' => $OperationID, 'onhanda_content.ClientEmail' => $EMail])
                //->with('onhandaoperationid')
                ->all();
            //return $queryOnhanda;
            if ($queryOnhanda && count($queryOnhanda) > 0) {
                $res = [];
                foreach ($queryOnhanda as $item) {
                    $res['res'][] = array(
                        'y' => "(" . substr($item['Year'], 2, 2) . ")",
                        'doc' => $item['DocNum'],
                        'opid' => $item['OperationID'],
                        'desc' => $item['Description'],
                        'date' => $item['CreationDate'],
                        'trnums' => $listTracks[$item['OperationID']],
                    );
                }
            }
        }
        return $res;
    }

    public static function actionGetonhandaoid($o)
    {

        $track = $o;
        Yii::$app->response->format = Response::FORMAT_JSON;
        $res['error'][] = ['c' => '404', 'text' => 'Not Found'];
        if (Yii::$app->user->isGuest) {
            return $res;
        }

        $trackV = strtolower(preg_replace("/[^a-zA-Z0-9\(\)]/", "", $track));


        if (strlen($trackV) == 0) {
            return $res;
        }
        $regexp = explode("(", $trackV);
        $docNum = $regexp[0];
        $year = "20" . str_replace(")", "", $regexp[1]);

        $yearV = preg_replace("/[^0-9]/", "", $year);
        if ((strlen($yearV) > 4) || !is_numeric($docNum)) {
            return $res;
        }

        $EMail = Yii::$app->user->identity->username;
        $ClientID = Yii::$app->user->id;
        $cache = Yii::$app->cache;

        $key = 'onhanda_oid_1' . $ClientID . "_" . $trackV;
        $queryOnhanda = $cache->get($key);
        if ($queryOnhanda === false) {
            $queryOnhanda = OnhandaMain::find()
                ->select('*')
                ->where(['DocNum' => $docNum, 'Year' => $yearV])
                ->all();
            $cache->set($key, $queryOnhanda, 10);//секунд
        }

        //return $queryOnhanda;
        if ($queryOnhanda && count($queryOnhanda) > 0) {
            $res = [];
            foreach ($queryOnhanda as $item) {
                $res['res'][] = array(
                    'y' => "(" . substr($item['Year'], 2, 2) . ")",
                    'doc' => $item['DocNum'],
                    'opid' => $item['OperationID'],
                    'desc' => $item['Description'],
                    'date' => $item['CreationDate'],
                    'trnums' => '',
                );
            }
        }

        return $res;
    }
    public static function actionGetallonhanda()
    {

        Yii::$app->response->format = Response::FORMAT_JSON;
        $res['error'][] = ['c' => '404', 'text' => 'Not Found'];
        if (Yii::$app->user->isGuest) {
            return $res;
        }
        $EMail = "Linas@autoterpe.w3.lt";//
        $EMail = Yii::$app->user->identity->username;
        $ClientID = Yii::$app->user->id;
        $cache = Yii::$app->cache;

        $key = 'Getallonhanda_1' . $ClientID;
        $queryOnhanda = $cache->get($key);
        if ($queryOnhanda === false) {
            $queryOnhanda = OnhandaMain::find()
                ->select('onhanda_main.*')
                ->leftJoin('onhanda_content', '`onhanda_content`.`OperationID` = `onhanda_main`.`OperationID`')
                ->where(['onhanda_content.ClientEmail' => $EMail])
                ->orderBy(['onhanda_main.OperationID' => SORT_DESC])
                //->with('onhandaoperationid')
                ->all();
            $cache->set($key, $queryOnhanda, 10);//секунд
        }

        //return $queryOnhanda;
        if ($queryOnhanda && count($queryOnhanda) > 0) {
            $res = [];
            foreach ($queryOnhanda as $item) {
                $res['res'][] = array(
                    'y' => "(" . substr($item['Year'], 2, 2) . ")",
                    'doc' => $item['DocNum'],
                    'opid' => $item['OperationID'],
                    'desc' => $item['Description'],
                    'date' => $item['CreationDate'],
                    'trnums' => '',
                );
            }
        }

        return $res;
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        return $this->render('contact');
        /*if (!Yii::$app->user->isGuest) {
            return $this->render('contact');
        } else {
            return $this->redirect(Yii::$app->params['redirectUserAutorizationUrl']);
        }
        //$this->layout = '@app/views/layouts/main-uikit';
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);*/
    }

    /**
     * Displays about page.
     *
     * @return string
     */

    /*public function actionHello()
    {
        return $this->render('hello');
        //return "Hello Word!";
    }*/

    public function actionForgotpass()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(Yii::$app->params['redirectUserUrl']);
        }

        //$this->layout = '@app/views/layouts/base-uikit-layout';
        $model = new ForgotpassForm();
        $model->message = '';
        if ($model->load(Yii::$app->request->post())) {
            $user = Clients::findOne(['username' => $model->username]);
            if (!$user) {
                $model->message = 'Пользователь не существует!';
            } else {
                $Oldpass = Clients::getPassword($model->username);
                if ($Oldpass) {
                    $subj = 'Забыли пароль?';
                    $textBody = '';
                    $htmlBody = "Здравствуйте! <br /><br />Напоминаем ваш пароль  на сайте <a href='" . Yii::$app->params['fullurl'] . "'>" . Yii::$app->params['fullurl'] . "</a>.
                        <br />
							Для входа используйте:
							<br /><strong>Пароль: </strong>" . $Oldpass . "<br />
							<br />
							С уважением, <br />комманда <a href='" . Yii::$app->params['fullurl'] . "'>" . Yii::$app->params['fullurl'] . "</a>";
                    Clients::sendEmail(Yii::$app->params['senderEmail'], $model->username, $subj, $textBody, $htmlBody);
                    $model->message = 'Сообщение было отправлено!';
                } else {
                    $model->message = 'Пользователь не существует!';
                }
            }
        }
        return $this->render('forgotpass', [
            'model' => $model,
        ]);
    }


    /**
     * Регистрация
     * @return string|Response
     */
    public function actionRegistration()
    {
        //$this->layout = '@app/views/layouts/base-uikit-layout';
        if (Yii::$app->user->isGuest) {
            /*$model1 = new LoginForm();
            print_r(Yii::$app->request->post());
            if ($model1->load(Yii::$app->request->post()) && $model1->login()) {
                //return $this->goBack();
                //return $this->goHome();
                return $this->redirect(Yii::$app->params['redirectUserUrl']);
            }*/
            //die;
            $model = new SignupForm();
            if ($model->load(\Yii::$app->request->post()) && $model->validate()) {
                $captcha = $this->createAction("captcha");
                $code = $captcha->verifyCode;
                if ($code == $model->captcha) {

                    $user = new Clients();
                    $user->username = $model->username;
                    $user->password = $model->password;
                    $user->name = $model->name;
                    $user->phone = $model->phone;
                    $user->firmname = $model->companyName;
                    $user->email_order_target = 'russia@concord-logistic.com';
                    $user->address = $model->address;
                    $user->CreationDate = date("Y-m-d H:i:s");
                    $user->IsActivated = 1;
                    $user->CG_ID = 1;
                    $user->PriceC = 1;
                    $user->natsenka = 20;

                    if ($user->save(false)) {
                        Yii::$app->getUser()->login($user);

                        $textBody = '';
                        $subj = "Вы зарегистрированы!";
                        $htmlBody = "Здравствуйте!<br>Вы успешно зарегистрировались <a href='" . Yii::$app->params['fullurl'] . "'>" . Yii::$app->params['fullurl'] . "</a> ,<br />
							Ваши данные для входа:<br />
							<strong>Логин: </strong>" . ($model->username) . "<br />
							<strong>Пароль: </strong>" . ($model->password) . "<br /><br />
							С уважением, <br />комманда <a href='" . Yii::$app->params['fullurl'] . "'>" . Yii::$app->params['fullurl'] . "</a>";
                        Clients::sendEmail(Yii::$app->params['senderEmail'], $model->username, $subj, $textBody, $htmlBody);
                        return $this->redirect(Yii::$app->params['redirectUserUrl']);
                    }
                } else {
                    $model->addError('noValidCode', 'Не правильно введен проверочный код!');
                }
            }
            return $this->render('registration', compact('model'));
        } else {
            return $this->redirect(Yii::$app->params['redirectUserUrl']);
        }
    }


    public function actionInvoices($page = 1)
    {
        $inv = $_GET['inv'];
        if (!Yii::$app->user->isGuest) {
            return $this->render('invoices', ['page' => $page, 'invo' => $inv]);
        } else {
            return $this->redirect(Yii::$app->params['fullurl']);
        }
    }

    public function actionOnhanda($page = 1)
    {
        //$this->context->layout = 'lk-layout';
        $this->layout = 'lklayout';
        $inv = $_GET['n'];
        //if (!Yii::$app->user->isGuest) {
        return $this->render('onhanda', ['page' => $page, 'n' => $inv]);
        /*} else {
            return $this->redirect(Yii::$app->params['fullurl']);
        }*/
    }

    public function actionOnhandc($page = 1)
    {
        $this->layout = 'lklayout';
        $inv = $_GET['n'];
        //if (!Yii::$app->user->isGuest) {
        return $this->render('onhandc', ['page' => $page, 'n' => $inv]);
        /*} else {
            return $this->redirect(Yii::$app->params['fullurl']);
        }*/
    }
    public function actionOnh1($page = 1)
    {
        $this->layout = 'lklayout';
        $inv = $_GET['n'];
        //if (!Yii::$app->user->isGuest) {
        return $this->render('onh1', ['page' => $page, 'n' => $inv]);
        /*} else {
            return $this->redirect(Yii::$app->params['fullurl']);
        }*/
    }

    public function actionOrders($page = 1, $o = 0)
    {
        $this->layout = 'lklayout';
        //end();
        //if (!Yii::$app->user->isGuest) {
        return $this->render('orders', ['page' => $page, 'orderNum' => $o]);
        /*} else {
            return $this->redirect(Yii::$app->params['fullurl']);
        }*/
    }

    public function actionFailureGoods($page = 1)
    {
        //end();
        if (!Yii::$app->user->isGuest) {
            return $this->render('failuregoods', ['page' => $page]);
        } else {
            return $this->redirect(Yii::$app->params['redirectUserAutorizationUrl']);
        }
    }

    public function actionMydata()
    {
        $this->layout = 'lklayout';
        //if (!Yii::$app->user->isGuest) {
        $model = new MydataForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $captcha = $this->createAction("captcha");
            $code = $captcha->verifyCode;
            if ($code == $model->captcha) {
                $ClientID = Yii::$app->user->id;
                $res = Clients::updateAll(['name' => $model->name, 'phone' => $model->phone, 'firmname' => $model->companyName, 'address' => $model->address], ['id' => $ClientID]);
                if ($res) {
                    Yii::$app->session->setFlash('successUpdData', "Данные обновлены!");
                    return $this->redirect('mydata');
                } else {
                    $model->addError('noValidCode', 'Не обновлено!');
                }
            } else {
                $model->addError('noValidCode', 'Неправильный проверочный код!');
            }
            return $this->render('mydata', ['model' => $model]);
        }
        return $this->render('mydata', compact('model'));
        /*} else {
            $model = new MydataForm();
            $model->addError('noValidCode', 'Необходимо войти в систему!');
            return $this->render('mydata', compact('model'));
        }*/
    }

    public function actionChangepassword()
    {
        $this->layout = 'lklayout';
        //if (!Yii::$app->user->isGuest) {
        $model = new ChangepasswordForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $captcha = $this->createAction("captcha");
            $code = $captcha->verifyCode;
            if ($code == $model->captcha) {
                if ($model->newPassword == $model->confirmPassword) {
                    $ClientID = Yii::$app->user->id;
                    $res = Clients::updateAll(['password' => $model->newPassword], ['id' => $ClientID]);
                    if ($res) {
                        Yii::$app->session->setFlash('successUpdData', "Пароль обновлен!");
                        return $this->redirect('changepassword');
                    } else {
                        $model->addError('noValidCode', 'Не обновлено!');
                    }
                } else {
                    $model->addError('noValidPassw', 'Не совпадает пароль и подтверждение пароля!');
                }
            } else {
                $model->addError('noValidCode', 'Неправильный проверочный код!');
            }
            return $this->render('changepassword', ['model' => $model]);
        }
        return $this->render('changepassword', ['model' => $model]);
        /*} else {
            $model = new ChangepasswordForm();
            $model->addError('noValidCode', 'Необходимо войти в систему!');
            return $this->render('mydata', compact('model'));
        }*/
    }

    /**
     * Поиск кроссов
     * @return string|Response
     */
    public function actionInterchange()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->render('interchange');
        } else {
            return $this->redirect(Yii::$app->params['redirectUserAutorizationUrl']);
        }
    }

    /**
     * О нас
     * @return string|Response
     */
    public function actionAbout()
    {
        return $this->render('about');
    }


    public function actionQuestion()
    {
        return $this->render('question');
    }

    public function actionRevievs()
    {
        return $this->render('revievs');
    }

    //Services
    public function actionShipping()
    {
        return $this->render('shipping');
    }

    public function actionServices()
    {
        return $this->render('services');
    }

    public function actionGeneral()
    {
        return $this->render('general');
    }

    public function actionGroupage()
    {
        return $this->render('groupage');
    }

    public function actionMult()
    {
        return $this->render('mult');
    }

    public function actionAutocarriage()
    {
        return $this->render('autocarriage');
    }

    public function actionConsolidation()
    {
        return $this->render('consolidation');
    }

    public function actionRepacking()
    {
        return $this->render('repacking');
    }

    //delivery
    public function actionDelivery_spare_parts()
    {
        return $this->render('delivery_spare_parts');
    }

    public function actionDelivery_kit()
    {
        return $this->render('delivery_kit');
    }

    public function actionDelivery_furniture()
    {
        return $this->render('delivery_furniture');
    }

    public function actionDelivery_toys()
    {
        return $this->render('delivery_toys');
    }

    public function actionDelivery_equipment()
    {
        return $this->render('delivery_equipment');
    }

    //Pages
    public function actionGeneral_cargo()
    {
        return $this->render('generalcargo');
    }

    //Send
    public function actionSendcalc()
    {
        if (isset($_POST['from']) && isset($_POST['to']) && strlen($_POST['phone']) > 0) {

            $mail2 = trim($_POST['email']);
            if (!preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", $mail2)) {
                $mail2 = "russia@concord-logistic.com";
            }
            $name = $_POST['name'];
            $phone = $_POST['phone'];
            $to = $_POST['to'];
            $from = $_POST['from'];
            $cat = $_POST['cat'];
            $weight = $_POST['weight'] * 1;
            $volume = $_POST['volume'] * 1;
            $cost = $_POST['cost'] * 1;
            $cost_currency = $_POST['cost_currency'];
            $result_currency = $_POST['result_currency'];
            $insurance = $_POST['insurance'];
            if ($insurance == "on") {
                $insurance = "Нужна";
            } else {
                $insurance = "Нет";
            }
            $custom_clearance = $_POST['custom_clearance'];
            if ($custom_clearance == "on") {
                $custom_clearance = "Нужна";
            } else {
                $custom_clearance = "Нет";
            }
            $headpost = "<strong>Client name: </strong>" . $name . "<br>";
            $headpost .= "<strong>Client mail: </strong>" . $mail2 . "<br>";
            $headpost .= "<strong>Client phone: </strong>" . $phone . "<br><br><br>";
            $headpost .= "<strong>Из: </strong>" . $from . "<br>";
            $headpost .= "<strong>В: </strong>" . $to . "<br>";
            $headpost .= "<strong>Категория: </strong>" . $cat . "<br>";
            $headpost .= "<strong>Вес: </strong>" . $weight . " kg<br>";
            $headpost .= "<strong>Объем: </strong>" . $volume . " m3<br>";
            $headpost .= "<strong>Стоимость груза: </strong>" . $cost . " " . $cost_currency . "<br>";
            $headpost .= "<strong>Рассчитать в: </strong>" . $result_currency . "<br>";
            $headpost .= "<strong>Страховка: </strong>" . $insurance . "<br>";
            $headpost .= "<strong>Таможня: </strong>" . $custom_clearance . "<br>";

            //if (preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", $mail2)) {
            $emailFrom = 'concordp@server.concord-parts.com';
            $name = 'Bot Concord Logistic';

            $mail = new PHPMailer();
            $mail->From = $emailFrom;//$frommail;      // от кого email
            $mail->FromName = $name;   // от кого имя
            $mail->AddAddress('russia@concord-logistic.com'); // кому - адрес, Имя
            //$mail->AddAddress('az@autozap.ru'); // кому - адрес, Имя
            //$mail->AddAddress('derision@mail.ru'); // кому - адрес, Имя
            //$mail->AddAddress('it@autozap.ru'); // кому - адрес, Имя
            $mail->IsHTML(true);// выставляем формат письма HTML
            $mail->Subject = "Запрос расчета доставки с сайта concord-logistic.com";// тема письма
            $mail->Body = $headpost;
            if (@$mail->Send()) {
                return 'Successfully';
            } else {
                return 'Unsuccessfully';
            }
            //}

        } else {
            return 'false';
        }
    }

    public function actionTopostsend()
    {
        $mail3 = 'concordp@server.concord-parts.com';
        $name3 = 'Bot Concord Logistic';
        if (isset($_POST['mail']) && isset($_POST['name']) && isset($_POST['mess']) && isset($_POST['phone']) && strlen($_POST['mail']) > 5 && strlen($_POST['name']) >= 0 && strlen($_POST['mess']) > 0 && strlen($_POST['phone']) > 0) {
            //include_once("app\models\PHPMailer.php");
            $mail2 = $_POST['mail'];
            $name = $_POST['name'];
            $mess = $_POST['mess'];
            $phone = $_POST['phone'];
            $headpost = "<strong>Client name:</strong>" . $name . "<br>";
            $headpost .= "<strong>Client mail:</strong>" . $mail2 . "<br>";
            $headpost .= "<strong>Client phone:</strong>" . $phone . "<br><br><br>";
            $headpost .= "<strong>Client message:</strong><br><br>" . $mess;

            if (preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", $mail2)) {

                $mail = new PHPMailer();
                $mail->From = $mail3;//$frommail;      // от кого email
                $mail->FromName = $name3;   // от кого имя
                $mail->AddAddress('russia@concord-logistic.com'); // кому - адрес, Имя
                //$mail->AddAddress('az@autozap.ru');
                //$mail->AddAddress('derision@mail.ru'); // кому - адрес, Имя
                //$mail->AddAddress('it@autozap.ru'); // кому - адрес, Имя
                $mail->IsHTML(true);// выставляем формат письма HTML
                $mail->Subject = "Client message";// тема письма
                $mail->Body = $headpost;
                if (@$mail->Send()) {
                    return 'Successfully';
                } else {
                    return 'Unsuccessfully';
                }
            } else {
                return 'Unsuccessfully';
            }

        } else if (isset($_POST['mail']) && isset($_POST['name']) && isset($_POST['text']) && isset($_POST['phon']) && strlen($_POST['mail']) > 5 && strlen($_POST['name']) >= 0 && strlen($_POST['text']) > 0 && strlen($_POST['phon']) > 0) {
            //include_once("PHPMailer.php");
            $mail2 = $_POST['mail'];
            $name = $_POST['name'];
            $mess = $_POST['text'];
            $phone = $_POST['phon'];
            $from = $_POST['from'];
            $to = $_POST['to'];
            $cm = $_POST['cm'];
            $weight = $_POST['weight'];
            $hei = $_POST['hei'];
            $lenght = $_POST['lenght'];
            $width = $_POST['width'];
            $air = $_POST['air'];
            $headpost = "<strong>Client name:</strong>" . $name . "<br>";
            $headpost .= "<strong>Client mail:</strong>" . $mail2 . "<br>";
            $headpost .= "<strong>Client phone:</strong>" . $phone . "<br><br><br>";
            $headpost .= "<strong>От:</strong>" . $from . " <strong> До:</strong>" . $to . " <strong> Доставка:</strong>" . $air . "<br><br>";
            $headpost .= "<strong>Описание груза: </strong><br>";
            $headpost .= "<strong>Ширина:</strong>" . $width . " <strong> Длина:</strong>" . $lenght . " <strong> Высота:</strong>" . $hei . " <strong> Вес:</strong>" . $weight . " <strong> Единицы измерения:</strong>" . $cm . "<br><br>";
            $headpost .= "<strong>Промо-тарифы на авиаперевозки из США</strong>";
            $headpost .= "<strong>Client message:</strong><br><br>" . $mess;

            if (preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", $mail2)) {

                $mail = new PHPMailer();
                $mail->From = $mail3;//$frommail;      // от кого email
                $mail->FromName = $name3;   // от кого имя
                $mail->AddAddress('russia@concord-logistic.com'); // кому - адрес, Имя
                //$mail->AddAddress('az@autozap.ru');
                //$mail->AddAddress('derision@mail.ru'); // кому - адрес, Имя
                //$mail->AddAddress('it@autozap.ru'); // кому - адрес, Имя
                $mail->IsHTML(true);// выставляем формат письма HTML
                $mail->Subject = "Client message";// тема письма
                $mail->Body = $headpost;
                if (@$mail->Send()) {
                    return 'Successfully';
                } else {
                    return 'Unsuccessfully';
                }
            } else {
                return 'Unsuccessfully';
            }
        } else {
            return 'false';
        }
    }


    /**
     * Проверка и размещение заказа
     * @return string
     */
    public function actionCheckout()
    {
        if (!Yii::$app->user->isGuest) {
            $model = new PlaceorderForm();
            if ($model->load(Yii::$app->request->post()) && $model->validate()) {

                /**
                 * Получаем корзину клиента
                 * $res['error'][]- array(), существует если есть ошибка
                 * $res['total']- float - сумма в корзине
                 * $res['res'][]- array() - список товаров
                 */
                $clientCart = Clientbasket::getClientsCart();
                if (!isset($clientCart['error']) && isset($clientCart['res'])) {

                    $ClientID = Yii::$app->user->id;
                    $username = Yii::$app->user->identity->username;
                    $from = Yii::$app->user->identity->email_order_target;
                    $itog = $clientCart['total'];
                    $vsego = $clientCart['total'];
                    $nameClient = Yii::$app->user->identity->name;
                    $firmname = Yii::$app->user->identity->firmname;


                    $state = $model->state;
                    $zipCode = $model->zipcode;
                    $address = $model->address;
                    $to = $model->username;
                    $name = $model->name;
                    $country = $model->country;
                    $city = $model->city;
                    $tel = $model->phone;
                    $note = $model->note;
                    $orderNote = $model->orderNote;
                    $paymentType = ($model->paymentType) * 1;
                    $deliveryType = ($model->deliveryType) * 1;

                    //$shipType = trim($_POST['shipType']);
                    $promo = '';
                    $metro = "";
                    //$shipName = trim($_POST['shipName']);
                    //$paymentPP = trim($_POST['paymentpp']);
                    $dvrid = 1;
                    $payment = 'Wire transfer';
                    if ($deliveryType == 1) {
                        $deliveryMethod = 'Air';
                    } else {
                        $deliveryMethod = 'Sea';
                    }
                    if ($paymentType == 2) {
                        $payment = 'PayPal';
                    }
                    $dostavkaPrice = 0;
                    $valutaName = "USD";

                    /**
                     * Получаем ip
                     */
                    $usIp = Clients::getIp();
                    $cropIp = explode(",", $usIp);
                    $usIp = trim($cropIp[0]);

                    /**
                     * Определякм номер нового ордера +1
                     */
                    $lastOrderNum = Orders::getLastDocNum();
                    $DocNum = date('y') . $ClientID;
                    $DocNumAdd = $DocNum . "-" . $lastOrderNum;

                    /**
                     * Создаем новый Ордер в БД
                     */
                    $order = new Orders;
                    $order->ClientID = $ClientID;
                    $order->DocNum = $DocNumAdd;
                    $order->State = '1';
                    $order->client_email_order_target = $from;
                    $order->client_email_order_subject = '1';
                    $order->client_email_order_source = $to;
                    $order->Year = date('Y');
                    $order->CreationDate = date('YmdHis');
                    $order->ConfirmationDate = date('YmdHis');
                    $order->ValutaRatio = 1;
                    $order->ValutaName = 'USD';
                    $order->SummaWithoutDiscount = $vsego;
                    $order->Summa = $itog;
                    $order->client_name = $name;
                    $order->client_email = $username;
                    $order->client_country = $country;
                    $order->client_address = $address;
                    $order->client_phone = $tel;
                    $order->client_description = $note;
                    $order->client_firmname = $firmname;
                    $order->DeliveryID = $dvrid;
                    $order->Delivery = '';
                    $order->DeliveryType = $deliveryMethod;
                    $order->Payment = $payment;
                    $order->usa = '1';
                    $order->Comment = $orderNote;
                    $order->client_metro = $metro;
                    $order->promocode = $promo;
                    $order->dostavka_price = $dostavkaPrice;
                    $order->ip = $usIp;
                    if ($order->save(false)) {
                        unset($order);
                        /**
                         * Начинаем формировать сообщение менеджеру
                         */
                        $txtmess = "
                            <table border='1' cellspacing='0'>
                                <tr>
                                    <th class='num'>#</th>
                                    <th class='article'>Our number</th>
                                    <th class='name'>Name</th>
                                    <th class='producer'>Manufacturer</th>
                                    <th class='code'>Part Number</th>
                                    <th class='price'>Price</th>
                                    <th class='quant' >Quantity</th>
                                    <th class='quant' >Post</th>
                                </tr>
                            ";

                        /**
                         * Очищаем корзину
                         */
                        Clientbasket::deleteClientsCart(0);

                        /**
                         * OrderID последней записи
                         */
                        $ordId = Orders::getLastOrderID();

                        /**
                         * Перебираем записи в корзине и добавляем список товаров в таблицу Ordercontent
                         */
                        foreach ($clientCart['res'] as $val) {
                            $ordercont = new Ordercontent;
                            $ordercont->OrderID = $ordId;
                            $ordercont->GoodID = "1111" . $val['gid'];
                            $ordercont->InnerCode = 0;
                            $ordercont->GoodNameRus = $val['desc'];
                            $ordercont->GoodNameEng = $val['desc'];
                            $ordercont->UzelName = '0';
                            $ordercont->ManufacturerName = $val['man'];
                            $ordercont->OriginalCode = $val['mpn'];
                            $ordercont->quantity = $val['q'];
                            $ordercont->price = $val['yp'];//$val['price'];
                            $ordercont->discount_proc = 0;
                            $ordercont->IsForSale = 0;
                            $ordercont->good_discount = 0;
                            $ordercont->usedDiscount = 0;
                            $ordercont->priceID = $val['pn'];
                            $ordercont->etype = $val['et'];
                            $ordercont->dtime = $val['dt'];
                            if ($ordercont->save(false)) {

                            } else {
                                /**
                                 * Ошибка Не добавлены записи в таблицы
                                 */
                                //return $this->redirect('/cart?m=1');
                            }
                            unset($ordercont);

                            $txtmess .= "<tr>
                                            <td>" . ($tov * 1) . "</td>
                                            <td class='article'></td>
                                            <td class='name'>" . $val['desc'] . "</td>
                                            <td class='producer'>" . $val['man'] . "</td>
                                            <td class='code'>" . $val['mpn'] . "</td>
                                            <td class='price'>" . $val['yp'] . "</td>
                                            <td>" . $val['q'] . "</td>
                                            <td>Price: " . $val['pn'] . "</td>
                                        </tr>
                                        ";
                            $tov++;
                        }
                        $txtmess .= "</table><br>";
                        $txtmess .= "Total: " . $vsego . " " . $valutaName . " Discount: " . $skidka . " " . $valutaName . " To pay: <strong>" . $itog . " " . $valutaName . "</strong>";
                    } else {
                        /**
                         * Ошибка Не добавлены записи в таблицы
                         */
                        return $this->redirect('/cart?m=1');

                    }
                    //echo $txtmess;
                    //print_r($clientCart['res']);end();
                    /**
                     * Успешно добавлены все записи в таблицы
                     */


                    /**
                     * Сообщение клиенту о новом заказе
                     */
                    $subj = "Order " . $DocNumAdd . " is accepted";
                    $textBody = '';
                    $htmlBody = 'Hello!<br/><br/>Thank you for placing order # ' . $DocNumAdd . ' with  ' . Yii::$app->params["fullurl"] . ' !<br/>The manager will contact you after processing  the order.<br/><br/>Best regards, <br />support service <a href="' . Yii::$app->params["fullurl"] . '">' . Yii::$app->params["fullurl"] . '</a>.';
                    //Clients::sendEmail($from, $username, $subj, $textBody, $htmlBody);
                    Clients::sendEmail(Yii::$app->params['senderEmail'], $username, $subj, $textBody, $htmlBody);


                    /**
                     * Сообщение менеджеру  о новом заказе
                     */
                    $txt = "<strong>Name: </strong>" . $nameClient . "<br /><br/>
                            <strong>Shipping Type: </strong>" . $shipType . "<br /><br />

							<strong>Phone: </strong>" . $tel . " Ext.:" . $ext . "<br />
							<strong>E-mail: </strong>" . $to . "<br /><br />

							<strong>Country: </strong>" . $country . "<br />
							<strong>zipCode: </strong>" . $zipCode . "<br />
							<strong>State: </strong>" . $state . "<br />
							<strong>City: </strong>" . $city . "<br />
							<strong>Address: </strong>" . $address . "<br />
							<strong>Address 2: </strong>" . $address2 . "<br /><br />

							<strong>requiredContact: </strong>" . $requiredContact . "<br />
							<strong>residential: </strong>" . $residential . "<br /><br />

							<strong>Payment: </strong>" . $payment . "<br />
							<strong>Shipping Service: </strong>" . $shipName . "<br />
							<strong>Shipping: </strong>$" . ($dostavkaPrice * 1) . "<br />
							<strong>Note: " . $note . "</strong><br /><br />";

                    $subj = "New Order " . $DocNumAdd . " from " . $username;
                    $textBody = '';
                    $htmlBody = "<h3>Order # " . $DocNumAdd . "</h3>" . $txt . $txtmess;
                    //Clients::sendEmail($username, $from, $subj, $textBody, $htmlBody);
                    Clients::sendEmail(Yii::$app->params['senderEmail'], $from, $subj, $textBody, $htmlBody);
                    if ($paymentType == 2) {
                        /*echo '<div id="paypal-button-container"></div>
                                <script src="https://www.paypal.com/sdk/js?client-id=AQ_Vm9tw1QEP0xxvMZlWz9wktSh5UVORApxxuOhFsdQwk-bdRgUCHWB6kSeBBoxkZy3MQO2zLYU-gcF9&currency=USD" data-sdk-integration-source="button-factory"></script>
                                <script>
                                    paypal.Buttons({
                                        style: {
                                            shape: \'rect\',
                                            color: \'white\',
                                            layout: \'horizontal\',
                                            label: \'buynow\',
                                            tagline: true
                                        },
                                        createOrder: function(data, actions) {
                                            return actions.order.create({
                                                purchase_units: [{
                                                    amount: {
                                                        value: "'.$itog.'"
                                                    }
                                                }]
                                            });
                                        },
                                        onApprove: function(data, actions) {
                                            return actions.order.capture().then(function(details) {
                                                alert(\'Transaction completed by \' + details.payer.name.given_name + \'!\');
                                            });
                                        }
                                    }).render(\'#paypal-button-container\');
                                </script>';*/

                        $out = "<a style='display:none;' id='app' href='https://www.paypal.com/cgi-bin/webscr?cmd=_xclick&business=sychev.a@allamerican-parts.com&item_name=Shipping&item_number=$ordId&amount=" . $itog . "&currency_code=USD'>Buy Now with PayPal</a>";
                        echo $out;
                        echo '<script type="text/javascript">window.onload=function(){document.getElementById("app").click()}</script>';
                    } else {
                        return $this->redirect(Yii::$app->params['redirectUserUrl'] . '?m=2');
                    }
                }
            }
            return $this->redirect('/cart?m=1');
        } else {
            return $this->redirect(Yii::$app->params['redirectUserAutorizationUrl']);
        }
    }

}
