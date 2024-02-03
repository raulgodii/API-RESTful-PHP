<?php

use Lib\ResponseHTTP;

$ResponseHTTP = new ResponseHTTP;

echo $ResponseHTTP->setHeaders();

if (isset($error)) {
    echo $ResponseHTTP->statusMessage(404, $error, []);
} else {
    if (count($body) == 0) {
        echo $ResponseHTTP->statusMessage(404, "Competicion no creada", $body);
    } else {
        echo $ResponseHTTP->statusMessage(202, "Competicion creada con exito", $body);
    }
}
