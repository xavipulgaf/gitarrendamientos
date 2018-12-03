<?php
/**
 * Members Settings
 */

if ( ! function_exists( 'inspiry_members_customizer' ) ) :
	function inspiry_members_customizer( WP_Customize_Manager $wp_customize ) {

		/**
		 * Members Panel
		 */
		global $inspiry_pages;

		$wp_customize->add_panel( 'inspiry_members_panel', array(
			'title' => __( 'Members', 'framework' ),
			'priority' => 127,
		) );

		/**
		 * Members Basic
		 */

		$wp_customize->add_section( 'inspiry_members_basic', array(
			'title' => __( 'Basic', 'framework' ),
			'panel' => 'inspiry_members_panel',
		) );

		/* Restrict Access */
		$wp_customize->add_setting( 'theme_restricted_level', array(
			'type' => 'option',
			'default' => '0',
			'transport' => 'postMessage',
		) );
		$wp_customize->add_control( 'theme_restricted_level', array(
			'label' => __( 'Restrict Admin Side Access', 'framework' ),
			"description" => __( 'Restrict admin side access to any user level equal to or below the selected user level.', 'framework' ),
			'type' => 'select',
			'section' => 'inspiry_members_basic',
			'choices' => array(
				'0' => __( 'Subscriber ( Level 0 )', 'framework' ),
				'1' => __( 'Contributor ( Level 1 )', 'framework' ),
				'2' => __( 'Author ( Level 2 )', 'framework' ),
				// '7' => __( 'Editor ( Level 7 )','framework'),
			)
		) );


		/**
		 * Members Login and Register
		 */

		$wp_customize->add_section( 'inspiry_members_login', array(
			'title' => __( 'Login & Register', 'framework' ),
			'panel' => 'inspiry_members_panel',
		) );


		/* Enable/Disable Login in Header */
		$wp_customize->add_setting( 'inspiry_header_login', array(
			'type' => 'option',
			'default' => 'true',
		) );
		$wp_customize->add_control( 'inspiry_header_login', array(
			'label' => __( 'Login in Header', 'framework' ),
			'type' => 'radio',
			'section' => 'inspiry_members_login',
			'choices' => array(
				'true' => __( 'Enable', 'framework' ),
				'false' => __( 'Disable', 'framework' ),
			)
		) );


		/* Login Page */
		$wp_customize->add_setting( 'inspiry_login_register_page', array(
			'type' => 'option',
		) );
		$wp_customize->add_control( 'inspiry_login_register_page', array(
			'label' => __('Select Login and Register Page (Optional)','framework'),
			"description" => __( 'Selected page should have Login & Register Template assigned to it. By default the login modal box will appear and you do not need to configure this option.', 'framework' ),
			'type' => 'select',
			'section' => 'inspiry_members_login',
			'choices' => $inspiry_pages
		) );

		/* Separator */
		$wp_customize->add_setting( 'inspiry_login_url_separator', array() );
		$wp_customize->add_control(
			new Inspiry_Separator_Control(
				$wp_customize,
				'inspiry_login_url_separator',
				array(
					'section' => 'inspiry_members_login',
				)
			)
		);

		/* Login Page URL */
		$wp_customize->add_setting( 'theme_login_url', array(
			'type' => 'option',
			'transport' => 'postMessage',
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( 'theme_login_url', array(
			'label' => __( 'Login & Register Page URL (Optional)', 'framework' ) . ' ' . '**DEPRECATED**',
			"description" => 'Selecting Login and Register page above is enough and this setting is displayed for backward compatibility',
			'type' => 'url',
			'section' => 'inspiry_members_login',
		) );


		/**
		 * Members Edit Profile
		 */

		$wp_customize->add_section( 'inspiry_members_profile', array(
			'title' => __( 'Edit Profile', 'framework' ),
			'panel' => 'inspiry_members_panel',
		) );

		/* Inspiry Edit Profile Page */
		$wp_customize->add_setting( 'inspiry_edit_profile_page', array(
			'type' => 'option',
		) );
		$wp_customize->add_control( 'inspiry_edit_profile_page', array(
			'label' => __('Select Edit Profile Page','framework'),
			"description" => __('Selected page should have Edit Profile Template assigned to it.','framework'),
			'type' => 'select',
			'section' => 'inspiry_members_profile',
			'choices' => $inspiry_pages
		) );

		/* Separator */
		$wp_customize->add_setting( 'inspiry_profile_url_separator', array() );
		$wp_customize->add_control(
			new Inspiry_Separator_Control(
				$wp_customize,
				'inspiry_profile_url_separator',
				array(
					'section' => 'inspiry_members_profile',
				)
			)
		);

		/* Edit Profile URL */
		$wp_customize->add_setting( 'theme_profile_url', array(
			'type' => 'option',
			'transport' => 'postMessage',
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( 'theme_profile_url', array(
			'label' => __( 'Edit Profile Page URL', 'framework' ) . ' ' . '**DEPRECATED**',
			"description" => 'Selecting edit profile page above is enough and this setting is displayed for backward compatibility',
			'type' => 'url',
			'section' => 'inspiry_members_profile',
		) );


		/**
		 * Members Submit
		 */

		$wp_customize->add_section( 'inspiry_members_submit', array(
			'title' => __( 'Submit Property', 'framework' ),
			'panel' => 'inspiry_members_panel',
		) );

		/* Inspiry Submit Property Page */
		$wp_customize->add_setting( 'inspiry_submit_property_page', array(
			'type' => 'option',
		) );
		$wp_customize->add_control( 'inspiry_submit_property_page', array(
			'label' => __('Select Submit Property Page','framework'),
			"description" => __('Selected page should have Submit Property Template assigned to it.','framework'),
			'type' => 'select',
			'section' => 'inspiry_members_submit',
			'choices' => $inspiry_pages
		) );

		/* Submit Property Fields */
		$wp_customize->add_setting( 'inspiry_submit_property_fields', array(
			'type'              => 'option',
			'default'           => array(
				'title',
				'description',
				'property-type',
				'property-status',
				'locations',
				'bedrooms',
				'bathrooms',
				'garages',
				'property-id',
				'price',
				'price-postfix',
				'area',
				'area-postfix',
				'video',
				'images',
				'address-and-map',
				'additional-details',
				'featured',
				'features',
				'agent',
				'parent',
				'reviewer-message',
			),
			'sanitize_callback' => 'inspiry_sanitize_multiple_checkboxes'
		) );
		$wp_customize->add_control(
			new Inspiry_Multiple_Checkbox_Customize_Control(
				$wp_customize,
				'inspiry_submit_property_fields',
				array(
					'section' => 'inspiry_members_submit',
					'label'   => __( 'Which fields you want to display in submit form ?', 'framework' ),
					'choices' => array(
						'title'              => __( 'Property Title', 'framework' ),
						'description'        => __( 'Property Description', 'framework' ),
						'property-type'      => __( 'Type', 'framework' ),
						'property-status'    => __( 'Status', 'framework' ),
						'locations'          => __( 'Location', 'framework' ),
						'bedrooms'           => __( 'Bedrooms', 'framework' ),
						'bathrooms'          => __( 'Bathrooms', 'framework' ),
						'garages'            => __( 'Garages', 'framework' ),
						'property-id'        => __( 'Property ID', 'framework' ),
						'price'              => __( 'Price', 'framework' ),
						'price-postfix'      => __( 'Price Postfix', 'framework' ),
						'area'               => __( 'Area', 'framework' ),
						'area-postfix'       => __( 'Area Postfix', 'framework' ),
						'video'              => __( 'Video', 'framework' ),
						'images'             => __( 'Property Images', 'framework' ),
						'address-and-map'    => __( 'Address and Google Map', 'framework' ),
						'additional-details' => __( 'Additional Details', 'framework' ),
						'featured'           => __( 'Mark as Featured Checkbox', 'framework' ),
						'features'           => __( 'Features', 'framework' ),
						'agent'              => __( 'Agent', 'framework' ),
						'parent'             => __( 'Parent Property', 'framework' ),
						'reviewer-message'   => __( 'Message to Reviewer', 'framework' ),
					)
				)
			)
		);

		/* Submitted Property Status */
		$wp_customize->add_setting( 'theme_submitted_status', array(
			'type' => 'option',
			'default' => 'pending',
			'transport' => 'postMessage',
		) );
		$wp_customize->add_control( 'theme_submitted_status', array(
			'label' => __( 'Submitted Property Status', 'framework' ),
			"description" => __( 'Select the default status for submitted property.', 'framework' ),
			'type' => 'select',
			'section' => 'inspiry_members_submit',
			'choices' => array(
				'pending' => __( 'Pending ( Recommended )', 'framework' ),
				'publish' => __( 'Publish', 'framework' )
			)
		) );

		/* Default Address in Submit Form */
		$wp_customize->add_setting( 'theme_submit_default_address', array(
			'type' => 'option',
			'default' => '15421 Southwest 39th Terrace, Miami, FL 33185, USA',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_submit_default_address', array(
			'label' => __( 'Default Address in Submit Form', 'framework' ),
			'type' => 'textarea',
			'section' => 'inspiry_members_submit',
		) );

		/* Default Map Location */
		$wp_customize->add_setting( 'theme_submit_default_location', array(
			'type' => 'option',
			'default' => '25.7308309,-80.44414899999998',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_submit_default_location', array(
			'label' => __( 'Default Map Location in Submit Form (Latitude,Longitude)', 'framework' ),
			"description" => 'You can use <a href="http://www.latlong.net/" target="_blank">latlong.net</a> OR <a href="http://itouchmap.com/latlong.html" target="_blank">itouchmap.com</a> to get Latitude and longitude of your desired location.',
			'type' => 'text',
			'section' => 'inspiry_members_submit',
		) );

		/* Message after Submit */
		$wp_customize->add_setting( 'theme_submit_message', array(
			'type' => 'option',
			'default' => __( 'Thanks for Submitting Property!', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage',
		) );
		$wp_customize->add_control( 'theme_submit_message', array(
			'label' => __( 'Message After Successful Submit', 'framework' ),
			'type' => 'text',
			'section' => 'inspiry_members_submit',
		) );

		/* Submit Notice */
		$wp_customize->add_setting( 'theme_submit_notice_email', array(
			'type' => 'option',
			'default' => get_option( 'admin_email' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport' => 'postMessage',
		) );
		$wp_customize->add_control( 'theme_submit_notice_email', array(
			'label' => __( 'Submit Notice Email', 'framework' ),
			'type' => 'email',
			'section' => 'inspiry_members_submit',
		) );

		/* Separator */
		$wp_customize->add_setting( 'inspiry_submit_url_separator', array() );
		$wp_customize->add_control(
			new Inspiry_Separator_Control(
				$wp_customize,
				'inspiry_submit_url_separator',
				array(
					'section' => 'inspiry_members_submit',
				)
			)
		);

		/* Submit URL */
		$wp_customize->add_setting( 'theme_submit_url', array(
			'type' => 'option',
			'transport' => 'postMessage',
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( 'theme_submit_url', array(
			'label' => __( 'Submit Property Page URL', 'framework' ) . ' ' . '**DEPRECATED**',
			"description" => 'Selecting submit property page above is enough and this setting is displayed for backward compatibility',
			'type' => 'url',
			'section' => 'inspiry_members_submit',
		) );


		/**
		 * Members My Properties
		 */

		$wp_customize->add_section( 'inspiry_members_properties', array(
			'title' => __( 'My Properties', 'framework' ),
			'panel' => 'inspiry_members_panel',
		) );

		/* My Properties Page */
		$wp_customize->add_setting( 'inspiry_my_properties_page', array(
			'type' => 'option',
		) );
		$wp_customize->add_control( 'inspiry_my_properties_page', array(
			'label' => __('Select My Properties Page','framework'),
			"description" => __( 'Selected page should have My Properties Template assigned to it.', 'framework' ),
			'type' => 'select',
			'section' => 'inspiry_members_properties',
			'choices' => $inspiry_pages
		) );

		/* Separator */
		$wp_customize->add_setting( 'inspiry_my_properties_url_separator', array() );
		$wp_customize->add_control(
			new Inspiry_Separator_Control(
				$wp_customize,
				'inspiry_my_properties_url_separator',
				array(
					'section' => 'inspiry_members_properties',
				)
			)
		);

		/* My Properties Page URL */
		$wp_customize->add_setting( 'theme_my_properties_url', array(
			'type' => 'option',
			'transport' => 'postMessage',
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( 'theme_my_properties_url', array(
			'label' => __( 'My Properties Page URL', 'framework' ) . ' ' . '**DEPRECATED**',
			"description" => 'Selecting my properties page above is enough and this setting is displayed for backward compatibility',
			'type' => 'url',
			'section' => 'inspiry_members_properties',
		) );


		/**
		 * Members Add to Favorites
		 */

		$wp_customize->add_section( 'inspiry_members_favorites', array(
			'title' => __( 'Favorites', 'framework' ),
			'panel' => 'inspiry_members_panel',
		) );

		/* Enable/Disable Add to Favorites */
		$wp_customize->add_setting( 'theme_enable_fav_button', array(
			'type' => 'option',
			'default' => 'true',
		) );
		$wp_customize->add_control( 'theme_enable_fav_button', array(
			'label' => __( 'Add to Favorites Button on Property Detail Page', 'framework' ),
			'type' => 'radio',
			'section' => 'inspiry_members_favorites',
			'choices' => array(
				'true' => __( 'Show', 'framework' ),
				'false' => __( 'Hide', 'framework' ),
			)
		) );

		/* My Favorites Page */
		$wp_customize->add_setting( 'inspiry_favorites_page', array(
			'type' => 'option',
		) );
		$wp_customize->add_control( 'inspiry_favorites_page', array(
			'label' => __('Select Favorite Properties Page','framework'),
			"description" => __( 'Selected page should have Favorite Properties Template assigned to it.', 'framework' ),
			'type' => 'select',
			'section' => 'inspiry_members_favorites',
			'choices' => $inspiry_pages
		) );

		/* Separator */
		$wp_customize->add_setting( 'inspiry_favorites_url_separator', array() );
		$wp_customize->add_control(
			new Inspiry_Separator_Control(
				$wp_customize,
				'inspiry_favorites_url_separator',
				array(
					'section' => 'inspiry_members_favorites',
				)
			)
		);

		/* Favorites Page URL */
		$wp_customize->add_setting( 'theme_favorites_url', array(
			'type' => 'option',
			'transport' => 'postMessage',
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( 'theme_favorites_url', array(
			'label' => __( 'Favorite Properties Page URL', 'framework' ) . ' ' . '**DEPRECATED**',
			"description" => 'Selecting Favorite Properties page above is enough and this setting is displayed for backward compatibility',
			'type' => 'url',
			'section' => 'inspiry_members_favorites',
		) );


	}

	add_action( 'customize_register', 'inspiry_members_customizer' );
endif;


if ( ! function_exists( 'inspiry_members_defaults' ) ) :
	/**
	 * Set default values for members settings
	 *
	 * @param WP_Customize_Manager $wp_customize
	 */
	function inspiry_members_defaults( WP_Customize_Manager $wp_customize ) {
		$members_settings_ids = array(
			'theme_restricted_level',
			'inspiry_header_login',
			'theme_submitted_status',
			'theme_submit_default_address',
			'theme_submit_default_location',
			'theme_submit_message',
			'theme_submit_notice_email',
			'inspiry_submit_property_fields',
			'theme_enable_fav_button',
		);
		inspiry_initialize_defaults( $wp_customize, $members_settings_ids );
	}

	add_action( 'customize_save_after', 'inspiry_members_defaults' );
endif;