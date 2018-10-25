<?php
if (function_exists('add_theme_support')) {
    add_theme_support('post-thumbnails', array('post', 'page', 'port', 'team', 'testimonials', 'product', 'gallery'));
    add_theme_support('automatic-feed-links');
    add_theme_support('revisions');
    add_theme_support('post-formats', array('gallery', 'video', 'quote', 'audio', 'link'));
}

#Support menus
add_action('init', 'register_my_menus');
function register_my_menus()
{
    register_nav_menus(
        array(
            'main_menu' => esc_html__('Main menu', 'cryptronick'),
            'top_header_menu' => esc_html__('Top Header Menu', 'cryptronick'),
            'footer_menu' => esc_html__( 'Footer Menu', 'cryptronick' )
        )
    );
}

#ADD localization folder
add_action('init', 'enable_pomo_translation');
function enable_pomo_translation()
{
    load_theme_textdomain('cryptronick', get_template_directory() . '/core/languages/');
}
