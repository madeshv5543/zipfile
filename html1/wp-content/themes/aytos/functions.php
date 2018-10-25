<?php
/**
 * functions.php
 * @package WordPress
 * @subpackage Cryptoking
 * @since cryptoking 1.2
 * 
 */

/*************************************************
## Admin style and scripts  
*************************************************/ 

function cryptoking_admin_styles() {
     wp_enqueue_style('cryptoking_klbtheme',     get_template_directory_uri() .'/assets/css/admin/klbtheme.css');
     wp_enqueue_style('ionicons',     get_template_directory_uri() .'/assets/css/ionicons.min.css');
	 wp_enqueue_script('cryptoking_init', 	  	 get_template_directory_uri() .'/assets/js/init.js', array('jquery','media-upload','thickbox'));
}
add_action('admin_enqueue_scripts', 'cryptoking_admin_styles');

 /*************************************************
## Cryptoking Fonts
*************************************************/

function cryptoking_fonts_url() {
        $fonts_url = '';
 
		$poppins = _x( 'on', 'Poppins font: on or off', 'cryptoking' );	

		if ( 'off' !== $poppins ) {
		$font_families = array();
		 
		if ( 'off' !== $poppins ) {
		$font_families[] = 'Poppins:100,200,300,400,500,600,700,800,900';
		}
		
		$query_args = array( 
		'family' => rawurldecode( implode( '|', $font_families ) ), 
		'subset' => rawurldecode( 'latin,latin-ext' ), 
		); 
		 
		$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
		}
 
return esc_url_raw( $fonts_url );
}

/*************************************************
## Styles and Scripts
*************************************************/ 
define('CRYPTOKING_INDEX_JS', get_template_directory_uri()  . '/assets/js');
define('CRYPTOKING_INDEX_CSS', get_template_directory_uri()  . '/assets/css');
define('CRYPTOKING_INDEX', get_template_directory_uri()  . '/assets');

function cryptoking_scripts() {
	
     if ( is_admin_bar_showing() ) {
       wp_enqueue_style( 'klbtheme', CRYPTOKING_INDEX_CSS . '/admin/klbtheme.css', false, '1.0');    
     }	
	 
	 if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	 }
	 
     wp_enqueue_style( 'bootstrap',    			 CRYPTOKING_INDEX  	   . '/bootstrap/css/bootstrap.min.css', false, '1.0');
     wp_enqueue_style( 'animate',    			 CRYPTOKING_INDEX_CSS  . '/animate.css', false, '1.0');
     wp_enqueue_style( 'ionicons',    			 CRYPTOKING_INDEX_CSS  . '/ionicons.min.css', false, '1.0');
     wp_enqueue_style( 'owl-carousel',    		 CRYPTOKING_INDEX      . '/owlcarousel/css/owl.carousel.min.css', false, '1.0');
     wp_enqueue_style( 'owl-theme',    			 CRYPTOKING_INDEX      . '/owlcarousel/css/owl.theme.css', false, '1.0');
     wp_enqueue_style( 'magnific-popup',    	 CRYPTOKING_INDEX_CSS  . '/magnific-popup.css', false, '1.0');
     wp_enqueue_style( 'cryptoking_stylem',      CRYPTOKING_INDEX_CSS  . '/style.css', false, '1.0');	  
     wp_enqueue_style( 'cryptoking_responsive',  CRYPTOKING_INDEX_CSS  . '/responsive.css', false, '1.0');	  
     wp_enqueue_style( 'cryptoking_theme',  	 CRYPTOKING_INDEX	   . '/color/theme.css', false, '1.0');  
     wp_enqueue_style( 'cryptoking_font',        cryptoking_fonts_url(), array(), null );	 
  	 wp_enqueue_style( 'cryptoking_style',       get_stylesheet_uri() );   

	 $mapkey = ot_get_option('cryptoking_mapapi');
	
     wp_enqueue_script( 'bootstrap',     	     CRYPTOKING_INDEX    . '/bootstrap/js/bootstrap.min.js', array('jquery'), '1.0', true);
     wp_enqueue_script( 'owl-carousel',     	 CRYPTOKING_INDEX    . '/owlcarousel/js/owl.carousel.min.js', array('jquery'), '1.0', true);
     wp_enqueue_script( 'magnific-popup',  	     CRYPTOKING_INDEX_JS . '/magnific-popup.min.js', array('jquery'), '1.0', true);
     wp_enqueue_script( 'waypoints',    		 CRYPTOKING_INDEX_JS . '/waypoints.min.js', array('jquery'), '1.0', true);
     wp_enqueue_script( 'parallax',    	 	 	 CRYPTOKING_INDEX_JS . '/parallax.js', array('jquery'), '1.0', true);
     wp_register_script( 'particles',    	 	 CRYPTOKING_INDEX_JS . '/particles.min.js', array('jquery'), '1.0', true);
     wp_register_script( 'cryptoking_particle',  CRYPTOKING_INDEX_JS . '/custom/cryptoking_particle.js', array('jquery'), '1.0', true);
     wp_register_script( 'countdown',    	 	 CRYPTOKING_INDEX_JS . '/jquery.countdown.min.js', array('jquery'), '1.0', true);
     wp_register_script( 'cryptoking_countdown', CRYPTOKING_INDEX_JS . '/custom/cryptoking_countdown.js', array('jquery'), '1.0', true);
     wp_register_script( 'cryptoking_roadmap',   CRYPTOKING_INDEX_JS . '/custom/cryptoking_roadmap.js', array('jquery'), '1.0', true);
     wp_register_script( 'cryptoking_slidepost', CRYPTOKING_INDEX_JS . '/custom/cryptoking_slidepost.js', array('jquery'), '1.0', true);
     wp_register_script( 'cryptoking_sticky', 	 CRYPTOKING_INDEX_JS . '/custom/cryptoking_sticky.js', array('jquery'), '1.0', true);
	 wp_register_script( 'googlemap',           'https://maps.googleapis.com/maps/api/js?key='. $mapkey .'', array('jquery'), '1.0', true);
     wp_enqueue_script( 'cryptoking_scripts',  	CRYPTOKING_INDEX_JS . '/scripts.js', array('jquery'), '1.0', true);


    }
