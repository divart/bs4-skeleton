<?php
/**
 * BuddyPress - Members Single Profile
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

/** This action is documented in bp-templates/bp-legacy/buddypress/members/single/settings/profile.php */
do_action( 'bp_before_member_settings_template' ); ?>

<h3 class="bp-member-tab-title"><?php
	/* translators: accessibility text */
	_e( 'Account Settings', 'bs4' );
?></h3>

<form action="<?php echo bp_displayed_user_domain() . bp_get_settings_slug() . '/general'; ?>" method="post" class="standard-form" id="settings-form">

	<?php if ( !is_super_admin() ) : ?>
		<div class="form-group">
			<label for="pwd"><?php _e( 'Current Password <span>(required to update email or change current password)</span>', 'bs4' ); ?></label>
			<input type="password" name="pwd" id="pwd" value="" class="settings-input small form-control" <?php bp_form_field_attributes( 'password' ); ?>/> &nbsp;<a href="<?php echo wp_lostpassword_url(); ?>" title="<?php esc_attr_e( 'Password Lost and Found', 'bs4' ); ?>"><?php _e( 'Lost your password?', 'bs4' ); ?></a>
		</div>
	<?php endif; ?>

	<div class="form-group">
		<label for="email"><?php _e( 'Account Email', 'bs4' ); ?></label>
		<input type="email" name="email" id="email" value="<?php echo bp_get_displayed_user_email(); ?>" class="settings-input form-control" <?php bp_form_field_attributes( 'email' ); ?>/>
	</div>

	<div class="form-group">
		<label for="pass1"><?php _e( 'New Password', 'bs4' ); ?></label>
		<input type="password" name="pass1" id="pass1" value="" class="settings-input small password-entry form-control" <?php bp_form_field_attributes( 'password' ); ?>/>
	</div>

	<div id="pass-strength-result"></div>

	<div class="form-group">
		<label for="pass2"><?php _e( 'Repeat New Password', 'bs4' ); ?></label>
		<input type="password" name="pass2" id="pass2" value="" class="settings-input small password-entry-confirm form-control" <?php bp_form_field_attributes( 'password' ); ?>/>
	</div>

	<?php

	/**
	 * Fires before the display of the submit button for user general settings saving.
	 *
	 * @since 1.5.0
	 */
	do_action( 'bp_core_general_settings_before_submit' ); ?>

	<div class="submit">
		<input type="submit" name="submit" value="<?php esc_attr_e( 'Save Changes', 'bs4' ); ?>" id="submit" class="auto btn btn-secondary" />
	</div>

	<?php

	/**
	 * Fires after the display of the submit button for user general settings saving.
	 *
	 * @since 1.5.0
	 */
	do_action( 'bp_core_general_settings_after_submit' ); ?>

	<?php wp_nonce_field( 'bp_settings_general' ); ?>

</form>

<?php

/** This action is documented in bp-templates/bp-legacy/buddypress/members/single/settings/profile.php */
do_action( 'bp_after_member_settings_template' ); ?>
