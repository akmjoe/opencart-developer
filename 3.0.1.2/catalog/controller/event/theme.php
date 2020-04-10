<?php
class ControllerEventTheme extends Controller {
	public function index(&$route, &$args) {
		if (!$this->config->get('theme_' . $this->config->get('config_theme') . '_status')) {
			exit('Error: A theme has not been assigned to this store!');
		}
		
		// If the default theme is selected we need to know which directory its pointing to			
		if ($this->config->get('config_theme') == 'default') {
			$theme = $this->config->get('theme_default_directory');
		} else {
			$theme = $this->config->get('config_theme');
		}
			
		// If there is a theme override we should get it				
		$this->load->model('design/theme');
		
		$theme_info = $this->model_design_theme->getTheme($route, $theme);
		
		if ($theme_info) {
			// include and register Twig auto-loader
			include_once DIR_SYSTEM . 'library/template/Twig/Autoloader.php';
			
			Twig_Autoloader::register();	

			// specify where to look for templates
			$loader = new \Twig_Loader_Filesystem(DIR_TEMPLATE);
			
			// initialize Twig environment
			$twig = new \Twig_Environment($loader, array(
				'autoescape' => false, 
				'cache'      => $this->config->get('template_cache') ? DIR_CACHE : ''
			));	

			$template = $twig->createTemplate(html_entity_decode($theme_info['code'], ENT_QUOTES, 'UTF-8'));
			
			return $template->render($args);
		} elseif (is_file(DIR_TEMPLATE . $theme . '/template/' . $route . '.twig')) {
			$this->config->set('template_directory', $theme . '/template/');
		} elseif (is_file(DIR_TEMPLATE . 'default/template/' . $route . '.twig')) {
			$this->config->set('template_directory', 'default/template/');
		}
	}
}