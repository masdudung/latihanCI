<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once(APPPATH . 'core/API_Controller.php');

class Login extends API_Controller
{
    public $message = array(
        'error' => true,
        'message' => 'something wrong',
    );

    public function index_get()
    {
        $this->response($this->message, 200);
    }

    public function index_post()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        if (!$username || !$password) {
            $this->message['message'] = 'Username and password are required';
        } else {
            $this->load->model('UserModel');

            $user = $this->UserModel->getUser($username);
            if ($user) {
                # if password is correct
                if (password_verify($password, $user[0]->password)) {
                    $this->message['message'] = 'Login success';
                    $this->message['token'] = parent::generateToken($user[0]);
                } else {
                    $this->message['message'] = 'Username or Password incorrect';
                }
            } else {
                $this->message['message'] = 'Username or Password incorrect';
            }
        }

        $this->response($this->message, 200);
    }
}
