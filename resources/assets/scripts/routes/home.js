export default {
  init() {
    // JavaScript to be fired on the home page
    $('[data-toggle="tooltip"]').tooltip()

  //   $(window).on('scroll', function () {
  //     if ($(this).scrollTop() > 100) {
  //         $('header').addClass('not-transparent');
  //     }
  //     else {
  //         $('header').removeClass('not-transparent');
  //     }
  // });

   //sticky back to top
   $(window).on('scroll', function(){
    const scrollPos = $(window).scrollTop();
    if(scrollPos >= 800){
      $('.back-to-top').addClass('fixed animated fadeInRight show');
        
    } else if(scrollPos < 800){
      $('.back-to-top').removeClass('fadeInRight show');
    }
  });


  },
  finalize() {
    // JavaScript to be fired on the home page, after the init JS
  },
};
