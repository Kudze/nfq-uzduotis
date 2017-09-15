<?php

class Page {

	//----- Public Page functions
	private static $pageName;

	public static function render($pageName) {

		self::$pageName = $pageName;
		if(is_null(self::$pageName) || !Page::_doesTemplateExist(self::$pageName . "_body")) self::$pageName = 'index';
		Page::_loadTemplate('html_page');

	}

	public static function getPageName() {
		return self::$pageName;
	}

	public static function getCurrentURL() {
		return "index.php?page=" . self::$pageName;
	}

	//----- Util functions.
	public static function _loadTemplate($template) {
		
		$path = dirname(__FILE__) . '/../templates/' . $template . '.php';
		
		if(Page::_doesTemplateExist($template))
			include_once ($path);

		else
			echo 'Template was not found';
					
	}

	public static function _doesTemplateExist($template) {

		$path = dirname(__FILE__) . '/../templates/' . $template . '.php';
		
		return file_exists($path) && is_readable($path);

	}

};