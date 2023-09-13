<?php

namespace MegaCouponWheel\class;

class MegawheelAssets{

    function __construct()
    {
        
        add_action( 'admin_enqueue_scripts', array( $this, 'mega_wheel_admin_assets_enqueue' ) );

        add_action('current_screen', array( $this, 'mega_wheel_admin_assets_enqueue') );


        // Frontend Style/Scripts
        add_action( 'wp_enqueue_scripts', array( $this, 'mega_wheel_frontend_assets_enqueue' ) );
    }


    /**
     * Plugin Assets Enqueue
     */
    public function mega_wheel_admin_assets_enqueue(){

        $screen = get_current_screen();

        // Check screen base and page
        if ( 'toplevel_page_mega-wheel' == $screen->base  )
        {
            wp_enqueue_style('sl-bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css', '', MEGA_WHEEL_VERSION, 'all');

            wp_enqueue_script('mw-vue-js', MEGA_WHEEL_ASSETS_URL . 'js/vue.global.js', array(), MEGA_WHEEL_VERSION, true );
            wp_enqueue_script('mw-axios-js', 'https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js', array(), MEGA_WHEEL_VERSION, true );            
            wp_enqueue_script('mw-tailwind-css', MEGA_WHEEL_ASSETS_URL . 'js/tailwind-css.js', array(), MEGA_WHEEL_VERSION, true );
            wp_enqueue_script('mw-script', MEGA_WHEEL_ASSETS_URL . 'js/mw-script.js', array(), MEGA_WHEEL_VERSION, true );

            

        }

        wp_enqueue_script('vue-form-plugin', MEGA_WHEEL_ASSETS_URL . 'js/vue-form-plugin.js', array(), null, false);

        // Pass some data to JavaScript
        $vue_form_nonce = wp_create_nonce('vue_form_nonce');

        wp_localize_script('mw-script', 'vue_form_vars', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => $vue_form_nonce,
        ));

        

    }



    function mega_wheel_frontend_assets_enqueue() {
        wp_enqueue_style( 'mw-frontend-style', MEGA_WHEEL_ASSETS_URL . 'css/mw-style.css', '',  MEGA_WHEEL_VERSION, 'all');

        wp_enqueue_script('mw-vuehome-js', MEGA_WHEEL_ASSETS_URL . 'js/vue.global.js', array(), MEGA_WHEEL_VERSION, false );
        wp_enqueue_script('mw-frontend', MEGA_WHEEL_ASSETS_URL . 'js/mw-frontend.js', array(), MEGA_WHEEL_VERSION, true );
    }
    
    
}