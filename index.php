<?
/*
*Programming:Ivan Terzi
*
*19.10.2018 13:08
* 
*/

ini_set('display_errors',1);

/* system folder*/

$system_path='system'.DIRECTORY_SEPARATOR;

if ( ! is_dir($system_path)){
    
    header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
    echo 'Your system folder path does not appear to be set correctly. '
    .pathinfo(__FILE__, PATHINFO_BASENAME);
    exit(3); // EXIT_CONFIG
	
    }
    
define('BASEPATH', $system_path); 

/*application folder*/

$application_path='application'.DIRECTORY_SEPARATOR;

if ( ! is_dir($application_path)){
    
    header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
    echo 'Your system folder path does not appear to be set correctly.'
    .pathinfo(__FILE__, PATHINFO_BASENAME);
    exit(3); // EXIT_CONFIG
	
    }
    
define('APPPATH', $application_path); 


/*load the bootstrap file*/

require_once(BASEPATH.'bootstrap.php');
