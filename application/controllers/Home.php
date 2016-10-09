<?
include_once (dirname(__FILE__) . "/BaseController.php");

class Home extends BaseController{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('news_model');
    }

    public function index(){
        $allNews = $this->news_model->latest();
        $news_list1 = [];
        $news_list2 = [];
        $news_list3 = [];
        $i = 0;
        foreach($allNews as $new){ $i++;
            switch($i%3){
                case 1:
                    $news_list1[] = $new;
                    break;
                case 2:
                    $news_list2[] = $new;
                    break;
                case 0:
                    $news_list3[] = $new;
                    break;
                default:
                    echo "caca";
                    die();
                    break;
            }
        }
        $content = $this->load->view('home', [
            'news' => [ $news_list1, $news_list2, $news_list3 ]
        ] ,true);
        $this->_render($content, 'Home');
    }
}