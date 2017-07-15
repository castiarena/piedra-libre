<?
include_once (dirname(__FILE__) . "/BaseController.php");

class Home extends BaseController{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('News_model');
        $this->load->helper('directory');

    }

    public function index(){
        $allNews = $this->News_model->latest();
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
                    echo "FATAL ERROR";
                    die();
                    break;
            }
        }
        $content = $this->load->view('home', [
            'news' => [ $news_list1, $news_list2, $news_list3 ],
            'guideList' => $this->guideList()
        ] ,true);
        $this->_render($content, 'Home');
    }

    private function guideList(){
        $path = 'assets/downloads/guia';
        $files = directory_map(str_replace("/application/controllers/","/",__DIR__."/$path"));
        $i = 0;
        foreach($files as $file):
            $files[$i] = [
                "href" => site_url("$path/$file"),
                "safeName" => $file,
                "name" => $file,
                "size" => $this->fileSize(
                    str_replace("/application/controllers/","/",__DIR__."/$path/$file")
                )
            ];
        $i++;
        endforeach;
        return $files;
    }

    private function fileSize($path){
        $size = filesize($path);
        $units = array( 'B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        $power = $size > 0 ? floor(log($size, 1024)) : 0;
        return number_format($size / pow(1024, $power), 2, '.', ',') . ' ' . $units[$power];
    }
}