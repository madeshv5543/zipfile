<?php


/**
* 
*/
class bptTeamRegister{

	private $cpt;
	private $taxonomy;
	private $slug;
	
	function __construct(){
		$this->cpt = 'team';
		$this->taxonomy = $this->cpt.'_category';
        $this->taxonomy_pos = $this->cpt.'_position';
		$this->slug = Cryptronick_Theme_Helper::get_option('team_slug') != '' ? Cryptronick_Theme_Helper::get_option('team_slug') : 'team';
	}

	public function register(){
		$this->registerPostType();
		$this->registerTax();
	}

	private function getSlug(){
		$slug  = $this->slug;
	}

	private function registerPostType(){

        register_post_type('team',
            array(
                'labels' 		=> array(
                    'name' 				=> __('Team','bpt-core' ),
                    'singular_name' 	=> __('Team Member','bpt-core' ),
                    'add_item'			=> __('New Team Member','bpt-core'),
                    'add_new_item' 		=> __('Add New Team Member','bpt-core'),
                    'edit_item' 		=> __('Edit Team Member','bpt-core')
                ),
                'public'		=>	true,
                'has_archive' => true,
                'capability_type' => 'post',
                'rewrite' 		=> 	array('slug' => $this->slug),
                'menu_position' => 	5,
                'show_ui' => true,
                'supports' => array('title', 'editor', 'thumbnail', 'page-attributes'),
                'menu_icon'  =>  'dashicons-groups',
                'taxonomies' => array( $this->taxonomy_pos )
            )
        );

	}

