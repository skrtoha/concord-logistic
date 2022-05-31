<?php

use app\components\FormcalcWidget;
use app\components\ObsvWidget;
use http\Url;

$this->title = 'Доставка из США в Россию – Покупка и доставка товаров из Америки | Международные отправки с Concord Logistic';
$this->registerMetaTag(
    ['name' => 'description', 'content' => 'Доставка из США. Покупка и доставка товаров авиа и морские контейнерные перевозки из любой точки Америки. Собственные склады в США. Услуги по консолидации, хранению и переупаковке грузов. Работаем как с крупными предприятиями, так и с представителями малого бизнеса.']
);
$this->registerLinkTag(['rel' => 'canonical', 'href' => 'https://www.concord-logistic.com']);
/*$this->registerMetaTag(
    ['name' => 'link', 'rel' =>'canonical', 'href' => 'https://www.concord-logistic.com/']
);*/
?>
<section style="margin-top: 70px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="">
                    <h1 class="services_title" style="font-weight: bold;font-size: 60px;"> Доставка из США</h1>
                    <p class="services_block__text">
                        Посылками из США уже никого не удивить. Уже каждый второй заказывает себе различные товары из заграницы. Купить можно практически все – косметика, непортящиеся продукты, одежда, автомобильные запчасти и многое другое. Благодаря доступной и быстрой интернет-связи, ваш ассортимент не ограничивается местным торговым центром или рынком, перед вами весь мир качественных брендовых товаров, большая часть которых производится в США.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

<section id="services">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="">
                    <h2 class="services_title">
                        Услуги компании при доставке грузов из США
                    </h2>
                </div>
            </div>
            <div class="col-lg-five animated mov3" style="visibility: visible;">
                <div class="services_block">
                    <div class="services_block__item">
                        <div id="images">
                            <img src="/img/avia.png" alt="">
                        </div>
                    </div>
                    <h3 class="services_block__title">
                        Авиадоставка
                    </h3>
                    <div class="line_second">

                    </div>
                    <p class="services_block__text" style="">
                        Организация авиаперевозок из США с оптимизацией способов и маршрутов доставки в аэропорт страны
                        или по адресу получателей. Отправка авиа осуществляется каждую пятницу с нашего склада в США. Сроки доставки до России от 7-14 дней.  Для расчета  стоимости доставки можно воспользоваться <a href="/#tm-bottom-c">калькулятором расчета доставки</a>.
                    </p>

                </div>
            </div>
            <div class="col-lg-five animated mov3" data-mov3-delay=".2s"
                 style="visibility: visible; animation-delay: 0.2s; ">
                <div class="services_block">
                    <div class="services_block__item">
                        <div id="images">
                            <img src="/img/sea.png" alt="">
                        </div>
                    </div>
                    <h3 class="services_block__title">
                        Морские перевозки грузов
                    </h3>
                    <div class="line_second">

                    </div>
                    <p class="services_block__text">
                        Организация доставки товара в составе сборных контейнеров, включая доставку в отдельных
                        контейнерах, из любой точки США. Сроки доставки из США в Россию морем составляет 35-40 дней. Регулярно каждую неделю нами отправляется сборный контейнер в Россию что делает этот сервис наиболее удобным и комфортным для наших клиентов.
                    </p>

                </div>
            </div>
            <div class="col-lg-five animated mov3" data-mov3-delay=".4s"
                 style="visibility: visible; animation-delay: 0.4s; ">
                <div class="services_block ">
                    <div class="services_block__item">
                        <div id="images">
                            <img src="/img/consolidation.png" alt="">
                        </div>
                    </div>
                    <h3 class="services_block__title">
                        Консолидация грузов
                    </h3>
                    <div class="line_second">

                    </div>
                    <p class="services_block__text">
                        Осуществляем консолидацию грузов на своем складе.
                        Обслуживаем не только оптовые и коммерческие партии , так и малые грузы (до 50 кг.) для доставки
                        в составе сборного груза или генеральной отправки.
                    </p>

                </div>
            </div>
            <div class="col-lg-five animated mov3" data-mov3-delay=".6s"
                 style="visibility: visible; animation-delay: 0.6s; ">
                <div class="services_block animated mov3">
                    <div class="services_block__item">
                        <div id="images">
                            <img src="/img/storage.png" alt="">
                        </div>
                    </div>
                    <h3 class="services_block__title">
                        Хранение и переупаковка
                    </h3>
                    <div class="line_second">

                    </div>
                    <p class="services_block__text">
                        Принимаем на хранение грузы в любом виде, в т.ч. и паллетного хранения. При необходимости
                        переупакуем любой негабаритный и габаритный груз.
                    </p>

                </div>
            </div>
            <div class="col-lg-five animated mov3" data-mov3-delay=".6s"
                 style="visibility: visible; animation-delay: 0.6s; ">
                <div class="services_block animated mov3">
                    <div class="services_block__item">
                        <div id="images">
                            <img src="/img/icoUsdoll.png" alt="">
                        </div>
                    </div>
                    <h3 class="services_block__title">
                        Покупка товаров в США
                    </h3>
                    <div class="line_second">

                    </div>
                    <p class="services_block__text">
                        Оказываем помощь при покупке и заказе товаров из США коммерческих и мелкооптовых партий.
                        Проведем переговоры с вашим поставщиком и организуем доставку до нашего склада проведем осмотр и
                        фотографирование вашего груза. <a href="/#obsv">Напишите нам</a> и мы ответим на все ваши вопросы
                    </p>

                </div>
            </div>
        </div>
    </div>
