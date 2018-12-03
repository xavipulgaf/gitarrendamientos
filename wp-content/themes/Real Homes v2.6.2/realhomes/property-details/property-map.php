<?php
$display_google_map = get_option('theme_display_google_map');
$display_social_share = get_option('theme_display_social_share');
if($display_google_map == 'true' || $display_social_share == 'true'){
global $post;

    ?>
    <div class="map-wrap clearfix">
        <?php
            $property_location = get_post_meta($post->ID,'REAL_HOMES_property_location',true);
            $property_address = get_post_meta($post->ID,'REAL_HOMES_property_address',true);
            $property_map = get_post_meta($post->ID,'REAL_HOMES_property_map',true);

            if( $property_address && !empty($property_location) && $display_google_map == 'true' && ( $property_map != 1 ) )
            {
                $property_marker = array();

	            /* Property Title */
	            $property_marker['title'] = get_the_title();


	            /* Property Price */
	            $property_marker['price'] = get_property_price();

	            /* Property Latitude and Longitude */
                $lat_lng = explode(',',$property_location);
                $property_marker['lat'] = $lat_lng[0];
                $property_marker['lang'] = $lat_lng[1];

	            /* Property Thumbnail */
	            if(has_post_thumbnail()){
		            $image_id = get_post_thumbnail_id();
		            $image_attributes = wp_get_attachment_image_src( $image_id, 'property-thumb-image' );
		            if(!empty($image_attributes[0])){
			            $property_marker['thumb'] = $image_attributes[0];
		            }
	            }

                /* Property Map Icon Based on Property Type */
                $property_type_slug = 'single-family-home'; // Default Icon Slug

                $type_terms = get_the_terms( $post->ID,"property-type" );
                if( !empty( $type_terms ) ) {
                    foreach($type_terms as $typ_trm){
                        $property_type_slug = $typ_trm->slug;
                        break;
                    }
                }

                if( file_exists( get_template_directory().'/images/map/'.$property_type_slug.'-map-icon.png' ) ){
                    $property_marker['icon'] = get_template_directory_uri().'/images/map/'.$property_type_slug.'-map-icon.png';
                    // retina icon
                    if( file_exists( get_template_directory().'/images/map/'.$property_type_slug.'-map-icon@2x.png' ) ) {
                        $property_marker['retinaIcon'] = get_template_directory_uri().'/images/map/'.$property_type_slug.'-map-icon@2x.png';
                    }
                }else{
                    $property_marker['icon'] = get_template_directory_uri().'/images/map/single-family-home-map-icon.png';// default icon
                    $property_marker['retinaIcon'] = get_template_directory_uri().'/images/map/single-family-home-map-icon@2x.png';  // default retina icon
                }


                $property_map_title = get_option( 'theme_property_map_title' );
                if ( ! empty( $property_map_title ) ){
                    ?><span class="map-label"><?php echo esc_html( $property_map_title ); ?></span><?php
                }
                ?>
                <div id="property_map"></div>
                <script>
                    /* Property Detail Page - Google Map for Property Location */

                    function initialize_property_map(){

                        var propertyMarkerInfo = <?php echo json_encode( $property_marker ); ?>

                        var url = propertyMarkerInfo.icon;
                        var size = new google.maps.Size( 42, 57 );

                        // retina
                        if( window.devicePixelRatio > 1.5 ) {
                            if ( propertyMarkerInfo.retinaIcon ) {
                                url = propertyMarkerInfo.retinaIcon;
                                size = new google.maps.Size( 83, 113 );
                            }
                        }

                        var image = {
                            url: url,
                            size: size,
                            scaledSize: new google.maps.Size( 42, 57 ),
                            origin: new google.maps.Point( 0, 0 ),
                            anchor: new google.maps.Point( 21, 56 )
                        };

                        var propertyLocation = new google.maps.LatLng( propertyMarkerInfo.lat, propertyMarkerInfo.lang );
                        var propertyMapOptions = {
                            center: propertyLocation,
                            zoom: 15,
                            mapTypeId: google.maps.MapTypeId.ROADMAP,
                            scrollwheel: false
                        };
                        var propertyMap = new google.maps.Map(document.getElementById("property_map"), propertyMapOptions);
                        var propertyMarker = new google.maps.Marker({
                            position: propertyLocation,
                            map: propertyMap,
                            icon: image
                        });

	                    /* Info Box */
                        var boxText = document.createElement("div");
                        boxText.className = 'map-info-window';
                        var innerHTML = "";
                        if ( propertyMarkerInfo.thumb ) {
                            innerHTML += '<img class="prop-thumb" src="' + propertyMarkerInfo.thumb + '" alt="' + propertyMarkerInfo.title + '"/>';
                        }
                        innerHTML += '<h5 class="prop-title">' + propertyMarkerInfo.title + '</h5>';
                        if ( propertyMarkerInfo.price ) {
                            innerHTML += '<p><span class="price">' + propertyMarkerInfo.price + '</span></p>';
                        }
                        innerHTML += '<div class="arrow-down"></div>';
                        boxText.innerHTML = innerHTML;

                        var myOptions = {
                            content: boxText,
                            disableAutoPan: true,
                            maxWidth: 0,
                            alignBottom: true,
                            pixelOffset: new google.maps.Size( -122, -48 ),
                            zIndex: null,
                            closeBoxMargin: "0 0 -16px -16px",
                            closeBoxURL: "<?php echo get_template_directory_uri() . '/images/map/close.png'; ?>",
                            infoBoxClearance: new google.maps.Size( 1, 1 ),
                            isHidden: false,
                            pane: "floatPane",
                            enableEventPropagation: false
                        };

                        var infoBox = new InfoBox( myOptions );

	                    google.maps.event.addListener( propertyMarker, 'click', function(){
		                    var scale = Math.pow( 2, propertyMap.getZoom() );
		                    var offsety = ( (150/scale) || 0 );
		                    var projection = propertyMap.getProjection();
		                    var markerPosition = propertyMarker.getPosition();
		                    var markerScreenPosition = projection.fromLatLngToPoint( markerPosition );
		                    var pointHalfScreenAbove = new google.maps.Point( markerScreenPosition.x, markerScreenPosition.y - offsety );
		                    var aboveMarkerLatLng = projection.fromPointToLatLng( pointHalfScreenAbove );
		                    propertyMap.setCenter( aboveMarkerLatLng );
		                    infoBox.open( propertyMap, propertyMarker );
	                    });
                    }

                    window.onload = initialize_property_map();
                </script>

                <?php
            }

            if ( $display_social_share == 'true' ) {
                ?>
                <div class="share-networks clearfix">
                    <span class="share-label"><?php _e('Share this', 'framework'); ?></span>
                    <span><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>"><i class="fa fa-facebook fa-lg"></i><?php _e('Facebook','framework'); ?></a></span>
                    <span><a target="_blank" href="https://twitter.com/share?url=<?php the_permalink(); ?>" ><i class="fa fa-twitter fa-lg"></i><?php _e('Twitter','framework'); ?></a></span>
                    <span><a target="_blank" href="https://plus.google.com/share?url={<?php the_permalink(); ?>}" onclick="javascript:window.open(this.href,  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes')"><i class="fa fa-google-plus fa-lg"></i><?php _e('Google','framework'); ?></a></span>
                </div>
                <?php
            }
        ?>

    </div>

    <?php
}
?>