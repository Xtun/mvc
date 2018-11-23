<?
namespace application\controllers;

use \system\Controller;
use \application\models\Main_Model as Model;
use \application\lib\SimpleImage;

/*

Controller main page

*/

class Main_Controller extends Controller
{

	public function action_index(){

        $this->model= new Model();

        $insert =array();
        $insert['name']='';
        $insert['email']='';
        $insert['text']='';
        $insert['status']=0;
        $insert['image']='';
        //verify tasks

        if(isset($_POST['name']) && (isset($_POST['email'])) && (isset($_POST['text'])) 
        &&(strcmp($_POST['action'],'create')==0)) {
            
            $insert['name'] = htmlentities($_POST['name'], ENT_QUOTES, "UTF-8");
            
            if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $insert['email'] = htmlentities($_POST['email'], ENT_QUOTES, "UTF-8");
            }else{
                echo "E-mail адрес указан неверно.\n";
            }

            $insert['text'] = htmlentities($_POST['text'], ENT_QUOTES, "UTF-8");
            
            
            if ((($_FILES["image"]["type"] == "image/gif")
                || ($_FILES["image"]["type"] == "image/jpeg")
                || ($_FILES["image"]["type"] == "image/png"))
                && ($_FILES["image"]["size"] < 500000)) {
                $uploaddir = 'www/img/';
                $uploadfile = $uploaddir . basename($_FILES['image']['name']);

                move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile); 
            
            $image = new SimpleImage();
            $image->load($uploadfile);
            $image->resize(320, 240);
            $image->save('www/img/thumb_'.$_FILES["image"]['name']);
            

            $insert['image']=$_FILES["image"]['name'];



            unset($image);

            }
            $this->model->push_task($insert);
        }

        $data=array();
        $result=$this->model->get_tasks();
 
        //generate view for main page
        
        $data['title']="Main page";
        $data['table']='';
        if(!empty($result)){
            foreach($result as $res){
                $data['table'].= '<tr id="tr_'.$res[0].'">
                <td>'.$res[0].'</td>
                <td>'.$res[1].'</td>
                <td>'.$res[2].'</td>
                <td>'.$res[3].'</td>
                <td>'.$res[4].'</td>
                <td><img src="/www/img/thumb_'.$res[5].'"class="mr-3" src="#"></td>
     
                </tr>';

            }
        }
		$this->view->generate('main.php', $data);
        
	
    }
    
}
