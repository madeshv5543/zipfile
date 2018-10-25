<?php
get_header();

$layout = Cryptronick_Theme_Helper::get_option('blog_list_sidebar_layout');
$sidebar = Cryptronick_Theme_Helper::get_option('blog_list_sidebar_def');
$sidebar_width = Cryptronick_Theme_Helper::get_option('blog_list_sidebar_def_width');
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
                    // List of Post
                    get_template_part('templates/post/posts-list');
                    // Pagination
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
    
<?php get_footer(); ?>