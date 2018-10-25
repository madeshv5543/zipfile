<?php 
if ( !post_password_required() ) {
	get_header();

	$layout = Cryptronick_Theme_Helper::get_option('portfolio_single_sidebar_layout');
	$sidebar = Cryptronick_Theme_Helper::get_option('portfolio_single_sidebar_def'); 

	$cryptronick_core = class_exists('bpt_cryptronick_core');
    if(!$cryptronick_core){
        if(is_active_sidebar( 'sidebar_main-sidebar' )){
            $layout = 'right';
            $sidebar = 'sidebar_main-sidebar';
        }
    }
    
	if (class_exists( 'RWMB_Loader' )) {
		$mb_layout = rwmb_meta('mb_page_sidebar_layout');
		if (!empty($mb_layout) && $mb_layout != 'default') {
			$layout = $mb_layout;
			$sidebar = rwmb_meta('mb_page_sidebar_def');
		}
	}
	$column = 12;
	if ( $layout == 'left' || $layout == 'right' ) {
		$column = 9;
	}else{
		$sidebar = '';
	}
	$row_class = ' sidebar_'.$layout;
	$defaults = array(
	    'posts_per_row' => '1',
	);
?>

<div class="container single_portfolio">
        <div class="row<?php echo esc_attr($row_class); ?>">
            <div class="content-container span<?php echo (int)esc_attr($column); ?>">
                <section id='main_content'>
                	<?php
                		while ( have_posts() ):
						the_post();
						$item = new BptPortfolio();
						echo $item->bpt_portfolio_single_item($defaults, $item_class = '');
						endwhile;
						wp_reset_postdata();

						$prev_post = get_adjacent_post(false, '', true);
						$next_post = get_adjacent_post(false, '', false);

						if ($next_post || $prev_post):
	                		?>
		                	<!-- prev next links -->
							<div class="prev-next-links">
								<?php
								if($prev_post){
									$post_url = get_permalink($prev_post->ID);
									
									$image_prev_url = wp_get_attachment_image_src(get_post_thumbnail_id($prev_post->ID), array(50, 50));

									$img_prev_html = '';
									if(isset($image_prev_url[0]) && !empty($image_prev_url[0])){
										$img_prev_html .= "<span class='image_prev'><img src='" . esc_url( $image_prev_url[0] ) . "' alt='". esc_html($prev_post->post_title) ."'/></span>";
									}

									echo '<div class="prev-link_wrapper"><a class="prev-link" href="' . esc_url($post_url) . '" title="' . esc_html($prev_post->post_title) . '"><i class="prev-link_icon"></i><span>'.esc_html__('Previous Post', 'cryptronick').'</span></a>';
										echo '<div class="info_prev-link_wrapper"><a href="' . esc_url($post_url) . '" title="' . esc_html($prev_post->post_title) . '">'.$img_prev_html.'<span class="prev_title">'.esc_html($prev_post->post_title) .'</span></a></div>';
									echo '</div>';
								}
								if($next_post) {
									$post_url = get_permalink($next_post->ID);

									$image_next_url = wp_get_attachment_image_src(get_post_thumbnail_id($next_post->ID), array(50, 50));

									$img_next_html = '';
									if(isset($image_next_url[0]) && !empty($image_next_url[0])){
										$img_next_html .= "<span class='image_next'><img src='" . esc_url( $image_next_url[0] ) . "' alt='". esc_html($next_post->post_title) ."'/></span>";
									}
									echo '<div class="next-link_wrapper"><a class="next-link" href="' . esc_url($post_url) . '" title="' . esc_html($next_post->post_title) . '"><span>'.esc_html__('Next Post', 'cryptronick').'</span><i class="next-link_icon"></i></a>';
									echo '<div class="info_next-link_wrapper"><a href="' . esc_url($post_url) . '" title="' . esc_html($next_post->post_title) . '"><span class="next_title">'.esc_html($next_post->post_title) .'</span>'.$img_next_html.'</a></div>';
									echo '</div>';
								}
								?>
								<div class="clear"></div>
							</div>
							<!-- //prev next links -->
							<?php
						endif;         

					$show_post_related = Cryptronick_Theme_Helper::get_option('portfolio_single_related_posts');
					if ( (bool)$show_post_related && class_exists('Vc_Manager')) :
					    $mb_pf_show_r = $mb_pf_carousel_r = $mb_pf_column_r = $mb_pf_number_r = $mb_pf_title_r ='';
					    $mb_pf_cat_r = array();

					    if (class_exists( 'RWMB_Loader' )) {
					        $mb_pf_carousel_r 	  = rwmb_meta('mb_pf_carousel_r');
					        $mb_pf_show_r 	  	  = rwmb_meta('mb_pf_show_r');
					        $mb_pf_title_r 	  	  = rwmb_meta('mb_pf_title_r');
					        $mb_pf_cat_r   		  = get_post_meta(get_the_id(), 'mb_pf_cat_r'); // store terms’ IDs in the post meta and doesn’t set post terms.
					        $mb_pf_column_r 	  = rwmb_meta('mb_pf_column_r');
					        
					        $mb_pf_number_r 	  = rwmb_meta('mb_pf_number_r');
					        $mb_pf_number_r 	  = !empty($mb_pf_number_r) ? $mb_pf_number_r : '12';
					    }		    
					    
						$cats = get_the_terms( get_the_id(), 'portfolio-category' );
						$cats = $cats ? $cats : array(); 
						$cat_slugs = array();
						foreach( $cats as $cat ){
							$cat_slugs[] = $cat->term_taxonomy_id;
						}
						$cat_slugs = !empty( $cat_slugs ) ? implode(",", $cat_slugs) : null;
					    $mb_pf_cat_r = !empty($mb_pf_cat_r[0]) ? $mb_pf_cat_r[0] : $cat_slugs;
					    
						if ($mb_pf_show_r == "1" && class_exists('Vc_Manager')) {
							$atts = array(
								'portfolio_layout' => 'related',
							    'title' => '',
							    'mb_pf_carousel_r' => $mb_pf_carousel_r,
							    'subtitle' => '',
							    'view_all_link' => '',
							    'show_view_all' => 'no',
							    'posts_per_row' => !empty($mb_pf_column_r) ? $mb_pf_column_r : "4",
							    'item_el_class' => '', 
							    'css' => '',
							    'view_style' => 'standard',
							    'crop_images' => 'yes',
							    'show_portfolio_title' => 'true',
							    'show_meta_categories' => 'true',
							    'add_overlay' => 'true',
							    'custom_overlay_color' => 'rgba(34,35,40,.7)',
							    'items_load' => !empty($mb_pf_column_r) ? $mb_pf_column_r : "4",
							    'grid_gap' => '30px',
							    'featured_render' => '1',
							    'build_query' => "size:{$mb_pf_number_r}|order_by:menu_order|tax_query:{$mb_pf_cat_r}|order:ASC|post_type:portfolio"
							);
							$featured_render = new BptPortfolio();

							$featured_post = $featured_render->render($atts);
							if($featured_render->post_count > 0){
								echo '<div class="related_portfolio">';
									if(!empty($mb_pf_title_r)){
										echo '<div class="cryptronick_module_title"><h3>' . esc_html($mb_pf_title_r) . '</h3></div>';
									}
						        	echo $featured_post;
								echo '</div>';
							}

						}	
					endif;
					if (comments_open() || get_comments_number()) {?>
						<div class="row">
							<div class="span12">
								<?php comments_template('', true); ?>
							</div>
						</div>
					<?php } ?>
				</section>
			</div>
			<?php
			if ( in_array($layout, array('left', 'right'), true) ) {
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