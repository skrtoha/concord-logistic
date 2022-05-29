<?php

namespace app\models;

use Yii;
use yii\base\Model;
//use yii\base\Model\Clients;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $username;
    public $password;
    public $rememberMe = true;

    private $_user = false;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            //echo "<pre>22-".print_r($user)."</pre>";
            if (!$user || ! $user->validatePassword($this->password)) {//|| ! Clients::validatePassword($this->password)
                $this->addError($attribute, 'Incorrect username or password');
                $this->addError("aut", 'Incorrect username or password');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            $user = Clients::findOne(['username' => $this->username]);
            //Yii::$app->getUser()->login($user);
            //var_dump($user);
            Yii::$app->user->login($user, $this->rememberMe ? 3600*24*30 : 0);
            return true;
        } else {
            $this->addError("aut", 'Incorrect username or password');
            return false;
        }
        //echo 888;
        /*if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }else {
            // данные не корректны: $errors - массив содержащий сообщения об ошибках
            $errors = $this->errors;
            print_r($errors);
        }
        return false;*/
    }


    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            //$r= new Clients();
            $this->_user = Clients::findOne(['username' => $this->username]);
        }
        //$this->_user = User::findByUsername($this->username);
        return $this->_user;
    }
}
