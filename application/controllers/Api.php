<?php 

use Restserver\Libraries\REST_Controller;

require APPPATH . 'libraries/REST_Controller.php';
require_once APPPATH . '/controllers/End_Point_Connect.php';
require APPPATH . 'libraries/Format.php';
class Api extends REST_Controller {
 private $config;
 private $db;  
function __construct(){
    parent::__construct();
    $this->load->model('Api_model');
     $this->db = $this->load->database();
    header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type, x-api-key,client-id');
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Allow-Origin: *');
    if ( "OPTIONS" === $_SERVER['REQUEST_METHOD'] ) {
     die();
   }
}

function tester_get(){
    $epc = new End_Point_Connect(); 

    $r = $epc->client_header(getallheaders());

    
    $this->response(array('status' => $r));
     //     $ip = $this->input->ip_address();
      //     $utility = new Utility();
          //  $utility->send_sms("low-balance", "08099444264");
        //   $this->response(array('status' => $utility->call_tester(),'ip' => $ip));
          //print_r($ip);
}

function test_get(){
    $epc = new End_Point_Connect(); 
    $this->response(array('status' =>'200', 'name'=>'Adigun Hammed', 'phonenumber' => '08139440504'));    
}


function testing_post(){
    $req = file_get_contents('php://input');
    $data = json_decode($req , true);
    $num_1  = trim($data['num_1_input']);  
    $num_2  = trim($data['num_2_input']);
   // $phonenumber  = trim($data['phonenumber']);
    
    $sum = $num_1 + $num_2;

    $this->response(array('status_code' => '0' ,'message' => 'Successful', 'sum' =>  $sum));
   
}
// ===== Vision =====
function vision_creation_post(){
    $req = file_get_contents('php://input');
    $data = json_decode($req , true);
    $vision_header  = trim($data['vision_header']);  
    $vision_content  = trim($data['vision_content']);

    
    
  if ($vision_header == "" )  {
        $this->response(array('status_code' => '1' ,'message' =>'Invalid (vision_header)'));
    }
  if ($vision_content == ""){
     $this->response(array('status_code' => '1' ,'message' =>'Invalid (vision_content)'));
  }  
 $epc = new End_Point_Connect(); 
  $response =  $epc->save_vision($vision_header, $vision_content); 

  $this->response($response);
}
  
function vision_update_post(){
    $req = file_get_contents('php://input');
    $data = json_decode($req , true);
    $vision_header  = trim($data['vision_header']);  
    $vision_content  = trim($data['vision_content']);
    $id  = trim($data['id']);
    
    
  if ($id == "" )  {
        $this->response(array('status_code' => '1' ,'message' =>'Invalid (id)'));
    }
  if ($vision_content == ""){
     $this->response(array('status_code' => '1' ,'message' =>'Invalid (vision_content)'));
  }  
  if ($vision_header == ""){
     $this->response(array('status_code' => '1' ,'message' =>'Invalid (vision_header)'));
  }  
 $epc = new End_Point_Connect(); 
 $response =  $epc-> update_vision($vision_header, $vision_content,$id);
  $this->response($response);

}
function vision_get(){
   $epc = new End_Point_Connect(); 
$response =  $epc-> get_vision();
  $this->response($response);
}

function vision_delete_post() {
    $req = file_get_contents('php://input');
    $data = json_decode($req, true);
    $id = trim($data['id']);

    // Validate the input
    if (empty($id)) {
        $this->response(array('status_code' => '1', 'message' => 'Invalid (id)'));
        return;
    }

    // Call the delete method from End_Point_Connect
    $epc = new End_Point_Connect();
    $response = $epc->delete_vision($id);
    $this->response($response);
}

// ===== Agenda =====

function agenda_creation_post(){
    $req = file_get_contents('php://input');
    $data = json_decode($req , true);
    $agenda_header  = trim($data['agenda_header']);  
    $agenda_content  = trim($data['agenda_content']);

    
    
  if ($agenda_header == "" )  {
        $this->response(array('status_code' => '1' ,'message' =>'Invalid (agenda_header)'));
    }
  if ($agenda_content == ""){
     $this->response(array('status_code' => '1' ,'message' =>'Invalid (agenda_content)'));
  }  
 $epc = new End_Point_Connect(); 
  $response =  $epc->save_agenda($agenda_header, $agenda_content); 

  $this->response($response);
}
  
function agenda_update_post(){
    $req = file_get_contents('php://input');
    $data = json_decode($req , true);
    $agenda_header  = trim($data['agenda_header']);  
    $agenda_content  = trim($data['agenda_content']);
    $id  = trim($data['id']);
    
    
  if ($id == "" )  {
        $this->response(array('status_code' => '1' ,'message' =>'Invalid (id)'));
    }
  if ($agenda_content == ""){
     $this->response(array('status_code' => '1' ,'message' =>'Invalid (agenda_content)'));
  }  
  if ($agenda_header == ""){
     $this->response(array('status_code' => '1' ,'message' =>'Invalid (agenda_header)'));
  }  
 $epc = new End_Point_Connect(); 
 $response =  $epc-> update_agenda($agenda_header, $agenda_content,$id);
  $this->response($response);

}
function agenda_get(){
   $epc = new End_Point_Connect(); 
$response =  $epc-> get_agenda();
  $this->response($response);
}

function agenda_delete_post() {
    $req = file_get_contents('php://input');
    $data = json_decode($req, true);
    $id = trim($data['id']);

    // Validate the input
    if (empty($id)) {
        $this->response(array('status_code' => '1', 'message' => 'Invalid (id)'));
        return;
    }

    // Call the delete method from End_Point_Connect
    $epc = new End_Point_Connect();
    $response = $epc->delete_agenda($id);
    $this->response($response);
}

// ===== Mission =====

function mission_creation_post(){
    $req = file_get_contents('php://input');
    $data = json_decode($req , true);
    $mission_header  = trim($data['mission_header']);  
    $mission_content  = trim($data['mission_content']);

    
    
  if ($mission_header == "" )  {
        $this->response(array('status_code' => '1' ,'message' =>'Invalid (mission_header)'));
    }
  if ($mission_content == ""){
     $this->response(array('status_code' => '1' ,'message' =>'Invalid (mission_content)'));
  }  
 $epc = new End_Point_Connect(); 
  $response =  $epc->save_mission($mission_header, $mission_content); 

  $this->response($response);
}
  
function mission_update_post(){
    $req = file_get_contents('php://input');
    $data = json_decode($req , true);
    $mission_header  = trim($data['mission_header']);  
    $mission_content  = trim($data['mission_content']);
    $id  = trim($data['id']);
    
    
  if ($id == "" )  {
        $this->response(array('status_code' => '1' ,'message' =>'Invalid (id)'));
    }
  if ($mission_content == ""){
     $this->response(array('status_code' => '1' ,'message' =>'Invalid (mission_content)'));
  }  
  if ($mission_header == ""){
     $this->response(array('status_code' => '1' ,'message' =>'Invalid (mission_header)'));
  }  
 $epc = new End_Point_Connect(); 
 $response =  $epc-> update_mission($mission_header, $mission_content,$id);
  $this->response($response);

}
function mission_get(){
   $epc = new End_Point_Connect(); 
$response =  $epc-> get_mission();
  $this->response($response);
}

function mission_delete_post() {
    $req = file_get_contents('php://input');
    $data = json_decode($req, true);
    $id = trim($data['id']);

    // Validate the input
    if (empty($id)) {
        $this->response(array('status_code' => '1', 'message' => 'Invalid (id)'));
        return;
    }

    // Call the delete method from End_Point_Connect
    $epc = new End_Point_Connect();
    $response = $epc->delete_mission($id);
    $this->response($response);
}

// ===== Chairman ======

function chairman_creation_post() {
    // Ensure it's a file upload
    if (empty($_FILES['chairman_image']['tmp_name'])) {
        $this->response(array('status_code' => '1', 'message' => 'No image uploaded'));
        return;
    }

    // Load the image
    $image_path = $_FILES['chairman_image']['tmp_name'];

    $chairman_statement = trim($this->input->post('chairman_statement'));
    $chairman_name = trim($this->input->post('chairman_name'));

    if ($chairman_statement == "") {
        $this->response(array('status_code' => '1', 'message' => 'Invalid (chairman_statement)'));
    }

    if ($chairman_name == "") {
        $this->response(array('status_code' => '1', 'message' => 'Invalid (chairman_name)'));
    }

    $epc = new End_Point_Connect();
    $response = $epc->save_chairman($image_path, $chairman_statement, $chairman_name);

    $this->response($response);
}

  
function chairman_update_post() {
    // Check if an ID is provided
    $id = $this->input->post('id');
    if (empty($id)) {
        $this->response(array('status_code' => '1', 'message' => 'Invalid ID'));
        return;
    }

    // Check if position and name are provided
    $chairman_statement = trim($this->input->post('chairman_statement'));
    $chairman_name = trim($this->input->post('chairman_name'));

    if (empty($chairman_statement)) {
        $this->response(array('status_code' => '1', 'message' => 'Invalid (chairman_statement)'));
        return;
    }
    if (empty($chairman_name)) {
        $this->response(array('status_code' => '1', 'message' => 'Invalid (chairman_name)'));
        return;
    }

    // Check if an image file is uploaded
    if (!empty($_FILES['chairman_image']['tmp_name'])) {
        $chairman_image = $_FILES['chairman_image']['tmp_name'];
    } else {
        $chairman_image = null; // No new image uploaded
    }

    // Call the update function
    $epc = new End_Point_Connect();
    $response = $epc->update_chairman($chairman_image, $chairman_statement, $chairman_name, $id);

    // Return the response
    $this->response($response);
}


function chairman_get(){
   $epc = new End_Point_Connect(); 
$response =  $epc-> get_chairman();
  $this->response($response);
}


function chairman_delete_post() {
    $req = file_get_contents('php://input');
    $data = json_decode($req, true);
    $id = trim($data['id']);

    // Validate the input
    if (empty($id)) {
        $this->response(array('status_code' => '1', 'message' => 'Invalid (id)'));
        return;
    }

    // Call the delete method from End_Point_Connect
    $epc = new End_Point_Connect();
    $response = $epc->delete_chairman($id);
    $this->response($response);
}

// ===== contact =====

function contact_creation_post(){
    $req = file_get_contents('php://input');
    $data = json_decode($req , true);
    $website  = trim($data['website']);  
    $email  = trim($data['email']);
    $facebook  = trim($data['facebook']);
    $created_at  = trim($data['created_at']);
    $X  = trim($data['X']);
    
    
  if ($website == "" )  {
        $this->response(array('status_code' => '1' ,'message' =>'Invalid (website)'));
    }
  if ($email == ""){
     $this->response(array('status_code' => '1' ,'message' =>'Invalid (email)'));
  }  
  if ($facebook == ""){
     $this->response(array('status_code' => '1' ,'message' =>'Invalid (facebook)'));
  }  
  if ($created_at == ""){
     $this->response(array('status_code' => '1' ,'message' =>'Invalid (created_at)'));
  }  
  if ($X == ""){
     $this->response(array('status_code' => '1' ,'message' =>'Invalid (X)'));
  }  
 $epc = new End_Point_Connect(); 
  $response =  $epc->save_contact($website, $email, $facebook,$created_at,$X); 

  $this->response($response);
}
  
function contact_update_post(){
    $req = file_get_contents('php://input');
    $data = json_decode($req , true);
    $website  = trim($data['website']);  
    $email  = trim($data['email']);
    $facebook  = trim($data['facebook']);
    $instagram  = trim($data['instagram']);
    $X  = trim($data['X']);
    $id  = trim($data['id']);
    
    
  if ($id == "" )  {
        $this->response(array('status_code' => '1' ,'message' =>'Invalid (id)'));
    }
  if ($website == ""){
     $this->response(array('status_code' => '1' ,'message' =>'Invalid (website)'));
  }  
  if ($email == ""){
     $this->response(array('status_code' => '1' ,'message' =>'Invalid (email)'));
  }  
  if ($facebook == ""){
     $this->response(array('status_code' => '1' ,'message' =>'Invalid (facebook)'));
  }  
  if ($instagram == ""){
     $this->response(array('status_code' => '1' ,'message' =>'Invalid (instagram)'));
  }  
  if ($X == ""){
     $this->response(array('status_code' => '1' ,'message' =>'Invalid (X)'));
  }  
 $epc = new End_Point_Connect(); 
 $response =  $epc-> update_contact($website,$email,$facebook,$instagram,$X,$id);
  $this->response($response);

}
function contact_get(){
   $epc = new End_Point_Connect(); 
$response =  $epc-> get_contact();
  $this->response($response);
}
function contact_delete_post() {
    $req = file_get_contents('php://input');
    $data = json_decode($req, true);
    $id = trim($data['id']);

    // Validate the input
    if (empty($id)) {
        $this->response(array('status_code' => '1', 'message' => 'Invalid (id)'));
        return;
    }

    // Call the delete method from End_Point_Connect
    $epc = new End_Point_Connect();
    $response = $epc->delete_contact($id);
    $this->response($response);
}

// ===== executive =====

function executive_creation_post() {
    // Ensure it's a file upload
    if (empty($_FILES['executive_image']['tmp_name'])) {
        $this->response(array('status_code' => '1', 'message' => 'No image uploaded'));
        return;
    }

    // Load the image
    $image_path = $_FILES['executive_image']['tmp_name'];

    $executive_position = trim($this->input->post('executive_position'));
    $executive_name = trim($this->input->post('executive_name'));

    if ($executive_position == "") {
        $this->response(array('status_code' => '1', 'message' => 'Invalid (executive_position)'));
    }

    if ($executive_name == "") {
        $this->response(array('status_code' => '1', 'message' => 'Invalid (executive_name)'));
    }

    $epc = new End_Point_Connect();
    $response = $epc->save_executive($image_path, $executive_position, $executive_name);

    $this->response($response);
}

function executive_update_post() {
    // Check if an ID is provided
    $id = $this->input->post('id');
    if (empty($id)) {
        $this->response(array('status_code' => '1', 'message' => 'Invalid ID'));
        return;
    }

    // Check if position and name are provided
    $executive_position = trim($this->input->post('executive_position'));
    $executive_name = trim($this->input->post('executive_name'));

    if (empty($executive_position)) {
        $this->response(array('status_code' => '1', 'message' => 'Invalid (executive_position)'));
        return;
    }
    if (empty($executive_name)) {
        $this->response(array('status_code' => '1', 'message' => 'Invalid (executive_name)'));
        return;
    }

    // Check if an image file is uploaded
    if (!empty($_FILES['executive_image']['tmp_name'])) {
        $executive_image = $_FILES['executive_image']['tmp_name'];
    } else {
        $executive_image = null; // No new image uploaded
    }

    // Call the update function
    $epc = new End_Point_Connect();
    $response = $epc->update_executive($executive_image, $executive_position, $executive_name, $id);

    // Return the response
    $this->response($response);
}


function executive_get(){
   $epc = new End_Point_Connect(); 
$response =  $epc-> get_executive();
  $this->response($response);
}


function executive_delete_post() {
    $req = file_get_contents('php://input');
    $data = json_decode($req, true);
    $id = trim($data['id']);

    // Validate the input
    if (empty($id)) {
        $this->response(array('status_code' => '1', 'message' => 'Invalid (id)'));
        return;
    }

    // Call the delete method from End_Point_Connect
    $epc = new End_Point_Connect();
    $response = $epc->delete_executive($id);
    $this->response($response);
}


// ======= Legislative Arm =======

function honorable_creation_post() {
    // Ensure it's a file upload
    if (empty($_FILES['honorable_image']['tmp_name'])) {
        $this->response(array('status_code' => '1', 'message' => 'No image uploaded'));
        return;
    }

    // Load the image
    $image_path = $_FILES['honorable_image']['tmp_name'];

    $honorable_position = trim($this->input->post('honorable_position'));
    $honorable_name = trim($this->input->post('honorable_name'));

    if ($honorable_position == "") {
        $this->response(array('status_code' => '1', 'message' => 'Invalid (honorable_position)'));
    }

    if ($honorable_name == "") {
        $this->response(array('status_code' => '1', 'message' => 'Invalid (honorable_name)'));
    }

    $epc = new End_Point_Connect();
    $response = $epc->save_honorable($image_path, $honorable_position, $honorable_name);

    $this->response($response);
}

function honorable_update_post() {
    // Check if an ID is provided
    $id = $this->input->post('id');
    if (empty($id)) {
        $this->response(array('status_code' => '1', 'message' => 'Invalid ID'));
        return;
    }

    // Check if position and name are provided
    $honorable_position = trim($this->input->post('honorable_position'));
    $honorable_name = trim($this->input->post('honorable_name'));

    if (empty($honorable_position)) {
        $this->response(array('status_code' => '1', 'message' => 'Invalid (honorable_position)'));
        return;
    }
    if (empty($honorable_name)) {
        $this->response(array('status_code' => '1', 'message' => 'Invalid (honorable_name)'));
        return;
    }

    // Check if an image file is uploaded
    if (!empty($_FILES['honorable_image']['tmp_name'])) {
        $honorable_image = $_FILES['honorable_image']['tmp_name'];
    } else {
        $honorable_image = null; // No new image uploaded
    }

    // Call the update function
    $epc = new End_Point_Connect();
    $response = $epc->update_honorable($honorable_image, $honorable_position, $honorable_name, $id);

    // Return the response
    $this->response($response);
}




function legislative_arm_get(){
   $epc = new End_Point_Connect(); 
$response =  $epc-> get_honorable();
  $this->response($response);
}

function honorable_delete_post() {
    $req = file_get_contents('php://input');
    $data = json_decode($req, true);
    $id = trim($data['id']);

    // Validate the input
    if (empty($id)) {
        $this->response(array('status_code' => '1', 'message' => 'Invalid (id)'));
        return;
    }

    // Call the delete method from End_Point_Connect
    $epc = new End_Point_Connect();
    $response = $epc->delete_honorable($id);
    $this->response($response);
}



// ======= Management Staff =======


function staff_creation_post() {
    // Ensure it's a file upload
    if (empty($_FILES['staff_image']['tmp_name'])) {
        $this->response(array('status_code' => '1', 'message' => 'No image uploaded'));
        return;
    }

    // Load the image
    $image_path = $_FILES['staff_image']['tmp_name'];

    $staff_position = trim($this->input->post('staff_position'));
    $staff_name = trim($this->input->post('staff_name'));

    if ($staff_position == "") {
        $this->response(array('status_code' => '1', 'message' => 'Invalid (staff_position)'));
    }

    if ($staff_name == "") {
        $this->response(array('status_code' => '1', 'message' => 'Invalid (staff_name)'));
    }

    $epc = new End_Point_Connect();
    $response = $epc->save_staff($image_path, $staff_position, $staff_name);

    $this->response($response);
}

function staff_update_post() {
    // Check if an ID is provided
    $id = $this->input->post('id');
    if (empty($id)) {
        $this->response(array('status_code' => '1', 'message' => 'Invalid ID'));
        return;
    }

    // Check if position and name are provided
    $staff_position = trim($this->input->post('staff_position'));
    $staff_name = trim($this->input->post('staff_name'));

    if (empty($staff_position)) {
        $this->response(array('status_code' => '1', 'message' => 'Invalid (staff_position)'));
        return;
    }
    if (empty($staff_name)) {
        $this->response(array('status_code' => '1', 'message' => 'Invalid (staff_name)'));
        return;
    }

    // Check if an image file is uploaded
    if (!empty($_FILES['executive_image']['tmp_name'])) {
        $staff_image = $_FILES['staff_image']['tmp_name'];
    } else {
        $staff_image = null; // No new image uploaded
    }

    // Call the update function
    $epc = new End_Point_Connect();
    $response = $epc->update_staff($staff_image, $staff_position, $staff_name, $id);

    // Return the response
    $this->response($response);
}


function staff_get(){
   $epc = new End_Point_Connect(); 
$response =  $epc-> get_staff();
  $this->response($response);
}


function staff_delete_post() {
    $req = file_get_contents('php://input');
    $data = json_decode($req, true);
    $id = trim($data['id']);

    // Validate the input
    if (empty($id)) {
        $this->response(array('status_code' => '1', 'message' => 'Invalid (id)'));
        return;
    }

    // Call the delete method from End_Point_Connect
    $epc = new End_Point_Connect();
    $response = $epc->delete_staff($id);
    $this->response($response);
}


//  ======= Hero =======

function hero_creation_post() {
    // Ensure it's a file upload
    if (empty($_FILES['hero_image']['tmp_name'])) {
        $this->response(array('status_code' => '1', 'message' => 'No image uploaded'));
        return;
    }

    // Load the image
    $image_path = $_FILES['hero_image']['tmp_name'];
    
    $hero_text = trim($this->input->post('hero_text'));

    if ($hero_text == "") {
        $this->response(array('status_code' => '1', 'message' => 'Invalid (hero_text)'));
    }

    $epc = new End_Point_Connect();
    $response = $epc->save_hero($image_path, $hero_text);

    $this->response($response);
}


  
function hero_update_post() {
    // Check if an ID is provided
    $id = $this->input->post('id');
    if (empty($id)) {
        $this->response(array('status_code' => '1', 'message' => 'Invalid ID'));
        return;
    }

    // Check if position and name are provided
    $hero_text = trim($this->input->post('hero_text'));

    if (empty($hero_text)) {
        $this->response(array('status_code' => '1', 'message' => 'Invalid (hero_text)'));
        return;
    }

    // Check if an image file is uploaded
    if (!empty($_FILES['hero_image']['tmp_name'])) {
        $hero_image = $_FILES['hero_image']['tmp_name'];
    } else {
        $hero_image = null; // No new image uploaded
    }

    // Call the update function
    $epc = new End_Point_Connect();
    $response = $epc->update_hero($hero_image, $hero_text, $id);

    // Return the response
    $this->response($response);
}


function hero_get(){
   $epc = new End_Point_Connect(); 
$response =  $epc-> get_hero();
  $this->response($response);
}

