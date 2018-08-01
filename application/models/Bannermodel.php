<?php

Class Bannermodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }



   function create_banner($prod_id,$banner_title,$banner_status,$banner_desc,$banner_img,$user_id){
    if(empty($prod_id)){

    }else{
      $select="SELECT * FROM banner WHERE product_id='$prod_id'";
      $res=$this->db->query($select);
     if($res->num_rows()>0){
       $data = array("status" => "already");
       return $data;
     }else{
       $insert_query="INSERT INTO banner (banner_title,banner_desc,banner_image,product_id,status,created_at,created_by) VALUES('$banner_title','$banner_desc','$banner_img','$prod_id','$banner_status',NOW(),'$user_id')";
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
   }
   function check_banner($prod_id,$user_id){
     $select="SELECT * FROM banner WHERE product_id='$prod_id'";
     $res=$this->db->query($select);
    if($res->num_rows()>0){
      echo "false";
    }else{
      echo "true";
    }
   }

  function check_banner_exist($ban_id,$prod_id,$user_id){
     $id=base64_decode($ban_id)/9876;
     $select="SELECT * FROM banner WHERE product_id='$prod_id' AND id!='$id'";
     $res=$this->db->query($select);
    if($res->num_rows()>0){
      echo "false";
    }else{
      echo "true";
    }
   }


   function get_all_active_product(){
     $select="SELECT * FROM products WHERE status='Active'";
     $res=$this->db->query($select);
      return $res->result();
   }


   function get_all_banner(){
     $select="SELECT p.product_name,b.* FROM banner AS b LEFT JOIN products AS p ON p.id=b.product_id  ORDER BY b.id DESC";
     $res=$this->db->query($select);
    return $res->result();
   }


   function get_banner_edit($ban_id){
       $id=base64_decode($ban_id)/9876;
      $select="SELECT p.product_name,b.* FROM banner AS b LEFT JOIN products AS p ON p.id=b.product_id  WHERE b.id='$id'";
       $res=$this->db->query($select);
       return $res->result();
   }

   function update_banner($prod_id,$banner_token,$banner_title,$banner_status,$banner_desc,$banner_img,$user_id){
   $id=base64_decode($banner_token)/9876;
    $update="UPDATE banner SET product_id='$prod_id',banner_title='$banner_title',banner_desc='$banner_desc',banner_image='$banner_img',status='$banner_status',updated_at=NOW(),updated_by='$user_id' WHERE id='$id'";

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
