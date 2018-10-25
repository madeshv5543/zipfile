<?php

/**
 * page.php
 * @package WordPress
 * @subpackage Cryptoking
 * @since Cryptoking 1.0
 */
?>

<?php get_header(); ?>
		
	<?php $content = ''; ?>
	<?php if (have_posts()) : while (have_posts()) : the_post();  ?>
		  <?php $content .= get_the_content(); ?>
	<?php  endwhile; ?>
	<?php endif; ?> 
	
	<?php if( has_shortcode( $content, 'vc_row' )) { ?>
	
		<?php while(have_posts()) : the_post(); ?>
			<?php the_content (); ?>
			<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
		<?php endwhile; ?>
		
	<?php } else { ?>
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
					 <?php while(have_posts()) : the_post(); ?>
						<h2 class="t)tle"><?php the_title(); ?></h2>
						<div class="klb-post post_content">
							<?php the_content (); ?>
							<?php wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
						</div>
					 <?php endwhile; ?>
					 
					 <?php comments_template(); ?>    

					</div>
				</div>
			</div>
		</section>
	<?php } ?>
   
<?php get_footer(); ?>