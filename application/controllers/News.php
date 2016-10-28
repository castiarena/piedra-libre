<?php
include_once (dirname(__FILE__) . "/BaseController.php");
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends BaseController{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $content = $this->load->view('news/index', [] ,true);
        $this->_render($content, 'Noticias');
    }

    public function cine_de_montania()
    {
        $method = $this->router->fetch_method();
        $content = $this->load->view('news/index', [] ,true);
        $this->_render($content, 'Noticias - '.$method);
    }

    public function charlas()
    {
        $method = $this->router->fetch_method();
        $content = $this->load->view('news/index', [] ,true);
        $this->_render($content, 'Noticias - '.$method);
    }

    public function convenios_de_colaboracion()
    {
        $method = $this->router->fetch_method();
        $content = $this->load->view('news/index', [] ,true);
        $this->_render($content, 'Noticias - '.$method);
    }

    public function otros()
    {
        $method = $this->router->fetch_method();
        $content = $this->load->view('news/index', [] ,true);
        $this->_render($content, 'Noticias - '.$method);
    }

    public function view($id){

    }
}