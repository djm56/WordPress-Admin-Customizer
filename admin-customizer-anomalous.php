<?php

/**
 *
 * @link              https://wpza.co.za
 * @since             1.0.0
 * @package           wordpress-admin-customizer
 *
 * @wordpress-plugin
 * Plugin Name:       WordPress Admin Customizer
 * Plugin URI:        https://github.com/djm56/WordPress-Admin-Customizer
 * Description:       Some simple changes to Admin, Login Logo, Admin Copyright and other simple changes.
 * Version:           1.3.0
 * Author:            Donovan Maidens
 * Author URI:        https://wpza.co.za
 */
// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}
if (!class_exists("AdminCustomizerAnomalousPlugin")) {

    /**
     * class:   AdminCustomizerAnomalousPlugin
     * desc:    plugin class to allow reports be pulled from multipe GA accounts
     */
    class AdminCustomizerAnomalousPlugin {

        /**
         * Created an instance of the AdminCustomizerAnomalousPlugin class
         */
        public function __construct() {
            require_once(sprintf("%s/includes/custom-admin.php", dirname(__FILE__)));
            require_once(sprintf("%s/includes/cutom-options.php", dirname(__FILE__)));
        }

// END public function __construct()

        /**
         * Hook into the WordPress activate hook
         */
        public static function activate() {
            // Clear all options on activation, if Restore Defaults Upon Reactivation = Yes 
            $tmp = get_option('wac_settings');
            if (($tmp['wac_text_field_3'] == 'Yes') || (!is_array($tmp))) {
                $arr = array(
                    "wac_text_field_0" => "WPZA",
                    "wac_text_field_1" => "",
                    "wac_text_field_2" => "No",
                    "wac_text_field_3" => "No",
                    "wac_text_field_4" => "",
                    "wac_text_field_5" => "",
                    "wac_text_field_6" => "",
                    "wac_text_field_7" => "",
                    "wac_text_field_8" => "",
                    "wac_text_field_9" => "",
                    "wac_text_field_10" => "",
                    "wac_text_field_11" => "",
                );
                update_option('wac_settings', $arr);
            }
        }

        /**
         * Hook into the WordPress deactivate hook
         */
        public static function deactivate() {
            // Do something
        }

    }

    // END class AdminCustomizerAnomalousPlugin
} // END if(!class_exists("AdminCustomizerAnomalousPlugin"))

if (class_exists('AdminCustomizerAnomalousPlugin')) {
    // Installation and uninstallation hooks
    register_activation_hook(__FILE__, array('AdminCustomizerAnomalousPlugin', 'activate'));
    register_deactivation_hook(__FILE__, array('AdminCustomizerAnomalousPlugin', 'deactivate'));

    // instantiate the plugin class
    $plugin = new AdminCustomizerAnomalousPlugin();
} // END if(class_exists('AdminCustomizerAnomalousPlugin'))