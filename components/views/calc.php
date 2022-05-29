<?php
error_reporting(0);
$str = file_get_contents('rates1.json');
$json = json_decode($str, true);
$showTab=false;
foreach ($json as $value){
    foreach ($value as $key=>$val){
        $i=0;
        foreach ($val as $k=>$v) {
            //echo $k . "=>" . $v . "\n";
            if($k=='type') {
                $showTab=true;
                $tab .= '<tr style=""><td colspan="9" style="background: #F4D848;color:#4A4B4D;text-align:center;font-weight: bold;padding: 10px 3px 3px;">'.$v.' </td></tr>';
            }else{
                if($i==1){
                    $tab.="<tr style=''>";
                    $tab1.="<tr style=''>";
                    $st="width:30%;";
                }else{
                    $st="";
                }
                if($k=="destination"){

                }else{

                }
                $tab .= '<td style="background: #4A4B4D;color:#ffffff;font-weight: bold;padding: 5px;text-align:center;'.$st.'">'.$k.'</td>';
                $tab1 .= '<td style="background: #C5C7CA;color:#4A4B4D;font-weight: bold;padding: 5px;text-align:center;'.$st.'">'.$v.'</td>';
                if($i==count($val)-1){
                    $tab.="</tr>";//<tr><td colspan="9">&nbsp;</td></tr>
                    $tab1.="</tr>";
                    $tab=$tab.$tab1;
                    $tab1="";
                }

            }
            $i++;
        }
    }
}
if($showTab) {
    $table = '<div class="form-title"></div><table border="2" cellspacing="2" bgcolor="#ffffff" style="width: 100%;">' . $tab . '</table>
<div style="width: 100%;text-align: center;margin-top: 20px;"><input type="button" class="btn btn-primary" id="step_1_but" style="padding: 15px;" value="Узнать подробнее" onclick="yaCounter44445358.reachGoal(\'Uznat_podrobnee\');"></div>';

    $disp='display: none;';
}
?>
<link rel="stylesheet" href="/css/calculate.css?3">
<form class="form" onsubmit="return false;">
    <div class="form-title">
        <?=$titleCalc?>
    </div>

    <?=$table?>

    <div id="2_st"  style="<?=$disp?>">
        <div class="form-title">
            Заказчик
        </div>
        <div class="logist">
  <textarea  type="text" id="text" name="shipment" placeholder="комментарии, тип груза и описание"
             onclick="this.value=''" ></textarea>
            <input id="name"  value=""
                   onclick="this.value=''" placeholder="имя" style="width: 24%;">
            <input id="phon"  value=""
                   onclick="this.value=''" placeholder="телефон" style="width: 24%;">
            <input id="mail"  value=""
                   onclick="this.value=''" placeholder="почта" style="width: 24%;">
            <input id="to" name="to" value=""
                   onclick="this.value=''" placeholder="город доставки" style="width: 24%;">
            <button class="btn btn-primary" id="add" onclick="yaCounter44445358.reachGoal('Poluchit_predlojenie');" style="padding: 15px;">Получить предложение</button>
        </div>
    </div>
</form>
