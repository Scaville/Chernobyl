<?php

if (!function_exists('service')) {

    function service($class) {
        return app()->make($class);
    }

}