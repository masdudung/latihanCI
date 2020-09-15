<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template {

    protected $CI;
    protected $folder;

    public function __construct($_folder=NULL)
    {
            // Assign the CodeIgniter super-object
            $this->CI =& get_instance();
            
            // set default folder template
            $this->folder = 'template/default';
            if($_folder)
            {
                $this->folder = $_folder;
            }
    }

    public function render($file=null, $_data=null){

        $data = array();
        if(is_array($_data)){
            $data = $_data;
        }

        $this->CI->load->view($this->folder.'/head', $data);
        if($file){
            $this->CI->load->view($file, $data);
        }
        $this->CI->load->view($this->folder.'/footer', $data);
    }

}