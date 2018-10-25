<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }


if (!class_exists('Cryptronick_header_sticky')) {
	class Cryptronick_header_sticky extends Cryptronick_get_header{

		public function __construct(){
			$this->header_vars();  
			$this->html_render = 'sticky';

	   		if (Cryptronick_Theme_Helper::options_compare('header_sticky','mb_customize_header_layout','custom') == '1') {
	   			$header_sticky_appearance_style = Cryptronick_Theme_Helper::get_option('header_sticky_appearance_style');
	   			$header_sticky_appearance_number = Cryptronick_Theme_Helper::get_option('header_sticky_appearance_number');
	   			$header_sticky_appearance_number = (Cryptronick_Theme_Helper::get_option('header_sticky_appearance_from_top') == 'custom') && !empty($header_sticky_appearance_number) ? $header_sticky_appearance_number['height'] : '';
	   			$header_sticky_background = Cryptronick_Theme_Helper::get_option('header_sticky_background');
	   			$header_sticky_color = Cryptronick_Theme_Helper::get_option('header_sticky_color');
	   			$header_sticky_shadow = Cryptronick_Theme_Helper::get_option('header_sticky_shadow');

	   			$sticky_styles = '';
	   			$sticky_styles .= !empty($header_sticky_background['rgba']) ? 'background-color: '.(esc_attr($header_sticky_background['rgba'])).';' : '';
	   			$sticky_styles .= !empty($header_sticky_color) ? 'color: '.(esc_attr($header_sticky_color)).';' : '';
	   			$sticky_styles = !empty($sticky_styles) ? ' style="'.$sticky_styles.'"' : '';

	   			echo "<div class='bpt-sticky-header".($header_sticky_shadow == '1' ? ' header_sticky_shadow' : '')."'".(!empty($sticky_styles) ? $sticky_styles : '').(!empty($header_sticky_appearance_style) ? ' data-sticky-type="'.esc_attr($header_sticky_appearance_style).'"' : '').(!empty($header_sticky_appearance_number) ? ' data-sticky-number="'.((int)$header_sticky_appearance_number).'"' : '').">";

	   				echo "<div class='container-wrapper'>";
	   				
	   			$this->build_header_layout('sticky');
	   			echo "</div>";

	   			echo "</div>";
	   		}
		}
	}

    new Cryptronick_header_sticky();
}
