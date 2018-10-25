<?php

/*************************************************
## cryptoking Metabox
*************************************************/

if ( ! function_exists( 'rwmb_meta' ) ) {
  function rwmb_meta( $key, $args = '', $post_id = null ) {
   return false;
  }
  
  function klb_cryptoking(){
  }
 }

add_filter( 'rwmb_meta_boxes', 'cryptoking_register_page_meta_boxes' );

function cryptoking_register_page_meta_boxes( $meta_boxes ) {
	
$prefix = 'klb_';
$meta_boxes = array();


/* ----------------------------------------------------- */
// Cryptoking OnePage Settings
/* ----------------------------------------------------- */

$meta_boxes[] = array(
	'id' => 'klbonepagesettings',
	'title' => 'Page Settings',
	'pages' => array( 'page' ),
	'context' => 'side',
	'priority' => 'high',

	// List of meta fields
	'fields' => array(

		array(
			'name'		=> esc_html__('Open as a Separate Page','cryptoking'),
			'id'		=> $prefix . 'separate_page',
			'type' => 'checkbox',
			// Value can be 0 or 1
			'std'  => 0,
		),
		
		array(
			'name'		=> esc_html__('Disable section from menu','cryptoking'),
			'id'		=> $prefix . 'disable_section_from_menu',
			'type' => 'checkbox',
			// Value can be 0 or 1
			'std'  => 0,
		),			
				
	)
);



/* ----------------------------------------------------- */
// Blog Post Slides Metabox
/* ----------------------------------------------------- */

$meta_boxes[] = array(
	'id'		=> 'klb-blogmeta-gallery',
	'title'		=> esc_html__('Blog Post Image Slides','cryptoking'),
	'pages'		=> array( 'post' ),
	'context' => 'normal',

	'fields'	=> array(
		array(
			'name'	=> esc_html__('Blog Post Slider Images','cryptoking'),
			'desc'	=> esc_html__('Upload unlimited images for a slideshow - or only one to display a single image.','cryptoking'),
			'id'	=> $prefix . 'blogitemslides',
			'type'	=> 'image_advanced',
		)
		
	)
);

/* ----------------------------------------------------- */
// Blog Audio Post Settings
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'klb-blogmeta-audio',
	'title' => esc_html('Audio Settings','cryptoking'),
	'pages' => array( 'post'),
	'context' => 'normal',

	// List of meta fields
	'fields' => array(	
		array(
			'name'		=> esc_html__('Audio Code','cryptoking'),
			'id'		=> $prefix . 'blogaudiourl',
			'desc'		=> esc_html__('Enter your Audio URL(Oembed) or Embed Code.','cryptoking'),
			'clone'		=> false,
			'type'		=> 'textarea',
			'std'		=> ''
		),
	)
);



/* ----------------------------------------------------- */
// Blog Video Metabox
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id'		=> 'klb-blogmeta-video',
	'title'		=> esc_html__('Blog Video Settings','cryptoking'),
	'pages'		=> array( 'post' ),
	'context' => 'normal',

	'fields'	=> array(
		array(
			'name'		=> esc_html__('Video Type','cryptoking'),
			'id'		=> $prefix . 'blog_video_type',
			'type'		=> 'select',
			'options'	=> array(
				'youtube'		=> esc_html__('Youtube','cryptoking'),
				'vimeo'			=> esc_html__('Vimeo','cryptoking'),
				'own'			=> esc_html__('Own Embed Code','cryptoking'),
			),
			'multiple'	=> false,
			'std'		=> array( 'no' )
		),
		array(
			'name'	=> cryptoking_sanitize_data(__('Embed Code<br />(Audio Embed Code is possible, too)','cryptoking')),
			'id'	=> $prefix . 'blog_video_embed',
			'desc'	=> cryptoking_sanitize_data(__('Just paste the ID of the video (E.g. http://www.youtube.com/watch?v=<strong>GUEZCxBcM78</strong>) you want to show, or insert own Embed Code. <br />This will show the Video <strong>INSTEAD</strong> of the Image Slider.<br /><strong>Of course you can also insert your Audio Embedd Code!</strong>','cryptoking')),
			'type' 	=> 'textarea',
			'std' 	=> "",
			'cols' 	=> "40",
			'rows' 	=> "8"
		)
	)
);
 

return $meta_boxes;
}
