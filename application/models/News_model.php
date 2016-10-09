<?

class News_model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
    }

    public function latest($cant = 10){
        $query = $this->db->get('news', $cant);
        return $query->result();
    }

    public function getById($id){
        $this->db->where('id', $id);
        $query = $this->db->get('news');
        return $query->result();
    }

    private function prepare($info){
        return [
            'title' => $info['title'],
            'description' => $info['description'],
            'date' => $info['date'],
            'images' => $info['image'],
            'tags' => $info['tag']
        ];
    }

    public function insert($info){
        $this->db->insert('news', $this->prepare($info));
    }

    public function update($info){
        $this->db->update('news', $this->prepare($info), ['id' => $info['id']]);
    }
}
?>