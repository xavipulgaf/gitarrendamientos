<?php
/**
 * Created by PhpStorm.
 * User: waqasriaz
 * Date: 08/12/16
 * Time: 8:11 PM
 */

global $wpdb, $userID;
$tabel = $wpdb->prefix . 'houzez_threads';
$message_query = "SELECT * FROM $tabel WHERE sender_id = $userID OR receiver_id = $userID ORDER BY seen ASC";
/* if ( isset( $_REQUEST['view'] ) && $_REQUEST['view'] == 'inbox' ) {
	$message_query = "SELECT * FROM $tabel WHERE receiver_id = $userID ORDER BY id ASC";
} elseif ( isset( $_REQUEST['view'] ) && $_REQUEST['view'] == 'sent' ) {
	$message_query = "SELECT * FROM $tabel WHERE sender_id = $userID ORDER BY id ASC";
} */

$houzez_threads = $wpdb->get_results( $message_query );

?>
<div class="messages-area">
	<div class="msg-table-list">
		<table class="table all-msgs-list">
			<tr>
				<th><?php esc_html_e( 'From', 'houzez' ); ?></th>
				<th><?php esc_html_e( 'Last Message', 'houzez' ); ?></th>
				<th><?php esc_html_e( 'Date', 'houzez' ); ?></th>
			</tr>
			<?php if ( sizeof( $houzez_threads ) != 0 ) : foreach ( $houzez_threads as $thread ) { ?>

				<?php

				$thread_class = 'msg-unread';
				$tabel = $wpdb->prefix . 'houzez_thread_messages';
				$sender_id = $thread->sender_id;
				$thread_id = $thread->id;

				$last_message = $wpdb->get_row(
					"SELECT *
						FROM $tabel
						WHERE thread_id = $thread_id
						ORDER BY id DESC"
				);

				$user_custom_picture =  get_the_author_meta( 'fave_author_custom_picture' , $sender_id );
				$url_query = array( 'thread_id' => $thread_id, 'seen' => true );

				if ( $last_message->created_by == $userID || $thread->seen ) {
					$thread_class = '';
					unset( $url_query['seen'] );
				}

				if ( empty( $user_custom_picture )) {
					$user_custom_picture = get_template_directory_uri().'/images/profile-avatar.png';
				}

				$thread_link = houzez_get_template_link_2('template/user_dashboard_messages.php');
				$thread_link = add_query_arg( $url_query, $thread_link );

				$sender_first_name  =  get_the_author_meta( 'first_name', $sender_id );
				$sender_last_name  =  get_the_author_meta( 'last_name', $sender_id );
				$sender_display_name = get_the_author_meta( 'display_name', $sender_id );
				if( !empty($sender_first_name) && !empty($sender_last_name) ) {
					$sender_display_name = $sender_first_name.' '.$sender_last_name;
				}

				$last_sender_first_name  =  get_the_author_meta( 'first_name', $last_message->created_by );
				$last_sender_last_name  =  get_the_author_meta( 'last_name', $last_message->created_by );
				$last_sender_display_name = get_the_author_meta( 'display_name', $last_message->created_by );
				if( !empty($last_sender_first_name) && !empty($last_sender_last_name) ) {
					$last_sender_display_name = $last_sender_first_name.' '.$last_sender_last_name;
				}

				?>
				<tr class="<?php echo $thread_class; ?>">
					<td><a href="" class="msg-media"><img src="<?php echo esc_url( $user_custom_picture ); ?>" class="img-circle" alt="Image" width="30" height="30"> <?php echo ucfirst( $sender_display_name ); ?> </a></td>
					<td>
						<div class="msg-description">
							<a href="<?php echo esc_url( $thread_link ); ?>"> <b><?php echo get_the_title( $thread->property_id ); ?></b> </a>
							<a href="<?php echo esc_url( $thread_link ); ?>"> <?php echo ucfirst( $last_sender_display_name ); ?>: <?php echo $last_message->message; ?> </a>
						</div>
					</td>
					<td class="msg-date">
						<?php echo date_i18n( get_option('date_format').' '.get_option('time_format'), strtotime( $last_message->time ) ); ?>
					</td>
				</tr>
			<?php } endif; ?>
		</table>
	</div>
</div>