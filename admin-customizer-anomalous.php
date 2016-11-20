<?php

/**
 *
 * @link              http://www.anomalous.co.za
 * @since             1.0.0
 * @package           wordpress-admin-customizer
 *
 * @wordpress-plugin
 * Plugin Name:       WordPress Admin Customizer
 * Plugin URI:        http://www.anomalous.co.za
 * Description:       Some simple changes to Admin, Login Logo, Admin Copyright and other simple changes.
 * Version:           1.0.0
 * Author:            Donovan Maidens
 * Author URI:        http://www.anomalous.co.za
 */
// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}
if(!class_exists("AdminCustomizerAnomalousPlugin"))
{
    /**
     * class:   AdminCustomizerAnomalousPlugin
     * desc:    plugin class to allow reports be pulled from multipe GA accounts
     */
    class AdminCustomizerAnomalousPlugin
    {
        /**
         * Created an instance of the AdminCustomizerAnomalousPlugin class
         */
        public function __construct()
        {
            require_once(sprintf("%s/includes/custom-admin.php", dirname(__FILE__)));
        } // END public function __construct()

        /**
         * Hook into the WordPress activate hook
         */
        public static function activate()
        {
            // Do something
        }

        /**
         * Hook into the WordPress deactivate hook
         */
        public static function deactivate()
        {
            // Do something
        }
    } // END class AdminCustomizerAnomalousPlugin
} // END if(!class_exists("AdminCustomizerAnomalousPlugin"))

if(class_exists('AdminCustomizerAnomalousPlugin'))
{    
    // Installation and uninstallation hooks
    register_activation_hook(__FILE__, array('AdminCustomizerAnomalousPlugin', 'activate'));
    register_deactivation_hook(__FILE__, array('AdminCustomizerAnomalousPlugin', 'deactivate'));
    
    // instantiate the plugin class
    $plugin = new AdminCustomizerAnomalousPlugin();
} // END if(class_exists('AdminCustomizerAnomalousPlugin'))