</section>

<?= FormcalcWidget::widget()?>

<!--section id="choose">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 animated mov" style="visibility: visible; ">
                <div class="choose_block ">
                    <h3 class="choose_block__title">
                        Кто мы?
                    </h3>
                    <div class="line_second">

                    </div>
                    <p class="choose_block__text">
                        Concord Logistic является вашим самым надежным партнером в мире международной логистики, который
                        способен максимально упростить и оптимизировать для вас доставку товаров из США. Внедрение
                        системы измерения эффективности работы KPI «Доставка в срок в необходимом количестве» помогла
                        нашим клиентам найти решение проблем с планировкой доставки и улучшила исполнение размещенных
                        заказов до 97-98%.
                    </p>

                </div>
            </div>
            <div class="col-lg-6 animated mov2" style="visibility: visible;">
                <div class="choose_block ">
                    <h3 class="choose_block__title">
                        Почему выбирают нас
                    </h3>
                    <div class="line_second">

                    </div>
                    <p class="choose_block__text">
                        Мы работаем не только с крупными предприятиями, но и с представителями малого бизнеса в том
                        числе. Прорабатывая различные логистические схемы и подбирая индивидуальные и эффективные
                        варианты доставки из США в кратчайшие сроки, мы имеем возможность учитывать все пожелания наших
                        клиентов, сохраняя максимально низкие цены.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section-->
<section id="delivery">
    <div class="management_offer ">
        <div class="container">
            <div class="row">
                <div class="col-lg-2 col-md-12">
                    <div class="num">01</div>
                    <div class="line"></div>
                </div>
                <div class="col-lg-10 col-md-12">
                    <div class="offer_group ">
                        <div class="offer_title">Авиадоставка из США</div>
                        <!--<h2 class="offer_title"><span></span></h2>-->
                        <p class="offer_text animated bounceInRight mov2">Международные грузовые авиаперевозки –
                            наиболее быстрый способ доставки груза.Мы сотрудничаем с ведущими Российскими и зарубежными
                            авиакомпаниями, что позволяет гарантировать нашим партнерам и клиентам надежность и
                            выполнение обязательств в срок.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="management">
    <div class="management_offer ">
        <div class="container">
            <div class="row">


                <div class="col-lg-2">
                    <div class="num">02</div>
                    <div class="line"></div>
                </div>
                <div class="col-lg-10 ">
                    <div class="offer_group">
                        <div class="offer_title" style="">Доставка товаров и грузов из США морем


                        </div>
                        <p class="offer_text management_text">Организуем доставку генеральных FCL (FULL CONTAINER LOADS)
                            и сборных LCL (Less then Container Loads) контейнеров из любой точки Северной Америки.
                            Доставка морем - наиболее экономичный способ доставки для крупногабаритных и/или
                            негабаритных товаров.</p>
                    </div>
                </div>


            </div>
        </div>
    </div>
