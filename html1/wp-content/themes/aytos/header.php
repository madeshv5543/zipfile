<?php
/**
 * header.php
 * @package WordPress
 * @subpackage cryptoking
 * @since cryptoking 1.0
 * 
 */
 ?>
 
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

	<?php wp_head(); ?>
</head>

<body data-spy="scroll" data-offset="110" <?php body_class(); ?>>

<!-- LOADER -->
<div class="preloader">
    <div id="g-spinner" class="loading">
        <div class="circle c1"></div>
        <div class="circle c2"></div>
        <div class="circle c3"></div>
        <div class="circle c4"></div>
    </div>
</div>
<!-- END LOADER --> 

<!-- START HEADER -->
<?php if(ot_get_option('cryptoking_menu_type') == 'transparent'){ ?>
	<?php $headclass = 'fixed-top'; ?>
	<?php wp_enqueue_script('cryptoking_sticky');  ?>
<?php } else { ?>
	<?php $headclass = 'nav-fixed'; ?>
<?php } ?>
<header class="header_wrap <?php echo esc_attr($headclass); ?>">
  <div class="container">
    <nav class="navbar navbar-expand-lg btco-hover-menu">
	
		<?php if (ot_get_option( 'cryptoking_logo' )) { ?>
			<a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo('name'); ?>">
				<img src="<?php echo esc_url(ot_get_option( 'cryptoking_logo' )); ?>" alt="<?php bloginfo('name'); ?>" >
			</a>
		<?php } elseif (ot_get_option( 'cryptoking_logotext' )) { ?>
			<a class="navbar-brand klb-logo-text" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo('name'); ?>">
				<?php echo esc_html(ot_get_option( 'cryptoking_logotext' )); ?>
			</a>
		<?php } else { ?>
			<a class="navbar-brand klb-logo-text" href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php bloginfo('name'); ?>">
				<?php esc_html_e('Cryptoking','cryptoking'); ?>
			</a>
		<?php } ?>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"> <span class="ion-android-menu"></span> </button>
      
      <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
		<?php 
		   wp_nav_menu(array(
		   'theme_location' => 'main-menu',
		   'container' => '',
		   'fallback_cb' => 'show_top_menu',
		   'menu_id' => 'main-menu',
		   'menu_class' => 'navbar-nav',
		   'echo' => true,
		   'walker' => new cryptoking_description_walker(),
		   'depth' => 0 
			)); 
		?>
		 
		<?php $headbutton = ot_get_option('cryptoking_header_buttons'); ?>
		<?php if($headbutton){ ?>
        <ul class="navbar-nav nav_btn">
		<?php foreach($headbutton as $key => $value) { ?>
			<li><a class="btn btn-default" href="<?php echo esc_url($value['cryptoking_button_url']); ?>"><?php echo esc_html($value['cryptoking_button_text']); ?></a></li>
		<?php } ?>
        </ul>
		<?php } ?>
		
      </div>
    </nav>
  </div>
</header>
<!-- START HEADER -->