<?
namespace application\models;

use system\Model as Model;

/*

Model for main

*/

class Main_Model extends Model
{
	
	public function get_tasks()
	{	 
        
        return $this->db->query("SELECT * FROM `tasks`");

	}
    
    public function push_task($data)
	{	 
        if(!empty($data)){
            extract($data);
            $this->db->query("INSERT INTO tasks( name, email, status, text, image)
             VALUES('$name','$email','$status','$text','$image')",true);

        }
	}
    
    public function update_task($data)
	{	 
        if(!empty($data)){
            extract($data);
            if (!empty($image)){
                $this->db->query("UPDATE tasks as t1 SET t1.name='$name',t1.email='$email',
                t1.status='$status',t1.text='$text',t1.image='$image' WHERE t1.id='$id'",true);               
            }else{
                $this->db->query("UPDATE tasks as t1 SET t1.name='$name',t1.email='$email',
                t1.status='$status',t1.text='$text' WHERE t1.id='$id'",true);
            }
        }
	}  

}