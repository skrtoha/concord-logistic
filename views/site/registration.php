<?php

use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;

?>

    <div id="app" class="container" style="margin-top: 150px;" v-cloak>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Регистрация</div>
                    <div class="card-body">
                        <?php $form = ActiveForm::begin([
                            //'id' => 'signup-form',
                            'options' => [
                                'action' => "/",
                                'class' => "form-horizontal",
                                'method' => "post",
                            ],
                            'fieldConfig' => [
                                'options' => [
                                    'tag' => false,
                                ]
                            ]
                        ]);
                        $errors = @$model->getErrors();
                        //print_r($model);
                        ?>
                        <div class="form-group">
                            <div class="cols-sm-10">
                                <div class="alert " role="alert"
                                     :class="{'alert-danger': hasErrorForm,'alert-primary': !hasErrorForm}">
                                    {{hasErrorForm?"Выделенные поля обязательны для заполнения":"Все поля заполнены!"}}
                                </div>
                            </div>
                        </div>
                        <?php
                        foreach ($errors as $error => $val) {
                            echo '<div class="alert alert-danger" :hidden="!hasErrorVerify">
                                ' . $val[0] . '</div>';
                        }
                        ?>
                        <!--<form class="form-horizontal" method="post" action="#">-->
                        <div class="form-group">
                            <label for="email" class="cols-sm-2 control-label">Email</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                                    <?= $form->field($model, 'username', ['template' => '{input}', 'inputOptions' => (['class' => 'uk-input uk-form-medium', ':class' => "{'uk-form-danger': hasErrorEmail}", 'placeholder' => 'Email', 'v-model' => 'email', 'required' => true])])->input('email')->label(false); ?>
                                    <!--<input type="text" class="form-control" name="email" id="email"
                                           placeholder="Enter your Email"/>-->
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="cols-sm-2 control-label">Пароль</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                    <?= $form->field($model, 'password', ['template' => '{input}', 'inputOptions' => (['class' => 'uk-input uk-form-medium', ':class' => "{'uk-form-danger': hasErrorPass}", 'v-model' => 'passw', 'placeholder' => 'Пароль', 'uk-tooltip' => 'title: 4 или больше символов; pos: right; offset:-130', 'required' => true])])->input('password')->label(false); ?>
                                    <!--<input type="password" class="form-control" name="password" id="password"
                                           placeholder="Enter your Password"/>-->
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="confirm" class="cols-sm-2 control-label">Подтвердите пароль</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                                    <?= $form->field($model, 'confirmPassword', ['template' => '{input}', 'inputOptions' => (['class' => 'uk-input uk-form-medium', ':class' => "{'uk-form-danger': hasErrorConfirm}", 'v-model' => 'confPassw', 'placeholder' => 'Подтвердите пароль', 'required' => true])])->input('password')->label(false); ?>
                                    <!--<input type="password" class="form-control" name="confirm" id="confirm"
                                           placeholder="Confirm your Password"/>-->
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="name" class="cols-sm-2 control-label">ФИО</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa"
                                                                       aria-hidden="true"></i></span>
                                    <?= $form->field($model, 'name', ['template' => '{input}', 'inputOptions' => (['class' => 'uk-input uk-form-medium', ':class' => "{'uk-form-danger': confName.length==0?true:false}", 'v-model' => 'confName', 'placeholder' => 'ФИО', 'required' => true])])->input('text')->label(false); ?>
                                    <!--<input type="text" class="form-control" name="name" id="name"
                                           placeholder="Enter your Name"/>-->
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="username" class="cols-sm-2 control-label">Телефон</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-users fa"
                                                                       aria-hidden="true"></i></span>
                                    <?= $form->field($model, 'phone', ['template' => '{input}', 'inputOptions' => (['class' => 'uk-input uk-form-medium', ':class' => "{'uk-form-danger': confPhone.length==0?true:false}", 'v-model' => 'confPhone', 'placeholder' => 'Телефон', 'required' => true])])->input('text')->label(false); ?>
                                    <!--<input type="text" class="form-control" name="username" id="username"
                                           placeholder="Enter your Username"/>-->
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username" class="cols-sm-2 control-label">Организация</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-users fa"
                                                                       aria-hidden="true"></i></span>
                                    <?= $form->field($model, 'companyName', ['template' => '{input}', 'inputOptions' => (['class' => 'uk-input uk-form-medium', 'v-model' => 'firm', 'placeholder' => 'Организация'])])->input('text')->label(false); ?>
                                    <!--<input type="text" class="form-control" name="username" id="username"
                                           placeholder="Enter your Username"/>-->
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="username" class="cols-sm-2 control-label">Адрес</label>
                            <div class="cols-sm-10">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-users fa"
                                                                       aria-hidden="true"></i></span>
                                    <?= $form->field($model, 'address')->textarea(['rows' => 3, 'class' => 'uk-textarea', 'v-model' => 'addr', 'placeholder' => 'Адрес', 'style' => 'padding-left: 40px;'])->label(false); ?>
                                    <!--<input type="text" class="form-control" name="username" id="username"
                                           placeholder="Enter your Username"/>-->
                                </div>
                            </div>
                        </div>

                        <div class="form-group ">
                            <?=
                            $form->field($model, 'captcha')->widget(Captcha::className(), [
                                'imageOptions' => [
                                    'id' => 'captcha-image'
                                ],
                                'captchaAction' => ['/site/captcha'],
                                'options' => ['class' => 'uk-input uk-form-medium', ':class' => "{'uk-form-danger': hasErrorVerify}", 'v-model' => 'verifyCode', 'placeholder' => 'Проверочный код', 'required' => true],
                                'template' => '
                                    <div class="uk-margin uk-grid">
                                        <div class="uk-width-1-2@s" style="width: 50%">{image} <span id="refresh-captcha" class="uk-icon" uk-icon="icon:  refresh"></span></div>
                                        <div class="uk-inline uk-width-1-2@s" style="width: 50%">
                                            <span class="uk-form-icon uk-form-icon-flip" uk-icon="icon:  image"></span>
                                            {input}
                                        </div>
                                    </div>',
                            ])->label(false);
                            ?>
                            <?= Html::submitButton('Зарегистрироваться', ['class' => 'btn btn-warning btn-lg btn-block login-button', ':disabled' => "enableSend()", 'name' => 'create-button']) ?>
                            <!--<button type="button" class="btn btn-primary btn-lg btn-block login-button">Зарегистрироваться
                            </button>-->
                        </div>
                        <!--</form>-->
                        <?php ActiveForm::end(); ?>
                    </div>

                </div>
            </div>
        </div>
    </div>


    <script>
        var em = '<?=$model->username?>';
        var nm = '<?=$model->name?>';
        var ph = '<?=$model->phone?>';
        var frm = '<?=$model->companyName?>';
        var addr = '<?=$model->address?>';
    </script>
