<?php
/*
Plugin Name: Houzez Theme - Functionality
Plugin URI:  http://themeforest.net/user/favethemes
Description: Adds functionality to Favethemes Themes
Version:     1.4.3
Author:      Favethemes
Author URI:  http://themeforest.net/user/favethemes
License:     GPL2
*/

class Houzez_Functionality {

	/**
     * Constructor
     *
     * @since 1.0
     *
    */
    public function __construct() {
        $this->houzez_constants();
    	$this->houzez_inc_files();
        add_action( 'plugins_loaded', array( &$this, 'houzez_pluginsLoaded' ), 9 );
        register_activation_hook( __FILE__, array( &$this, 'houzez_plugin_activation' ) );
        register_deactivation_hook( __FILE__, array( &$this, 'houzez_plugin_deactivate' ) );
    }

    /**
     * Define constants
     *
     * @since 1.0
     *
    */
    protected function houzez_constants() {

        /**
         * Plugin Path
         */
        define( 'HOUZEZ_FUNC_PATH', plugin_dir_path( __FILE__ ) );

    }

    /**
     * include files
     *
     * @since 1.0
     *
    */
    function houzez_inc_files() {

        $fave_theme_name = (wp_get_theme()->Name);

        $activation_status = get_option( 'houzez_activation' );

        if( $fave_theme_name == 'Houzez' || $fave_theme_name == 'Houzez Child' ) {

            //Custom Post Types
            if( $activation_status == 'activated') {
                require_once(HOUZEZ_FUNC_PATH . 'post-types/agency-post-type.php');
            }
            require_once(HOUZEZ_FUNC_PATH . 'post-types/agent-post-type.php');
            require_once(HOUZEZ_FUNC_PATH . 'post-types/membership-post-type.php');
            require_once(HOUZEZ_FUNC_PATH . 'post-types/property-post-type.php');
            require_once(HOUZEZ_FUNC_PATH . 'post-types/testimonials-post-type.php');
            require_once(HOUZEZ_FUNC_PATH . 'post-types/partners-post-type.php');
            require_once(HOUZEZ_FUNC_PATH . 'post-types/invoice-post-type.php');
            require_once(HOUZEZ_FUNC_PATH . 'post-types/user-packages-post-type.php');
            require_once(HOUZEZ_FUNC_PATH . 'post-types/functions-options.php');
            require_once(HOUZEZ_FUNC_PATH . 'post-types/functions-rewrite.php');
            require_once(HOUZEZ_FUNC_PATH . 'functions.php');

            // Classes
            require_once(HOUZEZ_FUNC_PATH . '/classes/class-settings.php');
            require_once(HOUZEZ_FUNC_PATH . '/classes/Houzez_Query.php');

            // VC Shourcodes
            //if( $activation_status == 'activated') {
                require_once(HOUZEZ_FUNC_PATH . 'vc_shortcodes/section-title.php');
                require_once(HOUZEZ_FUNC_PATH . 'vc_shortcodes/advance-search.php');
                require_once(HOUZEZ_FUNC_PATH . 'vc_shortcodes/grids.php');
                require_once(HOUZEZ_FUNC_PATH . 'vc_shortcodes/property-carousel.php');
                require_once(HOUZEZ_FUNC_PATH . 'vc_shortcodes/property-carousel-v2.php');
                require_once(HOUZEZ_FUNC_PATH . 'vc_shortcodes/properties-grids.php');
                require_once(HOUZEZ_FUNC_PATH . 'vc_shortcodes/testimonials.php');
                require_once(HOUZEZ_FUNC_PATH . 'vc_shortcodes/agents.php');
                require_once(HOUZEZ_FUNC_PATH . 'vc_shortcodes/partners.php');
                require_once(HOUZEZ_FUNC_PATH . 'vc_shortcodes/blog-posts.php');
                require_once(HOUZEZ_FUNC_PATH . 'vc_shortcodes/blog-posts-carousel.php');
                require_once(HOUZEZ_FUNC_PATH . 'vc_shortcodes/properties.php');
                require_once(HOUZEZ_FUNC_PATH . 'vc_shortcodes/property-by-id.php');
                require_once(HOUZEZ_FUNC_PATH . 'vc_shortcodes/property-by-ids.php');
                require_once(HOUZEZ_FUNC_PATH . 'vc_shortcodes/properties-map.php');
                require_once(HOUZEZ_FUNC_PATH . 'vc_shortcodes/team-member.php');
                require_once(HOUZEZ_FUNC_PATH . 'vc_shortcodes/price-table.php');
                require_once(HOUZEZ_FUNC_PATH . 'vc_shortcodes/space.php');
            //}

            //Meta & Tax
            require_once(HOUZEZ_FUNC_PATH . 'extensions/Tax-meta-class/Tax-meta-class.php');
            require_once(HOUZEZ_FUNC_PATH . 'extensions/Tax-meta-class/fave-class-config.php');

            if (!class_exists('RW_Meta_Box')) {
                require_once(HOUZEZ_FUNC_PATH . 'extensions/meta-box/meta-box.php');
            }
            if (!class_exists('RWMB_Tabs')) {
                require_once(HOUZEZ_FUNC_PATH . 'extensions/meta-box/addons/meta-box-tabs/meta-box-tabs.php');
            }
            if (!class_exists('RWMB_Columns')) {
                require_once(HOUZEZ_FUNC_PATH . 'extensions/meta-box/addons/meta-box-columns/meta-box-columns.php');
            }
            if (!class_exists('RWMB_Group')) {
                require_once(HOUZEZ_FUNC_PATH . 'extensions/meta-box/addons/meta-box-group/meta-box-group.php');
            }

            // Include the Redux theme options Framework
            if (!class_exists('ReduxFramework')) {
                require_once(HOUZEZ_FUNC_PATH . 'extensions/redux/ReduxCore/framework.php');
            }

            //paypal
            require_once(HOUZEZ_FUNC_PATH . 'third-party/3rdparty_functions.php');

            require_once(HOUZEZ_FUNC_PATH . 'statistics/houzez-statistics-functions.php');
            require_once(HOUZEZ_FUNC_PATH . 'statistics/houzez-statistics.php');

        } // End theme check
    }

