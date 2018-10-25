<?php

/* 
Template name: Frontpage Template
*/

?>


<?php get_header(); ?>


<?php
global $current_page_id;
$current_page_id = get_option('page_on_front');

if ( ( $locations = get_nav_menu_locations() ) && $locations['main-menu'] ) {
    $menu = wp_get_nav_menu_object( $locations['main-menu'] );
    $menu_items = wp_get_nav_menu_items($menu->term_id);
    $test_include = array();
    foreach($menu_items as $item) {
        if($item->object == 'page')
            $test_include[] = $item->object_id;
    }
	
	$args = array( 'post_type' => 'page', 'post__in' => $test_include, 'posts_per_page' => count($test_include), 'orderby' => 'post__in',  'suppress_filters'=> true );
    
	$main_query = new WP_Query($args);
	

}
else{
    $args=array(
    'post_type' => 'page',
    'order' => 'ASC',
    'orderby' => 'menu_order',
    'posts_per_page' => '-1',
	'suppress_filters'=> true
  );
    $main_query = new WP_Query($args); 
}


$menu = 1;
if( have_posts() ) : 
    while ($main_query->have_posts()) : $main_query->the_post();

    global $post;

    $post_name = $post->post_name;
    
    $post_id = get_the_ID();
    
    $separate_page = get_post_meta($post_id, "klb_separate_page", true); 
    if (($separate_page!= true )&& ($post_id != $current_page_id ))
    {
		
?>

	<section id="<?php echo esc_attr($post_name); ?>">
		   <?php
			$id = get_the_ID();
			$shortcodes_custom_css = get_post_meta( $id, '_wpb_shortcodes_custom_css', true );
				if($shortcodes_custom_css) { 
				echo '<style type="text/css" data-type="vc_shortcodes-custom-css">';
				echo cryptoking_sanitize_data($shortcodes_custom_css);
				echo '</style>';

				}
			?>
		<?php the_content(); ?>
	</section> 
    
   <?php if($menu==1){
        get_template_part('menu_section');
     } 	
	  $menu=2;
  }
    endwhile;
    endif; 


function cryptoking_custom_scripts() {
global $smof_data; 
?>


<?php } get_footer(); ?>