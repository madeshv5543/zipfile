<?php


include_once get_template_directory() . '/core/vc/templates/bpt_google_fonts_render.php';

$header_font = Cryptronick_Theme_Helper::get_option('header-font');
$main_font = Cryptronick_Theme_Helper::get_option('main-font');

$theme_color = esc_attr(Cryptronick_Theme_Helper::get_option("theme-custom-color"));

$defaults = array(
    // General
    'blog_title' => '',
    'blog_subtitle' => '',
    'blog_style' => 'standard',
    'blog_layout' => 'grid',
    'min_height_blog' => '',
    'blog_navigation' => 'none',
    'items_load'  => 4,
    'blog_navigation_align' => 'center',
    'css_animation' => '',
    'css' => '',
    'item_el_class' => '',
    // Content
    'build_query' => '',
    'blog_columns' => '6',
    'hide_media' => '',
    'hide_content' => '',
    'hide_blog_title' => '',
    'hide_postmeta' => '',
    'meta_author' => 'true',
    'meta_comments' => '',
    'meta_categories' => '',
    'meta_date' => '',
    'hide_likes' => 'true',
    'hide_share' => '',
    'read_more_hide' => 'true',
    'read_more_text' => '[ Read More ]',
    'full_width_load_more' => true,
    'content_letter_count' => '85',
    'crop_square_img' => '',
    // Carousel
    'use_carousel' => false,
    'autoplay' => false,
    'autoplay_speed' => '3000',
    'use_pagination' => true,
    'use_navigation' => true,
    'pag_type' => 'circle',
    'pag_offset' => '',
    'custom_pag_color' => false,
    'pag_color' => $theme_color,
    'custom_resp' => false,
    'resp_medium' => '1025',
    'resp_medium_slides' => '',
    'resp_tablets' => '800',
    'resp_tablets_slides' => '',
    'resp_mobile' => '480',
    'resp_mobile_slides' => '',
    // Custom style
    'heading_tag' => 'h4',
    'heading_margin_bottom' => '18px',
    'custom_fonts_blog_content' => '',
    'google_fonts_blog' => '',
    'custom_fonts_blog_headings' => '',
    'google_fonts_blog_headings' => '',
    'custom_main_color' => '#e2e2e2',
    'custom_headings_color' => esc_attr($header_font['color']),
    'custom_hover_headings_color' => esc_attr($theme_color),
    'custom_content_color' => esc_attr($main_font['color']),
    'heading_font_size' => '',
    'heading_line_height' => '',
    'content_font_size' => '',
    'content_line_height' => '',
    'custom_blog_bg' => '',
    'custom_bg_mask_color' => 'rgba(14,21,30,.6)',    
    'custom_blog_mask' => '',
    'custom_image_mask_color' => 'rgba(14,21,30,.6)',
    'custom_blog_hover_mask'    => '',
    'custom_image_hover_mask_color'    => 'rgba(14,21,30,.6)',
    'blog_left_pad' => '',
    'blog_right_pad' => '',
    'blog_top_pad' => '',
    'blog_bottom_pad' => '',
    'blog_left_mar' => '',
    'blog_right_mar' => '',
    'blog_top_mar' => '',
    'blog_bottom_mar' => '',
    'add_divider' => 'true',
    'blog_border_style' => 'solid',
    'blog_border_width' => '1px',
    'blog_border_color' => '#eeeeee',
    'custom_fonts_blog_size_headings' => '',
    'custom_fonts_blog_size_content' => '',
    'use_custom_heading_color' => '',
    'use_custom_content_color' => '',
    'use_custom_main_color' => '',
    'name_load_more' => esc_html__('Load More', 'cryptronick'),
);

$atts = vc_shortcode_attribute_parse($defaults, $atts);

extract($atts);
$compile = '';
list($query_args, $build_query) = vc_build_loop_query($build_query);

// Add Page to Query
global $paged;
if (empty($paged)) {
    $paged = (get_query_var('page')) ? get_query_var('page') : 1;
}
$query_args['paged'] = $paged;

// New Query
$query = new WP_Query($query_args);
$class_to_filter = vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $item_el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

// Animation
$animation_class = '';
if (! empty($atts['css_animation'])) {
    $animation_class = $this->getCSSAnimation( $atts['css_animation'] );
}

// Start Custom CSS
$styles = $blog_id = '';
// Add custom id

$custom_style = '';

