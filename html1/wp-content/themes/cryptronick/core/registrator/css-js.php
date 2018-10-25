<?php

#Frontend
if (!function_exists('cryptronick_css_js_register')) {
    function cryptronick_css_js_register()
    {
        $wp_upload_dir = wp_upload_dir();

        wp_register_script( 'cryptronick-theme', get_template_directory_uri() . '/js/theme.js', array('jquery'), false, true);
        $translation_array = array(
		    'bpt_ajaxurl' => esc_url(admin_url('admin-ajax.php'))
		);
		wp_localize_script( 'cryptronick-theme', 'object_name', $translation_array );

        #CSS
        wp_enqueue_style('cryptronick-default-style', get_bloginfo('stylesheet_url'));
		wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css');
		wp_enqueue_style('flaticon', get_template_directory_uri() . '/fonts/flaticon/flaticon.css');
		wp_enqueue_style('cryptronick-composer', get_template_directory_uri() . '/css/main.css');

        #JS
		wp_enqueue_script('cryptronick-theme', get_template_directory_uri() . '/js/theme.js', array('jquery'), false, true);

        wp_localize_script( 'cryptronick-theme', 'bpt_core', array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'like' => esc_html__( 'Like', 'cryptronick' ),
            'unlike' => esc_html__( 'Unlike', 'cryptronick' )
            ) ); 
    }
}
add_action('wp_enqueue_scripts', 'cryptronick_css_js_register');

#Admin
add_action('admin_enqueue_scripts', 'cryptronick_admin_css_js_register');
function cryptronick_admin_css_js_register()
{
    $protocol = is_ssl() ? 'https' : 'http';

    #CSS (MAIN)
	wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css');
	wp_enqueue_style('cryptronick-admin', get_template_directory_uri() . '/core/admin/css/admin.css');
    wp_enqueue_style('cryptronick-admin-font', '$protocol://fonts.googleapis.com/css?family=Roboto:400,700,300');
	wp_enqueue_style('wp-color-picker');
    wp_enqueue_style('cryptronick-admin-colorbox', get_template_directory_uri() . '/core/admin/css/colorbox.css');
	wp_enqueue_style('selectBox', get_template_directory_uri() . '/core/admin/css/jquery.selectBox.css');
	wp_enqueue_style('cryptronick-vc-backend-style', get_template_directory_uri() . '/core/admin/css/bpt-vc-backend.css');

    #JS (MAIN)
    wp_enqueue_script('cryptronick-admin', get_template_directory_uri() . '/core/admin/js/admin.js', array('jquery'), false, true);
    wp_enqueue_media();
    wp_enqueue_script('cryptronick-admin-colorbox', get_template_directory_uri() . '/core/admin/js/jquery.colorbox-min.js', array(), false, true);
	wp_enqueue_script('wp-color-picker');
	wp_enqueue_script('selectBox', get_template_directory_uri() . '/core/admin/js/jquery.selectBox.js');

	if (class_exists( 'RWMB_Loader' )) {
		wp_enqueue_script('metaboxes', get_template_directory_uri() . '/core/admin/js/metaboxes.js');
	}
}


