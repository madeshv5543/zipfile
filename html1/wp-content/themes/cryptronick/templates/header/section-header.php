<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }


if (!class_exists('Cryptronick_get_header')) {
	class Cryptronick_get_header{

		protected $html_render = 'bottom';	
		protected $id;		
		protected $def_preset;		
		protected $name_preset;


		private static $instance = null;
		public static function get_instance( ) {
			if ( null == self::$instance ) {
				self::$instance = new self( ); 
			}

			return self::$instance;
		}
		
	    public function __construct() {
			
	    	$this->init();
	    }

	    public function header_vars(){
	    	$this->id = get_queried_object_id();
	    	//Redux options header
	    	$this->name_preset = Cryptronick_Theme_Helper::get_option('header_def_js_preset');
	    	$get_def_name = get_option( 'cryptronick_preset' );
	    	if( !$this->in_array_r($this->name_preset, get_option( 'cryptronick_preset' ))){    				
	    		$this->name_preset = 'default';
	    	}
	    	else{	
		    	if(isset($get_def_name['default']) && $this->name_preset ){
		    		if(array_key_exists($this->name_preset, $get_def_name['default']) && !array_key_exists($this->name_preset, $get_def_name)){
		    			$this->def_preset = true;
		    		}else{
		    			$this->def_preset = false;
		    		}	
		    	}
		    	else{
		    		$this->def_preset = false;
		    	}
	    	}	

	    	//RWMB opions header	    
	    	if (class_exists( 'RWMB_Loader' ) && $this->id !== 0) {
	    		$customize_header = rwmb_meta('mb_customize_header');
	    		if (!empty($customize_header) && $customize_header != 'default') {
	    			if( !$this->in_array_r(rwmb_meta('mb_customize_header'), get_option( 'cryptronick_preset' ))){    	
	    			}else{
	    				$get_def_name = get_option( 'cryptronick_preset' );
	    				$this->name_preset = rwmb_meta('mb_customize_header');
	    				
	    				if(isset($get_def_name['default']) && $this->name_preset ){
		    				if(array_key_exists($this->name_preset, $get_def_name['default']) && !array_key_exists($this->name_preset, $get_def_name)){
		    					$this->def_preset = true;
		    				}else{
	    						$this->def_preset = false;
	    					}	
	    				}
	    				else{
	    					$this->def_preset = false;
	    				}
	    			}
	    		}
	    	}
	    }
	    	
		public function init(){
			// Don't render header if in metabox set to hide it.
			if (class_exists( 'RWMB_Loader' )) {
	            if (rwmb_meta('mb_customize_header_layout') == 'hide') return;
	        }

			$this->header_vars();       
	        /**
			* Generate html header rendered
			*
			*
			* @since 1.0
			* @access public
			*/
			
	        $this->header_render_html();	        
	   	}
	    
	    /**
		* Generate header class
		*
		*
		* @since 1.0
		* @access public
		*/
	   	public function header_class(){
	   		$header_shadow = Cryptronick_Theme_Helper::get_option('header_shadow',$this->name_preset, $this->def_preset);
	   		$header_on_bg = Cryptronick_Theme_Helper::get_option('header_on_bg',$this->name_preset, $this->def_preset);

	        //Build Header Class
	        $header_class = '';
	        if ($header_on_bg == 1) {
	            $header_class .= ' header_over_bg';
	        }
	        if ($header_shadow == '1') {
	            $header_class .= ' header_shadow';
	        }
	        return $header_class;

	   	}
	    
	    /**
		* Generate header editor
		*
		*
		* @since 1.0
		* @access public
		*/	    

		public function header_bar_editor($location = null,$position = null){
			if(!$position)
				return;
			
			/*
			 * Define Theme options and field configurations.
			*/

			${'header_'.$position.'_editor'} = Cryptronick_Theme_Helper::get_option($location.'_header_bar_'.$position.'_editor', $this->name_preset, $this->def_preset);
	        $html_render = ${'header_'.$position.'_editor'};
	    	// Header Bar HTML Editor render
	        $html = "";
	        if (!empty($html_render)) {
	            $html .= "<div class='".esc_attr($location)."_header ".esc_attr($position)."_editor header_render_editor header_render'>";
	                $html .= "<div class='wrapper'>";                	
	                		$html .= do_shortcode( $html_render );                	
	                $html .= "</div>";
	            $html .= "</div>";
	        }
	     
	        return $html;
		} 

	    /**
		* Generate header spacer
		*
		*
		* @since 1.0
		* @access public
		*/	    

		public function header_bar_spacer($key = null){
			if(!$key)
				return;
			
			/*
			 * Define Theme options and field configurations.
			*/

			$get_number = (int) filter_var($key, FILTER_SANITIZE_NUMBER_INT);
			$spacer = Cryptronick_Theme_Helper::get_option('bottom_header_spacer'.$get_number, $this->name_preset, $this->def_preset);	    	
	    	//Header Bar Spacer render
	        $html = "";
	        if (is_array($spacer)) {
	            $html .= "<div class='header_spacing spacer_".$get_number."' style='width:".esc_attr( (int) $spacer['width'] )."px;'>";
	            $html .= "</div>";
	        }
	      
	        return $html;
		}

		/**
		* Generate header builder layout
		*
		*
		* @since 1.0
		* @access public
		*/
	   	public function build_header_layout($section = 'bottom'){
	   		$header_sticky_builder = Cryptronick_Theme_Helper::get_option('sticky_header');

	   		if(empty($header_sticky_builder) && $this->html_render == 'sticky'){
	   			$section = 'bottom';
	   		}

	   		$this->name_preset = $section == 'bottom' ? $this->name_preset : null;
	   		$bottom_header_layout = Cryptronick_Theme_Helper::get_option($section.'_header_layout', $this->name_preset, $this->def_preset);
	   		
	   		$menu_ative_top_line = Cryptronick_Theme_Helper::get_option('menu_ative_top_line', $this->name_preset, $this->def_preset);
	   		 if (class_exists( 'RWMB_Loader' ) && $this->id !== 0) {
	            if (rwmb_meta('mb_customize_header_layout') == 'custom') {
	                $menu_ative_top_line = rwmb_meta('mb_menu_ative_top_line');
	            }
	        }
					
			//Get item from recycle bin	
			$j =0;
			$bottom_header_layout_top = $bottom_header_layout_middle = $bottom_header_layout_bottom = array();
			
			//Build Row Item
			$counter = 1;
			if($section == 'bottom'){
				$bottom_header_layout = array_slice($bottom_header_layout, 1);
				$count = count($bottom_header_layout);
				$half = 3;
				for($i = 0 ;$i<3;$i++){
					switch ($i) {
						case 0:
							$bottom_header_layout_top = array_slice($bottom_header_layout, $j, $half); 
							break;						
						case 1:
							$bottom_header_layout_middle = array_slice($bottom_header_layout, $j, $half); 
							break;						
						case 2:
							$bottom_header_layout_bottom = array_slice($bottom_header_layout, $j, $half); 
							break;
					}

					$j = $j+$half;   
				}	

				//bpt Header Builder Row
				$counter = 3;	   			
			}
			
			/**
			* Generate sticky builder(default)
			*/
			$inc_sticky = 0;			
			$sticky_present_element = false;
			$sticky_last_row = '';
			$sticky_key_last_row = array();

			for ($i=1; $i <= $counter; $i++) {
		    	if($section == 'bottom'){
 	 				switch ($i) {
 	 					case 1:
 	 						$sticky_loc = '_top';
 	 						break; 	 					
 	 					case 2:
 	 						$sticky_loc = '_middle';
 	 						break; 	 					
 	 					case 3:
 	 						$sticky_loc = '_bottom';
 	 						break;
 	 				}
		    		$sticky_header_layout = ${"bottom_header_layout" . $sticky_loc};
    		
		    		foreach ($sticky_header_layout as $key => $v) {

		    			if (count($sticky_header_layout[$key]) == 1 && empty($sticky_header_layout[$key]['placebo']) || count($sticky_header_layout[$key]) > 2) {
		    				$sticky_present_element = true;
		    				$sticky_key_last_row[] = $key;
		    			}
		    		}
		    	}else{
		    		$sticky_present_element = true;
		    	}

		    	if (!empty($sticky_header_layout)) {
			    	if($sticky_present_element && $this->html_render == 'sticky'){
						$inc_sticky++;
						$sticky_present_element = false;
			    	}
			    }
		    }

		    if(is_array($sticky_key_last_row)){
				$last_element = end($sticky_key_last_row);
				if($last_element){
				    switch ($last_element) {
				     	case array_key_exists($last_element, $bottom_header_layout_top):
				     		$sticky_last_row = '_top';
				     		break;		     	
				     	case array_key_exists($last_element, $bottom_header_layout_middle):
				     		$sticky_last_row = '_middle';
				     		break;		     	
				     	case array_key_exists($last_element, $bottom_header_layout_bottom):
				     		$sticky_last_row = '_bottom';
				     		break;		     	
				    } 							
				}
		    }
		    /**
			* End Generate sticky builder(default)
			*/

		    $location = '';
		   	$has_element = false;
 	 		
 	 		$counter = $inc_sticky > 1  ? 1 : $counter;		

		    for ($i=1; $i <= $counter; $i++) {
 	 			if($section == 'bottom'){
 	 				switch ($i) {
 	 					case 1:
 	 						$location = '_top';
 	 						break; 	 					
 	 					case 2:
 	 						$location = '_middle';
 	 						break; 	 					
 	 					case 3:
 	 						$location = '_bottom';
 	 						break;
 	 				}

		    		if($inc_sticky > 1){
		    			$location = $sticky_last_row;	
		    		}

		    		$bottom_header_layout = ${"bottom_header_layout" . $location};
		    		foreach ($bottom_header_layout as $key => $v) {
		    			if (count($bottom_header_layout[$key]) == 1 && empty($bottom_header_layout[$key]['placebo']) || count($bottom_header_layout[$key]) > 2) {
		    				$has_element = true;
		    			}
		    		}
		    	}else{
		    		$has_element = true;
		    	}

			    if (!empty($bottom_header_layout)) {
			    	if($has_element){
			    		echo '<div class="bpt-header-row"'.$this->row_style_color($location, $section).'>';  	
			    		echo '<div class="'.esc_attr($this->row_width_class($location, $section)).'">';		
			    		echo '<div class="bpt-header-row_wrapper"'.$this->row_style_height($location, $section).'>';
			    		foreach ($bottom_header_layout as $side => $value) {
			    			if (!empty($bottom_header_layout[$side]) && $side != 'Items' ) {

			    				$dispay = isset($bottom_header_layout[$side]['pos_column']['display']) ? $bottom_header_layout[$side]['pos_column']['display'] : "";
			    				$v_align = isset($bottom_header_layout[$side]['pos_column']['v_align']) ? $bottom_header_layout[$side]['pos_column']['v_align'] : "";
			    				$h_align = isset($bottom_header_layout[$side]['pos_column']['h_align']) ? $bottom_header_layout[$side]['pos_column']['h_align'] : "";
			    				
			    				$column_class  = '';
			    				$column_class .= !empty($dispay) ? " display_".$dispay : "";
			    				$column_class .= !empty($v_align) ? " v_align_".$v_align : "";
			    				$column_class .= !empty($h_align) ? " h_align_".$h_align : "";
			    				$area_name = '';
			    				switch ($side) {
			    					case stripos($side,'center') !== false:
				    					$area_name = 'center'; 
				    				break;				    					
				    				case stripos($side,'left') !== false:
				    					$area_name = 'left';
				    				break;				    					
				    				case stripos($side,'right') !== false:
				    					$area_name = 'right';
				    				break;	
			    					
			    				}
			    				$class_area = 'position_'.$area_name.$location;
				    			
				    			echo "<div class='".esc_attr(sanitize_html_class($class_area))." header_side".esc_attr($column_class)."'>";

				    			if (count($bottom_header_layout[$side]) == 1 && empty($bottom_header_layout[$side]['placebo']) || count($bottom_header_layout[$side]) > 1) {
				    				echo "<div class='header_area_container'>";
				    				foreach ($bottom_header_layout[$side] as $key => $value) {
				    					if ($key != 'placebo' && $key != 'pos_column') {  
				    						switch ($key) {                                
				    							case 'item_search':
				    								$this->search($this->html_render);
				    							break;				    							
				    							case 'cart':
				    								if(class_exists( 'WooCommerce' ))
				    								$this->cart();
				    							break;
				    							case 'logo':
				    							$logo = self::get_logo($location);
				    							echo !empty($logo) ? $logo : '';
				    							break;
				    							case 'menu':
				    							if (has_nav_menu( 'main_menu' )) {
				    								echo "<nav class='main-menu main_menu_container".($menu_ative_top_line == '1' ? ' menu_line_enable' : '')."' ".$this->row_style_height($location, $section).">";
				    								cryptronick_main_menu ();
				    								echo "</nav>";
				    								echo '<div class="mobile-navigation-toggle"><div class="toggle-box"><div class="toggle-inner"></div></div></div>';
				    							}                                                            
				    							break;
				    							case stripos($key,'html') !== false:
				    							$this_header_bar_editor = $this->header_bar_editor($section,$key);
				    							echo !empty($this_header_bar_editor) ? $this->header_bar_editor($section,$key)  : '';
				    							break;
				    							case 'wpml':
					    							if (class_exists('SitePress')) {
					    								echo "<div class='sitepress_container' ".$this->row_style_height($location, $section).">";
					    								do_action('wpml_add_language_selector');
					    								echo "</div>";
					    							}
				    							break;
				    							case stripos($key,'delimiter') !== false:
				    							echo '<div class="delimiter"></div>'; 
				    							break;				    							
				    							case stripos($key,'spacer') !== false:
				    							$this_header_bar_spacer = $this->header_bar_spacer($key);
				    							echo !empty($this_header_bar_spacer) ? $this->header_bar_spacer($key)  : '';
				    							break;
				    						}
				    					}
				    				}
				    				echo "</div>";
				    			}
				    			echo "</div>";
			    			}
			    		}
			    		echo '</div>';
			    		echo '</div>';
			    		echo '</div>';
			    		$has_element = false;
			    	}
			    }
		    }
	   		/*echo "</div>";*/
	   	}

	   	private function row_width_class($s = '_middle', $section){
			/**
			* Loop Header Row Style Color
			*
			*
			* @since 1.0
			* @access private
			*/
			$class = '';


			switch ($section) {
				case 'bottom':
					$width_container = Cryptronick_Theme_Helper::get_option('header'.$s.'_full_width',$this->name_preset, $this->def_preset);
					if ($width_container == '1') {
			   			$class = "fullwidth-wrapper";
			   		} else {
			   			$class = 'container';
			   		}
					break;				
				
				case 'sticky':
					$width_container = Cryptronick_Theme_Helper::get_option('header_custom_sticky_full_width');
					if ($width_container == '1') {
			   			$class = "fullwidth-wrapper";
			   		} else {
			   			$class = 'container';
			   		}
					break;
				
				default:
					$class = 'container';
	        		break;

			}

			return $class;   		
	   	}

	   	private function row_style_color($s = '_middle', $section){
			if($section != 'bottom' || $this->html_render != 'bottom'){
				return;
			}	   		
			/**
			* Loop Header Row Style Color
			*
			*
			* @since 1.0
			* @access private
			*/
			$header_background = Cryptronick_Theme_Helper::get_option('header'.$s.'_background', $this->name_preset, $this->def_preset);
			$header_background_image = Cryptronick_Theme_Helper::get_option('header'.$s.'_background_image', $this->name_preset, $this->def_preset);
			$header_background_image = isset($header_background_image['url']) ? $header_background_image['url'] : '';  

			$header_color = Cryptronick_Theme_Helper::get_option('header'.$s.'_color', $this->name_preset, $this->def_preset);
			$header_bottom_border = Cryptronick_Theme_Helper::get_option('header'.$s.'_bottom_border', $this->name_preset, $this->def_preset);
			$header_border_height = Cryptronick_Theme_Helper::get_option('header'.$s.'_border_height', $this->name_preset, $this->def_preset);
			$header_border_height = $header_border_height['height'];
			$header_bottom_border_color = Cryptronick_Theme_Helper::get_option('header'.$s.'_bottom_border_color', $this->name_preset, $this->def_preset);
	        
			$style = '';
			if (!empty($header_background['rgba'])) {
	            $style .= !empty($header_background['rgba']) ? 'background-color: '.esc_attr($header_background['rgba']).';' : '';
	        }

	        if(!empty($header_background_image)){
	        	$style .= 'background-size:cover;background-repeat:no-repeat; background-image:url('.esc_attr($header_background_image).');';
	        }

	        if(!empty($header_bottom_border)){
	        	$style .= !empty($header_border_height) ? 'border-bottom-width: '.(int) (esc_attr($header_border_height)).'px;' : '';
	        	if (!empty($header_bottom_border_color['rgba'])) {
	        		$style .= 'border-bottom-color: '.esc_attr($header_bottom_border_color['rgba']).';';
	        	}

	        	$style .= 'border-bottom-style: solid;';
	        }
			if (!empty($header_color['rgba'])) {
	            $style .= !empty($header_color['rgba']) ? 'color: '.esc_attr($header_color['rgba']).';' : '';
	        }

			$style = !empty($style) ? ' style="'.$style.'"' : '';
			return $style;
	   	}	   	

	   	private function row_style_height($s = '_middle', $section){   		
			/**
			* Loop Header Row Style Height
			*
			*
			* @since 1.0
			* @access private
			*/

			$header_sticky_height = Cryptronick_Theme_Helper::get_option('header_sticky_height');
	   		$header_mobile_height = Cryptronick_Theme_Helper::get_option('header_mobile_height');
	   					
	   		$header_height = Cryptronick_Theme_Helper::get_option('header'.$s.'_height', $this->name_preset, $this->def_preset);
			$header_height = $header_height['height'];
			
			$style = '';
	        
	        switch ($this->html_render) {
	        	case 'sticky':
		        	if (!empty($header_sticky_height["height"])) {
			        	$style = ' style="height:'.(int)$header_sticky_height["height"].'px;"';
			        }
	        		break;	        	
	        	
	        	case 'mobile':
		        	if (!empty($header_mobile_height["height"])) {
		        		$style = ' style="height:'.(int)$header_mobile_height["height"].'px;"';
		        	}
	        		break;
	        	
	        	default:
					$style .= !empty($header_height) ? 'height:'.(int) (esc_attr($header_height)).'px;' : "";
					$style = !empty($style) ? ' style="'.$style.'"' : '';
	        		break;

	        }

			return $style;
	   	}

	   	/**
		* Generate header mobile menu
		*
		*
		* @since 1.0
		* @access public
		*/
	   	public function build_header_mobile_menu($preset = null, $def_preset = null){
	   		$preset = !$preset ? $this->name_preset : $preset;
	   		$def_preset = !$def_preset ? $this->def_preset : $def_preset;
	   		
	   		$header_queris = Cryptronick_Theme_Helper::get_option('header_mobile_queris' ,$preset, $def_preset);
	   		echo "<div class='mobile_menu_container' data-mobile-width='".$header_queris."'>";
	   			echo "<div class='container-wrapper'>";
	   		if (has_nav_menu( 'main_menu' )) {
	   			echo "<nav class='main-menu'>";
	   			cryptronick_main_menu ();
	   			echo "</nav>";
	   		}
	   		echo "</div>";
	   		echo "</div>";
	   	}
	   	
	    public function header_render_html(){
	    	$mobile_header_custom =  Cryptronick_Theme_Helper::get_option('mobile_header');
	        echo "<header class='bpt-theme-header".esc_attr($this->header_class())."'>";
            
	            // header output
	            echo "<div class='bpt-site-header".(!empty($mobile_header_custom) ? ' mobile_header_custom' : "")."'>";
	                echo "<div class='container-wrapper'>";
	                $this->build_header_layout();
	                echo "</div>";
	                
	                if(empty($mobile_header_custom)){
	                	$this->build_header_mobile_menu();
	                }
	             	
	            echo "</div>";

	            // sticky header output
	            get_template_part('templates/header/block', 'sticky');
	            
	            // mobile output
	            get_template_part('templates/header/block', 'mobile');

	        echo "</header>";
	    }

	   	/**
		* Get header Logotype
		*
		*
		* @since 1.0
		* @access public
		*/
        public static function get_logo($row = null){
            //Get Default Logotype
            $header_logo_src = Cryptronick_Theme_Helper::get_option('header_logo');
            $header_logo_src = !empty($header_logo_src) ? $header_logo_src['url'] : '';            
            
            //Get Stycky Logotype
            $logo_sticky_src =  Cryptronick_Theme_Helper::get_option('logo_sticky');
            $logo_sticky_src =  !empty($logo_sticky_src) ? $logo_sticky_src['url'] : '';
            
            //Get Mobile Logotype
            $logo_mobile_src =  Cryptronick_Theme_Helper::get_option('logo_mobile');
            $logo_mobile_src =  !empty($logo_mobile_src) ? $logo_mobile_src['url'] : '';

            if (class_exists( 'RWMB_Loader' ) && get_queried_object_id() !== 0) {
                if (rwmb_meta('mb_customize_logo') == 'custom') {
                    
                    //Get Default RWMB Logotype
                    $mb_header_logo_src = rwmb_meta("mb_header_logo");
                    if (!empty($mb_header_logo_src)) {
                        $header_logo_src = array_values($mb_header_logo_src);
                        $header_logo_src = $header_logo_src[0]['full_url'];
                    }
                    
                    //Get Sticky RWMB Logotype
                    $mb_logo_sticky_src = rwmb_meta('mb_logo_sticky');
                    if (!empty($mb_logo_sticky_src)) {
                        $logo_sticky_src = array_values($mb_logo_sticky_src);
                        $logo_sticky_src = $logo_sticky_src[0]['full_url'];
                    }

                    //Get Mobile RWMB Logotype
                    $mb_logo_mobile_src = rwmb_meta('mb_logo_mobile');
                    if (!empty($mb_logo_mobile_src)) {
                        $logo_mobile_src = array_values($mb_logo_mobile_src);
                        $logo_mobile_src = $logo_mobile_src[0]['full_url'];
                    }                
                }
            }

            $logo_height_custom = Cryptronick_Theme_Helper::get_option('logo_height_custom');
            $logo_height = Cryptronick_Theme_Helper::get_option('logo_height');
            $logo_height = $logo_height['height'];
            

            $sticky_logo_height_custom = Cryptronick_Theme_Helper::get_option('sticky_logo_height_custom');
            $sticky_logo_height = Cryptronick_Theme_Helper::get_option('sticky_logo_height');
            $sticky_logo_height = $sticky_logo_height['height'];

            $mobile_logo_height_custom = Cryptronick_Theme_Helper::get_option('mobile_logo_height_custom');
            $mobile_logo_height = Cryptronick_Theme_Helper::get_option('mobile_logo_height');
            $mobile_logo_height = $mobile_logo_height['height'];
            
            if (class_exists( 'RWMB_Loader' ) && get_queried_object_id() !== 0) {
                if (rwmb_meta('mb_customize_logo') == 'custom') {
                    if (rwmb_meta('mb_logo_height_custom') == '1') {
                        $logo_height_custom = rwmb_meta('mb_logo_height_custom');
                        $logo_height = rwmb_meta('mb_logo_height');

                        $sticky_logo_height_custom = rwmb_meta('mb_sticky_logo_height_custom');
                        $sticky_logo_height = rwmb_meta('mb_sticky_logo_height');

                        $mobile_logo_height_custom = rwmb_meta('mb_mobile_logo_height_custom');
                        $mobile_logo_height = rwmb_meta('mb_mobile_logo_height');
                    }                
                }
            }

            $logo_height_style = '';
            if (!empty($logo_height) && $logo_height_custom == '1') {
                $logo_height_style .= 'height:'.(esc_attr((int) $logo_height)).'px;';
            }
            $logo_height_style = !empty($logo_height_style) ? ' style="'.$logo_height_style.'"' : '';

            $sticky_logo_height_style = '';
            if (!empty($sticky_logo_height) && $sticky_logo_height_custom == '1') {
                $sticky_logo_height_style .= 'height:'.(esc_attr((int) $sticky_logo_height)).'px;';
            }elseif(!empty($logo_height) && $logo_height_custom == '1'){
                $sticky_logo_height_style .= 'height:'.(esc_attr((int) $logo_height)).'px;';
            }            

            $mobile_logo_height_style = '';
            if (!empty($mobile_logo_height) && $mobile_logo_height_custom == '1') {
                $mobile_logo_height_style .= 'height:'.(esc_attr((int) $mobile_logo_height)).'px;';
            }elseif(!empty($logo_height) && $logo_height_custom == '1'){
                $mobile_logo_height_style .= 'height:'.(esc_attr((int) $logo_height)).'px;';
            }
            
            // Set Sticky Height Logotype
            $sticky_logo_height_style = !empty($sticky_logo_height_style) ? ' style="'.$sticky_logo_height_style.'"' : '';
          	
          	// Set Mobile Height Logotype
            $mobile_logo_height_style = !empty($mobile_logo_height_style) ? ' style="'.$mobile_logo_height_style.'"' : '';

            $logo = "";
            $logo .= "<div class='bpt-logotype-container".
            (!empty($logo_sticky_src) ? ' sticky_logo_enable' : '').
            (!empty($logo_mobile_src) ? ' mobile_logo_enable' : '')."'>";
            $logo .= "<a href='".esc_url(home_url('/'))."'>";
            if (!empty($header_logo_src)) {
                $logo .= '<img class="default_logo" src="'.esc_url($header_logo_src).'" alt="logo"'.$logo_height_style.'>';
            }else{
                $logo .= '<h1 class="site-title">';
                $logo .= get_bloginfo( 'name' );
                $logo .= '</h1>';
            }
            if (!empty($logo_sticky_src)) {
                $logo .= '<img class="sticky_logo" src="'.esc_url($logo_sticky_src).'" alt="logo"'.$sticky_logo_height_style.'>';
            }   
            if (!empty($logo_mobile_src)) {
                $logo .= '<img class="mobile_logo" src="'.esc_url($logo_mobile_src).'" alt="logo"'.$mobile_logo_height_style.'>';
            }     
            $logo .= "</a>";
            $logo .= "</div>";
            return $logo;            
        }
        
	   	/**
		* Get Header Search
		*
		*
		* @since 1.0
		* @access public
		*/
	    public static function search($html_render = ''){
	        $output = '<div class="header_search">';
	            $output .= '<div class="header_search__container">';
	                $output .= '<div class="header_search__icon">';
	                    $output .= '<i></i>';
	                $output .= '</div>';        
	                if ($html_render != 'sticky' ) {
		                $output .= '<div class="header_search__inner">';
		                	$output .= '<div class="header_search__logo-wrap">';
		                    	$output .= self::get_logo();
		                		$output .= '<div class="header_search__icon-close"></div>';
		                	$output .= '</div>';
		                    $output .= get_search_form(false);
		                $output .= '</div>';
	                }    
	            $output .= '</div>';
	        $output .= '</div>';
	        echo sprintf( $output );
	    }	   	

	    /**
		* Get Header Cart
		*
		*
		* @since 1.0
		* @access public
		*/
	    public static function cart(){
	    	$output = '';
	        echo "<div class='mini-cart'>".self::icon_cart().self::woo_cart()."</div>";
	    }

		public static function icon_cart() {
			ob_start();
			$link = function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : WC()->cart->get_cart_url();
			?>
				<a class="woo_icon" href="<?php echo esc_url( $link ); ?>" title="<?php esc_html_e( 'View your shopping cart','cryptronick' ); ?>"><span class='woo_mini-count flaticon-shopcart-icon'><?php echo ((WC()->cart->cart_contents_count > 0) ?  '<span>' . esc_html( WC()->cart->cart_contents_count ) .'</span>' : '') ?></span></a>
			<?php
			return ob_get_clean();
		}

		public static function woo_cart(){
			ob_start();
			woocommerce_mini_cart();
			return ob_get_clean();			
		}


	    public function in_array_r($needle, $haystack, $strict = false) {
	    	if(is_array($haystack)){
			    foreach ($haystack as $item) {
			        if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && $this->in_array_r($needle, $item, $strict))) {
			            return true;
			        }
			    }	    		
	    	}

		    return false;
		}

	}

    new Cryptronick_get_header();
}
