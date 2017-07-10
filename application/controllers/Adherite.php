<?php

include_once (dirname(__FILE__) . "/BaseController.php");
/**
 * Created by PhpStorm.
 * User: acastiarena
 * Date: 9/10/16
 * Time: 2:19
 */
class Adherite extends BaseController{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('Users_model');
        $this->load->library('parser');

    }
    public function index(){
        $user_type = 'friend';

        $this->form_validation->set_error_delimiters('
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>',
            '</div>');


        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_message('is_unique', 'El email: <strong>'.$this->input->post('email').'</strong> ya esta registrado, por favor intenta con otro');
        $this->form_validation->set_rules('name', 'Nombre', 'required');
        $this->form_validation->set_rules('last_name', 'Apellido', 'required');
        $this->form_validation->set_rules('document', 'Documento', 'required');
        $this->form_validation->set_rules('document_type', 'tipoDocumento', 'required');
        $this->form_validation->set_rules('country', 'Pais', 'required');
        $this->form_validation->set_rules('birth', 'Fecha', 'required');

        $success = '';

        if($this->form_validation->run()){
            $success = "<div class='alert alert-success'>
                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">&times;</span>
                    </button>
                Gracias ".
                    $this->input->post('name').
                    "! ya formas parte de los amigos de la fundación, estamos en contacto
                </div>";
            $birth_date = date("Y-m-d H:i:s",strtotime( $this->input->post('birth')));
            $this->Users_model->create([
                "type" => "friend",
                "email" => $this->input->post('email'),
                "nickname" => $this->input->post('name') .'_'.$this->input->post('last_name').'_'.$this->input->post('document'),
                "name" => $this->input->post('name'),
                "last_name" => $this->input->post('last_name'),
                "birth" => $birth_date,
                "document" => $this->input->post('document'),
                "document_type" => $this->input->post('document_type'),
                "country" => $this->input->post('country'),
                "residence" => $this->input->post('residence'),
                "password" => '-not-created',
            ]);
        }

        $content = $this->load->view('adherite', [
            'countries' => $this->countries(),
            'errors' => validation_errors(),
            'success' => $success
        ] ,true);
        $this->_render($content, 'Adherite');
    }


    private function countries(){
        return array(
            "AF"=>"Afghanistan",
            "AL"=>"Albania",
            "DZ"=>"Algeria",
            "AD"=>"Andorra",
            "AO"=>"Angola",
            "AI"=>"Anguilla",
            "AQ"=>"Antarctica",
            "AG"=>"Antigua and Barbuda",
            "AR"=>"Argentina",
            "AM"=>"Armenia",
            "AW"=>"Aruba",
            "AU"=>"Australia",
            "AT"=>"Austria",
            "AZ"=>"Azerbaijan",
            "BS"=>"Bahamas",
            "BH"=>"Bahrain",
            "BD"=>"Bangladesh",
            "BB"=>"Barbados",
            "BY"=>"Belarus",
            "BE"=>"Belgium",
            "BZ"=>"Belize",
            "BJ"=>"Benin",
            "BM"=>"Bermuda",
            "BT"=>"Bhutan",
            "BO"=>"Bolivia",
            "BA"=>"Bosnia and Herzegovina",
            "BW"=>"Botswana",
            "BR"=>"Brazil",
            "IO"=>"British Indian Ocean",
            "BN"=>"Brunei",
            "BG"=>"Bulgaria",
            "BF"=>"Burkina Faso",
            "BI"=>"Burundi",
            "KH"=>"Cambodia",
            "CM"=>"Cameroon",
            "CA"=>"Canada",
            "CV"=>"Cape Verde",
            "KY"=>"Cayman Islands",
            "CF"=>"Central African Republic",
            "TD"=>"Chad",
            "CL"=>"Chile",
            "CN"=>"China",
            "CX"=>"Christmas Island",
            "CC"=>"Cocos (Keeling) Islands",
            "CO"=>"Colombia",
            "KM"=>"Comoros",
            "CD"=>"Congo, Democratic Republic of the",
            "CG"=>"Congo, Republic of the",
            "CK"=>"Cook Islands",
            "CR"=>"Costa Rica",
            "HR"=>"Croatia",
            "CY"=>"Cyprus",
            "CZ"=>"Czech Republic",
            "DK"=>"Denmark",
            "DJ"=>"Djibouti",
            "DM"=>"Dominica",
            "DO"=>"Dominican Republic",
            "TL"=>"East Timor",
            "EC"=>"Ecuador",
            "EG"=>"Egypt",
            "SV"=>"El Salvador",
            "GQ"=>"Equatorial Guinea",
            "ER"=>"Eritrea",
            "EE"=>"Estonia",
            "ET"=>"Ethiopia",
            "FK"=>"Falkland Islands (Malvinas)",
            "FO"=>"Faroe Islands",
            "FJ"=>"Fiji",
            "FI"=>"Finland",
            "FR"=>"France",
            "GF"=>"French Guiana",
            "PF"=>"French Polynesia",
            "GA"=>"Gabon",
            "GM"=>"Gambia",
            "GE"=>"Georgia",
            "DE"=>"Germany",
            "GH"=>"Ghana",
            "GI"=>"Gibraltar",
            "GR"=>"Greece",
            "GL"=>"Greenland",
            "GD"=>"Grenada",
            "GP"=>"Guadeloupe",
            "GT"=>"Guatemala",
            "GN"=>"Guinea",
            "GW"=>"Guinea-Bissau",
            "GY"=>"Guyana",
            "HT"=>"Haiti",
            "HN"=>"Honduras",
            "HK"=>"Hong Kong",
            "HU"=>"Hungary",
            "IS"=>"Iceland",
            "IN"=>"India",
            "ID"=>"Indonesia",
            "IE"=>"Ireland",
            "IL"=>"Israel",
            "IT"=>"Italy",
            "CI"=>"Ivory Coast (C&ocirc;te d\'Ivoire)",
            "JM"=>"Jamaica",
            "JP"=>"Japan",
            "JO"=>"Jordan",
            "KZ"=>"Kazakhstan",
            "KE"=>"Kenya",
            "KI"=>"Kiribati",
            "KR"=>"Korea, South",
            "KW"=>"Kuwait",
            "KG"=>"Kyrgyzstan",
            "LA"=>"Laos",
            "LV"=>"Latvia",
            "LB"=>"Lebanon",
            "LS"=>"Lesotho",
            "LI"=>"Liechtenstein",
            "LT"=>"Lithuania",
            "LU"=>"Luxembourg",
            "MO"=>"Macau",
            "MK"=>"Macedonia, Republic of",
            "MG"=>"Madagascar",
            "MW"=>"Malawi",
            "MY"=>"Malaysia",
            "MV"=>"Maldives",
            "ML"=>"Mali",
            "MT"=>"Malta",
            "MH"=>"Marshall Islands",
            "MQ"=>"Martinique",
            "MR"=>"Mauritania",
            "MU"=>"Mauritius",
            "YT"=>"Mayotte",
            "MX"=>"Mexico",
            "FM"=>"Micronesia",
            "MD"=>"Moldova",
            "MC"=>"Monaco",
            "MN"=>"Mongolia",
            "ME"=>"Montenegro",
            "MS"=>"Montserrat",
            "MA"=>"Morocco",
            "MZ"=>"Mozambique",
            "NA"=>"Namibia",
            "NR"=>"Nauru",
            "NP"=>"Nepal",
            "NL"=>"Netherlands",
            "AN"=>"Netherlands Antilles",
            "NC"=>"New Caledonia",
            "NZ"=>"New Zealand",
            "NI"=>"Nicaragua",
            "NE"=>"Niger",
            "NG"=>"Nigeria",
            "NU"=>"Niue",
            "NF"=>"Norfolk Island",
            "NO"=>"Norway",
            "OM"=>"Oman",
            "PK"=>"Pakistan",
            "PS"=>"Palestinian Territory",
            "PA"=>"Panama",
            "PG"=>"Papua New Guinea",
            "PY"=>"Paraguay",
            "PE"=>"Peru",
            "PH"=>"Philippines",
            "PN"=>"Pitcairn Island",
            "PL"=>"Poland",
            "PT"=>"Portugal",
            "QA"=>"Qatar",
            "RE"=>"R&eacute;union",
            "RO"=>"Romania",
            "RU"=>"Russia",
            "RW"=>"Rwanda",
            "SH"=>"Saint Helena",
            "KN"=>"Saint Kitts and Nevis",
            "LC"=>"Saint Lucia",
            "PM"=>"Saint Pierre and Miquelon",
            "VC"=>"Saint Vincent and the Grenadines",
            "WS"=>"Samoa",
            "SM"=>"San Marino",
            "ST"=>"S&atilde;o Tome and Principe",
            "SA"=>"Saudi Arabia",
            "SN"=>"Senegal",
            "RS"=>"Serbia",
            "CS"=>"Serbia and Montenegro",
            "SC"=>"Seychelles",
            "SL"=>"Sierra Leon",
            "SG"=>"Singapore",
            "SK"=>"Slovakia",
            "SI"=>"Slovenia",
            "SB"=>"Solomon Islands",
            "SO"=>"Somalia",
            "ZA"=>"South Africa",
            "GS"=>"South Georgia and the South Sandwich Islands",
            "ES"=>"Spain",
            "LK"=>"Sri Lanka",
            "SR"=>"Suriname",
            "SJ"=>"Svalbard and Jan Mayen",
            "SZ"=>"Swaziland",
            "SE"=>"Sweden",
            "CH"=>"Switzerland",
            "TW"=>"Taiwan",
            "TJ"=>"Tajikistan",
            "TZ"=>"Tanzania",
            "TH"=>"Thailand",
            "TG"=>"Togo",
            "TK"=>"Tokelau",
            "TO"=>"Tonga",
            "TT"=>"Trinidad and Tobago",
            "TN"=>"Tunisia",
            "TR"=>"Turkey",
            "TM"=>"Turkmenistan",
            "TC"=>"Turks and Caicos Islands",
            "TV"=>"Tuvalu",
            "UG"=>"Uganda",
            "UA"=>"Ukraine",
            "AE"=>"United Arab Emirates",
            "GB"=>"United Kingdom",
            "US"=>"United States",
            "UM"=>"United States Minor Outlying Islands",
            "UY"=>"Uruguay",
            "UZ"=>"Uzbekistan",
            "VU"=>"Vanuatu",
            "VA"=>"Vatican City",
            "VE"=>"Venezuela",
            "VN"=>"Vietnam",
            "VG"=>"Virgin Islands, British",
            "WF"=>"Wallis and Futuna",
            "EH"=>"Western Sahara",
            "YE"=>"Yemen",
            "ZM"=>"Zambia",
            "ZW"=>"Zimbabwe");
    }
}