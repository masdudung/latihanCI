<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('UserModel');

        # check user login
        $user = $this->session->user;
        if (!$user) {
            $notify = array('error' => true, 'message' => 'Anda belum Login');
            $this->session->set_flashdata('notify', $notify);
            redirect(base_url('login'));
        }
    }

    /**
     * render Home page 
     */
    public function index()
    {
        $username = $this->session->user;
        $user = $this->UserModel->getUser($username);
        $data['user'] = $user[0];

        $this->template->render('home', $data);
    }

    public function profileUpdate()
    {
        $username = $this->session->user;
        $about = $this->input->post('about');
        $updateuser = $this->UserModel->updateUser($username, $about);
        
        $notify = array('error' => true, 'message' => 'Terjadi kesalahan');
        if($updateuser==true)
            $notify = array('error' => false, 'message' => 'Berhasil update data');
        
        $this->session->set_flashdata('notify', $notify);
        redirect(base_url('home'));
    }

    /**
     * process logout
     */
    public function logout()
    {
        session_destroy();
        redirect(base_url('login'));
    }
}
