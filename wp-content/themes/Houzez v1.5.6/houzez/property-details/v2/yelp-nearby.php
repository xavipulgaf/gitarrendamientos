<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 10/10/16
 * Time: 4:17 AM
 * Since v1.4.0
 */

$hide_yelp = houzez_option('houzez_yelp');
$houzez_yelp_consumer_key = houzez_option('houzez_yelp_consumer_key');
$houzez_yelp_secret_consumer_key = houzez_option('houzez_yelp_secret_consumer_key');
$houzez_yelp_token = houzez_option('houzez_yelp_token');
$houzez_yelp_secret_token = houzez_option('houzez_yelp_secret_token');

if( empty( $houzez_yelp_consumer_key ) || empty($houzez_yelp_secret_consumer_key) || empty($houzez_yelp_token) || empty($houzez_yelp_secret_token) ) {
    return;
}

$yelp_categories = array (
    'active' => array( 'name' => 'Active Life', 'icon' => 'fa fa-bicycle' ),
    'arts' => array( 'name' => 'Arts & Entertainment', 'icon' => 'fa fa-picture-o' ),
    'auto' => array( 'name' => 'Automotive', 'icon' => 'fa fa-car' ),
    'beautysvc' => array( 'name' => 'Beauty & Spas', 'icon' => 'fa fa-cutlery' ),
    'education' => array( 'name' => 'Education', 'icon' => 'fa fa-graduation-cap' ),
    'eventservices' => array( 'name' => 'Event Planning & Services', 'icon' => 'fa fa-birthday-cake' ),
    'financialservices' => array( 'name' => 'Financial Services', 'icon' => 'fa fa-money' ),
    'food' => array( 'name' => 'Food', 'icon' => 'fa fa-shopping-basket' ),
    'health' => array( 'name' => 'Health & Medical', 'icon' => 'fa fa-medkit' ),
    'homeservices' => array( 'name' => 'Home Services ', 'icon' => 'fa fa-wrench' ),
    'hotelstravel' => array( 'name' => 'Hotels & Travel', 'icon' => 'fa fa-bed' ),
    'localflavor' => array( 'name' => 'Local Flavor', 'icon' => 'fa fa-coffee' ),
    'localservices' => array( 'name' => 'Local Services', 'icon' => 'fa fa-dot-circle-o' ),
    'massmedia' => array( 'name' => 'Mass Media', 'icon' => 'fa fa-television' ),
    'nightlife' => array( 'name' => 'Nightlife', 'icon' => 'fa fa-glass' ),
    'pets' => array( 'name' => 'Pets', 'icon' => 'fa fa-paw' ),
    'professional' => array( 'name' => 'Professional Services', 'icon' => 'fa fa-suitcase' ),
    'publicservicesgovt' => array( 'name' => 'Public Services & Government', 'icon' => 'fa fa-university' ),
    'realestate' => array( 'name' => 'Real Estate', 'icon' => 'fa fa-building-o' ),
    'religiousorgs' => array( 'name' => 'Religious Organizations', 'icon' => 'fa fa-universal-access' ),
    'restaurants' => array( 'name' => 'Restaurants', 'icon' => 'fa fa-cutlery' ),
    'shopping' => array( 'name' => 'Shopping', 'icon' => 'fa fa-shopping-bag' ),
    'transport' =>  array( 'name' => 'Transportation', 'icon' => 'fa fa-bus' )
);

$yelp_data = houzez_option( 'houzez_yelp_term' );

$prop_location = get_post_meta( get_the_ID(), 'fave_property_location' );
$prop_location = $prop_location[0];
// $prop_location = explode( ',', $prop_location[0] );