add_action( 'wp_enqueue_scripts', 'cryptoking_scripts' );

/*************************************************
## Cryptoking Theme options
*************************************************/

	require_once get_template_directory() . '/includes/breadcrumb.php'; 
	require_once get_template_directory() . '/includes/metaboxes.php';
	require_once get_template_directory() . '/includes/sanitize.php';
   	add_filter( 'ot_show_pages', '__return_false' );
	add_filter( 'ot_show_new_layout', '__return_false' );
	require_once get_template_directory() . '/includes/theme-options.php';
	if(function_exists('vc_set_as_theme')) { 
	   require_once get_template_directory() . '/includes/js_composer/shortcodes.php';
	   require_once get_template_directory() . '/includes/js_composer/ion-klbicon.php';
	}

/*************************************************
## Theme Setup
*************************************************/ 

if ( ! isset( $content_width ) ) $content_width = 960;

function cryptoking_theme_setup() {
	
	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'post-formats', array('gallery', 'audio', 'video'));
	load_theme_textdomain( 'cryptoking', get_template_directory() . '/languages' );

}
add_action( 'after_setup_theme', 'cryptoking_theme_setup' );


/*************************************************
## Include the TGM_Plugin_Activation class.
*************************************************/ 

require_once get_template_directory() . '/includes/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'cryptoking_register_required_plugins' );

