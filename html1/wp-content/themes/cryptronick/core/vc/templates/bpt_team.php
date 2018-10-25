<?php

$theme_color = esc_attr(Cryptronick_Theme_Helper::get_option("theme-custom-color"));
$theme_gradient = Cryptronick_Theme_Helper::get_option('theme-gradient');
$header_font = Cryptronick_Theme_Helper::get_option('header-font');

$defaults = array(
    'build_query' => '',
    'posts_per_line' => '4',
    'info_align' => 'center',
    'grid_gap' => '30',
    'single_link' => true,
    'add_shadow' => true,
    'add_grayscale' => false,
    'hide_title' => false,
    'hide_department' => false,
    'hide_soc_icons' => false,
    'item_el_class' => '',
    'animation_class' => '',
    // Carousel
    'use_carousel' => false,
    'autoplay' => false,
    'multiple_items' => false,
    'scroll_items' => false,
    'autoplay_speed' => '3000',
    'use_pagination' => false,
    'pag_type' => 'circle',
    'pag_offset' => '',
    'custom_pag_color' => false,
    'pag_color' => $theme_color,
    'use_prev_next' => false,
    'custom_buttons_color' => false,
    'buttons_color' => $theme_color,
    'custom_resp' => false,
    'resp_medium' => '1025',
    'resp_medium_slides' => '',
    'resp_tablets' => '800',
    'resp_tablets_slides' => '',
    'resp_mobile' => '480',
    'resp_mobile_slides' => '',
    // Colors
    'bg_color_type' => 'def',
    'background_color' => '#00002b',
    'background_color_hover' => '#00002b',
    'background_gradient_start' => '#ffffff',
    'background_gradient_end' => '#ffffff',
    'background_gradient_hover_start' => $theme_gradient['from'],
    'background_gradient_hover_end' => $theme_gradient['to'],
    'custom_title_color' => false,
    'title_color' => $header_font['color'],
    'title_hover_color' => '#ffffff',
    'custom_depart_color' => false,
    'depart_color' => $theme_color,
    'depart_hover_color' => '#ffffff',
    'custom_soc_color' => false,
    'soc_color' => '#b6c2db',
    'soc_hover_color' => '#ffffff',
);

$atts = vc_shortcode_attribute_parse($defaults, $atts);
$atts['build_query'] .= "|post_type:team";
// Animation
$animation_class = '';
if (!empty($atts['css_animation'])) {
    $animation_class = $this->getCSSAnimation( $atts['css_animation'] );
}
$atts['animation_class'] .= $animation_class;
extract($atts);

if ((bool)$use_carousel) {
    // carousel options array
    $carousel_options_arr = array(
        'posts_per_line' => $posts_per_line,
        'autoplay_carousel' => $autoplay,
        'slider_speed' => $autoplay_speed,
        'use_pagination' => $use_pagination,
        'pag_type' => $pag_type,
        'pag_offset' => $pag_offset,
        'custom_pag_color' => $custom_pag_color,
        'pag_color' => $pag_color,
        'use_prev_next' => $use_prev_next,
        'custom_buttons_color' => $custom_buttons_color,
        'buttons_color' => $buttons_color,
        'custom_resp' => $custom_resp,
        'resp_medium' => $resp_medium,
        'resp_medium_slides' => $resp_medium_slides,
        'resp_tablets' => $resp_tablets,
        'resp_tablets_slides' => $resp_tablets_slides,
        'resp_mobile' => $resp_mobile,
        'resp_mobile_slides' => $resp_mobile_slides,
        'multiple_items' => $multiple_items,
        'scroll_items' => $scroll_items,
    );

    // carousel options
    $carousel_options = array_map(function($k, $v) { return "$k=\"$v\" "; }, array_keys($carousel_options_arr), $carousel_options_arr);
    $carousel_options = implode('', $carousel_options);

    wp_enqueue_script('cryptronick-slick', get_template_directory_uri() . '/js/slick.min.js', array(), false, false);
}

$compile = $team_classes = $team_id = $team_id_attr = '';

if ((bool)$custom_title_color || (bool)$custom_depart_color || (bool)$custom_soc_color || $bg_color_type != 'def') {
    $team_id = uniqid( "cryptronick_team_" );
    $team_id_attr = 'id='.$team_id;
}

// custom team colors
ob_start();
    if ((bool)$custom_title_color) {
        echo "#$team_id .team-title{
            color: ".(!empty($title_color) ? esc_attr($title_color) : 'transparent').";
        }";
        echo "#$team_id .team-item_content:hover .team-title{
            color: ".(!empty($title_hover_color) ? esc_attr($title_hover_color) : 'transparent').";
        }";
    }
    if ((bool)$custom_depart_color) {
        echo "#$team_id .team-department{
            color: ".(!empty($depart_color) ? esc_attr($depart_color) : 'transparent').";
        }";
        echo "#$team_id .team-item_content:hover .team-department{
            color: ".(!empty($depart_hover_color) ? esc_attr($depart_hover_color) : 'transparent').";
        }";
    }
    if ((bool)$custom_soc_color) {
        echo "#$team_id .team-info_icons{
            color: ".(!empty($soc_color) ? esc_attr($soc_color) : 'transparent').";
        }";
        echo "#$team_id .team-item_content:hover .team-info_icons{
            color: ".(!empty($soc_hover_color) ? esc_attr($soc_hover_color) : 'transparent').";
        }";
    }
    if ($bg_color_type == 'color') {
        echo "#$team_id .team-item_content:before{
            background: ".(!empty($background_color) ? esc_attr($background_color) : 'transparent').";
        }";
        echo "#$team_id .team-item_content:after{
            background: ".(!empty($background_color_hover) ? esc_attr($background_color_hover) : 'transparent').";
        }";
    }
    if ($bg_color_type == 'gradient') {
        echo "#$team_id .team-item_content:before{
            background: linear-gradient(90deg, $background_gradient_start, $background_gradient_end);
        }";
        echo "#$team_id .team-item_content:after{
            background: linear-gradient(90deg, $background_gradient_hover_start, $background_gradient_hover_end);
        }";
    }
$styles = ob_get_clean();
Cryptronick_shortcode_css()->enqueue_cryptronick_css($styles);

$style_gap = ($grid_gap != '0px') ? ' style="margin-right:-'.esc_attr($grid_gap/2).'px; margin-left:-'.esc_attr($grid_gap/2).'px;"' : '';
$team_classes .= 'team-col_'.$posts_per_line;
$team_classes .= ' align-'.$info_align;
$team_classes .= (bool)$add_shadow ? ' with_shadow' : '';
$team_classes .= (bool)$add_grayscale ? ' grayscale' : '';
$team_classes .= ($bg_color_type != 'color') ? ' bg_gradient' : '';

ob_start();
    render_bpt_team($atts, $build_query);
$team_items = ob_get_clean();

?>

<div <?php echo esc_attr($team_id_attr); ?> class="bpt_module_team <?php echo esc_attr($team_classes); ?>">
    <div class="team-items_wrap clearfix" <?php echo Cryptronick_Theme_Helper::render_html($style_gap);?> >
        <?php

        if ((bool)$use_carousel) {
            echo do_shortcode('[bpt_carousel '.$carousel_options.']'.$team_items.'[/bpt_carousel]');
        } else{
            echo Cryptronick_Theme_Helper::render_html($team_items);
        }

        ?>
    </div>
</div>

<?php
?>