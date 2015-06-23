<?php

namespace Drift\API;

use Drift\Core\Drift;

/**
 * Description of Response
 *
 * @author ryan
 */
class Response extends Drift{

    protected $sock;
    protected $headers = [
        "HTTP/1.1 200 Success",
        "Connection" => "keep-alive"
    ];
    protected $body    = "";

    public function __construct($sock){
        $this->sock = $sock;
    }

    /**
     * Writes data out to the socket.
     * The socket is not automatically closed
     */
    public function write(){
        $fullMessage = "";
        foreach($this->headers as $key => $value){
            if(ctype_digit($key)){
                $fullMessage .= "$value\r\n";
            }else{
                $fullMessage .= "$key: $value\r\n";
            }
        }
        $fullMessage .= "\r\n";
        $fullMessage .= $this->body;
        socket_write($this->sock, $fullMessage, strlen($fullMessage));
    }

    /**
     * Closes the socket connection
     */
    public function close(){
        socket_close($this->sock);
    }

    /**
     * Writes out json to the socket.
     * Socket will automatically close.
     * @param type $message The json data to encode
     */
    public function json($message){
        $this->setHeader("Content-Type", "text/json");
        $this->body = json_encode($message);
        $this->write();
        $this->close();
    }

    /**
     * Writes Html to the socket.
     * Scoket will automatically close.
     * @param type $message The Html data to write to the socket
     */
    public function html($message){
        $this->setHeader("Content-Type", "text/html");
        $this->body = $message;
        $this->write();
        $this->close();
    }

    /**
     * Sets a header to write out to the socket.
     * @param type $key Header key name
     * @param type $value Header value
     */
    public function setHeader($key, $value){
        $this->headers[$key] = $value;
    }

}
