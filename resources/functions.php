<?php

/**
 * Do not edit anything in this file unless you know what you're doing
 */

use Roots\Sage\Config;
use Roots\Sage\Container;

use function App\template;

/**
 * Helper function for prettying up errors
 * @param string $message
 * @param string $subtitle
 * @param string $title
 */
$sage_error = function ($message, $subtitle = '', $title = '') {
    $title = $title ?: __('Sage &rsaquo; Error', 'sage');
    $footer = '<a href="https://roots.io/sage/docs/">roots.io/sage/docs/</a>';
    $message = "<h1>{$title}<br><small>{$subtitle}</small></h1><p>{$message}</p><p>{$footer}</p>";
    wp_die($message, $title);
};

/**
 * Ensure compatible version of PHP is used
 */
if (version_compare('7.1', phpversion(), '>=')) {
    $sage_error(__('You must be using PHP 7.1 or greater.', 'sage'), __('Invalid PHP version', 'sage'));
}

/**
 * Ensure compatible version of WordPress is used
 */
if (version_compare('4.7.0', get_bloginfo('version'), '>=')) {
    $sage_error(__('You must be using WordPress 4.7.0 or greater.', 'sage'), __('Invalid WordPress version', 'sage'));
}

/**
 * Ensure dependencies are loaded
 */
if (!class_exists('Roots\\Sage\\Container')) {
    if (!file_exists($composer = __DIR__.'/../vendor/autoload.php')) {
        $sage_error(
            __('You must run <code>composer install</code> from the Sage directory.', 'sage'),
            __('Autoloader not found.', 'sage')
        );
    }
    require_once $composer;
}

/**
 * Sage required files
 *
 * The mapped array determines the code library included in your theme.
 * Add or remove files to the array as needed. Supports child theme overrides.
 */
array_map(function ($file) use ($sage_error) {
    $file = "../app/{$file}.php";
    if (!locate_template($file, true, true)) {
        $sage_error(sprintf(__('Error locating <code>%s</code> for inclusion.', 'sage'), $file), 'File not found');
    }
}, ['helpers', 'setup', 'filters', 'admin']);

/**
 * Here's what's happening with these hooks:
 * 1. WordPress initially detects theme in themes/sage/resources
 * 2. Upon activation, we tell WordPress that the theme is actually in themes/sage/resources/views
 * 3. When we call get_template_directory() or get_template_directory_uri(), we point it back to themes/sage/resources
 *
 * We do this so that the Template Hierarchy will look in themes/sage/resources/views for core WordPress themes
 * But functions.php, style.css, and index.php are all still located in themes/sage/resources
 *
 * This is not compatible with the WordPress Customizer theme preview prior to theme activation
 *
 * get_template_directory()   -> /srv/www/example.com/current/web/app/themes/sage/resources
 * get_stylesheet_directory() -> /srv/www/example.com/current/web/app/themes/sage/resources
 * locate_template()
 * ├── STYLESHEETPATH         -> /srv/www/example.com/current/web/app/themes/sage/resources/views
 * └── TEMPLATEPATH           -> /srv/www/example.com/current/web/app/themes/sage/resources
 */
array_map(
    'add_filter',
    ['theme_file_path', 'theme_file_uri', 'parent_theme_file_path', 'parent_theme_file_uri'],
    array_fill(0, 4, 'dirname')
);
Container::getInstance()
    ->bindIf('config', function () {
        return new Config([
            'assets' => require dirname(__DIR__).'/config/assets.php',
            'theme' => require dirname(__DIR__).'/config/theme.php',
            'view' => require dirname(__DIR__).'/config/view.php',
        ]);
    }, true);

// Create Custom Post Type 'Subscriptions'
function create_posttype() {
    register_post_type( 'subscriptions', 
        // CPT Options
        array(
            'labels' => array(
                'name' => __( 'Subscriptions' ),
                'singular_name' => __( 'Subscription' )
            ),
            'public'        => true,
            'has_archive'   => true,
            'rewrite'       => array('slug' => 'subscriptions'),
            'show_in_rest'  => true,
            'template'      => array(
             
                array(
                    'core/column',
                    array(),
                    array(
                        array( 'core/heading', array( 'placeholder' => 'Subscriber Name' ) ),
                        array( 'core/paragraph', array( 'placeholder' => 'Subscriber Email' ) )
                    ),
                ),
            ),
        )
    );
}
// Hook up function to theme setup
add_action( 'init', 'create_posttype' );