if( $hide_yelp ) :

    ?>
    <div id="yelp_nearby" class="yelp-category detail-block target-block">
        <div class="container">
        <div class="detail-title">
            <h2 class="title-left"> <?php echo esc_html__("What's Nearby?", "houzez"); ?> </h2>
            <div class="title-right">
                <?php echo esc_html__("powered by", "houzez"); ?>  <img src="<?php echo get_template_directory_uri(); ?>/images/yelp-logo.png" alt="yelp" class="v-align-bottom">
            </div>
        </div>
        <?php

        foreach ( $yelp_data as $value ) :

            $term_id = $value;
            $term_name = $yelp_categories[ $term_id ]['name'];
            $term_icon = $yelp_categories[ $term_id ]['icon'];
            $terms_limit = houzez_option( 'houzez_yelp_limit' );

            $unsigned_url = "http://api.yelp.com/v2/";

            // Token object built using the OAuth library
            $yelp_widget_token        = houzez_option('houzez_yelp_token');
            $yelp_widget_token_secret = houzez_option('houzez_yelp_secret_token');
            $token = new OAuthToken( $yelp_widget_token, $yelp_widget_token_secret );

            // Consumer object built using the OAuth library
            $yelp_widget_consumer_key    = houzez_option('houzez_yelp_consumer_key');
            $yelp_widget_consumer_secret = houzez_option('houzez_yelp_secret_consumer_key');

            $consumer = new OAuthConsumer( $yelp_widget_consumer_key, $yelp_widget_consumer_secret );

            // Yelp uses HMAC SHA1 encoding
            $signature_method = new OAuthSignatureMethod_HMAC_SHA1();

            //Build URL Parameters
            $urlparams = array(
                'term'     => $term_id,
                'id'       => '',
                // 'location' => 'Miramonte+Blvd',
                'limit'    => $terms_limit,
                'll'      => $prop_location
            );

            // If ID param is set, use business method and delete any other parameters
            if ( $urlparams['id'] != '' ) {
                $urlparams['method'] = 'business/' . $urlparams['id'];
                unset( $urlparams['term'], $urlparams['location'], $urlparams['id'], $urlparams['sort'] );
            } else {
                $urlparams['method'] = 'search';
                unset( $urlparams['id'] );
            }

            $unsigned_url = $unsigned_url . $urlparams['method'];

            unset( $urlparams['method'] );

            // Build OAuth Request using the OAuth PHP library. Uses the consumer and
            // token object created above.
            $oauthrequest = OAuthRequest::from_consumer_and_token( $consumer, $token, 'GET', $unsigned_url, $urlparams );

            // Sign the request
            $oauthrequest->sign_request( $signature_method, $consumer, $token );

            // Get the signed URL
            $signed_url = $oauthrequest->to_url();

            //No Cache option enabled
            $response = yelp_widget_curl( $signed_url );

            // }

            if ( isset( $response->businesses ) ) {
                $businesses = $response->businesses;
            } else {
                $businesses = array( $response );
            }
            $distance = false;
            $current_lat = '';
            $current_lng = '';

            if ( isset( $response->region->center ) ) :

                $current_lat = $response->region->center->latitude;
                $current_lng = $response->region->center->longitude;
                $distance = true;

            endif;

            if ( sizeof( $businesses ) != 0 ) :

                ?>
                <div class="yelp-cat-block">
                    <h4 class="cat-title"><span class="yelp-cat-icon"><i class="<?php echo $term_icon; ?>"></i></span> <?php echo $term_name; ?> </h4>
                    <ul class="yelp-cat-list">
                        <?php

                        foreach ( $businesses as $data ) :

                            $location_distance = '';

                            if ( $distance && isset( $data->location->coordinate ) ) :

                                $location_lat = $data->location->coordinate->latitude;
                                $location_lng = $data->location->coordinate->longitude;
                                $theta = $current_lng - $location_lng;
                                $dist = sin( deg2rad( $current_lat ) ) * sin( deg2rad( $location_lat ) ) +  cos( deg2rad( $current_lat ) ) * cos( deg2rad( $location_lat ) ) * cos( deg2rad( $theta ) );
                                $dist = acos( $dist );
                                $dist = rad2deg( $dist );
                                $miles = $dist * 60 * 1.1515;
                                // $unit = strtoupper( $unit );

                                $location_distance = '<span class="time-review"> (' . round( $miles, 2 ) . ' mi) </span>';

                            endif;

                            ?>
                            <li>
                                <div class="cat-list-left"> <?php echo $data->name; ?> <?php echo $location_distance; ?></div>
                                <div class="cat-list-right"><img src="<?php echo $data->rating_img_url; ?>" alt="<?php echo $data->name; ?>"> <span class="time-review"> <?php echo $data->review_count; ?> reviews </span></div>
                            </li>
                            <?php

                        endforeach;

                        ?>
                    </ul>
                </div>
                <?php

            endif;

        endforeach;

        ?>
        </div>
    </div>
    <?php

endif;