function cryptronick_custom_styles() {


	$page_colors_switch = Cryptronick_Theme_Helper::options_compare('page_colors_switch','mb_page_colors_switch','custom');
	if ($page_colors_switch == 'custom') {
		$theme_color = Cryptronick_Theme_Helper::options_compare('page_theme_color','mb_page_colors_switch','custom');
		$use_gradient = Cryptronick_Theme_Helper::options_compare('use_gradient','mb_page_colors_switch','custom');
		$theme_gradient_start = Cryptronick_Theme_Helper::options_compare('theme_gradient_from','mb_page_colors_switch','custom');
		$theme_gradient_end = Cryptronick_Theme_Helper::options_compare('theme_gradient_to','mb_page_colors_switch','custom');
		// BODY BACKGROUND
		$bg_body = Cryptronick_Theme_Helper::options_compare('body_background_color','mb_page_colors_switch','custom');
	} else{
		$theme_color = esc_attr(Cryptronick_Theme_Helper::get_option('theme-custom-color'));
		$use_gradient = Cryptronick_Theme_Helper::get_option('use-gradient');
		$theme_gradient = Cryptronick_Theme_Helper::get_option('theme-gradient');
		$theme_gradient_start = $theme_gradient['from'];
		$theme_gradient_end = $theme_gradient['to'];
		// BODY BACKGROUND
		$bg_body = esc_attr(Cryptronick_Theme_Helper::get_option('body-background-color'));
	}

	// Add class if gradient active
	if ((bool)$use_gradient) {
		add_filter( 'body_class', function( $classes ) {
		    return array_merge( $classes, array( 'theme-gradient' ) );
		} );
	}

	$custom_css = '';

	// END BODY BACKGROUND

	// BODY TYPOGRAPHY
	$main_font = Cryptronick_Theme_Helper::get_option('main-font');
	if (!empty($main_font)) {
		$content_font_family = esc_attr($main_font['font-family']);
		$content_line_height = esc_attr($main_font['line-height']);
		$content_font_size = esc_attr($main_font['font-size']);
		$content_font_weight = esc_attr($main_font['font-weight']);
		$content_color = esc_attr($main_font['color']);
	}else{
		$content_font_family = '';
		$content_line_height = '';
		$content_font_size = '';
		$content_font_weight = '';
		$content_color = '';
	}
	
	// END BODY TYPOGRAPHY

	// HEADER TYPOGRAPHY
	$header_font = Cryptronick_Theme_Helper::get_option('header-font');
	if (!empty($header_font)) {
		$header_font_family = esc_attr($header_font['font-family']);
		$header_font_weight = esc_attr($header_font['font-weight']);
		$header_font_color = esc_attr($header_font['color']);
	}else{
		$header_font_family = '';
		$header_font_weight = '';
		$header_font_color = '';
	}
	
	$h1_font = Cryptronick_Theme_Helper::get_option('h1-font');
	if (!empty($h1_font)) {
		$H1_font_family = !empty($h1_font['font-family']) ? esc_attr($h1_font['font-family']) : '';
		$H1_font_weight = !empty($h1_font['font-weight']) ? esc_attr($h1_font['font-weight']) : '';
		$H1_font_line_height = !empty($h1_font['line-height']) ? esc_attr($h1_font['line-height']) : '';
		$H1_font_size = !empty($h1_font['font-size']) ? esc_attr($h1_font['font-size']) : '';
	}else{
		$H1_font_family = '';
		$H1_font_weight = '';
		$H1_font_line_height = '';
		$H1_font_size = '';
	}
	
	$h2_font = Cryptronick_Theme_Helper::get_option('h2-font');
	if (!empty($h2_font)) {
		$H2_font_family = !empty($h2_font['font-family']) ? esc_attr($h2_font['font-family']) : '';
		$H2_font_weight = !empty($h2_font['font-weight']) ? esc_attr($h2_font['font-weight']) : '';
		$H2_font_line_height = !empty($h2_font['line-height']) ? esc_attr($h2_font['line-height']) : '';
		$H2_font_size = !empty($h2_font['font-size']) ? esc_attr($h2_font['font-size']) : '';
	}else{
		$H2_font_family = '';
		$H2_font_weight = '';
		$H2_font_line_height = '';
		$H2_font_size = '';
	}

	$h3_font = Cryptronick_Theme_Helper::get_option('h3-font');
	if (!empty($h3_font)) {
		$H3_font_family = !empty($h3_font['font-family']) ? esc_attr($h3_font['font-family']) : '';
		$H3_font_weight = !empty($h3_font['font-weight']) ? esc_attr($h3_font['font-weight']) : '';
		$H3_font_line_height = !empty($h3_font['line-height']) ? esc_attr($h3_font['line-height']) : '';
		$H3_font_size = !empty($h3_font['font-size']) ? esc_attr($h3_font['font-size']) : '';
	}else{
		$H3_font_family = '';
		$H3_font_weight = '';
		$H3_font_line_height = '';
		$H3_font_size = '';
	}
	
	$h4_font = Cryptronick_Theme_Helper::get_option('h4-font');
	if (!empty($h4_font)) {
		$H4_font_family = !empty($h4_font['font-family']) ? esc_attr($h4_font['font-family']) : '';
		$H4_font_weight = !empty($h4_font['font-weight']) ? esc_attr($h4_font['font-weight']) : '';
		$H4_font_line_height = !empty($h4_font['line-height']) ? esc_attr($h4_font['line-height']) : '';
		$H4_font_size = !empty($h4_font['font-size']) ? esc_attr($h4_font['font-size']) : '';
	}else{
		$H4_font_family = '';
		$H4_font_weight = '';
		$H4_font_line_height = '';
		$H4_font_size = '';
	}

	$h5_font = Cryptronick_Theme_Helper::get_option('h5-font');
	if (!empty($h5_font)) {
		$H5_font_family = !empty($h5_font['font-family']) ? esc_attr($h5_font['font-family']) : '';
		$H5_font_weight = !empty($h5_font['font-weight']) ? esc_attr($h5_font['font-weight']) : '';
		$H5_font_line_height = !empty($h5_font['line-height']) ? esc_attr($h5_font['line-height']) : '';
		$H5_font_size = !empty($h5_font['font-size']) ? esc_attr($h5_font['font-size']) : '';
	}else{
		$H5_font_family = '';
		$H5_font_weight = '';
		$H5_font_line_height = '';
		$H5_font_size = '';
	}

	$h6_font = Cryptronick_Theme_Helper::get_option('h6-font');
	if (!empty($h6_font)) {
		$H6_font_family = !empty($h6_font['font-family']) ? esc_attr($h6_font['font-family']) : '';
		$H6_font_weight = !empty($h6_font['font-weight']) ? esc_attr($h6_font['font-weight']) : '';
		$H6_font_line_height = !empty($h6_font['line-height']) ? esc_attr($h6_font['line-height']) : '';
		$H6_font_size = !empty($h6_font['font-size']) ? esc_attr($h6_font['font-size']) : '';
		$H6_text_transform = !empty($h6_font['text-transform']) ? esc_attr($h6_font['text-transform']) : '';
	}else{
		$H6_font_family = '';
		$H6_font_weight = '';
		$H6_font_line_height = '';
		$H6_font_size = '';
		$H6_text_transform = '';
	}

	$menu_font = Cryptronick_Theme_Helper::get_option('menu-font');
	if (!empty($menu_font)) {
		$menu_font_family = !empty($menu_font['font-family']) ? esc_attr($menu_font['font-family']) : '';
		$menu_font_weight = !empty($menu_font['font-weight']) ? esc_attr($menu_font['font-weight']) : '';
		$menu_font_line_height = !empty($menu_font['line-height']) ? esc_attr($menu_font['line-height']) : '';
		$menu_font_size = !empty($menu_font['font-size']) ? esc_attr($menu_font['font-size']) : '';
	}else{
		$menu_font_family = '';
		$menu_font_weight = '';
		$menu_font_line_height = '';
		$menu_font_size = '';
	}

	$name_preset = Cryptronick_Theme_Helper::header_preset_name();
	$get_def_name = get_option( 'cryptronick_preset' );
	$def_preset = false;
	if(isset($get_def_name['default']) && $name_preset){
		if(array_key_exists($name_preset, $get_def_name['default']) && !array_key_exists($name_preset, $get_def_name)){
			$def_preset = true;
		}	
	}

	// Set Queris width to apply mobile style
    $sub_menu_color = Cryptronick_Theme_Helper::get_option('sub_menu_color' ,$name_preset, $def_preset);
    $sub_menu_bg = Cryptronick_Theme_Helper::get_option('sub_menu_background' ,$name_preset, $def_preset);


	$mobile_sub_menu_bg = Cryptronick_Theme_Helper::get_option('mobile_sub_menu_background');
	$mobile_sub_menu_color = Cryptronick_Theme_Helper::get_option('mobile_sub_menu_color');


	// END HEADER TYPOGRAPHY


	$custom_css = '
    /* Custom CSS */
	
	body,
	.blog-post_quote-text,
	.isotope-filter a .number_filter,
	.blog-post_link>a{
		font-family:' . $content_font_family . ';
	}
	body {
		'.(!empty($bg_body) ? 'background:'.$bg_body.';' : '').'
		font-size:'.$content_font_size.';
		line-height:'.$content_line_height.';
		font-weight:'.$content_font_weight.';
		color: '.$content_color.';
	}
	.wpb-js-composer .vc_row .vc_tta.vc_general .vc_tta-panel-title > a span,
	.wpb-js-composer .vc_row .vc_tta.vc_general .vc_tta-panel-title > a .vc_tta-controls-icon,
	.vc_row .vc_toggle .vc_toggle_title h4,
	.vc_row .vc_toggle .vc_toggle_icon,
	body input::placeholder, body textarea::placeholder,
	.woocommerce input::placeholder,
	.widget_product_search .woocommerce-product-search:before,
	#mc_embed_signup .mc-field-group input::placeholder{
		color: '.$content_color.';
	}
	/* Custom Fonts */
	h1, h1 span, h1 a,
	h2, h2 span, h2 a,
	h3, h3 span, h3 a,
	h4, h4 span, h4 a,
	h5, h5 span, h5 a,
	h6, h6 span, h6 a,
	.calendar_wrap tbody,
	.widget.widget_posts .recent_posts .post_title a,
	.cryptronick_module_testimonials .testimonials_name,
	.author-widget_title,
	.author-widget_text,
	.woocommerce .widget_shopping_cart .total strong, .woocommerce.widget_shopping_cart .total strong,
	.woocommerce div.product .woocommerce-tabs .panel #respond #commentform label,
	.woocommerce div.product form.cart div.quantity .qty,
	.bpt_module_title.item_title .carousel_arrows a span:after,
	.bpt_module_team.info_under_image .team-department{
		color: '.$header_font_color.';
	}
	h1, h1 span, h1 a,
	h2, h2 span, h2 a,
	h3, h3 span, h3 a,
	h4, h4 span, h4 a,
	h5, h5 span, h5 a,
	h6, h6 span, h6 a,
	.strip_template .strip-item a span,
	.column1 .item_title a,
	.index_number,
	.prev_next_links a b,
	.shortcode_tab_item_title,
	.blog-post .button-read-more,
	.main-menu.footer-menu .menu-item a,
	.widget.widget_posts .recent_posts li > .recent_posts_content .post_title,
	.cryptronick_twitter .twitt_title,
	.woocommerce #respond input#submit, 
	.woocommerce a.button, 
	.woocommerce button.button, 
	.woocommerce input.button,
	input[type="submit"], button{
		font-family: ' . $header_font_family . ';
		font-weight: ' . $header_font_weight . '
	}
	.cryptronick_module_button,
	.likes_block .sl-count,
	.countdown-section .countdown-amount,
	.countdown-period,
	.vc_row .vc_tta.vc_general.vc_tta-style-accordion_bordered .vc_tta-panel-title>a span,
	.cryptronick_module_infobox .infobox_button,
	.cryptronick_module_infobox .infobox_icon_container .infobox_icon_number,
	.comment-reply-link,
	.share_link,
	.prev-link,
	.next-link,
	.load_more_item,
	.isotope-filter a,
	.banner_404,
	.cryptronick_404_button a,
	.blog-post_quote-text:before,
	.product_list_widget .product-title,
	.woo_product_image a.add_to_cart_button,
	.product_list_widget .woocommerce-Price-amount,
	.woocommerce ul.cart_list li a, .woocommerce ul.product_list_widget li a,
	.woocommerce ul.cart_list li .quantity,
	.woocommerce div.product form.cart .group_table tr td label,
	.woocommerce .widget_shopping_cart .total,
	.woocommerce div.product p.price, .woocommerce div.product span.price,
	.woocommerce div.product .woocommerce-tabs ul.tabs li a,
	.woocommerce div.product .woocommerce-tabs .panel table.shop_attributes th,
	.woocommerce table.shop_table thead th,
	.woocommerce table.shop_table .woocommerce-Price-amount.amount,
	#add_payment_method .wc-proceed-to-checkout a.checkout-button, 
	.woocommerce-cart .wc-proceed-to-checkout a.checkout-button, 
	.woocommerce-checkout .wc-proceed-to-checkout a.checkout-button,
	.woocommerce .cart-collaterals .cart_totals table th, 
	.woocommerce-page .cart-collaterals .cart_totals table th,
	.woocommerce #respond input#submit, 
	.woocommerce a.button, .woocommerce button.button, 
	.woocommerce input.button,
	.woocommerce .product_meta > span,
	.woocommerce .price_label,
	.share_link,
	blockquote:before,
	blockquote,
	.bpt-theme-header .woo_mini-count span,
	body .vc_pie_chart .vc_pie_chart_value{
		font-family: ' . $header_font_family . ';
	}
	.vc_row .vc_progress_bar .vc_single_bar .vc_label,
	.woocommerce ul.cart_list li a, .woocommerce ul.product_list_widget li a,
	.woocommerce div.product form.cart .button,
	.woocommerce div.product form.cart button.button.alt,
	.woocommerce table.shop_table td.product-name,
	.meta-wrapper .author_post a,		
	.post_share, .likes_block .sl-count,
	.author-info_wrapper .title_soc_share,
	.info_prev-link_wrapper a,
	.info_next-link_wrapper a,	
	.product_list_widget .product-title{
		font-family: ' . $header_font_family . ';
		color: '.$header_font_color.';
	}
	.woocommerce #respond input#submit.disabled, 
	.woocommerce #respond input#submit:disabled, 
	.woocommerce #respond input#submit:disabled[disabled], 
	.woocommerce a.button.disabled, 
	.woocommerce a.button:disabled, 
	.woocommerce a.button:disabled[disabled], 
	.woocommerce button.button.disabled, 
	.woocommerce button.button:disabled, 
	.woocommerce button.button:disabled[disabled], 
	.woocommerce input.button.disabled, 
	.woocommerce input.button:disabled, 
	.woocommerce input.button:disabled[disabled]{
		color: '.$header_font_color.' !important;
	}	
	h1, h1 a, h1 span {
		'.(!empty($H1_font_family) ? 'font-family:'.$H1_font_family.';' : '' ).'
		'.(!empty($H1_font_weight) ? 'font-weight:'.$H1_font_weight.';' : '' ).'
		'.(!empty($H1_font_size) ? 'font-size:'.$H1_font_size.';' : '' ).'
		'.(!empty($H1_font_line_height) ? 'line-height:'.$H1_font_line_height.';' : '' ).'
	}
	h2, h2 a, h2 span {
		'.(!empty($H2_font_family) ? 'font-family:'.$H2_font_family.';' : '' ).'
		'.(!empty($H2_font_weight) ? 'font-weight:'.$H2_font_weight.';' : '' ).'
		'.(!empty($H2_font_size) ? 'font-size:'.$H2_font_size.';' : '' ).'
		'.(!empty($H2_font_line_height) ? 'line-height:'.$H2_font_line_height.';' : '' ).'
	}
	h3, h3 a, h3 span,
	.sidepanel .title{
		'.(!empty($H3_font_family) ? 'font-family:'.$H3_font_family.';' : '' ).'
		'.(!empty($H3_font_weight) ? 'font-weight:'.$H3_font_weight.';' : '' ).'
		'.(!empty($H3_font_size) ? 'font-size:'.$H3_font_size.';' : '' ).'
		'.(!empty($H3_font_line_height) ? 'line-height:'.$H3_font_line_height.';' : '' ).'
	}
	h4, h4 a, h4 span,
	.prev_next_links a b {
		'.(!empty($H4_font_family) ? 'font-family:'.$H4_font_family.';' : '' ).'
		'.(!empty($H4_font_weight) ? 'font-weight:'.$H4_font_weight.';' : '' ).'
		'.(!empty($H4_font_size) ? 'font-size:'.$H4_font_size.';' : '' ).'
		'.(!empty($H4_font_line_height) ? 'line-height:'.$H4_font_line_height.';' : '' ).'
	}
	h5, h5 a, h5 span {
		'.(!empty($H5_font_family) ? 'font-family:'.$H5_font_family.';' : '' ).'
		'.(!empty($H5_font_weight) ? 'font-weight:'.$H5_font_weight.';' : '' ).'
		'.(!empty($H5_font_size) ? 'font-size:'.$H5_font_size.';' : '' ).'
		'.(!empty($H5_font_line_height) ? 'line-height:'.$H5_font_line_height.';' : '' ).'
	}
	h6, h6 a, h6 span {
		'.(!empty($H6_font_family) ? 'font-family:'.$H6_font_family.';' : '' ).'
		'.(!empty($H6_font_weight) ? 'font-weight:'.$H6_font_weight.';' : '' ).'
		'.(!empty($H6_font_size) ? 'font-size:'.$H6_font_size.';' : '' ).'
		'.(!empty($H6_font_line_height) ? 'line-height:'.$H6_font_line_height.';' : '' ).'
		'.(!empty($H6_text_transform) ? 'text-transform:'.$H6_text_transform.';' : '' ).'
	}

	.diagram_item .chart,
	.item_title a ,
	.contentarea ul,
	body .vc_pie_chart .vc_pie_chart_value{
		color:'. $header_font_color .';
	}
	.share_link span,
    .vc_row .vc_progress_bar:not(.vc_progress-bar-color-custom) .vc_single_bar .vc_label:not([style*="color"]) {
    	color: '. $header_font_color .' !important;
    }

	/* Theme color */
	blockquote:before,
	a,
	.footer_top-area a:hover,
	.footer_top-area .widget.widget_archive ul li > a:hover,
	.footer_top-area .widget.widget_categories ul li > a:hover,
	.footer_top-area .widget.widget_pages ul li > a:hover,
	.footer_top-area .widget.widget_meta ul li > a:hover,
	.footer_top-area .widget.widget_recent_comments ul li > a:hover,
	.footer_top-area .widget.widget_recent_entries ul li > a:hover,
	.footer_top-area .widget.widget_nav_menu ul li > a:hover,
	.calendar_wrap thead,
	.load_more_works:hover,
	.copyright a:hover,
	button,
	.mc_form_inside #mc_signup_submit:hover,
	.bpt_portfolio_category-wrapper a:hover,
	.cryptronick_module_testimonials .testimonials_quote:before,
	input[type="submit"]:hover,
	.cryptronick_module_message_box .message_title,
	.blog-post_quote-text:before,
	.blog-post_link:before,
	.blog-post_link>a:hover,
	.bpt_module_team .team-department,
	.widget.widget_recent_comments ul li a,
	.single_team_page .team-info_wrapper .team-info_icons a:hover,
	ul.bpt-products .price,
	.product_list_widget .woocommerce-Price-amount,
	.single_team_page .team-info_wrapper .team-info_item a:hover,
	.woocommerce ul.cart_list li a:hover, .woocommerce ul.product_list_widget li a:hover,
	.product_list_widget .product-title:hover,
	.product_list_widget li:hover .product-title,
	.woocommerce div.product p.price, .woocommerce div.product span.price,
	a:hover .bpt-icon,
	.woocommerce div.product form.cart .reset_variations:before,
	.woocommerce p.stars a,
	.woocommerce table.shop_table .order-total .woocommerce-Price-amount.amount,
	.meta-wrapper span:after,
	.woocommerce form .form-row .required,
	.woocommerce table.shop_table td.product-name a:hover,
	.cryptronick_module_demo_item .di_title_wrap a:hover .di_title,
	.bpt-theme-header .woo_mini-count span,
	.bpt-theme-header .woo_mini_cart .woocommerce-mini-cart__total span,
	.widget-title:after,
	.blog-post_cats span,
	.author-info_social-wrapper,
	.header_search .header_search__icon > i:hover,
	.single_team_page .team-info_wrapper .team-department span,
	.cryptronick_module_social .soc_icon:hover,
	.cryptronick_module_testimonials.type_author_top .testimonials_content_wrap:before,
	.bpt-icon:hover,
	.wpml-ls a:hover,
	.wpml-ls-legacy-dropdown .wpml-ls-current-language:hover > a,
	.wpml-ls-legacy-dropdown .wpml-ls-current-language a:hover,
	.single_team_page .team-info_icons a:hover,
	.product-categories a:hover,
	.bpt-theme-header .mini-cart .woocommerce-mini-cart.cart_list.product_list_widget li a:hover,
	.product-categories .current-cat a,
	.inside_image .bpt_portfolio_item-meta .post_cats:hover,
	.bpt_module_team.grayscale .team-item_content .team-icon:hover, 
	.bpt_module_team.grayscale .team-title > a:hover{
		color: '.$theme_color.';
	}
	.widget.widget_archive ul li a:hover,
	.widget.widget_categories ul li a:hover,
	.widget.widget_pages ul li a:hover,
	.widget.widget_meta ul li a:hover,
	.widget.widget_recent_comments ul li a:hover,
	.widget.widget_recent_entries ul li a:hover,
	.widget.widget_nav_menu ul li a:hover{
		color: '.$theme_color.';
	}


	mark,
	.meta-wrapper span:after,		
	.blog-post_cats span a,
	ul.bpt-pagination li a:hover,
	ul.bpt-pagination li a:focus,	
	.woocommerce nav.woocommerce-pagination ul li a:hover,
	.woocommerce nav.woocommerce-pagination ul li a:focus,
	.main_menu_container .menu_item_line,
	.load_more_works,
	button:hover,
	.mc_form_inside #mc_signup_submit,
	.cryptronick_module_carousel .slick-dots li button,
	.main_wrapper ul.cryptronick_dash li:before,
	.widget_archive ul li .post_count, 
	.widget_categories ul li .post_count,
	.main_wrapper ul li:before,
	.isotope-filter a .number_filter,
	.woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content,
	.woo_product_image .picture:hover a.add_to_cart_button:hover, .woo_product_image .picture:hover a.button:hover,
	.woo_product_image .added_to_cart.wc-forward:hover,
	.woocommerce nav.woocommerce-pagination ul li span.current,
	.vc_wp_custommenu .menu .menu-item a:before,
	.woocommerce div.product form.cart button.button.alt:hover,
	.cryptronick_module_infobox.type_tile:hover:before,
	.cryptronick_module_carousel.pagination_line .slick-dots li button:before,
	.widget-title:after, .widget-title:before,
	.widget .counter_posts,
	.main-menu ul li ul li > a span:before,
	.main-menu > ul > li > a span:before,
	.cryptronick_module_social.with_bg .soc_icon,
	.wpb-js-composer .vc_row .vc_general.vc_tta-tabs .vc_tta-tabs-list .vc_tta-tab.vc_active > a:before,
	.wpml-ls-legacy-dropdown .wpml-ls-sub-menu .wpml-ls-item a:before,
	.cryptronick_module_pricing_plan .pricing_header,
	.product-categories .cat-item .post_count,
	.widget.widget_pages ul li a:before,
	.widget.widget_nav_menu ul li a:before,
	.bpt-theme-header .woo_mini_cart .woocommerce-mini-cart__buttons a.checkout,
	.isotope-filter a:before{
		background-color: '.$theme_color.';
	}
	.cryptronick_module_infobox.type_tile{
		border-top-color: '.$theme_color.';
	}
	.bpt-theme-header .header_search .header_search__inner:after{
		border-bottom-color: rgba('.Cryptronick_Theme_Helper::HexToRGB($theme_color).', 0.9);
	}
	#back_to_top,
	.woocommerce .widget_shopping_cart .buttons a:not(.checkout):hover, 
	.woocommerce.widget_shopping_cart .buttons a:not(.checkout):hover,
	.bpt-theme-header .woo_mini_cart .woocommerce-mini-cart__buttons a.button.wc-forward:not(.checkout):hover{
		color: '.$theme_gradient_start.';
	}
	#back_to_top,
	.woocommerce.widget_shopping_cart .buttons a,
	.bpt-theme-header .woo_mini_cart .woocommerce-mini-cart__buttons a.button.wc-forward:not(.checkout){
		border-color: '.$theme_gradient_start.';
	}
	#back_to_top:hover,
	.woocommerce.widget_shopping_cart .buttons a,
	.bpt-theme-header .woo_mini_cart .woocommerce-mini-cart__buttons a.button.wc-forward:not(.checkout){
		background-color: '.$theme_gradient_start.';
	}
	.bpt_module_team.with_shadow .team-item_content:before,
	.single_team_page .team-single_wrapper:before,
	.cryptronick_module_message_box,
	.cryptronick_module_flipbox.with_shadow .flipbox_front,
	.cryptronick_module_flipbox.with_shadow .flipbox_back,
	.cryptronick_module_testimonials .testimonials_item_wrap{
		box-shadow: 0px 0px 27px 0px rgba('.Cryptronick_Theme_Helper::HexToRGB($theme_gradient_start).', 0.1);
	}
	.cryptronick_module_time_line_vertical .time_line-content,
	.cryptronick_module_infobox.type_tile.tile_shadow,
	.woocommerce div.product div.images .flex-control-thumbs li:hover,
	.woocommerce #order_review,
	.bpt-theme-header .woo_mini_cart,
	.cryptronick_module_pricing_plan.recommended .pricing_plan_wrap{
		box-shadow: 0px 0px 18px 0px rgba('.Cryptronick_Theme_Helper::HexToRGB($theme_gradient_start).', 0.1);
	}
	.cryptronick_module_time_line_vertical .time_line-item:hover .time_line-content{
		box-shadow: 0px 0px 28px 0px rgba('.Cryptronick_Theme_Helper::HexToRGB($theme_gradient_start).', 0.2);
	}
	.cryptronick_module_time_line_vertical .time_line-check:before,
	.cryptronick_module_time_line_vertical .time_line-check:after{
		box-shadow: 0px 0px 27px 0px rgba('.Cryptronick_Theme_Helper::HexToRGB($theme_gradient_start).', 0.15);
	}	
	.woocommerce .widget_price_filter .ui-slider .ui-slider-handle{
		box-shadow: 0px 0px 18px 0px rgba('.Cryptronick_Theme_Helper::HexToRGB($theme_gradient_start).', 0.23);
	}
	.vc_row.row-box-shadow{
		box-shadow: 0px 0px 27px 0px rgba('.Cryptronick_Theme_Helper::HexToRGB($theme_gradient_start).', 0.05);
	}	
	.blog-style-standard .blog-post:hover .blog-post_wrapper{
		box-shadow: 0px 20px 50px 0px rgba('.Cryptronick_Theme_Helper::HexToRGB($theme_gradient_start).', 0.12);
	}
	.main-menu ul li ul,ul.bpt-products li:hover, .woocommerce .products ul.bpt-products li:hover,.wpml-ls-legacy-dropdown .wpml-ls-sub-menu, .bpt-theme-header .header_search__inner,
	.main-menu ul li ul,.wpml-ls-legacy-dropdown .wpml-ls-sub-menu, .bpt-theme-header .header_search__inner{
		box-shadow: 0px 0px 18px 0px rgba('.Cryptronick_Theme_Helper::HexToRGB($theme_gradient_start).', 0.1);
	}
	.cryptronick_module_time_line_vertical:before{
		background: -webkit-linear-gradient(top, transparent 0%, rgba('.Cryptronick_Theme_Helper::HexToRGB($theme_gradient_start).', 0.15) 100px, rgba('.Cryptronick_Theme_Helper::HexToRGB($theme_gradient_start).', 0.15) calc(100% - 100px), transparent 100%);
	}
	.nivo-directionNav .nivo-prevNav,
	.nivo-directionNav .nivo-nextNav,
	.calendar_wrap caption,
	.widget .calendar_wrap table td#today:before,
	.woocommerce #respond input#submit.disabled:hover, 
	.woocommerce #respond input#submit:disabled:hover, 
	.woocommerce #respond input#submit:disabled[disabled]:hover, 
	.woocommerce a.button.disabled:hover, 
	.woocommerce a.button:disabled:hover, 
	.woocommerce a.button:disabled[disabled]:hover, 
	.woocommerce button.button.disabled:hover, 
	.woocommerce button.button:disabled:hover, 
	.woocommerce button.button:disabled[disabled]:hover, 
	.woocommerce input.button.disabled:hover, 
	.woocommerce input.button:disabled:hover, 
	.woocommerce input.button:disabled[disabled]:hover,
	.video_popup_link{
		background: '.$theme_color.';
	}

	.cryptronick_module_button a,
	.tagcloud a:hover,
	.load_more_item,
	.blog-post_cats span a,
	.bpt-theme-header .woo_mini_cart .woocommerce-mini-cart__buttons a.checkout,
	.woocommerce .widget_shopping_cart .buttons a.checkout, 
	.woocommerce.widget_shopping_cart .buttons a.checkout,
	.single-product div.product .woocommerce-product-gallery .woocommerce-product-gallery__trigger:hover,
	.dropcap.alt{
		border-color: '.$theme_color.';
		background: '.$theme_color.';
	}
	.cryptronick_submit_wrapper:hover > i,
	.wpb-js-composer .vc_row .vc_tta.vc_general .vc_active .vc_tta-panel-title > a span, 
	.wpb-js-composer .vc_row .vc_tta.vc_general .vc_active .vc_tta-panel-title > a .vc_tta-controls-icon,
	.vc_row .vc_toggle.vc_toggle_active .vc_toggle_title h4,
	.vc_row .vc_toggle.vc_toggle_active .vc_toggle_title i,
	.wpb-js-composer .vc_row .vc_general.vc_tta-tabs .vc_tta-tabs-list .vc_tta-tab.vc_active{
		color:'.$theme_color.';
	}
	.nivo-directionNav .nivo-prevNav:hover:after,
	.nivo-directionNav .nivo-nextNav:hover:after,
	ul.bpt-pagination li a,
	ul.bpt-pagination li span,
	.load_more_works,
	.woocommerce div.product form.cart .button,
	input[type="submit"],
	.woocommerce #respond input#submit.disabled, 
	.woocommerce #respond input#submit:disabled, 
	.woocommerce #respond input#submit:disabled[disabled], 
	.woocommerce a.button.disabled, 
	.woocommerce a.button:disabled, 
	.woocommerce a.button:disabled[disabled], 
	.woocommerce button.button.disabled, 
	.woocommerce button.button:disabled, 
	.woocommerce button.button:disabled[disabled], 
	.woocommerce input.button.disabled, 
	.woocommerce input.button:disabled, 
	.woocommerce input.button:disabled[disabled],
	button,
	.banner-widget_button{
		border-color: '.$theme_color.';
	}

	.cryptronick_module_button a:hover,.load_more_item:hover {
		border-color: '.$theme_color.';
	}

	.cryptronick_module_button a:hover,
	.load_more_item:hover,
	.info_prev-link_wrapper a:hover,
	.bpt-theme-header .woo_mini_cart .woocommerce-mini-cart__buttons a.checkout:hover,
	.woocommerce .widget_shopping_cart .buttons a.checkout:hover, 
	.woocommerce.widget_shopping_cart .buttons a.checkout:hover,
	.info_next-link_wrapper a:hover,	
	.team-icons .member-icon:hover {
		color: '.$theme_color.';
	}

	.widget_nav_menu .menu .menu-item:before,
	input[type="submit"] {
		background-color: '.$theme_color.';
	}
	.single-member-page .member-icon:hover,
	.single-member-page .team-link:hover{
		color: '.$theme_color.';
	}

	/* menu fonts */
	.main-menu>ul,
	.wpml-ls,
	.main-menu>div>ul{
		font-family:'.esc_attr($menu_font_family).';
		font-weight:'.esc_attr($menu_font_weight).';
		line-height:'.esc_attr($menu_font_line_height).';
		font-size:'.esc_attr($menu_font_size).';
	}

	/* sub menu styles */
	.bpt-theme-header .header_search__inner,
	.main-menu ul li ul,
	.bpt-theme-header .woo_mini_cart,
	.wpml-ls-legacy-dropdown .wpml-ls-current-language:hover .wpml-ls-sub-menu
	{
		background-color: ' .(!empty($sub_menu_bg['rgba']) ? esc_attr( $sub_menu_bg['rgba'] ) : "#fff" ).' ;
		color: '.esc_attr( $sub_menu_color ).' ;
	}
	.mobile_menu_container{
		background-color: ' .(!empty($mobile_sub_menu_bg['rgba']) ? esc_attr( $mobile_sub_menu_bg['rgba'] ) : "#fff" ).' ;
		color: '.esc_attr( $mobile_sub_menu_color ).' ;		
	}

	.bpt-theme-header .header_search__inner .search_text::-webkit-input-placeholder{
		color: '.esc_attr( $sub_menu_color ).' !important;
	}
	.bpt-theme-header .header_search__inner .search_text:-moz-placeholder{
		color: '.esc_attr( $sub_menu_color ).' !important;
	}
	.bpt-theme-header .header_search__inner .search_text::-moz-placeholder{
		color: '.esc_attr( $sub_menu_color ).' !important;
	}
	.bpt-theme-header .header_search__inner .search_text:-ms-input-placeholder{
		color: '.esc_attr( $sub_menu_color ).' !important;
	}

	/* blog */
	.post_share > a,
	.like_count,
	.likes_block .icon,
	ul.bpt-pagination li a,
	.woocommerce nav.woocommerce-pagination ul li a,
	.woocommerce nav.woocommerce-pagination ul li a.next.page-numbers:after,
	.woocommerce nav.woocommerce-pagination ul li a.prev.page-numbers:after,
	ul.bpt-pagination li span,
	.widget_search .search_form:after,
	.recent_posts .meta-wrapper a:hover,
	.woocommerce-error, .woocommerce-info, .woocommerce-message,
	.flex-direction-nav a:before{
		color: '.$content_color.';
	}	
	.cryptronick_module_carousel .slick-prev:after, 
	.cryptronick_module_carousel .slick-next:after,
	.nivo-directionNav a.nivo-nextNav:before, 
	.nivo-directionNav a.nivo-prevNav:before, 
	.flex-direction-nav a:before,
	.flex-direction-nav a.flex-next:before{
		border-color: '.$content_color.';
	}

	.meta-wrapper a:hover,
	.blog-post_title a:hover,
	.post_share:hover > a:before,
	.blog-posts .meta-wrapper a:hover,
	.recent_posts .meta-wrapper a,
	 .product_meta > span a:hover,
	 .woocommerce .summary .product_meta > span a:hover,
	.widget.widget_posts .recent_posts li > .recent_posts_content .post_title a:hover,
	.vc_wp_custommenu .menu .menu-item.current-menu-item > a,
	.vc_wp_custommenu .menu .menu-item.current-menu-ancestor > a,
	.comment-reply-link:hover,
	.footer_top-area .widget.widget_posts .recent_posts li > .recent_posts_content .post_title a:hover{
		color: '.$theme_color.';
	}
	.hover_links a:hover{
		color: '.$theme_color.' !important;
	}	
	.button-read-more,
	.blog-post_title i {
		color: '.$theme_color.';
	}
	.blog-posts .meta-wrapper,
	.blog-posts .meta-wrapper a{
		color: '.$header_font_color.';
	}
	.cryptronick_module_title .carousel_arrows a:hover span,
	.prev_next_links a span i {background: '.$theme_color.';
	}
	.cryptronick_module_title .carousel_arrows a:hover span:before,
	.prev_next_links a span i:before {border-color: '.$theme_color.';
	}
	.cryptronick_module_title .carousel_arrows a span {background: '.$header_font_color.';
	}
	.cryptronick_module_title .carousel_arrows a span:before {border-color: '.$header_font_color.';
	}
	.likes_block:hover .icon,
	.likes_block.already_liked .icon,
	.isotope-filter a:hover,
	.isotope-filter a.active,
	.share_wrap a span,
	.blog-post.format-standard.link .blog-post_title:before{
		color: '.$theme_color.';
	}
	.blog-post_quote-author{
		color: '.$header_font_color.';
	}
	ul.bpt-pagination li a.current,
	ul.bpt-pagination li span{
		background: '.$theme_color.';
	}

	.cryptronick_module_title .external_link .button-read-more {
		line-height:'.$content_line_height.';
	}
	ol.commentlist:after {
		'.(!empty($bg_body) ? 'background:'.$bg_body.';' : '').'
	}

	.comment_author_says a:hover,
	.prev_next_links a:hover b,
	.dropcap,
	.cryptronick_custom_text a,
	.cryptronick_custom_button i {
		color: '.$theme_color.';
	}
	.product-categories a,
	h3#reply-title a,
	.comment_author_says,
	.comment_author_says a,
	.prev_next_links a b,
	.bpt_module_team:not(.grayscale) .team-item_content .team-icon:hover,
	.bpt_module_team:not(.grayscale) .team-title > a:hover {
		color: '.$header_font_color.';
	}

	h3#reply-title a:hover,
	.main_wrapper ol > li:before,
	.main-menu>ul>li:hover>a>span,
	.main-menu>ul>li:hover>a:after,
	.main-menu ul li ul .menu-item a:hover,
	.main-menu ul li ul .menu-item.current-menu-item > a,
	.main-menu ul li.menu-item.current-menu-ancestor > a,
	.main-menu ul li.menu-item.current-menu-item > a,
	.main_wrapper ul li:before,
	.footer ul li:before,
	.cryptronick_twitter a{
		color: '.$theme_color.';
	}

	::-moz-selection{background: '.$theme_color.';}
	::selection{background: '.$theme_color.';}
    ';

    //sticky header logo 
    $header_sticky_height = Cryptronick_Theme_Helper::get_option('header_sticky_height');
    
    //sticky header color
    $header_sticky_color = Cryptronick_Theme_Helper::get_option('header_sticky_color');
    $custom_css .='
    .bpt-sticky-header .bpt-logotype-container > a,
    .bpt-sticky-header .bpt-logotype-container > a > img{
    	max-height: '.((int)$header_sticky_height['height']*0.9).'px !important;
    }
    .bpt-theme-header .bpt-sticky-header .header_search{
    	height: '.((int)$header_sticky_height['height']).'px !important;
    }    
    .bpt-theme-header .bpt-sticky-header .delimiter:after{
    	background: '.(esc_attr($header_sticky_color)).';
    }



	input::-webkit-input-placeholder,
	textarea::-webkit-input-placeholder {
		color: '.$header_font_color.';
	}
	input:-moz-placeholder,
	textarea:-moz-placeholder { /* Firefox 18- */
		color: '.$header_font_color.';
	}
	input::-moz-placeholder,
	textarea::-moz-placeholder {  /* Firefox 19+ */
		color: '.$header_font_color.';
	}
	input:-ms-input-placeholder,
	textarea:-ms-input-placeholder {
		color: '.$header_font_color.';
	}

    ';

    $gradient_class = (bool)$use_gradient ? '.theme-gradient ' : '';

    $custom_css .= '
	/* Theme Gradient  */
	.content-container .vc_progress_bar.vc_progress-bar-color-bar_grey .vc_single_bar .vc_bar,
	.di_button.cryptronick_module_button.button_gradient a:before,
	aside > .widget + .widget:before,
	.footer .widget + .widget:before,
	.bpt_module_team .team-item_content:after {';
	    if ( (bool)$use_gradient ) {
	    	$custom_css .= '
			background: '.$theme_gradient_start.';
			background: -moz-linear-gradient(-30deg, '.$theme_gradient_start.' 0%, '.$theme_gradient_end.' 100%);
			background: -webkit-gradient(left top, right bottom, color-stop(0%, '.$theme_gradient_start.'), color-stop(100%, '.$theme_gradient_end.'));
			background: -webkit-linear-gradient(-30deg, '.$theme_gradient_start.' 0%, '.$theme_gradient_end.' 100%);
			background: -o-linear-gradient(-30deg, '.$theme_gradient_start.' 0%, '.$theme_gradient_end.' 100%);
			background: -ms-linear-gradient(-30deg, '.$theme_gradient_start.' 0%, '.$theme_gradient_end.' 100%);
			background: linear-gradient(120deg, '.$theme_gradient_start.' 0%, '.$theme_gradient_end.' 100%);
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="'.$theme_gradient_start.'", endColorstr="#fa6661", GradientType=1 );';
		} else {
			$custom_css .= 'background-color: '.$theme_color.';';
		}
	$custom_css .= '}';

	$custom_css .= '
	/* Theme Gradient  */
	.di_button.cryptronick_module_button.button_gradient a:after{';
	    if ( (bool)$use_gradient ) {
	    	$custom_css .= '
			background: '.$theme_gradient_end.';
			background: -moz-linear-gradient(-30deg, '.$theme_gradient_end.' 0%, '.$theme_gradient_start.' 100%);
			background: -webkit-gradient(left top, right bottom, color-stop(0%, '.$theme_gradient_end.'), color-stop(100%, '.$theme_gradient_start.'));
			background: -webkit-linear-gradient(-30deg, '.$theme_gradient_end.' 0%, '.$theme_gradient_start.' 100%);
			background: -o-linear-gradient(-30deg, '.$theme_gradient_end.' 0%, '.$theme_gradient_start.' 100%);
			background: -ms-linear-gradient(-30deg, '.$theme_gradient_end.' 0%, '.$theme_gradient_start.' 100%);
			background: linear-gradient(120deg, '.$theme_gradient_end.' 0%, '.$theme_gradient_start.' 100%);
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="'.$theme_gradient_start.'", endColorstr="#fa6661", GradientType=1 );';
		} else {
			$custom_css .= 'background-color: '.$theme_color.';';
		}
	$custom_css .= '}';

	$custom_css .= '
	'.$gradient_class.'input[type="submit"],
	'.$gradient_class.'.load_more_item,
	'.$gradient_class.'.widget_price_filter .price_slider_amount button.button,
	'.$gradient_class.'.woocommerce .widget_shopping_cart .buttons a, 
	'.$gradient_class.'#respond input#submit, 
	'.$gradient_class.'#respond input#submit:hover, 
	'.$gradient_class.'.cryptronick_404_button a,
	'.$gradient_class.'.woocommerce table.shop_table.cart input.button:hover,
	'.$gradient_class.'.woocommerce a.button.alt,
	'.$gradient_class.'.woocommerce button.button:hover,
	'.$gradient_class.'.woocommerce-message .button,
	'.$gradient_class.'.woocommerce-message .button:hover,
	'.$gradient_class.'.woocommerce .form-row.place-order .button,
	'.$gradient_class.'.woocommerce .shop_table .actions .button,
	'.$gradient_class.'.woocommerce button.button,
	'.$gradient_class.'.bpt_module_title.item_title .carousel_arrows a:hover,
	'.$gradient_class.'ul.bpt-products li a.add_to_cart_button, 
	'.$gradient_class.'ul.bpt-products li a.button, 
	'.$gradient_class.'ul.bpt-products li .added_to_cart.wc-forward,
	'.$gradient_class.'div.product form.cart button.button.alt,
	'.$gradient_class.'div.product .woocommerce-tabs .panel table.shop_attributes th,
	'.$gradient_class.'.banner-widget_button {';
	if ( (bool)$use_gradient ) {
		$custom_css .= '
		background: -webkit-linear-gradient(left, '.$theme_gradient_start.' 0%, '.$theme_gradient_end.' 50%, '.$theme_gradient_start.' 100%);
		background-size: 300%, 1px;
    	background-position: 0%;';
	} else {
		$custom_css .= 'background-color:'.$theme_color.';';
	}
	$custom_css .= '}';

	$custom_css .= '
	'.$gradient_class.'.load_more_wrapper.full_width_btn .load_more_item{';
	if ( (bool)$use_gradient ) {
		$custom_css .= '
		background: -webkit-linear-gradient(left, '.$theme_gradient_start.' 0%, '.$theme_gradient_end.' 50%, '.$theme_gradient_start.' 100%);
		background-size: 200%, 1px;
    	background-position: 0%;';
	} else {
		$custom_css .= 'background-color:'.$theme_color.';';
	}
	$custom_css .= '}';


    // footer styles
    $footer_text_color = Cryptronick_Theme_Helper::options_compare('footer_text_color','mb_footer_switch','yes');
    $footer_heading_color = Cryptronick_Theme_Helper::options_compare('footer_heading_color','mb_footer_switch','yes');
    $custom_css .= '.footer_top-area .widget-title,
    .footer_top-area .widget.widget_posts .recent_posts li > .recent_posts_content .post_title a,
    .footer_top-area .widget.widget_archive ul li > a,
	.footer_top-area .widget.widget_categories ul li > a,
	.footer_top-area .widget.widget_pages ul li > a,
	.footer_top-area .widget.widget_meta ul li > a,
	.footer_top-area .widget.widget_recent_comments ul li > a,
	.footer_top-area .widget.widget_recent_entries ul li > a,
	.footer_top-area strong,
	.footer_top-area h1,
	.footer_top-area h2,
	.footer_top-area h3,
	.footer_top-area h4,
	.footer_top-area h5,
	.footer_top-area h6{
    	color: '.esc_attr($footer_heading_color).' ;
    }
    .footer_top-area{
    	color: '.esc_attr($footer_text_color).';
    }';

    $copyright_text_color = Cryptronick_Theme_Helper::options_compare('copyright_text_color','mb_footer_switch','yes');
    $custom_css .= '.footer .copyright{
    	color: '.esc_attr($copyright_text_color).';
    }';


    // Mobile Header Css render
    $mobile_header = Cryptronick_Theme_Helper::get_option('mobile_header');

	// Set Queris width to apply mobile style
    $header_queris = Cryptronick_Theme_Helper::get_option('header_mobile_queris' ,$name_preset, $def_preset);

    if ($mobile_header == '1') {
    	$mobile_background = Cryptronick_Theme_Helper::get_option('mobile_background');
    	$mobile_color = Cryptronick_Theme_Helper::get_option('mobile_color');

    	$custom_css .= '@media only screen and (max-width: '.(int) $header_queris.'px){
			.bpt-theme-header{
		    	background-color: '.esc_attr($mobile_background['rgba']).' !important;
		    	color: '.esc_attr($mobile_color).' !important;
		    }
		    .toggle-inner, .toggle-inner:before, .toggle-inner:after{
	    		background-color:'.esc_attr($mobile_color).';
	    	}
		}
	    ';
    } 
    
    $custom_css .= '@media only screen and (max-width: '.(int) $header_queris.'px){
		.bpt-theme-header .bpt-mobile-header{
			display: block;
		}		

		.bpt-theme-header .bpt-mobile-header .mobile_logo_enable .default_logo,
		.bpt-theme-header .bpt-mobile-header .mobile_logo_enable .sticky_logo{
			display: none;
		}
		.bpt-site-header{
			display:none;
		}
		.bpt-theme-header .main-menu.main_menu_container {
    		display: none;
		}
		.bpt-theme-header .mobile-navigation-toggle{
			display: inline-block;
		}
		.bpt-theme-header .main-menu.main_menu_container{
			display:none;
		}
		header.bpt-theme-header .mobile_menu_container .main-menu{
			display:block;
		}
		.bpt-logotype-container.mobile_logo_enable .mobile_logo{
			display: block;
		}
	}
	';

	$footer_switch = Cryptronick_Theme_Helper::get_option('footer_switch');
	if ($footer_switch) {
		$footer_content_type = Cryptronick_Theme_Helper::get_option('footer_content_type');
		if (class_exists( 'RWMB_Loader' ) && get_queried_object_id() !== 0) {
			$mb_footer_switch = rwmb_meta('mb_footer_switch');
			if ($mb_footer_switch == 'yes') {
				$footer_content_type = rwmb_meta('mb_footer_content_type');
			}
		}
		if($footer_content_type == 'pages'){
			$footer_page_id = Cryptronick_Theme_Helper::options_compare('footer_page_select');
			if ( $footer_page_id ) {
				$footer_page_id = intval($footer_page_id);
				$shortcodes_custom_css = get_post_meta( $footer_page_id, '_wpb_shortcodes_custom_css', true );
				if ( ! empty( $shortcodes_custom_css ) ) {
					$shortcodes_custom_css = strip_tags( $shortcodes_custom_css );
					$custom_css .= $shortcodes_custom_css;
				}
			}
		}		
	}


	$custom_css = str_replace(array("\r\n", "\r", "\n", "\t", '  ', '    ', '    '), '', $custom_css);
	wp_add_inline_style( 'cryptronick-composer', $custom_css );
}
add_action( 'wp_enqueue_scripts', 'cryptronick_custom_styles' );
