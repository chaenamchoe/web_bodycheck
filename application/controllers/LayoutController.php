<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LayoutController extends CI_Controller {
	function __construct()	{
		parent::__construct();
		$this->load->helper(array('form', 'url', 'cookie'));
        $this->load->library('upload');
		$this->load->database();
		$this->load->model('userModel');
	}
    public function header()
    {
        $this->load->view('layouts/header');
    }
    public function footer()
    {
        $this->load->view('layouts/footer');
    }
}
