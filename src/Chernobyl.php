<?php

namespace Scaville\Chernobyl;

use Illuminate\Support\ServiceProvider;

class Chernobyl extends ServiceProvider {

    use \Scaville\Chernobyl\Traits\MakeServicesTrait;

    private $modules;

    /**
     * @access public
     * @author Scaville® Inc.
     * @version 1.0
     */
    public function boot() {
        if (!$this->publishCLI()) {
            $this->modules = config("module.modules");

            $this->loadRoutes();
            $this->loadServices();
            $this->loadViews();
            $this->addHelpers();
        }
    }

    /**
     * @internal Load the routes for each of the modules
     * @author Scaville® Inc.
     * @version 1.0
     */
    private function loadRoutes() {
        foreach ($this->modules as $module => $config) {
            if (!file_exists($routeConfigFile = base_path() . DIRECTORY_SEPARATOR .
                            'routes' . DIRECTORY_SEPARATOR .
                            $module . DIRECTORY_SEPARATOR .
                            'routes.php')) {
                $routeConfigFile = base_path() . DIRECTORY_SEPARATOR .
                        'routes' . DIRECTORY_SEPARATOR .
                        strtolower($module) . DIRECTORY_SEPARATOR .
                        'routes.php';
            }
            if (file_exists($routeConfigFile)) {
                $this->loadRoutesFrom($routeConfigFile, $module);
            }
        }
    }

    /**
     * @internal the service modules.
     * @author Scaville® Inc.
     * @version 1.0
     */
    private function loadServices() {
        foreach ($this->modules as $module => $package) {
            $serviceConfigFile = base_path() . DIRECTORY_SEPARATOR . 
                            $package . DIRECTORY_SEPARATOR . 
                            'config' . DIRECTORY_SEPARATOR . 
                            'services.php';

            if (file_exists($serviceConfigFile)) {
                $serviceConfigFile = include $serviceConfigFile;
                $this->makeServices($serviceConfigFile);
            }
        }
    }

     /**
     * @internal Load the modules views.
     * @author Scaville® Inc.
     * @version 1.0
     * @param array $modules
     */
    private function loadViews() {
        foreach ($this->modules as $module => $config) {
            $this->loadViewsFrom(resource_path('views' . DIRECTORY_SEPARATOR . strtolower($module)), $module);
        }
    }

    /**
     * @internal Publishes the module content.
     * @author Scaville® Inc.
     * @version 1.0
     * @return boolean
     */
    private function publishCLI() {
        if (\App::runningInConsole()) {
            //-- Publish this module config
            $this->publishes([
                __DIR__ . DIRECTORY_SEPARATOR .
                'publisher' . DIRECTORY_SEPARATOR .
                'config' => config_path()
            ]);
            $this->createPaths();
            return true;
        } else {
            return false;
        }
    }

    /**
     * @internal Add this module Helpers
     * @author Scaville® Inc.
     * @version 1.0
     */
    private function addHelpers() {
        include(__DIR__ . DIRECTORY_SEPARATOR . 'Helpers' . DIRECTORY_SEPARATOR . 'Chernobyl.php');
    }

    /**
     * @internal Create Modules path
     * @author Scaville® Inc.
     * @version 1.0
     */
    private function createPaths(){
        $modulesPath = base_path() . DIRECTORY_SEPARATOR . "Modules";
        if(!file_exists($modulesPath)){
            mkdir($modulesPath);
        }
    }

    /**
     * Register all Services of this module.
     * @access public 
     * @author Scaville® Inc.
     * @version 1.0
     */
    public function register() {
        
    }

}