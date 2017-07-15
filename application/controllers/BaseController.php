<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, OPTIONS, POST, PUT, PATCH, DELETE");
/**
 * Created by PhpStorm.
 * User: acastiarena
 * Date: 9/10/16
 * Time: 2:23
 */

abstract class BaseController extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('Users_model');
    }

    public function _render($content, $title){
        $data = [
            'title' => 'Piedra libre - '. $title ,
            'content' => $content,
            'navigation' => $this->getNavigation()
        ];
        $this->load->view('layout' ,$data);
    }

    protected function json($data, $status = 200){
        $response = [
            'status' => $status,
            'data' => $data
        ];
        return $this->output
            ->set_content_type('application/json')
            ->set_status_header($status)
            ->set_output(json_encode($response));
    }

    public function getNavigation(){
        $section = $this->session->userdata('section');

        return [
            ['name' => 'Inicio' , 'url' => site_url(''), 'active' => '' ],
            ['name' => 'Quienes Somos', 'url' => site_url('quienes-somos') , 'active' => $section == 'home' ? 'active' : '' ,
                'subnav' => [
                    ['name' => 'Fundadores', 'url' => site_url('quienes-somos/fundadores')],
                    ['name' => 'Objeto de la fundación', 'url' => site_url('quienes-somos/objeto-de-la-fundacion')],
                    ['name' => 'Administracion', 'url' => site_url('quienes-somos/administracion')]
                ]
            ],
            ['name' => 'Noticias' , 'url' => site_url('news'), 'active' => $section == 'news' ? 'active' : '' ,
                'subnav' => [
                    ['name' => 'Cine de Montaña', 'url' => site_url('news/cine-de-montania')],
                    ['name' => 'Charlas', 'url' => site_url('news/charlas')],
                    ['name' => 'Convenios de Colaboración', 'url' => site_url('news/convenios-de-colaboracion')],
                    ['name' => 'Otros', 'url' => site_url('news/otros')]
                ]
            ],
            ['name' => 'Proyectos' , 'url' => site_url('proyectos'), 'active' => $section == 'events' ? 'active' : '' ,
                'subnav' => [
                    ['name' => 'Lo que hicimos', 'url' => site_url('proyectos/before')],
                    ['name' => 'Lo que vamos a hacer', 'url' => site_url('proyectos/after')]
                ]
            ],
            ['name' => 'Adherite' , 'url' => site_url('adherite'), 'active' => $section == 'events' ? 'active' : '' ],
            ['name' => 'Contacto' , 'url' => site_url('contacto'), 'active' => $section == 'events' ? 'active' : '' ]
        ];
    }
}