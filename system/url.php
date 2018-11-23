<?
namespace system;


/*
router url

*/


 class Url
 {


    public static function start()
    {
        

        // default controler and function
        
        $controller_name = 'main';
		$action_name = 'index';
		$admin_controller_name='';
        $admin_controller_path='';
        $is_admin='';


		$url = explode('/', $_SERVER['REQUEST_URI']);

		// get name controller
		if ( !empty($url[1]) )
			$controller_name = $url[1];
        
		// get name action  
		if ( !empty($url[2]) )
			$action_name = $url[2];
		
        // if we connected to admin panel
        
        if (strcasecmp($controller_name,'admin') == 0){

            if (Url::is_login()){
                $controller_name = 'main';//default admin controller
		        $action_name = 'index';//default method name

                if ( !empty($url[2]) )               
                    $controller_name=$url[2];
                
                if ( !empty($url[3]) )
                    $action_name=$url[3];

                $admin_controller_path='admin/';
                $admin_controller_name='admin\\';
                $is_admin='_Admin';

            }else{

                $controller_name='auth';
                $action_name = 'index';

            }

        }

        // Add prefixes

        $action_name = 'action_'.$action_name;
            
        // connect the controll class file
            
        $controller_path = APPPATH."controllers/".$admin_controller_path.$controller_name;
       

        if(file_exists($controller_path.'.php')){

                
            $controller_name='\application\controllers\\'.$admin_controller_name.ucfirst($controller_name).$is_admin.'_Controller';
               
            // create controler
            $controller = new $controller_name();
                     
            if(method_exists($controller, $action_name))
            {
                // call method action_name in controll class

                $controller->$action_name();
                   
            }else Url::errorPage404();

        }else Url::errorPage404();


    }

    
    
    protected function errorPage404()
    {

            
        header('HTTP/1.1 404 Service Unavailable.', TRUE, 404);
        echo '<p>Not Found</p> 
        <div><a href="/">на главную</a><div>';
        exit(3); // EXIT_CONFIG
    }
    
    //check loging connection
    protected function is_login()
    {
        session_start();
        if($_SESSION['status_admin']){
            return true;
        }else{
            return false;
        }
    }
    

}