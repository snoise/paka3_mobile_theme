<?php
class Paka3_theme_switch {
	private $name ;
	private $dir ;
	private $url ;

	function __construct($name = null, $dir = null, $url = null) {
		$this->name = $name;
		$this->dir  = $dir;
		$this->url  = $url;
		add_filter("show_admin_bar", "__return_false");
		add_filter("stylesheet", array($this, "template"));
		add_filter("template", array($this, "template"));
		add_filter("theme_root", array($this, "theme_root"));
		add_filter("theme_root_uri", array($this, "theme_root_uri"));
	}
	
	public function template($name) {
		$template_name = $this->name ? $this->name : $name; 
		return $template_name;
	}
	
	public function theme_root($dir) {
		$dir_path = $this->dir ? $this->dir : $dir;
		return $dir_path;
	}
	
	public function theme_root_uri($url) {
		$theme_url = $this->url ? $this->url : $url;
		return $theme_url ;
	}
}