<?php

namespace Scaville\Chernobyl\Exceptions;

use Exception;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class JsonException extends Exception{
    protected $message;

    public function __construct($message){
        $this->message = $message;
    }

        
    public function report(){
    }

    /**
     * Render the exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
        return response()->json(
            [
                'message' => $this->message,
                'code' => 400
            ], 400, [], JSON_UNESCAPED_UNICODE
        );
    }
}