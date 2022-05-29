<?php

use app\models\Clients;
use app\models\Onhandclist;
use app\widgets\Alert;
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\MyClassAsset;

MyClassAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="yandex-verification" content="ded4993738fb38cd"/>
    <meta name="google-site-verification" content="Uqmm2xBKr2GcMLGJ7nYYQCEOzeeQ_QxODsQP0Fa3ljg"/>
    <meta name="description" content="<?= $description ?>">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>

    <link rel="icon" type="image/png" href="/favicon.png"/>
    <!--<link rel="stylesheet" href="/css/bootstrap.4.1.1.min.css">
    <link rel="stylesheet" href="/css/main.css?9">-->
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<?php
$username='';
if (!Yii::$app->user->isGuest) {
    $username = Yii::$app->user->identity->username;
}
?>

<div class="header" id="head_hidden" style="">


    <div class="col-lg-8 col-md-12">
        <nav class="navbar navbar-expand-lg navbar-dark bg" style="background: #ffda31;z-index: 10;">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
                    aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <?php

            if (Yii::$app->user->isGuest) {
                echo '<a href="/" style="max-width: 50%;"><img class="d-sm-none" src="/img/logo-concord.webp" alt=""></a>';
            }else {
                ?>
                <span class="uk-text-bold" style="color:white;">
            <?= $username ?>
                </span>
                <?php
            }
            ?>
            <!-- small -->
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar_hidden" style="flex-direction: column">
                    <li class="nav-item">
                        <a href="/onhanda" class="act">Грузы на складе</a>
                    </li>
                    <li class="nav-item">
                        <a href="/onhandc">Грузы, готовые к отправке</a>
                    </li>
                    <li class="nav-item">
                        <a href="/orders">Заказы</a>
                    </li>
                    <li class="nav-item">
                        <a href="/mydata">Данные аккаунта</a>
                    </li>
                    <li class="nav-item">
                        <a href="/changepassword">Изменить пароль</a>
                    </li>
                    <li class="nav-item">
                        <a href="/logout"> Выход</a>
                    </li>
                </ul>

            </div>
        </nav>
    </div>


</div>
<section id="contacts" class="d-none d-md-block">
    <div class="container">

        <div class="row">

            <div class="col-lg-4 col-md-4 col-sm-6">

                <div class="logo_logistic" style="">
                    <a href="/" style="text-decoration: none">
                        <div class="logo_title" style="">
                            все услуги международной логистики
                        </div>
                        <div class="logo_logistic_first">
                            <img src="/img/logo-concord.webp" alt="" style="">
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 d-none d-md-block">
                <?php

                if (Yii::$app->user->isGuest) {
                    /**
                     * Вход в ЛК
                     */

                    ?>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4 ">
                                <button class="btn btn-secondary btn-lg " type="button"
                                        style="margin-top: 30px; border: 1px solid #DCDCDC;background: #ffda31;color: black;font-weight: normal;"
                                        onclick="openLoginModal();">
                                    &nbsp;&nbsp;Вход&nbsp;&nbsp;

                                </button>
                                <div>
                                    <a class=" " href="/registration"
                                       style="margin-top: 5px; color: black;font-weight: normal;"
                                       role="button">Регистрация</a>
                                </div>
                            </div>

                        </div>
                    </div>
                    <?php

                } else {
                    $actionId = $this->context->action->id;
                    $activeStyle=[5];
                    switch ($actionId){
                        case 'onhandc':
                            $activeStyle[1]='color: white; background: #c9b034;';
                            break;
                        case 'orders':
                            $activeStyle[2]='color: white; background: #c9b034;';
                            break;
                        case 'mydata':
                            $activeStyle[3]='color: white; background: #c9b034;';
                            break;
                        case 'changepassword':
                            $activeStyle[4]='color: white; background: #c9b034;';
                            break;
                        default:
                            $activeStyle[0]='color: white; background: #c9b034;';
                            break;
                    }
                    /**
                     * Выпадающее Меню Личного кабинета
                     */
                    ?>
                    <div class="btn-group">
                        <a class="btn btn-secondary btn-lg text-center"  href="/logout" aria-haspopup="true" aria-expanded="false"
                                style="margin-top: 20px; border: 1px solid #DCDCDC;background: #ffffff;color: black;font-weight: normal;">
                            <div>Выход </div>
                            <div><?= Yii::$app->user->identity->username ?></div>
                        </a>
                    </div>
                    <?php
                }
                ?>
            </div>
            <div class="col-lg-4 col-md-4 ">
                <div class="contact_content d-none d-md-block">
                    <div class="contacts_office" style="color: #4a4a4a; ;">

                        <div class="langue_russia">

                            <a href="" id="russia"><img class="images"
                                                        src="/img/Russia.png"
                                                        alt="" style=" "></a>
                        </div>
                        <div class="off-text d-flex">
                            <div>
                                <img src="/img/icon01.png" alt=""
                                     style="height: 25px; ">
                            </div>

                            <div class="contacts_office__russia" style="line-height: 20px; ">
                                <p><span class="office">Офис в России:</span><a href="callto:+79261899903"
                                                                                style="color: #4a4a4a;"
                                                                                class="num-phone">+7 926 18-999-03</a>
                                    <br>
                                    <span>
                           <a href="" class="small"> Москва Киевское ш. БП "Румянцево"</a>
                        </span>

                                </p>

                            </div>
                        </div>
                    </div>
                    <div class="contacts_office  d-flex" style="">
                        <div class="langue_usa" style="">
                            <a href="" id="usa"><img class="images"
                                                     src="/img/United-States.png" alt=""
                                                     style=""></a>

                        </div>
                        <div class="off-text d-flex">
                            <div>
                                <img src="/img/icon01.png" alt=""
                                     style="height: 25px; ">
                            </div>

                            <div class="contacts_office__russia" style="line-height:20px; ">
                                <p><span class="office">Офис в США:</span><a href="callto:+19086552600"
                                                                             style="color: #4a4a4a;"
                                                                             class="num-phone">1-908-6552600</a> <br>
                                    <span>
                          <a href="" class="small">230 West 38th Street, 14th Floor, New York, <br> NY, 10018</a>
                        </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</section>
