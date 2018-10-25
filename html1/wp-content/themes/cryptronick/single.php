<?php 
if ( !post_password_required() ) {
	get_header();
	the_post();

	$layout = Cryptronick_Theme_Helper::get_option('single_sidebar_layout');
	$sidebar = Cryptronick_Theme_Helper::get_option('single_sidebar_def'); 
	$sidebar_width = Cryptronick_Theme_Helper::get_option('single_sidebar_column'); 

	$cryptronick_core = class_exists('bpt_cryptronick_core');
    if(!$cryptronick_core){
        if(is_active_sidebar( 'sidebar_main-sidebar' )){
            $layout = 'right';
            $sidebar = 'sidebar_main-sidebar';
            $sidebar_width = 8;
        }
    }
    
	if (class_exists( 'RWMB_Loader' )) {
		$mb_layout = rwmb_meta('mb_page_sidebar_layout');
		if (!empty($mb_layout) && $mb_layout != 'default') {
			$layout = $mb_layout;
			$sidebar = rwmb_meta('mb_page_sidebar_def');
			$sidebar_width = rwmb_meta('mb_page_sidebar_def_width');
		}
	}
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
                		get_template_part('templates/post/post-1');

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

					$show_post_related = Cryptronick_Theme_Helper::get_option('single_related_posts');
					if ( (bool)$show_post_related && class_exists('Vc_Manager')) : ?>
						<?php

						$mb_blog_show_r = $mb_blog_carousel_r = $mb_blog_column_r = $mb_blog_number_r = $mb_blog_title_r ='';
					    $mb_blog_cat_r = array();

					    if (class_exists( 'RWMB_Loader' )) {
					        $mb_blog_carousel_r 	  = rwmb_meta('mb_blog_carousel_r');
					        $mb_blog_show_r 	  	  = rwmb_meta('mb_blog_show_r');
					        $mb_blog_title_r 	  	  = rwmb_meta('mb_blog_title_r');
					        $mb_blog_cat_r   		  = get_post_meta(get_the_id(), 'mb_blog_cat_r'); // store terms’ IDs in the post meta and doesn’t set post terms.
					        $mb_blog_column_r 	  = rwmb_meta('mb_blog_column_r');
					        
					        $mb_blog_number_r 	  = rwmb_meta('mb_blog_number_r');
					        $mb_blog_number_r 	  = !empty($mb_blog_number_r) ? $mb_blog_number_r : (($layout == "none") ? "3" : "2");
					    }		    
						if ($mb_blog_show_r == "1" && class_exists('Vc_Manager')) {
						?>

						<div class='single related_posts'>
						<?php
							// Related Posts
							// Get Cats_ID
							$categories = $post_category_compile = '';
							if (get_the_category()) $categories = get_the_category();
							if ($categories) {
								$post_categ = '';
								foreach ($categories as $category) {
									$post_categ = $post_categ . $category->cat_ID . ',';
								}
								$post_category_compile .= '' . trim($post_categ, ',') . '';

								$mb_blog_cat_r = !empty($mb_blog_cat_r[0]) ? $mb_blog_cat_r[0] : $post_category_compile;
							}

							echo '<div class="cryptronick_module_title"><h3>'.(!empty($mb_blog_title_r) ? esc_html($mb_blog_title_r) : esc_html__('Related Posts', 'cryptronick')) .' </h3></div>';
							echo do_shortcode('[bpt_blog_posts 
								blog_layout="'.(!empty($mb_blog_carousel_r) ? 'carousel' : 'grid').'"
								hide_content="true"
								meta_author="true"
								use_navigation=""
								blog_left_pad="0"
								blog_right_pad="0"
								hide_likes="true"
								read_more_hide="true"
								crop_square_img="true"
								heading_tag="h4"
								blog_border_style="solid"
								blog_border_width="1px"
								blog_border_color="#eeeeee"
								add_divider="true"
								pag_type="line_circle"
								blog_columns="' . (!empty($mb_blog_column_r) ? $mb_blog_column_r : (($layout == "none") ? "4" : "6") ).'"
								build_query="size:'.$mb_blog_number_r.'|order_by:rand|categories:'.$mb_blog_cat_r.'"]');?>
						</div>
						<?php
						}
					endif;
					if (comments_open() || get_comments_number()) {?>
						<div class="row">
							<div class="span12">
								<?php comments_template(); ?>
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
				<h1 class="mb55"><?php echo esc_html__('Password Protected', 'cryptronick'); ?></h1>
				<?php the_content(); ?>
			</div>
		</div>
	</div>
<?php 
	get_footer();
} ?>