<?php 
get_header();
$defaults = array(
    'title' => '',
    'posts_per_line' => '4',
    'bg_color_type' => 'def',
    'add_shadow' => true,
    'grid_gap' => '30',
    'info_align' => 'center',
);
$build_query = "size:all|order_by:title|order:ASC|post_type:team";
extract($defaults);

$compile = $team_classes = '';

$style_gap = ($grid_gap != '0px') ? ' style="margin-right:-'.esc_attr($grid_gap).'"' : '';

$team_classes .= 'team-col_'.$posts_per_line;
$team_classes .= (bool)$add_shadow ? ' with_shadow' : '';
$team_classes .= ' align-'.$info_align;
$team_classes .= ($bg_color_type != 'color') ? ' bg_gradient' : '';

?>
<div class="container">
    <div class="content-container"> 
        <section id='main_content'>
            <div class="bpt_module_team <?php echo esc_attr($team_classes); ?>">
                <div class="team-items_wrap clearfix" <?php echo Cryptronick_Theme_Helper::render_html($style_gap);?> >
                    <?php
                    echo render_bpt_team($defaults, $build_query);
                    ?>
                </div>
            </div>
        </section>
    </div>
</div>
<?php 
get_footer();
?>