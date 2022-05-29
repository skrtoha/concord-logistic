<?php
namespace app\models;

use Yii;

class OtherFunctions
{
    public static function sendEmail($from, $to, $subj, $text, $html)
    {
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
        return 1;
    }
}