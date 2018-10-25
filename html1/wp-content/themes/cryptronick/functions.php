<?php

//Class Theme Helper
require_once ( get_template_directory() . '/core/class/theme-helper.php' );

//Class Walker comments
require_once ( get_template_directory() . '/core/class/walker-comment.php' );

//Class Theme Likes
require_once ( get_template_directory() . '/core/class/theme-likes.php' );

//Class Single Post
require_once ( get_template_directory() . '/core/class/single-post.php' );

//Class Cryptronick_crypto_data for getting data from api
require_once ( get_template_directory() . '/crypto-extension/crypto-data.php' );

function cryptronick_content_width() {
    $GLOBALS['content_width'] = apply_filters( 'cryptronick_content_width', 940 );
}
add_action( 'after_setup_theme', 'cryptronick_content_width', 0 );

function cryptronick_theme_slug_setup() {
    add_theme_support('title-tag');
}
add_action('after_setup_theme', 'cryptronick_theme_slug_setup');

require_once(get_template_directory() . "/core/loader.php");
require_once(get_template_directory() . "/core/tinymce-icon.php");

add_action('init', 'cryptronick_page_init');
if (!function_exists('cryptronick_page_init')) {
    function cryptronick_page_init()
    {
        add_post_type_support('page', 'excerpt');
    }
}

if (!function_exists('cryptronick_main_menu')) {
    function cryptronick_main_menu (){
        wp_nav_menu( array(
            'theme_location'  => 'main_menu',
            'container' => '',
            'container_class' => '',  
            'after' => '',
            'link_before'     => '<span>',
            'link_after'      => '</span>',            
            'walker' => ''
        ) );
    }
}

// need for vertical view of header in theme options (admin)
if (!function_exists('cryptronick_add_admin_class_menu_order')) {
    add_filter('admin_body_class', 'cryptronick_add_admin_class_menu_order');
    function cryptronick_add_admin_class_menu_order($classes) {
        if (Cryptronick_Theme_Helper::get_option('bottom_header_vertical_order')) {
            $classes .= ' bottom_header_vertical_order';
        }            
        return $classes;
    }
}

// return all sidebars
if (!function_exists('cryptronick_get_all_sidebar')) {
    function cryptronick_get_all_sidebar() {
        global $wp_registered_sidebars;
        $out = array('' => '' );
        if ( empty( $wp_registered_sidebars ) )
            return;
         foreach ( $wp_registered_sidebars as $sidebar_id => $sidebar) :
            $out[$sidebar_id] = $sidebar['name'];
         endforeach; 
         return $out;
    }
}

if (!function_exists('cryptronick_get_custom_preset')) {
    function cryptronick_get_custom_preset() {
        $custom_preset = get_option('cryptronick_preset');
        $presets =  cryptronick_default_preset();
        
        $out = array();
        $out['default'] = esc_html__( 'Default', 'cryptronick' );
        $i = 1;
        if(is_array($presets)){
            foreach ($presets as $key => $value) {
                $out[$key] = $key;
                $i++;
            }            
        }
        if(is_array($custom_preset)){
            foreach ( $custom_preset as $preset_id => $preset) :
                $out[$preset_id] = $preset_id;
            endforeach;             
        }
        return $out;
    }
}

function cryptronick_get_attachment( $attachment_id ) {
    $attachment = get_post( $attachment_id );
    return array(
        'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
        'caption' => $attachment->post_excerpt,
        'description' => $attachment->post_content,
        'href' => get_permalink( $attachment->ID ),
        'src' => $attachment->guid,
        'title' => $attachment->post_title
    );
}

if (!function_exists('cryptronick_showJSInFooter')) {
    function cryptronick_showJSInFooter()
    {
        if (isset($GLOBALS['showOnlyOneTimeJS']) && is_array($GLOBALS['showOnlyOneTimeJS'])) {
            foreach ($GLOBALS['showOnlyOneTimeJS'] as $id => $js) {
                echo Cryptronick_Theme_Helper::render_html($js);
            }
        }
    }
}
add_action('wp_footer', 'cryptronick_showJSInFooter');

