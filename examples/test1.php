<?php

use Drift\API\Http;
use Drift\API\Request;
use Drift\API\Response;

$http = new Http();

$http->createServer(function (Request $req, Response $res){
    $req->on("end", function() use ($res){
        $res->json(["name" => "Ryan", "Categories" => ["Driving", "Biking", "Boating", "Snowboarding"]]);
    });
})->listen(3000);

