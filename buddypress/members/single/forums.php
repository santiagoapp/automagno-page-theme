<?php

/**
 * BuddyPress - Users Forums
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<div class="x-item-list-tabs-subnav item-list-tabs no-ajax" id="subnav" role="navigation">
	<ul>
		<?php bp_get_options_nav(); ?>

		<li id="forums-order-select" class="last filter">

			<label for="forums-order-by"><?php _e( 'Order By:', '__x__' ); ?></label>
			<select id="forums-order-by">
				<option value="active"><?php _e( 'Last Active', '__x__' ); ?></option>
				<option value="popular"><?php _e( 'Most Posts', '__x__' ); ?></option>
				<option value="unreplied"><?php _e( 'Unreplied', '__x__' ); ?></option>

				<?php do_action( 'bp_forums_directory_order_options' ); ?>

			</select>
		</li>
	</ul>
</div><!-- .item-list-tabs -->

<?php

if ( bp_is_current_action( 'favorites' ) ) :
	bp_get_template_part( 'members/single/forums/topics' );

else :
	do_action( 'bp_before_member_forums_content' ); ?>

	<div class="forums myforums">

		<?php bp_get_template_part( 'forums/forums-loop' ) ?>

	</div>

	<?php do_action( 'bp_after_member_forums_content' ); ?>

<?php endif; ?>
