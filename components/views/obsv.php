
<div class="answer_title" >
    Приглашаем к сотрудничеству транспортные компании
</div>
<div class="hr"></div>
<form class=""  action="" method="post" onsubmit="return validForm();" >
    <div class="row">
        <div class="col-lg-4 col-md-12">


            <input type="text" id="named" class="form-control"  value="Имя" onclick="this.value=''"
                   placeholder="Имя" required />
        </div>
        <div class=" rel col-lg-4 col-md-12">


            <input type="tel" id="phone" class="form-control" value="Ваш телефон"
                   placeholder="Ваш телефон" required />
            <div id="tel"> неверный  телефон </div>


        </div>
        <div class="col-lg-4 col-md-12">

            <input type="text" id="email" class="form-control"   value="Ваша почта"
                   placeholder="Ваша почта" required />
            <div id="message">неверный e-mail</div>
        </div>

        <div class="col-lg-12">
            <div class=" area">


                <textarea cols="170" class="textarea" placeholder="Представьте вашу компанию" id="mess"   required></textarea>

                <div class="button">
                    <input  id="send" type="submit"  onclick="yaCounter44445358.reachGoal('Otpravit_soobcshenie');"  value="Отправить">
                </div>
            </div>
        </div>
    </div>
</form>