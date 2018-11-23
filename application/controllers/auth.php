<?
namespace application\controllers;


use \system\Controller;
use \application\controllers\admin\Main_Admin_Controller;
 
class Auth_Controller extends Controller
{

	public function action_index()
    {
        session_start();
        /*
            This is class for a validation admin
        
        */
        //verify login and password
       
        if(isset($_POST['login']) && (isset($_POST['password']))) {
            
            $login = htmlentities($_POST['login'], ENT_QUOTES, "UTF-8");
            $password = htmlentities($_POST['password'], ENT_QUOTES, "UTF-8");
           
            if ((strcmp($login, 'admin') == 0) && (strcmp($password,'123') == 0)){
                
                $this->login($login);
                
            
            }else{
            
                echo "Incorrectly password or username";

            
            }
        }
  

        // if logged in then we transfer the call to the admin panel
       
        if ($_SESSION['status_admin']){

            header("Location: /admin");

        }else{
       
            $this->view->generate('admin/login.php');
        }
        	
    }

    private function login($login)
    {

        $_SESSION['status_admin']=true;
        $_SESSION['session_id']=session_id();
        $_SESSION['name']=$login;

    }

    public function action_logout()
    {

        session_start();
        $_SESSION['status_admin']=false;
        session_destroy();

        header("Location: /");
    }
    
    public function is_login()
    {
        session_start();
        if($_SESSION['status_admin']){
            return true;
        }else{
            return false;
        }
    }
    
}