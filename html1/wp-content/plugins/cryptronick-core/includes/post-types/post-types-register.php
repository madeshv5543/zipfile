<?php

class bptPostTypesRegister{
    private static
        $instance = null;

    private $postTypes = array();
    private $allShortcodes = array();
  
    /**
     * @return Returns current instance of class
     */

    public static function getInstance() {
        if(self::$instance == null) {
            return new self;
        }

        return self::$instance;
    }

    public function register(){
        $this->postTypes['team'] = new bptTeamRegister();
        $this->postTypes['portfolio'] = new BptPortfolioRegister();
        foreach ($this->postTypes as $postType) {
            $postType->register();
        }

        if(class_exists('Vc_Manager')) {  
          $list = array(
              'team',
              'portfolio',
              'page',
              'post'
          );
          vc_set_default_editor_post_types( $list );
        }
    }

    public function shortcodes(){
        new BptPortfolio();
    }
   

    private function __clone() {}
    private function __construct() {}
    private function __wakeup() {}
}
