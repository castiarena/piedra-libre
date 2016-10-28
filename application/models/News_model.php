<?

class News_model extends CI_Model{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('date');
    }

    public function latest($cant = 10){
        $query = $this->db->get('news', $cant);
        return $query ? $query->result() : [];
    }

    public function getById($id){
        $this->db->where('id', $id);
        $query = $this->db->get('news');

        return $query ? $query->row() : [];
    }

    public function getOne($id){
        $this->db->where('id', $id);
        $query = $this->db->get('news');

        return $query ? $query->result() : [];
    }

    private function prepare($info){
        return [
            'title' => $info['title'],
            'description' => $info['description'],
            'date' => $info['date'],
            'created' => date('Y-m-d H:i:s',now()),
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

    public function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('news');
    }

    public function countAll(){
        $query = $this->db->get('news');
        return count($query->result());
    }
}
?>