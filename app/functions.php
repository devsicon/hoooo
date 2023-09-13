<?php



function mega_wheel_frontend_shortcode( ) {
	
    $data = json_decode( get_option('mega_wheel_settings_data') );

    // echo '<pre>';
    // var_dump($data);
    // echo '</pre>';

    // exit;

    ob_start();

    ?>


    <div id="displayApp">

        <div class="wheel-wrapper">
            <div class="wheel-pointer" @click="onClickRotate">
            Start
            </div>
            <div class="wheel-bg" :class="{freeze: freeze}" :style="`transform: rotate(${wheelDeg}deg)`">
                <div class="prize-list">
                    <div class="prize-item-wrapper" v-for="(item,index) in prizeList" :key="index">
                    <div class="prize-item" :style="`transform: rotate(${(360/ prizeList.length) * index}deg)`">
                        <div class="prize-name">
                        {{ item.name }}
                        </div>
                        
                    </div>
                    </div>
                </div>
            </div>
        </div>

    </div>




    <?php

    return ob_get_clean();
}
add_shortcode( 'megawheel', 'mega_wheel_frontend_shortcode' );