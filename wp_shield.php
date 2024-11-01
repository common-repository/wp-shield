<?php
/*
Plugin Name: WP Shield
Plugin URI: https://www.tronebrandenergy.com/plugins/shield
Description: Adds an htaccess block to be used on your sebsite
Version: 1.6
Author: Matthew Sherman
Author URI: https://www.tronebrandenergu.com
Text Domain: wp_shield
*/

if (! defined('MODULE')) {
    define('MODULE', __FILE__);
}
if (!defined('MODULE_PATH')) {
    define('MODULE_PATH', plugin_dir_path(MODULE));
}

require_once(MODULE_PATH . 'wp_shield_auth.php');
new WP_SHIELD_AUTH();

function wp_shield_admin_menu()
{
    add_menu_page('WP Shield Settings', 'WP Shield', 'manage_options', 'wp-shield-settings', 'wp_shield_form_page_handler', '', 26) ;
}
add_action('admin_menu', 'wp_shield_admin_menu');


if (!function_exists("update_wp_shield_info")) {
    function update_wp_shield_info()
    {
        register_setting('wp-shield-settings', 'wp_shield_enabled');
        register_setting('wp-shield-settings', 'wp_shield_username');
        register_setting('wp-shield-settings', 'wp_shield_password');
    }
}
add_action('admin_init', 'update_wp_shield_info');

function wp_shield_form_page_handler()
{
    include_once('admin/templates/settings.php');
}
