<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 08/09/16
 * Time: 5:10 PM
 */


function houzez_get_user_packages_capabilities() {

    $caps = array(
        // meta caps (don't assign these to roles)
        'create_posts' => 'do_not_allow',
        'edit_post'    => 'edit_user_packages',
        'delete_post'  => 'delete_user_package',
        'delete_posts'           => 'delete_user_packages',
    );

    return apply_filters( 'houzez_get_user_packages_capabilities', $caps );
}

// register the custom post type
add_action( 'init', 'houzez_create_user_package_type' );

if( !function_exists('houzez_create_user_package_type') ):
    function houzez_create_user_package_type() {
        register_post_type( 'user_packages',
            array(
                'labels' => array(
                    'name'          => __( 'Users Package Info','houzez-theme-functionality'),
                    'singular_name' => __( 'Packages','houzez-theme-functionality'),
                    'add_new'       => __('Add New','houzez-theme-functionality'),
                    'add_new_item'          =>  __('Add New','houzez-theme-functionality'),
                ),
                'public' => true,
                'has_archive' => true,
                'rewrite' => array('slug' => 'user_packages'),
                'supports' => array('title', 'page-attributes' ),
                'capability_type'    => 'page',
                'capabilities' => houzez_get_user_packages_capabilities(),
                'exclude_from_search'   => true,
                'can_export' => true,
                'menu_position' => 18,
                'menu_icon'=> 'dashicons-money'
            )
        );
    }
endif; // end   houzez_create_membership_type

/**************************************************************************
 * Add Custom Columns
 **************************************************************************/
add_filter("manage_edit-user_packages_columns", "user_packages_edit_columns");
if( !function_exists( 'user_packages_edit_columns' ) ){
    function user_packages_edit_columns($columns)
    {

        $columns = array(
            "cb" => "<input type=\"checkbox\" />",
            "title" => __( 'Title','houzez-theme-functionality' ),
            "package_holder" => __( 'Package Holder','houzez-theme-functionality' ),
            "package" => __( 'Package','houzez-theme-functionality' ),
            "listings_avl" => __('Available Listings','houzez-theme-functionality'),
            "featured_avl" => __('Featured Available','houzez-theme-functionality'),
            "activation_date" => __('Activation','houzez-theme-functionality'),
            "expire_date" => __( 'Expiry','houzez-theme-functionality' )
        );

        return $columns;
    }
}


add_action( 'manage_posts_custom_column', 'user_packages_populate_columns' );
if( !function_exists( 'user_packages_populate_columns' ) ){
    function user_packages_populate_columns($column){
        global $post;

        $postID = $post->ID;
        $seconds = 0;
        $package_user_id = get_post_meta( $postID, 'user_packages_userID', true );
        $pack_id = get_user_meta( $package_user_id, 'package_id', true );
        $pack_available_listings = get_user_meta( $package_user_id, 'package_listings', true );
        $pack_featured_available_listings = get_user_meta( $package_user_id, 'package_featured_listings', true );
        $package_activation = get_user_meta( $package_user_id, 'package_activation', true );
        $package_name = get_the_title( $pack_id );
        $user_info = get_userdata( $package_user_id );

        $pack_billing_period = get_post_meta( $pack_id, 'fave_billing_time_unit', true );
        $pack_billing_frequency = get_post_meta( $pack_id, 'fave_billing_unit', true );
        $pack_date = strtotime ( get_user_meta( $package_user_id, 'package_activation',true ) );

        switch ( $pack_billing_period ) {
            case 'Day':
                $seconds = 60*60*24;
                break;
            case 'Week':
                $seconds = 60*60*24*7;
                break;
            case 'Month':
                $seconds = 60*60*24*30;
                break;
            case 'Year':
                $seconds = 60*60*24*365;
                break;
        }

        $pack_time_frame = $seconds * $pack_billing_frequency;
        $expired_date    = $pack_date + $pack_time_frame;
        $expired_date    = date( 'Y-m-d', $expired_date );

        switch ($column)
        {
            case 'package_holder':
                echo esc_attr( $user_info->display_name );
                break;

            case 'package':
                echo esc_attr( $package_name );
                break;

            case 'listings_avl':
                echo esc_attr( $pack_available_listings );
                break;

            case 'featured_avl':
                echo esc_attr( $pack_featured_available_listings );
                break;

            case 'activation_date':
                echo esc_attr( $package_activation );
                break;

            case 'expire_date':
                echo esc_attr( $expired_date );
                break;

        }
    }
}

add_filter( 'manage_edit-user_packages_sortable_columns', 'user_packages_sort' );
if( !function_exists('user_packages_sort') ):
    function user_packages_sort( $columns ) {
        $columns['package_holder']  = 'package_holder';
        $columns['package']   = 'package';
        $columns['listings_avl']    = 'listings_avl';
        $columns['featured_avl']    = 'featured_avl';
        $columns['activation_date']  = 'activation_date';
        $columns['expire_date'] = 'expire_date';
        return $columns;
    }
endif;