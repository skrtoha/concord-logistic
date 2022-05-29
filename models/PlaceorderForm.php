<?php

namespace app\models;

use yii\base\Model;

class PlaceorderForm extends Model
{

    public $username;
    public $name;
    public $phone;
    public $address;

    public $note;
    public $orderNote;
    public $zipcode;
    public $city;
    public $country;
    public $state;
    public $paymentType;
    public $deliveryType;

    public function rules()
    {
        return [
            [['phone','username','paymentType','address'], 'required', 'message' => 'Marked fields are mandatory'],
            [['name','phone','address','note','state','zipcode','city','country','orderNote','deliveryType'], 'string'],
            [['paymentType'], 'integer'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Логин',
            'name' => 'Пароль',
            'phone' => 'Пароль',
            'address' => 'Пароль',
            'note' => 'Пароль',
            'state' => 'Пароль',
            'zipcode' => 'Пароль',
            'city' => 'Пароль',
            'orderNote' => 'Пароль',
            'country' => 'Пароль',
            'deliveryType' => 'Пароль',
        ];
    }

}