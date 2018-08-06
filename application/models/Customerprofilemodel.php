<?php

Class Customerprofilemodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }



   function get_all_customer(){
     $select="SELECT * FROM customers";
     $res=$this->db->query($select);
      return $res->result();
   }

   function get_customer_details($cus_id){
     $id=base64_decode($cus_id)/9876;
     $select="SELECT c.*,cd.*,c.status AS cus_status FROM customers AS c LEFT JOIN customer_details AS cd ON c.id=cd.customer_id WHERE cd.customer_id='$id'";
     $res=$this->db->query($select);
     return $res->result();
   }
   function get_customer_address_details($cus_id){
     $id=base64_decode($cus_id)/9876;
     $select="SELECT * FROM cus_address WHERE cus_id='$id'";
     $res=$this->db->query($select);
      return $res->result();
   }

   function change_status($rw_id,$stat_id,$user_id){

    $id=base64_decode($rw_id)/9876;
     if($stat_id=='Active'){
       $status='Inactive';
     }else{
        $status='Active';
     }

  $update="UPDATE customers SET status='$status',updated_at=NOW(),updated_by='$user_id' WHERE id='$id'";
   $res=$this->db->query($update);
   if($res){
      echo "success";
    }else{
      echo "failed";
    }
  }

  function get_count_of_active_customer(){
    $select="SELECT COUNT(*) AS count_cust FROM customers WHERE STATUS='Active'";
   $res=$this->db->query($select);
   return $res->result();
  }








}
