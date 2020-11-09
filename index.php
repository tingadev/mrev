<?php include "config.php"; ?>
<?php
	
		$modules='main';

	
?>
<?php include "includes/getIDSession.php" ?>
<?php include "includes/getLang.php" ?>



<?php include "seo.php"; ?>

<?php include "lang/".$lang."/global.php";  ?>
<?php include "lang/products_config.php";  ?>

<?php include "includes/seo_url.php";  ?>


<?php
    define('ROOTPATH', dirname(__FILE__));
    define('ROOT_SRC', dirname(__DIR__));
    define('ROOTHOST', $_SERVER['SERVER_NAME']);
?>
<!-- ADD LIBS -->
<?php 
    include "includes/libs.php"; 
 
    
?>
<!-- ADD FUNCTION OF MODULES -->

<?php 
  include "modules/".$modules."/".$modules.".php"; 
  if($ex_modules){
    include "modules/".$modules."/".$ex_modules.".php"; 
  }

?>
<!-- ADD FUNCTION OF MODULES -->



<!-- ADD HEADER -->



<!doctype html>
<html>
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' >
    <title><?php echo $title_meta; ?></title>
    <meta name="keywords" content="<?php echo $meta_keyword; ?>">
    <meta name="description" content="<?php echo $meta_desc ?>">

    <?php echo getFavicon(); ?>
    <link rel="stylesheet" href="plugins/uikit-3.1.2/css/uikit.min.css" />
    <link rel="stylesheet" href="2-css/fontawesome/css/all.css">
    <link rel="stylesheet" href="2-css/animate.css">
    <link rel="stylesheet" href="2-css/style.css">
    <link rel="stylesheet" href="2-css/screen.css">
    <link rel="stylesheet" href="3-js/slick/slick.css">
    <link rel="stylesheet" href="3-js/slick/slick-theme.css">
    <link rel="stylesheet" href="3-js/jquery-confirm-master/jquery-confirm.css">
    <link rel="stylesheet" href="3-js/fancybox/jquery.fancybox.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    

        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap&subset=vietnamese" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans+Condensed:300,300i,700&display=swap&subset=vietnamese" rel="stylesheet">
    <script language="javascript">
      var id_global = -1;
      var step_reset = <?php echo $products_config['limit_display']; ?>;
      var ROOT = '<?php echo basename(ROOTPATH); ?>';
      var finished = 0;

      js_global = [];
      js_global['annouce'] = '<?php echo $global_lang['annouce']; ?>';
      js_global['empty_keywords'] = '<?php echo $global_lang['empty_keywords']; ?>';
      js_global['out_of_stock'] = '<?php echo $global_lang['out_of_stock']; ?>';
      js_global['empty_size'] = '<?php echo $global_lang['empty_size']; ?>';
      js_global['empty_sen'] = '<?php echo $global_lang['empty_sen']; ?>';
      js_global['empty_color'] = '<?php echo $global_lang['empty_color']; ?>';
      js_global['order_contact'] = '<?php echo $global_lang['order_contact']; ?>';
      js_global['order_contact_note'] = '<?php echo $global_lang['order_contact_note']; ?>';
      js_global['title_brand'] = '<?php echo $global_lang['type_brand'] ?>';
    </script>

    <script src="3-js/jquery.min.js"></script>
    <script src="3-js/slick/slick.min.js"></script>
    <script src="3-js/jquery-confirm-master/jquery-confirm.js"></script>
    <script src="plugins/uikit-3.1.2/js/uikit.min.js"></script>
    <script src="plugins/uikit-3.1.2/js/uikit-icons.min.js"></script>
    <script src="3-js/mnfixed.js"></script>
    <script src="3-js/fancybox/jquery.fancybox.min.js"></script>
    <script type="text/javascript" src="3-js/nicescroll/jquery.nicescroll.js"></script>
    <script type="text/javascript" src="3-js/javascript.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    

    <!-- MODULE -->
    <?php
        if($modules){
          // die($ex_modules);
            if($ex_modules){
                echo '<link rel="stylesheet" type="text/css" href="modules/'.$modules.'/css/'.$ex_modules.'.css" />';
                echo '<script type="text/javascript" src="modules/'.$modules.'/js/'.$ex_modules.'.js"></script>';
                echo '<link rel="stylesheet" type="text/css" href="3-js/bootstrap/bootstrap.min.css" />';
                // echo '<script type="text/javascript" src="modules/'.$modules.'/js/'.$modules.'.js"></script>';
            }
            else{
              echo '<link rel="stylesheet" type="text/css" href="modules/'.$modules.'/css/'.$modules.'.css" />';
              echo '<script type="text/javascript" src="modules/'.$modules.'/js/'.$modules.'.js"></script>';
            }
            
        }

    ?>
    
    <!-- Compiled and minified CSS -->
   

    <!-- Compiled and minified JavaScript -->
            
  </head>
  <body>
    <?php 
    //     if($modules == 'main'){
    //         echo '<div id="mprevloading_hype_container" class="HYPE_document" style="margin:auto;position:relative;width:1440px;height:600px;overflow:hidden;">
    //     <script type="text/javascript" charset="utf-8" src="3-js/mprev_loading.hyperesources/mprevloading_hype_generated_script.js?74651"></script>
    // </div>
    // <script>
    //     var myWindow = $("#mprevloading_hype_container");
    //     setTimeout(function(){ myWindow.css("display","none") }, 3500);
    // </script>';
    //     }

    ?>
   
    <div class="mprev_content">

