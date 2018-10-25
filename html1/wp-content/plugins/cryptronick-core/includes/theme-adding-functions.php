<?php
// Adding functions for theme

function bpt_types_init(){
    if (class_exists('Vc_Manager')) {
        if (function_exists('cryptronick_image_select')) {
            vc_add_shortcode_param('cryptronick_dropdown', 'cryptronick_image_select', get_template_directory_uri().'/core/vc/custom_types/js/bpt_image_select.js');
        }
        if (function_exists('cryptronick_dropdown_field')) {
            vc_add_shortcode_param('dropdown_multi','cryptronick_dropdown_field');
        }
        if (function_exists('cryptronick_checkbox_custom')) {
            vc_add_shortcode_param('bpt_checkbox', 'cryptronick_checkbox_custom', get_template_directory_uri().'/core/vc/custom_types/js/checkbox_custom.js');
        }
        if (function_exists('cryptronick_heading_line')) {
            vc_add_shortcode_param('cryptronick_param_heading', 'cryptronick_heading_line');
        }
    }
}
add_action( 'init', 'bpt_types_init' );
        
//admin icon tinymce shortcode
if (!function_exists('bpt_admin_icon')) {
    function bpt_admin_icon($atts){
        if(!class_exists('BptAdminIcon')){
            return;
        }
        extract( shortcode_atts( array(
                    'name'             => '',
                    'class'            => '',
                    'unprefixed_class' => '',
                    'title'            => '', /* For compatibility with other plugins */
                    'size'             => '', /* For compatibility with other plugins */
                    'space'            => '',
            ), $atts )
        );

        $title = $title ? 'title="' . $title . '" ' : '';
        $space = 'true' == $space ? '&nbsp;' : '';
        $size = $size ? ' '. BptAdminIcon()->prefix . '-' . $size : '';

        $prefixes = array( 'icon-', 'fa-' );
        foreach ( $prefixes as $prefix ) {

            if ( substr( $name, 0, strlen( $prefix ) ) == $prefix ) {
                $name = substr( $name, strlen( $prefix ) );
            }

        }

        $name = str_replace( 'fa-', '', $name );
        $icon_name = BptAdminIcon()->prefix ? BptAdminIcon()->prefix . '-' . $name : $name;

        $class = str_replace( 'icon-', '', $class );
        $class = str_replace( 'fa-', '', $class );

        $class = trim( $class );
        $class = preg_replace( '/\s{3,}/', ' ', $class );

        $class_array = explode( ' ', $class );
        foreach ( $class_array as $index => $class ) {
            $class_array[ $index ] = $class;
        }
        $class = implode( ' ', $class_array );

        // Add unprefixed classes.
        $class .= $unprefixed_class ? ' ' . $unprefixed_class : '';

        $class = apply_filters( 'bpt_icon_class', $class, $name );

        $es_2class = 'bpt-icon';

        $tag = apply_filters( 'bpt_icon_tag', 'i' );

        $output = sprintf( '<%s class="%s %s %s %s %s" %s>%s</%s>',
            $tag,
            $es_2class,
            BptAdminIcon()->prefix,
            $icon_name,
            $class,
            $size,
            $title,
            $space,
            $tag
        );

        return apply_filters( 'bpt_icon', $output );
    }
    add_shortcode('bpt_icon', 'bpt_admin_icon');
}


// out search shortcode
if (!function_exists('bpt_search_shortcode')) {
    function bpt_search_shortcode(){
        $header_height = Cryptronick_Theme_Helper::get_option('header_height');
        $header_height = $header_height['height'];
        if (class_exists( 'RWMB_Loader' ) && get_queried_object_id() !== 0) {
            if (rwmb_meta('mb_customize_header_layout') == 'custom') {
                $header_height = rwmb_meta("mb_header_height");
            }
        }

        $search_style = '';
        $search_style .= !empty($header_height) ? 'height:'.$header_height.'px;' : '';
        $search_style = !empty($search_style) ? ' style="'.$search_style.'"' : '' ;
        

        $out = '<div class="header_search"'.$search_style.'>';
            $out .= '<div class="header_search__container">';
                $out .= '<div class="header_search__icon">';
                    $out .= '<i></i>';
                $out .= '</div>';            
                $out .= '<div class="header_search__inner">';
                    $out .= get_search_form(false);
                $out .= '</div>';
            $out .= '</div>';
        $out .= '</div>';
        return $out;
    }
    add_shortcode('bpt_search', 'bpt_search_shortcode');
}

if (!function_exists('bpt_menu_shortcode')) {
    function bpt_menu_shortcode(){     
        $header_height = Cryptronick_Theme_Helper::get_option('header_height');
        $header_height = $header_height['height'];
        if (class_exists( 'RWMB_Loader' ) && get_queried_object_id() !== 0) {
            if (rwmb_meta('mb_customize_header_layout') == 'custom') {
                $header_height = rwmb_meta("mb_header_height");
            }
        }

        $search_style = '';
        $search_style .= !empty($header_height) ? 'height:'.$header_height.'px;' : '';
        $search_style = !empty($search_style) ? ' style="'.$search_style.'"' : '' ;
        
        ob_start();
        if (has_nav_menu( 'top_header_menu' )) {
            echo "<nav class='top-menu main-menu main_menu_container'>";
                bpt_top_menu ();
            echo "</nav>";
            echo '<div class="mobile-navigation-toggle"><div class="toggle-box"><div class="toggle-inner"></div></div></div>';
        }
        $out = ob_get_clean();
        return !empty($out) ? $out : '';
    }
    add_shortcode('bpt_menu', 'bpt_menu_shortcode');
}

if (!function_exists('bpt_top_menu')) {
    function bpt_top_menu (){
        wp_nav_menu( array(
            'theme_location'  => 'top_header_menu',
            'container' => '',
            'container_class' => '',  
            'after' => '',
            'link_before'     => '<span>',
            'link_after'      => '</span>',            
            'walker' => ''
        ) );
    }
}

add_action('wp_head','bpt_wp_head_custom_code',1000);
function bpt_wp_head_custom_code() {
    // this code not only js or css / can insert any type of code
    
    if (function_exists('cryptronick_option')) {
        $header_custom_code = Cryptronick_Theme_Helper::get_option('header_custom_js');
    }
    echo isset($header_custom_code) ? "<script type='text/javascript'>".$header_custom_code."</script>" : '';
}

add_action('wp_footer', 'bpt_custom_footer_js',1000);
function bpt_custom_footer_js() {
    if (function_exists('cryptronick_option')) {
        $custom_js = Cryptronick_Theme_Helper::get_option('custom_js');
    }
    echo isset($custom_js) ? '<script type="text/javascript" id="bpt_custom_footer_js">'.$custom_js.'</script>' : '';
}

// If Redux is running as a plugin, this will remove the demo notice and links
add_action( 'redux/loaded', 'remove_demo' );


/**
 * Removes the demo link and the notice of integrated demo from the redux-framework plugin
 */
if ( ! function_exists( 'remove_demo' ) ) {
    function remove_demo() {
        // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
        if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
            remove_filter( 'plugin_row_meta', array(
                ReduxFrameworkPlugin::instance(),
                'plugin_metalinks'
            ), null, 2 );

            // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
            remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
        }
    }
}
?>
