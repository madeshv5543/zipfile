<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
/**
* Cryptronick Woocommerce
*
*
* @class        Cryptronick_Woocoommerce
* @version      1.0
* @category Class
* @author       BlendPixelsThemes
*/

if (!class_exists('Cryptronick_Woocoommerce')) {
	class Cryptronick_Woocoommerce{
	    /**
		* Generate lauout template
		*
		*
		* @since 1.0
		* @access private
		*/
		private $layout;
		private $sidebar;
		private $sidebar_width;
		private $column_temp;


		public function __construct ( ){
			add_action( 'after_setup_theme', array( $this, 'setup' ) );
			add_action( 'woocommerce_init', array( $this, 'init' ) );
			add_filter( 'woocommerce_show_page_title', '__return_false' );

			remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
			add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'woocommerce_template_loop_product_thumbnail' ), 10);

			global $pagenow;
			if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ){
				add_action('init',  array( $this, 'woo_install_theme' ), 1);
			} 
		}

		public function setup() {
			// Declare WooCommerce support.
			add_theme_support( 'woocommerce', apply_filters( 'cryptronick_woocommerce_args', array(
				'single_image_width'    => 1080,
				'thumbnail_image_width' => 500,
				'gallery_thumbnail_image_width' => 240,
				'product_grid'          => array(
					'default_columns' => (int) Cryptronick_Theme_Helper::get_option('shop_column'),
					'default_rows'    => 4,
					'min_columns'     => 1,
					'max_columns'     => 6,
					'min_rows'        => 1,),
			) ) );

			add_theme_support( 'wc-product-gallery-zoom' );
			add_theme_support( 'wc-product-gallery-lightbox' );
			add_theme_support( 'wc-product-gallery-slider' );			
			// Declare support for title theme feature.
			add_theme_support( 'title-tag' );

			// Declare support for selective refreshing of widgets.
			add_theme_support( 'customize-selective-refresh-widgets' );	
		}

		public function woo_install_theme(){
			update_option( 'woocommerce_thumbnail_cropping', 'custom' );
			update_option( 'woocommerce_thumbnail_cropping_custom_width', '8' );
			update_option( 'woocommerce_thumbnail_cropping_custom_height', '6' );			
		}

		public function init (){
			
			remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper',       10 );
			remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
			remove_action( 'woocommerce_after_main_content',  'woocommerce_output_content_wrapper_end',   10 );
			remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10, 0 ); 
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5, 0 ); 
			remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10, 0 );
			remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10, 0 );
			remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
			remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
			remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );

			add_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 10 );
			add_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 20 );
			
			/* BPT Page Template*/
			add_action( 'woocommerce_before_main_content', array( $this, 'bpt_page_template_open' ), 10 );
			add_action( 'woocommerce_after_main_content',  array( $this, 'bpt_page_template_close' ), 10 );		
			/* \BPT Page Template*/

			/* BPT Wrapper Sorting*/
			add_action( 'woocommerce_before_shop_loop', array( $this, 'bpt_sorting_wrapper_open' ), 9 );
			add_action( 'woocommerce_before_shop_loop', array( $this, 'bpt_sorting_wrapper_close' ), 31 );

			/* \BPT Wrapper Sorting*/

			/* loop */
			add_action( 'woocommerce_shop_loop_item_title', array( $this, 'template_loop_product_title' ), 10 );
			add_filter( 'loop_shop_per_page', array( $this, 'loop_products_per_page' ), 20 );					
			/* \loop */

			/* widgets */
			add_action( 'woocommerce_before_mini_cart', array( $this, 'minicart_wrapper_open' ) );
			add_action( 'woocommerce_after_mini_cart', array( $this, 'minicart_wrapper_close' ) );
			add_action( 'wp_ajax_woocommerce_remove_from_cart', array( $this, 'ajax_remove_from_cart' ), 1000 );
			add_action( 'wp_ajax_nopriv_woocommerce_remove_from_cart', array( $this, 'ajax_remove_from_cart' ), 1000 );
			add_filter( 'add_to_cart_fragments', array( $this, 'header_add_to_cart_fragment' ) );
			/* \widgets */
			
			add_filter( 'woocommerce_product_thumbnails_columns',   array( $this, 'thumbnail_columns' ) );
			add_filter( 'woocommerce_output_related_products_args', array( $this, 'related_products_args' ) );
			// Legacy WooCommerce columns filter.
			if ( defined( 'WC_VERSION' ) && version_compare( WC_VERSION, '3.3', '<' ) ) {
				add_filter( 'loop_shop_columns',  array( $this, 'loop_columns' ));
			}

			//tabs remove heading filter
			add_filter( 'woocommerce_product_description_heading', '__return_false' ); 
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
			add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 20 );

			add_action( 'woocommerce_before_shop_loop', array( $this, 'bpt_product_columns_wrapper_open' ), 40 );
			add_action( 'woocommerce_after_shop_loop', array( $this, 'bpt_product_columns_wrapper_close' ), 40 );

			add_filter( 'woocommerce_product_loop_start',  array( $this, 'wrapper_catalog_shop' ) );

			add_filter( 'comment_form_fields',  array( $this, 'bpt_comments_fiels' ) );
			add_filter( 'woocommerce_product_review_comment_form_args',array( $this, 'bpt_filter_comments' ), 10, 1 ); 
			add_filter( 'woocommerce_product_review_list_args',array( $this, 'bpt_filter_reviews' ), 10, 1 ); 
		}
		
		/**/
		/* BPT Reviews filter */
		/**/
		function bpt_filter_reviews($array){
			return array( 'callback' => array( $this, 'bpt_templates_reviews' ) );
		}

		public function bpt_templates_reviews($comment, $args, $depth){
			$GLOBALS['comment'] = $comment;
			?>
			<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">

				<div id="comment-<?php comment_ID(); ?>" class="stand_comment">
					<div class="thiscommentbody">
	                    <div class="commentava">
							<?php
							/**
							 * The woocommerce_review_before hook
							 *
							 * @hooked woocommerce_review_display_gravatar - 10
							 */
							do_action( 'woocommerce_review_before', $comment );
							?>
						</div>
						<div class="comment_info">
							<div class="comment_author_says">
							<?php
								/**
								 * The woocommerce_review_meta hook.
								 *
								 * @hooked woocommerce_review_display_meta - 20
								 * @hooked WC_Structured_Data::generate_review_data() - 20
								 */
								$this->review_comments_meta_info($comment);

							?>
							</div>	
						</div>	
						<div class="raiting-meta-wrapper">			
							<?php
							/**
							 * The woocommerce_review_before_comment_meta hook.
							 *
							 * @hooked woocommerce_review_display_rating - 10
							 */
							do_action( 'woocommerce_review_before_comment_meta', $comment );

							?>
						</div>
						<div class="comment_content">
							<?php

							do_action( 'woocommerce_review_before_comment_text', $comment );

							/**
							 * The woocommerce_review_comment_text hook
							 *
							 * @hooked woocommerce_review_display_comment_text - 10
							 */
							do_action( 'woocommerce_review_comment_text', $comment );

							do_action( 'woocommerce_review_after_comment_text', $comment ); ?>
						
						</div>
					</div>
				</div>
			<?php
		}

		function review_comments_meta_info($comment){
			global $comment;
			$verified = function_exists('wc_review_is_from_verified_owner') ? wc_review_is_from_verified_owner( $comment->comment_ID ) : '';

			if ( '0' === $comment->comment_approved ) { ?>
				<em class="woocommerce-review__awaiting-approval">
					<?php esc_html_e( 'Your review is awaiting approval', 'cryptronick' ); ?>
				</em>

			<?php } else { ?>
				<span class="comments_author">
					<?php comment_author(); ?>	
				</span>
				
				<?php
				if ( 'yes' === get_option( 'woocommerce_review_rating_verification_label' ) && $verified ) {
					echo '<em class="woocommerce-review__verified verified">(' . esc_attr__( 'verified owner', 'cryptronick' ) . ')</em> ';
				}
				?>
				<div class="meta-wrapper">       
					<time class="woocommerce-review__published-date" datetime="<?php echo esc_attr( get_comment_date( 'c' ) ); ?>"><?php echo esc_html( get_comment_date( wc_date_format() ) ); ?></time> 
				</div>

			<?php
			}
		}

		/**/
		/* BPT Comments Form Filter */
		/**/
		function bpt_filter_comments($comment_form){
			$commenter = wp_get_current_commenter();

			$comment_form = array(
				'title_reply'          => have_comments() ? __( 'Add a review', 'cryptronick' ) : sprintf( __( 'Be the first to review &ldquo;%s&rdquo;', 'cryptronick' ), get_the_title() ),
				'title_reply_to'       => __( 'Leave a Reply to %s', 'cryptronick' ),
				'title_reply_before'   => '<span id="reply-title" class="comment-reply-title">',
				'title_reply_after'    => '</span>',
				'comment_notes_after'  => '',
				'fields'               => array(
					'author' => '<p class="comment-form-author">' . '<label for="author"></label> ' .
					'<input id="author" name="author" placeholder="'.esc_html__( 'Name', 'cryptronick' ).'" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" required /></p>',
					'email'  => '<p class="comment-form-email"><label for="email"></label> ' .
					'<input id="email" name="email" placeholder="'. esc_html__( 'Email', 'cryptronick' ).'" type="email" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30" aria-required="true" required /></p>',
				),
				'label_submit'  => __( 'Submit', 'cryptronick' ),
				'logged_in_as'  => '',
				'comment_field' => '',
			);

			if ( $account_page_url = wc_get_page_permalink( 'myaccount' ) ) {
				$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( __( 'You must be <a href="%s">logged in</a> to post a review.', 'cryptronick' ), esc_url( $account_page_url ) ) . '</p>';
			}

			if ( get_option( 'woocommerce_enable_review_rating' ) === 'yes' ) {
				$comment_form['comment_field'] = '<div class="comment-form-rating"><label for="rating">' . esc_html__( 'Your rating', 'cryptronick' ) . '</label><select name="rating" id="rating" aria-required="true" required>
				<option value="">' . esc_html__( 'Rate&hellip;', 'cryptronick' ) . '</option>
				<option value="5">' . esc_html__( 'Perfect', 'cryptronick' ) . '</option>
				<option value="4">' . esc_html__( 'Good', 'cryptronick' ) . '</option>
				<option value="3">' . esc_html__( 'Average', 'cryptronick' ) . '</option>
				<option value="2">' . esc_html__( 'Not that bad', 'cryptronick' ) . '</option>
				<option value="1">' . esc_html__( 'Very poor', 'cryptronick' ) . '</option>
				</select></div>';
			}

			$comment_form['comment_field'] .= '<p class="comment-form-comment"><label for="comment"></label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" placeholder="'.esc_html__( 'Your review', 'cryptronick' ).'" required></textarea></p>';
			return $comment_form;
		}

		/**/
		/* Comments Field Reorder */
		/**/
		function bpt_comments_fiels( $fields ){
			if( is_product() ) {
				$comment_field = $fields['comment'];
				unset( $fields['comment'] );
				$fields['comment'] = $comment_field;				
			}
			return $fields;
		}

		/**/
		/* Wrapper Catalog Shop */
		/**/
		function wrapper_catalog_shop( $ob_get_clean ){
			echo '<ul class="bpt-products">';
		}

		/**/
		/* LOOP */
		/**/
		public function loop_products_per_page() {
			return (int) Cryptronick_Theme_Helper::get_option('shop_products_per_page');
		}
		/**/
		/* \LOOP */
		/**/

		/**/
		/* WIDGETS */
		/**/
		public function ajax_remove_from_cart() {
			global $woocommerce;
			$woocommerce->cart->set_quantity( $_POST['remove_item'], 0 );

			$ver = explode( '.', WC_VERSION );

			if ( $ver[1] == 1 && $ver[2] >= 2 ) :
				$wc_ajax = new WC_AJAX();
				$wc_ajax->get_refreshed_fragments();
			else :
				woocommerce_get_refreshed_fragments();
			endif;

			die();
		}

		public function header_add_to_cart_fragment( $fragments ) {
			global $woocommerce;
			ob_start();
				?>
					<span class='woo_mini-count flaticon-shopcart-icon'><?php echo ((WC()->cart->cart_contents_count > 0) ?  '<span>' . esc_html( WC()->cart->cart_contents_count ) .'</span>' : '') ?></span>
				<?php
				$fragments['.woo_mini-count'] = ob_get_clean();
				ob_start();
				woocommerce_mini_cart();
				$fragments['div.woo_mini_cart'] = ob_get_clean();

				return $fragments;
		}
		public function minicart_wrapper_open (){
			echo "<div class='woo_mini_cart'>";
		}
		public function minicart_wrapper_close (){
			echo "</div>";
		}		
		/**/
		/* \WIDGETS */
		/**/

		public function woocommerce_template_loop_product_thumbnail (){
			$permalink = esc_url( get_the_permalink() );

			// Sale Product
			ob_start();
			woocommerce_show_product_loop_sale_flash();
			$sale = ob_get_clean();

			$sale_banner = !empty( $sale ) ? "<div class='woo_banner_wrapper'><div class='woo_banner sale_bunner'><div class='woo_banner_text'>$sale</div></div></div>" : "";
			echo "<div class='woo_product_image shop_media'>";		
				echo "<div class='picture'>";
					echo !empty( $sale_banner ) ? $sale_banner : "";

					if(function_exists('woocommerce_get_product_thumbnail')){
						echo "<a href='$permalink'>";
							echo woocommerce_get_product_thumbnail();
						echo "</a>";						
					}
				echo "</div>";
			echo '</div>';
		}
		/**
		 * Product gallery thumbnail columns
		 *
		 * @return integer number of columns
		 * @since  1.0.0
		 */
		public function thumbnail_columns() {
			$columns = 4;
			return intval( $columns );
		}

		/**
		 * Related Products Args
		 *
		 * @param  array $args related products args.
		 * @since 1.0.0
		 * @return  array $args related products args
		 */
		public function related_products_args( $args ) {
			$args = array(
				'posts_per_page' => (int) Cryptronick_Theme_Helper::get_option('shop_r_products_per_page'),
				'columns'        => (int) Cryptronick_Theme_Helper::get_option('shop_related_columns'),
			);

			return $args;
		}		

		/**
		 * Columns Products
		 *
		 * @param  array $args columns products args.
		 * @since 1.0.0
		 * @return  array $args columns products args
		 */
		public function loop_columns( $args ) {
			$columns = (int) Cryptronick_Theme_Helper::get_option('shop_column'); // 3 products per row
			return $columns;
		}

		public function bpt_product_columns_wrapper() {
			$columns = (int) Cryptronick_Theme_Helper::get_option('shop_column');
			echo '<div class="bpt-products-catalog bpt-products-wrapper columns-' . absint( $columns ) . '">';
		}		

		public function template_loop_product_title(){
			global $product;
			$link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );
			echo '<h2 class="woocommerce-loop-product__title"><a href="' . esc_url( $link ) . '" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">' . get_the_title() . '</a></h2>';
		}

		public function bpt_sorting_wrapper_open(){
			echo '<div class="bpt-woocommerce-sorting">';
		}		

		public function bpt_sorting_wrapper_close(){
			echo '</div>';
		}

		public function bpt_product_columns_wrapper_open() {
			$columns = (int) Cryptronick_Theme_Helper::get_option('shop_column');
			echo '<div class="bpt-products-catalog bpt-products-wrapper columns-' . absint( $columns ) . '">';
		}		
		
		public function bpt_product_columns_wrapper_close() {
			echo '</div>';
		}

		public function init_template(){
			$shop_template = is_single() ? 'single' : 'catalog';
			$this->layout = Cryptronick_Theme_Helper::get_option('shop_'.$shop_template.'_sidebar_layout');
			$this->sidebar = Cryptronick_Theme_Helper::get_option('shop_'.$shop_template.'_sidebar_def'); 
			$this->sidebar_width = Cryptronick_Theme_Helper::get_option('shop_'.$shop_template.'_sidebar_def_width');

			$cryptronick_core = class_exists('bpt_cryptronick_core');
		    if(!$cryptronick_core){
		        if(is_active_sidebar( 'sidebar_main-sidebar' )){
		            $this->layout = 'right';
		            $this->sidebar = 'sidebar_main-sidebar';
		        }
		    }

		   	if (class_exists( 'RWMB_Loader' )) {
				$mb_layout = rwmb_meta('mb_page_sidebar_layout');
				if (!empty($mb_layout) && $mb_layout != 'default') {
					$this->layout = $mb_layout;
					$this->sidebar = rwmb_meta('mb_page_sidebar_def');
				}
			}
			$this->column_temp = 12;
			if ( $this->layout == 'left' || $this->layout == 'right' ) {
				$this->column_temp = (int) $this->sidebar_width;
			}else{
				$this->sidebar = '';
			}

		}

		public function bpt_page_template_open(){	    
			$this->init_template();
			$row_class = ' sidebar_'.$this->layout;
			?>
			<div class="container single_product">
    			<div class="row<?php echo esc_attr($row_class); ?>">
	        	<div class="content-container span<?php echo (int)esc_attr($this->column_temp); ?>">
		        	<section id='main_content'>
		    <?php
		}

		public function bpt_page_template_close(){
			$this->init_template();
			echo '</section>';
			echo '</div>';
			if ( in_array($this->layout, array('left', 'right'), true) ) {
				echo '<div class="sidebar-container span'.(12 - (int)esc_attr($this->column_temp)).'">';
				if (is_active_sidebar( $this->sidebar )) {
					echo "<aside class='sidebar'>";
					dynamic_sidebar( $this->sidebar );
					echo "</aside>";
				}
				echo "</div>";
			}
				echo "</div>";
			echo "</div>";
		}

	}
}

