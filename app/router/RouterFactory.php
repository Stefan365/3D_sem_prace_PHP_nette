<?php

namespace App;

use Nette\Application\Routers\RouteList,
	Nette\Application\Routers\Route;

/**
 * Router factory.
 */
class RouterFactory
{

    
    /**
	 * @return \Nette\Application\IRouter
	 */
	public function createRouter()
	{
		$router = new RouteList();
        $router[] = new Route('index.php', 'Registrace:registrace', Route::ONE_WAY);
		$router[] = new Route('<presenter>/<action>[/<id>]', 'Registrace:registrace');
		return $router;
	}
    

}
