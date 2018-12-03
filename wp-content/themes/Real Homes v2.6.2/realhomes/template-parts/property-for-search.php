<div class="span6 ">
    <article class="property-item clearfix">
        <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

        <figure>
            <a href="<?php the_permalink(); ?>">
                <?php
                global $post;
                if( has_post_thumbnail( $post->ID ) ) {
                    the_post_thumbnail( 'property-thumb-image' );
                } else {
                    inspiry_image_placeholder( 'property-thumb-image' );
                }
                ?>
            </a>

            <?php display_figcaption( $post->ID ); ?>

        </figure>

        <div class="detail">
            <h5 class="price">
                <?php
                // price
                property_price();

                // property types
                echo inspiry_get_property_types( $post->ID );
                ?>
            </h5>
            <p><?php framework_excerpt(12); ?></p>
            <a class="more-details" href="<?php the_permalink() ?>"><?php _e('More Details ','framework'); ?><i class="fa fa-caret-right"></i></a>
        </div>

        <?php
            $compare_properties_module  = get_option( 'theme_compare_properties_module' );
            $inspiry_compare_page       = get_option( 'inspiry_compare_page' );
        ?>
        <div class="property-meta clearfix <?php echo ( ( 'enable' == $compare_properties_module ) && ( $inspiry_compare_page ) ) ? "compare-meta" : ''; ?>">
            <?php get_template_part('property-details/property-metas'); ?>
            <?php
                if ( ( 'enable' == $compare_properties_module ) && ( $inspiry_compare_page ) ) {
                    get_template_part( 'property-details/property-compare-search' );
                } 
            ?>
        </div>
    </article>
</div>