<!-- Large -->
<section id="head_visible" style="">
    <div class="row">
        <div class="col-lg-12">
            <ul class="navbar_visible"
                style="padding-top: 0px;padding-bottom: 0px;position: relative;right: auto;width: auto;">

                <li class="nav-item">
                    <a href="/onhanda" class="nav-link active" style="<?=$activeStyle[0]?>">Грузы на складе</a>
                </li>
                <li class="nav-item">
                    <a href="/onhandc" class="nav-link" style="<?=$activeStyle[1]?>">Грузы, готовые к отправке</a>
                </li>
                <li class="nav-item">
                    <a href="/orders" class="nav-link" style="<?=$activeStyle[2]?>">Заказы</a>
                </li>
                <li class="nav-item">
                    <a href="/mydata" class="nav-link" style="<?=$activeStyle[3]?>">Данные аккаунта</a>
                </li>
                <li class="nav-item">
                    <a href="/changepassword" class="nav-link" style="<?=$activeStyle[4]?>">Изменить пароль</a>
                </li>
            </ul>

        </div>
    </div>
</section>
<div style="margin-top: 50px;"></div>


<?= $content ?>
<?php
if (Yii::$app->user->isGuest) {
    echo '<div class="container d-sm-none">
                        <div class="row">
                            <div class="col-md-4 col-md-offset-4 ">
                                <button class="btn btn-secondary btn-lg " type="button"
                                        style="margin-top: 30px; border: 1px solid #DCDCDC;background: #ffda31;color: black;font-weight: normal;"
                                        onclick="openLoginModal();">
                                    &nbsp;&nbsp;Вход&nbsp;&nbsp;

                                </button>
                                <div>
                                    <a class=" " href="/registration"
                                       style="margin-top: 5px; color: black;font-weight: normal;"
                                       role="button">Регистрация</a>
                                </div>
                            </div>

                        </div>
                    </div>';
    echo '<div class="container" style="margin-top: 100px;" >
            <div class="row justify-content-center">
                <div class="col-md-6"><h3 style="">Необходимо войти в Личный кабинет</h3></div>
            </div>
        </div>';
}
?>

<button id="top"><i class="fas fa-arrow-up"></i></button>
<!--=======================script========================-->

<!--<script src="/js/jquery-3.0.0.min.js"></script>-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
        crossorigin="anonymous"></script>
<script src="/js/bootstrap.min.js"></script>

<script>
    jQuery.fn.exists = function () {
        return $(this).length;
    };
    var speedHide = "fast";
    var speedShow = "slow";
    if ($('#step_1_but').exists()) {
        $('#step_1_but').on('click', function () {
            $('#1_st').hide(speedHide);
            $('#step_1_but').hide(speedHide);
            $('#2_st').show(speedShow);
        });
    }
</script>

<link rel="stylesheet" href="/css/sweet-alert.css"/>


<link rel="stylesheet" href="/css/custom.css?6">


<link rel="stylesheet" href="/css/uikit.min.css?1">
<link rel="stylesheet" href="/css/theme.css?4">
<script src="/js/uikit.min.js"></script>

<script src="/js/menu.js"></script>
<script src="/js/positionScroled.js"></script>
<script src="/js/scroled.js"></script>

<script src="/js/sweet-alert.min.js"></script>
<script src="/js/main.js?9"></script>
<?php

if (Yii::$app->user->isGuest) {
    echo app\components\LoginformWidget::widget();
}

?>



<!-- Begin Verbox {literal} -->
<script type='text/javascript'>
    (function (d, w, m) {
        window.supportAPIMethod = m;
        var s = d.createElement('script');
        s.type = 'text/javascript';
        s.id = 'supportScript';
        s.charset = 'utf-8';
        s.async = true;
        var id = '639558860c8c007500d0c05ae2ed9f69';
        s.src = '//admin.verbox.ru/support/support.js?h=' + id;
        var sc = d.getElementsByTagName('script')[0];
        w[m] = w[m] || function () {
            (w[m].q = w[m].q || []).push(arguments);
        };
        if (sc) sc.parentNode.insertBefore(s, sc);
        else d.documentElement.firstChild.appendChild(s);
    })(document, window, 'Verbox');
</script>
<!-- {/literal} End Verbox -->

<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage() ?>
