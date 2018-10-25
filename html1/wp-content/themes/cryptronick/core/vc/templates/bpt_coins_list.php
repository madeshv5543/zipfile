<?php
$defaults = array(
	'coins_list_style' => 'scrolling_line',
	'coins_list' => '',
	'show_coin_logo' => '',
	'show_change_1h' => '',
	'show_change_24h' => '',
	'show_change_7d' => '',
	'show_market_cap' => '',
	// Style
	'custom_style' => '',
	'text_color' => '#000000',
	'lable_font_size' => '16',
	'big_lable_color' => '#ffeb3a'

);
$atts = vc_shortcode_attribute_parse( $defaults, $atts );

extract($atts);
$compile = '';

if (empty($coins_list)) {
	echo '<p style="color: red;">Not found data</p>';
	return;
}
$coins_array = explode(",", $coins_list);
$all_coins = Cryptronick_crypto_data::get_api_data();
$all_coins = $all_coins->data;


$wrapper_class = '';
switch ($coins_list_style) {
	case 'table':
		$wrapper_class = 'bpt-currency-stripe_table';

		$string_image = '<span class="bpt-currency-stripe_image-wrapper"><img src="%1$s" alt="coin logo"></span>';
		$string_name = '<span class="bpt-currency-stripe_name">%1$s</span>';
		$string_price = '<td class="bpt-currency-stripe_price">$ %1$s</td>';
		$string_changes_1h = $string_changes_24h = $string_changes_7d = '
			<td class="bpt-currency-stripe_change %1$s">
				<span class="bpt-currency-stripe_change__percent">%2$s %%</span>
			</td>';
		$srting_market_cap = '<td class="bpt-currency-stripe_market-cap">$ %1$s</td>';

		/*
			Variables in string wrapper
			1 = html_img 
			2 = html_name 
			3 = html_changes_1h 
			4 = html_changes_24h 
			5 = html_changes_7d 
			6 = html_price, 
			7 = html_market_cap
		*/
		$string_wrapper = '<tr class="bpt-currency-stripe_table-row"><td>%1$s%2$s</td>%6$s%3$s%4$s%5$s%7$s</tr>';

		break;
	case 'big-lable':
		$wrapper_class = 'bpt-currency-stripe_big-lable';

		$string_image = '<div class="bpt-currency-stripe_image-wrapper"><img src="%1$s" alt="coin logo"></div>';
		$string_name = '<div class="bpt-currency-stripe_name"><span class="bpt-currency-stripe_name__short">%1$s</span><br><span class="bpt-currency-stripe_name__long">%2$s</span></div>';
		$string_price = '<div class="bpt-currency-stripe_price">$ %1$s</div>';
		$string_changes_1h = '
			<div class="bpt-currency-stripe_change %1$s">
				<span class="bpt-currency-stripe_change__lable">%% 1h</span>
				<span class="bpt-currency-stripe_change__percent">%2$s</span>
			</div>';
		$string_changes_24h = '
			<div class="bpt-currency-stripe_change %1$s">
				<span class="bpt-currency-stripe_change__lable">%% 24h</span>
				<span class="bpt-currency-stripe_change__percent">%2$s</span>
			</div>';
		$string_changes_7d = '
			<div class="bpt-currency-stripe_change %1$s">
				<span class="bpt-currency-stripe_change__lable">%% 7d</span>
				<span class="bpt-currency-stripe_change__percent">%2$s</span>
			</div>';
		$srting_market_cap = '<div class="bpt-currency-stripe_market-cap">$ %1$s</div>';

		$lable_style = !empty($big_lable_color) ? 'background-color:'.$big_lable_color.';' : '';

		/*
			Variables in string wrapper
			1 = html_img 
			2 = html_name 
			3 = html_changes_1h 
			4 = html_changes_24h 
			5 = html_changes_7d 
			6 = html_price
			7 = html_market_cap
		*/
		$string_wrapper = '
		<div class="bpt-currency-stripe_item" style="'.esc_attr($lable_style).'">
			<div class="bpt-currency-stripe_item-head">%1$s%2$s</div>
			<div class="bpt-currency-stripe_item-body">
				<div class="bpt-currency-stripe_body-changes">%3$s%4$s%5$s</div>
				<div class="bpt-currency-stripe_market-price">%6$s%7$s</div>
			</div>
		</div>';
		break;
	case 'scrolling_line':
	default:
		$wrapper_class = 'bpt-currency-stripe_scrolling';

		$string_image = '<div class="bpt-currency-stripe_image-wrapper"><img src="%1$s" alt="coin logo"></div>';
		$string_name = '<div class="bpt-currency-stripe_name">%1$s/USD</div>';
		$string_price = '<div class="bpt-currency-stripe_price">%1$s</div>';
		$string_changes_1h = $string_changes_24h = $string_changes_7d = '
			<div class="bpt-currency-stripe_change %1$s">
				<span class="bpt-currency-stripe_change__percent">%2$s%%</span>
				<span class="bpt-currency-stripe_change__dollar">%3$s</span>
			</div>';
		$srting_market_cap = '<div class="bpt-currency-stripe_market-cap">$%1$s</div>';

		/*
			Variables in string wrapper
			1 = html_img 
			2 = html_name 
			3 = html_changes_1h 
			4 = html_changes_24h 
			5 = html_changes_7d 
			6 = html_price, 
			7 = html_market_cap
		*/
		$string_wrapper = '<div class="bpt-currency-stripe_item">%1$s%2$s%3$s%4$s%5$s%6$s%7$s</div>';
		break;
}

