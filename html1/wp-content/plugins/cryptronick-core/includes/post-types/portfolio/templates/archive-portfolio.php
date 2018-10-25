<?php
get_header();


$term_slug = isset(get_queried_object()->term_id) ? get_queried_object()->term_id : '';
$term_slug = !empty($term_slug) ? '|tax_query:'.$term_slug.'' : '';

//Show Filter Options
$show_filter = Cryptronick_Theme_Helper::get_option('portfolio_list_show_filter');
$list_terms =  Cryptronick_Theme_Helper::get_option('portfolio_list_filter_cats');

if(!empty($term_slug)){
    $show_filter = '';
}

if(!empty($show_filter) && !empty($list_terms)){
    $term_slug = '|tax_query:'.implode(', ', $list_terms).'';
}

$build_query = 'size:12|order_by:menu_order|order:ASC|post_type:portfolio'.$term_slug.'';
$defaults = array(
    'title' => '',
    'subtitle' => '',
    'view_all_link' => '',
    'show_view_all' => 'no',
    'posts_per_row' => Cryptronick_Theme_Helper::get_option('portfolio_list_columns'),
    'item_el_class' => '', 
    'css' => '',
    'show_portfolio_title' => Cryptronick_Theme_Helper::get_option('portfolio_list_show_title'),
    'show_content' => Cryptronick_Theme_Helper::get_option('portfolio_list_show_content'),
    'show_meta_categories' => Cryptronick_Theme_Helper::get_option('portfolio_list_show_cat'),
    'view_style' => 'ajax',
    'show_filter' => $show_filter,
    'crop_images' => 'yes',
    'items_load' => '4',
    'grid_gap' => '30px',
    'add_overlay' => 'true',
    'portfolio_layout' => 'masonry',
    'custom_overlay_color' => 'rgba(34,35,40,.7)',
    'build_query' => $build_query
);
extract($defaults);
$layout = Cryptronick_Theme_Helper::get_option('portfolio_list_sidebar_layout');
$sidebar = Cryptronick_Theme_Helper::get_option('portfolio_list_sidebar_def');
$column = 12;

if ( $layout == 'left' || $layout == 'right' ) {
    $column = 9;
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
                    $portfolio_render = new BptPortfolio();
                    echo $portfolio_render->render($defaults);
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
