<?php
/**
 * Since 1.3.0
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 11/08/16
 * Time: 7:41 PM
 */

/*-----------------------------------------------------------------------------------*/
// Listing Price
/*-----------------------------------------------------------------------------------*/
if( !function_exists('houzez_listing_price') ) {
    function houzez_listing_price() {

        $sale_price = get_post_meta( get_the_ID(), 'fave_property_price', true);
        $second_price     = get_post_meta( get_the_ID(), 'fave_property_sec_price', true );
        $price_postfix = get_post_meta( get_the_ID(), 'fave_property_price_postfix', true);
        $price_prefix  = get_post_meta( get_the_ID(), 'fave_property_price_prefix', true );

        $output = '';
        $price_as_text = doubleval( $sale_price );
        if( !$price_as_text ) {
            $output .= '<span class="item-price item-price-text">'.$sale_price. '</span>';
            return $output;
        }

        if( !empty( $price_prefix ) ) {
            $price_prefix = '<span class="price-start">'.$price_prefix.'</span>';
        }

        if (!empty($sale_price)) {

            if (!empty($price_postfix)) {
                if( empty( $second_price ) ) {
                    $price_postfix = '&#47;' . $price_postfix;
                } else {
                    $price_postfix = '';
                }
            }

            return $price_prefix.' '.houzez_get_property_price($sale_price) . $price_postfix;

        }
    }
}

/*-----------------------------------------------------------------------------------*/
// Get invoice price
/*-----------------------------------------------------------------------------------*/
if( !function_exists('houzez_get_invoice_price') ) {
    function houzez_get_invoice_price ( $invoice_price ) {

        $invoice_price = doubleval( $invoice_price );

        if( $invoice_price ) {

            if ( class_exists( 'WP_Currencies' ) && isset( $_COOKIE[ "houzez_set_current_currency" ] ) ) {

                $listing_price = apply_filters( 'houzez_currency_switcher_filter', $invoice_price );
                return $listing_price;
            }

            $invoice_currency = houzez_get_currency();
            $price_decimals = 2;
            $invoice_currency_pos = houzez_option( 'currency_position' );
            $thousands_separator = houzez_option( 'thousands_separator' );
            $decimal_point_separator = houzez_option( 'decimal_point_separator' );

            //number_format() — Format a number with grouped thousands
            $final_price = number_format ( $invoice_price , $price_decimals , $decimal_point_separator , $thousands_separator );

            if(  $invoice_currency_pos == 'before' ) {
                return $invoice_currency . $final_price;
            } else {
                return $final_price . $invoice_currency;
            }

        } else {
            $invoice_currency = '';
        }

        return $invoice_currency;
    }
}

/*-----------------------------------------------------------------------------------*/
// Get price
/*-----------------------------------------------------------------------------------*/
if( !function_exists('houzez_get_property_price') ) {
    function houzez_get_property_price ( $listing_price ) {

        $listing_price = doubleval( $listing_price );

        if( $listing_price ) {

            if ( class_exists( 'WP_Currencies' ) && isset( $_COOKIE[ "houzez_set_current_currency" ] ) ) {

                $listing_price = apply_filters( 'houzez_currency_switcher_filter', $listing_price );
                return $listing_price;
            }

            $listings_currency = houzez_get_currency();
            $price_decimals = intval(houzez_option( 'decimals' ));;
            $listing_currency_pos = houzez_option( 'currency_position' );
            $price_thousands_separator = houzez_option( 'thousands_separator' );
            $price_decimal_point_separator = houzez_option( 'decimal_point_separator' );

            //number_format() — Format a number with grouped thousands
            $final_price = number_format ( $listing_price , $price_decimals , $price_decimal_point_separator , $price_thousands_separator );

            if(  $listing_currency_pos == 'before' ) {
                return $listings_currency . $final_price;
            } else {
                return $final_price . $listings_currency;
            }

        } else {
            $listings_currency = '';
        }

        return $listings_currency;
    }
}

