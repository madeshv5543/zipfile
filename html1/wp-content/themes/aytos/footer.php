<?php
/**
 * footer.php
 * @package WordPress
 * @subpackage Cryptoking
 * @since Cryptoking 1.0
 * 
 */
 ?>
 
<!-- START FOOTER SECTION --> 
<footer>
    <div class="bottom_footer">
    	<div class="container">
        	<div class="row">
            	<div class="col-md-6">
                	<p class="copyright">
						<?php if(ot_get_option( 'cryptoking_copyright' )){ ?>
							<?php echo cryptoking_sanitize_data(ot_get_option( 'cryptoking_copyright' )); ?>
						<?php } else { ?>
							<?php esc_html_e('Copyright 2018.KlbTheme . All rights reserved','cryptoking'); ?>
						<?php } ?>
					</p>
                </div>
                <div class="col-md-6">
					<?php 
					   wp_nav_menu(array(
					   'theme_location' => 'footer-menu',
					   'container' => '',
					   'fallback_cb' => 'show_top_menu',
					   'menu_id' => '',
					   'menu_class' => 'list_none footer_menu',
					   'echo' => true,
					   'walker' => new cryptoking_footer_description_walker(),
					   'depth' => 0 
						)); 
					 ?>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- END FOOTER SECTION --> 

	<a href="#" class="scrollup btn-default animation" data-animation="zoomIn" data-animation-delay="0.1s" style="display: none;"><i class="ion-ios-arrow-up"></i></a> 

	<?php wp_footer(); ?>

	</body>
</html>