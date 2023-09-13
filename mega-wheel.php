<?php

 if(!defined('ABSPATH')){
    exit();
 }

/*
 * Plugin Name:       Mega Wheel
 * Plugin URI:        https://codeindeed.com/plugins/megawheel/
 * Description:       Handle the basics with this plugin.
 * Version:           1.0.1
 * Requires at least: 5.6
 * Requires PHP:      7.2
 * Author:            Md. Mahmudul Hasan
 * Author URI:        https://codeindeed.com/mahmud/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://codeindeed.com/plugins/megawheel/
 * Text Domain:       megawheel
 * Domain Path:       /languages
 */

 require_once __DIR__ . '/vendor/autoload.php';

/**
 * The main plugin class
 */
class MegaWheel{


    /**
     * Plugin version
     */
    public $version = '1.0.0';


    /**
     * Plugin text-domian
     */
    public $text_domain = 'megawheel';


    /**
     * Define instance variable
     */
    protected static $_instance = null;


    /**
     * Create Instance of this Class
     */
    public static function instance() {
        if ( is_null( self::$_instance ) ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }


    /**
     * Constructor Class
     */
    function __construct()
    {

        $this->mega_wheel_define_constant();

        add_action( 'plugins_loaded', array( $this, 'mega_wheel_load_plugin_textdomain' ));
        
        add_action('plugins_loaded', array( $this, 'plugin_init'));

        register_activation_hook( __FILE__ , array($this, 'mw_create_mega_wheel_page'));

    }


    /**
     * Constant define
     */
    public function mega_wheel_define_constant(){

        define('MEGA_WHEEL_VERSION', $this->version);
        define('MEGA_WHEEL_DIR_URL', plugin_dir_url(__FILE__)); // Return value = http://localhost/plugindev/wp-content/plugins/first-plugin/
        define('MEGA_WHEEL_DIR_PATH', plugin_dir_path(__FILE__)); // Return value = F:\server\htdocs\plugindev\wp-content\plugins\first-plugin/
        define('MEGA_WHEEL_BASENAME', plugin_basename(__FILE__)); // Return value = first-plugin/first-plugin.php
        define('MEGA_WHEEL_ASSETS_URL', MEGA_WHEEL_DIR_URL . 'assets/');
        define('MEGA_WHEEL_INC_DIR_PATH', MEGA_WHEEL_DIR_PATH . 'inc/');

    }

    
    /**
     * Load plugin textdomain
     */
    public function mega_wheel_load_plugin_textdomain() {
        load_plugin_textdomain( $this->text_domain, false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
    }


    // Create Page with Shortcode
    function mw_create_mega_wheel_page() {
        // Define the page title and shortcode content
        $page_title = 'Mega Wheel';
        $shortcode_content = '[megawheel]';

        // Check if the page already exists
        $existing_page = new WP_Query(
            array(
                'post_type' => 'page',
                'post_status' => 'publish',
                'name' => sanitize_title($page_title),
            )
        );

        if (!$existing_page->have_posts()) {
            // Page doesn't exist, so let's create it
            $page_args = array(
                'post_title' => $page_title,
                'post_content' => $shortcode_content,
                'post_status' => 'publish',
                'post_type' => 'page',
            );

            // Insert the new page into the database
            wp_insert_post($page_args);
        }

        // Restore the global post data
        wp_reset_postdata();
    }


    /**
     * Menu page loaded
     */

     public function plugin_init(){
        new MegaCouponWheel\MegawheelClass();
    }

}



function MegaWheelInit() {
    return MegaWheel::instance();
}

//Class  instance.
$MegaWheel = MegaWheelInit();





 