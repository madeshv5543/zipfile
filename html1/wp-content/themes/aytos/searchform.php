<?php
/**
 * searchform.php
 * @package WordPress
 * @subpackage Cryptoking
 * @since Cryptoking 1.0
 * 
 */
 ?>
<form action="<?php echo esc_url( home_url( '/' ) ); ?>" id="searchform" class="form_search" role="search" method="get">
	<input type="text" class="search-field" name="s" id="s" placeholder="<?php esc_attr_e('Search For', 'cryptoking') ?>" autocomplete="off">
	<button type="submit"><i class="ion-search"></i></button>
</form>