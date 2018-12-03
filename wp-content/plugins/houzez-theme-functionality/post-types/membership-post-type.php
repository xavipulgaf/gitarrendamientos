<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 06/10/15
 * Time: 12:39 PM
 */

// register the custom post type
add_action( 'init', 'houzez_create_membership_type' );

if( !function_exists('houzez_create_membership_type') ):
    function houzez_create_membership_type() {
        register_post_type( 'houzez_packages',
            array(
                'labels' => array(
                    'name'          => __( 'Houzez Packages','houzez-theme-functionality'),
                    'singular_name' => __( 'Packages','houzez-theme-functionality'),
                    'add_new'       => __('Add New Package','houzez-theme-functionality'),
                    'add_new_item'          =>  __('Add Packages','houzez-theme-functionality'),
                    'edit'                  =>  __('Edit Packages' ,'houzez-theme-functionality'),
                    'edit_item'             =>  __('Edit Package','houzez-theme-functionality'),
                    'new_item'              =>  __('New Packages','houzez-theme-functionality'),
                    'view'                  =>  __('View Packages','houzez-theme-functionality'),
                    'view_item'             =>  __('View Packages','houzez-theme-functionality'),
                    'search_items'          =>  __('Search Packages','houzez-theme-functionality'),
                    'not_found'             =>  __('No Packages found','houzez-theme-functionality'),
                    'not_found_in_trash'    =>  __('No Packages found','houzez-theme-functionality'),
                    'parent'                =>  __('Parent Package','houzez-theme-functionality')
                ),
                'public' => true,
                'has_archive' => true,
                'rewrite' => array('slug' => 'package'),
                'supports' => array('title', 'page-attributes' ),
                'capability_type'    => 'page',
                'exclude_from_search'   => true,
                'can_export' => true,
                'menu_position' => 16,
                'menu_icon'=> 'dashicons-money'
            )
        );
    }
endif; // end   houzez_create_membership_type