<?php

namespace app\models;

use yii\base\Model;

class SignupForm extends Model
{

    public $username;
    public $password;
    public $confirmPassword;
    public $companyName;
    public $name;
    public $phone;
    public $address;
    public $captcha;

    public function rules()
    {
        return [
            [['name','phone','username', 'password','captcha'], 'required', 'message' => 'Выделенные поля обязательны для заполнения'],
            [['captcha','phone','address','companyName'], 'string'],
            //['captcha', 'captcha'],
            ['username', 'unique', 'targetClass' => Clients::className(),  'message' => 'Пользователь уже существует!'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'password' => 'Пароль',
            'companyName' => 'Пароль',
            'userName' => 'Пароль',
            'phone' => 'Пароль',
            'address' => 'Пароль',
            'captcha' => 'Пароль',
        ];
    }

}