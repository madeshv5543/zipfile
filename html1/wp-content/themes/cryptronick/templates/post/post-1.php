<?php
    $single = Cryptronick_SinglePost::getInstance();
    $single->set_data();

    $title = get_the_title();

	$show_likes = Cryptronick_Theme_Helper::get_option('single_likes');
	$show_share = Cryptronick_Theme_Helper::get_option('single_share');
	$single_author_info = Cryptronick_Theme_Helper::get_option('single_author_info');
	$single_cats = Cryptronick_Theme_Helper::get_option('single_meta_categories');
	$single_meta = Cryptronick_Theme_Helper::get_option('single_meta');
	$featured_image = Cryptronick_Theme_Helper::options_compare('post_hide_featured_image', 'mb_post_hide_featured_image', '1');

	$meta_args = array();
	if ( !(bool)$single_meta ) {
		$meta_args['date'] = !(bool)Cryptronick_Theme_Helper::get_option('single_meta_date');
		$meta_args['author'] = !(bool)Cryptronick_Theme_Helper::get_option('single_meta_author');
		$meta_args['comments'] = !(bool)Cryptronick_Theme_Helper::get_option('single_meta_comments');
		
	}
?>

<div class="blog-post blog-post-single-item format-<?php echo esc_attr($single->get_pf()); ?>">
	<div <?php post_class("single_meta"); ?>>
		<div class="item_wrapper">
			<div class="blog-post_content">
				<?php
					if( !(bool) $single_cats ){
						echo "<div class='blog-post_cats'>";
							$single->render_post_cats();
						echo "</div>";
					}				
				?>
				<h1 class="blog-post_title"><?php echo get_the_title(); ?></h1>
				<?php
					//Post Meta render	
					if ( !(bool)$single_meta ) {
						$single->render_post_meta($meta_args);
					}

					if((bool) $single->get_excerpt()){
						echo "<div class='short_desc blog-post_excerpt'>".$single->get_excerpt()."</div>";
					}
					if(!(bool) $featured_image){
						$single->render_featured();	
					}
							
				?>
				<div class="clear"></div>
				<?php
					?>
					<?php
					the_content();
					wp_link_pages(array('before' => '<div class="page-link"><span class="pagger_info_text">' . esc_html__('Pages', 'cryptronick') . ': </span>', 'after' => '</div>'));

				if (has_tag() || (bool)$show_likes) {
					?>		
					<div class="post_info single_post_info">
						<?php
						the_tags('<div class="tagcloud">', ' ', '</div>');

						// Likes in blog
		                if ( (bool)$show_likes ) : ?>              
		                	<div class="blog-post_likes-wrap">
		                		<?php
		                		if ( (bool)$show_likes && function_exists('bpt_simple_likes')) {
		                			echo bpt_simple_likes()->likes_button( get_the_ID(), 0 );
		                		} 
		                		?>
		                	</div>
		                    <?php
		                endif;
							?>
					</div>
					<?php
				}
				
				if ( (bool)$show_share ) {
					$single->render_post_share($show_share);
				}

				if ( (bool)$single_author_info ) {
					$single->render_author_info();
				} 
				?>
				<div class="clear"></div>
			</div>
		</div>
	</div>
</div>