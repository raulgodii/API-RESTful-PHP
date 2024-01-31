<?php
    use Lib\ResponseHTTP;
    $ResponseHTTP = new ResponseHTTP;

    echo $ResponseHTTP->setHeaders();

    if(count($body) == 0){
        echo $ResponseHTTP->statusMessage(404, "No existen competiciones");
    } else {
        echo $ResponseHTTP->statusMessage(202, "OK");
    }

    echo json_encode(
        [
            "body" => $body
        ]
    );