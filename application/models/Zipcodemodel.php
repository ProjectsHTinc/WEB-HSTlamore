<?php

Class Zipcodemodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }



   function create_zip_code($zip_code,$zip_desc,$zip_status,$user_id){
    if(empty($zip_code)){

    }else{
      $select="SELECT * FROM zipcode_masters WHERE zip_code='$zip_code'";
      $res=$this->db->query($select);
      if($res->num_rows()>0){
       echo "Already Exist";
     }else{
       $insert_query="INSERT INTO zipcode_masters (zip_code,zip_desc,status,created_at,created_by) VALUES('$zip_code','$zip_desc','$zip_status',NOW(),'$user_id')";
       $res=$this->db->query($insert_query);
       if($res){
               echo "success";
            }else{
               echo "failed";
            }
     }

    }
   }
   function check_zip_code($zip_code,$user_id){
     $select="SELECT * FROM zipcode_masters WHERE zip_code='$zip_code'";
     $res=$this->db->query($select);
    if($res->num_rows()>0){
      echo "false";
    }else{
      echo "true";
    }
   }

  function  check_zip_exist($zip_id,$zip_code,$user_id){
    $id=base64_decode($zip_id)/9876;
    $select="SELECT * FROM zipcode_masters WHERE zip_code='$zip_code' AND id!='$id'";
    $res=$this->db->query($select);
    if($res->num_rows()>0){
      echo "false";
    }else{
      echo "true";
    }
   }

   function get_all_zipcode(){
     $select="SELECT * FROM zipcode_masters";
     $res=$this->db->query($select);
      return $res->result();
   }


   function get_zip_edit($zip_id){
       $id=base64_decode($zip_id)/9876;
       $select="SELECT * FROM zipcode_masters WHERE id='$id'";
       $res=$this->db->query($select);
       return $res->result();
   }

   function update_zipcode($zip_code,$zip_code_id,$zip_desc,$zip_status,$user_id){
   $id=base64_decode($zip_code_id)/9876;
   $update="UPDATE zipcode_masters SET zip_code='$zip_code',zip_desc='$zip_desc',status='$zip_status',updated_at=NOW(),updated_by='$user_id' WHERE id='$id'";
   $res=$this->db->query($update);
   if($res){
      echo "success";
    }else{
      echo "failed";
    }
  }








}
