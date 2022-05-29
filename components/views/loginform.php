<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

?>

<script src="/js/loginform.js" type="text/javascript"></script>
<link rel="stylesheet" href="/css/loginform.css"/>




<div class="modal fade login" id="loginModal">
    <div class="modal-dialog login animated">
        <div class="modal-content">
            <div class="modal-header" style="display: block;">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <div class="modal-title" style="font-size: 30px;">Вход</div>
            </div>
            <div class="modal-body">
                <div class="box">
                    <div class="content">
                        <div class="error"></div>
                        <div class="form loginBox" style="background: #F5D847;padding:15px;">
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
                            $errors=@Yii::$app->controller->loginForm->getErrors();
                            //print_r($model->getErrors());
                            if(isset($errors['aut'])){
                                echo '<div class="uk-margin uk-text-medium uk-text-left uk-padding-small uk-alert-danger" >
                                    Неправильный Логин или Пароль
                                </div>';
                            }
                            ?>
                            <?= $form->field(Yii::$app->controller->loginForm, 'username',['template' => '{input}', 'inputOptions'=> ( ['class' => 'form-control','placeholder'=>'Email','required'=>true])])->input('email')->label(false); ?>
                            <?= $form->field(Yii::$app->controller->loginForm, 'password',['template' => '{input}', 'inputOptions'=> ( ['class' => 'form-control','placeholder'=>'Пароль','required'=>true])])->input('password')->label(false); ?>

                            <?= Html::submitButton('Войти', ['class' => 'btn btn-default btn-login', 'style'=>'background: #4A4B4D','name' => 'login-button']) ?>

                            <?php ActiveForm::end(); ?>

                        </div>
                    </div>
                </div>
                <div class="box">
                </div>
            </div>
            <div class="modal-footer">
                <div class="forgot login-footer">
 <span>
 <a href="/registration">Зарегистрируйтесь</a> для отслеживания отправлений!
 </span>
                </div>
                <div class="forgot login-footer">
 <span>Забыли пароль?
 <a href="/forgotpass">Нажмите </a> для восстановления!
 </span>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
if(isset($errors['aut'])){
    echo '<script type="text/javascript">openLoginModal();</script>';
}
?>
