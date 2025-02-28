<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once FCPATH . 'vendor/autoload.php';

use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;

class End_Point_Connect extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->config->load('cloudinary'); // Load Cloudinary config

        // Get Cloudinary credentials from config
        $cloudinary_config = $this->config->item('cloudinary');

        // Initialize Cloudinary with API credentials
        Configuration::instance([
            'cloud' => [
                'cloud_name' => $cloudinary_config['cloud_name'],
                'api_key'    => $cloudinary_config['api_key'],
                'api_secret' => $cloudinary_config['api_secret']
            ],
            'url' => [
                'secure' => true
            ]
        ]);
    }

// defined('BASEPATH') OR exit('No direct script access allowed');

// class End_Point_Connect extends CI_Controller {


// function __construct(){
//     parent::__construct();
// }


// public function index()
// {  
//  echo APPPATH;
// }
  //=========== Database runs =====================//
  
   function save_vision($vision_header, $vision_content){
    $response = array('status_code' => '1' , 'message' => '');
   
    $result = $this->db->query("insert into vision (vision_header,vision_content)values ('$vision_header','$vision_content')");
   
    if ($this->db->affected_rows() == 1){
      $response =  array('status_code' =>  '0' ,'message' =>'Vision Saved Successful'); 
    }
   return $response;
  }
   function update_vision($vision_header, $vision_content,$id){
    $response = array('status_code' => '1' , 'message' => '');
   
    $result = $this->db->query("update vision set vision_header='$vision_header',vision_content='$vision_content' where id=$id");
   
    if ($this->db->affected_rows() == 1){
      $response =  array('status_code' =>  '0' ,'message' =>'Vision updated Successful'); 
    }
   return $response;
  }

  function get_vision(){
    $response = array('status_code' => '1' , 'message' => '');
   
    $result = $this->db->query("Select * from vision")->result_array();
   
    if (sizeof($result) > 0 ){
      $response =  array('status_code' =>  '0' ,'message' =>'Vision updated Successful', "data" => $result ); 
    }
   return $response;
  }
  function delete_vision($id){
    $response = array('status_code' => '1' , 'message' => '');
   
    $result = $this->db->query("delete from vision  where id=$id");
   
    if ($this->db->affected_rows() > 0){
      $response =  array('status_code' =>  '0' ,'message' =>'Vision deleted Successful'); 
    }
   return $response;
  }

// ===== Agenda =====
function save_agenda($agenda_header, $agenda_content){
    $response = array('status_code' => '1' , 'message' => '');
   
    $result = $this->db->query("insert into agenda (agenda_header,agenda_content)values ('$agenda_header','$agenda_content')");
   
    if ($this->db->affected_rows() == 1){
      $response =  array('status_code' =>  '0' ,'message' =>'Agenda Saved Successful'); 
    }
   return $response;
  }

  function update_agenda($agenda_header, $agenda_content,$id){
    $response = array('status_code' => '1' , 'message' => '');
   
    $result = $this->db->query("update agenda set agenda_header='$agenda_header',agenda_content='$agenda_content' where id=$id");
   
    if ($this->db->affected_rows() == 1){
      $response =  array('status_code' =>  '0' ,'message' =>'agenda updated Successful'); 
    }
   return $response;
  }
function get_agenda(){
    $response = array('status_code' => '1' , 'message' => '');
   
    $result = $this->db->query("Select * from agenda")->result_array();
   
    if (sizeof($result) > 0 ){
      $response =  array('status_code' =>  '0' ,'message' =>'Agenda updated Successful', "data" => $result ); 
    }
   return $response;
  }

  function delete_agenda($id){
    $response = array('status_code' => '1' , 'message' => '');
   
    $result = $this->db->query("delete from agenda  where id=$id");
   
    if ($this->db->affected_rows() > 0){
      $response =  array('status_code' =>  '0' ,'message' =>'Agenda deleted Successful'); 
    }
   return $response;
  }


// ===== Mission =====

function save_mission($mission_header, $mission_content){
    $response = array('status_code' => '1' , 'message' => '');
    
    $result = $this->db->query("insert into mission (mission_header,mission_content)values ('$mission_header','$mission_content')");
    if ($this->db->affected_rows() == 1){
      $response =  array('status_code' =>  '0' ,'message' =>'Mission Saved Successful'); 
    }
   return $response;
  }

  function update_mission($mission_header, $mission_content,$id){
    $response = array('status_code' => '1' , 'message' => '');
   
    $result = $this->db->query("update mission set mission_header='$mission_header',mission_content='$mission_content' where id=$id");
   
    if ($this->db->affected_rows() == 1){
      $response =  array('status_code' =>  '0' ,'message' =>'Mission updated Successful'); 
    }
   return $response;
  }
function get_mission(){
    $response = array('status_code' => '1' , 'message' => '');
   
    $result = $this->db->query("Select * from mission")->result_array();
   
    if (sizeof($result) > 0 ){
      $response =  array('status_code' =>  '0' ,'message' =>'Mission updated Successful', "data" => $result ); 
    }
   return $response;
  }

function delete_mission($id){
    $response = array('status_code' => '1' , 'message' => '');
   
    $result = $this->db->query("delete from news  where id=$id");
   
    if ($this->db->affected_rows() > 0){
      $response =  array('status_code' =>  '0' ,'message' =>'Mission deleted Successful'); 
    }
   return $response;
  }



// ===== Chairman =====


