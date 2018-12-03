<?php
/**
 * Plugin options functions.
 *
 * @package    Houzez
 * @subpackage Houzez Theme Functionality
 * @author     Waqas Riaz <waqas@favethemes.com>
 * @copyright  Copyright (c) 2016, Favethemes
 * @link       http://favethemes.com
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/**
 * Returns the property rewrite base. Used for single properties.
 *
 * @since  1.0.8
 * @access public
 * @return string
 */
function houzez_get_property_rewrite_base() {
	return apply_filters( 'houzez_get_property_rewrite_base', houzez_get_setting( 'property_rewrite_base' ) );
}


/**
 * Returns the property type rewrite base. Used for property type taxonomy.
 *
 * @since  1.0.8
 * @access public
 * @return string
 */
function houzez_get_property_type_rewrite_base() {
	return apply_filters( 'houzez_get_property_type_rewrite_base', houzez_get_setting( 'property_type_rewrite_base' ) );
}


/**
 * Returns the property feature rewrite base. Used for property feature taxonomy.
 *
 * @since  1.0.8
 * @access public
 * @return string
 */
function houzez_get_property_feature_rewrite_base() {
	return apply_filters( 'houzez_get_property_feature_rewrite_base', houzez_get_setting( 'property_feature_rewrite_base' ) );
}


/**
 * Returns the property status rewrite base. Used for property status taxonomy.
 *
 * @since  1.0.8
 * @access public
 * @return string
 */
function houzez_get_property_status_rewrite_base() {
	return apply_filters( 'houzez_get_property_status_rewrite_base', houzez_get_setting( 'property_status_rewrite_base' ) );
}


/**
 * Returns the property area rewrite base. Used for property area taxonomy.
 *
 * @since  1.0.8
 * @access public
 * @return string
 */
function houzez_get_property_area_rewrite_base() {
	return apply_filters( 'houzez_get_property_area_rewrite_base', houzez_get_setting( 'property_area_rewrite_base' ) );
}


/**
 * Returns the property city rewrite base. Used for property city taxonomy.
 *
 * @since  1.0.8
 * @access public
 * @return string
 */
function houzez_get_property_city_rewrite_base() {
	return apply_filters( 'houzez_get_property_city_rewrite_base', houzez_get_setting( 'property_city_rewrite_base' ) );
}


/**
 * Returns the property state rewrite base. Used for property state taxonomy.
 *
 * @since  1.0.8
 * @access public
 * @return string
 */
function houzez_get_property_state_rewrite_base() {
	return apply_filters( 'houzez_get_property_state_rewrite_base', houzez_get_setting( 'property_state_rewrite_base' ) );
}

/**
 * Returns a plugin setting.
 *
 * @since  1.0.8
 * @access public
 * @param  string  $setting
 * @return mixed
 */
function houzez_get_setting( $setting ) {

	$defaults = houzez_get_default_settings();
	$settings = wp_parse_args( get_option('houzez_settings', $defaults ), $defaults );

	return isset( $settings[ $setting ] ) ? $settings[ $setting ] : false;
}

/**
 * Returns the default settings for the plugin.
 *
 * @since  1.0.8
 * @access public
 * @return array
 */
function houzez_get_default_settings() {

	$settings = array(
		'property_rewrite_base'   => 'property',
		'property_type_rewrite_base' => 'property-type',
		'property_feature_rewrite_base' => 'feature',
		'property_status_rewrite_base' => 'status',
		'property_area_rewrite_base' => 'area',
		'property_city_rewrite_base' => 'city',
		'property_state_rewrite_base' => 'state',
		/*'category_rewrite_base'  => 'categories',
		'tag_rewrite_base'       => 'tags',
		'author_rewrite_base'    => 'authors'*/
	);

	return $settings;
}