	private function registerTax() {
        $labels = array(
            'name' => __( 'Team Categories', 'bpt-core' ),
            'singular_name' => __( 'Team Category', 'bpt-core' ),
            'search_items' =>  __( 'Search Team Categories','bpt-core' ),
            'all_items' => __( 'All Team Categories','bpt-core' ),
            'parent_item' => __( 'Parent Team Category','bpt-core' ),
            'parent_item_colon' => __( 'Parent Team Category:','bpt-core' ),
            'edit_item' => __( 'Edit Team Category','bpt-core' ),
            'update_item' => __( 'Update Team Category','bpt-core' ),
            'add_new_item' => __( 'Add New Team Category','bpt-core' ),
            'new_item_name' => __( 'New Team Category Name','bpt-core' ),
            'menu_name' => __( 'Team Categories','bpt-core' ),
        );

        register_taxonomy($this->taxonomy, array($this->cpt), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => self::getSlug().'-category' ),
        ));
    }

}
add_filter('the_content', 'bpt_fix_shortcodes_autop' );
function bpt_fix_shortcodes_autop($content){
    $array = array (
        '<p>[' => '[',
        ']</p>' => ']',
        ']<br />' => ']'
    );

    $content = strtr($content, $array);
    return $content;
}
function render_bpt_team_item ( $single_member = false, $item_atts, $team_image_dims) {
    extract($item_atts);
    $compile = $team_cats = $team_info = $team_icons = $featured_image = $team_title = $featured_image_single = $item_classes = "";
    $bpt_pid = get_the_ID();
    $link_to = get_permalink($bpt_pid);
    $department_name = get_post_meta($bpt_pid, "department_name");
    $department = get_post_meta($bpt_pid, "department", true);
    $info_array = get_post_meta($bpt_pid, "info_items", true);
    $social_array = get_post_meta($bpt_pid, "soc_icon", true);
    $wp_get_attachment_url = wp_get_attachment_url(get_post_thumbnail_id($bpt_pid), 'single-post-thumbnail');
    $style_gap = ($grid_gap != '0px') ? 'padding-right:'.($grid_gap/2).'px; padding-left:'.($grid_gap/2).'px; padding-bottom:'.$grid_gap.'px;' : '';

    $item_style = (!empty($style_gap)) ? 'style="'.$style_gap.'"' : '';

    //team info
    if (isset($info_array) && !empty($info_array)) {
        for ( $i=0; $i<count( $info_array ); $i++ ){
            $info = $info_array[$i];
            $info_name = !empty($info['name']) ? $info['name'] : '';
            $info_description = !empty($info['description']) ? $info['description'] : '';
            $info_link = !empty($info['link']) ? $info['link'] : '';

            if ((bool)$single_member && !empty($info_name) &&!empty($info_description)) {
                $team_info .= '<div class="team-info_item">';
                    $team_info .= '<h5>'.esc_html($info_name).':</h5>';
                    $team_info .= !empty($info_link) ? '<a href="'.esc_url($info_link).'">' : '';
                        $team_info .= '<span>'.esc_html($info_description).'</span>';
                    $team_info .= !empty($info_link) ? '</a>' : '';
                $team_info .= '</div>';
            }
        }
    }

    //team social icons
    if (isset($social_array)) {
        for ( $i=0; $i<count( $social_array ); $i++ ){
            $icon = $social_array[$i];
            $icon_name = !empty($icon['select']) ? $icon['select'] : '';
            $icon_link = !empty($icon['input']) ? $icon['input'] : '#';
            $team_icons .= !empty($icon['select']) ? '<a href="'.$icon_link.'" class="team-icon '.$icon_name.'"></a>' : '';
        }
    }
    $team_icons_wrap = !empty($team_icons) ? '<div class="team-info_icons">' . $team_icons . '</div>' : '';

    // team image
    if (!empty($wp_get_attachment_url)) {
         $bpt_featured_image_url = ($posts_per_line == '1') ? $wp_get_attachment_url : aq_resize($wp_get_attachment_url, $team_image_dims['width'], $team_image_dims['height'], true, true, true);

        $img_alt = get_post_meta(get_post_thumbnail_id($bpt_pid), '_wp_attachment_image_alt', true);
        $featured_image = '<img src="'.esc_url($bpt_featured_image_url).'" alt="'.(!empty($img_alt) ? $img_alt : '').'" />';
    }

    // team image with single link
    $featured_image_single .= (bool)$single_link ? '<a href="'.esc_attr($link_to).'">' : '';
        $featured_image_single .= $featured_image;
    $featured_image_single .= (bool)$single_link ? '</a>' : '';

    // team list title
    if (!(bool)$hide_title) {
        $team_title .= '<h4 class="team-title">';
            $team_title .= (bool)$single_link ? '<a href="'.esc_attr($link_to).'">' : '';
                $team_title .= get_the_title();
            $team_title .= (bool)$single_link ? '</a>' : '';
        $team_title .= '</h4>';
    }

    // item classes
    $item_classes .= !empty($animation_class) ? $animation_class : '';

    // render team list & team single
    if (!$single_member) {

        $compile .= '<div class="team-item'.(!empty($item_classes) ? $item_classes : '').'" '.$item_style.'>';
            $compile .= '<div class="team-item_content">';
                $compile .= '<div class="team-image">'.$featured_image_single.'</div>';
                if (!(bool)$hide_title || !(bool)$hide_department || !(bool)$hide_soc_icons) {
                    $compile .= '<div class="team-item_info">';
                        $compile .= $team_title;
                        $compile .= (!empty($department) && !(bool)$hide_department) ? '<div class="team-department">'.esc_html($department).'</div>' : '';
                        $compile .= !(bool)$hide_soc_icons ? $team_icons_wrap : '';
                    $compile .= '</div>';
                }
            $compile .= '</div>';
        $compile .= '</div>';

    } else {

        $compile .= '<div class="team-single_wrapper">';
            $compile .= $team_icons_wrap;
            $compile .= '<div class="team-image">' . $featured_image . '</div>';
            $compile .= '<div class="team-info_wrapper">';
                $compile .= $team_title;
                $compile .= !empty($department) ? '<div class="team-info_item team-department"><h5>'.(!empty($department_name[0]) ? esc_html($department_name[0]) : 'Department').':</h5><span>'.esc_html($department).'</span></div>' : '';
                $compile .= !empty($team_info) ? $team_info : '';
            $compile .= '</div>';
        $compile .= '</div>';

    }
    
    return $compile;
}

function render_bpt_team ($atts, $build_query) {
    $bpt_def_atts = array(
        'posts_per_line' => '4',
        'grid_gap' => '30px',
        'single_link' => true,
        'hide_title' => false,
        'hide_department' => false,
        'hide_soc_icons' => false,
        'add_member' => false,
        'member_image' => '',
        'member_link' => '',
        'animation_class' => '',
    );
    $item_atts = array_merge($bpt_def_atts ,array_intersect_key($atts, $bpt_def_atts));
    extract($item_atts);

    $compile = $item_classes = '';

    // dims for team images
    switch ($posts_per_line) {
        case "2":
            $team_image_dims = array('width' => '1200', 'height' => '1200');
            break;
        case "3":
            $team_image_dims = array('width' => '800', 'height' => '800');
            break;
        case "4":
        case "5":
            $team_image_dims = array('width' => '600', 'height' => '600');
            break;
        default:
            $team_image_dims = array('width' => '1200', 'height' => '1200');
    }

    list($query_args, $build_query) = vc_build_loop_query($build_query);
    $bpt_posts = new WP_Query($query_args);
    bpt_get_all_icon();
    if ($bpt_posts->have_posts()):
        while ($bpt_posts->have_posts()):
            $bpt_posts -> the_post();
            $compile .= render_bpt_team_item( false, $item_atts, $team_image_dims);
        endwhile;
        wp_reset_postdata();
    endif;

    echo $compile;
}
?>