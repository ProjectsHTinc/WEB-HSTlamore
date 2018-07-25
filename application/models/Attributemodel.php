<?php

Class Attributemodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }



   function create_attribute($att_type,$color_name,$attribute_color_value,$attribute_size_value,$att_status,$user_id){
    if(empty($att_type)){

    }else{
      if($att_type==1){
        $att_name='';
        $att_value=$attribute_size_value;
      }else{
        $att_name=$color_name;
        $att_value=$attribute_color_value;
      }
      $check ="SELECT * FROM attribute_masters WHERE attribute_name='$att_name' AND attribute_value='$att_value'";
       $result=$this->db->query($check);
         if($result->num_rows()>0){
           echo "Already Exist";
         }else{
           $insert_query="INSERT INTO attribute_masters (attribute_type,attribute_name,attribute_value,status,created_at,created_by) VALUES('$att_type','$att_name','$att_value','$att_status',NOW(),'$user_id')";
           $res=$this->db->query($insert_query);
           if($res){
                   echo "success";
                }else{
                   echo "failed";
                }
         }

    }
   }






   function get_all_attribute(){
     $select="SELECT atm.attribute_type_name,am.* FROM attribute_masters AS am LEFT JOIN attribute_type_master AS atm ON atm.id=am.attribute_type";
     $res=$this->db->query($select);
      return $res->result();
   }

   function get_all_active_size_attr(){
     $select="SELECT atm.attribute_type_name,am.* FROM attribute_masters AS am LEFT JOIN attribute_type_master AS atm ON atm.id=am.attribute_type WHERE am.status='Active' AND am.attribute_type='1'";
     $res=$this->db->query($select);
      return $res->result();
   }

   function get_all_active_color_attr(){
     $select="SELECT atm.attribute_type_name,am.* FROM attribute_masters AS am LEFT JOIN attribute_type_master AS atm ON atm.id=am.attribute_type WHERE am.status='Active' AND am.attribute_type='2'";
     $res=$this->db->query($select);
      return $res->result();
   }


   function get_attribute_edit($att_id){
       $id=base64_decode($att_id)/9876;
       $select="SELECT * FROM attribute_masters WHERE id='$id'";
       $res=$this->db->query($select);
       return $res->result();
   }

   function update_attribute($att_type,$color_name,$attribute_color_value,$attribute_size_value,$att_status,$user_id,$att_id){
   $id=base64_decode($att_id)/9876;
   if($att_type==1){
     $att_name='';
     $att_value=$attribute_size_value;
   }else{
     $att_name=$color_name;
     $att_value=$attribute_color_value;
   }

    $update="UPDATE attribute_masters SET attribute_name='$att_name',attribute_value='$att_value',status='$att_status',updated_at=NOW(),updated_by='$user_id' WHERE id='$id'";
   $res=$this->db->query($update);
   if($res){
           echo "success";
        }else{
           echo "failed";
        }
  }
  function check_att_exist($att_id,$att_name,$user_id){
    $id=base64_decode($att_id)/9876;
     $select="SELECT * FROM attribute_masters WHERE attribute_value='$att_name' AND id!='$id'";
    $res=$this->db->query($select);
   if($res->num_rows()>0){
     echo "false";
   }else{
     echo "true";
   }
  }








}
