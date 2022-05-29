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

<div class="header" id="head_hidden" style="">



    <div class="col-lg-4 col-md-12">
        <div class="free_call">`
            <div class="img">
                <img src="/img/tel.png" alt="">
            </div>
            <div class="telephone_free">
                <span class="size">Мы доступны в <a href="https://wa.me/79261899903"
                                                    class="whatsapp">WhatsApp</a> и в <a
                        href="viber://pa?chatURI=concordlogistic" class="viber">Viber</a></span>

                <div class="tel">
                    <a href="callto:+79261899903">+7 926 18-999-03</a>
                </div>
            </div>
        </div>
    </div>


</div>


<section id="contacts">
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
            <div class="col-lg-4 col-md-4 col-sm-6">
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

                    /**
                     * Выпадающее Меню Личного кабинета
                     */
                    ?>
                    <div class="btn-group">
                        <button class="btn btn-secondary btn-lg text-center" type="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false"
                                style="margin-top: 20px; border: 1px solid #DCDCDC;background: #ffffff;color: black;font-weight: normal;">
                            <div>Личный кабинет &#9660;</div>
                            <div><?= Yii::$app->user->identity->username ?></div>

                        </button>

                        <div class="dropdown-menu col-lg-12">
                            <a class="dropdown-item" href="/mydata">Данные Аккаунта</a>
                            <a class="dropdown-item" href="/changepassword">Изменить пароль</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="/logout">Выход</a>
                        </div>
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


<section id="head_visible" style="">
    <div class="row">
        <div class="bg-image"></div>

        <div class="col-lg-4 col-md-5 col-sm-12 col-sm-12">
            <div class="free_content">
                <div class="free_call">`
                    <div class="img">
                        <img src="/img/tel.png" alt="">
                    </div>
                    <div class="telephone_free">
                        <span class="size">Мы доступны в <a href="https://wa.me/79261899903"
                                                            class="whatsapp">WhatsApp</a> и в <a
                                href="viber://pa?chatURI=concordlogistic" class="viber">Viber</a></span>

                        <div class="tel">
                            <a href="callto:+79261899903">+7 926 18-999-03</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
<div class="col-lg-4 col-md-5 col-sm-12 ">
    <div class="free_content_hidden">
        <div class=" free_call__hidden">`
            <div class="img">
                <img src="/img/tel.png" alt="">
            </div>
            <div class="telephone_free">
                <span class="size">Мы доступны в <a href="https://wa.me/79261899903"
                                                    class="whatsapp">WhatsApp</a> и в <a
                        href="viber://pa?chatURI=concordlogistic" class="viber">Viber</a></span>

                <div class="tel">
                    <a href="callto:+79261899903">+7 926 18-999-03</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $content ?>


<footer id="newsletter">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="newsletter_right">
                    <h5 class="newsletter_title">
                        Наши партнеры:
                    </h5>
                    <div class="newsletter_item__partners ">
                        <div class="logo_partners" style=""><a href=""><img
                                    src="/img/sudohodnaya-kompaniya.jpg" alt=""></a>
                        </div>
                        <div class="logo_partners" style=""><a href=""><img
                                    src="/img/aeroflot.png" alt=""></a></div>
                        <div class="logo_partners" style=""><a href=""><img
                                    src="/img/FedEx-logo-big-min.jpeg" alt=""></a>
                        </div>
                    </div>
                    <div class="newsletter_item__partners ">
                        <div class="logo_partners" style=" padding-top: -10px"><a href=""><img
                                    src="/img/lufthansa.png" alt=""></a></div>

                        <div class="logo_partners" style=""><a href=""><img
                                    src="/img/og-turkish-airlines-2015.png" alt=""></a>
                        </div>
                    </div>

                    <div class="credits"><span>Concord </span>Logistic© 2018 | Правовая информация</div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12">
                <div class="newsletter_left ">
                    <div class="newsletter_adres__first d-flex">
                        <div class="adres_first__img">
                            <img src="/img/icon01.png" alt="">
                        </div>
                        <p class="adres_first__text" style="text-transform: uppercase">
                            Москва Киевское ш. БП "Румянцево" <br>
                            строение 4, офис 401е <br>
                            russian@concord-logistic.com
                        </p>
                    </div>

                    <div class="social ">
                        <a href="https://www.instagram.com/concord_logistic" class="social_item">
                            <i class="fab fa-instagram"></i>


                        </a>
                        <a href="https://twitter.com/ConcordLogistic" class="social_item">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://www.facebook.com/Concord-Logistic-2236407973248851" class="social_item">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
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
<!-- Yandex.Metrika counter -->
<script type="text/javascript">
    (function (m, e, t, r, i, k, a) {
        m[i] = m[i] || function () {
            (m[i].a = m[i].a || []).push(arguments)
        };
        m[i].l = 1 * new Date();
        k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
    })
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(44445358, "init", {
        clickmap: true,
        trackLinks: true,
        accurateTrackBounce: true,
        webvisor: true,
        ecommerce: "dataLayer"
    });
</script>
<noscript>
    <div><img src="https://mc.yandex.ru/watch/44445358" style="position:absolute; left:-9999px;" alt=""/></div>
</noscript>
<!-- /Yandex.Metrika counter -->

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-131505091-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
        dataLayer.push(arguments);
    }

    gtag('js', new Date());
    gtag('config', 'UA-131505091-1');
</script>
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
