<?php

include_once (dirname(__FILE__) . "/BaseController.php");
/**
 * Created by PhpStorm.
 * User: acastiarena
 * Date: 9/10/16
 * Time: 2:19
 */
class Quienes_somos extends BaseController{
    public function __construct()
    {
        parent::__construct();
    }
    public function index(){
        $content = $this->load->view('quienes-somos/index', [] ,true);
        $this->_render($content, 'Quienes somos');
    }

    public function fundadores(){
        $content = $this->load->view('quienes-somos/fundadores', [] ,true);
        $this->_render($content, 'Quienes somos - Fundadores');
    }

    public function objeto_de_la_fundacion(){
        $content = $this->load->view('quienes-somos/objeto-de-la-fundacion', [] ,true);
        $this->_render($content, 'Quienes somos - Objeto de la fundación');
    }

    public function administracion(){
        $content = $this->load->view('quienes-somos/administracion', [] ,true);
        $this->_render($content, 'Quienes somos - Consejo de administracion actual');
    }

}