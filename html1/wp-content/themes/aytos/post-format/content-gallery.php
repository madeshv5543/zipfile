<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="blog_item">
		<?php $images = rwmb_meta( 'klb_blogitemslides', 'type=image_advanced&size=medium' ); ?>
		<?php if($images) { ?>
			<?php wp_enqueue_script('cryptoking_slidepost');  ?>
			<div class="blog_img entry-media">
				<div class="post-slider owl-carousel owl-theme">
				<?php  foreach ( $images as $image ) { ?>
					<?php  $resize = cryptoking_resize( $image['full_url'], 750, 500, true, true, true ); ?>   
					<img src="<?php echo esc_url($resize); ?>" alt="blogimage">
				<?php } ?>
				</div>
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