function cryptronick_mce_buttons_2( $buttons ) {
    array_unshift( $buttons, 'styleselect' );
    return $buttons;
}
add_filter( 'mce_buttons_2', 'cryptronick_mce_buttons_2' );


function cryptronick_tiny_mce_before_init( $settings ) {

    $settings['theme_advanced_blockformats'] = 'p,h1,h2,h3,h4';
    $style_formats = array(
        array( 'title' => esc_html__( 'Dropcap', 'cryptronick' ), 'inline' => 'span', 'classes' => 'dropcap', 'styles' => array( 'font-size' => '2.25em', 'line-height' => '48px', 'color' => Cryptronick_Theme_Helper::get_option('theme-custom-color'))),
        array( 'title' => esc_html__( 'Highlighter', 'cryptronick' ), 'inline' => 'span', 'classes' => 'highlighter', 'styles' => array( 'color' => '#ffffff', 'background-color' => Cryptronick_Theme_Helper::get_option('theme-custom-color'))),
        array( 'title' => esc_html__( 'Font Weight', 'cryptronick' ), 'items' => array(
            array( 'title' => esc_html__( 'Default', 'cryptronick' ), 'inline' => 'span', 'classes' => 'cryptronick_font-weight', 'styles' => array( 'font-weight' => 'inherit' ) ),
            array( 'title' => esc_html__( 'Lightest (100)', 'cryptronick' ), 'inline' => 'span', 'classes' => 'cryptronick_font-weight', 'styles' => array( 'font-weight' => '100' ) ),
            array( 'title' => esc_html__( 'Lighter (200)', 'cryptronick' ), 'inline' => 'span', 'classes' => 'cryptronick_font-weight', 'styles' => array( 'font-weight' => '200' ) ),
            array( 'title' => esc_html__( 'Light (300)', 'cryptronick' ), 'inline' => 'span', 'classes' => 'cryptronick_font-weight', 'styles' => array( 'font-weight' => '300' ) ),
            array( 'title' => esc_html__( 'Normal (400)', 'cryptronick' ), 'inline' => 'span', 'classes' => 'cryptronick_font-weight', 'styles' => array( 'font-weight' => '400' ) ),
            array( 'title' => esc_html__( 'Medium (500)', 'cryptronick' ), 'inline' => 'span', 'classes' => 'cryptronick_font-weight', 'styles' => array( 'font-weight' => '500' ) ),
            array( 'title' => esc_html__( 'Semi-Bold (600)', 'cryptronick' ), 'inline' => 'span', 'classes' => 'cryptronick_font-weight', 'styles' => array( 'font-weight' => '600' ) ),
            array( 'title' => esc_html__( 'Bold (700)', 'cryptronick' ), 'inline' => 'span', 'classes' => 'cryptronick_font-weight', 'styles' => array( 'font-weight' => '700' ) ),
            array( 'title' => esc_html__( 'Bolder (800)', 'cryptronick' ), 'inline' => 'span', 'classes' => 'cryptronick_font-weight', 'styles' => array( 'font-weight' => '800' ) ),
            array( 'title' => esc_html__( 'Extra Bold (900)', 'cryptronick' ), 'inline' => 'span', 'classes' => 'cryptronick_font-weight', 'styles' => array( 'font-weight' => '900' ) ),
            )
        ),
        array( 'title' => esc_html__( 'List Style', 'cryptronick' ), 'items' => array(
            array( 'title' => esc_html__( 'Dash', 'cryptronick' ), 'selector' => 'ul', 'classes' => 'cryptronick_dash'),
            )
        ),
    );

    $settings['style_formats'] = str_replace( '"', "'", json_encode( $style_formats ) );
    $settings['extended_valid_elements'] = 'span[*],a[*],i[*]';
    return $settings;
}
add_filter( 'tiny_mce_before_init', 'cryptronick_tiny_mce_before_init' );

