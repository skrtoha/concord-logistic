<?php

$this->title = 'Доставка автозапчастей из Америки. Рассчитать стоимость';
$this->registerMetaTag(
    ['name' => 'description', 'content' => 'Заказ и доставка запчастей из США. Запчасти для легковых американских автомобилей, американских грузовиков, спецтехники, мотоциклов, мопедов, а так же водного транспорта: яхт, катеров, гидроциклов. Доставка по воздуху и морские грузоперевозки.']
);
?>
<section id="ways_second" style="">

    <div class="container">
        <div class="row">

            <div class="co-lg-3 col-md-5">
                <div class="ways_item ">
                    <img src="/img/patron-all.webp" alt=""
                         style="border-radius: 50%; box-shadow: 0 0 3px rgba(0,0,0,0.6); padding: 5px;">
                </div>
            </div>
            <div class="col-lg-7 col-md-7">
                <div class="ways_content ">
                    <h1 class="ways_title">
                        Доставка автозапчастей <br>
                        из Америки
                    </h1>
                    <div class="line"></div>
                    <p class="ways_text ">
                        Мы предлагаем доставку автозапчастей из США для легковых американских автомобилей (Ford,
                        Chevrolet, Dodge, Jeep, Chrysler, GMC, Cadillac), доставку запчастей для американских грузовиков
                        и спецтехники. Кроме того, у нас вы можете заказать доставку любых запчастей для мопедов,
                        мотоциклов, квадроциклов, а так же водного транспорта (яхт, катеров, гидроциклов).
                    </p>
                </div>
            </div>
        </div>

    </div>
</section>
<section id="ways-options">
    <div class="ways_second">
        <div class="container">
            <div class="row">


                <div class="col-lg-7 col-md-7">
                    <div class="ways_content ">
                        <h2 class="ways_title">
                            Способы доставки

                            <br>

                        </h2>
                        <div class="line"></div>
                        <p class="ways_text">
                            К услугам наших клиентов – авиа- и морские контейнерные перевозки. Авиадоставка
                            автозапчастей подойдет для тех, кому нужны сжатые сроки, а для тех, кому важнее цена – мы
                            предлагаем доставку морем. Наша компания предлагает как разовые перевозки, так и
                            систематические поставки грузов на постоянной основе.
                        </p>
                    </div>
                </div>
                <div class="co-lg-3 col-md-5">
                    <div class="ways_item__ship ">
                        <img src="/img/avtozap2.webp" alt=""
                             style="border-radius: 50%;">
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section>

</section>
<section id="calculation">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?= app\components\CalcWidget::widget(['titleCalc' => 'Рассчитать стоимость доставки запчастей из Америки.<br>Промо-тарифы на авиадоставку из США:'])?>



            </div>

        </div>
    </div>
</section>

<section id="specialize">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 animated mov" data-mov3-delay=.3s;
                 style=" visibility: visible; animation-delay: 0.3s;">
                <div class="specialize-block">
                    <h2 class="specialize-block_title">
                        Мы доставляем запчасти для:
                    </h2>
                    <div class="line_second">

                    </div>
                    <ul class="specialize-block_text">
                        <li class="gray-list"><span>Американских легковых автомобилей</span></li>
                        <li class="gray-list"><span>Американских грузовиков</span></li>
                        <li class="gray-list"><span>Спецтехники</span></li>
                        <li class="gray-list"><span>Мотоциклов, мопедов, квадроциклов</span></li>
                        <li class="gray-list"><span>Водных транспортных средств (яхт, катеров, гидроциклов)</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 animated mov2" data-mov2-delay=.3s;
                 style=" visibility: visible; animation-delay: 0.3s;">
                <div class="specialize-block">
                    <h2 class="specialize-block_title">
                        К услугам наших клиентов:
                    </h2>
                    <div class="line_second">

                    </div>
                    <ul class="specialize-block_text">
                        <li class="gray-list"><span>Авиадоставка запчастей из США (максимально короткие
                                    сроки)
                                </span></li>
                        <li class="gray-list"><span>Морские контейнерные перевозки (низкая стоимость
                                    доставки)
                                </span></li>
                        <li class="gray-list"><span>Мультимодальные перевозки (решение любых сложных задач)
                                </span></li>
                        <li class="gray-list"><span>Систематические поставки (поддержание складских
                                    остатков)
                                </span></li>
                        <li class="gray-list"><span>Складское хранение, консолидация грузов, переупаковка</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="form_section">
    <div class="container">
        <?= app\components\ObsvWidget::widget()?>
    </div>
</section>