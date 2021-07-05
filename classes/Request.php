<?php 

class Request  
{
    public function get($key)
    {
        return $_GET[$key];
    }

    public function getHas($key)
    {
        return isset($_GET[$key]);
    }

    
    public function post($key)
    {
        return $_POST[$key];
    }

    public function postClean($key)
    {
        return trim(htmlspecialchars($_POST[$key]));
    }

    public function postHas($key)
    {
        return isset($_POST[$key]);
    }

}