<?php

class Development extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validate');
        $this->load->library('parser');


    }

    public function index(){

        if($this->input->post('password') === 'fundpiedralibre:ntp07Ns1R9'){
            $this->session->set_userdata([
                'development' => true
            ]);
            redirect('');
        }else{
            $this->session->set_userdata([
                'development' => false
            ]);
            $this->load->view('development' ,  [
                'title' => 'Piedra libre - Development'
            ]);
        }


    }
}