<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use app\assets\MyClassAsset;
use app\models\UrlContent;

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
    <?php
    $this->registerCsrfMetaTags()
    ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="icon" type="image/png" href="/favicon.png"/>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="header" id="head_hidden" style="">


    <div class="col-lg-8 col-md-12">
        <nav class="navbar navbar-expand-lg navbar-dark bg" style="background: #ffda31;">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02"
                    aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <img class="d-sm-none" src="/img/logo-concord.webp" alt="" style="max-width: 50%;">
<!-- small -->
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar_hidden" style="flex-direction: column">
                    <li class="nav-item">
                        <a href="/" class="" >главная</a>
                    </li>
                    <li class="dropdown dt-style ">
                        <a  class=""  href="/" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">О компании
                            <span id="toggle"></span></a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <li><a href="/about.php">Кто мы</a>
                            </li>
                            <li><a href="/question.php">Вопрос-ответ</a>
                            </li>
                            <li><a href="/revievs.php">Отзывы клиентов</a>
                            </li>
                        </ul>
                    </li>


                    <li class="dropdown ds-style">
                        <a class="" data-toggle="dropdown" id="dropdownMenuLink1" href="" aria-haspopup="true" aria-expanded="false">услуги</a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink1">

                            <li><a href="/services/services.php">Авиаперевозки из США </a>
                            </li>
                            <li><a href="/services/shipping.php">Морские перевозки из США </a>
                            </li>
                            <li><a href="/services/groupage.php">Сборные грузы  </a>
                            </li>
                            <li><a href="/services/general.php"> Генеральные грузы FCL</a></li>
                            <li><a href="/pages/general_cargo.html"> Генеральные грузы</a></li>
                            <li><a href="/services/mult.php">Мультимодальные перевозки  </a></li>

                            <!--  <li><a href="#" >Доставка из США в Европу </a> </li>-->
                            <li><a href="/services/autocarriage.php">Автоперевозки по США </a></li>

                            <li><a href="/services/consolidation.php">Консолидация и хранение</a></li>
                            <li><a href="/services/repacking.php">Переупаковка</a></li>
                        </ul>
                    </li>

                    <li class="dropdown dp-style">
                        <a class="" data-toggle="dropdown" href="#" id="dropdownMenuLink2" aria-haspopup="true" aria-expanded="false">грузы <span id="toggle"></span></a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink2">
                            <li><a href="/delivery/delivery_spare_parts.php" class="ipa">Доставка  автозапчастей из
                                    Америки </a>
                            </li>
                            <li><a href="/delivery/delivery_kit.php">Доставка комплектующих из Америки </a>
                            </li>
                            <li><a href="/delivery/delivery_furniture.php"> Доставка мебели из Америки  </a></li>
                            <li><a href="/delivery/delivery_toys.php">Доставка игрушек из Америки  </a></li>
                            <!-- <li><a href="/delivery/delivery_footwear.php">Доставка обуви из Америки </a> </li>-->
                            <li><a href="/delivery/delivery_equipment.php">Доставка оборудования из Америки </a></li>
                            <!-- <li><a href="/delivery/delivery_cosmetics.php" >Доставка косметики из Америки </a> </li>-->

                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="/contact.php">контакты</a>
                    </li>
                    <li class="nav-item">
                        <a href="/onhanda">Личный кабинет</a>
                    </li>
                </ul>

            </div>
        </nav>
    </div>
    <div class="col-lg-4 col-md-12">
        <div class="free_call">`
            <div class="img">
                <img src="/img/tel.png" alt="">
            </div>
            <div class="telephone_free">
                <span class="size">Мы доступны в <a href="https://wa.me/79296510681"
                                                    class="whatsapp">WhatsApp</a> и в <a
                            href="viber://pa?chatURI=concordlogistic" class="viber">Viber</a></span>

                <div class="tel">
                    <a href="callto:+79296510681">+7 929 651-06-81</a>
                </div>
            </div>
        </div>
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
            <div class="col-lg-4 col-md-4 col-sm-6">

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
                                <p><span class="office">Офис в России:</span><a href="callto:+79296510681"
                                                                                style="color: #4a4a4a;"
                                                                                class="num-phone">+7 929 651-06-81</a>
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
        <div class="bg-image"></div>
        <div class="col-lg-8 col-md-7 d-md-block d-sm-none d-none">

            <ul class="navbar_visible">

                <li class="nav-item">

                    <a href="/" class="">главная</a>
                </li>
                <li class="dropdown dt-style ">


                    <a id="too" class=""  data-toggle="dropdown" href="/">О компании <span
                                id="toggle"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/about.php">Кто мы</a>
                        </li>

                        <li><a href="/question.php">Вопрос-ответ</a>
                        </li>
                        <li><a href="/revievs.php">Отзывы клиентов</a>
                        </li>
                    </ul>
                </li>


                <li class="dropdown ds-style">
                    <a class="" data-toggle="dropdown" href="">услуги</a>
                    <ul class="dropdown-menu">

                        <li><a href="/services/services.php">Авиаперевозки из США </a>
                        </li>
                        <li><a href="/services/shipping.php">Морские перевозки из США </a>
                        </li>
                        <li><a href="/services/groupage.php">Сборные грузы  </a>
                        </li>
                        <li><a href="/services/general.php"> Генеральные грузы FCL</a></li>
                        <li><a href="/pages/general_cargo.html"> Генеральные грузы</a></li>
                        <li><a href="/services/mult.php">Мультимодальные перевозки  </a></li>

                        <!-- <li><a href="#" >Доставки из США в Европу </a> </li>-->
                        <li><a href="/services/autocarriage.php">Автоперевозки по США </a></li>

                        <li><a href="/services/consolidation.php">Консолидация и хранение</a></li>
                        <li><a href="/services/repacking.php">Переупаковка</a></li>
                    </ul>
                </li>

                <li class="dropdown dp-style">
                    <a  class="" data-toggle="" href="#">грузы <span id="toggle"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/delivery/delivery_spare_parts.php" class="ipa">Доставка  автозапчастей из
                                Америки </a>
                        </li>
                        <li><a href="/delivery/delivery_kit.php">Доставка комплектующих из Америки </a>
                        </li>
                        <li><a href="/delivery/delivery_furniture.php"> Доставка мебели из Америки  </a></li>
                        <li><a href="/delivery/delivery_toys.php">Доставка игрушек из Америки  </a></li>

                        <li><a href="/delivery/delivery_equipment.php">Доставка оборудования из Америки </a></li>


                    </ul>
                </li>
                <li class="nav-item">
                    <a href="/contact.php">контакты</a>
                </li>
                <li class="nav-item">
                    <a href="/onhanda">Личный кабинет</a>
                </li>
            </ul>

        </div>
        <div class="col-lg-4 col-md-5 col-sm-12 col-sm-12">
            <div class="free_content">
                <div class="free_call">`
                    <div class="img">
                        <img src="/img/tel.png" alt="">
                    </div>
                    <div class="telephone_free">
                        <span class="size">Мы доступны в <a href="https://wa.me/79296510681"
                                                            class="whatsapp">WhatsApp</a> и в <a
                                    href="viber://pa?chatURI=concordlogistic" class="viber">Viber</a></span>

                        <div class="tel">
                            <a href="callto:+79296510681">+7 929 651-06-81</a>
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
                <span class="size">Мы доступны в <a href="https://wa.me/79296510681"
                                                    class="whatsapp">WhatsApp</a> и в <a
                            href="viber://pa?chatURI=concordlogistic" class="viber">Viber</a></span>

                <div class="tel">
                    <a href="callto:+79296510681">+7 929 651-06-81</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $content ?>

