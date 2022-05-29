<?php

namespace app\models;

use yii\base\Model;

class MydataForm extends Model
{
    public $companyName;
    public $name;
    public $phone;
    public $address;
    public $captcha;

    public function rules()
    {
        return [
            [['name','phone','captcha'], 'required', 'message' => 'Выделенные поля обязательны для заполнения'],
            [['captcha','phone','name','address','companyName'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'companyName' => 'Пароль',
            'name' => 'Пароль',
            'phone' => 'Пароль',
            'address' => 'Пароль',
            'captcha' => 'Пароль',
        ];
    }

}