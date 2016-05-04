<?php

class employee_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    public function create() {
//        $this->load->helper('url');
        $data2 = array(
            'email' => $this->input->post('email'),
            'mobile' => $this->input->post('mobile'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'type' => "Employee",
            'password' => md5($this->input->post('password')),
        );
        return $this->db->insert('authentication', $data2);
    }

    public function log($email, $pass) {
        $query = $this->db->get_where('authentication', array('email' => $email, 'password' => $pass,));
        return $query->row_array();
    }

    public function find_by_id($id) {
        if ($id === FALSE) {
            $query = $this->db->get('authentication');
            return $query->result_array();
        }

        $query = $this->db->get_where('authentication', array('auth_id' => $id));
        return $query->row_array();
    }

    public function add_details($id) {
        $query = $this->db->get_where('emp_profile', array('auth_id' => $id));
        $field_array = array(
            'auth_id' => $this->input->post('auth_id'),
            'designation' => $this->input->post('designation'),
            'name' => $this->input->post('name'),
            'type' => $this->input->post('type'),
            'industry_type' => $this->input->post('industry_type'),
            'contact_person' => $this->input->post('contact_person'),
            'updated_at' => date('Y-m-d H:i:s'),
        );

        if ($query->num_rows() > 0) {
            $this->db->where('auth_id', $id);
            return $this->db->update('emp_profile', $field_array);
        } else {
            $field_array['created_at'] = date('Y-m-d H:i:s');
            return $this->db->insert('emp_profile', $field_array);
        }
    }

    public function find_id($id) {
        $this->db->select('emp_profile.*,address_master.*');
        $this->db->from('emp_profile');
        $this->db->join('address_master', 'emp_profile.auth_id = address_master.auth_id');
        $query = $this->db->get();
        return $query->row_array();
    }

    public function profile($id) {
        $this->db->select('emp_profile.*,address_master.*,industry_master.*');
        $this->db->from('emp_profile');
        $this->db->join('address_master', 'emp_profile.auth_id = address_master.auth_id', 'left');
        $this->db->join('industry_master', 'emp_profile.industry_type = industry_master.indus_id', 'left');
        $this->db->where('emp_profile.auth_id', $id);

        $query = $this->db->get();
        return $query->row_array();
    }

    public function email_verification($data) {
        return $this->db->insert('profile_visit', $data);
    }

    public function vefication_check($id, $auth_id) {
        $sql = "select * from profile_visit where visitor_id=$auth_id AND jobseeker_id=$id";

        $query = $this->db->query($sql);
        return $query->row_array();
    }

    public function visitor_visit($auth_id) {
        $sql = "SELECT COUNT(jobseeker_id) AS count FROM profile_visit
                WHERE jobseeker_id=$auth_id";

        $query = $this->db->query($sql);
        return $query->row_array();
    }

}