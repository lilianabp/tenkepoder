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
        var privacy = $('#contact_privacy').prop('checked');
        var locale = document.location.pathname.split('/');

        if(name == '' || email == '' || phone == '' || !privacy)
        {
          if(locale[1] == 'en') {
            $('#contact-form .response').html('<div class="failed">Please fill the required fields *.</div>');
          } else {
            $('#contact-form .response').html('<div class="failed">Por favor completa los campos requeridos *.</div>');
          }
          
          return false;
        }
              
        $.ajax({
            url:"/"+locale[1]+"/sendcontact",
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
              if(data.status == 'success'){
                $('form').trigger("reset");
              }
                $('#contact-form .response').fadeIn().html('<div class="text-info">'+data.message+'</div>');
                setTimeout(function(){
                    $('#contact-form .response').fadeOut("slow");
                }, 8000);
            },
            error:function(data){
                $('#contact-form .response').fadeIn().html('<div class="text-info">'+data.message+'</div>');
            }
        });
      });
    }

    if($('.newsletter-form').length){
      $('#submit-form').click(function(event){
          event.preventDefault();
          var o = new Object();
          var form = '.newsletter-form';
          var email = $('.newsletter-form #newsletter_email').val();
          var privacy = $('.newsletter-form #newsletter_privacy').prop('checked');
          var locale = document.location.pathname.split('/');

          if(email == '' || !privacy)
          {
            if(locale[1] == 'en') {
              $('.newsletter-form .response').html('<div class="failed">Please fill the required fields *.</div>');
            } else {
              $('.newsletter-form .response').html('<div class="failed">Por favor completa los campos requeridos *.</div>');
            }
            
            return false;
          }
                
          $.ajax({
              url:"/"+locale[1]+"/sendnewsletter",
              method:"POST",
              data: $(form).serialize(),
              beforeSend:function(){
                  if(locale[1] == 'en') {
                      $('.newsletter-form .response').html('<div class="text-info"><img src="images/preloader.gif"> Sending...</div>');
                  } else {
                      $('.newsletter-form .response').html('<div class="text-info"><img src="images/preloader.gif"> Enviando...</div>');
                  }
              },
              success:function(data){
                if(data.status == 'success'){
                  $('form').trigger("reset");
                }
                $('.newsletter-form .response').fadeIn().html('<div class="text-info">'+data.message+'</div>');
                  setTimeout(function(){
                      $('.newsletter-form .response').fadeOut("slow");
                }, 5000);
              },
              error:function(data){
                  $('.newsletter-form .response').fadeIn().html('<div class="text-info">'+data.message+'</div>');
              }
          });
      });
    }
    
});


