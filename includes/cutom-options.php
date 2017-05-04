<?php
add_action('admin_menu', 'wac_add_admin_menu');
add_action('admin_init', 'wac_settings_init');

function wac_add_admin_menu() {

    add_options_page('WPZA Admin', 'Admin Customizer', 'manage_options', 'wordpress_admin_customizer', 'wac_options_page');
}

function wac_settings_init() {

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
    <p><small>This is a text box that appears on the dashboard</small></p>
    <?php
}

//function wac_text_field_2_render(  ) { 
//	$options = get_option( 'wac_settings' );
//        if($options['wac_text_field_2']) { $checked = ' checked="checked" '; } else { $checked = ''; };
//	echo "<input ".$checked." id='plugin_chk1' name='wac_settings[wac_text_field_2]' type='checkbox' />";
//        
//}
function wac_text_field_2_render() {
    $options = get_option('wac_settings');
    $items = array("Yes", "No");
    foreach ($items as $item) {
        $checked = ($options['wac_text_field_2'] == $item) ? ' checked="checked" ' : '';
        echo "<label><input " . $checked . " value='$item' name='wac_settings[wac_text_field_2]' type='radio' /> $item</label><br />";
    }
}

//function wac_text_field_3_render(  ) { 
//	$options = get_option( 'wac_settings' );
//        if($options['wac_text_field_3']) { $checked = ' checked="checked" '; } else { $checked = ''; };
//	echo "<input ".$checked." id='plugin_chk1' name='wac_settings[wac_text_field_3]' type='checkbox' />";
//        
//}

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
    <input type='text' name='wac_settings[wac_text_field_4]' value='<?php echo sanitize_text_field($options['wac_text_field_4']); ?>'>
    <p><small>Upload the image first to media then copy the url to this location.</small></p>
    <?php
}

function wac_settings_section_callback() {
    echo __('Update the WP-Admin with custom logo, description and details.', 'wordpress-admin-customizer');
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
        <p><small>Developed by WPZA. <a href="https://wpza.co.za">https://wpza.co.za</a></small></p>
    </form>
    <?php
}
