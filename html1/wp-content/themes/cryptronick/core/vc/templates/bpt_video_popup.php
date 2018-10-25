<?php 

include_once get_template_directory() . '/core/vc/templates/bpt_google_fonts_render.php';

$theme_color = esc_attr(Cryptronick_Theme_Helper::get_option("theme-custom-color"));
$theme_gradient = Cryptronick_Theme_Helper::get_option('theme-gradient');
$header_font = Cryptronick_Theme_Helper::get_option('header-font');

$defaults = array(
    'video_title' => '',
    'title_pos' => 'right',
    'button_pos' => 'left',
    'always_pulse_anim' => '',
    'bg_image' => '',
    'video_link' => '#',
    'title_color' => $header_font['color'],
    'btn_color' => '#ffffff',
    'bg_color_type' => 'def',
    'background_color' => $theme_color,
    'background_gradient_start' => $theme_gradient['from'],
    'background_gradient_end' => $theme_gradient['to'],
    'custom_buttom_size' => false,
    'button_size' => '',
    'title_size' => '16',
	'item_el_class' => '',
);

wp_enqueue_script('cryptronick-swipebox', get_template_directory_uri() . '/js/swipebox/js/jquery.swipebox.min.js', array(), false, false);
wp_enqueue_style('cryptronick-swipebox-style', get_template_directory_uri() . '/js/swipebox/css/swipebox.min.css');

$atts = vc_shortcode_attribute_parse($defaults, $atts);
extract($atts);

$video_popup_id = uniqid( "cryptronick_video_" );

$popup_title_font = $video_wrap_classes = '';

ob_start();
if ($bg_color_type == 'color') {
	echo "#$video_popup_id .video_popup_link{
		background-color: ".(!empty($background_color) ? esc_html($background_color) : 'transparent').";
	}";
} else if ($bg_color_type == 'gradient') {
	$background_gradient_start = !empty($background_gradient_start) ? esc_html($background_gradient_start) : 'transparent';
	$background_gradient_end = !empty($background_gradient_end) ? esc_html($background_gradient_end) : 'transparent';
	// video gradient
	echo "#$video_popup_id .video_popup_link{
		background: linear-gradient(90deg, $background_gradient_start, $background_gradient_end);
	}";
	// \video gradient
}
$styles = ob_get_clean();
Cryptronick_shortcode_css()->enqueue_cryptronick_css($styles);

// Render Google Fonts
$obj = new GoogleFontsRender();
extract( $obj->getAttributes( $atts, $this, $this->shortcode, array('google_fonts_vpopup_title') ) );

// Animation
if (!empty($atts['css_animation'])) {
	$animation_class = $this->getCSSAnimation( $atts['css_animation'] );
}
	
if ( ! empty( $styles_google_fonts_vpopup_title ) ) {
	$popup_title_font = esc_attr( $styles_google_fonts_vpopup_title ) . ';';
}

$video_wrap_classes .= ' title_pos-'.$title_pos;
$video_wrap_classes .= ' button_align-'.$button_pos;
$video_wrap_classes .= !empty($bg_image) ? ' with_image' : ' no_image';
$video_wrap_classes .= !empty($animation_class) ? ' '.$animation_class : '';
$video_wrap_classes .= !empty($item_el_class) ? ' '.$item_el_class : '';
$video_wrap_classes .= (bool)$always_pulse_anim ? ' always-pulse-animation' : '';

// Font Size of Title
$popup_title_size = ($title_size != '') ? 'font-size: ' . $title_size . 'px;line-height:'.$title_size * 1.5.'px;' : '';

// Color of Title
$popup_title_color = !empty($title_color) ? 'color: '.$title_color.';' : '';

// Styles of Title
$title_style = !empty($popup_title_color) || !empty($popup_title_size) || !empty($popup_title_font) ? 'style="'.esc_attr($popup_title_color).$popup_title_font.esc_attr($popup_title_size).'"' : '';

$video_title = !empty($video_title) ? '<h2 class="video_popup_title" '.$title_style.' >'.$video_title.'</h2>' : '';

// button size
$button_size_style = !empty($button_size) ? ' style="width:'.esc_attr($button_size).'px; height:'.esc_attr($button_size).'px;"' : '';

// render html
?>
<div <?php echo 'id="'.esc_attr($video_popup_id).'"' ?> class="cryptronick_module_video_popup<?php echo esc_attr($video_wrap_classes); ?>">
<?php
if ( empty($bg_image) ):
	?><div class="video_popup_content"><?php
		echo Cryptronick_Theme_Helper::render_html($video_title); ?>
		<a class="video_popup_link swipebox_video" href="<?php echo esc_url($video_link); ?>" <?php echo Cryptronick_Theme_Helper::render_html($button_size_style); ?> ><span class="video_popup_triangle" style="border-color: transparent transparent transparent <?php echo esc_attr($btn_color);?>"></span></a>
	</div>
	<?php 
else:
	?>
	<a href="<?php echo esc_url($video_link); ?>" class="video_popup_wrapper_link swipebox_video">
		<?php echo wp_get_attachment_image( $bg_image , 'full');?>
		<div class="video_popup_content">
			<?php echo Cryptronick_Theme_Helper::render_html($video_title); ?>
			<span class="video_popup_link"><span class="video_popup_triangle" style="border-color: transparent transparent transparent <?php echo esc_attr($btn_color)?>"></span></span>
		</div>
	</a>
<?php
endif;
?>
</div>