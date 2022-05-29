<?php

use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;

if (!Yii::$app->user->isGuest) {
?>
    <div id="app" class="container" style="margin-top: 150px;" v-cloak>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Изменить пароль</div>
                    <div class="card-body">
                        <?php
                        if (!Yii::$app->user->isGuest) {
                            ?>
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
                            ?>

                            <?php
                            if (Yii::$app->session->getFlash('successUpdData')) {
                                ?>
                                <div class="uk-margin uk-text-medium uk-text-left uk-padding-small uk-alert-success">
                                    <?php echo Yii::$app->session->getFlash('successUpdData'); ?>
                                </div>
                                <?php
                            }

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
                            <div class="form-group">
                                <label for="password" class="cols-sm-2 control-label">Новый пароль</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-user fa"
                                                                       aria-hidden="true"></i></span>
                                        <?= $form->field($model, 'newPassword', ['template' => '{input}', 'inputOptions' => (['class' => 'uk-input uk-form-medium', ':class' => "{'uk-form-danger': hasErrorPass}", 'v-model' => 'passw', 'placeholder' => 'Новый пароль', 'uk-tooltip' => 'title: 4 или больше символов; pos: right; offset:-130', 'required' => true])])->input('password')->label(false); ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="confirmPassword" class="cols-sm-2 control-label">Подтвердите пароль</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-users fa"
                                                                           aria-hidden="true"></i></span>
                                        <span class="uk-form-icon uk-form-icon-flip "
                                              :class="{'uk-text-danger': hasErrorConfirm,'uk-text-primary': !hasErrorConfirm}"
                                              :uk-icon="iconConfirm"></span>
                                        <?= $form->field($model, 'confirmPassword', ['template' => '{input}', 'inputOptions' => (['class' => 'uk-input uk-form-medium', ':class' => "{'uk-form-danger': hasErrorConfirm}", 'v-model' => 'confPassw', 'placeholder' => 'Подтвердите пароль', 'required' => true])])->input('password')->label(false); ?>
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
                                <?= Html::submitButton('Обновить', ['class' => 'btn btn-warning btn-lg btn-block login-button', ':disabled' => "enableSend()", 'name' => 'create-button']) ?>

                            </div>
                            <?php
                            ActiveForm::end();
                        } else {
                            $errors = @$model->getErrors();
                            foreach ($errors as $error => $val) {
                                echo '<div class="uk-margin uk-text-medium uk-text-left uk-padding-small uk-alert-danger">
                                            ' . $val[0] . '
                                        </div>';
                            }
                        }
                        ?>
                    </div>

                </div>
            </div>
        </div>
    </div>


<?php
$script = <<< JS
    new Vue({
        el: '#app',
        data: {
            email: "",
            passw: "",
            confPassw:"",
            verifyCode:"",
            confName:"",
            confPhone:"",
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
                if( !this.hasErrorConfirm && !this.hasErrorVerify){
                    this.hasErrorForm=false;
                }else{
                    this.hasErrorForm=true;
                }
                return this.hasErrorForm;
            },
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
} 
?>