<?php get_header();?>
	<section class="wrapper_404_section">
		<div class="container a-center">
			<div class="banner_404">
				<div class="banner_404_content">
					<img src="<?php echo get_template_directory_uri() . "/img/404.png"; ?>" alt />		
				</div>

			</div>
			<h2 class="banner_404_title"><?php echo esc_html__('Woops! Page Cannot Be Found!', 'cryptronick'); ?></h2>
			<p class="banner_404_text"><?php echo esc_html__('Either Something Went Wrong or the Page Doesn\'t Exist Anymore.', 'cryptronick'); ?></p>
			<div class="cryptronick_404_search">
				<?php get_search_form(); ?>
			</div>
			<div class="cryptronick_404_button cryptronick_module_button button_gradient">
				<a class="button_size_large" href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e('Take me home', 'cryptronick'); ?></a>
			</div>
		</div>
	</section>
<?php get_footer(); ?>