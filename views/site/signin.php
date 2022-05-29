<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
?>
<nav class="uk-navbar-container" uk-navbar>
    <div class="uk-navbar-left">
        <img class='uk-navbar-item uk-logo uk-animation-shake' src="/images/allamericant.png" alt = 'autopart store' />
    </div>
    <div class="uk-navbar-right">
        <ul class="uk-navbar-nav">
            <li class="uk-active"><a href="#">Login</a></li>
            <li><a href="/registration">Sign up</a></li>
        </ul>
    </div>
</nav>
<div id="app" class="uk-section uk-flex uk-flex-middle uk-animation-fade uk-position-center" >
    <div class="uk-width-1-1">
        <div class="uk-container">
            <div class="uk-grid " uk-grid>
                <div class="uk-width-1-1@m">
                    <div class="uk-margin uk-margin-auto uk-width-large uk-card uk-card-default uk-card-body uk-box-shadow-large">
                        <h3 class="uk-card-title uk-text-center">WELCOME BACK!</h3>
                        <?php $form = ActiveForm::begin([
                            'options' => [
                                'action' => "/",
                                'method' => "post",
                            ],
                            'fieldConfig' => [
                                'options' => [
                                    'tag' => false,
                                ]
                            ]
                        ]);
                        $errors=@$model->getErrors();
                        //print_r($model->getErrors());
                        if(isset($errors['aut'])){
                            echo '<div class="uk-margin uk-text-medium uk-text-left uk-padding-small uk-alert-danger" >
                                    Incorrect login or password
                                </div>';
                        }
                        ?>

                            <div class="uk-margin">
                                <div class="uk-inline uk-width-1-1">
                                    <span class="uk-form-icon" uk-icon="icon: mail"></span>
                                    <!--input class="uk-input uk-form-large" v-model="email" name="username" type="email" required-->
                                    <?= $form->field($model, 'username',['template' => '{input}', 'inputOptions'=> ( ['class' => 'uk-input uk-form-large uk-text-emphasis','placeholder'=>'Email','required'=>true])])->input('email')->label(false); ?>
                                </div>
                            </div>
                            <div class="uk-margin">
                                <div class="uk-inline uk-width-1-1">
                                    <span class="uk-form-icon" uk-icon="icon: lock"></span>
                                    <!--input class="uk-input uk-form-large" v-model="passw" name="password" type="password" required-->
                                    <?= $form->field($model, 'password',['template' => '{input}', 'inputOptions'=> ( ['class' => 'uk-input uk-form-large  uk-text-emphasis','placeholder'=>'Password','required'=>true])])->input('password')->label(false); ?>
                                </div>
                            </div>
                            <div class="uk-margin">
                                <?= Html::submitButton('Login', ['class' => 'uk-button uk-button-primary uk-button-large uk-width-1-1', 'name' => 'login-button']) ?>
                            </div>
                            <div class="uk-text-small uk-text-center">
                                Not registered? <a href="/registration">Create an account</a>
                            </div>
                            <div class="uk-margin-top uk-text-small uk-text-center">
                                Forgot your password? <a href="/forgotpass">Password reminder</a>
                            </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
/*$script = <<< JS
    new Vue({
        el: '#app',
        data: {
            email: "",
            passw: "",
            passwLength:5,
        },
        methods:{
            enableSend:function () {
                let res = true;
                if(this.validEmail(this.email)){                    
                    if(this.passw.length>this.passwLength){
                        res = false;
                    }else{
                        res = true;
                    }
                }else{
                    res = true;
                }
                return res;
            },
            validEmail: function (email) {
              var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
              return re.test(email);
            }
        }
    });
JS;
$this->registerJs($script, yii\web\View::POS_END);*/
?>