<?php

use app\models\Orders;
use app\models\Paid;

$this->title = 'Orders History';

$onPage = Yii::$app->params['onPageOrders'];

$cache = Yii::$app->cache;
$ClientID = Yii::$app->user->id;

$allGoods = 0;
$allOrdersLink = '';
if ($orderNum != 0) {
    //$headerTxt="<h2>Orders by invoice #".$invoiceNum."</h2>";
    $allOrdersLink = '<a href="/orders" class="uk-button  uk-button-default  uk-button-large link-upload">View all orders</a>';
    $history = Orders::getOrderByOrderNum($orderNum);
    $allGoods = true;
} else {
    $key2 = 'orders_9_' . $ClientID . "_" . (($page * 1) - 1) . "_" . $onPage;
    $history = $cache->get($key2);
    if ($history === false) {
        $history = Orders::getAllByClient(($page * 1) - 1, $onPage);
        $cache->set($key2, $history, 600);
    }
}
//$history = Orders::getAllByClient(($page * 1) - 1, $onPage);
$test = Yii::$app->user->identity->CreationDate;
//$history = Orders::getAllByClient(($page * 1) - 1, $onPage);
//$history = Orders::getAllByClient(($page * 1) - 1, $onPage);
/*$history = $cache->getOrSet('history_' . $ClientID."_".(($page * 1) - 1)."_".$onPage, function () {
    return Orders::getAllByClient(($page * 1) - 1,$onPage);
}, 3600);*/
/**
 * Пагинация
 */
$pages = ceil($history['total'] / $onPage);
if ($page < 0) {
    $page = 1;
}

