<?php
if (!(defined('WP_CLI') && WP_CLI)) {
    zwp_auto_update();
}
function zwp_auto_update()
{

    // wordpress core update disable
    add_filter('auto_update_core', '__return_false');

    // dashboard update notification disable
    add_filter('pre_site_transient_update_core', '__return_zero');
    remove_action('wp_version_check', 'wp_version_check');
    remove_action('admin_init', '_maybe_update_core');

    // notification mail disable
    add_filter('auto_core_update_send_email', '__return_false');

    // update auto plugin enable
    add_action(
        'wp_update_plugins',
        function() {
                if ( wp_doing_cron() && ! doing_action( 'wp_maybe_auto_update' ) ) {
                        do_action( 'wp_maybe_auto_update' );
                }
        }
    );

    // update auto theme enable
    add_action(
        'wp_update_themes',
        function() {
                if ( wp_doing_cron() && ! doing_action( 'wp_maybe_auto_update' ) ) {
                        do_action( 'wp_maybe_auto_update' );
                }
        }
    );
}