if( !function_exists('houzez_currency_switcher_filter') ) {
    function houzez_currency_switcher_filter($listing_price) {
        $current_currency = $_COOKIE[ "houzez_set_current_currency" ];
        if ( currency_exists( $current_currency ) ) {    // validate current currency
            $base_currency = houzez_default_currency_for_switcher();
            $converted_price = convert_currency( $listing_price, $base_currency, $current_currency );
            return format_currency( $converted_price, $current_currency );
        }
    }
}
add_filter( 'houzez_currency_switcher_filter', 'houzez_currency_switcher_filter', 1, 9 );

/*-----------------------------------------------------------------------------------*/
// get user define currency from theme options, if empty return default
/*-----------------------------------------------------------------------------------*/
if(!function_exists('houzez_get_currency')){
    function houzez_get_currency(){
        //get default currency from theme options
        $houzez_default_currency = houzez_option( 'currency_symbol' );
        if(empty($houzez_default_currency)){
            return esc_html__( '$' , 'houzez' );
        }
        return $houzez_default_currency;
    }
}

/*-----------------------------------------------------------------------------------*/
// Listing price by property ID
/*-----------------------------------------------------------------------------------*/
if( !function_exists('houzez_listing_price_by_id') ) {
    function houzez_listing_price_by_id( $propID )
    {

        $sale_price = get_post_meta( $propID, 'fave_property_price', true);
        $second_price     = get_post_meta( $propID, 'fave_property_sec_price', true );
        $price_postfix = get_post_meta( $propID, 'fave_property_price_postfix', true);

        $output = '';
        $price_as_text = doubleval( $sale_price );
        if( !$price_as_text ) {
            $output .= '<span class="item-price item-price-text">'.$sale_price. '</span>';
            return $output;
        }

        if (!empty($sale_price)) {

            if (!empty($price_postfix)) {
                if( empty( $second_price ) ) {
                    $price_postfix = '&#47;' . $price_postfix;
                } else {
                    $price_postfix = '';
                }
            }

            return houzez_get_property_price($sale_price) . $price_postfix;

        }
    }
}

/*-----------------------------------------------------------------------------------*/
// Listing price version 1
/*-----------------------------------------------------------------------------------*/
if( !function_exists('houzez_listing_price_v1') ) {
    function houzez_listing_price_v1()
    {
        $output = '';
        $sale_price     = get_post_meta( get_the_ID(), 'fave_property_price', true );
        $second_price     = get_post_meta( get_the_ID(), 'fave_property_sec_price', true );
        $price_postfix  = get_post_meta( get_the_ID(), 'fave_property_price_postfix', true );
        $price_prefix  = get_post_meta( get_the_ID(), 'fave_property_price_prefix', true );

        $price_as_text = doubleval( $sale_price );
        if( !$price_as_text ) {
            if( is_singular( 'property' ) ) {
                $output .= '<span class="item-price item-price-text price-single-listing-text">'.$sale_price. '</span>';
                return $output;
            }
            $output .= '<span class="item-price item-price-text">'.$sale_price. '</span>';
            return $output;
        }

        if( !empty( $price_prefix ) ) {
            $price_prefix = '<span class="price-start">'.$price_prefix.'</span>';
        }

        if (!empty( $sale_price ) ) {

            if (!empty( $price_postfix )) {
                $price_postfix = '&#47;' . $price_postfix;
            }

            if (!empty( $sale_price ) && !empty( $second_price ) ) {

                if( is_singular( 'property' ) ) {
                    $output .= '<span class="item-price">'.$price_prefix. houzez_get_property_price($sale_price) . '</span>';
                    if (!empty($second_price)) {
                        $output .= '<span class="item-sub-price">';
                        $output .= houzez_get_property_price($second_price) . $price_postfix;
                        $output .= '</span>';
                    }
                } else {
                    $output .= $price_prefix.'<span class="item-price">'. houzez_get_property_price($sale_price) . '</span>';
                    if (!empty($second_price)) {
                        $output .= '<span class="item-sub-price">';
                        $output .= houzez_get_property_price($second_price) . $price_postfix;
                        $output .= '</span>';
                    }
                }
            } else {
                if (!empty( $sale_price )) {
                    if( is_singular( 'property' ) ) {
                        $output .= '<span class="item-price">';
                        $output .= $price_prefix. houzez_get_property_price($sale_price) . $price_postfix;
                        $output .= '</span>';
                    } else {
                        $output .= $price_prefix;
                        $output .= '<span class="item-price">';
                        $output .= houzez_get_property_price($sale_price) . $price_postfix;
                        $output .= '</span>';
                    }
                }
            }

        }
        return $output;
    }
}