switch (true) {
    case (bool)$add_divider:
        $custom_style = true;
        break;       
    case (bool)$custom_fonts_blog_content:
        $custom_style = true;
        break;    
    case (bool)$custom_fonts_blog_headings:
        $custom_style = true;
        break;    
    case (bool)$use_custom_heading_color:
        $custom_style = true;
        break;    
    case (bool)$use_custom_content_color:
        $custom_style = true;
        break;    
    case (bool)$use_custom_main_color:
        $custom_style = true;
        break;    
    case (bool)$custom_blog_mask:
        $custom_style = true;
        break;    
    case (bool)$custom_blog_hover_mask:
        $custom_style = true;
        break;       
    case (bool)$custom_blog_bg:
        $custom_style = true;
        break;    
    case (bool)$custom_fonts_blog_size_headings:
        $custom_style = true;
        break;      
    case (bool)$custom_fonts_blog_size_content:
        $custom_style = true;
        break;  
}


if( (bool)$custom_style ) {
    $blog_id = uniqid( "blog_module_" );
}

// Render Google Fonts
if( (bool)$custom_fonts_blog_content || (bool)$custom_fonts_blog_headings ) {

    $blog_value_font = $blog_value_font_headings = '';
    $obj = new GoogleFontsRender();
    extract( $obj->getAttributes( $atts, $this, $this->shortcode, array('google_fonts_blog', 'google_fonts_blog_headings')));

    if ( ! empty( $styles_google_fonts_blog ) ) {
        $blog_value_font = esc_attr( $styles_google_fonts_blog );
        $styles .= "#$blog_id.blog-posts,
        #$blog_id.blog-posts .button-read-more,
        #$blog_id.blog-posts .likes_block .sl-count {
            ".$blog_value_font."
        }";

    }

    if ( ! empty( $styles_google_fonts_blog_headings ) ) {
        $blog_value_font_headings = esc_attr( $styles_google_fonts_blog_headings );
        $styles .= "
        #$blog_id.blog-posts .blog-post_title {
            ".$blog_value_font_headings."
        }";
    }

    
}

// Render colors and font size
if ( (bool)$custom_style ) {

    $custom_main_color_css = !empty($custom_main_color) ? ' color:'.$custom_main_color.';' : '';
    $custom_main_bg_css = !empty($custom_main_color) ? ' background-color:'.$custom_main_color.';' : '';
    
    $custom_headings_color_css = !empty($custom_headings_color) ? ' color:'.$custom_headings_color.';' : '';
    $custom_headings_hover_color_css = !empty($custom_hover_headings_color) ? ' color:'.$custom_hover_headings_color.';' : '';
    $custom_content_color_css = !empty($custom_content_color) ? ' color:'.$custom_content_color.';' : '';
    
    $heading_font_size_css = !empty($heading_font_size) ? ' font-size:'.$heading_font_size.'px;' : '';
    $heading_line_height = !empty($heading_font_size) ? ' line-height:'.$heading_line_height.'px;' : '';
    $content_font_size_css = !empty($content_font_size) ? ' font-size:'.$content_font_size.'px;' : '';
    $content_line_height = !empty($content_line_height) ? ' line-height:'.$content_line_height.'px;' : '';
    $background_color = !empty($custom_image_mask_color) ? ' background-color:'.$custom_image_mask_color.';' : '';
    $background_item = !empty($custom_bg_mask_color) ? ' background-color:'.$custom_bg_mask_color.';' : '';
    $background_color_hover = !empty($custom_image_hover_mask_color) ? ' background-color:'.$custom_image_hover_mask_color.';' : '';
    
    $blog_border_style = !empty($blog_border_style) ? ' border-top-style:'.esc_attr($blog_border_style).';' : '';
    $blog_border_style .= !empty($blog_border_width) ? ' border-top-width:'.(int) $blog_border_width.'px;' : '';
    $blog_border_style .= !empty($blog_border_color) ? ' border-top-color:'.esc_attr($blog_border_color).'' : '';


    // custom testimonials colors
    ob_start();

    if ((bool)$use_custom_heading_color && (bool)$custom_headings_color_css) {
        echo "#$blog_id.blog-posts .blog-post_title,
        #$blog_id.blog-posts .blog-post_title a {
            ".$custom_headings_color_css ."
        }";
    }     

    if ((bool)$use_custom_heading_color && (bool)$custom_headings_hover_color_css) {
        echo "#$blog_id.blog-posts .blog-post_title:hover,
        #$blog_id.blog-posts .blog-post_title a:hover {
            ".$custom_headings_hover_color_css ."
        }";
    }    

    if ((bool)$custom_fonts_blog_size_headings &&  (bool)$heading_font_size_css ) {
        echo "#$blog_id.blog-posts .blog-post_title,
        #$blog_id.blog-posts .blog-post_title a {
            ".$heading_font_size_css. $heading_line_height ."
        }";
    }

    if ( (bool)$use_custom_content_color &&  (bool)$custom_content_color_css) {
        echo "#$blog_id.blog-posts .blog-post_text {
            ".$custom_content_color_css."
            line-height: 1.7;
        }";
    }  

    if ((bool)$custom_fonts_blog_size_content && (bool)$content_font_size_css) {
        echo "#$blog_id.blog-posts .blog-post_text {
            ".$content_font_size_css."
            line-height: 1.7;
        }";
    }


    if ((bool) $use_custom_main_color && (bool)$custom_main_color_css ) {
        echo "#$blog_id.blog-posts .blog-post_title a:hover,
        #$blog_id.blog-posts .button-read-more:not(:hover),
        #$blog_id.blog-posts .meta-wrapper,
        #$blog_id.blog-posts .meta-wrapper a,
        #$blog_id.blog-posts .blog-post_likes-wrap .sl-count,
        #$blog_id.blog-posts .post_share a,
        #$blog_id.blog-posts .blog-post_likes-wrap .sl-icon,
        #$blog_id.blog-posts .meta-wrapper a:hover{
            ".$custom_main_color_css."
        }";
    }      

    if ((bool) $use_custom_main_color && (bool)$custom_main_bg_css ) {
        echo "#$blog_id .blog-style-news_post .item:before{
            ".$custom_main_bg_css."
        }";
    }    

    if((bool) $custom_blog_mask){
        echo "#$blog_id.blog-posts .blog-post_bg_media:before,
        #$blog_id.blog-posts .blog-style-news_post .item,
        #$blog_id.blog-posts .blog-post.format-standard-image .blog-post_media .blog-post_feature-link:before{
            ".$background_color."
        }";        
    } 
   
   if((bool) $custom_blog_bg){
        echo "#$blog_id.blog-posts .blog-post.format-standard-image .blog-post_content,
        #$blog_id.blog-posts .format-standard .blog-post_wrapper, 
        #$blog_id.blog-posts .format-audio .blog-post_wrapper, 
        #$blog_id.blog-posts .format-quote .blog-post_wrapper, 
        #$blog_id.blog-posts .format-link .blog-post_wrapper
        {
            ".$background_item."
        }";        
    }    

    if((bool) $custom_blog_hover_mask){
        echo "#$blog_id.blog-posts .blog-post:hover .blog-post_bg_media:before,
        #$blog_id.blog-posts .blog-post.hide_media:hover,
        #$blog_id.blog-posts .blog-post-news_post .item,
        #$blog_id.blog-posts .blog-style-news_post .item:hover,
        #$blog_id.blog-posts .blog-post.format-standard-image .blog-post_media .blog-post_feature-link:before{
            ".$background_color_hover."
        }";        
    }

    if((bool) $blog_border_style && (bool) $blog_border_color){
        echo "#$blog_id.blog-posts .blog-post_meta-wrap,
        #$blog_id.blog-posts .meta-wrapper{
            ".$blog_border_style."
        }";        
    }

    if((bool) $blog_border_style && (bool) $blog_border_color){
        echo "#$blog_id.blog-posts .blog-style-standard .blog-post_wrapper{
            border: 1px solid ".esc_attr($blog_border_color).";
        }";           
    }

    $styles .= ob_get_clean();
    
}

