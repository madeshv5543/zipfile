<?php
/**
 * search.php
 * @package WordPress
 * @subpackage Cryptoking
 * @since Cryptoking 1.0
 * 
 */
 ?>

<?php get_header(); ?>

<section class="section_gradiant small_pb">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-12 col-md-12 col-sm-12 order-lg-first text-center">
				<div class="banner_text pt-5 res_md_mt_20">
					<h1 class="title"><?php printf( esc_html__( 'Search Results for: %s', 'cryptoking' ), get_search_query() ); ?></h1>
				</div>
			</div>
		</div>
	</div>
</section>

<section>
	<div class="container">
    	<div class="row">
			<?php if( ot_get_option( 'layout_set' ) == 'left-sidebar') { ?>
				<div class="col-lg-4">
					<div class="sidebar">
						<?php if ( is_active_sidebar( 'blog-sidebar' ) ) { ?>
								<?php dynamic_sidebar( 'blog-sidebar' ); ?>
						<?php } ?>
					</div>
				</div>
			
				<div class="col-lg-8">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					   <?php  get_template_part( 'post-format/content', get_post_format() ); ?>

					<?php endwhile; ?>
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<?php get_template_part( 'post-format/pagination' ); ?>
							</div>
						</div>
					<?php else : ?>
						<div class="blog_item">
							<div class="blog_content">
								<h2><?php esc_html_e('No Posts Found', 'cryptoking') ?></h2>
							</div>
						</div>
					<?php endif; ?>
				</div>
			<?php } elseif( ot_get_option( 'layout_set' ) == 'full-width') { ?>
				<div class="col-lg-12">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					   <?php  get_template_part( 'post-format/content', get_post_format() ); ?>

					<?php endwhile; ?>
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<?php get_template_part( 'post-format/pagination' ); ?>
							</div>
						</div>
					<?php else : ?>
						<div class="blog_item">
							<div class="blog_content">
								<h2><?php esc_html_e('No Posts Found', 'cryptoking') ?></h2>
							</div>
						</div>
					<?php endif; ?>

				</div>
			<?php } else { ?>			
				<div class="col-lg-8">
					<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

					   <?php  get_template_part( 'post-format/content', get_post_format() ); ?>

					<?php endwhile; ?>
						<div class="row">
							<div class="col-md-12 col-sm-12">
								<?php get_template_part( 'post-format/pagination' ); ?>
							</div>
						</div>
					<?php else : ?>
						<div class="blog_item">
							<div class="blog_content">
								<h2><?php esc_html_e('No Posts Found', 'cryptoking') ?></h2>
							</div>
						</div>
					<?php endif; ?>

				</div>
				
				<div class="col-lg-4">
					<div class="sidebar_block">
						<?php if ( is_active_sidebar( 'blog-sidebar' ) ) { ?>
								<?php dynamic_sidebar( 'blog-sidebar' ); ?>
						<?php } ?>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</section>
<?php get_footer(); ?>