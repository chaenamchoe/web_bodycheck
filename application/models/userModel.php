<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class UserModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();

    }
    function check_user_exists($data){
        $u_email = $data['u_email'];
        $u_pass = $data['u_pass'];
		return $this->db->get_where('USERS', array('U_EMAIL'=>$u_email, 'U_PASS'=>$u_pass))->row();
    }    
    function insert_user($data)
    {
        $this->db->insert('USERS', $data);
        return $this->db->affected_rows();
        // return ($this->db->affected_rows() != 1) ? false : true;
    }
    function get_user_byemail($email)
    {
        return $this->db->get_where('USERS', array('U_EMAIL'=>$email))->row();
    }
}