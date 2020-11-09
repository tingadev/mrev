
<?php echo getBanner('banner_products'); ?>
<!--  BREADCRUM-->
<div class="wrapper">
  <?php
   echo $breadcrum;
    ?>
</div>
<div class="clear"></div>
		<div class="wrapCont">
			<div class="wrapper">
				<div class="box_mid">

					<div class="mid-content">

						<!-- PRODUCT CONTAINER -->
						<div class="l-wrapper">
							<div class="productWrap">
								<div class="row">
									<div class="col">
										<div class="productThumbnail">
											<div id="vnt-thumbnail-for">
												<div class="item">
															<div class="img"><a data-fancybox="fancyThumb" href="<?php echo $detail_product['src'] ?>" alt="" /><img src="<?php echo $detail_product['src'] ?>" alt="" /></a></div>
														</div>
												<?php
												// print_r($detail_product_img);die;
													foreach ($detail_product_img as $key => $value) {
													?>
														<div class="item">
															<div class="img"><a data-fancybox="fancyThumb" href="<?php echo $value; ?>" alt="" /><img src="<?php echo $value; ?>" alt="" /></a></div>
														</div>
													<?php
													}
												?>
												

											</div>
											<div id="vnt-thumbnail-nav">
												<!--==IMAGES CROP RIGHT SIZE 80X80==-->
												<div class="item">
													<div class="img"><img src="<?php echo $detail_product['src'] ?>" alt="" width="80px" height="80px" /></div>
												</div>
												<?php
													foreach ($detail_product_img as $key => $value) {
													?>
														<div class="item">
															<div class="img"><img src="<?php echo $value; ?>" alt="" /></a></div>
														</div>
													<?php
													}
												?>

											</div>
										</div>

									</div>
									<div class="col">
										<div class="productTitle">
											<h1><?php echo $detail_product['title']; ?></h1>
											<div class="bb-box-h-line-3"></div>
										</div>
										<div class="productDes">
											<?php echo $detail_product['short_desc']; ?>
										</div>
										<div class="price">
											<p><?php echo $products_lang['price']; ?>: 
												<?php
													if($detail_product['price']==0){
														echo '<span class="num">'.$global_lang['order_contact'].'</span>';
													}
													else{
														echo '<span class="num">'.$detail_product['price'].'</span><span class="unit">'.$global_lang['unit'].'</span>';
													}
												?>
												
											</p>
										</div>
										<div class="productAttr">
											<ul>
												<?php echo $detail_op; ?> 
												<?php if(is_array($size_d)){
													?>
												<li>
												<?php echo $products_lang['size']; ?>
												<select name="size" style="margin-left: 20px;" onchange="getSize(this.value)">
													<option value="0"><?php echo $products_lang['choose_size']; ?></option>
													<?php
													
														foreach ($size_d as $key => $value) {
															echo '<option value="'.$value.'">'.$value.'</option>';
														}

													?>
													</select>
													<input type="hidden" id="size" value="0">
												</li>
												
												<?php
												} 
												?>
												<?php if(is_array($sen_d)){
													?>
												<li>
												<?php echo $products_lang['sen']; ?>
												<select name="sen" style="margin-left: 20px;" onchange="getSen(this.value)">
													<option value="0"><?php echo $products_lang['choose_sen']; ?></option>
													<?php
													
														foreach ($sen_d as $key => $value) {
															echo '<option value="'.$value.'">'.$value.'</option>';
														}

													?>
													</select>
													<input type="hidden" id="sen" value="0">
												</li>
												
												<?php
												} 
												?>

												<?php if(is_array($color_d)){
													?>
												<li>
												<?php echo $products_lang['color']; ?>
												<ul class="color_d">

													<!-- <option value="0"><?php ?></option> -->
													<?php
														
														foreach ($color_d as $key => $value) {
															global $connection;
															$query = "SELECT name from color_table where code = '{$value}'";
															$select=mysqli_query($connection,$query);
															if($select){
																while($row = mysqli_fetch_assoc($select)){
																	$title = $row['name'];
																}
															}
															echo '<li><input type="radio" id="r'.$key.'" name="color_s" value="'.$value.','.$title.'" onchange="getColor(this.value);"><div style="background: #'.$value.'; width: 20px; height:20px; margin: 0 auto;"></div><div style="font-size:16px;">'.$title.'</div>
															</li>';
														}

													?>
													</ul>
													<input type="hidden" id="color" value="0">
													<div class="clear"></div>
												</li>
												<?php
												} 
												?>
												<li><?php echo $products_lang['title_status']; ?><?php echo $out_of_stock; ?></li>
											</ul>
											<div class="note_size">
												<p><?php echo $products_lang['note_size']; ?></p>
											</div>
										</div>


										<div class="productInfo bb">
											<div class="productCart">
												<div class="gridC">
													<div class="colC1">
														<div class="quantity">
                                                                    <button type="button" href="javascript:void(0)" onclick="changeQuantity('quantity_<?php echo $detail_product['p_id']; ?>','decrease',<?php echo $detail_product['p_id']; ?>);" class="btn-quan btn-down"><i class="fa fa-minus"></i></button>
                                                                     <input type="text"  class="form-control quantity" id="quantity_<?php echo $detail_product['p_id']; ?>" name="quantity[<?php echo $detail_product['p_id']; ?>]" value="1" onkeyup="updateQuantity(<?php echo $detail_product['p_id']; ?>)"  />
                                                                    <button type="button" onclick="changeQuantity('quantity_<?php echo $detail_product['p_id']; ?>','increase',<?php echo $detail_product['p_id']; ?>);" class="btn-quan btn-up"><i class="fa fa-plus"></i></button>
                                                                    <div class="clear"></div>
                                                                </div>
													</div>
													<div class="colC2">
														<button class="btn-sub" onclick="do_AddItemFlyCart('helo',<?php echo $detail_product['p_id']; ?>,'<?php echo $detail_product['title']; ?>','<?php echo $detail_product['src']; ?>','<?php echo $detail_product['link']; ?>','<?php echo $detail_product['price_real']; ?>',<?php echo $detail_product['stock']; ?>);"><span><?php echo $global_lang['add_cart']; ?></span></button>
														<button class="btn-buy-now" onclick="do_AddItemCart('helo',<?php echo $detail_product['p_id']; ?>,'<?php echo $detail_product['title']; ?>','<?php echo $detail_product['src']; ?>','<?php echo $detail_product['link']; ?>','<?php echo $detail_product['price_real']; ?>',<?php echo $detail_product['stock']; ?>);"><span><?php echo $global_lang['buy_now']; ?></span></button>
													</div>
												</div>
											</div>
										</div>

										<div class="productShare">
											<ul>
												<li><a href="https://www.facebook.com/sharer.php?u=<?php echo $link_share; ?>"><i class="fab fa-facebook-f"></i></a></li>
												<li><a href=""><i class="fab fa-instagram"></i></a></li>
												<li><a href=""><i class="fab fa-youtube-square"></i></a></li>
												
											</ul>
										</div>
									</div>
								</div>
							</div>
							<div class="clear"></div>
							<div class="productContent">
								<div class="title_tab">
									<h5>
										<?php echo $products_lang['detail_p']; ?>
									</h5>
								</div>

								<div class="tab-content ">
									<div class="tab-pane active vnt-tab-content" id="tab1">
										<div class="the-content desc">
											<div class="boxProduct">

												<?php echo $detail_product['description']; ?>



											</div>
										</div>
									</div>

								</div>
							</div>
						</div>


						<!-- PRODUCT CONTAINER -->

						<!--RECENT VIEW-->
						<div class="l-wrapper">

							<div class="recent-view">
								<div class="r-title">
									<h5>
										<?php echo $products_lang['related_p']; ?>
									</h5>
								</div>

								<div class="s-container" id="product-related">
									<?php
										foreach ($detail_product_related as $key => $value) {
													?>

												<div class="s-box">
										<div class="img">
											<a class="a_img" href="<?php echo $value['link']; ?>" alt=""><img src="<?php echo $value['src']; ?>" alt="<?php echo $value['title']; ?>"></a>
											
										</div>
										<div class="i_title">
												<h3><a href="<?php echo $value['link']; ?>"><?php echo $value['title']; ?></a></h3>
											</div>
											<div class="i_price">
												<?php
													if($value['price']==0){
														echo $global_lang['order_contact'];
													}
													else{
														echo $value['price'].' '.$global_lang['unit'];
													}
												?>
												
											</div>
									</div>

													<?php
												}
												?>
									
									

								</div>
							</div>



						</div>
						<!--RECENT VIEW-->



					</div>

				</div>

			</div>






		</div>