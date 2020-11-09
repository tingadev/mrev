<?php echo getBanner('banner_products'); ?>

<div class="clear"></div>


		<!--	HEADER AND BANNER-->
		<!--	PRODUCT-->
		<section class="vnt-cart">
      <div class="wrapper">
        <div class="style_step">
          <ul class="list-inline text-center">
            <li class="active">
              <span class="number">1</span>
              <span class="text"><?php echo $products_lang['cart']; ?></span>
            </li>
            <li>
              <span class="number">2</span>
              <span class="text"><?php echo $products_lang['info_cart']; ?></span>
            </li>
            <li>
              <span class="number">3</span>
              <span class="text"><?php echo $products_lang['finished_cart']; ?></span>
            </li>
          </ul>
          <div class="clear"></div>
        </div>
        <div class="cart_head">

          <div class="title_m">
            <h2><?php echo $products_lang['cart']; ?></h2>
          </div>

        </div>
        <?php
        if(is_array($list_cart)){
          ?>
          <div class="card_content" style="animation-delay: 0.5s;">
            <div class="vnt-order">
              <form id="step1" action="<?php echo $link_method;?>" method="post" name="f_cart">
                <div class="wrap-table" id="">
                  <table class="addtocart">
                    <thead>
                      <tr>
                        <td><?php echo $products_lang['product_table']; ?></td>
                        <td><?php echo $products_lang['quantity_table']; ?></td>
                        <td><?php echo $products_lang['price_table']; ?></td>
                        <td><?php echo $products_lang['totals_table']; ?></td>
                        <td><?php echo $products_lang['quantity_table']; ?></td>
                      </tr>

                    </thead>
                    <tbody>
                      <?php 
                      
                        foreach ($list_cart as $key => $value) {
                        ?>

                        <tr>
                          <td class="flex-info">

                            <div class="box-p">
                              <div class="row-p">

                                <div class="item">
                                  <div class="col-p">
                                    <a href="<?php echo $value['link']; ?>" class="img">

                                      <img src="<?php echo $value['src']; ?>" alt="<?php echo $value['title']; ?>">

                                    </a>
                                  </div>

                                </div>



                              </div>
                            </div>
                            <div class="i-title">
                              <?php 
                                  $color =  explode(',', $value['color']);
                                  
                                  
                               ?>

                                <a href="<?php echo $value['link']; ?>" target="_blank"><?php echo $value['title']; ?><br> <?php echo $products_lang['size']; ?>: <?php echo $value['size']; ?><br> <?php echo $products_lang['sen']; ?>: <?php echo $value['sen']; ?> <br> <?php echo $products_lang['color']; ?>: <span style="width:20px;height:20px;display: inline-block;background: #<?php echo $color[0]; ?>; margin-right: 5px;"></span><?php echo $color[1]; ?></a>

                            </div>


                          </td>
                          <td>
                            <div class="choose-quantity">
                              <a class="nav-button q-prev" href="javascript:void(0)" onclick="changeQuantity('quantity_<?php echo $value['id']; ?>','decrease',<?php echo $value['id']; ?>,<?php echo $value['price_real']; ?>,'<?php echo $lang; ?>');">-</a>
                              <input type="text" class="form-control quantity quantity_<?php echo $value['id']; ?>" name="quantity[<?php echo $value['id']; ?>]" value="<?php echo $value['quantity']; ?>" id="quantity_<?php echo $value['id']; ?>" onkeyup="updateQuantity(<?php echo $value['id']; ?>,<?php echo $value['price_real']; ?>,'<?php echo $lang; ?>')">
                              <a class="nav-button q-next" href="javascript:void(0)" onclick="changeQuantity('quantity_<?php echo $value['id']; ?>','increase',<?php echo $value['id']; ?>,<?php echo $value['price_real']; ?>,'<?php echo $lang; ?>');">+</a>
                            </div>
                          </td>
                          <td class="price"><?php echo $value['price']; ?> <?php echo $global_lang['unit']; ?></td>
                          <td class="price colorRed"><span id="ext_total_<?php echo $value['id']; ?>"><?php echo $value['price_temp']; ?> </span> <?php echo $global_lang['unit']; ?></td>
                          <td><a class="btnclear" href="javascript:0;" onclick="deleteItem(<?php echo $value['id']; ?>,'<?php echo $value['size']; ?>','<?php echo $value['color']; ?>');" title="Remove Item"></a></td>
                        </tr>
                      
                        <?php
                        }
                     
                    ?>
                     

                    </tbody>
                  </table>
                </div>
                <div class="orderTotal">
                  <div class="fr">

                    <div class="row-total">
                      <div class="t-tile"><?php echo $products_lang['totals_price'] ?> :</div>
                      <div class="t-price colorRed"><span id="ext_total_price"><?php
                         if($lang=='vn'){
                          echo number_format($value['totals'], 0, '', '.'); 
                         }
                         else{
                          echo $value['totals']; 
                         }
                          
                       ?> </span> <?php echo $global_lang['unit']; ?></div>
                     
                      <div class="clear"></div>
                    </div>
                  </div>

                  <div class="clear"></div>
                </div>

                <div class="button-form">
                  <div class="fl">
                    <button type="button" id="btnContinue" name="btnContinue" class="btn btnContinue" onclick="location.href='<?php echo $link_products; ?>'" value="Tiếp tục mua"><span><?php echo $products_lang['buy_goon']; ?></span></button>
                  </div>
                  <div class="fr">
                    <button type="submit" id="btnCheckout" name="btnCheckout" class="btn do_submit" value="Thanh toán"><span><?php echo $products_lang['pay']; ?></span></button>
                  </div>
                  <input type="hidden" name="modify" value="modify">
                  <input type="hidden" name="do_process" value="1">

                  <input type="hidden" name="link_ref" value="">
                  <div class="clear"></div>
                </div>
              </form>
            </div>
          </div>
          <?php
        } 
        
        
        else{
          echo $list_cart;
        }

        ?>
        
        
      
  </div>
  <div class="clear"></div>
  </section>