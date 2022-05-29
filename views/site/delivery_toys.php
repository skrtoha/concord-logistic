<?php

$this->title = 'Доставка игрушек из Америки.  Купить с доставкой игрушки из США';
$this->registerMetaTag(
    ['name' => 'description', 'content' => 'Мягкие игрушки, конструкторы, куклы, товары для хобби и творчества, развивающие коврики, товары для малышей высочайшего качества из Америки.  Закажите доставку из США в Concord Logistic.']
);
?>
<section id="ways_second" style="">

    <div class="container">
        <div class="row">

            <div class="co-lg-3 col-md-5">
                <div class="ways_item ">
                    <img src="/img/toys.webp" alt=""
                         style="border-radius: 50%; box-shadow: 0 0 3px rgba(0,0,0,0.6); padding: 5px;">
                </div>
            </div>
            <div class="col-lg-7 col-md-7">
                <div class="ways_content ">
                    <h1 class="ways_title">
                        Доставка игрушек из Америки
                    </h1>
                    <div class="line"></div>
                    <p class="ways_text ">
                        Детские товары из США пользуются заслуженным спросом по всему миру, благодаря безопасности и
                        высочайшему качеству. Мягкие игрушки, конструкторы, куклы, товары для хобби и творчества,
                        развивающие коврики, товары для малышей проходят жесточайший контроль, прежде чем выходят на
                        рынок. Именно поэтому товары для детей из Америки всегда популярны.
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
                        <h3 class="ways_title">
                            Способы доставки
                        </h3>
                        <div class="line"></div>
                        <p class="ways_text">
                            Мы доставляем игрушки из Америки авиатранспортом и морскими перевозками. Авиа доставка
                            пользуется наибольшим спросом в преддверии праздников (новый год, 23 февраля и 8 марта), а
                            так же детских каникул – когда спрос на игрушки особенно высок и требуется срочно пополнить
                            складские запасы. Морские перевозки больше подходят в том случае, когда закупка происходит
                            заранее и сроки спланированы, а вот стоимость доставки имеет существенное значение. Вы
                            можете заказать доставку игрушек из США как в составе сборного груза, так и с полной
                            загрузкой контейнера.
                        </p>
                    </div>
                </div>
                <div class="co-lg-3 col-md-5">
                    <div class="ways_item__ship ">
                        <img src="/img/toys2.png" alt="" style="border-radius: 50%;">
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
                <?= app\components\CalcWidget::widget(['titleCalc' => 'Рассчитать стоимость доставки игрушек из Америки.<br>Промо-тарифы на авиадоставку из США:'])?>


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
                        Наиболее часто заказывают продукцию брендов:
                    </h3>
                    <div class="line_second">

                    </div>
                    <ul class="specialize-block_text">
                        <li class="gray-list"><span>Mattel</span></li>
                        <li class="gray-list"><span>LEGO</span></li>
                        <li class="gray-list"><span>Frozen</span></li>
                        <li class="gray-list"><span>Minecraft</span></li>
                        <li class="gray-list"><span>Marvel Legends</span></li>
                        <li class="gray-list"><span>Barbie</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 animated mov2" data-mov2-delay=.3s;
                 style=" visibility: visible; animation-delay: 0.3s;">
                <div class="specialize-block">
                    <h3 class="specialize-block_title">
                        К услугам наших клиентов:
                    </h3>
                    <div class="line_second">

                    </div>
                    <ul class="specialize-block_text">
                        <li class="gray-list"><span>Авиа доставка игрушек из США</span></li>
                        <li class="gray-list"><span>Морские грузовые перевозки</span></li>
                        <li class="gray-list"><span>Перевозки в составе сборных грузов</span></li>
                        <li class="gray-list"><span>Мультимодальные перевозки</span></li>
                        <li class="gray-list"><span>Возможность систематических поставок</span></li>
                        <li class="gray-list"><span>Консолидация и хранение грузов от разных поставщиков</span></li>
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