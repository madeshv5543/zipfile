<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/**
* Cryptronick Theme Helper
*
*
* @class        Cryptronick_Theme_Helper
* @version      1.0
* @category Class
* @author       BlendPixelsThemes
*/

if (!class_exists('Cryptronick_Theme_Helper')) {
    class Cryptronick_Theme_Helper{

        private static $instance = null;
        public static function get_instance( ) {
            if ( null == self::$instance ) {
                self::$instance = new self( );
            }

            return self::$instance;
        }

        function __construct () {
            $this->register_filter();
        }

        function register_filter () {
            add_filter( 'vc_iconpicker-type-flaticon', array($this , 'vc_iconpicker_type_flaticon' ) );

        }

        public static function get_option($name, $preset = null, $def_preset = null) {
            if (  class_exists( 'Redux' ) && class_exists( 'bpt_cryptronick_core_Public' ) ) {
                $preset = $preset == 'default' ? null : $preset;

                if (!$preset) {

                    // Customizer
                    if (!empty($GLOBALS['cryptronick']) && $GLOBALS['cryptronick'] != NULL) {
                        $theme_options = $GLOBALS['cryptronick'];
                    } else {
                        $theme_options = get_option( 'cryptronick' );
                    }

                } else {
                    $theme_options = get_option( 'cryptronick_preset' );
                }
                
                if (empty($theme_options)) {
                    $theme_options = get_option( 'cryptronick_default_options' );
                }

                if(!$preset){
                    return isset($theme_options[$name]) ? $theme_options[$name] : null;  
                }
                
                if(!empty($def_preset)){
                    return isset($theme_options['default'][$preset][$name]) ? $theme_options['default'][$preset][$name] : null;
                }else{
                    return isset($theme_options[$preset][$name]) ? $theme_options[$preset][$name] : null;
                }                
                

            }else{
                $default_option = get_option( 'cryptronick_default_options' );
                return isset($default_option[$name]) ? $default_option[$name] : null;
            }
        }        

        public static function options_compare($opt_name,$meta_conditional = false,$meta_value = false,$meta_conditional2 = false,$meta_value2 = false){
            $option = self::get_option($opt_name);
            if (class_exists( 'RWMB_Loader' ) && get_queried_object_id() !== 0) {
                if ($meta_conditional != false) {           
                    if ($meta_conditional2 != false) {
                        if (rwmb_meta($meta_conditional) == $meta_value &&rwmb_meta($meta_conditional2) == $meta_value2) {
                            $option = rwmb_meta('mb_'.$opt_name);
                        }
                    }else{
                        if (rwmb_meta($meta_conditional) == $meta_value ) {
                            $option = rwmb_meta('mb_'.$opt_name);
                        }
                    }
                }else{
                    $var = rwmb_meta('mb_'.$opt_name);
                    $option = !empty($var) ? rwmb_meta('mb_'.$opt_name) : self::get_option($opt_name);
                }
            }
            return $option;
        }

        public static function bg_render($opt_name,$meta_conditional = false,$meta_value = false){
            $image_array = Cryptronick_Theme_Helper::get_option($opt_name."_bg_image");
            $bg_src = !empty($image_array['background-image']) ? $image_array['background-image'] : '';
            $bg_repeat = !empty($image_array['background-repeat']) ? $image_array['background-repeat'] : '';
            $bg_size = !empty($image_array['background-size']) ? $image_array['background-size'] : '';
            $attachment = !empty($image_array['background-attachment']) ? $image_array['background-attachment'] : '';
            $position = !empty($image_array['background-position']) ? $image_array['background-position'] : '';

            if (class_exists( 'RWMB_Loader' ) && get_queried_object_id() !== 0) {
                if ($meta_conditional != false) {
                    $mb_conditional = rwmb_meta($meta_conditional);
                    if ($mb_conditional == $meta_value) {
                        $bg_src = rwmb_meta('mb_'.$opt_name.'_bg_image');
                        $bg_src = !empty($bg_src) ? $bg_src : '';
                        if (!empty($bg_src)) {
                            $bg_src = array_values($bg_src);
                            $bg_src = $bg_src[0]['url'];
                        }
                        if (!empty($bg_src)) {
                            $bg_repeat = rwmb_meta('mb_'.$opt_name.'_bg_repeat');
                            $bg_repeat = !empty($bg_repeat) ? $bg_repeat : '';
                            $bg_size = rwmb_meta('mb_'.$opt_name.'_bg_size');
                            $bg_size = !empty($bg_size) ? $bg_size : '';
                            $attachment = rwmb_meta('mb_'.$opt_name.'_bg_attachment');
                            $attachment = !empty($attachment) ? $attachment : '';
                            $position = rwmb_meta('mb_'.$opt_name.'_bg_position');
                            $position = !empty($position) ? $position : '';
                        }else{
                            $bg_repeat = '';
                            $bg_size = '';
                            $attachment = '';
                            $position = '';
                        }              
                    }
                }
            }
            $bg_styles = '';
            $bg_styles .= !empty($bg_src) ? 'background-image:url('.esc_url($bg_src).');' : '';
            if (!empty($bg_src)) {
               $bg_styles .= !empty($bg_size) ? 'background-size:'.esc_attr($bg_size).';' : '';
                $bg_styles .= !empty($bg_repeat) ? 'background-repeat:'.esc_attr($bg_repeat).';' : '';
                $bg_styles .= !empty($attachment) ? 'background-attachment:'.esc_attr($attachment).';' : '';
                $bg_styles .= !empty($position) ? 'background-position:'.esc_attr($position).';' : '';
            }
            return $bg_styles;
        }

        public static function preloader(){
            if (self::get_option('preloader') == '1' || self::get_option('preloader') == true) {
                $preloader_background = self::get_option('preloader_background');
                $preloader_color_1 = self::get_option('preloader_color_1');
                $preloader_color_2 = self::get_option('preloader_color_2');
                $preloader_color_3 = self::get_option('preloader_color_3');

                $bg_styles = !empty($preloader_background) ? ' style=background-color:'.$preloader_background.';' : "";
                $circle_color_1 = !empty($preloader_color_1) ? ' style=border-top-color:'.$preloader_color_1.';' : "";
                $circle_color_2 = !empty($preloader_color_2) ? ' style=border-top-color:'.$preloader_color_2.';' : "";
                $circle_color_3 = !empty($preloader_color_3) ? ' style=border-top-color:'.$preloader_color_3.';' : "";

                echo '<div id="preloader-wrapper" '.esc_attr($bg_styles).'>
                        <div class="preloader-container">
                          <div class="dot dot-1" '.esc_attr($circle_color_1).'>
                            <div class="dot dot-2" '.esc_attr($circle_color_2).'></div>
                            <div class="dot dot-3" '.esc_attr($circle_color_3).'></div>
                          </div>
                        </div>
                    </div>';
            }
        }

        public static function pagination($range = 5, $query = false, $alignment = 'center'){
            if ( $query != false ) {
                $wp_query = $query;
            } else {
                global $paged, $wp_query;
            }
            if (empty($paged)) {
                $query_vars = $wp_query->query_vars;
                $paged = isset($query_vars['paged']) ? $query_vars['paged'] : 1;
            }
            
            $compile = '';
            $max_page = $wp_query->max_num_pages;


            // Exit if pagination not need
            if ( !($max_page > 1) ) return;

            switch ($alignment) {
                case 'left':
                    $class_alignment = '';
                    break;
                case 'right':
                    $class_alignment = 'a-right';
                    break;
                case 'center':
                    $class_alignment = 'a-center';
                    break;
                default:
                    $class_alignment = '';
                    break;
            }

            //return $compile;
            $big = 999999999;
            
            $test_pag = paginate_links(array(
                'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                'type' => 'array',
                'current'    => max( 1, $paged ),
                'total'      => $max_page,
                'prev_text' => '<i class="fa fa-angle-left"></i>',
                'next_text' => '<i class="fa fa-angle-right"></i>',
            ));
            $test_comp = '';
            foreach ($test_pag as $key => $value) {
                $test_comp .= '<li>'.$value.'</li>';
            }
            return '<ul class="bpt-pagination '.esc_attr($class_alignment).'">'.$test_comp.'</ul>';
        }

        public static function hexToRGB($hex = "#ffffff"){
            $color = array();
            if (strlen($hex) < 1) {
                $hex = "#ffffff";
            }
            $color['r'] = hexdec(substr($hex, 1, 2));
            $color['g'] = hexdec(substr($hex, 3, 2));
            $color['b'] = hexdec(substr($hex, 5, 2));
            return $color['r'] . "," . $color['g'] . "," . $color['b'];
        }

        public static function modifier_character($string, $length = 80, $etc = '... ', $break_words = false) {
            if ($length == 0)
                return '';

            if (mb_strlen($string, 'utf8') > $length) {
                $length -= mb_strlen($etc, 'utf8');
                if (!$break_words) {
                    $string = preg_replace('/\s+\S+\s*$/su', '', mb_substr($string, 0, $length + 1, 'utf8'));
                }
                return mb_substr($string, 0, $length, 'utf8') . $etc;
            } else {
                return $string;
            }
        }

        public static function load_more($range = 5, $query = false, $alignment = 'left', $name_load_more = '', $class = ''){
            $out = '';
            $name_load_more = !empty($name_load_more) ? $name_load_more : esc_html__("Load More", "cryptronick");
            $out .= '<div class="clear"></div><div class="text-center load_more_wrapper'.(!empty($class) ? " ".esc_attr($class) : "" ).'"><a href="#" class="load_more_item"><span>' . esc_html($name_load_more) . '</span></a>';

            $uniq = uniqid();
            $ajax_data_str = htmlspecialchars( json_encode( $query ), ENT_QUOTES, 'UTF-8' );
            $out .= "<form class='posts_grid_ajax'>";
                $out .= "<input type='hidden' class='ajax_data' name='{$uniq}_ajax_data' value='$ajax_data_str' />";
            $out .= "</form>";
            $out .= "</div>";
           
            return $out;
        }

        public static function header_preset_name(){
            $id = get_queried_object_id();
            $name_preset = '';

            //Redux options header
            $name_preset = self::get_option('header_def_js_preset');
            $get_def_name = get_option( 'cryptronick_preset' );
            if( !self::in_array_r($name_preset, get_option( 'cryptronick_preset' ))){                   
                $name_preset = 'default';
            }

            //Metaboxes options header
            if (class_exists( 'RWMB_Loader' ) && $id !== 0) {
                $customize_header = rwmb_meta('mb_customize_header');
                if (!empty($customize_header) && rwmb_meta('mb_customize_header') != 'default') {
                    $name_preset = rwmb_meta('mb_customize_header');                  
                    if( !self::in_array_r($name_preset, get_option( 'cryptronick_preset' ))){
                        $name_preset = 'default';
                    }
                }
            }
            return $name_preset;
        }

        public static function render_html ($args) {
            return isset($args) ? $args : '';
        }
 
        public static function in_array_r($needle, $haystack, $strict = false) {
            if(is_array($haystack)){
                foreach ($haystack as $item) {
                    if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && self::in_array_r($needle, $item, $strict))) {
                        return true;
                    }
                }                
            }

            return false;
        }


        public function vc_iconpicker_type_flaticon( $icons ) {
            $flaticon_icons = array(
                array( 'flaticon-left-arrow' => 'left-arrow' ),
                array( 'flaticon-down-arrow' => 'down-arrow' ),
                array( 'flaticon-right-arrow' => 'right-arrow' ),
                array( 'flaticon-vector' => 'vector' ),
                array( 'flaticon-search' => 'search' ),
                array( 'flaticon-luxury' => 'luxury' ),
                array( 'flaticon-folder' => 'folder' ),
                array( 'flaticon-business' => 'business' ),
                array( 'flaticon-commerce' => 'commerce' ),
                array( 'flaticon-money-8' => 'money-8' ),
                array( 'flaticon-graphic-1' => 'graphic-1' ),
                array( 'flaticon-gestures' => 'gestures' ),
                array( 'flaticon-mark-1' => 'mark-1' ),
                array( 'flaticon-symbol' => 'symbol' ),
                array( 'flaticon-share' => 'share' ),
                array( 'flaticon-interface' => 'interface' ),
                array( 'flaticon-circle-1' => 'circle-1' ),
                array( 'flaticon-pin' => 'pin' ),
                array( 'flaticon-close' => 'close' ),
                array( 'flaticon-school' => 'school' ),
                array( 'flaticon-coins-5' => 'coins-5' ),
                array( 'flaticon-tool' => 'tool' ),
                array( 'flaticon-circle' => 'circle' ),
                array( 'flaticon-close-cross-circular-interface-button' => 'close-button' ),
                array( 'flaticon-mark' => 'mark' ),
                array( 'flaticon-money-7' => 'money-7' ),
                array( 'flaticon-money-6' => 'money-6' ),
                array( 'flaticon-money-5' => 'money-5' ),
                array( 'flaticon-money-4' => 'money-4' ),
                array( 'flaticon-money-3' => 'money-3' ),
                array( 'flaticon-graphene' => 'graphene' ),
                array( 'flaticon-hologram' => 'hologram' ),
                array( 'flaticon-technology' => 'technology' ),
                array( 'flaticon-computer' => 'computer' ),
                array( 'flaticon-chip' => 'chip' ),
                array( 'flaticon-coins-4' => 'coins-4' ),
                array( 'flaticon-coins-3' => 'coins-3' ),
                array( 'flaticon-money-2' => 'money-2' ),
                array( 'flaticon-coins-2' => 'coins-2' ),
                array( 'flaticon-money-1' => 'money-1' ),
                array( 'flaticon-mobile' => 'mobile' ),
                array( 'flaticon-coins-1' => 'coins-1' ),
                array( 'flaticon-graphic' => 'graphic' ),
                array( 'flaticon-coins' => 'coins' ),
                array( 'flaticon-download' => 'download' ),
            );

            return array_merge( $icons, $flaticon_icons );
        }

        
    }
    new Cryptronick_Theme_Helper();
}
?>