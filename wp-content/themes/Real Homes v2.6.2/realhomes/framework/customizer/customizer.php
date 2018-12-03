<?php
/**
 * Customizer
 */

if ( ! function_exists( 'inspiry_initialize_defaults' ) ) :
	/**
	 * Helper function to initialize default values for settings as customizer api do not do so by default.
	 *
	 * @param WP_Customize_Manager $wp_customize
	 * @param $inspiry_settings_ids
	 */
	function inspiry_initialize_defaults( WP_Customize_Manager $wp_customize, $inspiry_settings_ids ) {
		if ( is_array( $inspiry_settings_ids ) && ! empty( $inspiry_settings_ids ) ) {
			foreach ( $inspiry_settings_ids as $setting_id ) {
				$setting = $wp_customize->get_setting( $setting_id );
				if ( $setting ) {
					add_option( $setting->id, $setting->default );
				}
			}
		}
	}
endif;


/**
 * Load custom controls
 */
if ( ! function_exists( 'inspiry_load_customize_controls' ) ) :
	function inspiry_load_customize_controls() {
		require_once( INSPIRY_FRAMEWORK . 'customizer/custom/control-multiple-checkbox.php' );
		require_once( INSPIRY_FRAMEWORK . 'customizer/custom/control-intro-text.php' );
		require_once( INSPIRY_FRAMEWORK . 'customizer/custom/control-separator.php' );
	}

	add_action( 'customize_register', 'inspiry_load_customize_controls', 0 );
endif;


/**
 * Create a pages array named $inspiry_pages, This array can be used at multiple places
 */
$inspiry_pages = array( 0 => __( 'None', 'framework' ) );
$raw_pages = get_pages();
if ( 0 < count( $raw_pages ) ) {
	foreach ( $raw_pages as $single_page ) {
		$inspiry_pages[$single_page->ID] = $single_page->post_title;
	}
}


/**
 * Header Settings
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/header.php' );


/**
 * Home Page Settings
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/home.php' );


/**
 * Properties Search Settings
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/search.php' );


/**
 * Price Format Settings
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/price-format.php' );


/**
 * Currency Switcher Settings
 * only if wp-currencies plugins is active
 */
if ( class_exists( 'WP_Currencies' ) ) {
	require_once( INSPIRY_FRAMEWORK . 'customizer/currency-switcher.php' );
}


/**
 * Property Detail Page Settings
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/property.php' );


/**
 * Blog/News Page Settings
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/news.php' );


/**
 * Gallery Page Settings
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/gallery.php' );


/**
 * Agents Settings
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/agents.php' );


/**
 * Contact Page Settings
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/contact.php' );


/**
 * Properties List and Taxonomy Archive Settings
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/list-and-taxonomy.php' );


/**
 * Misc Settings
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/misc.php' );


/**
 * Footer Settings
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/footer.php' );


/**
 * Members Settings
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/members.php' );


/**
 * Payments Settings
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/payments.php' );


/**
 * URL Slugs Settings
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/url-slugs.php' );


/**
 * Styles Settings
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/styles.php' );


