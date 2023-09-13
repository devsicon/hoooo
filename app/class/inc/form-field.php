<?php 

$mw_data = get_option('mega_wheel_settings_data');

$mw_decode_data = json_decode($mw_data );

// echo '<pre>';
// var_dump($mw_decode_data);

// exit;

?>

<div class="wrap" id="mwApp">
    <h1 class="wp-heading-inline"><?php _e('Mega Wheel Coupon'); ?></h1>

    <form v-on:submit.prevent="submitForm" >

    <table class="form-table" role="presentation">
        <tr>
            <th scope="row">Coupon Wheel Enable</th>
            <td><input v-model="wheelEnbl" type="checkbox"> Enable</td>
        </tr>
        <tr>
            <th scope="row">Coupon Wheel Enable on Mobile</th>
            <td><input v-model="wheelMEnbl" type="checkbox"> Enable</td>
        </tr>
        <tr>
            <th scope="row">Wheel Title</th>
            <td><input v-model="wheelTitle" type="text"></td>
        </tr>
        <tr>
            <th scope="row">Wheel Description</th>
            <td><textarea v-model="wheelDescription" cols="60" rows="4"></textarea></td>
        </tr>
        <tr>
            <th scope="row">Wheel Button Text</th>
            <td><input v-model="wheelBtnText" type="text"></td>
        </tr>
        <!-- <tr>
            <th scope="row">Wheel Background Image</th>
            <td><input type="file" name="" id="mw_bg_img"></td>
        </tr> -->
        <tr>
            <th scope="row">Coupon Winner Message</th>
            <td><textarea v-model="wheelWinerMsg" cols="60" rows="4"></textarea></td>
        </tr>
        <tr>
            <th scope="row">Mailchimp API Key</th>
            <td><input v-model="wheelMcApi" type="text"></td>
        </tr>
    </table>

        <table class="table form-table" >
            <p><b><?php _e('A Wheel has 6 slices. Below you can define each slice in detail.', 'megawheel'); ?></b></p>
            <thead class="thead-dark">
                <tr class="thead-dark">
                <th style="width: 50px;"><?php _e('SL', 'megawheel'); ?></th>
                <th><?php _e('Wheel Type', 'megawheel'); ?></th>
                <th><?php _e('Label / Text', 'megawheel'); ?></th>
                <th><?php _e('Coupon Amount', 'megawheel'); ?></th>
                <!-- <th><?php // _e('Chance %', 'megawheel'); ?></th> -->
                <th><?php _e('Colr', 'megawheel'); ?></th>
                <th>Action</th>
                </tr>

            </thead>
            <tbody>
                

                <!-- Vue Form Field -->
                
                <tr v-for="(field, index) in formFields" :key="index">
                    <td>{{ index + 1 }}</td>
                    <!-- <td>{{ field }}</td> -->
                    <td  >
                        <select v-model="field.wheelOption">
                            <option value="nocoupon">No Coupon</option>
                            <option value="percentagecoupon">Percentage Discount</option>
                            <option value="fixedproduct">Fixed Product Discount</option>
                            <option value="fixedcart">Fixed Cart Discount</option>
                            <option value="welcomecoupon">Welcome Discount</option>
                            <option value="customcoupon">Custom</option>
                        </select>
                    </td>
                    <td><input v-model="field.wheelLabel" type="text"></td>
                    <td><input v-model="field.couponAmount" type="text"></td>
                    <!-- <td><input name="wheel_" type="text"></td> -->
                    <td><input v-model="field.wheelColor" type="color"></td>
                    <td >  <a href="#" class="btn btn-danger" @click="removeField(index)">Remove</a> </td>
                </tr>
                <tr>
                    <td colspan="5"></td>
                    <td><a href="#" class="btn btn-success" @click="addField">Add Field</a></td>
                </tr>

                
                
            </tbody>
        </table>

        <?php // wp_nonce_field('megawheel-nonce'); ?>

        <!-- <input type="submit" class="btn btn-success"> -->

        <?php submit_button(__('Save Settings', 'megawheel'), 'primary', 'save_mw_settings'); ?>
    </form>

</div>