</section>

<section id="stock">
    <div class="management_offer">
        <div class="container">
            <div class="row">


                <div class="col-lg-2">
                    <div class="num">03</div>
                    <div class="line"></div>
                </div>
                <div class="col-lg-10 ">
                    <div class="offer_group">
                        <div class="offer_title" style="font-size: ">Консолидация хранение и переупаковка

                            <span><br> </span></div>
                        <!--<h2 class="offer_title"><span>Консолидация, хранение и переупаковка</span></h2>-->
                        <p class="offer_text management_text">Одна из наиболее востребованных услуг, предоставляемых
                            нашей компанией. Сборка нескольких небольших грузов от одного или разных заказчиков в единую
                            партию, что позволяет клиенту экономить на доставке из США. Высокий профессионализм наших
                            сотрудников и большой опыт в оказании услуг по консолидации гарантирует объединение грузов
                            строго в соответствии с требованиями производителей к упаковке и транспортировке каждого
                            типа товаров. </p>
                    </div>
                </div>


            </div>
        </div>
    </div>
</section>
<section id="ways">
    <div class="container">
        <div class="row">

            <div class="co-lg-3 col-md-5 animated mov" style="visibility: visible;  animation-delay:0.3s; "
                 data-mov-delay=".3s">
                <div class="ways_item ">
                    <img src="/img/page-1.png" alt="" style="border-radius: 50%; ">
                </div>
            </div>
            <div class="co-lg-7 col-md-7 animated mov2" style="visibility: visible;  animation-delay: 0.3s;"
                 data-mov2-delay="3s">
                <div class="ways_content animated mov2">
                    <h3 class="ways_title">
                        Консолидация грузов на складе в Америке
                    </h3>
                    <div class="line"></div>
                    <p class="ways_text ">
                        Одна из наиболее востребованных услуг, предоставляемых нашей компанией. Объединение нескольких
                        небольших грузов от одного или разных заказчиков в единую отправку позволяет существенно снизить
                        стоимость доставки из Америки. Высокий профессионализм наших сотрудников и большой опыт в
                        оказании услуг по консолидации гарантируют объединение грузов строго в соответствии с
                        требованиями производителей к упаковке и транспортировке каждого типа товаров.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="ways " class="ways_second">
    <div class="">
        <div class="container">
            <div class="row">

                <div class="co-lg-3 col-md-5 animated mov" style="visibility: visible;  animation-delay: 0.3s;"
                     data-mov-delay="3s">
                    <div class="ways_item ">
                        <img src="/img/cargoTruks.webp" alt=""
                             style="border-radius: 50%;">
                    </div>
                </div>
                <div class="co-lg-7 col-md-7 animated mov2" style="visibility: visible;  animation-delay: 0.3s;"
                     data-mov2-delay="3s">
                    <div class="ways_content animated mov2">
                        <h3 class="ways_title">
                            Хранение на нашем складе в Америке
                        </h3>
                        <div class="line"></div>
                        <p class="ways_text">
                            Наша компания оказывает услуги ответственного хранения на базе собственного склада в США.
                            Склад Concord Logistic оснащен современным профессиональным оборудованием и
                            климат-контролем. Мы предлагаем как краткосрочные, так и долгосрочные варианты хранения и
                            гарантируем наилучшие условия для ваших товаров. При необходимости, мы можем так же
                            осуществить самостоятельный забор вашего груза на территории Америки.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="ways">
    <div class="container">
        <div class="row">

            <div class="co-lg-3 col-md-5 animated mov" style="visibility: visible;  animation-delay: 0.3s;"
                 data-mov-delay="3s">
                <div class="ways_item ">
                    <img src="/img/cargo.webp" alt=""
                         style="border: 1px solid #b9b9b9; padding: 5px; box-shadow: 0 0 3px rgba(0,0,0,0.6); ">
                </div>
            </div>
            <div class="co-lg-7 col-md-7 animated mov2" style="visibility: visible;  animation-delay: 0.3s;"
                 data-mov2-delay="3s">
                <div class="ways_content ">
                    <h3 class="ways_title">
                        Переупаковка на складе в Америке
                    </h3>
                    <div class="line"></div>
                    <p class="ways_text ">
                        Если потребуется, наши сотрудники переупакуют любой негабаритный груз и проведут монтажные
                        работы. Доставка из Америки имеет свои особенные условия, независимо от того, какой вид доставки
                        вы выберете – авиа- или морской. Правильная упаковка (переупаковка) обеспечивает большую
                        сохранность груза при транспортировке. Кроме того, во многих случаях профессиональная
                        переупаковка позволяет максимально снизить объемный вес груза, что выгодно сказывается на
                        стоимости его перевозки из США
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="form_section" id="obsv">
    <div class="container">


        <?= ObsvWidget::widget()?>


    </div>
