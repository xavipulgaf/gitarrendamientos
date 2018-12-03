<?php
/**
 * Invoice Post Type
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 04/02/16
 * Time: 3:44 AM
 */
if( !function_exists( 'houzez_invoice_post_type' ) ){
    function houzez_invoice_post_type(){
        $labels = array(
            'name' => __( 'Houzez Invoices','houzez-theme-functionality'),
            'singular_name' => __( 'Houzez Invoice','houzez-theme-functionality' ),
            'add_new' => __('Add New','houzez-theme-functionality'),
            'add_new_item' => __('Add New Invoice','houzez-theme-functionality'),
            'edit_item' => __('Edit Invoice','houzez-theme-functionality'),
            'new_item' => __('New Invoice','houzez-theme-functionality'),
            'view_item' => __('View Invoice','houzez-theme-functionality'),
            'search_items' => __('Search Invoice','houzez-theme-functionality'),
            'not_found' =>  __('No Invoice found','houzez-theme-functionality'),
            'not_found_in_trash' => __('No Invoice found in Trash','houzez-theme-functionality'),
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
            'menu_icon' => 'dashicons-book',
            'menu_position' => 17,
            'supports' => array('title'),
            'exclude_from_search'   => true,
            'can_export' => true,
            'rewrite' => array( 'slug' => __('invoice', 'houzez-theme-functionality') )
        );

        register_post_type('houzez_invoice',$args);
    }
}
add_action( 'init', 'houzez_invoice_post_type' );

/**************************************************************************
 * Add Custom Columns
 **************************************************************************/
add_filter("manage_edit-houzez_invoice_columns", "houzez_invoices_edit_columns");
if( !function_exists( 'houzez_invoices_edit_columns' ) ){
    function houzez_invoices_edit_columns($columns)
    {

        $columns = array(
            "cb" => "<input type=\"checkbox\" />",
            "title" => __( 'Invoice Title','houzez-theme-functionality' ),
            "invoice_price" => __( 'Price','houzez-theme-functionality' ),
            "invoice_payment_method" => __( 'Payment Method','houzez-theme-functionality' ),
            "invoice_buyer" => __('Buyer','houzez-theme-functionality'),
            "invoice_buyer_email" => __('Buyer Email','houzez-theme-functionality'),
            "invoice_type" => __('Invoice Type','houzez-theme-functionality'),
            "billing_for" => __('Billion For','houzez-theme-functionality'),
            "invoice_status" => __( 'Status','houzez-theme-functionality' ),
            "date" => __( 'Date','houzez-theme-functionality' )
        );

        return $columns;
    }
}


add_action( 'manage_posts_custom_column', 'houzez_invoice_populate_columns' );
if( !function_exists( 'houzez_invoice_populate_columns' ) ){
    function houzez_invoice_populate_columns($column){
        global $post;

        $invoice_meta = get_post_meta( $post->ID, '_houzez_invoice_meta', true );
        switch ($column)
        {
            case 'invoice_price':
                echo esc_attr( $invoice_meta['invoice_item_price'] );
                break;

            case 'invoice_payment_method':
                if( $invoice_meta['invoice_payment_method'] == 'Direct Bank Transfer' ) {
                    esc_html_e( 'Direct Bank Transfer', 'houzez-theme-functionality' );
                } else {
                    echo $invoice_meta['invoice_payment_method'];
                }
                break;

            case 'invoice_type':
                echo esc_attr( $invoice_meta['invoice_billing_type'] );
                break;

            case 'billing_for':
                echo esc_attr( $invoice_meta['invoice_billion_for'] );
                break;

            case 'invoice_buyer':
                $user_info = get_userdata($invoice_meta['invoice_buyer_id']);
                echo esc_attr( $user_info->display_name );
                break;

            case 'invoice_buyer_email':
                $user_info = get_userdata($invoice_meta['invoice_buyer_id']);
                echo esc_attr( $user_info->user_email );
                break;

            case 'invoice_status':
                $invoice_status = get_post_meta(  $post->ID, 'invoice_payment_status', true );
                if( $invoice_status == 0 ) {
                    echo '<span class="fave_admin_label float-none label-red">'.__('Not Paid','houzez-theme-functionality').'</span>';
                } else {
                    echo '<span class="fave_admin_label float-none label-green">'.__('Paid','houzez-theme-functionality').'</span>';
                }
                break;
        }
    }
}

add_filter( 'manage_edit-houzez_invoice_sortable_columns', 'houzez_invoice_sort' );
if( !function_exists('houzez_invoice_sort') ):
    function houzez_invoice_sort( $columns ) {
        $columns['invoice_price']  = 'invoice_price';
        $columns['invoice_payment_method']  = 'invoice_payment_method';
        $columns['invoice_type']   = 'invoice_type';
        $columns['billing_for']    = 'billing_for';
        $columns['invoice_buyer']  = 'invoice_buyer';
        $columns['invoice_buyer_email']  = 'invoice_buyer_email';
        $columns['invoice_status'] = 'invoice_status';
        return $columns;
    }
endif;