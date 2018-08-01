<?php
Class Productmodel extends CI_Model
{

  public function __construct()
  {
      parent::__construct();

  }



   function create_product_item($product_name,$sku_code,$cat_id,$sub_cat_id,$product_desc,$delivery_fee,$prod_cover_img,$prod_size_chart,$prod_actual_price,$prod_mrp_price,$combined_status,$mas_size,$mas_color,$prod_comb_mrp_price,$prod_comb_actual_price,$prod_comb_total_stocks,$prod_default,$prod_offer_percentage,$prod_return_policy,$prod_cod,$prod_stock_left,$product_tags,$prod_meta_title,$prod_meta_keywords,$product_meta_desc,$user_id,$prod_status,$prod_total_stocks,$prod_minimum_stocks){
    if(empty($product_name)){

    }else{
      $select="SELECT * FROM products WHERE product_name='$product_name'";
      $res=$this->db->query($select);
      if($res->num_rows()>0){
       echo "Already Exist";
     }else{
      $insert_query="INSERT INTO products(cat_id,sub_cat_id,product_name,sku_code,product_cover_img,prod_size_chart,product_description,combined_status,prod_actual_price,prod_mrp_price,offer_percentage,delivery_fee_status,prod_return_policy,prod_cod,product_meta_title,product_meta_desc,product_meta_keywords,min_stocks_status,total_stocks,stocks_left,status,created_by,created_at) VALUES ('$cat_id','$sub_cat_id','$product_name','$sku_code','$prod_cover_img','$prod_size_chart','$product_desc','$combined_status','$prod_actual_price','$prod_mrp_price','$prod_offer_percentage','$delivery_fee','$prod_return_policy','$prod_cod','$prod_meta_title','$product_meta_desc','$prod_meta_keywords','$prod_minimum_stocks','$prod_total_stocks','$prod_total_stocks','$prod_status','$user_id',NOW())";
      $res=$this->db->query($insert_query);



      //------Product Last Insert id ----//

       $last_prod_id = $this->db->insert_id();

       //------Product View count ----//

       $insert_view_count="INSERT INTO product_view_count (product_id,view_count,updated_at) VALUES ('$last_prod_id','0',NOW())";
       $res_count=$this->db->query($insert_view_count);



        //------Product Combined ----//

       if($combined_status=='1'){
         $combined_cnt=count($mas_size);
         for($i=0;$i< count($mas_size);$i++){
           $mas_color_id=$mas_color[$i];
           $mas_size_id=$mas_size[$i];
           $prod_comb_mrp_price_id=$prod_comb_mrp_price[$i];
           $prod_comb_actual_price_id=$prod_comb_actual_price[$i];
          $prod_default_id=$prod_default[$i];


           $prod_comb_total_stocks_id=$prod_comb_total_stocks[$i];
          $check ="SELECT * FROM product_combined WHERE mas_color_id='$mas_color_id' AND mas_size_id='$mas_size_id' AND product_id='$last_prod_id'";
          $result=$this->db->query($check);
          if($result->num_rows()==0){
            $reg_query="INSERT INTO product_combined (product_id,mas_size_id,mas_color_id,prod_mrp_price,prod_actual_price,prod_default,total_stocks,stocks_left,status,created_at,created_by) VALUES('$last_prod_id','$mas_size_id','$mas_color_id','$prod_comb_mrp_price_id','$prod_comb_actual_price_id','$prod_default_id','$prod_comb_total_stocks_id','$prod_comb_total_stocks_id','Active',NOW(),'$user_id')";
           $req_q=$this->db->query($reg_query);
         }else{
         }
        }
       }

       //------Product stocks ----//
        if($combined_status=='1'){
       $check_total_stocks="SELECT sum(total_stocks) as combined_total_stocks FROM product_combined WHERE product_id='$last_prod_id'";
       $result_stocks=$this->db->query($check_total_stocks);
       $res_stocks=$result_stocks->result();
       foreach($res_stocks as $row_tot_stocks){}
       $tota_stocks= $row_tot_stocks->combined_total_stocks;
       $update_total_main="UPDATE products SET total_stocks='$tota_stocks',stocks_left='$tota_stocks' WHERE id='$last_prod_id'";
       $result_stocks=$this->db->query($update_total_main);
       }else{ }

       //------Product tags----//

         $tag_cnt=count($product_tags);
         for($i=0;$i<$tag_cnt;$i++){
           $product_tags_id=$product_tags[$i];
          $check ="SELECT * FROM product_tags WHERE product_id='$last_prod_id' AND tag_id='$product_tags_id'";
          $result=$this->db->query($check);
          if($result->num_rows()==0){
            $reg_query="INSERT INTO product_tags (product_id,tag_id,status,created_at,created_by) VALUES('$last_prod_id','$product_tags_id','Active',NOW(),'$user_id')";
           $req_q=$this->db->query($reg_query);
         }else{
         }
        }


     }
     if($res){
          $data = array("status" => "success",'prod_last_id'=>$last_prod_id);
          return $data;
      }else{
          $data = array("status" => "failed");
          return $data;
      }


    }
   }
   function check_product_name($product_name,$user_id){
     $select="SELECT * FROM products WHERE product_name='$product_name'";
     $res=$this->db->query($select);
    if($res->num_rows()>0){
      echo "false";
    }else{
      echo "true";
    }
   }

   function check_sku_code($sku_code,$user_id){
     $select="SELECT * FROM products WHERE sku_code='$sku_code'";
     $res=$this->db->query($select);
    if($res->num_rows()>0){
      echo "false";
    }else{
      echo "true";
    }
   }


  function check_product_name_exist($prod_id,$prod_name,$user_id){
    $id=base64_decode($prod_id)/9876;
    $select="SELECT * FROM products WHERE product_name='$prod_name' AND id!='$id'";
    $res=$this->db->query($select);
    if($res->num_rows()>0){
      echo "false";
    }else{
      echo "true";
    }
   }

   function check_sku_code_exist($prod_id,$sku_code,$user_id){
     $id=base64_decode($prod_id)/9876;
     $select="SELECT * FROM products WHERE sku_code='$sku_code' AND id!='$id'";
     $res=$this->db->query($select);
     if($res->num_rows()>0){
       echo "false";
     }else{
       echo "true";
     }
    }

   function get_all_products(){
     $select="SELECT cm.category_name,IFNULL(scm.category_name,' ') AS sub_cat,pd.* FROM products AS pd
     LEFT JOIN category_masters AS cm ON pd.cat_id=cm.id LEFT JOIN category_masters AS scm ON pd.sub_cat_id=scm.id ORDER BY pd.id DESC";
     $res=$this->db->query($select);
      return $res->result();
   }


   function get_prod_edit($product_id){
       $id=base64_decode($product_id)/9876;
       $select="SELECT cm.category_name,IFNULL(scm.category_name,' ') AS sub_cat,pd.* FROM products as pd LEFT JOIN category_masters AS cm ON pd.cat_id=cm.id LEFT JOIN category_masters AS scm ON pd.sub_cat_id=scm.id WHERE pd.id='$id'";
       $res=$this->db->query($select);
       return $res->result();
   }

   function get_prod_comb_edit($product_id){
       $id=base64_decode($product_id)/9876;
       $select="SELECT am.attribute_value,am.attribute_name,pc.mas_color_id,pc.mas_size_id,ams.attribute_value AS size,pc.* FROM product_combined AS pc LEFT JOIN attribute_masters AS am ON am.id=pc.mas_color_id LEFT JOIN attribute_masters AS ams ON ams.id=pc.mas_size_id WHERE product_id='$id'";
       $res=$this->db->query($select);
       return $res->result();
   }

   function get_prod_tag_edit($product_id){
       $id=base64_decode($product_id)/9876;
       $select="SELECT pt.id,tm.tag_name FROM product_tags AS pt LEFT JOIN tag_masters AS tm ON tm.id=pt.tag_id WHERE pt.product_id='$id'";
       $res=$this->db->query($select);
       return $res->result();
   }

   function get_prod_gall_edit($product_id){
       $id=base64_decode($product_id)/9876;
       $select="SELECT * FROM product_gallery WHERE product_id='$id'";
       $res=$this->db->query($select);
       return $res->result();
   }

   function get_prod_spec_edit($product_id){
       $id=base64_decode($product_id)/9876;
       $select="SELECT sm.spec_name,ps.* FROM product_specification AS ps LEFT JOIN specification_masters AS sm ON sm.id=ps.spec_id WHERE product_id='$id'";
       $res=$this->db->query($select);
       return $res->result();
   }



   function update_prod_info($product_token,$sku_code,$product_name,$cat_id,$sub_cat_id,$product_desc,$delivery_fee,$prod_actual_price,$prod_mrp_price,$prod_offer_percentage,$prod_return_policy,$prod_total_stocks,$prod_minimum_stocks,$prod_cod,$prod_status,$user_id,$prod_meta_title,$prod_meta_keywords,$product_meta_desc,$combined_status){
    $id=base64_decode($product_token)/9876;
    $update="UPDATE products SET sku_code='$sku_code',product_name='$product_name',cat_id='$cat_id',sub_cat_id='$sub_cat_id',product_description='$product_desc',delivery_fee_status='$delivery_fee',prod_actual_price='$prod_actual_price',prod_mrp_price='$prod_mrp_price',offer_percentage='$prod_offer_percentage',prod_return_policy='$prod_return_policy',total_stocks='$prod_total_stocks',min_stocks_status='$prod_minimum_stocks',prod_cod='$prod_cod',status='$prod_status',updated_at=NOW(),updated_by='$user_id',product_meta_title='$prod_meta_title',product_meta_desc='$product_meta_desc',product_meta_keywords='$prod_meta_keywords' WHERE id='$id'";
   $res=$this->db->query($update);
        if($combined_status=='1'){
          $check_total_stocks="SELECT sum(total_stocks) as combined_total_stocks FROM product_combined WHERE product_id='$id'";
          $result_stocks=$this->db->query($check_total_stocks);
          $res_stocks=$result_stocks->result();
          foreach($res_stocks as $row_tot_stocks){}
          $tota_stocks= $row_tot_stocks->combined_total_stocks;
          $update_total_main="UPDATE products SET total_stocks='$tota_stocks',stocks_left='$tota_stocks' WHERE id='$id'";
          $result_stocks=$this->db->query($update_total_main);
        }else{
          $update_total_main="UPDATE products SET total_stocks='$prod_total_stocks',stocks_left='$prod_total_stocks' WHERE id='$id'";
          $result_stocks=$this->db->query($update_total_main);
        }



   if($res){
      echo "success";
    }else{
      echo "failed";
    }
  }


  function get_edit_combined_product($com_id){
    $id=base64_decode($com_id)/9876;
     $select="SELECT am.attribute_value,am.attribute_name,pc.mas_color_id,pc.mas_size_id,ams.attribute_value AS size,pc.* FROM product_combined AS pc LEFT JOIN attribute_masters AS am ON am.id=pc.mas_color_id LEFT JOIN attribute_masters AS ams ON ams.id=pc.mas_size_id WHERE pc.id='$id'";
    $res=$this->db->query($select);
    return $res->result();
  }


   function update_combined_products($mas_size,$mas_color,$prod_actual_price,$prod_mrp_price,$product_id,$combined_token,$total_stocks,$comb_status,$user_id,$prod_default){
       $id=base64_decode($combined_token)/9876;
       if(empty($product_id)){

       }else{
          $check_exist="SELECT * FROM product_combined WHERE  product_id='$product_id' AND mas_color_id='$mas_color' AND mas_size_id='$mas_size' AND id!='$id'";
         $res_exist=$this->db->query($check_exist);
         if($res_exist->num_rows()>0){
           $data = array("status" => "already");
           return $data;
         }else{
           if($prod_default=='1'){
             $update_total_main="UPDATE product_combined SET prod_default='0' WHERE product_id='$product_id'";
             $result_stocks=$this->db->query($update_total_main);

           }
           $update="UPDATE product_combined SET mas_size_id='$mas_size',mas_color_id='$mas_color',prod_actual_price='$prod_actual_price',prod_mrp_price='$prod_mrp_price',stocks_left='$total_stocks',total_stocks='$total_stocks',status='$comb_status',prod_default='$prod_default',updated_at=NOW(),updated_by='$user_id' WHERE id='$id'";
           $res=$this->db->query($update);

           //-----Increase product count ------//

           $check_total_stocks="SELECT sum(total_stocks) as combined_total_stocks FROM product_combined WHERE product_id='$product_id'";
           $result_stocks=$this->db->query($check_total_stocks);
           $res_stocks=$result_stocks->result();
           foreach($res_stocks as $row_tot_stocks){}
           $tota_stocks= $row_tot_stocks->combined_total_stocks;
           $update_total_main="UPDATE products SET total_stocks='$tota_stocks',stocks_left='$tota_stocks' WHERE id='$product_id'";
           $result_stocks=$this->db->query($update_total_main);
           if($res){
             $data = array("status" => "success",'prod_last_id'=>$product_id);
             return $data;
                }else{
                    $data = array("status" => "failed");
                    return $data;
                }
         }



       }
   }



   function create_combined_products($mas_size,$mas_color,$prod_actual_price,$prod_mrp_price,$product_token,$total_stocks,$comb_status,$user_id,$prod_default){
      $product_id=base64_decode($product_token)/9876;
     if(empty($product_id)){

     }else{

        $check_exist="SELECT * FROM product_combined WHERE  product_id='$product_id' AND mas_color_id='$mas_color' AND mas_size_id='$mas_size'";
       $res_exist=$this->db->query($check_exist);
       if($res_exist->num_rows()>0){
         $data = array("status" => "already");
         return $data;
       }else{

         if($prod_default=='1'){
           $update_total_main="UPDATE product_combined SET prod_default='0' WHERE product_id='$product_id'";
           $result_stocks=$this->db->query($update_total_main);

         }
         $insert="INSERT INTO product_combined (product_id,mas_size_id,mas_color_id,prod_mrp_price,prod_actual_price,stocks_left,total_stocks,status
         ,created_at,created_by,prod_default) VALUES ('$product_id','$mas_size','$mas_color','$prod_mrp_price','$prod_actual_price','$total_stocks','$total_stocks','$comb_status',NOW(),'$user_id','$prod_default')";
         $res=$this->db->query($insert);

          //--SET Combined Product--//
          $update_total_main="UPDATE products SET combined_status='1' WHERE id='$product_id'";
          $result_stocks=$this->db->query($update_total_main);

         //-----Increase product count ------//

         $check_total_stocks="SELECT sum(total_stocks) as combined_total_stocks FROM product_combined WHERE product_id='$product_id'";
         $result_stocks=$this->db->query($check_total_stocks);
         $res_stocks=$result_stocks->result();
         foreach($res_stocks as $row_tot_stocks){}
         $tota_stocks= $row_tot_stocks->combined_total_stocks;
         $update_total_main="UPDATE products SET total_stocks='$tota_stocks',stocks_left='$tota_stocks' WHERE id='$product_id'";
         $result_stocks=$this->db->query($update_total_main);
         if($res){
           $data = array("status" => "success",'prod_last_id'=>$product_id);
           return $data;
              }else{
                  $data = array("status" => "failed");
                  return $data;
              }
       }
     }
   }


   function get_delete_sub_prod($prod_id,$user_id){
       $product_id=base64_decode($prod_id)/9876;
       $update_total_main="UPDATE products SET combined_status='0' WHERE id='$product_id'";
       $result_stocks=$this->db->query($update_total_main);
       $delete_comb="DELETE FROM product_combined WHERE product_id='$product_id'";
       $result_stocks=$this->db->query($delete_comb);
       if($result_stocks){
         echo "success";
       }else{
         echo "failure";
       }

   }

   function create_specification($spec_id,$spec_value,$product_token,$spec_status,$user_id){
     $product_id=base64_decode($product_token)/9876;
    if(empty($product_id)){

    }else{
      $check_exist="SELECT * FROM product_specification WHERE  spec_id='$spec_id' AND product_id='$product_id'";
     $res_exist=$this->db->query($check_exist);
     if($res_exist->num_rows()>0){
       $data = array("status" => "already");
       return $data;
     }else{
       $insert="INSERT INTO product_specification (product_id,spec_id,spec_value,status,created_at,created_by) VALUES ('$product_id','$spec_id','$spec_value','$spec_status',NOW(),'$user_id')";
       $res=$this->db->query($insert);

        //--SET Combined Product--//
        $update_total_main="UPDATE products SET specification_status='1' WHERE id='$product_id'";
        $result_stocks=$this->db->query($update_total_main);

       if($res){
         $data = array("status" => "success",'prod_last_id'=>$product_id);
         return $data;
            }else{
                $data = array("status" => "failed");
                return $data;
            }
     }
    }

   }



   function edit_specifcation($spec_id){
     $id=base64_decode($spec_id)/9876;
      $select="SELECT sm.spec_name,ps.* FROM product_specification AS ps LEFT JOIN specification_masters AS sm ON sm.id=ps.spec_id WHERE ps.id='$id'";
     $res=$this->db->query($select);
     return $res->result();
   }

   function update_specification($spec_id,$spec_value,$product_token,$spec_status,$user_id,$spec_token){
     $id=base64_decode($spec_token)/9876;
      $check_exist="SELECT * FROM product_specification WHERE  spec_id='$spec_id' AND id!='$id'";

    $res_exist=$this->db->query($check_exist);
    if($res_exist->num_rows()>0){
      $data = array("status" => "already");
      return $data;
    }else{
      $update_specs="UPDATE product_specification SET spec_id='$spec_id',spec_value='$spec_value',status='$spec_status',updated_at=NOW(),updated_by='$user_id' WHERE id='$id'";
      $result_stocks=$this->db->query($update_specs);
      if($result_stocks){
        $data = array("status" => "success");
        return $data;
      }else{
        $data = array("status" => "failed");
        return $data;
      }
    }
   }


    function upload_size_chart($product_token,$prod_size_chart,$user_id){
       $id=base64_decode($product_token)/9876;
      $update_specs="UPDATE products SET prod_size_chart='$prod_size_chart',updated_at=NOW(),updated_by='$user_id' WHERE id='$id'";
      $result_stocks=$this->db->query($update_specs);
      if($result_stocks){
        $data = array("status" => "success");
        return $data;
      }else{
        $data = array("status" => "failed");
        return $data;
      }
    }


    function upload_cover_img($product_token,$product_cover_img,$user_id){
      $id=base64_decode($product_token)/9876;
     $update_specs="UPDATE products SET product_cover_img='$product_cover_img',updated_at=NOW(),updated_by='$user_id' WHERE id='$id'";
     $result_stocks=$this->db->query($update_specs);
     if($result_stocks){
       $data = array("status" => "success");
       return $data;
     }else{
       $data = array("status" => "failed");
       return $data;
     }
    }

      function get_all_active_tags_prod($prod_id){
        $id=base64_decode($prod_id)/9876;
        $select="SELECT a.tag_name,a.id FROM tag_masters a WHERE NOT EXISTS  (SELECT * FROM  product_tags AS b WHERE a.id = b.tag_id AND  b.product_id='$id') AND a.status='Active'";
        $res=$this->db->query($select);
        return $res->result();
      }

      function get_update_product_tags($product_token,$product_tags,$user_id){
          $id=base64_decode($product_token)/9876;
          $tag_cnt=count($product_tags);
          for($i=0;$i<$tag_cnt;$i++){
          $product_tags_id=$product_tags[$i];

           $check ="SELECT * FROM product_tags WHERE product_id='$id' AND tag_id='$product_tags_id'";
           $result=$this->db->query($check);
           if($result->num_rows()==0){
           $reg_query="INSERT INTO product_tags (product_id,tag_id,status,created_at,created_by) VALUES('$id','$product_tags_id','Active',NOW(),'$user_id')";
            $req_q=$this->db->query($reg_query);
          }else{
          }
         }
         if($req_q){
           $data = array("status" => "success");
           return $data;
         }else{
           $data = array("status" => "failed");
           return $data;
         }
      }

      function get_delete_prod_tags($tag_id,$user_id){
        $product_tag_id=base64_decode($tag_id)/9876;
        $delete_comb="DELETE FROM product_tags WHERE id='$product_tag_id'";
        $result_stocks=$this->db->query($delete_comb);
        if($result_stocks){
          echo "success";
        }else{
          echo "failure";
        }
      }


      function   get_delete_prod_gallery($gal_id,$user_id){
        $product_gal_id=base64_decode($gal_id)/9876;
        $delete_comb="DELETE FROM product_gallery WHERE id='$product_gal_id'";
        $result_stocks=$this->db->query($delete_comb);
        if($result_stocks){
          echo "success";
        }else{
          echo "failure";
        }
      }

      function get_upload_gallery_file($product_token,$file_name,$user_id){
        $id=base64_decode($product_token)/9876;
        $tag_cnt=count($file_name);
        for($i=0;$i<$tag_cnt;$i++){
        $product_gal=$file_name[$i];
         $reg_query="INSERT INTO product_gallery (product_id,gallery_img,status,created_at,created_by) VALUES('$id','$product_gal','Active',NOW(),'$user_id')";
          $req_q=$this->db->query($reg_query);

       }
       if($req_q){
         $data = array("status" => "success");
         return $data;
       }else{
         $data = array("status" => "failed");
         return $data;
       }
      }


      function get_all_active_product(){
        $select="SELECT * FROM products WHERE status='Active'";
        $res=$this->db->query($select);
         return $res->result();
      }

      function get_product_price($prod_id){
         $select="SELECT prod_actual_price FROM products WHERE id='$prod_id'";
        $res=$this->db->query($select);
        return $res->result();
      }


}
