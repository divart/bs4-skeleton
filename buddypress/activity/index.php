<?php
/**
 * BuddyPress Activity templates
 *
 * @since 2.3.0
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

/**
 * Fires before the activity directory listing.
 *
 * @since 1.5.0
 */
do_action( 'bp_before_directory_activity' ); ?>

<div id="buddypress">

	<?php

	/**
	 * Fires before the activity directory display content.
	 *
	 * @since 1.2.0
	 */
	do_action( 'bp_before_directory_activity_content' ); ?>

	<?php if ( is_user_logged_in() ) : ?>

		<?php bp_get_template_part( 'forms/activity-post-form' ); ?>

	<?php endif; ?>

	<div id="template-notices" role="alert" aria-atomic="true">
		<?php

		/**
		 * Fires towards the top of template pages for notice display.
		 *
		 * @since 1.0.0
		 */
		do_action( 'template_notices' ); ?>

	</div>

	<nav class="navbar navbar-toggleable-md item-list-tabs activity-tabs">
		<ul class="nav nav-pills mr-auto">
			<?php
			/**
			 * Fires before the listing of activity type tabs.
			 *
			 * @since 1.2.0
			 */
			do_action( 'bp_before_activity_type_tab_all' ); ?>
			<li class="nav-item selected" id="activity-all">
				<a href="<?php bp_activity_directory_permalink(); ?>" class="nav-link">
					<?php printf( __( 'All Members %s', 'buddypress' ), '<span>' . bp_get_total_member_count() . '</span>' ); ?>
				</a>
			</li>

			<?php if ( is_user_logged_in() ) : ?>

				<?php
				/**
				 * Fires before the listing of friends activity type tab.
				 *
				 * @since 1.2.0
				 */
				do_action( 'bp_before_activity_type_tab_friends' ); ?>

				<?php if ( bp_is_active( 'friends' ) ) : ?>

					<?php if ( bp_get_total_friend_count( bp_loggedin_user_id() ) ) : ?>

						<li id="activity-friends" class="nav-item">
							<a href="<?php echo bp_loggedin_user_domain() . bp_get_activity_slug() . '/' . bp_get_friends_slug() . '/'; ?>" class="nav-link">
								<?php printf( __( 'My Friends %s', 'buddypress' ), '<span>' . bp_get_total_friend_count( bp_loggedin_user_id() ) . '</span>' ); ?>
							</a>
						</li>

					<?php endif; ?>

				<?php endif; ?>

				<?php
				/**
				 * Fires before the listing of groups activity type tab.
				 *
				 * @since 1.2.0
				 */
				do_action( 'bp_before_activity_type_tab_groups' ); ?>

				<?php if ( bp_is_active( 'groups' ) ) : ?>

					<?php if ( bp_get_total_group_count_for_user( bp_loggedin_user_id() ) ) : ?>

						<li id="activity-groups" class="nav-item">
							<a href="<?php echo bp_loggedin_user_domain() . bp_get_activity_slug() . '/' . bp_get_groups_slug() . '/'; ?>" class="nav-link">
								<?php printf( __( 'My Groups %s', 'buddypress' ), '<span>' . bp_get_total_group_count_for_user( bp_loggedin_user_id() ) . '</span>' ); ?>
							</a>
						</li>

					<?php endif; ?>

				<?php endif; ?>

				<?php
				/**
				 * Fires before the listing of favorites activity type tab.
				 *
				 * @since 1.2.0
				 */
				do_action( 'bp_before_activity_type_tab_favorites' ); ?>

				<?php if ( bp_get_total_favorite_count_for_user( bp_loggedin_user_id() ) ) : ?>

					<li id="activity-favorites" class="nav-item">
						<a href="<?php echo bp_loggedin_user_domain() . bp_get_activity_slug() . '/favorites/'; ?>" class="nav-link">
							<?php printf( __( 'My Favorites %s', 'buddypress' ), '<span>' . bp_get_total_favorite_count_for_user( bp_loggedin_user_id() ) . '</span>' ); ?>
						</a>
					</li>

				<?php endif; ?>

				<?php if ( bp_activity_do_mentions() ) : ?>

					<?php
					/**
					 * Fires before the listing of mentions activity type tab.
					 *
					 * @since 1.2.0
					 */
					do_action( 'bp_before_activity_type_tab_mentions' ); ?>
					<li id="nav-item activity-mentions" class="nav-item">
						<a href="<?php echo bp_loggedin_user_domain() . bp_get_activity_slug() . '/mentions/'; ?>" class="nav-link"><?php _e( 'Mentions', 'buddypress' ); ?>

							<?php if ( bp_get_total_mention_count_for_user( bp_loggedin_user_id() ) ) : ?>

								<strong>
									<span>
										<?php printf( _nx( '%s new', '%s new', bp_get_total_mention_count_for_user( bp_loggedin_user_id() ), 'Number of new activity mentions', 'buddypress' ), bp_get_total_mention_count_for_user( bp_loggedin_user_id() ) ); ?>
									</span>
								</strong>

							<?php endif; ?>

						</a>
					</li>

				<?php endif; ?>

			<?php endif; ?>

			<?php
			/**
			 * Fires after the listing of activity type tabs.
			 *
			 * @since 1.2.0
			 */
			do_action( 'bp_activity_type_tabs' ); ?>
		</ul>
		<?php
		/**
		 * Fires before the display of the activity syndication options.
		 *
		 * @since 1.2.0
		 */
		do_action( 'bp_activity_syndication_options' ); ?>
		<form id="activity-filter-select" class="form-inline">
			<label for="activity-filter-by" class="screen-reader-text"><?php _e( 'Show:', 'buddypress' ); ?></label>
			<select id="activity-filter-by" class="form-control">
				<option value="-1"><?php _e( 'Everything', 'bs4' ); ?></option>
				<?php bp_activity_show_filters(); ?>
				<?php
				/**
				 * Fires inside the select input for activity filter by options.
				 *
				 * @since 1.2.0
				 */
				do_action( 'bp_activity_filter_options' ); ?>
			</select>
		</form>
	</nav><!-- .item-list-tabs -->

	<?php

	/**
	 * Fires before the display of the activity list.
	 *
	 * @since 1.5.0
	 */
	do_action( 'bp_before_directory_activity_list' ); ?>

	<div class="activity" aria-live="polite" aria-atomic="true" aria-relevant="all">

		<?php bp_get_template_part( 'activity/activity-loop' ); ?>

	</div><!-- .activity -->

	<?php

	/**
	 * Fires after the display of the activity list.
	 *
	 * @since 1.5.0
	 */
	do_action( 'bp_after_directory_activity_list' ); ?>

	<?php

	/**
	 * Fires inside and displays the activity directory display content.
	 */
	do_action( 'bp_directory_activity_content' ); ?>

	<?php

	/**
	 * Fires after the activity directory display content.
	 *
	 * @since 1.2.0
	 */
	do_action( 'bp_after_directory_activity_content' ); ?>

	<?php

	/**
	 * Fires after the activity directory listing.
	 *
	 * @since 1.5.0
	 */
	do_action( 'bp_after_directory_activity' ); ?>

</div>
