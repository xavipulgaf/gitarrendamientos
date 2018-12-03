<?php
/**
 * Styles Settings
 */


if ( ! function_exists( 'inspiry_styles_customizer' ) ) :
	function inspiry_styles_customizer( WP_Customize_Manager $wp_customize ) {

		$inspiry_google_fonts = inspiry_get_google_fonts_list();

		/**
		 * Styles Panel
		 */
		$wp_customize->add_panel( 'inspiry_styles_panel', array(
			'title' => __( 'Styles', 'framework' ),
			'priority' => 128,
		) );

		/**
		 * Typography Section
		 */
		$wp_customize->add_section( 'inspiry_typography_section', array(
			'title' => esc_html__( 'Typography', 'framework' ),
			'panel' => 'inspiry_styles_panel',
		) );

		/* Heading Font */
		$wp_customize->add_setting( 'inspiry_heading_font', array(
			'type'    => 'option',
			'Default' => 'Default',
		) );
		$wp_customize->add_control( 'inspiry_heading_font', array(
			'label'   => esc_html__( 'Google Font for Primary Headings', 'framework' ),
			'section' => 'inspiry_typography_section',
			'type'    => 'select',
			'choices' => $inspiry_google_fonts,
		) );

		/* Secondary Font */
		$wp_customize->add_setting( 'inspiry_secondary_font', array(
			'type'    => 'option',
			'Default' => 'Default',
		) );
		$wp_customize->add_control( 'inspiry_secondary_font', array(
			'label'   => esc_html__( 'Google Font for Secondary Headings and Text', 'framework' ),
			'section' => 'inspiry_typography_section',
			'type'    => 'select',
			'choices' => $inspiry_google_fonts,
		) );

		/* Body Font */
		$wp_customize->add_setting( 'inspiry_body_font', array(
			'type'    => 'option',
			'Default' => 'Default',
		) );
		$wp_customize->add_control( 'inspiry_body_font', array(
			'label'   => esc_html__( 'Google Font for Body Text', 'framework' ),
			'section' => 'inspiry_typography_section',
			'type'    => 'select',
			'choices' => $inspiry_google_fonts,
		) );


		/**
		 * Basic Section
		 */

		$wp_customize->add_section( 'inspiry_styles_basic', array(
			'title' => __( 'Basic', 'framework' ),
			'panel' => 'inspiry_styles_panel',
		) );

		/* Quick CSS */
		$wp_customize->add_setting( 'theme_quick_css', array(
			'type' => 'option',
			'transport' => 'postMessage',
		) );
		$wp_customize->add_control( 'theme_quick_css', array(
			'label' => __( 'Quick CSS', 'framework' ),
			'description' => __( 'Enter small CSS changes here. If you need to change major portions of the theme then use child-custom.css file in child theme.', 'framework' ),
			'type' => 'textarea',
			'section' => 'inspiry_styles_basic',
		) );


		/**
		 * Slider Section
		 */

		$wp_customize->add_section( 'inspiry_slider_styles', array(
			'title' => __( 'Slider', 'framework' ),
			'panel' => 'inspiry_styles_panel',
		) );

		$wp_customize->add_setting( 'theme_slide_title_color', array(
			'type' => 'option',
			'default' => '#394041',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'theme_slide_title_color',
				array(
					'label' => __( 'Slide Title Color', 'framework' ),
					'section' => 'inspiry_slider_styles',
				)
			)
		);

		$wp_customize->add_setting( 'theme_slide_title_hover_color', array(
			'type' => 'option',
			'default' => '#df5400',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'theme_slide_title_hover_color',
				array(
					'label' => __( 'Slide Title Hover Color', 'framework' ),
					'section' => 'inspiry_slider_styles',
				)
			)
		);

		$wp_customize->add_setting( 'theme_slide_desc_text_color', array(
			'type' => 'option',
			'default' => '#8b9293',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'theme_slide_desc_text_color',
				array(
					'label' => __( 'Slide Description Text Color', 'framework' ),
					'section' => 'inspiry_slider_styles',
				)
			)
		);

		$wp_customize->add_setting( 'theme_slide_price_color', array(
			'type' => 'option',
			'default' => '#df5400',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'theme_slide_price_color',
				array(
					'label' => __( 'Slide Price Color', 'framework' ),
					'section' => 'inspiry_slider_styles',
				)
			)
		);

		$wp_customize->add_setting( 'theme_slide_know_more_text_color', array(
			'type' => 'option',
			'default' => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'theme_slide_know_more_text_color',
				array(
					'label' => __( 'Slide Know More Button Text Color', 'framework' ),
					'section' => 'inspiry_slider_styles',
				)
			)
		);

		$wp_customize->add_setting( 'theme_slide_know_more_bg_color', array(
			'type' => 'option',
			'default' => '#37b3d9',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'theme_slide_know_more_bg_color',
				array(
					'label' => __( 'Slide Know More Button Background Color', 'framework' ),
					'section' => 'inspiry_slider_styles',
				)
			)
		);


		$wp_customize->add_setting( 'theme_slide_know_more_hover_bg_color', array(
			'type' => 'option',
			'default' => '#2aa6cc',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'theme_slide_know_more_hover_bg_color',
				array(
					'label' => __( 'Slide Know More Button Hover Background Color', 'framework' ),
					'section' => 'inspiry_slider_styles',
				)
			)
		);


		/**
		 * Property Item Section
		 */

		$wp_customize->add_section( 'inspiry_property_item_styles', array(
			'title' => __( 'Property Item', 'framework' ),
			'panel' => 'inspiry_styles_panel',
		) );

		$wp_customize->add_setting( 'theme_property_item_bg_color', array(
			'type' => 'option',
			'default' => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'theme_property_item_bg_color',
				array(
					'label' => __( 'Property Item Background Color', 'framework' ),
					'section' => 'inspiry_property_item_styles',
				)
			)
		);

		$wp_customize->add_setting( 'theme_property_item_border_color', array(
			'type' => 'option',
			'default' => '#dedede',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'theme_property_item_border_color',
				array(
					'label' => __( 'Property Item Border Color', 'framework' ),
					'section' => 'inspiry_property_item_styles',
				)
			)
		);

		$wp_customize->add_setting( 'theme_property_title_color', array(
			'type' => 'option',
			'default' => '#394041',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'theme_property_title_color',
				array(
					'label' => __( 'Property Title Color', 'framework' ),
					'section' => 'inspiry_property_item_styles',
				)
			)
		);

		$wp_customize->add_setting( 'theme_property_title_hover_color', array(
			'type' => 'option',
			'default' => '#df5400',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'theme_property_title_hover_color',
				array(
					'label' => __( 'Property Title Hover Color', 'framework' ),
					'section' => 'inspiry_property_item_styles',
				)
			)
		);

		$wp_customize->add_setting( 'theme_property_price_text_color', array(
			'type' => 'option',
			'default' => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'theme_property_price_text_color',
				array(
					'label' => __( 'Property Price Text Color', 'framework' ),
					'section' => 'inspiry_property_item_styles',
				)
			)
		);

		$wp_customize->add_setting( 'theme_property_price_bg_color', array(
			'type' => 'option',
			'default' => '#4dc7ec',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'theme_property_price_bg_color',
				array(
					'label' => __( 'Property Price Background Color', 'framework' ),
					'section' => 'inspiry_property_item_styles',
				)
			)
		);

		$wp_customize->add_setting( 'theme_property_status_text_color', array(
			'type' => 'option',
			'default' => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'theme_property_status_text_color',
				array(
					'label' => __( 'Property Status Text Color', 'framework' ),
					'section' => 'inspiry_property_item_styles',
				)
			)
		);

		$wp_customize->add_setting( 'theme_property_status_bg_color', array(
			'type' => 'option',
			'default' => '#ec894d',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'theme_property_status_bg_color',
				array(
					'label' => __( 'Property Status Background Color', 'framework' ),
					'section' => 'inspiry_property_item_styles',
				)
			)
		);

		$wp_customize->add_setting( 'theme_property_desc_text_color', array(
			'type' => 'option',
			'default' => '#8b9293',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'theme_property_desc_text_color',
				array(
					'label' => __( 'Property Description Text Color', 'framework' ),
					'section' => 'inspiry_property_item_styles',
				)
			)
		);

		$wp_customize->add_setting( 'theme_more_details_text_color', array(
			'type' => 'option',
			'default' => '#394041',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'theme_more_details_text_color',
				array(
					'label' => __( 'More Details Text Color', 'framework' ),
					'section' => 'inspiry_property_item_styles',
				)
			)
		);

		$wp_customize->add_setting( 'theme_more_details_text_hover_color', array(
			'type' => 'option',
			'default' => '#df5400',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'theme_more_details_text_hover_color',
				array(
					'label' => __( 'More Details Text Hover Color', 'framework' ),
					'section' => 'inspiry_property_item_styles',
				)
			)
		);

		$wp_customize->add_setting( 'theme_property_meta_text_color', array(
			'type' => 'option',
			'default' => '#394041',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'theme_property_meta_text_color',
				array(
					'label' => __( 'Property Meta Text Color', 'framework' ),
					'section' => 'inspiry_property_item_styles',
				)
			)
		);

		$wp_customize->add_setting( 'theme_property_meta_bg_color', array(
			'type' => 'option',
			'default' => '#f5f5f5',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'theme_property_meta_bg_color',
				array(
					'label' => __( 'Property Meta Background Color', 'framework' ),
					'section' => 'inspiry_property_item_styles',
				)
			)
		);


		/**
		 * Buttons Section
		 */

		$wp_customize->add_section( 'inspiry_buttons_styles', array(
			'title' => __( 'Buttons', 'framework' ),
			'panel' => 'inspiry_styles_panel',
		) );

		$wp_customize->add_setting( 'theme_button_text_color', array(
			'type' => 'option',
			'default' => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'theme_button_text_color',
				array(
					'label' => __( 'Button Text Color', 'framework' ),
					'section' => 'inspiry_buttons_styles',
				)
			)
		);

		$wp_customize->add_setting( 'theme_button_bg_color', array(
			'type' => 'option',
			'default' => '#ec894d',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'theme_button_bg_color',
				array(
					'label' => __( 'Button Background Color', 'framework' ),
					'section' => 'inspiry_buttons_styles',
				)
			)
		);

		$wp_customize->add_setting( 'theme_button_hover_text_color', array(
			'type' => 'option',
			'default' => '#ffffff',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'theme_button_hover_text_color',
				array(
					'label' => __( 'Button Hover Text Color', 'framework' ),
					'section' => 'inspiry_buttons_styles',
				)
			)
		);

		$wp_customize->add_setting( 'theme_button_hover_bg_color', array(
			'type' => 'option',
			'default' => '#e3712c',
			'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control(
			new WP_Customize_Color_Control(
				$wp_customize,
				'theme_button_hover_bg_color',
				array(
					'label' => __( 'Button Hover Background Color', 'framework' ),
					'section' => 'inspiry_buttons_styles',
				)
			)
		);

		/* Separator */
		$wp_customize->add_setting( 'inspiry_scroll_to_top_separator', array() );
		$wp_customize->add_control(
			new Inspiry_Separator_Control(
				$wp_customize,
				'inspiry_scroll_to_top_separator',
				array(
					'section' => 'inspiry_buttons_styles',
				)
			)
		);

		$wp_customize->add_setting( 'inspiry_back_to_top_bg_color', array(
				'type' => 'option',
				'default' => '#4dc7ec',
				'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control(
				new WP_Customize_Color_Control(
						$wp_customize,
						'inspiry_back_to_top_bg_color',
						array(
								'label' => __( 'Scroll to Top Button Background Color', 'framework' ),
								'section' => 'inspiry_buttons_styles',
						)
				)
		);

		$wp_customize->add_setting( 'inspiry_back_to_top_bg_hover_color', array(
				'type' => 'option',
				'default' => '#37b3d9',
				'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control(
				new WP_Customize_Color_Control(
						$wp_customize,
						'inspiry_back_to_top_bg_hover_color',
						array(
								'label' => __( 'Scroll to Top Button Background Hover Color', 'framework' ),
								'section' => 'inspiry_buttons_styles',
						)
				)
		);

		$wp_customize->add_setting( 'inspiry_back_to_top_color', array(
				'type' => 'option',
				'default' => '#fff',
				'sanitize_callback' => 'sanitize_hex_color',
		) );
		$wp_customize->add_control(
				new WP_Customize_Color_Control(
						$wp_customize,
						'inspiry_back_to_top_color',
						array(
								'label' => __( 'Scroll to Top Button Icon Color', 'framework' ),
								'section' => 'inspiry_buttons_styles',
						)
				)
		);


	}

	add_action( 'customize_register', 'inspiry_styles_customizer' );
endif;


if ( ! function_exists( 'inspiry_styles_defaults' ) ) :
	/**
	 * Set default values for styles settings
	 *
	 * @param WP_Customize_Manager $wp_customize
	 */
	function inspiry_styles_defaults( WP_Customize_Manager $wp_customize ) {
		$styles_settings_ids = array(
			'inspiry_heading_font',
			'inspiry_secondary_font',
			'inspiry_body_font',
			'theme_slide_title_color',
			'theme_slide_title_hover_color',
			'theme_slide_desc_text_color',
			'theme_slide_price_color',
			'theme_slide_know_more_text_color',
			'theme_slide_know_more_bg_color',
			'theme_slide_know_more_hover_bg_color',
			'theme_property_item_bg_color',
			'theme_property_item_border_color',
			'theme_property_title_color',
			'theme_property_title_hover_color',
			'theme_property_price_text_color',
			'theme_property_price_bg_color',
			'theme_property_status_text_color',
			'theme_property_status_bg_color',
			'theme_property_desc_text_color',
			'theme_more_details_text_color',
			'theme_more_details_text_hover_color',
			'theme_property_meta_text_color',
			'theme_property_meta_bg_color',
			'theme_button_text_color',
			'theme_button_bg_color',
			'theme_button_hover_text_color',
			'theme_button_hover_bg_color',
		);
		inspiry_initialize_defaults( $wp_customize, $styles_settings_ids );
	}

	add_action( 'customize_save_after', 'inspiry_styles_defaults' );
endif;