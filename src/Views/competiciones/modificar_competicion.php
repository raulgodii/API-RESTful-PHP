<?php

use Lib\ResponseHTTP;

$ResponseHTTP = new ResponseHTTP;

echo $ResponseHTTP->setHeaders();

if ($rowCount == 0) {
    echo $ResponseHTTP->statusMessage(404, "Competicion no modificada");
} else {
    echo $ResponseHTTP->statusMessage(202, "Competicion modificada con exito");
}
