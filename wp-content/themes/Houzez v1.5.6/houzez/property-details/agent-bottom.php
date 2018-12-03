<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 21/01/16
 * Time: 7:20 PM
 */
global $post, $user_role;
$houzez_agent_display = get_post_meta( get_the_ID(), 'fave_agent_display_option', true );
$prop_agent_display = get_post_meta( get_the_ID(), 'fave_agents', true );
$enable_contact_form_7_prop_detail = houzez_option('enable_contact_form_7_prop_detail');
$contact_form_agent_bottom = houzez_option('contact_form_agent_bottom');
$enableDisable_agent_forms = houzez_option('agent_forms');
$enable_direct_messages = houzez_option('enable_direct_messages');
$is_single_agent = true;
$listing_agent = '';
$prop_agent_email = '';

$enable_reCaptcha = houzez_option('enable_reCaptcha');
$recaptha_site_key = houzez_option('recaptha_site_key');
$recaptha_secret_key = houzez_option('recaptha_secret_key');

if( $prop_agent_display != '-1' && $houzez_agent_display == 'agent_info' ) {

    $prop_agent_ids = get_post_meta( get_the_ID(), 'fave_agents' );
    $prop_agent_ids = array_filter( $prop_agent_ids, function($hz){
        return ( $hz > 0 );
    });

    $prop_agent_ids = array_unique( $prop_agent_ids );

    $agents_count = count( $prop_agent_ids );

    if ( $agents_count > 1 ) :
        $is_single_agent = false;
    endif;

    foreach ( $prop_agent_ids as $agent ) :

        if ( 0 < intval( $agent ) ) :

            $agent_args = array();
            $agent_args[ 'agent_id' ] = intval( $agent );
            $agent_args[ 'agent_name' ] = get_the_title( $agent_args[ 'agent_id' ] );
            $agent_args[ 'agent_mobile' ] = get_post_meta( $agent_args[ 'agent_id' ], 'fave_agent_mobile', true );
            $agent_args[ 'agent_mobile_call' ] = str_replace(array('(',')',' ','-'),'', $agent_args[ 'agent_mobile' ]);
            $agent_args[ 'agent_phone' ] = get_post_meta( $agent_args[ 'agent_id' ], 'fave_agent_office_num', true );
            $prop_agent_email = get_post_meta( $agent_args[ 'agent_id' ], 'fave_agent_email', true );
            $agent_args[ 'agent_email' ] = $prop_agent_email;
            $agent_args[ 'agent_skype' ] = get_post_meta( $agent_args[ 'agent_id' ], 'fave_agent_skype', true );
            $prop_agent_permalink = get_permalink($agent_args[ 'agent_id' ]);
            $agent_args[ 'link' ] = $prop_agent_permalink;
            $agent_args[ 'facebook' ] = get_post_meta( $agent_args[ 'agent_id' ], 'fave_agent_facebook', true );
            $agent_args[ 'twitter' ] = get_post_meta( $agent_args[ 'agent_id' ], 'fave_agent_twitter', true );
            $agent_args[ 'linkedin' ] = get_post_meta( $agent_args[ 'agent_id' ], 'fave_agent_linkedin', true );
            $agent_args[ 'googleplus' ] = get_post_meta( $agent_args[ 'agent_id' ], 'fave_agent_googleplus', true );
            $agent_args[ 'youtube' ] = get_post_meta( $agent_args[ 'agent_id' ], 'fave_agent_youtube', true );
            $thumb_id = get_post_thumbnail_id( $agent_args[ 'agent_id' ] );
            $thumb_url_array = wp_get_attachment_image_src( $thumb_id, 'thumbnail', true );
            $prop_agent_photo_url = $thumb_url_array[0];
            if( empty( $prop_agent_photo_url )) :
                $agent_args[ 'picture' ] = get_template_directory_uri().'/images/profile-avatar.png';
            else :
                $agent_args[ 'picture' ] = $prop_agent_photo_url;
            endif;
            $listing_agent .= houzez_get_agent_info_bottom( $agent_args, 'agent_form', $is_single_agent );

        endif;

    endforeach;

} elseif( $houzez_agent_display == 'agency_info' ) {

    $agent_args = array();
    $prop_agent_id = get_post_meta( get_the_ID(), 'fave_property_agency', true );
    $agent_args[ 'agent_id' ] = $prop_agent_id;
    $agent_args[ 'agent_phone' ] = get_post_meta( $prop_agent_id, 'fave_agency_phone', true );
    $prop_agent_mobile = get_post_meta( $prop_agent_id, 'fave_agency_mobile', true );
    $agent_args[ 'agent_mobile' ] = $prop_agent_mobile;
    $prop_agent_email = get_post_meta( $prop_agent_id, 'fave_agency_email', true );
    $agent_args[ 'agent_email' ] = $prop_agent_email;
    $agent_args[ 'agent_mobile_call' ] = str_replace(array('(',')',' ','-'),'', $prop_agent_mobile);
    $agent_args[ 'agent_name' ] = get_the_title( $prop_agent_id );
    $prop_agent_permalink = get_post_permalink( $prop_agent_id );
    $agent_args[ 'link' ] = $prop_agent_permalink;

    $agent_args[ 'agent_skype' ] = get_post_meta( $prop_agent_id, 'fave_agency_skype', true );
    $agent_args[ 'facebook' ] = get_post_meta( $prop_agent_id, 'fave_agency_facebook', true );
    $agent_args[ 'twitter' ] = get_post_meta( $prop_agent_id, 'fave_agency_twitter', true );
    $agent_args[ 'linkedin' ] = get_post_meta( $prop_agent_id, 'fave_agency_linkedin', true );
    $agent_args[ 'googleplus' ] = get_post_meta( $prop_agent_id, 'fave_agency_googleplus', true );
    $agent_args[ 'youtube' ] = get_post_meta( $prop_agent_id, 'fave_agency_youtube', true );

    $thumb_id = get_post_thumbnail_id( $prop_agent_id );
    $thumb_url_array = wp_get_attachment_image_src( $thumb_id, 'thumbnail', true );
    $prop_agent_photo_url = $thumb_url_array[0];

    if( empty( $prop_agent_photo_url )) :
        $agent_args[ 'picture' ] = get_template_directory_uri().'/images/profile-avatar.png';
    else :
        $agent_args[ 'picture' ] = $prop_agent_photo_url;
    endif;
    $listing_agent .= houzez_get_agent_info_bottom( $agent_args, 'agent_form', $is_single_agent );

} elseif( $houzez_agent_display == 'author_info' ) {

    $listing_agent = '';
    $author_args = array();
    $author_args[ 'agent_name' ] = get_the_author();
    $author_args[ 'agent_mobile' ] = get_the_author_meta( 'fave_author_mobile' );
    $author_args[ 'agent_mobile_call' ] = str_replace(array('(',')',' ','-'),'', get_the_author_meta( 'fave_author_mobile' ));
    $prop_agent_email = get_the_author_meta( 'email' );
    $author_args[ 'agent_email' ] = $prop_agent_email;
    $author_args[ 'agent_phone' ] = get_the_author_meta( 'fave_author_phone' );
    $author_args[ 'agent_skype' ] = get_the_author_meta( 'fave_author_skype' );
    $prop_agent_permalink = get_author_posts_url( get_the_author_meta( 'ID' ) );
    $author_args[ 'link' ] = $prop_agent_permalink;
    $author_args[ 'facebook' ] = get_the_author_meta( 'fave_author_facebook' );
    $author_args[ 'twitter' ] = get_the_author_meta( 'fave_author_twitter' );
    $author_args[ 'linkedin' ] = get_the_author_meta( 'fave_author_linkedin' );
    $author_args[ 'googleplus' ] = get_the_author_meta( 'fave_author_googleplus' );
    $author_args[ 'youtube' ] = get_the_author_meta( 'fave_author_youtube' );
    $prop_agent_photo_url = get_the_author_meta( 'fave_author_custom_picture' );
    if( empty( $prop_agent_photo_url )) {
        $author_args[ 'picture' ] = get_template_directory_uri().'/images/profile-avatar.png';
    } else {
        $author_args[ 'picture' ] = $prop_agent_photo_url;
    }
    $listing_agent .= houzez_get_agent_info_bottom( $author_args, 'agent_form', true );
}

