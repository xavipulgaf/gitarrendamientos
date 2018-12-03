<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 08/09/16
 * Time: 8:06 PM
 */
if( !function_exists( 'houzez_payment_post_type' ) ){
    function houzez_payment_post_type(){
        $labels = array(
            'name' => __( 'Houzez Payments','houzez-theme-functionality'),
            'singular_name' => __( 'Payment','houzez-theme-functionality' ),
            'add_new' => __('Add New','houzez-theme-functionality'),
            'add_new_item' => __('Add New','houzez-theme-functionality'),
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
            'menu_position' => 10,
            'supports' => array('title'),
            'exclude_from_search'   => true,
            'can_export' => true,
            'rewrite' => array( 'slug' => __('payment', 'houzez-theme-functionality') )
        );

        register_post_type('houzez_payment',$args);
    }
}
add_action( 'init', 'houzez_payment_post_type' );

/**************************************************************************
 * Add Custom Columns
 **************************************************************************/
add_filter("manage_edit-houzez_payment_columns", "houzez_payments_edit_columns");
if( !function_exists( 'houzez_payments_edit_columns' ) ){
    function houzez_payments_edit_columns($columns)
    {

        $columns = array(
            "cb" => "<input type=\"checkbox\" />",
            "title" => __( 'Payment Title','houzez-theme-functionality' ),
            "payment_price" => __( 'Price','houzez-theme-functionality' ),
            "payment_type" => __('Payment Type','houzez-theme-functionality'),
            "payment_for" => __('Payment For','houzez-theme-functionality'),
            "payment_buyer" => __('Buyer','houzez-theme-functionality'),
            "payment_status" => __( 'Status','houzez-theme-functionality' ),
            "date" => __( 'Date','houzez-theme-functionality' )
        );

        return $columns;
    }
}


add_action( 'manage_posts_custom_column', 'houzez_payment_populate_columns' );
if( !function_exists( 'houzez_payment_populate_columns' ) ){
    function houzez_payment_populate_columns($column){
        global $post;

        $payment_meta = get_post_meta( $post->ID, '_houzez_payment_meta', true );
        switch ($column)
        {
            case 'payment_price':
                echo esc_attr( $payment_meta['payment_item_price'] );
                break;

            case 'payment_type':
                echo esc_attr( $payment_meta['payment_type'] );
                break;

            case 'payment_for':
                echo esc_attr( $payment_meta['payment_for'] );
                break;

            case 'payment_buyer':
                $user_info = get_userdata($payment_meta['payment_buyer_id']);
                echo esc_attr( $user_info->display_name );
                break;

            case 'payment_status':
                $payment_status = get_post_meta(  $post->ID, 'payment_status', true );
                if( $payment_status == 0 ) {
                    echo '<span class="fave_admin_label float-none label-red">'.__('Not Paid','houzez-theme-functionality').'</span>';
                } else {
                    echo '<span class="fave_admin_label float-none label-green">'.__('Paid','houzez-theme-functionality').'</span>';
                }
                break;
        }
    }
}

add_filter( 'manage_edit-houzez_payment_sortable_columns', 'houzez_payment_sort' );
if( !function_exists('houzez_payment_sort') ):
    function houzez_payment_sort( $columns ) {
        $columns['payment_price']  = 'payment_price';
        $columns['payment_type']   = 'payment_type';
        $columns['payment_for']    = 'billing_for';
        $columns['payment_buyer']  = 'payment_buyer';
        $columns['payment_status'] = 'payment_status';
        return $columns;
    }
endif;

// Save payment
if( !function_exists('houzez_add_payment') ):
    function houzez_add_payment( $paymentFor, $paymentType, $packageID, $userID, $featured, $upgrade, $paypalTaxID ) {

        $price_per_submission = houzez_option('price_listing_submission');
        $price_featured_submission = houzez_option('price_featured_listing_submission');

        $price_per_submission      = floatval( $price_per_submission );
        $price_featured_submission = floatval( $price_featured_submission );

        $time = time();
        $paymentDate = date('Y-m-d H:i:s',$time);

        $args = array(
            'post_title'	=> 'payment ',
            'post_status'	=> 'publish',
            'post_type'     => 'houzez_payment'
        );
        $inserted_post_id =  wp_insert_post( $args );

        if( $paymentType != 'one_time' ) {
            $paymentType = __( 'Recurring', 'houzez-theme-functionality' );
        } else {
            $paymentType = __( 'One Time', 'houzez-theme-functionality' );
        }

        if( $paymentFor != 'package' ) {
            if( $upgrade == 1 ) {
                $total_price = $price_featured_submission;

            } else {
                if( $featured == 1 ) {
                    $total_price = $price_per_submission+$price_featured_submission;
                } else {
                    $total_price = $price_per_submission;
                }
            }
        } else {
            $total_price = get_post_meta( $packageID, 'fave_package_price', true);
        }

        $fave_meta = array();

        $fave_meta['payment_for'] = $paymentFor;
        $fave_meta['payment_type'] = $paymentType;
        $fave_meta['payment_item_id'] = $packageID;
        $fave_meta['payment_item_price'] = $total_price;
        $fave_meta['payment_purchase_date'] = $paymentDate;
        $fave_meta['payment_buyer_id'] = $userID;
        $fave_meta['paypal_txn_id'] = $paypalTaxID;

        update_post_meta( $inserted_post_id, 'HOUZEZ_payment_buyer', $userID );
        update_post_meta( $inserted_post_id, 'HOUZEZ_payment_type', $paymentType );
        update_post_meta( $inserted_post_id, 'HOUZEZ_payment_for', $paymentFor );
        update_post_meta( $inserted_post_id, 'HOUZEZ_payment_item_id', $packageID );
        update_post_meta( $inserted_post_id, 'HOUZEZ_payment_price', $total_price );
        update_post_meta( $inserted_post_id, 'HOUZEZ_payment_date', $paymentDate );
        update_post_meta( $inserted_post_id, 'HOUZEZ_paypal_txn_id', $paypalTaxID );

        update_post_meta( $inserted_post_id, '_favethemes_payment_meta', $fave_meta );

        // Update post title
        $update_post = array(
            'ID'         => $inserted_post_id,
            'post_title' => 'payment '.$inserted_post_id,
        );
        wp_update_post( $update_post );
        return $inserted_post_id;
    }
endif;