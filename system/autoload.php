<?
    /*

    A simple autoloader, that loads files during their initialization.
    
    */
    function autoloader ($class) 
    {
     $class = str_replace('\\', '/', $class);
     $class = explode('_', $class);
    require_once (strtolower($class[0]).'.php');
    }
    
    spl_autoload_register('autoloader');
