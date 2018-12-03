<div class="main fix-margins">

	<!-- listing layout -->
	<section class="listing-layout property-grid">

		<div class="list-container clearfix">

			<?php
			/* List of Properties on Homepage */
			$number_of_properties = intval(get_option('theme_properties_on_search'));
			if(!$number_of_properties){
				$number_of_properties = 6;
			}

			global $paged;
			if ( is_front_page()  ) {
				$paged = (get_query_var('page')) ? get_query_var('page') : 1;
			}

			$search_args = array(
				'post_type' => 'property',
				'posts_per_page' => $number_of_properties,
				'paged' => $paged
			);

			// Apply Search Filter
			$search_args = apply_filters('real_homes_search_parameters',$search_args);

			$search_args = sort_properties($search_args);

			$search_query = new WP_Query( $search_args );

			?>

			<div class="search-header clearfix">
				<div class="properties-count">
					<span><?php printf( _n( '<strong>%s</strong> Result', '<strong>%s</strong> Results', $search_query->found_posts, 'framework' ), number_format( $search_query->found_posts ) ); ?></span>
				</div>
				<?php get_template_part('template-parts/sort-controls'); ?>
				<?php get_template_part('template-parts/compare-properties'); ?>
			</div>

			<?php

			if ( $search_query->have_posts() ) :
				$post_count = 0;
				while ( $search_query->have_posts() ) :
					$search_query->the_post();

					/* Display Property for Search Page */
					get_template_part('template-parts/property-for-grid');

				endwhile;
				wp_reset_query();
			else:
				?><div class="alert-wrapper"><h4><?php _e('No Properties Found!', 'framework') ?></h4></div><?php
			endif;
			?>
		</div>

		<?php theme_pagination( $search_query->max_num_pages); ?>

	</section><!-- end of listing layout -->

</div>