$agent_email = is_email($prop_agent_email);
$user_info = get_userdata(get_the_author_meta('ID'));
$user_role = implode(', ', $user_info->roles);

if( $enableDisable_agent_forms != 0 && $houzez_agent_display != 'none') {
    ?>
    <div id="agent_bottom" class="detail-contact detail-block target-block">
        <div class="detail-title">
            <h2 class="title-left"><?php esc_html_e( 'Contact info', 'houzez' ); ?></h2>
            <?php if ( $is_single_agent == true ) : ?>
                <div class="title-right"><strong><a href="<?php echo esc_url($prop_agent_permalink); ?>"><?php esc_html_e( 'View my listing', 'houzez' ); ?></a></strong></div>
            <?php endif; ?>
        </div>

        <?php if( $enable_contact_form_7_prop_detail != 1 ) { ?>
        <form method="post" action="#">
        <?php } ?>

            <?php echo $listing_agent; ?>
            <div class="detail-title-inner">
                <h4 class="title-inner"><?php esc_html_e( 'Inquire about this property', 'houzez' ); ?></h4>
            </div>
            <?php
            if( $enable_contact_form_7_prop_detail != 1 ) {
            if( $is_single_agent == true && is_user_logged_in() && $enable_direct_messages != 0 ) {
                ?>
                <input type="hidden" name="start_thread_form_ajax"
                       value="<?php echo wp_create_nonce('start-thread-form-nonce'); ?>"/>
                <input type="hidden" name="property_id" value="<?php echo $post->ID; ?>"/>
                <input type="hidden" name="action" value="houzez_start_thread">
                <div class="form-group">
                   <textarea class="form-control" name="message" rows="5" placeholder="<?php esc_html_e('Description', 'houzez'); ?>"><?php esc_html_e("Hello, I am interested in", "houzez"); ?> [<?php echo get_the_title(); ?>]</textarea>
                </div>

                <button class="start_thread_form btn btn-secondary btn-block"><?php esc_html_e('Send Message', 'houzez'); ?></button>
                <div class="form_messages"></div>
                <?php
            } else {
            if ($agent_email) { ?>
            <?php if ($is_single_agent == true) : ?>
                <input type="hidden" name="target_email" value="<?php echo antispambot($agent_email); ?>">
            <?php endif; ?>
            <input type="hidden" name="agent_contact_form_ajax"
                   value="<?php echo wp_create_nonce('agent-contact-form-nonce'); ?>"/>
            <input type="hidden" name="property_permalink"
                   value="<?php echo esc_url(get_permalink($post->ID)); ?>"/>
            <input type="hidden" name="property_title"
                   value="<?php echo esc_attr(get_the_title($post->ID)); ?>"/>
            <input type="hidden" name="action" value="houzez_agent_send_message">

            <div class="row">
                <div class="col-sm-4 col-xs-12">
                    <div class="form-group">
                        <input class="form-control" name="name"
                               placeholder="<?php esc_html_e('Your Name', 'houzez'); ?>" type="text">
                    </div>
                </div>
                <div class="col-sm-4 col-xs-12">
                    <div class="form-group">
                        <input class="form-control" name="phone"
                               placeholder="<?php esc_html_e('Phone', 'houzez'); ?>" type="text">
                    </div>
                </div>
                <div class="col-sm-4 col-xs-12">
                    <div class="form-group">
                        <input class="form-control" name="email"
                               placeholder="<?php esc_html_e('Email', 'houzez'); ?>" type="email">
                    </div>
                </div>
                <div class="col-sm-12 col-xs-12">
                    <div class="form-group">
                    <textarea class="form-control" name="message" rows="5" placeholder="<?php esc_html_e('Message', 'houzez'); ?>"><?php esc_html_e("Hello, I am interested in", "houzez"); ?> [<?php echo get_the_title(); ?>]</textarea>
                    </div>
                </div>
                <?php if( $enable_reCaptcha != 0 && !empty($recaptha_site_key) && !empty($recaptha_secret_key) ) { ?>
                <div class="col-sm-12 col-xs-12">
                    <div class="form-group captcha_wrapper">
                        <div id="houzez_recaptcha2"></div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <button class="agent_contact_form btn btn-secondary"><?php esc_html_e('Request info', 'houzez'); ?></button>
            <?php if( $is_single_agent == true && $enable_direct_messages != 0 ) { ?>
            <button type="button" class="btn btn-secondary btn-trans" data-toggle="modal" data-target="#pop-login"> <?php esc_html_e('Send Direct Message', 'houzez'); ?></button>
            <?php } ?>
            <div class="form_messages"></div>
    <?php }
    }
    echo '</form>';
    } else {
        if( !empty($contact_form_agent_bottom) ) {
            echo do_shortcode($contact_form_agent_bottom);
        }
    }?>

    </div>
<?php } ?>