<?php
/**
 * Functions to process contact forms in this theme
 *
 */


if( !function_exists( 'inspiry_mail_from_name' ) ) :
	/**
	 * Override 'WordPress' as from name in emails sent by wp_mail function
	 * @return string
	 */
    function inspiry_mail_from_name() {
	    // The blogname option is escaped with esc_html on the way into the database in sanitize_option
	    // we want to reverse this for the plain text arena of emails.
	    $blogname = wp_specialchars_decode( get_option( 'blogname' ), ENT_QUOTES );

	    return $blogname;
    }
	add_filter( 'wp_mail_from_name', 'inspiry_mail_from_name' );
endif;


if ( ! function_exists( 'inspiry_send_messages' ) ) {
	/**
	 * Handler for Contact form on contact page template
	 */
	function inspiry_send_messages() {

		if ( isset( $_POST[ 'email' ] ) ):

			/*
			 * Verify Nonce
			 */
			if ( ! isset( $_POST[ 'nonce' ] ) || ! wp_verify_nonce( $_POST[ 'nonce' ], 'send_message_nonce' ) ) {
				echo json_encode( array(
					'success' => false,
					'message' => __( 'Unverified Nonce!', 'framework' )
				) );
				die;
			}

			/*
			 * Verify Recaptcha
			 */
			$show_reCAPTCHA = get_option( 'theme_show_reCAPTCHA' );
			$reCAPTCHA_public_key = get_option( 'theme_recaptcha_public_key' );
			$reCAPTCHA_private_key = get_option( 'theme_recaptcha_private_key' );

			if ( ! empty( $reCAPTCHA_public_key ) && ! empty( $reCAPTCHA_private_key ) && $show_reCAPTCHA == 'true' ) {
				/* Include recaptcha library */
				require_once( get_template_directory() . '/recaptcha/recaptchalib.php' );
				$resp = recaptcha_check_answer( $reCAPTCHA_private_key,
					$_SERVER[ "REMOTE_ADDR" ],
					$_POST[ "recaptcha_challenge_field" ],
					$_POST[ "recaptcha_response_field" ] );

				if ( ! $resp->is_valid ) {
					/* What happens when the CAPTCHA was entered incorrectly */
					echo json_encode( array(
						'success' => false,
						'message' => __( 'The reCAPTCHA is not correct. Please try again.', 'framework' )
					) );
					die;
				}
			}

			/*
			 * Sanitize and Validate Target email address that will be configured from theme options
			 */
			$to_email = sanitize_email( get_option( 'theme_contact_email' ) );
			$to_email = is_email( $to_email );
			if ( ! $to_email ) {
				echo json_encode( array(
					'success' => false,
					'message' => __( 'Target Email address is not properly configured!', 'framework' )
				) );
				die;
			}

			/*
			 * Sanitize and Validate contact form input data
			 */
			$from_name = sanitize_text_field( $_POST[ 'name' ] );
			$phone_number = sanitize_text_field( $_POST[ 'number' ] );
			$message = stripslashes( $_POST[ 'message' ] );
			$from_email = sanitize_email( $_POST[ 'email' ] );
			$from_email = is_email( $from_email );
			if ( ! $from_email ) {
				echo json_encode( array(
					'success' => false,
					'message' => __( 'Provided Email address is invalid!', 'framework' )
				) );
				die;
			}

			/*
			 * Email Subject
			 */
			$email_subject = __( 'New message sent by', 'framework' ) . ' ' . $from_name . ' ' . __( 'using contact form at', 'framework' ) . ' ' . get_bloginfo( 'name' );

			/*
			 * Email Body
			 */
			$email_body = __( "You have received a message from: ", 'framework' ) . $from_name . " <br/>";
			if ( ! empty( $phone_number ) ) {
				$email_body .= __( "Phone Number : ", 'framework' ) . $phone_number . " <br/>";
			}
			$email_body .= __( "Their additional message is as follows.", 'framework' ) . " <br/>";
			$email_body .= wpautop( $message ) . " <br/>";
			$email_body .= __( "You can contact ", 'framework' ) . $from_name . __( " via email, ", 'framework' ) . $from_email;

			/*
			 * Email Headers ( Reply To and Content Type )
			 */
			$headers = array();

			/* Send CC of contact form message if configured */
			$cc_email = get_option( 'theme_contact_cc_email' );
			$cc_email = explode( ',', $cc_email );
			if ( ! empty( $cc_email ) ) {
				foreach ( $cc_email as $ind_email ) {
					$ind_email = sanitize_email( $ind_email );
					$ind_email = is_email( $ind_email );
					if ( $ind_email ) {
						$headers[] = "Cc: $ind_email";
					}
				}
			}

			/* Send BCC of contact form message if configured */
			$bcc_email = get_option( 'theme_contact_bcc_email' );
			$bcc_email = explode( ',', $bcc_email );
			if ( ! empty( $bcc_email ) ) {
				foreach ( $bcc_email as $ind_email ) {
					$ind_email = sanitize_email( $ind_email );
					$ind_email = is_email( $ind_email );
					if ( $ind_email ) {
						$headers[] = "Bcc: $ind_email";
					}
				}
			}

			$headers[] = "Reply-To: $from_name <$from_email>";
			$headers[] = "Content-Type: text/html; charset=UTF-8";
			$headers = apply_filters( "inspiry_contact_mail_header", $headers );    // just in case if you want to modify the header in child theme

			if ( wp_mail( $to_email, $email_subject, $email_body, $headers ) ) {
				echo json_encode( array(
					'success' => true,
					'message' => __( "Message Sent Successfully!", 'framework' )
				) );
			} else {
				echo json_encode( array(
						'success' => false,
						'message' => __( "Server Error: WordPress mail function failed!", 'framework' )
					)
				);
			}

		else:
			echo json_encode( array(
					'success' => false,
					'message' => __( "Invalid Request !", 'framework' )
				)
			);
		endif;

		die;

	}

	add_action( 'wp_ajax_nopriv_send_message', 'inspiry_send_messages' );
	add_action( 'wp_ajax_send_message', 'inspiry_send_messages' );

}


