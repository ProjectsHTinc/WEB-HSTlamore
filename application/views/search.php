	<?php
		if (count($search_result)>0){
			foreach($search_result as $prod){ 
				$search_word = $prod->tag_name;
			}
		} else {
			$search_word ="";
		}
	?>
	<!-- Categories Product Start -->
	<div class="all-categories pb-100">
		<div class="container">
			<div class="row">
			   <!-- Sidebar Content Start -->
				<div class="col-md-12">
					<!-- Sidebar Right Top Content Start -->
					<div class="sidebar-desc-content pb-50 pt-50">
						<h4>Search Keyword : <?php echo $search_word; ?></h4><hr>
					</div>
					<!-- Sidebar Right Top Content Start -->
					<!-- Best Seller Product Start -->
					<div class="best-seller">
						<!--
						<div class="row mt-20">
							<div class="col-md-3 col-sm-4 pull-left"></div>
							<div class="col-md-4 col-sm-5 pull-right">
								<select name="shorer" id="shorter" class="form-control select-varient">
									<option value="#">Sort By:Default</option>
									<option value="#">Sort By:Name (A - Z)</option>
									<option value="#">Sort By:Name (Z - A)</option>
									<option value="#">Sort By:Price (Low > High)</option>
									<option value="#">Sort By:Price (High > Low)</option>
								</select>
							</div>
						</div>
						-->
						<div class="row">
							<div class="col-sm-12">
								<div class="tab-content categorie-list">
									
									<div id="grid-view" class="tab-pane fade in active mt-40">
                                            <div class="row">
                                            <?php
											if (count($search_result)>0){
												foreach($search_result as $prod){ 
													$sproduct_id = $prod->id;
													$product_id = $prod->id * 663399;
													$enc_product_name = strtolower(preg_replace("/[^\w]/", "-", $prod->product_name));
													$enc_product_id = base64_encode($product_id);
													$combined_status = $prod->combined_status;
													$offer_status = $prod->offer_status;
													$prod_actual_price = $prod->prod_actual_price;
													$stocks_left = $prod->stocks_left;
													$posteddate = date("d-m-Y",strtotime($prod->created_at));
													$check_date = date("d-m-Y",strtotime("-15 day"));
													if ($offer_status =='1'){
														$offer_details = $this->homemodel->get_offer_details($sproduct_id);
													if (count($offer_details)>0){
														foreach($offer_details as $offer){ 
															$offer_percentage = $offer->offer_percentage;
														}
													}
														$soffer_price = ($offer_percentage / 100) * $prod_actual_price;
														$doffer_price = $prod_actual_price - $soffer_price;
														$offer_price = number_format((float)$doffer_price, 2, '.', '');
													}
                                            ?>
                                                <div class="col-md-3 col-sm-6">
                                                    <!-- Single Product Start -->
                                                    <div class="single-product">
                                                        <!-- Product Image Start -->
                                                        <div class="pro-img">
                                                            <a href="<?php echo base_url(); ?>home/product_details/<?php echo $sproduct_id; ?>/<?php echo $enc_product_name ; ?>/">
                                                               <img class="primary-img" src="<?php echo base_url(); ?>assets/products/<?php echo $prod->product_cover_img; ?>" alt="single-product">
                                                            </a>
                                                            <!--<div class="quick-view">
                                                                <a href="#" data-toggle="modal" data-target="#myModal"><i class="pe-7s-look"></i>quick view</a>
                                                            </div>-->
                                                            <?php 
                                                                if (strtotime($posteddate) >= strtotime($check_date)) 
                                                                {
                                                                     echo '<span class="sticker-new">new</span>';
                                                                } 
                                                               ?>
                                                        </div>
                                                        <!-- Product Image End -->
                                                        <!-- Product Content Start -->
                                                        <div class="pro-content text-center">
                                                            <h4><a href="<?php echo base_url(); ?>home/product_details/<?php echo $sproduct_id; ?>/<?php echo $enc_product_name ; ?>/"><?php echo $prod->product_name; ?></a></h4>
                                         <?php if ($offer_status == '1'){ ?>
                                        <p class="price"><span class="mrp">₹<?php echo $prod_actual_price;?></span> <span>₹<?php echo $offer_price;?></span></p>										<?php } else { ?>
                                        <p class="price"><span>₹<?php echo $prod_actual_price;?></span></p>
                                        <?php } ?>
											<div class="action-links2">
                                                      <?php 
										 if ($stocks_left>0){
											 if ($combined_status == '1'){ ?>
												<a data-toggle="tooltip" title="View Products" href="<?php echo base_url(); ?>home/product_details/<?php echo $sproduct_id; ?>/<?php echo $enc_product_name ; ?>/" style="background:#FAA320;">view products</a>
											<?php } else { ?>
												<a data-toggle="tooltip" title="Add to Cart" href="<?php echo base_url(); ?>home/addcart/<?php echo $sproduct_id; ?>/">add to cart</a>
											 <?php }
										 } else {
										?>
											 <a data-toggle="tooltip" title="Out of Stock" style="background:#e11313;">Out of Stock</a>
										 <?php } ?>
                                             </div>
                                                        </div>
                                                        <!-- Product Content End -->
                                                    </div>
                                                    <!-- Single Product End -->
                                                </div>
                                               <?php
												}
											}
											?>
 
                                            </div>
                                            <!-- Row End -->

                                        </div>
                                        <!-- #Grid-view End -->
								</div>
								<!-- .Tab Content End -->
							</div>
						</div>
						<!-- Row End -->
					</div>
					<!-- Best Seller Product End -->
				</div>
				<!-- Sidebar Content End -->
				
			</div>
			<!-- Row End -->
		</div>
		<!-- Container End -->
	</div>
	<!-- Categories Product End -->