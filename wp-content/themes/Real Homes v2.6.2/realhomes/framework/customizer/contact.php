<?php
/**
 * Contact Page Customizer Settings
 */


if ( ! function_exists( 'inspiry_contact_customizer' ) ) :
	function inspiry_contact_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Contact Section
		 */

		$wp_customize->add_section( 'inspiry_contact_section', array(
			'title' => __( 'Contact Page', 'framework' ),
			'panel' => 'inspiry_various_pages',
		) );

		/* Show / Hide Google Map */
		$wp_customize->add_setting( 'theme_show_contact_map', array(
			'type' => 'option',
			'default' => 'true',
		) );
		$wp_customize->add_control( 'theme_show_contact_map', array(
			'label' => __( 'Google Map on Contact Page', 'framework' ),
			'type' => 'radio',
			'section' => 'inspiry_contact_section',
			'choices' => array(
				'true' => __( 'Show', 'framework' ),
				'false' => __( 'Hide', 'framework' ),
			)
		) );

		/* Google Map Latitude */
		$wp_customize->add_setting( 'theme_map_lati', array(
			'type' => 'option',
			'default' => '-37.817917',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_map_lati', array(
			'label' => __( 'Google Map Latitude', 'framework' ),
			'description' => 'You can use <a href="http://www.latlong.net/" target="_blank">latlong.net</a> OR <a href="http://itouchmap.com/latlong.html" target="_blank">itouchmap.com</a> to get Latitude and longitude of your desired location.',
			'type' => 'text',
			'section' => 'inspiry_contact_section',
		) );

		/* Google Map Longitude */
		$wp_customize->add_setting( 'theme_map_longi', array(
			'type' => 'option',
			'default' => '144.965065',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_map_longi', array(
			'label' => __( 'Google Map Longitude', 'framework' ),
			'type' => 'text',
			'section' => 'inspiry_contact_section',
		) );

		/* Google Map Zoom */
		$wp_customize->add_setting( 'theme_map_zoom', array(
			'type' => 'option',
			'default' => '17',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_map_zoom', array(
			'label' => __( 'Google Map Zoom Level', 'framework' ),
			"description" => __( "Provide Google Map Zoom Level.", 'framework' ),
			'type' => 'number',
			'section' => 'inspiry_contact_section',
		) );

		/* Separator */
		$wp_customize->add_setting( 'inspiry_map_zoom_separator', array() );
		$wp_customize->add_control(
			new Inspiry_Separator_Control(
				$wp_customize,
				'inspiry_map_zoom_separator',
				array(
					'section' => 'inspiry_contact_section',
				)
			)
		);

		/* Show / Hide Contact Details */
		$wp_customize->add_setting( 'theme_show_details', array(
			'type' => 'option',
			'default' => 'true',
		) );
		$wp_customize->add_control( 'theme_show_details', array(
			'label' => __( 'Contact Details', 'framework' ),
			'type' => 'radio',
			'section' => 'inspiry_contact_section',
			'choices' => array(
				'true' => __( 'Show', 'framework' ),
				'false' => __( 'Hide', 'framework' ),
			)
		) );

		/* Contact Details Title */
		$wp_customize->add_setting( 'theme_contact_details_title', array(
			'type' => 'option',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_contact_details_title', array(
			'label' => __( 'Contact Details Title', 'framework' ),
			'type' => 'text',
			'section' => 'inspiry_contact_section',
		) );

		/* Contact Address */
		$wp_customize->add_setting( 'theme_contact_address', array(
			'type' => 'option',
			'sanitize_callback' => 'wp_kses_data',
		) );
		$wp_customize->add_control( 'theme_contact_address', array(
			'label' => __( 'Contact Address', 'framework' ),
			'type' => 'textarea',
			'section' => 'inspiry_contact_section',
		) );

		/* Cell Number */
		$wp_customize->add_setting( 'theme_contact_cell', array(
			'type' => 'option',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_contact_cell', array(
			'label' => __( 'Cell Number', 'framework' ),
			'type' => 'tel',
			'section' => 'inspiry_contact_section',
		) );

		/* Phone Number */
		$wp_customize->add_setting( 'theme_contact_phone', array(
			'type' => 'option',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_contact_phone', array(
			'label' => __( 'Phone Number', 'framework' ),
			'type' => 'tel',
			'section' => 'inspiry_contact_section',
		) );

		/* Fax Number */
		$wp_customize->add_setting( 'theme_contact_fax', array(
			'type' => 'option',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_contact_fax', array(
			'label' => __( 'Fax Number', 'framework' ),
			'type' => 'tel',
			'section' => 'inspiry_contact_section',
		) );

		/* Display Email */
		$wp_customize->add_setting( 'theme_contact_display_email', array(
			'type' => 'option',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_contact_display_email', array(
			'label' => __( 'Display Email', 'framework' ),
			"desc" => __( "Provide Email that will be displayed in contact details section.", 'framework' ),
			'type' => 'email',
			'section' => 'inspiry_contact_section',
		) );

		/* Separator */
		$wp_customize->add_setting( 'inspiry_contact_form_separator', array() );
		$wp_customize->add_control(
			new Inspiry_Separator_Control(
				$wp_customize,
				'inspiry_contact_form_separator',
				array(
					'section' => 'inspiry_contact_section',
				)
			)
		);

		/* Contact Form Heading */
		$wp_customize->add_setting( 'theme_contact_form_heading', array(
			'type' => 'option',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_contact_form_heading', array(
			'label' => __( 'Contact Form Heading', 'framework' ),
			'type' => 'text',
			'section' => 'inspiry_contact_section',
		) );

		/* Contact Form Email */
		$wp_customize->add_setting( 'theme_contact_email', array(
			'type' => 'option',
			'sanitize_callback' => 'sanitize_text_field',
			'default' => get_option( 'admin_email' ),
		) );
		$wp_customize->add_control( 'theme_contact_email', array(
			'label' => __( 'Contact Form Email', 'framework' ),
			"description" => __( "Provide email address that will get messages from contact form.", 'framework' ),
			'type' => 'email',
			'section' => 'inspiry_contact_section',
		) );

		/* Contact Form CC Email */
		$wp_customize->add_setting( 'theme_contact_cc_email', array(
			'type' => 'option',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_contact_cc_email', array(
			'label' => __( 'Contact Form CC Email', 'framework' ),
			"description" => __( "You can add multiple comma separated cc email addresses, to get a carbon copy of contact form message.", 'framework' ),
			'type' => 'email',
			'section' => 'inspiry_contact_section',
		) );

		/* Contact Form BCC Email */
		$wp_customize->add_setting( 'theme_contact_bcc_email', array(
			'type' => 'option',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_contact_bcc_email', array(
			'label' => __( 'Contact Form BCC Email', 'framework' ),
			"description" => __( "You can add multiple comma separated bcc email addresses, to get a blind carbon copy of contact form message.", 'framework' ),
			'type' => 'email',
			'section' => 'inspiry_contact_section',
		) );

		/* Contact Form Shortcode */
		$wp_customize->add_setting( 'inspiry_contact_form_shortcode', array(
			'type' => 'option',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_contact_form_shortcode', array(
			'label' => __( 'Contact Form Shortcode ( To Replace Default Form )', 'framework' ),
			"description" => __( "If you want to replace default contact form with a plugin based form then provide its shortcode here.", 'framework' ),
			'type' => 'text',
			'section' => 'inspiry_contact_section',
		) );


	}

	add_action( 'customize_register', 'inspiry_contact_customizer' );
endif;


if ( ! function_exists( 'inspiry_contact_defaults' ) ) :
	/**
	 * Set default values for contact settings
	 *
	 * @param WP_Customize_Manager $wp_customize
	 */
	function inspiry_contact_defaults( WP_Customize_Manager $wp_customize ) {
		$contact_settings_ids = array(
			'theme_show_contact_map',
			'theme_map_lati',
			'theme_map_longi',
			'theme_map_zoom',
			'theme_show_details',
			'theme_contact_email',
		);
		inspiry_initialize_defaults( $wp_customize, $contact_settings_ids );
	}

	add_action( 'customize_save_after', 'inspiry_contact_defaults' );
endif;