$output = '';
foreach ($coins_array as $key => $value) {
	$coin = $all_coins->$value;
	$coin_quotes = $coin->quotes;
	$coin_usd = $coin_quotes->USD;
	$percent_change_1h = abs($coin_usd->percent_change_1h);
	$percent_change_24h = abs($coin_usd->percent_change_24h);
	$percent_change_7d = abs($coin_usd->percent_change_7d);
	$market_cap = $coin_usd->market_cap;

	$html_img = $html_name = $html_changes_1h = $html_changes_24h = $html_changes_7d = $html_price = $html_market_cap = '';

	if ((bool)$show_coin_logo) {
		$img_dir = get_template_directory().'/crypto-extension/coin-logo/'.strtolower($coin->symbol).'.svg';
		if ( file_exists($img_dir) ) {
			$img_url = get_template_directory_uri().'/crypto-extension/coin-logo/'.strtolower($coin->symbol).'.svg';

			$html_img = sprintf( $string_image, esc_url($img_url) );
		}
	}
	
		
	$html_name = sprintf($string_name, esc_html($coin->symbol), esc_html($coin->name) );
	
	if ((bool)$show_change_1h) {
		$class_changes_1h = $coin_usd->percent_change_1h > 0 ? 'up' : 'down';
		$changes_1h_dollar = ( $percent_change_1h / 100 ) * $coin_usd->price;

		$html_changes_1h = sprintf( $string_changes_1h, esc_attr( $class_changes_1h ), str_replace("-","",$percent_change_1h),number_format($changes_1h_dollar, 2, '.', ',') );
	}
	
	if ((bool)$show_change_24h) {
		$class_changes_24h = $coin_usd->percent_change_24h > 0 ? 'up' : 'down';
		$changes_24h_dollar = ( $percent_change_24h / 100 ) * $coin_usd->price;

		$html_changes_24h = sprintf( $string_changes_24h, esc_attr( $class_changes_24h ), str_replace("-","",$percent_change_24h),number_format($changes_24h_dollar, 2, '.', ',') );
	}
	
	if ((bool)$show_change_7d) {
		$class_changes_7d = $coin_usd->percent_change_7d > 0 ? 'up' : 'down';
		$changes_7d_dollar = ( $percent_change_7d / 100 ) * $coin_usd->price;

		$html_changes_7d = sprintf( $string_changes_7d, esc_attr( $class_changes_7d ), str_replace("-","",$percent_change_7d),number_format($changes_7d_dollar, 2, '.', ',') );
	}

	$html_price = sprintf($string_price, number_format($coin_usd->price, 2, '.', ',') );
	
	if ((bool)$show_market_cap) {
		$html_market_cap = sprintf($srting_market_cap, number_format($market_cap, 0, '.', ',') );
	}

	$output .= sprintf( $string_wrapper, $html_img, $html_name, $html_changes_1h, $html_changes_24h, $html_changes_7d, $html_price, $html_market_cap );
}
wp_enqueue_script('simplemarquee', get_template_directory_uri() . '/crypto-extension/js/jquery.simplemarquee.js', array(), false, false);

// Style
$style = '';
if ( (bool)$custom_style ){
	$style .= !empty($text_color) ? 'color:'.$text_color.';' : '';
	$style .= !empty($lable_font_size) ? 'font-size:'.(int)$lable_font_size.'px;' : '';
}

switch ($coins_list_style) {
	case 'table':
		$style .= !empty($big_lable_color) ? 'background-color:'.$big_lable_color.';' : '';

		echo '<table class="bpt-currency-stripe '.esc_attr($wrapper_class).'" style="'.esc_attr($style).'"><thead><tr>
			<th class="vcw-name vcw-header">CryptoCurrency</th>
			<th class="vcw-rate vcw-header">USD</th>';
		if ((bool)$show_change_1h) {
			echo '<th class="vcw-change vcw-header">Change 1h</th>';
		} 
		if ((bool)$show_change_24h) {
			echo '<th class="vcw-change vcw-header">Change 24h</th>';
		}
		if ((bool)$show_change_7d) {
			echo '<th class="vcw-change vcw-header">Change 7d</th>';
		}
		if ((bool)$show_market_cap) {
			echo '<th class="vcw-change vcw-header">Capitalization</th>';
		}
		echo '</tr></thead><tbody>'.$output.'</tbody></table>';
		break;
	case 'scrolling_line':
	default:
		echo '<div class="bpt-currency-stripe" style="'.esc_attr($style).'"><div class="'.esc_attr($wrapper_class).'">'.$output.'</div></div>';
		break;
}

?>  