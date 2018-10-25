<?php
	
function bpt_child_scripts() {
	wp_enqueue_style( 'bpt-parent-style', get_template_directory_uri(). '/style.css' );
}
add_action( 'wp_enqueue_scripts', 'bpt_child_scripts' );

/**
 * Your code here.
 *
 */
