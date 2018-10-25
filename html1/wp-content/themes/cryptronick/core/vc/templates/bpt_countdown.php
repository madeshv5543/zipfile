<?php
    include_once get_template_directory() . '/core/vc/templates/bpt_google_fonts_render.php';
	$defaults = array(
		'icon_type' => 'font',
        'countdown_year' => '2018',
        'countdown_month' => '8',
        'countdown_day' => '14',
        'countdown_hours' => '12',
        'countdown_min' => '00',        
        'number_color' => '#ffffff',            
        'countdown_color' => '#ffffff',            
        'points_color' => '#46e1ac',            
        'use_theme_fonts_countdown' => 'yes',  
        'hide_day' => '',  
        'hide_hours' => '',  
        'hide_minutes' => '',  
        'hide_seconds' => '',  
        'size' => 'large',  
        'font_size' => '',  
        'font_weight' => '',  
        'font_text_weight' => '',  
        'align' => 'center',  


	);

	wp_enqueue_script('cryptronick-coundown', get_template_directory_uri() . '/js/jquery.countdown.min.js', array(), false, false);

	$atts = vc_shortcode_attribute_parse($defaults, $atts);
	extract($atts);

    $obj = new GoogleFontsRender();
    $shortc = $this->shortcode;
    extract( $obj->getAttributes( $atts, $this, $shortc, array('google_fonts_countdown') ) );

    $countdown_value_font = '';

    // uniq id
    $countdown_id = uniqid( "countdown_" );
    $countdown_attr = 'id='.$countdown_id;

    // custom social colors
    ob_start();
        echo "#$countdown_id .countdown-amount{
            color: ".$number_color.";
        }";
        echo "#$countdown_id .countdown-amount:before,
            #$countdown_id .countdown-amount:after{
            background-color: ".$points_color.";
        }";
        if ($font_weight != '') {
            echo "#$countdown_id .countdown-amount{
                font-weight: ".$font_weight.";
            }";
        }
        if ($font_text_weight != '') {
            echo "#$countdown_id .countdown-period{
                font-weight: ".$font_text_weight.";
            }";
        }
    $styles = ob_get_clean();
    Cryptronick_shortcode_css()->enqueue_cryptronick_css($styles);


    if(isset($styles_google_fonts_countdown) && !empty($styles_google_fonts_countdown)){
        $countdown_value_font = '' . esc_attr( $styles_google_fonts_countdown ) . '; ';
    }

    $countdown_class = '';
    if($use_theme_fonts_countdown != 'yes'){
        $countdown_class .= ' custom_countdown';
    }

    $countdown_class .= ' countdown_size_'.$size;
    $countdown_class .= ' countdown_align_'.$align;

    $label_years = esc_html__('Years', 'cryptronick');
    $label_months = esc_html__('Months', 'cryptronick');
    $label_weeks = esc_html__('Weeks', 'cryptronick');
    $label_days = esc_html__('Days', 'cryptronick');
    $label_hours = esc_html__('Hours', 'cryptronick');
    $label_minutes = esc_html__('Minutes', 'cryptronick');
    $label_seconds = esc_html__('Seconds', 'cryptronick');

    $label_year = esc_html__('Year', 'cryptronick');
    $label_month = esc_html__('Month', 'cryptronick');
    $label_week = esc_html__('Week', 'cryptronick');
    $label_day = esc_html__('Day', 'cryptronick');
    $label_hour = esc_html__('Hour', 'cryptronick');
    $label_minute = esc_html__('Minute', 'cryptronick');
    $label_second = esc_html__('Second', 'cryptronick');

    $countdown_style = '';
    $countdown_style .= "color:".esc_attr($countdown_color).";";
    $countdown_style .= !empty($countdown_value_font) ? $countdown_value_font : "";
    $countdown_style .= $size == 'custom' ? 'font-size:'.$font_size.'px;' : "";

    $format = '';
    if (!(bool)$hide_day) {
        $format .= 'd';
    }
    if (!(bool)$hide_hours) {
        $format .= 'H';
    }
    if (!(bool)$hide_minutes) {
        $format .= 'M';
    }
    if (!(bool)$hide_seconds) {
        $format .= 'S';
    }
    $data_attribute = '';
    if (!empty($format)) {
        $data_attribute = ' data-format="'.esc_attr($format).'"';
    }

	$compile = '';
	$compile .= '<div class="countdown_wrapper">
                    <div '.$countdown_attr.' class="bpt-countdown'.esc_attr($countdown_class).'" data-year="'.esc_attr($countdown_year).'" data-month="'.esc_attr($countdown_month).'" data-day="'.esc_attr($countdown_day).'" data-hours="'.esc_attr($countdown_hours).'" data-min="'.esc_attr($countdown_min).'" data-label_years="'.esc_attr($label_years).'" data-label_months="'.esc_attr($label_months).'" data-label_weeks="'.esc_attr($label_weeks).'" data-label_days="'.esc_attr($label_days).'" data-label_hours="'.esc_attr($label_hours).'" data-label_minutes="'.esc_attr($label_minutes).'" data-label_seconds="'.esc_attr($label_seconds).'" data-label_year="'.esc_attr($label_year).'" data-label_month="'.esc_attr($label_month).'" data-label_week="'.esc_attr($label_week).'" data-label_day="'.esc_attr($label_day).'" data-label_hour="'.esc_attr($label_hour).'" data-label_minute="'.esc_attr($label_minute).'" data-label_second="'.esc_attr($label_second).'"'.$data_attribute.' style="'.$countdown_style.'"></div>
                </div>';
	
	echo Cryptronick_Theme_Helper::render_html($compile);
?>
    
