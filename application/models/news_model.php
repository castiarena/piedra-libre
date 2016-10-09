<?

class News_model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
    }

    public function latest($cant = 10){
        $query = $this->db->get('news', $cant);
        echo "<script>alert('". ($query ? 'hay' : 'no hay')."')</script>";
        return $query ? $query->result() : [];
    }

    public function getById($id){
        $this->db->where('id', $id);
        $query = $this->db->get('news');
        return   json_decode(json_encode($query->result_array()), FALSE);
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