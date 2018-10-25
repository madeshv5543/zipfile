<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( '-1' );
}

$header_font = Cryptronick_Theme_Helper::get_option('header-font');
$main_font = Cryptronick_Theme_Helper::get_option('main-font');
$theme_color = Cryptronick_Theme_Helper::get_option('theme-custom-color');

if (function_exists('vc_map')) {
    vc_map(array(
        'base' => 'bpt_blog_posts',
        'name' => esc_html__('Blog Posts', 'cryptronick'),
        'description' => esc_html__('Display the blog posts', 'cryptronick'),
        'category' => esc_html__('BPT Modules', 'cryptronick'),
        'icon' => 'bpt_icon_blog',
        'params' => array(
             array(
                'type' => 'textfield',
                'heading' => esc_html__('Blog Title', 'cryptronick'),
                'param_name' => 'blog_title',
                'admin_label' => true,
            ),
            array(
                'type' => 'textarea',
                'heading' => esc_html__('Blog Subtitle', 'cryptronick'),
                'param_name' => 'blog_subtitle',
                'admin_label' => true,
            ),
            array(
                'type' => 'cryptronick_dropdown',
                'heading' => esc_html__('Style', 'cryptronick'),
                'param_name' => 'blog_style',
                'fields' => array(
                    'standard' => array(
                        'image' => get_template_directory_uri() . '/img/bpt_composer_addon/blog_type_1.png',
                        'descr' => esc_html__('Standard', 'cryptronick')),
                    'tiny_img' => array(
                        'image' => get_template_directory_uri() . '/img/bpt_composer_addon/blog_type_2.png',
                        'descr' => esc_html__('Tiny Thumbnail', 'cryptronick')),                    
                    'medium_img' => array(
                        'image' => get_template_directory_uri() . '/img/bpt_composer_addon/blog_type_3.png',
                        'descr' => esc_html__('Medium Thumbnail', 'cryptronick')),
                    'image' => array(
                        'image' => get_template_directory_uri() . '/img/bpt_composer_addon/blog_type_4.png',
                        'descr' => esc_html__('Image Overlay', 'cryptronick')),                    
                    'news_post' => array(
                        'image' => get_template_directory_uri() . '/img/bpt_composer_addon/blog_type_5.png',
                        'descr' => esc_html__('News Column', 'cryptronick')),
                ),
                'value' => 'standard',
            ),   
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Min Height', 'cryptronick'),
                'param_name' => 'min_height_blog',
                'value' => 'initial',
                'save_always' => true,
                'description' => esc_html__( 'Add a minimum height to the post item so you can have a row without any content but still display it at a certain height.', 'cryptronick' ),
                'dependency' => array(
                    'element' => 'blog_style',
                    "value" => "image"
                )
            ),     
            array(
                'type' => 'cryptronick_dropdown',
                'heading' => esc_html__('Layout', 'cryptronick'),
                'param_name' => 'blog_layout',
                'fields' => array(
                    'grid' => array(
                        'image' => get_template_directory_uri() . '/img/bpt_composer_addon/icons/layout_grid.png',
                        'descr' => esc_html__('Grid', 'cryptronick')),
                    'masonry' => array(
                        'image' => get_template_directory_uri() . '/img/bpt_composer_addon/icons/layout_masonry.png',
                        'descr' => esc_html__('Masonry', 'cryptronick')),
                    'carousel' => array(
                        'image' => get_template_directory_uri() . '/img/bpt_composer_addon/icons/layout_carousel.png',
                        'descr' => esc_html__('Carousel', 'cryptronick')),
                ),
                'value' => 'grid',
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Navigation', 'cryptronick' ),
                'param_name' => 'blog_navigation',
                'value'         => array(
                    esc_html__( 'None', 'cryptronick' ) => 'none',
                    esc_html__( 'Pagination', 'cryptronick' ) => 'pagination',
                    esc_html__( 'Load More', 'cryptronick' ) => 'load_more',
                ),
                'description' => esc_html__('Select Type of Navigation', 'cryptronick'),
                'std' => 'none',
                'dependency' => array(
                    'element' => 'blog_layout',
                    'value_not_equal_to' => 'carousel',
                ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Navigation\'s Alignment', 'cryptronick' ),
                'param_name' => 'blog_navigation_align',
                'value'         => array(
                    esc_html__( 'Center', 'cryptronick' ) => 'center',
                    esc_html__( 'Left', 'cryptronick' ) => 'left',
                    esc_html__( 'Right', 'cryptronick' ) => 'right'
                ),
                'description' => esc_html__('Select Navigation\'s Alignment.', 'cryptronick'),
                'std' => 'center',
                'dependency' => array(
                    'element' => 'blog_navigation',
                    'value' => 'pagination'
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Items on load', 'cryptronick'),
                'param_name' => 'items_load',
                'value' => '4',
                'save_always' => true,
                'description' => esc_html__( 'Items load by load more button.', 'cryptronick' ),
                'dependency' => array(
                    'element' => 'blog_navigation',
                    "value" => "load_more"
                )
            ),            
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Button Name', 'cryptronick'),
                'param_name' => 'name_load_more',
                'value' => esc_html__('Load More', 'cryptronick'),
                'save_always' => true,
                'dependency' => array(
                    'element' => 'blog_navigation',
                    "value" => "load_more"
                )
            ),
            array(
                "type"          => "bpt_checkbox",
                'heading' => esc_html__( 'Full Width', 'cryptronick' ),
                "param_name"    => "full_width_load_more",
                'dependency' => array(
                    'element' => 'blog_navigation',
                    "value" => "load_more"
                ),
                'std' => 'true'
            ),
            vc_map_add_css_animation( true ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Extra Class', 'cryptronick'),
                'param_name' => 'item_el_class',
                'description' => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'cryptronick')
            ),
            // --- Content GROUP --- //
            array(
                'type' => 'loop',
                'heading' => esc_html__('Blog Items', 'cryptronick'),
                'param_name' => 'build_query',
                'settings' => array(
                    'size' => array('hidden' => false, 'value' => 4 * 3),
                    'order_by' => array('value' => 'date'),
                    'post_type' => array('value' => 'post', 'hidden' => true),
                    'categories' => array('hidden' => false),
                    'tags' => array('hidden' => false)
                ),
                'description' => esc_html__('Create WordPress loop, to populate content from your site.', 'cryptronick'),
                'group' => esc_html__( 'Content', 'cryptronick' ),
            ),
            // Items per line
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Layout Settings', 'cryptronick'),
                'param_name' => 'h_layout_settings',
                'group' => esc_html__( 'Icon', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
                'group' => esc_html__( 'Content', 'cryptronick' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Number of Columns', 'cryptronick' ),
                'param_name' => 'blog_columns',
                'value'         => array(
                    esc_html__( 'One', 'cryptronick' ) => '12',
                    esc_html__( 'Two', 'cryptronick' ) => '6',
                    esc_html__( 'Three', 'cryptronick' ) => '4',
                    esc_html__( 'Four', 'cryptronick' ) => '3'
                ),
                'description' => esc_html__('Select Number of Columns', 'cryptronick'),
                'std' => '6',
                'edit_field_class' => 'vc_col-sm-6',
                'group' => esc_html__( 'Content', 'cryptronick' ),
            ),
            // Post Meta settings
            // Info Box Icon/Image heading
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Content Elements', 'cryptronick'),
                'param_name' => 'h_content_elements',
                'group' => esc_html__( 'Icon', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
                'group' => esc_html__( 'Content', 'cryptronick' ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__('Hide Media?', 'cryptronick' ),
                'param_name' => 'hide_media',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Content', 'cryptronick' ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__('Hide Title?', 'cryptronick' ),
                'param_name' => 'hide_blog_title',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Content', 'cryptronick' ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__('Hide Content?', 'cryptronick' ),
                'param_name' => 'hide_content',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Content', 'cryptronick' ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__('Hide all post-meta?', 'cryptronick' ),
                'param_name' => 'hide_postmeta',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Content', 'cryptronick' ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__('Hide post-meta author?', 'cryptronick' ),
                'param_name' => 'meta_author',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Content', 'cryptronick' ),
                'dependency' => array(
                    'element' => 'hide_postmeta',
                    'value_not_equal_to' => 'true',
                ),
                'std' => 'true'
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__('Hide post-meta comments?', 'cryptronick' ),
                'param_name' => 'meta_comments',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Content', 'cryptronick' ),
                'dependency' => array(
                    'element' => 'hide_postmeta',
                    'value_not_equal_to' => 'true',
                ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__('Hide post-meta categories?', 'cryptronick' ),
                'param_name' => 'meta_categories',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Content', 'cryptronick' ),
                'dependency' => array(
                    'element' => 'hide_postmeta',
                    'value_not_equal_to' => 'true',
                ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__('Hide post-meta date?', 'cryptronick' ),
                'param_name' => 'meta_date',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Content', 'cryptronick' ),
                'dependency' => array(
                    'element' => 'hide_postmeta',
                    'value_not_equal_to' => 'true',
                ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__('Hide Likes?', 'cryptronick' ),
                'param_name' => 'hide_likes',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Content', 'cryptronick' ),
                'std' => 'true'
            ),            
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__('Hide Post Share?', 'cryptronick' ),
                'param_name' => 'hide_share',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Content', 'cryptronick' ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__('Add Divider to the post-meta?', 'cryptronick' ),
                'param_name' => 'add_divider',
                'edit_field_class' => 'vc_col-sm-12',
                'group' => esc_html__( 'Content', 'cryptronick' ),
                'std' => 'true'
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Divider Style', 'cryptronick' ),
                'param_name' => 'blog_border_style',
                'value'         => array(
                    esc_html__( 'Solid', 'cryptronick' )     => 'solid',
                    esc_html__( 'Dashed', 'cryptronick' )   => 'dashed',
                    esc_html__( 'Dotted', 'cryptronick' )     => 'dotted',
                    esc_html__( 'Double', 'cryptronick' )      => 'double',
                    esc_html__( 'Inset', 'cryptronick' )      => 'inset',
                    esc_html__( 'Outset', 'cryptronick' )      => 'outset',
                ),
                'dependency' => array(
                    'element' => 'add_divider',
                    "value" => 'true'
                ),
                'group' => esc_html__( 'Content', 'cryptronick' ),
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Divider Width', 'cryptronick' ),
                'param_name' => 'blog_border_width',
                'value'         => array(
                    esc_html__( '1px', 'cryptronick' )      => '1px',
                    esc_html__( '2px', 'cryptronick' )      => '2px',
                    esc_html__( '3px', 'cryptronick' )      => '3px',
                    esc_html__( '4px', 'cryptronick' )      => '4px',
                    esc_html__( '5px', 'cryptronick' )      => '5px',
                    esc_html__( '6px', 'cryptronick' )      => '6px',
                    esc_html__( '7px', 'cryptronick' )      => '7px',
                    esc_html__( '8px', 'cryptronick' )      => '8px',
                    esc_html__( '9px', 'cryptronick' )      => '9px',
                    esc_html__( '10px', 'cryptronick' )      => '10px'
                ),
                'dependency' => array(
                    'element' => 'add_divider',
                    "value" => 'true'
                ),
                'group' => esc_html__( 'Content', 'cryptronick' ),
            ),
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Divider Color', 'cryptronick'),
                'param_name' => 'blog_border_color',
                'value' => '#eeeeee',
                'save_always' => true,
                'dependency' => array(
                    'element' => 'add_divider',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Content', 'cryptronick' ),
            ),
            // Post Read More Link
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Content Trim', 'cryptronick'),
                'param_name' => 'h_content_trime',
                'edit_field_class' => 'vc_col-sm-12',
                'group' => esc_html__( 'Content', 'cryptronick' ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__('Hide post read more link?', 'cryptronick' ),
                'param_name' => 'read_more_hide',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Content', 'cryptronick' ),
                'std' => 'true'
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Read More Text', 'cryptronick'),
                'param_name' => 'read_more_text',
                'edit_field_class' => 'vc_col-sm-8',
                'value' => 'Read More',
                'description' => esc_html__( 'Enter read more text.', 'cryptronick' ),
                'dependency' => array(
                    'element' => 'read_more_hide',
                    'value_not_equal_to' => 'true',
                ),
                'group' => esc_html__( 'Content', 'cryptronick' ),
            ),

            // Content Letter Count
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Content Letter Count', 'cryptronick'),
                'param_name' => 'content_letter_count',
                'value' => '85',
                'description' => esc_html__( 'Enter content letter count.', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
                'group' => esc_html__( 'Content', 'cryptronick' ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__('Crop Images for Posts List?', 'cryptronick' ),
                'param_name' => 'crop_square_img',
                'description' => esc_html__( 'For correctly work uploaded image size should be larger than 700px height and width.', 'cryptronick' ),
                'group' => esc_html__( 'Content', 'cryptronick' ),
            ),
            
            // --- CAROUSEL GROUP --- //
            array(
                "type"          => "bpt_checkbox",
                'heading' => esc_html__( 'Autoplay', 'cryptronick' ),
                "param_name"    => "autoplay",
                'dependency'    => array(
                    'element'   => 'blog_layout',
                    'value' => 'carousel'
                ),
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
            ),
            array(
                "type"          => "textfield",
                "heading"       => esc_html__( 'Autoplay Speed', 'cryptronick' ),
                "param_name"    => "autoplay_speed",
                "dependency"    => array(
                    "element"   => "autoplay",
                    "value" => 'true'
                ),
                'edit_field_class' => 'vc_col-sm-4',
                "value"         => "3000",
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
            ),
            // carousel pagination heading
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Pagination Controls', 'cryptronick'),
                'param_name' => 'h_pag_controls',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency'    => array(
                    'element'   => 'blog_layout',
                    'value' => 'carousel'
                ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Add Pagination control', 'cryptronick' ),
                'param_name' => 'use_pagination',
                'edit_field_class' => 'vc_col-sm-12',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'dependency'    => array(
                    'element'   => 'blog_layout',
                    'value' => 'carousel'
                ),
                'std' => 'true'
            ),
            array(
                'type' => 'cryptronick_dropdown',
                'heading' => esc_html__('Pagination Type', 'cryptronick'),
                'param_name' => 'pag_type',
                'fields' => array(
                    'circle' => array(
                        'image' => get_template_directory_uri() . '/img/bpt_composer_addon/icons/pag_circle.png',
                        'descr' => esc_html__('Circle', 'cryptronick')),
                    'square' => array(
                        'image' => get_template_directory_uri() . '/img/bpt_composer_addon/icons/pag_square.png',
                        'descr' => esc_html__('Square', 'cryptronick')),
                    'line' => array(
                        'image' => get_template_directory_uri() . '/img/bpt_composer_addon/icons/pag_line.png',
                        'descr' => esc_html__('Line', 'cryptronick')),
                    'line_circle' => array(
                        'image' => get_template_directory_uri() . '/img/bpt_composer_addon/icons/pag_line_circle.png',
                        'descr' => esc_html__('Line - Circle', 'cryptronick')),
                ),
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'dependency' => array(
                    'element' => 'use_pagination',
                    'value' => 'true',
                ),
                'value' => 'circle',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Pagination Top Offset', 'cryptronick' ),
                'param_name' => 'pag_offset',
                'value' => '',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
                'description' => esc_html__( 'Enter pagination top offset in pixels.', 'cryptronick' ),
                'dependency' => array(
                    'element' => 'use_pagination',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Custom Pagination Color', 'cryptronick' ),
                'param_name' => 'custom_pag_color',
                'edit_field_class' => 'vc_col-sm-4',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'dependency' => array(
                    'element' => 'use_pagination',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'colorpicker',
                'heading' => esc_html__('Pagination Color', 'cryptronick'),
                'param_name' => 'pag_color',
                'value' => esc_attr($theme_color),
                'dependency' => array(
                    'element' => 'custom_pag_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // carousel pagination heading            
            // carousel navigation heading
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Navigation Controls', 'cryptronick'),
                'param_name' => 'h_nav_controls',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency'    => array(
                    'element'   => 'blog_layout',
                    'value' => 'carousel'
                ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Add Navigation control', 'cryptronick' ),
                'param_name' => 'use_navigation',
                'edit_field_class' => 'vc_col-sm-12',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'dependency'    => array(
                    'element'   => 'blog_layout',
                    'value' => 'carousel'
                ),
                'std' => 'true'
            ),
            // carousel navigation heading
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Responsive', 'cryptronick'),
                'param_name' => 'h_resp',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency'    => array(
                    'element'   => 'blog_layout',
                    'value' => 'carousel'
                ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Customize Responsive', 'cryptronick' ),
                'param_name' => 'custom_resp',
                'dependency'    => array(
                    'element'   => 'blog_layout',
                    'value' => 'carousel'
                ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
            ),
            // medium desktop
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Medium Desktop', 'cryptronick'),
                'param_name' => 'h_resp_medium',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Screen resolution', 'cryptronick' ),
                'param_name' => 'resp_medium',
                'value' => '1025',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Slides to show', 'cryptronick' ),
                'param_name' => 'resp_medium_slides',
                'value' => '',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            
            // tablets
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Tablets', 'cryptronick'),
                'param_name' => 'h_resp_tablets',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Screen resolution', 'cryptronick' ),
                'param_name' => 'resp_tablets',
                'value' => '800',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Slides to show', 'cryptronick' ),
                'param_name' => 'resp_tablets_slides',
                'value' => '',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            // mobile phones
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Mobile Phones', 'cryptronick'),
                'param_name' => 'h_resp_mobile',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Screen resolution', 'cryptronick' ),
                'param_name' => 'resp_mobile',
                'value' => '480',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__( 'Slides to show', 'cryptronick' ),
                'param_name' => 'resp_mobile_slides',
                'value' => '',
                'group' => esc_html__( 'Carousel', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_resp',
                    'value' => 'true',
                ),
            ),

            // --- CUSTOM GROUP --- //
            array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Heading tag', 'cryptronick' ),
                'param_name' => 'heading_tag',
                'value'         => array(
                    esc_html__( 'H1', 'cryptronick' ) => 'h1',
                    esc_html__( 'H2', 'cryptronick' ) => 'h2',
                    esc_html__( 'H3', 'cryptronick' ) => 'h3',
                    esc_html__( 'H4', 'cryptronick' ) => 'h4',
                    esc_html__( 'H5', 'cryptronick' ) => 'h5',
                    esc_html__( 'H6', 'cryptronick' ) => 'h6',
                ),
                'description' => esc_html__('Select Type Heading tag.', 'cryptronick'),
                'std' => 'h4',
                'group' => esc_html__( 'Custom', 'cryptronick' ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Heading margin bottom', 'cryptronick'),
                'param_name' => 'heading_margin_bottom',
                'value' => '18px',
                'save_always' => true,
                'group' => esc_html__( 'Custom', 'cryptronick' ),
            ),  
            // Blog Headings Font
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Blog Headings Styles', 'cryptronick'),
                'param_name' => 'blog_heading_styles',
                'group' => esc_html__( 'Custom', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Custom font family for Blog Headings', 'cryptronick' ),
                'param_name' => 'custom_fonts_blog_headings',
                'group' => esc_html__( 'Custom', 'cryptronick' ),
            ),            
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_blog_headings',
                'value' => '',
                'settings' => array(
                    'fields' => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'cryptronick' ),
                        'font_style_description' => esc_html__( 'Select font styling.', 'cryptronick' ),
                    ),
                ),
                'dependency' => array(
                    'element' => 'custom_fonts_blog_headings',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Custom', 'cryptronick' ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Custom font size for Blog Headings', 'cryptronick' ),
                'param_name' => 'custom_fonts_blog_size_headings',
                'group' => esc_html__( 'Custom', 'cryptronick' ),
            ),
            // Heading Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Heading Font Size', 'cryptronick'),
                'param_name' => 'heading_font_size',
                'value' => '24',
                'description' => esc_html__( 'Enter heading font-size in pixels.', 'cryptronick' ),
                'group' => esc_html__( 'Custom', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_fonts_blog_size_headings',
                    'value' => 'true'
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Heading Line Height', 'cryptronick'),
                'param_name' => 'heading_line_height',
                'value' => '36',
                'description' => esc_html__( 'Enter heading line-height in pixels.', 'cryptronick' ),
                'group' => esc_html__( 'Custom', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_fonts_blog_size_headings',
                    'value' => 'true'
                ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Use Custom Heading Color', 'cryptronick' ),
                'param_name' => 'use_custom_heading_color',
                'description' => esc_html__( 'Select custom color', 'cryptronick' ),
                'group' => esc_html__( 'Custom', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Custom Headings Color', 'cryptronick'),
                'param_name' => 'custom_headings_color',
                'value' => esc_attr($header_font['color']),
                'description' => esc_html__('Select custom headings color.', 'cryptronick'),
                'dependency' => array(
                    'element' => 'use_custom_heading_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Custom', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),            
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Custom Hover Headings Color', 'cryptronick'),
                'param_name' => 'custom_hover_headings_color',
                'value' => esc_attr($theme_color),
                'description' => esc_html__('Select custom hover headings color.', 'cryptronick'),
                'dependency' => array(
                    'element' => 'use_custom_heading_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Custom', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-4',
            ),
            // Blog Font
            // Blog Headings Font
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Blog Content Styles', 'cryptronick'),
                'group' => esc_html__( 'Custom', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
                'param_name' => 'blog_content_styles',
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Custom font family for Blog Content', 'cryptronick' ),
                'param_name' => 'custom_fonts_blog_content',
                'group' => esc_html__( 'Custom', 'cryptronick' ),
            ),
            array(
                'type' => 'google_fonts',
                'param_name' => 'google_fonts_blog',
                'value' => '',
                'settings' => array(
                    'fields' => array(
                        'font_family_description' => esc_html__( 'Select font family.', 'cryptronick' ),
                        'font_style_description' => esc_html__( 'Select font styling.', 'cryptronick' ),
                    ),
                ),
                'dependency' => array(
                    'element' => 'custom_fonts_blog_content',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Custom', 'cryptronick' ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Custom font size for Blog Content', 'cryptronick' ),
                'param_name' => 'custom_fonts_blog_size_content',
                'group' => esc_html__( 'Custom', 'cryptronick' ),
            ),
            // Heading Font Size
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Content Font Size', 'cryptronick'),
                'param_name' => 'content_font_size',
                'value' => '16',
                'description' => esc_html__( 'Enter content font-size in pixels.', 'cryptronick' ),
                'group' => esc_html__( 'Custom', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_fonts_blog_size_content',
                    'value' => 'true'
                ),
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Content Line Height', 'cryptronick'),
                'param_name' => 'content_line_height',
                'value' => '30',
                'description' => esc_html__( 'Enter content line-height in pixels.', 'cryptronick' ),
                'group' => esc_html__( 'Custom', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
                'dependency' => array(
                    'element' => 'custom_fonts_blog_size_content',
                    'value' => 'true'
                ),
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Use Custom Content Color', 'cryptronick' ),
                'param_name' => 'use_custom_content_color',
                'description' => esc_html__( 'Select custom color', 'cryptronick' ),
                'group' => esc_html__( 'Custom', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Custom Content Color', 'cryptronick'),
                'param_name' => 'custom_content_color',
                'value' => esc_attr($main_font['color']),
                'description' => esc_html__('Select custom content color.', 'cryptronick'),
                'dependency' => array(
                    'element' => 'use_custom_content_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Custom', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
             // Blog Style
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Blog Styles', 'cryptronick'),
                'group' => esc_html__( 'Custom', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12',
                'param_name' => 'blog_content_styles',
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Use Custom Main Color', 'cryptronick' ),
                'param_name' => 'use_custom_main_color',
                'description' => esc_html__( 'Custom blog font size and font color.', 'cryptronick' ),
                'group' => esc_html__( 'Custom', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-7',
            ),
            // Custom blog style
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Custom Main Color', 'cryptronick'),
                'param_name' => 'custom_main_color',
                'value' => '#e2e2e2',
                'description' => esc_html__('Select custom main color.', 'cryptronick'),
                'dependency' => array(
                    'element' => 'use_custom_main_color',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Custom', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-5 clearfix-col',
            ),
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Add Background Posts', 'cryptronick' ),
                'param_name' => 'custom_blog_bg',
                'description' => esc_html__( 'Custom blog posts background', 'cryptronick' ),
                'group' => esc_html__( 'Custom', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-7',
            ),
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Background Color', 'cryptronick'),
                'param_name' => 'custom_bg_mask_color',
                'value' => esc_attr('rgba(14,21,30,.6)'),
                'dependency' => array(
                    'element' => 'custom_blog_bg',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Custom', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-5',
            ),             
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Add Mask Image', 'cryptronick' ),
                'param_name' => 'custom_blog_mask',
                'description' => esc_html__( 'Custom blog image', 'cryptronick' ),
                'group' => esc_html__( 'Custom', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-7',
            ),
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Mask Image Color', 'cryptronick'),
                'param_name' => 'custom_image_mask_color',
                'value' => esc_attr('rgba(14,21,30,.6)'),
                'dependency' => array(
                    'element' => 'custom_blog_mask',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Custom', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-5',
            ),            
            array(
                'type' => 'bpt_checkbox',
                'heading' => esc_html__( 'Add Hover Mask', 'cryptronick' ),
                'param_name' => 'custom_blog_hover_mask',
                'description' => esc_html__( 'Custom blog hover mask', 'cryptronick' ),
                'group' => esc_html__( 'Custom', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-7',
            ),
            array(
                'type' => 'colorpicker',
                'class' => '',
                'heading' => esc_html__('Mask Hover Image Color', 'cryptronick'),
                'param_name' => 'custom_image_hover_mask_color',
                'value' => esc_attr('rgba(14,21,30,.6)'),
                'dependency' => array(
                    'element' => 'custom_blog_hover_mask',
                    'value' => 'true'
                ),
                'group' => esc_html__( 'Custom', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-5',
            ),
            array(
                'type' => 'cryptronick_param_heading',
                'heading' => esc_html__('Blog Post Paddings', 'cryptronick'),
                'param_name' => 'heading_p',
                'group' => esc_html__( 'Spacing', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-12 no-top-margin',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Blog Post Left Padding', 'cryptronick'),
                'param_name' => 'blog_left_pad',
                'value' => '',
                'group' => esc_html__( 'Spacing', 'cryptronick' ),
                'description' => esc_html__( 'Enter button left padding in pixels.', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Blog Post Right Padding', 'cryptronick'),
                'param_name' => 'blog_right_pad',
                'value' => '',
                'group' => esc_html__( 'Spacing', 'cryptronick' ),
                'description' => esc_html__( 'Enter button right padding in pixels.', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Blog Post Top Padding', 'cryptronick'),
                'param_name' => 'blog_top_pad',
                'value' => '',
                'group' => esc_html__( 'Spacing', 'cryptronick' ),
                'description' => esc_html__( 'Enter button top padding in pixels.', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Blog Post Bottom Padding', 'cryptronick'),
                'param_name' => 'blog_bottom_pad',
                'value' => '',
                'group' => esc_html__( 'Spacing', 'cryptronick' ),
                'description' => esc_html__( 'Enter button bottom padding in pixels.', 'cryptronick' ),
                'edit_field_class' => 'vc_col-sm-6',
            ),
        ),

    ));

    class WPBakeryShortCode_bpt_Blog_Posts extends WPBakeryShortCode
    {
    }
}