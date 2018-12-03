<?php
if( !function_exists( 'generate_dynamic_css' ) ){
    function generate_dynamic_css(){

        // Header
        $theme_header_bg_color = get_option('theme_header_bg_color');
        $theme_header_text_color = get_option('theme_header_text_color');
        $theme_header_link_hover_color = get_option('theme_header_link_hover_color');
        $theme_header_border_color = get_option('theme_header_border_color');

        // Drop Down Menu
        $theme_main_menu_text_color = get_option('theme_main_menu_text_color');
        $theme_menu_bg_color = get_option('theme_menu_bg_color');
        $theme_menu_text_color = get_option('theme_menu_text_color');
        $theme_menu_hover_bg_color = get_option('theme_menu_hover_bg_color');

        // Phone Icon and Number
        $theme_phone_bg_color = get_option('theme_phone_bg_color');
        $theme_phone_text_color = get_option('theme_phone_text_color');
        $theme_phone_icon_bg_color = get_option('theme_phone_icon_bg_color');

        // Logo
        $theme_logo_text_color = get_option('theme_logo_text_color');
        $theme_logo_text_hover_color = get_option('theme_logo_text_hover_color');

        // Tagline
        $theme_tagline_text_color = get_option('theme_tagline_text_color');
        $theme_tagline_bg_color = get_option('theme_tagline_bg_color');

        // Banner title
        $theme_banner_text_color = get_option('theme_banner_text_color');
        $theme_banner_sub_text_color = get_option('theme_banner_sub_text_color');
        $theme_banner_title_bg_color = get_option('theme_banner_title_bg_color');
        $theme_banner_sub_title_bg_color = get_option('theme_banner_sub_title_bg_color');

        // Slide
        $theme_slide_title_color = get_option('theme_slide_title_color');
        $theme_slide_title_hover_color = get_option('theme_slide_title_hover_color');
        $theme_slide_desc_text_color = get_option('theme_slide_desc_text_color');
        $theme_slide_price_color = get_option('theme_slide_price_color');
        $theme_slide_know_more_text_color = get_option('theme_slide_know_more_text_color');
        $theme_slide_know_more_bg_color = get_option('theme_slide_know_more_bg_color');
        $theme_slide_know_more_hover_bg_color = get_option('theme_slide_know_more_hover_bg_color');

        // Search Form Over Image
        $inspiry_SFOI_top_margin = get_option('inspiry_SFOI_top_margin');
        $inspiry_SFOI_title_color = get_option('inspiry_SFOI_title_color');
        $inspiry_SFOI_description_color = get_option('inspiry_SFOI_description_color');

        // property item
        $theme_property_item_bg_color = get_option('theme_property_item_bg_color');
        $theme_property_item_border_color = get_option('theme_property_item_border_color');
        $theme_property_title_color = get_option('theme_property_title_color');
        $theme_property_title_hover_color = get_option('theme_property_title_hover_color');
        $theme_property_price_text_color = get_option('theme_property_price_text_color');
        $theme_property_price_bg_color = get_option('theme_property_price_bg_color');
        $theme_property_status_text_color = get_option('theme_property_status_text_color');
        $theme_property_status_bg_color = get_option('theme_property_status_bg_color');
        $theme_property_desc_text_color = get_option('theme_property_desc_text_color');
        $theme_more_details_text_color = get_option('theme_more_details_text_color');
        $theme_more_details_text_hover_color = get_option('theme_more_details_text_hover_color');
        $theme_property_meta_text_color = get_option('theme_property_meta_text_color');
        $theme_property_meta_bg_color = get_option('theme_property_meta_bg_color');

        // Footer
        $theme_disable_footer_bg = get_option('theme_disable_footer_bg');
        $theme_footer_bg_img = get_option('theme_footer_bg_img');
        $theme_footer_widget_title_color = get_option('theme_footer_widget_title_color');
        $theme_footer_widget_text_color = get_option('theme_footer_widget_text_color');
        $theme_footer_widget_link_color = get_option('theme_footer_widget_link_color');
        $theme_footer_widget_link_hover_color = get_option('theme_footer_widget_link_hover_color');
        $theme_footer_border_color = get_option('theme_footer_border_color');

        // Button
        $theme_button_text_color = get_option('theme_button_text_color');
        $theme_button_bg_color = get_option('theme_button_bg_color');
        $theme_button_hover_text_color = get_option('theme_button_hover_text_color');
        $theme_button_hover_bg_color = get_option('theme_button_hover_bg_color');
        $inspiry_back_to_top_bg_color = get_option('inspiry_back_to_top_bg_color');
        $inspiry_back_to_top_bg_hover_color = get_option('inspiry_back_to_top_bg_hover_color');
        $inspiry_back_to_top_color = get_option('inspiry_back_to_top_color');

        $dynamic_css = array(

                            //Header background color
                            array(
                                'elements'	=>	'.header-wrapper, #currency-switcher #selected-currency, #currency-switcher-list li',
                                'property'	=>	'background-color',
                                'value'		=> 	$theme_header_bg_color
                            ),
                            //Logo
                            array(
                                'elements'	=>	'#logo h2 a',
                                'property'	=>	'color',
                                'value'		=> 	$theme_logo_text_color
                            ),
                            array(
                                'elements'	=>	'#logo h2 a:hover, #logo h2 a:focus, #logo h2 a:active',
                                'property'	=>	'color',
                                'value'		=> 	$theme_logo_text_hover_color
                            ),
                            //Tagline
                            array(
                                'elements'	=>	'.tag-line span',
                                'property'	=>	'color',
                                'value'		=> 	$theme_tagline_text_color
                            ),
                            array(
                                'elements'	=>	'.tag-line span',
                                'property'	=>	'background-color',
                                'value'		=> 	$theme_tagline_bg_color
                            ),
                            //Banner title
                            array(
                                'elements'	=>	'.page-head h1.page-title span',
                                'property'	=>	'color',
                                'value'		=> 	$theme_banner_text_color
                            ),
                            array(
                                'elements'	=>	'.page-head h1.page-title span',
                                'property'	=>	'background-color',
                                'value'		=> 	$theme_banner_title_bg_color
                            ),
                            array(
                                'elements'	=>	'.page-head p',
                                'property'	=>	'color',
                                'value'		=> 	$theme_banner_sub_text_color
                            ),
                            array(
                                'elements'	=>	'.page-head p',
                                'property'	=>	'background-color',
                                'value'		=> 	$theme_banner_sub_title_bg_color
                            ),
                            //Header Text color
                            array(
                                'elements'	=>	'.header-wrapper, #contact-email, #contact-email a, .user-nav a, .social_networks li a, #currency-switcher #selected-currency, #currency-switcher-list li',
                                'property'	=>	'color',
                                'value'		=> 	$theme_header_text_color
                            ),
                            //Header Link Hover color
                            array(
                                'elements'	=>	'#contact-email a:hover, .user-nav a:hover',
                                'property'	=>	'color',
                                'value'		=> 	$theme_header_link_hover_color
                            ),
                            //Header Border color
                            array(
                                'elements'	=>	'#header-top, .social_networks li a, .user-nav a, .header-wrapper .social_networks, #currency-switcher #selected-currency, #currency-switcher-list li',
                                'property'	=>	'border-color',
                                'value'		=> 	$theme_header_border_color
                            ),
                            //Drop Down Menu Text color
                            array(
                                'elements'	=>	'.main-menu ul li a',
                                'property'	=>	'color',
                                'value'		=> 	$theme_main_menu_text_color
                            ),
                            //Drop Down Menu background color
                            array(
                                'elements'	=>	'.main-menu ul li.current-menu-ancestor > a, .main-menu ul li.current-menu-parent > a, .main-menu ul li.current-menu-item > a, .main-menu ul li.current_page_item > a, .main-menu ul li:hover > a, .main-menu ul li ul, .main-menu ul li ul li ul',
                                'property'	=>	'background-color',
                                'value'		=> 	$theme_menu_bg_color
                            ),
                            //Drop Down Menu Text color
                            array(
                                'elements'	=>	'.main-menu ul li.current-menu-ancestor > a, .main-menu ul li.current-menu-parent > a, .main-menu ul li.current-menu-item > a, .main-menu ul li.current_page_item > a, .main-menu ul li:hover > a, .main-menu ul li ul, .main-menu ul li ul li a, .main-menu ul li ul li ul, .main-menu ul li ul li ul li a',
                                'property'	=>	'color',
                                'value'		=> 	$theme_menu_text_color
                            ),
                            //Drop Down Menu hover background color
                            array(
                                'elements'	=>	'.main-menu ul li ul li:hover > a, .main-menu ul li ul li ul li:hover > a',
                                'property'	=>	'background-color',
                                'value'		=> 	$theme_menu_hover_bg_color
                            ),
                            // Slide
                            array(
                                'elements'	=>	'.slide-description h3, .slide-description h3 a',
                                'property'	=>	'color',
                                'value'		=> 	$theme_slide_title_color
                            ),
                            array(
                                'elements'	=>	'.slide-description h3 a:hover, .slide-description h3 a:focus, .slide-description h3 a:active',
                                'property'	=>	'color',
                                'value'		=> 	$theme_slide_title_hover_color
                            ),
                            array(
                                'elements'	=>	'.slide-description p',
                                'property'	=>	'color',
                                'value'		=> 	$theme_slide_desc_text_color
                            ),
                            array(
                                'elements'	=>	'.slide-description span',
                                'property'	=>	'color',
                                'value'		=> 	$theme_slide_price_color
                            ),
                            array(
                                'elements'	=>	'.slide-description .know-more',
                                'property'	=>	'color',
                                'value'		=> 	$theme_slide_know_more_text_color
                            ),
                            array(
                                'elements'	=>	'.slide-description .know-more',
                                'property'	=>	'background-color',
                                'value'		=> 	$theme_slide_know_more_bg_color
                            ),
                            array(
                                'elements'	=>	'.slide-description .know-more:hover',
                                'property'	=>	'background-color',
                                'value'		=> 	$theme_slide_know_more_hover_bg_color
                            ),
					        // Search Form Over Image
					        array(
						        'elements'	=>	'.SFOI__content',
						        'property'	=>	'margin-top',
						        'value'		=> 	$inspiry_SFOI_top_margin . 'px',
					        ),
	                        array(
						        'elements'	=>	'.SFOI__title',
						        'property'	=>	'color',
						        'value'		=> 	$inspiry_SFOI_title_color,
					        ),
					        array(
						        'elements'	=>	'.SFOI__description',
						        'property'	=>	'color',
						        'value'		=> 	$inspiry_SFOI_description_color,
					        ),
                            //property item
                            array(
                                'elements'	=>	'.property-item',
                                'property'	=>	'background-color',
                                'value'		=> 	$theme_property_item_bg_color
                            ),
                            array(
                                'elements'	=>	'.property-item, .property-item .property-meta, .property-item .property-meta span',
                                'property'	=>	'border-color',
                                'value'		=> 	$theme_property_item_border_color
                            ),
                            array(
                                'elements'	=>	'.property-item h4, .property-item h4 a, .es-carousel-wrapper ul li h4 a',
                                'property'	=>	'color',
                                'value'		=> 	$theme_property_title_color
                            ),
                            array(
                                'elements'	=>	'.property-item h4 a:hover, .property-item h4 a:focus, .property-item h4 a:active, .es-carousel-wrapper ul li h4 a:hover, .es-carousel-wrapper ul li h4 a:focus, .es-carousel-wrapper ul li h4 a:active',
                                'property'	=>	'color',
                                'value'		=> 	$theme_property_title_hover_color
                            ),
                            array(
                                'elements'	=>	'.property-item .price, .es-carousel-wrapper ul li .price, .property-item .price small',
                                'property'	=>	'color',
                                'value'		=> 	$theme_property_price_text_color
                            ),
                            array(
                                'elements'	=>	'.property-item .price, .es-carousel-wrapper ul li .price',
                                'property'	=>	'background-color',
                                'value'		=> 	$theme_property_price_bg_color
                            ),
                            array(
                                'elements'	=>	'.property-item figure figcaption',
                                'property'	=>	'color',
                                'value'		=> 	$theme_property_status_text_color
                            ),
                            array(
                                'elements'	=>	'.property-item figure figcaption',
                                'property'	=>	'background-color',
                                'value'		=> 	$theme_property_status_bg_color
                            ),
                            array(
                                'elements'	=>	'.property-item p, .es-carousel-wrapper ul li p',
                                'property'	=>	'color',
                                'value'		=> 	$theme_property_desc_text_color
                            ),
                            array(
                                'elements'	=>	'.more-details, .es-carousel-wrapper ul li p a',
                                'property'	=>	'color',
                                'value'		=> 	$theme_more_details_text_color
                            ),
                            array(
                                'elements'	=>	'.more-details:hover, .more-details:focus, .more-details:active, .es-carousel-wrapper ul li p a:hover, .es-carousel-wrapper ul li p a:focus, .es-carousel-wrapper ul li p a:active',
                                'property'	=>	'color',
                                'value'		=> 	$theme_more_details_text_hover_color
                            ),
                            array(
                                'elements'	=>	'.property-item .property-meta span',
                                'property'	=>	'color',
                                'value'		=> 	$theme_property_meta_text_color
                            ),
                            array(
                                'elements'	=>	'.property-item .property-meta',
                                'property'	=>	'background-color',
                                'value'		=> 	$theme_property_meta_bg_color
                            ),
                            array(
                                'elements'	=>	'#footer .widget .title',
                                'property'	=>	'color',
                                'value'		=> 	$theme_footer_widget_title_color
                            ),
                            array(
                                'elements'	=>	'#footer .widget .textwidget, #footer .widget, #footer-bottom p',
                                'property'	=>	'color',
                                'value'		=> 	$theme_footer_widget_text_color
                            ),
                            array(
                                'elements'	=>	'#footer .widget ul li a, #footer .widget a, #footer-bottom a',
                                'property'	=>	'color',
                                'value'		=> 	$theme_footer_widget_link_color
                            ),
                            array(
                                'elements'	=>	'#footer .widget ul li a:hover, #footer .widget ul li a:focus, #footer.widget ul li a:active, #footer .widget a:hover, #footer .widget a:focus, #footer .widget a:active, #footer-bottom a:hover, #footer-bottom a:focus, #footer-bottom a:active',
                                'property'	=>	'color',
                                'value'		=> 	$theme_footer_widget_link_hover_color
                            ),
                            array(
                                'elements'	=>	'#footer-bottom',
                                'property'	=>	'border-color',
                                'value'		=> 	$theme_footer_border_color
                            ),
                            //button
                            array(
                                'elements'	=>	'.real-btn',
                                'property'	=>	'color',
                                'value'		=> 	$theme_button_text_color
                            ),
                            array(
                                'elements'	=>	'.real-btn',
                                'property'	=>	'background-color',
                                'value'		=> 	$theme_button_bg_color
                            ),
                            array(
                                'elements'	=>	'.real-btn:hover, .real-btn.current',
                                'property'	=>	'color',
                                'value'		=> 	$theme_button_hover_text_color
                            ),
                            array(
                                'elements'	=>	'.real-btn:hover, .real-btn.current',
                                'property'	=>	'background-color',
                                'value'		=> 	$theme_button_hover_bg_color
                            ),
                            array(
                                'elements'	=>	'#scroll-top',
                                'property'	=>	'background-color',
                                'value'		=> 	$inspiry_back_to_top_bg_color
                            ),
                            array(
                                'elements'	=>	'#scroll-top:hover',
                                'property'	=>	'background-color',
                                'value'		=> 	$inspiry_back_to_top_bg_hover_color
                            ),
                            array(
                                'elements'	=>	'#scroll-top',
                                'property'	=>	'color',
                                'value'		=> 	$inspiry_back_to_top_color
                            ),

                        );

	    /*
		 * Primary Heading Font
		 */
	    $inspiry_heading_font = get_option( 'inspiry_heading_font', 'Default' );
	    if ( 'Default' != $inspiry_heading_font ) {
		    $dynamic_css[] = array(
			    'elements' => '
			                    h1, h2, h3, h4, h5, h6,
			                    .inner-wrapper .hentry p.info,
			                    .inner-wrapper .hentry p.tip,
			                    .inner-wrapper .hentry p.success,
			                    .inner-wrapper .hentry p.error,
			                    .main-menu ul li a,
			                    #overview .share-label,
								#overview .common-label,
								#overview .video-label,
								#overview .attachments-label,
								#overview .map-label,
								#overview .floor-plans .floor-plans-label,
			                    #dsidx-listings .dsidx-address a,
			                    #dsidx-listings .dsidx-price,
			                    #dsidx-listings .dsidx-listing-container .dsidx-listing .dsidx-primary-data .dsidx-address a,
			                    .inspiry-social-login .wp-social-login-connect-with ',
			    'property' => 'font-family',
			    'value'    => $inspiry_heading_font,
		    );
	    }

	    /*
	     * Secondary Heading Font
	     */
	    $inspiry_secondary_font = get_option( 'inspiry_secondary_font', 'Default' );
	    if ( 'Default' != $inspiry_secondary_font ) {
		    $dynamic_css[] = array(
			    'elements' => '
			                    .real-btn, .btn-blue, .btn-grey, .sidebar .widget .dsidx-widget .submit,
			                    input[type="number"], input[type="date"], input[type="tel"], input[type="url"], input[type="email"], input[type="text"], input[type="password"], textarea,
			                    .selectwrap,
			                    .more-details,
			                    .slide-description span, .slide-description .know-more,
			                    .advance-search,
			                    .select2-container .select2-selection,
			                    .property-item h4, .property-item h4 a,
			                    .property-item .property-meta,
			                    .es-carousel-wrapper ul li h4, .es-carousel-wrapper ul li .property-item h4 a, .property-item h4 .es-carousel-wrapper ul li a, .es-carousel-wrapper ul li h4 a, .property-item h4 .es-carousel-wrapper ul li a a,
			                    .es-carousel-wrapper ul li .price,
			                    #footer .widget, #footer .widget .title,
			                    #footer-bottom,
			                    .widget, .widget .title, .widget ul li, .widget .enquiry-form .agent-form-title,
			                    #footer .widget ul.featured-properties li h4,
			                    #footer .widget ul.featured-properties li .property-item h4 a,
			                    .property-item h4 #footer .widget ul.featured-properties li a,
			                    #footer .widget ul.featured-properties li h4 a,
			                    .property-item h4 #footer .widget ul.featured-properties li a a,
								ul.featured-properties li h4,
								ul.featured-properties li .property-item h4 a,
								.property-item h4 ul.featured-properties li a,
								ul.featured-properties li h4 a,
								ul.featured-properties li .property-item h4 a a,
								.property-item h4 ul.featured-properties li a a,
			                    .page-head h1.page-title, .post-title, .post-title a,
			                    .post-meta, #comments-title, #contact-form #reply-title, #respond #reply-title, .form-heading, #contact-form, #respond,
			                    .contact-page, #overview, #overview .property-item .price,
			                    #overview .child-properties h3,
			                    #overview .agent-detail h3,
			                    .infoBox .prop-title a,
			                    .infoBox span.price,
			                    .detail .list-container h3,
			                    .about-agent .contact-types,
			                    .listing-layout h4, .listing-layout .property-item h4 a, .property-item h4 .listing-layout a,
			                    #filter-by,
			                    .gallery-item .item-title,
			                    .dsidx-results li.dsidx-prop-summary .dsidx-prop-title,
			                    #dsidx.dsidx-details #dsidx-actions,
			                    #dsidx.dsidx-details .dsidx-contact-form table label, #dsidx.dsidx-details .dsidx-contact-form table input[type=button],
			                    #dsidx-header table#dsidx-primary-data th, #dsidx-header table#dsidx-primary-data td
			                    .sidebar .widget .dsidx-slideshow .featured-listing h4, .sidebar .widget .dsidx-slideshow .featured-listing .property-item h4 a, .property-item h4 .sidebar .widget .dsidx-slideshow .featured-listing a,
			                    .sidebar .widget .dsidx-expanded .featured-listing h4, .sidebar .widget .dsidx-expanded .featured-listing .property-item h4 a, .property-item h4 .sidebar .widget .dsidx-expanded .featured-listing a,
			                    .sidebar .widget .dsidx-search-widget span.select-wrapper,
			                    .sidebar .widget .dsidx-search-widget .dsidx-search-button .submit,
			                    .sidebar .widget .dsidx-widget-single-listing h3.widget-title,
			                    .login-register .main-wrap h3,
			                    .login-register .info-text, .login-register input[type="text"], .login-register input[type="password"], .login-register label,
			                    .inspiry-social-login .wp-social-login-provider,
			                    .my-properties .main-wrap h3,
			                    .my-properties .alert-wrapper h5,
			                    .my-property .cell h5 ',
			    'property' => 'font-family',
			    'value'    => $inspiry_secondary_font,
		    );
	    }

	    /*
		 * Body Font
		 */
	    $inspiry_body_font = get_option( 'inspiry_body_font', 'Default' );
	    if ( 'Default' != $inspiry_body_font ) {
		    $dynamic_css[] = array(
			    'elements' => 'body',
			    'property' => 'font-family',
			    'value'    => $inspiry_body_font,
		    );
	    }

        if( $theme_disable_footer_bg == 'true' ){
            //Disable Footer Background Image
            $dynamic_css[] =  array(
                'elements'	=>	'#footer-wrapper',
                'property'	=>	'background-image',
                'value'		=> 	"none"
            );
            $dynamic_css[] =  array(
                'elements'	=>	'#footer-wrapper',
                'property'	=>	'padding-bottom',
                'value'		=> 	"0px"
            );
        }else{
            if(!empty($theme_footer_bg_img)){
                //Footer Background Image
                $dynamic_css[] =  array(
                    'elements'	=>	'#footer-wrapper',
                    'property'	=>	'background-image',
                    'value'		=> 	"url($theme_footer_bg_img)"
                );
            }
        }

        $dynamic_css_above_980px = array(
            //Phone Number background color
            array(
                'elements'	=>	'.contact-number, .contact-number .outer-strip',
                'property'	=>	'background-color',
                'value'		=> 	$theme_phone_bg_color
            ),
            //Phone Number background color
            array(
                'elements'	=>	'.contact-number',
                'property'	=>	'color',
                'value'		=> 	$theme_phone_text_color
            ),
            //Phone Icon background color
            array(
                'elements'	=>	'.contact-number .fa-phone',
                'property'	=>	'background-color',
                'value'		=> 	$theme_phone_icon_bg_color
            )
        );




        $prop_count = count($dynamic_css);

        if($prop_count > 0)
        {
            echo "<style type='text/css' id='dynamic-css'>\n\n";

            foreach($dynamic_css as $css_unit )
            {
                if(!empty($css_unit['value']))
                {
                    echo $css_unit['elements']."{\n";
                    echo $css_unit['property'].":".$css_unit['value'].";\n";
                    echo "}\n\n";
                }
            }

            /* CSS For min width 980px */
            echo "@media (min-width: 980px) {\n";
            foreach($dynamic_css_above_980px as $css_unit )
            {
                if(!empty($css_unit['value']))
                {
                    echo $css_unit['elements']."{\n";
                    echo $css_unit['property'].":".$css_unit['value'].";\n";
                    echo "}\n\n";
                }
            }
            echo "}\n";

            echo '</style>';
        }
    }
}

add_action('wp_head', 'generate_dynamic_css');