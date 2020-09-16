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

    /**
     * render users page 
     */
    public function user()
    {
        $username = $this->session->user;
        $user = $this->UserModel->getUser($username);
        $data['user'] = $user[0];

        $users = $this->UserModel->getAllUser();
        $data['users'] = $users;
        $data['customjs'] = 'admin.js';

        $this->template->render('user', $data);
    }

    /**
     * render countries page 
     */
    public function country()
    {
        $username = $this->session->user;
        $user = $this->UserModel->getUser($username);
        $data['user'] = $user[0];

        $countries = $this->UserModel->getAllCountry();
        $data['countries'] = $countries;
        $data['customjs'] = 'admin.js';

        $this->template->render('country', $data);
    }

    public function profileUpdate()
    {
        $username = $this->session->user;
        $about = $this->input->post('about');
        $updateuser = $this->UserModel->updateUser($username, $about);

        $notify = array('error' => true, 'message' => 'Terjadi kesalahan');
        if ($updateuser == true)
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
