<?php
include_once (dirname(__FILE__) . "/BaseController.php");
/**
 * Created by IntelliJ IDEA.
 * User: acastiarena
 * Date: 31/3/17
 * Time: 10:51
 */
class My404 extends BaseController {
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->output->set_status_header('404');
        $content = $this->load->view('errors/html/error_404', [] ,true);
        $this->_render($content, 'Not Found');
    }
}