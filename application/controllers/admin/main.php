<?
namespace application\controllers\admin;

use \system\Controller;
use \application\models\Main_Model as Model;
use \application\lib\SimpleImage;
/*

controller http://../admin/main/

*/


class Main_Admin_Controller extends Controller
{

	public function action_index(){


        $this->model= new Model();

        $update =array();
        $update['name']='';
        $update['email']='';
        $update['text']='';
        $update['status']=0;
        $update['image']='';

        //verify tasks

        if(isset($_POST['name']) && (isset($_POST['email'])) && (isset($_POST['text']))&& (isset($_POST['id'])) 
        &&(strcmp($_POST['action'],'edit')==0)) {

            
            $update['name'] = htmlentities($_POST['name'], ENT_QUOTES, "UTF-8");
            $update['email'] = htmlentities($_POST['email'], ENT_QUOTES, "UTF-8");
            $update['text'] = htmlentities($_POST['text'], ENT_QUOTES, "UTF-8");
            $update['id'] = (int)$_POST['id'];

            if(strcmp($_POST['status'],'on')==0){
               $update['status']=1; 
            }


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

            $update['image']=$_FILES["image"]['name'];
            unset($image);
            }

            $this->model->update_task($update);
        }

        $data=array();
        $result=$this->model->get_tasks();
 
        //generate view for main page
        
        $data['title']="Main page";
        $data['table']='';
        if(!empty($result)){
            foreach($result as $res){
                $data['table'].= '<tr id="tr_'.$res[0].'">
                <td class="tr_id_'.$res[0].'">'.$res[0].'</td>
                <td class="tr_name_'.$res[0].'">'.$res[1].'</td>
                <td class="tr_email_'.$res[0].'">'.$res[2].'</td>
                <td class="tr_status_'.$res[0].'">'.$res[3].'</td>
                <td class="tr_text_'.$res[0].'">'.$res[4].'</td>
                <td class="tr_image_'.$res[0].'"><img src="/www/img/thumb_'.$res[5].'"class="mr-3" src="#"></td>
                <td><button type="button"  value="'.$res[0].'" class="edit btn btn-primary" data-toggle="modal" 
                data-target="#exampleModal" data-whatever="@getbootstrap">
                Edit</button></td>
                </tr>';

            }
        }
        //generate view
		$this->view->generate('admin/index.php',$data);	
    }
    
}