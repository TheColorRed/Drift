# Drift
Non blocking input/output server for php

### Example Application

```php
<?php

use Drift\API\Http;
use Drift\API\Request;
use Drift\API\Response;

$http = new Http();

$http->createServer(function (Request $req, Response $res){
    $req->on("end", function() use ($res){
        $res->json(["name" => "Drift Test", "Categories" => ["Driving", "Biking", "Boating", "Snowboarding"]]);
    });
})->listen(3000);
```

### Create an Executable
Create an executable `sudo vim /usr/sbin/drift`
```sh
#!/bin/sh

fileName=$(basename $1)
DIR="$( cd "$( dirname "$1" )" && pwd )"

php /Drift/index.php $DIR $fileName
```

Make the file executable `sudo chmod +x /usr/sbin/drift`


### Running your Application

```
cd /path/to/application
drift test.php
```
