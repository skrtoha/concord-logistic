<?php
namespace app\models;


use app\models\OutcomeContent;

use Yii;
class OtherFunctions
{
    public static function sendEmail($from,$to,$subj,$text,$html){
        Yii::$app->mailer->compose()
            ->setFrom($from)
            ->setTo($to)
            ->setSubject($subj)
            ->setTextBody($text)
            ->setHtmlBody($html)
            ->send();
    }
    public static function getStepDeliveryLogistic($ClientOrderID, $GoodID)
    {

        $arr[0]="";
        $arr[1]="";
        $arr[2]="";
        $arr[3]="";

        $arr[4]="";
        $arr[5]="";
        $arr[6]="";
        $arr[7]="";

        $cache = Yii::$app->cache;
        $key = 'OutcomeMain_1_' . $ClientOrderID."_".$GoodID;
        $OutcomeMain = $cache->get($key);
        if ($OutcomeMain === false) {
            $OutcomeMain = OutcomeMain::find()
                ->select('outcome_main.ConfirmationDate')
                ->leftJoin('outcome_content', '`outcome_content`.`OperationID` = `outcome_main`.`OperationID`')
                ->where(['outcome_content.ClientOrderID' => $ClientOrderID,'outcome_content.GoodID' => $GoodID])
                ->one();
            $cache->set($key, $OutcomeMain, 1800);//секунд
        }
        if($OutcomeMain){
            $arr[0]="is-complete";
            $arr[1]="is-complete";
            $arr[2]="is-complete";
            $arr[3]="is-active";
            $arr[7] =explode(' ',$OutcomeMain['ConfirmationDate'])[0];
        }else{
            $key = '$IncomeMain_1_' . $ClientOrderID."_".$GoodID;
            $IncomeMain = $cache->get($key);
            if ($IncomeMain === false) {
                $IncomeMain = IncomeMain::find()
                    ->select('income_main.ConfirmationDate')
                    ->leftJoin('income_content', '`income_content`.`OperationID` = `income_main`.`OperationID`')
                    ->where(['income_content.ClientOrderID' => $ClientOrderID,'income_content.GoodID' => $GoodID])
                    ->one();
                $cache->set($key, $IncomeMain, 1800);//секунд
            }
            if($IncomeMain){
                $arr[0]="is-complete";
                $arr[1]="is-complete";
                $arr[2]="is-active";

                $arr[6] =explode(' ',$IncomeMain['ConfirmationDate'])[0];

            }else{
                $key = 'OnhandcContent_1_' . $ClientOrderID."_".$GoodID;
                $queryOnhandc = $cache->get($key);
                if ($queryOnhandc === false) {
                    $queryOnhandc = OnhandcMain::find()
                        ->select('onhandc_main.CreationDate')
                        ->leftJoin('onhandc_content', '`onhandc_content`.`OperationID` = `onhandc_main`.`OperationID`')
                        ->where(['onhandc_content.ClientOrderID' => $ClientOrderID,'onhandc_content.GoodID' => $GoodID])
                        ->one();
                    $cache->set($key, $queryOnhandc, 1800);//секунд
                }
                if($queryOnhandc){
                    $arr[0]="is-complete";
                    $arr[1]="is-active";
                    $arr[5] =explode(' ',$queryOnhandc['CreationDate'])[0];
                }else{
                    $queryOnhanda = OnhandaMain::find()
                        ->select('onhanda_main.CreationDate')
                        ->leftJoin('onhanda_content', '`onhanda_content`.`OperationID` = `onhanda_main`.`OperationID`')
                        ->where(['onhanda_content.ClientOrderID' => $ClientOrderID,'onhanda_content.GoodID' => $GoodID])
                        ->one();

                    $arr[0]="is-active";

                    $arr[4] =explode(' ',$queryOnhanda['CreationDate'])[0];
                }
            }
        }
        return $arr;
    }

}