 function hero_delete_post() {
    $req = file_get_contents('php://input');
    $data = json_decode($req, true);
    $id = trim($data['id']);

    // Validate the input
    if (empty($id)) {
        $this->response(array('status_code' => '1', 'message' => 'Invalid (id)'));
        return;
    }

    // Call the delete method from End_Point_Connect
    $epc = new End_Point_Connect();
    $response = $epc->delete_hero($id);
    $this->response($response);
}


// ===== News =====


function news_creation_post() {
    // Ensure it's a file upload
    if (empty($_FILES['news_image']['tmp_name'])) {
        $this->response(array('status_code' => '1', 'message' => 'No image uploaded'));
        return;
    }

    // Load the image
    $image_path = $_FILES['news_image']['tmp_name'];

    $news_heading = trim($this->input->post('news_heading'));
    $news_content = trim($this->input->post('news_content'));

    if ($news_heading == "") {
        $this->response(array('status_code' => '1', 'message' => 'Invalid (news_heading)'));
    }

    if ($news_content == "") {
        $this->response(array('status_code' => '1', 'message' => 'Invalid (news_content)'));
    }

    $epc = new End_Point_Connect();
    $response = $epc->save_news($image_path, $news_heading, $news_content);

    $this->response($response);
}



function news_update_post() {
    // Check if an ID is provided
    $id = $this->input->post('id');
    if (empty($id)) {
        $this->response(array('status_code' => '1', 'message' => 'Invalid ID'));
        return;
    }

    // Check if position and name are provided
    $news_heading = trim($this->input->post('news_heading'));
    $news_content = trim($this->input->post('news_content'));

    if (empty($news_heading)) {
        $this->response(array('status_code' => '1', 'message' => 'Invalid (news_heading)'));
        return;
    }
    if (empty($news_content)) {
        $this->response(array('status_code' => '1', 'message' => 'Invalid (news_content)'));
        return;
    }

    // Check if an image file is uploaded
    if (!empty($_FILES['news_image']['tmp_name'])) {
        $news_image = $_FILES['news_image']['tmp_name'];
    } else {
        $news_image = null; // No new image uploaded
    }

    // Call the update function
    $epc = new End_Point_Connect();
    $response = $epc->update_news($news_image, $news_heading, $news_content, $id);

    // Return the response
    $this->response($response);
}


function news_get(){
   $epc = new End_Point_Connect(); 
$response =  $epc-> get_news();
  $this->response($response);
}

function news_delete_post() {
    $req = file_get_contents('php://input');
    $data = json_decode($req, true);
    $id = trim($data['id']);

    // Validate the input
    if (empty($id)) {
        $this->response(array('status_code' => '1', 'message' => 'Invalid (id)'));
        return;
    }

    // Call the delete method from End_Point_Connect
    $epc = new End_Point_Connect();
    $response = $epc->delete_news($id);
    $this->response($response);
}


// ======= Achievements =======

function achievement_creation_post() {
    // Ensure it's a file upload
    if (empty($_FILES['achievement_image']['tmp_name'])) {
        $this->response(array('status_code' => '1', 'message' => 'No image uploaded'));
        return;
    }

    // Load the image
    $image_path = $_FILES['achievement_image']['tmp_name'];

    $epc = new End_Point_Connect();
    $response = $epc->save_achievement($image_path);

    $this->response($response);
}



function achievement_update_post() {
    // Check if an ID is provided
    $id =intval($this->input->post('id'));
    if (empty($id)) {
        $this->response(array('status_code' => '1', 'message' => 'Invalid ID'));
        return;
    }

    // Check if position and name are provided

    // Check if an image file is uploaded
    if (!empty($_FILES['achievement_image']['tmp_name'])) {
        $achievement_image = $_FILES['achievement_image']['tmp_name'];
    } else {
        $achievement_image = null; // No new image uploaded
    }

    // Call the update function
    $epc = new End_Point_Connect();
    $response = $epc->update_achievement($achievement_image, $id);

    // Return the response
    $this->response($response);
}


function achievements_get(){
   $epc = new End_Point_Connect(); 
$response =  $epc-> get_achievements();
  $this->response($response);
}

function achievement_delete_post() {
    $req = file_get_contents('php://input');
    $data = json_decode($req, true);
    $id = trim($data['id']);

    // Validate the input
    if (empty($id)) {
        $this->response(array('status_code' => '1', 'message' => 'Invalid (id)'));
        return;
    }

    // Call the delete method from End_Point_Connect
    $epc = new End_Point_Connect();
    $response = $epc->delete_achievement($id);
    $this->response($response);
}


// ======= Heeds Agenda =======

function heeds_creation_post() {
    // Ensure it's a file upload
    if (empty($_FILES['heeds_image']['tmp_name'])) {
        $this->response(array('status_code' => '1', 'message' => 'No image uploaded'));
        return;
    }

    // Load the image
    $image_path = $_FILES['heeds_image']['tmp_name'];

    $epc = new End_Point_Connect();
    $response = $epc->save_heeds_agenda($image_path);

    $this->response($response);
}



function heeds_update_post() {
    // Check if an ID is provided
    $id =$this->input->post('id');
    if (empty($id)) {
        $this->response(array('status_code' => '1', 'message' => 'Invalid ID'));
        return;
    }

    // Check if position and name are provided

    // Check if an image file is uploaded
    if (!empty($_FILES['heeds_image']['tmp_name'])) {
        $heeds_image = $_FILES['heeds_image']['tmp_name'];
    } else {
        $heeds_image = null; // No new image uploaded
    }

    // Call the update function
    $epc = new End_Point_Connect();
    $response = $epc->update_heeds_agenda($heeds_image, $id);

    // Return the response
    $this->response($response);
}


function heeds_get(){
   $epc = new End_Point_Connect(); 
$response =  $epc-> get_heeds_agenda();
  $this->response($response);
}

function heeds_delete_post() {
    $req = file_get_contents('php://input');
    $data = json_decode($req, true);
    $id = trim($data['id']);

    // Validate the input
    if (empty($id)) {
        $this->response(array('status_code' => '1', 'message' => 'Invalid (id)'));
        return;
    }

    // Call the delete method from End_Point_Connect
    $epc = new End_Point_Connect();
    $response = $epc->delete_heeds_agenda($id);
    $this->response($response);
}


// ======== Our Services =======


function service_creation_post(){
    $req = file_get_contents('php://input');
    $data = json_decode($req , true);
    $facility_location  = trim($data['facility_location']);  
    $facility_address  = trim($data['facility_address']);
    $facility_type  = trim($data['facility_type']);
    $phone_number  = trim($data['phone_number']);
    $email  = trim($data['email']);
    
    
  if ($facility_location == "" )  {
        $this->response(array('status_code' => '1' ,'message' =>'Invalid (facility_location)'));
    }
  if ($facility_address == ""){
     $this->response(array('status_code' => '1' ,'message' =>'Invalid (facility_address)'));
  }  
  if ($facility_type == ""){
     $this->response(array('status_code' => '1' ,'message' =>'Invalid (facility_type)'));
  }  
  if ($phone_number == ""){
     $this->response(array('status_code' => '1' ,'message' =>'Invalid (phone_number)'));
  }  
  if ($email == ""){
     $this->response(array('status_code' => '1' ,'message' =>'Invalid (email)'));
  }  
 $epc = new End_Point_Connect(); 
  $response =  $epc->save_chairman($facility_location, $facility_address, $facility_type,$phone_number,$email); 

  $this->response($response);
}
  
function service_update_post(){
    $req = file_get_contents('php://input');
    $data = json_decode($req , true);
    $facility_location  = trim($data['facility_location']);  
    $facility_address  = trim($data['facility_address']);
    $facility_type  = trim($data['facility_type']);
    $phone_number  = trim($data['phone_number']);
    $email  = trim($data['email']);
    $id  = trim($data['id']);
    
    
  if ($id == "" )  {
        $this->response(array('status_code' => '1' ,'message' =>'Invalid (id)'));
    }
  if ($facility_address == ""){
     $this->response(array('status_code' => '1' ,'message' =>'Invalid (facility_address)'));
  }  
  if ($facility_location == ""){
     $this->response(array('status_code' => '1' ,'message' =>'Invalid (facility_location)'));
  }  
  if ($facility_type == ""){
     $this->response(array('status_code' => '1' ,'message' =>'Invalid (facility_type)'));
  }  
  if ($phone_number == ""){
     $this->response(array('status_code' => '1' ,'message' =>'Invalid (phone_number)'));
  }  
  if ($email == ""){
     $this->response(array('status_code' => '1' ,'message' =>'Invalid (email)'));
  }  
 $epc = new End_Point_Connect(); 
 $response =  $epc-> update_service($facility_location, $facility_address,$facility_type,$phone_number,$email,$id);
  $this->response($response);

}
function services_get(){
   $epc = new End_Point_Connect(); 
$response =  $epc-> get_services();
  $this->response($response);
}

function service_delete_post(){
    $req = file_get_contents('php://input');
    $data = json_decode($req, true);
    $id = trim($data['id']);

    // Validate the input
    if (empty($id)) {
        $this->response(array('status_code' => '1', 'message' => 'Invalid (id)'));
        return;
    }

    // Call the delete method from End_Point_Connect
    $epc = new End_Point_Connect();
    $response = $epc->delete_service($id);
    $this->response($response);
}


// ======= Reports =======

function report_creation_post(){
    $req = file_get_contents('php://input');
    $data = json_decode($req , true);
    $reporter_address  = trim($data['reporter_address']);  
    $report_category  = trim($data['report_category']);
    $report  = trim($data['report']);
    $phone_number  = trim($data['phone_number']);
    
    
  if ($reporter_address == "" )  {
        $this->response(array('status_code' => '1' ,'message' =>'Invalid (reporter_address)'));
    }
  if ($report_category == ""){
     $this->response(array('status_code' => '1' ,'message' =>'Invalid (report_category)'));
  }  
  if ($report == ""){
     $this->response(array('status_code' => '1' ,'message' =>'Invalid (report)'));
  }  
  if ($phone_number == ""){
     $this->response(array('status_code' => '1' ,'message' =>'Invalid (phone_number)'));
  }  
  
 $epc = new End_Point_Connect(); 
  $response =  $epc->save_chairman($reporter_address, $report_category, $report,$phone_number); 

  $this->response($response);
}
  
function report_update_post(){
    $req = file_get_contents('php://input');
    $data = json_decode($req , true);
    $reporter_address  = trim($data['reporter_address']);  
    $report_category  = trim($data['report_category']);
    $report  = trim($data['report']);
    $phone_number  = trim($data['phone_number']);
    
    $id  = trim($data['id']);
    
    
  if ($id == "" )  {
        $this->response(array('status_code' => '1' ,'message' =>'Invalid (id)'));
    }
  if ($report_category == ""){
     $this->response(array('status_code' => '1' ,'message' =>'Invalid (report_category)'));
  }  
  if ($facility_location == ""){
     $this->response(array('status_code' => '1' ,'message' =>'Invalid (facility_location)'));
  }  
  if ($report == ""){
     $this->response(array('status_code' => '1' ,'message' =>'Invalid (report)'));
  }  
  if ($phone_number == ""){
     $this->response(array('status_code' => '1' ,'message' =>'Invalid (phone_number)'));
  }  
  if ($email == ""){
     $this->response(array('status_code' => '1' ,'message' =>'Invalid (email)'));
  }  
 $epc = new End_Point_Connect(); 
 $response =  $epc-> update_service($facility_location, $report_category,$report,$phone_number,$email,$id);
  $this->response($response);

}
function reports_get(){
   $epc = new End_Point_Connect(); 
$response =  $epc-> get_reports();
  $this->response($response);
}

function report_delete_post(){
    $req = file_get_contents('php://input');
    $data = json_decode($req, true);
    $id = trim($data['id']);

    // Validate the input
    if (empty($id)) {
        $this->response(array('status_code' => '1', 'message' => 'Invalid (id)'));
        return;
    }

    // Call the delete method from End_Point_Connect
    $epc = new End_Point_Connect();
    $response = $epc->delete_report($id);
    $this->response($response);
}





// =====================================================================
function register_post() {
    $phone= trim($this->input->post('phone'));
    $email = trim($this->input->post('email'));
    $fname =trim( $this->input->post('fname'));
    $lname = trim($this->input->post('lname'));
    $password  =trim($this->input->post('password'));
  
    $epc = new End_Point_Connect(); 
   
    if ($password == "" )  {
        $this->response(array('status_code' => '1' ,'message' =>'Invalid (password)'));
    }
   
    if ( $phone  == '')  {
        $this->response(array('status' => false , 'responsecode' => '1000','message' =>'Invalid Request Parameters ( phonenumber )'));
    }
   
    if ($fname == '')  {
        $this->response(array('status' => false , 'responsecode' => '1000','message' =>'Invalid Request Parameters (fname)'));
    }
   
    if ($lname == '')  {
        $this->response(array('status' => false , 'responsecode' => '1000','message' =>'Invalid Request Parameters ( lastname)'));
    }
 
    if ($email == '')  {
        $this->response(array('status' => false , 'responsecode' => '1000','message' =>'Invalid Request Parameters ( email )'));
    }

     $response =  $epc->save_details_ep($phone, $fname,$lname,$email,$password); 

     $this->response($response);
     
  
  }


