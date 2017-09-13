<?php

class Page {

	//----- Public Page functions
	private static $pageName;

	public static function render($pageName) {

		self::$pageName = $pageName;
		if(is_null(self::$pageName) || !Page::_doesTemplateExist(self::$pageName)) self::$pageName = 'index';

		Page::_loadTemplate('html_page');

	}

	public static function getPageName() {
		return self::$pageName;
	}

	//----- Util functions.
	public static function _loadTemplate($template) {
		
		$path = dirname(__FILE__) . '/../templates/' . $template . '.php';
		
		if(Page::_doesTemplateExist($template))
			include_once ($path);
					
	}

	public static function _doesTemplateExist($template) {

		$path = dirname(__FILE__) . '/../templates/' . $template . '.php';
		
		return file_exists($path) && is_readable($path);

	}

};