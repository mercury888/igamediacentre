$headerHeight = '';
$headerHeightscroll = '';

jQuery(document).ready(function($) {
        $(".navbar-toggle").click(function() {
            if ($(this).hasClass("active")) {
                $(this).removeClass("active");
                $('.mobile_menu').animate({
                    'right': '-100%'
                }, 500);
            } else {
                $(this).addClass("active");
                $('.mobile_menu').animate({
                    'right': '0'
                }, 500);
            }
        });
        $(".mobile_menu ul li").find("ul").parents("li").prepend("<span></span>");
        $(".mobile_menu ul li ul").addClass("first-sub");
        $(".mobile_menu ul li ul").prev().prev("span").addClass("first-em");
        $(".mobile_menu ul li ul ul").removeClass("first-sub");
        $(".mobile_menu ul li ul ul").addClass("second-sub");
        $(".mobile_menu ul li ul ul").prev().prev("span").addClass("second-em");
        $(".mobile_menu ul li ul ul").prev().prev("span").removeClass("first-em");
        $(".mobile_menu ul li span.first-em").click(function(e) {
            $(".mobile_menu ul li span.first-em").removeClass('active');
            $(".mobile_menu ul li span.second-em").removeClass('active');
            if ($(this).parent("li").hasClass("active")) {
                $(this).parent("li").removeClass("active");
                $(this).next().next("ul.first-sub").slideUp();
                $(".mobile_menu ul li ul.second-sub li").removeClass("active");
                $(".mobile_menu ul li ul.second-sub").slideUp();
            } else {
                $(this).addClass('active');
                $(".mobile_menu ul li").removeClass("active");
                $(this).parent("li").addClass("active");
                $(".mobile_menu ul li ul.first-sub").slideUp();
                $(this).next().next("ul.first-sub").slideDown();
                $(".mobile_menu ul li ul.second-sub li").removeClass("active");
                $(".mobile_menu ul li ul.second-sub").slideUp();
            }
        });
        $(".mobile_menu ul li ul.first-sub li span.second-em").click(function(e) {
            $(".mobile_menu ul li span.second-em").removeClass('active');
            if ($(this).parent("li").hasClass("active")) {
                $(this).parent("li").removeClass("active");
                $(this).next().next("ul.second-sub").slideUp();
            } else {
                $(this).addClass('active');
                $(".mobile_menu ul li ul li").removeClass("active");
                $(this).parent("li").addClass("active");
                $(".mobile_menu ul li ul.second-sub").slideUp();
                $(this).next().next("ul.second-sub").slideDown();
            }
        });
        $(".close-btn").click(function() {
            $('.mobile_menu').animate({
                'right': '-100%'
            }, 500);
            $(" .navbar-toggle").removeClass("active");
        });


    // Banner Slider
    // $('.banner-slider').slick({
    //     slidesToShow: 1,
    //     slidesToScroll: 1,
    //     dots: true,
    //     arrows: false,
    //     autoplay: true,
    //     infinite: true,
    //     fade: true,
    // });


    $(".search-link").click(function() {
      $("#search-header").slideToggle();
    });

    setTimeout(function(){
        $('.site-loader').fadeOut();
    },1500);


    $('.counter').counterUp({
      delay: 10,
      time: 500
    });

    $('ul.faq-listing li h6 a').click(function(e) {
        if ($(this).hasClass("active")) {
            $(this).removeClass("active");
            $(this).parents("h6").next(".faq-content").slideUp(300);
        } else {
            $('ul.faq-listing li h6 a').removeClass("active")
            $('ul.faq-listing li .faq-content').slideUp(300);
            $(this).addClass("active");
            $(this).parents("h6").next(".faq-content").slideDown(300);
        }
        return false;
    });



    $(".get-started-btn").click(function () {
      $(".get-started-block").css ({
        display: "none"
      });
      $(".progress-first-step").css ({
        display: "none"
      });
      $(".start-here form").css ({
        display: "block"
      });
      $(".progress").css ({
        display: "block"
      });
    });


    setInterval(function(){
      if ( $('.get-started-block').css('display') == 'block') {
          $('.progress').addClass('transparent_bar');
      }
      if ( $('.get-started-block').css('display') == 'none') {
          $('.progress').removeClass('transparent_bar');
      }


      $('.single-option .inner-block input').change(function() {
        $('.single-option .inner-block input').parent().css('background', 'white');
        $('.single-option .inner-block input').parent().css('color', '#30302f');

        // if($(this).is(':checked')) { // Input is checked
        //     $(this).parent().css('background', '#e4291b');
        //     $(this).parent().css('color', 'white');
        // }

        $(".single-option .inner-block input:checked").each(
          function() {
            $(this).parent().css('background', '#e4291b');
            $(this).parent().css('color', 'white');
          }
      );
    });

  }, 100);//wait 0.01 seconds



    if( jQuery( window ).width() < 993 ) {
        jQuery('.media-kits .media-kits-list.page-list').slick({
          dots: false,
          arrows: false,
          autoplay: true,
          infinite: true,
          slidesToShow: 2,
          centerMode: true,
          centerPadding:'80px',
          responsive: [
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    centerPadding:'50px',
                }
            }
        ]
      });
    }

});


jQuery(window).on('load resize ready', function($) {
    if( jQuery(window).scrollTop() > 50 ){
        setTimeout(function(){
            stickyHeader();
        },500);
    }

    var headerHeigh = jQuery('header').outerHeight();
    jQuery('#wrapper').css('padding-top', headerHeigh);

});

jQuery(window).scroll(function(event) {
    stickyHeader();

    // var headerHeigh = jQuery('header').outerHeight();
    // jQuery('#wrapper').css('padding-top', headerHeigh);
});


/* sticky header script */
function stickyHeader() {
    var sticky = jQuery('header'),
        scroll = jQuery(window).scrollTop();

    if (scroll >= 50) {
        sticky.addClass('sticky');
        $headerHeightscroll = jQuery('header.sticky').outerHeight();
    } else sticky.removeClass('sticky');
}

jQuery('.js-download-file').click(function(e){
    e.preventDefault();
    var fileurl = jQuery(this).attr('href');
    if(fileurl != ""){
        fetch(fileurl)
          .then(resp => resp.blob())
          .then(blob => {
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.style.display = 'none';
            a.href = url;
            // the filename you want
            a.download = fileurl.split('/').pop();
            document.body.appendChild(a);
            a.click();
            window.URL.revokeObjectURL(url);
        }).catch(() => console.log('Download not completed!'));
    }
});


function isValidEmailAddress(emailAddress) {
    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
    return pattern.test(emailAddress);
};


jQuery('.download-media-section .fsBody #fsSubmit4578471 input[type="submit"]').click(function(e){

    // e.preventDefault();
    var fileurl = "https://igamediacentre.com.au/wp-content/themes/igamediacentre/resources/IMC_Media_Kit_2021_0921.pdf";
    var emailadd = jQuery('.download-media-section .fsBody input[type="email"]').val();

    if(fileurl != ""){
      if ((jQuery('.download-media-section .fsBody input:text').val().length != 0)  && (isValidEmailAddress( emailadd ))) {

        fetch(fileurl)
          .then(resp => resp.blob())
          .then(blob => {
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement('a');
            a.style.display = 'none';
            a.href = url;
            // the filename you want
            a.download = fileurl.split('/').pop();
            document.body.appendChild(a);
            a.click();
            window.URL.revokeObjectURL(url);
        }).catch(() => console.log('Download not completed!'));
    }
  }
});