function cryptoking_register_required_plugins() {
	
	$plugins = array(
		
        array(
            'name'                  => esc_html__('Meta Box','cryptoking'),
            'slug'                  => 'meta-box',
        ),

        array(
            'name'                  => esc_html__('Contact Form 7','cryptoking'),
            'slug'                  => 'contact-form-7',
        ),

        array(
            'name'                  => esc_html__('Theme Options','cryptoking'),
            'slug'                  => 'option-tree',
        ),
		
		array(
            'name'                  => esc_html__('MailChimp Subscribe','cryptoking'),
            'slug'                  => 'mailchimp-for-wp',
        ),

        array(
            'name'                  => esc_html__('Visual Composer','cryptoking'),
            'slug'                  => 'js_composer',
            'source'                => get_template_directory() . '/plugins/js-composer.zip',
            'required'              => false,
            'version'               => '5.5.2',
            'force_activation'      => false,
            'force_deactivation'    => false,
            'external_url'          => '',
        ),

        array(
            'name'                  => esc_html__('Klb Shortcode','cryptoking'),
            'slug'                  => 'klb-shortcode',
            'source'                => get_template_directory() . '/plugins/klb-shortcode.zip',
            'required'              => false,
            'version'               => '1.0',
            'force_activation'      => false,
            'force_deactivation'    => false,
            'external_url'          => '',
        ),
		
        array(
            'name'                  => esc_html__('Revolution Slider','cryptoking'),
            'slug'                  => 'revslider',
            'source'                => get_template_directory() . '/plugins/revslider.zip',
            'required'              => false,
            'version'               => '5.4.8',
            'force_activation'      => false,
            'force_deactivation'    => false,
            'external_url'          => '',
        ),

        array(
            'name'                  => esc_html__('Envato Market Master','cryptoking'),
            'slug'                  => 'wp-envato-market-master',
            'source'                => get_template_directory() . '/plugins/wp-envato-market-master.zip',
            'required'              => true,
            'version'               => '1.0',
            'force_activation'      => false,
            'force_deactivation'    => false,
            'external_url'          => '',
        ),

        array(
            'name'                  => esc_html__('Demo Installation','cryptoking'),
            'slug'                  => 'easy_installer',
            'source'                => get_template_directory() . '/plugins/easy_installer.zip',
            'required'              => false,
            'version'               => '1.2',
            'force_activation'      => false,
            'force_deactivation'    => false,
            'external_url'          => '',
        ),


	);

	$config = array(
		'id'           => 'cryptoking',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}

/*************************************************
## Cryptoking Register Menu 
*************************************************/

function cryptoking_register_menus() {
	register_nav_menus( array( 'main-menu' => esc_html__('Primary Navigation Menu', 'cryptoking')) );
	register_nav_menus( array( 'footer-menu' => esc_html__('Footer Menu', 'cryptoking')) ); 

}
add_action('init', 'cryptoking_register_menus');

/*************************************************
## Cryptoking Menu
*************************************************/ 
class cryptoking_description_walker extends Walker_Nav_Menu {
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		// depth dependent classes
		$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
		$display_depth = ( $depth + 1); // because it counts the first submenu as 0
		$classes = array(
			'',
			( $display_depth % 2  ? '' : '' ),
			( $display_depth >=2 ? '' : '' ),
			
			);
		$class_names = implode( ' ', $classes );
	  
		// build html
		$output .= "\n" . $indent . '<ul class="dropdown-menu list_none">' . "\n";
	}

    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ){
        $id_field = $this->db_fields['id'];
        if ( is_object( $args[0] ) ) {
            $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
        }
        return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }
      function start_el(&$output, $object, $depth = 0, $args = Array() , $current_object_id = 0) {
           
           global $wp_query;

           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

           $class_names = $value = '';
		   
		   $classes = empty( $object->classes ) ? array() : (array) $object->classes;
           $icon_class = $classes[0];
		   $classes = array_slice($classes,1);
		   
		   $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $object ) );
		   $class_names = 'class=" nav-item '. esc_attr( $class_names ) . '"';

		   if($object->object == 'page'){
				$varpost = get_post($object->object_id);                
				$separate_page = get_post_meta($object->object_id, "klb_separate_page", true);
				$disable_menu = get_post_meta($object->object_id, "klb_disable_section_from_menu", true);
				$current_page_id = get_option('page_on_front');
				
				if ( ( $disable_menu != true ) && ( $varpost->ID != $current_page_id ) ) {
					$output .= $indent . '<li ' . $value . $class_names .'>';
					
					$attributes = '';
					if ( function_exists( 'klb_cryptoking' ) ) {
						if ( $args->has_children ) {
						$attributes .= ! empty( $object->url ) ? ' class="nav-link dropdown-toggle" href="'   . esc_attr( $object->url ) .'" ' : '';
						} else {
						$attributes .= ! empty( $object->url ) ? ' class="nav-link" href="'   . esc_attr( $object->url ) .'" ' : '';
						}
					} elseif ( $separate_page == true ) {
							$attributes .= ! empty( $object->url ) ? ' href="'   . esc_url( $object->url ) .'"' : '';
					} else {
						if (is_front_page()) {
								$attributes .= ' class="nav-link page-scroll" href="#'. $varpost->post_name . '" ';
						} else {
								$attributes .= ' class="nav-link" href="' .  ''.esc_url(home_url('/')).'#' . $varpost->post_name . '" ';
						}
					}
					
					$object_output = $args->before;
					$object_output .= '<a'. $attributes .'  >';
					$object_output .= $args->link_before .  apply_filters( 'the_title', $object->title, $object->ID ) . '';
					$object_output .= $args->link_after;
					$object_output .= '</a>';
					$object_output .= $args->after;

					$output .= apply_filters( 'walker_nav_menu_start_el', $object_output, $object, $depth, $args );

				}
		   } else {
			$output .= $indent . '<li ' . $value . $class_names .'>';

			$attributes = '';
			if (strpos($object->url, '#') !== false) {
			$attributes .= ! empty( $object->url ) ? ' class="nav-link page-scroll" href="'   . esc_url( $object->url ) .'"' : '';
			} else {
			$attributes .= ! empty( $object->url ) ? ' class="nav-link" href="'   . esc_url( $object->url ) .'"' : '';
			}
			
			$object_output = $args->before;
			$object_output .= '<a'. $attributes .'  >';
			$object_output .= $args->link_before .  apply_filters( 'the_title', $object->title, $object->ID ) . '';
	        $object_output .= $args->link_after;
			$object_output .= '</a>';
			$object_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $object_output, $object, $depth, $args );
		   }	
		    
      }
}

