<?php

namespace SmashBalloon\Reviews\Common\Admin;

use Smashballoon\Stubs\Services\ServiceProvider;

class SBR_Admin_Notice extends ServiceProvider{

    function register() {
        $this->init();
    }

    public function init() {
        if ( ! is_admin() ) {
            return;
        }

        add_action('admin_notices', [$this, 'apikey_limit_notice']);
        add_action( 'wp_ajax_sbr_dismiss_license_notice', [ $this, 'sbr_dismiss_license_notice' ] );
    }


    public static function check_menu_notice_bubble(){
        $is_admin_bubble = false;
        $api_limits = get_option('sbr_apikeys_limit', []);

        if( is_array( $api_limits )  && sizeof( $api_limits ) > 0 ){
            $is_admin_bubble = true;
        }


        return $is_admin_bubble;
    }

    public function apikey_limit_notice(){
        $api_limits = get_option('sbr_apikeys_limit', []);
        $should_show_notice = is_array( $api_limits )  && sizeof( $api_limits ) > 0;
        if ( ! $should_show_notice ) {
            return;
        }
        ?>
        <div class="notice notice-error">
            <p>
                <?php echo sprintf(
                    __('You have reached the maximum sources limit for (%s), Please enter a valid API key to retrieve new sources. Please add API Key %shere%s', 'sb-reviews'),
                    ucfirst( join( ", ", $api_limits ) ),
                    '<a href="' . admin_url('admin.php?page=sbr-settings') . '">',
                    '</a>');
                ?>
            </p>
        </div>
        <?php
    }

     /**
     * CFF Dismiss Notice
     *
     * @since 1.1
     */
    public function sbr_dismiss_license_notice() {
        check_ajax_referer( 'sbr-admin' , 'nonce');
        if ( ! sbr_current_user_can('manage_reviews_feed_options') ) {
            wp_send_json_error(); // This auto-dies.
        }

        global $current_user;
        $user_id = $current_user->ID;
        update_user_meta( $user_id, 'sbr_ignore_dashboard_license_notice', true );
    }

}