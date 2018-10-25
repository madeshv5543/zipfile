<?php

class CoreParam {

	public $paramName;
	public $paramJsFile;

	function renderParam (){

	}

	function registerParam (){
		vc_add_shortcode_param( $paramName, $this->renderParam(), $this->paramJsFile );		
	}

}

?>