function cryptronick_theme_add_editor_styles() {
    add_editor_style( 'css/font-awesome.min.css' );
    add_editor_style( 'css/tiny_mce.css' );
}
add_action( 'current_screen', 'cryptronick_theme_add_editor_styles' );

function cryptronick_categories_postcount_filter ($variable) {
    if(strpos($variable,'</a> (')){
        $variable = str_replace('</a> (', '</a> <span class="post_count">', $variable); 
        $variable = str_replace('</a>&nbsp;(', '</a>&nbsp;<span class="post_count">', $variable); 
        $variable = str_replace(')', '</span>', $variable);      
    }
    else{
        $variable = str_replace('</a> <span class="count">(', '</a><span class="post_count">', $variable);
        $variable = str_replace(')', '', $variable);       
    }   

    return $variable;
}
add_filter('wp_list_categories', 'cryptronick_categories_postcount_filter');

add_filter( 'get_archives_link', 'cryptronick_render_archive_widgets', 10, 6 );
function cryptronick_render_archive_widgets ( $link_html, $url, $text, $format, $before, $after ) {
    $after = str_replace('(', '', $after);
    $after = str_replace(' ', '', $after);
    $after = str_replace('&nbsp;', '', $after);
    $after = str_replace(')', '', $after);

    $after = !empty($after) ? "<span class='post_count'>".esc_html($after)."</span>" : "";

    $link_html = "<li>".esc_html($before)."<a href='".esc_url($url)."'>".esc_html($text)."</a>".$after."</li>";

    return $link_html;

}

add_action( 'show_user_profile', 'cryptronick_extra_user_profile_fields' );
add_action( 'edit_user_profile', 'cryptronick_extra_user_profile_fields' );

function cryptronick_extra_user_profile_fields( $user ) { ?>
    <h3><?php esc_html_e("Extra profile information", "cryptronick"); ?></h3>

    <table class="form-table">
    <tr>
        <th><label for="instagram"><?php esc_html_e("Instagram", "cryptronick"); ?></label></th>
        <td>
            <input type="text" name="instagram" id="instagram" value="<?php echo esc_attr( get_the_author_meta( 'instagram', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php esc_html_e("Please enter your instagram url.", "cryptronick"); ?></span>
        </td>
    </tr>
    <tr>
        <th><label for="facebook"><?php esc_html_e("Facebook", "cryptronick"); ?></label></th>
        <td>
            <input type="text" name="facebook" id="facebook" value="<?php echo esc_attr( get_the_author_meta( 'facebook', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php esc_html_e("Please enter your facebook url.", "cryptronick"); ?></span>
        </td>
    </tr>
    <tr>
    <th><label for="linkedin"><?php esc_html_e("Linkedin", "cryptronick"); ?></label></th>
        <td>
            <input type="text" name="linkedin" id="linkedin" value="<?php echo esc_attr( get_the_author_meta( 'linkedin', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php esc_html_e("Please enter your linkedin url.", "cryptronick"); ?></span>
        </td>
    </tr>
    <tr>
    <th><label for="twitter"><?php esc_html_e("Twitter", "cryptronick"); ?></label></th>
        <td>
            <input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( get_the_author_meta( 'twitter', $user->ID ) ); ?>" class="regular-text" /><br />
            <span class="description"><?php esc_html_e("Please enter your twitter url.", "cryptronick"); ?></span>
        </td>
    </tr>
    </table>
<?php }

add_action( 'personal_options_update', 'cryptronick_save_extra_user_profile_fields' );
add_action( 'edit_user_profile_update', 'cryptronick_save_extra_user_profile_fields' );

function cryptronick_save_extra_user_profile_fields( $user_id ) {
    if ( !current_user_can( 'edit_user', $user_id ) ) { 
        return false; 
    }
    update_user_meta( $user_id, 'instagram', $_POST['instagram'] );
    update_user_meta( $user_id, 'facebook', $_POST['facebook'] );
    update_user_meta( $user_id, 'linkedin', $_POST['linkedin'] );
    update_user_meta( $user_id, 'twitter', $_POST['twitter'] );
}