  function login_post() {
    $email= trim($this->input->post('email'));
    $password  =trim($this->input->post('password'));
  
    $epc = new End_Point_Connect(); 
   
    if ($password == "" )  {
        $this->response(array('status' => false , 'responsecode' => '1000','message' =>'Invalid Request Parameters (password)'));
    }
   
    if ($email == '')  {
        $this->response(array('status' => false , 'responsecode' => '1000','message' =>'Invalid Request Parameters ( email )'));
    }

    $response =  $epc->auth_ep($email,$password); 
    
    $this->response($response);
       
  
  }


  function testa_post() {
    
    $epc = new End_Point_Connect(); 
    $axs=   "Authorization:  sandbox_sk_75881dc764ac8c724eb528e179dce5428fdab0dd329b";
    $header = array("Content-Type: application/json", $axs );
   // $data = json_encode(array( "account_number" => "0691614946" , "bank_code" => "000014" ));
    $data = json_encode(array( "first_name" => "Adigun" , "last_name" => "Hammed" , "dob" => "30/10/1990", "bvn" => "22110011001",
     "email" => "adigun@gmail.com", "address" => "lagos", "gender" => "1", "beneficiary_account" => "0012312111", 
     "customer_identifier" => "CCC",  "mobile_num" => "08010143452"));

    /*
       "{\"first_name\":\"Joesph\"," +
        "\"last_name\":\"Ayodele\"," +
        "\"dob\":\"30/10/1990\",\"bvn\":\"22110011001\",\"email\":\"ayo@gmail.com\"," +
        "\"address\":\"22 Kota street, UK\",\"gender\":\"1\"," +
        " \"beneficiary_account\":\"0900110011\", \"customer_identifier\":\"CCC\"" +
        ", \"mobile_num\":\"09188888888\" }" );
    */
    //    $response =  $epc-> call_api_a("POST", "https://sandbox-api-d.squadco.com/payout/account/lookup", $header , $data);
        $response =  $epc-> call_api_a("POST", "https://sandbox-api-d.squadco.com/virtual-account", $header , $data);
    
    $this->response($response);
       
  
  }


