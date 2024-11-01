<?php if (! defined('ABSPATH')) {
    exit;
} ?>

<div class="wrap">
  <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
  <form method="post" action="options.php">

    <?php settings_fields('wp-shield-settings'); ?>
    <?php do_settings_sections('wp-shield-settings'); ?>

      <div id="wps-shield-enable-container">
          <h2>Enable Shield</h2>

          <div class="options">
              <p>
                <input type="checkbox" id="wp_shield_enabled" name='wp_shield_enabled'
                checked="<?php echo get_option('wp_shield_enabled'); ?>"/>
                <label for="wp_shield_enabled">Enable WP Shield</label>
              </p>
      </div><!-- #wps-shield-enable-container -->

      <div id="wps-shield-credentials-container">
          <h2>Shield Credentials</h2>
          <p>
            <strong>
              <label for="wp_shield_username">Shield Username</label>
            </strong>
            <br />
            <input type="text" id="wp_shield_username" name="wp_shield_username" maxlength="50"
            value="<?php echo get_option('wp_shield_username'); ?>" />
          </p>
          <p>
            <strong>
              <label for="wp_shield_password">Shield Password</label>
            <strong>
            <br />
            <input type="text" id="wpShieldPassword" name="wp_shield_password" maxlength="50"
            value="<?php echo get_option('wp_shield_password'); ?>"/>
          </p>
      </div><!-- #wps-shield-credentials-container -->
      <?php
        wp_nonce_field('wp-shield-save', 'wp-shield-message');
        submit_button();
      ?>
  </form>


</div><!-- .wrap -->
