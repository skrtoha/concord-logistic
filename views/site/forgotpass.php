<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>
<div id="app" class="container" style="margin-top: 150px;">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Забыли пароль?</div>
                <div class="card-body">

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
                    if (isset($model->message) && strlen($model->message) > 5) {
                        echo '<div class="uk-margin uk-text-medium uk-text-left uk-padding-small uk-alert-primary" >
                                    ' . $model->message . '
                                </div>';
                    }
                    ?>
                    <div class="form-group">
                        <label for="email" class="cols-sm-2 control-label">Email</label>
                        <div class="cols-sm-10">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope fa"
                                                                   aria-hidden="true"></i></span>
                                <?= $form->field($model, 'username', ['template' => '{input}', 'inputOptions' => (['class' => 'uk-input uk-form-medium', 'placeholder' => 'Ваш Email', 'required' => true])])->input('email')->label(false); ?>

                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <?= Html::submitButton('Получить пароль', ['class' => 'btn btn-warning btn-lg btn-block login-button', 'name' => '']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>

