<?php
class Paka3_theme_switch {
	private $name ;

	function __construct($name = null) {
		$this->name = $name;

		add_filter("show_admin_bar", "__return_false");
		add_filter("stylesheet", array($this, "template"));
		add_filter("template", array($this, "template"));
	}
	
	public function template($name) {
		$template_name = $this->name ? $this->name : $name; 
		return $template_name;
	}

}