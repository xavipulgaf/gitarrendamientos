<?php
/**
 * Custom Post Type Testimmonials
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 07/01/16
 * Time: 2:45 PM
 */

function houzez_get_testimonials_capabilities() {

    $caps = array(
        // meta caps (don't assign these to roles)
        'edit_post'              => 'edit_testimonial',
        'read_post'              => 'read_testimonial',
        'delete_post'            => 'delete_testimonial',

        // primitive/meta caps
        'create_posts'           => 'create_testimonials',

        // primitive caps used outside of map_meta_cap()
        'edit_posts'             => 'edit_testimonials',
       'edit_others_posts'      => 'edit_others_testimonials',
       'publish_posts'          => 'publish_testimonials',
       'read_private_posts'     => 'read_private_testimonials',

        // primitive caps used inside of map_meta_cap()
        'read'                   => 'read',
        'delete_posts'           => 'delete_testimonials',
        'delete_private_posts'   => 'delete_private_testimonials',
        'delete_published_posts' => 'delete_published_testimonials',
        'delete_others_posts'    => 'delete_others_testimonials',
        'edit_private_posts'     => 'edit_private_testimonials',
        'edit_published_posts'   => 'edit_published_testimonials'
    );

    return apply_filters( 'houzez_get_testimonials_capabilities', $caps );
}

if( !function_exists( 'houzez_testimonial_post_type' ) ){
    function houzez_testimonial_post_type(){
        $labels = array(
            'name' => __( 'Testimonials','houzez-theme-functionality'),
            'singular_name' => __( 'Testimonial','houzez-theme-functionality' ),
            'add_new' => __('Add New','houzez-theme-functionality'),
            'add_new_item' => __('Add New Testimonial','houzez-theme-functionality'),
            'edit_item' => __('Edit Testimonial','houzez-theme-functionality'),
            'new_item' => __('New Testimonial','houzez-theme-functionality'),
            'view_item' => __('View Testimonial','houzez-theme-functionality'),
            'search_items' => __('Search Agent','houzez-theme-functionality'),
            'not_found' =>  __('No Testimonial found','houzez-theme-functionality'),
            'not_found_in_trash' => __('No Testimonial found in Trash','houzez-theme-functionality'),
            'parent_item_colon' => ''
        );

        $args = array(
            'labels' => $labels,
            'public' => true,
            'exclude_from_search' => true,
            'publicly_queryable' => true,
            'show_ui' => true,
            'query_var' => true,
            'capability_type' => 'post',
            'hierarchical' => false,
            'capabilities'    => houzez_get_testimonials_capabilities(),
            'menu_icon' => 'dashicons-businessman',
            'menu_position' => 14,
            'supports' => array('title', 'page-attributes','revisions'),
            'rewrite' => array( 'slug' => __('testimonials', 'houzez-theme-functionality') )
        );

        register_post_type('houzez_testimonials',$args);
    }
}
add_action( 'init', 'houzez_testimonial_post_type' );
?>