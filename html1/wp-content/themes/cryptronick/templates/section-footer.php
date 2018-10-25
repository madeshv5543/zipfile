<?php  if ( ! defined( 'ABSPATH' ) ) { exit; }

if (!class_exists('Cryptronick_footer_area')) {
	/**
	 * Footer area
	 *
	 *
	 * @class 		Cryptronick_footer_area
	 * @version		1.0
	 * @category	Class
	 * @author 		BlendPixelsThemes
	 */

    class Cryptronick_footer_area {
		/**
		* @since 1.0
		* @access private
		*/
		private $mb_footer_sidebar_1;
		private $mb_footer_sidebar_2;
		private $mb_footer_sidebar_3;
		private $mb_footer_sidebar_4;    	
    	
    	private $footer_full_width;

    	function __construct () {
	    	// footer option
	        $footer_switch = Cryptronick_Theme_Helper::get_option('footer_switch');
	        $this->footer_full_width = Cryptronick_Theme_Helper::options_compare('footer_full_width','mb_footer_switch','yes');
	        $footer_bg_color = Cryptronick_Theme_Helper::options_compare('footer_bg_color','mb_footer_switch','yes');

	        // copyright option
	        $copyright_switch = Cryptronick_Theme_Helper::get_option('copyright_switch');

	        if (class_exists( 'RWMB_Loader' ) && get_queried_object_id() !== 0) {
	            $mb_footer_switch = rwmb_meta('mb_footer_switch');
	            if ($mb_footer_switch == 'yes') {
	                $footer_switch = true;
	                $mb_copyright_switch = rwmb_meta('mb_copyright_switch');
	                if ($mb_copyright_switch == '1') {
	                    $copyright_switch = true;
	                }else{
	                    $copyright_switch = false;
	                }

	            }elseif (rwmb_meta('mb_footer_switch') == 'no') {
	                $footer_switch = false;
	                $copyright_switch = false;
	            }
	        }

	        //footer container style
	        $footer_cont_style = !empty($footer_bg_color) ? ' background-color :'.esc_attr($footer_bg_color).';' : '';
	        $footer_cont_style .= Cryptronick_Theme_Helper::bg_render('footer','mb_footer_switch','yes');
	        $footer_cont_style = !empty($footer_cont_style) ? ' style="'.esc_attr($footer_cont_style).'"' : '' ;
	        
	        /*
	        *
	        * footer remder
	        */

	        if ($footer_switch || $copyright_switch) {
	            echo "<footer class='footer fadeOnLoad clearfix'".$footer_cont_style." id='footer'>";
	                if ($footer_switch) {
	                	$footer_content_type = Cryptronick_Theme_Helper::get_option('footer_content_type');
			            if (class_exists( 'RWMB_Loader' ) && get_queried_object_id() !== 0) {
			            	$mb_footer_switch = rwmb_meta('mb_footer_switch');
			            	if ($mb_footer_switch == 'yes') {
			            		$footer_content_type = rwmb_meta('mb_footer_content_type');
				            }
			        	}
	                	switch ($footer_content_type) {
	                		case 'widgets':
	                			$this->main_footer_html();
	                			break;
	                		case 'pages':
	                    		$this->main_footer_get_page();
	                			break;
	                		default:
	                			$this->main_footer_html();
	                			break;
	                	}
	                }

	                if ($copyright_switch) {
	                    $this->copyright_html();
	                }

	            echo "</footer>";
	        }
    	}

    	private function get_wave_html(){
    		$wave_switch = Cryptronick_Theme_Helper::options_compare('footer_add_wave','mb_footer_switch','yes');
    		if((bool) $wave_switch){

    			$wave_height = Cryptronick_Theme_Helper::get_option('footer_wave_height');
    			$wave_height = isset($wave_height['height']) ? $wave_height['height'] : '';
    			if (class_exists( 'RWMB_Loader' ) && get_queried_object_id() !== 0) {
    				if (rwmb_meta('mb_footer_switch') == 'yes') {
    					$wave_height = rwmb_meta('mb_footer_wave_height');
    				}
    			}

    			echo "<div class='cryptronick_wave_footer' style='height:".(int) $wave_height."px;'>";
    			echo '<svg class="wave_bottom" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1920 347.1" preserveAspectRatio="none">
					<linearGradient id="SVGID_1_" gradientUnits="userSpaceOnUse" x1="959.9996" y1="312.5311" x2="959.9996" y2="-1405.3223">
						<stop  offset="0" style="stop-color:#FFFFFF"/>
						<stop  offset="8.581323e-02" style="stop-color:#F7F9FE"/>
						<stop  offset="0.2183" style="stop-color:#E1E7FC"/>
						<stop  offset="0.3808" style="stop-color:#BECAF9"/>
						<stop  offset="0.5671" style="stop-color:#8DA2F5"/>
						<stop  offset="0.7737" style="stop-color:#4E6EF0"/>
						<stop  offset="0.9942" style="stop-color:#0231E9"/>
						<stop  offset="1" style="stop-color:#002FE9"/>
					</linearGradient>
					<path class="st0" style="fill:url(#SVGID_1_);" d="M0,146.9v-118c0,0,204.7-42.1,470.5-25.4s340.2,56.7,569,104.2s456.3,45.6,549.8,48.8
						c93.5,3.2,330.7-0.8,330.7-0.8s-171-22.9-340.3,26.3S712.2,71.2,454.2,71.2S0,146.9,0,146.9z"/>
					<path class="st1" style="fill:#FFFFFF;" d="M1920,0v162.8c0,0.2,0,0.3,0,0.5c-315,79.3-632.9,18.5-951.4-66.3C644.3,8.5,321.2-20.3,0,36.8V0H1920z"/>
					</svg>';
    			echo "</div>";
    		}
    	}

    	private function get_footer_vars($optn_1 = null){

    		$footer_options = array();
    		//Get options
    		$footer_spacing = Cryptronick_Theme_Helper::get_option('footer_spacing');

	        // Only for widgets in footer
	        if ($optn_1 == 'widgets') {

				$footer_options['footer_column'] = Cryptronick_Theme_Helper::options_compare('footer_column','mb_footer_switch','yes');
		        $footer_options['footer_column2'] = Cryptronick_Theme_Helper::options_compare('footer_column2','mb_footer_switch','yes');
		        $footer_options['footer_column3'] = Cryptronick_Theme_Helper::options_compare('footer_column3','mb_footer_switch','yes');
		        $footer_align = Cryptronick_Theme_Helper::options_compare('footer_align','mb_footer_switch','yes');

	        }
	        

    		// METABOX VAR
	        if (class_exists( 'RWMB_Loader' ) && get_queried_object_id() !== 0) {
	            $footer_options['mb_footer_switch'] = rwmb_meta('mb_footer_switch');
	            if ($footer_options['mb_footer_switch'] == 'yes') {
	                $footer_spacing = array();
	                $mb_padding_top = rwmb_meta('mb_padding_top');
	                $mb_padding_bottom = rwmb_meta('mb_padding_bottom');
	                $mb_padding_left = rwmb_meta('mb_padding_left');
	                $mb_padding_right = rwmb_meta('mb_padding_right');          
	                $footer_spacing['padding-top'] = !empty($mb_padding_top) ? (int) $mb_padding_top .'px' : '';
	                $footer_spacing['padding-bottom'] = !empty($mb_padding_bottom) ? (int) $mb_padding_bottom .'px' : '';
	                $footer_spacing['padding-left'] = !empty($mb_padding_left) ? (int) $mb_padding_left .'px' : '';
	                $footer_spacing['padding-right'] = !empty($mb_padding_right) ? (int) $mb_padding_right .'px' : '';

	                // Only for widgets in footer
	                if ($optn_1 == 'widgets') {
		                $this->mb_footer_sidebar_1 = rwmb_meta('mb_footer_sidebar_1');
		                $this->mb_footer_sidebar_2 = rwmb_meta('mb_footer_sidebar_2');
		                $this->mb_footer_sidebar_3 = rwmb_meta('mb_footer_sidebar_3');
		                $this->mb_footer_sidebar_4 = rwmb_meta('mb_footer_sidebar_4');	
	                }
	            }
	        }

	        // Only for widgets in footer
	        if ($optn_1 == 'widgets') {
	    		//footer container class
		        $footer_options['footer_class'] = '';
		        $footer_options['footer_class'] .= ' align-'.esc_attr($footer_align);
	        }

	        //footer padding
	        $footer_top_padding = !empty($footer_spacing['padding-top']) ? $footer_spacing['padding-top'] : '';
	        $footer_bottom_padding = !empty($footer_spacing['padding-bottom']) ? $footer_spacing['padding-bottom'] : '';
	        $footer_left_padding = !empty($footer_spacing['padding-left']) ? $footer_spacing['padding-left'] : '';
	        $footer_right_padding = !empty($footer_spacing['padding-right']) ? $footer_spacing['padding-right'] : '';

	        //footer style
	        $footer_options['footer_style'] = '';
	        $footer_options['footer_style'] .= !empty($footer_top_padding) ? 'padding-top:'.esc_attr($footer_top_padding).';' : '' ;
	        $footer_options['footer_style'] .= !empty($footer_bottom_padding) ? 'padding-bottom:'.esc_attr($footer_bottom_padding).';' : '' ;
	        $footer_options['footer_style'] .= !empty($footer_left_padding) ? 'padding-left:'.esc_attr($footer_left_padding).';' : '' ;
	        $footer_options['footer_style'] .= !empty($footer_right_padding) ? 'padding-right:'.esc_attr($footer_right_padding).';' : '' ;
	        $footer_options['footer_style'] = !empty($footer_options['footer_style']) ? ' style="'.$footer_options['footer_style'].'"' : '';

	        // Only for widgets in footer
	        if ($optn_1 == 'widgets') {
	    		/*
		        *
		        * column build
		        */
		        $footer_options['column_sizes'] = array();
		        switch ((int)$footer_options['footer_column']) {
		            case 1:
		                $footer_options['column_sizes'] = array('12');
		                break;
		            case 2:
		                $footer_options['column_sizes'] = explode('-', $footer_options['footer_column2']);
		                break;
		            case 3:
		                $footer_options['column_sizes'] = explode('-', $footer_options['footer_column3']);
		                break;
		            case 4:
		                $footer_options['column_sizes'] = array('3','3','3','3');
		                break;
		            default:
		                $footer_options['column_sizes'] = array('3','3','3','3');
		                break;
		        }
	        }

	        return $footer_options;
    	}

    	private function main_footer_html(){
    		
    		// Get footer vars
	        $footer_vars = $this->get_footer_vars('widgets');
	        extract($footer_vars);

    		echo "<div class='footer_top-area column_".(int)$footer_column.$footer_class."'>";

    			$this->get_wave_html();
                if ($this->footer_full_width) {
                    echo "";
                } else {
                    echo "<div class='container'>";
                }

                $sidebar_exists = false;
                for ($i=0; $i < (int)$footer_column; $i++) {
                    if (isset($mb_footer_switch) && $mb_footer_switch == 'yes') {
                        if (is_active_sidebar( $this->{'mb_footer_sidebar_'.($i+1)} )) {
                        	$sidebar_exists = true;
                        }
                    }else{
                        if (is_active_sidebar( 'footer_column_' . ($i+1) )) {
                        	$sidebar_exists = true;
                        }
                    }
                }
                
                if ($sidebar_exists) {
	                echo "<div class='row'".$footer_style.">";
	                    for ($i=0; $i < (int)$footer_column; $i++) { 
	                        echo "<div class='span".$column_sizes[$i]."'>";
	                            if (isset($mb_footer_switch) && $mb_footer_switch == 'yes') {
	                                if (is_active_sidebar( $this->{'mb_footer_sidebar_'.($i+1)} )) {
	                                    dynamic_sidebar( $this->{'mb_footer_sidebar_'.($i+1)} );
	                                }
	                            }else{
	                                if (is_active_sidebar( 'footer_column_' . ($i+1) )) {
	                                    dynamic_sidebar( 'footer_column_' . ($i+1) );
	                                }
	                            }
	                        echo "</div>";
	                    }

	                echo "</div>";
                }

                if ($this->footer_full_width) {
                    echo "";
                } else {
                    echo "</div>";
                }
            echo "</div>";
    	}

    	private function main_footer_get_page(){
    		// Get options
    		$footer_vars = $this->get_footer_vars('widgets');
	        extract($footer_vars);

	        echo "<div class='footer_top-area'>";
	        	$this->get_wave_html();
	        	
                if ($this->footer_full_width) {
                    echo "";
                } else {
                    echo "<div class='container'>";
                }
                echo "<div class='row-footer'".$footer_style.">";
                    
                    $footer_page_select = Cryptronick_Theme_Helper::options_compare('footer_page_select');

                    if (!empty($footer_page_select)) {
                    	$footer_page_select_id = intval($footer_page_select);

                    	$page_data = get_page($footer_page_select_id);

                    	if (!empty($page_data) && isset($page_data->post_status) && strcmp($page_data->post_status,'publish')===0) {
							global $wp_the_query;

							$wp_the_query_backup = $wp_the_query;
							
							$wp_the_query = new WP_Query(array(
								'page_id' => $footer_page_select_id,
							));

							if ($wp_the_query->have_posts()) {
								$wp_the_query->the_post();
								?>

								<?php the_content(); ?>

								<?php 	
								$wp_the_query = $wp_the_query_backup;
								wp_reset_postdata();
							}
						}
                    }

                echo "</div>";
                if ($this->footer_full_width) {
                    echo "";
                } else {
                    echo "</div>";
                }
            echo "</div>";


    	}

    	private function copyright_html() {
    		//Get options
    		$copyright_spacing = Cryptronick_Theme_Helper::get_option('copyright_spacing');
	        $copyright_editor = Cryptronick_Theme_Helper::options_compare('copyright_editor','mb_copyright_switch','1','mb_footer_switch','yes');
	        $copyright_align = Cryptronick_Theme_Helper::options_compare('copyright_align','mb_copyright_switch','1','mb_footer_switch','yes');
	        $copyright_bg_color = Cryptronick_Theme_Helper::options_compare('copyright_bg_color','mb_copyright_switch','1','mb_footer_switch','yes');
	        $copyright_top_border = Cryptronick_Theme_Helper::get_option("copyright_top_border");
	        $copyright_top_border_color = Cryptronick_Theme_Helper::get_option("copyright_top_border_color");

	        // METABOX VAR
	        if (class_exists( 'RWMB_Loader' ) && get_queried_object_id() !== 0) {
	            $mb_footer_switch = rwmb_meta('mb_footer_switch');

	            if ($mb_footer_switch == 'yes') {
	                $mb_copyright_switch = rwmb_meta('mb_copyright_switch');
	                if ($mb_copyright_switch == '1') {
	                    $mb_copyright_padding_top = rwmb_meta('mb_copyright_padding_top');
	                    $mb_copyright_padding_bottom = rwmb_meta('mb_copyright_padding_bottom');
	                    $mb_copyright_padding_left = rwmb_meta('mb_copyright_padding_left');
	                    $mb_copyright_padding_right = rwmb_meta('mb_copyright_padding_right');
	                    $copyright_spacing['padding-top'] = !empty($mb_copyright_padding_top) ? $mb_copyright_padding_top : '';
	                    $copyright_spacing['padding-bottom'] = !empty($mb_copyright_padding_bottom) ? $mb_copyright_padding_bottom : '';
	                    $copyright_spacing['padding-left'] = !empty($mb_copyright_padding_left) ? $mb_copyright_padding_left : '';
	                    $copyright_spacing['padding-right'] = !empty($mb_copyright_padding_right) ? $mb_copyright_padding_right : '';

	                    $copyright_top_border = rwmb_meta('mb_copyright_top_border');
	                    $mb_copyright_top_border_color = rwmb_meta('mb_copyright_top_border_color');
	                    $mb_copyright_top_border_color_opacity = rwmb_meta('mb_copyright_top_border_color_opacity');

	                    if (!empty($mb_copyright_top_border_color) && $copyright_top_border == '1') {
	                        $copyright_top_border_color['rgba'] = 'rgba('.(Cryptronick_Theme_Helper::hexToRGB($mb_copyright_top_border_color)).','.$mb_copyright_top_border_color_opacity.')';
	                    }else{
	                        $copyright_top_border_color = '';
	                    }
	                }
	            }
	        }

	        // copyright class
	        $copyright_class = '';
	        $copyright_class .= ' align-'.esc_attr($copyright_align);

	        // copyright container style
	        $copyright_cont_style = '';
	        $copyright_cont_style .= !empty($copyright_bg_color) ? 'background-color:'.esc_attr($copyright_bg_color).';' : '';
	        
	        if ($copyright_top_border == '1') {
	            $copyright_cont_style .= !empty($copyright_top_border_color['rgba']) ? 'border-top: 1px solid '.esc_attr($copyright_top_border_color['rgba']).';' : '';
	        }
	        $copyright_cont_style = !empty($copyright_cont_style) ? ' style="'.$copyright_cont_style.'"' : '';

	        // copyright padding
	        $copyright_top_padding = !empty($copyright_spacing['padding-top']) ? $copyright_spacing['padding-top'] : '';
	        $copyright_bottom_padding = !empty($copyright_spacing['padding-bottom']) ? $copyright_spacing['padding-bottom'] : '';
	        $copyright_left_padding = !empty($copyright_spacing['padding-left']) ? $copyright_spacing['padding-left'] : '';
	        $copyright_right_padding = !empty($copyright_spacing['padding-right']) ? $copyright_spacing['padding-right'] : '';
	        // copyright style
	        $copyright_style = '';
	        $copyright_style .= !empty($copyright_top_padding) ? 'padding-top:'.esc_attr($copyright_top_padding).'px;' : '' ;
	        $copyright_style .= !empty($copyright_bottom_padding) ? 'padding-bottom:'.esc_attr($copyright_bottom_padding).'px;' : '' ;
	        $copyright_style .= !empty($copyright_left_padding) ? 'padding-left:'.esc_attr($copyright_left_padding).'px;' : '' ;
	        $copyright_style .= !empty($copyright_right_padding) ? 'padding-right:'.esc_attr($copyright_right_padding).'px;' : '' ;
	        $copyright_style = !empty($copyright_style) ? ' style="'.$copyright_style.'"' : '';


    		echo "<div class='copyright".$copyright_class."'".$copyright_cont_style.">";
                if ($this->footer_full_width) {
                    echo "";
                } else {
                    echo "<div class='container'>";
                }
                   echo "<div class='row'".$copyright_style.">";
                       echo "<div class='span12'>";
                       echo do_shortcode( $copyright_editor );
                       echo "</div>"; 
                   echo "</div>";
                if ($this->footer_full_width) {
                    echo "";
                } else {
                    echo "</div>";
                }
            echo "</div>";
    	}
    }
    new Cryptronick_footer_area();
}