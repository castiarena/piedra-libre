<?php

include_once (dirname(__FILE__) . "/BaseController.php");
/**
 * Created by PhpStorm.
 * User: acastiarena
 * Date: 9/10/16
 * Time: 2:19
 */
class Contacto extends BaseController{
    public function __construct()
    {
        parent::__construct();
    }
    public function index(){
        $content = $this->load->view('contacto', [] ,true);
        $this->_render($content, 'Contacto');
    }
}