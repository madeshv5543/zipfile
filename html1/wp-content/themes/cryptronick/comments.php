<?php
if (post_password_required()) {
    ?>
    <p class="nocomments"><?php esc_html_e('This post is password protected. Enter the password to view comments.', 'cryptronick'); ?></p>
    <?php return;
}
?>

<div id="comments"><?php
#Required for nested reply function that moves reply inline with JS
if (is_singular()) wp_enqueue_script('comment-reply');

if (have_comments()) : 

    $comments_number = number_format_i18n( get_comments_number() );
    $comment_text = ($comments_number == '1') ? __('Comment', 'cryptronick') : __('Comments', 'cryptronick');
    ?>
    <h3 class="commentslist_title"> <?php echo esc_html($comment_text, 'cryptronick'); ?> <?php echo '('.$comments_number.')'; ?></h3>
    <ol class="commentlist">
    <?php
        wp_list_comments(array(
            'walker' => new Cryptronick_Walker_Comment(),
            'avatar_size' => 80,
            'short_ping' => true
        ) );
    ?>
    </ol>
    <div><?php paginate_comments_links(); ?></div>
    <?php if ('open' == $post->comment_status) : ?>
    <?php else : // comments are closed ?>
    <?php endif; ?>
<?php endif; ?>
<?php if ('open' == $post->comment_status) :
    $comment_form = array(
        'fields' => apply_filters('comment_form_default_fields', array(
            'author' => '<div class="span6"><label class="label-name"></label><input type="text" placeholder="' . esc_attr__('Name *', 'cryptronick') . '" title="' . esc_attr__('Name *', 'cryptronick') . '" id="author" name="author" class="form_field"></div>',
            'email' => '<div class="span6"><label class="label-email"></label><input type="text" placeholder="' . esc_attr__('Email *', 'cryptronick') . '" title="' . esc_attr__('Email *', 'cryptronick') . '" id="email" name="email" class="form_field"></div>',
            'url' => '<div class="span12"><label class="label-email"></label><input type="text" placeholder="' . esc_attr__('Website', 'cryptronick') . '" title="' . esc_attr__('Website', 'cryptronick') . '" id="url" name="url" class="form_field"></div>'
        )),
        'comment_field' => '<div class="span12"><label class="label-message"></label><textarea name="comment" cols="45" rows="5" placeholder="' . esc_attr__('Your Comment', 'cryptronick') . '" id="comment-message" class="form_field"></textarea></div>',
        'comment_form_before' => '',
        'comment_form_after' => '',
        'must_log_in' => esc_html__('You must be logged in to post a comment.', 'cryptronick'),
        'title_reply' => esc_html__('Leave a Comment!', 'cryptronick'),
        'title_reply_before' => '<h3 id="reply-title" class="comment-reply-title">',
        'title_reply_after' => '</h3>',
        'label_submit' => esc_html__('Post comment', 'cryptronick'),
        'logged_in_as' => '<p class="logged-in-as">' . esc_html__('Logged in as', 'cryptronick') . ' <a href="' . esc_url(admin_url('profile.php')) . '">' . $user_identity . '</a>. <a href="' . esc_url(wp_logout_url(apply_filters('the_permalink', get_permalink()))) . '">' . esc_html__('Log out?', 'cryptronick') . '</a></p>',
    );

    add_filter('comment_form_fields', 'cryptronick_reorder_comment_fields');

    if (!function_exists('cryptronick_reorder_comment_fields')) {
        function cryptronick_reorder_comment_fields($fields ) {
            $new_fields = array();

            $myorder = array('author', 'email', 'url', 'comment');

            foreach( $myorder as $key ){
                $new_fields[ $key ] = $fields[ $key ];
                unset( $fields[ $key ] );
            }

            if( $fields ) {
                foreach( $fields as $key => $val ) {
                    $new_fields[ $key ] = $val;
                }
            }

            return $new_fields;
        }
    }
    

    comment_form($comment_form, $post->ID);

else : // Comments are closed ?>
<?php endif; ?></div>