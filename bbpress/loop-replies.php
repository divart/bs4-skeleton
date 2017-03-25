<?php

/**
 * Replies Loop
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<?php do_action( 'bbp_template_before_replies_loop' ); ?>
<div id="topic-<?php bbp_topic_id(); ?>-replies" class="forums bbp-replies card">
	<div class="bbp-header card-block">
		<div class="bbp-reply-author"><?php  _e( 'Author',  'bs4' ); ?></div><!-- .bbp-reply-author -->
		<div class="bbp-reply-content">

			<?php if ( !bbp_show_lead_topic() ) : ?>

				<?php _e( 'Posts', 'bs4' ); ?>
				<?php bbp_topic_subscription_link(); ?>
				<?php bbp_user_favorites_link(); ?>

			<?php else : ?>

				<?php _e( 'Replies', 'bs4' ); ?>

			<?php endif; ?>

		</div><!-- .bbp-reply-content -->
	</div><!-- .bbp-header -->
	<div class="bbp-body card-block">

		<?php if ( bbp_thread_replies() ) : ?>

			<?php bbp_list_replies(); ?>

		<?php else : ?>

			<?php while ( bbp_replies() ) : bbp_the_reply(); ?>

				<?php bbp_get_template_part( 'loop', 'single-reply' ); ?>

			<?php endwhile; ?>

		<?php endif; ?>

	</div><!-- .bbp-body -->

	<div class="bbp-footer card-block">

		<div class="bbp-reply-author"><?php  _e( 'Author',  'bs4' ); ?></div>

		<div class="bbp-reply-content">

			<?php if ( !bbp_show_lead_topic() ) : ?>

				<?php _e( 'Posts', 'bs4' ); ?>

			<?php else : ?>

				<?php _e( 'Replies', 'bs4' ); ?>

			<?php endif; ?>

		</div><!-- .bbp-reply-content -->

	</div><!-- .bbp-footer -->

</div><!-- #topic-<?php bbp_topic_id(); ?>-replies -->

<?php do_action( 'bbp_template_after_replies_loop' ); ?>
