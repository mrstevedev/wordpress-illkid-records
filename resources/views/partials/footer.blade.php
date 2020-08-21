<div class="cookies-notification">
  <div class="cookies-notification-close">
    <p>THIS SITE USES COOKIES TO PROVIDE A GREAT USER EXPERIENCE. BY USING ILLKID RECORDS, YOU AGREE TO OUR USE OF COOKIES.</p>
    <button class="cookies__accept--btn btn">
      Accept
    </button>
    <a href="/cookie-policy">
      <button class="cookies__decline--btn btn">More 
  </button>
</a>
  </div>
</div>
<footer class="content-info">
    {{-- @php dynamic_sidebar('sidebar-footer') @endphp --}}
    <div class="footer__content--top">
      <div class="container-fluid">
        <div class="footer-content--btmLeft">
          <label for="signup">
            Payment Methods
            </label>
            <ul class="footer__content--footer-top-list">
              <li><img src="@php echo bloginfo( 'url' ) @endphp/wp-content/uploads/2020/08/Stripe-logo-slate.svg" width="60" /></li>
              <li><img src="@php echo bloginfo( 'url' ) @endphp/wp-content/uploads/2020/08/PayPal.svg" width="80" /></li>
              <li><img src="@php echo bloginfo( 'url' ) @endphp/wp-content/uploads/2020/08/Google_Pay_GPay_Logo.svg" width="50" /></li>             
            </ul>
        </div>
        <div class="footer-content--center">
          <label for="signup">
            Shipping Methods
            </label>
            <ul class="footer__content--footer-top-list">
                <li><img src="@php echo bloginfo( 'url' ) @endphp/wp-content/uploads/2020/08/FedEx_Express.svg" width="60" /></li>
                <li><img src="@php echo bloginfo( 'url' ) @endphp/wp-content/uploads/2020/08/PinClipart.com_post-office-clip-art_2042928.png" width="40" /></li>
                <li><img src="@php echo bloginfo( 'url' ) @endphp/wp-content/uploads/2020/08/United_Parcel_Service_logo_2014.svg" width="25" /></li>
            </ul>
        </div>
        <div class="footer-content--btmRight">
          <form class="footer__form--signup" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="POST">
            <label for="signup">
              Sign Up For Our Newsletter
              </label>
            
          </form>
        </div>
      </div>
    </div>
    <div class="footer__content--btm">
      <div class="container-fluid">
        <div class="footer-content--btmLeft">
          <a class="brand logo" href="{{ home_url('/') }}">
            <span class="logo-top">illkid</span>
            <span class="logo-bottom">records</span>
          </a>
        </div>
        <div class="footer__content--center">
          <p class="footer__content--copyright">&copy; ILLKID RECORDS 2020</p>
        </div>
        <div class="footer__content--btmRight">
          {{-- <div class="footer__content--btmLanguage">
            <a class="languageTogglerBtn" href="#">
              <span class="footer__content--btmLanguagTxt">
                Language
                <span class="footer__content--btmLanguageSelect">
                <img src="/wp-content/uploads/2020/04/united-states-of-america.png" /> English
                </span>            
              </span>
            </a>
            <span class="footer__content--btmSocials">
              <ul class="social-list">
                <li>
                  <a href="#!">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="19" viewBox="0 0 24 24"><path d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z"/></svg>
                  </a>
                </li>
                <li>
                  <a href="#!">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                  </a>
                </li>
                <li>
                  <a href="#!">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="17" viewBox="0 0 24 24"><path d="M7 17.939h-1v-8.068c.308-.231.639-.429 1-.566v8.634zm3 0h1v-9.224c-.229.265-.443.548-.621.857l-.379-.184v8.551zm-2 0h1v-8.848c-.508-.079-.623-.05-1-.01v8.858zm-4 0h1v-7.02c-.312.458-.555.971-.692 1.535l-.308-.182v5.667zm-3-5.25c-.606.547-1 1.354-1 2.268 0 .914.394 1.721 1 2.268v-4.536zm18.879-.671c-.204-2.837-2.404-5.079-5.117-5.079-1.022 0-1.964.328-2.762.877v10.123h9.089c1.607 0 2.911-1.393 2.911-3.106 0-2.233-2.168-3.772-4.121-2.815zm-16.879-.027c-.302-.024-.526-.03-1 .122v5.689c.446.143.636.138 1 .138v-5.949z"/></svg>
                  </a>
                </li>
                <li>
                  <a href="#!">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="15" viewBox="0 0 24 24"><path d="M19.615 3.184c-3.604-.246-11.631-.245-15.23 0-3.897.266-4.356 2.62-4.385 8.816.029 6.185.484 8.549 4.385 8.816 3.6.245 11.626.246 15.23 0 3.897-.266 4.356-2.62 4.385-8.816-.029-6.185-.484-8.549-4.385-8.816zm-10.615 12.816v-8l8 3.993-8 4.007z"/></svg>
                  </a>
                </li>
              </ul>
            </span>
          </div>--}}
          <div class="back-to-top"
          ">
          <a href="#top"><i class="fas fa-long-arrow-alt-up"></i> Back to Top</a>
      </div>
        </div>
      </div>
    </div>
</footer>
