$(document).ready(function () {
    $(window).scroll(function () {
        var bo = $(this).scrollTop();
        var a = $("#top").css('opacity');
        $("#top").bo;
        if (bo >= 500 && a == 0) {
            $("#top").stop().animate({'opacity': '1'}, 500)
        };
        if (bo < 800 && a == 1) {
            $("#top").stop().animate({'opacity': '0'}, 500)
        };
    })
});


function Add() {
    var from = document.getElementById('from').value;
    var air = document.getElementById('air').value;
    var name = document.getElementById('name').value;
    var phone = document.getElementById('phone').value;
    var mail = document.getElementById('mail').value;
    var width = document.getElementById('width').value;
    var lenght = document.getElementById('lenght').value;
    var weight = document.getElementById('weight').value;
    var to = document.getElementById('to').value;
    var text = document.getElementById('text').value;
    var cm = document.getElementById('cm').value;
    var hei = document.getElementById('hei').value;
    if (from && name && phone && mail && air && width && lenght && weight && to && text && cm) {
        var tr = document.createElement('tr');

        var td1 = document.createElement('td');
        var td2 = document.createElement('td');
        var td3 = document.createElement('td');
        var td4 = document.createElement('td');
        var td5 = document.createElement('td');
        var td6 = document.createElement('td');
        var td7 = document.createElement('td');
        var td8 = document.createElement('td');
        var td9 = document.createElement('td');
        var td10 = document.createElement('td');
        var td11 = document.createElement('td');
        var td12 = document.createElement('td');
        var td13 = document.createElement('td');

        var text1 = document.createTextNode(name);
        var text2 = document.createTextNode(phone);
        var text3 = document.createTextNode(mail);
        var text4 = document.createTextNode(from);
        var text5 = document.createTextNode(to);
        var text6 = document.createTextNode(air);
        var text7 = document.createTextNode(width);
        var text8 = document.createTextNode(lenght);
        var text9 = document.createTextNode(hei);
        var text10 = document.createTextNode(weight);
        var text11 = document.createTextNode(cm);
        var text12 = document.createTextNode(text);
        var text13 = document.createElement("button");
        text13.style.cssText = "color: white !important; \
    border: 1px solid red; \
    background-color: red; \
    width: 100px; \
    text-align: center; \
    blabla: 5; \
  ";
        var buttext = document.createTextNode("Ответить");
        var atr = document.createAttribute('onclick');
        atr.value = 'deleteRow(this);';
        text13.appendChild(buttext);
        text13.setAttributeNode(atr);

        td1.appendChild(text1);
        td2.appendChild(text2);
        td3.appendChild(text3);
        td4.appendChild(text4);
        td5.appendChild(text5);
        td6.appendChild(text6);
        td7.appendChild(text7);
        td8.appendChild(text8);
        td9.appendChild(text9);
        td10.appendChild(text10);
        td11.appendChild(text11);
        td12.appendChild(text12);
        td13.appendChild(text13);
        tr.appendChild(td1);
        tr.appendChild(td2);
        tr.appendChild(td3);
        tr.appendChild(td4);
        tr.appendChild(td5);
        tr.appendChild(td6);
        tr.appendChild(td7);
        tr.appendChild(td8);
        tr.appendChild(td9);
        tr.appendChild(td10);
        tr.appendChild(td11);
        tr.appendChild(td12);

        tr.appendChild(td13);
        var table = document.getElementById('table');
        table.appendChild(tr);
        console.log("added");
    }
}
function delall() {
    var table = document.getElementById('table');

    for (var i = table.rows.length - 1; i > 0; i--) {
        table.deleteRow(i);
    }
}
function deleteRow(r) {
    var i = r.parentNode.parentNode.rowIndex;
    document.getElementById("table").deleteRow(i);
}