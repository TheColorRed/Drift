<?php

namespace Drift\API;

use Drift\Core\Drift;

/**
 * Description of Server
 *
 * @author ryan
 */
class Server extends Drift{

    protected $requestListener;
    protected $address = "127.0.0.1";
    protected $sock;

    public function __construct(callable $requestListener){
        if(!is_callable($requestListener)){
            // Not a valid callable trigger error event
            return;
        }
        $this->requestListener = $requestListener;
    }

    public function __destruct(){
        echo "Closing Socket Connection\n";
        socket_close($this->sock);
    }

    public function listen($port){
        if(!ctype_digit($port)){
            // Not a valid port number trigger error event
        }
        $this->sock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);

        if($this->sock === false){
            echo "socket_create() failed: reason: " . socket_strerror(socket_last_error()) . "\n";
        }

        if(socket_bind($this->sock, $this->address, $port) === false){
            echo "socket_bind() failed: reason: " . socket_strerror(socket_last_error($this->sock)) . "\n";
        }

        if(socket_listen($this->sock, 5) === false){
            echo "socket_listen() failed: reason: " . socket_strerror(socket_last_error($this->sock)) . "\n";
        }

        do{
            $msgsock = socket_accept($this->sock);
            if($msgsock === false){
                echo "socket_accept() failed: reason: " . socket_strerror(socket_last_error($this->sock)) . "\n";
                break;
            }

            $request  = new Request($msgsock);
            $response = new Response($msgsock);
            call_user_func_array($this->requestListener, array($request, $response));


            /* Send instructions. */
//            $msg = "\nWelcome to the PHP Test Server. \n" .
//                    "To quit, type 'quit'. To shut down the server type 'shutdown'.\n";
//            socket_write($msgsock, $msg, strlen($msg));
//            socket_close($msgsock);
        }while(true);




        //call_user_func_array($requestListener, array($request, $response));
    }

}
