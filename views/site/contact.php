<?php

$this->title = 'Контакты Concord Logistic. Официальный сайт';
$this->registerMetaTag(
    ['name' => 'description', 'content' => 'Наш офис в России. Наш офис в Америке. Наш склад в США. Адреса, телефоны и схемы проезда. Обращайтесь, мы будем вам рады!']
);
?>
<link rel="stylesheet" href="/css/contact.css?1">
<div class="container">
    <div class="row">

        <div class="contacts">
            <div class="col-lg-12">
                <div class="contact_title">
                    Контакты
                </div>
                <div class="hr"></div>
            </div>
            <div class="col-lg-12">
                <div class="contact_first">
                    <div class="contact_first__title">
                        Офис в России
                    </div>
                    <div class="contact_first__adress">
                        Москва, Киевское ш. БП "Румянцево", строение 401 Е
                    </div>
                    <div class="contact_first__phone">
                        <span>Телефон:</span> +7 499 450 2544
                    </div>
                    <div class="contact_first__mail">
                        <span>E-mail:</span> russia@concord-logistic.com
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <script type="text/javascript" charset="utf-8" async
                    src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A4f3c3417eb70ed50ce7d75ca04df5c9740af1d52ec542bdf353e9baf29d39ef4&amp;width=auto&amp;height=200&amp;lang=ru_RU&amp;scroll=true"></script>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="hr"></div>
        </div>
        <div class="col-lg-12">
            <div class="contact_first " style="padding-bottom: 30px;">
                <div class="contact_first__title">
                    Офис в США
                </div>
                <div class="contact_first__adress">
                    230 West 38th Street, 14th Floor, New York, NY, 10018
                </div>
                <div class="contact_first__phone">
                    <span>Телефон:</span> +1-908-6552600
                </div>
                <div class="contact_first__mail">
                    <span>E-mail:</span> usa@concord-logistic.com
                </div>
            </div>

        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <script
                    src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=AIzaSyDbWW8YACt9y-HiRA0WP2grIKpshV2trUE"
                    type="text/javascript"></script>
            <script>
                function initialize() {
                    var myLatlng = new google.maps.LatLng(40.7537979, -73.9900212);
                    var mapOptions = {
                        zoom: 15,
                        center: myLatlng
                    };
                    var map = new google.maps.Map(document.getElementById('map'), mapOptions);

                    var marker = new google.maps.Marker({
                        position: myLatlng,
                        map: map,
                        title: 'Concord Logistic'
                    });
                }

                google.maps.event.addDomListener(window, 'load', initialize);

            </script>
            <div id="map" style='height: 200px;width:100%;max-width: 1140px;float:left;margin: 10px 0 0 0;'></div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="hr"></div>
        </div>
        <div class="col-lg-12">
            <div class="contact_first " style="padding-bottom: 30px;">
                <div class="contact_first__title">
                    Склад в США
                </div>
                <div class="contact_first__adress">
                    3556 Kennedy Rd, South Plainfield, NJ 07080, США
                </div>
            </div>

        </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <script
                    src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&key=AIzaSyDbWW8YACt9y-HiRA0WP2grIKpshV2trUE"
                    type="text/javascript"></script>
            <script>
                function initialize() {
                    var myLatlng = new google.maps.LatLng(40.5690958,-74.4257695);
                    var mapOptions = {
                        zoom: 17,
                        center: myLatlng
                    };
                    var map = new google.maps.Map(document.getElementById('map11'), mapOptions);

                    var marker = new google.maps.Marker({
                        position: myLatlng,
                        map: map,
                        title: 'Concord Logistic'
                    });
                }

                google.maps.event.addDomListener(window, 'load', initialize);

            </script>
            <div id="map11" style='height: 200px;width:100%;max-width: 1140px;float:left;margin: 10px 0 0 0;'></div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row contacts">
        <div class="col-lg-12">
        </div>
    </div>
</div>
<section class="form_section">
    <div class="container">
        <?= app\components\ObsvWidget::widget()?>
    </div>
</section>