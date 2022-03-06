<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MemberController extends CI_Controller {
	function __construct()	{
		parent::__construct();
		$this->load->helper(array('form', 'url', 'cookie', 'date'));
        $this->load->library('upload');
		$this->load->database();
		$this->load->model('userModel');
		$this->load->model('memberModel');
	}
	public function index()
	{
		$this->memlist();
	}
	public function memlist(){
		$user_id = get_cookie('user_id');
        $this->load->view('layouts/header');
		$results = $this->memberModel->list_member($user_id);
		$data['results'] = $results;
        $this->load->view('member/member_view', $data);
        $this->load->view('layouts/footer');
	}
	public function newmem(){
		$this->load->view('layouts/header');
        $this->load->view('member/member_add_view');
        $this->load->view('layouts/footer');
	}
	public function saveMember(){
		$m_name = $this->input->post('m_name');
		$m_age = $this->input->post('m_age');
		$m_mobile = $this->input->post('m_mobile');
		$m_email = $this->input->post('m_email');
		$data = array(
			'M_NAME'=>$m_name,
			'M_AGE'=>$m_age,
			'M_MOBILE'=>$m_mobile,
			'M_EMAIL'=>$m_email,
			'M_UID'=>uniqid(),
			'M_INDATE'=>date('Y-m-d'),
			'USER_ID'=>get_cookie('user_id'),
		);
		$result = $this->memberModel->insert_member($data);
		redirect("MemberController/memlist");
	}
	public function editMember($id){
		$this->load->view('layouts/header');
		$results = $this->memberModel->get_member($id);
		$data['results'] = $results;
        $this->load->view('member/member_edit_view', $data);
        $this->load->view('layouts/footer');
	}
	public function updateMember($id){
		$m_name = $this->input->post('m_name');
		$m_age = $this->input->post('m_age');
		$m_mobile = $this->input->post('m_mobile');
		$m_email = $this->input->post('m_email');
		$data = array(
			'ID'=>$id,	
			'M_NAME'=>$m_name,
			'M_AGE'=>$m_age,
			'M_MOBILE'=>$m_mobile,
			'M_EMAIL'=>$m_email,
		);
		$send_data['update_data'] = $data;
		$send_data['id'] = $id;
		$result = $this->memberModel->update_member($send_data);
		redirect("MemberController/memlist");
	}
	public function deleteMember($id)
	{
		$result = $this->memberModel->delete_member($id);
		redirect("MemberController/memlist");
	}
	public function memberPicture($member_id, $sdate="", $edate="")
	{
		$this->load->view('layouts/header');
		if($sdate==''){$sdate = date('Y-m-d');}
		if($edate==''){$edate = date('Y-m-d');}
		$mem_result = $this->memberModel->get_member($member_id);
		$pic_result = $this->memberModel->get_picture($member_id, $sdate, $edate);
		$data['sdate'] = $sdate;
		$data['edate'] = $edate;
		$data['mem_info'] = $mem_result;
		$data['pic_info'] = $pic_result;
		$data['member_id'] = $member_id;
		set_cookie('member_id', $member_id, 0);
		set_cookie('member_name', $mem_result->M_NAME, 0);
		//var_dump($pic_result);
		$this->load->view('member/posture_view', $data);
		$this->load->view('layouts/footer');
	}
	public function uploadImages()
	{
		$this->load->view('layouts/header');
		$member_id = get_cookie('member_id');
		$sdate = date('Y-m-d');
		$edate = date('Y-m-d');
		$data['member_id'] = $member_id;
		$results2 = $this->memberModel->get_picture($member_id, $sdate, $edate);
		$data['results2'] = $results2;
		$this->load->view('upload/upload_view', $data);
		$this->load->view('layouts/footer');
	}
	public function deletePicture($id, $sdate, $edate)
	{
		$member_id = get_cookie('member_id');
		$this->memberModel->delete_picture($id);
		redirect("MemberController/memberPicture/$member_id/$sdate/$edate");
	}
}
