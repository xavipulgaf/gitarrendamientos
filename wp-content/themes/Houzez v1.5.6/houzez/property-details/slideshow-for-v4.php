<?php
global $post, $property_map, $property_streetView, $prop_agent_email;
$size = 'houzez-single-big-size';
$properties_images = rwmb_meta( 'fave_property_images', 'type=plupload_image&size='.$size, $post->ID );
$gallery_view = $map_view = $street_view = '';
$prop_default_active_tab = houzez_option('prop_default_active_tab');
if( $prop_default_active_tab == "image_gallery" ) {
    $gallery_view = 'in active';
} elseif( $prop_default_active_tab == "map_view" ) {
    $map_view = 'in active';
} elseif( $prop_default_active_tab == "street_view" ) {
    $street_view = 'in active';
} else {
    $gallery_view = 'in active';
}
?>
<section class="detail-top detail-top-slideshow">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <?php get_template_part( 'property-details/header', 'detail' ); ?>
            </div>
        </div>

        <?php
        if( !empty($properties_images) ) { ?>
        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <div class="detail-media">
                    <div class="tab-content">

                        <div id="gallery" class="tab-pane fade <?php echo esc_attr( $gallery_view );?>">
                            <span class="label-wrap visible-sm visible-xs">
                                <?php if( houzez_taxonomy_simple('property_status') ) { ?>
                                    <span class="label label-primary label-status-<?php echo intval(houzez_get_taxonomy_id('property_status')); ?>"><?php echo houzez_taxonomy_simple('property_status'); ?></span>
                                <?php } ?>
                                <?php if( houzez_taxonomy_simple('property_label') ) { ?>
                                    <span class="label label-primary label-color-<?php echo intval(houzez_get_taxonomy_id('property_label')); ?>"><?php echo houzez_taxonomy_simple('property_label'); ?></span>
                                <?php } ?>
                            </span>
                            <div class="detail-slider-wrap">
                                <div class="detail-slider owl-carousel owl-theme">
                                    <?php
                                    foreach( $properties_images as $prop_image_id => $prop_image_meta ) {
                                        echo '<div class="item" style="background-image: url('.esc_url( $prop_image_meta['url'] ).')">';
                                        echo '<a class="popup-trigger banner-link" href="#">';
                                        echo '</a>';
                                        echo '</div>';
                                    }
                                    ?>
                                </div>
                                <div class="detail-slider-nav-wrap">
                                    <div class="detail-slider-nav owl-carousel owl-theme"">
                                        <?php
                                        foreach( $properties_images as $prop_image_id=>$prop_image_meta ){
                                            $slider_thumb = wp_get_attachment_image_src($prop_image_id,'houzez-widget-prop');
                                            echo '<div class="item">';
                                            echo '<img src="'.esc_url( $slider_thumb[0] ).'" alt="'.esc_attr( $prop_image_meta['title'] ).'" width="100" height="70" />';
                                            echo '</div>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php if( $property_map != 0 ) { ?>
                            <div id="singlePropertyMap" class="tab-pane fade <?php echo esc_attr( $map_view );?>">
                                <div class="mapPlaceholder">
                                    <div class="loader-ripple">
                                        <div></div>
                                        <div></div>
                                    </div>
                                </div>
                            </div>
                            <?php wp_nonce_field('houzez_map_ajax_nonce', 'securityHouzezMap', true); ?>
                            <input type="hidden" name="prop_id" id="prop_id" value="<?php echo esc_attr($post->ID); ?>" />
                        <?php } ?>

                        <?php if( $property_streetView != 'hide' ) { ?>
                            <div id="street-map" class="tab-pane fade <?php echo esc_attr( $street_view );?>"></div>
                        <?php } ?>

                    </div>

                    <?php get_template_part( 'property-details/media-tabs' ); ?>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</section>