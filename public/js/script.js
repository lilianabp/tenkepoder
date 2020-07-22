$(window).on("load", function() {
    "use strict";

    // LOADER 

    $(".preloader").fadeOut();

    // RESPONSIVE MOBILE MENU 

    $(".menu-btn").on("click", function() {
      $(".responsive-mobile-menu").toggleClass("show");
      return false;
    });

    $("html").on("click", function() {
      $(".responsive-mobile-menu").removeClass("show");
    });
    $(".menu-btn, .responsive-mobile-menu").on("click", function(e) {
      e.stopPropagation();
    })

    // CONTACT FORM VALIDATION  

    if($('#contact-form').length){
      $('#submit').click(function(){
        
              var o = new Object();
              var form = '#contact-form';
        
              var name = $('#contact-form .name').val();
              var email = $('#contact-form .email').val();
              var phone = $('#contact-form .phone').val();
              var locale = document.location.pathname.split('/');
        if(name == '' || email == '' || phone == '')
        {
          if(locale[1] == 'en') {
            $('#contact-form .response').html('<div class="failed">Please fill the required fields *.</div>');
          } else {
            $('#contact-form .response').html('<div class="failed">Por favor completa los campos requeridos *.</div>');
          }
          
          return false;
        }
              
        $.ajax({
            url:"/"+locale[1]+"/contact",
            method:"POST",
            data: $(form).serialize(),
            beforeSend:function(){
                if(locale[1] == 'en') {
                    $('#contact-form .response').html('<div class="text-info"><img src="images/preloader.gif"> Sending...</div>');
                } else {
                     $('#contact-form .response').html('<div class="text-info"><img src="images/preloader.gif"> Enviando...</div>');
                }
            },
            success:function(data){
                $('form').trigger("reset");
                $('#contact-form .response').fadeIn().html(data);
                setTimeout(function(){
                    $('#contact-form .response').fadeOut("slow");
                }, 5000);
            },
            error:function(data){
                $('#contact-form .response').fadeIn().html(data);
            }
        });
    });
    }

});


