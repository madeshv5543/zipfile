<?php

if ( !class_exists('Vc_Manager') ) return;
if ( !class_exists('bpt_cryptronick_core') ) return;

if(!class_exists('Bpt_vc_register')){
    class Bpt_vc_register{
        function __construct (){
            $this->vc_setup_options();
            $this->custom_fields();
            $this->register_modules();
            $this->params_remove();
            $this->add_params();
        }

        function custom_fields () {
            require_once get_template_directory() . '/core/vc/custom_types/image_select.php';
            require_once get_template_directory() . '/core/vc/custom_types/multi_select.php';
            require_once get_template_directory() . '/core/vc/custom_types/checkbox_custom.php';
            require_once get_template_directory() . '/core/vc/custom_types/heading_line.php';
        }

        function register_modules () {
            $cryptronick_vc_modules = array(
                'bpt_counter',
                'bpt_blog_posts',
                'bpt_carousel',
                'bpt_team',
                'bpt_testimonials',
                'bpt_info_box',
                'bpt_flip_box',
                'bpt_image_layers',
                'bpt_pricing_table',
                'bpt_message_box',
                'bpt_button',
                'bpt_double_headings',
                'bpt_custom_text',
                'bpt_countdown',
                'bpt_video_popup',
                'bpt_spacing',
                'bpt_clients',
                'bpt_demo_item',
                'bpt_earth',
                'bpt_soc_icons',
                'bpt_time_line_vertical',
                'bpt_time_line_horizontal',
                'bpt_coins_list',
                'bpt_ico_progress',
                'bpt_ico_progress_bar',
                'bpt_image_particles'
            );

            foreach ($cryptronick_vc_modules as $cryptronick_vc_module) {
                require_once get_template_directory() . '/core/vc/modules/' . $cryptronick_vc_module . '.php';
            }
        }

        function vc_setup_options () {

            add_action('vc_before_init', 'cryptronick_vcSetAsTheme');
            function cryptronick_vcSetAsTheme() {
                vc_set_as_theme($disable_updater = true);
            }

            $cryptronick_dir = get_template_directory() . '/core/vc/templates';
            vc_set_shortcodes_templates_dir( $cryptronick_dir );
        }

        function params_remove () {
            // Remove options from tabs
            vc_remove_param( 'vc_tta_tabs', 'style' );
            vc_remove_param( 'vc_tta_tabs', 'shape' );
            vc_remove_param( 'vc_tta_tabs', 'color' );
            vc_remove_param( 'vc_tta_tabs', 'spacing' );
            vc_remove_param( 'vc_tta_tabs', 'gap' );
            vc_remove_param( 'vc_tta_tabs', 'pagination_style' );
            vc_remove_param( 'vc_tta_tabs', 'pagination_color' );
            vc_remove_param( 'vc_tta_tabs', 'no_fill_content_area' );

            // Remove options from
            vc_remove_param( 'vc_tta_tour', 'style' );
            vc_remove_param( 'vc_tta_tour', 'shape' );
            vc_remove_param( 'vc_tta_tour', 'color' );
            vc_remove_param( 'vc_tta_tour', 'spacing' );
            vc_remove_param( 'vc_tta_tour', 'gap' );
            vc_remove_param( 'vc_tta_tour', 'pagination_style' );
            vc_remove_param( 'vc_tta_tour', 'pagination_color' );
            vc_remove_param( 'vc_tta_tour', 'no_fill_content_area' );

            // Remove options from accordion
            vc_remove_param( 'vc_tta_accordion', 'color' );
            vc_remove_param( 'vc_tta_accordion', 'spacing' );
            vc_remove_param( 'vc_tta_accordion', 'gap' );
            vc_remove_param( 'vc_tta_accordion', 'no_fill' );
            vc_remove_param( 'vc_tta_accordion', 'shape' );

            // Remove options from toogle
            vc_remove_param( 'vc_toggle', 'use_custom_heading' );
            vc_remove_param( 'vc_toggle', 'custom_font_container' );
            vc_remove_param( 'vc_toggle', 'custom_use_theme_fonts' );
            vc_remove_param( 'vc_toggle', 'custom_google_fonts' );
            vc_remove_param( 'vc_toggle', 'custom_css_animation' );
            vc_remove_param( 'vc_toggle', 'custom_el_class' );
        }

        function add_params () {
            // Add options to accordions
            vc_add_param( 'vc_tta_accordion' , array(
                'type' => 'dropdown',
                'heading' => 'Accordion Style',
                'param_name' => 'style',
                'value' => array(
                    esc_html__( 'Light', 'cryptronick' ) => 'light',
                    esc_html__( 'Dark', 'cryptronick' ) => 'dark',
                )
            ));

            // Add options to toggle
            vc_add_param( 'vc_toggle' , array(
                'type' => 'dropdown',
                'heading' => 'Style',
                'param_name' => 'style',
                'value' => array(
                    esc_html__( 'Light', 'cryptronick' ) => 'light',
                    esc_html__( 'Dark', 'cryptronick' ) => 'dark',
                )
            ));
            vc_add_param( 'vc_toggle' , array(
                'type' => 'dropdown',
                'heading' => 'Icon',
                'param_name' => 'color',
                'value' => array(
                    esc_html__( 'None', 'cryptronick' ) => 'none',
                    esc_html__( 'Chevron', 'cryptronick' ) => 'chevron',
                    esc_html__( 'Plus', 'cryptronick' ) => 'plus',
                    esc_html__( 'Triangle', 'cryptronick' ) => 'triangle',
                )
            ));
            vc_add_param( 'vc_toggle' , array(
                'type' => 'dropdown',
                'heading' => 'Icon Position',
                'param_name' => 'size',
                'value' => array(
                    esc_html__( 'Left', 'cryptronick' ) => 'left',
                    esc_html__( 'Right', 'cryptronick' ) => 'right',
                )
            ));

            // Add options to separator
            /*vc_add_param('vc_separator',array(
                'type' => 'dropdown',
                'heading' => esc_html__( 'Element width', 'cryptronick' ),
                'param_name' => 'el_width',
                'value' => array(
                    '100%' => '',
                    '90%' => '90',
                    '80%' => '80',
                    '70%' => '70',
                    '60%' => '60',
                    '50%' => '50',
                    '40%' => '40',
                    '30%' => '30',
                    '20%' => '20',
                    '10%' => '10',
                    '100px' => '100px',
                    '75px' => '75px',
                    '40px' => '40px',
                    ),
                'description' => esc_html__( 'Select separator width (percentage or px).', 'cryptronick' ),
            ));*/
    
            $row_params = array(
                array(
                    'type' => 'bpt_checkbox',
                    'param_name' => 'add_extended',                    
                    'heading' => esc_html__( 'Add Extended Background Animation', 'cryptronick' ),       
                    'group' => esc_html__( 'Extended Animation', 'cryptronick' ),
                ),

                array(
                    'type' => 'param_group',
                    'heading' => esc_html__( 'Values', 'cryptronick' ),
                    'param_name' => 'values',
                    'description' => esc_html__( 'Enter values for graph - thumbnail, quote, author name and author status.', 'cryptronick' ),
                    'group' => esc_html__( 'Extended Animation', 'cryptronick' ),
                    'params' => array(
                        array(
                            'type' => 'dropdown',
                            'heading' => 'Choose your animation',
                            'param_name' => 'extended_animation',
                            'value' => array(
                                esc_html__( 'Sphere', 'cryptronick' ) => 'sphere',
                                esc_html__( 'Particles', 'cryptronick' ) => 'particles',
                            ),
                            'admin_label'   => true,
                        ),
                        array(
                            'type' => 'colorpicker',
                            'heading' => esc_html__('Figure Color', 'cryptronick'),
                            'param_name' => 'figure_color',
                            'value' => '#ffffff',
                            'description' => esc_html__('Select sphere color', 'cryptronick'),
                            'admin_label'   => true,
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__('Vertical position', 'cryptronick'),
                            'param_name' => 'extended_animation_pos_vertical',
                            'value' => '50',
                            'description' => esc_html__( 'Enter vertical position from top in %.', 'cryptronick' ),
                            'edit_field_class' => 'vc_col-sm-6',
                            'dependency' => array(
                                'element' => 'extended_animation',
                                'value' => 'sphere'
                            ),
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__('Horizontal position', 'cryptronick'),
                            'param_name' => 'extended_animation_pos_horizont',
                            'value' => '50',
                            'description' => esc_html__( 'Enter horizontal position from left in %.', 'cryptronick' ),
                            'edit_field_class' => 'vc_col-sm-6',
                            'dependency' => array(
                                'element' => 'extended_animation',
                                'value' => 'sphere'
                            ),
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__('Sphere Size', 'cryptronick'),
                            'param_name' => 'sphere_width',
                            'value' => '100',
                            'description' => esc_html__( 'Set size of sphere in pixels.', 'cryptronick' ),
                            'dependency' => array(
                                'element' => 'extended_animation',
                                'value' => 'sphere'
                            ),
                        ),
                        array(
                            'type' => 'bpt_checkbox',
                            'heading' => esc_html__('Add Inside Second Sphere', 'cryptronick'),
                            'param_name' => 'add_second_sphere',
                            'dependency' => array(
                                'element' => 'extended_animation',
                                'value' => 'sphere'
                            ),
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__('Position Top', 'cryptronick'),
                            'param_name' => 'particles_position_top',
                            'value' => '0',
                            'description' => esc_html__( 'Set canvas vertical position from top to top of canvas.', 'cryptronick' ),
                            'dependency' => array(
                                'element' => 'extended_animation',
                                'value' => 'particles'
                            ),
                            'edit_field_class' => 'vc_col-sm-6',
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__('Position Left', 'cryptronick'),
                            'param_name' => 'particles_position_left',
                            'value' => '0',
                            'description' => esc_html__( 'Set canvas vertical position from left to left side of canvas.', 'cryptronick' ),
                            'dependency' => array(
                                'element' => 'extended_animation',
                                'value' => 'particles'
                            ),
                            'edit_field_class' => 'vc_col-sm-6',
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__('Width in Percent', 'cryptronick'),
                            'param_name' => 'particles_width',
                            'value' => '100',
                            'description' => esc_html__( 'Set canvas width in percent.', 'cryptronick' ),
                            'dependency' => array(
                                'element' => 'extended_animation',
                                'value' => 'particles'
                            ),
                            'edit_field_class' => 'vc_col-sm-6',
                        ),
                        array(
                            'type' => 'textfield',
                            'heading' => esc_html__('Height in Percent', 'cryptronick'),
                            'param_name' => 'particles_height',
                            'value' => '100',
                            'description' => esc_html__( 'Set canvas width in percent.', 'cryptronick' ),
                            'dependency' => array(
                                'element' => 'extended_animation',
                                'value' => 'particles'
                            ),
                            'edit_field_class' => 'vc_col-sm-6',
                        ),
                        array(
                            'type' => 'bpt_checkbox',
                            'param_name' => 'add_line',                    
                            'heading' => esc_html__( 'Remove Linked Line' ),
                            'std' => '',
                            'save_always' => true,
                            'dependency' => array(
                                'element' => 'extended_animation',
                                'value' => 'particles'
                            ),
                        ),
                    ),
                    'dependency' => array(
                        'element' => 'add_extended',
                        'value' => 'true'
                    ),
                ),
                
            );

            vc_add_params('vc_row', $row_params);
            
            $menu_params = array(
                array(
                    'type' => 'dropdown',
                    'heading' => esc_html__( 'Alignment', 'cryptronick' ),
                    'param_name' => 'menu_alignment',
                    'value'         => array(
                        esc_html__( 'Center', 'cryptronick' )     => 'center',
                        esc_html__( 'Left', 'cryptronick' )     => 'left',
                        esc_html__( 'Right', 'cryptronick' )   => 'right',
                        esc_html__( 'Block', 'cryptronick' )      => 'block'
                    ),
                    'description' => esc_html__('Select menu item alignment.', 'cryptronick')
                ),  
                
            );
            vc_add_params('vc_wp_custommenu', $menu_params);         
        }
    }
    new Bpt_vc_register();
}

//Add inline styles to enqueue
if(!function_exists('Cryptronick_shortcode_css')){
    function Cryptronick_shortcode_css() {
        return Cryptronick_shortcode_css::instance();
    }
}

if ( !class_exists( "Cryptronick_shortcode_css" ) ){
    class Cryptronick_shortcode_css{
        public $settings;
        protected static $instance = null;

        public static function instance() {
            if ( is_null( self::$instance ) ) {
                self::$instance = new self();
            }
            return self::$instance;
        }    
        public function enqueue_cryptronick_css( $style ) {
            if(!empty($style)){
                ob_start();             
                    echo sprintf("%s", $style);
                $css = ob_get_clean();
                $css = apply_filters( 'cryptronick_enqueue_shortcode_css', $css, $style );

                wp_register_style( 'cryptronick-footer', false );
                wp_enqueue_style( 'cryptronick-footer' );
                wp_add_inline_style( 'cryptronick-footer', $css );      
            }

        }
    }
}
//Add inline styles to enqueue
