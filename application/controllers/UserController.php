<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserController extends CI_Controller {
	function __construct()	{
		parent::__construct();
		$this->load->helper(array('form', 'url', 'cookie'));
        $this->load->library('upload');
		$this->load->database();
		$this->load->model('userModel');
	}
    public function index()
	{
		$this->login();
	}
	public function logout()
	{
		delete_cookie('user_id');
		delete_cookie('user_name');
		delete_cookie('member_id');
		delete_cookie('member_name');
		$this->login();
	}
    public function login()
    {
        $this->load->view('layouts/header');
        $this->load->view('login');
        $this->load->view('layouts/footer');
    }
	//로그인 확인
	public function check_login(){
		$data['u_email']  = $this->input->post('u_email');
		$data['u_pass'] = $this->input->post('u_pass');
		$result = $this->userModel->check_user_exists($data);
        if($result){
			$user_id = $result->ID;
			$user_name = $result->U_NAME;
            set_cookie('user_id', $user_id, 0);
            set_cookie('user_name', $user_name, 0);
			redirect('MemberController');
        }else{
			redirect('UserController');
        }

	}
    public function registUser()
    {
        $this->load->view('layouts/header');
        $this->load->view('register_view');
        $this->load->view('layouts/footer');
    }
    public function saveUser()
    {
        $data = array(
            'U_NAME' => $this->input->post('u_name'),
            'U_PASS' => $this->input->post('u_pass'),
            'U_EMAIL' => $this->input->post('u_email'),
            'U_UID' => uniqid(),
            'CREATED_AT' => date("Y-m-d") ,
            'U_ACTIVATE' => 0,
        );
        $result = $this->userModel->insert_user($data);
        if ($result != 1){
            echo 'error...';
        }else{
            $this->login();
        }
    }
    public function userLoginOK()
    {
        echo 'login OK...';
    }
    public function userLoginFail()
    {
        echo 'login Failed...';
    }
	public function findUser()
	{
        $this->load->view('layouts/header');
        $this->load->view('find_user_view');
        $this->load->view('layouts/footer');
	}
    public function sendEmail(){
		$this->load->library('email');
		$this->load->library('parser');
		
		$config = array();
		$config['useragent'] = "CodeIgniter";
		$config['protocol']  = "smtp";
		$config['smtp_host'] = "ssl://smtp.googlemail.com";
		$config['smtp_user'] = "ccnplaza@gmail.com";
		$config['smtp_pass'] = "@Choe3415ccn";
		$config['smtp_port'] = "465";
		$config['mailtype'] = 'html';
		$config['charset']  = 'euc-kr';
		$config['newline']  = "\r\n";
		$config['smtp_timeout'] = "60";
		$config['wordwrap'] = TRUE;

		$this->email->clear();
		$this->email->initialize($config);
		
		$email=$this->input->post('u_email');
		$result=$this->userModel->get_user_byemail($email);
		if($result){
			$pass=$result->U_PASS;
			$this->email->from("ccnplaza@gmail.com" , "관리자"); //보내는 사람
			$this->email->to($email); //받는 사람
			$this->email->subject("Your password notification service"); //메일 제목
			$this->email->message("안녕하세요? 회원님. ".
					"요청하신 회원님의 비밀번호는 다음과 같습니다."."<br>".
					"<br>비밀번호: ".$pass."<br>".
					"비밀번호를 분실하거나 다른 사람들한테 노출되지 않도록 주의를 부탁드립니다.");
			if ($this->email->send())
			{
				echo 'ok';
				// $this->load->view('header/header');
				// $this->load->view('email_send_ok');
				// $this->load->view('header/footer');
			} else {
				echo 'fail';
				// $this->load->view('header/header');
				// $this->load->view('email_send_fail');
				// $this->load->view('header/footer');
			}
		} else {
			echo 'fail2';
			// $this->load->view('header/header');
			// $this->load->view('email_send_fail');
			// $this->load->view('header/footer');
		}
	}

}
