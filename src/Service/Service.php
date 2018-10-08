<?php

 namespace Scaville\Chernobyl\Service;

 class Service{

     /**
     * Returns a singleton instance of the a service.
     * @param string $class
     * @return Class
     */
    protected function service($class) {
        return app()->make($class);
    }
 }