/*-----------------------------------------------------------------------------------*/
// Listing price toparea v5
/*-----------------------------------------------------------------------------------*/
if( !function_exists('houzez_listing_price_v5') ) {
    function houzez_listing_price_v5()
    {
        $output = '';
        $sale_price     = get_post_meta( get_the_ID(), 'fave_property_price', true );
        $second_price     = get_post_meta( get_the_ID(), 'fave_property_sec_price', true );
        $price_postfix  = get_post_meta( get_the_ID(), 'fave_property_price_postfix', true );
        $price_prefix  = get_post_meta( get_the_ID(), 'fave_property_price_prefix', true );

        if (!empty( $price_postfix )) {
            $price_postfix = '&#47;' . $price_postfix;
        }
        
        $output .= '<h4 class="price-left"><span>'.$price_prefix.'</span> '. houzez_get_property_price($sale_price) . '</h4>';
        if (!empty($second_price)) {
            $output .= '<p class="price-right">';
            $output .= houzez_get_property_price($second_price) . $price_postfix;
            $output .= '</p>';
        }
        return $output;
    }
}


/*-----------------------------------------------------------------------------------*/
// Price for print property
/*-----------------------------------------------------------------------------------*/
if( !function_exists('houzez_listing_price_for_print') ) {
    function houzez_listing_price_for_print( $propID )
    {

        $sale_price     = get_post_meta( $propID, 'fave_property_price', true );
        $second_price     = get_post_meta( $propID, 'fave_property_sec_price', true );
        $price_postfix  = get_post_meta( $propID, 'fave_property_price_postfix', true );

        $price_prefix  = get_post_meta( $propID, 'fave_property_price_prefix', true );

        $output = '';
        $price_as_text = doubleval( $sale_price );
        if( !$price_as_text ) {
            $output .= '<span class="item-price item-price-text">'.$sale_price. '</span>';
            return $output;
        }

        if( !empty( $price_prefix ) ) {
            $price_prefix = '<span class="price-start">'.$price_prefix.'</span>';
        }

        $output = '';

        if (!empty( $sale_price ) ) {

            if (!empty( $price_postfix )) {
                $price_postfix = '&#47;' . $price_postfix;
            }

            if (!empty( $sale_price ) && !empty( $second_price ) ) {

                $output .= $price_prefix. '<span class="item-price">'. houzez_get_property_price($sale_price) . '</span>';
                if (!empty($second_price)) {
                    $output .= '<span class="item-sub-price">';
                    $output .= houzez_get_property_price($second_price) . $price_postfix;
                    $output .= '</span>';
                }
            } else {
                if (!empty( $sale_price )) {
                    $output .= '<span class="item-price">';
                    $output .= $price_prefix.' '.houzez_get_property_price($sale_price) . $price_postfix;
                    $output .= '</span>';
                }
            }

        }
        return $output;
    }
}

