<?php


/**
* 
*/
class BptPortfolioRegister{

	public $cpt;
	public $dest_taxonomy;
    private $tag_taxonomy;
	private $slug;
	
	function __construct(){

		$this->cpt = 'portfolio';
		$this->taxonomy = 'portfolio-category';
		//$this->slug = Cryptronick_Theme_Helper::get_option('portfolio_slug') != '' ? Cryptronick_Theme_Helper::get_option('portfolio_slug') : 'portfolio';

        //add_action('init', array($this, 'categories_tags_for_portfolio'), 11);
        //add_action( 'pre_get_posts',array($this, 'portfolio_tags') );
	}

	public function register(){
		$this->registerPostType();
        $this->registerTax();    
        $this->registerTag();    
        
        add_filter('single_template', array($this, 'registerSingleTemplate'));      
        add_filter('archive_template', array($this, 'registerArchiveTemplate'));      
	}

	private function getSlug(){
		$slug  = $this->slug;
	}

/*    public function categories_tags_for_portfolio() {
        register_taxonomy_for_object_type('post_tag', $this->cpt);
    }*/

	private function registerPostType(){

        register_post_type($this->cpt,
            array(
                'labels' 		=> array(
                    'name' 				=> __('Portfolio','cryptronick-core' ),
                    'singular_name' 	=> __('Portfolio Item','cryptronick-core' ),
                    'add_item'			=> __('New Portfolio Item','cryptronick-core'),
                    'add_new_item' 		=> __('Add New Portfolio Item','cryptronick-core'),
                    'edit_item' 		=> __('Edit Potrtfolio Item','cryptronick-core')
                ),
                'public'		=>	true,
                'has_archive' => true,
                'rewrite' 		=> 	array('slug' => $this->slug),
                'menu_position' => 	5,
                'show_ui' => true,
                'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'page-attributes', 'comments'),
                'menu_icon'  =>  'dashicons-chart-area',

            )
        );

	}

    private function registerTax() {
        $labels = array(
            'name' => __( 'Portfolio Categories', 'cryptronick-core' ),
            'singular_name' => __( 'Portfolio Category', 'cryptronick-core' ),
            'search_items' =>  __( 'Search Portfolio Categories','cryptronick-core' ),
            'all_items' => __( 'All Portfolio Categories','cryptronick-core' ),
            'parent_item' => __( 'Parent Portfolio Category','cryptronick-core' ),
            'parent_item_colon' => __( 'Parent Portfolio Category:','cryptronick-core' ),
            'edit_item' => __( 'Edit Portfolio Category','cryptronick-core' ),
            'update_item' => __( 'Update Portfolio Category','cryptronick-core' ),
            'add_new_item' => __( 'Add New Portfolio Category','cryptronick-core' ),
            'new_item_name' => __( 'New Portfolio Category Name','cryptronick-core' ),
            'menu_name' => __( 'Categories','cryptronick-core' ),
        );

        register_taxonomy($this->taxonomy, array($this->cpt), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array( 'portfolio-category' ),
        ));

    }   
    
    private function registerTag() {
        $labels = array(
            'name' => __( 'Tags', 'cryptronick-core'),
            'singular_name' => __( 'Tag', 'cryptronick-core'),
            'search_items' =>  __( 'Search Tags', 'cryptronick-core' ),
            'popular_items' => __( 'Popular Tags', 'cryptronick-core' ),
            'all_items' => __( 'All Tags', 'cryptronick-core' ),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __( 'Edit Tag', 'cryptronick-core' ), 
            'update_item' => __( 'Update Tag', 'cryptronick-core' ),
            'add_new_item' => __( 'Add New Tag', 'cryptronick-core' ),
            'new_item_name' => __( 'New Tag Name', 'cryptronick-core' ),
            'separate_items_with_commas' => __( 'Separate tags with commas', 'cryptronick-core' ),
            'add_or_remove_items' => __( 'Add or remove tags', 'cryptronick-core' ),
            'choose_from_most_used' => __( 'Choose from the most used tags', 'cryptronick-core' ),
            'menu_name' => __( 'Tags', 'cryptronick-core' ),
        ); 

        register_taxonomy('portfolio-tag',array($this->cpt),array(
            'hierarchical' => false,
            'labels' => $labels,
            'show_ui' => true,
            'update_count_callback' => '_update_post_term_count',
            'query_var' => true,
            'rewrite' => array( 'slug' => 'portfolio-tag' ),
        ));
    }

    public function registerSingleTemplate($single){
        global $post;

        if($post->post_type == $this->cpt) {
            if(!file_exists(get_template_directory().'/single-'.$this->cpt.'.php')) {
                return plugin_dir_path( dirname( __FILE__ ) ) .'portfolio/templates/single-'.$this->cpt.'.php';
            }
        }

        return $single;  
    }

    public function registerArchiveTemplate($archive){
        global $post;
        
        if(is_post_type_archive ($this->cpt)) {
            if(!file_exists(get_template_directory().'/archive-'.$this->cpt.'.php')) {
                return plugin_dir_path( dirname( __FILE__ ) ) .'portfolio/templates/archive-'.$this->cpt.'.php';
            }
        }

        return $archive;  
    }
    public function portfolio_tags( $query ) {
        if ( $query->is_tag() && $query->is_main_query() ) {
            $query->set( 'post_type', array( 'post', $this->cpt ) );
        }
    }

}



?>