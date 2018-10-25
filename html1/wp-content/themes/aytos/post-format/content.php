<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="blog_item">
		<?php if (  (function_exists('has_post_thumbnail')) && (has_post_thumbnail())  ) { ?>
			<?php  
			$att=get_post_thumbnail_id();
			$image_src = wp_get_attachment_image_src( $att, 'full' );
			$image_src = $image_src[0]; 
			?>
			<div class="blog_img">
				<a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($image_src); ?>" alt="<?php the_title(); ?>"/></a>
			</div>
		<?php } ?>
		<div class="blog_content">
			<h3 class="blog_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
			<ul class="list_none blog_meta">
				<li><a href="<?php the_permalink(); ?>"><i class="ion-clock"></i> <?php echo get_the_date(); ?></a></li>
				<li><i class="ion-ios-folder-outline"></i> <?php the_category(', '); ?></li>
				<?php the_tags( '<li><i class="ion-ios-pricetags-outline"></i> ', ', ', ' </li>'); ?>
				<?php if ( is_sticky()) {
					printf( '<li><i class="ion-alert"></i> <span class="sticky-post">%s</span></li>', esc_html__( 'Featured', 'cryptoking' ) );
				} ?>
			</ul>
			<?php the_excerpt(); ?>
			<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
		</div>
	</div>
</article>