export default {
  init() {
    // JavaScript to be fired on all pages
    // Cookie Notification
    const cookiesAcceptBtn = document.querySelector(
      '.cookies__accept--btn'
    );
    const cookiesMoreBtn = document.querySelector(
      '.cookies__decline--btn'
    );
    const cookiesNotification = document.querySelector(
      '.cookies-notification'
    );

    cookiesAcceptBtn.addEventListener('click', () => {
      console.log('Accept button clicked');

      // Store cookie
      document.cookie = 'cookieNotificationShown=true; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/';
      cookiesAcceptBtn.style.background = '#568c9b';
      cookiesAcceptBtn.style.color = '#fff';

      cookiesNotification.style.display = 'none';

    });

    cookiesMoreBtn.addEventListener('click', () => {
      cookiesMoreBtn.style.background = '#568c9b';
      cookiesMoreBtn.style.color = '#fff';
    });

    //if cookie hasn't been set...
    if (document.cookie.indexOf('CookieNotificationShown') < 0) {

      setTimeout(() => {
        cookiesNotification.style.display = 'block';
      }, 6000);

      cookiesAcceptBtn.addEventListener('click', () => {
        // Store cookie
        document.cookie =
          'CookieNotificationShown=true; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/';
      });
    } else {
      // Display none on notification modal
      cookiesNotification.style.display = 'none';
    }
  },
  finalize() {
    // JavaScript to be fired on all pages, after page specific JS is fired
  },
};