add_filter('nav_menu_css_class' , 'cryptoking_nav_class' , 10 , 2);
function cryptoking_nav_class($classes, $item){
     if( in_array('menu-item-has-children', $classes) ){
             $classes[] = 'dropdown';
     }
     return $classes;
}
/*************************************************
## Cryptoking Footer Menu
*************************************************/ 
class cryptoking_footer_description_walker extends Walker_Nav_Menu {
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		// depth dependent classes
		$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
		$display_depth = ( $depth + 1); // because it counts the first submenu as 0
		$classes = array(
			'',
			( $display_depth % 2  ? '' : '' ),
			( $display_depth >=2 ? '' : '' ),
			
			);
		$class_names = implode( ' ', $classes );
	  
		// build html
		$output .= "\n" . $indent . '<ul class="dropdown-menu">' . "\n";
	}

    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ){
        $id_field = $this->db_fields['id'];
        if ( is_object( $args[0] ) ) {
            $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
        }
        return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }
      function start_el(&$output, $object, $depth = 0, $args = Array() , $current_object_id = 0) {
           
           global $wp_query;

           $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

           $class_names = $value = '';
		   
		   $classes = empty( $object->classes ) ? array() : (array) $object->classes;
           $icon_class = $classes[0];
		   $classes = array_slice($classes,1);
		   
		   $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $object ) );

		   $class_names = 'class="'. esc_attr( $class_names ) . '"';


			$output .= $indent . '<li ' . $value . $class_names .'>';


			$attributes = ! empty( $object->url ) ? ' href="'   . esc_attr( $object->url ) .'"' : '';	

			$object_output = $args->before;

			$object_output .= '<a'. $attributes .'  >';
			$object_output .= $args->link_before .  apply_filters( 'the_title', $object->title, $object->ID ) . '';
	        $object_output .= $args->link_after;
			$object_output .= '</a>';


			$object_output .= $args->after;

			$output .= apply_filters( 'walker_nav_menu_start_el', $object_output, $object, $depth, $args );            	              	
      }
}



/*************************************************
## Excerpt More
*************************************************/ 

function cryptoking_excerpt_more($more) {
  global $post;
  return '<div class="read-more"><a href="'. esc_url(get_permalink($post->ID)) . '" class="btn btn-default">' . esc_html__('Read More', 'cryptoking') . ' <i class="fa fa-angle-right"></i></a></div>';
}
add_filter('excerpt_more', 'cryptoking_excerpt_more');

/*************************************************
## Word Limiter
*************************************************/ 
function cryptoking_limit_words($string, $limit) {
	$words = explode(' ', $string);
	return implode(' ', array_slice($words, 0, $limit));
}

/*************************************************
## Cryptoking body classes
*************************************************/

function cryptoking_body_classes( $classes ) {
	if(ot_get_option('cryptoking_skin_type') == 'blue'){
		$classes[] = 'v_blue';
	}elseif(ot_get_option('cryptoking_skin_type') == 'light'){
		$classes[] = 'v_light';
	}elseif(ot_get_option('cryptoking_skin_type') == 'dark'){
		$classes[] = 'v_dark';
	} else {
		$classes[] = '';
	}
	return $classes;
}
add_filter( 'body_class', 'cryptoking_body_classes' );

/*************************************************
## Widgets
*************************************************/ 

