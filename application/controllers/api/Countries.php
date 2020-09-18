<?php
defined('BASEPATH') or exit('No direct script access allowed');

require_once(APPPATH . 'core/API_Controller.php');

class Countries extends API_Controller
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
        $this->load->model('CountryModel');
    }

    public function index_get()
    {
        $length = 10;
        $page = (int) $this->input->get('page');
        if ($page <= 0)
            $page = 1;

        $start = (($page - 1) * $length);

        $count_all = $this->CountryModel->count_all();
        $pageTotal = ($count_all - ($count_all % $length)) / $length;
        if ($count_all % $length != 0)
            $pageTotal += 1;

        $output = array(
            "recordsTotal" => $count_all,
            "totalPage" => $pageTotal,
            "currentPage" => $page,
            "data" => $this->CountryModel->get_datatables($start, $length),
        );

        $this->message['error'] = false;
        $this->message['message'] = $output;
        $this->response($this->message, 200);
    }
}
