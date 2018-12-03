<?php
/**
 * Compare Properties: Container.
 *
 * @since 2.6.0
 */

if ( ! empty( get_option( 'inspiry_compare_page' ) ) ) {
	$inspiry_compare_page	= get_option( 'inspiry_compare_page' );
}

if ( ! empty( get_permalink( $inspiry_compare_page ) ) ) {
	$compare_page_url		= get_permalink( $inspiry_compare_page );
}

if ( isset( $_COOKIE[ 'inspiry_compare' ] ) ) {
	$compare_list_items		= unserialize( $_COOKIE[ 'inspiry_compare' ] );
}

if ( ! empty( $compare_list_items ) ) {

	foreach ( $compare_list_items as $compare_list_item ) {

		$compare_property 	= get_post( $compare_list_item );

		if ( ! empty( $compare_property ) ) {

			if ( ! empty( get_post_thumbnail_id( $compare_property->ID ) ) ){
				$compare_property_img	= wp_get_attachment_image_src( 
					get_post_thumbnail_id( $compare_property->ID ), 'property-thumb-image' 
				);
			}
			
			$compare_properties[] 	= array(
				'ID' 				=> $compare_property->ID,
				'title' 			=> $compare_property->post_title,
				'img'				=> $compare_property_img
			);

		}

	}

}

?>

<div class="compare-properties clear">

	<h4>Compare Properties</h4>
	
	<div class="compare-carousel clear">

		<?php if ( ! empty( $compare_properties ) ) : ?>
			<?php foreach ( $compare_properties as $compare_single_property ) : ?>
				<div class="compare-carousel-slide clear">
					<div class="compare-slide-img">
						<?php if ( ! empty( $compare_single_property[ 'img' ] ) ) : ?>
							<img 
								src="<?php echo esc_attr( $compare_single_property[ 'img' ][0] ); ?>" 
								alt="<?php echo esc_attr( $compare_single_property[ 'title' ] ); ?>" 
								width="<?php echo esc_attr( $compare_single_property[ 'img' ][1] ); ?>" 
								height="<?php echo esc_attr( $compare_single_property[ 'img' ][2] ); ?>"
							>
						<?php endif; ?>
					</div>
					<a class="compare-remove" data-property-id="<?php echo esc_attr( $compare_single_property[ 'ID' ] ); ?>" href="<?php echo admin_url('admin-ajax.php'); ?>"><i class="fa fa-close"></i></a>
				</div>
			<?php endforeach; ?>
			<!-- .compare-carousel-slide -->
		<?php endif; ?>

	</div>

	<a href="<?php echo esc_attr( $compare_page_url ); ?>" class="compare-submit real-btn btn"><?php _e( 'Compare', 'inspiry' ); ?></a>
	<!-- .compare-submit -->

</div>
<!-- .compare-properties -->