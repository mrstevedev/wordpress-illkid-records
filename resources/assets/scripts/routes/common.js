export default {
  init() {
    // JavaScript to be fired on all pages
    // Cookie Notification
    const cookiesAcceptBtn = document.querySelector(
      '.cookies__accept--btn'
    );
    const cookiesChangePreferencesBtn = document.querySelector(
      '.cookies__decline--btn'
    );
    const cookiesNotification = document.querySelector(
      '.cookies-notification'
    );
    cookiesAcceptBtn.addEventListener('click', () => {
      cookiesAcceptBtn.style.background = '#568c9b';
      cookiesAcceptBtn.style.color = '#fff';

      cookiesNotification.style.display = 'none';
    });

    cookiesChangePreferencesBtn.addEventListener('click', () => {
      cookiesChangePreferencesBtn.style.background = '#568c9b';
      cookiesChangePreferencesBtn.style.color = '#fff';
    });

    //if cookie hasn't been set...
    if (document.cookie.indexOf('CookieNotificationShown') < 0) {
      // Display block / show modal
      cookiesNotification.style.display = 'block';

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