/*-----------------------------------------------------------------------------------*/
// Price for admin property custom post type
/*-----------------------------------------------------------------------------------*/
if( !function_exists( 'houzez_property_price_admin' ) ) {
    function houzez_property_price_admin () {
        global $post;
        $sale_price     = get_post_meta( get_the_ID(), 'fave_property_price', true );
        $second_price     = get_post_meta( get_the_ID(), 'fave_property_sec_price', true );
        $price_postfix  = get_post_meta( get_the_ID(), 'fave_property_price_postfix', true );

        $output = '';
        $price_as_text = doubleval( $sale_price );
        if( !$price_as_text ) {
            $output .= '<b>'.$sale_price. '</b>';
            echo $output;
            return;
        }

        if (!empty( $sale_price ) ) {

            if (!empty( $price_postfix )) {
                $price_postfix = '&#47;' . $price_postfix;
            }

            if (!empty( $sale_price ) && !empty( $second_price ) ) {
                echo '<b>' . houzez_get_property_price($sale_price) . '</b><br/>';

                if (!empty( $second_price )) {
                    echo houzez_get_property_price($second_price) . $price_postfix;
                }
            } else {
                if (!empty( $sale_price )) {
                    echo '<b>';
                    echo houzez_get_property_price($sale_price) . $price_postfix;
                    echo '</b>';
                }
            }

        }
    }
}


/*-----------------------------------------------------------------------------------*/
// Minimum Price List
/*-----------------------------------------------------------------------------------*/
if( !function_exists('houzez_adv_searches_min_price') ) {
    function houzez_adv_searches_min_price() {
        $prices_array = array( 500, 1000, 5000, 10000, 15000, 20000, 25000, 50000, 100000, 200000, 300000, 400000, 500000, 600000, 700000 );
        $searched_price = '';

        $minimum_price_theme_options = houzez_option('min_price');

        if( !empty($minimum_price_theme_options) ) {
            $minimum_prices_array = explode( ',', $minimum_price_theme_options );

            if( is_array( $minimum_prices_array ) && !empty( $minimum_prices_array ) ) {
                $temp_min_price_array = array();
                foreach( $minimum_prices_array as $min_price ) {
                    $min_price_integer = floatval( $min_price );
                    if( $min_price_integer > 0 ) {
                        $temp_min_price_array[] = $min_price_integer;
                    }
                }

                if( !empty( $temp_min_price_array ) ) {
                    $prices_array = $temp_min_price_array;
                }
            }
        }

        if( isset( $_GET['min-price'] ) ) {
            $searched_price = $_GET['min-price'];
        }

        if( $searched_price == 'any' )  {
            echo '<option value="any" selected="selected">'.esc_html__( 'Any', 'houzez').'</option>';
        } else {
            echo '<option value="any">'.esc_html__( 'Any', 'houzez').'</option>';
        }

        if( !empty( $prices_array ) ) {
            foreach( $prices_array as $min_price ) {
                if( $searched_price == $min_price ) {
                    echo '<option value="'.esc_attr( $min_price ).'" selected="selected">'.houzez_get_property_price( $min_price ).'</option>';
                } else {
                    echo '<option value="'.esc_attr( $min_price ).'">'.houzez_get_property_price( $min_price ).'</option>';
                }
            }
        }

    }
}

/*-----------------------------------------------------------------------------------*/
// Minimum Price List For advanced searches rent only
/*-----------------------------------------------------------------------------------*/
if( !function_exists('houzez_adv_searches_min_price_rent_only') ) {
    function houzez_adv_searches_min_price_rent_only() {
        $price_array = array( 500, 1000, 2000, 3000, 4000, 5000, 7500, 10000, 15000 );
        $searched_price = '';

        $minimum_price_theme_options = houzez_option('min_price_rent');

        if( !empty($minimum_price_theme_options) ) {
            $minimum_prices_array = explode( ',', $minimum_price_theme_options );

            if( is_array( $minimum_prices_array ) && !empty( $minimum_prices_array ) ) {
                $temp_min_price_array = array();
                foreach( $minimum_prices_array as $min_price ) {
                    $min_price_integer = floatval( $min_price );
                    if( $min_price_integer > 0 ) {
                        $temp_min_price_array[] = $min_price_integer;
                    }
                }

                if( !empty( $temp_min_price_array ) ) {
                    $price_array = $temp_min_price_array;
                }
            }
        }

        if( isset( $_GET['min-price'] ) ) {
            $searched_price = $_GET['min-price'];
        }

        if( $searched_price == 'any' )  {
            echo '<option value="any" selected="selected">'.esc_html__( 'Any', 'houzez').'</option>';
        } else {
            echo '<option value="any">'.esc_html__( 'Any', 'houzez').'</option>';
        }

        if( !empty( $price_array ) ) {
            foreach( $price_array as $min_price ) {
                if( $searched_price == $min_price ) {
                    echo '<option value="'.esc_attr( $min_price ).'" selected="selected">'.houzez_get_property_price( $min_price ).'</option>';
                } else {
                    echo '<option value="'.esc_attr( $min_price ).'">'.houzez_get_property_price( $min_price ).'</option>';
                }
            }
        }

    }
}

