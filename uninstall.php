<?php

function wp_shield_uninstall()
{
    if (!defined('WP_UNINSTALL_PLUGIN')) {
        die;
    }
    // Remove Options from the database
    delete_option('wp_shield_username');
    delete_option('wp_shield_password');
    delete_option('wp_shield_enabled');
}
