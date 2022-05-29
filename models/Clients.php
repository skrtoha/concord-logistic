<?php
namespace app\models;
use Codeception\Module\Cli;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "clients".
 *
 * @property int $id
 * @property string $CreationDate
 * @property int $IsActivated
 * @property int $newpassw
 * @property string $ActivationCode
 * @property int $LastOrderDocNum
 * @property int $CG_ID
 * @property string $name
 * @property float $discount_proc
 * @property int $natsenka
 * @property string $username
 * @property string $password
 * @property string $country
 * @property string $city
 * @property string $address
 * @property string $phone
 * @property string $ext
 * @property string $description
 * @property string $firmname
 * @property string $discountcard
 * @property string $email_order_target
 * @property string $email_order_subject
 * @property string $email_order_source
 * @property int $goodscatalog_usefilterconstraints
 * @property string $BasePriceIs
 * @property string $RestsIs
 * @property string $KnowFrom
 * @property int|null $IsGoldDiscount
 * @property int|null $PriceA
 * @property int|null $PriceB
 * @property int|null $PriceC
 * @property int|null $IgnoreR
 * @property int $LetDownloadAcademyGoodsCards
 * @property string|null $Password2
 * @property int $ban
 * @property int $role
 * @property int $promocode
 * @property string $promocodeDate
 * @property int $academyOnly
 * @property string $lastPurchase
 * @property int $branch
 * @property int $spec
 * @property string $dateUpdDiscount
 * @property string $address2
 * @property string $state
 * @property string $zipCode
 * @property string $residential
 * @property string $requiredContact
 * @property string $token
 * @property int|null $cookiePolicy
 */
