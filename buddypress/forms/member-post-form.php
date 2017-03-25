<?php
/**
 * BuddyPress - Member Post Form
 *
 * @package BuddyPress
 * @subpackage bp-default
 */
?>
<form id="whats-new-form" action="<?php bp_activity_post_form_action(); ?>" method="post" name="whats-new-form" class="card member-post-form" role="complementary">
    <?php
    /**
     * Fires before the activity post form.
     *
     * @since 1.2.0
     */
    do_action( 'bp_before_activity_post_form' );
    ?>
    <div class="card-block media">
        <div id="whats-new-content-bs" class="media-body">
            <div id="whats-new-textarea-bs">
                <div class="form-group">
                    <label for="whats-new" class="screen-reader-text"><?php _e( 'Post what&#8217;s new', 'bs4' ); ?></label>
                    <textarea class="bp-suggestions form-control" name="whats-new" id="whats-new-bs" placeholder="<?php esc_attr_e( 'Start writing&hellip;', 'bs4' ); ?>" rows="2"
                        <?php if ( bp_is_group() ) : ?>data-suggestions-group-id="<?php echo esc_attr( (int) bp_get_current_group_id() ); ?>" <?php endif; ?>
                    ><?php if ( isset( $_GET['r'] ) ) : ?>@<?php echo esc_textarea( $_GET['r'] ); ?> <?php endif; ?></textarea>
                </div>
            </div>
            <div id="whats-new-options-bs">
                <div id="whats-new-submit-bs">
                    <input id="aw-whats-new-submit-bs" type="submit" name="aw-whats-new-submit" class="btn btn-sm btn-secondary" value="<?php esc_attr_e( 'Submit', 'bs4' ); ?>" />
                </div>

                <?php if ( bp_is_active( 'groups' ) && !bp_is_my_profile() && !bp_is_group() ) : ?>

                    <div id="whats-new-post-in-box form-group">

                        <?php _e( 'Post in', 'bs4' ); ?>:

                        <label for="whats-new-post-in" class="bp-screen-reader-text"><?php
                            /* translators: accessibility text */
                            _e( 'Post in', 'bs4' );
                        ?></label>
                        <select id="whats-new-post-in" name="whats-new-post-in" class="form-control">
                            <option selected="selected" value="0"><?php _e( 'My Profile', 'bs4' ); ?></option>

                            <?php if ( bp_has_groups( 'user_id=' . bp_loggedin_user_id() . '&type=alphabetical&max=100&per_page=100&populate_extras=0&update_meta_cache=0' ) ) :

                                while ( bp_groups() ) : bp_the_group(); ?>

                                    <option value="<?php bp_group_id(); ?>"><?php bp_group_name(); ?></option>

                                <?php endwhile;

                            endif; ?>

                        </select>
                    </div>
                    <input type="hidden" id="whats-new-post-object" name="whats-new-post-object" value="groups" />

                <?php elseif ( bp_is_group_activity() ) : ?>

                    <input type="hidden" id="whats-new-post-object" name="whats-new-post-object" value="groups" />
                    <input type="hidden" id="whats-new-post-in" name="whats-new-post-in" value="<?php bp_group_id(); ?>" />

                <?php endif; ?>

                <?php
                /**
                 * Fires at the end of the activity post form markup.
                 *
                 * @since 1.2.0
                 */
                do_action( 'bp_activity_post_form_options' ); ?>
            </div><!-- #whats-new-options -->
        </div><!-- #whats-new-content -->

        <?php wp_nonce_field( 'post_update', '_wpnonce_post_update' ); ?>
        <?php
        /**
         * Fires after the activity post form.
         *
         * @since 1.2.0
         */
        do_action( 'bp_after_activity_post_form' ); ?>
    </div>
</form><!-- #whats-new-form -->
