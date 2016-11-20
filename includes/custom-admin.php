<?php

/* 
 * @link              http://www.anomalous.co.za
 * @since             1.0.0
 * @package           wordpress-admin-customizer.
 */

function login_css() {
    wp_enqueue_style( 'custom-login', plugins_url( '/assets/style.css', __FILE__ ) );
}
add_action('login_head', 'login_css');

function remove_footer_admin () {
    echo '&copy; 2016 - TMG Advent Calendar';
}
add_filter('admin_footer_text', 'remove_footer_admin');