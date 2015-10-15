<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function register() {
        $this->form_validation->set_rules('email', 'email', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        $this->form_validation->set_rules('mobile', 'mobile', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->loadFinalView(array('User/registration'));
        } else {
            $this->User_model->create();
            redirect('User/login_show', 'refresh');
            // $this->loadFinalView(array('User/login'));
            //redirect('news', 'refresh');
        }
    }

    public function login() {

        if ($this->input->post()) {

            $new = $_POST['email'];
            $pass = md5($_POST['password']);
            $check = $this->User_model->log($new, $pass);

            if (!empty($check) && $check['user_type'] == 'User' ) {
                $this->session->set_userdata("user_id", $check['auth_id']);
                $this->session->set_userdata("user_email", $check['email']);
                $this->session->set_userdata("user_mobile", $check['mobile']);
                $this->session->set_userdata("user_type", $check['type']);
                $check1['User'] = $this->User_model->find_by_id($check['auth_id']);
                //$this->load->view('User/success');
                redirect('User/Add_profile', 'refresh');
            } else {
                $data['user'] = "Incorrect Login";
                $this->load->view('User/login', $data);
            }
        }

        $data = array('title' => 'Login', 'content' => 'User/login');
        $this->load->view('template2', $data);
    }

    public function Add_profile() {
$this->load->model('Master_model');
        if ($this->is_logged_in() == TRUE) {
            $user_id = $this->session->userdata("user_id");
            $check = $this->User_model->find_by_user_id($user_id);
            if ($this->input->post()) {
                $user_id = $this->session->userdata("user_id");
                $user_email = $this->session->userdata("user_email");
                $user_mobile = $this->session->userdata("user_mobile");
                $this->form_validation->set_rules('name', 'name', 'required');
                $this->form_validation->set_rules('dob', 'dob', 'required');
                $this->form_validation->set_rules('sex', 'sex', 'required');
                $this->form_validation->set_rules('experince_year', 'experince_year', 'required');
                $this->form_validation->set_rules('experince_month', 'experince_month', 'required');
                $this->form_validation->set_rules('current_location', 'current_location', 'required');
                $this->form_validation->set_rules('prefred_location', 'prefred_location', 'required');
                $this->form_validation->set_rules('industry', 'industry', 'required');
                $this->form_validation->set_rules('function_area', 'function_area', 'required');
                $this->form_validation->set_rules('role', 'role', 'required');
                $this->form_validation->set_rules('key_skill', 'key_skill', 'required');
                $this->form_validation->set_rules('marital_status', 'marital_status', 'required');
                $this->form_validation->set_rules('resume_headline', 'resume_headline', 'required');
                //$check1['User'] = $this->User_model->find_by_id($user_id);
                if ($this->form_validation->run() === True) {
                    if ($check['auth_id'] != $user_id) {
                        $check2['User1'] = $this->User_model->Add_detail($user_id, $user_email, $user_mobile);
                    } else {
                        $data['user'] = $this->User_model->profile_update($user_id, $user_email, $user_mobile);
                    }
                }
                $this->load->view('User/success');
            }
            $dropdown['dropdowns'] = $this->Master_model->getLocation();
            $data = array('title' => 'Basic Profile', 'content' => 'User/Add_profile', 'view_data' => $dropdown);
            $this->load->view('template1', $data);
        } else {
            redirect('User/login', 'refresh');
        }
    }

    public function logout() {

        $this->session->unset_userdata("user_id");
        $this->session->unset_userdata("user_email");
        $this->session->unset_userdata("user_mobile");
        $this->session->unset_userdata("user_type");
//        $this->session->session_destroy();
        redirect('User/login', 'refresh');
    }

    public function is_logged_in() {
        $is_logged_in = $this->session->userdata('user_id');
        if (isset($is_logged_in) && $is_logged_in != '') {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function profile_update() {
        if ($this->is_logged_in() == TRUE) {
            if ($this->input->post()) {
                $user_id = $this->session->userdata("user_id");
                $user_email = $this->session->userdata("user_email");
                $user_mobile = $this->session->userdata("user_mobile");
                $this->form_validation->set_rules('name', 'name', 'required');
                $this->form_validation->set_rules('dob', 'dob', 'required');
                $this->form_validation->set_rules('sex', 'sex', 'required');
                $this->form_validation->set_rules('experince_year', 'experince_year', 'required');
                $this->form_validation->set_rules('experince_month', 'experince_month', 'required');
                $this->form_validation->set_rules('current_location', 'current_location', 'required');
                $this->form_validation->set_rules('prefred_location', 'prefred_location', 'required');
                $this->form_validation->set_rules('industry', 'industry', 'required');
                $this->form_validation->set_rules('function_area', 'function_area', 'required');
                $this->form_validation->set_rules('role', 'role', 'required');
                $this->form_validation->set_rules('key_skill', 'key_skill', 'required');
                $this->form_validation->set_rules('marital_status', 'marital_status', 'required');
                $this->form_validation->set_rules('resume_headline', 'resume_headline', 'required');
                $data['user'] = $this->User_model->profile_update($user_id);
                redirect('User/Profile_update', 'refresh');
            }
            $is_logged_in = $this->session->userdata('user_id');
            $show['user'] = $this->User_model->Show_profile($is_logged_in);
            $data = array('title' => 'Basic Profile', 'content' => 'User/Profile_update', 'view_data' => $show);
            $this->load->view('template1', $data);
        } else {
            redirect('User/login', 'refresh');
        }
    }

    public function user_qualification() {
        $this->load->model('Master_model');
        if ($this->is_logged_in() == TRUE) {
            if ($this->input->post()) {
                $user_id = $this->session->userdata("user_id");
                $this->form_validation->set_rules('qualification', 'qualification', 'required');
                $this->form_validation->set_rules('specialization', 'specialization', 'required');
                $this->form_validation->set_rules('institute', 'institute', 'required');
                $this->form_validation->set_rules('year', 'year', 'required');


                $qual = $this->User_model->user_qualification_by_id($user_id);

                if ($this->form_validation->run() === True) {
                    if ($qual['auth_id'] !== $user_id) {
                        $add = $this->User_model->user_qualification($user_id);
                    } else {
                        $update = $this->User_model->user_qualification_update($user_id);
                    }
                }
            }
            $is_logged_in = $this->session->userdata('user_id');

            //$special['edu'] = $this->User_model->education_master();
            //var_dump($special);
            $dropdown['dropdowns'] = $this->Master_model->getQualification();
            $dropdown['institute'] = $this->Master_model->institute();
            $data = array('title' => 'Basic Qualification', 'content' => 'User/user_qualification', 'view_data' => $dropdown);
            $this->load->view('template1', $data);
        } else {
            redirect('User/login', 'refresh');
        }
    }

    public function user_projects() {
      $this->load->model('Master_model');
         $user_id = $this->session->userdata("user_id");
                $qual1 = $this->User_model->project_by_id($user_id);
        if ($this->is_logged_in() == TRUE) {
            if ($this->input->post()) {
                
               
                $this->form_validation->set_rules('client', 'client', 'required');
                $this->form_validation->set_rules('projects_title', 'projects_title', 'required');
                $this->form_validation->set_rules('to', 'to', 'required');
                $this->form_validation->set_rules('from', 'from', 'required');
                $this->form_validation->set_rules('location', 'location', 'required');
                $this->form_validation->set_rules('site', 'site', 'required');
                $this->form_validation->set_rules('type', 'type', 'required');
                $this->form_validation->set_rules('detail', 'detail', 'required');
                $this->form_validation->set_rules('role', 'role', 'required');
                $this->form_validation->set_rules('role_description', 'role_description', 'required');
                $this->form_validation->set_rules('team_size', 'team_size', 'required');
                $this->form_validation->set_rules('skill', 'skill', 'required');



                
                if ($this->form_validation->run() === True) {
                    
                       $this->User_model->project_add($user_id);
                    
                }
            }
            $is_logged_in = $this->session->userdata('user_id');

            //$special['edu'] = $this->User_model->education_master();
            //var_dump($special);

            $data = array('title' => 'Projects', 'content' => 'User/Add_projects', 'view_data' => 'blank');
            $this->load->view('template1', $data);
        } else {
            redirect('User/login', 'refresh');
        }
    }

}
