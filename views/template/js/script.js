// JavaScript Document
$(document).ready(function(){
    /* ===Аккордеон=== */
   	var openItem = false;
   	if($.cookie("openItem") && $.cookie("openItem") != 'false'){
   		var openItem = parseInt($.cookie("openItem"));
   	}
   $.fn.slideFadeToggle = function(speed, easing, callback) {
            return this.animate({opacity: 'toggle', height: 'toggle'}, speed, easing, callback);
        };
       $( "#accordion" ).accordion({
   		  active: openItem,
   		  collapsible: true,
           autoHeight: false,
        header: 'h3',
    fillSpace: true,  
	animateOpen: function (elem, opts) { //replace the standard slideUp with custom function
                elem.next().stop(true, true).slideFadeToggle(opts.speed);
            },
            animateClose: function (elem, opts) { //replace the standard slideDown with custom function
                elem.next().stop(true, true).slideFadeToggle(opts.speed);
            }
       });
   	$("#accordion h3").click(function(){
   		$.cookie("openItem", $("#accordion").accordion("option", "active"));
   	});
   	$("#accordion > li").click(function(){
   		$.cookie("openItem", null);
        var link = $(this).find('a').attr('href');
        window.location = link;
   	});
    /* ===Аккордеон=== */
          
       $("#section").change(function () {
           // Запрашиваем у сервера рубрики
           self.location = "/gold_pages2/addsection/id/" + this.value;
       });
    
       $("#section_add_object").change(function () {
           self.location = "/gold_pages2/addobject/id/" + this.value;
       });       
	   
   	/* === Button "top" === */
      var top_show = 150; // В каком положении полосы прокрутки начинать показ кнопки "Наверх"
      var delay = 1000; // Задержка прокрутки
      
       $(window).scroll(function () { // При прокрутке попадаем в эту функцию
         /* В зависимости от положения полосы прокрукти и значения top_show, скрываем или открываем кнопку "Наверх" */
         if ($(this).scrollTop() > top_show) $('#top').fadeIn();
         else $('#top').fadeOut();
       });
       $('#top').click(function () { // При клике по кнопке "Наверх" попадаем в эту функцию
         /* Плавная прокрутка наверх */
         $('body, html').animate({
           scrollTop: 0
         }, delay);
       });
	
   	/* === Limit simbols === */
   	$('input#keywords').limit('255','#charsLeft');
});