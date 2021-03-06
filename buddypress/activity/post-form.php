<?php

/**
 * BuddyPress - Activity Post Form
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<form action="<?php bp_activity_post_form_action(); ?>" method="post" id="whats-new-form" class="cf" name="whats-new-form" role="complementary">

	<?php do_action( 'bp_before_activity_post_form' ); ?>

	<p class="activity-greeting cfc-h-tx"><?php if ( bp_is_group() )
		printf( __( "What's new in %s, %s?", '__x__' ), bp_get_group_name(), bp_get_user_firstname() );
	else
		printf( __( "What's new, %s?", '__x__' ), bp_get_user_firstname() );
	?></p>

	<div id="whats-new-content">
		<div id="whats-new-textarea">
			<textarea name="whats-new" id="whats-new" class="bp-suggestions" cols="50" rows="10"><?php if ( isset( $_GET['r'] ) ) : ?>@<?php echo esc_textarea( $_GET['r'] ); ?> <?php endif; ?></textarea>
		</div>

		<div id="whats-new-options">
			<div id="x-whats-new-options-inner" class="cf">
				<div id="whats-new-submit">
					<input type="submit" name="aw-whats-new-submit" id="aw-whats-new-submit" value="<?php bp_is_activity_directory() ? esc_attr_e( 'Post In', '__x__' ) : esc_attr_e( 'Post', '__x__' ); ?>" />
				</div>

				<?php if ( bp_is_active( 'groups' ) && !bp_is_my_profile() && !bp_is_group() ) : ?>

					<div id="whats-new-post-in-box">

						<select id="whats-new-post-in" name="whats-new-post-in">
							<option selected="selected" value="0"><?php _e( 'My Profile', 'buddypress' ); ?></option>

							<?php if ( bp_has_groups( 'user_id=' . bp_loggedin_user_id() . '&type=alphabetical&max=100&per_page=100&populate_extras=0&update_meta_cache=0' ) ) :
								while ( bp_groups() ) : bp_the_group(); ?>

									<option value="<?php bp_group_id(); ?>"><?php bp_group_name(); ?></option>

								<?php endwhile;
							endif; ?>

						</select>
					</div>
					<input type="hidden" id="whats-new-post-object" name="whats-new-post-object" value="groups" />

				<?php elseif ( bp_is_group_home() ) : ?>

					<input type="hidden" id="whats-new-post-object" name="whats-new-post-object" value="groups" />
					<input type="hidden" id="whats-new-post-in" name="whats-new-post-in" value="<?php bp_group_id(); ?>" />

				<?php endif; ?>

				<?php do_action( 'bp_activity_post_form_options' ); ?>

			</div><!-- #x-whats-new-options-inner -->
		</div><!-- #whats-new-options -->
	</div><!-- #whats-new-content -->

	<?php wp_nonce_field( 'post_update', '_wpnonce_post_update' ); ?>
	<?php do_action( 'bp_after_activity_post_form' ); ?>

</form><!-- #whats-new-form -->
