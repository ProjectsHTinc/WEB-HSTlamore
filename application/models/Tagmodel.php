<?php

Class Tagmodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }



   function create_tag_name($tag_name,$tag_status,$user_id){
    if(empty($tag_name)){

    }else{
      $select="SELECT * FROM tag_masters WHERE tag_name='$tag_name'";
      $res=$this->db->query($select);
      if($res->num_rows()>0){
       echo "Already Exist";
     }else{
       $insert_query="INSERT INTO tag_masters (tag_name,status,created_at,created_by) VALUES('$tag_name','$tag_status',NOW(),'$user_id')";
       $res=$this->db->query($insert_query);
       if($res){
               echo "success";
            }else{
               echo "failed";
            }
     }

    }
   }
   function check_tag_name($tag_name,$user_id){
     $select="SELECT * FROM tag_masters WHERE tag_name='$tag_name'";
     $res=$this->db->query($select);
    if($res->num_rows()>0){
      echo "false";
    }else{
      echo "true";
    }
   }

  function  check_tag_exist($tag_id,$tag_name,$user_id){
      $id=base64_decode($tag_id)/9876;
      $select="SELECT * FROM tag_masters WHERE tag_name='$tag_name' AND id!='$id'";
     $res=$this->db->query($select);
    if($res->num_rows()>0){
      echo "false";
    }else{
      echo "true";
    }
   }

   function get_all_tag(){
     $select="SELECT * FROM tag_masters";
     $res=$this->db->query($select);
      return $res->result();
   }

   function get_all_active_tags(){
     $select="SELECT * FROM tag_masters WHERE status='Active'";
     $res=$this->db->query($select);
      return $res->result();
   }



   function get_tag_edit($tag_id){
       $id=base64_decode($tag_id)/9876;
       $select="SELECT * FROM tag_masters WHERE id='$id'";
       $res=$this->db->query($select);
       return $res->result();
   }

   function update_tag_name($tag_name,$tag_status,$user_id,$tag_id){
   $id=base64_decode($tag_id)/9876;
   $update="UPDATE tag_masters SET tag_name='$tag_name',status='$tag_status',updated_at=NOW(),updated_by='$user_id' WHERE id='$id'";
   $res=$this->db->query($update);
   if($res){
      echo "success";
    }else{
      echo "failed";
    }
  }








}
