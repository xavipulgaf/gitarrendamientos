<?php
/**
 * Gallery Customizer
 */


if ( ! function_exists( 'inspiry_gallery_customizer' ) ) :
	function inspiry_gallery_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Gallery Section
		 */

		$wp_customize->add_section( 'inspiry_gallery_section', array(
			'title' => __( 'Gallery Pages', 'framework' ),
			'panel' => 'inspiry_various_pages',
		) );

		/* Banner Title */
		$wp_customize->add_setting( 'theme_gallery_banner_title', array(
			'type' => 'option',
			'default' => __( 'Properties Gallery', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_gallery_banner_title', array(
			'label' => __( 'Banner Title', 'framework' ),
			'type' => 'text',
			'section' => 'inspiry_gallery_section',
		) );

		/* Banner Sub Title */
		$wp_customize->add_setting( 'theme_gallery_banner_sub_title', array(
			'type' => 'option',
			'default' => __( 'Skim Through Available Properties', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_gallery_banner_sub_title', array(
			'label' => __( 'Banner Sub Title', 'framework' ),
			'type' => 'text',
			'section' => 'inspiry_gallery_section',
		) );


	}

	add_action( 'customize_register', 'inspiry_gallery_customizer' );
endif;


if ( ! function_exists( 'inspiry_gallery_defaults' ) ) :
	/**
	 * Set default values for gallery settings
	 *
	 * @param WP_Customize_Manager $wp_customize
	 */
	function inspiry_gallery_defaults( WP_Customize_Manager $wp_customize ) {
		$gallery_settings_ids = array(
			'theme_gallery_banner_title',
			'theme_gallery_banner_sub_title',
		);
		inspiry_initialize_defaults( $wp_customize, $gallery_settings_ids );
	}

	add_action( 'customize_save_after', 'inspiry_gallery_defaults' );
endif;
