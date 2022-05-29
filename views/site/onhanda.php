<?php

//$this->layout = '@app/views/layouts/base-uikit-layout';
$css= <<< CSS

:root {
  --color-white: #fff;
  --color-black: #333;
  --color-gray: #75787b;
  --color-gray-light: #bbb;
  --color-gray-disabled: #cccccc;
  --color-green: #53a318;
  --color-green-dark: #383;
  --font-size-small: .75rem;
  --font-size-default: .875rem;
}

* {
  box-sizing: border-box;
}

body {
  margin: 2rem;
  font-family: 'Open Sans', sans-serif;
  color: var(--color-black);
}

h2 {
  color: var(--color-gray);
  font-size: var(--font-size-small);
  line-height: 1.5;
  font-weight: 400;
  text-transform: uppercase;
  letter-spacing: 3px;
}
section {
  margin-bottom: 2rem;
}

.progressBar {
  display: flex;
  justify-content: space-between;
  list-style: none;
  padding: 0;
  margin: 0 0 1rem 0;
}
.progressBar li {
  flex: 2;
  position: relative;
  padding: 0;
  /*padding: 0 0 14px 0;*/
  font-size: var(--font-size-default);
  line-height: 1.5;
  color: var(--color-green);
  font-weight: 600;
  /*white-space: nowrap;*/
  overflow: visible;
  min-width: 0;
  text-align: center;
  border-bottom: 2px solid var(--color-gray-disabled);
}
.progressBar li:first-child,
.progressBar li:last-child {
  flex: 1;
}
.progressBar li:last-child {
  text-align: right;
}
.progressBar li:before {
  content: "";
  display: block;
  width: 15px;
  height: 15px;
  background-color: var(--color-gray-disabled);
  border-radius: 50%;
  border: 2px solid var(--color-white);
  position: absolute;
  left: calc(50% - 6px);
  bottom: -9px;
  z-index: 3;
  transition: all .2s ease-in-out;
}
.progressBar li:first-child:before {
  left: 0;
}
.progressBar li:last-child:before {
  right: 0;
  left: auto;
}
.progressBar span {
  transition: opacity .3s ease-in-out;
}
.progressBar li:not(.is-active) span {
  opacity: 0;
}
.progressBar .is-complete:not(:first-child):after,
.progressBar .is-active:not(:first-child):after {
  content: "";
  display: block;
  width: 100%;
  position: absolute;
  bottom: -2px;
  left: -50%;
  z-index: 2;
  border-bottom: 2px solid var(--color-green);
}
.progressBar li:last-child span {
  width: 200%;
  display: inline-block;
  position: absolute;
  left: -100%;
}

.progressBar .is-complete:last-child:after,
.progressBar .is-active:last-child:after {
  width: 200%;
  left: -100%;
}

.progressBar .is-complete:before {
  background-color: var(--color-green);
}

.progressBar .is-active:before,
.progressBar li:hover:before,
.progressBar .is-hovered:before {
  background-color: var(--color-white);
  border-color: var(--color-green);
}
.progressBar li:hover:before,
.progressBar .is-hovered:before {
  transform: scale(1.33);
}

.progressBar li:hover span,
.progressBar li.is-hovered span {
  opacity: 1;
}

.progressBar:hover li:not(:hover) span {
  opacity: 0;
}

.x-ray .progressBar,
.x-ray .progressBar li {
  border: 1px dashed red;
}

.progressBar .has-changes {
  opacity: 1 !important;
}
.progressBar .has-changes:before {
  content: "";
  display: block;
  width: 8px;
  height: 8px;
  position: absolute;
  left: calc(50% - 4px);
  bottom: -20px;
  background-image: url('data:image/svg+xml;charset=utf-8,%3Csvg%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%208%208%22%3E%3Cpath%20fill%3D%22%23ed1c24%22%20d%3D%22M4%200l4%208H0z%22%2F%3E%3C%2Fsvg%3E');
}
CSS;

