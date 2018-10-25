<?php

/*************************************************
## Cryptoking Sanitize
*************************************************/ 

function cryptoking_sanitize_data( $string ) {
	$klb_allowed_tags = array(
			'a' => array(
				'href' => array(),
				'title' => array(),
				'class' => array(),
			),
			'br' => array(),
			'em' => array(),
			'strong' => array(
				'class' => array(),
			 ),
			'div' => array(		
				  'class' => array(),
			 ),
			'figcaption' => array(),
			'p' => array(
				'class' => array(),
			 ),
			'li' => array(
				'class' => array(),
			 ),
			'ul' => array(
				'class' => array(),
			 ),
			'span' => array(
				'class' => array(),
				'data-countdown' => array(),
				'style' => array(),
			 ),
			'h3' => array(
				'class' => array(),
			 ),
			'i' => array(
				'class' => array(),
			 ),
			'img' => array(
				'class' => array(),
				'src' => array(),
				'width' => array(),
				'height' => array(),
				'alt' => array(),
			 ),

			 'figure' => array(
				'class' => array(),
				'data-bg-img' => array(),
			 ),
			 
			 'del' => array(),
			 'ins' => array(),

		);

	return wp_kses( $string, $klb_allowed_tags );
}

?>