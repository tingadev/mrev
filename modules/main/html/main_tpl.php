<?php 
  define('SOURCE_MODE', dirname(dirname(__FILE__)));
  // die(SOURCE_MODE);
?>
<?php
  global $connection;
  $query_video = "SELECT *from video limit 0,1";
  $select_video = mysqli_query($connection,$query_video);
  if($select_video){
    while ($row = mysqli_fetch_assoc($select_video)) {
        $display = $row['display'];
        $embed = $row['embed'];
        $position = $row['position'];
        $height = $row['height'].'px';
        $width = $row['width'].'px';
        if($row['width'] == 0){
          $width = '100%';
        }

    }
  }

 ?>
 <?php
 if($display==1){
  if($position == 0){
  ?>
    <div class="video_main" style="padding-top:90px; padding-bottom: 0px;">
      <div class="wrapper">
        <div class="style_video" style="width:<?php echo $width; ?>; height: <?php echo $height; ?>; margin: 0 auto;">
          <?php echo $embed; ?>
        </div>
        
      </div>
      
    </div>

  <?php

  }
 }
 


?>
    
    <!--  PRODUCT-->
    <section class="product">
      <div class="wrapper">
        <div class="uk-text-center" uk-grid>
          <div class="uk-width-expand@m p1">
            <div class="box_product">
              <div class="title">

                <h2>
                  <?php echo $global_lang['product_main']; ?>
                </h2>

              </div>
              <div class="content" id="">
              <div class="loading_product"><span uk-spinner="ratio: 4.5"></span></div>
                <div class="uk-child-width-1-2 uk-text-center container_product" uk-grid id="results" >
                  <?php
                    foreach ($list_product as $value) {
                        $id = $value['p_id'];
                        $title = $value['title'];
                        $src = "uploads/products/thumb/".$value['thumb'];
                        $link = $lang."/".$value['link'];
                        $color = $value['color'];
                        $size = $value['size'];
                        $sen = $value['sen'];
                        $price_real = $value['price'];
                        $stock = $value['stock'];
                        if($lang=='vn'){
                          $price = number_format($value['price'], 0, '', '.');
                        }
                        else{
                          $price = $value['price'];
                        }
                        
                        if($price==0){
                          $price = $global_lang['order_contact'];
                        }
                        else{
                          $price .=" ".$global_lang['unit'];
                        }
                        
                        ?>

                        <div class="item">
                    <div class="product_box">
                      <div class="img">
                        <a class="a_img" href="<?php echo $link; ?>">
                          <img id='img_fly<?php echo $id; ?>' src="<?php echo $src ?>" alt="<?php echo $title; ?>">
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
                        <?php 
                          
                          echo $price; 
                        ?>
                      </div>
                    </div>


                  </div>

                        <?php
                    }

                  ?>
                  
                  
                
                </div>
              </div>

            <?php
                $limit_cat = $products_config['limit_display'];
                if($limit_cat <= $cat_count){
                  // die('ok');
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
          <div class="uk-width-1-3@m p2">

            <div class="box_search">
              <div class="title">
                <h2><?php echo $global_lang['chose_type']; ?></h2>
              </div>
              <div class="col">
                <span class="custom-dropdown">
                  <select name="cat_id_p" id="cat_id_p" onchange="getCatSubProducts(this.value,'<?php echo $lang; ?>'); getCatListProducts(this.value,<?php echo $products_config['limit_display']; ?>,'<?php echo $lang; ?>','<?php echo $global_lang['param']; ?>','<?php echo $global_lang['add_cart']; ?>','<?php echo $global_lang['buy_now']; ?>','<?php echo $global_lang['unit']; ?>','<?php echo $global_lang['color']; ?>','<?php echo $global_lang['size']; ?>','<?php echo $global_lang['sen']; ?>'); passCatId(this.value);">
                    <option value="">--- <?php echo $global_lang['type_product']; ?> ---</option>
                    <option value="-1">--- <?php echo $global_lang['all_products']; ?>---</option>
                    <?php echo getCatProducts($lang,1); ?>

                  </select>
                </span>
              </div>

              <div class="col">
                <span class="custom-dropdown">
                  <select name="cat_id_c" id="cat_id_c" onchange="getListProducts(this.value,<?php echo $products_config['limit_display']; ?>,'<?php echo $lang; ?>','<?php echo $global_lang['param']; ?>','<?php echo $global_lang['add_cart']; ?>','<?php echo $global_lang['buy_now']; ?>','<?php echo $global_lang['unit']; ?>','<?php echo $global_lang['color']; ?>','<?php echo $global_lang['size']; ?>','<?php echo $global_lang['sen']; ?>'); passCatId(this.value);">
                     <option value="-1">--- <?php echo $global_lang['type_brand']; ?> ---</option>

                  </select>
                </span>
              </div>
              <div class="col">

                <form class="uk-search uk-search-default" onsubmit="getListProductsKeys(0,<?php echo $products_config['limit_display']; ?>,'<?php echo $lang; ?>','<?php echo $global_lang['param']; ?>','<?php echo $global_lang['add_cart']; ?>','<?php echo $global_lang['buy_now']; ?>','<?php echo $global_lang['unit']; ?>','<?php echo $global_lang['color']; ?>','<?php echo $global_lang['size']; ?>','<?php echo $global_lang['sen']; ?>'); return false;">
                  <button class="uk-search-icon-flip" type="button" uk-search-icon onclick="getListProductsKeys(0,<?php echo $products_config['limit_display']; ?>,'<?php echo $lang; ?>','<?php echo $global_lang['param']; ?>','<?php echo $global_lang['add_cart']; ?>','<?php echo $global_lang['buy_now']; ?>','<?php echo $global_lang['unit']; ?>','<?php echo $global_lang['color']; ?>','<?php echo $global_lang['size']; ?>','<?php echo $global_lang['sen']; ?>');"></button>
                  <input class="uk-search-input" name="keywords" id="keywords" type="search" placeholder="Search...">
                </form>

              </div>
              <div class="col">
                <a href="<?php echo $lang."/";?><?php echo $global_lang['product_link']; ?>" class="view_all"><?php echo $global_lang['view_all']; ?></a>
                

              </div>
            </div>
          </div>
        </div>

      </div>
      <div id="limit"></div>
    </section>
    <!--  PRODUCT-->

    <!--  ABOUT AND SERVICE-->
    <section class="box_group">
      <div class="wrapper">
        <div class="uk-text-center" uk-grid>
          <div class="uk-width-1-3@m">
            <div class="about">
              <a class="img" href="<?php echo $about['link']; ?>" style="background: url(<?php echo $about['src']; ?>);"></a>
              <div class="text">
                <div class="title_s">
                  <?php echo $global_lang['about']; ?>
                </div>
              </div>
            </div>
          </div>
              <?php
    if($display == 1){
      if($position == 1){
  ?>
          <div class="uk-width-expand@m">
            <div class="services">
              <div class="video_main">
      
        <div class="style_video" style="width:100%; height: 400px;">
          <?php echo $embed; ?>
        </div>     
    </div>
              
            </div>

          </div>
            <?php

 }

    }
?>

        </div>
      </div>
    </section>

    <!--  ABOUT AND SERVICE-->


