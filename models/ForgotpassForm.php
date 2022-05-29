<?php

namespace app\models;

use yii\base\Model;

class ForgotpassForm extends Model
{

    public $username;
    public $message;

    public function rules()
    {
        return [
            [['username'], 'required', 'message' => 'Marked fields are mandatory'],
            ['username', 'unique', 'targetClass' => Clients::className(),  'message' => 'User already exists!'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'message' => 'Логин',
        ];
    }

}