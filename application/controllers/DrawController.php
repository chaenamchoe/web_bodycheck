<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DrawController extends CI_Controller {
	function __construct()	{
		parent::__construct();
		$this->load->helper(array('form', 'url', 'cookie'));
        $this->load->library('upload');
		$this->load->database();
		$this->load->model('userModel');
	}
    public function index()
	{
		$this->draw();
	}
    public function draw()
    {
        $this->load->view('layouts/header');
        $this->load->view('draw/canvas_view');
        $this->load->view('layouts/footer');
    }
    public function draw2()
    {
        $this->load->view('layouts/header');
        $this->load->view('draw/canvas_view2');
        $this->load->view('layouts/footer');
    }
    public function compareImage(){
        $this->load->view('layouts/header');
        $this->load->view('draw/compare_view');
        $this->load->view('layouts/footer');
    }
    public function postureView(){
        $this->load->view('layouts/header');
        $this->load->view('draw/posture_view');
        $this->load->view('layouts/footer');
    }
    public function draw_arrow()
    {
        $this->load->view('draw/arrow_line_view');
    }
}
