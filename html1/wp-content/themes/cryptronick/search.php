<?php 
get_header();

$layout = Cryptronick_Theme_Helper::get_option('page_sidebar_layout');
$sidebar = Cryptronick_Theme_Helper::get_option('page_sidebar_def');
$sidebar_width = Cryptronick_Theme_Helper::get_option('page_sidebar_def_width');
$column = 12;

if ( $layout == 'left' || $layout == 'right' ) {
    $column = (int) $sidebar_width;
}else{
    $sidebar = '';
}
$row_class = ' sidebar_'.esc_attr($layout);

global $wp_query;

    if ('tours' == $wp_query->query_vars['post_type']) {
        get_template_part( 'tours', 'search' );
    }else{


?>
    <div class="container">
        <div class="row<?php echo esc_attr($row_class); ?>">
            <div class="content-container span<?php echo (int)$column; ?>">
                <section id='main_content'>
                    <?php

                    global $paged, $offset, $posts_per_page;

                    $offset = 0;
                    $posts_per_page = 10;
                    $foundSomething = false;

                    $defaults = array('numberposts' => 10, 'offset' => 0, 'post_type' => 'any', 'post_status' => 'publish', 'post_password' => '', 'suppress_filters' => false, 's' => get_search_query(), 'paged' => $paged);
                    $query = http_build_query($defaults);
                    $posts = get_posts($query);

                    foreach ($posts as $post) {
                        setup_postdata($post);
                        ?>
                        <div class="blog-post">
                            <div class="blog-post_content">
                                <div class="meta-wrapper">
                                    <span><?php echo esc_html(get_the_time(get_option('date_format'))); ?></span>
                                    <span><?php echo esc_html__('by', 'cryptronick'); ?> <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>" class="text-capitalize"><?php echo esc_html(get_the_author_meta('display_name')); ?></a></span>
                                </div>
                                <h3 class="blog-post_title"><a href="<?php echo esc_url(get_permalink()); ?>"><?php esc_html(the_title()); ?></a></h3>
                            </div>
                        </div>
                        <?php

                        $foundSomething = true;
                    }

                    if ($foundSomething == false) {
                        ?>
                        <div class="wrapper_404_section height_100percent pp_block">
                            <div class="container_vertical_wrapper">
                                <div class="container a-center pp_container">
                                    <h1><?php echo esc_html__('Oops!', 'cryptronick'); ?> <?php echo esc_html__('Not Found!', 'cryptronick'); ?></h1>
                                    <h2 class='mb45'><?php echo esc_html__('Apologies, but we were unable to find what you were looking for.', 'cryptronick'); ?></h2>
                                    <div class="search_result_form text-center">
                                        <?php get_search_form(true); ?>
                                    </div>
                                    <div class="cryptronick_404_button cryptronick_module_button button_gradient">
                                        <a class="button_size_large" href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Take me home', 'cryptronick'); ?></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }

                    echo Cryptronick_Theme_Helper::pagination();

                    ?>
                </section>
            </div>
            <?php
            if ($layout == 'left' || $layout == 'right') {
                echo '<div class="sidebar-container span'.(12 - (int)$column).'">';
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
    }
get_footer(); ?>