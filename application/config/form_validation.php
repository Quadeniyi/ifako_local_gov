<?php
if (!defined('BASEPATH')) exit('No direct script access allowed.');
$config = array(
    'autoreg_valid'=>array(
                     array('field'=> 'number_plate', 'label' =>'number_plate','rules' => 'trim|required' ),
                     array('field'=> 'plan', 'label' =>'plan','rules' => 'trim|required'),
                      ),
    'create_superagent_valid'=>array(
                     array('field'=> 'firstname', 'label' =>'firstname', 'rules' => 'trim|required'),
					 array('field'=> 'lastname', 'label' =>'lastname','rules' => 'trim|required'),
                     array('field'=> 'mobile', 'label' =>'mobile','rules' => 'trim|required' ),
                     array('field'=> 'email', 'label' =>'email', 'rules' => 'trim|required'),
					  array('field'=> 'accountnumber', 'label' =>'accountnumber', 'rules' => 'trim|required'),
                    ),
	'international_cover_valid'=>array(
                     array('field'=> 'firstname', 'label' =>'Firstname', 'rules' => 'trim|required'),
                     array('field'=> 'middlename', 'label' =>'Middlename','rules' => 'trim|required' ),
                     array('field'=> 'lastname', 'label' =>'Lastname','rules' => 'trim|required'),
                     array('field'=> 'mobile', 'label' =>'Mobile', 'rules' => 'trim|required'),
					 array('field'=> 'email', 'label' =>'Email', 'rules' => 'trim|required'),
					 array('field'=> 'identification_means', 'Means of Identification' =>'gender', 'rules' => 'trim|required'),
					 array('field'=> 'destination', 'label' =>'Destination', 'rules' => 'trim|required'),
					 array('field'=> 'trip_duration', 'label' =>'Trip Duration', 'rules' => 'trim|required'),
					 array('field'=> 'destination_mobile', 'label' =>'Destination Mobile', 'rules' => 'trim|required'),
					 array('field'=> 'passport_number', 'label' =>'Passport', 'rules' => 'trim|required'),
					 array('field'=> 'resident_address', 'label' =>'Resident Address', 'rules' => 'trim|required'),
					 array('field'=> 'destination_address', 'label' =>'Destination Address', 'rules' => 'trim|required'),
					 array('field'=> 'cover_type', 'label' =>'Cover TYpe', 'rules' => 'trim|required'),
                    ),
  'home_cover_valid'=>array(
                      array('field'=> 'firstname', 'label' =>'Firstname', 'rules' => 'trim|required'),
                     array('field'=> 'middlename', 'label' =>'Middlename','rules' => 'trim|required' ),
                     array('field'=> 'lastname', 'label' =>'Lastname','rules' => 'trim|required'),
                     array('field'=> 'mobile', 'label' =>'Mobile', 'rules' => 'trim|required'),
					 array('field'=> 'email', 'label' =>'Email', 'rules' => 'trim|required'),
					 array('field'=> 'identification_means', 'Means of Identification' =>'gender', 'rules' => 'trim|required'),
					 array('field'=> 'content_address', 'label' =>'Content Address', 'rules' => 'trim|required'),
					 array('field'=> 'content_value', 'label' =>'Content Value', 'rules' => 'trim|required'),
					 array('field'=> 'content_description', 'label' =>'Content Description', 'rules' => 'trim|required'),
					 array('field'=> 'content_report', 'label' =>'Content Report', 'rules' => 'trim|required'),
					 array('field'=> 'content_age', 'label' =>'Content Age', 'rules' => 'trim|required'),
					 
                    ),					
     'benefit_classification_valid'=>array(
                     array('field'=> 'benefit_id', 'label' =>'benefit_id', 'rules' => 'trim|required|numeric'),
					  array('field'=> 'classification_id', 'label' =>'classification_id', 'rules' => 'trim|required|numeric'),
                     ),		
    'vehicle_reg_valid'=>array(
                    array('field'=> 'msisdn', 'label' =>'msisdn','rules' => 'trim|required' ),
                   ),							
    
    );
 ?>