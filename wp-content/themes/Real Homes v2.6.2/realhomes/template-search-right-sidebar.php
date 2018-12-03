<?php
/*
*   Template Name: Property Search Right Sidebar
*/
get_header();


/* Theme Search Module */
$theme_search_module = get_option('theme_search_module');

switch( $theme_search_module ){
    case 'properties-map':
	    get_template_part( 'banners/map_based_banner' );
        break;

    default:
        get_template_part( 'banners/default_page_banner' );
        break;
}
?>

<!-- listing container - grid layout -->
<div class="container contents listing-grid-layout">

    <div class="row">

        <!-- main content wrapper -->
        <div class="span9 main-wrap">

            <?php get_template_part( 'template-parts/sidebar-search-results' ); ?>

        </div><!-- end of main content wrapper -->

        <!-- sidebar wrapper -->
        <div class="span3 sidebar-wrap">

            <!-- start of sidebar -->
            <aside class="sidebar">
                <?php
                if ( ! dynamic_sidebar( 'property-search-sidebar' ) ) :
                endif;
                ?>
            </aside><!-- end of sidebar -->

        </div><!-- end of sidebar wrapper -->

    </div><!-- end of .row -->

</div><!-- end of listing container -->


<?php get_footer(); ?>