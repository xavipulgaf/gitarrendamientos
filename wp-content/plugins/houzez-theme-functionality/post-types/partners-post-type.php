<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 07/01/16
 * Time: 6:41 PM
 */
if( !function_exists( 'houzez_partner_post_type' ) ){
    function houzez_partner_post_type(){
        $labels = array(
            'name' => __( 'Partners','houzez-theme-functionality'),
            'singular_name' => __( 'Partner','houzez-theme-functionality' ),
            'add_new' => __('Add New','houzez-theme-functionality'),
            'add_new_item' => __('Add New Partner','houzez-theme-functionality'),
            'edit_item' => __('Edit Partner','houzez-theme-functionality'),
            'new_item' => __('New Partner','houzez-theme-functionality'),
            'view_item' => __('View Partner','houzez-theme-functionality'),
            'search_items' => __('Search Partner','houzez-theme-functionality'),
            'not_found' =>  __('No Partner found','houzez-theme-functionality'),
            'not_found_in_trash' => __('No Partner found in Trash','houzez-theme-functionality'),
            'parent_item_colon' => ''
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'exclude_from_search' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'query_var' => true,
            'capability_type' => 'page',
            'hierarchical' => false,
            'menu_icon' => 'dashicons-awards',
            'menu_position' => 22,
            'supports' => array('title','page-attributes','thumbnail','revisions'),
            'rewrite' => array( 'slug' => __('partner', 'houzez-theme-functionality') )
        );

        register_post_type('houzez_partner',$args);
    }
}
add_action( 'init', 'houzez_partner_post_type' );

?>