<?php
    use Lib\ResponseHTTP;
    $ResponseHTTP = new ResponseHTTP;

    echo $ResponseHTTP->setHeaders();

    echo $ResponseHTTP->statusMessage(404, "Error 404");
?>