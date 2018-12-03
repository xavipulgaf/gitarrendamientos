<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 09/10/16
 * Time: 10:29 PM
 */
if ( get_option( 'houzez_1_5_db' ) == false ) :

    function houzez_db_update_notice() {

        $update_url     = add_query_arg( array(
            'houzez_update_bd' => 'true'
        ), admin_url() );

        ?>
        <div class="error notice">
            <h3><?php _e( 'Database need to be update for Houzez 1.5.0', 'houzez' ); ?></h3>
            <p><a href="<?php echo esc_url( $update_url ); ?>"><?php _e( 'Click here for database update, It is required', 'houzez' ); ?></a></p>
        </div>
        <?php

    }

    //add_action( 'admin_notices', 'houzez_db_update_notice' );

    function houzez_update_bd() {

        if ( isset( $_REQUEST['houzez_update_bd'] ) && $_REQUEST['houzez_update_bd'] == true ) :

            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

            global $wpdb;

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

            add_option( 'houzez_1_5_db', true );

            header( 'Location: ' . admin_url() );

        endif;

    }

    add_action( 'admin_init', 'houzez_update_bd' );

endif;