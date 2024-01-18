<?php
    use Lib\ResponseHTTP;
    $ResponseHTTP = new ResponseHTTP;

    echo $ResponseHTTP->setHeaders();

    echo $ResponseHTTP->statusMessage(404, "No existen ponentes");

    echo json_encode(
        [
            "body" => $body
        ]
    );