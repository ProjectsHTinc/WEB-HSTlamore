<?php

Class Loginmodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }

 function login($username,$password)
  {
    $query = "SELECT * FROM admin_details WHERE user_name='$username' OR email='$username' ";

    $resultset=$this->db->query($query);
    $resultset->num_rows();

    if($resultset->num_rows()==1)
      {
         $pwdcheck="SELECT * FROM admin_details WHERE password='$password' AND (user_name='$username'  OR email='$username')";
          $res=$this->db->query($pwdcheck);
           $res->num_rows();

          if($res->num_rows()==1)
	        {
              foreach($res->result() as $rows)
               {

                 $quer="SELECT status FROM admin_details WHERE id='$rows->id'";
                 $resultset=$this->db->query($quer);
                 $status=$rows->status;
                 switch($status)
                 {
                    case "Active":


                      $data = array("user_name" => $rows->user_name,"msg"  =>"success","phonenumber"=>$rows->phone_number,"status"=>"success","email"=>$rows->email,"role_type_id"=>$rows->role_type_id,"id"=>$rows->id);
                      $session_data=$this->session->set_userdata($data);


                      break;
                    case "Inactive":
           					$data= array("status"=>"Deactive","msg"=>"Your Account Is De-Activated");
           					return $data;
                      break;
                  }

                  $data = array("user_name" => $rows->user_name,"msg"  =>"success","phonenumber"=>$rows->phone_number,"status"=>"success","email"=>$rows->email,"role_type_id"=>$rows->role_type_id,"id"=>$rows->id);

   	            $this->session->set_userdata($data);
   	            return $data;
               }
         }else{
            $data= array("status" => "Wrong Password","msg" => "Password Wrong");
            return $data;
           }
      }else{
            $data= array("status" => "Invalid Username","msg" => "invalid Username");
            return $data;
         }
   }


   function checkpassword($password,$user_id){
     $select="SELECT * FROM admin_details WHERE password='$password' AND id='$user_id'";
     $res=$this->db->query($select);
    if($res->num_rows()==0){
      echo "false";
    }else{
      echo "true";
    }
   }


   function updatepassword($password,$user_id){
     if(empty($password)){

     }else{
       $select="UPDATE admin_details SET password='$password',updated_at=NOW(),updated_by='$user_id' WHERE id='$user_id'";
       $res=$this->db->query($select);
      if($res){
        echo "success";
      }else{
        echo "failed";
      }
     }
   }








}