  function upload_test_post(){
    $phonenumber =   trim($this->input->post('phonenumber'));
    $image_name =  $_FILES['upload_picture']['name'];
    $image_tmp_name  = $_FILES["upload_picture"]["tmp_name"];    
    $target_dir =  "images/$phonenumber"."_";
    $target_file = $target_dir . basename( $image_name);            
     
    $file_size = round(filesize($image_tmp_name)/1042 ,2);
    
    if($file_size > 500.00){            
      $this->response(array('status_code' => '1' ,'message' =>'The image size of the image should not be greater than 500kb')); 
    }  
    
    // Select file type
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Valid file extensions
    $extensions_arr = array("jpg","jpeg","png","gif");
       // Check extension
    if( in_array($imageFileType,$extensions_arr) ){
        // $utility = new Utility();
         $full_image_name = "$target_dir$image_name";
         $t =    move_uploaded_file($_FILES['upload_picture']['tmp_name'],$full_image_name);  
         if ($t == 1){ 
             $this->response(array('status_code' => '0' ,'message' =>'The image  upload at the moment')); 
            // $url = "https://zippyworld.net/zippy_world_live_api/$full_image_name";
           //  $this->response($utility->identity_upload($phonenumber, $url)); 
         }else{
              $this->response(array('status_code' => '1' ,'message' =>'The image cannot be upload at the moment, try again later.')); 
         }        
     }     
    }
  
 
}

