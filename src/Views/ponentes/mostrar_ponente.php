<?php
    use Lib\ResponseHTTP;
    $ResponseHTTP = new ResponseHTTP;

    echo $ResponseHTTP->setHeaders();

    if(count($body) == 0){
        echo $ResponseHTTP->statusMessage(404, "Ponente no existente");
    } else {
        echo $ResponseHTTP->statusMessage(202, "OK");
    }

    echo json_encode(
        [
            "body" => $body
        ]
    );