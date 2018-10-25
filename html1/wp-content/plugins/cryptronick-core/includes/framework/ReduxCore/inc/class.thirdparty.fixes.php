<?php
    // Fix for the bpt page builder: http://www.bpthemes.com/wordpress-bpt-page-builder-plugin/
    /** @global string $pagenow */
    if ( has_action( 'ecpt_field_options_' ) ) {
        global $pagenow;
        if ( $pagenow === 'admin.php' ) {

            remove_action( 'admin_init', 'pb_admin_init' );
        }
    }