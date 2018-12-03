<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 05/05/17
 * Time: 7:06 PM
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

            $prop_agent_id = intval( $agent );
            $prop_agent_email = get_post_meta( $prop_agent_id, 'fave_agent_email', true );

        endif;

    endforeach;

} elseif( $houzez_agent_display == 'agency_info' ) {

    $prop_agent_id = get_post_meta( get_the_ID(), 'fave_property_agency', true );
    $prop_agent_email = get_post_meta( $prop_agent_id, 'fave_agency_email', true );

} elseif( $houzez_agent_display == 'author_info' ) {

    $prop_agent_email = get_the_author_meta( 'email' );
}

$agent_email = is_email($prop_agent_email);
$user_info = get_userdata(get_the_author_meta('ID'));
$user_role = implode(', ', $user_info->roles);
?>
<div id="schedule_tour" class="detail-contact detail-block target-block">
    <div class="detail-title">
        <h2 class="title-left"><?php esc_html_e('Schedule a Tour', 'houzez'); ?></h2>
    </div>
    <form method="post" action="#">
        <input type="hidden" name="schedule_contact_form_ajax"
               value="<?php echo wp_create_nonce('schedule-contact-form-nonce'); ?>"/>
        <input type="hidden" name="property_permalink"
               value="<?php echo esc_url(get_permalink($post->ID)); ?>"/>
        <input type="hidden" name="property_title"
               value="<?php echo esc_attr(get_the_title($post->ID)); ?>"/>
        <input type="hidden" name="action" value="houzez_schedule_send_message">

        <input type="hidden" name="target_email" value="<?php echo antispambot($agent_email); ?>">

        <div class="row">
            <div class="col-sm-6 col-xs-12">
                <div class="form-group">
                    <label><?php esc_html_e('Date', 'houzez'); ?></label>
                    <input name="schedule_date" class="form-control input_date" placeholder="<?php esc_html_e('Select tour date', 'houzez'); ?>" type="text">
                </div>
            </div>
            <div class="col-sm-6 col-xs-12">
                <div class="form-group">
                    <label><?php esc_html_e('Time', 'houzez'); ?></label>
                    <select name="schedule_time" class="selectpicker">
                        <option value="12:00 am">12:00 AM</option>
                        <option value="12:15 am">12:15 AM</option>
                        <option value="12:30 am">12:30 AM</option>
                        <option value="12:45 am">12:45 AM</option>
                        <option value="01:00 am">01:00 AM</option>
                        <option value="01:15 am">01:15 AM</option><option value="01:30 am">01:30 AM</option><option value="01:45 am">01:45 AM</option><option value="02:00 am">02:00 AM</option><option value="02:15 am">02:15 AM</option><option value="02:30 am">02:30 AM</option><option value="02:45 am">02:45 AM</option><option value="03:00 am">03:00 AM</option><option value="03:15 am">03:15 AM</option><option value="03:30 am">03:30 AM</option><option value="03:45 am">03:45 AM</option><option value="04:00 am">04:00 AM</option><option value="04:15 am">04:15 AM</option><option value="04:30 am">04:30 AM</option><option value="04:45 am">04:45 AM</option><option value="05:00 am">05:00 AM</option><option value="05:15 am">05:15 AM</option><option value="05:30 am">05:30 AM</option><option value="05:45 am">05:45 AM</option><option value="06:00 am">06:00 AM</option><option value="06:15 am">06:15 AM</option><option value="06:30 am">06:30 AM</option><option value="06:45 am">06:45 AM</option><option value="07:00 am">07:00 AM</option><option value="07:15 am">07:15 AM</option><option value="07:30 am">07:30 AM</option><option value="07:45 am">07:45 AM</option><option value="08:00 am">08:00 AM</option><option value="08:15 am">08:15 AM</option><option value="08:30 am">08:30 AM</option><option value="08:45 am">08:45 AM</option><option value="09:00 am">09:00 AM</option><option value="09:15 am">09:15 AM</option><option value="09:30 am">09:30 AM</option><option value="09:45 am">09:45 AM</option><option value="10:00 am">10:00 AM</option><option value="10:15 am">10:15 AM</option><option value="10:30 am">10:30 AM</option><option value="10:45 am">10:45 AM</option><option value="11:00 am">11:00 AM</option><option value="11:15 am">11:15 AM</option><option value="11:30 am">11:30 AM</option><option value="11:45 am">11:45 AM</option><option value="12:00 pm">12:00 PM</option><option value="12:15 pm">12:15 PM</option><option value="12:30 pm">12:30 PM</option><option value="12:45 pm">12:45 PM</option><option value="01:00 pm">01:00 PM</option><option value="01:15 pm">01:15 PM</option><option value="01:30 pm">01:30 PM</option><option value="01:45 pm">01:45 PM</option><option value="02:00 pm">02:00 PM</option><option value="02:15 pm">02:15 PM</option><option value="02:30 pm">02:30 PM</option><option value="02:45 pm">02:45 PM</option><option value="03:00 pm">03:00 PM</option><option value="03:15 pm">03:15 PM</option><option value="03:30 pm">03:30 PM</option><option value="03:45 pm">03:45 PM</option><option value="04:00 pm">04:00 PM</option><option value="04:15 pm">04:15 PM</option><option value="04:30 pm">04:30 PM</option><option value="04:45 pm">04:45 PM</option><option value="05:00 pm">05:00 PM</option><option value="05:15 pm">05:15 PM</option><option value="05:30 pm">05:30 PM</option><option value="05:45 pm">05:45 PM</option><option value="06:00 pm">06:00 PM</option><option value="06:15 pm">06:15 PM</option><option value="06:30 pm">06:30 PM</option><option value="06:45 pm">06:45 PM</option><option value="07:00 pm">07:00 PM</option><option value="07:15 pm">07:15 PM</option><option value="07:30 pm">07:30 PM</option><option value="07:45 pm">07:45 PM</option><option value="08:00 pm">08:00 PM</option><option value="08:15 pm">08:15 PM</option><option value="08:30 pm">08:30 PM</option><option value="08:45 pm">08:45 PM</option><option value="09:00 pm">09:00 PM</option><option value="09:15 pm">09:15 PM</option><option value="09:30 pm">09:30 PM</option><option value="09:45 pm">09:45 PM</option><option value="10:00 pm">10:00 PM</option><option value="10:15 pm">10:15 PM</option><option value="10:30 pm">10:30 PM</option><option value="10:45 pm">10:45 PM</option><option value="11:00 pm">11:00 PM</option><option value="11:15 pm">11:15 PM</option><option value="11:30 pm">11:30 PM</option><option value="11:45 pm">11:45 PM</option></select>
                </div>
            </div>
        </div>

        <div class="detail-title-inner">
            <h4 class="title-inner"><?php esc_html_e('Your information', 'houzez'); ?></h4>
        </div>

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
                    <textarea class="form-control" name="message" rows="5" placeholder="<?php esc_html_e('Message', 'houzez'); ?>"></textarea>
                </div>
            </div>
        </div>
        <button class="schedule_contact_form btn btn-secondary"><?php esc_html_e('Submit', 'houzez'); ?></button>
        <div class="form_messages"></div>
    </form>
</div><!-- #schedule_tour -->