<?php
$script = <<< JS
    new Vue({
        el: '#app',
        data: {
            email: em,
            passw: "",
            confPassw:"",
            verifyCode:"",
            confName:nm,
            confPhone:ph,
            firm:frm,
            addr:addr,
            hasErrorEmail:true,
            hasErrorPass:true,
            hasErrorConfirm:true,
            hasErrorVerify:true,
            hasErrorForm:true,
            iconConfirm:'icon:close',
            passwMinLength:4,
        },
        methods:{
            enableSend:function () {
                if(this.validEmail(this.email)){
                    this.hasErrorEmail=false;
                }else{
                    this.hasErrorEmail=true;
                }
                if(this.passw.length>=this.passwMinLength){
                    if(this.confPassw == this.passw){
                        this.hasErrorConfirm=false;
                        this.iconConfirm='icon:check';
                    }else{
                        this.iconConfirm='icon:close';
                        this.hasErrorConfirm=true;
                    }
                    this.hasErrorPass=false;
                }else{
                    this.hasErrorPass=true;
                }
                if(this.verifyCode.length>2){
                    this.hasErrorVerify=false;
                }else{
                    this.hasErrorVerify=true;
                } 
                if(!this.hasErrorEmail && !this.hasErrorConfirm && !this.hasErrorVerify){
                    this.hasErrorForm=false;
                }else{
                    this.hasErrorForm=true;
                }
                return this.hasErrorForm;
            },
            validEmail: function (email) {
              var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
              return re.test(email);
            }
        }
    });
JS;
$this->registerJs("
    $('#refresh-captcha').on('click', function(e){
        //e.preventDefault();
        $('#captcha-image').yiiCaptcha('refresh');
    })
");
$this->registerJs($script, yii\web\View::POS_END);
?>