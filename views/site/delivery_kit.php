<?php

$this->title = 'Доставка комплектующих из Америки.  Рассчитать стоимость';
$this->registerMetaTag(
    ['name' => 'description', 'content' => 'Специализируемся на доставке комплектующих для строительной, сельскохозяйственной, специализированной техники,  нефтяного и газового оборудования, оборудования пищевых и производственных предприятий. Быстрая доставка из США, низкие цены.']
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
                        Доставка комплектующих из Америки
                    </h1>
                    <div class="line"></div>
                    <p class="ways_text ">
                        Concord Logstic оказывает услуги по доставке комплектующих из США для специализированной и
                        строительной техники, нефтяного и газового оборудования, производственных и сельскохозяйственных
                        единиц. Решаем задачи с поставками комплектующих для крупных промышленных объектов,
                        производственных компаний, торговых и пищевых точек. Многолетний опыт работы наших сотрудников
                        позволяет предлагать нашим клиентом наиболее оптимальные и экономичные схемы доставки.
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
                    <div class="ways_content animated mov">
                        <h2 class="ways_title">
                            Способы доставки
                        </h2>
                        <div class="line"></div>
                        <p class="ways_text">
                            К услугам наших клиентов – авиа- и морские контейнерные перевозки. Авиадоставка
                            комплектующих отличается сжатыми сроками поставки, но имеет ряд ограничений. В случае, когда
                            требуется перевозка крупных и/или негабаритных грузов – мы предлагаем доставку морем. Наша
                            компания предлагает как разовые перевозки, так и систематические поставки комплектующих к
                            вашему оборудованию (на постоянной основе).
                        </p>
                    </div>
                </div>
                <div class="co-lg-3 col-md-5">
                    <div class="ways_item__ship animated mov2">
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
                <?= app\components\CalcWidget::widget(['titleCalc' => 'Рассчитать стоимость доставки комплектующих из США.<br>Промо-тарифы на авиадоставку из США:'])?>


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
                        Мы доставляем комплектующие для:
                    </h3>
                    <div class="line_second">

                    </div>
                    <ul class="specialize-block_text">
                        <li class="gray-list"><span>Строительной техники</span></li>
                        <li class="gray-list"><span>Специализированной техники</span></li>
                        <li class="gray-list"><span>Сельскохозяйственной техники</span></li>
                        <li class="gray-list"><span>Нефтяного и газового оборудования</span></li>
                        <li class="gray-list"><span>Металлопроката</span></li>
                        <li class="gray-list"><span>Оборудования пищевых предприятий</span></li>
                        <li class="gray-list"><span>Производственных предприятий</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 animated mov2" data-mov2-delay=.3s;
                 style=" visibility: visible; animation-delay: 0.3s;">
                <div class="specialize-block">
                    <h3 class="specialize-block_title">
                        Услуги по доставке комплектующих:
                    </h3>
                    <div class="line_second">

                    </div>
                    <ul class="specialize-block_text">
                        <li class="gray-list"><span>Авиадоставка из США</span></li>
                        <li class="gray-list"><span>Морские контейнерные перевозки</span></li>
                        <li class="gray-list"><span>Мультимодальные перевозки и сборные грузы</span></li>
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