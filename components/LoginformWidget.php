<?php
namespace app\components;
use yii\base\Widget;

class LoginformWidget extends Widget
{

    public function run()
    {

        return $this->render('loginform');
    }
}
?>