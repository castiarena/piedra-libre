<?

class Tags_model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('date');
    }

    public function insert($info){
        $data =  [
            'created' => date('Y-m-d H:i:s', now()),
            'name' => $info['name']
        ];
        $this->db->insert('tag', $data);
    }

    public function getOne($id){
        $this->db->where('id', $id);
        $query = $this->db->get('tag');
        return $query->result_array()[0];
    }
    public function getAll(){
        $query = $this->db->get('tag');
        return $query->result();
    }

    public function countAll(){
        $query = $this->db->get('tag');
        return count($query->result());
    }

    public function getAllWithUsage(){
        $queryAll = $this->db->get('tag');
        $all = $queryAll->result_array();
        foreach($all as $i => $one){
            $query = $this->db->query('select count(news.id) as total from tag left JOIN news on tag.id = news.id where tag.id =' .$one['id']);
            $all[$i]['usage'] = $query->result_array()[0]['total'] ;
        }

        return  $all;
    }

    public function remove($id){
        $this->db->where('id', $id);
        $this->db->delete('tag');
    }

    public function update($data){
        $this->db->where('id', $data['id']);
        $this->db->update('tag' ,$data);
    }
}