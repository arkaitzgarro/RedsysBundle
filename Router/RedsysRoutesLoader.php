<?php

/**
 * RedsysBundle for Symfony2
 *
 * This Bundle is part of Symfony2 Payment Suite
 *
 * @author Gonzalo Vilaseca <gonzalo.vilaseca@gmail.com>
 *
 * Gonzalo Vilaseca 2014
 */

namespace PaymentSuite\RedsysBundle\Router;

use RuntimeException;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\Config\Loader\LoaderResolverInterface;
use Symfony\Component\Routing\Route;
use Symfony\Component\Routing\RouteCollection;

/**
 * Redsys router
 */
class RedsysRoutesLoader implements LoaderInterface
{
    /**
     * @var string
     *
     * Execute route name
     */
    private $controllerExecuteRouteName;

    /**
     * @var string
     *
     * Execute route
     */
    private $controllerExecuteRoute;

    /*
     * @var string
     *
     * Result controller route name
     */
    private $controllerResultRouteName;

    /**
     * @var string
     *
     * Result route
     */
    private $controllerResultRoute;

    /**
     * @var boolean
     *
     * Route is loaded
     */
    private $loaded = false;

    /**
     * Construct method
     *
     * @param string $controllerExecuteRouteName Controller Execute route name
     * @param string $controllerExecuteRoute     Controller Execute route
     * @param string $controllerResultRouteName  Controller Result route name
     * @param string $controllerResultRoute      Controller Result route

     */
    public function __construct($controllerExecuteRouteName,
                                 $controllerExecuteRoute,
                                 $controllerResultRouteName,
                                 $controllerResultRoute)
    {
        $this->controllerExecuteRouteName = $controllerExecuteRouteName;
        $this->controllerExecuteRoute = $controllerExecuteRoute;
        $this->controllerResultRouteName = $controllerResultRouteName;
        $this->controllerResultRoute = $controllerResultRoute;
    }

    /**
     * Loads a resource.
     *
     * @param mixed  $resource The resource
     * @param string $type     The resource type
     *
     * @return RouteCollection
     *
     * @throws RuntimeException Loader is added twice
     */
    public function load($resource, $type = null)
    {
        if ($this->loaded) {
           throw new RuntimeException('Do not add this loader twice');
        }

        $routes = new RouteCollection();
        
        foreach ($this->controllerExecuteRoute as $locale => $route) {
            $routes->add(
                $this->controllerExecuteRouteName.'.'.$locale,
                new Route(
                    $route,
                    array(
                        '_controller'   =>  'RedsysBundle:Redsys:execute',
                        array('_method' => 'GET'),
                    )
                )
            );
        }

        foreach ($this->controllerResultRoute as $locale => $route) {
            $routes->add(
                $this->controllerResultRouteName.'.'.$locale,
                new Route(
                    $route,
                    array(
                        '_controller'   =>  'RedsysBundle:Redsys:result',
                        array('_method' => 'GET'),
                    )
                )
            );
        }

        $this->loaded = true;

        return $routes;

    }

    /**
     * Returns true if this class supports the given resource.
     *
     * @param mixed  $resource A resource
     * @param string $type     The resource type
     *
     * @return boolean true if this class supports the given resource, false otherwise
     */
    public function supports($resource, $type = null)
    {
        return 'redsys' === $type;
    }

    /**
     * Gets the loader resolver.
     *
     * @return LoaderResolverInterface A LoaderResolverInterface instance
     */
    public function getResolver()
    {
    }

    /**
     * Sets the loader resolver.
     *
     * @param LoaderResolverInterface $resolver A LoaderResolverInterface instance
     */
    public function setResolver(LoaderResolverInterface $resolver)
    {
    }
}
