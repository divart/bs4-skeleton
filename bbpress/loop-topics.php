<?php

/**
 * Topics Loop
 *
 * @package bbPress
 * @subpackage Theme
 */

?>

<?php do_action( 'bbp_template_before_topics_loop' ); ?>
<table class="table table-bordered">
	<thead class="bbp-header thead-default">
		<tr class="forum-titles">
			<th class="bbp-topic-title"><?php _e( 'Topic', 'bs4' ); ?></th>
			<th class="bbp-topic-reply-count"><?php bbp_show_lead_topic() ? _e( 'Replies', 'bs4' ) : _e( 'Posts', 'bs4' ); ?></th>
			<th class="bbp-topic-freshness"><?php _e( 'Activity', 'bs4' ); ?></th>
			<th class="bbp-topic-last-user"><?php _e( 'Last Reply', 'bs4' ); ?></th>
			<th class="bbp-topic-creator"><?php _e( 'Creator', 'bs4' ); ?></th>
		</tr>
	</thead>
	<tbody class="bbp-body">

		<?php while ( bbp_topics() ) : bbp_the_topic(); ?>

			<?php bbp_get_template_part( 'loop', 'single-topic' ); ?>

		<?php endwhile; ?>

	</tbody>
</table>
<div class="bbp-footer">
	<div>
		<span class="<?php echo ( bbp_is_user_home() && ( bbp_is_favorites() || bbp_is_subscriptions() ) ) ? '5' : '4'; ?>">&nbsp;</span>
	</div>
</div>
<?php do_action( 'bbp_template_after_topics_loop' ); ?>
