<?

class Users_model extends CI_Model{

    public function __construct(){
        parent::__construct();
    }

    public function create($data){
        $this->db->insert('users', $data);
    }

    public function getUser($email, $pass){
        $loginArray = array('email' => $email, 'password' => $pass);
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where($loginArray);
        $query = $this->db->get();
        return $query->result();
    }

    public function getAll(){
        $query = $this->db->get('users');
        return $query->result();
    }

    public function countAll($type = null){
        if($type != null){
            $this->db->where('type', $type);
        }
        $query = $this->db->get('users');
        return count($query->result());
    }
}
?>