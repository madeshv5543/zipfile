<?php
    
    if ( !class_exists( 'bpt_cryptronick_core' ) ) {
        return;
    } 

    if (!function_exists('cryptronick_get_preset')) {
        function cryptronick_get_preset() {
            $custom_preset = get_option('cryptronick_preset');
            $presets = function_exists('cryptronick_default_preset') ? cryptronick_default_preset() : '';

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

    $theme = wp_get_theme(); 
    $opt_name = 'cryptronick';

    $args = array(
        'opt_name'             => $opt_name,
        'display_name'         => $theme->get( 'Name' ),
        'display_version'      => $theme->get( 'Version' ),
        'menu_type'            => 'menu',
        'allow_sub_menu'       => true,
        'menu_title'           => esc_html__('Theme Options', 'cryptronick' ),
        'page_title'           => esc_html__('Theme Options', 'cryptronick' ),
        'google_api_key'       => '',
        'google_update_weekly' => false,
        'async_typography'     => true,
        'admin_bar'            => true,
        'admin_bar_icon'       => 'dashicons-admin-generic',
        'admin_bar_priority'   => 50,
        'global_variable'      => '',
        'dev_mode'             => false,
        'update_notice'        => true,
        'customizer'           => true,
        'page_priority'        => null,
        'page_parent'          => 'themes.php',
        'page_permissions'     => 'manage_options',
        'menu_icon'            => 'dashicons-admin-generic',
        'last_tab'             => '',
        'page_icon'            => 'icon-themes',
        'page_slug'            => '',
        'save_defaults'        => true,
        'default_show'         => false,
        'default_mark'         => '',
        'show_import_export'   => true,
        'transient_time'       => 60 * MINUTE_IN_SECONDS,
        'output'               => true,
        'output_tag'           => true,
        'database'             => '',
        'use_cdn'              => true,
    );


    Redux::setArgs( $opt_name, $args );

    // -> START Basic Fields
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'General', 'cryptronick' ),
        'id'               => 'general',
        'customizer_width' => '400px',
        'icon'             => 'el el-home',
        'fields'           => array(
            array(
                'id'       => 'responsive',
                'type'     => 'switch',
                'title'    => esc_html__( 'Responsive', 'cryptronick' ),
                'default'  => true,
            ),
            array(
                'id'       => 'page_comments',
                'type'     => 'switch',
                'title'    => esc_html__( 'Page Comments', 'cryptronick' ),
                'default'  => true,
            ),
            array(
                'id'       => 'preloader',
                'type'     => 'switch',
                'title'    => esc_html__( 'Preloader', 'cryptronick' ),
                'default'  => false,
            ),
            array(
                'id'       => 'preloader_background',
                'type'     => 'color',
                'title'    => esc_html__( 'Preloader Background', 'cryptronick' ),
                'subtitle' => esc_html__( 'Set Preloader Background', 'cryptronick' ),
                'default'  => '#fdfcf4',
                'transparent' => false,
                'required' => array( 'preloader', '=', '1' ),
            ),
            array(
                'id'       => 'preloader_color_1',
                'type'     => 'color',
                'title'    => esc_html__( 'Preloader Color Circle 1', 'cryptronick' ),
                'default'  => '#0c63ff',
                'transparent' => false,
                'required' => array( 'preloader', '=', '1' ),
            ),
            array(
                'id'       => 'preloader_color_2',
                'type'     => 'color',
                'title'    => esc_html__( 'Preloader Color Circle 2', 'cryptronick' ),
                'default'  => '#10bce8',
                'transparent' => false,
                'required' => array( 'preloader', '=', '1' ),
            ),
            array(
                'id'       => 'preloader_color_3',
                'type'     => 'color',
                'title'    => esc_html__( 'Preloader Color Circle 3', 'cryptronick' ),
                'default'  => '#10e0e8',
                'transparent' => false,
                'required' => array( 'preloader', '=', '1' ),
            ),
            array(
                'id'       => 'back_to_top',
                'type'     => 'switch',
                'title'    => esc_html__( 'Back to Top', 'cryptronick' ),
                'default'  => true,
            ),
            array(
                'id'       => 'custom_js',
                'type'     => 'ace_editor',
                'title'    => esc_html__( 'Custom JS', 'cryptronick' ),
                'subtitle' => esc_html__( 'Paste your JS code here.', 'cryptronick' ),
                'mode'     => 'javascript',
                'theme'    => 'chrome',
                'default'  => ''
            ),
            array(
                'id'       => 'header_custom_js',
                'type'     => 'ace_editor',
                'title'    => esc_html__( 'Custom JS', 'cryptronick' ),
                'subtitle' => esc_html__( 'Code to be added inside HEAD tag', 'cryptronick' ),
                'mode'     => 'html',
                'theme'    => 'chrome',
                'default'  => ''
            ),
        ),
    ) );

    // -> START Basic Fields
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Header', 'cryptronick' ),
        'id'               => 'header_section',
        'customizer_width' => '400px',
        'icon'             => 'el-icon-screen',
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Logo', 'cryptronick' ),
        'id'               => 'logo',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'header_logo',
                'type'     => 'media',
                'title'    => esc_html__( 'Header Logo', 'cryptronick' ),
            ),
            array(
                'id'       => 'logo_height_custom',
                'type'     => 'switch',
                'title'    => esc_html__( 'Enable Logo Height', 'cryptronick' ),
                'default'  => false,
            ),
            array(
                'id'             => 'logo_height',
                'type'           => 'dimensions',
                'units'          => false,    
                'units_extended' => false,
                'title'          => esc_html__( 'Set Logo Height' , 'cryptronick' ),
                'height'         => true,
                'width'          => false,
                'default'        => array(
                    'height' => 100,
                ),
                'required' => array( 'logo_height_custom', '=', '1' ),
            ),
            array(
                'id'       => 'logo_sticky',
                'type'     => 'media',
                'title'    => esc_html__( 'Sticky Logo', 'cryptronick' ),
            ),
            array(
                'id'       => 'sticky_logo_height_custom',
                'type'     => 'switch',
                'title'    => esc_html__( 'Enable Sticky Logo Height', 'cryptronick' ),
                'default'  => false,
            ),
            array(
                'id'             => 'sticky_logo_height',
                'type'           => 'dimensions',
                'units'          => false,    
                'units_extended' => false,
                'title'          => esc_html__( 'Set Sticky Logo Height' , 'cryptronick' ),
                'height'         => true,
                'width'          => false,
                'default'        => array(
                    'height' => '',
                ),
                'required' => array(
                    array( 'sticky_logo_height_custom', '=', '1' ),
                ),
            ),
            array(
                'id'       => 'logo_mobile',
                'type'     => 'media',
                'title'    => esc_html__( 'Mobile Logo', 'cryptronick' ),
            ),
            array(
                'id'       => 'mobile_logo_height_custom',
                'type'     => 'switch',
                'title'    => esc_html__( 'Enable Mobile Logo Height', 'cryptronick' ),
                'default'  => false,
            ),
            array(
                'id'             => 'mobile_logo_height',
                'type'           => 'dimensions',
                'units'          => false,    
                'units_extended' => false,
                'title'          => esc_html__( 'Set Mobile Logo Height' , 'cryptronick' ),
                'height'         => true,
                'width'          => false,
                'default'        => array(
                    'height' => '',
                ),
                'required' => array(
                    array( 'mobile_logo_height_custom', '=', '1' ),
                ),
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Header Builder', 'cryptronick' ),
        'id'               => 'header-customize',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'         => 'opt-presets',
                'type'       => 'image_select',
                'presets'    => true,
                'full_width' => true,
                'title'      => esc_html__( 'Preset', 'cryptronick' ),
                'subtitle'   => esc_html__( 'This allows you to set default header layout.', 'cryptronick' ),
                'default'    => 0,
                'options'    => array(

                    '1' => array(
                        'alt'     => 'Preset 1',
                        'img'     => get_template_directory_uri() . '/core/admin/img/menu_1.png',
                        'presets' => '{"header_def_js_preset":"Home Transparent","opt-js-preset":"Home Transparent","bottom_header_layout":{"items":{"placebo":"placebo","html4":"HTML 4","html5":"HTML 5","html6":"HTML 6","delimiter1":"|","delimiter3":"|","delimiter4":"|","delimiter5":"|","html2":"HTML 2","delimiter6":"|","spacer5":"Spacer 5","spacer6":"Spacer 6","spacer7":"Spacer 7","spacer8":"Spacer 8","item_search":"Search","spacer3":"Spacer 3","delimiter2":"|","spacer4":"Spacer 4","html3":"HTML 3","spacer2":"Spacer 2","cart":"Cart"},"Left top area":{"placebo":"placebo","pos_column":{"h_align":"left","v_align":"middle","display":"normal"}},"Center top area":{"placebo":"placebo","pos_column":{"h_align":"center","v_align":"middle","display":"normal"}},"Right top area":{"placebo":"placebo","pos_column":{"h_align":"right","v_align":"middle","display":"normal"}},"Left middle area":{"placebo":"placebo","logo":"Logo","pos_column":{"h_align":"left","v_align":"middle","display":"normal"}},"Center middle area":{"placebo":"placebo","menu":"Menu","pos_column":{"h_align":"right","v_align":"middle","display":"normal"}},"Right middle area":{"placebo":"placebo","wpml":"WPML","spacer1":"Spacer 1","html1":"HTML 1","pos_column":{"h_align":"right","v_align":"middle","display":"normal"}},"Left bottom area":{"placebo":"placebo","pos_column":{"h_align":"left","v_align":"middle","display":"normal"}},"Center bottom area":{"placebo":"placebo","pos_column":{"h_align":"left","v_align":"middle","display":"normal"}},"Right bottom area":{"placebo":"placebo","pos_column":{"h_align":"left","v_align":"middle","display":"normal"}}},"bottom_header_spacer1":{"width":"5"},"bottom_header_spacer2":{"width":"10"},"bottom_header_spacer3":{"width":"10"},"bottom_header_spacer4":{"width":"20"},"bottom_header_spacer5":{"width":"25"},"bottom_header_spacer6":{"width":"25"},"bottom_header_spacer7":{"width":"25"},"bottom_header_spacer8":{"width":"25"},"bottom_header_bar_html1_editor":"[bpt_button button_title=\"Buy Token\" btn_font_size=\"15px\" btn_left_pad=\"37\" btn_right_pad=\"37\" btn_bottom_mar=\"0\" btn_customize=\"color\" btn_text_color=\"#ffffff\" btn_text_color_hover=\"#14c7ff\" btn_bg_color=\"\" btn_bg_color_hover=\"#ffffff\" btn_border_color=\"#ffffff\" btn_border_color_hover=\"#ffffff\" item_el_class=\"sticky_dark\"]","bottom_header_bar_html2_editor":"","bottom_header_bar_html3_editor":"","bottom_header_bar_html4_editor":"","bottom_header_bar_html5_editor":"","bottom_header_bar_html6_editor":"","header_top_full_width":"1","header_top_height":{"height":"50"},"header_top_background_image":{"url":"","id":"","height":"","width":"","thumbnail":""},"header_top_background":{"color":"#222328","alpha":"1","rgba":"rgba(34,35,40,1)"},"header_top_color":{"color":"#fefefe","alpha":".5","rgba":"rgba(254,254,254,0.5)"},"header_top_bottom_border":"0","header_top_border_height":{"height":"1"},"header_top_bottom_border_color":{"color":"#2b3258","alpha":"1","rgba":"rgba(43,50,88,1)"},"header_middle_full_width":"0","header_middle_height":{"height":"112"},"header_middle_background_image":{"url":"","id":"","height":"","width":"","thumbnail":""},"header_middle_background":{"color":"","alpha":"","rgba":""},"header_middle_color":{"color":"#ffffff","alpha":"1","rgba":"rgba(255,255,255,1)"},"header_middle_bottom_border":"0","header_middle_border_height":{"height":"1"},"header_middle_bottom_border_color":{"color":"#ffffff","alpha":"0.2","rgba":"rgba(255,255,255,0.2)"},"header_bottom_full_width":"","header_bottom_height":{"height":"100"},"header_bottom_background_image":{"url":"","id":"","height":"","width":"","thumbnail":""},"header_bottom_background":{"color":"#ffffff","alpha":".9","rgba":"rgba(255,255,255,0.9)"},"header_bottom_color":{"color":"#fefefe","alpha":".5","rgba":"rgba(254,254,254,0.5)"},"header_bottom_bottom_border":"1","header_bottom_border_height":{"height":"1"},"header_bottom_bottom_border_color":{"color":"#2b3258","alpha":"1","rgba":"rgba(43,50,88,1)"},"header_shadow":"0","header_on_bg":"1","menu_ative_top_line":"","sub_menu_background":{"color":"#ffffff","alpha":"1","rgba":"rgba(255,255,255,1)"},"sub_menu_color":"#1b3452","header_mobile_queris":"1170","redux-backup":1}'
                    ),
                    '2' => array(
                        'alt'     => 'Preset 2',
                        'img'     => get_template_directory_uri() . '/core/admin/img/menu_2.png',
                        'presets' => '{"header_def_js_preset":"Fill","opt-js-preset":"Fill","bottom_header_layout":{"items":{"placebo":"placebo","html6":"HTML 6","delimiter1":"|","delimiter3":"|","delimiter4":"|","delimiter5":"|","delimiter2":"|","delimiter6":"|","spacer2":"Spacer 2","spacer3":"Spacer 3","spacer4":"Spacer 4","spacer5":"Spacer 5","spacer8":"Spacer 8","spacer6":"Spacer 6","spacer7":"Spacer 7","html3":"HTML 3","cart":"Cart","html4":"HTML 4","html2":"HTML 2","html5":"HTML 5","wpml":"WPML"},"Left top area":{"placebo":"placebo","pos_column":{"h_align":"left","v_align":"middle","display":"normal"}},"Center top area":{"placebo":"placebo","html1":"HTML 1","pos_column":{"h_align":"center","v_align":"middle","display":"normal"}},"Right top area":{"placebo":"placebo","pos_column":{"h_align":"right","v_align":"middle","display":"normal"}},"Left middle area":{"placebo":"placebo","logo":"Logo","pos_column":{"h_align":"left","v_align":"middle","display":"grow"}},"Center middle area":{"placebo":"placebo","pos_column":{"h_align":"center","v_align":"middle","display":"normal"}},"Right middle area":{"placebo":"placebo","menu":"Menu","spacer1":"Spacer 1","item_search":"Search","pos_column":{"h_align":"right","v_align":"middle","display":"normal"}},"Left bottom area":{"placebo":"placebo","pos_column":{"h_align":"left","v_align":"middle","display":"grow"}},"Center bottom area":{"placebo":"placebo","pos_column":{"h_align":"left","v_align":"middle","display":"normal"}},"Right bottom area":{"placebo":"placebo","pos_column":{"h_align":"right","v_align":"middle","display":"grow"}}},"bottom_header_spacer1":{"width":"82"},"bottom_header_spacer2":{"width":"25"},"bottom_header_spacer3":{"width":"25"},"bottom_header_spacer4":{"width":"25"},"bottom_header_spacer5":{"width":"25"},"bottom_header_spacer6":{"width":"25"},"bottom_header_spacer7":{"width":"25"},"bottom_header_spacer8":{"width":"25"},"bottom_header_bar_html1_editor":"","bottom_header_bar_html2_editor":"<div style=\"margin-right: 29px;\"><span style=\"color: #fb784b; margin-right: 11px; font-size: 18px; line-height: 1.2; float: left;\">[bpt_icon name=\"map-marker\" class=\"\" unprefixed_class=\"\"]<\/span><span style=\"font-size: 14px; line-height: 1.2; display: block; overflow: hidden;\">351 Montreal Ave, Staten <br \/>Island, NY 10306<\/span><\/div>","bottom_header_bar_html3_editor":"<h3><span style=\"color: #fb784b; font-size: 25px; line-height: 28px; font-weight: 300;\">700.1234.5678<\/span><\/h3><span style=\"font-size: 14px;line-height: 21px; display: block;\">Call Us for Any Questions<\/span>","bottom_header_bar_html4_editor":"<span style=\"color: #fb784b; margin-right: 11px; font-size: 18px; line-height: 1.2; float: left;\">[bpt_icon name=\"clock-o\" class=\"\" unprefixed_class=\"\"]<\/span><span style=\"font-size: 15px; line-height: 1.2; display: block; overflow: hidden;\">Monday - Saturday <br \/>9.00 AM - 6 .00 PM<\/span>","bottom_header_bar_html5_editor":"<a href=\"http:\/\/newcryptronick?page_id=18\" style=\"margin-right: 29px;\">[bpt_icon name=\"twitter\" class=\"\" unprefixed_class=\"\"]<\/a>\u00a0\u00a0<a href=\"http:\/\/newcryptronick\" style=\"margin-right: 29px;\">[bpt_icon name=\"linkedin\" class=\"\" unprefixed_class=\"\"]<\/a>\u00a0\u00a0<a href=\"http:\/\/newcryptronick\" style=\"margin-right: 29px;\">[bpt_icon name=\"facebook\" class=\"\" unprefixed_class=\"\"]<\/a>\u00a0\u00a0<a href=\"http:\/\/newcryptronick?page_id=18\">[bpt_icon name=\"instagram\" class=\"\" unprefixed_class=\"\"]<\/a>","bottom_header_bar_html6_editor":"","header_top_full_width":"1","header_top_height":{"height":"56"},"header_top_background_image":{"url":"","id":"","height":"","width":"","thumbnail":""},"header_top_background":{"color":"#080b37","alpha":"1","rgba":"rgba(8,11,55,1)"},"header_top_color":{"color":"#fffcfc","alpha":"1","rgba":"rgba(255,252,252,1)"},"header_top_bottom_border":"0","header_top_border_height":{"height":"0"},"header_top_bottom_border_color":{"color":"#ffffff","alpha":"0.2","rgba":"rgba(255,255,255,0.2)"},"header_middle_full_width":"0","header_middle_height":{"height":"115"},"header_middle_background_image":{"url":"","id":"","height":"","width":"","thumbnail":""},"header_middle_background":{"color":"#000020","alpha":"1","rgba":"rgba(0,0,32,1)"},"header_middle_color":{"color":"#ffffff","alpha":"1","rgba":"rgba(255,255,255,1)"},"header_middle_bottom_border":"0","header_middle_border_height":{"height":"1"},"header_middle_bottom_border_color":{"color":"#ffffff","alpha":"0.2","rgba":"rgba(255,255,255,0.2)"},"header_bottom_full_width":"","header_bottom_height":{"height":"50"},"header_bottom_background_image":{"url":"","id":"","height":"","width":"","thumbnail":""},"header_bottom_background":{"color":"#222328","alpha":"0.4","rgba":"rgba(34,35,40,0.4)"},"header_bottom_color":{"color":"#fefefe","alpha":"1","rgba":"rgba(254,254,254,1)"},"header_bottom_bottom_border":"0","header_bottom_border_height":{"height":"1"},"header_bottom_bottom_border_color":{"color":"#2b3258","alpha":"1","rgba":"rgba(43,50,88,1)"},"header_shadow":"1","header_on_bg":"0","menu_ative_top_line":"","sub_menu_background":{"color":"#ffffff","alpha":"1","rgba":"rgba(255,255,255,1)"},"sub_menu_color":"#1b3452","header_mobile_queris":"1240","redux-backup":1}'
                    ),                    
                    '3' => array(
                        'alt'     => 'Preset 3',
                        'img'     => get_template_directory_uri() . '/core/admin/img/menu_3.png',
                        'presets' => '{"header_def_js_preset":"Fill BG-Image","opt-js-preset":"Fill BG-Image","bottom_header_layout":{"items":{"placebo":"placebo","html6":"HTML 6","delimiter1":"|","delimiter3":"|","delimiter4":"|","delimiter5":"|","delimiter2":"|","delimiter6":"|","spacer2":"Spacer 2","spacer3":"Spacer 3","spacer4":"Spacer 4","spacer5":"Spacer 5","spacer8":"Spacer 8","spacer6":"Spacer 6","spacer7":"Spacer 7","html3":"HTML 3","cart":"Cart","html4":"HTML 4","html2":"HTML 2","html5":"HTML 5","wpml":"WPML"},"Left top area":{"placebo":"placebo","pos_column":{"h_align":"left","v_align":"middle","display":"normal"}},"Center top area":{"placebo":"placebo","html1":"HTML 1","pos_column":{"h_align":"center","v_align":"middle","display":"normal"}},"Right top area":{"placebo":"placebo","pos_column":{"h_align":"right","v_align":"middle","display":"normal"}},"Left middle area":{"placebo":"placebo","logo":"Logo","pos_column":{"h_align":"left","v_align":"middle","display":"grow"}},"Center middle area":{"placebo":"placebo","pos_column":{"h_align":"center","v_align":"middle","display":"normal"}},"Right middle area":{"placebo":"placebo","menu":"Menu","spacer1":"Spacer 1","item_search":"Search","pos_column":{"h_align":"right","v_align":"middle","display":"normal"}},"Left bottom area":{"placebo":"placebo","pos_column":{"h_align":"left","v_align":"middle","display":"grow"}},"Center bottom area":{"placebo":"placebo","pos_column":{"h_align":"left","v_align":"middle","display":"normal"}},"Right bottom area":{"placebo":"placebo","pos_column":{"h_align":"right","v_align":"middle","display":"grow"}}},"bottom_header_spacer1":{"width":"82"},"bottom_header_spacer2":{"width":"25"},"bottom_header_spacer3":{"width":"25"},"bottom_header_spacer4":{"width":"25"},"bottom_header_spacer5":{"width":"25"},"bottom_header_spacer6":{"width":"25"},"bottom_header_spacer7":{"width":"25"},"bottom_header_spacer8":{"width":"25"},"bottom_header_bar_html1_editor":"","bottom_header_bar_html2_editor":"<div style=\"margin-right: 29px;\"><span style=\"color: #fb784b; margin-right: 11px; font-size: 18px; line-height: 1.2; float: left;\">[bpt_icon name=\"map-marker\" class=\"\" unprefixed_class=\"\"]<\/span><span style=\"font-size: 14px; line-height: 1.2; display: block; overflow: hidden;\">351 Montreal Ave, Staten <br \/>Island, NY 10306<\/span><\/div>","bottom_header_bar_html3_editor":"<h3><span style=\"color: #fb784b; font-size: 25px; line-height: 28px; font-weight: 300;\">700.1234.5678<\/span><\/h3><span style=\"font-size: 14px;line-height: 21px; display: block;\">Call Us for Any Questions<\/span>","bottom_header_bar_html4_editor":"<span style=\"color: #fb784b; margin-right: 11px; font-size: 18px; line-height: 1.2; float: left;\">[bpt_icon name=\"clock-o\" class=\"\" unprefixed_class=\"\"]<\/span><span style=\"font-size: 15px; line-height: 1.2; display: block; overflow: hidden;\">Monday - Saturday <br \/>9.00 AM - 6 .00 PM<\/span>","bottom_header_bar_html5_editor":"<a href=\"http:\/\/newcryptronick?page_id=18\" style=\"margin-right: 29px;\">[bpt_icon name=\"twitter\" class=\"\" unprefixed_class=\"\"]<\/a>\u00a0\u00a0<a href=\"http:\/\/newcryptronick\" style=\"margin-right: 29px;\">[bpt_icon name=\"linkedin\" class=\"\" unprefixed_class=\"\"]<\/a>\u00a0\u00a0<a href=\"http:\/\/newcryptronick\" style=\"margin-right: 29px;\">[bpt_icon name=\"facebook\" class=\"\" unprefixed_class=\"\"]<\/a>\u00a0\u00a0<a href=\"http:\/\/newcryptronick?page_id=18\">[bpt_icon name=\"instagram\" class=\"\" unprefixed_class=\"\"]<\/a>","bottom_header_bar_html6_editor":"","header_top_full_width":"1","header_top_height":{"height":"56"},"header_top_background_image":{"url":"","id":"","height":"","width":"","thumbnail":""},"header_top_background":{"color":"#080b37","alpha":"1","rgba":"rgba(8,11,55,1)"},"header_top_color":{"color":"#fffcfc","alpha":"1","rgba":"rgba(255,252,252,1)"},"header_top_bottom_border":"0","header_top_border_height":{"height":"0"},"header_top_bottom_border_color":{"color":"#ffffff","alpha":"0.2","rgba":"rgba(255,255,255,0.2)"},"header_middle_full_width":"0","header_middle_height":{"height":"115"},"header_middle_background_image":{"url":"http:\/\/cryptronick.bpthemes.net\/wp-content\/uploads\/2018\/06\/header_bg.jpg","id":"769","height":"115","width":"1920","thumbnail":"http:\/\/cryptronick.bpthemes.net\/wp-content\/uploads\/2018\/06\/header_bg-150x115.jpg"},"header_middle_background":{"color":"#000020","alpha":"1","rgba":"rgba(0,0,32,1)"},"header_middle_color":{"color":"#ffffff","alpha":"1","rgba":"rgba(255,255,255,1)"},"header_middle_bottom_border":"0","header_middle_border_height":{"height":"1"},"header_middle_bottom_border_color":{"color":"#ffffff","alpha":"0.2","rgba":"rgba(255,255,255,0.2)"},"header_bottom_full_width":"","header_bottom_height":{"height":"50"},"header_bottom_background_image":{"url":"","id":"","height":"","width":"","thumbnail":""},"header_bottom_background":{"color":"#222328","alpha":"0.4","rgba":"rgba(34,35,40,0.4)"},"header_bottom_color":{"color":"#fefefe","alpha":"1","rgba":"rgba(254,254,254,1)"},"header_bottom_bottom_border":"0","header_bottom_border_height":{"height":"1"},"header_bottom_bottom_border_color":{"color":"#2b3258","alpha":"1","rgba":"rgba(43,50,88,1)"},"header_shadow":"1","header_on_bg":"0","menu_ative_top_line":"","sub_menu_background":{"color":"#ffffff","alpha":"1","rgba":"rgba(255,255,255,1)"},"sub_menu_color":"#1b3452","header_mobile_queris":"1240","redux-backup":1}'
                    ),
                ),
            ),            
            array(
                'id'       => 'header_def_js_preset',
                'type'     => 'select',
                'title'    => esc_html__( 'Header default preset', 'cryptronick' ),
                'default'  => 'Fill BG-Image',
                'options'  => cryptronick_get_preset(),
                'desc'     => esc_html__( 'Please choose preset to use this in all Pages. 
                    You also can choose for every page your custom header present in page\'s option select(page metabox).', 'cryptronick' ),
            ),            
            array(
                'id'         => 'opt-js-preset',
                'type'       => 'custom_preset',
                'title'      => esc_html__( 'Custom Preset', 'cryptronick' ),
            ),    
            array(
                'id'       => 'bottom_header_layout',
                'type'     => 'custom_header_builder',
                'title'    => esc_html__( 'Header Order', 'cryptronick' ),
                'desc'     => esc_html__( 'Organize the layout of the header', 'cryptronick' ),
                'compiler' => 'true',
                'full_width' => true,
                'options'  => array(
                    'items'  => array(
                        'html1' => esc_html__( 'HTML 1', 'cryptronick' ),
                        'html2'  =>  esc_html__( 'HTML 2', 'cryptronick' ),
                        'html3' => esc_html__( 'HTML 3', 'cryptronick' ),
                        'html4'  =>  esc_html__( 'HTML 4', 'cryptronick' ),
                        'html5' => esc_html__( 'HTML 5', 'cryptronick' ),
                        'html6'  =>  esc_html__( 'HTML 6', 'cryptronick' ),
                        'item_search'  =>  esc_html__( 'Search', 'cryptronick' ),
                        'wpml'        =>  esc_html__( 'WPML', 'cryptronick' ),
                        'delimiter1'  =>  esc_html__( '|', 'cryptronick' ),
                        'delimiter2'  =>  esc_html__( '|', 'cryptronick' ),
                        'delimiter3'  =>  esc_html__( '|', 'cryptronick' ),
                        'delimiter4'  =>  esc_html__( '|', 'cryptronick' ),
                        'delimiter5'  =>  esc_html__( '|', 'cryptronick' ),
                        'delimiter6'  =>  esc_html__( '|', 'cryptronick' ),
                        'spacer1'  =>  esc_html__( 'Spacer 1', 'cryptronick' ),
                        'spacer2'  =>  esc_html__( 'Spacer 2', 'cryptronick' ),
                        'spacer3'  =>  esc_html__( 'Spacer 3', 'cryptronick' ),
                        'spacer4'  =>  esc_html__( 'Spacer 4', 'cryptronick' ),
                        'spacer5'  =>  esc_html__( 'Spacer 5', 'cryptronick' ),
                        'spacer6'  =>  esc_html__( 'Spacer 6', 'cryptronick' ),
                        'spacer7'  =>  esc_html__( 'Spacer 7', 'cryptronick' ),
                        'spacer8'  =>  esc_html__( 'Spacer 8', 'cryptronick' ),
                        'cart'     =>  esc_html__( 'Cart', 'cryptronick' ),
                    ), 
                    'Left top area' => array(),
                    'Center top area' => array(),
                    'Right top area' => array(),                     
                    'Left middle area' => array(
                        'logo' => esc_html__( 'Logo', 'cryptronick' ),
                    ),
                    'Center middle area' => array(
                    ),
                    'Right middle area' => array(
                        'menu' => esc_html__( 'Menu', 'cryptronick' ),
                    ),                    
                    'Left bottom area' => array(
                    ),
                    'Center bottom area' => array(
                    ),
                    'Right bottom area' => array(
                    ),
                ),
                'default'   => array(
                    'items'  => array(
                        'html1' => esc_html__( 'HTML 1', 'cryptronick' ),
                        'html2'  =>  esc_html__( 'HTML 2', 'cryptronick' ),
                        'html3' => esc_html__( 'HTML 3', 'cryptronick' ),
                        'html4'  =>  esc_html__( 'HTML 4', 'cryptronick' ),
                        'html5' => esc_html__( 'HTML 5', 'cryptronick' ),
                        'html6'  =>  esc_html__( 'HTML 6', 'cryptronick' ),
                        'item_search'  =>  esc_html__( 'Search', 'cryptronick' ),
                        'wpml'        =>  esc_html__( 'WPML', 'cryptronick' ),
                        'delimiter1'  =>  esc_html__( '|', 'cryptronick' ),
                        'delimiter2'  =>  esc_html__( '|', 'cryptronick' ),
                        'delimiter3'  =>  esc_html__( '|', 'cryptronick' ),
                        'delimiter4'  =>  esc_html__( '|', 'cryptronick' ),
                        'delimiter5'  =>  esc_html__( '|', 'cryptronick' ),
                        'delimiter6'  =>  esc_html__( '|', 'cryptronick' ),
                        'spacer1'  =>  esc_html__( 'Spacer 1', 'cryptronick' ),
                        'spacer2'  =>  esc_html__( 'Spacer 2', 'cryptronick' ),
                        'spacer3'  =>  esc_html__( 'Spacer 3', 'cryptronick' ),
                        'spacer4'  =>  esc_html__( 'Spacer 4', 'cryptronick' ),
                        'spacer5'  =>  esc_html__( 'Spacer 5', 'cryptronick' ),
                        'spacer6'  =>  esc_html__( 'Spacer 6', 'cryptronick' ),
                        'spacer7'  =>  esc_html__( 'Spacer 7', 'cryptronick' ),
                        'spacer8'  =>  esc_html__( 'Spacer 8', 'cryptronick' ),
                        'cart'     =>  esc_html__( 'Cart', 'cryptronick' ),
                    ), 
                    'Left top area' => array(),
                    'Center top area' => array(),
                    'Right top area' => array(),                     
                    'Left middle area' => array(
                        'logo' => esc_html__( 'Logo', 'cryptronick' ),
                    ),
                    'Center middle area' => array(
                    ),
                    'Right middle area' => array(
                        'menu' => esc_html__( 'Menu', 'cryptronick' ),
                    ),                    
                    'Left bottom area' => array(
                    ),
                    'Center bottom area' => array(
                    ),
                    'Right bottom area' => array(
                    ),
                ),
            ),   
            array(
                'id'      => 'bottom_header_spacer1',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Header Spacer 1 Width', 'cryptronick' ),
                'height'         => false,
                'width'          => true,
                'default'        => array(
                    'width' => 25,
                )
            ),            
            array(
                'id'      => 'bottom_header_spacer2',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Header Spacer 2 Width', 'cryptronick' ),
                'height'         => false,
                'width'          => true,
                'default'        => array(
                    'width' => 25,
                )
            ),            
            array(
                'id'      => 'bottom_header_spacer3',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Header Spacer 3 Width', 'cryptronick' ),
                'height'         => false,
                'width'          => true,
                'default'        => array(
                    'width' => 25,
                )
            ),            
            array(
                'id'      => 'bottom_header_spacer4',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Header Spacer 4 Width', 'cryptronick' ),
                'height'         => false,
                'width'          => true,
                'default'        => array(
                    'width' => 25,
                )
            ),            
            array(
                'id'      => 'bottom_header_spacer5',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Header Spacer 5 Width', 'cryptronick' ),
                'height'         => false,
                'width'          => true,
                'default'        => array(
                    'width' => 25,
                )
            ),            
            array(
                'id'      => 'bottom_header_spacer6',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Header Spacer 6 Width', 'cryptronick' ),
                'height'         => false,
                'width'          => true,
                'default'        => array(
                    'width' => 25,
                )
            ),            
            array(
                'id'      => 'bottom_header_spacer7',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Header Spacer 7 Width', 'cryptronick' ),
                'height'         => false,
                'width'          => true,
                'default'        => array(
                    'width' => 25,
                )
            ),            
            array(
                'id'      => 'bottom_header_spacer8',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Header Spacer 8 Width', 'cryptronick' ),
                'height'         => false,
                'width'          => true,
                'default'        => array(
                    'width' => 25,
                )
            ),

            array(
                'id'      => 'bottom_header_bar_html1_editor',
                'type'    => 'ace_editor',
                'mode'    => 'html',
                'title'   => esc_html__( 'HTML Element 1 Editor', 'cryptronick' ),
                'default' => '',
            ),
            array(
                'id'      => 'bottom_header_bar_html2_editor',
                'type'    => 'ace_editor',
                'mode'    => 'html',
                'title'   => esc_html__( 'HTML Element 2 Editor', 'cryptronick' ),
                'default' => '',
            ),            
            array(
                'id'      => 'bottom_header_bar_html3_editor',
                'type'    => 'ace_editor',
                'mode'    => 'html',
                'title'   => esc_html__( 'HTML Element 3 Editor', 'cryptronick' ),
                'default' => '',
            ),
            array(
                'id'      => 'bottom_header_bar_html4_editor',
                'type'    => 'ace_editor',
                'mode'    => 'html',
                'title'   => esc_html__( 'HTML Element 4 Editor', 'cryptronick' ),
                'default' => '',
            ),            array(
                'id'      => 'bottom_header_bar_html5_editor',
                'type'    => 'ace_editor',
                'mode'    => 'html',
                'title'   => esc_html__( 'HTML Element 5 Editor', 'cryptronick' ),
                'default' => '',
            ),
            array(
                'id'      => 'bottom_header_bar_html6_editor',
                'type'    => 'ace_editor',
                'mode'    => 'html',
                'title'   => esc_html__( 'HTML Element 6 Editor', 'cryptronick' ),
                'default' => '',
            ),
            array(
                'id'       => 'header_top-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Header Top Options', 'cryptronick' ),
                'indent'   => true,
            ),
            array(
                'id'       => 'header_top_full_width',
                'type'     => 'switch',
                'title'    => esc_html__( 'Full Width Top Header', 'cryptronick' ),
                'subtitle' => esc_html__( 'Set header content in full width top layout', 'cryptronick' ),
                'default'  => false,
            ),
            array(
                'id'             => 'header_top_height',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Header Top Height', 'cryptronick' ),
                'height'         => true,
                'width'          => false,
                'default'        => array(
                    'height' => 100,
                )
            ),
            array(
                'id'       => 'header_top_background_image',
                'type'     => 'media',
                'title'    => esc_html__( 'Header Top Background Image', 'cryptronick' ),
            ),
            array(
                'id'       => 'header_top_background',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Header Top Background', 'cryptronick' ),
                'default'  => array(
                    'color' => '#ffffff',
                    'alpha' => '.9',
                    'rgba'  => 'rgba(255,255,255,0.9)'
                ),
                'mode'     => 'background',
            ),
            array(
                'id'       => 'header_top_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Header Top Text Color', 'cryptronick' ),
                'subtitle' => esc_html__( 'Set Top header text color', 'cryptronick' ),
                'default'  => array(
                    'color' => '#fefefe',
                    'alpha' => '.5',
                    'rgba'  => 'rgba(254,254,254,0.5)'
                ),
                'mode'     => 'background',
            ),
            array(
                'id'       => 'header_top_bottom_border',
                'type'     => 'switch',
                'title'    => esc_html__( 'Set Header Top Bottom Border', 'cryptronick' ),
                'default'  => true,
            ),
            array(
                'id'             => 'header_top_border_height',
                'type'           => 'dimensions',
                'units'          => false,    
                'units_extended' => false,
                'title'          => esc_html__( 'Header Top Border Width' , 'cryptronick' ),
                'height'         => true,
                'width'          => false,
                'default'        => array(
                    'height' => '1',
                ),
                'required' => array(
                    array( 'header_top_bottom_border', '=', '1' )
                ),
            ),
            array(
                'id'       => 'header_top_bottom_border_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Header Top Border Color', 'cryptronick' ),
                'default'  => array(
                    'color' => '#2b3258',
                    'alpha' => '1',
                    'rgba'  => 'rgba(43,50,88,1)'
                ),
                'mode'     => 'background',
                'required' => array(
                    array( 'header_top_bottom_border', '=', '1' ),
                ), 
            ),
            array(
                'id'     => 'header_top-end',
                'type'   => 'section',
                'indent' => false, 
            ),               
            array(
                'id'       => 'header_middle-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Header Middle Options', 'cryptronick' ),
                'indent'   => true,
            ),
            array(
                'id'       => 'header_middle_full_width',
                'type'     => 'switch',
                'title'    => esc_html__( 'Full Width Middle Header', 'cryptronick' ),
                'subtitle' => esc_html__( 'Set header content in full width middle layout', 'cryptronick' ),
                'default'  => true,
            ),
            array(
                'id'             => 'header_middle_height',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Header Middle Height', 'cryptronick' ),
                'height'         => true,
                'width'          => false,
                'default'        => array(
                    'height' => 100,
                )
            ),
            array(
                'id'       => 'header_middle_background_image',
                'type'     => 'media',
                'title'    => esc_html__( 'Header Middle Background Image', 'cryptronick' ),
            ),
            array(
                'id'       => 'header_middle_background',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Header Middle Background', 'cryptronick' ),
                'default'  => array(
                    'color' => '#222328',
                    'alpha' => '.8',
                    'rgba'  => 'rgba(34,35,40,0.8)'
                ),
                'mode'     => 'background',
            ),
            array(
                'id'       => 'header_middle_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Header Middle Text Color', 'cryptronick' ),
                'subtitle' => esc_html__( 'Set Middle header text color', 'cryptronick' ),
                'default'  => array(
                    'color' => '#ffffff',
                    'alpha' => '1',
                    'rgba'  => 'rgba(255,255,255,1)'
                ),
                'mode'     => 'background',
            ),
            array(
                'id'       => 'header_middle_bottom_border',
                'type'     => 'switch',
                'title'    => esc_html__( 'Set Header Middle Bottom Border', 'cryptronick' ),
                'default'  => false,
            ),
            array(
                'id'             => 'header_middle_border_height',
                'type'           => 'dimensions',
                'units'          => false,    
                'units_extended' => false,
                'title'          => esc_html__( 'Header Middle Border Width' , 'cryptronick' ),
                'height'         => true,
                'width'          => false,
                'default'        => array(
                    'height' => '1',
                ),
                'required' => array(
                    array( 'header_middle_bottom_border', '=', '1' )
                ),
            ),
            array(
                'id'       => 'header_middle_bottom_border_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Header Middle Border Color', 'cryptronick' ),
                'default'  => array(
                    'color' => '#2b3258',
                    'alpha' => '1',
                    'rgba'  => 'rgba(43,50,88,1)'
                ),
                'mode'     => 'background',
                'required' => array(
                    array( 'header_middle_bottom_border', '=', '1' ),
                ), 
            ),
            array(
                'id'     => 'header_middle-end',
                'type'   => 'section',
                'indent' => false, 
            ),            

            array(
                'id'       => 'header_bottom-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Header Bottom Options', 'cryptronick' ),
                'indent'   => true,
            ),
            array(
                'id'       => 'header_bottom_full_width',
                'type'     => 'switch',
                'title'    => esc_html__( 'Full Width Bottom Header', 'cryptronick' ),
                'subtitle' => esc_html__( 'Set header content in full width bottom layout', 'cryptronick' ),
                'default'  => false,
            ),
            array(
                'id'             => 'header_bottom_height',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Header Bottom Height', 'cryptronick' ),
                'height'         => true,
                'width'          => false,
                'default'        => array(
                    'height' => 100,
                )
            ),
            array(
                'id'       => 'header_bottom_background_image',
                'type'     => 'media',
                'title'    => esc_html__( 'Header Bottom Background Image', 'cryptronick' ),
            ),
            array(
                'id'       => 'header_bottom_background',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Header Bottom Background', 'cryptronick' ),
                'default'  => array(
                    'color' => '#ffffff',
                    'alpha' => '.9',
                    'rgba'  => 'rgba(255,255,255,0.9)'
                ),
                'mode'     => 'background',
            ),
            array(
                'id'       => 'header_bottom_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Header Bottom Text Color', 'cryptronick' ),
                'subtitle' => esc_html__( 'Set Bottom header text color', 'cryptronick' ),
                'default'  => array(
                    'color' => '#fefefe',
                    'alpha' => '.5',
                    'rgba'  => 'rgba(254,254,254,0.5)'
                ),
                'mode'     => 'background',
            ),
            array(
                'id'       => 'header_bottom_bottom_border',
                'type'     => 'switch',
                'title'    => esc_html__( 'Set Header Bottom Border', 'cryptronick' ),
                'default'  => true,
            ),
            array(
                'id'             => 'header_bottom_border_height',
                'type'           => 'dimensions',
                'units'          => false,    
                'units_extended' => false,
                'title'          => esc_html__( 'Header Bottom Border Width' , 'cryptronick' ),
                'height'         => true,
                'width'          => false,
                'default'        => array(
                    'height' => '1',
                ),
                'required' => array(
                    array( 'header_bottom_bottom_border', '=', '1' )
                ),
            ),
            array(
                'id'       => 'header_bottom_bottom_border_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Header Bottom Border Color', 'cryptronick' ),
                'default'  => array(
                    'color' => '#2b3258',
                    'alpha' => '1',
                    'rgba'  => 'rgba(43,50,88,1)'
                ),
                'mode'     => 'background',
                'required' => array(
                    array( 'header_bottom_bottom_border', '=', '1' ),
                ), 
            ),
            array(
                'id'     => 'header_bottom-end',
                'type'   => 'section',
                'indent' => false, 
            ),
            array(
                'id'       => 'header_row_settings-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Header Settings', 'cryptronick' ),
                'indent'   => true,
            ),
            array(
                'id'       => 'header_shadow',
                'type'     => 'switch',
                'title'    => esc_html__( 'Header Bottom Shadow', 'cryptronick' ),
                'default'  => true,
            ),
            array(
                'id'       => 'header_on_bg',
                'type'     => 'switch',
                'title'    => esc_html__( 'Header Above Content', 'cryptronick' ),
                'subtitle' => esc_html__( 'Set the header to display above the slider or page content', 'cryptronick' ),
                'default'  => false,
            ),
            array(
                'id'       => 'menu_ative_top_line',
                'type'     => 'switch',
                'title'    => esc_html__( 'Enable Active Menu Item Marker', 'cryptronick' ),
                'default'  => false,
            ),
            array(
                'id'       => 'sub_menu_background',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Sub Menu Background', 'cryptronick' ),
                'subtitle' => esc_html__( 'Set sub menu background color', 'cryptronick' ),
                'default'  => array(
                    'color' => '#222328',
                    'alpha' => '1',
                    'rgba'  => 'rgba(34,35,40,1)'
                ),
                'mode'     => 'background',
            ),
            array(
                'id'       => 'sub_menu_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Sub Menu Text Color', 'cryptronick' ),
                'subtitle' => esc_html__( 'Set sub menu header text color', 'cryptronick' ),
                'default'  => '#ffffff',
                'transparent' => false,
            ),
            array(
                'id'        => 'header_mobile_queris',
                'type'      => 'slider',
                'title'     => esc_html__('Show Header mobile in the resolution', 'cryptronick'),
                "default"   => 1200,
                "min"       => 1,
                "step"      => 1,
                "max"       => 1700,
                'display_value' => 'text',
                'required' => array( 'mobile_header', '=', '1' ),
            ),

            array(
                'id'     => 'header_row_settings-end',
                'type'   => 'section',
                'indent' => false, 
            ),

        )

    ) );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Header Sticky', 'cryptronick' ),
        'id'               => 'header_builder_sticky',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(            
            array(
                'id'       => 'header_sticky',
                'type'     => 'switch',
                'title'    => esc_html__( 'Sticky Header', 'cryptronick' ),
                'default'  => true,
            ),
            array(
                'id'       => 'header_sticky-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Sticky Settings', 'cryptronick' ),
                'indent'   => true,
                'required' => array( 'header_sticky', '=', '1' ),
            ),
            array(
                'id'             => 'header_sticky_height',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Sticky Header Height', 'cryptronick' ),
                'height'         => true,
                'width'          => false,
                'default'        => array(
                    'height' => 100,
                )
            ),
            array(
                'id'       => 'header_sticky_background',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Sticky Header Background', 'cryptronick' ),
                'subtitle' => esc_html__( 'Set sticky header background color', 'cryptronick' ),
                'default'  => array(
                    'color' => '#ffffff',
                    'alpha' => '1.0',
                    'rgba'  => 'rgba(255,255,255,1)'
                ),
                'mode'     => 'background',
            ),
            array(
                'id'       => 'header_sticky_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Sticky Header Text Color', 'cryptronick' ),
                'subtitle' => esc_html__( 'Set sticky header text color', 'cryptronick' ),
                'default'  => '#404040',
                'transparent' => false,
            ),
            array(
                'id'       => 'header_sticky_appearance_style',
                'type'     => 'select',
                'title'    => esc_html__( 'Sticky Appearance Style', 'cryptronick' ),
                'options'  => array(
                    'classic' => esc_html__( 'Classic', 'cryptronick' ),
                    'scroll_top' => esc_html__( 'Appearance only on scroll top', 'cryptronick' ),
                ),
                'default'  => 'classic'
            ),
            array(
                'id'       => 'header_sticky_appearance_from_top',
                'type'     => 'select',
                'title'    => esc_html__( 'Sticky Header Appearance From Top of Page', 'cryptronick' ),
                'options'  => array(
                    'auto' => esc_html__( 'Auto', 'cryptronick' ),
                    'custom' => esc_html__( 'Custom', 'cryptronick' ),
                ),
                'default'  => 'auto'
            ),
            array(
                'id'             => 'header_sticky_appearance_number',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Set the distance from the top of the page', 'cryptronick' ),
                'height'         => true,
                'width'          => false,
                'default'        => array(
                    'height' => 300,
                ),
                'required' => array( 'header_sticky_appearance_from_top', '=', 'custom' ),
            ),
            array(
                'id'       => 'header_sticky_shadow',
                'type'     => 'switch',
                'title'    => esc_html__( 'Sticky Header Bottom Shadow', 'cryptronick' ),
                'default'  => true,
            ),
            array(
                'id'       => 'sticky_header',
                'type'     => 'switch',
                'title'    => esc_html__( 'Custom Sticky Header ', 'cryptronick' ),
                'default'  => false,
            ),
            array(
                'id'       => 'sticky_header_layout',
                'type'     => 'sorter',
                'title'    => esc_html__( 'Sticky Header Order', 'cryptronick' ),
                'desc'     => esc_html__( 'Organize the layout of the sticky header', 'cryptronick' ),
                'compiler' => 'true',
                'options'  => array(
                    'Items'  => array(
                        'html1' => esc_html__( 'HTML 1', 'cryptronick' ),
                        'html2'  =>  esc_html__( 'HTML 2', 'cryptronick' ),                        
                        'html3' => esc_html__( 'HTML 3', 'cryptronick' ),
                        'html4'  =>  esc_html__( 'HTML 4', 'cryptronick' ),                        
                        'html5' => esc_html__( 'HTML 5', 'cryptronick' ),
                        'html6'  =>  esc_html__( 'HTML 6', 'cryptronick' ),
                        'item_search'  =>  esc_html__( 'Search', 'cryptronick' ),
                        'wpml'        =>  esc_html__( 'WPML', 'cryptronick' ),
                        'delimiter1'  =>  esc_html__( '|', 'cryptronick' ),
                        'delimiter2'  =>  esc_html__( '|', 'cryptronick' ),
                        'delimiter3'  =>  esc_html__( '|', 'cryptronick' ),
                        'delimiter4'  =>  esc_html__( '|', 'cryptronick' ),
                        'delimiter5'  =>  esc_html__( '|', 'cryptronick' ),
                        'delimiter6'  =>  esc_html__( '|', 'cryptronick' ),
                    ),
                    'Left align side' => array(
                        'logo' => esc_html__( 'Logo', 'cryptronick' ),
                    ),
                    'Center align side' => array(),
                    'Right align side' => array(
                        'menu' => esc_html__( 'Menu', 'cryptronick' ),
                    ),
                ),
                'required' => array(
                    array( 'sticky_header', '=', '1' )
                ),
            ),
            array(
                'id'       => 'header_custom_sticky_full_width',
                'type'     => 'switch',
                'title'    => esc_html__( 'Full Width Sticky Header', 'cryptronick' ),
                'default'  => false,
                'required' => array(
                    array( 'sticky_header', '=', '1' )
                ),
            ),
            array(
                'id'      => 'sticky_header_bar_html1_editor',
                'type'    => 'ace_editor',
                'mode'    => 'html',
                'title'   => esc_html__( 'HTML Element 1 Editor', 'cryptronick' ),
                'default' => '',
                'required' => array(
                    array( 'sticky_header', '=', '1' )
                ),
            ),
            array(
                'id'      => 'sticky_header_bar_html2_editor',
                'type'    => 'ace_editor',
                'mode'    => 'html',
                'title'   => esc_html__( 'HTML Element 2 Editor', 'cryptronick' ),
                'default' => '',
                'required' => array(
                    array( 'sticky_header', '=', '1' )
                ),
            ),             
            array(
                'id'      => 'sticky_header_bar_html3_editor',
                'type'    => 'ace_editor',
                'mode'    => 'html',
                'title'   => esc_html__( 'HTML Element 3 Editor', 'cryptronick' ),
                'default' => '',
                'required' => array(
                    array( 'sticky_header', '=', '1' )
                ),
            ),
            array(
                'id'      => 'sticky_header_bar_html4_editor',
                'type'    => 'ace_editor',
                'mode'    => 'html',
                'title'   => esc_html__( 'HTML Element 4 Editor', 'cryptronick' ),
                'default' => '',
                'required' => array(
                    array( 'sticky_header', '=', '1' )
                ),
            ),             
            array(
                'id'      => 'sticky_header_bar_html5_editor',
                'type'    => 'ace_editor',
                'mode'    => 'html',
                'title'   => esc_html__( 'HTML Element 5 Editor', 'cryptronick' ),
                'default' => '',
                'required' => array(
                    array( 'sticky_header', '=', '1' )
                ),
            ),
            array(
                'id'      => 'sticky_header_bar_html6_editor',
                'type'    => 'ace_editor',
                'mode'    => 'html',
                'title'   => esc_html__( 'HTML Element 6 Editor', 'cryptronick' ),
                'default' => '',
                'required' => array(
                    array( 'sticky_header', '=', '1' )
                ),
            ), 
            array(
                'id'     => 'header_sticky-end',
                'type'   => 'section',
                'indent' => false, 
                'required' => array( 'header_sticky', '=', '1' ),
            ),
        )
    ) );    
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Header Mobile', 'cryptronick' ),
        'id'               => 'header_builder_mobile',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'mobile_header',
                'type'     => 'switch',
                'title'    => esc_html__( 'Custom Mobile Header ', 'cryptronick' ),
                'default'  => true,
            ),
            array(
                'id'       => 'mobile_background',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Mobile Header Background', 'cryptronick' ),
                'subtitle' => esc_html__( 'Set mobile header background color', 'cryptronick' ),
                'default'  => array(
                    'color' => '#222328',
                    'alpha' => '1',
                    'rgba'  => 'rgba(34,35,40,1)'
                ),
                'mode'     => 'background',
                'required' => array( 'mobile_header', '=', '1' ),
            ),
            array(
                'id'       => 'mobile_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Mobile Header Text Color', 'cryptronick' ),
                'subtitle' => esc_html__( 'Set mobile header text color', 'cryptronick' ),
                'default'  => '#ffffff',
                'transparent' => false,
                'required' => array( 'mobile_header', '=', '1' ),
            ),
            array(
                'id'       => 'mobile_sub_menu_background',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Mobile Sub Menu Background', 'cryptronick' ),
                'subtitle' => esc_html__( 'Set sub menu background color', 'cryptronick' ),
                'default'  => array(
                    'color' => '#222328',
                    'alpha' => '1',
                    'rgba'  => 'rgba(34,35,40,1)'
                ),
                'mode'     => 'background',
                'required' => array( 'mobile_header', '=', '1' ),
            ),
            array(
                'id'       => 'mobile_sub_menu_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Mobile Sub Menu Text Color', 'cryptronick' ),
                'subtitle' => esc_html__( 'Set sub menu header text color', 'cryptronick' ),
                'default'  => '#ffffff',
                'transparent' => false,
                'required' => array( 'mobile_header', '=', '1' ),
            ),   
            array(
                'id'             => 'header_mobile_height',
                'type'           => 'dimensions',
                'units'          => false,    
                'units_extended' => false,
                'title'          => esc_html__( 'Mobile Height' , 'cryptronick' ),
                'height'         => true,
                'width'          => false,
                'default'        => array(
                    'height' => '100',
                ),
                'required' => array(
                    array( 'mobile_header', '=', '1' )
                ),
            ),
            array(
                'id'       => 'mobile_header_layout',
                'type'     => 'sorter',
                'title'    => esc_html__( 'Mobile Header Order', 'cryptronick' ),
                'desc'     => esc_html__( 'Organize the layout of the mobile header', 'cryptronick' ),
                'compiler' => 'true',
                'options'  => array(
                    'Items'  => array(
                        'html1' => esc_html__( 'HTML 1', 'cryptronick' ),
                        'html2'  =>  esc_html__( 'HTML 2', 'cryptronick' ),                        
                        'html3' => esc_html__( 'HTML 3', 'cryptronick' ),
                        'html4'  =>  esc_html__( 'HTML 4', 'cryptronick' ),                        
                        'html5' => esc_html__( 'HTML 5', 'cryptronick' ),
                        'html6'  =>  esc_html__( 'HTML 6', 'cryptronick' ),
                        'wpml'        =>  esc_html__( 'WPML', 'cryptronick' ),
                    ),
                    'Left align side' => array(
                        'menu' => esc_html__( 'Menu', 'cryptronick' ),
                    ),
                    'Center align side' => array(
                        'logo' => esc_html__( 'Logo', 'cryptronick' ),
                    ),
                    'Right align side' => array(
                        'item_search'  =>  esc_html__( 'Search', 'cryptronick' ),
                    ),
                ),
                'required' => array(
                    array( 'mobile_header', '=', '1' )
                ),
            ),
            array(
                'id'      => 'mobile_header_bar_html1_editor',
                'type'    => 'ace_editor',
                'mode'    => 'html',
                'title'   => esc_html__( 'HTML Element 1 Editor', 'cryptronick' ),
                'default' => '',
                'required' => array(
                    array( 'mobile_header', '=', '1' )
                ),
            ),
            array(
                'id'      => 'mobile_header_bar_html2_editor',
                'type'    => 'ace_editor',
                'mode'    => 'html',
                'title'   => esc_html__( 'HTML Element 2 Editor', 'cryptronick' ),
                'default' => '',
                'required' => array(
                    array( 'mobile_header', '=', '1' )
                ),
            ),              
            array(
                'id'      => 'mobile_header_bar_html3_editor',
                'type'    => 'ace_editor',
                'mode'    => 'html',
                'title'   => esc_html__( 'HTML Element 3 Editor', 'cryptronick' ),
                'default' => '',
                'required' => array(
                    array( 'mobile_header', '=', '1' )
                ),
            ),
            array(
                'id'      => 'mobile_header_bar_html4_editor',
                'type'    => 'ace_editor',
                'mode'    => 'html',
                'title'   => esc_html__( 'HTML Element 4 Editor', 'cryptronick' ),
                'default' => '',
                'required' => array(
                    array( 'mobile_header', '=', '1' )
                ),
            ),             
            array(
                'id'      => 'mobile_header_bar_html5_editor',
                'type'    => 'ace_editor',
                'mode'    => 'html',
                'title'   => esc_html__( 'HTML Element 5 Editor', 'cryptronick' ),
                'default' => '',
                'required' => array(
                    array( 'mobile_header', '=', '1' )
                ),
            ),
            array(
                'id'      => 'mobile_header_bar_html6_editor',
                'type'    => 'ace_editor',
                'mode'    => 'html',
                'title'   => esc_html__( 'HTML Element 6 Editor', 'cryptronick' ),
                'default' => '',
                'required' => array(
                    array( 'mobile_header', '=', '1' )
                ),
            ),  
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Page Title', 'cryptronick' ),
        'id'               => 'page_title',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'page_title_conditional',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Page Title', 'cryptronick' ),
                'default'  => true,
            ),
            array(
                'id'       => 'page_title-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Page Title Settings', 'cryptronick' ),
                'indent'   => true,
                'required' => array( 'page_title_conditional', '=', '1' ),
            ),
            array(
                'id'       => 'page_title_breadcrumbs_conditional',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Breadcrumbs', 'cryptronick' ),
                'default'  => true,
            ),
            array(
                'id'       => 'page_title_vert_align',
                'type'     => 'select',
                'title'    => esc_html__( 'Vertical Align', 'cryptronick' ),
                'options'  => array(
                    'top' => esc_html__( 'Top', 'cryptronick' ),
                    'middle' => esc_html__( 'Middle', 'cryptronick' ),
                    'bottom' => esc_html__( 'Bottom', 'cryptronick' )
                ),
                'default'  => 'middle'
            ),
            array(
                'id'       => 'page_title_horiz_align',
                'type'     => 'select',
                'title'    => esc_html__( 'Page Title Text Align?', 'cryptronick' ),
                'options'  => array(
                    'left' =>  esc_html__( 'Left', 'cryptronick' ),
                    'center' => esc_html__( 'Center', 'cryptronick' ),
                    'right' => esc_html__( 'Right', 'cryptronick' )
                ),
                'default'  => 'left'
            ),
            array(
                'id'       => 'page_title_font_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Page Title Font Color', 'cryptronick' ),
                'default'  => '#1b3452',
                'transparent' => false
            ),
            array(
                'id'       => 'page_title_bg_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Page Title Background Color', 'cryptronick' ),
                'default'  => '#f7f9fd',
                'transparent' => false
            ),
            array(
                'id'       => 'page_title_bg_image',
                'type'     => 'media',
                'title'    => esc_html__( 'Page Title Background Image', 'cryptronick' ),
            ),
            array(
                'id'       => 'page_title_bg_image',
                'type'     => 'background',
                'background-color' => false,
                'preview_media' => true,
                'preview' => false,
                'title'    => esc_html__( 'Page Title Background Image', 'cryptronick' ),
                'default'  => array(
                    'background-repeat' => 'repeat',
                    'background-size' => 'cover',
                    'background-attachment' => 'scroll',
                    'background-position' => 'center center',
                    'background-color' => '#1e73be',
                )
            ),
            array(
                'id'             => 'page_title_height',
                'type'           => 'dimensions',
                'units'          => false, 
                'units_extended' => false,
                'title'          => esc_html__( 'Page Title Height', 'cryptronick' ),
                'height'         => true,
                'width'          => false,
                'default'        => array(
                    'height' => 50,
                )
            ),
            array(
                'id'       => 'page_title_padding',
                'type'     => 'spacing',
                // An array of CSS selectors to apply this font style to
                'mode'     => 'padding',
                'all'      => false,
                'bottom'   => true,
                'top'   => true,
                'left'   => false,
                'right'   => false,
                'title'    => esc_html__( 'Page Title Padding', 'cryptronick' ),
                'default'  => array(
                    'padding-bottom' => '0px',
                    'padding-top' => '0px',              
                )
            ),
            array(
                'id'       => 'page_title_bottom_margin',
                'type'     => 'spacing',
                // An array of CSS selectors to apply this font style to
                'mode'     => 'margin',
                'all'      => false,
                'bottom'   => true,
                'top'   => false,
                'left'   => false,
                'right'   => false,
                'title'    => esc_html__( 'Page Title Bottom Margin', 'cryptronick' ),
                'default'  => array(
                    'margin-bottom' => '80',          
                )
            ),
            array(
                'id'     => 'page_title-end',
                'type'   => 'section',
                'indent' => false, 
                'required' => array( 'page_title_conditional', '=', '1' ),
            ),
            
        )
    ) );

    // -> START Footer Options
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__('Footer', 'cryptronick' ),
        'id'               => 'footer-option',
        'customizer_width' => '400px',
        'icon' => 'el-icon-screen',
        'fields'           => array(
            array(
                'id'       => 'footer_full_width',
                'type'     => 'switch',
                'title'    => esc_html__( 'Full Width Footer', 'cryptronick' ),
                'default'  => false,
            ),
            array(
                'id'       => 'footer_add_wave',
                'type'     => 'switch',
                'title'    => esc_html__( 'Add Wave', 'cryptronick' ),
                'default'  => false,
            ),           
            array(
                'id'             => 'footer_wave_height',
                'type'           => 'dimensions',
                'units'          => false,    
                'units_extended' => false,
                'title'          => esc_html__( 'Set Wave Height' , 'cryptronick' ),
                'height'         => true,
                'width'          => false,
                'default'        => array(
                    'height' => 250,
                ),
                'required' => array( 'footer_add_wave', '=', '1' ),
            ), 
            array(
                'id'       => 'footer_bg_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Footer Background Color', 'cryptronick' ),
                'default'  => '#272727',
                'transparent' => false
            ),
            array(
                'id'       => 'footer_text_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Footer Text color', 'cryptronick' ),
                'default'  => '#ffffff',
                'transparent' => false
            ),
            array(
                'id'       => 'footer_heading_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Footer Heading color', 'cryptronick' ),
                'default'  => '#ffffff',
                'transparent' => false
            ),
            array(
                'id'       => 'footer_bg_image',
                'type'     => 'background',
                'background-color' => false,
                'preview_media' => true,
                'preview' => false,
                'title'    => esc_html__( 'Footer Background Image', 'cryptronick' ),
                'default'  => array(
                    'background-repeat' => 'repeat',
                    'background-size' => 'cover',
                    'background-attachment' => 'scroll',
                    'background-position' => 'center center',
                )
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Footer Content', 'cryptronick' ),
        'id'               => 'footer_content',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'footer_switch',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Footer', 'cryptronick' ),
                'default'  => true,
            ),
            array(
                'id'       => 'footer-start',
                'type'     => 'section',
                'title'    => esc_html__( 'Footer Settings', 'cryptronick' ),
                'indent'   => true,
                'required' => array( 'footer_switch', '=', '1' ),
            ),
            array(
                'id'       => 'footer_content_type',
                'type'     => 'select',
                'title'    => esc_html__( 'Footer Content Type', 'cryptronick' ),
                'options'  => array(
                    'widgets' => 'Get Widgets',
                    'pages' => 'Get Pages'
                ),
                'default'  => 'widgets'
            ),
            array(
                'id'       => 'footer_page_select',
                'type'     => 'select',
                'title'    => esc_html__( 'Footer Page Select', 'cryptronick' ),
                'data'     => 'pages',
                'required' => array( 'footer_content_type', '=', 'pages' )
            ),
            array(
                'id'       => 'footer_column',
                'type'     => 'select',
                'title'    => esc_html__( 'Footer Column', 'cryptronick' ),
                'options'  => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                    '4' => '4'
                ),
                'default'  => '4',
                'required' => array( 'footer_content_type', '=', 'widgets' )
            ),
            array(
                'id'       => 'footer_column2',
                'type'     => 'select',
                'title'    => esc_html__( 'Footer Column Layout', 'cryptronick' ),
                'options'  => array(
                    '6-6' => '50% / 50%',
                    '3-9' => '25% / 75%',
                    '9-3' => '25% / 75%',
                    '4-8' => '33% / 66%',
                    '8-3' => '66% / 33%',
                ),
                'default'  => '6-6',
                'required' => array( 'footer_column', '=', '2' ),
            ),
            array(
                'id'       => 'footer_column3',
                'type'     => 'select',
                'title'    => esc_html__( 'Footer Column Layout', 'cryptronick' ),
                'options'  => array(
                    '4-4-4' => '33% / 33% / 33%',
                    '3-3-6' => '25% / 25% / 50%',
                    '3-6-3' => '25% / 50% / 25%',
                    '6-3-3' => '50% / 25% / 25%',
                ),
                'default'  => '4-4-4',
                'required' => array( 'footer_column', '=', '3' ),
            ),
            array(
                'id'       => 'footer_align',
                'type'     => 'select',
                'title'    => esc_html__( 'Footer Title Text Align', 'cryptronick' ),
                'options'  => array(
                    'left' => esc_html__( 'Left', 'cryptronick' ),
                    'center' => esc_html__( 'Center', 'cryptronick' ),
                    'right' => esc_html__( 'Right', 'cryptronick' ),
                ),
                'default'  => 'center',
                'required' => array( 'footer_content_type', '=', 'widgets' )
            ),
            array(
                'id'       => 'footer_spacing',
                'type'     => 'spacing',
                'output'   => array( '.bpt-footer' ),
                // An array of CSS selectors to apply this font style to
                'mode'     => 'padding',
                'units'    => 'px',
                'all'      => false,
                'title'    => esc_html__( 'Footer Padding (px)', 'cryptronick' ),
                'default'  => array(
                    'padding-top'    => '70px',
                    'padding-right'  => '0px',
                    'padding-bottom' => '70px',
                    'padding-left'   => '0px'
                )
            ),
            array(
                'id'     => 'footer-end',
                'type'   => 'section',
                'indent' => false, 
                'required' => array( 'footer_switch', '=', '1' ),
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Copyright', 'cryptronick' ),
        'id'               => 'copyright',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'copyright_switch',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Copyright', 'cryptronick' ),
                'default'  => true,
            ),
            array(
                'id'      => 'copyright_editor',
                'type'    => 'editor',
                'title'   => esc_html__( 'Copyright Editor', 'cryptronick' ),
                'default' => '<p>© 2018 Cryptronick. All rights reserved.</p>',
                'args'    => array(
                    'wpautop'       => false,
                    'media_buttons' => false,
                    'textarea_rows' => 2,
                    'teeny'         => false,
                    'quicktags'     => true,
                ),
                'required' => array( 'copyright_switch', '=', '1' ),
            ),
            array(
                'id'       => 'copyright_align',
                'type'     => 'select',
                'title'    => esc_html__( 'Copyright Title Text Align', 'cryptronick' ),
                'options'  => array(
                    'left' => esc_html__( 'Left', 'cryptronick' ),
                    'center' => esc_html__( 'Center', 'cryptronick' ),
                    'right' => esc_html__( 'Right', 'cryptronick' ),
                ),
                'default'  => 'center',
                'required' => array( 'copyright_switch', '=', '1' ),
            ),
            array(
                'id'       => 'copyright_spacing',
                'type'     => 'spacing',
                'mode'     => 'padding',
                'all'      => false,
                'title'    => esc_html__( 'Copyright Padding (px)', 'cryptronick' ),
                'default'  => array(
                    'padding-top'    => '10',
                    'padding-right'  => '0px',
                    'padding-bottom' => '10',
                    'padding-left'   => '0px'
                ),
                'required' => array( 'copyright_switch', '=', '1' ),
            ),
            array(
                'id'       => 'copyright_bg_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Copyright Background Color', 'cryptronick' ),
                'default'  => '#001a3d',
                'transparent' => true,
                'required' => array( 'copyright_switch', '=', '1' ),
            ),
            array(
                'id'       => 'copyright_text_color',
                'type'     => 'color',
                'title'    => esc_html__( 'Copyright Text Color', 'cryptronick' ),
                'default'  => '#667794',
                'transparent' => false,
                'required' => array( 'copyright_switch', '=', '1' ),
            ),
            array(
                'id'       => 'copyright_top_border',
                'type'     => 'switch',
                'title'    => esc_html__( 'Set Copyright Top Border', 'cryptronick' ),
                'default'  => true,
                'required' => array( 'copyright_switch', '=', '1' ),
            ),
            array(
                'id'       => 'copyright_top_border_color',
                'type'     => 'color_rgba',
                'title'    => esc_html__( 'Copyright Border Color', 'cryptronick' ),
                'default'  => array(
                    'color' => '#525252',
                    'alpha' => '1',
                    'rgba'  => 'rgba(82, 82, 82, 1)'
                ),
                'mode'     => 'background',
                'required' => array(
                    array( 'copyright_top_border', '=', '1' ),
                    array( 'copyright_switch', '=', '1' )
                ), 
            ),
        )
    ));

    // -> START Blog Options
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__('Blog', 'cryptronick' ),
        'id'               => 'blog-option',
        'customizer_width' => '400px',
        'icon' => 'el-icon-th-list',
        'fields'           => array(
            array(
                'id'       => 'blog_title_conditional',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Blog Post Title', 'cryptronick' ),
                'default'  => true,
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Archive', 'cryptronick' ),
        'id'               => 'blog-list-option',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'blog_list_sidebar_layout',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Blog Archive Sidebar Layout', 'cryptronick' ),
                'options'  => array(
                    'none' => array(
                        'alt' => 'None',
                        'img' => esc_url(ReduxFramework::$_url) . 'assets/img/1col.png'
                    ),
                    'left' => array(
                        'alt' => 'Left',
                        'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cl.png'
                    ),
                    'right' => array(
                        'alt' => 'Right',
                        'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cr.png'
                    )
                ),
                'default'  => 'none'
            ),
            array(
                'id'       => 'blog_list_sidebar_def',
                'type'     => 'select',
                'title'    => esc_html__( 'Blog Archive Sidebar', 'cryptronick' ),
                'data'     => 'sidebars',
                'required' => array( 'blog_list_sidebar_layout', '!=', 'none' ),
            ),
            array(
                'id'       => 'blog_list_sidebar_def_width',
                'type'     => 'select',
                'title'    => esc_html__( 'Blog Archive Sidebar Width', 'cryptronick' ),
                'options'  => array(
                    '8' => '33.333%',
                    '9' => '25%',
                ),
                'default'  => '8',
                'required' => array( 'blog_list_sidebar_layout', '!=', 'none' ),
            ),
            array(
                'id'       => 'blog_list_columns',
                'type'     => 'button_set',
                'title'    => __('Columns in Archive', 'cryptronick'),
                'options' => array(
                    '12' => 'One', 
                    '6' => 'Two', 
                    '4' => 'Three',
                    '3' => 'Four'
                 ), 
                'default' => '12'
            ),
            array(
                'id'       => 'blog_list_likes',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Likes?', 'cryptronick' ),
                'default'  => false,
            ),            
            array(
                'id'       => 'blog_list_share',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Share?', 'cryptronick' ),
                'default'  => false,
            ),
            array(
                'id'       => 'blog_list_hide_media',
                'type'     => 'switch',
                'title'    => esc_html__( 'Hide Media?', 'cryptronick' ),
                'default'  => false,
            ),
            array(
                'id'       => 'blog_list_hide_title',
                'type'     => 'switch',
                'title'    => esc_html__( 'Hide Title?', 'cryptronick' ),
                'default'  => false,
            ),
            array(
                'id'       => 'blog_list_hide_content',
                'type'     => 'switch',
                'title'    => esc_html__( 'Hide Content?', 'cryptronick' ),
                'default'  => false,
            ),
            array(
                'id'       => 'blog_post_listing_content',
                'type'     => 'switch',
                'title'    => esc_html__( 'Cut Off Text in Blog Listing', 'cryptronick' ),
                'default'  => false,
            ),
            array(
                'id'       => 'blog_list_letter_count',
                'type'     => 'text',
                'title'    => esc_html__('Number of character to show after trim.', 'cryptronick'),
                'default'  => '85',
                'required' => array( 'blog_post_listing_content', '=', true ),
            ),
            array(
                'id'       => 'blog_list_read_more',
                'type'     => 'switch',
                'title'    => esc_html__( 'Hide Read More Button?', 'cryptronick' ),
                'default'  => true,
            ),
            array(
                'id' => 'blog_list_meta',
                'type'     => 'switch',
                'title'    => esc_html__( 'Hide all post-meta?', 'cryptronick' ),
                'default'  => false,
            ),
            array(
                'id'       => 'blog_list_meta_author',
                'type'     => 'switch',
                'title'    => esc_html__( 'Hide post-meta author?', 'cryptronick' ),
                'default'  => true,
                'required' => array( 'blog_list_meta', '=', false ),
            ),
            array(
                'id'       => 'blog_list_meta_comments',
                'type'     => 'switch',
                'title'    => esc_html__( 'Hide post-meta comments?', 'cryptronick' ),
                'default'  => false,
                'required' => array( 'blog_list_meta', '=', false ),
            ),
            array(
                'id'       => 'blog_list_meta_categories',
                'type'     => 'switch',
                'title'    => esc_html__( 'Hide post-meta categories?', 'cryptronick' ),
                'default'  => false,
                'required' => array( 'blog_list_meta', '=', false ),
            ),
            array(
                'id'       => 'blog_list_meta_date',
                'type'     => 'switch',
                'title'    => esc_html__( 'Hide post-meta date?', 'cryptronick' ),
                'default'  => false,
                'required' => array( 'blog_list_meta', '=', false ),
            ),
            
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Single', 'cryptronick' ),
        'id'               => 'blog-single-option',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'single_sidebar_layout',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Blog Single Sidebar Layout', 'cryptronick' ),
                'options'  => array(
                    'none' => array(
                        'alt' => 'None',
                        'img' => esc_url(ReduxFramework::$_url) . 'assets/img/1col.png'
                    ),
                    'left' => array(
                        'alt' => 'Left',
                        'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cl.png'
                    ),
                    'right' => array(
                        'alt' => 'Right',
                        'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cr.png'
                    )
                ),
                'default'  => 'none'
            ),
            array(
                'id'       => 'single_sidebar_def',
                'type'     => 'select',
                'title'    => esc_html__( 'Blog Single Sidebar', 'cryptronick' ),
                'data'     => 'sidebars',
                'required' => array( 'single_sidebar_layout', '!=', 'none' ),
            ),  
            array(
                'id'       => 'single_sidebar_column',
                'type'     => 'select',
                'title'    => esc_html__( 'Blog Single Sidebar Width', 'cryptronick' ),
                'options'  => array(
                    '8' => '33.333%',
                    '9' => '25%',
                ),
                'default'  => '8',
                'required' => array( 'single_sidebar_layout', '!=', 'none' ),
            ),
            array(
                'id'       => 'single_related_posts',
                'type'     => 'switch',
                'title'    => esc_html__( 'Related Posts', 'cryptronick' ),
                'default'  => true,
            ),
            array(
                'id'       => 'single_likes',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Likes?', 'cryptronick' ),
                'default'  => false,
            ),
            array(
                'id'       => 'single_share',
                'type'     => 'switch',
                'title'    => esc_html__( 'Share on Single Post?', 'cryptronick' ),
                'default'  => false,
            ),
            array(
                'id'       => 'single_author_info',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Author Info?', 'cryptronick' ),
                'default'  => true,
            ),
            array(
                'id' => 'single_meta',
                'type'     => 'switch',
                'title'    => esc_html__( 'Hide all post-meta?', 'cryptronick' ),
                'default'  => false,
            ),
            array(
                'id'       => 'single_meta_author',
                'type'     => 'switch',
                'title'    => esc_html__( 'Hide post-meta author?', 'cryptronick' ),
                'default'  => false,
                'required' => array( 'single_meta', '=', false ),
            ),
            array(
                'id'       => 'single_meta_comments',
                'type'     => 'switch',
                'title'    => esc_html__( 'Hide post-meta comments?', 'cryptronick' ),
                'default'  => false,
                'required' => array( 'single_meta', '=', false ),
            ),
            array(
                'id'       => 'single_meta_categories',
                'type'     => 'switch',
                'title'    => esc_html__( 'Hide post-meta categories?', 'cryptronick' ),
                'default'  => false,
                'required' => array( 'single_meta', '=', false ),
            ),
            array(
                'id'       => 'single_meta_date',
                'type'     => 'switch',
                'title'    => esc_html__( 'Hide post-meta date?', 'cryptronick' ),
                'default'  => false,
                'required' => array( 'single_meta', '=', false ),
            ),
            
        )
    ) );     
    
    // -> START Portfolio Options
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__('Portfolio', 'cryptronick' ),
        'id'               => 'portfolio-option',
        'customizer_width' => '400px',
        'icon' => 'el-icon-th-list',
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Archive', 'cryptronick' ),
        'id'               => 'portfolio-list-option',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'portfolio_list_sidebar_layout',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Portfolio Archive Sidebar Layout', 'cryptronick' ),
                'options'  => array(
                    'none' => array(
                        'alt' => 'None',
                        'img' => esc_url(ReduxFramework::$_url) . 'assets/img/1col.png'
                    ),
                    'left' => array(
                        'alt' => 'Left',
                        'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cl.png'
                    ),
                    'right' => array(
                        'alt' => 'Right',
                        'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cr.png'
                    )
                ),
                'default'  => 'none'
            ),
            array(
                'id'       => 'portfolio_list_sidebar_def',
                'type'     => 'select',
                'title'    => esc_html__( 'Portfolio Archive Sidebar', 'cryptronick' ),
                'data'     => 'sidebars',
                'required' => array( 'portfolio_list_sidebar_layout', '!=', 'none' ),
            ),
            array(
                'id'       => 'portfolio_list_columns',
                'type'     => 'button_set',
                'title'    => __('Columns in Archive', 'cryptronick'),
                'options' => array(
                    '1' => 'One', 
                    '2' => 'Two', 
                    '3' => 'Three',
                    '4' => 'Four'
                 ), 
                'default' => '4'
            ),
            array(
                'id'       => 'portfolio_slug',
                'type'     => 'text',
                'title'    => esc_html__( 'Portfolio Slug', 'cryptronick' ),
                'default'  => 'portfolio',
            ),  
            array(
                'id'       => 'portfolio_list_show_filter',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Filter?', 'cryptronick' ),
                'default'  => false,
            ),  

            array(
                'id'    => 'portfolio_list_filter_cats',
                'type'  => 'select',
                'multi'    => true,
                'title' => __( 'Select Categories', 'cryptronick' ), 
                'data'  => 'terms',
                'args' => array('taxonomies'=>'portfolio-category'),
                'required' => array( 'portfolio_list_show_filter', '=', '1' ),
            ),

            array(
                'id'       => 'portfolio_list_show_title',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Title?', 'cryptronick' ),
                'default'  => false,
            ),
            array(
                'id'       => 'portfolio_list_show_content',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Content?', 'cryptronick' ),
                'default'  => false,
            ),            
            array(
                'id'       => 'portfolio_list_show_cat',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Categories?', 'cryptronick' ),
                'default'  => false,
            ),           
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__( 'Single', 'cryptronick' ),
        'id'               => 'portfolio-single-option',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'       => 'portfolio_single_sidebar_layout',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Portfolio Single Sidebar Layout', 'cryptronick' ),
                'options'  => array(
                    'none' => array(
                        'alt' => 'None',
                        'img' => esc_url(ReduxFramework::$_url) . 'assets/img/1col.png'
                    ),
                    'left' => array(
                        'alt' => 'Left',
                        'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cl.png'
                    ),
                    'right' => array(
                        'alt' => 'Right',
                        'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cr.png'
                    )
                ),
                'default'  => 'none'
            ),
            array(
                'id'       => 'portfolio_single_sidebar_def',
                'type'     => 'select',
                'title'    => esc_html__( 'Portfolio Single Sidebar', 'cryptronick' ),
                'data'     => 'sidebars',
                'required' => array( 'portfolio_single_sidebar_layout', '!=', 'none' ),
            ),  
            array(
                'id'       => 'portfolio_single_related_posts',
                'type'     => 'switch',
                'title'    => esc_html__( 'Related Posts', 'cryptronick' ),
                'default'  => true,
            ),           
            array(
                'id'       => 'portfolio_above_content_cats',
                'type'     => 'switch',
                'title'    => esc_html__( 'Shaw Tags', 'cryptronick' ),
                'default'  => true,
            ),           
            array(
                'id'       => 'portfolio_above_content_share',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show Share', 'cryptronick' ),
                'default'  => true,
            ),
            array(
                'id'       => 'portfolio_single_meta_likes',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show post-meta likes?', 'cryptronick' ),
                'default'  => true,
            ),
            array(
                'id' => 'portfolio_single_meta',
                'type'     => 'switch',
                'title'    => esc_html__( 'Hide all post-meta?', 'cryptronick' ),
                'default'  => true,
            ),
            array(
                'id'       => 'portfolio_single_meta_author',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show post-meta author?', 'cryptronick' ),
                'default'  => true,
                'required' => array( 'portfolio_single_meta', '=', false ),
            ),
            array(
                'id'       => 'portfolio_single_meta_comments',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show post-meta comments?', 'cryptronick' ),
                'default'  => true,
                'required' => array( 'portfolio_single_meta', '=', false ),
            ),
            array(
                'id'       => 'portfolio_single_meta_categories',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show post-meta categories?', 'cryptronick' ),
                'default'  => true,
                'required' => array( 'portfolio_single_meta', '=', false ),
            ),
            array(
                'id'       => 'portfolio_single_meta_date',
                'type'     => 'switch',
                'title'    => esc_html__( 'Show post-meta date?', 'cryptronick' ),
                'default'  => true,
                'required' => array( 'portfolio_single_meta', '=', false ),
            ),
        )
    ) );   

    // -> START Team Options
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__('Team', 'cryptronick' ),
        'id'               => 'team-option',
        'customizer_width' => '400px',
        'icon' => 'el-icon-th-list',
        'fields'           => array(
            array(
                'id'       => 'team_slug',
                'type'     => 'text',
                'title'    => esc_html__( 'Team Slug', 'cryptronick' ),
                'default'  => 'team',
            ),           
        )
    ) ); 

    // -> START Layout Options
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__('Sidebars', 'cryptronick' ),
        'id'               => 'layout_options',
        'customizer_width' => '400px',
        'icon' => 'el el-website',
        'fields'           => array(
            array(
                'id'       => 'page_sidebar_layout',
                'type'     => 'image_select',
                'title'    => esc_html__( 'Page Sidebar Layout', 'cryptronick' ),
                'options'  => array(
                    'none' => array(
                        'alt' => 'None',
                        'img' => esc_url(ReduxFramework::$_url) . 'assets/img/1col.png'
                    ),
                    'left' => array(
                        'alt' => 'Left',
                        'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cl.png'
                    ),
                    'right' => array(
                        'alt' => 'Right',
                        'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cr.png'
                    )
                ),
                'default'  => 'none'
            ),
            array(
                'id'       => 'page_sidebar_def',
                'type'     => 'select',
                'title'    => esc_html__( 'Page Sidebar', 'cryptronick' ),
                'data'     => 'sidebars',
                'required' => array( 'page_sidebar_layout', '!=', 'none' ),
            ),          
            array(
                'id'       => 'page_sidebar_def_width',
                'type'     => 'select',
                'title'    => esc_html__( 'Page Sidebar Width', 'cryptronick' ),
                'options'  => array(
                    '8' => '33.333%',
                    '9' => '25%',
                ),
                'default'  => '8',
                'required' => array( 'page_sidebar_layout', '!=', 'none' ),
            ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__('Sidebar Generator', 'cryptronick' ),
        'id'               => 'sidebars_generator_section',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'=>'sidebars', 
                'type' => 'multi_text',
                'validate' => 'no_html',
                'add_text' => esc_html__('Add Sidebar', 'cryptronick' ),
                'title' => esc_html__('Sidebar Generator', 'cryptronick' ),
                'default' => array('Main Sidebar'),
            ),
        )
    ) );   


    // -> START Styling Options
    Redux::setSection( $opt_name, array(
        'title'            => esc_html__('Color Options', 'cryptronick' ),
        'id'               => 'color_options',
        'customizer_width' => '400px',
        'icon' => 'el-icon-brush'
    ) );

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__('Colors', 'cryptronick' ),
        'id'               => 'color_options_color',
        'subsection'       => true,
        'customizer_width' => '450px',
        'fields'           => array(
            array(
                'id'        => 'theme-custom-color',
                'type'      => 'color',
                'title'     => esc_html__('General Theme Color', 'cryptronick' ),
                'transparent' => false,
                'default'   => '#14c7ff',
                'validate'  => 'color',
            ),
            array(
                'id'       => 'use-gradient',
                'type'     => 'switch',
                'title'    => esc_html__( 'Use Theme Gradient?', 'cryptronick' ),
                'default'  => true,
            ),
            array(
                'id'        => 'theme-gradient',
                'type'      => 'color_gradient',
                'title'     => esc_html__('Theme Gradient', 'cryptronick' ),
                'validate' => 'color',
                'default'  => array(
                    'from' => '#0c63ff',
                    'to'   => '#10e0e8', 
                ),
                'required' => array( 'use-gradient', '=', '1' ),
            ),
            array(
                'id'        => 'body-background-color',
                'type'      => 'color',
                'title'     => esc_html__('Body Background Color', 'cryptronick' ),
                'transparent' => false,
                'default'   => '#ffffff',
                'validate'  => 'color',
            ),
        )
    ));

    Redux::setSection( $opt_name, array(
        'title'            => esc_html__('Typography', 'cryptronick' ),
        'id'               => 'typography_options',
        'customizer_width' => '400px',
        'icon' => 'el-icon-font',
        'fields'           => array(
            array(
                'id'          => 'menu-font',
                'type'        => 'typography',
                'title'       => esc_html__( 'Menu Font', 'cryptronick' ),
                'google' => true,
                'font-style'    => true,
                'color' => false,
                'line-height' => true,
                'font-size' => true,
                'font-backup' => false,
                'text-align' => false,
                'all_styles'  => true,
                'default'     => array(
                    'font-family' => 'Rubik',
                    'google'      => true,
                    'font-size'   => '16px',
                    'font-weight' => '400',
                    'line-height' => '20px'
                ),
            ),

            array(
                'id' => 'main-font',
                'type' => 'typography',
                'title' => esc_html__('Main Font', 'cryptronick' ),
                'google' => true,
                'font-backup' => false,
                'font-size' => true,
                'line-height' => true,
                'color' => true,
                'word-spacing' => false,
                'letter-spacing' => false,
                'text-align' => false,
                'all_styles'  => true,
                'default' => array(
                    'font-size' => '16px',
                    'line-height' => '24px',
                    'color' => '#57616b',
                    'google' => true,
                    'font-family' => 'Rubik',
                    'font-weight' => '300',
                ),
            ),
            array(
                'id' => 'header-font',
                'type' => 'typography',
                'title' => esc_html__('Headers Font', 'cryptronick' ),
                'google' => true,
                'font-backup' => false,
                'font-size' => false,
                'line-height' => false,
                'color' => true,
                'subsets' => false,
                'word-spacing' => false,
                'letter-spacing' => false,
                'text-align' => false,
                'all_styles'  => true,
                'text-transform' => false,
                'default' => array(
                    'color' => '#1b3452',
                    'google' => true,
                    'font-family' => 'Rubik',
                    'font-weight' => '400',
                ),
            ),
            array(
                'id' => 'h1-font',
                'type' => 'typography',
                'title' => esc_html__('H1', 'cryptronick' ),
                'google' => true,
                'font-backup' => false,
                'font-size' => true,
                'line-height' => true,
                'color' => false,
                'word-spacing' => false,
                'letter-spacing' => false,
                'text-align' => false,
                'text-transform' => false,
                'default' => array(
                    'font-family' => 'Rubik',
                    'font-size' => '48px',
                    'font-weight' => '400',
                    'line-height' => '44px',
                    'google' => true,
                ),
            ),
            array(
                'id' => 'h2-font',
                'type' => 'typography',
                'title' => esc_html__('H2', 'cryptronick' ),
                'google' => true,
                'font-backup' => false,
                'font-size' => true,
                'line-height' => true,
                'color' => false,
                'word-spacing' => false,
                'letter-spacing' => false,
                'text-align' => false,
                'text-transform' => false,
                'default' => array(
                    'font-family' => 'Rubik',
                    'font-weight' => '400',
                    'font-size' => '36px',
                    'line-height' => '48px',
                    'google' => true,
                ),
            ),
            array(
                'id' => 'h3-font',
                'type' => 'typography',
                'title' => esc_html__('H3', 'cryptronick' ),
                'google' => true,
                'font-backup' => false,
                'font-size' => true,
                'line-height' => true,
                'color' => false,
                'word-spacing' => false,
                'letter-spacing' => false,
                'text-align' => false,
                'text-transform' => false,
                'default' => array(
                    'font-family' => 'Rubik',
                    'font-weight' => '400',
                    'font-size' => '30px',
                    'line-height' => '42px',
                    'google' => true,
                ),
            ),
            array(
                'id' => 'h4-font',
                'type' => 'typography',
                'title' => esc_html__('H4', 'cryptronick' ),
                'google' => true,
                'font-backup' => false,
                'font-size' => true,
                'line-height' => true,
                'color' => false,
                'word-spacing' => false,
                'letter-spacing' => false,
                'text-align' => false,
                'text-transform' => false,
                'default' => array(
                    'font-family' => 'Rubik',
                    'font-weight' => '400',
                    'font-size' => '24px',
                    'line-height' => '36px',
                    'google' => true,
                ),
            ),
            array(
                'id' => 'h5-font',
                'type' => 'typography',
                'title' => esc_html__('H5', 'cryptronick' ),
                'google' => true,
                'font-backup' => false,
                'font-size' => true,
                'line-height' => true,
                'color' => false,
                'word-spacing' => false,
                'letter-spacing' => false,
                'text-align' => false,
                'text-transform' => false,
                'default' => array(
                    'font-size' => '18px',
                    'line-height' => '26px',
                    'google' => true,
                    'font-family' => 'Rubik',
                    'font-weight' => '500'
                ),
            ),
            array(
                'id' => 'h6-font',
                'type' => 'typography',
                'title' => esc_html__('H6', 'cryptronick' ),
                'google' => true,
                'font-backup' => false,
                'font-size' => true,
                'line-height' => true,
                'color' => false,
                'word-spacing' => false,
                'letter-spacing' => true,
                'text-align' => false,
                'text-transform' => true,
                'default' => array(
                    'font-size' => '14px',
                    'line-height' => '24px',
                    'google' => true,
                    'font-family' => 'Rubik',
                    'font-weight' => '500',
                    'text-transform' => 'uppercase',
                ),
            ),
        )
    ) );

    if ( class_exists( 'WooCommerce' ) )  {
        Redux::setSection( $opt_name, array(
            'title'            => esc_html__('Shop', 'cryptronick' ),
            'id'               => 'shop-option',
            'customizer_width' => '400px',
            'icon' => 'el-icon-shopping-cart',
            'fields'           => array(
                array(
                    'id'       => 'shop_catalog_sidebar_layout',
                    'type'     => 'image_select',
                    'title'    => esc_html__( 'Shop Catalog Sidebar Layout', 'cryptronick' ),
                    'options'  => array(
                        'none' => array(
                            'alt' => 'None',
                            'img' => esc_url(ReduxFramework::$_url) . 'assets/img/1col.png'
                        ),
                        'left' => array(
                            'alt' => 'Left',
                            'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cl.png'
                        ),
                        'right' => array(
                            'alt' => 'Right',
                            'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cr.png'
                        )
                    ),
                    'default'  => 'right'
                ),
                array(
                    'id'       => 'shop_catalog_sidebar_def',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Shop Catalog Sidebar', 'cryptronick' ),
                    'data'     => 'sidebars',
                    'required' => array( 'shop_catalog_sidebar_layout', '!=', 'none' ),
                ),  
                array(
                    'id'       => 'shop_catalog_sidebar_def_width',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Shop Sidebar Width', 'cryptronick' ),
                    'options'  => array(
                        '8' => '33.333%',
                        '9' => '25%',
                    ),
                    'default'  => '8',
                    'required' => array( 'shop_catalog_sidebar_layout', '!=', 'none' ),
                ),               
                array(
                    'id'       => 'shop_single_sidebar_layout',
                    'type'     => 'image_select',
                    'title'    => esc_html__( 'Shop Single Sidebar Layout', 'cryptronick' ),
                    'options'  => array(
                        'none' => array(
                            'alt' => 'None',
                            'img' => esc_url(ReduxFramework::$_url) . 'assets/img/1col.png'
                        ),
                        'left' => array(
                            'alt' => 'Left',
                            'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cl.png'
                        ),
                        'right' => array(
                            'alt' => 'Right',
                            'img' => esc_url(ReduxFramework::$_url) . 'assets/img/2cr.png'
                        )
                    ),
                    'default'  => 'right'
                ),
                array(
                    'id'       => 'shop_single_sidebar_def',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Shop Single Sidebar', 'cryptronick' ),
                    'data'     => 'sidebars',
                    'required' => array( 'shop_single_sidebar_layout', '!=', 'none' ),
                ),  
                array(
                    'id'       => 'shop_single_sidebar_def_width',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Shop Single Sidebar Width', 'cryptronick' ),
                    'options'  => array(
                        '8' => '33.333%',
                        '9' => '25%',
                    ),
                    'default'  => '8',
                    'required' => array( 'shop_single_sidebar_layout', '!=', 'none' ),
                ),
                array(
                    'id'       => 'shop_column',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Shop Column', 'cryptronick' ),
                    'options'  => array(
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4'
                    ),
                    'default'  => '3',
                ),
                array(
                    'id'       => 'shop_products_per_page',
                    'type'     => 'text',
                    'title'    => esc_html__('Products per page', 'cryptronick'),
                    'default'  => '10',
                ),  
                array(
                    'id'       => 'shop_related_columns',
                    'type'     => 'select',
                    'title'    => esc_html__( 'Related products column', 'cryptronick' ),
                    'options'  => array(
                        '1' => '1',
                        '2' => '2',
                        '3' => '3',
                        '4' => '4'
                    ),
                    'default'  => '4',
                ),              
                array(
                    'id'       => 'shop_r_products_per_page',
                    'type'     => 'text',
                    'title'    => esc_html__('Related products per page', 'cryptronick'),
                    'default'  => '4',
                ),
            )
        ) );
    }

