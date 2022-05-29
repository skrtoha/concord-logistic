
var h_hght = 150; // высота шапки
   var h_mrg = 0;     // отступ когда шапка уже не видна
  
$(function(){
    $(window).scroll(function(){
       var top = $(this).scrollTop();
       var elem = $('#head_visible');
       if (top+h_mrg < h_hght) {
        elem.css('top', (h_hght-top));
         
       } else {
        elem.css('top', h_mrg);
            
       }
     });
   });


