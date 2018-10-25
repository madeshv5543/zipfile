<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/**
* Page Title area
*
*
* @class 		Cryptronick_get_page_title
* @version		1.0
* @category	Class
* @author 		BlendPixelsThemes
*/

if (!class_exists('Cryptronick_get_page_title')) {
	class Cryptronick_get_page_title{

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

	    private $page_title_conditional;
	    private $mb_page_title_conditional;
	    protected $id;
 
		public function init(){	
			$this->id = get_queried_object_id();
			$this->page_title_conditional = Cryptronick_Theme_Helper::get_option('page_title_conditional') == '1' || Cryptronick_Theme_Helper::get_option('page_title_conditional') == true ? 'yes' : 'no';
			if (class_exists( 'RWMB_Loader' ) && $this->id !== 0) {
				$this->mb_page_title_conditional = rwmb_meta('mb_page_title_conditional');
			}

	        /**
			* Generate html header rendered
			*
			*
			* @since 1.0
			* @access public
			*/
	        $this->page_title_render_html();
	   	}



	   	public function page_title_render_html(){

	        if ($this->page_title_conditional == 'yes') {
	            $page_title_breadcrumbs_conditional = Cryptronick_Theme_Helper::get_option('page_title_breadcrumbs_conditional') == '1' ? 'yes' : 'no';

	            $page_title_horiz_align = Cryptronick_Theme_Helper::get_option('page_title_horiz_align');	           
	        }
	        if (class_exists( 'RWMB_Loader' ) && $this->id !== 0) {

	            if ($this->mb_page_title_conditional == 'yes') {
	                $this->page_title_conditional = 'yes';
	                
	                $page_title_breadcrumbs_conditional = rwmb_meta('mb_show_breadcrumbs') == '1' ? 'yes' : 'no';
	               
	                $page_title_horiz_align = rwmb_meta('mb_page_title_horizontal_align');
	            }elseif($this->mb_page_title_conditional == 'no'){
	                $this->page_title_conditional = 'no';
	            }
	        }

	        $cryptronick_page_title = $this->cryptronick_page_title();
	        $this_cryptronick_page_title = $this->cryptronick_page_title();

	        if ($this->page_title_conditional == 'yes' && !empty($this_cryptronick_page_title)) {
	        	
	        	$this_page_title_classes = $this->page_title_classes();
	        	$this_page_title_styles = $this->page_title_styles();
	            echo "<div class='bpt-page-title". (!empty($this_page_title_classes) ? esc_attr($this_page_title_classes) : '' ) ."'".( !empty($this_page_title_styles) ? ' style="'.esc_attr($this->page_title_styles()).'"' : '').">";
	                echo "<div class='bpt-page-title__inner'>";
	                    echo "<div class='container'>";
	                        echo "<div class='bpt-page-title__content'>";
	                            echo "<div class='page_title'><h1>";
	                                echo Cryptronick_Theme_Helper::render_html($cryptronick_page_title);
	                            echo "</h1>";
	                            echo "</div>";
	                            if ($page_title_breadcrumbs_conditional == 'yes') {
	                                echo "<div class='cryptronick_breadcrumb'>";
	                                    get_template_part('templates/breadcrumbs');
	                                echo "</div>";
	                            }
	                        echo "</div>";  
	                    echo "</div>";                  
	                echo "</div>";
	            echo "</div>";

	        }	
	   	}

	    public function cryptronick_page_title(){
	        $title = '';
	        if (is_home() || is_front_page()) {
	            $title = '';
	        }
	        elseif (is_category()) {
	            $title = single_cat_title('', false);
	        }elseif (is_tag()) {
	            $title = single_term_title("", false).esc_html__(' Tag', 'cryptronick');
	        }elseif (is_date()) {
	            $title = get_the_time('F Y');
	        }elseif(is_author()){
	            $title = esc_html__('Author:', 'cryptronick') . " " . get_the_author();
	        }elseif (is_search()) {
	            $title = esc_html__('Search', 'cryptronick');
	        }elseif (is_404()) {
	            $title = esc_html__('Error 404', 'cryptronick');
	        }elseif (is_archive()) { 	
	            if (is_post_type_archive('tribe_events')) {
	                $title = esc_html(post_type_archive_title('',false));
	            }          
	            elseif(function_exists('is_shop') && ( is_shop() || is_product_category() || is_product_tag() ) ){
	            	$title = esc_html__('Shop', 'cryptronick');
	            }
	            else{
	                $title = esc_html__('Archive','cryptronick');
	            }
	        }elseif(is_home() || is_front_page()){
	            $title = '';
	        }
	        else{
	            global $post;
	            
	            if (!empty($post)) {
	                $id = $post->ID;
	                $posttype = get_post_type($post );
	                $blog_title_conditional = ((Cryptronick_Theme_Helper::get_option('blog_title_conditional') == '1' || Cryptronick_Theme_Helper::get_option('blog_title_conditional') == true)) ? 'yes' : 'no';
	                
	                if($posttype == 'post'){
	                    $title = $blog_title_conditional == 'yes' ? esc_html__( 'BLOG', 'cryptronick' ) : esc_html(get_the_title($id));
	                }else{
	                    
	                    $title = esc_html(get_the_title($id));                    
	                }

	            }else{
	                $title = esc_html__('No Posts','cryptronick');
	            }
	            
	        } 
	        return $title;
	    }


	   	public function page_title_classes(){
	        if ($this->page_title_conditional == 'yes') {

	            $page_title_vert_align = Cryptronick_Theme_Helper::get_option('page_title_vert_align');
	            $page_title_horiz_align = Cryptronick_Theme_Helper::get_option('page_title_horiz_align');
	            $page_title_height = Cryptronick_Theme_Helper::get_option('page_title_height');
	            $page_title_height = $page_title_height['height'];
	        }

	        if (class_exists( 'RWMB_Loader' ) && $this->id !== 0) {
	            if ($this->mb_page_title_conditional == 'yes') {
	                $page_title_vert_align = rwmb_meta('mb_page_title_vertical_align'); 
	                $page_title_horiz_align = rwmb_meta('mb_page_title_horizontal_align');
	                $page_title_height = rwmb_meta('mb_page_title_height');
	            }
	        }

	        $page_title_classes = !empty($page_title_horiz_align) ? ' bpt-page-title_horiz_align_'.esc_attr($page_title_horiz_align) : 'bpt-page-title_horiz_align_left';
	        $page_title_classes .= !empty($page_title_vert_align) ? ' bpt-page-title_vert_align_'.esc_attr($page_title_vert_align) : 'bpt-page-title_vert_align_middle';
	        $page_title_classes .= !empty($page_title_height) && (int)$page_title_height < 80 ? ' bpt-page-title_small_header' : '';
	        
	        return $page_title_classes;		
	   	}

	   	public function page_title_styles(){

	        $page_title_bottom_margin = Cryptronick_Theme_Helper::get_option('page_title_bottom_margin');
	        $page_title_bottom_margin = !empty($page_title_bottom_margin['margin-bottom']) ? (int)$page_title_bottom_margin['margin-bottom'] : '';

	        $page_title_padding = Cryptronick_Theme_Helper::options_compare('page_title_padding', 'mb_page_title_conditional', 'yes');
	        $page_title_padding_top = !empty($page_title_padding['padding-top']) ? (int)$page_title_padding['padding-top'] : '';
	        $page_title_padding_bottom = !empty($page_title_padding['padding-bottom']) ? (int)$page_title_padding['padding-bottom'] : '';

	        if ($this->page_title_conditional == 'yes') {
	            $page_title_font_color = Cryptronick_Theme_Helper::get_option('page_title_font_color');
	            $page_title_bg_color = Cryptronick_Theme_Helper::get_option('page_title_bg_color');
	            $page_title_bg_image_array = Cryptronick_Theme_Helper::get_option('page_title_bg_image');
	            $page_title_height = Cryptronick_Theme_Helper::get_option('page_title_height');
	            $page_title_height = $page_title_height['height'];

	        }

	        if (class_exists( 'RWMB_Loader' ) && $this->id !== 0) {
	            if ($this->mb_page_title_conditional == 'yes') {
	                $this->page_title_conditional = 'yes';

	                $page_title_font_color = rwmb_meta('mb_page_title_font_color');
	                $page_title_bg_color = rwmb_meta('mb_page_title_bg_color');
	                $page_title_height = rwmb_meta('mb_page_title_height');
	                $page_title_bottom_margin = rwmb_meta('mb_page_title_offset');
	            }elseif($this->mb_page_title_conditional == 'no'){
	                $this->page_title_conditional = 'no';
	            }
	        }

	        $page_title_styles = !empty($page_title_bg_color) ? 'background-color:'.esc_attr($page_title_bg_color).';' : '';
	        $page_title_styles .= !empty($page_title_height) ? 'height:'.esc_attr($page_title_height).'px;' : '';        
	        $page_title_styles .= !empty($page_title_font_color) ? 'color:'.esc_attr($page_title_font_color).';' : '';
	        $page_title_styles .= !empty($page_title_bottom_margin) ? 'margin-bottom:'.esc_attr($page_title_bottom_margin).'px;' : '';
	        $page_title_styles .= Cryptronick_Theme_Helper::bg_render('page_title','mb_page_title_conditional','yes');
	        $page_title_styles .= !empty($page_title_padding_top) ?  'padding-top:'.esc_attr($page_title_padding_top).'px;' : '';
			$page_title_styles .= !empty($page_title_padding_bottom) ?  'padding-bottom:'.esc_attr($page_title_padding_bottom).'px;' : '';
	        
	        return $page_title_styles;		
	   	}
	
	}

    new Cryptronick_get_page_title();
}
