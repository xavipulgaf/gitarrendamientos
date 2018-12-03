<?php
/**
 * The current version of the theme.
 */
define( 'INSPIRY_THEME_VERSION', '2.6.2' );

// Framework Path
define( 'INSPIRY_FRAMEWORK', get_template_directory() . '/framework/' );

// Framework Path
define( 'INSPIRY_WIDGETS', get_template_directory() . '/widgets/' );


if ( ! function_exists( 'inspiry_theme_setup' ) ) {
	/**
	 * 1. Load text domain
	 * 2. Add custom background support
	 * 3. Add automatic feed links support
	 * 4. Add specific post formats support
	 * 5. Add custom menu support and register a custom menu
	 * 6. Register required image sizes
	 * 7. Add title tag support
	 */
	function inspiry_theme_setup() {

		/**
		 * Load text domain for translation purposes
		 */
		$languages_dir = get_template_directory() . '/languages';
		if ( file_exists( $languages_dir ) ) {
			load_theme_textdomain( 'framework', $languages_dir );
		} else {
			load_theme_textdomain( 'framework' );   // For backward compatibility
		}

		/**
		 * Add Theme Support - Custom background
		 */
		add_theme_support( 'custom-background' );

		/**
		 * Add Automatic Feed Links Support
		 */
		add_theme_support( 'automatic-feed-links' );

		/**
		 * Add Post Formats Support
		 */
		add_theme_support( 'post-formats', array( 'image', 'video', 'gallery' ) );

		/**
		 * Add Menu Support and register a custom menu
		 */
		add_theme_support( 'menus' );
		register_nav_menus(
			array(
				'main-menu' => __( 'Main Menu', 'framework' )
			)
		);

		/**
		 * Add Post Thumbnails Support and Related Image Sizes
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 150, 150 );                            // default Post Thumbnail dimensions
		add_image_size( 'partners-logo', 200, 58, true );                // For partner carousel logos
		add_image_size( 'post-featured-image', 830, 323, true );         // For Standard Post Thumbnails
		add_image_size( 'gallery-two-column-image', 536, 269, true );    // For Gallery Two Column property Thumbnails
		add_image_size( 'property-thumb-image', 244, 163, true );        // For Home page posts thumbnails/Featured Properties carousels thumb
		add_image_size( 'property-detail-slider-image', 770, 386, true );// For Property detail page slider image
		add_image_size( 'property-detail-slider-image-two', 830, 460, true ); // For Property detail page slider image
		add_image_size( 'property-detail-slider-thumb', 82, 60, true );  // For Property detail page slider thumb
		add_image_size( 'property-detail-video-image', 818, 417, true ); // For Property detail page video image
		add_image_size( 'agent-image', 210, 210, true );                 // For Agent Picture
		add_image_size( 'grid-view-image', 246, 162, true );             // For Property Listing Grid view,  image

		/**
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

	}

	add_action( 'after_setup_theme', 'inspiry_theme_setup' );

}


/**
 * Custom Post Types
 */
require_once( INSPIRY_FRAMEWORK . 'include/agent-post-type.php' );        // Agent
require_once( INSPIRY_FRAMEWORK . 'include/property-post-type.php' );     // Property
require_once( INSPIRY_FRAMEWORK . 'include/partners-post-type.php' );     // Partner
require_once( INSPIRY_FRAMEWORK . 'include/slide-post-type.php' );        // Slide


/**
 * Google Fonts
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/google-fonts/google-fonts.php' );


/**
 * Customizer
 */
require_once( INSPIRY_FRAMEWORK . 'customizer/customizer.php' );


/**
 * Meta Boxes
 */
require_once( INSPIRY_FRAMEWORK . 'meta-box/inspiry-meta-box.php' );


/**
 * Load functions files
 */
require_once( INSPIRY_FRAMEWORK . 'functions/load.php' );


/**
 * Shortcodes
 */
require_once( INSPIRY_FRAMEWORK . 'include/shortcodes/columns.php' );
require_once( INSPIRY_FRAMEWORK . 'include/shortcodes/elements.php' );
// if visual composer is installed then include related mapping code for properties shortcode
if ( class_exists( 'Vc_Manager' ) ) {
	require_once( get_template_directory() . '/framework/include/shortcodes/vc-map.php' );
}


/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 828;
}


if ( ! function_exists( 'inspiry_theme_sidebars' ) ) {
	/**
	 * Sidebars, Footer and other Widget areas
	 */
	function inspiry_theme_sidebars() {

		// Location: Default Sidebar
		register_sidebar( array(
			'name' => __( 'Default Sidebar', 'framework' ),
			'id' => 'default-sidebar',
			'description' => __( 'Widget area for default sidebar on news and post pages.', 'framework' ),
			'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="title">',
			'after_title' => '</h3>'
		) );

		// Location: Sidebar Pages
		register_sidebar( array(
			'name' => __( 'Pages Sidebar', 'framework' ),
			'id' => 'default-page-sidebar',
			'description' => __( 'Widget area for default page template sidebar.', 'framework' ),
			'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="title">',
			'after_title' => '</h3>'
		) );

		// Location: Sidebar for contact page
		register_sidebar( array(
			'name' => __( 'Contact Sidebar', 'framework' ),
			'id' => 'contact-sidebar',
			'description' => __( 'Widget area for contact page sidebar.', 'framework' ),
			'before_widget' => '<section class="widget clearfix %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="title">',
			'after_title' => '</h3>'
		) );

		// Location: Sidebar Property
		register_sidebar( array(
			'name' => __( 'Property Sidebar', 'framework' ),
			'id' => 'property-sidebar',
			'description' => __( 'Widget area for property detail page sidebar.', 'framework' ),
			'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="title">',
			'after_title' => '</h3>'
		) );

		// Location: Sidebar Properties Listing
		register_sidebar( array(
			'name' => __( 'Property Listing Sidebar', 'framework' ),
			'id' => 'property-listing-sidebar',
			'description' => __( 'Widget area for property listing template sidebar.', 'framework' ),
			'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="title">',
			'after_title' => '</h3>'
		) );

		// Location: Sidebar dsIDX
		register_sidebar( array(
			'name' => __( 'dsIDX Sidebar', 'framework' ),
			'id' => 'dsidx-sidebar',
			'description' => __( 'Widget area for dsIDX related pages.', 'framework' ),
			'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="title">',
			'after_title' => '</h3>'
		) );

		// Location: Footer First Column
		register_sidebar( array(
			'name' => __( 'Footer First Column', 'framework' ),
			'id' => 'footer-first-column',
			'description' => __( 'Widget area for first column in footer.', 'framework' ),
			'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="title">',
			'after_title' => '</h3>'
		) );

		// Location: Footer Second Column
		register_sidebar( array(
			'name' => __( 'Footer Second Column', 'framework' ),
			'id' => 'footer-second-column',
			'description' => __( 'Widget area for second column in footer.', 'framework' ),
			'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="title">',
			'after_title' => '</h3>'
		) );

		// Location: Footer Third Column
		register_sidebar( array(
			'name' => __( 'Footer Third Column', 'framework' ),
			'id' => 'footer-third-column',
			'description' => __( 'Widget area for third column in footer.', 'framework' ),
			'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="title">',
			'after_title' => '</h3>'
		) );

		// Location: Footer Fourth Column
		register_sidebar( array(
			'name' => __( 'Footer Fourth Column', 'framework' ),
			'id' => 'footer-fourth-column',
			'description' => __( 'Widget area for fourth column in footer.', 'framework' ),
			'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="title">',
			'after_title' => '</h3>'
		) );


		// Location: Sidebar Agent
		register_sidebar( array(
			'name' => __( 'Agent Sidebar', 'framework' ),
			'id' => 'agent-sidebar',
			'description' => __( 'Sidebar widget area for agent detail page.', 'framework' ),
			'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="title">',
			'after_title' => '</h3>'
		) );

		// Location: Home Search Area
		register_sidebar( array(
			'name' => __( 'Home Search Area', 'framework' ),
			'id' => 'home-search-area',
			'description' => __( 'Widget area for only IDX Search Widget. Using this area means you want to display IDX search form instead of default search form.', 'framework' ),
			'before_widget' => '<section id="home-idx-search" class="clearfix %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="home-widget-label">',
			'after_title' => '</h3>'
		) );

		// Location: Property Search Template
		register_sidebar( array(
			'name' => __( 'Property Search Sidebar', 'framework' ),
			'id' => 'property-search-sidebar',
			'description' => __( 'Widget area for property search template with sidebar.', 'framework' ),
			'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="title">',
			'after_title' => '</h3>'
		) );

		// Create additional sidebar to use with visual composer if needed
		if ( class_exists( 'Vc_Manager' ) ) {

			// Additional Sidebars
			register_sidebars( 4, array(
				'name' => __( 'Additional Sidebar %d', 'framework' ),
				'description' => __( 'An extra sidebar to use with Visual Composer if needed.', 'framework' ),
				'before_widget' => '<section id="%1$s" class="widget clearfix %2$s">',
				'after_widget' => '</section>',
				'before_title' => '<h3 class="title">',
				'after_title' => '</h3>'
			) );

		}

	}

	add_action( 'widgets_init', 'inspiry_theme_sidebars' );
}


/**
 * Custom Widgets
 */
include_once( INSPIRY_WIDGETS . 'featured-properties-widget.php' );
include_once( INSPIRY_WIDGETS . 'property-types-widget.php' );
include_once( INSPIRY_WIDGETS . 'advance-search-widget.php' );
include_once( INSPIRY_WIDGETS . 'agent-properties-widget.php' );
include_once( INSPIRY_WIDGETS . 'agent-featured-properties-widget.php' );


if ( ! function_exists( 'register_theme_widgets' ) ) {
	/**
	 * Register custom widgets
	 */
	function register_theme_widgets() {
		register_widget( 'Featured_Properties_Widget' );
		register_widget( 'Property_Types_Widget' );
		register_widget( 'Advance_Search_Widget' );
		register_widget( 'Agent_Properties_Widget' );
		register_widget( 'Agent_Featured_Properties_Widget' );
	}

	add_action( 'widgets_init', 'register_theme_widgets' );
}



if ( ! function_exists( 'inspiry_google_fonts' ) ) :
	/**
	 * Google fonts enqueue url
	 */
	function inspiry_google_fonts() {
		$fonts_url            = '';
		$font_families        = array ();
		$inspiry_heading_font = get_option( 'inspiry_heading_font', 'Default' );
		$inspiry_secondary_font = get_option( 'inspiry_secondary_font', 'Default' );
		$inspiry_body_font    = get_option( 'inspiry_body_font', 'Default' );

		/*
		 * Heading Font
		 */
		if ( $inspiry_heading_font !== "Default" ) {
			$font_families[] = $inspiry_heading_font;
		} else {
			/* Lato is theme's default heading font */
			$font_families[] = 'Lato:400,400i,700,700i';
		}

		/*
		 * Secondary Font
		 */
		if ( $inspiry_secondary_font !== "Default" ) {
			$font_families[] = $inspiry_secondary_font;
		} else {
			/* Robot is theme's default secondary font */
			$font_families[] = 'Roboto:400,400i,500,500i,700,700i';
		}

		/*
		 * Body Font
		 */
		if ( $inspiry_body_font !== "Default" ) {
			$font_families[] = $inspiry_body_font;
		}

		if ( !empty( $font_families ) ) {
			$query_args = array (
				'family' => urlencode( implode( '|', $font_families ) ),
				'subset' => urlencode( 'latin,latin-ext' ),
			);

			$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
		}

		return esc_url_raw( $fonts_url );
	}
endif;


if ( ! function_exists( 'load_theme_styles' ) ) {
	/**
	 * Load Required CSS Styles
	 */
	function load_theme_styles() {
		if ( ! is_admin() ) {

			/*
			 * Settings for CSS optimisation
			 */
			$inspiry_optimise_css = get_option( 'inspiry_optimise_css' );

			/*
			 * Google Fonts
			 */
			wp_enqueue_style (
				'inspiry-google-fonts',
				inspiry_google_fonts(),
				array(),
				INSPIRY_THEME_VERSION
			);

			/*
			 * Register Default and Custom Styles
			 */
			wp_register_style(
				'parent-default',
				get_stylesheet_uri(),
				array(),
				INSPIRY_THEME_VERSION,
				'all'
			);

			wp_register_style(
				'parent-custom',
				get_template_directory_uri() . '/css/custom.css',
				array(),
				INSPIRY_THEME_VERSION,
				'all'
			);

			// Font awesome css
			wp_enqueue_style(
				'font-awesome',
				get_template_directory_uri() . '/css/font-awesome.min.css',
				array(),
				'4.6.3',
				'all'
			);

			// Flex Slider
			wp_dequeue_style( 'flexslider' );       // dequeue flexslider if it registered by a plugin
			wp_deregister_style( 'flexslider' );    // deregister flexslider if it registered by a plugin
			wp_enqueue_style(
				'flexslider',
				get_template_directory_uri() . '/js/flexslider/flexslider.css',
				array(),
				'2.6.0',
				'all'
			);

			// Pretty photo
			wp_enqueue_style(
				'pretty-photo-css',
				get_template_directory_uri() . '/js/prettyphoto/css/prettyPhoto.css',
				array(),
				'3.1.6',
				'all'
			);

			// Swipe Box
			wp_enqueue_style(
				'swipebox',
				get_template_directory_uri() . '/js/swipebox/css/swipebox.min.css',
				array(),
				'1.4.4',
				'all'
			);

			// Select2
			wp_enqueue_style(
				'select2',
				get_template_directory_uri() . '/js/select2/select2.css',
				array(),
				'4.0.2',
				'all'
			);

			/*
			 * Main CSS
			 */
			if ( 'true' == $inspiry_optimise_css ) {
				wp_enqueue_style(
					'main-css',
					get_template_directory_uri() . '/css/main.min.css',
					array(),
					INSPIRY_THEME_VERSION,
					'all'
				);
			} else {
				wp_enqueue_style(
					'main-css',
					get_template_directory_uri() . '/css/main.css',
					array(),
					INSPIRY_THEME_VERSION,
					'all'
				);
			}

			/*
			 * RTL Styles
			 */
			if ( is_rtl() ) {
				if ( 'true' == $inspiry_optimise_css ) {
					wp_enqueue_style(
						'rtl-main-css',
						get_template_directory_uri() . '/css/rtl-main.min.css',
						array(),
						INSPIRY_THEME_VERSION,
						'all'
					);
				} else {
					wp_enqueue_style(
						'rtl-main-css',
						get_template_directory_uri() . '/css/rtl-main.css',
						array(),
						INSPIRY_THEME_VERSION,
						'all'
					);
				}
			}

			/*
			 * IF Visual Composer Plugins installed and activated
			 */
			if ( class_exists( 'Vc_Manager' ) ) {
				if ( 'true' == $inspiry_optimise_css ) {
					wp_enqueue_style(
						'vc-css',
						get_template_directory_uri() . '/css/visual-composer.min.css',
						array(),
						INSPIRY_THEME_VERSION,
						'all'
					);
				} else {
					wp_enqueue_style(
						'vc-css',
						get_template_directory_uri() . '/css/visual-composer.css',
						array(),
						INSPIRY_THEME_VERSION,
						'all'
					);
				}
			}

			// default css
			wp_enqueue_style( 'parent-default' );

			// parent theme custom css
			wp_enqueue_style( 'parent-custom' );

		}
	}

	add_action( 'wp_enqueue_scripts', 'load_theme_styles' );
}


if ( ! function_exists( 'load_theme_scripts' ) ) {
    /**
     * Enqueue JavaScripts required for this theme
     */
    function load_theme_scripts() {
        if ( ! is_admin() ) {

            $js_directory_uri = get_template_directory_uri() . '/js/';

            /**
             * Registering of Scripts
             */

            // flexslider
	        wp_dequeue_script( 'flexslider' );      // dequeue flexslider if it is enqueue by some plugin
	        wp_deregister_script( 'flexslider' );   // deregister flexslider if it registered by some plugin
            wp_register_script(
                'flexslider',
                $js_directory_uri . 'flexslider/jquery.flexslider-min.js',
                array( 'jquery' ),
                '2.6.0',
                false
            );

            // jQuery Easing
            wp_register_script(
                'jquery-easing',
                $js_directory_uri . 'jquery.easing.min.js',
                array( 'jquery' ),
                '1.4.1',
                false
            );

            // elasti slide
            wp_register_script(
                'elastislide',
                $js_directory_uri . 'elastislide/jquery.elastislide.js',
                array( 'jquery' ),
                false
            );

            // pretty photo
            wp_register_script(
                'pretty-photo',
                $js_directory_uri . 'prettyphoto/jquery.prettyPhoto.js',
                array( 'jquery' ),
                '3.1.6',
                false
            );

            // isotope
            wp_register_script(
                'isotope',
                $js_directory_uri . 'isotope.pkgd.min.js',
                array( 'jquery' ),
                '2.1.1',
                false
            );

            // jcarousel
            wp_register_script(
                'jcarousel',
                $js_directory_uri.'jquery.jcarousel.min.js',
                array( 'jquery' ),
                '0.2.9',
                false
            );

            // jQuery Validate
            wp_register_script(
                'jqvalidate',
                $js_directory_uri . 'jquery.validate.min.js',
                array( 'jquery' ),
                '1.11.1',
                false
            );

            // jQuery Form
            wp_register_script(
                'jqform',
                $js_directory_uri . 'jquery.form.js',
                array( 'jquery' ),
                '3.40',
                false
            );

	        // select2
	        wp_register_script(
		        'select2',
		        $js_directory_uri . 'select2/select2.full.min.js',
		        array( 'jquery' ),
		        '4.0.2',
		        false
	        );

            // jQuery Transit
            wp_register_script(
                'jqtransit',
                $js_directory_uri . 'jquery.transit.min.js',
                array( 'jquery' ),
                '0.9.9',
                false
            );

            // bootstrap
            wp_register_script(
                'bootstrap',
                $js_directory_uri . 'bootstrap.min.js',
                array( 'jquery' ),
                false
            );

            // swipebox
            wp_register_script(
                'swipebox',
                $js_directory_uri . 'swipebox/js/jquery.swipebox.min.js',
                array( 'jquery' ),
                '1.4.4',
                false
            );

            // Sticky-kit
            wp_register_script(
                'sticky-kit',
                $js_directory_uri . 'sticky-kit/sticky-kit.min.js',
                array( 'jquery' ),
                '1.1.2',
                false
            );
	        
	        // Search form script
	        wp_register_script(
		        'inspiry-search',
		        $js_directory_uri . 'inspiry-search-form.js',
		        array( 'jquery' ),
		        INSPIRY_THEME_VERSION,
		        true
	        );

            // Theme's main script
            wp_register_script(
                'custom',
                $js_directory_uri . 'custom.js',
                array( 'jquery' ),
                INSPIRY_THEME_VERSION,
                true
            );


            /*
             * Enqueue Scripts that are needed on all the pages
             */
	        wp_enqueue_script( 'jquery' );
	        wp_enqueue_script( 'jquery-ui-core' );
	        wp_enqueue_script( 'jquery-ui-autocomplete' );


	        /*
	         * If enabled include a single common script file to improve performance
	         */
	        if ( 'true' == get_option( 'inspiry_optimise_js' ) ) {

		        wp_enqueue_script(
			        'realhomes-common-scripts',
			        $js_directory_uri . 'realhomes-common-scripts.js',
			        array( 'jquery' ),
			        INSPIRY_THEME_VERSION,
			        false
		        );

	        } else {
		        wp_enqueue_script( 'flexslider' );
		        wp_enqueue_script( 'jquery-easing' );
		        wp_enqueue_script( 'elastislide' );
		        wp_enqueue_script( 'pretty-photo' );
		        wp_enqueue_script( 'swipebox' );
		        wp_enqueue_script( 'sticky-kit' );
		        wp_enqueue_script( 'isotope' );
		        wp_enqueue_script( 'jcarousel' );
		        wp_enqueue_script( 'jqvalidate' );
		        wp_enqueue_script( 'jqform' );
		        wp_enqueue_script( 'select2' );
		        wp_enqueue_script( 'jqtransit' );
		        wp_enqueue_script( 'bootstrap' );
	        }

            if ( google_map_needed() ) {

                /* default map query arguments */
                $google_map_arguments = array ();

                // Google Map API
                wp_enqueue_script(
                    'google-map-api',
                    esc_url_raw(
                        add_query_arg(
                            apply_filters(
                                'inspiry_google_map_arguments',
                                $google_map_arguments
                            ),
                            '//maps.google.com/maps/api/js'
                        )
                    ),
                    array(),
                    '3.21',
                    false
                );

                // Google Map Info Box API
                wp_enqueue_script(
                    'google-map-info-box',
                    esc_url_raw( $js_directory_uri . 'infobox.js' ),
                    array( 'google-map-api' ),
                    '1.1.9'
                );

                wp_enqueue_script(
                    'google-map-marker-clusterer',
                    esc_url_raw( $js_directory_uri . 'markerclusterer.js' ),
                    array( 'google-map-api' ),
                    '2.1.1'
                );

            }


            /**
             * Property Submit and Edit page
             */
            if ( is_page_template( 'template-submit-property.php' ) ) {

                // For image upload
                wp_enqueue_script( 'plupload' );

                // For sortable additional details
                wp_enqueue_script( 'jquery-ui-sortable' );

                // Property Submit Script
                wp_register_script(
                    'property-submit',
                    $js_directory_uri . 'property-submit.js',
                    array( 'jquery', 'jquery-ui-sortable', 'plupload' ),
                    INSPIRY_THEME_VERSION,
                    true
                );

                // data to print in JavaScript format above property submit script tag in HTML
                $property_submit_data = array(
                    'ajaxURL' => admin_url( 'admin-ajax.php' ),
                    'uploadNonce' => wp_create_nonce ( 'inspiry_allow_upload' ),
                    'fileTypeTitle' => __( 'Valid file formats', 'framework' ),
                );

                wp_localize_script( 'property-submit', 'propertySubmit', $property_submit_data );
                wp_enqueue_script( 'property-submit' );

            }

            /**
             * Edit profile template
             */
            if ( is_page_template( 'template-edit-profile.php' ) ) {

                // For image upload
                wp_enqueue_script( 'plupload' );

                wp_register_script(
                    'edit-profile',
                    $js_directory_uri . 'edit-profile.js',
                    array( 'jquery', 'plupload' ),
                    INSPIRY_THEME_VERSION,
                    true
                );

                // data to print in JavaScript format above edit profile script tag in HTML
                $edit_profile_data = array(
                    'ajaxURL' => admin_url( 'admin-ajax.php' ),
                    'uploadNonce' => wp_create_nonce ( 'inspiry_allow_upload' ),
                    'fileTypeTitle' => __( 'Valid file formats', 'framework' ),
                );

                wp_localize_script( 'edit-profile', 'editProfile', $edit_profile_data );
                wp_enqueue_script( 'edit-profile' );
            }

            /**
             * Script for comments reply
             */
            if ( is_singular( 'post' ) || is_page() || is_singular( 'property' ) ) {
                wp_enqueue_script( 'comment-reply' );
            }

            /**
             * Login, Register and Forgot Password Script
             */
            if ( ! is_user_logged_in() ) {
                wp_enqueue_script(
                    'inspiry-login-register',
                    $js_directory_uri . 'inspiry-login-register.js',
                    array( 'jquery' ),
                    INSPIRY_THEME_VERSION,
                    true
                );
            }

	        /* Print select status for rent to switch prices in properties search form */
	        $rent_slug = get_option( 'theme_status_for_rent' );
	        $localized_search_params = array();
	        if ( ! empty( $rent_slug ) ) {
		        $localized_search_params['rent_slug'] = $rent_slug;
	        }

	        /* localize search parameters */
	        wp_localize_script( 'inspiry-search', 'localizedSearchParams', $localized_search_params );

	        /* Inspiry search form script */
	        wp_enqueue_script( 'inspiry-search' );

	        /* Responsive menu title */
	        $localized_array = array(
		        'nav_title' => __('Go to...','framework')
	        );
	        wp_localize_script( 'custom', 'localized', $localized_array );

            /* Finally enqueue theme's main script */
            wp_enqueue_script('custom');

        }
    }
    add_action('wp_enqueue_scripts', 'load_theme_scripts');
}


if ( ! function_exists( 'inspiry_apply_google_maps_arguments' ) ) :
	/**
	 * This function adds google maps arguments to admins side maps displayed in meta boxes
	 */
	function inspiry_apply_google_maps_arguments( $google_maps_url ) {

		/* default map query arguments */
		$google_map_arguments = array();

		return esc_url_raw(
			add_query_arg(
				apply_filters(
					'inspiry_google_map_arguments',
					$google_map_arguments
				),
				$google_maps_url
			)
		);

	}

	add_filter( 'rwmb_google_maps_url', 'inspiry_apply_google_maps_arguments' );
endif;


if ( ! function_exists( 'inspiry_google_maps_api_key' ) ) :
	/**
	 * This function adds API key ( if provided in settings ) to google maps arguments
	 */
	function inspiry_google_maps_api_key( $google_map_arguments ) {
		/* Get Google Maps API Key if available */
		$google_maps_api_key = get_option( 'inspiry_google_maps_api_key' );
		if ( ! empty( $google_maps_api_key ) ) {
			$google_map_arguments[ 'key' ] = urlencode( $google_maps_api_key );
		}

		return $google_map_arguments;
	}

	add_filter( 'inspiry_google_map_arguments', 'inspiry_google_maps_api_key' );
endif;


if ( ! function_exists( 'inspiry_google_maps_language' ) ) :
	/**
	 * This function add current language to google maps arguments
	 */
	function inspiry_google_maps_language( $google_map_arguments ) {
		/* Localise Google Map if related theme options is set */
		if ( 'true' == get_option( 'theme_map_localization' ) ) {
			if ( function_exists( 'wpml_object_id_filter' ) ) {                         // FOR WPML
				$google_map_arguments[ 'language' ] = urlencode( ICL_LANGUAGE_CODE );
			} else {                                                                    // FOR Default
				$google_map_arguments[ 'language' ] = urlencode( get_locale() );
			}
		}

		return $google_map_arguments;
	}

	add_filter( 'inspiry_google_map_arguments', 'inspiry_google_maps_language' );
endif;

