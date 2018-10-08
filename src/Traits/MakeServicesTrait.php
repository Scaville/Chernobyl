<?php

namespace Scaville\Chernobyl\Traits;

trait MakeServicesTrait {

    function makeServices($servicesConfigFile) {
        foreach ($servicesConfigFile as $service) {
            $this->app->singleton($service, function($service) {
                return new $service();
            });
        }
    }

}
