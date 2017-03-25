<?php
/**
 * BuddyPress - Users Plugins Template
 *
 * 3rd-party plugins should use this template to easily add template
 * support to their plugins for the members component.
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

		/**
		 * Fires at the start of the member plugin template.
		 *
		 * @since 1.2.0
		 */
		do_action( 'bp_before_member_plugin_template' ); ?>

		<?php if ( has_action( 'bp_template_title' ) ) : ?>
			<h3><?php

			/**
			 * Fires inside the member plugin template <h3> tag.
			 *
			 * @since 1.0.0
			 */
			do_action( 'bp_template_title' ); ?></h3>

		<?php endif; ?>

		<?php

		/**
		 * Fires and displays the member plugin template content.
		 *
		 * @since 1.0.0
		 */
		do_action( 'bp_template_content' ); ?>

		<?php

		/**
		 * Fires at the end of the member plugin template.
		 *
		 * @since 1.2.0
		 */
		do_action( 'bp_after_member_plugin_template' ); ?>