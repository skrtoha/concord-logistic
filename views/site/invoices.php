<?php

use app\models\Clients;

use app\models\Onhandclist;

$onPage = Yii::$app->params['onPageInvoices'];

$this->title = 'Invoices';
$cache = Yii::$app->cache;
$ClientID = Yii::$app->user->id;
$page = $page * 1;
if ($page < 0) {
    $page = 1;
}

$key = 'invoices_7_' . $ClientID . "_" . (($page * 1) - 1) . "_" . $onPage;
$inv = $cache->get($key);
if ($inv === false) {
    $inv = Onhandclist::getAllByClient(($page * 1) - 1, $onPage);
    $cache->set($key, $inv, 3600);
}

//$inv = Onhandclist::getAllByClient(($page * 1) - 1, $onPage);
/*$inv = $cache->getOrSet('invoices_' . $ClientID."_".(($page * 1) - 1)."_".$onPage, function () {
    return Onhandclist::getAllByClient(($page * 1) - 1,$onPage);
}, 3600);*/
/**
 * Пагинация
 */
$pages = ceil($inv['total'] / $onPage);
//echo($invo);
if ($inv['total'] > 0) {
    $i = 1;
    $pag = '<ul class="uk-pagination" uk-margin data-uk-pagination="{items:' . $inv['total'] . ', itemsOnPage:' . $onPage . '}">';
    if ($page == 1) {
        $classFirst = 'uk-active';
        $classFirstClick = 'uk-disabled';
        $link = '<span >1</span>';
    } else {
        $link = '<span ><a class="link-upload" href="/invoices?page=1">1</a></span>';
    }

    $pag .= '<li class="' . $classFirstClick . '"><a class="link-upload" href="/invoices?page=' . (($page - 1) > 0 ? $page - 1 : 1) . '"><span uk-pagination-previous></span></a></li>';
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
                    $pagin .= '<li class="' . $classNoLink . '"><span><a class="link-upload" href="/invoices?page=' . $i . '">' . $i . '</a></span></li>';
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
    $pag .= $minPoints . $pagin . $maxPoints . '<li class="' . $classEnd . '"><a class="link-upload" href="/invoices?page=' . $pages . '"><span >' . $pages . '</span></a></li>';
    $pag .= '<li class="' . $classEndClick . '"><a class="link-upload" href="/invoices?page=' . (($page < $pages) > 0 ? $page + 1 : $pages) . '"><span uk-pagination-next></span></a></li>';
    $pag .= '</ul>';
}
?>
    <h3 class="uk-heading-divider uk-margin-small uk-margin-small-left" id="app0">Invoices</h3>
    <div class="uk-card uk-card-default uk-grid uk-grid-collapse uk-child-width-1-1 uk-margin" uk-grid>
        <div class="uk-card-body" id="appOrders" v-cloak>
            <!--<div class="uk-background-cover" style="background-image: url('images/photo.jpg');" ></div>-->
            <div class=" uk-margin-small-top" uk-height-viewport>
                <?php
                echo $pag;
                ?>
                <div>
                    <?php
                    if (count($inv['res']) > 0) {
                        foreach ($inv['res'] as $key => $invoice) {
                            if ($invoice['id'] == $invo) {
                                $trigger = '';
                            } else {
                                $trigger = 'hidden="true"';
                            }
                            ?>
                            <div class="uk-overflow-auto">
                                <button class="uk-button  uk-button-primary  uk-button-large uk-width-1-3@m uk-margin-small-top"
                                        type="button"
                                        uk-toggle="target: #tab<?= $key ?>,#exportButton<?= $key ?>;animation: uk-animation-fade">
                                    <?= 'Invoice: #' . $invoice['id'] . ", " . $invoice['date'] . ", $" . $invoice['sum'] ?>
                                </button>
                                <button id="exportButton<?= $key ?>"
                                        class="uk-button uk-button-default uk-button-large uk-width-1-6@m uk-margin-small-top uk-visible@m"
                                        type="button" onclick="CallPrint('tab<?= $key ?>')"
                                        uk-icon="icon: print; ratio:1" hidden="true">Print
                                </button>

                                <div id="tab<?= $key ?>" <?= $trigger ?>>
                                    <h4><?= 'Invoice: #' . $invoice['id'] . ", " . $invoice['date'] . ", $" . $invoice['sum'] ?></h4>
                                    <h4 class="uk-margin-remove-top"><?= 'Forwarder: ' . $invoice['f'] ?></h4>
                                    <table class="uk-table uk-table-striped  uk-table-hover uk-box-shadow-large">
                                        <?php
                                        $i = 1;
                                        $r = '<thead><tr class="uk-text-emphasis">
                                            <th class="uk-visible@m">Position #</th>
                                            <th>Manufacturer</th>
                                            <th class="uk-visible@m">Catalog #</th>
                                            <th class="uk-visible@m">Description</th>
                                            <th>Q-ty</th>
                                            <th>Unit Price, USD</th>
                                            <th class="uk-visible@m">Extended Price, USD</th>
                                            <th class="uk-visible@m">Order#</th>
                                            </tr></thead>';
                                        foreach ($invoice['list'] as $item) {
                                            $linkOrder='';
                                            if(strlen($item['o'])>3) {
                                                $linkOrder = '<a href="/orders?o=' . $item['linkOrd'] . '" class="uk-button  uk-button-primary  uk-button-small link-upload">' . $item['o'] . '</a>';
                                            }
                                            $r .= '<tr class="uk-text-emphasis">
                                            <td class="uk-visible@m">' . $i . '</td>
                                            <td class="uk-text-break">' . $item['man'] . '
                                                    <span class="uk-hidden@s uk-text-break">' . $item['mpn'] . '<br></span>
                                                    <span class="uk-hidden@s">' . $item['d'] . '<br></span>
                                                    <span class="uk-hidden@s">' . $linkOrder . '<br></span>
                                            </td>
                                            <td class="uk-visible@m">' . $item['mpn'] . '</td>
                                            <td class="uk-visible@m">' . $item['d'] . '</td>
                                            <td>' . $item['q'] . '</td>
                                            <td>$' . $item['p'] . '</td>
                                            <td class="uk-visible@m">$' . $item['s'] . '</td>
                                            <td class="uk-visible@m">
                                                '.$linkOrder.'
                                            </td>
                                            </tr>';
                                            $i++;
                                        }
                                        $r .= '<tr>
                                            <td  class="uk-hidden@s" ></td>
                                            <td class="uk-visible@m" colspan="5"></td>
                                            <td colspan="3"><span class="uk-text-emphasis uk-text-bolder">Total: $' . $invoice['sum'] . '</span></td>
                                            </tr>';
                                        echo $r;
                                        ?>
                                    </table>
                                </div>

                            </div>
                            <?php
                        }
                    } else {
                        echo '<h3>Not invoices!</h3>';
                    }
                    ?>
                </div>
                <?php
                echo $pag;
                ?>
            </div>
        </div>
    </div>

<?php

//var prtJS = '<script src="/js/uikit.js"></script>';
$script = <<< JS

function CallPrint(strid) {
  var prtContent = document.getElementById(strid);
  var prtCSS = '<link rel="stylesheet" href="/css/uikit.theme.css" type="text/css" />';
  var WinPrint = window.open('','','left=50,top=50,width=1000,height=640,toolbar=0,scrollbars=1,status=0');
  WinPrint.document.write('<html><head>');
  WinPrint.document.write(prtCSS);
  WinPrint.document.write('<title>Print Invoice</title></head><body>');
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