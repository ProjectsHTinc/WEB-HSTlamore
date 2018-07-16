<?php

Class Categorymodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }



   function create_category($cat_name,$cat_desc,$cat_status,$cat_meta_title,$cat_meta_desc,$cat_meta_keywords,$cat_cover_img,$cat_thumb_img,$user_id){
    if(empty($cat_name)){

    }else{
      $insert_query="INSERT INTO category_masters (parent_id,category_name,category_image,category_thumbnail,category_desc,category_meta_title,category_meta_desc,category_keywords,status,created_at,created_by) VALUES('1','$cat_name','$cat_cover_img','$cat_thumb_img','$cat_desc','$cat_meta_title','$cat_meta_desc','$cat_meta_keywords','$cat_status',NOW(),'$user_id')";
      $res=$this->db->query($insert_query);
      if($res){
               $data = array("status" => "success");
               return $data;
           }else{
               $data = array("status" => "failed");
               return $data;
           }
    }
   }
   function check_category($cat_name,$user_id){
     $select="SELECT * FROM category_masters WHERE category_name='$cat_name'";
     $res=$this->db->query($select);
    if($res->num_rows()>0){
      echo "false";
    }else{
      echo "true";
    }
   }

  function  check_category_exist($cat_id,$cat_name,$user_id){
     $id=base64_decode($cat_id)/9876;
     $select="SELECT * FROM category_masters WHERE category_name='$cat_name' AND id!='$id'";
     $res=$this->db->query($select);
    if($res->num_rows()>0){
      echo "false";
    }else{
      echo "true";
    }
   }

   function create_sub_category($cat_name,$cat_desc,$cat_status,$cat_meta_title,$cat_meta_desc,$cat_meta_keywords,$cat_cover_img,$cat_thumb_img,$user_id,$sub_cat_id){
      $parent_id=base64_decode($sub_cat_id)/9876;

     if(empty($cat_name)){

     }else{
       $insert_query="INSERT INTO category_masters (parent_id,category_name,category_image,category_thumbnail,category_desc,category_meta_title,category_meta_desc,category_keywords,status,created_at,created_by) VALUES('$parent_id','$cat_name','$cat_cover_img','$cat_thumb_img','$cat_desc','$cat_meta_title','$cat_meta_desc','$cat_meta_keywords','$cat_status',NOW(),'$user_id')";
       $res=$this->db->query($insert_query);
       if($res){
                $data = array("status" => "success");
                return $data;
            }else{
                $data = array("status" => "failed");
                return $data;
            }
     }
   }





   function get_all_category(){
     $select="SELECT * FROM category_masters WHERE id!='1' AND parent_id='1'";
     $res=$this->db->query($select);
      return $res->result();
   }

   function get_all_parent_category(){
     $select="SELECT * FROM category_masters WHERE id!='1' AND parent_id='1'";
     $res=$this->db->query($select);
    return $res->result();
   }

   function get_all_subcategory($sub_cat){
      $parent_id=base64_decode($sub_cat)/9876;
      $select="SELECT * FROM category_masters WHERE id!='1' AND parent_id='$parent_id'";
      $res=$this->db->query($select);
      return $res->result();
   }
   function get_category_edit($cat_id){
       $id=base64_decode($cat_id)/9876;
       $select="SELECT * FROM category_masters WHERE id='$id'";
       $res=$this->db->query($select);
       return $res->result();
   }

   function update_category($cat_name,$cat_desc,$cat_status,$cat_meta_title,$cat_meta_desc,$cat_meta_keywords,$cat_cover_img,$cat_thumb_img,$user_id,$cat_id){
   $id=base64_decode($cat_id)/9876;
   $update="UPDATE category_masters SET category_name='$cat_name',category_image='$cat_cover_img',category_thumbnail='$cat_thumb_img',category_desc='$cat_desc',category_meta_title='$cat_meta_title',category_meta_desc='$cat_meta_desc',category_keywords='$cat_meta_keywords',status='$cat_status',updated_at=NOW(),updated_by='$user_id' WHERE id='$id'";
   $res=$this->db->query($update);
   if($res){
        $data = array("status" => "success");
        return $data;
    }else{
        $data = array("status" => "failed");
        return $data;
    }
  }

  function update_sub_category($cat_name,$cat_desc,$cat_status,$cat_meta_title,$cat_meta_desc,$cat_meta_keywords,$cat_cover_img,$cat_thumb_img,$user_id,$cat_id,$main_cat_id){
  $id=base64_decode($cat_id)/9876;
   $update="UPDATE category_masters SET parent_id='$main_cat_id',category_name='$cat_name',category_image='$cat_cover_img',category_thumbnail='$cat_thumb_img',category_desc='$cat_desc',category_meta_title='$cat_meta_title',category_meta_desc='$cat_meta_desc',category_keywords='$cat_meta_keywords',status='$cat_status',updated_at=NOW(),updated_by='$user_id' WHERE id='$id'";

  $res=$this->db->query($update);
  if($res){
       $data = array("status" => "success");
       return $data;
   }else{
       $data = array("status" => "failed");
       return $data;
   }
 }






}
