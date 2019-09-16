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
                      $this->session->sess_expiration = '32140800'; //~ one year
                      $this->session->sess_expire_on_close = 'false';
                      $session_data=$this->session->set_userdata($data);


                      break;
                    case "Inactive":
           					$data= array("status"=>"Deactive","msg"=>"Your Account Is De-Activated");
           					return $data;
                      break;
                  }

                  $data = array("user_name" => $rows->user_name,"msg"  =>"success","phonenumber"=>$rows->phone_number,"status"=>"success","email"=>$rows->email,"role_type_id"=>$rows->role_type_id,"id"=>$rows->id);
                  $this->session->sess_expiration = '32140800'; //~ one year
                  $this->session->sess_expire_on_close = 'false';
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
   function checkemail($email,$user_id){
     $select="SELECT * FROM admin_details WHERE email='$email' AND id!='$user_id'";
     $res=$this->db->query($select);
    if($res->num_rows()>0){
      echo "false";
    }else{
      echo "true";
    }
   }
   function checkphone($phone_number,$user_id){
     $select="SELECT * FROM admin_details WHERE phone_number='$phone_number' AND id!='$user_id'";
     $res=$this->db->query($select);
    if($res->num_rows()>0){
      echo "false";
    }else{
      echo "true";
    }
   }

   function updateprofile($email,$phone_number,$name,$user_id){
     if(empty($email)){

     }else{
       $select="UPDATE admin_details SET email='$email',name='$name',phone_number='$phone_number',updated_at=NOW(),updated_by='$user_id' WHERE id='$user_id'";
       $res=$this->db->query($select);
      if($res){
        echo "success";
      }else{
        echo "failed";
      }
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


   function get_admin_details($user_id){
     $select="SELECT rm.*,ad.* FROM admin_details AS ad LEFT JOIN role_masters AS rm ON rm.id=ad.role_type_id WHERE ad.id='$user_id'";
     $res=$this->db->query($select);
      return $res->result();
   }



   function resetpassword($email){
     function randomPassword() {
      $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
      $pass = array();
      $alphaLength = strlen($alphabet) - 1;
      for ($i = 0; $i < 8; $i++) {
          $n = rand(0, $alphaLength);
          $pass[] = $alphabet[$n];
      }
      return implode($pass);
    }
     $newPassword=randomPassword();
     $update_password=md5($newPassword);
     $select="SELECT * FROM admin_details WHERE email='$email'";

     $res=$this->db->query($select);
     if($res->num_rows()==1){
       $select="UPDATE admin_details SET password='$update_password',updated_at=NOW() WHERE email='$email'";
       $res=$this->db->query($select);
       $to=$email;
        $subject="Reset Password";
        $htmlContent = '
         <html>
         <head>
         <title>Reset Password</title>
            </head>
            <body>
            <p style="margin-left:20px;">Password has been Reset Successfully.Please use this password to login <a href="">'.$newPassword.'</a></p>
            </body>
         </html>';
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        // Additional headers
        $headers .= 'From:Admin <admin@littleamore.com>' . "\r\n";
        $sent= mail($to,$subject,$htmlContent,$headers);
        if($sent){
          echo "success";
      }else{
        echo "Something Went Wrong";
      }
    }else{
      echo "Email  id is not found!!";
    }
   }








}