$this->registerCss($css, ["type" => "text/css"], "progressBar" );

$onPage = Yii::$app->params['onPageOnhandA'];

$this->title = 'Грузы на складе';
if (!isset($n)) {
    $n = '';
}
if (!Yii::$app->user->isGuest) {
    ?>
    <script type="text/javascript" src="//s.trackingmore.com/plugins/v1/buttonCurrent.js"></script>
    <div id="onhandA" class="container" style="" v-cloak>
        <div class="row">
            <div class="col-lg-12"  style="margin-top: 20px;">
                <h2>Грузы на складе</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form role="form" action="//track.trackingmore.com" method="get" onsubmit="return false" style="padding-bottom: 0;">
                <label for="tracknumber">Проверка трекингов от Fedex, USPS, UPS и др. До нашего склада в Америке </label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon" style="background: #d7edb4;">трек номер:</span>
                    </div>
                    <input type="text" class="form-control" style="margin-top: 0px; padding: 0.375rem 0.75rem; height: auto;"
                           id="button_tracking_number" aria-describedby="basic-addon" placeholder="введите трек-номер Fedex USPS, UPS и др"/>
                    <div class="input-group-append">
                        <button  class="btn btn-warning " style="background: #8abc3a;" type="button" id="query" onclick="return doTrack()">Track</button>
                        <input type="hidden" name="lang" value="ru"/>
                        <input id="button_express_code" type="hidden" name="lang" value=""/>
                    </div>
                </div>
                </form>
                <div id="TRNum" style="margin-bottom: 20px;"></div>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <label for="tracknumber">Проверка трекингов от нашего склада в Америке до склада в Москве</label>
                <div class="uk-text-primary uk-text-bold" uk-spinner="ratio: 1"
                     :hidden="!animRow"></div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon3">трек номер:</span>
                    </div>
                    <input type="text" class="form-control"
                           style="margin-top: 0px; padding: .375rem .75rem; height: auto;"
                           id="tracknumber" aria-describedby="basic-addon3" @keyup.enter="checkTracknumbers"
                           v-model="tracknumber" placeholder="введите 3 и больше символов"/>
                    <div class="input-group-append">
                        <button @click="checkTracknumbers" class="btn btn-warning " type="button">Найти</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <button @click="getOnhends()"
                        class="uk-button uk-button-medium uk-text-bolder uk-text-nowrap"
                        style="background: #F4D848; color:black;">Показать
                    Все
                </button>
            </div>
        </div>
        <div class="row"><div class="col-md-6"></div></div>

        <div class="row">
            <div id="accordion" class="col-lg-12 ">
                <div class="row uk-visible@s" style="margin-top: 10px;">
                    <div class="col-lg-1 v-cloak--hidden">

                    </div>
                    <div class="col-lg-3 v-cloak--hidden">
                        <span class="text-muted">№ документа</span>
                    </div>
                    <div class="col-lg-8 v-cloak--hidden">
                        <span class="text-muted">Описание, трек-номер</span>
                    </div>
                </div>
                <div class="uk-alert-danger uk-margin uk-text-medium uk-text-left uk-padding-small"
                     :hidden="!notFound">
                    Ничего не найдено!
                </div>
                <div class="card" v-for="(ridx, idx) in onhandARows[0]" style="margin-top: 10px;">

                    <div class="card-header" id="headingOne">
                        <div class="row" @click="openWindowTracknumbers(ridx.opid,idx)" data-toggle="collapse" :data-target="'#collapse_'+idx" aria-expanded="true"
                             :aria-controls="'collapse_'+idx">
                            <div class="col-lg-1 v-cloak--hidden">
                                <span class="badge badge-light">{{idx+1}}</span>
                            </div>
                            <div class="col-lg-3 v-cloak--hidden">
                                <button @click="openWindowTracknumbers(ridx.opid,idx)"
                                        class="uk-button uk-button-small uk-button-primary uk-text-bolder uk-text-nowrap"
                                        data-toggle="collapse" :data-target="'#collapse_'+idx" aria-expanded="true"
                                        :aria-controls="'collapse_'+idx">
                                    {{ridx.doc}}{{ridx.y}}
                                </button>
                            </div>
                            <div class="col-lg-8 v-cloak--hidden">
                                <span class="uk-hidden@s text-muted">Описание: </span>
                                <span>{{ridx.desc}}</span>
                            </div>

                        </div>
                    </div>

                    <div :id="'collapse_'+idx" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <table class="uk-table uk-overflow-auto uk-table-divider uk-table-middle uk-table-striped">
                                <thead class="uk-visible@s v-cloak--hidden" :hidden="!goodsRows.length>0">
                                <tr>
                                    <th></th>
                                    <th>Трек/ Код изготовителя</th>
                                    <th>Наименование</th>
                                    <th>Количество</th>
                                    <th>Onhand B</th>
                                    <th>Грузы, готовые к отправке / № док</th>
                                </tr>
                                </thead>
                                <tbody :hidden="!goodsRows.length>0">
                                <tr class="" v-for="(ridx, idx) in goodsRows[0]">

                                    <td class="uk-hidden@s ">
                                        <span class="uk-label uk-label-warning">{{idx+1}}</span>
                                        <span>Трек-номер / код: {{ridx.c}}</span><br>
                                        <div><ol class="progressBar" >
                                                <li class="" :class="[ridx.st[0]]"><span>На складе в США<br>{{ridx.st[4]}}</span></li>
                                                <li class="" :class="[ridx.st[1]]"><span>В пути<br>{{ridx.st[5]}}</span></li>
                                                <li class="" :class="[ridx.st[2]]"><span>На складе в Москве<br>{{ridx.st[6]}}</span></li>
                                                <li class="" :class="[ridx.st[3]]"><span>Выдан клиенту<br>{{ridx.st[7]}}<br></span></li>
                                            </ol></div>
                                        <span>{{ridx.n}}</span><br>
                                        <span>Количество: {{ridx.q}}</span><br>
                                        <span>Onhand B: {{ridx.ohB}}</span><br>
                                        <span>№ док / Грузы, готовые к отправке: <a
                                                    class="uk-button uk-button-primary uk-button-small uk-text-bolder uk-text-nowrap"
                                                    :href="'/onhandc?n='+ridx.ohC">
                                            {{ridx.ohC}}
                                        </a></span>
                                    </td>


                                    <!-- Large -->
                                    <td class="uk-visible@s v-cloak--hidden">
                                        <span>{{idx+1}}</span>
                                    </td>
                                    <td class="uk-visible@s v-cloak--hidden">
                                        <span>{{ridx.c}}</span>
                                        <ol class="progressBar" style="margin: 10px 0;">
                                            <li class="" :class="[ridx.st[0]]"><span>На складе в США<br>{{ridx.st[4]}}</span></li>
                                            <li class="" :class="[ridx.st[1]]"><span>В пути<br>{{ridx.st[5]}}</span></li>
                                            <li class="" :class="[ridx.st[2]]"><span>На складе в Москве<br>{{ridx.st[6]}}</span></li>
                                            <li class="" :class="[ridx.st[3]]"><span>Выдан клиенту<br>{{ridx.st[7]}}<br></span></li>
                                        </ol>
                                    </td>
                                    <td class="uk-visible@s v-cloak--hidden">
                                        {{ridx.n}}
                                    </td>
                                    <td class="uk-visible@s v-cloak--hidden">
                                        {{ridx.q}}
                                    </td>
                                    <td class="uk-visible@s v-cloak--hidden">
                                        {{ridx.ohB}}
                                    </td>
                                    <td class="uk-visible@s v-cloak--hidden">
                                        <a class="uk-button uk-button-primary uk-button-small uk-text-bolder uk-text-nowrap"
                                           :href="'/onhandc?n='+ridx.ohC">
                                            {{ridx.ohC}}
                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                            <div class="uk-alert-danger uk-margin uk-text-medium uk-text-left uk-padding-small"
                                 :hidden="!notFoundGoods">
                                Ничего не найдено!
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        var operid = '<?=$n?>';
    </script>
    <?php
    $script = <<< JS
    new Vue({
        el: '#onhandA',
        data: {
            tracknumber: '',
            notFound:false,
            notFoundGoods:false,
            animRow:false,
            hasErrorForm:false,
            application:[],   
            onhandARows:[],
            goodsRows:[],
            goodsData:[],
            oid:operid,
            //requestGoodsStatus:true,
            lastGoodId:888,
        },
        methods:{
            clearRowTracknumber:function(){
                this.onhandARows.splice(0,100);
                this.application=[];
            },
            clearRowGoods:function(){
                this.goodsRows=[];
                this.goodsData=[];
            },
            openWindowTracknumbers:function(a,id){

                if(this.lastGoodId*1 !=id){ 

                        this.clearRowGoods();
                        this.animRow=true;
                        
                        var urlJ;
                        urlJ='/getgoodsbyoid?o='+a;
                        axios
                        .get(urlJ)
                        .then(response => (
                                this.animRow=false,
                                this.isErrorGoods(response.data), 
                                //console.log(JSON.stringify(response.data.res)),                                
                                this.goodsRows.push(response.data.res) 
                            )                       
                        );
                }
                this.lastGoodId=id;
                
            },
            checkTracknumbers:function(){                
                if(this.tracknumber.length >2){                      
                    this.animRow=true;
                    this.clearRowTracknumber();
                    var urlJ;
                    urlJ='/getallbytracknum?t='+this.tracknumber;
                    axios
                    //.get('https://api.coindesk.com/v1/bpi/currentprice.json')
                    .get(urlJ)
                    .then(response => (
                            //this.info = response,   
                            this.animRow=false,
                            this.isError(response.data), 
                            //console.log(JSON.stringify(response.data.res)),                                
                            this.onhandARows.push(response.data.res)              
                            
                        )                       
                    );
                }else{
                    //console.log(888);
                }
            },
            checkOid:function(oid){                
                if(oid.length >1){                      
                    this.animRow=true;
                    this.clearRowTracknumber();
                    var urlJ;
                    urlJ='/getonhandaoid?o='+this.oid;
                    axios
                    //.get('https://api.coindesk.com/v1/bpi/currentprice.json')
                    .get(urlJ)
                    .then(response => (
                            //this.info = response,   
                            this.animRow=false,
                            this.isError(response.data), 
                            //console.log(JSON.stringify(response.data.res)),                                
                            this.onhandARows.push(response.data.res)   
                            
                        )                       
                    );
                }
            },
            isError:function(a){
                if(a.error){
                    this.notFound=true;
                }else{
                    this.notFound=false;                       
                }
            },
            isErrorGoods:function(a){
                if(a.error){
                    this.notFoundGoods=true;
                }else{
                    this.notFoundGoods=false;                       
                }
            },
            getOnhends:function(){                                 
                this.animRow=true;
                this.notFound=false,
                this.notFoundGoods=false,
                this.clearRowTracknumber();
                var urlJ;
                urlJ='/getallonhanda';
                axios.get(urlJ)
                .then(response => (
                        this.animRow=false,
                        this.isError(response.data), 
                        //console.log(JSON.stringify(response.data.res)),                                
                        this.onhandARows.push(response.data.res)  
                    )                       
                );
            },
            
        },
        mounted() {
             if(this.oid.length>0) {
                 this.checkOid(this.oid);                                     
             }else{
                 this.getOnhends();     
             }             
        }
    });
JS;

    $this->registerJs($script, yii\web\View::POS_END);
}
?>
