<?php

namespace GingTeam\Symfony\Router;

use Symfony\Component\Config\Loader\Loader;
use Symfony\Component\Routing\RouteCollection;

class BlogLoader extends Loader
{
    public function load($resource, string $type = null)
    {
        $routes = new RouteCollection();

        $importedRoutes = $this->import(__DIR__.'/../Resources/config/routes.php');

        $routes->addCollection($importedRoutes);

        return $routes;
    }

    public function supports($resource, string $type = null)
    {
        return 'gingteam_blog' === $type;
    }
}
