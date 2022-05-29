<link rel="stylesheet" href="/css/calculate.css?3">
<section id="tm-bottom-c" class="bottom-calc">
    <div class="">
        <div class="calc-form">
            <div class="uk-container uk-container-center">
                <h2 class="special-block_title">калькулятор для расчета стоимости доставки груза из США</h2>
                <form action="" method="post" id="form_calc">

                    <div class="uk-grid" id="calcDiv1">
                        <div class="uk-width-medium-1-3 uk-width-small-1-1">
                            <div class="arrow-dot">
                                <div class="uk-form-row uk-grid">
                                    <label class="uk-form-label uk-width-1-3">Откуда</label>
                                    <div class="uk-width-2-3">
                                        <input id="fromCalc" type="text" name="country_id_from" value="США" class="uk-input" disabled>
                                        <!--<select id="fromCalc" name="country_id_from" class="uk-select" style="">
                                            <option value="24">Китай</option>
                                            <option value="21">Россия</option>
                                            <option value="22">Белорусия</option>
                                            <option value="25">Казахстан</option>
                                            <option value="77">Австралия</option>
                                            <option value="41">Австрия</option>
                                            <option value="99">Азербайджан</option>
                                            <option value="26">Аргентина</option>
                                            <option value="101">Армения</option>
                                            <option value="42">Бельгия</option>
                                            <option value="43">Болгария</option>
                                            <option value="27">Бразилия</option>
                                            <option value="35">Великобритания</option>
                                            <option value="44">Венгрия</option>
                                            <option value="60">Вьетнам</option>
                                            <option value="33">Германия</option>
                                            <option value="61">Гонконг</option>
                                            <option value="45">Греция</option>
                                            <option value="100">Грузия</option>
                                            <option value="46">Дания</option>
                                            <option value="90">Египет</option>
                                            <option value="31">Израиль</option>
                                            <option value="29">Индия</option>
                                            <option value="62">Индонезия</option>
                                            <option value="63">Иран</option>
                                            <option value="94">Ирландия</option>
                                            <option value="37">Испания</option>
                                            <option value="34">Италия</option>
                                            <option value="39">Канада</option>
                                            <option value="95">Кипр</option>
                                            <option value="102">Киргизия</option>
                                            <option value="28">Корея</option>
                                            <option value="47">Латвия</option>
                                            <option value="48">Литва</option>
                                            <option value="91">Люксембург</option>
                                            <option value="64">Малайзия</option>
                                            <option value="75">Марокко</option>
                                            <option value="72">Мексика</option>
                                            <option value="96">Молдавия</option>
                                            <option value="65">Непал</option>
                                            <option value="49">Нидерланды</option>
                                            <option value="50">Норвегия</option>
                                            <option value="32">ОАЭ</option>
                                            <option value="66">Пакистан</option>
                                            <option value="73">Перу</option>
                                            <option value="51">Польша</option>
                                            <option value="52">Португалия</option>
                                            <option value="53">Румыния</option>
                                            <option value="67">Саудовская Аравия</option>
                                            <option value="54">Сербия</option>
                                            <option value="68">Сингапур</option>
                                            <option value="38">США</option>
                                            <option value="103">Таджикистан</option>
                                            <option value="69">Таиланд</option>
                                            <option value="30">Тайвань</option>
                                            <option value="92">Туркменистан</option>
                                            <option value="40">Турция</option>
                                            <option value="98">Узбекистан</option>
                                            <option value="89">Украина</option>
                                            <option value="70">Филиппины</option>
                                            <option value="55">Финляндия</option>
                                            <option value="36">Франция</option>
                                            <option value="97">Черногория</option>
                                            <option value="56">Чехия</option>
                                            <option value="57">Швейцария</option>
                                            <option value="58">Швеция</option>
                                            <option value="74">Эквадор</option>
                                            <option value="59">Эстония</option>
                                            <option value="76">ЮАР</option>
                                            <option value="71">Япония</option>
                                        </select>-->
                                    </div>
                                </div>
                                <div class="uk-form-row uk-grid">
                                    <label class="uk-form-label uk-width-1-3">Куда</label>
                                    <div class="uk-width-2-3">
                                        <select id="toCalc" name="country_id_to" class="uk-select" style="">

                                            <option value="24">Китай</option>
                                            <option value="21" selected="">Россия</option>
                                            <option value="22">Белорусия</option>
                                            <option value="25">Казахстан</option>
                                            <option value="77">Австралия</option>
                                            <option value="41">Австрия</option>
                                            <option value="99">Азербайджан</option>
                                            <option value="26">Аргентина</option>
                                            <option value="101">Армения</option>
                                            <option value="42">Бельгия</option>
                                            <option value="43">Болгария</option>
                                            <option value="27">Бразилия</option>
                                            <option value="35">Великобритания</option>
                                            <option value="44">Венгрия</option>
                                            <option value="60">Вьетнам</option>
                                            <option value="33">Германия</option>
                                            <option value="61">Гонконг</option>
                                            <option value="45">Греция</option>
                                            <option value="100">Грузия</option>
                                            <option value="46">Дания</option>
                                            <option value="90">Египет</option>
                                            <option value="31">Израиль</option>
                                            <option value="29">Индия</option>
                                            <option value="62">Индонезия</option>
                                            <option value="63">Иран</option>
                                            <option value="94">Ирландия</option>
                                            <option value="37">Испания</option>
                                            <option value="34">Италия</option>
                                            <option value="39">Канада</option>
                                            <option value="95">Кипр</option>
                                            <option value="102">Киргизия</option>
                                            <option value="28">Корея</option>
                                            <option value="47">Латвия</option>
                                            <option value="48">Литва</option>
                                            <option value="91">Люксембург</option>
                                            <option value="64">Малайзия</option>
                                            <option value="75">Марокко</option>
                                            <option value="72">Мексика</option>
                                            <option value="96">Молдавия</option>
                                            <option value="65">Непал</option>
                                            <option value="49">Нидерланды</option>
                                            <option value="50">Норвегия</option>
                                            <option value="32">ОАЭ</option>
                                            <option value="66">Пакистан</option>
                                            <option value="73">Перу</option>
                                            <option value="51">Польша</option>
                                            <option value="52">Португалия</option>
                                            <option value="53">Румыния</option>
                                            <option value="67">Саудовская Аравия</option>
                                            <option value="54">Сербия</option>
                                            <option value="68">Сингапур</option>
                                            <option value="38">США</option>
                                            <option value="103">Таджикистан</option>
                                            <option value="69">Таиланд</option>
                                            <option value="30">Тайвань</option>
                                            <option value="92">Туркменистан</option>
                                            <option value="40">Турция</option>
                                            <option value="98">Узбекистан</option>
                                            <option value="89">Украина</option>
                                            <option value="70">Филиппины</option>
                                            <option value="55">Финляндия</option>
                                            <option value="36">Франция</option>
                                            <option value="97">Черногория</option>
                                            <option value="56">Чехия</option>
                                            <option value="57">Швейцария</option>
                                            <option value="58">Швеция</option>
                                            <option value="74">Эквадор</option>
                                            <option value="59">Эстония</option>
                                            <option value="76">ЮАР</option>
                                            <option value="71">Япония</option>
                                        </select>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="uk-width-medium-1-3 uk-width-small-1-1">
                            <!--центральный блок-->

                            <div class="uk-form-row uk-grid">
                                <label class="uk-form-label uk-width-1-3">Категория</label>
                                <div class="form-field uk-width-2-3">
                                    <select id="catCalc" name="category_id" class="uk-select" style="">
                                        <option value="53">Автозапчасти</option>
                                        <option value="52">БАД</option>
                                        <option value="38">Бижутерия</option>
                                        <option value="59">Брелки</option>
                                        <option value="60">Бумага</option>
                                        <option value="20">Видеокамеры</option>
                                        <option value="27">Видеорегистраторы</option>
                                        <option value="58">Головные уборы</option>
                                        <option value="70">Елки</option>
                                        <option value="6">Игровые приставки</option>
                                        <option value="44">Игрушки</option>
                                        <option value="40">Инструменты</option>
                                        <option value="57">Искусственные ногти</option>
                                        <option value="56">Искусственные цветы</option>
                                        <option value="69">Канцтовары</option>
                                        <option value="23">Квадрокоптеры</option>
                                        <option value="36">Косметика</option>
                                        <option value="7">Личные вещи</option>
                                        <option value="35">Мебель</option>
                                        <option value="34">Микросхемы</option>
                                        <option value="21">Модемы</option>
                                        <option value="19">Навигаторы</option>
                                        <option value="67">Нитки</option>
                                        <option value="71">Ножи</option>
                                        <option value="24">Ноутбуки</option>
                                        <option value="64">Обои</option>
                                        <option value="39">Оборудование</option>
                                        <option value="31">Обувь</option>
                                        <option value="37">Одежда</option>
                                        <option value="65">Перчатки</option>
                                        <option value="25">Планшеты</option>
                                        <option value="62">Пластик</option>
                                        <option value="33">Платы</option>
                                        <option value="61">Плиты</option>
                                        <option value="63">Постельные принадлежности</option>
                                        <option value="68">Посуда</option>
                                        <option value="42">Прочее</option>
                                        <option value="49">Пряжа</option>
                                        <option value="22">Роутеры</option>
                                        <option value="73">Рыболовное оборудование</option>
                                        <option value="75">Сантехника</option>
                                        <option value="74">Светильники</option>
                                        <option value="32">Светодиоды</option>
                                        <option value="72">Сувенирная продукция</option>
                                        <option value="30">Сумки</option>
                                        <option value="54">Сухие продукты</option>
                                        <option value="50">Сырьевая кожа</option>
                                        <option value="45">Текстиль</option>
                                        <option value="29">Телефоны</option>
                                        <option value="26">Фотоаппараты</option>
                                        <option value="55">Фоторамки</option>
                                        <option value="66">Фурнитрура</option>
                                        <option value="43">Хоз товары</option>
                                    </select>
                                </div>
                            </div>


                            <div class="uk-form-row uk-grid">
                                <label class="uk-form-label uk-width-1-3">Вес, кг</label>
                                <div class="form-field uk-width-2-3">
                                    <input id="weightCalc" type="text" name="weight" value="10" class="uk-input">
                                </div>
                            </div>

                            <div class="uk-form-row uk-grid">
                                <label class="uk-form-label uk-width-1-3"> Объем, м<sup>3</sup>
                                </label>
                                <div class="form-field uk-width-2-3">
                                    <input id="volumeCalc" type="text" name="volume" value="1" class="uk-input">
                                </div>
                            </div>
                            <div class="uk-form-row uk-grid coast-box">
                                <label class="uk-form-label uk-width-1-3">Стоимость груза</label>
                                <div class="form-field  uk-width-2-3">
                                    <input id="costCalc" type="text" name="cost" value="100" class="uk-input"
                                           style="width:46%;display:block;float:left;">
                                    <select id="cost_currencyCalc" name="cost_currency" class="uk-select"
                                            style="width: 52%; float: right; ">
                                        <option data-img-src="images/valuta-RUB.png" value="RUB">Рубль</option>
                                        <option data-img-src="images/valuta-USD.png" value="USD" selected="">
                                            Доллар
                                        </option>
                                        <option data-img-src="images/valuta-EUR.png" value="EUR">Евро</option>
                                    </select>
                                </div>
                            </div>


                            <!--/центральный блок-->


                        </div>
                        <div class="uk-width-medium-1-3 uk-width-small-1-1">


                            <!-- правый блок-->

                            <div class="uk-form-row uk-grid">
                                <label class="uk-form-label uk-width-1-3 ob-label">Валюта расчета</label>
                                <div class="form-field  uk-width-2-3">
                                    <select id="result_currencyCalc" name="result_currency" class="uk-select"
                                            style="">
                                        <option data-img-src="images/valuta-RUB.png" value="RUB">Рубль</option>
                                        <option data-img-src="images/valuta-USD.png" value="USD" selected="">
                                            Доллар
                                        </option>
                                        <option data-img-src="images/valuta-EUR.png" value="EUR">Евро</option>
                                    </select>
                                </div>
                            </div>
                            <div class="uk-form-row uk-grid checkboxform">
                                <label class="uk-form-label uk-width-1-3" for="strach">
                                    Страховка
                                </label>
                                <div class="  uk-width-2-3">
                                    <input id="insuranceCalc" type="checkbox" name="insurance" checked=""
                                           class="uk-checkbox" id="strach" style="margin: 10px;">
                                </div>
                            </div>

                            <div class="uk-form-row uk-grid checkboxform">
                                <label class="uk-form-label uk-width-1-3 ob-label" for="tamozh">
                                    Таможенное оформление
                                </label>
                                <div class="  uk-width-2-3">
                                    <input id="custom_clearanceCalc" type="checkbox" name="custom_clearance"
                                           checked="" class="uk-checkbox" id="tamozh" style="margin: 10px; ">
                                </div>
                            </div>
                            <div class="uk-form-row">
                                <input id="sendCalcStep1" type="button" value="Рассчитать" class="btn btn-default ">
                            </div>


                            <input type="hidden" name="option" value="com_pbajax">
                            <input type="hidden" name="task" value="calc">
                            <input type="hidden" name="tmpl" value="component">
                            <input type="hidden" name="format" value="raw">

                            <!-- \ правый блок-->
                        </div>
                    </div>
                    <div class="uk-grid" id="calcDiv2" style="display: none;">
                        <div class="uk-width-medium-1-3 uk-width-small-1-1">
                            <input id="nameCalc" type="text" name="name" value="" class="uk-input" placeholder="Имя" >
                        </div>
                        <div class="uk-width-medium-1-3 uk-width-small-1-1">
                            <input id="phoneCalc" type="text" name="phone" value="" class="uk-input" placeholder="* Телефон" required>
                        </div>
                        <div class="uk-width-medium-1-3 uk-width-small-1-1">
                            <input id="emailCalc" type="text" name="mail" value="" class="uk-input" placeholder="Email" >
                        </div>
                        <div class="uk-width-medium-1-3 uk-width-small-1-1" style="margin-top: 20px;">
                            <div class="uk-form-row">
                                <input id="calcFormUK" type="button" value="Отправить" class="btn btn-default ">
                            </div>
                        </div>
                    </div>


                </form>
            </div>
        </div>
        <div class="uk-container uk-container-center">
            <div class="row">
                <div class="col-xs-12" id="result_calc">

                </div>
            </div>
        </div>

        <div id="calc-volume-form-box" style="display: none;max-width: 310px">
            <form class="calc-volume-form">
                <div class="name_form_feedback">Рассчитать <span>объем</span></div>
                <div class="form-group">
                    <label for="calc-volume_ed"> Ед. измерения:</label>
                    <select id="calc-volume_ed" class="uk-select">
                        <option value="m">метр</option>
                        <option value="cm">сантиметр</option>
                        <option value="d">дюйм</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="calc-volume_length">Длина:</label>
                    <input id="calc-volume_length" class="form-control" required="" autocomplete="off" value="0.2">
                </div>
                <div class="form-group">
                    <label for="calc-volume_width">Ширина:</label>
                    <input id="calc-volume_width" class="form-control" required="" autocomplete="off" value="0.2">
                </div>
                <div class="form-group">
                    <label for="calc-volume_height">Высота:</label>
                    <input id="calc-volume_height" class="form-control" required="" autocomplete="off" value="">
                </div>
                <div class="form-group">
                    <input type="submit" value="Рассчитать" id="calc-volume_submit" class="btn btn-default btn-send">
                </div>
            </form>
        </div>
    </div>
</section>