/*-----------------------------------------------------------------------------------*/
// Maximum Price List
/*-----------------------------------------------------------------------------------*/
if( !function_exists('houzez_adv_searches_max_price') ) {
    function houzez_adv_searches_max_price() {
        $price_array = array( 5000, 10000, 50000, 100000, 200000, 300000, 400000, 500000, 600000, 700000, 800000, 900000 );
        $searched_price = '';

        $maximum_price_theme_options = houzez_option('max_price');

        if( !empty($maximum_price_theme_options) ) {
            $maximum_price_array = explode( ',', $maximum_price_theme_options );

            if( is_array( $maximum_price_array ) && !empty( $maximum_price_array ) ) {
                $temp_max_price_array = array();
                foreach( $maximum_price_array as $max_price ) {
                    $max_price_integer = floatval( $max_price );
                    if( $max_price_integer > 0 ) {
                        $temp_max_price_array[] = $max_price_integer;
                    }
                }

                if( !empty( $temp_max_price_array ) ) {
                    $price_array = $temp_max_price_array;
                }
            }
        }

        if( isset( $_GET['max-price'] ) ) {
            $searched_price = $_GET['max-price'];
        }

        if( $searched_price == 'any' )  {
            echo '<option value="any" selected="selected">'.esc_html__( 'Any', 'houzez').'</option>';
        } else {
            echo '<option value="any">'.esc_html__( 'Any', 'houzez').'</option>';
        }

        if( !empty( $price_array ) ) {
            foreach( $price_array as $max_price ) {
                if( $searched_price == $max_price ) {
                    echo '<option value="'.esc_attr( $max_price ).'" selected="selected">'.houzez_get_property_price( $max_price ).'</option>';
                } else {
                    echo '<option value="'.esc_attr( $max_price ).'">'.houzez_get_property_price( $max_price ).'</option>';
                }
            }
        }

    }
}

/*-----------------------------------------------------------------------------------*/
// Advanced searches max price for rent only
/*-----------------------------------------------------------------------------------*/
if( !function_exists('houzez_adv_searches_max_price_rent_only') ) {
    function houzez_adv_searches_max_price_rent_only() {
        $price_array = array( 1000, 2000, 3000, 4000, 5000, 7500, 10000, 15000, 20000, 25000, 30000 );
        $searched_price = '';

        $maximum_price_theme_options = houzez_option('max_price_rent');

        if( !empty($maximum_price_theme_options) ) {
            $maximum_price_array = explode( ',', $maximum_price_theme_options );

            if( is_array( $maximum_price_array ) && !empty( $maximum_price_array ) ) {
                $temp_max_price_array = array();
                foreach( $maximum_price_array as $max_price ) {
                    $max_price_integer = floatval( $max_price );
                    if( $max_price_integer > 0 ) {
                        $temp_max_price_array[] = $max_price_integer;
                    }
                }

                if( !empty( $temp_max_price_array ) ) {
                    $price_array = $temp_max_price_array;
                }
            }
        }

        if( isset( $_GET['max-price'] ) ) {
            $searched_price = $_GET['max-price'];
        }

        if( $searched_price == 'any' )  {
            echo '<option value="any" selected="selected">'.esc_html__( 'Any', 'houzez').'</option>';
        } else {
            echo '<option value="any">'.esc_html__( 'Any', 'houzez').'</option>';
        }

        if( !empty( $price_array ) ) {
            foreach( $price_array as $max_price ) {
                if( $searched_price == $max_price ) {
                    echo '<option value="'.esc_attr( $max_price ).'" selected="selected">'.houzez_get_property_price( $max_price ).'</option>';
                } else {
                    echo '<option value="'.esc_attr( $max_price ).'">'.houzez_get_property_price( $max_price ).'</option>';
                }
            }
        }

    }
}

