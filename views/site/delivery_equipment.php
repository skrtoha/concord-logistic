<?php

$this->title = 'Доставка оборудования из Америки. Тяжеловесные и сложные грузы';
$this->registerMetaTag(
    ['name' => 'description', 'content' => 'Concord Logstic специализируется на доставке сложного тяжеловесного оборудования из США. Решаем любые задачи с поставками оборудования для крупных промышленных объектов, производственных компаний, торговых и пищевых точек.']
);
?>
<section id="ways_second" style="">

    <div class="container">
        <div class="row">

            <div class="co-lg-3 col-md-5">
                <div class="ways_item ">
                    <img src="/img/page-1.webp" alt="" style="border-radius: 50%; ">
                </div>
            </div>
            <div class="col-lg-7 col-md-7">
                <div class="ways_content ">
                    <h1 class="ways_title">
                        Доставка оборудования из Америки
                    </h1>
                    <div class="line"></div>
                    <p class="ways_text ">
                        Concord Logstic специализируется на доставке сложного тяжеловесного оборудования из США. Решаем
                        любые задачи с поставками оборудования для крупных промышленных объектов, производственных
                        компаний, торговых и пищевых точек. Многолетний опыт работы наших сотрудников позволяет
                        предлагать нашим клиентом наиболее оптимальные и экономичные схемы доставки.
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
                        </h2>
                        <div class="line"></div>
                        <p class="ways_text">
                            К услугам наших клиентов – авиа- и морские контейнерные перевозки. Авиадоставка оборудования
                            подойдет для тех, кому нужны сжатые сроки, а для тех, кому важнее цена, или же требуется
                            перевозка негабаритных грузов – мы предлагаем доставку морем. Наша компания предлагает как
                            разовые перевозки, так и систематические поставки оборудования на постоянной основе.
                        </p>
                    </div>
                </div>
                <div class="co-lg-3 col-md-5">
                    <div class="ways_item__ship ">
                        <img src="/img/page-2.webp" alt="" style="border-radius: 50%;">
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
                <?= app\components\CalcWidget::widget(['titleCalc' => 'Рассчитать стоимость доставки оборудования из Америки.<br>Промо-тарифы на авиадоставку из США:'])?>

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
                    <h3 class="specialize-block_title">
                        Мы доставляем из США
                    </h3>
                    <div class="line_second">

                    </div>
                    <ul class="specialize-block_text">
                        <li class="gray-list"><span>Строительные материалы и техника</span></li>
                        <li class="gray-list"><span>Нефтяное и газовое оборудование</span></li>
                        <li class="gray-list"><span>Металлопрокат</span></li>
                        <li class="gray-list"><span>Лакокрасочное оборудование и расходные материалы</span></li>
                        <li class="gray-list"><span>Оборудование для торговых точек</span></li>
                        <li class="gray-list"><span>Оборудование для пищевых предприятий</span></li>
                        <li class="gray-list"><span>Электрооборудование и светодиодные изделия</span></li>
                        <li class="gray-list"><span>И многое другое.</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 animated mov2" data-mov2-delay=.3s;
                 style=" visibility: visible; animation-delay: 0.3s;">
                <div class="specialize-block">
                    <h2 class="specialize-block_title">
                        Услуги по доставке оборудования:
                    </h2>
                    <div class="line_second">

                    </div>
                    <ul class="specialize-block_text">
                        <li class="gray-list"><span>Авиадоставка из США</span></li>
                        <li class="gray-list"><span>Морские контейнерные перевозки</span></li>
                        <li class="gray-list"><span>Мультимодальные перевозки и сборные грузы</span></li>
                        <li class="gray-list"><span>Согласованный график поставки</span></li>
                        <li class="gray-list"><span>Решение любых сложных задач</span></li>
                        <li class="gray-list"><span>Минимизация стоимости</span></li>
                        <li class="gray-list"><span>Ответственное складское хранение</span></li>
                        <li class="gray-list"><span>Консолидация грузов, переупаковка</span></li>
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