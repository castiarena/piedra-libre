<?

class Users_model extends CI_Model{

    public function __construct()
    {
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
}
?>