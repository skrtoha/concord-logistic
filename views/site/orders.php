<?php

//$this->layout = '@app/views/layouts/base-uikit-layout';

$onPage = Yii::$app->params['onPageOnhandA'];

$this->title = 'Ваши заказы';
if (!isset($n)) {
    $n = '';
}
if (!Yii::$app->user->isGuest) {
    ?>

    <div id="onhandA" class="container" style="" v-cloak>
        <div class="row">
            <div class="col-lg-12"  style="margin-top: 20px;">
                <h2>Ваши заказы</h2>
            </div>
        </div>
        <!--<div class="row justify-content-center">
            <div class="col-md-6">
                <label for="tracknumber">Введите 3 и больше символов</label>
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
        </div>-->
        <div class="row">
            <div class="col-md-6">
                <button @click="getOrders()"
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
                        <span class="text-muted">Состояние</span>
                    </div>
                    <div class="col-lg-3 v-cloak--hidden">
                        <span class="text-muted">Дата</span>
                    </div>
                    <div class="col-lg-3 v-cloak--hidden">
                        <span class="text-muted">Номер</span>
                    </div>
                    <div class="col-lg-2 v-cloak--hidden">
                        <span class="text-muted">Сумма</span>
                    </div>
                </div>
                <div class="uk-alert-danger uk-margin uk-text-medium uk-text-left uk-padding-small"
                     :hidden="!notFound">
                    Ничего не найдено!
                </div>
                <div class="card" v-for="(ridx, idx) in orderRows[0]" style="margin-top: 10px;">

                    <div class="card-header" id="headingOne">
                        <div class="row" @click="openWindowGoods(ridx.cid,idx)"
                             data-toggle="collapse" :data-target="'#collapse_'+idx" aria-expanded="true"
                             :aria-controls="'collapse_'+idx">
                            <div class="col-lg-1 v-cloak--hidden">
                                <span class="badge badge-light">{{idx+1}}</span>
                            </div>

                            <div class="col-lg-3 v-cloak--hidden">
                                <span class="uk-hidden@s text-muted">Состояние: </span>
                                <span class="uk-text-warning">{{ridx.state}}</span>
                            </div>
                            <div class="col-lg-3 v-cloak--hidden">
                                <span>{{ridx.date}}</span>
                            </div>
                            <div class="col-lg-3 v-cloak--hidden">
                                <button @click="openWindowGoods(ridx.cid,idx)"
                                        class="uk-button uk-button-small uk-text-bolder uk-text-nowrap"
                                        data-toggle="collapse" :data-target="'#collapse_'+idx" aria-expanded="true"
                                        :class="[ridx.st==10 ? 'uk-button-success' : 'uk-button-primary']"
                                        :aria-controls="'collapse_'+idx">
                                    {{ridx.doc}}{{ridx.y}}
                                </button>
                            </div>
                            <div class="col-lg-2 v-cloak--hidden">
                                <span class="uk-hidden@s text-muted">Сумма: </span>
                                <span>{{ridx.sum}} {{ridx.v}}</span>
                            </div>

                        </div>
                    </div>

                    <div :id="'collapse_'+idx" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <table class="uk-table uk-overflow-auto uk-table-divider uk-table-middle uk-table-striped">
                                <thead class="uk-visible@s v-cloak--hidden" :hidden="!goodsRows.length>0">
                                <tr>
                                    <th></th>
                                    <th>Состояние</th>
                                    <th>Внутренний код</th>
                                    <th>Трек (код изготовителя)</th>
                                    <th>Наименование</th>
                                    <th>Количество</th>
                                    <th>Цена</th>
                                </tr>
                                </thead>
                                <tbody :hidden="!goodsRows.length>0">
                                <tr class="" v-for="(ridx, idx) in goodsRows[0]">

                                    <td class="uk-hidden@s ">
                                        <span class="uk-label uk-label-warning">{{idx+1}}</span>
                                        <span class="uk-text-warning">{{ridx.state}}</span><br>
                                        <span>Внутр. номер:
                                        <button @click="enableSend()"
                                                class="uk-button uk-button-small uk-text-bolder uk-text-nowrap" style="background: #F4D848; color:black;">
                                        {{ridx.ic}}
                                        </button>
                                    </span><br>
                                        <span>Код изготовителя: {{ridx.c}}</span><br>
                                        <span>{{ridx.n}}</span><br>
                                        <span>Количество: {{ridx.q}}</span><br>
                                        <span>Сумма {{ridx.sum}}</span>
                                    </td>


                                    <!-- Large -->
                                    <td class="uk-visible@s v-cloak--hidden">
                                        <span>{{idx+1}}</span>
                                    </td>
                                    <td class="uk-visible@s v-cloak--hidden">
                                        <span class="uk-text-warning">{{ridx.state}}</span>
                                    </td>
                                    <td class="uk-visible@s v-cloak--hidden">
                                        <button @click="enableSend()"
                                                class="uk-button uk-button-small uk-text-bolder uk-text-nowrap" style="background: #F4D848; color:black;">
                                            {{ridx.ic}}
                                        </button>
                                    </td>
                                    <td class="uk-visible@s v-cloak--hidden">
                                        {{ridx.c}}
                                    </td>
                                    <td class="uk-visible@s v-cloak--hidden">
                                        {{ridx.n}}
                                    </td>
                                    <td class="uk-visible@s v-cloak--hidden">
                                        {{ridx.q}}
                                    </td>
                                    <td class="uk-visible@s v-cloak--hidden">
                                        {{ridx.sum}}
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
            orderRows:[],
            goodsRows:[],
            goodsData:[],
            oid:operid,
            //requestGoodsStatus:true,
            lastGoodId:888,
        },
        methods:{
            /*clearRowTracknumber:function(){
                this.onhandARows.splice(0,100);
                this.application=[];
            },*/
            clearRowOrders:function(){
                this.orderRows=[];
            },
            clearRowGoods:function(){
                this.goodsRows=[];
                this.goodsData=[];
            },
            openWindowGoods:function(a,id){

                if(this.lastGoodId*1 !=id){ 

                        this.clearRowGoods();
                        this.animRow=true;                        
                        var urlJ;
                        urlJ='/getgoodsbycliorder?o='+a;
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
            enableSend:function () {                
                return true;
            },
            getOrders:function(){                                 
                this.animRow=true;
                this.notFound=false;
                this.notFoundGoods=false;
                this.clearRowOrders();
                var urlJ;
                urlJ='/getallclientorders';
                axios.get(urlJ)
                .then(response => (
                        this.animRow=false,
                        this.isError(response.data), 
                        //console.log(JSON.stringify(response.data.res)),                                
                        this.orderRows.push(response.data.res)              
                        
                    )                       
                );
            },
            
        },
        mounted() {
             if(this.oid.length>0) {
                 //this.checkOid(this.oid);                                     
             }else{
                 this.getOrders();     
             }             
        }
    });
JS;

    $this->registerJs($script, yii\web\View::POS_END);
}
?>
