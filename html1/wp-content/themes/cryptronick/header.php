<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>">
    <?php echo((Cryptronick_Theme_Helper::get_option('responsive') == "1") ? '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">' : ''); ?>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <link rel="pingback" href="<?php esc_url(bloginfo('pingback_url')); ?>">
    <?php 
        wp_head(); 
    ?>
</head>

<body <?php body_class(); ?> data-theme-color="<?php echo esc_attr(Cryptronick_Theme_Helper::get_option('theme-custom-color')); ?>">
    <?php 
        Cryptronick_Theme_Helper::preloader();
        get_template_part('templates/header/section','header');
        get_template_part('templates/header/section','page_title');
        
    ?>
    <div class="site_wrapper fadeOnLoad">
        <?php
            $page_shortcode = '';
            if (class_exists( 'RWMB_Loader' )) {
                $page_shortcode = rwmb_meta('mb_page_shortcode');
                if (strlen($page_shortcode) > 0) {
                    echo do_shortcode($page_shortcode);
                }
            }
        ?>
        <div class="main_wrapper">