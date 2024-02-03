<?php

use Lib\ResponseHTTP;

$ResponseHTTP = new ResponseHTTP;

echo $ResponseHTTP->setHeaders();

if (isset($error)) {
    echo $ResponseHTTP->statusMessage(404, $error, []);
} else {
    if ($rowCount == 0) {
        echo $ResponseHTTP->statusMessage(404, "Competicion no creada", []);
    } else {
        echo $ResponseHTTP->statusMessage(202, "Competicion creada con exito", []);
    }
}