// Add image size
if ( function_exists( 'add_image_size' ) ) {
    add_image_size( 'bpt-740-560',  740, 560, true  );
}

// Include Woocommerce init if plugin is active
if ( class_exists( 'WooCommerce' ) ) {
    require_once( get_template_directory() . '/woocommerce/woocommerce-init.php' ); 
}

/**
 * Add new colopicker field to "Add New Category" screen
 * - https://developer.wordpress.org/reference/hooks/taxonomy_add_form_fields/
 *
 * @param WP_Term_Object $term
 *
 * @return void
 */
function cryptronick_category_fields( $term ) {    //check for existing featured ID
    
    $color = get_term_meta( $term->term_id, '_category_color', true );
    $page_colors_switch = Cryptronick_Theme_Helper::options_compare('page_colors_switch','mb_page_colors_switch','custom');
    if ($page_colors_switch == 'custom') {
        $theme_color = Cryptronick_Theme_Helper::options_compare('page_theme_color','mb_page_colors_switch','custom');
    }else{
        $theme_color = esc_attr(Cryptronick_Theme_Helper::get_option('theme-custom-color'));
    }
    $color = ( ! empty( $color ) ) ? "#{$color}" : $theme_color;

  ?>
    <tr class="form-field term-colorpicker-wrap">
        <th scope="row"><label for="term-colorpicker">Background Color</label></th>
        <td>
            <input name="_category_color" value="<?php echo esc_attr($color); ?>" class="colorpicker" id="term-colorpicker" />
        </td>
    </tr>

  <?php
}
add_action ( 'edit_category_form_fields', 'cryptronick_category_fields');

/**
 * Add new colopicker field to "Edit Category" screen
 * - https://developer.wordpress.org/reference/hooks/taxonomy_add_form_fields/
 *
 * @param WP_Term_Object $term
 *
 * @return void
 */
function cryptronick_colorpicker_field_add_new_category( $taxonomy ) {

  ?>

    <div class="form-field term-colorpicker-wrap">
        <label for="term-colorpicker">Background Color</label>
        <input name="_category_color" value="#ffffff" class="colorpicker" id="term-colorpicker" />
    </div>

  <?php

}
add_action( 'category_add_form_fields', 'cryptronick_colorpicker_field_add_new_category' );  // Variable Hook Name

/**
 * Term Metadata - Save Created and Edited Term Metadata
 * - https://developer.wordpress.org/reference/hooks/created_taxonomy/
 * - https://developer.wordpress.org/reference/hooks/edited_taxonomy/
 *
 * @param Integer $term_id
 *
 * @return void
 */
function cryptronick_save_termmeta( $term_id ) {

    // Save term color if possible
    if( isset( $_POST['_category_color'] ) && ! empty( $_POST['_category_color'] ) ) {
        update_term_meta( $term_id, '_category_color', sanitize_hex_color_no_hash( $_POST['_category_color'] ) );
    } else {
        delete_term_meta( $term_id, '_category_color' );
    }

}

add_action( 'created_category', 'cryptronick_save_termmeta' );  // Variable Hook Name
add_action( 'edited_category',  'cryptronick_save_termmeta' );  // Variable Hook Name

/**
 * Enqueue colorpicker styles and scripts.
 * - https://developer.wordpress.org/reference/hooks/admin_enqueue_scripts/
 *
 * @return void
 */
function cryptronick_category_colorpicker_enqueue( $taxonomy ) {

    if( null !== ( $screen = get_current_screen() ) && 'edit-category' !== $screen->id ) {
        return;
    }

    // Colorpicker Scripts
    wp_enqueue_script( 'wp-color-picker' );

    // Colorpicker Styles
    wp_enqueue_style( 'wp-color-picker' );

}
add_action( 'admin_enqueue_scripts', 'cryptronick_category_colorpicker_enqueue' );

/**
 * Enqueue svg to the media.
 * @return void
 */
add_filter('upload_mimes', 'cryptronick_svg_mime_types');

function cryptronick_svg_mime_types($mimes) {
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}

