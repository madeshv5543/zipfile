<?php
/**
 * 404.php
 * @package WordPress
 * @subpackage Cryptoking
 * @since Cryptoking 1.0
 */
?>

<?php get_header(); ?>
<section class="section_gradiant small_pb">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-12 col-md-12 col-sm-12 order-lg-first text-center">
				<div class="banner_text pt-5 res_md_mt_20">
					<h1 class="title"><?php esc_html_e('Oops !','cryptoking'); ?></h1>
				</div>
			</div>
		</div>
	</div>
</section>
	
<section class="page-not-found">
	<div class="container">
    	<div class="row">
			<div class="col-md-8 offset-md-2">

					<h2><?php esc_html_e('404','cryptoking'); ?></h2>
					<h3><?php esc_html_e('Page Not Found!','cryptoking'); ?></h3>

					<p><?php esc_html_e('We are sorry, but the page you were looking for does not exist.','cryptoking'); ?></p>

					<?php get_search_form(); ?>

			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>