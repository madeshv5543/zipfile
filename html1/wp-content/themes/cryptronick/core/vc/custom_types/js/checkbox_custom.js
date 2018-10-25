!function($) {
	jQuery('.vc_ui-panel-content-container').off().on("click", ".bpt_checkbox_label", function(){
		console.log('click');
		var $self = jQuery(this),
			$checkbox = $self.siblings(".bpt_checkbox");
				
		$self.toggleClass("checked");

		if(!$self.hasClass("checked")) {
			$checkbox.removeAttr("checked").val("");
		} else {
			$checkbox.attr("checked","checked").val($self.data("value"));
		}

		$checkbox.trigger("change");
	});
}(window.jQuery);
