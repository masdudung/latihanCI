<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        # load model
        $this->load->model('UserModel');
        $this->load->model('CountryModel');

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
        $data['customjs'] = 'admin.js';

        $this->template->render('user', $data);
    }

    public function ajax_user()
    {
        header('Content-Type: application/json');

        $list = $this->UserModel->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->fullname;
            $row[] = $field->email;
            $row[] = $field->phone_number;
            $row[] = $field->gender;
            $row[] = $field->name;

            $data[] = $row;
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->UserModel->count_all(),
            "recordsFiltered" => $this->UserModel->count_filtered(),
            "data" => $data,
        );

        //output dalam format JSON
        echo json_encode($output);
    }

    /**
     * render countries page 
     */
    public function country()
    {
        $username = $this->session->user;
        $user = $this->UserModel->getUser($username);
        $data['user'] = $user[0];
        $data['customjs'] = 'admin.js';

        $this->template->render('country', $data);
    }

    public function ajax_country()
    {
        header('Content-Type: application/json');

        $list = $this->CountryModel->get_datatables();
        $data = array();
        $no = $this->input->post('start');
        foreach ($list as $field) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $field->name;
            $row[] = $field->alpha2_code;
            $row[] = $field->alpha3_code;
            $row[] = $field->calling_code;
            $row[] = $field->demonym;
            $row[] = "<img src='$field->flag' width='20px'>";

            $data[] = $row;
        }

        $output = array(
            "draw" => $this->input->post('draw'),
            "recordsTotal" => $this->CountryModel->count_all(),
            "recordsFiltered" => $this->CountryModel->count_filtered(),
            "data" => $data,
        );

        //output dalam format JSON
        echo json_encode($output);
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
