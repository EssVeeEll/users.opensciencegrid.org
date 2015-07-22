<?php 
	if ( post_password_required() ) { ?>
		<p class="nocomments"><?php _e('This post is protected', 'artificial_reason') ?>.</p>
	<?php
		return;
	}      
?>

<!-- You can start editing here. -->
<?php // Begin Comments & Trackbacks ?>
<?php if ( have_comments() ) : ?>
    <section>
	<h2  class="section-title"><?php comments_number(__('0 Comments'), __('1 Comment'), __('% Comments'));?></h2>

    <?php $args = array(
        'walker'            => new wp_list_comments_walker(),
        'max_depth'         => '',
        'style'             => 'ul',
        'callback'          => "areason_comment",
        'end-callback'      => null,
        'type'              => 'all',
        'page'              => '',
        'per_page'          => '',
        'avatar_size'       => 75,
        'reverse_top_level' => null,
        'reverse_children'  => '',
        'format'            => 'html5', //or html5 @since 3.6
        'short_ping'        => false // @since 3.6
    ); ?>

	<ul class="list-unstyled">
		<?php wp_list_comments($args); ?>
	</ul>

    </section>

<?php // End Comments ?>

 <?php else : // this is displayed if there are no comments so far ?>

	<?php if ('open' == $post->comment_status) : ?>
		<!-- If comments are open, but there are no comments. -->

	 <?php elseif($post->post_type != "page") : // comments are closed ?>
		<!-- If comments are closed. -->

	<?php endif; ?>
<?php endif; ?>

<?php if ('open' == $post->comment_status) : ?>

<?php

add_filter( 'comment_form_default_fields', 'bootstrap3_comment_form_fields' );
function bootstrap3_comment_form_fields(  ) {
    $commenter = wp_get_current_commenter();
    
    $req      = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $html5    = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;
    
    $fields   =  array(
        'author' => '<div class="form-group comment-form-author">' . '<label for="author">' . __( 'Name', 'artificial_reason' ) . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                    '<input class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',
        'email'  => '<div class="form-group comment-form-email"><label for="email">' . __( 'Email', 'artificial_reason') . ( $req ? ' <span class="required">*</span>' : '' ) . '</label> ' .
                    '<input class="form-control" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div>',
        'url'    => '<div class="form-group comment-form-url"><label for="url">' . __( 'Website', 'artificial_reason') . '</label> ' .
                    '<input class="form-control" id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div>',
    );
    
    return $fields;
}

add_filter( 'comment_form_defaults', 'bootstrap3_comment_form' );
function bootstrap3_comment_form( $args ) {
    $args['comment_field'] = '<div class="form-group comment-form-comment">
            <label for="comment">' . __( 'Comment', 'artificial_reason' ) . '</label> 
            <textarea class="form-control" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
        </div>';
    return $args;
}

add_action('comment_form', 'bootstrap3_comment_button' );
function bootstrap3_comment_button() {
    echo '<button class="btn btn-ar btn-primary" type="submit">' . __( 'Submit', 'artificial_reason') . '</button>';
}

$comments_args = array(
        // change the title of send button 
        'fields'=> bootstrap3_comment_form_fields(  ),
        'title_reply'       => __( 'Leave a Comment', 'artificial_reason'),
        'comment_notes_after' => ''
);

comment_form($comments_args);
?>

<style>
.form-submit {
    display: none;
}
</style>

<?php endif; ?>