// function wplook_activate_gutenberg_products($can_edit, $post_type){
// 	if($post_type == 'product'){
// 		$can_edit = true;
// 	}
	
// 	return $can_edit;
// }
// add_filter('use_block_editor_for_post_type', 'wplook_activate_gutenberg_products', 10, 2);

function add_file_types_to_uploads($file_types){
    $new_filetypes = array();
    $new_filetypes['svg'] = 'image/svg';
    $file_types = array_merge($file_types, $new_filetypes );
    return $file_types;
}
add_filter('upload_mimes', 'add_file_types_to_uploads');
    
add_filter( 'woocommerce_add_to_cart_fragments', 'wc_refresh_mini_cart_count');

function wc_refresh_mini_cart_count($fragments){
    ob_start();
    ?>
        <div class="cart-total" style="opacity: 0;">
            <?php echo WC()->cart->get_cart_contents_count(); ?>
        </div>

        <?php  if (sizeof( WC()->cart->get_cart() ) > 0 ) {  ?>
                <div class="cart-total pop" style="opacity: 1;">
                    <?php echo WC()->cart->get_cart_contents_count(); ?>
                </div>
                <?php } ?>
    <?php
    $fragments['.cart-total'] = ob_get_clean();
    return $fragments;
}

function prefix_send_email_to_admin() {

    $email = strtolower($_POST['signup']);
    $to = $email;
    $subject = 'Thank you for subscribing';
    $message = '
    <div style="font-family: sans-serif;
        background: #f7f7f7;
        width: 100%;
        display: flex;
        font-weight: bold;
        padding: 1rem 0 10rem 0;
        color: #5a5a5a;
        flex-direction: column;
        align-items: center;">
        <div style="display: flex; padding: 1rem 0; width: 500px;">
            <a class="brand logo" href="http://illkidrecords.local/" style="text-transform: uppercase;
            color: #333;
            text-decoration: none;
            font-family: helveticaneueblackcond, sans-serif;
            font-weight: bold;
            line-height: 13px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="96" height="54" viewBox="0 0 96 54">
            <g id="Logo_Main" transform="translate(-883.755 -31.447)">
              <text id="ILLKID_RECORDS" data-name="ILLKID
          RECORDS" transform="translate(883.755 31.447)" fill="#ccc" font-size="21" font-family="HelveticaNeueBlackCond, HelveticaNeue"><tspan x="0" y="20">ILLKID</tspan><tspan fill="#2e2e2e" font-size="22"><tspan x="0" y="38">RECORDS</tspan></tspan></text>
            </g>
          </svg>
            
            </a>
        </div>
            <div class="inner" style="background: #fff;
            height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 500px;
            padding-bottom: 2rem;
            border-radius: 6px;">
            <div class="hero__img" style="background:url(http://illkidrecords.local/wp-content/uploads/2020/07/email__header.svg) no-repeat;    
            height: 160px;
            width: 100%;"></div>
                <div class="content" style="padding: 3rem 0 0 0">
                    <p style="font-weight: bold; font-size: 1.54rem; color: #333;">Thank you for subscribing</p>
                </div>

                <div class="content" style="padding: 0rem 6rem;">
                    <p style="font-weight: 600; color: #afafaf; font-size: 18px; line-height: 32px;">
                        Some text here about the products available now. Some text about the latest product:
                    </p>
                </div>

                <div class="content" style="padding: 3rem 2rem;">
                    <button style="background: #3d5bd9;border-radius: 30px;border: none;
                        outline: none;
                        padding: 0.9rem 2rem;
                        display: flex;
                        align-items: center;
                        color: #fff;
                        cursor: pointer;
                        font-size: 0.8rem;
                        font-weight: bold;">View Online Store 
                    
                    <svg
                        style="margin: 1px 0 0 8px;"
                        width="24"
                        height="24"
                        viewBox="0 0 24 24"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                        d="M15.0378 6.34317L13.6269 7.76069L16.8972 11.0157L3.29211 11.0293L3.29413 13.0293L16.8619 13.0157L13.6467 16.2459L15.0643 17.6568L20.7079 11.9868L15.0378 6.34317Z"
                        fill="currentColor"/>
                    </svg>
                  </button>
                </div>             
                 
            </div>
            <div class="footer" style="height:100px;padding: 2rem; text-align: center;">
            <ul class="socials" style="    
            display: flex;
            list-style: none;
            justify-content: center;
            padding: 0;">
                <li style="padding: 0 0.5rem;"><a href="#">
                <svg xmlns="http://www.w3.org/2000/svg" width="9.4" height="17.18" viewBox="0 0 9.4 17.18">
                <path id="facebook" d="M8.968,19.68h3.617V12.437h3.259l.358-3.6H12.585V7.021a.9.9,0,0,1,.9-.9H16.2V2.5H13.489A4.521,4.521,0,0,0,8.968,7.021V8.838H7.16l-.358,3.6H8.968Z" transform="translate(-6.802 -2.5)" fill="#333"/>
              </svg>              
                </a></li>

                <li style="padding: 0 0.5rem;">
                    <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                    <g id="instagram" transform="translate(-1 -1)">
                      <path id="Path_1" data-name="Path 1" d="M11.5,7A4.5,4.5,0,1,0,16,11.5,4.5,4.5,0,0,0,11.5,7ZM8.8,11.5a2.7,2.7,0,1,0,2.7-2.7A2.7,2.7,0,0,0,8.8,11.5Z" transform="translate(-1.5 -1.5)" fill="#333" fill-rule="evenodd"/>
                      <path id="Path_2" data-name="Path 2" d="M18,5a1,1,0,1,0,1,1A1,1,0,0,0,18,5Z" transform="translate(-3.2 -0.8)" fill="#333"/>
                      <path id="Path_3" data-name="Path 3" d="M4.273,1A3.273,3.273,0,0,0,1,4.273V15.727A3.273,3.273,0,0,0,4.273,19H15.727A3.273,3.273,0,0,0,19,15.727V4.273A3.273,3.273,0,0,0,15.727,1ZM15.727,2.636H4.273A1.636,1.636,0,0,0,2.636,4.273V15.727a1.636,1.636,0,0,0,1.636,1.636H15.727a1.636,1.636,0,0,0,1.636-1.636V4.273A1.636,1.636,0,0,0,15.727,2.636Z" fill="#333" fill-rule="evenodd"/>
                    </g>
                  </svg>
                  
                    </a>
                </li>
                <li style="padding: 0 0.5rem;">
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="16.8" viewBox="0 0 24 16.8">
                    <path id="youtube" d="M5.6,7.4H22.4a1.2,1.2,0,0,1,1.2,1.2v9.6a1.2,1.2,0,0,1-1.2,1.2H5.6a1.2,1.2,0,0,1-1.2-1.2V8.6A1.2,1.2,0,0,1,5.6,7.4ZM2,8.6A3.6,3.6,0,0,1,5.6,5H22.4A3.6,3.6,0,0,1,26,8.6v9.6a3.6,3.6,0,0,1-3.6,3.6H5.6A3.6,3.6,0,0,1,2,18.2Zm9.6,1.2,4.8,3.6L11.6,17Z" transform="translate(-2 -5)" fill="#333" fill-rule="evenodd"/>
                    </svg>              
                </a>
            </li>
            </ul>
                <p style="font-size: 1rem; font-weight: normal;">
                    <a style=" color: #333; text-decoration: none;" class="newsletter-link" href="http://illkidrecords.local/unsubscribe/">unsubcribe</a> | 
                    <a style=" color: #333; text-decoration: none;" class="newsletter-link" href="">View this email online</a>
                </p>
                <p style="font-size: 0.7rem; color: #9B9B9B;">© 2020 iLLkid Records | P.O. Box 151474, San Diego, CA 91913</p>
            </div>
    </div>';
    
    $headers = "From: $email\r\n"; 

    // Now we specify our MIME version

        $headers .= "MIME-Version: 1.0\r\n"; 

    // Now we attach the HTML version

        $headers .= //"--$boundary\r\n".
                    "Content-Type: text/html; charset=ISO-8859-1\r\n";
    // $headers = 'From: '. $email . "\r\n" .
    //     'Reply-To: ' . $email . "\r\n";
            
    wp_mail( $to, $subject, $message, $headers );

        $post_content = $email;
            $my_post = array(
                'post_type'    => 'subscriptions',
                'post_title'   => $email,
                'post_content' => $post_content,
                'post_author'   => 1,
                'post_status'  => 'publish'
            );

        wp_insert_post( $my_post );


        header('Location: /thank-you');
    
        // Sanitize the POST field
        // Generate email content
        // Send to appropriate email
}
add_action( 'admin_post_nopriv_contact_form', 'prefix_send_email_to_admin' );
add_action( 'admin_post_contact_form', 'prefix_send_email_to_admin' );
