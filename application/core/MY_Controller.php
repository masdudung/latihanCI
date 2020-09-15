<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Controller Custom
 * bertindak layaknya midleware. 
 * sebelum memasuki kontroller utama
 * 
 */

class MY_Controller extends CI_Controller {

    // variable untuk inisiasi library template
    public $template;

    // variable untuk inisiasi user info (dari session)
    public $userInfo;
    

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array('template'));

        #initiate template library
        $this->template = new Template('template/default');
    }

}