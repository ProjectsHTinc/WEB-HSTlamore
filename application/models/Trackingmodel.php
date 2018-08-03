<?php
Class Trackingmodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();
      	$this->load->model('smsmodel');
        $this->load->model('mailmodel');
  }




   function get_all_success_orders(){
     $select="SELECT po.*,c.id,c.name FROM  purchase_order AS po left join customers as c on c.id=po.cus_id WHERE po.status!='Pending' ORDER BY  po.id  DESC";
     $res=$this->db->query($select);
      return $res->result();
   }

   function get_all_orders(){
     $select="SELECT po.*,c.id,c.name FROM  purchase_order AS po left join customers as c on c.id=po.cus_id ORDER BY  po.id  DESC";
     $res=$this->db->query($select);
      return $res->result();
   }

   function get_status_msg($status_name){
    $select="SELECT * FROM order_msg_master WHERE status_name='$status_name' AND status='Active'";
    $res=$this->db->query($select);
    return $res->result();
   }

   function check_orders($order_id){
     $id=base64_decode($order_id);
//      $select="SELECT p.product_name,am.attribute_value,am.attribute_name,ams.attribute_value AS size,pc.*,comb.id FROM product_cart AS pc
// LEFT JOIN products AS p ON p.id=pc.product_id LEFT JOIN product_combined AS comb ON comb.id=pc.product_combined_id LEFT JOIN attribute_masters AS am ON am.id=comb.mas_color_id
// LEFT JOIN attribute_masters AS ams ON ams.id=comb.mas_size_id WHERE pc.order_id='$id'";
$select="SELECT ca.*,pur.cus_address_id,c.*,p.product_name,am.attribute_value,am.attribute_name,ams.attribute_value AS size,pc.*,comb.id FROM product_cart AS pc
LEFT JOIN products AS p ON p.id=pc.product_id LEFT JOIN product_combined AS comb ON comb.id=pc.product_combined_id LEFT JOIN attribute_masters AS am ON am.id=comb.mas_color_id
LEFT JOIN attribute_masters AS ams ON ams.id=comb.mas_size_id LEFT JOIN purchase_order AS pur ON pur.order_id=pc.order_id LEFT JOIN customers AS c ON pur.cus_id=c.id
LEFT JOIN cus_address AS ca ON ca.id=pur.cus_address_id WHERE pc.order_id='$id'";
     $res=$this->db->query($select);
    return $res->result();
   }



   function get_update_status($current_order_status,$order_id,$order_status,$msg_to_customer,$user_id){
     $update="UPDATE purchase_order SET status='$order_status' WHERE order_id='$order_id'";
     $res=$this->db->query($update);

     $select="SELECT ca.* FROM purchase_order AS po LEFT JOIN customers AS c ON po.cus_id=c.id LEFT JOIN cus_address AS ca ON ca.id=po.cus_address_id WHERE po.order_id='$order_id'";
     $res_select=$this->db->query($select);
     $result=$res_select->result();
     foreach($result as $rows_val){}
     $phone= $rows_val->mobile_number;
     $email= $rows_val->email_address;
     $textmessage=''.$msg_to_customer.' Track Your order '.$order_id.' ';
     $notes =utf8_encode($textmessage);
     $this->mailmodel->send_mail($email,$notes);
     $this->smsmodel->send_sms($phone,$notes);
     $insert="INSERT order_history (order_id,sent_msg,old_status,status,updated_at,updated_by) VALUES('$order_id','$msg_to_customer','$current_order_status','$order_status',NOW(),'$user_id')";
     $res_ins=$this->db->query($insert);
     if($res_ins){
       echo "success";
     }else{
        echo "Something Went wrong";
     }

   }







}
