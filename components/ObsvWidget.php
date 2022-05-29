<?php
namespace app\components;
use yii\base\Widget;

class ObsvWidget extends Widget
{
    public function run()
    {
        return $this->render('obsv');
    }
}
?>