/**/
/* Config and enable extension */
new Cryptronick_Woocoommerce ( );

// Cryptronick Woocoommerce Helpers

if ( ! function_exists( 'cryptronick_woocommerce_breadcrumb' ) ) {
	/**
	 * Output the WooCommerce Breadcrumb.
	 *
	 * @param array $args Arguments.
	 */
	function cryptronick_woocommerce_breadcrumb( $args = array() ) {
		$args = wp_parse_args( $args, apply_filters( 'woocommerce_breadcrumb_defaults', array(
			'delimiter'   => '&nbsp;&#47;&nbsp;',
			'wrap_before' => '',
			'wrap_after'  => '',
			'before'      => '',
			'after'       => '',
			'home'        => _x( 'Home', 'breadcrumb', 'cryptronick' ),
		) ) );

		$breadcrumbs = new WC_Breadcrumb();

		$args['breadcrumb'] = $breadcrumbs->generate();

		/**
		 * WooCommerce Breadcrumb hook
		 *
		 * @hooked WC_Structured_Data::generate_breadcrumblist_data() - 10
		 */
		do_action( 'woocommerce_breadcrumb', $breadcrumbs, $args );

		extract($args);
		if ( ! empty( $breadcrumb ) ) {

			echo sprintf("%s", $wrap_before);

			foreach ( $breadcrumb as $key => $crumb ) {

				echo sprintf("%s", $before);

				if ( ! empty( $crumb[1] ) && sizeof( $breadcrumb ) !== $key + 1 ) {
					echo '<a href="' . esc_url( $crumb[1] ) . '">' . esc_html( $crumb[0] ) . '</a>';
				} else {
					echo '<span class="current">' .( $crumb[0] ). '</span>';
				}

				echo sprintf("%s", $after);

				if ( sizeof( $breadcrumb ) !== $key + 1 ) {
					echo sprintf("%s", $delimiter);
				}
			}
			echo sprintf("%s", $wrap_after);
		}

	}
}


?>
