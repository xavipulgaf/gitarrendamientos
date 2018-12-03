<?php
/*
 * Add to favorite for property
 */

/* check if features is enabled */
$fav_button = get_option('theme_enable_fav_button');
if ( $fav_button == "true" ) {
    ?>
    <span class="add-to-fav">
        <?php
        $property_id = get_the_ID();
        if ( is_added_to_favorite( $property_id ) ) {
            ?>
            <div id="fav_output" class="show">
	            <i class="fa fa-star-o dim"></i>&nbsp;
	            <span id="fav_target" class="dim"><?php _e('Added to Favorites','framework'); ?></span>
            </div>
            <?php
        } else {
            ?>
            <form action="<?php echo admin_url('admin-ajax.php'); ?>" method="post" id="add-to-favorite-form">
                <input type="hidden" name="property_id" value="<?php echo esc_attr( $property_id ); ?>" />
                <input type="hidden" name="action" value="add_to_favorite" />
            </form>
            <div id="fav_output">
	            <i class="fa fa-star-o dim"></i>&nbsp;
	            <span id="fav_target" class="dim"></span>
            </div>
            <a id="add-to-favorite" href="#add-to-favorite">
	            <i class="fa fa-star-o"></i>&nbsp;<?php _e('Add to Favorites','framework'); ?>
            </a>
            <?php
        }
        ?>
    </span>
    <?php
}