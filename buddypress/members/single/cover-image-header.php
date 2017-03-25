<?php
/**
 * BuddyPress - Users Cover Image Header
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<?php

/**
 * Fires before the display of a member's header.
 *
 * @since 1.2.0
 */
do_action( 'bp_before_member_header' ); ?>

<div id="cover-image-container" class="card">
	<div class="card-block">
		<a id="header-cover-image" href="<?php bp_displayed_user_link(); ?>"></a>
		<div id="item-header-cover-image" class="row">
			<div class="col-sm-2">
				<div id="item-header-avatar">
					<a href="<?php bp_displayed_user_link(); ?>"><?php bp_displayed_user_avatar( 'type=full' ); ?></a>
				</div><!-- #item-header-avatar -->
			</div>

			<div class="col-sm-10">
				<div id="item-header-content">

					<?php if ( bp_is_active( 'activity' ) && bp_activity_do_mentions() ) : ?>
						<h1 class="user-nicename h3">@<?php bp_displayed_user_mentionname(); ?></h1>
					<?php endif; ?>

					<div id="item-buttons">
						<?php
						/**
						 * Fires in the member header actions section.
						 *
						 * @since 1.2.6
						 */
						do_action( 'bp_member_header_actions' );
						?>
					</div><!-- #item-buttons -->
					<span class="activity" data-livestamp="<?php bp_core_iso8601_date( bp_get_user_last_activity( bp_displayed_user_id() ) ); ?>">
						<?php bp_last_activity( bp_displayed_user_id() ); ?>
					</span>
					<?php
					/**
					 * Fires before the display of the member's header meta.
					 *
					 * @since 1.2.0
					 */
					do_action( 'bp_before_member_header_meta' ); ?>
					<div id="item-meta">

						<?php if ( bp_is_active( 'activity' ) ) : ?>

							<div id="latest-update"><?php bp_activity_latest_update( bp_displayed_user_id() ); ?></div>

						<?php endif; ?>

						<?php
						 /**
						  * Fires after the group header actions section.
						  *
						  * If you'd like to show specific profile fields here use:
						  * bp_member_profile_data( 'field=About Me' ); -- Pass the name of the field
						  *
						  * @since 1.2.0
						  */
						 do_action( 'bp_profile_header_meta' );
						 ?>
					</div><!-- #item-meta -->
				</div><!-- #item-header-content -->
			</div><!-- .col-sm-9 -->
		</div><!-- #item-header-cover-image -->
	</div>
	<div class="card-nav">
		<nav id="member-nav" class="navbar item-list-tabs" aria-label="<?php esc_attr_e( 'Member navigation', 'bs4' ); ?>">
			<ul class="nav nav-fill">
				<?php
				bs4_bp_get_displayed_user_nav();
				/**
				 * Fires after the display of member options navigation.
				 *
				 * @since 1.2.4
				 */
				do_action( 'bp_member_options_nav' );
				?>
			</ul>
		</nav>
	</div>
</div><!-- #cover-image-container -->

<?php

/**
 * Fires after the display of a member's header.
 *
 * @since 1.2.0
 */
do_action( 'bp_after_member_header' ); ?>

<div id="template-notices" role="alert" aria-atomic="true">
	<?php

	/** This action is documented in bp-templates/bp-legacy/buddypress/activity/index.php */
	do_action( 'template_notices' ); ?>

</div>
