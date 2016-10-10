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
        $this->load->model('Events_model');
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

        if(!$this->session->userdata('development')  && ENVIRONMENT === 'production'){
            if(WIP){
                redirect('');
            }
        }else{
            $data = [
                'title' => 'Piedra libre - '. $title ,
                'content' => $content,
                'user' => $user,
                'navigation' => $this->getNavigation()
            ];
            $this->parser->parse('admin/layout' , $data);
        }

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


        $content = $this->load->view('admin/logged', [
            'tagsCount' => $this->Tags_model->countAll(),
            'eventsCount' => $this->Events_model->countAll(),
            'newsCount' => $this->News_model->countAll()
        ], true);
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

    public function news($stat = '' , $id = ''){
        $errors = null;
        $new = null;

        $config = [
            'upload_path' => './uploads/',
            'allowed_types' => 'gif|jpg|png',
            'max_size' => 200,
            'max_width' => 1920,
            'max_height' => 1920
        ];
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        $this->form_validate->set_rules('title', 'Title', 'required|is_unique[news.title]');
        $this->form_validate->set_rules('description', 'Description', 'required|min_length[30]');
        $this->form_validate->set_rules('date', 'Date', 'required');
        $this->form_validate->set_rules('tag', 'Tag', 'required');



        if($this->form_validate->run()){
            $upImage = $this->uploadFile('image');

            if(!$upImage['status']){
                $errors['image'] = $upImage['errors'];
                $new['image'] = '';
            }else{
                $new['image'] = $upImage['status']['url'];
            }
            $new['title'] = $this->input->post('title');
            $new['date'] = $this->input->post('date');
            $new['description'] = $this->input->post('description');
            $new['tag'] = $this->input->post('tag');
        }else{
            if(validation_errors()){
                $errors['form'] = validation_errors();
            }
        }


//        echo "<script>console.log('".json_encode( $new)."')</script>";



        switch($stat){
            case 'edit':
                $this->session->set_userdata([ 'section' => 'admin/news']);
                $selected = $this->News_model->getById($id);
                $content = $this->parser->parse('admin/news_edit',[
                    'new_edit' => [[
                        'id' => $selected->id,
                        'title' => $selected->title,
                        'description' => $selected->description,
                        'tags' => $this->Tags_model->getOne($selected->tags),
                        'images' => site_url($selected->images),
                        'date' => $selected->date,
                    ]],
                    'errors' => $errors,
                    'tags' => $this->Tags_model->getAll(),
                ],true);
                $this->_render($content,'Cargar Noticia');
                break;
            case 'create':

                if(count($new) > 1){
                    $this->News_model->insert($new);
                    redirect('admin/news');
                }
                $this->session->set_userdata([ 'section' => 'admin/news']);
                $content = $this->parser->parse('admin/news_create',[
                    'tags' => $this->Tags_model->getAll(),
                    'errors' => $errors
                ],true);
                $this->_render($content,'Cargar Noticia');
                break;
            case 'remove':
                $this->News_model->delete($id);
                redirect('admin/news');
                break;
            case 'view':
                $this->session->set_userdata([ 'section' => 'admin/news']);
                $selected = $this->News_model->getById($id);
                $this->debug($this->Tags_model->getOne($selected->tags));
                $content = $this->parser->parse('admin/news_view',[
                    'new_view' => [[
                        'id' => $selected->id,
                        'title' => $selected->title,
                        'description' => $selected->description,
                        'tags' => $this->Tags_model->getOne($selected->tags)['name'],
                        'images' => site_url($selected->images),
                        'date' => $selected->date,
                    ]]
                ],true);
                $this->_render($content,'Noticias');
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

    public function events($stat = '' , $id = ''){
        $errors = null;
        $event = null;

        $config = [
            'upload_path' => './uploads/',
            'allowed_types' => 'gif|jpg|png',
            'max_size' => 200,
            'max_width' => 1920,
            'max_height' => 1920
        ];
        $this->load->library('upload', $config);
        $this->upload->initialize($config);

        $this->form_validate->set_rules('title', 'Title', 'required|is_unique[news.title]');
        $this->form_validate->set_rules('description', 'Description', 'required|min_length[30]');
        $this->form_validate->set_rules('date', 'Date', 'required');
        $this->form_validate->set_rules('tag', 'Tag', 'required');



        if($this->form_validate->run()){
            $upImage = $this->uploadFile('image');

            if(!$upImage['status']){
                $errors['image'] = $upImage['errors'];
                $event['image'] = '';
            }else{
                $event['image'] = $upImage['status']['url'];
            }
            $event['title'] = $this->input->post('title');
            $event['date'] = $this->input->post('date');
            $event['description'] = $this->input->post('description');
            $event['tag'] = $this->input->post('tag');
        }else{
            if(validation_errors()){
                $errors['form'] = validation_errors();
            }
        }


//        echo "<script>console.log('".json_encode( $new)."')</script>";



        switch($stat){
            case 'edit':
                $this->session->set_userdata([ 'section' => 'admin/events']);
                $selected = $this->Events_model->getById($id);
                $content = $this->parser->parse('admin/events_edit',[
                    'event_edit' => [[
                        'id' => $selected->id,
                        'title' => $selected->title,
                        'description' => $selected->description,
                        'tags' => $this->Tags_model->getOne($selected->tags),
                        'images' => site_url($selected->images),
                        'date' => $selected->date,
                    ]],
                    'errors' => $errors,
                    'tags' => $this->Tags_model->getAll(),
                ],true);
                $this->_render($content,'Cargar Evento');
                break;
            case 'create':

                if(count($event) > 1){
                    $this->Events_model->insert($event);
                    redirect('admin/events');
                }
                $this->session->set_userdata([ 'section' => 'admin/events']);
                $content = $this->parser->parse('admin/events_create',[
                    'tags' => $this->Tags_model->getAll(),
                    'errors' => $errors
                ],true);
                $this->_render($content,'Cargar Evento');
                break;
            case 'remove':
                $this->News_model->delete($id);
                redirect('admin/events');
                break;
            case 'view':
                $this->session->set_userdata([ 'section' => 'admin/events']);
                $selected = $this->Events_model->getById($id);
                $this->debug($this->Tags_model->getOne($selected->tags));
                $content = $this->parser->parse('admin/events_view',[
                    'event_view' => [[
                        'id' => $selected->id,
                        'title' => $selected->title,
                        'description' => $selected->description,
                        'tags' => $this->Tags_model->getOne($selected->tags)['name'],
                        'images' => site_url($selected->images),
                        'date' => $selected->date,
                    ]]
                ],true);
                $this->_render($content,'Eventos');
                break;
            default:
                $this->session->set_userdata([ 'section' => 'admin/events']);
                $content = $this->parser->parse('admin/events',[
                    'events' => $this->Events_model->latest()
                ],true);
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


    private function uploadFile($file){
        $target_path = "uploads/";

        $target_path = $target_path . basename( $_FILES[$file]['name']);

        // Undefined | Multiple Files | $_FILES Corruption Attack
        // If this request falls under any of them, treat it invalid.
        if (!isset($_FILES[$file]['error']) || is_array($_FILES[$file]['error']) ) {
            return ['status' => false , 'errors' => 'Archivo inválido' ];
        }
        switch ($_FILES[$file]['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                return ['status' => false , 'errors' => 'El archivo no se envió' ];
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                return ['status' => false , 'errors' => 'El archivo supera el limite de peso' ];
            default:
                return ['status' => false , 'errors' => 'Error inesperado' ];
        }

         //You should also check filesize here.
        if ($_FILES[$file]['size'] > 1000000) {
            return ['status' => false , 'errors' => 'El archivo supera el limite de peso' ];
        }

        if(move_uploaded_file($_FILES[$file]['tmp_name'], $target_path)) {
            return ['status' => ['url' => $target_path ] , 'errors' => null ];
        } else{
            return ['status' => false , 'errors' => 'Ocurrio un herror subiendo el archivo' ];
        }

    }

    private function debug($message){
        if(is_array($message) || is_object($message)){
            echo "<script>console.log('".json_encode($message)."')</script>";
        }else if(is_string($message)){
            echo "<script>console.log('".$message."')</script>" ;
        }
    }

}
?>