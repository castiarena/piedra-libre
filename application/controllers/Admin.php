<? defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('Users_model');
        $this->load->model('News_model');
        $this->load->model('Tags_model');
        $this->load->library('form_validate');
        $this->load->library('parser');
    }

    private function _render($content, $title = 'Admin'){
        if($this->session->userdata('logged')){
            $user = [
                'name' => $this->session->userdata('username'),
                'email' => $this->session->userdata('useremail'),
                'notifications' => [1,2]
            ];
        }else{
            $user = null;
        }

        $data = [
            'title' => 'Piedra libre - '. $title ,
            'content' => $content,
            'user' => $user,
            'navigation' => $this->getNavigation()
        ];
        $this->parser->parse('admin/layout' , $data);
    }

    private function getNavigation(){
        $section = $this->session->userdata('section');

        return [
            ['name' => 'Inicio', 'url' => site_url('admin') , 'active' => $section == 'admin/home' ? 'active' : '' ],
            ['name' => 'Noticias' , 'url' => site_url('admin/news'), 'active' => $section == 'admin/news' ? 'active' : '' ],
            ['name' => 'Eventos' , 'url' => site_url('admin/events'), 'active' => $section == 'admin/events' ? 'active' : '' ],
            ['name' => 'Tags' , 'url' => site_url('admin/tags'), 'active' => $section == 'admin/tags' ? 'active' : '' ]
        ];
    }

    public function index(){
        $this->session->set_userdata([ 'section' => 'admin/home']);

        $this->form_validate->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validate->set_rules('password', 'Password', 'required|min_length[5]|max_length[15]');

        $email = $this->input->post('email');
        $pass = $this->input->post('password');
        $errors = [];


        if($this->form_validate->run()) {
            if($this->access($email,$pass)){
                $logged = true;
            }else{
                $errors = ['user' => 'Usuario o password invalidos'];
                $logged = false;
            }
        }else{
            $logged = false;
            $errors = $this->form_validate->error_array();
        }

        if($logged || $this->session->userdata('logged')){
            redirect('admin/logged');
        }


        // render the view
        $content = $this->load->view('admin/index', ['errors' => $errors, 'email' => $email], true);
        $this->_render($content , 'Acceder');
    }

    public function logged(){
        $logged = $this->session->userdata('logged');

        if(!$logged){
            redirect('admin');
        }

        $this->session->userdata('logged');


        $content = $this->load->view('admin/logged', [], true);
        $this->_render($content, 'Bienvenido!');

    }

    public function create(){

        $this->form_validate->set_rules('name', 'Nombre', 'required|min_length[5]');
        $this->form_validate->set_rules('password', 'Password', 'required|min_length[5]|max_length[15]');
        $this->form_validate->set_rules('repeat_password', 'Repetir Password', 'required|min_length[5]|max_length[15]|equals_str[password]');
        $this->form_validate->set_message('equals_str', 'Debe ingresar dos claves iguales');

        $this->form_validate->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');

        if($this->form_validate->run()){
            $name           = $this->input->post('name');
            $pass           = $this->input->post('password');
            $nickName       = $this->input->post('email');
            $email          = $this->input->post('email');


            $this->Users_model->create([
                'name' => $name,
                'password' => $pass,
                'nickname' => $nickName,
                'email' => $email
            ]);

            redirect('admin');

        }else{
            $errors = validation_errors();
        }
        $content = $this->load->view('admin/create', ['errors' => $errors] , true);
        $this->_render($content ,'Crear usuario');

    }

    private function access( $email, $pass){

        $user = $this->Users_model->getUser($email, $pass);
        if(count($user) === 0){
            $userData = array(
                'username'  => null,
                'useremail'     => null,
                'logged' => FALSE
            );
        }else{
            $userData = array(
                'username'  => $user[0]->name,
                'useremail'     => $user[0]->email,
                'logged' => true
            );
        }
        $this->session->set_userdata($userData);

        return $userData['logged'];

    }

    public function logout(){
        $userData = array(
            'username'  => null,
            'email'     => null,
            'logged' => FALSE
        );
        $this->session->set_userdata($userData);
        redirect('admin');
    }

    private function upLoadImage($image){
        $errorImage = null;
        $imageStatus = null;
        $config['upload_path']          = './uploads/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 100;
        $config['max_width']            = 1024;
        $config['max_height']           = 768;

        $this->load->library('upload', $config);
        if ( !$this->upload->do_upload($image)){
            $errorImage  = array('error' => $this->upload->display_errors());
        } else {
            $imageStatus = array('upload_data' => $this->upload->data());
        }
        return [
            'error' => $errorImage,
            'status' => $imageStatus
        ];
    }

    public function news($stat = '' , $id = ''){
        $errors =['image'=> null, 'form' => null];



        if($this->input->post('title') &&
            $this->input->post('description') &&
            $this->input->post('date') &&
            $this->input->post('image') &&
            $this->input->post('tag')
        ){
            $urlImage = '';
            $imageLoader = $this->upLoadImage('image');
            if($imageLoader['error'] != null){
                $errors['image'] = $imageLoader['error'];
            }else{
                $urlImage = $imageLoader['status']['full_path'];
                $this->News_model->insert([
                    'title' => $this->input->post('title'),
                    'date' => $this->input->post('date'),
                    'description' => $this->input->post('description'),
                    'tag' => $this->input->post('tag'),
                    'image' => $urlImage
                ]);
            }



        }else{
            $errors['form'] = validation_errors();
        }
        switch($stat){
            case 'edit':
                $this->session->set_userdata([ 'section' => 'admin/news']);
                $content = $this->parser->parse('admin/news_create',[
                    'new_edit' => $this->News_model->getById($id),
                    'errors' => $errors
                ],true);
                $this->_render($content,'Cargar Noticia');
                break;
            case 'create':

                $this->session->set_userdata([ 'section' => 'admin/news']);
                $content = $this->parser->parse('admin/news_create',[
                    'tags' => $this->Tags_model->getAll(),
                    'errors' => $errors
                ],true);
                $this->_render($content,'Cargar Noticia');
                break;
            default:
                $this->session->set_userdata([ 'section' => 'admin/news']);
                $content = $this->parser->parse('admin/news',[
                    'news' => $this->News_model->latest()
                ],true);
                $this->_render($content,'Noticias');
                break;
        }

    }

    public function events($stat = ''){

        switch($stat){
            case 'create':
                $this->session->set_userdata([ 'section' => 'admin/events']);
                $content = $this->load->view('admin/events_create',[],true);
                $this->_render($content,'Crear Evento');
                break;
            default:
                $this->session->set_userdata([ 'section' => 'admin/events']);
                $content = $this->load->view('admin/events',[],true);
                $this->_render($content,'Eventos');
                break;
        }
    }

    public function tags($stat = '', $id = null){
        $tag = null;
        $editing = false;
        $action_url = site_url('admin/tags');
        $this->form_validate->set_rules('name', 'Nombre', 'required|min_length[3]|is_unique[tag.name]');

        if($stat == 'remove'){
            $this->Tags_model->remove($id);
            redirect('admin/tags');
        }

        if($this->form_validate->run()){
            $tag = [
                'name' => $this->input->post('name')
            ];
            if($stat == 'edit' && $id != null){
                $tag['id'] = $id;
                $this->Tags_model->update($tag);
                redirect('admin/tags');
            }else{
                $this->Tags_model->insert( $tag );
                redirect('admin/tags');
            }
        }else{
            if($stat == 'edit' && $id != null){
                $action_url = site_url('admin/tags/edit/').$id;
                $editing = true;
                $tag = $this->Tags_model->getOne($id);
            }
        }

        $tags = $this->Tags_model->getAllWithUsage();

        $content =  $this->parser->parse('admin/tags',[
            'tags' => $tags,
            'tag_name' => $tag['name'],
            'tag_id' => $tag['id'] ? $tag['id'] : '',
            'action_url' => $action_url,
            'editing' => $editing
        ],true);

        $this->session->set_userdata([ 'section' => 'admin/tags']);
        $this->_render($content,'Tags');

    }

}
?>