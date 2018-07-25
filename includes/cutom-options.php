<?php
/*
 * @link              http://www.anomalous.co.za
 * @since             1.0.0
 * @package           wordpress-admin-customizer.
 */

function my_plugin_admin_scripts() {
//    if ( 'settings_page_myplugin' != $hook ) { //set your plugin page
//        return;
//    }
    wp_enqueue_style('wp-color-picker');
    wp_enqueue_script('wp-color-picker-alpha', plugins_url('assets/wp-color-picker-alpha.min.js', __FILE__), array('wp-color-picker'), '1.0.0', true);
}

add_action('admin_enqueue_scripts', 'my_plugin_admin_scripts');

add_action('admin_menu', 'wac_add_admin_menu');
add_action('admin_init', 'wac_settings_init');

function wac_add_admin_menu() {
    add_options_page('WPZA Admin', 'Admin Customizer', 'manage_options', 'wordpress_admin_customizer', 'wac_options_page');
}

function wac_settings_init() {
    if (function_exists('wp_enqueue_media')) {
        wp_enqueue_media();
    } else {
        wp_enqueue_style('thickbox');
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
    }
    register_setting('pluginPage', 'wac_settings');
    add_settings_section(
            'wac_pluginPage_section', __('Customize the WordPress Admin', 'wordpress-admin-customizer'), 'wac_settings_section_callback', 'pluginPage'
    );
    add_settings_field(
            'wac_text_field_0', __('Footer Copyright Text', 'wordpress-admin-customizer'), 'wac_text_field_0_render', 'pluginPage', 'wac_pluginPage_section'
    );
    add_settings_field(
            'wac_text_field_2', __('Show Dashboard Box', 'wordpress-admin-customizer'), 'wac_text_field_2_render', 'pluginPage', 'wac_pluginPage_section'
    );
    add_settings_field(
            'wac_text_field_1', __('Dashboard Box content', 'wordpress-admin-customizer'), 'wac_text_field_1_render', 'pluginPage', 'wac_pluginPage_section'
    );
    add_settings_field(
            'wac_text_field_4', __('Logo for Admin Login', 'wordpress-admin-customizer'), 'wac_text_field_4_render', 'pluginPage', 'wac_pluginPage_section'
    );
    add_settings_field(
            'wac_text_field_5', __('Login Background Color', 'wordpress-admin-customizer'), 'wac_text_field_5_render', 'pluginPage', 'wac_pluginPage_section'
    );
    add_settings_field(
            'wac_text_field_6', __('Login Font Color', 'wordpress-admin-customizer'), 'wac_text_field_6_render', 'pluginPage', 'wac_pluginPage_section'
    );
    add_settings_field(
            'wac_text_field_7', __('Hide Desktop Widgets', 'wordpress-admin-customizer'), 'wac_text_field_7_render', 'pluginPage', 'wac_pluginPage_section'
    );
    add_settings_field(
            'wac_text_field_3', __('Restore Defaults Upon Reactivation?', 'wordpress-admin-customizer'), 'wac_text_field_3_render', 'pluginPage', 'wac_pluginPage_section'
    );
}

function wac_text_field_0_render() {
    $options = get_option('wac_settings');
    ?>
    <input type='text' name='wac_settings[wac_text_field_0]' value='<?php echo sanitize_text_field($options['wac_text_field_0']); ?>'>
    <p><small>&copy; and current year are added automatically. So all you have to do is add a name.</small></p>
    <?php
}

function wac_text_field_1_render() {
    $options = get_option('wac_settings');
    ?>
    <textarea id="textarea_example" name="wac_settings[wac_text_field_1]" rows="5" cols="50"><?php echo $options['wac_text_field_1']; ?></textarea>
    <p><small>This is a widget box that appears on the admin dashboard</small></p>
    <?php
}

function wac_text_field_2_render() {
    $options = get_option('wac_settings');
    $items = array("Yes", "No");
    foreach ($items as $item) {
        $checked = ($options['wac_text_field_2'] == $item) ? ' checked="checked" ' : '';
        echo "<label><input " . $checked . " value='$item' name='wac_settings[wac_text_field_2]' type='radio' /> $item</label><br />";
    }
}

