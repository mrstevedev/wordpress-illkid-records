export default {
  init() {
    // JavaScript to be fired on the home page
    $('[data-toggle="tooltip"]').tooltip()

    $(window).on('scroll', function () {
      if ($(this).scrollTop() > 100) {
          $('header').addClass('not-transparent');
      }
      else {
          $('header').removeClass('not-transparent');
      }
  });


  },
  finalize() {
    // JavaScript to be fired on the home page, after the init JS
  },
};
