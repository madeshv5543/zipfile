<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://themeforest.net/user/blendpixels
 * @since      1.0.0
 *
 * @package    bpt_cryptronick_core
 * @subpackage bpt_cryptronick_core/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    bpt_cryptronick_core
 * @subpackage bpt_cryptronick_core/includes
 * @author     bpthemes <blendpixels@gmail.com>
 */
class bpt_cryptronick_core {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      bpt_cryptronick_core_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'cryptronick-core';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
		$this->define_CPT_hooks();
	
	}
	
	/**
	 * Create the ajax functionality of the plugin.
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function bpt_ajax_init (){	
		extract($_POST['data']);

		//Global variables blog
		global $bpt_blog_atts;
	    global $bpt_query_vars;

		$offset_items = (int) $offset_items;
		$items_load = (int) $items_load;

		$out = '';
		$post_type = isset($query_args['post_type']) ? esc_attr($query_args['post_type']) : "";
	    
	    list($query_args) = vc_build_loop_query($build_query);
	    
	    $query_args['post_type'] = $post_type;
	    $query_args['order'] = isset($query_args['order']) ? $query_args['order'] : 'DESC';
	    $query_args['orderby'] = isset($query_args['orderby']) ? $query_args['orderby'] : 'date';
	    $query_args['offset'] = $offset_items;
	    $query_args['post_status'] = 'publish';
	    $query_args['posts_per_page'] = $items_load;

	    $q = new WP_Query($query_args);

	    $found_posts = $q->found_posts;
	    
	    if( $offset_items + $items_load >= (int) $q->found_posts){
	    	$out .= "<div class='hidden_load_more'></div>";
	    }

	    switch ($post_type) {
	    	case 'portfolio':
	    		$custom_post = new BptPortfolio();
	    		$out .= $custom_post->output_loop_query($q, $_POST['data']);	
	    		break;    	
	    	
	    	default:
	    		$bpt_blog_atts = $_POST['data'];
	    		$bpt_query_vars = $q;
	    		$out .= get_template_part('templates/post/post', isset($blog_style) ? $blog_style : 'standard');
	    		break;
	    }  
	    
	    wp_reset_postdata();   
	    echo $out;
	    
	   	unset($bpt_blog_atts);
	   	unset($bpt_query_vars);
	   	
	    wp_die();
	}


	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - bpt_cryptronick_core_Loader. Orchestrates the hooks of the plugin.
	 * - bpt_cryptronick_core_i18n. Defines internationalization functionality.
	 * - bpt_cryptronick_core_Admin. Defines all hooks for the admin area.
	 * - bpt_cryptronick_core_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-bpt_core-loader.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-bpt_core-i18n.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-bpt_core-admin.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-bpt_core-public.php';

		//Load redux 
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/framework/class.redux-plugin.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/framework/init.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/redux-extension-loader.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/redux-importer-config.php';
		//Load meta-box
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/meta-box/meta-box.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/metabox-addon.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/post-types/post-types-register.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/post-types/team/team-register.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/post-types/portfolio/portfolio-register.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/post-types/portfolio/shortcodes/portfolio.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/theme-adding-functions.php';

		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/bpt_likes/likes.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/aq_resizer/aq_resizer.php';

		$this->loader = new bpt_cryptronick_core_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the bpt_cryptronick_core_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new bpt_cryptronick_core_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new bpt_cryptronick_core_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}


	/**
	 * Register all of the hooks related to the CPT functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_CPT_hooks(){
		$plugin_CPT = bptPostTypesRegister::getInstance();
		$this->loader->add_action( 'after_setup_theme', $plugin_CPT, 'register' );
		$this->loader->add_action( 'after_setup_theme', $plugin_CPT, 'shortcodes' );


        /*register practice single*/
        /*$this->loader->add_filter( 'single_template', $practice, 'registerSingleTemplate');*/

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {


		$plugin_public = new bpt_cryptronick_core_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		add_action( 'wp_ajax_bpt_ajax', array($this, 'bpt_ajax_init')  );
		add_action( 'wp_ajax_nopriv_bpt_ajax', array($this, 'bpt_ajax_init') );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    bpt_cryptronick_core_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
