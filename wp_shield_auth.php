<?php

/**
 * @package WPShield
 */
class WP_SHIELD_AUTH
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        add_action('init', array($this, 'wp_shield_auth'));
    }

    public function wp_shield_auth()
    {
        // Check for existing external credentials
        if (file_exists(ABSPATH . 'shield-settings.php')) {
            require_once(ABSPATH . 'shield-settings.php');
        }

        // Check if plugin is enabled
        $is_enabled = $this->wp_shield_is_enabled();

        // Get UN from Config or Database
        $active_un = defined('WP_SHIELD_UN') ? WP_SHIELD_UN : get_option('wp_shield_username');

        // Get UN from Config or Database
        $active_pw = defined('WP_SHIELD_PWD') ? WP_SHIELD_PWD : get_option('wp_shield_password');

        $is_not_authenticated = true;

        // Check for WP CLI as this does not need to be shielded
        $is_wp_cli = $this->wp_is_cli();
        if ($is_wp_cli) {
            return;
        }

        if ($is_enabled && $is_not_authenticated) {
            header('Cache-Control: no-cache, must-revalidate, max-age=0');
            $has_supplied_credentials = !(empty($_SERVER['PHP_AUTH_USER']) && empty($_SERVER['PHP_AUTH_PW']));

            // Is user already authenticated?
            $is_not_authenticated = (
                !$has_supplied_credentials ||
        $_SERVER['PHP_AUTH_USER'] != $active_un ||
        $_SERVER['PHP_AUTH_PW'] != $active_pw
      );

            if ($is_not_authenticated) {
                header('WWW-Authenticate: Basic realm="Access denied"');
                header('HTTP/1.1 401 Authorization Required');
                exit;
            }
        }
    }

    public function wp_shield_is_enabled()
    {
        $wp_shield_enabled = false;
        switch (get_option('wp_shield_enabled')) {
      case 'on':
        $wp_shield_enabled = true;
        break;
      default:
        $wp_shield_enabled = false;
        break;
    }

        if (defined('WP_SHIELD_UN')) {
            if (empty(WP_SHIELD_UN)) {
                return false;
            } else {
                return true;
            }
        } else {
            return $wp_shield_enabled;
        }
        return false;
    }

    public function wp_is_cli()
    {
        if (defined('WP_CLI') && WP_CLI) {
            return true;
        }
        return false;
    }
}
