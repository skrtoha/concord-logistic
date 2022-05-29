<?php

namespace app\models;

use yii\base\Model;

class ChangepasswordForm extends Model
{
    public $newPassword;
    public $confirmPassword;
    public $captcha;

    public function rules()
    {
        return [
            [['newPassword','confirmPassword','captcha'], 'required', 'message' => 'Marked fields are mandatory'],
            [['captcha','newPassword','confirmPassword'], 'string'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'newPassword' => 'Пароль',
            'confirmPassword' => 'Пароль',
            'captcha' => 'Пароль',
        ];
    }

}