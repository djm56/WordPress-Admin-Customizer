<?php
/*
 * @link              http://www.anomalous.co.za
 * @since             1.0.0
 * @package           wordpress-admin-customizer.
 */

function login_css() {
    wp_enqueue_style('custom-login', plugins_url('/assets/style.css', __FILE__));
    $options = get_option('wac_settings');
    $optionfield = sanitize_text_field($options['wac_text_field_4']);
    $colorfield = sanitize_text_field($options['wac_text_field_5']);
    $fontfield = sanitize_text_field($options['wac_text_field_6']);
    if (!empty($optionfield)) :
        ?>
        <style>
            #login h1 a { 
                background-image: url("<?php echo $optionfield; ?>") !important;  
                background-size: 312px;
                width: 100%;
            } 
        </style>
        <?php
    endif;
    if (!empty($colorfield)) :
        ?>
        <style>
            body.login {
                background-color: <?php echo $colorfield; ?> !important;
            }
        </style>
        <?php
    endif;
    if (!empty($fontfield)) :
        ?>
        <style>
            body.login p#nav, body.login p#backtoblog,
            body.login p#nav a, body.login p#backtoblog a {
                color: <?php echo $fontfield; ?> !important;
            }
        </style>
        <?php
    endif;
}

add_action('login_head', 'login_css');

function remove_footer_admin() {
    $options = get_option('wac_settings');
    $optionfield = sanitize_text_field($options['wac_text_field_0']);
    if (!empty($optionfield)) :
        $footername = $optionfield;
    else:
        $footername = "WPZA";
    endif;
    echo '&copy; ' . date("Y") . ' - ' . $footername;
}

add_filter('admin_footer_text', 'remove_footer_admin');

// Add a widget in WordPress Dashboard
function wpc_dashboard_widget_function() {
    $options = get_option('wac_settings');
    $optionfield = sanitize_text_field($options['wac_text_field_1']);
    echo $optionfield;
}

function wpc_add_dashboard_widgets() {
    $options = get_option('wac_settings');
    $optionfield = sanitize_text_field($options['wac_text_field_2']);
    if ($optionfield == "Yes") {
        wp_add_dashboard_widget('wp_dashboard_widget', 'Development Information', 'wpc_dashboard_widget_function');
    }
}

add_action('wp_dashboard_setup', 'wpc_add_dashboard_widgets');

function remove_dashboard_widgets() {
    remove_meta_box('dashboard_right_now', 'dashboard', 'normal');   // Right Now
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal'); // Recent Comments
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');  // Incoming Links
    remove_meta_box('dashboard_plugins', 'dashboard', 'normal');   // Plugins
    remove_meta_box('dashboard_activity', 'dashboard', 'normal');   // Plugins
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');  // Quick Press
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');  // Recent Drafts
    remove_meta_box('dashboard_primary', 'dashboard', 'side');   // WordPress blog
    remove_meta_box('dashboard_secondary', 'dashboard', 'side');   // Other WordPress News
    // use 'dashboard-network' as the second parameter to remove widgets from a network dashboard.
}

add_action('wp_dashboard_setup', 'remove_dashboard_widgets');
