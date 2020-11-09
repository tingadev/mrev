<?php
	include "sendMail.php";
	$link_cart = curPageURL();
	$link_products = "./".$lang."/".$products_lang['product_link'];
	$link_method = "./".$lang."/shopping_method";
	$link_finished = "./shopping_finished";
	$finished = 0;
	$order_code_f = "";
	if(isset($_POST['submit_bill'])){
		global $connection;
		$date_now = date("Y-m-d H:i:s");
		$random = rand(100, 999);
		$order_sum['date_order'] =  strtotime($date_now);
		$order_code =strtotime($date_now);
		$order_sum['d_address'] = $_POST['address'];
		$order_sum['order_code'] = $_POST['order_id'];
		$order_sum['bill'] = 1;
		if($lang == 'vn'){
			$order_sum['bill'] = 0;
			$order_sum['order_code'] = "000-".$order_code.$random;
			$order_sum['d_address'] = $_POST['address'].", ".getWard($_POST['ward']).", ".getState($lang,$_POST['district']).", ".getCity($lang,$_POST['country']);
		}
		$code_replace = $order_sum['order_code'];
		$order_sum['d_name'] = $_POST['name'];
		$order_sum['d_email'] = $_POST['email'];
		$order_sum['d_phone'] = $_POST['phone'];
		
		
		$order_sum['note'] = $_POST['note'];
		$order_sum['total_price'] = $_POST['totals_price_sum'];
		$order_sum['lang'] = $lang;


		//INSERT TO ORDER_SUM
		$res_sum = insert('order_sum',$order_sum,'submit_bill');
		if($res_sum['mysqli_insert_id']) {
        	$order_detail_id = $res_sum['mysqli_insert_id'];
        	$query_in = "INSERT into order_detail(order_id,item_id,quantity,item_title,item_picture,item_link,item_price,size,color,sen)
					SELECT '{$order_detail_id}',item_id,quantity,title,src,link,price,size,color,sen from order_shopping where session = '$session_id'";
					$select_in = mysqli_query($connection,$query_in);	
			if($select_in){
				
				

				//GET BODY MAIL
				$body_mid = getMailTem($lang,$session_id,$products_config['ratio']);

				//GET MAIL TEMPLATE CUSTOMER
				$query_cus = "SELECT *from mail_template where m_id = 1 and lang ='$lang'";
				  $select_cus = mysqli_query($connection,$query_cus);
				  if(mysqli_num_rows($select_cus)){
				    if($row_cus = mysqli_fetch_assoc($select_cus)){
				      $mail_full_body_cus = $row_cus['description'];
				      
				    }
				  }

				 //GET MAIL TEMPLATE CUSTOMER
				$query_ad = "SELECT *from mail_template where m_id = 2 and lang ='$lang'";
				  $select_ad = mysqli_query($connection,$query_ad);
				  if(mysqli_num_rows($select_ad)){
				    if($row_ad = mysqli_fetch_assoc($select_ad)){
				      $mail_full_body_ad = $row_ad['description'];
				      
				    }
				  } 

				//REPLACE MAIL BODY
				$arr_find_cus = array('{replace}','{replace_code}');
				$arr_replace_cus = array($body_mid,$code_replace);
				$body_cus = str_replace($arr_find_cus, $arr_replace_cus, $mail_full_body_cus);

				$arr_find_ad = array('{replace}','{name}','{phone}','{email}','{address}','{note}');
				$arr_replace_ad = array($body_mid,$order_sum['d_name'],$order_sum['d_phone'],$order_sum['d_email'],$order_sum['d_address'],$order_sum['note']);
				$body_ad = str_replace($arr_find_ad, $arr_replace_ad, $mail_full_body_ad);


				$res_cus = sendMail_Bill('empty','MREV',$order_sum['d_email'],$products_lang['info_cart_mail'],$body_cus);
				if($res_cus){
					$res_ad = sendMail_Bill($order_sum['d_email'],$order_sum['d_name'],'empty',$products_lang['info_cart_mail'],$body_ad);
					if($res_ad)
					{
						$finished = 1;
						
						$remove_query = "DELETE from order_shopping where session ='$session_id'"; 
						$remove_sp = mysqli_query($connection,$remove_query);
						if($remove_sp){
							$query_f = "SELECT order_code from order_sum where order_code = '$code_replace'";
							$select_f = mysqli_query($connection,$query_f);
							$count_f = mysqli_num_rows($select_f);
							if($count_f){
								if($row_f = mysqli_fetch_assoc($select_f)){
									$_SESSION['order_code'] = $row_f['order_code'];
								}
								
							}
							header('Location: '.$link_finished);
							
						}
						
					}
				}
				


			}				
        }

	
		
	}


		//CART
	
		$list_cart = getListCart($lang,$session_id,$products_lang['empty_cart'],$products_lang['back_buy'],$link_products,$products_config['ratio']);

		//METHOD
		
		$list_method = getListCart($lang,$session_id,$products_lang['empty_cart'],$products_lang['back_buy'],$link_products,$products_config['ratio']);
		$list_city = getCities($lang);
		
		$payment_method = getPayment($lang);
		$shipping_fee = getShippingFee();
		
		//FINISHED 
		
		


	


	function getShippingFee(){
		global $connection;
		$query = "SELECT *from shipping_fee order by fee asc"; 
		$item = [];
		$select = mysqli_query($connection,$query);
		if(mysqli_num_rows($select)){
			while($row = mysqli_fetch_assoc($select)){
				array_push($item,$row);
			}
		}
		return $item;
	}
	function getListCart($lang,$session_id,$mess,$back,$link,$ratio){
		global $connection;
		$query = "SELECT *from order_shopping where session ='$session_id'"; 
		// die($query);
		$select = mysqli_query($connection,$query);
		$item = array();
		$totals = 0;
		if(mysqli_num_rows($select)){
			while($row = mysqli_fetch_assoc($select)){
				
				$price = number_format($row['price'], 0, '', '.');
				$price_temp = $row['price'] * $row['quantity'];
				$row['price_temp'] = number_format($price_temp,0,'','.');
				$totals = $totals + $price_temp;
				$row['totals'] = $totals;
				
				if($lang =='en'){
					
					$price = $row['price'];
					$row['price_temp'] = $price_temp;
					
				}
				$row['link'] = $lang."/".$row['link'];
				
				$row['price_real'] = $row['price'];
				$row['price'] = $price;
				

				array_push($item, $row);
			}

		}
		else{
			$item = '<h2 class="empty_cart">'.$mess.'</h2>';
			$item .= '<a class="back_buy" href="'.$link.'">'.$back.'</a>';
		}
		return $item;
	}
	function getCities($lang){
		global $connection;
		$query = "SELECT *from iso_cities"; 
		$select = mysqli_query($connection,$query);
		$list = "";
		while($row = mysqli_fetch_assoc($select)){
			if($lang == 'vn')
			{
				$name = $row['name'];
			}
			else{
				$name = $row['name_en'];
			}
			$list .="<option value='".$row['id']."'>".$name."</option>" ;
		}
		return $list;
	}
	function getCity($lang,$id){
		global $connection;
		$query = "SELECT *from iso_cities where id = $id"; 
		$select = mysqli_query($connection,$query);
		$list = "";
		while($row = mysqli_fetch_assoc($select)){
			if($lang == 'vn')
			{
				$name = $row['name'];
			}
			else{
				$name = $row['name_en'] ;
			}
		}
		return $name;
			
	}
	function getState($lang,$id){
		global $connection;
		$query = "SELECT *from iso_states where id = $id"; 
		$select = mysqli_query($connection,$query);
		$list = "";
		while($row = mysqli_fetch_assoc($select)){
			if($lang == 'vn')
			{
				$name = $row['name'];
			}
			else{
				$name = $row['name_en'];
			}
			$list = $name ;
		}
		return $list;
	}
	function getWard($id){
		global $connection;
		$query = "SELECT *from iso_wards where id = $id"; 
		$select = mysqli_query($connection,$query);

		while($row = mysqli_fetch_assoc($select)){
			$name = $row['name'];
			
		}
		return $name;
	}
	function getPayment($lang){
		global $connection;
		$query = "SELECT *from payment_method where display = 1 and lang = '$lang' limit 0,1"; 
		$select = mysqli_query($connection,$query);
		$list = "";
		while($row = mysqli_fetch_assoc($select)){
			
			$list = $row ;
		}
		return $list;
	}
	function getHTMLFinish($lang){
		global $connection;
				$query_cus = "SELECT *from mail_template where m_id = 3 and lang ='$lang'";
				  $select_cus = mysqli_query($connection,$query_cus);
				  if(mysqli_num_rows($select_cus)){
				    if($row_cus = mysqli_fetch_assoc($select_cus)){
				      $mail_full_body_cus = $row_cus['description'];
				      
				    }
				  }
				  return $mail_full_body_cus;

	}
	function getMailTem($lang,$session_id,$ratio){
		global $connection;
		$query = "SELECT *from order_shopping where session ='$session_id'"; 
		// die($query);
		$select = mysqli_query($connection,$query);
		$item = array();
		$totals = 0;
		$body = '';
		if(mysqli_num_rows($select)){
			while($row = mysqli_fetch_assoc($select)){
				$title = $row['title'];
				$quantity = $row['quantity'];
				$price_temp = $row['price'] * $row['quantity'];
				$totals = $totals + $price_temp;
				$unit = 'VND';
				$size = $row['size'];
				$sen = $row['sen'];
				$color = $row['color'];
				$color = explode(',', $color);
				$src = $_SERVER['SERVER_NAME']."/".$row['src'];
				$row['price_temp'] = number_format($price_temp,0,'','.');
				
				if($lang =='en'){
					
					$unit = 'USD';
					$row['price_temp'] = $price_temp;
					
					
				}
				$price = $row['price_temp'] . ' ' . $unit;
				// $row['link'] = $lang."/".$row['link'];
				

				$body .= '<div class="start" style="background-color:transparent;">
						<div class="block-grid four-up no-stack" style="Margin: 0 auto; min-width: 320px; max-width: 650px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #FFFFFF;">
							<div style="border-collapse: collapse;display: table;width: 100%;background-color:#FFFFFF;">
								<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:650px"><tr class="layout-full-width" style="background-color:#FFFFFF"><![endif]-->
								<!--[if (mso)|(IE)]><td align="center" width="162" style="background-color:#FFFFFF;width:162px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
								<div class="col num3" style="max-width: 320px; min-width: 162px; display: table-cell; vertical-align: top; width: 162px;">
									<div style="width:100% !important;">
										<!--[if (!mso)&(!IE)]><!-->
										<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:5px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
											<!--<![endif]-->
											<div align="center" class="img-container center fixedwidth" style="padding-right: 0px;padding-left: 0px;">
												<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr style="line-height:0px"><td style="padding-right: 0px;padding-left: 0px;" align="center"><![endif]--><img align="center" alt="Image" border="0" class="center fixedwidth" src="'.$src.'" style="text-decoration: none; -ms-interpolation-mode: bicubic; border: 0; height: auto; width: 100%; max-width: 130px; display: block;" title="Image" width="130" />
												<!--[if mso]></td></tr></table><![endif]-->
											</div>
											<!--[if (!mso)&(!IE)]><!-->
										</div>
										<!--<![endif]-->
									</div>
								</div>
								<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
								<!--[if (mso)|(IE)]></td><td align="center" width="162" style="background-color:#FFFFFF;width:162px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 1px dotted #E8E8E8;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:30px; padding-bottom:35px;"><![endif]-->
								<div class="col num3" style="max-width: 320px; min-width: 162px; display: table-cell; vertical-align: top; width: 161px;">
									<div style="width:100% !important;">
										<!--[if (!mso)&(!IE)]><!-->
										<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:1px dotted #E8E8E8; padding-top:30px; padding-bottom:35px; padding-right: 0px; padding-left: 0px;">
											<!--<![endif]-->
											<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 0px; padding-top: 10px; padding-bottom: 5px; font-family: Tahoma, Verdana, sans-serif"><![endif]-->
											<div style="color:#555555;font-family:'."Lato".', Tahoma, Verdana, Segoe, sans-serif;line-height:120%;padding-top:10px;padding-right:10px;padding-bottom:5px;padding-left:0px;">
												<div style="font-size: 12px; line-height: 14px; font-family: '."Lato".', Tahoma, Verdana, Segoe, sans-serif; color: #555555;">
													<p style="font-size: 14px; line-height: 19px; text-align: left; margin: 0;"><span style="font-size:16px;color:#2190e3"><strong>'.$title.'</strong>
<br>Size: '.$size.'
<br>Sên '.$sen.'
<br>Color:<strong style="display:inline-block;width:17px;height:17px;background:#'.$color[0].';margin-left:10px;"></strong><strong style="
    margin-left: 5px;
">'.$color[1].'</strong></span></p>
												</div>
											</div>
											<!--[if mso]></td></tr></table><![endif]-->
											<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 0px; padding-top: 0px; padding-bottom: 10px; font-family: Tahoma, Verdana, sans-serif"><![endif]-->
											<div style="color:#555555;font-family:'."Lato".', Tahoma, Verdana, Segoe, sans-serif;line-height:120%;padding-top:0px;padding-right:10px;padding-bottom:10px;padding-left:0px;">
												<div style="font-size: 12px; line-height: 14px; font-family: '."Lato".', Tahoma, Verdana, Segoe, sans-serif; color: #555555;">
													<p style="font-size: 14px; line-height: 16px; text-align: left; margin: 0;"></p>
												</div>
											</div>
											<!--[if mso]></td></tr></table><![endif]-->
											<!--[if (!mso)&(!IE)]><!-->
										</div>
										<!--<![endif]-->
									</div>
								</div>
								<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
								<!--[if (mso)|(IE)]></td><td align="center" width="162" style="background-color:#FFFFFF;width:162px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 1px dotted #E8E8E8;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:55px; padding-bottom:5px;"><![endif]-->
								<div class="col num3" style="max-width: 320px; min-width: 162px; display: table-cell; vertical-align: top; width: 161px;">
									<div style="width:100% !important;">
										<!--[if (!mso)&(!IE)]><!-->
										<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:1px dotted #E8E8E8; padding-top:55px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
											<!--<![endif]-->
											<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 0px; padding-bottom: 10px; font-family: Tahoma, Verdana, sans-serif"><![endif]-->
											<div style="color:#555555;font-family:'."Lato".', Tahoma, Verdana, Segoe, sans-serif;line-height:120%;padding-top:0px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
												<div style="font-size: 12px; line-height: 14px; font-family: '."Lato".', Tahoma, Verdana, Segoe, sans-serif; color: #555555;">
													<p style="font-size: 14px; line-height: 24px; text-align: center; margin: 0;"><span style="font-size: 20px;"><strong>'.$quantity.'</strong></span></p>
												</div>
											</div>
											<!--[if mso]></td></tr></table><![endif]-->
											<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
												<tbody>
													<tr style="vertical-align: top;" valign="top">
														<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;" valign="top">
															<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" height="30" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; border-top: 0px solid transparent; height: 30px;" valign="top" width="100%">
																<tbody>
																	<tr style="vertical-align: top;" valign="top">
																		<td height="30" style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
																	</tr>
																</tbody>
															</table>
														</td>
													</tr>
												</tbody>
											</table>
											<!--[if (!mso)&(!IE)]><!-->
										</div>
										<!--<![endif]-->
									</div>
								</div>
								<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
								<!--[if (mso)|(IE)]></td><td align="center" width="162" style="background-color:#FFFFFF;width:162px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:55px; padding-bottom:5px;"><![endif]-->
								<div class="col num3" style="max-width: 320px; min-width: 162px; display: table-cell; vertical-align: top; width: 162px;">
									<div style="width:100% !important;">
										<!--[if (!mso)&(!IE)]><!-->
										<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:55px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
											<!--<![endif]-->
											<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 15px; padding-left: 0px; padding-top: 0px; padding-bottom: 0px; font-family: Tahoma, Verdana, sans-serif"><![endif]-->
											<div style="color:#555555;font-family:'."Lato".', Tahoma, Verdana, Segoe, sans-serif;line-height:120%;padding-top:0px;padding-right:15px;padding-bottom:0px;padding-left:0px;">
												<div style="line-height: 14px; font-size: 12px; font-family: '."Lato".', Tahoma, Verdana, Segoe, sans-serif; color: #555555;">
													<p style="line-height: 24px; text-align: center; font-size: 12px; margin: 0;"><span style="font-size: 20px;"><span style="line-height: 24px; font-size: 20px;"><strong>'.$price.'</strong></span></span></p>
												</div>
											</div>
											<!--[if mso]></td></tr></table><![endif]-->
											<!--[if (!mso)&(!IE)]><!-->
										</div>
										<!--<![endif]-->
									</div>
								</div>
								<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
								<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
							</div>
						</div>
					</div>';
			}
			if($lang == 'vn'){
				$totals = number_format($totals,0,'','.').' '.$unit;
			}
			else{

				$totals = $totals.' '.$unit;
			}
			
			$body .= '<div class="start" style="background-color:transparent;">
						<div class="block-grid four-up no-stack" style="Margin: 0 auto; min-width: 320px; max-width: 650px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: #FFFFFF;">
							<div style="border-collapse: collapse;display: table;width: 100%;background-color:#FFFFFF;">
								<!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:650px"><tr class="layout-full-width" style="background-color:#FFFFFF"><![endif]-->
								<!--[if (mso)|(IE)]><td align="center" width="162" style="background-color:#FFFFFF;width:162px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
								
								<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
								<!--[if (mso)|(IE)]></td><td align="center" width="162" style="background-color:#FFFFFF;width:162px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 1px dotted #E8E8E8;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:30px; padding-bottom:35px;"><![endif]-->
								<div class="col num3" style="max-width: 320px; min-width: 162px; display: table-cell; vertical-align: top; width: 161px;">
									<div style="width:100% !important;">
										<!--[if (!mso)&(!IE)]><!-->
										<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:1px dotted #E8E8E8; padding-top:30px; padding-bottom:35px; padding-right: 0px; padding-left: 0px;">
											<!--<![endif]-->
											<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 0px; padding-top: 10px; padding-bottom: 5px; font-family: Tahoma, Verdana, sans-serif"><![endif]-->
											<div style="color:#555555;font-family:'."Lato".', Tahoma, Verdana, Segoe, sans-serif;line-height:120%;padding-top:10px;padding-right:10px;padding-bottom:5px;padding-left:0px;">
												<div style="font-size: 12px; line-height: 14px; font-family: '."Lato".', Tahoma, Verdana, Segoe, sans-serif; color: #555555;">
													<p style="font-size: 14px; line-height: 19px; text-align: left; margin: 0;"><span style="font-size:16px;color:#2190e3"><strong></strong></span></p>
												</div>
											</div>
											<!--[if mso]></td></tr></table><![endif]-->
											<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 0px; padding-top: 0px; padding-bottom: 10px; font-family: Tahoma, Verdana, sans-serif"><![endif]-->
											<div style="color:#555555;font-family:'."Lato".', Tahoma, Verdana, Segoe, sans-serif;line-height:120%;padding-top:0px;padding-right:10px;padding-bottom:10px;padding-left:0px;">
												<div style="font-size: 12px; line-height: 14px; font-family: '."Lato".', Tahoma, Verdana, Segoe, sans-serif; color: #555555;">
													<p style="font-size: 14px; line-height: 16px; text-align: left; margin: 0;"></p>
												</div>
											</div>
											<!--[if mso]></td></tr></table><![endif]-->
											<!--[if (!mso)&(!IE)]><!-->
										</div>
										<!--<![endif]-->
									</div>
								</div>
								<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
								<!--[if (mso)|(IE)]></td><td align="center" width="162" style="background-color:#FFFFFF;width:162px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 1px dotted #E8E8E8;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:55px; padding-bottom:5px;"><![endif]-->
								<div class="col num3" style="max-width: 320px; min-width: 162px; display: table-cell; vertical-align: top; width: 161px;">
									<div style="width:100% !important;">
										<!--[if (!mso)&(!IE)]><!-->
										<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:1px dotted #E8E8E8; padding-top:55px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
											<!--<![endif]-->
											<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 0px; padding-bottom: 10px; font-family: Tahoma, Verdana, sans-serif"><![endif]-->
											<div style="color:#555555;font-family:'."Lato".', Tahoma, Verdana, Segoe, sans-serif;line-height:120%;padding-top:0px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
												<div style="font-size: 12px; line-height: 14px; font-family: '."Lato".', Tahoma, Verdana, Segoe, sans-serif; color: #555555;">
													<p style="font-size: 14px; line-height: 24px; text-align: center; margin: 0;"><span style="font-size: 20px;"><strong>Total</strong></span></p>
												</div>
											</div>
											<!--[if mso]></td></tr></table><![endif]-->
											<table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
												<tbody>
													<tr style="vertical-align: top;" valign="top">
														<td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px;" valign="top">
															<table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" height="30" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; border-top: 0px solid transparent; height: 30px;" valign="top" width="100%">
																<tbody>
																	<tr style="vertical-align: top;" valign="top">
																		<td height="30" style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top"><span></span></td>
																	</tr>
																</tbody>
															</table>
														</td>
													</tr>
												</tbody>
											</table>
											<!--[if (!mso)&(!IE)]><!-->
										</div>
										<!--<![endif]-->
									</div>
								</div>
								<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
								<!--[if (mso)|(IE)]></td><td align="center" width="162" style="background-color:#FFFFFF;width:162px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:55px; padding-bottom:5px;"><![endif]-->
								<div class="col num3" style="max-width: 320px; min-width: 162px; display: table-cell; vertical-align: top; width: 162px;">
									<div style="width:100% !important;">
										<!--[if (!mso)&(!IE)]><!-->
										<div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:55px; padding-bottom:5px; padding-right: 0px; padding-left: 0px;">
											<!--<![endif]-->
											<!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 15px; padding-left: 0px; padding-top: 0px; padding-bottom: 0px; font-family: Tahoma, Verdana, sans-serif"><![endif]-->
											<div style="color:#555555;font-family:'."Lato".', Tahoma, Verdana, Segoe, sans-serif;line-height:120%;padding-top:0px;padding-right:15px;padding-bottom:0px;padding-left:0px;">
												<div style="line-height: 14px; font-size: 12px; font-family: '."Lato".', Tahoma, Verdana, Segoe, sans-serif; color: #555555;">
													<p style="line-height: 24px; text-align: center; font-size: 12px; margin: 0;"><span style="font-size: 20px;"><span style="line-height: 24px; font-size: 20px;"><strong>'.$totals.'</strong></span></span></p>
												</div>
											</div>
											<!--[if mso]></td></tr></table><![endif]-->
											<!--[if (!mso)&(!IE)]><!-->
										</div>
										<!--<![endif]-->
									</div>
								</div>
								<!--[if (mso)|(IE)]></td></tr></table><![endif]-->
								<!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
							</div>
						</div>
					</div>';

		}
		
		return $body;
	}

?>