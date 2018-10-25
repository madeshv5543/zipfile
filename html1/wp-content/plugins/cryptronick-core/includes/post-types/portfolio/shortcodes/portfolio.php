<?php


/**
* 
*/
class BptPortfolio{

    private $shortcodeName;
    public $post_count;

    public function __construct() {
        $this->shortcodeName = 'bpt_portfolio_list';
        add_action('vc_before_init', array($this, 'shortcodesMap'));
        $this->addShortcode();
    }

    public function shortcodesMap(){    
        require_once(WP_PLUGIN_DIR . '/' .trim(dirname(plugin_basename(__FILE__)), '/'). '/options.php');
    }

    public function addShortcode(){
        add_shortcode($this->shortcodeName, array($this, 'render'));
    }

    public function render($atts, $content = null){
        include_once get_template_directory() . '/core/vc/templates/bpt_google_fonts_render.php';
        $header_font = Cryptronick_Theme_Helper::get_option('header-font');
        $main_font = Cryptronick_Theme_Helper::get_option('main-font');
        $theme_color = esc_attr(Cryptronick_Theme_Helper::get_option("theme-custom-color"));
        $theme_gradient = Cryptronick_Theme_Helper::get_option('theme-gradient');
        
        $args = array(
            'build_query' => '',
            'posts_per_row' => 4,
            'show_filter' => '',
            'portfolio_layout' => 'grid',
            'view_style' => 'standard',
            'items_load' => 4,
            'show_pagination' => '',
            'show_loadmore' => '',
            'grid_gap' => '30px',
            'crop_images' => 'yes',
            'featured_render' => '',
            'css_animation' => '',
            'css' => '',
            'item_el_class' => '',
            'portfolio_navigation_align' => 'left',
            
            // Content
            'click_area' => 'none',
            'info_position' => 'inside_image',
            'image_anim' => 'default',
            'horizontal_align' => 'center',
            'vertical_align' => 'center',
            'add_shadow' => '',
            'show_content' => '',
            'show_portfolio_title' => true,
            'show_meta_author' => '',
            'show_meta_categories' => true,
            'show_meta_date' => '',
            'show_comments' => '',
            'show_likes' => '',
            'content_letter_count' => '85',
            
            // Carousel
            'autoplay' => false,
            'autoplay_speed' => '3000',
            'use_pagination' => true,
            'pag_type' => 'circle',
            'pag_offset' => '',
            'custom_pag_color' => false,
            'pag_color' => $theme_color,
            'custom_resp' => false,
            'resp_medium' => '1025',
            'resp_medium_slides' => '',
            'resp_tablets' => '800',
            'resp_tablets_slides' => '',
            'resp_mobile' => '480',
            'resp_mobile_slides' => '',
            
            // Custom style
            'custom_portfolio_style' => '',
            'custom_fonts_portfolio_content' => '',
            'google_fonts_portfolio' => '',
            'custom_fonts_portfolio_headings' => '',
            'google_fonts_portfolio_headings' => '',
            'custom_main_color' => esc_attr(Cryptronick_Theme_Helper::get_option('theme-custom-color')),
            'custom_filter_color' => esc_attr(Cryptronick_Theme_Helper::get_option('theme-custom-color')),
            'custom_headings_color' => esc_attr($header_font['color']),
            'custom_content_color' => esc_attr($main_font['color']),
            'heading_font_size' => '30',
            'content_font_size' => '16',
            'bg_color_type' => 'color',
            'background_color' => 'rgba('.Cryptronick_Theme_Helper::HexToRGB($theme_color).', 0.8)',
            'background_gradient_start' => 'rgba('.Cryptronick_Theme_Helper::HexToRGB($theme_gradient['from']).', 0.8)',
            'background_gradient_end' => 'rgba('.Cryptronick_Theme_Helper::HexToRGB($theme_gradient['to']).', 0.8)',

            //Metaboxes Settings
            'mb_pf_carousel_r' => '',
        );

        $params = shortcode_atts($args, $atts);
        
        extract($params);
        // Build Query Visual Composer
        list($query_args) = vc_build_loop_query($build_query);
       
        $query_args['paged'] = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $query_args['post_type'] = 'portfolio';
        
        // Add Query Not In Post in the Related Posts(Metaboxes)
        if(!empty($featured_render)){
            $query_args['post__not_in'] = array( get_the_id() );
        }

        $query_results = new WP_Query($query_args);
        $params['post_count'] = $this->post_count = $query_results->post_count;
        $params['query_args'] = $query_args;

        
        $sc_obj = Vc_Shortcodes_Manager::getInstance()->getElementClass( $this->shortcodeName );
        $class_to_filter = vc_shortcode_custom_css_class( $css, ' ' ) . $sc_obj->getExtraClass( $item_el_class );
        $css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $css, $atts );

