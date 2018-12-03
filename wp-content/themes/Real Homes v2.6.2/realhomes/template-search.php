<?php
/*
*   Template Name: Property Search Template
*/
get_header();


/* Theme Home Page Module */
$theme_search_module = get_option('theme_search_module');

switch($theme_search_module){
    case 'properties-map':
        get_template_part('banners/map_based_banner');
        break;

    default:
        get_template_part('banners/default_page_banner');
        break;
}


?>

    <!-- Content -->
    <div class="container contents">
        <div class="row">

            <div class="span12">

                <!-- Main Content -->
                <div class="main">
                    <?php
                    /* Advance Search Form */
                    get_template_part('template-parts/advance-search');
                    ?>

                    <section class="property-items">
	                    <?php
	                    /* List of Properties on Homepage */
	                    $number_of_properties = intval(get_option('theme_properties_on_search'));
	                    if(!$number_of_properties){
		                    $number_of_properties = 4;
	                    }

	                    global $paged;

	                    $search_args = array(
		                    'post_type' => 'property',
		                    'posts_per_page' => $number_of_properties,
		                    'paged' => $paged
	                    );

	                    /* Apply Search Filter */
	                    $search_args = apply_filters( 'real_homes_search_parameters', $search_args );

	                    /* Sort Properties */
	                    $search_args = sort_properties( $search_args );

	                    $search_query = new WP_Query( $search_args );

	                    ?>

                        <div class="search-header clearfix">
	                        <div class="properties-count">
		                        <span><strong><?php echo $search_query->found_posts; ?></strong>&nbsp;<?php
			                        if ( 1 < $search_query->found_posts ) {
				                        esc_html_e( 'Results', 'framework' );
			                        } else {
				                        esc_html_e( 'Result', 'framework' );
			                        }
			                        ?></span>
	                        </div>
                            <?php get_template_part('template-parts/sort-controls'); ?>
                            <?php
                            $compare_properties_module  = get_option( 'theme_compare_properties_module' );
                            $inspiry_compare_page       = get_option( 'inspiry_compare_page' );
                            if ( ( 'enable' == $compare_properties_module ) && ( $inspiry_compare_page ) ) {
                                get_template_part( 'template-parts/compare-properties' );
                            }
                            ?>
                        </div>

                        <div class="property-items-container clearfix">
                            <?php

                            if ( $search_query->have_posts() ) :
                                $post_count = 0;
                                while ( $search_query->have_posts() ) :
                                    $search_query->the_post();

                                    /* Display Property for Search Page */
                                    get_template_part('template-parts/property-for-search');

                                    $post_count++;
	                                if ( 0 == ( $post_count % 2 ) ) {
                                        echo '<div class="clearfix"></div>';
                                    }
                                endwhile;
                                wp_reset_postdata();
                            else:
                                ?>
	                            <div class="alert-wrapper">
	                                <h4><?php _e( 'No Property Found!', 'framework' ) ?></h4>
	                            </div>
	                            <?php
                            endif;
                            ?>
                        </div>

                        <?php theme_pagination( $search_query->max_num_pages); ?>

                    </section>

                </div><!-- End Main Content -->

            </div> <!-- End span12 -->

        </div><!-- End  row -->

    </div><!-- End content -->

<?php get_footer(); ?>