if ($history['total'] > 0) {
    $i = 1;
    $pag = '<ul class="uk-pagination" uk-margin >';//data-uk-pagination="{items:25, itemsOnPage:5}"
    if ($page == 1) {
        $classFirst = 'uk-active';
        $classFirstClick = 'uk-disabled';
        $link = '<span >1</span>';
    } else {
        $link = '<span ><a class="link-upload" href="/orders?page=1">1</a></span>';
    }
    $pag .= '<li class="' . $classFirstClick . '"><a class="link-upload" href="/orders?page=' . (($page - 1) > 0 ? $page - 1 : 1) . '"><span uk-pagination-previous></span></a></li>';
    if ($pages > 1) {
        $pag .= '<li class="' . $classFirst . '">' . $link . '</li>';
    }
    $minPg = 10000;
    $maxPg = 0;
    while ($i < $pages) {
        if ($i > 1) {
            if ($page - 2 == $i || $page - 1 == $i || $page == $i || $page + 1 == $i || $page + 2 == $i) {
                if ($i == $page) {
                    $classNoLink = 'uk-active';
                    $pagin .= '<li class="' . $classNoLink . '"><span>' . $i . '</span></li>';
                } else {
                    $classNoLink = '';
                    $pagin .= '<li class="' . $classNoLink . '"><span><a class="link-upload" href="/orders?page=' . $i . '">' . $i . '</a></span></li>';
                }
                $minPg = min($i, $minPg);
                $maxPg = max($i, $maxPg);
            }
        }
        $i++;
    }
    if ($pages == $page) {
        $classEnd = 'uk-active';
        $classEndClick = 'uk-disabled';
    }
    if ($minPg - 1 > 1 && $minPg != 10000) {
        $minPoints = '<li class="uk-disabled"><span> ... </span></li>';
    }
    if ($maxPg + 1 < $pages) {
        $maxPoints = '<li class="uk-disabled"><span> ... </span></li>';
    }
    $pag .= $minPoints . $pagin . $maxPoints . '<li class="' . $classEnd . '"><a class="link-upload" href="/orders?page=' . $pages . '"><span >' . $pages . '</span></a></li>';
    $pag .= '<li class="' . $classEndClick . '"><a class="link-upload" href="/orders?page=' . (($page < $pages) > 0 ? $page + 1 : $pages) . '"><span uk-pagination-next></span></a></li>';
    $pag .= '</ul>';
}
?>

    <h3 class="uk-heading-divider uk-margin-small uk-margin-small-left" id="app2">Orders History</h3>
    <div class="uk-card uk-card-default uk-grid uk-grid-collapse uk-child-width-1-1 uk-margin" uk-grid>
        <div class="uk-card-body" id="appOrders" v-cloak>
            <!--<div class="uk-background-cover" style="background-image: url('images/photo.jpg');" ></div>-->
            <div class=" uk-margin-small-top" uk-height-viewport>
                <?php
                echo $allOrdersLink;
                echo $headerTxt;
                if ($orderNum == 0) {
                    echo $pag;

                    ?>

                    <ul class="uk-subnav uk-subnav-pill" uk-switcher>
                        <li><a class="uk-button uk-button-large" href="#" @click="toggleList">By Orders</a></li>
                        <li><a class="uk-button uk-button-large" href="#" @click="toggleList">All Goods</a></li>
                    </ul>
                    <?php
                }
                ?>
                <div :hidden="allGoods">

                    <?php
                    $toggleElem='';
                    if (count($history['res']) > 0) {
                        //print_r($history['res']);
                        foreach ($history['res'] as $key => $his) {
                            $his['sum'] = round($his['sum'], 2);
                            $paid = 0;
                            $toggleElem='.toggle-usage'.$key;
                            $orderPaid = \app\models\OrderCrossPayment::find()
                                ->select(['foMoneyAmount', 'foValutaRatio'])
                                ->where(['ordDocNum' => $his['doc']])
                                ->all();
                            if (count($orderPaid) > 0) {
                                foreach ($orderPaid as $item) {
                                    $paid = $paid + $item['foMoneyAmount'] / $item['foValutaRatio'];
                                }
                                $paid = round($paid, 2);
                            }

                            /*$orderPaid = Paid::find()
                                ->select(['paid'])
                                ->where(['DocNum' => $his['doc']])
                                ->all();
                            if (count($orderPaid) > 0) {
                                foreach ($orderPaid as $item) {
                                    $paid = $paid + $item['paid'] / 100;
                                }
                            }*/
                            $paid = round($paid, 2);

                            $labelClass = ' uk-label-success';

                            if (strlen($his['comment']) == 0) {
                                $his['comment'] = 'No notes';
                                $labelClass = '';
                            }
                            ?>
                            <div class="uk-overflow-auto" style="margin-top: 20px;">
                                <div class="uk-width-1-1">
                                    <span class="uk-label <?= $labelClass ?>">Order Note</span><span
                                            style="background:lightyellow; padding:5px;"
                                            :hidden="<?= strlen($his['comment']) ?>==0?true:false"><?= $his['comment'] ?></span>
                                    <span class="uk-label uk-label-warning"
                                          :hidden="<?= strlen($his['delivery']) ?>==0?true:false"><?= $his['delivery'] ?></span>
                                </div>
                                <button class="uk-button  uk-button-primary uk-button-large uk-width-1-3@m uk-margin-small-top "
                                        type="button"
                                        uk-toggle="target: .toggle-usage<?= $key ?>;animation: uk-animation-fade">
                                    <?= $his['type'] . ': #' . $his['doc'] . ", " . $his['date'] . ", $" . $his['sum'] ?>
                                </button>
                                <button class="uk-button  uk-button-success uk-button-small "
                                        :hidden="<?= $paid ?>==0?true:false">
                                    Paid: $<?= $paid ?>
                                </button>
                                <a class="uk-button  uk-button-danger uk-button-small link-upload"
                                   :hidden="<?= ($his['sum'] - $paid) ?><=0?true:false"
                                   href="/payment?o=<?= $his['doc'] ?>&s=<?= ($his['sum'] - $paid) ?>">
                                    To Pay $ <?= ($his['sum'] - $paid) ?>
                                </a>
                                <div class="uk-width-1-1">
                                    <button id="exportButton<?= $key ?>"
                                            class="uk-button uk-button-default uk-button-large uk-width-1-6@m uk-margin-small-top uk-visible@m toggle-usage<?= $key ?>"
                                            type="button" @click="exportData('<?= $his['doc'] ?>','tab<?= $key ?>')"
                                            uk-icon="icon: file-text; ratio:1" hidden="true">Export to Excel
                                    </button>
                                    <button id="printButton<?= $key ?>"
                                            class="uk-button uk-button-default uk-button-large uk-width-1-6@m uk-margin-small-top uk-visible@m toggle-usage<?= $key ?>"
                                            type="button" onclick="CallPrint('tab<?= $key ?>')"
                                            uk-icon="icon: print; ratio:1" hidden="true">Print
                                    </button>
                                </div>

                                <!--<button onclick="exportToExcel('toggle-usage<?/*= $key */ ?>')">Export Table Data To Excel File</button>-->
                                <div id="tab<?= $key ?>">

                                    <table :hidden="!allGoods"
                                           class="uk-table uk-table-hover uk-box-shadow-large uk-table-striped toggle-usage<?= $key ?>">
                                        <?php
                                        $i = 1;
                                        $r = '<thead>
                                            <tr class="uk-text-emphasis">
                                                <th>Part #</th>
                                                <th class="uk-visible@m">Manufacturer</th>
                                                <th class="uk-visible@m">Name</th>
                                                <th class="uk-visible@m">Weight</th>
                                                <th class="uk-visible@m">Status</th>
                                                <th class="uk-visible@m">Date of Status Change</th>
                                                <th class="uk-visible@m">Manager Info</th>
                                                <th class="uk-visible@m">Invoice</th>
                                                <th>Qty</th>
                                                <th>Price</th>
                                            </tr>
                                          </thead>';
                                        if ($his['list'] > 0) {
                                            foreach ($his['list'] as $item) {
                                                if (strlen($item['we']) > 0) {
                                                    $item['weight'] = $item['we'];
                                                    $item['we'] = "&nbsp;<span class=\"uk-label \">Weight: " . $item['we'] . "</span>";
                                                } else {
                                                    $item['weight'] = '';
                                                }
                                                $invs = "";
                                                if (strlen($item['inv']) > 0) {
                                                    $invoives = $item['inv'];
                                                    $item['inv'] = "<br>Invoice: " . $item['inv'];
                                                    $invoivesExp = explode(',', $invoives);
                                                    if (count($invoivesExp) > 0) {
                                                        foreach ($invoivesExp as $itemInv) {
                                                            $invs .= '<button  @click="viewInvoices(\'' . $itemInv . '\')"  class="uk-button uk-button-small uk-button-primary " uk-toggle="target: #modal-close-default">' . $itemInv . '</button>';
                                                        }
                                                    }
                                                }
                                                //$item['stcode']
                                                $manInfo = '';
                                                if (strlen($item['stcode']) > 0) {
                                                    $manInfo = '<br>Manager info: ' . $item['stcode'];
                                                }
                                                if ($item['s'] != 'Deleted from Client Order') {
                                                    $r .= '<tr class="uk-text-emphasis">
                                                        <td class="uk-text-break">' . $item['mpn'] . '
                                                            <span class="uk-hidden@s">' . $item['man'] . ' </span>
                                                            <span class="uk-hidden@s"><br>' . $item['n'] . $item['we'] . '</span>
                                                            <span class="uk-hidden@s" style="color:' . $item['cl'] . ';"><br>' . $item['s'] . ' ' . $item['std'] . $invs . ' </span>
                                                            <span class="uk-hidden@s">' . $manInfo . '</span>
                                                        </td>
                                                        <td  class="uk-visible@m">' . $item['man'] . '</td>
                                                        <td  class="uk-visible@m">' . $item['n'] . '</td>
                                                        <td  class="uk-visible@m">' . $item['weight'] . '</td>
                                                        <td  class="uk-visible@m"><span style="color:' . $item['cl'] . ';">' . $item['s'] . '</span></td>
                                                        <td  class="uk-visible@m">' . $item['std'] . '</td>
                                                        <td  class="uk-visible@m">' . $item['stcode'] . '</td>
                                                        <td  class="uk-visible@m">' . $invs . '</td>
                                                        <td>' . $item['q'] . '</td>
                                                        <td>$' . $item['p'] . '</td>
                                                    </tr>';
                                                    $rr .= '<tr class="uk-text-emphasis">
                                                        <td class="uk-text-break">' . $item['mpn'] . '
                                                            <span class="uk-hidden@s">' . $item['man'] . ' </span>
                                                            <span class="uk-hidden@s"><br>' . $item['n'] . $item['we'] . '</span>
                                                            <span class="uk-hidden@s" style="color:' . $item['cl'] . ';"><br>' . $item['s'] . ' ' . $item['std'] . $invs . '</span>
                                                            <span class="uk-hidden@s">' . $manInfo . '</span>
                                                        </td>
                                                        <td  class="uk-visible@m">' . $item['man'] . '</td>
                                                        <td  class="uk-visible@m">' . $item['n'] . '</td>
                                                        <td  class="uk-visible@m">' . $item['weight'] . '</td>
                                                        <td  class="uk-visible@m"><span style="color:' . $item['cl'] . ';">' . $item['s'] . '</span></td>
                                                        <td  class="uk-visible@m">' . $item['std'] . '</td>
                                                        <td  class="uk-visible@m">' . $item['stcode'] . '</td>
                                                        <td  class="uk-visible@m">' . $invs . '                                                        
                                                        
                                                        </td>
                                                        <td>' . $item['q'] . '</td>
                                                        <td>$' . $item['p'] . '</td>
                                                    </tr>';
                                                    $i++;
                                                }
                                            }
                                        }
                                        $r .= '<tr >
                                                <td  class="uk-hidden@s" ></td>
                                                <td class="uk-visible@m" colspan="4"></td>
                                                <td colspan="2" class="uk-text-emphasis uk-text-bolder">Total: $' . $his['sum'] . '</td> 
                                            </tr>';
                                        echo $r;
                                        ?>
                                    </table>
                                </div>
                            </div>

                            <?php
                        }

                    } else {
                        echo '<h3>Not orders!</h3>';
                    }
                    ?>
                </div>
                <div class="uk-overflow-auto" :hidden="!allGoods">
                    <button id="exportButton"
                            class="uk-button uk-button-default uk-button-large uk-width-1-6@m uk-margin-small-top uk-visible@m"
                            type="button" @click="exportData(' All Goods','tabAllGoods')"
                            uk-icon="icon: file-text; ratio:1"
                    >Export to Excel
                    </button>
                    <div id="tabAllGoods">
                        <table class="uk-table uk-table-hover uk-box-shadow-large uk-table-striped">
                            <thead>
                            <tr class="uk-text-emphasis">
                                <th>Part #</th>
                                <th class="uk-visible@m">Manufacturer</th>
                                <th class="uk-visible@m">Name</th>
                                <th class="uk-visible@m">Weight</th>
                                <th class="uk-visible@m">Status</th>
                                <th class="uk-visible@m">Date of Status Change</th>
                                <th class="uk-visible@m">Manager Info</th>
                                <th class="uk-visible@m">Invoice</th>
                                <th>Qty</th>
                                <th>Price</th>
                            </tr>
                            </thead>
                            <?= $rr ?>
                        </table>
                        <div id="modal-close-default" class="uk-modal-container uk-margin-small" uk-modal>
                            <div class="uk-modal-dialog">
                                <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>
                                <div class="uk-grid-collapse uk-child-width-1-1@s uk-flex-middle" uk-overflow-auto>
                                    <!--<div class="uk-background-cover" style="background-image: url('images/photo.jpg');" ></div>-->
                                    <div class="uk-padding-large ">
                                        <h4>Invoice {{invoice}}, {{date}}, ${{sumtotal}}</h4>
                                        <h4 class="uk-margin-remove-top">Forwarder: {{forvarder}}</h4>

                                    </div>
                                    <div class="" uk-height-viewport>
                                        <table class="uk-table uk-table-striped  uk-table-hover uk-box-shadow-large">
                                            <thead>
                                            <tr class="uk-text-emphasis">
                                                <th class="uk-visible@m">Position #</th>
                                                <th>Manufacturer</th>
                                                <th class="uk-visible@m">Catalog #</th>
                                                <th class="uk-visible@m">Description</th>
                                                <th>Q-ty</th>
                                                <th>Unit Price, USD</th>
                                                <th class="uk-visible@m">Extended Price, USD</th>
                                            </tr>
                                            </thead>
                                            <tr class="uk-text-emphasis" v-for="(ridx, idx) in invoiceRows[0]">
                                                <td class="uk-visible@m">{{idx+1}}</td>
                                                <td class="uk-text-break">{{ridx.man}}
                                                    <span class="uk-hidden@s uk-text-break">{{ridx.mpn}}<br></span>
                                                    <span class="uk-hidden@s">{{ridx.d}}<br></span>
                                                </td>
                                                <td class="uk-visible@m">{{ridx.mpn}}</td>
                                                <td class="uk-visible@m">{{ridx.d}}</td>
                                                <td>{{ridx.q}}</td>
                                                <td>${{ridx.p}}</td>
                                                <td class="uk-visible@m">${{ridx.s}}</td>
                                            </tr>
                                            <tr>
                                                <td class="uk-hidden@s"></td>
                                                <td class="uk-visible@m" colspan="5"></td>
                                                <td colspan="2"><span class="uk-text-emphasis uk-text-bolder">Total: $ {{sumtotal}}</span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="uk-position-center" :hidden="!animFindIntercange">
                                    <div class="uk-text-danger uk-text-bold uk-align-center" uk-spinner="ratio: 5"
                                         :hidden="!animFindIntercange"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                if ($orderNum == 0) {
                    echo $pag;
                }
                ?>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="js/Filesaver.min.js"></script>
    <script>
        var allGScr = <?=$allGoods?>;
        var elToggle = '<?=$toggleElem?>';
    </script>
