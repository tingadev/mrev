

<?php echo getBanner('banner_products'); ?>
<!--  BREADCRUM-->
<div class="wrapper">
  <?php echo $breadcrum; ?>
</div>

		<!--	HEADER AND BANNER-->
		<!--	PRODUCT-->
		<div class="uk-width-expand@m p2">
      <?php 
      if($box_search == 1){
        ?>
        <div class="box_search">
        <div class="wrapper">
          <div class="title">
            <h2><?php echo $global_lang['chose_type']; ?></h2>
          </div>
          <div class="child_box_search" uk-grid>
            <div class="col">
                <span class="custom-dropdown">
                  <select name="cat_id_p" id="cat_id_p" onchange="getCatSubProducts(this.value,'<?php echo $lang; ?>'); getCatListProducts(this.value,<?php echo $products_config['limit_display']; ?>,'<?php echo $lang; ?>','<?php echo $global_lang['param']; ?>','<?php echo $global_lang['add_cart']; ?>','<?php echo $global_lang['buy_now']; ?>','<?php echo $global_lang['unit']; ?>','<?php echo $global_lang['color']; ?>','<?php echo $global_lang['size']; ?>','<?php echo $global_lang['sen']; ?>'); passCatId(this.value);">
                    
                    <?php echo getCatProducts($lang,$itemID); ?>

                  </select>
                </span>
              </div>

              <div class="col">
                <span class="custom-dropdown">
                  <select name="cat_id_c" id="cat_id_c" onchange="getListProducts(this.value,<?php echo $products_config['limit_display']; ?>,'<?php echo $lang; ?>','<?php echo $global_lang['param']; ?>','<?php echo $global_lang['add_cart']; ?>','<?php echo $global_lang['buy_now']; ?>','<?php echo $global_lang['unit']; ?>','<?php echo $global_lang['color']; ?>','<?php echo $global_lang['size']; ?>','<?php echo $global_lang['sen']; ?>'); passCatId(this.value);">
                    <option value="-1">--- <?php echo $global_lang['type_brand']; ?> ---</option>
                     <?php echo $cat_sub_name; ?>

                  </select>
                </span>
              </div>
              <div class="col">

                <form class="uk-search uk-search-default" onsubmit="getListProductsKeys(0,<?php echo $products_config['limit_display']; ?>,'<?php echo $lang; ?>','<?php echo $global_lang['param']; ?>','<?php echo $global_lang['add_cart']; ?>','<?php echo $global_lang['buy_now']; ?>','<?php echo $global_lang['unit']; ?>','<?php echo $global_lang['color']; ?>','<?php echo $global_lang['size']; ?>','<?php echo $global_lang['sen']; ?>'); return false;">
                  <button class="uk-search-icon-flip" type="button" uk-search-icon onclick="getListProductsKeys(0,<?php echo $products_config['limit_display']; ?>,'<?php echo $lang; ?>','<?php echo $global_lang['param']; ?>','<?php echo $global_lang['add_cart']; ?>','<?php echo $global_lang['buy_now']; ?>','<?php echo $global_lang['unit']; ?>','<?php echo $global_lang['color']; ?>','<?php echo $global_lang['size']; ?>','<?php echo $global_lang['sen']; ?>');"></button>
                  <input class="uk-search-input" name="keywords" id="keywords" type="search" placeholder="Search...">
                </form>

              </div>
             

          </div>

        </div>
      </div>

   <?php
      }
       ?>
			


		</div>
		<section class="product">
			<div class="wrapper">
				<div class="uk-text-center" uk-grid>
					<div class="uk-width-expand@m p1">
						<div class="box_product" id='box_product'>
							<div class="title">

								<h2>

									<?php echo $title_cat; ?>

								</h2>

							</div>
							<div class="content" id="">
								<div class="loading_product"><span uk-spinner="ratio: 4.5"></span></div>
								<div class="uk-child-width-1-2 uk-text-center container_product" uk-grid id="results">
									<?php
                    foreach ($list_product_cat as $value) {
                        $id = $value['p_id'];
                        $title = $value['title'];
                        $src = "uploads/products/thumb/".$value['thumb'];
                        $link = $lang."/".$value['link'];
                        $size = $value['size'];
                        $sen = $value['sen'];
                        $color = $value['color'];
                        $stock = $value['stock'];
                        $price_real = $value['price'];
                        // die($price_real);
                        $price = number_format($value['price'], 0, '', ',')." ".$global_lang['unit'];
                        if($lang =='en'){
                         // $price_real = round(($value['price'] / $products_config['ratio']),3);
                         $price = $value['price']." ".$global_lang['unit'];
                        }
                        if($value['price']==0){
                          $price = $global_lang['order_contact'];
                        }
                        
                        
                        ?>

                        <div class="item animated" rel="yamaha" data-type="1">
                    <div class="product_box">
                      <div class="img">
                        <a class="a_img" href="<?php echo $link; ?>">
                          <img id="img_fly<?php echo $id; ?>" src="<?php echo $src ?>" alt="<?php echo $title; ?>">
                        </a>

                        <div class="i_tools">
                          <ul>
                            <li><a href="<?php echo $link; ?>"><i class="fal fa-search"></i></a></li>
                            <li onclick="showModal(<?php echo $id; ?>,'<?php echo $lang; ?>','<?php echo $title; ?>','<?php echo $price_real; ?>','<?php echo $global_lang['param']; ?>','<?php echo $global_lang['add_cart']; ?>','<?php echo $global_lang['buy_now']; ?>','<?php echo $link; ?>',<?php echo $stock; ?>,'<?php echo $src; ?>','<?php echo $color; ?>','<?php echo $size; ?>','<?php echo $sen; ?>','<?php echo $global_lang['color']; ?>','<?php echo $global_lang['size']; ?>','<?php echo $global_lang['sen']; ?>')"><a href="#modal-center<?php echo $id; ?>" uk-toggle><i class="fal fa-eye"></i></a></li>
                            
                          </ul>
                        </div>
                        <div id="modal-center<?php echo $id; ?>" class="uk-modal-container product_mod" uk-modal>  
                        </div>
                      </div>
                      <div class="i_title">
                        <h3><a href="<?php echo $link; ?>"><?php echo $title; ?></a></h3>
                      </div>
                      <div class="i_price">
                        <?php echo $price; ?>
                      </div>
                    </div>


                  </div>

                        <?php
                    }

                  ?>

								</div>
							</div>
							
							
							<script>
                var id_global = '<?php echo $cat_id_all; ?>';
              </script>
							<?php
                $limit_cat = $products_config['limit_display'];
                // echo $cat_count ; die();
                if($limit_cat < $cat_count || $limit_cat === $cat_count){
                    ?>
                  <button class="view-more-button" id="button_more" onclick="getListProductsMore(0,<?php echo $products_config['limit_display']; ?>,'<?php echo $lang; ?>','<?php echo $global_lang['param']; ?>','<?php echo $global_lang['add_cart']; ?>','<?php echo $global_lang['buy_now']; ?>','<?php echo $global_lang['unit']; ?>','<?php echo $global_lang['color']; ?>','<?php echo $global_lang['size']; ?>','<?php echo $global_lang['sen']; ?>');"><?php echo $global_lang['view_more']; ?></button>       
                    <input type="hidden" id="step_p" value="<?php echo $products_config['step']; ?>">
                    <input type="hidden" id="step" value="<?php echo $products_config['step']; ?>">
                    <input type="hidden" id="temp_s" value="<?php echo $products_config['limit_display']; ?>">
              <?php
                }

              ?>
							
							
						</div>

					</div>

				</div>

			</div>
			<div id="limit"></div>
		</section>