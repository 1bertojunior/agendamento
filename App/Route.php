<?php

namespace App;

use MF\Init\Bootstrap;

class Route extends Bootstrap {

	protected function initRoutes() {

		$routes['home'] = array(
			'route' => '/',
			'controller' => 'indexController',
			'action' => 'index'
		);

		$routes['agendamento'] = array(
			'route' => '/agendamento',
			'controller' => 'indexController',
			'action' => 'agendamento'
		);

		$routes['login'] = array(
			'route' => '/login',
			'controller' => 'adminController',
			'action' => 'login',
		);

		$routes['autenticar'] = array(
			'route' => '/auth',
			'controller' => 'authController',
			'action' => 'autenticar',
		);

		$routes['register'] = array(
			'route' => '/register',
			'controller' => 'adminController',
			'action' => 'register',
		);

		$routes['registrar'] = array(
			'route' => '/registrar',
			'controller' => 'adminController',
			'action' => 'registrar',
		);

		$routes['admin'] = array(
			'route' => '/admin',
			'controller' => 'adminController',
			'action' => 'admin',
		);

		$routes['logout'] = array(
			'route' => '/logout',
			'controller' => 'adminController',
			'action' => 'logout',
		);

		$routes['calendar'] = array(
			'route' => '/calendar',
			'controller' => 'adminController',
			'action' => 'calendar',
		);

		$routes['listEvents'] = array(
			'route' => '/listEvents',
			'controller' => 'adminController',
			'action' => 'listEvents',
		);

		$routes['pageNotFound'] = array(
			'route' => '/admin/404',
			'controller' => 'adminController',
			'action' => 'pageNotFound',
		);

		$routes['searchagendamento'] = array(
			'route' => '/searchagendamento',
			'controller' => 'indexController',
			'action' => 'searchagendamento'
		);

		$routes['searchByIdAndPhone'] = array(
			'route' => '/searchByIdAndPhone',
			'controller' => 'indexController',
			'action' => 'searchByIdAndPhone'
		);

		$routes['delete'] = array(
			'route' => '/delete',
			'controller' => 'indexController',
			'action' => 'delete'
		);

		$routes['ajaxAdmin'] = array(
			'route' => '/ajaxAdmin',
			'controller' => 'indexController',
			'action' => 'ajaxAdmin',
		);
		

		$routes['holidays'] = array(
			'route' => '/holidays',
			'controller' => 'indexController',
			'action' => 'holidays',
		);

		$routes['daysoff'] = array(
			'route' => '/daysoff',
			'controller' => 'indexController',
			'action' => 'daysoff',
		);

		$routes['schedule'] = array(
			'route' => '/schedule',
			'controller' => 'indexController',
			'action' => 'agendar',
		);

		// $routes['city'] = array(
		// 	'route' => '/city',
		// 	'controller' => 'indexController',
		// 	'action' => 'city'
		// );

		// $routes['getCity'] = array(
		// 	'route' => '/getCity',
		// 	'controller' => 'indexController',
		// 	'action' => 'getCity'
		// );

		$this->setRoutes($routes);
	}

}

?>