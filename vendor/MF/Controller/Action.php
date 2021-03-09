<?php


namespace MF\Controller;

abstract class Action {

	protected $view;

	public function __construct() {
		$this->view = new \stdClass();
	}

	protected function render($view, $layout = 'layout1', $title = 'Title', $previous = false) {
		// echo "VIEW: " . $view . "<br>";
		// echo "LAYOUT: " . $layout . "<br>";
		// echo "TITLE: " . $title . "<br>";
		$this->view->page = $view;
		$this->view->title = $title;

		if(file_exists("../App/Views/".$layout.".php")) {
			$this->view->previous = $previous ? '../' : '';
			require_once "../App/Views/".$layout.".php";
		} else {
			$this->content();
		}
	}

	protected function content() {
		$classAtual = get_class($this);

		$classAtual = str_replace('App\\Controllers\\', '', $classAtual);

		$classAtual = strtolower(str_replace('Controller', '', $classAtual));

		require_once "../App/Views/".$classAtual."/".$this->view->page.".php";
	}
}

?>