<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UploadController extends CI_Controller {
	function __construct()	{
		parent::__construct();
		$this->load->helper(array('form', 'url', 'cookie'));
        $this->load->library('upload');
		$this->load->database();
		$this->load->model('userModel');
		$this->load->model('memberModel');
	}
    public function index()
	{
		$this->selectFile();
	}
    public function selectFile()
    {
        $this->load->view('layouts/header');
        $this->load->view('upload/upload_view');
        $this->load->view('layouts/footer');
    }
    public function uploadFile(){
        if($this->input->post('fileSubmit')){ 
            if(!empty($_FILES['files']['name']) && count(array_filter($_FILES['files']['name'])) > 0){ 
                $filesCount = count($_FILES['files']['name']); 
                for($i = 0; $i < $filesCount; $i++){ 
                    $fileName = $_FILES['files']['name'][$i]; 
                    $new_filename = uniqid() . '.' . pathinfo($fileName,PATHINFO_EXTENSION);
                    $_FILES['file']['name']     = $new_filename; //$_FILES['files']['name'][$i]; 
                    $_FILES['file']['type']     = $_FILES['files']['type'][$i]; 
                    $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i]; 
                    $_FILES['file']['error']    = $_FILES['files']['error'][$i]; 
                    $_FILES['file']['size']     = $_FILES['files']['size'][$i]; 
                    // File upload configuration 
                    $uploadPath = 'public/upload/'.get_cookie('user_id'); 
                    if(!is_dir($uploadPath)){
                        mkdir($uploadPath);
                    }
                    $config['upload_path'] = $uploadPath; 
                    $config['allowed_types'] = 'jpg|jpeg|png|gif'; 
                    // Load and initialize upload library 
                    $this->load->library('upload', $config); 
                    $this->upload->initialize($config); 
                    if($this->upload->do_upload('file')){ 
                        $fileData = $this->upload->data(); 
                        $uploadData[$i]['IMG_NAME'] = $new_filename; //$fileData['file_name'];
                        $uploadData[$i]['PIC_DATE'] = date('Y-m-d');
                        $uploadData[$i]['USER_ID'] = get_cookie('user_id');
                        $uploadData[$i]['MEMBER_ID'] = get_cookie('member_id');
                    }else{  
                        $errorUploadType .= $_FILES['file']['name'].' | ';  
                    } 
                } 
                $errorUploadType = !empty($errorUploadType)?'<br/>File Type Error: '.trim($errorUploadType, ' | '):''; 
                if(!empty($uploadData)){ 
                    // Insert files data into the database 
                    foreach($uploadData as $row){
                        $this->memberModel->insert_picture($row);
                    }
                }else{ 
                    $statusMsg = "Sorry, there was an error uploading your file.".$errorUploadType; 
                } 
            }else{ 
                $statusMsg = 'Please select image files to upload.'; 
            } 
        } 
        redirect('MemberController/memberPicture/'.get_cookie('member_id'));         
    } 
    public function viewFile(){
        $this->load->view('layouts/header');
        $this->load->view('draw/posture_view');
        $this->load->view('layouts/footer');
    }
}
