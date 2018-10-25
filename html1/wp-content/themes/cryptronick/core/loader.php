<?php

#main config
if (class_exists( 'RWMB_Loader' )) {
	function cryptronick_metabox_init(){
    	require_once(get_template_directory() . '/core/metabox_config.php');
    }
	add_action('init', 'cryptronick_metabox_init', 20);
}


require_once(get_template_directory() . '/core/metabox_config.php');

require_once(get_template_directory() . '/core/config.php');
require_once(get_template_directory() . '/core/default-options.php');
require_once(get_template_directory() . '/core/redux-config.php');
require_once(get_template_directory() . '/core/vc/init.php');

function cryptronick_vc_template( $template ){
     if(is_page_template('template-full-width.php'))
        require_once(get_template_directory() . "/core/vc/bpt_vc_addons.php");
    return $template;
}
add_filter( 'template_include', 'cryptronick_vc_template', 1000 );


#all registration
require_once(get_template_directory() . '/core/registrator/css-js.php');
require_once(get_template_directory() . '/core/registrator/ajax-handlers.php');
require_once(get_template_directory() . '/core/registrator/sidebars.php');
require_once(get_template_directory() . '/core/registrator/misc.php');

#widgets
require_once(get_template_directory() . '/core/widgets/flickr.php');
require_once(get_template_directory() . '/core/widgets/posts.php');
require_once(get_template_directory() . '/core/widgets/author.php');
require_once(get_template_directory() . '/core/widgets/banner.php');

#TGM init
require_once(get_template_directory() . '/core/tgm/bpt-tgm.php');
