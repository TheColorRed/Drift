<?php

namespace Drift\API;

use Drift\Core\Drift;

/**
 * Description of http
 *
 * @author ryan
 */
class Http extends Drift{

    public function createServer(callable $requestListener){
        $server = new Server($requestListener);
        return $server;
    }

}
