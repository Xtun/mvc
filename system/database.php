<?
namespace system;

use \application\config\Db_config as db_config;


/*

class for connection to database and request processing

*/


class Database
{
    protected $link; 
  
  public function query($query,$priority=false)
  { 
    if ($this->connect()){
        if($priority){
            $this->updater($query);
        }else{
            $result=$this->request($query);
            return $result;
            
        }
        
    }
   

  }  

  private function connect()
  {
       
    $db_config = new db_config();
    $db_config->get_config();

      // connect to database
    $link = mysqli_connect(
        $db_config->get_config()['host'], 
        $db_config->get_config()['user'], 
        $db_config->get_config()['password'],
        $db_config->get_config()['database']) 
        or die("Error connecting to database" . mysqli_error($link));
    
    $this->link=$link;

   return true;
  }

  
  private function request($query){
    // perform database operations
    
    $result = mysqli_query($this->link, $query) or die("Error request " . mysqli_error($this->link)); 
    // close connect
    mysqli_close($this->link);
    
    $row=$result->fetch_all();
    $result->close();

    return $row;
  }
  
  
  private function updater($query){
    // perform database operations
    
    mysqli_query($this->link, $query) or die("Error request " . mysqli_error($this->link)); 
    // close connect
    mysqli_close($this->link);

  }

}
