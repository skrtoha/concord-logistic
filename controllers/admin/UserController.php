<?php
namespace app\controllers\admin;

//use app\controllers\AppController;
use yii\web\Controller;

class UserController extends Controller
{
    public function actionIndex(){
        return $this->render('index');
    }
}