<?php
Class Adsmodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }



   function create_ads($sub_cat_id,$ad_title,$ad_status,$ad_img,$user_id){
    if(empty($sub_cat_id)){

    }else{
      if($ad_status=='Active'){
        $update="UPDATE ads_master SET status='Inactive'";
        $res=$this->db->query($update);

      }
      $select="SELECT * FROM ads_master WHERE sub_cat_id='$sub_cat_id'";
      $res=$this->db->query($select);
     if($res->num_rows()>0){
       $data = array("status" => "already");
       return $data;
     }else{
       $insert_query="INSERT INTO ads_master (ad_title,sub_cat_id,ad_img,status,created_at,created_by) VALUES('$ad_title','$sub_cat_id','$ad_img','$ad_status',NOW(),'$user_id')";
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
   function check_ads($sub_cat_id,$user_id){
     $select="SELECT * FROM ads_master WHERE sub_cat_id='$sub_cat_id'";
     $res=$this->db->query($select);
    if($res->num_rows()>0){
      echo "false";
    }else{
      echo "true";
    }
   }

  function check_ads_exist($ads_id,$sub_cat_id,$user_id){
     $id=base64_decode($ads_id)/9876;
     $select="SELECT * FROM ads_master WHERE sub_cat_id='$sub_cat_id' AND id!='$id'";
     $res=$this->db->query($select);
    if($res->num_rows()>0){
      echo "false";
    }else{
      echo "true";
    }
   }


   function get_all_active_sub_cat(){
     $select="SELECT * FROM category_masters WHERE parent_id!=1 AND status='Active'";
     $res=$this->db->query($select);
      return $res->result();
   }


   function get_all_ads(){
     $select="SELECT cm.category_name,ad.* FROM ads_master AS ad LEFT JOIN category_masters AS cm ON cm.id=ad.sub_cat_id  ORDER BY ad.id DESC";
     $res=$this->db->query($select);
    return $res->result();
   }


   function get_ads_edit($ads_id){
       $id=base64_decode($ads_id)/9876;
      $select="SELECT cm.category_name,ad.* FROM ads_master AS ad LEFT JOIN category_masters AS cm ON cm.id=ad.sub_cat_id WHERE ad.id='$id'";
       $res=$this->db->query($select);
       return $res->result();
   }

   function update_ads($sub_cat_id,$ads_token,$ad_img,$ad_title,$ads_status,$user_id){
   $id=base64_decode($ads_token)/9876;
   if($ads_status=='Active'){
     $update="UPDATE ads_master SET status='Inactive'";
     $res=$this->db->query($update);
   }
  $update="UPDATE ads_master SET sub_cat_id='$sub_cat_id',ad_title='$ad_title',ad_img='$ad_img',status='$ads_status',updated_at=NOW(),updated_by='$user_id' WHERE id='$id'";
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