</section>

<section id="question">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="">
                    <div class="offer_title services_title">
                        Вопрос-Ответ
                    </div>
                </div>
                <div class="line_second">

                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="question_content animated mov">
                    <div class="services_block__item">
                        <div id="question_images">27</div>
                        <div class="nov">мар</div>
                    </div>
                    <div class="question_block">
                        <h3 class="services_block__title ">
                            Наша компания занимается дизайном интерьеров, возможно ли через вас доставлять крупногабаритные предметы мебели – шкафы, стенки?
                        </h3>
                        <p class="services_block__text">
                            Да, вы можете заказать у нас доставку крупногабаритных предметов – в случае, если авиадоставка из США будет невозможна, мы предложим вам доставку морем.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="question_content  ">
                    <div class="services_block__item">

                        <div id="question_images">

                            17
                        </div>
                        <div class="nov">
                            сен
                        </div>
                    </div>
                    <div class="question_block">
                        <h3 class =" question_block__title">
                            Занимаетесь ли вы доставкой автомобилей <br>    под заказ из Америки?
                        </h3>

                        <p class="services_block__text">
                            Нет, наша компания не оказывает услуг по доставке новых или подержанных автомобилей из США.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="question_content  ">
                    <div class="services_block__item">

                        <div id="question_images">

                            12
                        </div>
                        <div class="nov">
                            авг
                        </div>
                    </div>
                    <div class="question_block">
                        <h3 class =" question_block__title">
                            Вы работаете с частными лицами? <br> Можно заказать доставку посылки из Американского интернет-магазина?
                        </h3>

                        <p class="services_block__text">
                            Нет, наша компания работает только с юридическими лицами.
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="question_content  ">
                    <div class="services_block__item">

                        <div id="question_images">
                            30
                        </div>
                        <div class="nov">
                            июль
                        </div>
                    </div>
                    <div class="question_block">
                        <h3 class =" question_block__title">
                            Сколько по времени занимает доставка контейнера морем?
                        </h3>

                        <p class="services_block__text">
                            Максимум 40-45 дней. Мы стремимся, по возможности, максимально сокращать сроки доставки.
                        </p>
                    </div>
                </div>
            </div>

            <div class="question_button">
                <a href="/question.php">
                    <button id="quest_view">Смотреть все +</button>
                </a>
            </div>
        </div>
    </div>
</section>
