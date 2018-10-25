<?php
/*-----------------------------------------------------------------------------------*/
/*	Shortcode Filter
/*-----------------------------------------------------------------------------------*/

vc_remove_element( "vc_gmaps");
vc_remove_element( "vc_wp_search");
vc_remove_element(  "vc_wp_meta" );
vc_remove_element(  "vc_wp_recentcomments" );
vc_remove_element(  "vc_wp_calendar" );
vc_remove_element(  "vc_wp_pages" );
vc_remove_element(  "vc_wp_tagcloud" );
vc_remove_element(  "vc_wp_custommenu" );
vc_remove_element(  "vc_wp_text" );
vc_remove_element(  "vc_wp_posts" );
vc_remove_element(  "vc_wp_categories" );
vc_remove_element(  "vc_wp_archives" );
vc_remove_element(  "vc_wp_rss" );
vc_remove_element(  "vc_progress_bar" );
vc_remove_element(  "vc_message" );
vc_set_as_theme( $disable_updater = false ); 
vc_is_updater_disabled();


$attributes = array(
	array(
		'type' => 'css_editor',
		'param_name' => 'klb_responsive',
		'heading' => esc_html__( 'XS Responsive option', 'cryptoking' ),
		'description' => esc_html__( 'These settings are worked for xsmall devices.', 'cryptoking' ),
		'group' => esc_html__('Responsive Design','cryptoking'),
	),
	
	array(
		'type' => 'checkbox',
		'param_name' => 'activate_particle',
		'heading' => esc_html__( 'Activate Particle?', 'cryptoking' ),
		'description' => esc_html__( 'You want to activate Particles?', 'cryptoking' ),
		'value' => array( esc_html__( 'Yes', 'cryptoking' ) => 'yes' ),
		'group' => esc_html__('Particle','cryptoking'),
	),
	
	array(
		'type' => 'colorpicker',
		'param_name' => 'particle_first_bg_color',
		'heading' => esc_html__( 'First Background Color', 'cryptoking' ),
		'description' => esc_html__( 'Set first background color.', 'cryptoking' ),
		'group' => esc_html__('Particle','cryptoking'),
		'dependency' => array(
			'element' => 'activate_particle',
			'value' => 'yes',
		),		
	),

	array(
		'type' => 'colorpicker',
		'param_name' => 'particle_second_bg_color',
		'heading' => esc_html__( 'Second Background Color', 'cryptoking' ),
		'description' => esc_html__( 'Set second background color.', 'cryptoking' ),
		'group' => esc_html__('Particle','cryptoking'),
		'dependency' => array(
			'element' => 'activate_particle',
			'value' => 'yes',
		),
	),
	
	array(
		'type' => 'colorpicker',
		'param_name' => 'first_bg_color',
		'heading' => esc_html__( 'First Background Color', 'cryptoking' ),
		'description' => esc_html__( 'Set first background color.', 'cryptoking' ),
		'group' => esc_html__('Gradient Background','cryptoking'),
		'dependency' => array(
			'element' => 'activate_particle',
			'is_empty' => true,
		),
	),

	array(
		'type' => 'colorpicker',
		'param_name' => 'second_bg_color',
		'heading' => esc_html__( 'Second Background Color', 'cryptoking' ),
		'description' => esc_html__( 'Set second background color.', 'cryptoking' ),
		'group' => esc_html__('Gradient Background','cryptoking'),
		'dependency' => array(
			'element' => 'activate_particle',
			'is_empty' => true,
		),
	),
	
	array(
		'type' => 'dropdown',
		'heading' => esc_html__( 'Shape', 'cryptoking' ),
		'param_name' => 'shape',
		'value' => array(
			esc_html__( 'Select Shape', 'cryptoking' ) => 'select-type',
			esc_html__( 'Shape 1', 'cryptoking' ) => 'shape1',
			esc_html__( 'Shape 2', 'cryptoking' ) => 'shape2',
			esc_html__( 'Shape 3', 'cryptoking' ) => 'shape3',
			esc_html__( 'Shape 4', 'cryptoking' ) => 'shape4',
			esc_html__( 'Shape 5', 'cryptoking' ) => 'shape5',
			esc_html__( 'Shape 6', 'cryptoking' ) => 'shape6',
			esc_html__( 'Shape 7', 'cryptoking' ) => 'shape7',
		),			
		'description' => esc_html__( 'Select shape.', 'cryptoking' ),
		'group' => esc_html__('Shape','cryptoking'),

	),

);
vc_add_params( 'vc_row', $attributes );


/*-----------------------------------------------------------------------------------*/
/* cryptoking Style
/*-----------------------------------------------------------------------------------*/

$attributes = array(

	array(
		'type' => 'css_editor',
		'param_name' => 'klb_responsive',
		'heading' => esc_html__( 'XS Responsive option', 'cryptoking' ),
		'description' => esc_html__( 'These settings are worked for xsmall devices.', 'cryptoking' ),
		'group' => esc_html__('Responsive Design','cryptoking'),
	),

);
vc_add_params( 'vc_column', $attributes );

