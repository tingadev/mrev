<?php echo getBanner('banner_products'); ?>
<?php
if (!is_array($list_method)) {
  echo '<script>
      document.location.href="index.html";
</script>';
}
?>
<script>
  js_lang = [];
  js_lang['info_name_empty'] = '<?php echo $products_lang['info_name_empty']; ?>';
  js_lang['info_mail_empty'] = '<?php echo $products_lang['info_mail_empty']; ?>';
  js_lang['info_mail_err'] = '<?php echo $products_lang['info_mail_err']; ?>';
  js_lang['info_phone_empty'] = '<?php echo $products_lang['info_phone_empty']; ?>';
  js_lang['info_address_empty'] = '<?php echo $products_lang['info_address_empty']; ?>';
  js_lang['annouce'] = '<?php echo $products_lang['annouce']; ?>';
  js_lang['lang'] = '<?php echo $lang; ?>';
  js_lang['role'] = '<?php echo $_SESSION['role'] ?? null; ?>';
  js_lang['amountTotal'] = <?php echo $list_method[0]['totals']; ?>;
</script>
<script src="https://www.paypal.com/sdk/js?client-id=<?php echo $config['paypal_id'] ?>">
  // Required. Replace SB_CLIENT_ID with your sandbox client ID.
</script>
<div class="clear"></div>
<!--	HEADER AND BANNER-->
<!--	PRODUCT-->
<section class="vnt-cart">
  <div class="wrapper">
    <div class="style_step">
      <ul class="list-inline text-center">
        <li>
          <span class="number">1</span>
          <span class="text"><?php echo $products_lang['cart']; ?></span>
        </li>
        <li class="active">
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
        <h2><?php echo $products_lang['info_cart']; ?></h2>
      </div>

    </div>
    <div class="card_content" style="animation-delay: 0.5s;">
      <div class="wrapCont">
        <div class="wrapper">
          <!--===BEGIN STEP===-->
          <!-- return checkForm(); -->
          <form action="" id="form_payment" method="post" onsubmit="return checkForm('<?php echo $products_lang['bill_process']; ?>');">
            <!--===END STEP===-->
            <div class="row">
              <div class="col-md-8 col-sm-12 col-xs-12">
                <div class="boxCart">
                  <div class="title"><?php echo $products_lang['info_customer']; ?></div>
                  <div class="content">
                    <div class="wrap_box_login">

                      <div class="box_login rowLeft_200">
                        <div class="row_input">
                          <div class="row_left">
                            <label for="name"><?php echo $products_lang['info_name']; ?> <span>*</span></label>
                          </div>
                          <div class="row_right">
                            <input type="text" name="name" id="name" class="form-control" value="" placeholder="">
                          </div>
                          <div class="clear"></div>
                        </div>
                        <div class="row_input">
                          <div class="row_left">
                            <label for="phone"><?php echo $products_lang['info_phone']; ?> <span>*</span></label>
                          </div>
                          <div class="row_right">
                            <input type="text" name="phone" id="phone" class="form-control" value="">
                          </div>
                          <div class="clear"></div>
                        </div>
                        <div class="row_input">
                          <div class="row_left">
                            <label for="email"><?php echo $products_lang['info_mail']; ?> <span>*</span></label>
                          </div>
                          <div class="row_right">
                            <input type="text" name="email" id="email" class="form-control" value="">
                          </div>
                          <div class="clear"></div>
                        </div>
                        <?php
                        $disabled = '';
                        if ($lang == 'en') {
                          $disabled = 'disabled';
                        }


                        ?>
                        <div class="row_input">
                          <div class="row_left">
                            <label><?php echo $products_lang['info_address']; ?> <span>*</span></label>
                          </div>
                          <div class="row_right">
                            <select name="country" id="country" class="form-control" onchange="cityChange(this.value,'<?php echo $products_lang['states_choice']; ?>');" <?php echo $disabled; ?>>
                              <option value=""><?php echo $products_lang['city_choice']; ?></option>
                              <?php echo $list_city; ?>
                            </select>
                          </div>
                          <div class="clear"></div>
                        </div>
                        <div class="row_input">
                          <div class="row_left"></div>
                          <div class="row_right">
                            <select name="district" id="district" class="form-control" onchange="stateChange(this.value,'<?php echo $products_lang['ward_choice']; ?>');" <?php echo $disabled; ?>>
                              <option value=""><?php echo $products_lang['states_choice']; ?></option>
                            </select>
                          </div>
                          <div class="clear"></div>
                        </div>
                        <div class="row_input">
                          <div class="row_left"></div>
                          <div class="row_right">
                            <select name="ward" id="ward" class="form-control" <?php echo $disabled; ?>>
                              <option value=""><?php echo $products_lang['ward_choice']; ?></option>
                            </select>
                          </div>
                          <div class="clear"></div>
                        </div>
                        <div class="row_input">
                          <div class="row_left"></div>
                          <div class="row_right">
                            <input type="text" name="address" id="address" class="form-control" value="" placeholder="<?php echo $products_lang['address_placeholder']; ?>">
                          </div>
                          <div class="clear"></div>
                        </div>
                        <div class="row_input">
                          <div class="row_left">
                            <label for="note"><?php echo $products_lang['info_note']; ?></label>
                          </div>
                          <div class="row_right">
                            <textarea name="note" id="note" class="form-control" placeholder="<?php echo $products_lang['note_placeholder']; ?>"></textarea>
                          </div>
                          <div class="clear"></div>
                        </div>

                      </div>

                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="boxCart v2">
                  <div class="title">Giỏ hàng</div>
                  <div class="content">
                    <?php
                    foreach ($list_method as $key => $value) {
                      $totals_price = $value['totals'];
                    ?>

                      <div class="productCart">
                        <div class="box-img">
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
                        </div>
                        <div class="caption">
                          <?php $color =  explode(',', $value['color']) ?>
                          <div class="tend"><?php echo $value['title']; ?></div>
                          <div class="ssl"><?php echo $products_lang['quantity_table']; ?>: <?php echo $value['quantity']; ?></div>
                          <div class="ex_color_size">
                            <?php echo $products_lang['size']; ?>: <?php echo $value['size']; ?><br>
                            <?php echo $products_lang['sen']; ?>: <?php echo $value['sen']; ?><br>
                            <?php echo $products_lang['color']; ?>: <span style="width:20px;height:20px;display: inline-block;background: #<?php echo $color[0]; ?>; margin-right: 5px;"></span><?php echo $color[1]; ?>
                          </div>
                          <div class="price"><?php echo $products_lang['totals_price']; ?>: <span><?php echo $value['price']; ?> <?php echo $global_lang['unit']; ?></span></div>

                        </div>
                      </div>

                    <?php }
                    ?>




                    <div class="tableToCartInfo v2">
                      <div class="cartInfo">
                        <ul>
                          <!--  <li>
                              <div class="at">Tạm tính :</div>
                              <div class="as">11,000 đ</div>
                          </li> -->
                          <?php

                          if ($lang == 'en') {
                          ?>
                            <li>
                              <div class="at">Shipping:</div>
                              <div class="as" id="shipping_fee_js"><?php echo $shipping_fee[0]['fee']; ?></div>
                            </li>
                          <?php
                          }


                          ?>
                          <li>
                            <div class="at"><?php echo $products_lang['totals_bill']; ?></div>
                            <div class="as s">
                              <?php
                              if ($lang == 'vn') {
                                echo number_format($totals_price, 0, '', '.') . " " . $global_lang['unit'];
                              } else {
                                echo "<span id='total_en'>" . ($totals_price + $shipping_fee[0]['fee']) . "</span>" . " " . $global_lang['unit'];
                              }

                              ?>

                            </div>
                            <input type="hidden" id="totals_price_sum" name="totals_price_sum" value="<?php echo ($totals_price + $shipping_fee[0]['fee']); ?>">
                            <input type="hidden" id="non_ship_total" value="<?php echo $totals_price; ?>">
                          </li>
                        </ul>
                      </div>
                    </div>


                  </div>
                </div>
                <?php
                if ($lang == 'en') {
                ?>
                  <div class="boxCart">
                    <div class="title bg_color"><?php echo $products_lang['shipping_fee']; ?></div>
                    <div class="content">
                      <div class="wraspMethod">
                        <?php
                        foreach ($shipping_fee as $key => $item) {
                          if ($key == 0) {
                            $checkedShip = 'checked';
                          } else {
                            $checkedShip = '';
                          }
                        ?>

                          <div class="form-group d-flex" style="flex-wrap: wrap;">
                            <span style="width: 150px">
                              <input type="radio" name="checkShip" class="checkShip" id="shipping<?php echo $item['id']; ?>" onclick="addShippingFee(this)" value="<?php echo $item['fee']; ?>" <?php echo $checkedShip; ?>>
                              <label for="shipping<?php echo $item['id']; ?>" style="margin-bottom: 0;">
                                <h6 style="margin-left:5px; margin-bottom: 0;"><?php echo $item['name']; ?></h6>
                              </label>
                            </span>
                            <span style="margin-left:20px; color:coral;"><?php echo $item['fee']; ?> USD</span>
                            <i style="font-size: 12px; width:100%; padding: 0 22px;">(<?php echo $item['description']; ?>)</i>
                          </div>

                        <?php
                        }

                        ?>

                      </div>
                    </div>


                  </div>
                <?php
                }



                ?>

                <div class="boxCart">
                  <div class="title bg_color"><?php echo $products_lang['payment_method']; ?></div>
                  <div class="content">
                    <div class="wraspMethod">

                      <label for="idl2">
                        <h6><?php echo $payment_method['name']; ?></h6>
                      </label>

                      <?php echo $payment_method['description']; ?>


                    </div>
                  </div>
                  <div class="row_input" id="paypal_btn">
                    <button type="submit" name="submit_bill" class="btn" id="btn_submit" style="margin-bottom: 10px;"><span><?php echo $products_lang['bill_done']; ?></span></button>


                    <input type="hidden" name="order_id" id="order_id">
                    <input type="hidden" id="val_paypal" value="0">
                    <script>
                      if (js_lang['lang'] == 'en') {
                        paypal.Buttons({
                          onInit: function(data, actions) {

                          },
                          onClick: function(data, actions) {
                            checkForm('<?php echo $products_lang['bill_process']; ?>', 'paypal');
                            if ($('#val_paypal').val() == 0) {
                              return actions.reject();
                            }
                            $('#val_paypal').change(function() {
                              if ($('#val_paypal').val() == 1) {
                                return actions.resolve();
                              }
                            })
                          },
                          createOrder: function(data, actions) {
                            // This function sets up the details of the transaction, including the amount and line item details.
                            return actions.order.create({
                              purchase_units: [{
                                amount: {
                                  value: js_lang['amountTotal']
                                }
                              }]
                            });
                          },
                          onApprove: function(data, actions) {
                            return actions.order.capture().then(function(details) {
                              $('#order_id').val(data.orderID)
                              $('#btn_submit').click();
                            });

                          }
                        }).render('#paypal_btn');
                      }
                    </script>

                  </div>

                </div>


              </div>
            </div>
          </form>
        </div>

      </div>

    </div>

  </div>
  <div class="clear"></div>
</section>