<?php
/*defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH . '/controllers/End_Point_Connect.php';
require_once APPPATH . '/libraries/REST_Controller.php';
require APPPATH . '/libraries/Format.php';*/
//use namespace Restserver\Libraries;
use Restserver\Libraries\REST_Controller;
//use CI_Controller;
//use Exception;
//use stdClass;
require APPPATH . 'libraries/REST_Controller.php';
require_once APPPATH . '/controllers/End_Point_Connect.php';
require APPPATH . 'libraries/Format.php';
class Api extends REST_Controller {

function __construct(){
    parent::__construct();
    $this->load->model('Api_model');
}

function test_get(){
		$ip = $this->input->ip_address();
	  $this->response(array('status' => 'unsuccessful','ip' => $ip));
}



// get all network operators
function networkoperators_get(){

  $epc = new End_Point_Connect();     
  $response =  $epc->get_network_operators(); 
  if (sizeof($response) > 0){
       $this->response(array('status' => TRUE,'response' => 0 ,'message' => 'Successful','result' => $response));
  }else{
           $this->response(array('status' => FALSE, 'response' => 1001,'message' => 'No Record found'));
  }
 }

//get all network services
function networkservices_get(){

  $epc = new End_Point_Connect(); ;
    
  $response = $epc->get_network_services(); 
  if (sizeof($response) > 0){
       $this->response(array('status' => TRUE,'response' => 0 ,'message' => 'Successful','result' => $response));
  }else{
           $this->response(array('status' => FALSE, 'response' => 1001,'message' => 'No Record found'), REST_Controller::HTTP_BAD_REQUEST);
  }
 }



public function forgotpassword_post(){
  $phonenumber = trim($this->input->post('phonenumber'));
  $pin = trim($this->input->post('pin'));
  $txn_id = trim($this->input->post('transaction_id'));
  $epc = new End_Point_Connect();
  $enc_pin = $epc->encrypt($pin);
       
  if ($phonenumber != '' && $pin != '' && $txn_id != '')  {

      $rl_response = $this->Api_model->request_logging('forgot-password', $txn_id, $phonenumber , $enc_pin,'incoming','','');
  
      if($rl_response > 0){ 

           
              $response =  $epc->forgot_password($phonenumber, $pin);
             //  $this->response(array('status' =>  $response ));
              $value = explode("|", $response);
             
              if($value[0]){
                $this->Api_model->response_logging('forgot-password', $rl_response, $response , "completed",'Successful');
                $this->response(array('status' => true,'responsecode' => $value[1],'message' => $value[2]));
              } else{
                $this->Api_model->response_logging('forgot-password', $rl_response, $response , "completed",'Unsuccessful');
                $this->response(array('status' =>false,'responsecode' => $value[1],'message' => $value[2]));
              }

      }else{
        $this->Api_model->request_logging('forgot-password',  $epc->random_id(10).'I'.$txn_id , $phonenumber ,$enc_pin,  "completed",$rl_response ,'Unsuccessful');
        $this->response(array('status' => false , 'responsecode' => '1001','message' =>$rl_response), REST_Controller::HTTP_BAD_REQUEST);
      }
  } else {
      $this->Api_model->request_logging('forgot-password',  $epc->random_id(10).'I'.$txn_id,$phonenumber,$enc_pin, "completed", 'Invalid Request Parameters','Unsuccessful');
      $this->response(array('status' => false, 'responsecode' => '1002','message' =>'Invalid Request Parameters'), REST_Controller::HTTP_BAD_REQUEST);
  }
}




 

}