// Register css
if (!empty($styles)) {
    Cryptronick_shortcode_css()->enqueue_cryptronick_css($styles);
}


// Render Items blog
$bpt_def_atts = array(
    'query' => $query,
    'animation_class' => $animation_class,
    // General
    'blog_layout' => '',
    'blog_title' => '',
    'blog_subtitle' => '',
    // Content
    'build_query' => '',
    'blog_columns' => '',
    'hide_media' => '',
    'hide_share' => '',
    'hide_content' => '',
    'hide_blog_title' => '',
    'hide_postmeta' => '',
    'meta_author' => $meta_author,
    'meta_comments' => '',
    'meta_categories' => '',
    'meta_date' => '',
    'hide_likes' => $hide_likes,
    'read_more_hide' => $read_more_hide,
    'read_more_text' => '',
    'content_letter_count' => '',
    'crop_square_img' => '',
    'heading_tag' => '',
    'heading_margin_bottom' => $heading_margin_bottom,
    'items_load'  => $items_load,
    'blog_left_pad' => '',
    'blog_right_pad' => '',
    'blog_top_pad' => '',
    'blog_bottom_pad' => '',
    'blog_left_mar' => '',
    'blog_right_mar' => '',
    'blog_top_mar' => '',
    'blog_bottom_mar' => '',
    'blog_style' => 'standard',
    'min_height_blog'   => '',
    'name_load_more'    => $name_load_more
);

global $bpt_blog_atts;
$bpt_blog_atts = array_merge($bpt_def_atts ,array_intersect_key($atts, $bpt_def_atts));
ob_start();

    get_template_part('templates/post/post', $blog_style);

$blog_items = ob_get_clean();

// Render row class
$row_class = '';

