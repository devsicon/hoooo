<?php

namespace MegaCouponWheel\class;

class Menupage{

    public function menu_page_html(){
        $template = __DIR__ . '/inc/form-field.php';

        if( file_exists($template)){
            include $template;
        }
    }


    public function form_submit_handler(){

        // Verify Nonce
        if (!isset($_POST['nonce']) && !wp_verify_nonce($_POST['nonce'], 'vue_form_nonce')) {
            echo 'Nonce verification failed.';
            die();
        }

        // echo '<pre>';
        // var_dump($_POST);
        // echo '</pre>';

        // exit;


        if(isset($_POST['wheelenbl'])){
            $mw_enable = $_POST['wheelenbl']; 
        }else{
            $mw_enable = 'notenabled';
        }

        if(isset($_POST['wheelmenbl'])){
            $mw_m_enable = $_POST['wheelmenbl'];
        }else{
            $mw_m_enable = 'notenabled';
        }



        
        $wheel_form_data = [
            'mw_enabled' => $mw_enable,
            'mw_m_enabled' => $mw_m_enable,
            'mw_title' => $_POST['wheeltitle'],
            'mw_description' => $_POST['wheeldescription'],
            'mw_btn_txt' => $_POST['wheelbtntext'],
            'mw_win_msg' => $_POST['wheelwinermsg'],
            'mc_api' => $_POST['wheelmcapi'],
            'wheel_data' => $_POST['formfield'],
            // [
            //     'wheel_type' => $_POST['wheeloption'],
            //     'wheel_label' => $_POST['wheellabel'],
            //     'wheel_amount' => $_POST['couponamount'],
            //     'wheel_color' => $_POST['wheelcolor'],
            // ]            
            ];

            // echo '<pre>';
            // var_dump($wheel_form_data);

            // exit;

            $mw_post_data = json_encode($wheel_form_data);

            update_option( 'mega_wheel_settings_data',  $mw_post_data );

            wp_send_json_success(['message' => 'Data saved successfully']);


    }



    // Get data
    function get_wheel_options_data() {
        
        // Retrieve data from WordPress options table

        $data = json_decode(get_option('mega_wheel_settings_data'));

        var_dump($data);

        exit;

        wp_send_json($data);

        // wp_die();
    }
    

    
}



