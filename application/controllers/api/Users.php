<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once(APPPATH . 'core/API_Controller.php');

class Users extends API_Controller
{
    public $uid = null;
    public $message = array(
        'error' => true,
        'message' => 'something wrong',
    );

    public function __construct()
    {
        parent::__construct();
        $this->uid = parent::verifyToken($this->message);
        $this->load->model('UserModel');
    }

    public function index_get()
    {
        $uid = $this->uri->segment(3, null);
        if (!is_numeric($uid))
            $this->response($this->message, 200);

        $user = $this->UserModel->getUserByID($uid);

        $this->message['error'] = false;
        $this->message['message'] = $user;
        $this->response($this->message, 200);
    }

    public function index_post()
    {
        $this->_register();
    }

    public function index_put()
    {
        $uid = $this->uri->segment(3, null);
        if (!is_numeric($uid))
            $this->response($this->message, 200);

        $gender = (substr($this->input->input_stream('gender'), 0, 1) == 'm') ? 'M' : 'F';
        $user = array(
            'first_name' => $this->input->input_stream('first_name'),
            'last_name' => $this->input->input_stream('last_name'),
            'phone_number' => $this->input->input_stream('phone_number'),
            'gender' => $gender,
            'country_id' => (int) $this->input->input_stream('country_id'),
            'password' => password_hash($this->input->input_stream('password'), PASSWORD_DEFAULT),
        );

        $this->form_validation->set_data($user);
        if ($this->form_validation->run('put_users') == TRUE) {
            $existUser = $this->UserModel->getUserByID($uid);
            if ($existUser) {
                $update = $this->UserModel->updateUserByID($uid, $user);
                if ($update)
                    $this->message['message'] = 'User update success';
            } else {
                $this->message['message'] = 'User doesnt exist';
            }
        } else {
            $this->message['message'] = form_error('first_name');
            $this->message['message'] .= form_error('last_name');
            $this->message['message'] .= form_error('phone_number');
            $this->message['message'] .= form_error('password');
        }

        $this->response($this->message, 200);
    }

    public function index_delete()
    {
        $uid = $this->uri->segment(3, null);
        if (!is_numeric($uid))
            $this->response($this->message, 200);

        $user = $this->UserModel->deleteUserByID($uid);
        if ($user == 0) {
            $this->message['message'] = 'user doesnt exist';
        } else {
            $this->message['error'] = false;
            $this->message['message'] = 'User Deleted';
        }

        $this->response($this->message, 200);
    }

    public function profile_get()
    {
        $user = $this->UserModel->getUserByID($this->uid);

        $this->message['error'] = false;
        $this->message['message'] = $user;
        $this->response($this->message, 200);
    }

    public function profile_put()
    {
        $user = $this->UserModel->getUserByID($this->uid);

        $gender = (substr($this->input->input_stream('gender'), 0, 1) == 'm') ? 'M' : 'F';
        $user = array(
            'first_name' => $this->input->input_stream('first_name'),
            'last_name' => $this->input->input_stream('last_name'),
            'phone_number' => $this->input->input_stream('phone_number'),
            'gender' => $gender,
            'country_id' => (int) $this->input->input_stream('country_id'),
            'password' => password_hash($this->input->input_stream('password'), PASSWORD_DEFAULT),
        );

        $this->form_validation->set_data($user);
        if ($this->form_validation->run('put_users') == TRUE) {
            $update = $this->UserModel->updateUserByID($this->uid, $user);
            if ($update)
                $this->message['message'] = 'profile update success';
        } else {
            $this->message['message'] = form_error('first_name');
            $this->message['message'] .= form_error('last_name');
            $this->message['message'] .= form_error('phone_number');
            $this->message['message'] .= form_error('password');
        }

        $this->response($this->message, 200);
    }

    public function register_post()
    {
        $this->_register();
    }

    private function _register()
    {
        $gender = (substr($this->input->post('gender'), 0, 1) == 'm') ? 'M' : 'F';
        $user = array(
            'first_name' => $this->input->post('first_name'),
            'last_name' => $this->input->post('last_name'),
            'email' => $this->input->post('email'),
            'phone_number' => $this->input->post('phone_number'),
            'gender' => $gender,
            'country_id' => rand(1, 250),
            'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
        );

        if ($this->form_validation->run('post_users') == TRUE) {
            $insert = $this->UserModel->insertUser($user);
            if ($insert)
                $this->message['message'] = 'User register success';
        } else {
            $this->message['message'] = form_error('first_name');
            $this->message['message'] .= form_error('last_name');
            $this->message['message'] .= form_error('phone_number');
            $this->message['message'] .= form_error('email');
            $this->message['message'] .= form_error('password');
        }

        $this->response($this->message, 200);
    }
}
