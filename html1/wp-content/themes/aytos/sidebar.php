<?php
/**
 * sidebar.php
 * @package WordPress
 * @subpackage Cryptoking
 * @since Cryptoking 1.0
 * 
 */
 ?>
  <?php if ( is_active_sidebar( 'blog-sidebar' ) ) { ?>
		<?php dynamic_sidebar( 'blog-sidebar' ); ?>
  <?php } ?>