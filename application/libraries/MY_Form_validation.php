<?php 

class MY_Form_validation extends CI_Form_validation{

 //public function MY_Form_validation($config) {
  public function __construct($config) {

    parent::__construct($config);
  }

  public function get_errors_as_array(){
   return $this->_error_array;
  }
  public function get_config_rules(){
   return $this->_config_rules;
  }
  
  public function get_field_names($form){
    $field_names = array();
    $rules = $this->get_config_rules();
	$rules = $rules[$form];
	
	foreach($rules as $index => $info){
	   $field_names[] = $info['field'];
	}
   return $field_names;
  }
}


?>