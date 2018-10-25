<?php
global $bpt_blog_atts;

// Default settings for blog item
$trim = true;
if ( !(bool)$bpt_blog_atts ) {
    $opt_likes = Cryptronick_Theme_Helper::get_option('blog_list_likes');
    $opt_share = Cryptronick_Theme_Helper::get_option('blog_list_share');
    $opt_meta = Cryptronick_Theme_Helper::get_option('blog_list_meta');
    $opt_meta_author = Cryptronick_Theme_Helper::get_option('blog_list_meta_author');
    $opt_meta_comments = Cryptronick_Theme_Helper::get_option('blog_list_meta_comments');
    $opt_meta_categories = Cryptronick_Theme_Helper::get_option('blog_list_meta_categories');
    $opt_meta_date = Cryptronick_Theme_Helper::get_option('blog_list_meta_date');
    $opt_read_more = Cryptronick_Theme_Helper::get_option('blog_list_read_more');
    $opt_hide_media = Cryptronick_Theme_Helper::get_option('blog_list_hide_media');
    $opt_hide_title = Cryptronick_Theme_Helper::get_option('blog_list_hide_title');
    $opt_hide_content = Cryptronick_Theme_Helper::get_option('blog_list_hide_content');
    $opt_letter_count = Cryptronick_Theme_Helper::get_option('blog_list_letter_count');
    $opt_blog_columns = Cryptronick_Theme_Helper::get_option('blog_list_columns');
    $opt_blog_columns = empty($opt_blog_columns) ? '12' : $opt_blog_columns;

    global $wp_query;
    $bpt_blog_atts = array(
        'query' => $wp_query,
        'animation_class' => '',
        // General
        'blog_layout' => 'grid',
        // Content
        'build_query' => '',
        'blog_columns' => $opt_blog_columns,
        'hide_media' => $opt_hide_media,
        'hide_content' => $opt_hide_content,
        'hide_blog_title' => $opt_hide_title,
        'hide_postmeta' => $opt_meta,
        'meta_author' => $opt_meta_author,
        'meta_comments' => $opt_meta_comments,
        'meta_categories' => $opt_meta_categories,
        'meta_date' => $opt_meta_date,
        'hide_likes' => !(bool)$opt_likes,
        'hide_share' => !(bool)$opt_share,
        'read_more_hide' => $opt_read_more,
        'read_more_text' => esc_html__('[ Read More ]', 'cryptronick'),
        'content_letter_count' => empty($opt_letter_count) ? '85' : $opt_letter_count,
        'crop_square_img' => '',
        'heading_tag' => 'h4',
        'items_load'  => 4,
        'blog_left_pad' => '',
        'blog_right_pad' => '',
        'blog_top_pad' => '',
        'blog_bottom_pad' => '',
        'blog_left_mar' => '',
        'blog_right_mar' => '',
        'blog_top_mar' => '',
        'blog_bottom_mar' => '',
        'heading_margin_bottom' => '18px',

    );
    $trim = false;
}

extract($bpt_blog_atts);

if ((bool)$crop_square_img) {
    $image_size = 'bpt-700-700';
} else {
     $image_size = 'full';
}
global $bpt_query_vars;
if(!empty($bpt_query_vars)){
    $query = $bpt_query_vars;
}

$blog_styles = '';
// paddings
$blog_styles .= ($blog_left_pad != '') ? 'padding-left:'.(int) $blog_left_pad.'px; ' : '';
$blog_styles .= ($blog_right_pad != '') ? 'padding-right:'.(int) $blog_right_pad.'px; ' : '';
$blog_styles .= ($blog_top_pad != '') ? 'padding-top:'.(int) $blog_top_pad.'px; ' : '';
$blog_styles .= ($blog_bottom_pad != '') ? 'padding-bottom:'.(int) $blog_bottom_pad.'px; ' : '';

