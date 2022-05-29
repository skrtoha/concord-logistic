<?php

use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;

if (!Yii::$app->user->isGuest) {
?>
    <div id="app1" class="container" style="margin-top: 150px;" v-cloak>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">Данные аккаунта</div>
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
                                <label for="phone" class="cols-sm-2 control-label">Телефон</label>
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
                                <label for="companyName" class="cols-sm-2 control-label">Организация</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-users fa"
                                                                       aria-hidden="true"></i></span>
                                        <?= $form->field($model, 'companyName', ['template' => '{input}', 'inputOptions' => (['class' => 'uk-input uk-form-medium', 'v-model' => 'confFirm', 'placeholder' => 'Организация'])])->input('text')->label(false); ?>
                                        <!--<input type="text" class="form-control" name="username" id="username"
                                               placeholder="Enter your Username"/>-->
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="address" class="cols-sm-2 control-label">Адрес</label>
                                <div class="cols-sm-10">
                                    <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-users fa"
                                                                       aria-hidden="true"></i></span>
                                        <?= $form->field($model, 'address')->textarea(['rows' => 3, 'class' => 'uk-textarea', 'v-model' => 'confAddr', 'placeholder' => 'Адрес', 'style' => 'padding-left: 40px;'])->label(false); ?>
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

    <script>
        var confNm = `<?=str_replace("`", "", Yii::$app->user->identity->name)?>`;
        var confPh = `<?=str_replace("`", "", Yii::$app->user->identity->phone)?>`;
        var confF = `<?=str_replace("`", "", Yii::$app->user->identity->firmname)?>`;
        var confA = `<?=str_replace("`", "", Yii::$app->user->identity->address)?>`;
    </script>
<?php

$script = <<< JS
    new Vue({
        el: '#app1',
        data: {
            email: "",
            passw: "",
            confPassw:"",
            verifyCode:"",
            confName:confNm,
            confPhone:confPh,
            confFirm:confF,
            confAddr:confA,
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
                if(this.verifyCode.length>2){
                    this.hasErrorVerify=false;
                }else{
                    this.hasErrorVerify=true;
                } 
                if(!this.hasErrorVerify && this.confName.length>0 && this.confPhone.length>4){
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