function wac_text_field_3_render() {
    $options = get_option('wac_settings');
    $items = array("Yes", "No");
    foreach ($items as $item) {
        $checked = ($options['wac_text_field_3'] == $item) ? ' checked="checked" ' : '';
        echo "<label><input " . $checked . " value='$item' name='wac_settings[wac_text_field_3]' type='radio' /> $item</label><br />";
    }
}

function wac_text_field_4_render() {
    $options = get_option('wac_settings');
    ?>
    <img class="header_logo" src="<?php echo sanitize_text_field($options['wac_text_field_4']); ?>" /><br>
    <input type='text' class='header_logo_url' name='wac_settings[wac_text_field_4]' value='<?php echo sanitize_text_field($options['wac_text_field_4']); ?>'>
    <a href="#" class="header_logo_upload button button-primary">Upload</a>
    <p><small>Upload the image that is 312px × 84px. Also try make it a Alpha PNG (A Logo with invisible background).</small></p>
    <script>
        jQuery(document).ready(function ($) {
            $('.header_logo_upload').click(function (e) {
                e.preventDefault();

                var custom_uploader = wp.media({
                    title: 'Custom Image',
                    button: {
                        text: 'Upload Image'
                    },
                    multiple: false  // Set this to true to allow multiple files to be selected
                })
                        .on('select', function () {
                            var attachment = custom_uploader.state().get('selection').first().toJSON();
                            $('.header_logo').attr('src', attachment.url);
                            $('.header_logo_url').val(attachment.url);

                        })
                        .open();
            });
        });
    </script>
    <?php
}

function wac_text_field_5_render() {
    $options = get_option('wac_settings');
    ?>
    <input type='text' class='color-picker' data-alpha='true' name='wac_settings[wac_text_field_5]' value='<?php echo sanitize_text_field($options['wac_text_field_5']); ?>'>
    <p><small>Please select background color for Login screen.</small></p>
    <?php
}

function wac_text_field_6_render() {
    $options = get_option('wac_settings');
    ?>
    <input type='text' class='color-picker' data-alpha='true' name='wac_settings[wac_text_field_6]' value='<?php echo sanitize_text_field($options['wac_text_field_6']); ?>'>
    <p><small>Please select font color for Login screen.</small></p>
    <?php
}

function wac_text_field_7_render() {
    $options = get_option('wac_settings');
    $checkedone = '';
    $checkedtwo = '';
    $checkedthree = '';
    $checkedfour = '';
    $checkedfive = '';
    if ($options['wac_text_field_7']) {
        $checkedone = ' checked="checked" ';
    }
    echo "<input " . $checkedone . " id='wac_text_field_7' name='wac_settings[wac_text_field_7]' type='checkbox' /> Hide Quick Draft<br>";
    if ($options['wac_text_field_8']) {
        $checkedtwo = ' checked="checked" ';
    }
    echo "<input " . $checkedtwo . " id='wac_text_field_8' name='wac_settings[wac_text_field_8]' type='checkbox' /> Hide Activity<br>";
    if ($options['wac_text_field_9']) {
        $checkedthree = ' checked="checked" ';
    }
    echo "<input " . $checkedthree . " id='wac_text_field_9' name='wac_settings[wac_text_field_9]' type='checkbox' /> Hide At A Glance<br>";
    if ($options['wac_text_field_10']) {
        $checkedfour = ' checked="checked" ';
    }
    echo "<input " . $checkedfour . " id='wac_text_field_10' name='wac_settings[wac_text_field_10]' type='checkbox' /> Hide WordPress News and Events<br>";
    if ($options['wac_text_field_11']) {
        $checkedfive = ' checked="checked" ';
    }
    echo "<input " . $checkedfive . " id='wac_text_field_11' name='wac_settings[wac_text_field_11]' type='checkbox' /> Hide Welcome Panel<br>";
}

function wac_settings_section_callback() {
    echo __('Customize this WordPress Install with a custom login logo, and other description\'s and details.', 'wordpress-admin-customizer');
}

function wac_options_page() {
    ?>
    <form action='options.php' method='post' enctype="multipart/form-data">
        <h1>Admin Customizer</h1>
    <?php
    settings_fields('pluginPage');
    do_settings_sections('pluginPage');
    submit_button();
    ?>
        <p><small>Developed by WPZA Website Maintenance Services. <a href="https://wpza.co.za">https://wpza.co.za</a></small></p>
    </form>
    <?php
}
