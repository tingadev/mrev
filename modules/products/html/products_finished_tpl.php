<?php echo getBanner('banner_products'); ?>
<?php 

if($_SESSION['order_code']){
      
      $thank_you = getHTMLFinish($lang);
      $thank_you = str_replace('{replace}', $_SESSION['order_code'], $thank_you);
  }
  else{

    echo '<script>
      document.location.href="index.html";
      </script>';
     
  
  }

?>

<div class="clear"></div>
		<!--	HEADER AND BANNER-->
		<!--	PRODUCT-->
		<section class="vnt-cart">
      <div class="wrapper">
        <div class="style_step">
          <ul class="list-inline text-center">
            <li >
              <span class="number">1</span>
              <span class="text"><?php echo $products_lang['cart']; ?></span>
            </li>
            <li>
              <span class="number">2</span>
              <span class="text"><?php echo $products_lang['info_cart']; ?></span>
            </li>
            <li class="active">
              <span class="number">3</span>
              <span class="text"><?php echo $products_lang['finished_cart']; ?></span>
            </li>
          </ul>
          <div class="clear"></div>
        </div>
        <div class="cart_head">

          <div class="title_m">
            <h2><?php echo $products_lang['bill_finished']; ?></h2>
          </div>

        </div>
        <div class="card_content" style="animation-delay: 0.5s;">
          <div class="wrapCont">
                                    <div class="wrapper">

                                        <?php echo $thank_you; ?>
                                        
                                    </div>
                                </div>

        </div>
      
  </div>
  <div class="clear"></div>
  </section>
