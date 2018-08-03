<?php
Class Salesmodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }




   function day_wise_sales($day_name){
    $day_id=date("Y-m-d", strtotime($day_name));
     $select="SELECT c.name,po.* FROM purchase_order AS po LEFT JOIN customers AS c ON po.cus_id=c.id WHERE po.status!='Pending' AND DATE_FORMAT(po.purchase_date, '%Y-%m-%d')='$day_id'";
     $res=$this->db->query($select);
      return $res->result();
   }



   function month_wise_sales($month_id,$year_id){
      $select="SELECT c.name,po.* FROM purchase_order AS po LEFT JOIN customers AS c ON po.cus_id=c.id WHERE po.status!='Pending' AND MONTH(po.purchase_date)='$month_id' AND  YEAR(po.purchase_date)='$year_id'";
     $res=$this->db->query($select);
      return $res->result();
   }




}
