<div class="form-option property-id-field-wrapper">
	<label for="property-id"><?php _e( 'Property ID', 'framework' ); ?></label>
	<input id="property-id" name="property-id" type="text" value="<?php
	if ( inspiry_is_edit_property() ) {
		global $post_meta_data;
		if ( isset( $post_meta_data[ 'REAL_HOMES_property_id' ] ) ) {
			echo esc_attr( $post_meta_data[ 'REAL_HOMES_property_id' ][ 0 ] );
		}
	}
	?>" title="<?php _e( 'Property ID', 'framework' ); ?>"/>
</div>
