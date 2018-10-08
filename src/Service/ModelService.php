<?php

namespace \Scaville\Chernobyl\Service;

use \Illuminate\Http\Request;
use \Scaville\Chernobyl\Constants\Actions;
use \Scaville\Chernobyl\Service\Service;

abstract class ModelService extends Service
{
    public abstract function filter(Request $request, Actions $action);
    public abstract function validate(Request $request, Actions $action);
    public abstract function persist(Request $request);
    public abstract function update(Request $request);
    public abstract function get(int $id);
}