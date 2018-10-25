<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }


if (!class_exists('Cryptronick_header_mobile')) {
	class Cryptronick_header_mobile extends Cryptronick_get_header{

		public function __construct(){
			$this->header_vars();  
	   		$this->html_render = 'mobile';
	   		$name_preset = $this->name_preset;
	   		$def_preset = $this->def_preset;
 
	   		$header_mobile_background = Cryptronick_Theme_Helper::get_option('mobile_background');
	   		$header_mobile_color = Cryptronick_Theme_Helper::get_option('mobile_color');
	   		$mobile_header_custom =  Cryptronick_Theme_Helper::get_option('mobile_header');

	   		$mobile_styles = '';
	   		$mobile_styles .= !empty($header_mobile_background['rgba']) ? 'background-color: '.(esc_attr($header_mobile_background['rgba'])).';' : '';
	   		$mobile_styles .= !empty($header_mobile_color) ? 'color: '.(esc_attr($header_mobile_color)).';' : '';
	   		$mobile_styles = !empty($mobile_styles) ? ' style="'.$mobile_styles.'"' : '';

	   		echo "<div class='bpt-mobile-header'".(!empty($mobile_styles) ? $mobile_styles : '').">";
	   		echo "<div class='container-wrapper'>";
	   		if(!empty($mobile_header_custom)){
	   			$this->build_header_layout('mobile');
	   		}else{
	   			$this->default_header_mobile();
	   		}

	   		$this->build_header_mobile_menu($name_preset, $def_preset);
	   		echo "</div>";

	   		echo "</div>";
	   		
		}

		public function default_header_mobile(){
			$logo = parent::get_logo();
			$mobile_height = Cryptronick_Theme_Helper::get_option('header_mobile_height');
			$mobile_height_style = '';

			if(isset($mobile_height['height'])){
                $mobile_height_style .= 'height:'.(esc_attr((int)$mobile_height['height'])).'px;';
            }
            $mobile_height_style = !empty($mobile_height_style) ? ' style="'.$mobile_height_style.'"' : '';

			echo "<div class='bpt-header-row'>";
				echo "<div class='fullwidth-wrapper'>";
					echo "<div class='bpt-header-row_wrapper'".$mobile_height_style.">";
						echo "<div class='Leftalignside header_side display_grow v_align_middle h_align_left'>";
							echo "<div class='header_area_container'>";
							if (has_nav_menu( 'main_menu' )) {
								echo "<nav class='main-menu main_menu_container'>";
								if(function_exists('cryptronick_main_menu')){
									cryptronick_main_menu ();
								}								
								echo "</nav>";
								echo '<div class="mobile-navigation-toggle"><div class="toggle-box"><div class="toggle-inner"></div></div></div>';
							}
							echo "</div>";
						echo "</div>";						

						echo "<div class='Centeralignside header_side display_grow v_align_middle h_align_center'>";
							echo "<div class='header_area_container'>";
								echo !empty($logo) ? $logo : '';
							echo "</div>";
						echo "</div>";
						
						echo "<div class='Rightalignside  header_side display_grow v_align_middle h_align_right'>";
							echo "<div class='header_area_container'>";
								echo self::search();
							echo "</div>";
						echo "</div>";				
					echo "</div>";				
				echo "</div>";				
			echo "</div>";				
		}


	}

    new Cryptronick_header_mobile();
}
