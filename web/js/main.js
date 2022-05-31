
$(window).scroll(function() {
    $('.mov').each(function(){
      var imagePos = $(this).offset().top;
      var topOfWindow = $(window).scrollTop();
      if (imagePos < topOfWindow +950) {
          $(this).addClass('bounceInLeft');


      }
    })
  });

  $(window).scroll(function() {
    $('.mov2').each(function(){
      var imagePos = $(this).offset().top;
      var topOfWindow = $(window).scrollTop();
      if (imagePos < topOfWindow +950) {
        $(this).addClass('bounceInRight');

      }
    });
  });
  $(window).scroll(function() {
    $('.mov3').each(function(){
      var imagePos = $(this).offset().top;
      var topOfWindow = $(window).scrollTop();
      if (imagePos < topOfWindow +950) {
        $(this).addClass('fadeInUp');
      }
    });
  });


 function ValidMail() {
    var re = /^[\w-\.]+@[\w-]+\.[a-z]{2,4}$/i;
    var myMail = document.getElementById('email').value;
    var valid = re.test(myMail);
    if (valid){
        output = '';
    }else {
        output = message.style.display = "block";
    }
    return valid;
}

function ValidPhone() {
    //alert(545);
    var re = /^[\+\d][\d\(\)\ -]{4,14}\d$/;
    var myPhone = document.getElementById('phone').value;
    var valid = re.test(myPhone);
    console.log(valid);
    if (valid) {
        output = '';
    }else{
       tel.style.display = "block";
    }
    return valid;
}

function validForm(){
    var vm=ValidMail();
    var vp=ValidPhone();
    console.log("vemail:"+vm+";vphone:"+vp);
    if(vm==true && vp==true){
        return false;
    }else{

        return false;
    }
}

if(document.getElementById('phone')) {
    document.getElementById('phone').onclick = function () {
        document.getElementById('phone').value = "";
        document.getElementById('tel').style.display = 'none';
    };
}
if(document.getElementById('email')) {
    document.getElementById('email').onclick = function () {
        document.getElementById('email').value = "";
        document.getElementById('message').style.display = 'none';
    };
}
  /**** SEND POST ****/
    $("#send").click(function(e) {
        $.ajax({
            type: 'POST',
            url: "/topostsend",
            data: {
                name: $("#named").val(), //Добавить id к input
                mail: $("#email").val(),
                phone: $("#phone").val(),
                mess: $("#mess").val() //Добавить id к input
            }
        }).done(function (res) {
            if(res=='Successfully') {
                swal({
                    title: "",
                    type: "success",
                    text: "Ваш запрос отправлен, в ближайшее время мы свяжемся с вами, чтобы сделать предложение",
                    timer: 4000,
                    confirmButtonColor: '#FBC415'
                });
            }else if(res=='Unsuccessfully'){
                swal({
                    title: "",
                    type: "error",
                    text: "Ваше сообщение не отправлено",
                    timer: 2000,
                    confirmButtonColor: '#FBC415'
                });
            }else{
                swal({
                    title: "",
                    type: "error",
                    text: "Ваше сообщение не отправлено. Заполните все поля",
                    timer: 3000,
                    confirmButtonColor: '#FBC415'
                });
            }
        });
    });

    /**** SEND POST CALC****/
    function validatePhone(phone){
        let regex = /^(\+7|7|8)?[\s\-]?\(?[489][0-9]{2}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$/;
        return regex.test(phone);
    }
    $('#sendCalcStep1').on('click', function () {
        $('#calcDiv1').hide("fast");
        $('#calcDiv2').show("slow");
    });
    $("#calcFormUK").click(function(e) {

        var phone=$( "#phoneCalc" ).val();
        if (!validatePhone(phone)){
            swal({
                title: "",
                type: "error",
                text: "Укажите номер телефона",
                timer: 2000,
                confirmButtonColor: '#FBC415'
            });
        }else {
            $.ajax({
                type: 'POST',
                url: "/sendcalc",
                data: {
                    //from: $("#fromCalc option:selected").text(), //Добавить id к input
                    from: $("#fromCalc").val(),
                    to: $("#toCalc option:selected").text(),
                    cat: $("#catCalc option:selected").text(),
                    weight: $("#weightCalc").val(),
                    volume: $("#volumeCalc").val(),
                    cost: $("#costCalc").val(),
                    cost_currency: $("#cost_currencyCalc").val(),
                    result_currency: $("#result_currencyCalc").val(),
                    insurance: $("#insuranceCalc").val(),
                    custom_clearance: $("#custom_clearanceCalc").val(),
                    name: $("#nameCalc").val(),
                    phone: phone,
                    email: $("#emailCalc").val(),

                }
            }).done(function (res) {
                if (res == 'Successfully') {
                    swal({
                        title: "",
                        type: "success",
                        text: "Ваш запрос отправлен, в ближайшее время мы свяжемся с вами, чтобы сделать предложение",
                        timer: 4000,
                        confirmButtonColor: '#FBC415'
                    });
                    $('#calcDiv2').hide("fast");
                    $('#calcDiv1').show("slow");
                } else if (res == 'Unsuccessfully') {
                    swal({
                        title: "",
                        type: "error",
                        text: "Ваше сообщение не отправлено",
                        timer: 2000,
                        confirmButtonColor: '#FBC415'
                    });
                } else {
                    swal({
                        title: "",
                        type: "error",
                        text: "Ваше сообщение не отправлено",
                        timer: 2000,
                        confirmButtonColor: '#FBC415'
                    });
                }
            });
        }
    });

    /**** SEND POST CALC****/
    $("#add").click(function(e) {
        $.ajax({
            type: 'POST',
            url: "/topostsend",
            data: {
                name: $("#name").val(), //Добавить id к input
                mail: $("#mail").val(),
                phon: $("#phon").val(),
                text: $("#text").val(),
                cm: $("#cm").val(),
                weight: $("#weight").val(),
                hei: $("#hei").val(),
                lenght: $("#lenght").val(),
                width: $("#width").val(),
                air: $("#air").val(),
                to: $("#to").val(),
                from: $("#from").val()
            }
        }).done(function (res) {
            if(res=='Successfully') {
                swal({
                    title: "",
                    type: "success",
                    text: "Ваш запрос отправлен, в ближайшее время мы свяжемся с вами, чтобы сделать предложение",
                    timer: 4000,
                    confirmButtonColor: '#FBC415'
                });

            }else if(res=='Unsuccessfully'){
                swal({
                    title: "",
                    type: "error",
                    text: "Ваше сообщение не отправлено",
                    timer: 2000,
                    confirmButtonColor: '#FBC415'
                });
            }else{
                swal({
                    title: "",
                    type: "error",
                    text: "Ваше сообщение не отправлено",
                    timer: 2000,
                    confirmButtonColor: '#FBC415'
                });
            }
        });
    });