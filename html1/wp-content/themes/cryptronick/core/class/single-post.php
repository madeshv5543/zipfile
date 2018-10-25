<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/**
* Cryptronick Theme Helper
*
*
* @class        Cryptronick_Theme_Helper
* @version      1.0
* @category Class
* @author       BlendPixelsThemes
*/

if (!class_exists('Cryptronick_Single_Post')) {

	class Cryptronick_SinglePost{
		/**
	     * @var SinglePost
	     */
	    private static $instance;

	    /**
	     * @var \WP_Post
	     */
	    private $post_id;
	    private $post_format;
	    private $show_date_meta = true;
	    private $show_author_meta = true;
	    private $show_comments_meta = true;
	    private $show_category_meta = true;

	    /**
	     * @return SinglePost
	     */
	    public static function getInstance () {
	        if (null === static::$instance)
	        {
	            static::$instance = new static();
	        }
	        return static::$instance;
	    }

	    private function __construct () {
	    	$this->post_id = get_the_ID();   	
	    }

	    public function set_post_meta ( $args = false ) {
	    	if ( !(bool)$args || empty($args) ) {
	    		$this->show_date_meta = true;
    			$this->show_author_meta = true;
    			$this->show_comments_meta = true;
	    	} else {
	    		$this->show_date_meta = $args['date'];
    			$this->show_author_meta = $args['author'];
    			$this->show_comments_meta = $args['comments'];
	    	}	
	    }

	    public function set_data () {
	   	   	$this->post_id = get_the_ID();
	    	$this->post_format = get_post_format(); 
	    }

	    public function get_pf () {

	    	if(!$this->post_format) {
	    		if (has_post_thumbnail()) {
	    			return 'standard-image';
	    		} else {
	    			return 'standard';
	    		}
	    	}


	    	return $this->post_format;
	    }

	    public function render_featured ( $link_feature = false, $image_size = 'full', $image_with_cat = false, $aq_image = false ) {
	    	$output = '';
			if (class_exists( 'RWMB_Loader' )) {
		    	switch($this->post_format) {
		            case 'gallery' :
		                $media = $this->featured_gallery($link_feature, $image_size);
		                break;
		            case 'video' :
		                $media = $this->featured_video();
		                break;
		            case 'quote' :
		                $media = $this->featured_quote();
		                break;
		            case 'link' :
		                $media = $this->featured_link();
		                break;
		            case 'audio' :
		            	$media = $this->featured_audio();
		            	break;
		            default :
		                $media = $this->featured_image($link_feature, $image_size, $aq_image);
		                break;
	 			}
	 			
	 		} else {
	 			$media = $this->featured_image($link_feature, $image_size, $aq_image);
	 		}

	 		if (!empty($media)){
	 			echo '<div class="blog-post_media"><div class="blog-post_media_part">' . $media; 
	 		} 	 		
			if((bool) $image_with_cat){
	 			echo "<div class='blog-post_cats'>";
                    $this->render_post_cats();
                echo "</div>";
	 		}
	 		if (!empty($media)){
	 			echo '</div>'; 
	 			echo '</div>'; 
	 		} 	
	    }	    

	    public function render_bg ( $link_feature = false, $image_size = 'full' ) {
	    	$media = '';
	    	if(has_post_thumbnail()) {
	    		$image_id = get_post_thumbnail_id();
				$image_url = wp_get_attachment_image_src( $image_id, $image_size, false );
	    		$media = $image_url[0];
	    	}
	    	if(!$media)
	    		return;

	 		echo '<div class="blog-post_bg_media" style="background-image:url('.esc_url($media).')"></div>';	
	    }

	    public function featured_image ( $link_feature, $image_size, $aq_image = false ) {
	    	$output = '';

	    	if(has_post_thumbnail()) {
	    		$image_id = get_post_thumbnail_id();
	    		$image_data = wp_get_attachment_metadata($image_id);
	    		$image_meta = $image_data['image_meta'];
	    		$upload_dir = wp_upload_dir();
	    		$width = '1170';
				$height = '725';
				$image_url = wp_get_attachment_image_src( $image_id, $image_size, false );
				$image_orgn = $image_url[0];

	    		if ($link_feature) $output .= '<a href="'.esc_attr(get_permalink()).'" class="blog-post_feature-link">';
	    		
	    		if((bool) $aq_image){
			    	switch ($image_size) {
			    		case 'bpt-700-700':
			    			$width = '700';
							$height = '700';
			    			break;	    		
			    		case 'bpt-740-560':
			    			$width = '740';
							$height = '560';
			    			break;			    		
			    		case 'bpt-160-160':
			    			$width = '160';
							$height = '160';
			    			break;
			    		default:
			    			$width = '1170';
							$height = '725';
			    			break;
			    	}    			
			    	if(function_exists('aq_resize')){
			    		$image_url[0] = aq_resize($image_url[0], $width, $height, true, true, true);
			    	}
	    		}
	    		if (!(bool)$image_url[0]) {
	    			$image_url[0] = $image_orgn;
	    		}

	    		$output .= "<img src='" . esc_url( $image_url[0] ) . "' alt='" . esc_attr($image_meta['title']) . "' />";

	    		$this->post_format = 'standart-image';

	    		if ($link_feature) $output .= '</a>';
	    	}

	    	return $output;
	    }

	    public function featured_video () {
	    	$output = '';
	    	$output .= rwmb_meta('post_format_video_oEmbed', 'type=oembed');

	    	return $output;
	    }

	    public function featured_gallery ($link_feature, $image_size) {
	    	$output = '';
	    	$gallery_data = rwmb_meta('post_format_gallery_images');

	    	// If data are empty out of the function
	    	if (empty($gallery_data)) return;

	    	wp_enqueue_script('nivo', get_template_directory_uri() . '/js/nivo.js', array(), false, true);

	    	switch ($image_size) {
	    		case 'bpt-740-560':
	    			$width = '740';
					$height = '560';
	    			break;	    		
	    		case 'bpt-370-280':
	    			$width = '370';
					$height = '280';
	    			break;
	    		default:
	    			$width = '1170';
					$height = '725';
	    			break;
	    	}

			ob_start();
			?>
            <div class="slider-wrapper theme-default">
                <div class="nivoSlider">
				<?php
		    	foreach ($gallery_data as $image) {
	                echo "<img src='" . esc_url(aq_resize( $image["full_url"], $width, $height, true, true, true) ) . "' alt='" . esc_attr($image["alt"]) . "' />";
	            }
	            ?>
	            </div>
	        </div>
		    <?php
		    $output = ob_get_clean();

	    	return $output;
	    }

	    public function featured_quote () {
	    	$quote_author = rwmb_meta('post_format_qoute_author');
            $quote_author_image = rwmb_meta('post_format_qoute_author_image');

            if (!empty($quote_author_image)) {
                $quote_author_image = array_values($quote_author_image);
                $quote_author_image = $quote_author_image[0];
                $quote_author_image = $quote_author_image['url'];
            }else{
                $quote_author_image = '';
            }

            $quote_text = rwmb_meta('post_format_qoute_text');

            // render Quote text
            ob_start();
            if (strlen($quote_text)) :
           	?>
           		<h4 class="blog-post_quote-text"><?php echo esc_html($quote_text);?></h4>
			<?php
           	endif;
           	$output = ob_get_clean();

           	// render Author Image
           	ob_start();
           	if (!empty($quote_author_image)) {
           		?>
           		<img src="<?php echo esc_url($quote_author_image);?>"  class="blog-post_quote-image" alt="<?php echo esc_attr($quote_author);?>">
           		<?php
           	}
           	$autor_avatar = ob_get_clean(); // Get Author image

           	ob_start();
           	// Render basic quote container
           	if (strlen($quote_author)) :
           	?>
           		<div class="blog-post_quote-author">
           			<?php
           			echo Cryptronick_Theme_Helper::render_html($autor_avatar);
           			echo esc_html($quote_author);
           			?>
           		</div>
			<?php
           	endif;

           	$output .= ob_get_clean(); // Get Quote HTML

           	return $output;
	    }

	    public function featured_link () {
	    	$link = rwmb_meta('post_format_link');
            $link_text = rwmb_meta('post_format_link_text');

            ob_start();
	    	?>
	    	<div class="blog-post_media"><div class="blog-post_media_part"><h4 class="blog-post_link">
                <?php
                if ( !empty($link) ) {
                	echo '<a href="' . esc_url($link) . '">';
                }

                if ( !empty($link_text) ) {
                    echo esc_attr($link_text);
                } else {
                    echo esc_attr($link);
                }

                if ( !empty($link) ) {
                    echo '</a>';
                }
                ?>
            </h4></div></div>
            <?php
            $output = ob_get_clean();

            return $output;
	    }

	    public function featured_audio () {
	    	$output = '';
            $audio_meta = get_post_meta($this->post_id, 'post_format_audio_oEmbed');

            if ( !empty($audio_meta) ) {
            	$audio_embed = rwmb_meta('post_format_audio_oEmbed', 'type=oembed');
                $output = $audio_embed;
            }

            return $output;
	    }

	    public function render_post_meta ($args = false) {
	    	$this->set_post_meta($args);
	    	?>
	    	<div class="meta-wrapper">
				<?php if($this->show_author_meta) : ?>
					<span class="author_post">
						<?php echo get_avatar( get_the_author_meta( 'ID' ) , 40 );?>
						<?php echo esc_html__('by', 'cryptronick'); ?> <a href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php echo esc_html(get_the_author_meta('display_name')); ?></a></span>
				<?php endif; ?>

	    		<?php if($this->show_date_meta) : ?>
					<span class="date_post"><?php echo esc_html(get_the_time(get_option( 'date_format' ))); ?></span>
				<?php endif; ?>

				<?php if($this->show_comments_meta) :
					$comments_num = '' . get_comments_number($this->post_id) . '';
					$comments_text = '' . $comments_num == 1 ? esc_html__('comment', 'cryptronick') : esc_html__('comments', 'cryptronick')  . '';
				?>
					<span class="comments_post"><a href="<?php echo esc_url(get_comments_link()); ?>"><?php echo esc_html(get_comments_number($this->post_id)); ?> <?php echo esc_html($comments_text); ?></a></span>
				<?php endif; ?>

			</div>
			<?php
	    }	    

	    public function render_post_cats () {
	    	?>
				<!-- <span><?php //the_category(', '); ?></span> -->

			<?php
			$categories = $post_category_compile = '';
			if (get_the_category()) $categories = get_the_category();
			if ($categories) {
				$post_categ = '';
				foreach ($categories as $category) {
					$color = get_term_meta( $category->term_id, '_category_color', true );
					echo '<span'.(!empty($color) ? ' style="color:#'.esc_attr($color).'"' : "" ).'><a href="'. get_category_link($category->term_id).'"'.(!empty($color) ? ' style="background-color:#'.esc_attr($color).';border-color:#'.esc_attr($color).'"' : "" ).'>' . $category->cat_name . '</a></span>';
				}
			}
	    }

	    public function render_post_share ($show_share) {
	    	$img_url = wp_get_attachment_image_src(get_post_thumbnail_id($this->post_id), 'single-post-thumbnail');

	    	if ($show_share == "1" || $show_share == "yes") :
	    	?>
				<!-- post share block -->
				<div class="share_wrap">					
					<a class="share_link share_twitter" target="_blank" href="<?php echo esc_url('https://twitter.com/intent/tweet?text='. get_the_title() .'&amp;url='. get_permalink()); ?>"><span class="fa fa-twitter"></span><span><?php echo esc_html('Twitter');?></span></a>
					<a class="share_link share_facebook" target="_blank" href="<?php echo  esc_url('https://www.facebook.com/share.php?u='. get_permalink()); ?>"><span class="fa fa-facebook"></span><span><?php echo esc_html('Facebook');?></span></a>
					<a class="share_link share_google share_gplus" target="_blank" href="<?php echo esc_url('https://plus.google.com/share?url='.urlencode(get_permalink())); ?>"><span class="fa fa-google"></span><span><?php echo esc_html('Google +');?></span></a>
					<?php
						if (strlen($img_url[0]) > 0) {
							echo '<a class="share_link share_pinterest" target="_blank" href="'. esc_url('https://pinterest.com/pin/create/button/?url='. get_permalink() .'&media='. $img_url[0]) .'"><span class="fa fa-pinterest"></span><span>'.esc_html('Pinterest').'</span></a>';
						}
					?>
					<a class="share_link share_linkedin" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo substr(urlencode( get_permalink() ),0,1024);?>&title=<?php echo substr(urlencode(html_entity_decode(get_the_title())),0,200);?>" target="_blank" ><span class="fa fa-linkedin"></span><span><?php echo esc_html('Linkedin');?></span></a>
				</div>
				<!-- //post share block -->
			<?php
			endif;
	    }

	    public function render_post_list_share(){
	    	?>
	        <div class="post_share">
            	<a href="#"></a>
	            <div class="share_wrap">
	                <ul>
	                    <li>
	                        <a class="post_share share_twitter" target="_blank" href="<?php echo esc_url('https://twitter.com/intent/tweet?text='. get_the_title() .'&amp;url='. get_permalink()); ?>"><span class="fa fa-twitter"></span></a>                
	                    </li>
	                    <li>
	                        <a class="post_share share_facebook" target="_blank" href="<?php echo  esc_url('https://www.facebook.com/share.php?u='. get_permalink()); ?>"><span class="fa fa-facebook"></span></a>            
	                    </li>
	                    <li>
	                        <a class="post_share share_google share_gplus" target="_blank" href="<?php echo esc_url('https://plus.google.com/share?url='.urlencode(get_permalink())); ?>"><span class="fa fa-google"></span></a>            
	                    </li>   
	                    <?php
	                    $img_url = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail');
	                    if (strlen($img_url[0]) > 0) {
	                        echo '<li>';
	                        echo '<a class="post_share share_pinterest" target="_blank" href="'. esc_url('https://pinterest.com/pin/create/button/?url='. get_permalink() .'&media='. $img_url[0]) .'"><span class="fa fa-pinterest"></span></a>';
	                        echo '</li>';
	                    }
	                    ?>
	                    <li>
	                        <a class="post_share share_linkedin" target="_blank" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php echo substr(urlencode( get_permalink() ),0,1024);?>&title=<?php echo substr(urlencode(html_entity_decode(get_the_title())),0,200);?>"><span class="fa fa-linkedin"></span></a>                                    
	                    </li>
	                </ul>
	            </div>
        	</div>	    
			<?php
    	}


	    public function get_excerpt(){
	    	ob_start();
			if (has_excerpt()) {
				the_excerpt();
			} 
			return ob_get_clean();
	    }
	    
	    public function render_excerpt ($symbol_count = false, $shortcode = false, $read_more = false, $read_more_text = false) {

	    	ob_start();
			if (has_excerpt()) {
				the_excerpt();
			} else {
				the_content();
			}
			$post_content = ob_get_clean();

			if ( in_array( $this->post_format, array('audio', 'quote', 'link') ) && !(bool)$symbol_count ) {
				$symbol_count = '185';
			} elseif(!(bool)$symbol_count) {
				$symbol_count = '400';
			}

			if ((bool)Cryptronick_Theme_Helper::get_option('blog_post_listing_content') || $shortcode) {
				$post_content = preg_replace( '~\[[^\]]+\]~', '', $post_content);
				$post_content_stripe_tags = strip_tags($post_content);
				$output = Cryptronick_Theme_Helper::modifier_character($post_content_stripe_tags, $symbol_count, "...");
			} else {
				$output = $post_content;
			}

			if((bool) $read_more){
				$output .= '<a href="'.esc_url(get_permalink()).'" class="button-read-more">'.esc_html($read_more_text).'</a>';
			}
			
			echo '<div class="blog-post_text"><p>'.$output.'</p></div>';
	    }

	    public function render_author_info () {
	    	$user_email = get_the_author_meta('user_email');
			$user_avatar = get_avatar( $user_email, 100 );
			$user_first = get_the_author_meta('first_name');
			$user_last = get_the_author_meta('last_name');
			$user_description = get_the_author_meta('description'); 
			$user_instagram = get_the_author_meta('instagram');
			$user_facebook = get_the_author_meta('facebook');
			$user_linkedin = get_the_author_meta('linkedin');
			$user_twitter = get_the_author_meta('twitter');

			$avatar_html = !empty($user_avatar) ? '<div class="author-info_avatar">'.$user_avatar.'</div>' : '';
			$name_html = !empty($user_first) || !empty($user_last) ? '<h5 class="author-info_name">'.$user_first.' '.$user_last.'</h5>' : '';
			$description = !empty($user_description) ? '<div class="author-info_description">'.$user_description.'</div>' : '';

			$social_array = array(
				'instagram' => get_the_author_meta('instagram'),
				'facebook' => get_the_author_meta('facebook'),
				'linkedin' => get_the_author_meta('linkedin'),
				'twitter' => get_the_author_meta('twitter'),
			);
			$social_html = '';
			foreach ($social_array as $key => $value) {
				$social_html .= !empty($value) ? '<a href="'.esc_attr($value).'" class="author-info_social-link fa fa-'.esc_attr($key).'"></a>' : '';
			}
			$social_html = !empty($social_html) ? '<div class="author-info_social-wrapper">'.'<span class="title_soc_share">'.esc_html__('In Socials:', 'cryptronick').'</span>'. $social_html.'</div>' : '';

			if ( (bool)$name_html || (bool)$description || (bool)$social_html ) {
				echo '<div class="author-info_wrapper clearfix">'.$avatar_html.'<div class="author-info_content">'.$name_html.$description.$social_html.'</div></div>';
			}
			
	    }

	}

}