/*-----------------------------------------------------------------------------------*/
/*	Cryptoking Banner Title
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'cryptoking_banner_title_integrateWithVC' );
function cryptoking_banner_title_integrateWithVC() {
   vc_map( array(
      "name" => esc_html__( "Cryptoking Banner Title", "cryptoking" ),
      "base" => "banner_title",
	  "category" => "Cryptoking",
      "params" => array(
	  
        array(
            "type" => "textfield",
            "heading" => esc_html__("Title First", "cryptoking"),
            "param_name" => "title_first",
            "description" => esc_html__("Set first title.", "cryptoking")
        ),
		
        array(
            "type" => "textfield",
            "heading" => esc_html__("Title Second", "cryptoking"),
            "param_name" => "title_second",
            "description" => esc_html__("Set second title.", "cryptoking")
        ),
		
        array(
            "type" => "textarea",
            "heading" => esc_html__("Subtitle", "cryptoking"),
            "param_name" => "subtitle",
            "description" => esc_html__("Set subtitle.", "cryptoking")
        ),
		
        array(
            "type" => "textarea",
            "heading" => esc_html__("Description", "cryptoking"),
            "param_name" => "desc",
            "description" => esc_html__("Set description.", "cryptoking")
        ),
		
				
		array(
			'type' => 'param_group',
			'heading' => esc_html__( 'Buttons', 'cryptoking' ),
			'param_name' => 'values',
			'group' => esc_html__('Buttons','cryptoking'),
			'value' => urlencode( json_encode( array(
				array(
					'title' => esc_html__( 'title here', 'cryptoking' )
				)
			) ) ),
			'params' => array(
				
				array(
					"type" => "vc_link",
					"heading" => esc_html__("Link", "cryptoking"),
					"param_name" => "link",
					"description" => esc_html__("Add button.", "cryptoking"),
				),
				
				array(
					'type' => 'checkbox',
					'param_name' => 'pagescroll',
					'heading' => esc_html__( 'Activate Page Scroll?', 'cryptoking' ),
					'description' => esc_html__( 'You want to activate page scroll?', 'cryptoking' ),
					'value' => array( esc_html__( 'Yes', 'cryptoking' ) => 'yes' ),
				),
				
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Type', 'cryptoking' ),
					'param_name' => 'btn_type',
					'value' => array(
						esc_html__( 'Select Type', 'cryptoking' ) => 'select-type',
						esc_html__( 'Type 1', 'cryptoking' ) => 'type_1',
						esc_html__( 'Type 2', 'cryptoking' ) => 'type_2',										
					),			
					'description' => esc_html__( 'Select button type.', 'cryptoking' ),
				),
			
			),
		),
		
		
      ),
   ) );
}
class WPBakeryShortCode_Banner_Title extends WPBakeryShortCode {
}


/*-----------------------------------------------------------------------------------*/
/*	Cryptoking Countdown
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'cryptoking_countdown_integrateWithVC' );
function cryptoking_countdown_integrateWithVC() {
   vc_map( array(
      "name" => esc_html__( "Cryptoking Countdown", "cryptoking" ),
      "base" => "countdown",
	  "category" => "Cryptoking",
      "params" => array(
	  
        array(
            "type" => "textfield",
            "heading" => esc_html__("Title", "cryptoking"),
            "param_name" => "title",
            "description" => esc_html__("Set title.", "cryptoking"),
			'dependency' => array(
				'element' => 'type',
				'value' => array('select-type','type1'),
			),
        ),
		
        array(
            "type" => "textfield",
            "heading" => esc_html__("Date Time", "cryptoking"),
            "param_name" => "datetime",
            "description" => esc_html__("Set date time. for example: 2018/09/06 00:00:00", "cryptoking"),
        ),

        array(
            "type" => "textfield",
            "heading" => esc_html__("Target", "cryptoking"),
            "param_name" => "target",
            "description" => esc_html__("Set target. For example: 15M ICO MAX", "cryptoking"),
			'dependency' => array(
				'element' => 'type',
				'value' => array('select-type','type1'),
			),
        ),
		
        array(
            "type" => "textfield",
            "heading" => esc_html__("Raised Money", "cryptoking"),
            "param_name" => "raised_money",
            "description" => esc_html__("Set Raised Money. For example: 41000 USD", "cryptoking"),
			'dependency' => array(
				'element' => 'type',
				'value' => array('select-type','type1'),
			),
        ),
		
        array(
            "type" => "textfield",
            "heading" => esc_html__("Raised Width", "cryptoking"),
            "param_name" => "raised_width",
            "description" => esc_html__("Set raised bar width as percentage. For example: 45", "cryptoking"),
			'dependency' => array(
				'element' => 'type',
				'value' => array('select-type','type1'),
			),
        ),
		
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Type', 'cryptoking' ),
			'param_name' => 'type',
			'value' => array(
				esc_html__( 'Select Type', 'cryptoking' ) => 'select-type',
				esc_html__( 'Type 1', 'cryptoking' ) => 'type1',
				esc_html__( 'Type 2', 'cryptoking' ) => 'type2',										
			),			
			'description' => esc_html__( 'Select countdown type.', 'cryptoking' ),
		),
		
        array(
            "type" => "textfield",
            "heading" => esc_html__("Label First Raised", "cryptoking"),
            "param_name" => "label_first_raised",
            "description" => esc_html__("Set label for first raised. For example: 100K", "cryptoking"),
			'group' => esc_html__('Label First','cryptoking'),
			'dependency' => array(
				'element' => 'type',
				'value' => array('select-type','type1'),
			),
        ),
		
        array(
            "type" => "textfield",
            "heading" => esc_html__("Label First Left", "cryptoking"),
            "param_name" => "label_first_left",
            "description" => esc_html__("Set label left margin for first raised. For example: 10", "cryptoking"),
			'group' => esc_html__('Label First','cryptoking'),
			'dependency' => array(
				'element' => 'type',
				'value' => array('select-type','type1'),
			),
        ),
		
        array(
            "type" => "textfield",
            "heading" => esc_html__("Label Second Raised", "cryptoking"),
            "param_name" => "label_second_raised",
            "description" => esc_html__("Set label for second raised. For example: 800K", "cryptoking"),
			'group' => esc_html__('Label Second','cryptoking'),
			'dependency' => array(
				'element' => 'type',
				'value' => array('select-type','type1'),
			),
        ),
		
        array(
            "type" => "textfield",
            "heading" => esc_html__("Label Second Left", "cryptoking"),
            "param_name" => "label_second_left",
            "description" => esc_html__("Set label left margin for second raised. For example: 40", "cryptoking"),
			'group' => esc_html__('Label Second','cryptoking'),
			'dependency' => array(
				'element' => 'type',
				'value' => array('select-type','type1'),
			),
        ),
		
        array(
            "type" => "textfield",
            "heading" => esc_html__("Label Third Raised", "cryptoking"),
            "param_name" => "label_third_raised",
            "description" => esc_html__("Set label for third raised. For example: 950K", "cryptoking"),
			'group' => esc_html__('Label Third','cryptoking'),
			'dependency' => array(
				'element' => 'type',
				'value' => array('select-type','type1'),
			),
        ),
		
        array(
            "type" => "textfield",
            "heading" => esc_html__("Label Third Left", "cryptoking"),
            "param_name" => "label_third_left",
            "description" => esc_html__("Set label left margin for third raised. For example: 75", "cryptoking"),
			'group' => esc_html__('Label Third','cryptoking'),
			'dependency' => array(
				'element' => 'type',
				'value' => array('select-type','type1'),
			),
        ),
		
		array(
			"type" => "vc_link",
			"heading" => esc_html__("Link", "cryptoking"),
			"param_name" => "link",
			"description" => esc_html__("Add button.", "cryptoking"),
			'group' => esc_html__('Button','cryptoking'),
		),
		
      ),
   ) );
}
class WPBakeryShortCode_Countdown extends WPBakeryShortCode {
}

/*-----------------------------------------------------------------------------------*/
/*	Cryptoking Title
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'cryptoking_title_integrateWithVC' );
function cryptoking_title_integrateWithVC() {
   vc_map( array(
      "name" => esc_html__( "Cryptoking Title", "cryptoking" ),
      "base" => "title",
	  "category" => "Cryptoking",
      "params" => array(
		
        array(
            "type" => "textfield",
            "heading" => esc_html__("Title", "cryptoking"),
            "param_name" => "title",
            "description" => esc_html__("Set a title.", "cryptoking"),
			"admin_label" => true,
        ),
		
        array(
            "type" => "textfield",
            "heading" => esc_html__("Subtitle", "cryptoking"),
            "param_name" => "subtitle",
            "description" => esc_html__("Set a subtitle.", "cryptoking"),
			'dependency' => array(
				'element' => 'type',
				'value' => array('type2','type3'),
			),
        ),
		
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Type', 'cryptoking' ),
			'param_name' => 'type',
			'value' => array(
				esc_html__( 'Select Type', 'cryptoking' ) => 'select-type',
				esc_html__( 'Type 1', 'cryptoking' ) => 'type1',
				esc_html__( 'Type 2', 'cryptoking' ) => 'type2',										
				esc_html__( 'Type 3', 'cryptoking' ) => 'type3',										
			),			
			'description' => esc_html__( 'Select countdown type.', 'cryptoking' ),
		),
		
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Text Align', 'cryptoking' ),
			'param_name' => 'textalign',
			'value' => array(
				esc_html__( 'Select Align', 'cryptoking' ) => 'select-align',
				esc_html__( 'Left', 'cryptoking' ) => 'text-left',
				esc_html__( 'Center', 'cryptoking' ) => 'text-center',					
				esc_html__( 'Right', 'cryptoking' ) => 'text-right',					
			),			
			'description' => esc_html__( 'Select text align.', 'cryptoking' ),
		),
		
      ),
   ) );
}
class WPBakeryShortCode_Title extends WPBakeryShortCode {
}

/*-----------------------------------------------------------------------------------*/
/*	Cryptoking Button
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'cryptoking_btn_button_integrateWithVC' );
function cryptoking_btn_button_integrateWithVC() {
   vc_map( array(
      "name" => esc_html__( "Cryptoking Button", "cryptoking" ),
      "base" => "btn_button",
	  "category" => "Cryptoking",
      "params" => array( 
		
		//Button
		array(
			'type' => 'vc_link',
			'heading' => esc_html__( 'URL (Link)', 'cryptoking' ),
			'param_name' => 'link',
			'description' => esc_html__( 'Add Button for item', 'cryptoking' ),
            'group'       => 'Button',
		),
		
		array(
			'type' => 'checkbox',
			'param_name' => 'download',
			'heading' => esc_html__( 'Download Url?', 'cryptoking' ),
			'description' => esc_html__( 'You want to activate download url when clicked the button?', 'cryptoking' ),
			'value' => array( esc_html__( 'Yes', 'cryptoking' ) => 'yes' ),
			'group'       => 'Button',
		),
		
		array(
			'type' => 'checkbox',
			'param_name' => 'button_icon',
			'heading' => esc_html__( 'Add Icon?', 'cryptoking' ),
			'description' => esc_html__( 'You want to use icon on button?', 'cryptoking' ),
			'value' => array( esc_html__( 'Yes', 'cryptoking' ) => 'yes' ),
			'group' => 'Icon',
		),
		
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Icon library', 'cryptoking' ),
			'value' => array(
				esc_html__( 'Font Awesome', 'cryptoking' ) => 'fontawesome',
				esc_html__( 'Open Iconic', 'cryptoking' ) => 'openiconic',
				esc_html__( 'Typicons', 'cryptoking' ) => 'typicons',
				esc_html__( 'Entypo', 'cryptoking' ) => 'entypo',
				esc_html__( 'Linecons', 'cryptoking' ) => 'linecons',
				esc_html__( 'Mono Social', 'cryptoking' ) => 'monosocial',
				esc_html__( 'Ion', 'cryptoking' ) => 'ion',
			),
			'param_name' => 'type',
			'description' => esc_html__( 'Select icon library.', 'cryptoking' ),
			'dependency' => array(
				'element' => 'button_icon',
				'value' => 'yes',
			),	
			'group' => 'Icon',
		),

		
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'cryptoking' ),
			'param_name' => 'icon_fontawesome',
			'value' => 'fa fa-info-circle',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'type',
				'value' => 'fontawesome',
			),
			'description' => esc_html__( 'Select icon from library.', 'cryptoking' ),	
			'group' => 'Icon',			
		),
		

		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'cryptoking' ),
			'param_name' => 'icon_openiconic',
			'value' => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'openiconic',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'type',
				'value' => 'openiconic',
			),
			'description' => esc_html__( 'Select icon from library.', 'cryptoking' ),
			'group' => 'Icon',
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'cryptoking' ),
			'param_name' => 'icon_typicons',
			'value' => 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'typicons',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'type',
				'value' => 'typicons',
			),
			'description' => esc_html__( 'Select icon from library.', 'cryptoking' ),
			'group' => 'Icon',
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'cryptoking' ),
			'param_name' => 'icon_entypo',
			'value' => 'entypo-icon entypo-icon-note', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'entypo',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'type',
				'value' => 'entypo',
				'group' => 'Icon',
			),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'cryptoking' ),
			'param_name' => 'icon_linecons',
			'value' => 'vc_li vc_li-heart', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'linecons',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'type',
				'value' => 'linecons',
			),
			'description' => esc_html__( 'Select icon from library.', 'cryptoking' ),
			'group' => 'Icon',
		),
		
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'cryptoking' ),
			'param_name' => 'icon_monosocial',
			'value' => 'vc-mono vc-mono-fivehundredpx', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'monosocial',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'type',
				'value' => 'monosocial',
			),
			'description' => esc_html__( 'Select icon from library.', 'cryptoking' ),
			'group' => 'Icon',
		),
		
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'cryptoking' ),
			'param_name' => 'icon_ion',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'ion',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'type',
				'value' => 'ion',
			),
			'description' => esc_html__( 'Select icon from library.', 'cryptoking' ),
			'group' => 'Icon',
		),

		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Icon Alignment', 'cryptoking' ),
			'param_name' => 'icon_alignment',
			'value' => array(
				esc_html__( 'Select', 'cryptoking' ) => 'select-type',
				esc_html__( 'Left', 'cryptoking' ) => 'left',
				esc_html__( 'Right', 'cryptoking' ) => 'right',						
			),
			'dependency' => array(
				'element' => 'button_icon',
				'value' => 'yes',
			),			
			'description' => esc_html__( 'Select icon alignment.', 'cryptoking' ),
			'group' => 'Icon',
		),
		
		array(
			'type' => 'checkbox',
			'param_name' => 'activate_rounded',
			'heading' => esc_html__( 'Add Rounded Icon?', 'cryptoking' ),
			'description' => esc_html__( 'You want to use rounded icon in the button?', 'cryptoking' ),
			'value' => array( esc_html__( 'Yes', 'cryptoking' ) => 'yes' ),
			'group' => 'Rounded Icon',
		),
		
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'cryptoking' ),
			'param_name' => 'icon_rounded_ion',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'ion',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'activate_rounded',
				'value' => 'yes',
			),	
			'description' => esc_html__( 'Select icon from library.', 'cryptoking' ),
			'group' => 'Rounded Icon',

		),

        array(
            'type' => 'css_editor',
            'heading' => esc_html__( 'Css', 'cryptoking' ),
            'param_name' => 'css',
            'group' => esc_html__( 'Design options', 'cryptoking' ),
        ),
		
      ),
   ) );
}
class WPBakeryShortCode_btn_button extends WPBakeryShortCode {
}

/*-----------------------------------------------------------------------------------*/
/*	Cryptoking Icon Box
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'cryptoking_icon_box_integrateWithVC' );
function cryptoking_icon_box_integrateWithVC() {
   vc_map( array(
      "name" => esc_html__( "Cryptoking Icon Box", "cryptoking" ),
      "base" => "icon_box",
	  "category" => "Cryptoking",
      "params" => array( 
		
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Icon library', 'cryptoking' ),
			'value' => array(
				esc_html__( 'Font Awesome', 'cryptoking' ) => 'fontawesome',
				esc_html__( 'Open Iconic', 'cryptoking' ) => 'openiconic',
				esc_html__( 'Typicons', 'cryptoking' ) => 'typicons',
				esc_html__( 'Entypo', 'cryptoking' ) => 'entypo',
				esc_html__( 'Linecons', 'cryptoking' ) => 'linecons',
				esc_html__( 'Mono Social', 'cryptoking' ) => 'monosocial',
				esc_html__( 'Ion', 'cryptoking' ) => 'ion',
			),
			'param_name' => 'type',
			'description' => esc_html__( 'Select icon library.', 'cryptoking' ),
			'dependency' => array(
				'element' => 'use_image',
				'is_empty' => true,
			),
		),

		
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'cryptoking' ),
			'param_name' => 'icon_fontawesome',
			'value' => 'fa fa-info-circle',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'type',
				'value' => 'fontawesome',
			),
			'description' => esc_html__( 'Select icon from library.', 'cryptoking' ),	
		),
		

		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'cryptoking' ),
			'param_name' => 'icon_openiconic',
			'value' => 'vc-oi vc-oi-dial', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'openiconic',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'type',
				'value' => 'openiconic',
			),
			'description' => esc_html__( 'Select icon from library.', 'cryptoking' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'cryptoking' ),
			'param_name' => 'icon_typicons',
			'value' => 'typcn typcn-adjust-brightness', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'typicons',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'type',
				'value' => 'typicons',
			),
			'description' => esc_html__( 'Select icon from library.', 'cryptoking' ),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'cryptoking' ),
			'param_name' => 'icon_entypo',
			'value' => 'entypo-icon entypo-icon-note', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'entypo',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'type',
				'value' => 'entypo',
			),
		),
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'cryptoking' ),
			'param_name' => 'icon_linecons',
			'value' => 'vc_li vc_li-heart', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'linecons',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'type',
				'value' => 'linecons',
			),
			'description' => esc_html__( 'Select icon from library.', 'cryptoking' ),
		),
		
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'cryptoking' ),
			'param_name' => 'icon_monosocial',
			'value' => 'vc-mono vc-mono-fivehundredpx', // default value to backend editor admin_label
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'monosocial',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'type',
				'value' => 'monosocial',
			),
			'description' => esc_html__( 'Select icon from library.', 'cryptoking' ),
		),
		
		array(
			'type' => 'iconpicker',
			'heading' => esc_html__( 'Icon', 'cryptoking' ),
			'param_name' => 'icon_ion',
			'settings' => array(
				'emptyIcon' => false, // default true, display an "EMPTY" icon?
				'type' => 'ion',
				'iconsPerPage' => 200, // default 100, how many icons per/page to display
			),
			'dependency' => array(
				'element' => 'type',
				'value' => 'ion',
			),
			'description' => esc_html__( 'Select icon from library.', 'cryptoking' ),
		),
		
        array(
            "type" => "textfield",
            "heading" => esc_html__("Title", "cryptoking"),
            "param_name" => "title",
            "description" => esc_html__("Set a title.", "cryptoking"),
			"admin_label" => true,
        ),
		
        array(
            "type" => "textarea",
            "heading" => esc_html__("Content", "cryptoking"),
            "param_name" => "contentm",
            "description" => esc_html__("Set the content.", "cryptoking"),
        ),
		
      ),
   ) );
}
class WPBakeryShortCode_Icon_Box extends WPBakeryShortCode {
}

/*-----------------------------------------------------------------------------------*/
/*	Cryptoking Image Box
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'cryptoking_image_box_integrateWithVC' );
function cryptoking_image_box_integrateWithVC() {
   vc_map( array(
      "name" => esc_html__( "Cryptoking Image Box", "cryptoking" ),
      "base" => "image_box",
	  "category" => "Cryptoking",
      "params" => array(
		
        array(
            "type" => "textfield",
            "heading" => esc_html__("Title", "cryptoking"),
            "param_name" => "title",
            "description" => esc_html__("Set a title.", "cryptoking"),
			"admin_label" => true,
        ),
		
		array(
			'type' => 'attach_image',
			'heading' => esc_html__( 'Image', 'cryptoking' ),
			'param_name' => 'image_url',
			'description' => esc_html__( 'Upload an image.', 'cryptoking' ),
		),
		
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Text Align', 'cryptoking' ),
			'param_name' => 'textalign',
			'value' => array(
				esc_html__( 'Select Align', 'cryptoking' ) => 'select-align',
				esc_html__( 'Left', 'cryptoking' ) => 'text-left',
				esc_html__( 'Center', 'cryptoking' ) => 'text-center',					
				esc_html__( 'Right', 'cryptoking' ) => 'text-right',					
			),			
			'description' => esc_html__( 'Select text align.', 'cryptoking' ),
		),
		
      ),
   ) );
}
class WPBakeryShortCode_Image_Box extends WPBakeryShortCode {
}

/*-----------------------------------------------------------------------------------*/
/*	Cryptoking Text Box
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'cryptoking_text_box_integrateWithVC' );
function cryptoking_text_box_integrateWithVC() {
   vc_map( array(
      "name" => esc_html__( "Cryptoking Text Box", "cryptoking" ),
      "base" => "text_box",
	  "category" => "Cryptoking",
      "params" => array(
		
        array(
            "type" => "textfield",
            "heading" => esc_html__("Title", "cryptoking"),
            "param_name" => "title",
            "description" => esc_html__("Set a title.", "cryptoking"),
			"admin_label" => true,
        ),
		
        array(
            "type" => "textfield",
            "heading" => esc_html__("Content", "cryptoking"),
            "param_name" => "contentm",
            "description" => esc_html__("Set detail.", "cryptoking"),
        ),
		
      ),
   ) );
}
class WPBakeryShortCode_Text_Box extends WPBakeryShortCode {
}

/*-----------------------------------------------------------------------------------*/
/*	Cryptoking Chart List
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'cryptoking_chart_list_integrateWithVC' );
function cryptoking_chart_list_integrateWithVC() {
   vc_map( array(
      "name" => esc_html__( "Cryptoking Chart List", "cryptoking" ),
      "base" => "chart_list",
	  "category" => "Cryptoking",
      "params" => array(
				
		array(
			'type' => 'param_group',
			'heading' => esc_html__( 'Charts', 'cryptoking' ),
			'param_name' => 'values',
			'group' => esc_html__('Charts','cryptoking'),
			'value' => urlencode( json_encode( array(
				array(
					'title' => esc_html__( 'title here', 'cryptoking' )
				)
			) ) ),
			'params' => array(
				
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title", "cryptoking"),
					"param_name" => "title",
					"description" => esc_html__("Set a title.", "cryptoking"),
					"admin_label" => true,
				),
				
				array(
					'type' => 'dropdown',
					'heading' => esc_html__( 'Type', 'cryptoking' ),
					'param_name' => 'color',
					'value' => array(
						esc_html__( 'Select Color', 'cryptoking' ) => 'select-color',
						esc_html__( 'Color 1', 'cryptoking' ) => 'color1',
						esc_html__( 'Color 2', 'cryptoking' ) => 'color2',
						esc_html__( 'Color 3', 'cryptoking' ) => 'color3',
						esc_html__( 'Color 4', 'cryptoking' ) => 'color4',
						esc_html__( 'Color 5', 'cryptoking' ) => 'color5',
					),			
					'description' => esc_html__( 'Select color.', 'cryptoking' ),
				),
			
			),
		),
		
		
      ),
   ) );
}
class WPBakeryShortCode_Chart_List extends WPBakeryShortCode {
}

/*-----------------------------------------------------------------------------------*/
/*	Cryptoking Road Map Carousel
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'cryptoking_road_map_carousel_integrateWithVC' );
function cryptoking_road_map_carousel_integrateWithVC() {
   vc_map( array(
      "name" => esc_html__( "Cryptoking Road Map Carousel", "cryptoking" ),
      "base" => "road_map_carousel",
	  "category" => "Cryptoking",
      "params" => array(
				
		array(
			'type' => 'param_group',
			'heading' => esc_html__( 'Items', 'cryptoking' ),
			'param_name' => 'values',
			'group' => esc_html__('Items','cryptoking'),
			'value' => urlencode( json_encode( array(
				array(
					'title' => esc_html__( 'title here', 'cryptoking' )
				)
			) ) ),
			'params' => array(
				
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title", "cryptoking"),
					"param_name" => "title",
					"description" => esc_html__("Set a title.", "cryptoking"),
					"admin_label" => true,
				),
				
				array(
					"type" => "textfield",
					"heading" => esc_html__("Subtitle", "cryptoking"),
					"param_name" => "subtitle",
					"description" => esc_html__("Set a subtitle.", "cryptoking"),
				),
				
				array(
					'type' => 'checkbox',
					'param_name' => 'complete',
					'heading' => esc_html__( 'Completed?', 'cryptoking' ),
					'description' => esc_html__( 'Set the item as completed.', 'cryptoking' ),
					'value' => array( esc_html__( 'Yes', 'cryptoking' ) => 'yes' ),
				),
			
			),
		),
		
		
      ),
   ) );
}
class WPBakeryShortCode_Road_Map_Carousel extends WPBakeryShortCode {
}

/*-----------------------------------------------------------------------------------*/
/*	Cryptoking Team Box
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'cryptoking_team_box_integrateWithVC' );
function cryptoking_team_box_integrateWithVC() {
   vc_map( array(
      "name" => esc_html__( "Cryptoking Team Box", "cryptoking" ),
      "base" => "team_box",
	  "category" => "Cryptoking",
      "params" => array(
	  
		array(
			'type' => 'attach_image',
			'heading' => esc_html__( 'Image', 'cryptoking' ),
			'param_name' => 'image_url',
			'description' => esc_html__( 'Upload an image.', 'cryptoking' ),
		),
		
		array(
			"type" => "textfield",
			"heading" => esc_html__("Name", "cryptoking"),
			"param_name" => "name",
			"description" => esc_html__("Add the person name.", "cryptoking"),
			"admin_label" => true,
		),
		
		array(
			"type" => "textfield",
			"heading" => esc_html__("Position", "cryptoking"),
			"param_name" => "position",
			"description" => esc_html__("Add the person job.", "cryptoking"),
		),
		
		array(
			"type" => "textfield",
			"heading" => esc_html__("Unique Id", "cryptoking"),
			"param_name" => "uniqueid",
			"description" => esc_html__("Add an unique id for popup content. For example: team1 .", "cryptoking"),
		),
		
		array(
			"type" => "textarea_html",
			"heading" => esc_html__("Content", "cryptoking"),
			"param_name" => "content",
			"description" => esc_html__("Add text about the person.It will be appeared , when you click the person name on frontend.", "cryptoking"),
		),
	  
		array(
			'type' => 'param_group',
			'heading' => esc_html__( 'Social', 'cryptoking' ),
			'param_name' => 'values',
			'group' => esc_html__('Social','cryptoking'),
			'value' => urlencode( json_encode( array(
				array(
					'title' => esc_html__( 'title here', 'cryptoking' )
				)
			) ) ),
			'params' => array(
			
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'cryptoking' ),
					'param_name' => 'icon_ion',
					'settings' => array(
						'emptyIcon' => false, // default true, display an "EMPTY" icon?
						'type' => 'ion',
						'iconsPerPage' => 200, // default 100, how many icons per/page to display
					),
					'description' => esc_html__( 'Select social icon from library.', 'cryptoking' ),
					'admin_label' => true,
				),
				
				array(
					"type" => "vc_link",
					"heading" => esc_html__("Link", "cryptoking"),
					"param_name" => "link",
					"description" => esc_html__("Add social url.", "cryptoking"),
				),
			
			),
		),
		
		
      ),
   ) );
}
class WPBakeryShortCode_Team_Box extends WPBakeryShortCode {
}

/*-----------------------------------------------------------------------------------*/
/*	Cryptoking Info List
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'cryptoking_info_list_integrateWithVC' );
function cryptoking_info_list_integrateWithVC() {
   vc_map( array(
      "name" => esc_html__( "Cryptoking Info List", "cryptoking" ),
      "base" => "info_list",
	  "category" => "Cryptoking",
      "params" => array(

 		array(
			'type' => 'param_group',
			'heading' => esc_html__( 'Info List', 'cryptoking' ),
			'param_name' => 'values',
			'value' => urlencode( json_encode( array(
				array(
					'title' => esc_html__( 'title here', 'cryptoking' )
				)
			) ) ),
			'params' => array(
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'cryptoking' ),
					'param_name' => 'icon_ion',
					'settings' => array(
						'emptyIcon' => false, // default true, display an "EMPTY" icon?
						'type' => 'ion',
						'iconsPerPage' => 200, // default 100, how many icons per/page to display
					),
					'description' => esc_html__( 'Select social icon from library.', 'cryptoking' ),
				),
				
				array(
					"type" => "textfield",
					"heading" => esc_html__("Title", "cryptoking"),
					"param_name" => "title",
					"description" => esc_html__("Add title for the info list.", "cryptoking"),
					'admin_label' => true
				),
				
				array(
					"type" => "textarea",
					"heading" => esc_html__("Content", "cryptoking"),
					"param_name" => "contentm",
					"description" => esc_html__("Add content for the info list.", "cryptoking")
				),
			
			),
		),	


      ),
   ) );
}
class WPBakeryShortCode_Info_List extends WPBakeryShortCode {
}

/*-----------------------------------------------------------------------------------*/
/*	Cryptoking Social List
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'cryptoking_social_list_integrateWithVC' );
function cryptoking_social_list_integrateWithVC() {
   vc_map( array(
      "name" => esc_html__( "Cryptoking Social Icon List", "cryptoking" ),
      "base" => "social_list",
	  "category" => "Cryptoking",
      "params" => array(

		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Text Align', 'cryptoking' ),
			'param_name' => 'textalign',
			'value' => array(
				esc_html__( 'Select Align', 'cryptoking' ) => 'select-align',
				esc_html__( 'Left', 'cryptoking' ) => 'text-left',
				esc_html__( 'Center', 'cryptoking' ) => 'text-center',					
				esc_html__( 'Right', 'cryptoking' ) => 'text-right',					
			),			
			'description' => esc_html__( 'Select text align.', 'cryptoking' ),
		),
	  
 		array(
			'type' => 'param_group',
			'heading' => esc_html__( 'Social List', 'cryptoking' ),
			'param_name' => 'values',
			'value' => urlencode( json_encode( array(
				array(
					'title' => esc_html__( 'title here', 'cryptoking' )
				)
			) ) ),
			'params' => array(
				array(
					'type' => 'iconpicker',
					'heading' => esc_html__( 'Icon', 'cryptoking' ),
					'param_name' => 'icon_ion',
					'settings' => array(
						'emptyIcon' => false, // default true, display an "EMPTY" icon?
						'type' => 'ion',
						'iconsPerPage' => 200, // default 100, how many icons per/page to display
					),
					'description' => esc_html__( 'Select social icon from library.', 'cryptoking' ),
					'admin_label' => true,
				),
				
				array(
					"type" => "vc_link",
					"heading" => esc_html__("Link", "cryptoking"),
					"param_name" => "link",
					"description" => esc_html__("Add social url.", "cryptoking"),
				),
			
			),
		),	


      ),
   ) );
}
class WPBakeryShortCode_Social_Icon_List extends WPBakeryShortCode {
}

/*-----------------------------------------------------------------------------------*/
/*	Cryptoking Subscribe Form
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'cryptoking_subscribe_form_integrateWithVC' );
function cryptoking_subscribe_form_integrateWithVC() {
   vc_map( array(
      "name" => esc_html__( "Cryptoking Subscribe Form", "cryptoking" ),
      "base" => "subscribe_form",
	  "category" => "Cryptoking",
      "params" => array(
	  
        array(
            "type" => "textfield",
            "heading" => esc_html__("Subscribe Form Id", "cryptoking"),
            "param_name" => "subscribe_form_id",
            "description" => esc_html__("You can find the form id in Dashboard > Mailchimp For Wp > Form", "cryptoking"),
        ),
		
        array(
            "type" => "textfield",
            "heading" => esc_html__("Title", "cryptoking"),
            "param_name" => "title",
            "description" => esc_html__("Set a title for the subscribe form", "cryptoking"),
        ),
		
		array(
			'type' => 'colorpicker',
			'heading' => esc_html__( 'Title Color', 'cryptoking' ),
			'param_name' => 'font_color',
			'description' => esc_html__( 'Set title font color.', 'cryptoking' ),	
		),
	
		array(
			'type' => 'dropdown',
			'heading' => esc_html__( 'Text Align', 'cryptoking' ),
			'param_name' => 'textalign',
			'value' => array(
				esc_html__( 'Select Align', 'cryptoking' ) => 'select-align',
				esc_html__( 'Left', 'cryptoking' ) => 'text-left',
				esc_html__( 'Center', 'cryptoking' ) => 'text-center',					
				esc_html__( 'Right', 'cryptoking' ) => 'text-right',					
			),			
			'description' => esc_html__( 'Select text align.', 'cryptoking' ),
		),


      ),
   ) );
}
class WPBakeryShortCode_Social_Subscribe_Form extends WPBakeryShortCode {
}

/*-----------------------------------------------------------------------------------*/
/*	Cryptoking Login Register Form
/*-----------------------------------------------------------------------------------*/

add_action( 'vc_before_init', 'cryptoking_login_register_form_integrateWithVC' );
function cryptoking_login_register_form_integrateWithVC() {
   vc_map( array(
      "name" => esc_html__( "Cryptoking Login Register Form", "cryptoking" ),
      "base" => "login_register_form",
	  "category" => "Cryptoking",
      "params" => array(
		

		
      ),
   ) );
}
class WPBakeryShortCode_Login_Register_Form extends WPBakeryShortCode {
}