        // Add custom id
        $item_id = '';
        $item_id = uniqid( "portfolio_module_" );
        

        //Register css
        $this->register_css($params, $item_id);
                 
        //Metaxobes Related Items
        if(!empty($featured_render)){
            $portfolio_layout = 'related';
        }
        if(!empty($featured_render) && !empty($mb_pf_carousel_r)){
            $portfolio_layout = 'carousel';
        }
        
        if(!empty($show_filter)){
            $portfolio_layout = 'masonry';
        }
        
        $out = '';               
        $out .= '<section class="bpt_cpt_section">';               
        $out .= '<div class="'.esc_attr($this->shortcodeName).'"'.((bool)$item_id ? ' id="'.esc_attr($item_id).'"' : "" ).'>';
        
        wp_enqueue_script( 'imagesloaded' );    
        if($click_area == 'popup'){
            wp_enqueue_script('cryptronick-swipebox', get_template_directory_uri() . '/js/swipebox/js/jquery.swipebox.min.js', array(), false, false);
            wp_enqueue_style('cryptronick-swipebox-style', get_template_directory_uri() . '/js/swipebox/css/swipebox.min.css');            
        }

        if ($portfolio_layout == 'masonry') {
            //Call Wordpress Masonry
            wp_enqueue_script('isotope');
        }

        if ( (bool) $show_filter) {         
            $filter_class = $portfolio_layout != "carousel" ? 'isotope-filter' : '';
            $out .= '<div class="'.esc_attr($this->shortcodeName).'__filter '.esc_attr($filter_class).'">';
            $out .= $this->getCategories($query_args, $query_results);
            $out .= '</div>'; 
        }

        $style_gap = isset($grid_gap) && !empty($grid_gap) ? ' style="margin-right:-'.$grid_gap.';margin-bottom:-'.$grid_gap.';"' : '';


        $out .= '<div class="'.esc_attr($this->shortcodeName).'-container container-grid row '.esc_attr($this->row_class($params, $portfolio_layout)).esc_attr($css_class).'" '.$style_gap.'>'; 
        $out .= $this->output_loop_query($query_results, $params);        
        $out .= '</div>';

        wp_reset_postdata();     

        if ((bool) $show_pagination ) {
            global $paged;
            if(empty($paged)){
                $paged = (get_query_var('page')) ? get_query_var('page') : 1;
            }

            $out .= Cryptronick_Theme_Helper::pagination('10', $query_results, $portfolio_navigation_align);            
        }
        if ( (bool) $show_loadmore ) {
            $out .= $this->loadMore ($params); 
        }     
        
