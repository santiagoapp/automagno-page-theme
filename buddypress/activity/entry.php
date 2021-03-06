<?php

/**
 * BuddyPress - Activity Stream (Single Item)
 *
 * This template is used by activity-loop.php and AJAX functions to show
 * each activity.
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<?php do_action( 'bp_before_activity_entry' ); ?>

<li class="<?php bp_activity_css_class(); ?>" id="activity-<?php bp_activity_id(); ?>">

	<?php x_buddypress_activity_list_item_header(); ?>

	<div class="activity-content">

		<?php if ( bp_activity_has_content() ) : ?>

			<div class="activity-inner">

				<?php bp_activity_content_body(); ?>

			</div>

		<?php endif; ?>

		<?php do_action( 'bp_activity_entry_content' ); ?>

		<div class="x-list-item-meta activity-meta">
			<div class="x-list-item-meta-inner">

				<?php if ( bp_get_activity_type() == 'activity_comment' ) : ?>

					<a href="<?php bp_activity_thread_permalink(); ?>" class="view bp-secondary-action" title="<?php esc_attr_e( 'View Conversation', 'buddypress' ); ?>"><?php _e( 'View Conversation', '__x__' ); ?></a>

				<?php endif; ?>

				<?php if ( is_user_logged_in() ) : ?>

					<?php if ( bp_activity_can_comment() ) : ?>

						<a href="<?php bp_activity_comment_link(); ?>" class="acomment-reply bp-primary-action" id="acomment-comment-<?php bp_activity_id(); ?>"><?php printf( __( 'Comment <span class="x-bp-count">%s</span>', '__x__' ), bp_activity_get_comment_count() ); ?></a>

					<?php endif; ?>

					<?php if ( bp_activity_can_favorite() ) : ?>

						<?php if ( !bp_get_activity_is_favorite() ) : ?>

							<a href="<?php bp_activity_favorite_link(); ?>" class="fav bp-secondary-action" title="<?php esc_attr_e( 'Mark as Favorite', '__x__' ); ?>"><?php _e( 'Favorite', '__x__' ); ?></a>

						<?php else : ?>

							<a href="<?php bp_activity_unfavorite_link(); ?>" class="unfav bp-secondary-action" title="<?php esc_attr_e( 'Remove Favorite', '__x__' ); ?>"><?php _e( 'Remove Favorite', '__x__' ); ?></a>

						<?php endif; ?>

					<?php endif; ?>

					<?php if ( bp_activity_user_can_delete() ) bp_activity_delete_link(); ?>

					<?php do_action( 'bp_activity_entry_meta' ); ?>

				<?php endif; ?>

				<?php x_buddypress_logged_out_meta(); ?>

			</div>
		</div>
	</div>

	<?php do_action( 'bp_before_activity_entry_comments' ); ?>

	<?php if ( ( is_user_logged_in() && bp_activity_can_comment() ) || bp_is_single_activity() ) : ?>

		<div class="x-activity-comments-outer cf">
			<div class="activity-comments">

				<?php bp_activity_comments(); ?>

				<?php if ( is_user_logged_in() ) : ?>

					<form action="<?php bp_activity_comment_form_action(); ?>" method="post" id="ac-form-<?php bp_activity_id(); ?>" class="ac-form cf"<?php bp_activity_comment_form_nojs_display(); ?>>
						<div class="ac-reply-avatar"><?php bp_loggedin_user_avatar( 'width=' . BP_AVATAR_THUMB_WIDTH . '&height=' . BP_AVATAR_THUMB_HEIGHT ); ?></div>
						<div class="ac-reply-content cf">
							<div class="ac-textarea">
								<textarea id="ac-input-<?php bp_activity_id(); ?>" class="ac-input bp-suggestions" name="ac_input_<?php bp_activity_id(); ?>"></textarea>
							</div>
							<input type="submit" name="ac_form_submit" value="<?php esc_attr_e( 'Post', '__x__' ); ?>" /> &nbsp; <a href="#" class="ac-reply-cancel"><?php _e( 'Cancel', '__x__' ); ?></a>
							<input type="hidden" name="comment_form_id" value="<?php bp_activity_id(); ?>" />
						</div>

						<?php do_action( 'bp_activity_entry_comments' ); ?>

						<?php wp_nonce_field( 'new_activity_comment', '_wpnonce_new_activity_comment' ); ?>

					</form>

				<?php endif; ?>

			</div>
		</div>

	<?php endif; ?>

	<?php do_action( 'bp_after_activity_entry_comments' ); ?>

</li>

<?php do_action( 'bp_after_activity_entry' ); ?>
