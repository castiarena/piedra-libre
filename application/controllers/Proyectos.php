<?php

include_once (dirname(__FILE__) . "/BaseController.php");
/**
 * Created by PhpStorm.
 * User: acastiarena
 * Date: 9/10/16
 * Time: 2:19
 */
class Proyectos extends BaseController{
    public function __construct()
    {
        parent::__construct();
    }
    public function index(){
        $content = $this->load->view('proyectos/index', [] ,true);
        $this->_render($content, 'Proyectos');
    }

    public function before(){
        $content = $this->load->view('proyectos/lo-que-hicimos', [] ,true);
        $this->_render($content, 'Proyectos - Lo que hicimos');
    }

    public function after(){
        $content = $this->load->view('proyectos/lo-que-vamos-a-hacer', [] ,true);
        $this->_render($content, 'Proyectos - Lo que vamos a hacer');
    }
}