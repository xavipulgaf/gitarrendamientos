<?php
/**
 * Customizer settings for Header
 */

if ( ! function_exists( 'inspiry_search_customizer' ) ) :
	function inspiry_search_customizer( WP_Customize_Manager $wp_customize ) {

		/*
        *	Access the property-status terms via an Array
        */
		$statuses_array = array();
		$status_terms = get_terms('property-status');
		foreach ($status_terms as $status_term){
			$statuses_array[$status_term->slug] = $status_term->name;
		}

		global $inspiry_pages;

		/**
		 * Property Panel
		 */

		$wp_customize->add_panel( 'inspiry_properties_search_panel', array(
			'title' => __( 'Properties Search', 'framework' ),
			'priority' => 123,
		) );


		/**
		 * Search Page
		 */

		$wp_customize->add_section( 'inspiry_properties_search_page', array(
			'title' => __( 'Properties Search Page', 'framework' ),
			'panel' => 'inspiry_properties_search_panel',
		) );

		/* Inspiry Search Page */
		$wp_customize->add_setting( 'inspiry_search_page', array(
			'type' => 'option',
		) );
		$wp_customize->add_control( 'inspiry_search_page', array(
			'label' => __('Select Search Page','framework'),
			"description" => __('Selected page should have Property Search Template assigned to it. Also, Make sure to Configure Pretty Permalinks.','framework'),
			'type' => 'select',
			'section' => 'inspiry_properties_search_page',
			'choices' => $inspiry_pages
		) );

		/* Search Results Page Area Below Header */
		$wp_customize->add_setting( 'theme_search_module', array(
			'type' => 'option',
			'default' => 'properties-map',
		) );
		$wp_customize->add_control( 'theme_search_module', array(
			'label' => __( 'Search Results Page Header', 'framework' ),
			"description" => __( 'What you want to display in area below header on properties search results page ?', 'framework' ),
			'type' => 'radio',
			'section' => 'inspiry_properties_search_page',
			'choices' => array(
				'properties-map' => __( 'Google Map with Property Markers', 'framework' ),
				'simple-banner' => __( 'Image Banner', 'framework' )
			)
		) );

		/* Number of Properties To Display on Search Results Page */
		$wp_customize->add_setting( 'theme_properties_on_search', array(
			'type' => 'option',
			'default' => '4',
		) );
		$wp_customize->add_control( 'theme_properties_on_search', array(
			'label' => __( 'Properties Per Page', 'framework' ),
			'description' => __( 'Number of properties to display on search results page', 'framework' ),
			'type' => 'select',
			'section' => 'inspiry_properties_search_page',
			'choices' => array(
				'1' => 1,
				'2' => 2,
				'3' => 3,
				'4' => 4,
				'5' => 5,
				'6' => 6,
				'7' => 7,
				'8' => 8,
				'9' => 9,
				'10' => 10,
				'11' => 11,
				'12' => 12,
				'13' => 13,
				'14' => 14,
				'15' => 15,
				'16' => 16,
				'17' => 17,
				'18' => 18,
				'19' => 19,
				'20' => 20,
			)
		) );

		/* Stick Featured Properties on top of Search Results in default sorting */
		$wp_customize->add_setting( 'inspiry_featured_properties_on_top', array(
			'type' => 'option',
			'default' => 'true',
		) );
		$wp_customize->add_control( 'inspiry_featured_properties_on_top', array(
			'label' => __( 'Display Featured Properties on Top in Search Results Page?', 'framework' ),
			'description' => __( 'This setting will be applied on sorting based on Sort by Date (Old to New and New to Old) only.', 'framework' ),
			'type' => 'radio',
			'section' => 'inspiry_properties_search_page',
			'choices' => array(
				'true' => __( 'Yes', 'framework' ),
				'false' => __( 'No', 'framework' ),
			)
		) );

		/* Separator */
		$wp_customize->add_setting( 'inspiry_search_url_separator', array() );
		$wp_customize->add_control(
			new Inspiry_Separator_Control(
				$wp_customize,
				'inspiry_search_url_separator',
				array(
					'section' => 'inspiry_properties_search_page',
				)
			)
		);

		/* Search Page URL - DEPRECATED */
		$wp_customize->add_setting( 'theme_search_url', array(
			'type' => 'option',
			'sanitize_callback' => 'esc_url_raw',
		) );
		$wp_customize->add_control( 'theme_search_url', array(
			'label' => __( 'Search Page URL', 'framework' ) . ' ' . '**DEPRECATED**',
			"description" => 'Selecting search page above is enough and this setting is displayed for backward compatibility',
			'type' => 'url',
			'section' => 'inspiry_properties_search_page',
		) );



		/**
		 * Search Form Basics
		 */

		$wp_customize->add_section( 'inspiry_properties_search_form', array(
			'title' => __( 'Search Form Basics', 'framework' ),
			'panel' => 'inspiry_properties_search_panel',
		) );

		/* Search Form Title */
		$wp_customize->add_setting( 'theme_home_advance_search_title', array(
			'type' => 'option',
			'sanitize_callback' => 'sanitize_text_field',
			'default' => __( 'Find Your Home', 'framework' ),
		) );
		$wp_customize->add_control( 'theme_home_advance_search_title', array(
			'label' => __( 'Search Form Title', 'framework' ),
			'type' => 'text',
			'section' => 'inspiry_properties_search_form',
		) );

		/* Search Fields */
		$wp_customize->add_setting( 'theme_search_fields', array(
			'type' => 'option',
			'default' => array( 'keyword-search', 'property-id', 'location', 'status', 'type', 'min-beds', 'min-baths', 'min-max-price', 'min-max-area', 'features' ),
			'sanitize_callback' => 'inspiry_sanitize_multiple_checkboxes'
		) );
		$wp_customize->add_control(
			new Inspiry_Multiple_Checkbox_Customize_Control(
				$wp_customize,
				'theme_search_fields',
				array(
					'section' => 'inspiry_properties_search_form',
					'label' => __( 'Which fields you want to display in search form ?', 'framework' ),
					'choices' => array(
						'keyword-search' => __( 'Keyword Search', 'framework' ),
						'property-id' => __( 'Property ID', 'framework' ),
						'location' => __( 'Property Location', 'framework' ),
						'status' => __( 'Property Status', 'framework' ),
						'type' => __( 'Property Type', 'framework' ),
						'min-beds' => __( 'Min Beds', 'framework' ),
						'min-baths' => __( 'Min Baths', 'framework' ),
						'min-max-price' => __( 'Min and Max Price', 'framework' ),
						'min-max-area' => __( 'Min and Max Area', 'framework' ),
						'features' => __( 'Property Features', 'framework' ),
					)
				)
			)
		);

		/* Separator */
		$wp_customize->add_setting( 'inspiry_keyword_separator', array() );
		$wp_customize->add_control(
			new Inspiry_Separator_Control(
				$wp_customize,
				'inspiry_keyword_separator',
				array(
					'section' => 'inspiry_properties_search_form',
				)
			)
		);

		/* Keyword Label */
		$wp_customize->add_setting( 'inspiry_keyword_label', array(
			'type' => 'option',
			'default' => __( 'Keyword', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_keyword_label', array(
			'label' => __( 'Label for Keyword Search', 'framework' ),
			'type' => 'text',
			'section' => 'inspiry_properties_search_form',
		) );

		/* Keyword Placeholder Text */
		$wp_customize->add_setting( 'inspiry_keyword_placeholder_text', array(
			'type' => 'option',
			'default' => __('Any', 'framework'),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_keyword_placeholder_text', array(
			'label' => __( 'Placeholder Text for Keyword Search', 'framework' ),
			'type' => 'text',
			'section' => 'inspiry_properties_search_form',
		) );

		/* Separator */
		$wp_customize->add_setting( 'inspiry_property_id_separator', array() );
		$wp_customize->add_control(
			new Inspiry_Separator_Control(
				$wp_customize,
				'inspiry_property_id_separator',
				array(
					'section' => 'inspiry_properties_search_form',
				)
			)
		);

		/* Property ID Label */
		$wp_customize->add_setting( 'inspiry_property_id_label', array(
			'type' => 'option',
			'default' => __( 'Property ID', 'framework' ),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_property_id_label', array(
			'label' => __( 'Label for Property ID', 'framework' ),
			'type' => 'text',
			'section' => 'inspiry_properties_search_form',
		) );

		/* Property ID Placeholder Text */
		$wp_customize->add_setting( 'inspiry_property_id_placeholder_text', array(
			'type' => 'option',
			'default' => __('Any', 'framework'),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_property_id_placeholder_text', array(
			'label' => __( 'Placeholder Text for Property ID', 'framework' ),
			'type' => 'text',
			'section' => 'inspiry_properties_search_form',
		) );

		/* Separator */
		$wp_customize->add_setting( 'inspiry_search_taxonomy_separator', array() );
		$wp_customize->add_control(
			new Inspiry_Separator_Control(
				$wp_customize,
				'inspiry_search_taxonomy_separator',
				array(
					'section' => 'inspiry_properties_search_form',
				)
			)
		);

		/* Property Status Label */
		$wp_customize->add_setting( 'inspiry_property_status_label', array(
			'type' => 'option',
			'default' => __('Property Status', 'framework'),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_property_status_label', array(
			'label' => __( 'Label for Property Status', 'framework' ),
			'type' => 'text',
			'section' => 'inspiry_properties_search_form',
		) );

		/* Property Type Label */
		$wp_customize->add_setting( 'inspiry_property_type_label', array(
			'type' => 'option',
			'default' => __('Property Type', 'framework'),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_property_type_label', array(
			'label' => __( 'Label for Property Type', 'framework' ),
			'type' => 'text',
			'section' => 'inspiry_properties_search_form',
		) );

		/* Search Button Text */
		$wp_customize->add_setting( 'inspiry_search_button_text', array(
			'type' => 'option',
			'default' => __('Search', 'framework'),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_search_button_text', array(
			'label' => __( 'Search Button Text', 'framework' ),
			'type' => 'text',
			'section' => 'inspiry_properties_search_form',
		) );

		/* Separator */
		$wp_customize->add_setting( 'inspiry_any_separator', array() );
		$wp_customize->add_control(
			new Inspiry_Separator_Control(
				$wp_customize,
				'inspiry_any_separator',
				array(
					'section' => 'inspiry_properties_search_form',
				)
			)
		);

		/* Any Text */
		$wp_customize->add_setting( 'inspiry_any_text', array(
			'type' => 'option',
			'default' => __('Any', 'framework'),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_any_text', array(
			'label' => __( 'Any Text', 'framework' ),
			'type' => 'text',
			'section' => 'inspiry_properties_search_form',
		) );

		/* Search Features Title */
		$wp_customize->add_setting( 'inspiry_search_features_title', array(
			'type' => 'option',
			'default' => __('Looking for certain features', 'framework'),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_search_features_title', array(
			'label' => __( 'Title for Features Toggle', 'framework' ),
			'type' => 'text',
			'section' => 'inspiry_properties_search_form',
		) );


		/**
		 * Search Form Locations
		 */

		$wp_customize->add_section( 'inspiry_search_form_locations', array(
			'title' => __( 'Search Form Locations', 'framework' ),
			'panel' => 'inspiry_properties_search_panel',
		) );

		/* Number of Location Boxes */
		$wp_customize->add_setting( 'theme_location_select_number', array(
			'type' => 'option',
			'default' => '1',
		) );
		$wp_customize->add_control( 'theme_location_select_number', array(
			'label' => __( 'Number of Location Select Boxes', 'framework' ),
			"description" => __( 'In case of 1 location box, all locations will be listed in that select box. In case of 2 or more, Each select box will list parent locations of a level that matches its number and all the remaining children locations will be listed in last select box.', 'framework' ),
			'type' => 'select',
			'section' => 'inspiry_search_form_locations',
			'choices' => array(
				'1' => 1,
				'2' => 2,
				'3' => 3,
				'4' => 4,
			)
		) );

		/* 1st Location Box Title */
		$wp_customize->add_setting( 'theme_location_title_1', array(
			'type' => 'option',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_location_title_1', array(
			'label' => __( 'Title for 1st Location Select Box', 'framework' ),
			"description" => __( 'Example: Country', 'framework' ),
			'type' => 'text',
			'section' => 'inspiry_search_form_locations',
		) );

		/* 2nd Location Box Title */
		$wp_customize->add_setting( 'theme_location_title_2', array(
			'type' => 'option',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_location_title_2', array(
			'label' => __( 'Title for 2nd Location Select Box', 'framework' ),
			"description" => __( 'Example: State', 'framework' ),
			'type' => 'text',
			'section' => 'inspiry_search_form_locations',
		) );

		/* 3rd Location Box Title */
		$wp_customize->add_setting( 'theme_location_title_3', array(
			'type' => 'option',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_location_title_3', array(
			'label' => __( 'Title for 3rd Location Select Box', 'framework' ),
			"description" => __( 'Example: City', 'framework' ),
			'type' => 'text',
			'section' => 'inspiry_search_form_locations',
		) );

		/* 4th Location Box Title */
		$wp_customize->add_setting( 'theme_location_title_4', array(
			'type' => 'option',
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_location_title_4', array(
			'label' => __( 'Title for 4th Location Select Box', 'framework' ),
			"description" => __( 'Example: Area', 'framework' ),
			'type' => 'text',
			'section' => 'inspiry_search_form_locations',
		) );

		/* Hide Empty Locations */
		$wp_customize->add_setting( 'inspiry_hide_empty_locations', array(
			'type' => 'option',
			'default' => 'false',
		) );
		$wp_customize->add_control( 'inspiry_hide_empty_locations', array(
			'label' => __( 'Hide Empty Locations ?', 'framework' ),
			"description" => __( 'Optimize Locations by hiding the ones with zero property.', 'framework' ),
			'type' => 'radio',
			'section' => 'inspiry_search_form_locations',
			'choices' => array(
				'true' => __( 'Yes', 'framework' ),
				'false' => __( 'No', 'framework' ),
			)
		) );

		/* Sort Locations */
		$wp_customize->add_setting( 'theme_locations_order', array(
			'type' => 'option',
			'default' => 'false',
		) );
		$wp_customize->add_control( 'theme_locations_order', array(
			'label' => __( 'Sort Locations Alphabetically ?', 'framework' ),
			'type' => 'radio',
			'section' => 'inspiry_search_form_locations',
			'choices' => array(
				'true' => __( 'Yes', 'framework' ),
				'false' => __( 'No', 'framework' ),
			)
		) );


		/**
		 * Search Form Beds & Baths
		 */

		$wp_customize->add_section( 'inspiry_search_form_beds_baths', array(
			'title' => __( 'Search Form Beds & Baths', 'framework' ),
			'panel' => 'inspiry_properties_search_panel',
		) );

		/* Min Beds Label */
		$wp_customize->add_setting( 'inspiry_min_beds_label', array(
			'type' => 'option',
			'default' => __('Min Beds', 'framework'),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_min_beds_label', array(
			'label' => __( 'Label for Min Beds Field', 'framework' ),
			'type' => 'text',
			'section' => 'inspiry_search_form_beds_baths',
		) );

		/* Min Beds for Advance Search */
		$wp_customize->add_setting( 'inspiry_min_beds', array(
			'type' => 'option',
			'sanitize_callback' => 'sanitize_text_field',
			'default' => "1,2,3,4,5,6,7,8,9,10",
		) );
		$wp_customize->add_control( 'inspiry_min_beds', array(
			'label' => __( 'Minimum Beds Values', 'framework' ),
			"description" => __( 'Only provide comma separated numbers.', 'framework' ),
			'type' => 'textarea',
			'section' => 'inspiry_search_form_beds_baths',
		) );

		/* Min Baths Label */
		$wp_customize->add_setting( 'inspiry_min_baths_label', array(
			'type' => 'option',
			'default' => __('Min Baths', 'framework'),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_min_baths_label', array(
			'label' => __( 'Label for Min Baths Field', 'framework' ),
			'type' => 'text',
			'section' => 'inspiry_search_form_beds_baths',
		) );

		/* Min Baths for Advance Search */
		$wp_customize->add_setting( 'inspiry_min_baths', array(
			'type' => 'option',
			'sanitize_callback' => 'sanitize_text_field',
			'default' => "1,2,3,4,5,6,7,8,9,10",
		) );
		$wp_customize->add_control( 'inspiry_min_baths', array(
			'label' => __( 'Minimum Baths Values', 'framework' ),
			"description" => __( 'Only provide comma separated numbers.', 'framework' ),
			'type' => 'textarea',
			'section' => 'inspiry_search_form_beds_baths',
		) );

		/* Beds & Baths search behaviour */
		$wp_customize->add_setting( 'inspiry_beds_baths_search_behaviour', array(
			'type'    => 'option',
			'default' => 'min',
		) );
		$wp_customize->add_control( 'inspiry_beds_baths_search_behaviour', array(
			'label'       => __( 'Beds and Baths Search Behaviour', 'framework' ),
			"description" => __( 'Do you want the search functionality to look for minimum beds, maximum beds or exact equals ?', 'framework' ),
			'type'        => 'select',
			'section'     => 'inspiry_search_form_beds_baths',
			'choices'     => array(
				'min'   => __( 'Minimum', 'framework' ),
				'max'   => __( 'Maximum', 'framework' ),
				'equal' => __( 'Equal', 'framework' ),
			)
		) );


		/**
		 * Search Form Min & Max Prices
		 */

		$wp_customize->add_section( 'inspiry_search_form_prices', array(
			'title' => __( 'Search Form Prices', 'framework' ),
			'panel' => 'inspiry_properties_search_panel',
		) );

		/* Min Price Label */
		$wp_customize->add_setting( 'inspiry_min_price_label', array(
			'type' => 'option',
			'default' => __('Min Price', 'framework'),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_min_price_label', array(
			'label' => __( 'Label for Min Price Field', 'framework' ),
			'type' => 'text',
			'section' => 'inspiry_search_form_prices',
		) );

		/* Minimum Prices for Advance Search */
		$wp_customize->add_setting( 'theme_minimum_price_values', array(
			'type' => 'option',
			'sanitize_callback' => 'sanitize_text_field',
			'default' => "1000,5000,10000,50000,100000,200000,300000,400000,500000,600000,700000,800000,900000,1000000,1500000,2000000,2500000,5000000",
		) );
		$wp_customize->add_control( 'theme_minimum_price_values', array(
			'label' => __( 'Minimum Prices List', 'framework' ),
			"description" => __( 'Only provide comma separated numbers. Do not add decimal points, dashes, spaces and currency signs.', 'framework' ),
			'type' => 'textarea',
			'section' => 'inspiry_search_form_prices',
		) );

		/* Max Price Label */
		$wp_customize->add_setting( 'inspiry_max_price_label', array(
			'type' => 'option',
			'default' => __('Max Price', 'framework'),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_max_price_label', array(
			'label' => __( 'Label for Max Price Field', 'framework' ),
			'type' => 'text',
			'section' => 'inspiry_search_form_prices',
		) );

		/* Maximum Prices for Advance Search */
		$wp_customize->add_setting( 'theme_maximum_price_values', array(
			'type' => 'option',
			'sanitize_callback' => 'sanitize_text_field',
			'default' => '5000,10000,50000,100000,200000,300000,400000,500000,600000,700000,800000,900000,1000000,1500000,2000000,2500000,5000000,10000000',
		) );
		$wp_customize->add_control( 'theme_maximum_price_values', array(
			'label' => __( 'Maximum Prices List', 'framework' ),
			"description" => __( 'Only provide comma separated numbers. Do not add decimal points, dashes, spaces and currency signs.', 'framework' ),
			'type' => 'textarea',
			'section' => 'inspiry_search_form_prices',
		) );

		/* Status For Rent */
		$wp_customize->add_setting( 'theme_status_for_rent', array(
			'type' => 'option',
			'default' => 'for-rent',
		) );
		$wp_customize->add_control( 'theme_status_for_rent', array(
			'label' => __( 'Status That Represents Rent', 'framework' ),
			"description" => __( "Visitor expects smaller values for rent prices. So provide the list of minimum and maximum rent prices below. The rent prices will be displayed based on rent status selected here.", 'framework' ),
			'type' => 'radio',
			'section' => 'inspiry_search_form_prices',
			'choices' => $statuses_array,
		) );

		/* Minimum Prices for Rent in Advance Search */
		$wp_customize->add_setting( 'theme_minimum_price_values_for_rent', array(
			'type' => 'option',
			'sanitize_callback' => 'sanitize_text_field',
			'default' => "500,1000,2000,3000,4000,5000,7500,10000,15000,20000,25000,30000,40000,50000,75000,100000",
		) );
		$wp_customize->add_control( 'theme_minimum_price_values_for_rent', array(
			'label' => __('Minimum Prices List for Rent Only.','framework'),
			"description" => __( 'Only provide comma separated numbers. Do not add decimal points, dashes, spaces and currency signs.', 'framework' ),
			'type' => 'textarea',
			'section' => 'inspiry_search_form_prices',
		) );

		/* Maximum Prices for Rent in Advance Search */
		$wp_customize->add_setting( 'theme_maximum_price_values_for_rent', array(
			'type' => 'option',
			'sanitize_callback' => 'sanitize_text_field',
			'default' => '1000,2000,3000,4000,5000,7500,10000,15000,20000,25000,30000,40000,50000,75000,100000,150000',
		) );
		$wp_customize->add_control( 'theme_maximum_price_values_for_rent', array(
			'label' => __( 'Maximum Prices List for Rent Only.', 'framework' ),
			"description" => __( 'Only provide comma separated numbers. Do not add decimal points, dashes, spaces and currency signs.', 'framework' ),
			'type' => 'textarea',
			'section' => 'inspiry_search_form_prices',
		) );


		/**
		 * Search Form Min & Max Areas
		 */

		$wp_customize->add_section( 'inspiry_search_form_areas', array(
			'title' => __( 'Search Form Areas', 'framework' ),
			'panel' => 'inspiry_properties_search_panel',
		) );

		/* Min Area Label */
		$wp_customize->add_setting( 'inspiry_min_area_label', array(
			'type' => 'option',
			'default' => __('Min Area', 'framework'),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_min_area_label', array(
			'label' => __( 'Label for Min Area Field', 'framework' ),
			'type' => 'text',
			'section' => 'inspiry_search_form_areas',
		) );

		/* Min Area Placeholder Text */
		$wp_customize->add_setting( 'inspiry_min_area_placeholder_text', array(
			'type' => 'option',
			'default' => __('Any', 'framework'),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_min_area_placeholder_text', array(
			'label' => __( 'Placeholder Text for Min Area', 'framework' ),
			'type' => 'text',
			'section' => 'inspiry_search_form_areas',
		) );

		/* Max Area Label */
		$wp_customize->add_setting( 'inspiry_max_area_label', array(
			'type' => 'option',
			'default' => __('Max Area', 'framework'),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_max_area_label', array(
			'label' => __( 'Label for Max Area Field', 'framework' ),
			'type' => 'text',
			'section' => 'inspiry_search_form_areas',
		) );

		/* Max Area Placeholder Text */
		$wp_customize->add_setting( 'inspiry_max_area_placeholder_text', array(
			'type' => 'option',
			'default' => __('Any', 'framework'),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'inspiry_max_area_placeholder_text', array(
			'label' => __( 'Placeholder Text for Max Area', 'framework' ),
			'type' => 'text',
			'section' => 'inspiry_search_form_areas',
		) );

		/* Area Measurement Unit */
		$wp_customize->add_setting( 'theme_area_unit', array(
			'type' => 'option',
			'default' => __('sq ft', 'framework'),
			'sanitize_callback' => 'sanitize_text_field',
		) );
		$wp_customize->add_control( 'theme_area_unit', array(
			'label' => __( 'Area Measurement Unit for Min and Max Area fields.', 'framework' ),
			"description" => __( 'Example: sq ft', 'framework' ),
			'type' => 'text',
			'section' => 'inspiry_search_form_areas',
		) );


	}

	add_action( 'customize_register', 'inspiry_search_customizer' );
endif;


if ( ! function_exists( 'inspiry_search_defaults' ) ) :
	/**
	 * Set default values for search settings
	 *
	 * @param WP_Customize_Manager $wp_customize
	 */
	function inspiry_search_defaults( WP_Customize_Manager $wp_customize ) {
		$search_settings_ids = array(
			'theme_search_module',
			'theme_properties_on_search',
			'inspiry_featured_properties_on_top',
			'theme_home_advance_search_title',
			'theme_search_fields',
			'inspiry_keyword_label',
			'inspiry_keyword_placeholder_text',
			'inspiry_property_id_label',
			'inspiry_property_id_placeholder_text',
			'inspiry_property_status_label',
			'inspiry_property_type_label',
			'theme_location_select_number',
			'inspiry_hide_empty_locations',
			'theme_locations_order',
			'inspiry_min_beds_label',
			'inspiry_min_beds',
			'inspiry_min_baths_label',
			'inspiry_min_baths',
			'inspiry_min_price_label',
			'theme_minimum_price_values',
			'inspiry_max_price_label',
			'theme_maximum_price_values',
			'theme_status_for_rent',
			'theme_minimum_price_values_for_rent',
			'theme_maximum_price_values_for_rent',
			'inspiry_min_area_label',
			'inspiry_min_area_placeholder_text',
			'inspiry_max_area_label',
			'inspiry_max_area_placeholder_text',
			'theme_area_unit',
			'inspiry_any_text',
			'inspiry_search_button_text',
			'inspiry_search_features_title',
		);
		inspiry_initialize_defaults( $wp_customize, $search_settings_ids );
	}

	add_action( 'customize_save_after', 'inspiry_search_defaults' );
endif;