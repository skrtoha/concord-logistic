<?php

//use app\models\Tracktry;

?>
<script type="text/javascript" src="//s.trackingmore.com/plugins/v1/buttonCurrent.js"></script>
<div id="track" class="container" style="" >
    <div class="row">
        <div class="col-lg-12" style="margin-top: 60px;">
            <h2>Отслеживание тест</h2>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div style="width: 100%;margin:0 auto;text-align:center;">
                <form role="form" action="//track.trackingmore.com" method="get" onsubmit="return false">
                    <div class="TM_input-group">
                        <input type="text" class="TM_my_search_input_style " id="button_tracking_number"
                               placeholder="Tracking Number" name="button_tracking_number" value="" autocomplete="off"
                               maxlength="100" style="border-color: #F4D848">
                        <span class="TM_input-group-btn">
               <button class="TM_my_search_button_style " id="query" type="button" onclick="return doTrack()"
                       style="background-color: #F4D848">Track</button>
           </span>
                    </div>
                    <input type="hidden" name="lang" value="ru"/>
                    <input id="button_express_code" type="hidden" name="lang" value=""/>
                </form>
                <div id="TRNum"></div>
            </div>
        </div>
    </div>
</div>
