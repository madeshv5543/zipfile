<?php
$layout = Cryptronick_Theme_Helper::get_option('page_sidebar_layout');
$sidebar = Cryptronick_Theme_Helper::get_option('page_sidebar_def');
$sidebar_width = Cryptronick_Theme_Helper::get_option('page_sidebar_def_width');
if (class_exists( 'RWMB_Loader' )) {
    $mb_layout = rwmb_meta('mb_page_sidebar_layout');
    if (!empty($mb_layout) && $mb_layout != 'default') {
        $layout = $mb_layout;
        $sidebar = rwmb_meta('mb_page_sidebar_def');
    }
}
$column = 12;
if ( $layout == 'left' || $layout == 'right' ) {
    $column = (int) $sidebar_width;
}else{
    $sidebar = '';
}
$row_class = ' sidebar_'.$layout;

get_header ();

$defaults = array(
    'title' => '',
    'posts_per_line' => '4',
    'grid_gap' => '30',
    'info_align' => 'center',
    'add_shadow' => true,
    'single_link' => false,
    'hide_title' => false,
    'hide_department' => false,
    'hide_soc_icons' => false,
    'add_member' => false,
    'member_image' => '',
    'member_link' => '',
);
extract($defaults);
$team_image_dims = array('width' => '860', 'height' => '860');
?>

<div class="container">
	<div class="row<?php echo esc_attr($row_class); ?>">
	    <div class="content-container span<?php echo (int)$column; ?>">
	        <section id='main_content'>
	        	<?php
	        		while ( have_posts() ):
						the_post();
						?>
							<div class="row single_team_page">
								<div class="span12">
									<?php echo render_bpt_team_item(true, $defaults, $team_image_dims); ?>
								</div>
								<div class="span12">
									<!-- <div class="team_title"><h2><?php echo get_the_title(); ?></h2></div> -->
									<?php the_content(esc_html__('Read more!', 'cryptronick')); ?>
								</div>
							</div>
						<?php
					endwhile;
					wp_reset_postdata();
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
get_footer();
?>