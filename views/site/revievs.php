<?php

$this->title = 'Отзывы клиентов о логистической компании Concord Logistic';
$this->registerMetaTag(
    ['name' => 'description', 'content' => 'У вас есть, что сказать о Concord Logistic? Вам понравилось с нами работать или, наоборот, вам есть, что покритиковать? Оставьте ваш отзыв! ']
);
?>
<link rel="stylesheet" href="/css/revievs.css?1">
<section id="question_quest">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h2 class="services_title">
                    Отзывы наших клиентов
                </h2>
            </div>
            <div class="col-lg-6">
                <div class="revievs_block">
                    <img src="/img/stars.png" alt="">
                    <div class="line"></div>
                    <div class="services_block__text">
                        ООО "Берлинго Авто"
                    </div>
                    <p class="services_block__text">Выражаем вам признательность за добросовестное отношение и
                        взаимопонимание. Очень довольны компетентным и профессиональным персоналом вашей фирмы. Будем
                        рады развитию нашего сотрудничества. Заместитель Генерального директора Демченко Г.В.</p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="revievs_block">
                    <img src="/img/stars.png" alt="">
                    <div class="line"></div>
                    <div class="services_block__text">
                        ООО "Hot Dot”
                    </div>
                    <p class="services_block__text">Concord logistic - это люди, которые понимают спицифику нашего
                        бизнеса. С вами комфортно работать, вы всегда внимательны к нашим потребностям, вместе мы сможем
                        решить самые сложные задачи. </p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="revievs_block">
                    <img src="/img/stars.png" alt="">
                    <div class="line"></div>
                    <div class="services_block__text">
                        ООО “Европа люкс”
                    </div>
                    <p class="services_block__text">За время сотрудничества компания Concord logistic показала свою
                        способность выполнять в срок даже самые сложные задачи. </p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="revievs_block">
                    <img src="/img/stars.png" alt="">
                    <div class="line"></div>
                    <div class="services_block__text">
                        ООО “АвтоГарант”
                    </div>

                    <p class="services_block__text">Отличительной чертой работы компании является их высокий
                        профессионализм, организованность сотрудников компании и сильный командный дух. </p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="revievs_block">
                    <img src="/img/stars.png" alt="">
                    <div class="line"></div>
                    <div class="services_block__text">
                        ООО “ГлавЗапчасть”
                    </div>

                    <p class="services_block__text">Спасибо за своевременное выполнение обязательств по доставке автозапчастей! </p>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="revievs_block">
                    <img src="/img/stars.png" alt="">
                    <div class="line"></div>
                    <div class="services_block__text">
                        ООО “Спец Трак”
                    </div>

                    <p class="services_block__text">Немногие в это время придерживаются точного выполнения своих обещаний. Но команда Concord logistic показала себя отличными профессионалами!</p>
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


<script src="/js/rating.js"></script>