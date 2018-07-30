<?php

Class Specificationmodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }



   function create_spec_name($spec_name,$spec_status,$user_id){
    if(empty($spec_name)){

    }else{
      $select="SELECT * FROM specification_masters WHERE spec_name='$spec_name'";
      $res=$this->db->query($select);
      if($res->num_rows()>0){
       echo "Already Exist";
     }else{

       $insert_query="INSERT INTO specification_masters (spec_name,status,created_at,created_by) VALUES('$spec_name','$spec_status',NOW(),'$user_id')";
       $res=$this->db->query($insert_query);
       if($res){
               echo "success";
            }else{
               echo "failed";
            }
     }

    }
   }
   function check_spec_name($spec_name,$user_id){
     $select="SELECT * FROM specification_masters WHERE spec_name='$spec_name'";
     $res=$this->db->query($select);
    if($res->num_rows()>0){
      echo "false";
    }else{
      echo "true";
    }
   }

  function  check_spec_exist($specs_id,$specs_name,$user_id){
      $id=base64_decode($specs_id)/9876;
      $select="SELECT * FROM specification_masters WHERE spec_name='$specs_name' AND id!='$id'";
     $res=$this->db->query($select);
    if($res->num_rows()>0){
      echo "false";
    }else{
      echo "true";
    }
   }







   function get_all_specification(){
     $select="SELECT * FROM specification_masters";
     $res=$this->db->query($select);
      return $res->result();
   }
   function get_all_active_specs(){
     $select="SELECT * FROM specification_masters WHERE status='Active'";
     $res=$this->db->query($select);
      return $res->result();
   }


   function get_specification_edit($spec_id){
       $id=base64_decode($spec_id)/9876;
       $select="SELECT * FROM specification_masters WHERE id='$id'";
       $res=$this->db->query($select);
       return $res->result();
   }

   function update_spec_name($spec_name,$spec_status,$user_id,$spec_id){
   $id=base64_decode($spec_id)/9876;

   $update="UPDATE specification_masters SET spec_name='$spec_name',status='$spec_status',updated_at=NOW(),updated_by='$user_id' WHERE id='$id'";
   $res=$this->db->query($update);
   if($res){
      echo "success";
    }else{
      echo "failed";
    }
  }








}