if ( ! function_exists( 'send_message_to_agent' ) ) {
	/**
	 * Handler for agent's contact form
	 */
	function send_message_to_agent() {
		if ( isset( $_POST[ 'email' ] ) ):

			/*
			 *  Verify Nonce
			 */
			$nonce = $_POST[ 'nonce' ];
			if ( ! wp_verify_nonce( $nonce, 'agent_message_nonce' ) ) {
				echo json_encode( array(
					'success' => false,
					'message' => __( 'Unverified Nonce!', 'framework' )
				) );
				die;
			}

			/* Skip recaptcha check if it is disabled */
			if ( !isset( $_POST[ 'inspiry_recaptcha' ] ) ) {
				$show_reCAPTCHA = get_option( 'theme_show_reCAPTCHA' );
				$reCAPTCHA_public_key = get_option( 'theme_recaptcha_public_key' );
				$reCAPTCHA_private_key = get_option( 'theme_recaptcha_private_key' );

				if ( ! empty( $reCAPTCHA_public_key ) && ! empty( $reCAPTCHA_private_key ) && $show_reCAPTCHA == 'true' ) {
					/* Include recaptcha library */
					require_once( get_template_directory() . '/recaptcha/recaptchalib.php' );
					$resp = recaptcha_check_answer( $reCAPTCHA_private_key,
						$_SERVER[ "REMOTE_ADDR" ],
						$_POST[ "recaptcha_challenge_field" ],
						$_POST[ "recaptcha_response_field" ] );

					if ( ! $resp->is_valid ) {
						/* What happens when the CAPTCHA was entered incorrectly */
						echo json_encode( array(
							'success' => false,
							'message' => __( 'The reCAPTCHA is not correct. Please try again.', 'framework' )
						) );
						die;
					}
				}
			}

			/* Sanitize and Validate Target email address that is coming from agent form */
			$to_email = sanitize_email( $_POST[ 'target' ] );
			$to_email = is_email( $to_email );
			if ( ! $to_email ) {
				echo json_encode( array(
					'success' => false,
					'message' => __( 'Target Email address is not properly configured!', 'framework' )
				) );
				die;
			}


			/* Sanitize and Validate contact form input data */
			$from_name = sanitize_text_field( $_POST[ 'name' ] );
			$from_phone = sanitize_text_field( $_POST[ 'phone' ] );
			$message = stripslashes( $_POST[ 'message' ] );

			/*
			 * Property title and URL
			 */
			if ( isset( $_POST[ 'property_title' ] ) ) {
				$property_title = sanitize_text_field( $_POST[ 'property_title' ] );
			}
			if ( isset( $_POST[ 'property_permalink' ] ) ) {
				$property_permalink = esc_url( $_POST[ 'property_permalink' ] );
			}

			/*
			 * From email
			 */
			$from_email = sanitize_email( $_POST[ 'email' ] );
			$from_email = is_email( $from_email );
			if ( ! $from_email ) {
				echo json_encode( array(
					'success' => false,
					'message' => __( 'Provided Email address is invalid!', 'framework' )
				) );
				die;
			}


			/*
			 * Email Subject
			 */
			$email_subject = __( 'New message sent by', 'framework' ) . ' ' . $from_name . ' ' . __( 'using agent contact form at', 'framework' ) . ' ' . get_bloginfo( 'name' );


			/*
			 * Email body
			 */
			$email_body = __( "You have received a message from: ", 'framework' ) . $from_name . " <br/>";
			if ( ! empty( $property_title ) ) {
				$email_body .= "<br/>" . __( "Property Title : ", 'framework' ) . $property_title . " <br/>";
			}
			if ( ! empty( $property_permalink ) ) {
				$email_body .= __( "Property URL : ", 'framework' ) . '<a href="' . $property_permalink . '">' . $property_permalink . "</a><br/>";
			}
			$email_body .= "<br/>" . __( "Their additional message is as follows.", 'framework' ) . " <br/>";
			$email_body .= wpautop( $message ) . " <br/>";
			$email_body .= __( "You can contact ", 'framework' ) . $from_name . __( " via email, ", 'framework' ) . $from_email;
			$email_body .= __( " or via contact number ", 'framework' ) . $from_phone;


			/*
			 * Email Headers ( Reply To and Content Type )
			 */
			$headers = array();
			$headers[] = "Reply-To: $from_name <$from_email>";
			$headers[] = "Content-Type: text/html; charset=UTF-8";
			$headers = apply_filters( "inspiry_agent_mail_header", $headers );    // just in case if you want to modify the header in child theme

			/* Send copy of message to admin if configured */
			$theme_send_message_copy = get_option( 'theme_send_message_copy' );
			if ( $theme_send_message_copy == 'true' ) {
				$cc_email = get_option( 'theme_message_copy_email' );
				$cc_email = explode( ',', $cc_email );
				if ( ! empty( $cc_email ) ) {
					foreach ( $cc_email as $ind_email ) {
						$ind_email = sanitize_email( $ind_email );
						$ind_email = is_email( $ind_email );
						if ( $ind_email ) {
							$headers[] = "Cc: $ind_email";
						}
					}
				}
			}

			if ( wp_mail( $to_email, $email_subject, $email_body, $headers ) ) {
				echo json_encode( array(
					'success' => true,
					'message' => __( "Message Sent Successfully!", 'framework' )
				) );
			} else {
				echo json_encode( array(
						'success' => false,
						'message' => __( "Server Error: WordPress mail function failed!", 'framework' )
					)
				);
			}

		else:
			echo json_encode( array(
					'success' => false,
					'message' => __( "Invalid Request !", 'framework' )
				)
			);
		endif;
		die;
	}

	add_action( 'wp_ajax_nopriv_send_message_to_agent', 'send_message_to_agent' );
	add_action( 'wp_ajax_send_message_to_agent', 'send_message_to_agent' );
}
