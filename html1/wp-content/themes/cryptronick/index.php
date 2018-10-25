<?php
if ( !post_password_required() ) {
    get_header();
    ?>

    <?php
    $layout = Cryptronick_Theme_Helper::get_option('page_sidebar_layout');
    $sidebar = Cryptronick_Theme_Helper::get_option('page_sidebar_def');
    $sidebar_width = Cryptronick_Theme_Helper::get_option('page_sidebar_def_width');
    $column = 12;

    if ( $layout == 'left' || $layout == 'right' ) {
        $column = (int) $sidebar_width;
    }else{
        $sidebar = '';
    }
    $row_class = ' sidebar_'.$layout;
    ?>

    <div class="container">
        <div class="row<?php echo esc_attr($row_class); ?>">
            <div class="content-container span<?php echo (int)esc_attr($column); ?>">
                <section id='main_content'>
                    <?php
                        get_template_part('templates/post/posts-list');
                        echo Cryptronick_Theme_Helper::pagination();
                    ?>
                </section>
            </div>
            <?php
            if ($layout == 'left' || $layout == 'right') {
                echo '<div class="sidebar-container span'.(12 - (int)esc_attr($column)).'">';
                if (is_active_sidebar( $sidebar )) {
                    echo "<aside class='sidebar'>";
                    dynamic_sidebar( $sidebar );
                    echo "</aside>";
                }
                echo "</div>";
            }
            ?>
        </div>

    </div>

    <?php

    get_footer();

} else {
    get_header();
    ?>
    <div class="wrapper_404 height_100percent pp_block">
        <div class="container_vertical_wrapper">
            <div class="container a-center pp_container">
                <h1><?php echo esc_html__('Password Protected', 'cryptronick'); ?></h1>
                <h2><?php echo esc_html__('This content is password protected. Please enter your password below to continue.', 'cryptronick'); ?></h2>
                <?php the_content(); ?>
            </div>
        </div>
    </div>
    <?php
    get_footer();
} ?>