function cryptoking_widgets_init() {
	register_sidebar( array(
	  'name' => esc_html__( 'Blog Sidebar', 'cryptoking' ),
	  'id' => 'blog-sidebar',
	  'description'   => esc_html__( 'These are widgets for the Blog page.','cryptoking' ),
	  'before_widget' => '<div class="widget %2$s">',
	  'after_widget'  => '</div>',
	  'before_title'  => '<h5 class="widget_title">',
	  'after_title'   => '</h5>'
	) );
}
add_action( 'widgets_init', 'cryptoking_widgets_init' );

/*************************************************
## Pagination Function
*************************************************/

function cryptoking_pagination($pages = '', $range = 4) {
	$showitems = ($range * 2)+1;
	
	global $paged;
	if(empty($paged)) $paged = 1;
	
	if($pages == '') {
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if(!$pages) {
			$pages = 1;
		}
	}
	if(1 != $pages){
	    echo '<ul class="pagination justify-content-center">';
		if($paged > 1 ){
			echo '<li class="page-numbers previous">'.get_previous_posts_link('<i class="ion-arrow-left-c"></i>').'</li>';
		}
		if($paged > 1 && $showitems < $pages){ 
			echo "<li><a class='page-numbers' href='".get_pagenum_link($paged - 1)."'>&lsaquo; </a></li>"; 
		}
		
		for ($i=1; $i <= $pages; $i++) {
			if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
				echo ($paged == $i)? "<li class='active'><a class='page-numbers' href='".esc_url(get_pagenum_link($i))."' >".$i."</a></li>":
				"<li><a class='page-numbers' href='".esc_url(get_pagenum_link($i))."' >".$i."</a></li>";
			}
		}
	
		if ($paged < $pages){
			echo '<li class="page-numbers next">'.get_next_posts_link('<i class="ion-arrow-right-c"></i>').'</li>';
		}
	    echo '</ul>';

	}
}

 /*************************************************
## Cryptoking Comment
*************************************************/

if ( ! function_exists( 'cryptoking_comment' ) ) :
 function cryptoking_comment( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment;
  switch ( $comment->comment_type ) :
   case 'pingback' :
   case 'trackback' :
  ?>

   <article class="post pingback">
   <p><?php esc_html_e( 'Pingback:', 'cryptoking' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( esc_html__( '(Edit)', 'cryptoking' ), ' ' ); ?></p>
  <?php
    break;
   default :
  ?>
  
		<li class="comment_info">
			<div class="d-flex">
				<div class="user_img">
					<img src="<?php echo get_avatar_url( $comment, 80 ); ?>" alt="<?php comment_author(); ?>"/>
				</div>
				<div class="comment_content">
					<div class="d-flex align-items-center">
						<div class="meta_data">
							<h6><a><?php comment_author(); ?></a></h6>
							<div class="comment-time"><?php comment_date(); ?></div>
						</div>
						<div class="ml-auto">
							<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
						</div>
					</div>
					<div class="klb-post"><?php comment_text(); ?></div>
					<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php esc_html_e( 'Your comment is awaiting moderation.', 'cryptoking' ); ?></em>
					<?php endif; ?>
					<article class="clearfix" id="comment-<?php comment_ID(); ?>"></article>
				</div>
			</div>
		</li>

  <?php
    break;
  endswitch;
 }
endif;


/*************************************************
## Cryptoking Comment Placeholder
 *************************************************/

add_filter( 'comment_form_default_fields', 'cryptoking_comment_placeholders' );
function cryptoking_comment_placeholders( $fields ){
    $fields['author'] = str_replace(
        '<input',
        '<input placeholder="'.esc_html__('Name * ','cryptoking').'"',
        $fields['author']
    );
    $fields['email'] = str_replace(
        '<input',
        '<input placeholder="'.esc_html__('Email *','cryptoking').'"',
        $fields['email']
    );
    $fields['url'] = str_replace(
        '<input',
        '<input placeholder="'.esc_html__('Website','cryptoking').'"',
        $fields['url']
    );
    return $fields;
}

add_filter( 'comment_form_defaults', 'cryptoking_textarea_placeholder' );
function cryptoking_textarea_placeholder( $fields ){

    $fields['comment_field'] = str_replace(
        '<textarea',
        '<textarea placeholder="'.esc_html__('Comment','cryptoking').'"',
        $fields['comment_field']
    );
    return $fields;
}