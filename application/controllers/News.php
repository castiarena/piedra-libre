<?php
include_once (dirname(__FILE__) . "/BaseController.php");
defined('BASEPATH') OR exit('No direct script access allowed');

class News extends BaseController{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('News_model');
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
        $this->_render($content, 'Noticias - '. str_replace('_' , ' ' , $method));
    }

    public function charlas()
    {
        $method = $this->router->fetch_method();
        $content = $this->load->view('news/index', [] ,true);
        $this->_render($content, 'Noticias - '. str_replace('_' , ' ' , $method));
    }

    public function convenios_de_colaboracion()
    {
        $method = $this->router->fetch_method();
        $content = $this->load->view('news/index', [] ,true);
        $this->_render($content, 'Noticias - '. str_replace('_' , ' ' , $method));
    }

    public function otros()
    {
        $method = $this->router->fetch_method();
        $content = $this->load->view('news/index', [] ,true);
        $this->_render($content, 'Noticias - '. str_replace('_' , ' ' , $method));
    }

    public function view($id){
        $new = $this->News_model->getById($id);
        $content = $this->load->view('news/single', [
            'new' => $new
        ] ,true);
        $this->_render($content, 'Noticias - '. $new->title);
    }
}