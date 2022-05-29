<?php

$this->title = 'Доставка мебели из Америки.  Рассчитать  сроки и стоимость';
$this->registerMetaTag(
    ['name' => 'description', 'content' => 'Мы доставляем из США диваны, кресла, спальные гарнитуры, кровати, детские уголки, обеденные столы и стулья, и многое другое.  Предлагаем возможность как арендовать полный контейнер, так и заказать доставку в составе сборного груза.']
);
?>
<section id="ways_second" style="">

    <div class="container">
        <div class="row">

            <div class="co-lg-3 col-md-5">
                <div class="ways_item ">
                    <img src="/img/divany.png" alt="" style="border-radius: 50%; ">
                </div>
            </div>
            <div class="col-lg-7 col-md-7">
                <div class="ways_content ">
                    <h1 class="ways_title">
                        Доставка мебели из Америки
                    </h1>
                    <div class="line"></div>
                    <p class="ways_text ">
                        Мы предлагаем доставку мебели, предметов интерьера, декора, элементов отделки напрямую из США.
                        Дизайнерская мебель американского производства крайне востребована, а предметы интерьера и
                        декора жилых помещений имеют устойчивый спрос. Вы можете заказать диваны, кровати, столы,
                        спальные гарнитуры, шкафы, стулья, кресла и многое другое с <a href="/">доставкой из США</a>, как для разового
                        обустройства квартиры, так и для постоянного расширения ассортимента мебельного магазина.
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
                            Способы доставки мебели из США
                        </h3>
                        <div class="line"></div>
                        <p class="ways_text">
                            Доставка мебели из Америки – одно из приоритетных направлений нашей компании. Уже много лет
                            мы работаем со студиями дизайна интерьера, мебельными магазинами и индивидуальными
                            предпринимателями, занимающимися обустройством и отделкой жилых и нежилых помещений. Concord
                            Logistic предлагает авиадоставку мебели из Америки и морские контейнерные перевозки, с
                            возможностью как арендовать полный контейнер, так и заказать доставку в составе сборного
                            груза
                        </p>
                    </div>
                </div>
                <div class="co-lg-3 col-md-5">
                    <div class="ways_item__ship ">
                        <img src="/img/furnit.webp" alt="" style="border-radius: 50%;">
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
                <?= app\components\CalcWidget::widget(['titleCalc' => 'Рассчитать стоимость доставки мебели из Америки.<br>Промо-тарифы на авиадоставку из США:'])?>

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
                        Наиболее часто заказывают из США:
                    </h3>
                    <div class="line_second">

                    </div>
                    <ul class="specialize-block_text">
                        <li class="gray-list"><span>Диваны и кресла</span></li>
                        <li class="gray-list"><span>Спальные гарнитуры</span></li>
                        <li class="gray-list"><span>Обеденные столы и стулья</span></li>
                        <li class="gray-list"><span>Детские спальни</span></li>
                        <li class="gray-list"><span>Предметы интерьера и декора</span></li>
                        <li class="gray-list"><span>Элементы дизайнерской отделки</span></li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 animated mov2" data-mov2-delay=.3s;
                 style=" visibility: visible; animation-delay: 0.3s;">
                <div class="specialize-block">
                    <h2 class="specialize-block_title">
                        К нам обращаются:
                    </h2>
                    <div class="line_second">

                    </div>
                    <ul class="specialize-block_text">
                        <li class="gray-list"><span>Дизайнеры интерьера</span></li>
                        <li class="gray-list"><span>Фирменные салоны</span></li>
                        <li class="gray-list"><span>Мебельные магазины</span></li>
                        <li class="gray-list"><span>Декораторы интерьера</span></li>
                        <li class="gray-list"><span>Специалисты по оформлению</span></li>
                        <li class="gray-list"><span>Интернет-магазины</span></li>
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