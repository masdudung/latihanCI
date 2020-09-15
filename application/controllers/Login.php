<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends MY_Controller
{

	/**
	 * render login page 
	 */
	public function index()
	{
		# if user already loggin 
		$user = $this->session->user;
		if($user)
		redirect(base_url('home'));

		# if not yet login
		$this->template->render('login');
	}

	/**
	 * process auth user
	 */
	public function auth()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$this->load->model('UserModel');
		$user = $this->UserModel->getUser($username);

		$page = 'login';
		$notify = array('error' => true, 'message' => 'username atau password salah');

		if ($user) {
			# if password is correct
			if (password_verify($password, $user[0]->password)) {
				$currentUser = array(
					'user'  => $user[0]->username,
				);
				$this->session->set_userdata($currentUser);

				$notify = array('error' => false, 'message' => 'Berhasil Login');
				$page = 'home';
			}
			# if user found but password incorrect
			else {
				$notify = array('error' => true, 'message' => 'username atau password salah');
			}
		}

		$this->session->set_flashdata('notify', $notify);
		redirect(base_url($page));
	}

}