<?
$url = str_replace(['&edit=1', '?edit=1'], '', $_SERVER['REQUEST_URI']);
$urlcontentObject = UrlContent::findOne(['url' => $url, 'website' => 2]);
if (!$urlcontentObject){
    $urlcontentObject = new UrlContent();
    $urlcontentObject->url = $url;
}
$isAvailableEdit = Yii::$app->user->id == 45795 &&
    isset($_GET['edit']) &&
    $_GET['edit'] == 1;
if ($isAvailableEdit){?>
    <script src="/js/tinymce/tinymce.min.js"></script>
    <script type="text/javascript">
        tinymce.init({
            language: "ru",
            selector: '.textarea_content',
            height: 300,
            theme: 'modern',
            plugins: [
                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools codesample'
            ],
            toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
            image_advtab: true,
            templates: [
                { title: 'Test template 1', content: 'Test 1' },
                { title: 'Test template 2', content: 'Test 2' }
            ],
            content_css: [
                '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                '//www.tinymce.com/css/codepen.min.css'
            ]
        });
    </script>
    <div class="content">
        <section class="container">
            <div class="row">
                <div class="text-form">
                    <?php $form = ActiveForm::begin(['action' => '/site/urlcontent']); ?>
                    <?=$form->field($urlcontentObject, 'url')->hiddenInput();?>
                    <?=$form->field($urlcontentObject, 'before_content')->textarea(['class' => 'textarea_content'])?>
                    <?=$form->field($urlcontentObject, 'content')->textarea(['class' => 'textarea_content'])?>
                    <?=$form->field($urlcontentObject, 'after_content')->textarea(['class' => 'textarea_content'])?>
                    <div class="form-group">
                        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
                    </div>
                    <?php ActiveForm::end(); ?>
                    <a href="<?=$_SERVER['HTTP_REFERER']?>">Отменить</a>
                </div>
            </div>
        </section>
    </div>
<?}
else{
if ($urlcontentObject->content || $urlcontentObject->before_content || $urlcontentObject->after_content){?>
    <div class="content">
        <section class="container">
            <div class="row">
                <div id="url_content_wrap">
                    <?if ($urlcontentObject->before_content){?>
                        <?=$urlcontentObject->before_content?>
                    <?}?>
                    <?if ($urlcontentObject->content){?>
                        <div id="url_content">
                            <?=$urlcontentObject->content?>
                        </div>
                        <a href="#" id="showUrlContent">Показать</a>
                    <?}?>
                    <?if ($urlcontentObject->after_content){?>
                        <?=$urlcontentObject->after_content?>
                    <?}?>

                </div>
            </div>
        </section>
    </div>
<?}?>
<?if (Yii::$app->user->id == 45795){
$href = $_SERVER['REQUEST_URI'];
if (preg_match('/\?/', $href)) $href .= '&edit=1';
else $href .= '?edit=1';
?>
    <a id="editTags" href="<?=$href?>">Edit tags</a>
<?}?>
    <script>
        $('#showUrlContent').on('click', function(e){
            e.preventDefault();
            const $th = $(this);
            $th.prev().toggleClass('active_1');
        })
    </script>
<?}?>

<footer id="newsletter">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="newsletter_right">
                    <h5 class="newsletter_title" style="line-height: 35px;">
                        Наши партнеры по доставке грузов из США:
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
                    <div style="margin-top: 10px">Данный сайт использует <a href="/cookie_policy">cookie</a>. Ознакомьтесь с <a href="/terms_and_conditions_of_personal_data">условиями конфиденциальности.</a>
                    </div>
                    <div class="credits" style="margin-top: 10px"><span>Concord </span>Logistic© 2018 | Правовая информация</div>
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
