<?php

namespace MegaCouponWheel\class;

class Menu{

    function __construct()
    {

        $this->dispatch_action();
        add_action( 'admin_menu', array( $this, 'mega_wheel_menu_page' ) );

    }

    public function mega_wheel_menu_page(){
        
       add_menu_page( __('Mega Wheel Coupon', 'megawheel'), __('Mega Wheel', 'megawheel'), 'manage_options', 'mega-wheel', array( $this, 'mega_wheel_menu_page_html' ), MEGA_WHEEL_ASSETS_URL . 'images/mega-wheel-lottery.png',
            100 );

    }

    public function mega_wheel_menu_page_html(){

        $menupage = new Menupage();
        $menupage->menu_page_html();

        

    }

    public function dispatch_action(){

        $formdata = new Menupage();
        // add_action('admin_init', array( $formdata, 'form_submit_handler' ));

        add_action('wp_ajax_handle_form_submission', array($formdata, 'form_submit_handler' ));
        add_action('wp_ajax_nopriv_handle_form_submission', array($formdata, 'form_submit_handler' ));


        add_action('wp_ajax_get_wheel_data', array( $formdata, 'get_wheel_options_data' ));
        add_action('wp_ajax_nopriv_get_wheel_data', array( $formdata, 'get_wheel_options_data' ));

    }




}