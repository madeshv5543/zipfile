<?php  if ( ! defined( 'ABSPATH' ) ) { exit; }
/**
* Breadcrumbs area
*
*
* @class 		Cryptronick_breadcrumbs
* @version		1.0
* @category	Class
* @author 		BlendPixelsThemes
*/
if (!class_exists('Cryptronick_breadcrumbs')) {
    class Cryptronick_breadcrumbs {
		private static $instance = null;
		public static function get_instance( ) {
			if ( null == self::$instance ) {
				self::$instance = new self( );
			}

			return self::$instance;
		}

    	function __construct () {
	    	$showOnHome = 1;
	   		$delimiter = '<span class="divider"> > </span>';
	   		$home = esc_html__('Home', 'cryptronick');
	   		$showCurrent = 1;
	   		$before = '<span class="current">';
	   		$after = '</span>';
	   		global $post;
	   		$homeLink = esc_url(home_url('/'));
	   		if (is_home() || is_front_page()) {
	   			if ($showOnHome == 1) echo '<div class="breadcrumbs"><span>' . $home . '</span></div>';
	   		} else {

	   			echo '<div class="breadcrumbs"><a href="' . $homeLink . '">' . $home . '</a>' . $delimiter . '';
	   			if (is_category()) {
	   				$thisCat = get_category(get_query_var('cat'), false);
	   				if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
	   				echo '<span class="current">' . esc_html__('Archive','cryptronick').' "' . single_cat_title('', false) . '"' . '</span>';

	   			}
	   			elseif (get_post_type() == 'port') {

	   				the_terms($post->ID, 'portcat', '', '', '');

	   				if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . '<span class="current">' . get_the_title() . '</span>';

	   			} elseif (is_search()) {
	   				echo '<span class="current">' . esc_html__('Search for','cryptronick').' "' . get_search_query() . '"' . '</span>';

	   			} elseif (is_day()) {
	   				echo '<a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
	   				echo '<a href="' . esc_url(get_month_link(get_the_time('Y'), get_the_time('m'))) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
	   				echo '<span class="current">' . get_the_time('d') . '</span>';

	   			} elseif (is_month()) {
	   				echo '<a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
	   				echo '<span class="current">' . get_the_time('F') . '</span>';

	   			} elseif (is_year()) {
	   				echo '<span class="current">' . get_the_time('Y') . '</span>';

	   			} elseif (is_single() && !is_attachment() && (function_exists('is_product') && !is_product()) ) {
	   				if (get_post_type() != 'post') {

	   					$parent_id = $post->post_parent;
	   					if ($parent_id > 0) {
	   						$breadcrumbs = array();
	   						while ($parent_id) {
	   							$page = get_page($parent_id);
	   							$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
	   							$parent_id = $page->post_parent;
	   						}
	   						$breadcrumbs = array_reverse($breadcrumbs);
	   						for ($i = 0; $i < count($breadcrumbs); $i++) {
	   							echo Cryptronick_Theme_Helper::render_html($breadcrumbs[$i]);
	   							if ($i != count($breadcrumbs) - 1) echo ' ' . $delimiter . ' ';
	   						}
	   						if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . '<span class="current">' . get_the_title() . '</span>';
	   					} else {
	   						echo '<span class="current">' . get_the_title() . '</span>';
	   					}

	   				} else {
	   					$cat = get_the_category();
	   					$cat = $cat[0];
	   					$cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
	   					if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
	   					echo Cryptronick_Theme_Helper::render_html($cats);
	   					if ($showCurrent == 1) echo '<span class="current">' . get_the_title() . '</span>';
	   				}

	   			} elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
	   				$post_type = get_post_type_object(get_post_type());
	   				if($post_type){
	   					echo '<span class="current">' . esc_html($post_type->labels->singular_name) . '</span>';
	   				}
	   				   				
	   			} elseif (is_attachment()) {
	   				$parent = get_post($post->post_parent);
	   				$cat = get_the_category($parent->ID);
	   				$cat = $cat[0];
	   				echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
	   				echo '<a href="' . esc_url(get_permalink($parent)) . '">' . $parent->post_title . '</a>';
	   				if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . '<span class="current">' . get_the_title() . '</span>';

	   			} elseif (is_page() && !$post->post_parent) {
	   				if ($showCurrent == 1) echo '<span class="current">' . get_the_title() . '</span>';


	   			} elseif (is_page() && $post->post_parent) {
	   				$parent_id = $post->post_parent;
	   				$breadcrumbs = array();
	   				while ($parent_id) {
	   					$page = get_page($parent_id);
	   					$breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
	   					$parent_id = $page->post_parent;
	   				}
	   				$breadcrumbs = array_reverse($breadcrumbs);
	   				for ($i = 0; $i < count($breadcrumbs); $i++) {
	   					echo Cryptronick_Theme_Helper::render_html($breadcrumbs[$i]);
	   					if ($i != count($breadcrumbs) - 1) echo ' ' . $delimiter . ' ';
	   				}
	   				if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . '<span class="current">' . get_the_title() . '</span>';

	   			} elseif (is_tag()) {
	   				echo '<span class="current">' . esc_html__('Tag','cryptronick').' "' . single_tag_title('', false) . '"' . '</span>';

	   			} elseif (is_author()) {
	   				global $author;
	   				$userdata = get_userdata($author);
	   				echo '<span class="current">' . esc_html__('Author','cryptronick').' ' . esc_html($userdata->display_name) . '</span>';

	   			} elseif (is_404()) {
	   				echo '<span class="current">' . esc_html__('Error 404','cryptronick') . '</span>';
	   			} elseif (function_exists('is_product') && is_product()) {
	   				if(function_exists('cryptronick_woocommerce_breadcrumb')){
	   					$args = array();
	   					$args['delimiter'] = $delimiter;
	   					echo cryptronick_woocommerce_breadcrumb($args);
	   				}
	   			}

	   			echo '</div>';

	   		}
    	}
    }
    new Cryptronick_breadcrumbs();
}