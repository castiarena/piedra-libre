<? defined('BASEPATH') OR exit('No direct script access allowed');

class Form_validate extends CI_Form_validation{


    public function equals_str($str, $field)
    {
        return $this->CI->input->post($field) === $str;
    }
}