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
        $this->load->library('email');
        $config['mailtype'] = 'html';

        $this->email->initialize($config);

    }
    public function index(){
        $data = ["status" => "no enviado"];
        if($this->input->post('name')){
            $data = $this->send();
        }
        $content = $this->load->view('contacto', $data ,true);
        $this->_render($content, 'Contacto');
    }

    private function send(){

        $this->email->from('webmaster@fundacionpiedralibre.org', $this->input->post('name') . ' '. $this->input->post('lastname'));
        $this->email->to('castiarena@gmail.com');

        $this->email->subject('Contacto desde fundacionpiedralibre.org - ' . $this->input->post('subject'));

        $message = "<strong>Escribio: </strong><br>". $this->input->post('name') . ' '. $this->input->post('lastname');
        $message.= "<br><br>";
        $message.= "<strong>Email: </strong><br> <a href='mailto:".$this->input->post('email')."'>".$this->input->post('email')."</a>";
        $message.= "<br><br>";
        $message.= "<strong>Asunto: </strong><br>". $this->input->post('subject');
        $message.= "<br><br>";
        $message.= "<strong>Comentarios: </strong><br>". $this->input->post('comments');
        $this->email->message($message);

        $this->email->send();
        return ["status" => "enviado"];
    }
}