<!-- ADD HEADER -->

<!-- ADD NAVIGATION -->
<div class="uk-position-fixed header_menu" uk-sticky>
      <div class="wrapper">
        <nav class="uk-navbar-container uk-navbar-transparent" uk-navbar>
          <div class="uk-navbar-left">

            <a href="" class="menu_icon" uk-icon="menu" uk-toggle="target: #offcanvas-slide"></a>
          </div>
          <div id="offcanvas-slide" uk-offcanvas="overlay: true">
            <div class="uk-offcanvas-bar">

              <button class="uk-offcanvas-close" type="button" uk-close></button>

              <?php echo getMenu($lang); ?>

            </div>
          </div>
          <div class="uk-navbar-center">
            <div class="logo">
              <?php echo getLogo(); ?>
            </div>
          </div>
          <div class="uk-navbar-right">
            <div class="cart">
              <a href="./<?php echo $lang; ?>/shopping_cart">
                <i class="fal fa-shopping-cart"></i>
                <span id="ext_numcart"><?php echo getQuantity($session_id); ?></span>
              </a>
            </div>
            <div class="lang">
              <?php echo getLang($lang); ?>
            </div>
          </div>
        </nav>
      </div>
    </div>
<!-- ADD NAVIGATION -->

<!-- ADD BANNER -->
  <?php 
  if($modules =='about' || $modules == 'services' || $modules =='contact' || $modules == 'products'){

  }
  else{
      include "includes/banner.php"; 
  }

  ?>
  <!-- ADD BANNER -->

<!-- CONTENT -->
<?php include "modules/".$modules."/html/".$modules.$action."_tpl.php"; ?>
<!-- CONTENT -->


<!--     PARALLAX-->
      <div class="uk-height-large parallax_mprev uk-background-cover uk-light uk-flex" uk-parallax="bgy: -200" style="background-image: url('<?php echo getParallax('parallax'); ?>');">

         <h4 class="uk-width-1-2@m uk-text-center uk-margin-auto uk-margin-auto-vertical"><?php echo $global_lang['slogan_parallax']; ?></h4>

      </div>
      <!--PARALLAX-->
      
      <!--FOOTER-->
      <div class="footer">
         <div class="wrapper">
            <div class="uk-text-left info_footer" uk-grid>
               <div class="uk-width-1-3@m">
                  <div class="title_f">
                     <?php echo $global_lang['contact_footer_slogan']; ?>
                  </div>
               </div>
               <div class="uk-width-expand@m" uk-grid>
                  <div class="uk-width-1-2@s">
                  <div class="info_store ">
                    <?php $contact_info = getContact($lang); ?>
                     <h5><?php echo $contact_info['name']; ?></h5>
                     <ul>
                        <li><span><?php echo $global_lang['address']; ?>: </span><?php echo $contact_info['address']; ?></li>
                        <li><span><?php echo $global_lang['phone']; ?>: </span><?php echo $contact_info['phone']; ?></li>
                        <li><span><?php echo $global_lang['email']; ?>: </span><?php echo $contact_info['email']; ?></li>
                        <li><span><?php echo $global_lang['website']; ?>: </span><?php echo $contact_info['website']; ?></li>
                     </ul>
                  </div>
                  
                     
                  </div>
                  <div class="uk-width-1-2@s" >
                  <div class="info_store">
                     <h5><?php echo $global_lang['quick_link']; ?></h5>
                     <?php echo getMenuQuick($lang); ?>
                  </div>
                  </div>
               </div>
            </div>
            
         </div>
         <div class="box_copyright">
            <div class="wrapper">
               <div class="uk-text-left " uk-grid>
            
               <div class="uk-width-1-3@m copyright">
                  <?php echo $global_lang['copyright']; ?>
               </div>
               <div class="uk-width-1-3@m">
                  <div class="logo_f uk-text-center">
                     <?php echo getLogoFooter(); ?>
                  </div>
               </div>
               <div class="uk-width-1-3@m uk-text-right">
               
               <ul class="social uk-text-right">
                <?php  
                  $social_arr = getSocial();
                  if(is_array($social_arr)){
                    foreach ($social_arr as $key => $value) {
                      ?>
                      <li>
                       <a href="<?php echo $value['link']; ?>" title='<?php echo $value['title']; ?>' target='_blank'><i class="<?php echo $value['icon']; ?>"></i></a>
                    </li>
                      
                      <?php
                    }
                  }
                  
                ?>
                  
                  
                  
               </ul>
               </div>
            </div>
            </div>
         </div>
         
         
      </div>
      <!--FOOTER-->


   </div>



</body>

</html>
	