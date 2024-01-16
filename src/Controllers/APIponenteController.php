<?php
namespace Controllers;
use Lib\Pages;

class APIponenteController{
    private Pages $pages;
    function __construct(){
        $this->pages = new Pages();
    }
    
}