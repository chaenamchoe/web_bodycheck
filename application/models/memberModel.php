<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class MemberModel extends CI_Model
{
    function __construct()
    {
        parent::__construct();

    }
    function get_member($id)
    {
        return $this->db->get_where('MEMBER', array('ID'=>$id))->row();
    }
    function get_picture($member_id, $sdate, $edate)
    {
        $this->db->where('MEMBER_ID', $member_id);
        $this->db->where('PIC_DATE >=', $sdate);
        $this->db->where('PIC_DATE <=', $edate);
        return $this->db->get('MEMBER_PICTURE')->result_array();
        // return $this->db->get_where('MEMBER_PICTURE', array('MEMBER_ID'=>$member_id))->result_array();
    }
    function list_member($user_id){
		return $this->db->get_where('MEMBER', array('USER_ID'=>$user_id))->result_array();
    }    
    function insert_member($data)
    {
        $this->db->insert('MEMBER', $data);
        return $this->db->affected_rows();
        // return ($this->db->affected_rows() != 1) ? false : true;
    }
    function update_member($data)
    {
        $id = $data['id'];
        $up_data = $data['update_data'];
        $this->db->where('ID', $id);
        $this->db->update('MEMBER', $up_data);
        return $this->db->affected_rows();
        // return ($this->db->affected_rows() != 1) ? false : true;
    }
    function delete_member($id)
    {
        $this->db->delete('MEMBER', array('ID' => $id));
    }
    function insert_picture($uploadData)
    {
        $this->db->insert('MEMBER_PICTURE', $uploadData);
        return $this->db->affected_rows();
    }
    function delete_picture($id)
    {
        $this->db->delete('MEMBER_PICTURE', array('ID'=>$id));
    }
}