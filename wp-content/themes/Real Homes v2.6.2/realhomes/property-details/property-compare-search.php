<?php
/**
 * Partial: Property Compare
 *
 * @since 2.6.0
 */
?>
<span class="add-to-compare-span add-to-compare-search">
    <?php
    $property_id = get_the_ID();
    if ( inspiry_is_added_to_compare( $property_id ) ) {
        ?>
        <div class="compare_output show">
            <span class="compare-tooltip" aria-label="<?php _e( 'Added to Compare','framework' ); ?>" tabindex="0">
                <i class="fa fa-plus dim"></i>
            </span>
            <span class="compare_target dim compare-label compare-tooltip"><?php _e( 'Added to Compare','framework' ); ?></span>
        </div>
        <span class="compare-tooltip" aria-label="<?php _e( 'Add to Compare','framework' ); ?>" tabindex="0">
            <a class="add-to-compare hide" data-property-id="<?php the_ID(); ?>" href="<?php echo admin_url('admin-ajax.php'); ?>">
                <i class="fa fa-plus"></i><span class="compare-label"><?php _e( 'Add to Compare','framework' ); ?></span>
            </a>
        </span>
        <?php
    } else {
        ?>
        <div class="compare_output">
            <span class="compare-tooltip" aria-label="<?php _e( 'Added to Compare','framework' ); ?>" tabindex="0">
                <i class="fa fa-plus dim"></i>
            </span>
            <span class="compare_target dim compare-label"></span>
        </div>
        <span class="compare-tooltip" aria-label="<?php _e( 'Add to Compare','framework' ); ?>" tabindex="0">
            <a class="add-to-compare" data-property-id="<?php the_ID(); ?>" href="<?php echo admin_url('admin-ajax.php'); ?>">
                <i class="fa fa-plus"></i><span class="compare-label"><?php _e( 'Add to Compare','framework' ); ?></span>
            </a>
        </span>
        <?php
    }
    ?>
</span>
