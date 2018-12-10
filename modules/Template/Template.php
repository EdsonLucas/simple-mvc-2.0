<?php
class Template {

	private function __construct() {}

	public static function getInstance() {
		static $inst = null;
		if($inst === null) {
			$inst = new Template();
		}
		return $inst;
	}

	public function loadTemplate($tpl, $data = array()) {
		if(file_exists('templates/template.php')) {
			require 'templates/template.php';
		}
	}

	public function render($tpl, $data = array()) {
		if(file_exists('templates/'.$tpl.'.php')) {
			require 'templates/'.$tpl.'.php';
		}
	}

}