function save_chairman($chairman_image, $chairman_statement, $chairman_name) {
    $response = array('status_code' => '1', 'message' => '');

    // Upload image to Cloudinary
    try {
        $upload = (new UploadApi())->upload($chairman_image, ["folder" => "chairman_images"]);

        // Get the URL of the uploaded image
        $image_url = $upload['secure_url'];

        // Save only the URL in MySQL
        $this->db->query("INSERT INTO chairman (chairman_image, chairman_statement, chairman_name) 
                          VALUES ('$image_url', '$chairman_statement', '$chairman_name')");

        if ($this->db->affected_rows() == 1) {
            $response = array('status_code' => '0', 'message' => 'Chairman Saved Successfully');
        }
    } catch (Exception $e) {
        $response['message'] = 'Image Upload Failed: ' . $e->getMessage();
    }

    return $response;
}



  function update_chairman($chairman_image, $chairman_statement, $chairman_name, $id) {
    $response = array('status_code' => '1', 'message' => '');

    // Validate the ID exists before querying
    if (empty($id)) {
        return array('status_code' => '1', 'message' => 'Invalid ID');
    }

    // Retrieve the existing image URL from the database
    $query = $this->db->query("SELECT chairman_image FROM chairman WHERE id = ?", array($id))->row_array();

    if (!$query) {
        return array('status_code' => '1', 'message' => 'Record not found');
    }

    $old_image_url = $query['chairman_image'];

    // Upload new image if provided
    if (!empty($chairman_image)) {
        try {
            $upload = (new UploadApi())->upload($chairman_image, ['folder' => 'chairman_images']);
            $new_image_url = $upload['secure_url'];

            // Delete old image from Cloudinary if exists
            if (!empty($old_image_url)) {
                $public_id = pathinfo(parse_url($old_image_url, PHP_URL_PATH), PATHINFO_FILENAME);
                (new UploadApi())->destroy("chairman_images/$public_id");
            }
        } catch (Exception $e) {
            return array('status_code' => '1', 'message' => 'Image Upload Failed: ' . $e->getMessage());
        }
    } else {
        $new_image_url = $old_image_url;
    }

    // Update the database
    $result = $this->db->query("UPDATE chairman SET chairman_image=?, chairman_statement=?, chairman_name=? WHERE id=?", 
        array($new_image_url, $chairman_statement, $chairman_name, $id));

    if ($this->db->affected_rows() == 1) {
        $response = array('status_code' => '0', 'message' => 'Chairman Updated Successfully', 'image_url' => $new_image_url);
    } else {
        $response = array('status_code' => '1', 'message' => 'No changes made to the record.');
    }

    return $response;
}


function get_chairman() {
    $response = array('status_code' => '1', 'message' => '');

    $result = $this->db->query("SELECT * FROM chairman")->result_array();

    if (!empty($result)) {
        $response = array('status_code' => '0', 'message' => 'Chairman retrieved successfully', "data" => $result);
    }

    return $response;
}

  function delete_chairman($id) {
    $response = array('status_code' => '1', 'message' => '');

    // Fetch the image URL from the database
    $query = $this->db->query("SELECT chairman_image FROM chairman WHERE id = $id")->row_array();
    $image_url = $query['chairman_image'];

    if ($image_url) {
        // Extract public ID from the URL
        $public_id = pathinfo($image_url, PATHINFO_FILENAME);

        // Configure Cloudinary
        Configuration::instance([
            'cloud' => [
                'cloud_name' => $this->config->item('cloudinary')['cloud_name'],
                'api_key'    => $this->config->item('cloudinary')['api_key'],
                'api_secret' => $this->config->item('cloudinary')['api_secret']
            ],
            'url' => [
                'secure' => true
            ]
        ]);

        // Delete the image from Cloudinary
        (new UploadApi())->destroy("chairman_images/$public_id");
    }

    // Delete the record from the database
    $result = $this->db->query("DELETE FROM chairman WHERE id = $id");

    if ($this->db->affected_rows() > 0) {
        $response = array('status_code' => '0', 'message' => 'Chairman deleted successfully');
    }

    return $response;
}



  // ===== contact =====

function save_contact($website,$email, $facebook,$X,$instagram){
    $response = array('status_code' => '1' , 'message' => '');
    
    $result = $this->db->query("insert into contact (website,email,facebook,instagram,X)values ('$website','$email','$facebook','$instagram','$X')");
    if ($this->db->affected_rows() == 1){
      $response =  array('status_code' =>  '0' ,'message' =>'Contact Saved Successful'); 
    }
   return $response;
  }

  function update_contact($website, $email,$facebook,$instagram,$X,$id){
    $response = array('status_code' => '1' , 'message' => '');
   
    $result = $this->db->query("update contact set website='$website',email='$email',facebook='$facebook',instagram='$instagram',X='$X' where id=$id");
   
    if ($this->db->affected_rows() == 1){
      $response =  array('status_code' =>  '0' ,'message' =>'Contact updated Successful'); 
    }
   return $response;
  }
function get_contact(){
    $response = array('status_code' => '1' , 'message' => '');
   
    $result = $this->db->query("Select * from contact")->result_array();
   
    if (sizeof($result) > 0 ){
      $response =  array('status_code' =>  '0' ,'message' =>'Contact updated Successful', "data" => $result ); 
    }
   return $response;
  }

function delete_contact($id){
    $response = array('status_code' => '1' , 'message' => '');
   
    $result = $this->db->query("delete from contact  where id=$id");
   
    if ($this->db->affected_rows() > 0){
      $response =  array('status_code' =>  '0' ,'message' =>'Contact deleted Successful'); 
    }
   return $response;
  }


  // ===== executive =====


function save_executive($executive_image, $executive_position, $executive_name) {
    $response = array('status_code' => '1', 'message' => '');

    // Upload image to Cloudinary
    try {
        $upload = (new UploadApi())->upload($executive_image, ["folder" => "executive_images"]);

        // Get the URL of the uploaded image
        $image_url = $upload['secure_url'];

        // Save only the URL in MySQL
        $this->db->query("INSERT INTO executive (executive_image, executive_position, executive_name) 
                          VALUES ('$image_url', '$executive_position', '$executive_name')");

        if ($this->db->affected_rows() == 1) {
            $response = array('status_code' => '0', 'message' => 'Executive Saved Successfully');
        }
    } catch (Exception $e) {
        $response['message'] = 'Image Upload Failed: ' . $e->getMessage();
    }

    return $response;
}

function update_executive($executive_image, $executive_position, $executive_name, $id) {
    $response = array('status_code' => '1', 'message' => '');

    // Validate the ID exists before querying
    if (empty($id)) {
        return array('status_code' => '1', 'message' => 'Invalid ID');
    }

    // Retrieve the existing image URL from the database
    $query = $this->db->query("SELECT executive_image FROM executive WHERE id = ?", array($id))->row_array();

    if (!$query) {
        return array('status_code' => '1', 'message' => 'Record not found');
    }

    $old_image_url = $query['executive_image'];

    // Upload new image if provided
    if (!empty($executive_image)) {
        try {
            $upload = (new UploadApi())->upload($executive_image, ['folder' => 'executive_images']);
            $new_image_url = $upload['secure_url'];

            // Delete old image from Cloudinary if exists
            if (!empty($old_image_url)) {
                $public_id = pathinfo(parse_url($old_image_url, PHP_URL_PATH), PATHINFO_FILENAME);
                (new UploadApi())->destroy("executive_images/$public_id");
            }
        } catch (Exception $e) {
            return array('status_code' => '1', 'message' => 'Image Upload Failed: ' . $e->getMessage());
        }
    } else {
        $new_image_url = $old_image_url;
    }

    // Update the database
    $result = $this->db->query("UPDATE executive SET executive_image=?, executive_position=?, executive_name=? WHERE id=?", 
        array($new_image_url, $executive_position, $executive_name, $id));

    if ($this->db->affected_rows() == 1) {
        $response = array('status_code' => '0', 'message' => 'Executive Updated Successfully', 'image_url' => $new_image_url);
    } else {
        $response = array('status_code' => '1', 'message' => 'No changes made to the record.');
    }

    return $response;
}


function get_executive() {
    $response = array('status_code' => '1', 'message' => '');

    $result = $this->db->query("SELECT * FROM executive")->result_array();

    if (!empty($result)) {
        $response = array('status_code' => '0', 'message' => 'Executive retrieved successfully', "data" => $result);
    }

    return $response;
}
  
function delete_executive($id) {
    $response = array('status_code' => '1', 'message' => '');

    // Fetch the image URL from the database
    $query = $this->db->query("SELECT executive_image FROM executive WHERE id = $id")->row_array();
    $image_url = $query['executive_image'];

    if ($image_url) {
        // Extract public ID from the URL
        $public_id = pathinfo($image_url, PATHINFO_FILENAME);

        // Configure Cloudinary
        Configuration::instance([
            'cloud' => [
                'cloud_name' => $this->config->item('cloudinary')['cloud_name'],
                'api_key'    => $this->config->item('cloudinary')['api_key'],
                'api_secret' => $this->config->item('cloudinary')['api_secret']
            ],
            'url' => [
                'secure' => true
            ]
        ]);

        // Delete the image from Cloudinary
        (new UploadApi())->destroy("executive_images/$public_id");
    }

    // Delete the record from the database
    $result = $this->db->query("DELETE FROM executive WHERE id = $id");

    if ($this->db->affected_rows() > 0) {
        $response = array('status_code' => '0', 'message' => 'Executive deleted successfully');
    }

    return $response;
}

// ===== Legislative Arm =====

function save_honorable($honorable_image, $honorable_position, $honorable_name) {
    $response = array('status_code' => '1', 'message' => '');

    // Upload image to Cloudinary
    try {
        $upload = (new UploadApi())->upload($honorable_image, ["folder" => "honorable_images"]);

        // Get the URL of the uploaded image
        $image_url = $upload['secure_url'];

        // Save only the URL in MySQL
        $this->db->query("INSERT INTO legislative_arm (honorable_image, honorable_position, honorable_name) 
                          VALUES ('$image_url', '$honorable_position', '$honorable_name')");

        if ($this->db->affected_rows() == 1) {
            $response = array('status_code' => '0', 'message' => 'Honorable Saved Successfully');
        }
    } catch (Exception $e) {
        $response['message'] = 'Image Upload Failed: ' . $e->getMessage();
    }

    return $response;
}


function update_honorable($honorable_image, $honorable_position, $honorable_name, $id) {
    $response = array('status_code' => '1', 'message' => '');

    // Validate the ID exists before querying
    if (empty($id)) {
        return array('status_code' => '1', 'message' => 'Invalid ID');
    }

    // Retrieve the existing image URL from the database
    $query = $this->db->query("SELECT honorable_image FROM legislative_arm WHERE id = ?", array($id))->row_array();

    if (!$query) {
        return array('status_code' => '1', 'message' => 'Record not found');
    }

    $old_image_url = $query['honorable_image'];

    // Upload new image if provided
    if (!empty($honorable_image)) {
        try {
            $upload = (new UploadApi())->upload($honorable_image, ['folder' => 'honorable_images']);
            $new_image_url = $upload['secure_url'];

            // Delete old image from Cloudinary if exists
            if (!empty($old_image_url)) {
                $public_id = pathinfo(parse_url($old_image_url, PHP_URL_PATH), PATHINFO_FILENAME);
                (new UploadApi())->destroy("honorable_images/$public_id");
            }
        } catch (Exception $e) {
            return array('status_code' => '1', 'message' => 'Image Upload Failed: ' . $e->getMessage());
        }
    } else {
        $new_image_url = $old_image_url;
    }

    // Update the database
    $result = $this->db->query("UPDATE legislative_arm SET honorable_image=?, honorable_position=?, honorable_name=? WHERE id=?", 
        array($new_image_url, $honorable_position, $honorable_name, $id));

    if ($this->db->affected_rows() == 1) {
        $response = array('status_code' => '0', 'message' => 'Honorable Updated Successfully', 'image_url' => $new_image_url);
    } else {
        $response = array('status_code' => '1', 'message' => 'No changes made to the record.');
    }

    return $response;
}


function get_honorable() {
    $response = array('status_code' => '1', 'message' => '');

    $result = $this->db->query("SELECT * FROM legislative_arm")->result_array();

    if (!empty($result)) {
        $response = array('status_code' => '0', 'message' => 'Honorables retrieved successfully', "data" => $result);
    }

    return $response;
}

function delete_honorable($id) {
    $response = array('status_code' => '1', 'message' => '');

    // Fetch the image URL from the database
    $query = $this->db->query("SELECT honorable_image FROM legislative_arm WHERE id = $id")->row_array();
    $image_url = $query['honorable_image'];

    if ($image_url) {
        // Extract public ID from the URL
        $public_id = pathinfo($image_url, PATHINFO_FILENAME);

        // Configure Cloudinary
        Configuration::instance([
            'cloud' => [
                'cloud_name' => $this->config->item('cloudinary')['cloud_name'],
                'api_key'    => $this->config->item('cloudinary')['api_key'],
                'api_secret' => $this->config->item('cloudinary')['api_secret']
            ],
            'url' => [
                'secure' => true
            ]
        ]);

        // Delete the image from Cloudinary
        (new UploadApi())->destroy("honorable_images/$public_id");
    }

    // Delete the record from the database
    $result = $this->db->query("DELETE FROM legislative_arm WHERE id = $id");

    if ($this->db->affected_rows() > 0) {
        $response = array('status_code' => '0', 'message' => 'Honorable deleted successfully');
    }

    return $response;
}


// ======= Management Team ======

function save_staff($staff_image, $staff_position, $staff_name) {
    $response = array('status_code' => '1', 'message' => '');

    // Upload image to Cloudinary
    try {
        $upload = (new UploadApi())->upload($staff_image, ["folder" => "staff_images"]);

        // Get the URL of the uploaded image
        $image_url = $upload['secure_url'];

        // Save only the URL in MySQL
        $this->db->query("INSERT INTO management_staff (staff_image, staff_position, staff_name) 
                          VALUES ('$image_url', '$staff_position', '$staff_name')");

        if ($this->db->affected_rows() == 1) {
            $response = array('status_code' => '0', 'message' => 'Staff Saved Successfully');
        }
    } catch (Exception $e) {
        $response['message'] = 'Image Upload Failed: ' . $e->getMessage();
    }

    return $response;
}

function update_staff($staff_image, $staff_position, $staff_name, $id) {
    $response = array('status_code' => '1', 'message' => '');

    // Validate the ID exists before querying
    if (empty($id)) {
        return array('status_code' => '1', 'message' => 'Invalid ID');
    }

    // Retrieve the existing image URL from the database
    $query = $this->db->query("SELECT staff_image FROM management_staff WHERE id = ?", array($id))->row_array();

    if (!$query) {
        return array('status_code' => '1', 'message' => 'Record not found');
    }

    $old_image_url = $query['staff_image'];

    // Upload new image if provided
    if (!empty($staff_image)) {
        try {
            $upload = (new UploadApi())->upload($staff_image, ['folder' => 'staff_images']);
            $new_image_url = $upload['secure_url'];

            // Delete old image from Cloudinary if exists
            if (!empty($old_image_url)) {
                $public_id = pathinfo(parse_url($old_image_url, PHP_URL_PATH), PATHINFO_FILENAME);
                (new UploadApi())->destroy("staff_images/$public_id");
            }
        } catch (Exception $e) {
            return array('status_code' => '1', 'message' => 'Image Upload Failed: ' . $e->getMessage());
        }
    } else {
        $new_image_url = $old_image_url;
    }

    // Update the database
    $result = $this->db->query("UPDATE management_staff SET staff_image=?, staff_position=?, staff_name=? WHERE id=?", 
        array($new_image_url, $staff_position, $staff_name, $id));

    if ($this->db->affected_rows() == 1) {
        $response = array('status_code' => '0', 'message' => 'Staff Updated Successfully', 'image_url' => $new_image_url);
    } else {
        $response = array('status_code' => '1', 'message' => 'No changes made to the record.');
    }

    return $response;
}


function get_staff() {
    $response = array('status_code' => '1', 'message' => '');

    $result = $this->db->query("SELECT * FROM management_staff")->result_array();

    if (!empty($result)) {
        $response = array('status_code' => '0', 'message' => 'Staff retrieved successfully', "data" => $result);
    }

    return $response;
}
  
function delete_staff($id) {
    $response = array('status_code' => '1', 'message' => '');

    // Fetch the image URL from the database
    $query = $this->db->query("SELECT staff_image FROM management_staff WHERE id = $id")->row_array();
    $image_url = $query['staff_image'];

    if ($image_url) {
        // Extract public ID from the URL
        $public_id = pathinfo($image_url, PATHINFO_FILENAME);

        // Configure Cloudinary
        Configuration::instance([
            'cloud' => [
                'cloud_name' => $this->config->item('cloudinary')['cloud_name'],
                'api_key'    => $this->config->item('cloudinary')['api_key'],
                'api_secret' => $this->config->item('cloudinary')['api_secret']
            ],
            'url' => [
                'secure' => true
            ]
        ]);

        // Delete the image from Cloudinary
        (new UploadApi())->destroy("staff_images/$public_id");
    }

    // Delete the record from the database
    $result = $this->db->query("DELETE FROM management_staff WHERE id = $id");

    if ($this->db->affected_rows() > 0) {
        $response = array('status_code' => '0', 'message' => 'Executive deleted successfully');
    }

    return $response;
}



  // ======= Hero =======


function save_hero($hero_image, $hero_text) {
    $response = array('status_code' => '1', 'message' => '');

    // Upload image to Cloudinary
    try {
        $upload = (new UploadApi())->upload($hero_image, ["folder" => "hero_images"]);

        // Get the URL of the uploaded image
        $image_url = $upload['secure_url'];

        // Save only the URL in MySQL
        $this->db->query("INSERT INTO hero (hero_image, hero_text) 
                          VALUES ('$image_url', '$hero_text')");

        if ($this->db->affected_rows() == 1) {
            $response = array('status_code' => '0', 'message' => 'Hero Saved Successfully');
        }
    } catch (Exception $e) {
        $response['message'] = 'Image Upload Failed: ' . $e->getMessage();
    }

    return $response;
}


  function update_hero($hero_image, $hero_text,$id) {
    $response = array('status_code' => '1', 'message' => '');

    // Validate the ID exists before querying
    if (empty($id)) {
        return array('status_code' => '1', 'message' => 'Invalid ID');
    }

    // Retrieve the existing image URL from the database
    $query = $this->db->query("SELECT hero_image FROM hero WHERE id = ?", array($id))->row_array();

    if (!$query) {
        return array('status_code' => '1', 'message' => 'Record not found');
    }

    $old_image_url = $query['hero_image'];

    // Upload new image if provided
    if (!empty($hero_image)) {
        try {
            $upload = (new UploadApi())->upload($hero_image, ['folder' => 'hero_images']);
            $new_image_url = $upload['secure_url'];

            // Delete old image from Cloudinary if exists
            if (!empty($old_image_url)) {
                $public_id = pathinfo(parse_url($old_image_url, PHP_URL_PATH), PATHINFO_FILENAME);
                (new UploadApi())->destroy("hero_images/$public_id");
            }
        } catch (Exception $e) {
            return array('status_code' => '1', 'message' => 'Image Upload Failed: ' . $e->getMessage());
        }
    } else {
        $new_image_url = $old_image_url;
    }

    // Update the database
    $result = $this->db->query("UPDATE hero SET hero_image=?, hero_text=? WHERE id=?", 
        array($new_image_url, $hero_text, $id));

    if ($this->db->affected_rows() == 1) {
        $response = array('status_code' => '0', 'message' => 'Hero Updated Successfully', 'image_url' => $new_image_url);
    } else {
        $response = array('status_code' => '1', 'message' => 'No changes made to the record.');
    }

    return $response;
}


function get_hero(){
    $response = array('status_code' => '1' , 'message' => '');
   
    $result = $this->db->query("Select * from hero")->result_array();
   
    if (sizeof($result) > 0 ){
      $response =  array('status_code' =>  '0' ,'message' =>'Hero updated Successful', "data" => $result ); 
    }
   return $response;
  }

function delete_hero($id) {
    $response = array('status_code' => '1', 'message' => '');

    // Fetch the image URL from the database
    $query = $this->db->query("SELECT hero_image FROM hero WHERE id = $id")->row_array();
    $image_url = $query['hero_image'];

    if ($image_url) {
        // Extract public ID from the URL
        $public_id = pathinfo($image_url, PATHINFO_FILENAME);

        // Configure Cloudinary
        Configuration::instance([
            'cloud' => [
                'cloud_name' => $this->config->item('cloudinary')['cloud_name'],
                'api_key'    => $this->config->item('cloudinary')['api_key'],
                'api_secret' => $this->config->item('cloudinary')['api_secret']
            ],
            'url' => [
                'secure' => true
            ]
        ]);

        // Delete the image from Cloudinary
        (new UploadApi())->destroy("hero_images/$public_id");
    }

    // Delete the record from the database
    $result = $this->db->query("DELETE FROM hero WHERE id = $id");

    if ($this->db->affected_rows() > 0) {
        $response = array('status_code' => '0', 'message' => 'Hero deleted successfully');
    }

    return $response;
}





// ======= News =======


  function save_news($news_image, $news_heading, $news_content) {
    $response = array('status_code' => '1', 'message' => '');

    // Upload image to Cloudinary
    try {
        $upload = (new UploadApi())->upload($news_image, ["folder" => "news_images"]);

        // Get the URL of the uploaded image
        $image_url = $upload['secure_url'];

        // Save only the URL in MySQL
        $this->db->query("INSERT INTO news (news_image, news_heading, news_content) 
                          VALUES ('$image_url', '$news_heading', '$news_content')");

        if ($this->db->affected_rows() == 1) {
            $response = array('status_code' => '0', 'message' => 'News Saved Successfully');
        }
    } catch (Exception $e) {
        $response['message'] = 'Image Upload Failed: ' . $e->getMessage();
    }

    return $response;
}

  
  function update_news($news_image, $news_heading, $news_content, $id) {
    $response = array('status_code' => '1', 'message' => '');

    // Validate the ID exists before querying
    if (empty($id)) {
        return array('status_code' => '1', 'message' => 'Invalid ID');
    }

    // Retrieve the existing image URL from the database
    $query = $this->db->query("SELECT news_image FROM news WHERE id = ?", array($id))->row_array();

    if (!$query) {
        return array('status_code' => '1', 'message' => 'Record not found');
    }

    $old_image_url = $query['news_image'];

    // Upload new image if provided
    if (!empty($news_image)) {
        try {
            $upload = (new UploadApi())->upload($news_image, ['folder' => 'news_images']);
            $new_image_url = $upload['secure_url'];

            // Delete old image from Cloudinary if exists
            if (!empty($old_image_url)) {
                $public_id = pathinfo(parse_url($old_image_url, PHP_URL_PATH), PATHINFO_FILENAME);
                (new UploadApi())->destroy("news_images/$public_id");
            }
        } catch (Exception $e) {
            return array('status_code' => '1', 'message' => 'Image Upload Failed: ' . $e->getMessage());
        }
    } else {
        $new_image_url = $old_image_url;
    }

    // Update the database
    $result = $this->db->query("UPDATE news SET news_image=?, news_heading=?, news_content=? WHERE id=?", 
        array($new_image_url, $news_heading, $news_content, $id));

    if ($this->db->affected_rows() == 1) {
        $response = array('status_code' => '0', 'message' => 'News Updated Successfully', 'image_url' => $new_image_url);
    } else {
        $response = array('status_code' => '1', 'message' => 'No changes made to the record.');
    }

    return $response;
}

function get_news(){
    $response = array('status_code' => '1' , 'message' => '');
   
    $result = $this->db->query("Select * from news")->result_array();
   
    if (sizeof($result) > 0 ){
      $response =  array('status_code' =>  '0' ,'message' =>'News updated Successful', "data" => $result ); 
    }
   return $response;
  }

  function delete_news($id) {
    $response = array('status_code' => '1', 'message' => '');

    // Fetch the image URL from the database
    $query = $this->db->query("SELECT news_image FROM news WHERE id = $id")->row_array();
    $image_url = $query['news_image'];

    if ($image_url) {
        // Extract public ID from the URL
        $public_id = pathinfo($image_url, PATHINFO_FILENAME);

        // Configure Cloudinary
        Configuration::instance([
            'cloud' => [
                'cloud_name' => $this->config->item('cloudinary')['cloud_name'],
                'api_key'    => $this->config->item('cloudinary')['api_key'],
                'api_secret' => $this->config->item('cloudinary')['api_secret']
            ],
            'url' => [
                'secure' => true
            ]
        ]);

        // Delete the image from Cloudinary
        (new UploadApi())->destroy("news_images/$public_id");
    }

    // Delete the record from the database
    $result = $this->db->query("DELETE FROM news WHERE id = $id");

    if ($this->db->affected_rows() > 0) {
        $response = array('status_code' => '0', 'message' => 'News deleted successfully');
    }

    return $response;
}



// ======= Achievement =======


function save_achievement($achievement_image) {
    $response = array('status_code' => '1', 'message' => '');

    // Upload image to Cloudinary
    try {
        $upload = (new UploadApi())->upload($achievement_image, ["folder" => "achievements_images"]);

        // Get the URL of the uploaded image
        $image_url = $upload['secure_url'];

        // Save only the URL in MySQL
        $this->db->query("INSERT INTO achievements (achievement_image ) 
                          VALUES ('$image_url')");

        if ($this->db->affected_rows() == 1) {
            $response = array('status_code' => '0', 'message' => 'Achievement Saved Successfully');
        }
    } catch (Exception $e) {
        $response['message'] = 'Image Upload Failed: ' . $e->getMessage();
    }

    return $response;
}

  
  function update_achievement($achievement_image, $id) {
    $response = array('status_code' => '1', 'message' => '');

    // Validate the ID exists before querying
    if (empty($id)) {
        return array('status_code' => '1', 'message' => 'Invalid ID');
    }

    // Retrieve the existing image URL from the database
    $query = $this->db->query("SELECT achievement_image FROM achievements WHERE id = ?", array($id))->row_array();

    if (!$query) {
        return array('status_code' => '1', 'message' => 'Record not found');
    }

    $old_image_url = $query['achievement_image'];

    // Upload new image if provided
    if (!empty($achievement_image)) {
        try {
            $upload = (new UploadApi())->upload($achievement_image, ['folder' => 'achievements_images']);
            $new_image_url = $upload['secure_url'];

            // Delete old image from Cloudinary if exists
            if (!empty($old_image_url)) {
                $public_id = pathinfo(parse_url($old_image_url, PHP_URL_PATH), PATHINFO_FILENAME);
                (new UploadApi())->destroy("achievements_images/$public_id");
            }
        } catch (Exception $e) {
            return array('status_code' => '1', 'message' => 'Image Upload Failed: ' . $e->getMessage());
        }
    } else {
        $new_image_url = $old_image_url;
    }

    // Update the database
    $result = $this->db->query("UPDATE achievements SET achievement_image=? WHERE id=?", 
        array($new_image_url, $id));

    if ($this->db->affected_rows() == 1) {
        $response = array('status_code' => '0', 'message' => 'Achievement Updated Successfully', 'image_url' => $new_image_url);
    } else {
        $response = array('status_code' => '1', 'message' => 'No changes made to the record.');
    }

    return $response;
}

function get_achievements(){
    $response = array('status_code' => '1' , 'message' => '');
   
    $result = $this->db->query("Select * from achievements")->result_array();
   
    if (sizeof($result) > 0 ){
      $response =  array('status_code' =>  '0' ,'message' =>'Achievements updated Successful', "data" => $result ); 
    }
   return $response;
  }

function delete_achievement($id) {
    $response = array('status_code' => '1', 'message' => '');

    // Fetch the image URL from the database
    $query = $this->db->query("SELECT achievement_image FROM achievements WHERE id = $id")->row_array();
    $image_url = $query['achievement_image'];

    if ($image_url) {
        // Extract public ID from the URL
        $public_id = pathinfo($image_url, PATHINFO_FILENAME);

        // Configure Cloudinary
        Configuration::instance([
            'cloud' => [
                'cloud_name' => $this->config->item('cloudinary')['cloud_name'],
                'api_key'    => $this->config->item('cloudinary')['api_key'],
                'api_secret' => $this->config->item('cloudinary')['api_secret']
            ],
            'url' => [
                'secure' => true
            ]
        ]);

        // Delete the image from Cloudinary
        (new UploadApi())->destroy("achievements_images/$public_id");
    }

    // Delete the record from the database
    $result = $this->db->query("DELETE FROM achievements WHERE id = $id");

    if ($this->db->affected_rows() > 0) {
        $response = array('status_code' => '0', 'message' => 'Achievement deleted successfully');
    }

    return $response;
}


// ======= Heeds Agenda =======


function save_heeds_agenda($heeds_image) {
    $response = array('status_code' => '1', 'message' => '');

    // Upload image to Cloudinary
    try {
        $upload = (new UploadApi())->upload($heeds_image, ["folder" => "heeds_images"]);

        // Get the URL of the uploaded image
        $image_url = $upload['secure_url'];

        // Save only the URL in MySQL
        $this->db->query("INSERT INTO heeds_agenda (heeds_image ) 
                          VALUES ('$image_url')");

        if ($this->db->affected_rows() == 1) {
            $response = array('status_code' => '0', 'message' => 'Heeds Agenda Saved Successfully');
        }
    } catch (Exception $e) {
        $response['message'] = 'Image Upload Failed: ' . $e->getMessage();
    }

    return $response;
}

  
  function update_heeds_agenda($heeds_image, $id) {
    $response = array('status_code' => '1', 'message' => '');

    // Validate the ID exists before querying
    if (empty($id)) {
        return array('status_code' => '1', 'message' => 'Invalid ID');
    }

    // Retrieve the existing image URL from the database
    $query = $this->db->query("SELECT heeds_image FROM heeds_agenda WHERE id = ?", array($id))->row_array();

    if (!$query) {
        return array('status_code' => '1', 'message' => 'Record not found');
    }

    $old_image_url = $query['heeds_image'];

    // Upload new image if provided
    if (!empty($heeds_image)) {
        try {
            $upload = (new UploadApi())->upload($heeds_image, ['folder' => 'heeds_images']);
            $new_image_url = $upload['secure_url'];

            // Delete old image from Cloudinary if exists
            if (!empty($old_image_url)) {
                $public_id = pathinfo(parse_url($old_image_url, PHP_URL_PATH), PATHINFO_FILENAME);
                (new UploadApi())->destroy("heeds_images/$public_id");
            }
        } catch (Exception $e) {
            return array('status_code' => '1', 'message' => 'Image Upload Failed: ' . $e->getMessage());
        }
    } else {
        $new_image_url = $old_image_url;
    }

    // Update the database
    $result = $this->db->query("UPDATE heeds_agenda SET heeds_image=? WHERE id=?", 
        array($new_image_url, $id));

    if ($this->db->affected_rows() == 1) {
        $response = array('status_code' => '0', 'message' => 'Heeds Agenda Updated Successfully', 'image_url' => $new_image_url);
    } else {
        $response = array('status_code' => '1', 'message' => 'No changes made to the record.');
    }

    return $response;
}

function get_heeds_agenda(){
    $response = array('status_code' => '1' , 'message' => '');
   
    $result = $this->db->query("Select * from heeds_agenda")->result_array();
   
    if (sizeof($result) > 0 ){
      $response =  array('status_code' =>  '0' ,'message' =>'Heeds Agenda updated Successful', "data" => $result ); 
    }
   return $response;
  }

function delete_heeds_agenda($id) {
    $response = array('status_code' => '1', 'message' => '');

    // Fetch the image URL from the database
    $query = $this->db->query("SELECT heeds_image FROM heeds_agenda WHERE id = $id")->row_array();
    $image_url = $query['heeds_image'];

    if ($image_url) {
        // Extract public ID from the URL
        $public_id = pathinfo($image_url, PATHINFO_FILENAME);

        // Configure Cloudinary
        Configuration::instance([
            'cloud' => [
                'cloud_name' => $this->config->item('cloudinary')['cloud_name'],
                'api_key'    => $this->config->item('cloudinary')['api_key'],
                'api_secret' => $this->config->item('cloudinary')['api_secret']
            ],
            'url' => [
                'secure' => true
            ]
        ]);

        // Delete the image from Cloudinary
        (new UploadApi())->destroy("heeds_images/$public_id");
    }

    // Delete the record from the database
    $result = $this->db->query("DELETE FROM heeds_agenda WHERE id = $id");

    if ($this->db->affected_rows() > 0) {
        $response = array('status_code' => '0', 'message' => 'Heeds Agenda deleted successfully');
    }

    return $response;
}



// ======= Our Services =======


function save_service($facility_location, $facility_address,$facility_type,$phone_number,$email){
    $response = array('status_code' => '1' , 'message' => '');
    
    $result = $this->db->query("insert into our_services (facility_location,facility_address,facility_type,phone_number,email)values ('$facility_location','$facility_address','$facility_type,$phone_number,$email')");
    if ($this->db->affected_rows() == 1){
      $response =  array('status_code' =>  '0' ,'message' =>'Service Saved Successful'); 
    }
   return $response;
  }

  function update_service($facility_location, $facility_address,$facility_type,$phone_number,$email,$id){
    $response = array('status_code' => '1' , 'message' => '');
   
    $result = $this->db->query("update our_services set facility_location='$facility_location',facility_address='$facility_address',facility_type,='$facility_type',phone_number='$phone_number',email='$email' where id=$id");
   
    if ($this->db->affected_rows() == 1){
      $response =  array('status_code' =>  '0' ,'message' =>'Service updated Successful'); 
    }
   return $response;
  }
function get_services(){
    $response = array('status_code' => '1' , 'message' => '');
   
    $result = $this->db->query("Select * from our_services")->result_array();
   
    if (sizeof($result) > 0 ){
      $response =  array('status_code' =>  '0' ,'message' =>'Service updated Successful', "data" => $result ); 
    }
   return $response;
  }

  function delete_service($id){
    $response = array('status_code' => '1' , 'message' => '');
   
    $result = $this->db->query("delete from our_services  where id=$id");
   
    if ($this->db->affected_rows() > 0){
      $response =  array('status_code' =>  '0' ,'message' =>'chairman deleted Successful'); 
    }
   return $response;
  }


// ======= Reports =======


function save_report($reporter_address, $report_category,$report,$phone_number){
    $response = array('status_code' => '1' , 'message' => '');
    
    $result = $this->db->query("insert into reports (reporter_address,report_category,report,phone_number)values ('$reporter_address','$report_category','$report,$phone_number')");
    if ($this->db->affected_rows() == 1){
      $response =  array('status_code' =>  '0' ,'message' =>'Report Saved Successful'); 
    }
   return $response;
  }

  function update_report($reporter_address, $report_category,$report,$phone_number,$id){
    $response = array('status_code' => '1' , 'message' => '');
   
    $result = $this->db->query("update reports set reporter_address='$reporter_address',report_category='$report_category',report,='$report',phone_number='$phone_number',email='$email' where id=$id");
   
    if ($this->db->affected_rows() == 1){
      $response =  array('status_code' =>  '0' ,'message' =>'Report updated Successful'); 
    }
   return $response;
  }
function get_reports(){
    $response = array('status_code' => '1' , 'message' => '');
   
    $result = $this->db->query("Select * from reports")->result_array();
   
    if (sizeof($result) > 0 ){
      $response =  array('status_code' =>  '0' ,'message' =>'Report updated Successful', "data" => $result ); 
    }
   return $response;
  }

  function delete_report($id){
    $response = array('status_code' => '1' , 'message' => '');
   
    $result = $this->db->query("delete from reports  where id=$id");
   
    if ($this->db->affected_rows() > 0){
      $response =  array('status_code' =>  '0' ,'message' =>'Report deleted Successful'); 
    }
   return $response;
  }




// ==================================================================
  function save_details_ep($phone, $fname,$lname,$email,$password){
    $response = array('status' => false , 'response_code' => '1');
    $dt = date('Y-m-d H:i:s');
    $password = sha1($password);
    $result = $this->db->query("insert into user_whitelists (fname,lname,email,phone_number,password,inserted_dt)values ('$fname','$lname','$email','$phone','    $password','$dt')");
    if ($this->db->affected_rows()  == 1){
      $response =  array('status' =>  true , 'response_code' => '0','message' =>'Saved Successful'); 
    }
   return $response;
  }
  function auth_ep($email , $password){
    $response =  array('status' => false , 'response_code' => '1');
    $password = sha1($password);
    $result = $this->db->query("select email, fname, lname  from user_whitelists where email = '$email' and password = '$password'")->result_array();
    if (sizeof($result) > 0){
      $response = array('status' =>  true , 'response_code' => '0','details' => $result);  
    }
   return $response;
  }
  
   function get_client_type($client_type){
    $response = "";
    $client_type = $this->db->query("select client_type  from user_accounts where client_type ='$client_type'")->result_array();
    if (sizeof($client_type) > 0 ){
      $response =  $client_type[0]['client_type'];
    }
    return $response;
  } 
 
//===========Service Charges ============================================

function is_client_exist($client_id, $key){
  $response =  FALSE;
  $result = $this->db->query("select count(*) cnt from user_accounts where client_id = '$client_id' and x_api_key ='$key'")->row(0)->cnt;
  if ($result > 0){
    $response = TRUE;
  }
 return $response;
}

function random_id($maxlength = 17) {
  $chary = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
  $return_str = "";
  for ( $x=0; $x<=$maxlength; $x++ ) {
      $return_str .= $chary[rand(0, count($chary)-1)];
  }
  return $return_str;
}
function get_date_1(){
 return date('YmdHis');
}
function get_date_2(){
  return date('YmdHis');
 }
function get_operation_id($type){
  $value =  'QT-'.$this->get_date_1();
  if($type == "NU"){
    $value = $value.$this->random_number(10);
  }elseif($type == "AN"){
    $value = $value.$this->random_alphanumeric(10);
  }elseIf($type == "AL"){
    $value = $value.$this->random_alphabet(10);
  }
  return $value;
}

function random_alphanumeric($maxlength = 17) {
  $chary = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z",
                  "0", "1", "2", "3", "4", "5", "6", "7", "8", "9",
                  "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N" , "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
  $return_str = "";
  for ( $x=0; $x<=$maxlength; $x++ ) {
      $return_str .= $chary[rand(0, count($chary)-1)];
  }
  return $return_str;
}

function random_alphabet($maxlength = 17) {
$chary = array("a", "b", "c", "d", "e", "f", "g", "h", "i", "j", "k", "l", "m", "n", "o", "p", "q", "r", "s", "t", "u", "v", "w", "x", "y", "z",
               "A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N" , "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");
$return_str = "";
for ( $x=0; $x<=$maxlength; $x++ ) {
    $return_str .= $chary[rand(0, count($chary)-1)];
}
return $return_str;
}

function random_number($maxlength = 17) {
$chary = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9");
$return_str = "";
for ( $x=0; $x<=$maxlength; $x++ ) {
    $return_str .= $chary[rand(0, count($chary)-1)];
}
return $return_str;
}

   // Method: POST, PUT, GET etc
 // Data: array("param" => "value") ==> index.php?param=value
function call_api($method, $url, $header , $data = false){
    $curl = curl_init();
    // return $data;
    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, true);
            if ($data){
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            }
            break;
        case "Q_POST":
            curl_setopt($curl, CURLOPT_POST, true);
            if ($data){
                $data = http_build_query($data);
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            }
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
        //https://engageapi.armpension.com:8444/api/signupclients/getpin?pin=08084810208 : use for the below format request uri
        //    if ($data)
        //       $url = sprintf("%s?%s", $url, http_build_query($data));
       
        if ($data)
         $url = $url."/$data";
    }
    //return $url;

    // Optional Authentication:
    // curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    //curl_setopt($curl, CURLOPT_USERPWD, "username:password");
    //$header= array();
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
  /*  if($content_type == 'ENCODED' ){
    $header = $header;
    }elseif($content_type == 'JSON' ){
     $header = $header; 
    }
   */// $header = array("Content-Type: application/x-www-form-urlencoded",
    //"token: ". TOKEN);
    //URLOPT_POSTFIELDS => "SUBMITTED_DATE=2018-11-14%2019%3A33%3A03&STATUS=2"
    curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
     $response = "cURL Error #:" . $err;
   } else {
     $response = $result;
   } 

    return $response;
}




function call_api_a($method, $url, $header , $data = false){
  $curl = curl_init();
  // return $data;
  switch ($method)
  {
      case "POST":
          curl_setopt($curl, CURLOPT_POST, true);
          if ($data){
              curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
          }
          break;
      case "Q_POST":
          curl_setopt($curl, CURLOPT_POST, true);
          if ($data){
              $data = http_build_query($data);
              curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
          }
          break;
      case "PUT":
          curl_setopt($curl, CURLOPT_PUT, 1);
          break;
      default:
      //https://engageapi.armpension.com:8444/api/signupclients/getpin?pin=08084810208 : use for the below format request uri
      //    if ($data)
      //       $url = sprintf("%s?%s", $url, http_build_query($data));
     
      if ($data)
       $url = $url."/$data";
  }
  //return $url;

  // Optional Authentication:
  // curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
  //curl_setopt($curl, CURLOPT_USERPWD, "username:password");
  //$header= array();
  curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
/*  if($content_type == 'ENCODED' ){
  $header = $header;
  }elseif($content_type == 'JSON' ){
   $header = $header; 
  }
 */// $header = array("Content-Type: application/x-www-form-urlencoded",
  //"token: ". TOKEN);
  //URLOPT_POSTFIELDS => "SUBMITTED_DATE=2018-11-14%2019%3A33%3A03&STATUS=2"
  curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
  curl_setopt($curl, CURLOPT_URL, $url);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

  $result = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);

  if ($err) {
   $response = "cURL Error #:" . $err;
 } else {
   $response = $result;
 } 

  return $response;
}

}
