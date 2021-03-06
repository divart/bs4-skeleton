<?php

/**
 * User Topics Created
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

	<?php do_action( 'bbp_template_before_user_topics_created' ); ?>

	<div id="bbp-user-topics-started" class="bbp-user-topics-started">
		<h3 class="bp-member-tab-title"><?php _e( 'Forum Topics Started', 'bs4' ); ?></h3>
		<div class="bbp-user-section">

			<?php if ( bbp_get_user_topics_started() ) : ?>

				<?php bbp_get_template_part( 'pagination', 'topics' ); ?>

				<?php bbp_get_template_part( 'loop',       'topics' ); ?>

				<?php bbp_get_template_part( 'pagination', 'topics' ); ?>

			<?php else : ?>

				<p><?php bbp_is_user_home() ? _e( 'You have not created any topics.', 'bs4' ) : _e( 'This user has not created any topics.', 'bs4' ); ?></p>

			<?php endif; ?>

		</div>
	</div><!-- #bbp-user-topics-started -->

	<?php do_action( 'bbp_template_after_user_topics_created' ); ?>