// margins
$blog_styles .= ($blog_left_mar != '') ? 'margin-left:'.(int) $blog_left_mar.'px; ' : '';
$blog_styles .= ($blog_right_mar != '') ? 'margin-right:'.(int) $blog_right_mar.'px; ' : '';
$blog_styles .= ($blog_top_mar != '') ? 'margin-top:'.(int) $blog_top_mar.'px; ' : '';
$blog_styles .= ($blog_bottom_mar != '') ? 'margin-bottom:'.(int) $blog_bottom_mar.'px; ' : '';

$blog_attr = !empty($blog_styles) ? ' style="'.esc_attr($blog_styles).'"' : '';

$heading_attr = isset($heading_margin_bottom) && $heading_margin_bottom != '' ? ' style="margin-bottom: '.(int) $heading_margin_bottom.'px"' : '';
while ($query->have_posts()) : $query->the_post();          

    echo '<div class="span'.esc_attr($blog_columns).' item">';

    $single = Cryptronick_SinglePost::getInstance();
    $single->set_data();
    $title = get_the_title();

    $blog_item_classes = ' format-'.$single->get_pf();
    $blog_item_classes .= ' '.$animation_class;
    $blog_item_classes .= is_sticky() ? ' sticky-post' : '';

    ?>

    <div class="blog-post <?php echo esc_attr($blog_item_classes); ?>"<?php echo sprintf("%s", $blog_attr);?>>
        <div class="blog-post_wrapper">
            <?php
            ?>
            <div class="blog-post_content">
            <?php
                if( !(bool) $meta_categories ){
                    echo "<div class='blog-post_cats'>";
                        $single->render_post_cats();
                    echo "</div>";
                }   
                // Blog Title
                if ( !(bool)$hide_blog_title && !empty($title) ) :
                   echo sprintf('<%1$s class="blog-post_title"%2$s><a href="%3$s">%4$s</a></%1$s>', esc_html($heading_tag), $heading_attr, esc_url(get_permalink()), esc_html($title) );
                endif;

                // Content Blog
                if ( !(bool)$hide_content ) $single->render_excerpt($content_letter_count, $trim, !(bool)$read_more_hide, $read_more_text);
                ?>          
                <?php

                // Read more link
                if ( !(bool)$read_more_hide && (bool)$hide_content ) :
                ?>
                    <div class="clear"></div>
                    <a href="<?php echo esc_url(get_permalink()); ?>" class="button-read-more"><?php echo esc_html($read_more_text); ?></a>
               
               <?php
                endif;
                ?>

                <div class="clear"></div>
                <?php
                    if ( !(bool)$hide_share ||  !(bool)$hide_likes ) echo '<div class="blog-post_meta-wrap">';
                        if( !(bool)$hide_postmeta ) {
                            $meta_to_show = array(
                                'date' => !(bool)$meta_date,
                                'author' => !(bool)$meta_author,
                                'comments' => !(bool)$meta_comments,
                            );
                            $single->render_post_meta($meta_to_show);
                        }

                    // Likes in blog
                    if ( !(bool)$hide_share ||  !(bool)$hide_likes ) echo '<div class="blog-post_info-wrap">';
                    if ( !(bool)$hide_likes ) : ?>
                             
                            <div class="blog-post_likes-wrap">
                                <?php
                                if ( !(bool)$hide_likes && function_exists('bpt_simple_likes')) {
                                    echo bpt_simple_likes()->likes_button( get_the_ID(), 0 );
                                } 
                                ?>
                            </div> 
                        <?php
                    endif;
                    if ( !(bool)$hide_share ) : ?>
                      <?php
                      $single->render_post_list_share();
                    endif; 

                    if ( !(bool)$hide_share ||  !(bool)$hide_likes ): ?> 
                        </div>   
                        </div>   
                    <?php
                    endif;           

                ?>
            </div>
        </div>
    </div>
    <?php

    echo '</div>';

endwhile;
wp_reset_postdata();
