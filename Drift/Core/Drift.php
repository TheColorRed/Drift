<?php

namespace Drift\Core;

/**
 * Description of Drift
 *
 * @author ryan
 */
abstract class Drift{

    public function on($message, callable $callback){
        call_user_func_array($callback, array());
    }

    public function emit($message){
        
    }

}