wp_enqueue_script( 'imagesloaded' ); 
if ($blog_layout == 'masonry') {
    //Call Wordpress Isotope
    wp_enqueue_script('isotope');
    $row_class .= 'blog_masonry';
}

// Allowed HTML render
$allowed_html = array(
    'a' => array(
        'href' => true,
        'title' => true,
    ),
    'br' => array(),
    'em' => array(),
    'strong' => array()
); 

// Options for carousel
if ($blog_layout == 'carousel') {
    switch ($blog_columns){
        case '6':
            $item_grid = 2;
            break;
        case '3':
            $item_grid = 4;
            break;
        case '4':
            $item_grid = 3;
            break;
        case '12':
            $item_grid = 1;
            break;
        default:
            $item_grid = 6;
            break;
    }

    $carousel_options_arr = array(
        'posts_per_line' => $item_grid,
        'autoplay_carousel' => $autoplay,
        'slider_speed' => $autoplay_speed,
        'use_pagination' => $use_pagination,
        'use_navigation' => $use_navigation,
        'pag_type' => $pag_type,
        'pag_offset' => $pag_offset,
        'custom_pag_color' => $custom_pag_color,
        'pag_color' => $pag_color,
        'custom_resp' => $custom_resp,
        'resp_medium' => $resp_medium,
        'resp_medium_slides' => $resp_medium_slides,
        'resp_tablets' => $resp_tablets,
        'resp_tablets_slides' => $resp_tablets_slides,
        'resp_mobile' => $resp_mobile,
        'resp_mobile_slides' => $resp_mobile_slides,
        'adaptive_height'   => true
    );

    if((bool) $use_navigation){
        $carousel_options_arr['use_prev_next'] = 'true';
    }
    // carousel options
    $carousel_options = array_map(function($k, $v) { return "$k=\"$v\" "; }, array_keys($carousel_options_arr), $carousel_options_arr);
    $carousel_options = implode('', $carousel_options);

    wp_enqueue_script('cryptronick-slick-js', get_template_directory_uri() . '/js/slick.min.js', array(), false, false);

    $blog_items = do_shortcode('[bpt_carousel '.$carousel_options.']'.$blog_items.'[/bpt_carousel]');

    $row_class = 'blog_carousel';
    if(!empty($blog_title) || !empty($blog_title)){
        $row_class .= ' blog_carousel_title-arrow';
    }
}

// Row class for grid and massonry
if ( in_array($blog_layout, array('grid', 'masonry')) ) {

    switch ( $blog_columns ) {
        case '12':
            $row_class .= ' blog_columns-1';
            break;
        case '6':
            $row_class .= ' blog_columns-2';
            break;
        case '4':
            $row_class .= ' blog_columns-3';
            break;
        case '3':
            $row_class .= ' blog_columns-4';
            break;
    }
    $row_class .= " ".$blog_layout;

}
$row_class .= " blog-style-".$blog_style;

// Render wraper
if ($query->have_posts()): ?>
    <section class="bpt_cpt_section">
        <div <?php if ((bool)$blog_id) echo 'id="'.esc_attr($blog_id).'"' ?> class="blog-posts <?php echo esc_attr($css_class); ?>">
            <?php 
            echo '<div class="container-grid row '. esc_attr($row_class) .'">';
                if(!empty($blog_title) || !empty($blog_title)){
                    echo '<div class="bpt_module_title item_title">';
                    if(!empty($blog_title)) echo '<h2 class="blog_title">'.wp_kses( $blog_title, $allowed_html ).'</h2>';
                    if(!empty($blog_subtitle)) echo '<p class="blog_subtitle">'.wp_kses( $blog_subtitle, $allowed_html ).'</p>';
                    if ($blog_layout == 'carousel' && (bool) $use_navigation) {
                        echo '<div class="carousel_arrows"><a href="#" class="left_slick_arrow"><span></span></a><a href="#" class="right_slick_arrow"><span></span></a></div>';      
                        echo '</div>';
                    }             
                }

                echo Cryptronick_Theme_Helper::render_html($blog_items);
            echo '</div>';
            ?>
        </div>
<?php

if ( $blog_navigation == 'pagination' ) {
    echo Cryptronick_Theme_Helper::pagination('10', $query, $blog_navigation_align);
}

if ( $blog_navigation == 'load_more' ) {
    $bpt_blog_atts['post_count'] = $query->post_count;
    $bpt_blog_atts['query_args'] = $query_args;
    $class  = 'blog_load_more';
    $class .= !empty($full_width_load_more) ? ' full_width_btn' : '';
    echo Cryptronick_Theme_Helper::load_more('10', $bpt_blog_atts, $blog_navigation_align, $name_load_more, $class);
}

    echo '</section>';
endif;
?>
    
<?php
// Clear global var
unset($bpt_blog_atts);
?>