/*-----------------------------------------------------------------------------------*/
// get default based currecncy for currency conversion
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'houzez_default_currency_for_switcher' ) ) {

    function houzez_default_currency_for_switcher() {

        $default_currency = houzez_option('houzez_base_currency');
        if ( !empty( $default_currency ) ) {
            return $default_currency;
        } else {
            $default_currency = 'USD';
        }

        return $default_currency;
    }
}

/*-----------------------------------------------------------------------------------*/
// Get Supported currencies list from theme option for currency switcher
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'houzez_get_list_of_supported_currencies' ) ) {

    function houzez_get_list_of_supported_currencies() {

        $currencies_array = array();
        $get_currencies_list = houzez_option('houzez_supported_currencies');
        if ( ! empty( $get_currencies_list ) ) {
            $currencies_array = explode( ',', $get_currencies_list );
        } else {
            $currencies_array = array(
                'AUD','CAD','CHF','EUR','GBP','HKD','JPY','NOK','SEK','USD','NGN'
            );
        }

        return $currencies_array;
    }
}

/*-----------------------------------------------------------------------------------*/
// get current currency for currencies switcher
/*-----------------------------------------------------------------------------------*/
if ( ! function_exists( 'houzez_get_wpc_current_currency' ) ) {

    function houzez_get_wpc_current_currency() {

        if ( isset( $_COOKIE[ "houzez_set_current_currency" ] ) ) {
            $get_current_currency = $_COOKIE[ "houzez_set_current_currency" ];
            if ( currency_exists( $get_current_currency ) ) {
                $current_currency = $get_current_currency;
            } else {
                $current_currency = houzez_default_currency_for_switcher();
            }
        } else {
            $current_currency = houzez_default_currency_for_switcher();
        }

        return $current_currency;
    }
}

/*-----------------------------------------------------------------------------------*/
// Ajax function for currency conversion
/*-----------------------------------------------------------------------------------*/
add_action('wp_ajax_nopriv_houzez_currency_converter', 'houzez_currency_converter');
add_action('wp_ajax_houzez_currency_converter', 'houzez_currency_converter');

if ( ! function_exists( 'houzez_currency_converter' ) ) {

    function houzez_currency_converter()
    {

        if (isset($_POST['currency_converter'])) {

            $current_currency_expire = houzez_option('houzez_currency_expiry');

            $verify_nonce = $_POST['security'];
            if (!wp_verify_nonce($verify_nonce, 'houzez_currency_converter_nonce')) {
                echo json_encode(array(
                    'success' => false,
                    'msg' => esc_html__('Unverified Nonce!', 'houzez')
                ));
                wp_die();
            }

            if (class_exists('WP_Currencies')) {

                $currency_converter = $_POST['currency_converter'];

                // check current currency expiry time
                $currency_expiry_period = intval($current_currency_expire);
                if (!$currency_expiry_period) {
                    $currency_expiry_period = 60 * 60;
                }
                $current_currency_expiry = time() + $currency_expiry_period;

                if (currency_exists($currency_converter) && setcookie('houzez_set_current_currency', $currency_converter, $current_currency_expiry, '/')) {
                    echo json_encode(array(
                        'success' => true
                    ));
                } else {
                    echo json_encode(array(
                        'success' => false,
                        'msg' => __("Cookie update failed", 'houzez')
                    ));
                }

            } else {
                echo json_encode(array(
                    'success' => false,
                    'msg' => __('Please install and activate wp-currencies plugin!', 'houzez')
                ));
            }

        } else {
            echo json_encode(array(
                    'success' => false,
                    'msg' => __("Request not valid", 'houzez')
                )
            );
        }

        wp_die();

    }
}