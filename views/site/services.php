<?php

$this->title = 'Авиаперевозки грузов из США в Россию. Расчет стоимости ';
$this->registerMetaTag(
    ['name' => 'description', 'content' => 'Грузовые авиаперевозки – самый быстрый и надежный способ доставки грузов из Америки.  Маленькие и большие грузы, доставка пассажирскими и грузовыми рейсами. Сроки от 5 дней и действительно низкие цены. Быстрый расчет стоимости авиадоставки из США.']
);
?>
<section id="shipping" style="">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="">
                    <h1 class="">
                        Авиадоставка из США
                    </h1>
                </div>
                <div class="line_second">

                </div>
            </div>
            <div class="col-lg-6">
                <div class="page_img">
                    <img src="/img/avion.png" alt="" class="img-fluid" style="">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shipping_block">

                    <p>
                        Грузовые авиаперевозки – наиболее быстрый и надежный способ доставки грузов из Америки. Именно
                        поэтому авиадоставка грузов является одним из основных направлений компании Concord Logistic. Мы
                        специализируемся на регулярных поставках грузов из США на транспортных и пассажирских самолетах,
                        обеспечивая нашим клиентам максимально низкие цены и сжатые сроки. Если ваша компания нуждается
                        не в разовой доставке груза, а в систематических поставках товаров, мы сможем предложить вам
                        доставку грузов по согласованному графику на постоянной основе. Гибкая ценовая политика и
                        понимание потребностей наших клиентов позволяет Concord Logistic предлагать наиболее выгодное
                        решение для любых задач, как крупного, так и малого бизнеса.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="special">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 animated mov" data-mov3-delay=.3s;
                 style=" visibility: visible; animation-delay: 0.3s;">
                <div class="special-block">
                    <h2 class="special-block_title">
                        Авиадоставка из Америки от Concord Logistic
                    </h2>
                    <div class="line_second">

                    </div>
                    <ul class="special-block_text">


                        <li class="gray-list"><span>Один из основных видов межконтинентальной логистики</span></li>



                        <li class="gray-list"><span>Наиболее быстрый способ доставки</span></li>



                        <li class="gray-list"><span>Возможность ускоренного обслуживания</span></li>



                        <li class="gray-list"><span>Высокий уровень сохранности грузов</span></li>



                        <li class="gray-list"><span>Доставка небольших грузов пассажирскими рейсами</span></li>



                    </ul>
                </div>
            </div>
            <div class="col-lg-6 animated mov2" data-mov2-delay=.3s;
                 style=" visibility: visible; animation-delay: 0.3s;">
                <div class="special-block special-block__two">
                    <h2 class="special-block_title" style="visibility: hidden">
                        Авиадоставка из Америки от Concord Logistic
                    </h2>
                    <div class="line_second" style="visibility: hidden">

                    </div>
                    <ul class="specialize-block_text">


                        <li class="gray-list"><span>Гибкая ценовая политика</span></li>



                        <li class="gray-list"><span>Персональный менеджер для постоянных клиентов</span></li>



                        <li class="gray-list"><span>Прямые и транзитные рейсы</span></li>


                        <li class="gray-list"><span>Безопасная перевозка хрупких и ценных грузов</span></li>

                        <li class="gray-list"><span>Возможность заказать систематические поставки по графику</span>
                        </li>


                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="calculation">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="quick_calculation">
                    Быстрый расчет авиадоставки из США
                </div>
                <?php
                //echo app\components\CalcWidget::widget(['titleCalc' => 'Промо-тарифы на авиаперевозки из США:'])
                ?>
                <?= app\components\FormcalcWidget::widget()?>

                <p class="quick_credits">
                    *Стоимость авиаперевозки грузов из Америки в Россию зависит от типа товара, его объема и веса,
                    характеристик и требований к его перевозкам. Кроме того, стоимость учитывает тип самолета
                    (пассажирский или грузовой), вид перелета (прямой или транзитный), а так же варианты авиалиний. Для
                    выполнения точного расчета укажите максимально подробно характеристики груза и все свои пожелания.
                    Мы предложим вам самые выгодные условия и оптимальный маршрут!
                </p>
            </div>

        </div>
    </div>
</section>
<section id="services_second">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="">
                    <h2 class="services_title">
                        Основные преимущества авиаперевозки
                    </h2>
                </div>
            </div>
            <div class="col-lg-3 col-md-6   animated mov3" style="visibility: visible;">
                <div class="services_block  ">
                    <div class="services_block__item">
                        <div id="images">
                            <img src="/img/avia.png" alt="">
                        </div>
                    </div>
                    <h3 class="services_block__title">
                        Самая быстрая доставка
                    </h3>
                    <div class="line_second">

                    </div>
                    <p class="services_block__text">
                        Сроки <a href="/">доставки груза из США</a> в Россию - от 5 дней.
                    </p>

                </div>
            </div>
            <div class="col-lg-3 col-md-6  animated mov3" data-mov3-delay=".2s"
                 style="visibility: visible; animation-delay: 0.2s; ">

                <div class="services_block">
                    <div class="services_block__item">
                        <div id="images">
                            <img src="/img/cubick.png" alt=""
                                 style="height: 70px; margin-top: 15px; margin-left: 13px">
                        </div>
                    </div>
                    <h3 class="services_block__title">
                        Маленькие и большие грузы
                    </h3>
                    <div class="line_second">

                    </div>
                    <p class="services_block__text">
                        Доставка пассажирскими и грузовыми рейсами
                    </p>

                </div>
            </div>
            <div class="col-lg-3 col-md-6  animated mov3" data-mov3-delay=".4s"
                 style="visibility: visible; animation-delay: 0.4s; ">

                <div class="services_block">
                    <div class="services_block__item">
                        <div id="images">
                            <img src="/img/gs.png" alt=""
                                 style="height: 70px; margin-top: 16px; margin-left: 16px">
                        </div>
                    </div>
                    <h3 class="services_block__title">
                        Гарантия сохранности
                    </h3>
                    <div class="line_second">

                    </div>
                    <p class="services_block__text">
                        Безопасная перевозка даже особо хрупких и ценных грузов
                    </p>

                </div>
            </div>
            <div class="col-lg-3 col-md-6  animated mov3" data-mov3-delay=".6s"
                 style="visibility: visible; animation-delay: 0.6s; ">
                <div class="services_block ">
                    <div class="services_block__item">
                        <div id="images">
                            <img src="/img/lowest-price.png" alt=""
                                 style="height: 70px; margin-top: 20px; margin-left: 18px">
                        </div>
                    </div>
                    <h3 class="services_block__title">
                        Доступные <br> цены
                    </h3>
                    <div class="line_second">

                    </div>
                    <p class="services_block__text">
                        Мы предлагаем действительно низкие цены
                    </p>

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