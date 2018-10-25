<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="blog_item">
		<div class="blog_img">
		   <?php  
			if (get_post_meta( get_the_ID(), 'klb_blog_video_type', true ) == 'vimeo') {  
			  echo '<iframe src="http://player.vimeo.com/video/'.get_post_meta( get_the_ID(), 'klb_blog_video_embed', true ).'?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="100%" height="422" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';  
			}  
			else if (get_post_meta( get_the_ID(), 'klb_blog_video_type', true ) == 'youtube') {  
			  echo '<iframe width="100%" height="450" src="http://www.youtube.com/embed/'.get_post_meta( get_the_ID(), 'klb_blog_video_embed', true ).'?rel=0&showinfo=0&modestbranding=1&hd=1&autohide=1&color=white" frameborder="0" allowfullscreen></iframe>';  
			}  
			else {  
				echo ' '.get_post_meta( get_the_ID(), 'klb_blog_video_embed', true ).' '; 
			}  
			?> 
		</div>

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