        $out .= '</div>';
        $out .= '</section>';
        return $out;
    }

    public function output_loop_query($q, $params){
        extract($params);
        $out = '';
        //Metaxobes Related Items
        if(!empty($featured_render)){
            $portfolio_layout = 'related';
        }
        if(!empty($featured_render) && !empty($mb_pf_carousel_r)){
            $portfolio_layout = 'carousel';
        }  
        if($q->have_posts()):   
            ob_start();                                   
            while ( $q->have_posts() ) : $q->the_post();
                $item_class = $this->grid_class($params);
                switch ($portfolio_layout) {                                                  
                    case 'single':
                    echo $this->bpt_portfolio_single_item($params, $item_class);
                    break; 
                    default:
                    echo $this->bpt_portfolio_item($params, $item_class);
                    break;            
                }                    
            endwhile;  
            $render = ob_get_clean();                

            $out .= $portfolio_layout == 'carousel' ? $this->bpt_portfolio_carousel_item($params, $item_class , $render) : $render;
        endif;  
        return $out;
    }

    public function bpt_portfolio_carousel_item($params, $item_class, $return){
        extract($params);

        $carousel_options_arr = array(
            'posts_per_line' => $posts_per_row,
            'autoplay_carousel' => $autoplay,
            'slider_speed' => $autoplay_speed,
            'use_pagination' => $use_pagination,
            'pag_type' => $pag_type,
            'pag_offset' => $pag_offset,
            'custom_pag_color' => $custom_pag_color,
            'pag_color' => $pag_color,
            'custom_resp' => $custom_resp,
            'resp_medium' => $resp_medium,
            'resp_medium_slides' => $resp_medium_slides,
            'resp_tablets' => $resp_tablets,
            'resp_tablets_slides' => $resp_tablets_slides,
            'resp_mobile' => $resp_mobile,
            'resp_mobile_slides' => $resp_mobile_slides,
        );

        // carousel options
        $carousel_options = array_map( function($k, $v) { return "$k=\"$v\" "; }, array_keys($carousel_options_arr), $carousel_options_arr);
        $carousel_options = implode('', $carousel_options);

        wp_enqueue_script('cryptronick-slick', get_template_directory_uri() . '/js/slick.min.js', array(), false, false);

        $portfolio_items = do_shortcode('[bpt_carousel '.$carousel_options.']'. $return .'[/bpt_carousel]');

        return $portfolio_items;
    }

    private function register_css($params,$item_id){
        extract($params);
        
        // Start Custom CSS
        $styles = '';

        // Render Google Fonts
        if( (bool)$custom_fonts_portfolio_content || (bool)$custom_fonts_portfolio_headings ) {

            $portfolio_value_font = $portfolio_value_font_headings = '';
            $obj = new GoogleFontsRender();
            $sc_obj = Vc_Shortcodes_Manager::getInstance()->getElementClass( $this->shortcodeName );
            
            extract( $obj->getAttributes( $params, $sc_obj, $this->shortcodeName, array('google_fonts_portfolio', 'google_fonts_portfolio_headings')));

            if ( ! empty( $styles_google_fonts_portfolio_headings ) ) {
                $portfolio_value_font_headings = esc_attr( $styles_google_fonts_portfolio_headings );
                $styles .= "
                #$item_id .title {
                    ".$portfolio_value_font_headings."
                }";
            }
            if ( ! empty( $styles_google_fonts_portfolio ) ) {
                $portfolio_value_font = esc_attr( $styles_google_fonts_portfolio );
                $styles .= "#$item_id .bpt_portfolio_item-content,
                #$item_id .bpt_portfolio_item-meta{
                    ".$portfolio_value_font."
                }";

            }          
        }

        // Render colors and font size
        if ( (bool)$custom_portfolio_style ) {
            $custom_main_color_css = !empty($custom_main_color) ? ' color:'.$custom_main_color.';' : '';
            $custom_filter_count = !empty($custom_filter_color) ? ' background:'.$custom_filter_color.';' : '';
            $custom_filter_color = !empty($custom_filter_color) ? ' color:'.$custom_filter_color.';' : '';
            $custom_headings_color_css = !empty($custom_headings_color) ? ' color:'.$custom_headings_color.';' : '';
            $custom_content_color_css = !empty($custom_content_color) ? ' color:'.$custom_content_color.';' : '';
            
            $heading_font_size_css = !empty($heading_font_size) ? ' font-size:'.$heading_font_size.'px;' : '';
            $content_font_size_css = !empty($content_font_size) ? ' font-size:'.$content_font_size.'px;' : '';

            // custom testimonials colors
            ob_start();

            if ( (bool)$custom_headings_color_css || (bool)$heading_font_size_css ) {
                echo "#$item_id .title{
                    ".$custom_headings_color_css . $heading_font_size_css."
                    line-height: 1.1;
                }";
            }

            if ( (bool)$custom_content_color_css || (bool)$content_font_size_css) {
                echo "#$item_id .bpt_portfolio_item-content{
                    ".$custom_content_color_css . $content_font_size_css."
                    line-height: 1.7;
                }";
            }
            if ( (bool)$custom_main_color_css ) {
                echo "#$item_id .bpt_portfolio_item-meta,
                #$item_id .bpt_portfolio_item-meta a,
                #$item_id .bpt_portfolio_item-meta span{
                    ".$custom_main_color_css."
                }";
            }            

            if ( (bool)$custom_filter_color ) {
                echo "#$item_id .isotope-filter a:hover, .isotope-filter a.active{
                    ".$custom_filter_color."
                }";
                echo "#$item_id .isotope-filter a .number_filter{
                    ".$custom_filter_count."
                }";
            }
            $styles .= ob_get_clean();            
        }


        if($bg_color_type == 'color'){
            $styles .= "#$item_id .overlay{
                background-color: ".$background_color."
            }";
        }   

        if($bg_color_type == 'gradient'){
            $styles .= "#$item_id .overlay{          
                background: linear-gradient(90deg, $background_gradient_start, $background_gradient_end);
            }";
        }        

        if(isset($grid_gap) && !empty($grid_gap)){
            $styles .= "#$item_id .slick-dots{
                margin-right: ".$grid_gap."
            }";
        }

        // Register css
        if (!empty($styles)) {
            if(function_exists('Cryptronick_shortcode_css')){
               Cryptronick_shortcode_css()->enqueue_cryptronick_css($styles); 
            }
        }
    }

    private function row_class($params, $pf_layout){
        extract($params);
        $class = '';
        switch ($pf_layout) {
            case 'carousel':
                $class .= 'carousel';
                break;               
            case 'related':
                $class .= !empty($mb_pf_carousel_r) ? 'carousel' : 'isotope';
                break; 
            case 'masonry':
                $class .= 'isotope';
                break;            
            default:
                $class .= 'grid';
                break;
        }         

        $class .= ' portfolio_columns-'.$posts_per_row.'';             
        return $class;

    }

    public function grid_class ($params) {
        switch ($params['posts_per_row']) {
            case 1:
                $class = 'span12';
                break;
            case 2:
                $class = 'span6';
                break;
            case 3:
                $class = 'span4';
                break;
            case 4:
                $class = 'span3';
                break;
            default:
                $class = 'span12';
        }
        $class .= $this->post_cats_class();
        return $class;
    }

    private function post_date($date){ 
        if(!(bool) $date) return;
        return '<span class="post_date">' . esc_html(get_the_time(get_option( 'date_format' ))) . '</span>';
    }    

    private function post_author($author){       
        if(!(bool) $author) return;    
        return '<span class="post_author">' . esc_html__("by", "bpt_cryptronick_core") . ' <a href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author_meta('display_name')) . '</a></span>';
    }   

    private function post_cats_links( $cat ){
        
        if(!(bool) $cat) return;
        $p_cats = wp_get_post_terms(get_the_id(), 'portfolio-category');
        $p_cats_str = '';
        $p_cats_links = '<span class="post_cats">';
        for ($i=0; $i<count( $p_cats ); $i++) {
            $p_cat_term = $p_cats[$i];
            $p_cat_name = $p_cat_term->name;
            $p_cats_str .= ' '.$p_cat_name;
            $p_cats_link = get_category_link( $p_cat_term->term_id );
            $p_cats_links .= '<a href='.esc_html($p_cats_link).' class="portfolio-category">'.esc_html($p_cat_name).'</a>';
            if($i !== count( $p_cats ) - 1) {
                $p_cats_links .= '<span class="delimiter-comma">, </span>';
            }
        }
        $p_cats_links .= '</span>';
        return $p_cats_links;
    }        

    private function post_comments($comments){
        if(!(bool) $comments) return;

        $comments_num = '' . get_comments_number(get_the_ID()) . '';
        $comments_text = '' . $comments_num == 1 ? esc_html__('comment', 'cryptronick-core') : esc_html__('comments', 'cryptronick-core') . '';
        $post_comments = '<span class="post_comments"><a href="' . esc_url(get_comments_link()) . '">' . esc_html(get_comments_number(get_the_ID())) . ' ' . $comments_text . '</a></span>';
        return $post_comments;
    }

    private function post_cats_class(){
        $p_cats = wp_get_post_terms(get_the_id(), 'portfolio-category');
        $p_cats_class = '';
        for ($i=0; $i<count( $p_cats ); $i++) {
            $p_cat_term = $p_cats[$i];
            $p_cats_class .= ' '.$p_cat_term->slug;
        }
        return $p_cats_class;
    }   

    private function chars_count ( $cols = null ){
        $number = 155;
        switch ( $cols ){
            case '1':
                $number = 300;
                break;
            case '2':
                $number = 130;
                break;
            case '3':
                $number = 70;
                break;
            case '4':
                $number = 55;
                break;
        }
        return $number;
    }

    private function post_content ($params){
        extract( $params );
        if(!(bool) $show_content) return;

        if(class_exists('WPBMap')){
            WPBMap::addAllMappedShortcodes();
        }
       
        $pid = get_the_id ();
        $post = get_post( $pid );
        
        $out = $content = "";
        $chars_count = !empty($content_letter_count) ? $content_letter_count : $this->chars_count( $posts_per_row );
        $content = !empty( $post->post_excerpt ) ? $post->post_excerpt : $post->post_content;
        $content = trim( preg_replace( "/[\s]{2,}/", " ", strip_shortcodes( strip_tags( $content ) ) ) );
        $content = wptexturize( $content );
        $content = substr( $content, 0, $chars_count );

        if(!empty($content)){
            $content = "<div class='wrapper'>$content</div>";
            $out .= '<div class="bpt_portfolio_item-content">';
            $tag = 'div';
            $out .= sprintf('<%s class="content">%s</%s>', $tag, $content, $tag);                  
            $out .= '</div>';  
        }
        return $out;
    }

    public function bpt_portfolio_item($params, $class){
        extract($params);
        $out = '';

        $click_area = !empty($click_area) ? $click_area : "";

        $link = '';
        
        // Post meta
        $post_date = $this->post_date($show_meta_date);
        $post_author = $this->post_author($show_meta_author);
        $post_cats_links = $this->post_cats_links($show_meta_categories);
        $post_comments = $this->post_comments($show_comments);
        $post_likes = '';

        if ( function_exists('bpt_simple_likes') && (bool) $show_likes) {
            $post_likes = bpt_simple_likes()->likes_button( get_the_ID(), 0 );
        } 
        // Post meta
        $post_meta = $post_date . $post_author . $post_cats_links . $post_comments . $post_likes;    
        
        $crop = isset($crop_images) && !empty($crop_images) ? true : false;
        $wrapper_class = isset($info_position)  ? ' '. $info_position : "";
        
        $wrapper_class = isset($info_position)  ? ' '. $info_position : "";
        $wrapper_class .= isset($vertical_align) && !empty($vertical_align)  ? ' v_align_'. $vertical_align : "";
        $wrapper_class .= isset($horizontal_align) && !empty($horizontal_align)  ? ' h_align_'. $horizontal_align : "";
        $wrapper_class .= isset($add_shadow) && !empty($add_shadow)  ? ' add_shadow_item' : "";
        $wrapper_class .= $info_position == 'inside_image' ? ' '.$image_anim.'_animation' : '';

        $style_gap = isset($grid_gap) && !empty($grid_gap) ? ' style="padding-right:'.$grid_gap.';padding-bottom:'.$grid_gap.'"' : '';

        // set post options
        $p_id = get_the_ID();
        $wp_get_attachment_url = wp_get_attachment_url(get_post_thumbnail_id($p_id), 'full');

        switch ($click_area) {
            case 'popup':
                $link = "<a href='" . $wp_get_attachment_url . "' class='swipebox'></a>";
                break;
            case 'single':
                $link = "<a href='" . get_permalink() . "' class='single_link'></a>";
                break;
        }

        // Animation
        $animation_class = '';
        $sc_obj = Vc_Shortcodes_Manager::getInstance()->getElementClass( $this->shortcodeName );
        if (isset($css_animation) && !empty($css_animation)) {
            $animation_class = $sc_obj->getCSSAnimation( $css_animation );
        }

        $out .= '<article class="bpt_portfolio_list-item item '.esc_attr($class).esc_attr($animation_class).'" '.$style_gap.'>';
        $out .= '<div class="bpt_portfolio_item-wrapper'.esc_attr($wrapper_class).'">';   
        $out .= '<div class="bpt_portfolio_item-image">';
        $out .= self::getImgUrl($params, $wp_get_attachment_url, $crop);

        if($info_position == 'under_image'){
            //Overlay settings in css
            $out .= '<div class="overlay"></div>';

            //Links
            $out .= $link;            
        }
        $out .= '</div>';   

        $out .= '<div class="bpt_portfolio_item-description">';                  

        if((bool) $show_portfolio_title){
            $out .= '<div class="bpt_portfolio_item-title">';
            $tag = 'h4';
            $tag_title = $click_area == 'none' || $info_position == 'under_image'? 'a' : 'span';
            $tag_attr = $click_area == 'none' || $info_position == 'under_image' ? 'href="'.get_permalink().'"' : '';
            $out .= sprintf('<%s class="title"><%s %s>'.get_the_title().'</%s></%s>', 
                $tag,
                $tag_title, 
                $tag_attr, 
                $tag_title, 
                $tag
            );                  
            $out .= '</div>';                                  
        }

        if((bool) ($post_meta)){
            $out .= '<div class="bpt_portfolio_item-meta">' . $post_meta . '</div>';
        }
    
        if((bool) $show_content){
            $out .= $this->post_content($params);
        }

        if(!(bool) $show_portfolio_title && !(bool) $show_content && !(bool) $post_meta){
            $out .= '<span class="portfolio-post_overlay-figure"></span>';
        }

        $out .= '</div>'; 
        
        if($info_position != 'under_image'){
            //Overlay settings in css
            $out .= '<div class="overlay"></div>';

            //Links
            $out .= $link;            
        }        
        $out .= '</div>';

        $out .= '</article>';
        return $out;
    } 

    private function single_post_date(){
        $date = Cryptronick_Theme_Helper::get_option('portfolio_single_meta_date');   
        if(!empty($date)){
           return '<span>' . esc_html(get_the_time(get_option( 'date_format' ))) . '</span>'; 
        }       
    }      

    private function single_post_likes(){
        $show_likes = Cryptronick_Theme_Helper::get_option('portfolio_single_meta_likes');   
        if ( function_exists('bpt_simple_likes') && (bool) $show_likes) {
            return bpt_simple_likes()->likes_button( get_the_ID(), 0 );
        }      
    }    

    private function single_post_author(){
        $author = Cryptronick_Theme_Helper::get_option('portfolio_single_meta_author');   
        if(!empty($author)){
           return '<span>' . esc_html__("by", "bpt_core") . ' <a href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author_meta('display_name')) . '</a></span>';
        }       
    }       

    private function single_post_comments(){
        $comments = Cryptronick_Theme_Helper::get_option('portfolio_single_meta_comments');  

        $post_comments = '';
        if(!empty($comments)){
            $comments_num = '' . get_comments_number(get_the_ID()) . '';
            $comments_text = '' . $comments_num == 1 ? esc_html__('comment', 'bpt_core') : esc_html__('comments', 'bpt_core') . '';
            return $post_comments = '<span><a href="' . esc_url(get_comments_link()) . '">' . esc_html(get_comments_number(get_the_ID())) . ' ' . $comments_text . '</a></span>';   
        } 
    }    

    private function single_post_cats(){
        $cat = Cryptronick_Theme_Helper::get_option('portfolio_single_meta_categories');   
        if(!empty($cat)){
            $post_cats = wp_get_post_terms(get_the_id(), 'portfolio-category');
            $post_cats_str = '';
            $post_cats_class = '';
            $post_cats_links = '<span>';
            for ($i=0; $i<count( $post_cats ); $i++) {
                $post_cat_term = $post_cats[$i];
                $post_cat_name = $post_cat_term->name;
                $post_cats_str .= ' '.$post_cat_name;
                $post_cats_class .= ' '.$post_cat_term->slug;
                $post_cats_link = get_category_link( $post_cat_term->term_id );
                $post_cats_links .= '<a href='.esc_html($post_cats_link).' class="portfolio-category">'.esc_html($post_cat_name).'</a>';
            }
            $post_cats_links .= '</span>';
            return $post_cats_links;              
        }
    
    }
    public function bpt_portfolio_single_item($parameters, $item_class = ''){
        $out = '';

        // MetaBoxes
        $p_id = get_the_ID();
        $mb_featured_img = $mb_meta_info = $mb_title = true;
        $mb_cats_under = $mb_soc_under = '';
        if (class_exists( 'RWMB_Loader' )) {
            $mb_featured_img = rwmb_meta('mb_portfolio_featured_img');
            $mb_title = rwmb_meta('mb_portfolio_title');
            $mb_info = rwmb_meta('mb_portfolio_info_items');

            $mb_meta_info = Cryptronick_Theme_Helper::get_option('portfolio_single_meta');
            
            if (rwmb_meta('mb_portfolio_above_content_cats') == 'default') {
                $mb_cats_under = Cryptronick_Theme_Helper::get_option('portfolio_above_content_cats');
            } else {
                $mb_cats_under = rwmb_meta('mb_portfolio_above_content_cats');
            }
            if (rwmb_meta('mb_portfolio_above_content_share') == 'default') {
                $mb_soc_under = Cryptronick_Theme_Helper::get_option('portfolio_above_content_share');
            } else {
                $mb_soc_under = rwmb_meta('mb_portfolio_above_content_share');
            }

        }

        // Post meta
        $post_comments = $this->single_post_comments();
        $post_cats_links = $this->single_post_cats();
        $post_date = $this->single_post_date();
        $post_author = $this->single_post_author();
        $post_likes = $this->single_post_likes();

        // Post meta
        $post_meta = $post_date . $post_author . $post_cats_links . $post_comments;    
        // set post options
        
        $wp_get_attachment_url = wp_get_attachment_url(get_post_thumbnail_id($p_id), 'full');

        $out .= '<article class="bpt_portfolio_single-item">';
            $out .= '<div class="bpt_portfolio_item-wrapper">';

            if(!empty($mb_title)){
                $tag = 'h2';
                $out .= sprintf('<%s class="bpt_portfolio_item-title">'.get_the_title().'</%s>', 
                    $tag, 
                    $tag);
            }

            $portfolio_info = '';

            if (isset($mb_info) && !empty($mb_info)) {
                for ( $i=0; $i<count( $mb_info ); $i++ ){
                    $info = $mb_info[$i];
                    $info_name = !empty($info['name']) ? $info['name'] : '';
                    $info_description = !empty($info['description']) ? $info['description'] : '';
                    $info_link = !empty($info['link']) ? $info['link'] : '';

                    if (!empty($info_name) &&!empty($info_description)) {
                        $portfolio_info .= '<div class="portfolio_info_item-info_desc">';
                            $portfolio_info .= '<h5>'.$info_name.'</h5>';
                            $portfolio_info .= !empty($info_link) ? '<a href="'.esc_url($info_link).'">' : '';
                                $portfolio_info .= '<span>'.$info_description.'</span>';
                            $portfolio_info .= !empty($info_link) ? '</a>' : '';
                        $portfolio_info .= '</div>';
                    }
                }
            }

            if(!empty($post_meta) && !(bool)$mb_meta_info){
               $out .= '<div class="bpt_portfolio_item-meta">' . $post_meta . '</div>';
            } 

            if(!empty($portfolio_info)){
                $tag = 'div';
                $out .= sprintf('<%s class="bpt_portfolio_item-annotation">%s</%s>', $tag, $portfolio_info, $tag);     
            }

            if(!empty($mb_featured_img)){
                $out .= '<div class="bpt_portfolio_item-image">';
                $out .= BptPortfolio::getImgUrl($parameters, $wp_get_attachment_url, false);
                $out .= '</div>';                    
            }
           
            $content =  apply_filters('the_content', get_post_field('post_content', get_the_id()));

            if(!empty($content)){
                $out .= '<div class="bpt_portfolio_item-content">';              
                $tag = 'div';              
                $out .= sprintf('<%s class="content"><div class="wrapper">%s</div></%s>', 
                    $tag, 
                    $content, 
                    $tag
                );                 
                $out .= '</div>';                  
            }

            $single = Cryptronick_SinglePost::getInstance();
            ob_start();
            $single->render_post_share($mb_soc_under);
            $social_share = ob_get_clean();

            ob_start();
            if($mb_cats_under == "1" || $mb_cats_under == "yes"){
                $this->getTags('<div class="tagcloud">', ' ', '</div>');
            }
            $post_tags = ob_get_clean();

            if(!empty($post_tags) || !empty($social_share)){
                $tag = 'div';  
                $out .= sprintf('<%1$s class="post_info single_post_info post_info-portfolio"><div class="tags_likes_wrap clearfix">%2$s%3$s</div>%4$s</%1$s>', 
                        $tag, 
                        $post_tags,
                        $post_likes,
                        $social_share
                    );                
            }
         

            $out .= '</div>';  
        $out .= '</article>';
        
        return $out;
    }

    static public function getImgUrl ($params, $wp_get_attachment_url, $crop = false) {
        if (strlen($wp_get_attachment_url)) {
            switch ($params['posts_per_row']) {
                case "1":
                    $bpt_featured_image_url = $wp_get_attachment_url;
                    break;
                case "2":
                    $bpt_featured_image_url = aq_resize($wp_get_attachment_url, "1170", "1170", $crop, true, true);
                    break;
                case "3":
                    $bpt_featured_image_url = aq_resize($wp_get_attachment_url, "740", "740", $crop, true, true);
                    break;
                case "4":
                    $bpt_featured_image_url = aq_resize($wp_get_attachment_url, "570", "570", $crop, true, true);
                    break;
                default:
                    $bpt_featured_image_url = aq_resize($wp_get_attachment_url, "1170", "1170", $crop, true, true);
            }
            if (!(bool)$bpt_featured_image_url) {
                $bpt_featured_image_url = $wp_get_attachment_url;
            }
            $featured_image = '<img  src="' . $bpt_featured_image_url . '" alt="" />';
        } else {
            $featured_image = '';
        }
        return $featured_image;

    }

    public function getTags($before = null, $sep = ', ', $after = ''){
       if ( null === $before )
        $before = __('Tags: ', 'cryptronick-core');

        $the_tags = $this->get_the_tag_list( $before, $sep, $after );

        if ( ! is_wp_error( $the_tags ) ) {
            echo $the_tags;
        } 
    }
    private function get_the_tag_list( $before = '', $sep = '', $after = '', $id = 0 ) {

        /**
         * Filters the tags list for a given post.
         */
        global $post;

        return apply_filters( 'the_tags', get_the_term_list( $post->ID, 'portfolio-tag', $before, $sep, $after ), $before, $sep, $after, $post->ID );
    }

    public function getCategories($params, $query){
        $data_category = isset($params['tax_query']) ? $params['tax_query'] : array();
        $include = array();
        $exclude = array();
        if (!is_tax()) {
            if (!empty($data_category) && isset($data_category[0]) && $data_category[0]['operator'] === 'IN') {
                foreach ($data_category[0]['terms'] as $key => $value) {
                    array_push($include, $value);
                }
            } elseif (!empty($data_category) && isset($data_category[0]) && $data_category[0]['operator'] === 'NOT IN') {
                foreach ($data_category[0]['terms'] as $key => $value) {
                    array_push($exclude, $value);
                }
            }    
        }
        
        $cats = get_terms(array(
                'taxonomy' => 'portfolio-category',
                'include' => $include,
                'exclude' => $exclude
            ));
        $out = '<a href="#" data-filter=".item" class="active">All<span class="number_filter"></span></a>';
        foreach ($cats as $cat) {
            $out .= '<a href="'.get_term_link($cat->term_id, 'portfolio-category').'" data-filter=".'.$cat->slug.'">';
            $out .= $cat->name;
            $out .= '<span class="number_filter"></span>';
            $out .= '</a>';
        }
        return $out;
    }

    public function loadMore ($params) {
        $out = '';
        $out .= '<div class="clear"></div><div class="text-center load_more_wrapper"><a href="#" class="load_more_item"><span>' . esc_html__("Load More", "cryptronick-core") . '</span></a>';

        $uniq = uniqid();
        $ajax_data_str = json_encode( $params );
        $out .= "<form class='posts_grid_ajax'>";
            $out .= "<input type='hidden' class='ajax_data' name='{$uniq}_ajax_data' value='$ajax_data_str' />";
        $out .= "</form>";
        $out .= "</div>";
       
        return $out;
    }

}