    /**
     * Callback function WP plugin_loaded action hook. Loads lang
     *
     * @since  1.0
     * @access public
     */
    public function houzez_pluginsLoaded() {
        load_plugin_textdomain( 'houzez-theme-functionality', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
    }

    public function houzez_plugin_activation()
    {

        global $wpdb;

        $table_name         = $wpdb->prefix . 'houzez_search';
        $charset_collate    = $wpdb->get_charset_collate();
        $sql                = "CREATE TABLE $table_name (
           id mediumint(9) NOT NULL AUTO_INCREMENT,
           auther_id mediumint(9) NOT NULL,
           query longtext NOT NULL,
           email longtext DEFAULT '' NOT NULL,
           url longtext DEFAULT '' NOT NULL,
           time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
           UNIQUE KEY id (id)
       ) $charset_collate;";

        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

        dbDelta( $sql );

        $table_name         = $wpdb->prefix . 'houzez_threads';
        $charset_collate    = $wpdb->get_charset_collate();
        $sql                = "CREATE TABLE $table_name (
           id mediumint(9) NOT NULL AUTO_INCREMENT,
           sender_id mediumint(9) NOT NULL,
           receiver_id mediumint(9) NOT NULL,
           property_id mediumint(9) NOT NULL,
           seen mediumint(9) NOT NULL,
           time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
           UNIQUE KEY id (id)
       ) $charset_collate;";

        dbDelta( $sql );

        $table_name         = $wpdb->prefix . 'houzez_thread_messages';
        $charset_collate    = $wpdb->get_charset_collate();
        $sql                = "CREATE TABLE $table_name (
           id mediumint(9) NOT NULL AUTO_INCREMENT,
           created_by mediumint(9) NOT NULL,
           thread_id mediumint(9) NOT NULL,
           message longtext DEFAULT '' NOT NULL,
           attachments longtext DEFAULT '' NOT NULL,
           time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
           UNIQUE KEY id (id)
       ) $charset_collate;";

        dbDelta( $sql );

        if (!wp_next_scheduled('houzez_check_new_listing_action_hook')) {
            wp_schedule_event(time(), 'daily', 'houzez_check_new_listing_action_hook');
        }

        if (!wp_next_scheduled('houzez_check_new_listing_action_hook')) {
            wp_schedule_event(time(), 'weekly', 'houzez_check_new_listing_action_hook');
        }

    }

    public function houzez_plugin_deactivate()
    {

        global $wpdb;

        $table_name = $wpdb->prefix . 'houzez_search';
        $sql        = "DROP TABLE ". $table_name;

        $wpdb->query( $sql );

        wp_clear_scheduled_hook('houzez_check_new_listing_action_hook');

    }

}

/**
 * Instantiate the Class
 *
 * @since     1.0
 * @global    object
 */
$houzez_functionality = new Houzez_Functionality();
?>