class Clients extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    const STATUS_BLOCKED = 2;
    const STATUS_ACTIVE = 1;
    const STATUS_WAIT = 0;

    public function getStatusName()
    {
        return ArrayHelper::getValue(self::getStatusesArray(), $this->status);
    }

    public static function getStatusesArray()
    {
        return [
            self::STATUS_BLOCKED => 'Заблокирован',
            self::STATUS_ACTIVE => 'Активен',
            self::STATUS_WAIT => 'Ожидает подтверждения',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'clients';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username'], 'email'],
            [['username'], 'unique', 'targetClass' => Clients::className(), 'message' => 'Incorrect username '],
            [['username'], 'match', 'pattern' => '/^[a-zA-Z0-9-_.]{1,50}(@+)[a-zA-Z0-9-_.]{4,50}$/u', 'message' => 'Characters "A-z 0-9 - _ @ .".'],
            [['password'], 'length' => [4, 50]],

            [['name', 'username', 'password', 'phone'], 'required'],
            /*[['status'], 'integer'],
            [['status'], 'default', 'value' => self::STATUS_ACTIVE],
            [['status'], 'in', 'range' => array_keys(self::getStatusesArray())],*/
        ];
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        /*return array(
            array('name, username, password, phone', 'required'),
            array('username','email'),
            array('username','match','pattern'=>'/^[a-zA-Z0-9-_.]{1,50}(@+)[a-zA-Z0-9-_.]{4,50}$/u','message'=>'Допустимые символы "A-z 0-9 - _ @ .".'), //([\w-\.]+)@((?:[\w-]+\.)+)(\w{2,4})
            //[a-zA-Z0-9-_.]{1,50}(@+)[a-zA-Z0-9-_.]{4,50}
            array('IsActivated, newpassw, LastOrderDocNum, CG_ID, goodscatalog_usefilterconstraints, IsGoldDiscount, PriceA, PriceB, PriceC, IgnoreR, role,LetDownloadAcademyGoodsCards,role,ban', 'numerical', 'integerOnly'=>true),
            array('CreationDate', 'length', 'max'=>14),
            array('ActivationCode, country, city, discountcard, Password2', 'length', 'max'=>250),
            array('name, username, phone, firmname, email_order_target, email_order_subject, email_order_source', 'length', 'max'=>150),
            array('discount_proc', 'length', 'max'=>5),
            array('password', 'length', 'min'=>4),
            array('password', 'length', 'max'=>30),
            array('BasePriceIs', 'length', 'max'=>2),
            array('RestsIs', 'length', 'max'=>7),
            array('KnowFrom', 'length', 'max'=>100),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements(),'on'=>'registration'),
            array('id, CreationDate, IsActivated, newpassw, ActivationCode, LastOrderDocNum, CG_ID, name, discount_proc, username, password, country, city, address, address2,state,requiredContact,phone,ext, zipCode,residential,description, firmname, discountcard, email_order_target, email_order_subject, email_order_source, goodscatalog_usefilterconstraints, BasePriceIs, RestsIs, KnowFrom, IsGoldDiscount, PriceA, PriceB, PriceC, IgnoreR, LetDownloadAcademyGoodsCards, Password2, role,ban,promocode,promocodeDate,academyOnly,lastPurchase,branch,spec,natsenka,cookiePolicy', 'safe','on'=>'search'),
        );*/
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'CreationDate' => 'Creation Date',
            'IsActivated' => 'Is Activated',
            'newpassw' => 'Newpassw',
            'ActivationCode' => 'Activation Code',
            'LastOrderDocNum' => 'Last Order Doc Num',
            'CG_ID' => 'Cg ID',
            'name' => 'Name',
            'discount_proc' => 'Discount Proc',
            'natsenka' => 'Natsenka',
            'username' => 'Username',
            'password' => 'Password',
            'country' => 'Country',
            'city' => 'City',
            'address' => 'Address',
            'phone' => 'Phone',
            'ext' => 'Ext',
            'description' => 'Description',
            'firmname' => 'Firmname',
            'discountcard' => 'Discountcard',
            'email_order_target' => 'Email Order Target',
            'email_order_subject' => 'Email Order Subject',
            'email_order_source' => 'Email Order Source',
            'goodscatalog_usefilterconstraints' => 'Goodscatalog Usefilterconstraints',
            'BasePriceIs' => 'Base Price Is',
            'RestsIs' => 'Rests Is',
            'KnowFrom' => 'Know From',
            'IsGoldDiscount' => 'Is Gold Discount',
            'PriceA' => 'Price A',
            'PriceB' => 'Price B',
            'PriceC' => 'Price C',
            'IgnoreR' => 'Ignore R',
            'LetDownloadAcademyGoodsCards' => 'Let Download Academy Goods Cards',
            'Password2' => 'Password2',
            'ban' => 'Ban',
            'role' => 'Role',
            'promocode' => 'Promocode',
            'promocodeDate' => 'Promocode Date',
            'academyOnly' => 'Academy Only',
            'lastPurchase' => 'Last Purchase',
            'branch' => 'Branch',
            'spec' => 'Spec',
            'dateUpdDiscount' => 'Date Upd Discount',
            'address2' => 'Address2',
            'state' => 'State',
            'zipCode' => 'Zip Code',
            'residential' => 'Residential',
            'requiredContact' => 'Required Contact',
            'cookiePolicy' => 'Cookie Policy',
            'status' => 'Статус',
            'token' => 'token',
        ];
    }

    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        foreach (self::$users as $user) {
            if (strcasecmp($user['username'], $username) === 0) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */

    public function validatePassword($password)
    {
        return $this->password === $password;
    }


    public static function getCurrentPrice($priceSupplier, $PriceName, $SupplierName)
    {
        $natsenka = Clients::getNatsenka($PriceName, $SupplierName);
        //echo ($priceSupplier)."==".$PriceName."=". $SupplierName."=".$natsenka."==<br>".round(($priceSupplier * $natsenka) / 100, 2);
        return round(($priceSupplier * $natsenka) / 100, 2);
    }

    public static function getCurrentPriceByToken($priceSupplier, $PriceName, $SupplierName,$emailParent)
    {
        $natsenka = Clients::getNatsenka($PriceName, $SupplierName, $emailParent);
        return round(($priceSupplier * $natsenka) / 100, 2);
    }

    /**
     * Возвращает коэффициент наценки(умножения) на цену поставщика для конкретного товара для конкретного клиента
     * @param $PriceName
     * @param $SupplierName
     * @return float
     */
    public static function getNatsenka($PriceName, $SupplierName, $emailParent="")
    {
        $spec=0;
        if(strlen($emailParent)>5){

            $cache = Yii::$app->cache;
            $key = 'natsenkaParent_' . $PriceName . "_" . $SupplierName."_".$emailParent;
            $natsenkaParent = $cache->get($key);
            //$natsenkaParent=false;
            if ($natsenkaParent === false) {
                $natsenkaParent=Clients::getNatsenkaByEmail($emailParent);
                $cache->set($key, $natsenkaParent, 60 * 30);//30 минут
            }

            if($natsenkaParent) {
                $natsenkaW = 1 + $natsenkaParent / 100;
            }else{
                $natsenkaW = 1.5;
            }
        }else{
            $email = strtolower(Yii::$app->user->identity->username);
            $natsenkaW = 1 + (Yii::$app->user->identity->natsenka) / 100;
            $spec = Yii::$app->user->identity->spec;
        }
        if($spec==10){
            $email=strtolower(Yii::$app->user->identity->email_order_source);
            $natsenkaParent=Clients::getNatsenkaByEmail($email);
            if($natsenkaParent) {
                $natsenkaW = 1 + $natsenkaParent / 100;
            }else{
                $natsenkaW = 1.5;
            }
            //$message="email:$email; natsenkaW:$natsenkaW";
            //OtherFunctions::sendOtherMail("sendOtherMail",  "concord@concord-parts.com", "it@autozap.ru","test parent mail",$message );
        }
        $SupplierName = strtolower($SupplierName);

        /*
        if ($SupplierName == "security dodge") {
            if ($PriceName == "Chrysler без доставки Concord-1") {
                $natsenkaW = 1.24;
                if ($email == 'linas@autoterpe.w3.lt') {
                    $natsenkaW = 1.21;
                }
            }
            if ($PriceName == "Chrysler без доставки Concord-2") {
                $natsenkaW = 1.1;
                if ($email == 'linas@autoterpe.w3.lt') {
                    $natsenkaW = 1.07;
                }
                if ($email == 'info@mopartruckshop.nl') {
                    $natsenkaW = 1.07;
                }
            }

            if ($PriceName == "Chrysler без доставки-1") {
                $natsenkaW = 1.24;
                if ($email == 'linas@autoterpe.w3.lt') {
                    $natsenkaW = 1.21;
                }
                if ($email == 'info@usamotors.com.ua') {
                    $natsenkaW = 1.11;
                }
            }
            if ($PriceName == "Chrysler без доставки-2") {
                $natsenkaW = 1.1;
                if ($email == 'linas@autoterpe.w3.lt') {
                    $natsenkaW = 1.07;
                }
                if ($email == 'info@mopartruckshop.nl') {
                    $natsenkaW = 1.07;
                }
            }
        }
        if ($SupplierName == "enginetech") {
            $natsenkaW = 1.15;
            if ($email == 'nico.stamm@auto-stamm.de') {
                $natsenkaW = 1.1;
            }
        }

        if ($SupplierName == "bpi") {
            $natsenkaW = 1.2;
        }
        if ($SupplierName == "power stop") {
            $natsenkaW = 1.12;
        }
        if ($SupplierName == "crown") {
            $natsenkaW = 1.15;
        }
        //if($SupplierName=="standard"){$natsenkaW=1.2;}
        if ($SupplierName == "dorman") {
            $natsenkaW = 1.2;
        }
        if ($SupplierName == "summitracing.com") {
            if ($email == 'alex9@bakflip.ru') {
                $natsenkaW = 1.12;
            }
            if ($email == 'info@ploegparts.nl') {
                $natsenkaW = 1.05;
            }
            if ($email == 'shiva@pch.nl') {
                $natsenkaW = 1.05;
            }
            //if($email=='info@vanleersum.nl'){$natsenkaW=1.05;}
            //if($email=='info@lansauto.nl'){$natsenkaW=1.05;}
        }
        if ($SupplierName == "transamerican") {
            if ($email == 'alex9@bakflip.ru') {
                $natsenkaW = 1.12;
            }
        }

        if ($SupplierName == "keystone") {
            $natsenkaW = 1.1;
            if ($email == 'info@offjeep.ru') {
                $natsenkaW = 1.12;
            }
            if ($email == 'alex9@bakflip.ru') {
                $natsenkaW = 1.1;
            }
            if ($email == 'info@topparts.ee') {
                $natsenkaW = 1.05;
            }
        }
        if ($SupplierName == "partsauthority") {
            $natsenkaW = 1.14;
            if ($email == 'linas@autoterpe.w3.lt') {
                $natsenkaW = 1.09;
            }
            if ($email == 'nico.stamm@auto-stamm.de') {
                $natsenkaW = 1.1;
            }
            if ($email == 'vertexspareparts@gmail.com') {
                $natsenkaW = 1.1;
            }
            if ($email == 'c.weidlich@power-parts.de') {
                $natsenkaW = 1.1;
            }
            if ($email == 'ot@tyra.nl') {
                $natsenkaW = 1.10;
            }
            if ($email == 'info@usa-cars.nl') {
                $natsenkaW = 1.10;
            }
            if ($email == 'autogroup2013@gmail.com') {
                $natsenkaW = 1.10;
            }
            if ($email == 'maxim@motorparts.by') {
                $natsenkaW = 1.09;
            }
            if ($email == 'info@ploegparts.nl') {
                $natsenkaW = 1.09;
            }
            if ($email == 'shiva@pch.nl') {
                $natsenkaW = 1.09;
            }
            if ($email == 'info@topparts.ee') {
                $natsenkaW = 1.09;
            }
            if ($email == 'taivo@american.ee') {
                $natsenkaW = 1.09;
            }
            if ($email == 'info@mopartruckshop.nl') {
                $natsenkaW = 1.1;
            }
            if ($email == 'gerd@kien.nl') {
                $natsenkaW = 1.1;
            }
            if ($email == 'yverschuur@auto-kardol.nl') {
                $natsenkaW = 1.1;
            }
            if ($email == 'marco@tenback.nl') {
                $natsenkaW = 1.1;
            }
            if ($email == 'wouter@vanleersum.nl') {
                $natsenkaW = 1.1;
            }
            if ($email == 'daytonamotors.bxl@gmail.com') {
                $natsenkaW = 1.1;
            }
            if ($email == 'info@usparts-shop.de') {
                $natsenkaW = 1.1;
            }
            if ($email == 'f.huber@autohouseamrhein.com') {
                $natsenkaW = 1.1;
            }
            if ($email == 'motown@wxs.nl') {
                $natsenkaW = 1.1;
            }
        }
        if ($SupplierName == "uni-select") {
            $natsenkaW = 1.1;
        }
        if ($SupplierName == "ford fullerton") {
            $natsenkaW = 1.19;
        }
        if ($SupplierName == "malouf gm") {
            if ($email == 'info@generalparts.ch') {
                $natsenkaW = 1.06;
            }
            if ($email == 'nibeskov@gmail.com') {
                $natsenkaW = 1.11;
            }
            if ($email == 'hf@euro-us-cars.de') {
                $natsenkaW = 1.1;
            }
            if ($email == 'nico.stamm@auto-stamm.de') {
                $natsenkaW = 1.1;
            }

            if ($email == 'sergeichevi@yandex.ru') {

            } else if ($PriceName == "GM без доставки Concord") {
                $natsenkaW = $natsenkaW + 0.03;
            }
        }
        if ($SupplierName == "ford malouf") {
            $natsenkaW = 1.1;
            if ($email == 'uriybol@yandex.ru') {
                $natsenkaW = 1.28;
            }
            if ($email == 'sergeichevi@yandex.ru') {
                $natsenkaW = 1.07;
            }
            if ($email == 'motown@wxs.nl') {
                $natsenkaW = 1.04;
            }
            if ($email == 'info@usamotors.com.ua') {
                $natsenkaW = 1.08;
            }
        }

        if ($SupplierName == "casco") {
            if ($PriceName == "Casco-1 (AcDelco) без доставки" || $PriceName == "Casco-3 (AcDelco) без доставки" || $PriceName == "Casco-2 (AcDelco) без доставки" || $PriceName == "Casco-5 (Mopar) без доставки" || $PriceName == "Casco-4 (Ford) без доставки") {//Casco-1 (AcDelco) без доставки
                $natsenkaW = 1.15;
                if ($email == 'ot@tyra.nl') {
                    $natsenkaW = 1.10;
                }
                if ($email == 'info@usa-cars.nl') {
                    $natsenkaW = 1.10;
                }
                if ($email == 'motown@wxs.nl') {
                    $natsenkaW = 1.05;
                }
                if ($email == 'info@usamotors.com.ua') {
                    $natsenkaW = 1.13;
                }
                if ($email == 'nico.stamm@auto-stamm.de') {
                    $natsenkaW = 1.12;
                }
            }
        }
        if ($SupplierName == "premier") {
            if ($PriceName == "Premier Performance (без доставки)") {
                $natsenkaW = 1.1;
            }
        }
        */


        //echo $supplierName."=".$priceName."=".$clientEmail."=".$natsenkaW."=";
        $natsenkaW=DealerpricesMarkup::getMarkup($SupplierName,$PriceName,$email,$natsenkaW);
        if($SupplierName=='customs30122020' && $natsenkaW==1.2){
            $natsenkaW=1.1;
        }

        if ($SupplierName == "malouf gm") {
            if ($PriceName == "GM без доставки Concord") {
                $natsenkaW = $natsenkaW + 0.03;
            }
        }

        if ($SupplierName == "priceusa") {
            if($natsenkaW<=1.1) {
                $natsenkaW = 1.1;
            }
        }

        if($spec != 10 && strlen($emailParent) <= 5) {
            if (!Clients::isOptClient()) {
                $natsenkaW = $natsenkaW * 1 + 0.5;
            }
        }

        if($email=='purchase@flmotors.ae'){
            return 1.07;
        }
        return $natsenkaW;
    }

    /**
     * Оптовый клиент или нет
     * @return bool
     */
    public static function isOptClient()
    {
        $PriceA = Yii::$app->user->identity->PriceA;
        $PriceB = Yii::$app->user->identity->PriceB;
        $PriceC = Yii::$app->user->identity->PriceC;
        $opt = false;
        if (($PriceA == 1 || $PriceB == 1 || $PriceC == 1)) { //Если опт и Тип не 2 - т.е. не из России //&& $cli['CG_ID']!=2
            $opt = true;
        }
        return $opt;
    }

    /**
     * Определение ip пользователя
     * @return array|false|string
     */
    public static function getIp()
    {
        if ($ip = getenv("HTTP_CLIENT_IP")) return $ip;

        if ($ip = getenv("HTTP_X_FORWARDED_FOR")) {
            if ($ip == '' || $ip == "unknown") {
                $ip = getenv("REMOTE_ADDR");
            }
            return $ip;
        }
        if ($ip = getenv("REMOTE_ADDR")) return $ip;
    }

    public static function sendEmail($from, $to, $subj, $text="", $html)
    {
        /*Yii::$app->mailer->compose()
            ->setFrom($from)
            ->setTo($to)
            ->setSubject($subj)
            ->setTextBody($text)
            ->setHtmlBody($html)
            ->send();*/
        /*Yii::$app->mailer->compose()
            ->setFrom([$from => 'Bot'])
            ->setTo([$to => 'User'])
            ->setSubject($subj)
            ->setTextBody($text)
            ->send();*/
        $mail = new PHPMailer();
        $mail->From = $from;      // от кого email
        $mail->FromName = "Concord-logistic.com";   // от кого имя
        $mail->AddAddress($to); // кому - адрес, Имя
        //$mail->IsSMTP();
        $mail->IsHTML(true);        // выставляем формат письма HTML
        $mail->Subject = $subj;  // тема письма
        $mail->Body = $html;
        if (@$mail->Send()) {
            return true;
        }
        return false;
    }

    public static function getBillindData()
    {
        $respBank = Bankmoneys::getAllByClient();
        $bankmoney = 0;
        if (isset($respBank['total'])) {
            $bankmoney = $respBank['total'] * 1;
        }
        $respFinoper = Financeoperations::getAllByClient();
        $saldo = 0;
        $vm = 'USD';
        if (isset($respFinoper['total'])) {
            $saldo = $respFinoper['total'] * 1;
            $vm = $respFinoper['vm'] ;
        }
        if($vm=="USD"){
            $vm="$";
        }else if($vm=="РУБ"){
            $vm="₽";
        }
        $vm.="&nbsp;";
        if (($saldo * 1) < 0) {
            $balanceSym = "-&nbsp;".$vm . number_format($saldo * -1,2,'.',' ');
        } else {
            $balanceSym = "+&nbsp;".$vm . number_format($saldo * 1,2,'.',' ');
        }
        $spent=$saldo*1-$bankmoney*1;
        if (($spent * 1) < 0) {
            $spentSym = "-&nbsp;".$vm . number_format($spent * -1,2,'.',' ');
        } else {
            $spentSym = "+&nbsp;".$vm . number_format($spent * 1,2,'.',' ');
        }
        $res['bankmoney'] = number_format($bankmoney * 1,2,'.',' ');
        $res['vm'] = $vm;
        $res['balance'] = $saldo;
        $res['spent'] = $spent;
        $res['spentSym'] = $spentSym;
        $res['balanceSym'] = $balanceSym;
        $res['credit'] = 0;
        $res['creditVM'] = 'USD';
        $EMail=Yii::$app->user->identity->username;
        $clientsEx=Clientsex::findOne(['EMail' => $EMail]);
        if($clientsEx){
            $res['credit'] = number_format($clientsEx->MaxCredit,2,'.',' ');
            $res['creditVM'] = $clientsEx->ValutaName;
            if($res['creditVM']=="USD"){
                $res['creditVM']="$";
            }else if($res['creditVM']=="РУБ"){
                $res['creditVM']="₽";
            }
        }
        return $res;
    }

    public static function getPassword($username)
    {
        $query = self::find()
            ->select(['password'])
            ->where(['username' => $username])
            ->all();
        $res = false;
        if (count($query) > 0) {
            foreach ($query as $item) {
                $res = $item['password'];
            }
        }
        return $res;
    }
    public static function getNatsenkaByEmail($username)
    {
        $query = self::find()
            ->select(['natsenka'])
            ->where(['username' => $username])
            ->all();
        $res = false;
        if (count($query) > 0) {
            foreach ($query as $item) {
                $res = $item['natsenka'];
            }
        }
        return $res;
    }
    public static function getEmailByToken($token)
    {
        $query = self::find()
            ->select(['username'])
            ->where(['token' => $token])
            ->all();
        $res = false;
        if (count($query) > 0) {
            foreach ($query as $item) {
                $res = $item['username'];
            }
        }
        return $res;
    }
    public static function getTokenByEmail($email)
    {
        $query = self::find()
            ->select(['token'])
            ->where(['username' => $email])
            ->all();
        $res = false;
        if (count($query) > 0) {
            foreach ($query as $item) {
                $res = $item['token'];
            }
        }
        return $res;
    }
    public static function setTokenByEmail($email)
    {
        $rand=rand(1,1000);
        $date=date('c');
        $token = md5($email."_".$rand."_".$date);
        $res = Clients::updateAll(['token' => $token], ['username' => $email]);
        if ($res) {
            return $token;
        }
        return false;
    }
    public static function setClientsDataByEmail()
    {
        $query = Clients::find()
            ->select(['id','username'])
            ->where(['goodscatalog_usefilterconstraints' => 1])
            ->limit(300)
            ->all();
        $res=[];
        foreach ($query as $item) {
            $id=$item['id'];
            $email=$item['username'];
            $custom = Orders::find()
                ->select(['client_city','client_name','client_phone','client_address','client_country','client_firmname','client_email_order_target'])
                ->where(['client_email' => $email])
                ->orderBy(['OrderID' => SORT_DESC])
                ->limit(1)
                ->one();
            //foreach ($custom as $f){
            if($custom != null) {
                $res[] = $email . ";" . $custom['client_email_order_target'];
                $re = Clients::updateAll(['name' => $custom['client_name'],'phone' => $custom['client_phone'],'address' => $custom['client_address'],'country' => $custom['client_country'],'firmname' => $custom['client_firmname'],'email_order_target' => $custom['client_email_order_target'],'goodscatalog_usefilterconstraints' => 0], ['id' => $id]);
            }else{
                $re = Clients::updateAll(['goodscatalog_usefilterconstraints' => 0], ['id' => $id]);
            }
            unset($re);
            //}

        }
        //$res=785785;
        return $res;
    }
}