<?php
$script = <<< JS
new Vue({
        el: '#appOrders',
        data: {
            allGoodsScr:allGScr,
            elemToggle:elToggle,
            allGoods: false,
            counter:0, 
            invoice:'',
            date:'',
            invoiceRows:[],
            animFindIntercange:false,
            sumtotal:'',
            forvarder:'',
        },
        methods:{
            toggleList:function () {
                if(this.allGoods===false){
                    this.allGoods=true;
                }else{
                    this.allGoods=false;
                }
            },
            clearRowInvoice:function() {
              this.invoiceRows.splice(0,350);
            },
            viewInvoices:function(inv){
                //console.log(event);
                //this.goodId=this.goodsArray[0][event.target.value].id;
                //pageApp.invoice=inv;
                this.putInvoices(inv);
            },
            setVariables:function(a){
                if(a.error){
                    console.log(a.error[0].text);
                }else{
                    //for(i=0;i<this.invoiceRows[0].length;i++){  
                        //console.log((this.interchangeRows[0][0]));
                        //Vue.set(this.qty, i, 1);
                        //Vue.set(this.addedToCart, i, false);  
                        //for(j=0;j<this.invoiceRows[0][i].list.length;j++){ 
                            //Vue.set(this.invoice, i, i+1);
                            this.date=a.res.goods.date;
                            this.forvarder=a.res.goods.f;
                            this.sumtotal=a.res.goods.sum;
                            //console.log(a);
                            //Vue.set(this.sumtotal, i, a[0].goods.sum);
                            //Vue.set(this.code, i, this.invoiceRows[0][0].list[i].mpn);
                        //}
                    //}
                }
            },
            putInvoices:function(inv){
                this.invoice=inv;
                //console.log(this.interchangeCode,this.interchangeManufacturer);
                if(inv.length>1 ){
                    this.animFindIntercange=true;  
                    this.clearRowInvoice();
                    
                    var urlJ='/api/getinvoice?invNum='+inv;

                    axios
                    //.get('https://api.coindesk.com/v1/bpi/currentprice.json')
                    .get(urlJ)
                    .then(response => (   
                            this.animFindIntercange=false,
                            this.invoiceRows.push(response.data.res.goods.list) , 
                            this.setVariables(response.data)                        
                            //console.log(JSON.stringify(this.invoiceRows))
                        )                       
                    );                    
                    //this.animRow=true;

                }else{
                    //console.log(888);
                }
            },
            exportData: function (adr,elm) {
                console.log(adr,elm);
                
                var elem = document.getElementById(elm);
                var blob = new Blob([elem.innerHTML], {
                    type: "application/vnd.ms-excel"
                });
                saveAs(blob, "order-"+adr+".xls");
            },
            
        },
        mounted() {
            //this.allGoods=allGoodsScr;
            if(this.allGoodsScr){
                var highlightedItems = document.querySelectorAll(this.elemToggle);
                highlightedItems.forEach(function(userItem) {
                  //console.log(userItem);
                  UIkit.toggle(userItem).toggle();
                });                
            }
        },
    });

function CallPrint(strid) {
    var prtContent = document.getElementById(strid);
    var prtCSS = '<link rel="stylesheet" href="/css/uikit.theme.css" type="text/css" />';
    var WinPrint = window.open('','','left=50,top=50,width=1000,height=640,toolbar=0,scrollbars=1,status=0');
    WinPrint.document.write('<html><head>');
    WinPrint.document.write(prtCSS);
    WinPrint.document.write('<title>Print</title></head><body>');
    WinPrint.document.write('<div id="print" class="contentpane">');  
    WinPrint.document.write(prtContent.innerHTML);
    WinPrint.document.write('</div>');
    WinPrint.document.write('</body></html>');
    WinPrint.document.close();
    WinPrint.focus();
    WinPrint.print();
    WinPrint.close();
    //prtContent.innerHTML=strOldOne;
}

JS;
$this->registerJs($script, yii\web\View::POS_END);
?>