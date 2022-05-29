<?php
namespace app\components;
use yii\base\Widget;

class CalcWidget extends Widget
{
    public $titleCalc;

    public function init()
    {
        parent::init();
    }
    public function run()
    {
        return $this->render('calc', [
            'titleCalc' => $this->titleCalc,
        ]);
    }
}
?>