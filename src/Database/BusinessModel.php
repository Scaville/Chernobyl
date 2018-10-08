<?php

namespace Scaville\Chernobyl\Database;

use Illuminate\Database\Eloquent\Model;

abstract class BusinessModel extends Model{
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    public $timestamps = true;
}