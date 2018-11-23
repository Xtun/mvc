<?
namespace system;

use \system\Database as DB;

/*

Use model 

*/

class Model
{
    protected $db;

    function __construct(){
        
        $this->db=new DB();

    }

	public function get_data()
	{
		// todo
	}
}