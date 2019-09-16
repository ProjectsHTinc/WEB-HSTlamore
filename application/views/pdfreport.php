<?php
tcpdf();
$obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$obj_pdf->SetCreator(PDF_CREATOR);
$title = "Little A More";
$title1 = "";
$obj_pdf->SetTitle($title);
$obj_pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $title, PDF_HEADER_STRING);
$obj_pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
//$obj_pdf->setPrintHeader(false);
$obj_pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
$obj_pdf->SetDefaultMonospacedFont('dejavusans');
$obj_pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
$obj_pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$obj_pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
$obj_pdf->SetFont('dejavusans', '', 9);
$obj_pdf->setFontSubsetting(false);
$obj_pdf->AddPage();
ob_start();
    // we can have any view part here like HTML, PHP etc
	if (count($count_cart_session)>0){
			$html = '';
			$html .= '<table width="100%" border="0" cellspacing="1" cellpadding="5">
							<tr>
								<td width="50%" bgcolor="#333333" color="#ffffff">Product</td>
								<td width="15%" bgcolor="#333333" color="#ffffff">Price (INR)</td>
								<td width="15%" bgcolor="#333333" color="#ffffff">Quantity</td>
								<td width="20%" bgcolor="#333333" color="#ffffff">Total (INR)</td>
							</tr>
						<tbody>';
			$total_amount = '0';
				$check_quantity = array();
				foreach($count_cart_session as $clist){ 
					$cart_id = $clist->id;
					$sproduct_id = $clist->product_id;
					$product_name = $clist->product_name;
					
					$product_combined_id = $clist->product_combined_id;
					$product_id = $clist->product_id * 663399;
					$enc_product_name = strtolower(preg_replace("/[^\w]/", "-", $clist->product_name));
					$enc_product_id = base64_encode($product_id);
					$quantity = $clist->quantity;
					$stotal = $clist->total_amount;
					$price = $clist->price;
					$product_cover_img = $clist->product_cover_img;
					$stocks_left = $clist->stocks_left;
					
					if ($product_combined_id >0){
						$cproduct_details = $this->homemodel->get_colour_size($product_combined_id);
						if (count($cproduct_details)>0){
							foreach($cproduct_details as $cprod){ 
								 $product_size = $cprod->size;
								 $product_colour = $cprod->attribute_name;
								 $stocks_left = $cprod->stocks_left;
							}
						} 
					}else {
							$product_size = '';
							$product_colour = '';
						}
				$html .= '<tr>
							<td width="50%" bgcolor="#e3e2e2">'.$product_name.' '.$product_size.'  '.$product_colour.'</td>
							<td width="15%" bgcolor="#e3e2e2">'.$price.'</td>
							<td width="15%" bgcolor="#e3e2e2">'.$quantity.'</td>
							<td width="20%" bgcolor="#e3e2e2">'.$stotal.'</td>
						</tr>';
						$total_amount = $total_amount + $stotal;
				} 
				$html .= '<tr>
							<td width="50%"></td>
							<td width="15%"></td>
							<td width="15%" bgcolor="#d6d5d5">Subtotal</td>
							<td width="20%" bgcolor="#d6d5d5">'.number_format((float)$total_amount, 2, '.', '').'</td>
						</tr>';
				$html .= '<tr>
							<td width="50%"></td>
							<td width="15%"></td>
							<td width="15%" bgcolor="#d6d5d5">Total</td>
							<td width="20%" bgcolor="#d6d5d5">'.number_format((float)$total_amount, 2, '.', '').'</td>
						</tr>';
				$html .= '</table>';
		}
		//echo $html;
		//exit;
$obj_pdf->writeHTML($html, true, false, true, false, '');
$path = dirname(__FILE__) . '../../../assets/invoices/';
$file_name = 'output.pdf';
$full_path = $path . $file_name;
ob_end_clean();
$obj_pdf->Output($full_path, 'F');
?>