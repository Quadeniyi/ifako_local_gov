<?php

defined('BASEPATH') OR exit('No direct script access allowed');

// This can be removed if you use __autoload() in config.php OR use Modular Extensions
//require APPPATH . '/libraries/REST_Controller.php';

class Api_model extends CI_Model {

    function __construct() {
        parent::__construct();
       //1. from withdrawal you can get pen, name
       //2. from fundtype you can get subcriber fundtype "CPS or MPS"
    }

	
	  
	function insert_open_account($firstname , $lastname, $bvn,$email, $account_type  ,$mobilenumber){
	   $dt = date('Y-m-d H:i:s');
	   $data = array();
       $data['fname'] = ucfirst($firstname);
       $data['lname'] = ucfirst($lastname);
       $data['bvn'] = $bvn;
       $data['email'] = $email;
       $data['account_type'] = $account_type;
       $data['mobile'] = $mobilenumber;
       $data['registered_at'] = $dt;
       return $this->_insert('pfa_accounts',$data);
    }
	private function store_list() {
	    return $this->_custom_query("select * from oc_store")->result();
	}
	
    function request_logging($operation, $reference, $client_id, $txn_id , $request_param, $status,$complex_msg,$actual_msg){
       
         if ($operation  == 'airtime-vending'){
          return $this->insert_log('airtime_vending_logs', $reference, $client_id, $txn_id , $request_param, $status,$complex_msg,$actual_msg);
         }elseif($operation == 'electricity-validation'){
          return $this->insert_log('electricity_verify_logs', $reference, $client_id, $txn_id , $request_param, $status,$complex_msg,$actual_msg);
         }elseif($operation == 'electricity-vending'){
            return $this->insert_log('electricity_vending_logs',$reference, $client_id, $txn_id ,$request_param, $status,$complex_msg,$actual_msg);
        }elseif($operation == 'bank-transfer'){
            return $this->insert_log('bank_transfer_logs',$reference, $client_id , $txn_id , $request_param, $status,$complex_msg,$actual_msg);
        }/*elseif($operation == 'generate-statement'){
            return $this->insert_log('generate_statement_logs',$txn_id , $phonenumber, $request_param, $status,$complex_msg,$actual_msg);
        }elseif($operation == 'generate-cert'){
            return $this->insert_log('generate_cert_logs',$txn_id , $phonenumber, $request_param, $status,$complex_msg,$actual_msg);
        }elseif($operation == 'last-6-transactions'){
            return $this->insert_log('last_6_transaction_logs',$txn_id , $phonenumber, $request_param, $status,$complex_msg,$actual_msg);
        }elseif($operation == 'verify-user'){
            return $this->insert_log('verify_user_logs',$txn_id , $phonenumber, $request_param, $status,$complex_msg,$actual_msg);
        }elseif($operation == 'registration'){
            return $this->insert_log('registration_logs',$txn_id , $phonenumber, $request_param, $status,$complex_msg,$actual_msg);
        }elseif($operation == 'fund-type'){
            return $this->insert_log('fund_type_logs',$txn_id , $phonenumber, $request_param, $status,$complex_msg,$actual_msg);
        }elseif($operation == 'withdrawal'){
            return $this->insert_log('withdrawal_logs',$txn_id , $phonenumber, $request_param, $status,$complex_msg,$actual_msg);
        }*/

    }

    function response_logging($operation, $rl_response, $response_msg ,$status,$actual_msg){
       
        if ($operation  == 'airtime-vending'){
           return $this->update_log('airtime_vending_logs',$rl_response, $response_msg ,$status,$actual_msg);
        }elseif($operation == 'electricity-validation'){
            return $this->update_log('electricity_verify_logs',$rl_response, $response_msg ,$status,$actual_msg);
        }elseif($operation == 'electricity-vending'){
            return $this->update_log('electricity_vending_logs',$rl_response, $response_msg ,$status,$actual_msg);
        }elseif($operation == 'bank-transfer'){
            return $this->update_log('bank_transfer_logs',$rl_response, $response_msg ,$status,$actual_msg);
        }/*elseif($operation == 'generate-statement'){
            return $this->update_log('generate_statement_logs',$rl_response, $response_msg ,$status,$actual_msg);
        }elseif($operation == 'generate-cert'){
            return $this->update_log('generate_cert_logs',$rl_response, $response_msg ,$status,$actual_msg);
        }elseif($operation == 'last-6-transactions'){
            return $this->update_log('last_6_transaction_logs',$rl_response, $response_msg ,$status,$actual_msg);
        }elseif($operation == 'verify-user'){
            return $this->update_log('verify_user_logs',$rl_response, $response_msg ,$status,$actual_msg);
        }elseif($operation == 'registration'){
            return $this->update_log('registration_logs',$rl_response, $response_msg ,$status,$actual_msg);
        }elseif($operation == 'fund-type'){
            return $this->update_log('fund_type_logs',$rl_response, $response_msg ,$status,$actual_msg);
        }elseif($operation == 'withdrawal'){
            return $this->update_log('withdrawal_logs',$rl_response, $response_msg ,$status,$actual_msg);
        }*/

   }

    function insert_log($table_name,$reference,$client_id, $txn_id , $request_param, $status, $complex_msg ,$actual_msg){
        $data = array();
        $data['reference'] = $reference;
        $data['txn_id'] = $txn_id;
        $data['client_id'] = $client_id;
        $data['request_param'] = $request_param;
        $data['status'] = $status;
        $data['response_complex_message'] = $complex_msg;
        $data['response_actual_message'] = $actual_msg;
        $data['time_in'] = date('Y-m-d H:i:s');
        return $this->_insert($table_name,$data);
    }

    function update_log($table_name,$rl_response, $response_msg ,$status,$actual_msg){
        $data = array();
        $data['response_complex_message'] = $response_msg;
        $data['response_actual_message'] = $actual_msg;
        $data['status'] = $status;
        $data['time_out'] = date('Y-m-d H:i:s');
        return $this->_update($table_name , $rl_response ,$data);
    }
	
    

    function insert_user_details($phonenumber, $password){
        $data = array();
        $data['phonenumber'] = $phonenumber;
        $data['password'] = $password;
        return $this->_insert("user_details",$data);
    }

    function update_user_details($phonenumber, $password, $pin){
        $data = array();
        $data['phonenumber'] = $phonenumber;
        $data['password'] = $password;
        $data['pin'] = $pin;
        return $this->_update("user_details" , $rl_response ,$data);
    }
	
    



	 function _custom_query($mysql_query) {
		 $query = $this->db->query($mysql_query);
         return $query;
     }


     function _insert( $table ,$data) {
        $r= "";
        try {

        $this->db->insert( $table , $data);

        $db_error = $this->db->error();
      
        if (!empty($db_error) &&  $db_error['code'] != 0 ) {
            throw new Exception('Database error! Error Code [' . $db_error['code'] . '] Error: ' . $db_error['message']);
        }
      
        $r =   $this->db->insert_id();

      } catch (Exception $e) {
        // this will not catch DB related errors. But it will include them, because this is more general. 
      //  log_message('error: ',$e->getMessage());
      //  return;

      log_message( 'error', $e->getMessage( ) . ' in ' . $e->getFile() . ':' . $e->getLine() );
       $r = $e->getMessage();
      }
       return $r;
     }

     
    function _update( $table , $id, $data) {
        $this->db->where('ID', $id);
        $this->db->update($table, $data);
    }

	
     
	

}