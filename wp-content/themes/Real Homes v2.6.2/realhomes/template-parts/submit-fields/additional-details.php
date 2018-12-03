<div class="form-option additional-details-fields-wrapper">

	<div class="inspiry-details-wrapper">

		<?php
		if ( inspiry_is_edit_property() ) {
			global $target_property;
			/* Migrate old title and values to new key => value array */
			$detail_titles = get_post_meta( $target_property->ID, 'REAL_HOMES_detail_titles', true );
			if( !empty( $detail_titles ) ) {
				$detail_values = get_post_meta($target_property->ID, 'REAL_HOMES_detail_values', true);
				if (!empty($detail_values)) {
					$additional_details = array_combine( $detail_titles, $detail_values );
					if ( update_post_meta( $target_property->ID, 'REAL_HOMES_additional_details', $additional_details ) ){
						delete_post_meta( $target_property->ID, 'REAL_HOMES_detail_titles' );
						delete_post_meta( $target_property->ID, 'REAL_HOMES_detail_values' );
					}
				}
			}
		}
		?>

		<label><?php _e( 'Additional Details', 'framework' ); ?></label>

		<div class="inspiry-detail labels clearfix">
			<div class="inspiry-detail-control">&nbsp;</div>
			<div class="inspiry-detail-title"><label><?php _e( 'Title','framework' ) ?></label></div>
			<div class="inspiry-detail-value"><label><?php _e( 'Value','framework' ); ?></label></div>
			<div class="inspiry-detail-control">&nbsp;</div>
		</div>

		<!-- additional details container -->
		<div id="inspiry-additional-details-container">

			<?php
			if ( inspiry_is_edit_property() ) {

				global $target_property;

				$additional_details = get_post_meta( $target_property->ID, 'REAL_HOMES_additional_details', true );

				if ( ! empty ( $additional_details ) ) {

					foreach( $additional_details as $title => $value ) {
						?>
						<div class="inspiry-detail inputs clearfix">
							<div class="inspiry-detail-control">
								<i class="sort-detail fa fa-bars"></i>
							</div>
							<div class="inspiry-detail-title">
								<input type="text" name="detail-titles[]" value="<?php echo esc_attr( $title ); ?>" />
							</div>
							<div class="inspiry-detail-value">
								<input type="text" name="detail-values[]" value="<?php echo esc_attr( $value ); ?>" />
							</div>
							<div class="inspiry-detail-control">
								<a class="remove-detail" href="#"><i class="fa fa-times"></i></a>
							</div>
						</div>
						<?php
					}

				} else {
					?>
					<div class="inspiry-detail inputs clearfix">
						<div class="inspiry-detail-control">
							<i class="sort-detail fa fa-bars"></i>
						</div>
						<div class="inspiry-detail-title">
							<input type="text" name="detail-titles[]" value="" />
						</div>
						<div class="inspiry-detail-value">
							<input type="text" name="detail-values[]" value="" />
						</div>
						<div class="inspiry-detail-control">
							<a class="remove-detail" href="#"><i class="fa fa-times"></i></a>
						</div>
					</div>
					<?php
				}

			} else {
				?>
				<div class="inspiry-detail inputs clearfix">
					<div class="inspiry-detail-control">
						<i class="sort-detail fa fa-bars"></i>
					</div>
					<div class="inspiry-detail-title">
						<input type="text" name="detail-titles[]" value="" />
					</div>
					<div class="inspiry-detail-value">
						<input type="text" name="detail-values[]" value="" />
					</div>
					<div class="inspiry-detail-control">
						<a class="remove-detail" href="#"><i class="fa fa-times"></i></a>
					</div>
				</div>
				<?php
			}
			?>

		</div><!-- end of additional details container -->

		<div class="inspiry-detail clearfix">
			<div class="inspiry-detail-control">&nbsp;</div>
			<div class="inspiry-detail-control">
				<a class="add-detail" href="#"><i class="fa fa-plus"></i></a>
			</div>
		</div>

	</div>

</div>
