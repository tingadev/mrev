<?php ob_start(); ?>
<?php session_start(); ?> 
<?php 
  define('ROOTPATH', dirname(__DIR__));
  define('ROOTLANG', dirname(__DIR__,1));
  define('ROOT_SRC', dirname(dirname(__DIR__)));
  // echo BASE_CSS; die;
?>
<?php include ROOTPATH."/config.php"; ?>
<?php include ROOTPATH."/Models/BUS/BUS.php"; ?>
<?php include ROOTPATH."/Models/DATA/DAO.php"; ?>
<?php include ROOTPATH."/Models/functions.php"; ?>
<?php include ROOTPATH."/lang/global.php"; ?>
<?php include ROOTPATH."/includes/functions.php"; ?>
<?php include ROOTPATH."/includes/getLang.php"; ?>
<?php date_default_timezone_set("Asia/Bangkok"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <base href="/admin/">
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <title>
    ADMIN - CMS TINGADEV
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <!-- Nucleo Icons -->
  <link href="./assets/css/nucleo-icons.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="./assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="./assets/demo/demo.css" rel="stylesheet" />
  <link href="./css/style.css" rel="stylesheet" />
   <link rel="stylesheet" href="./assets/editormd.md/css/editormd.css" />
  <script src="js/jquery.js"></script> 
  <script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>
  <script src="js/tiny.js"></script> 
  
<script src="./assets/editormd.md/editormd.js"></script>


  <script src="./js/loading.js"></script>
  <script src="./js/admin.js"></script>
    
</head>

<body>
    <?php include ROOTPATH."/includes/delete_modal.php"; ?>
<!-- CONTENT -->
<div class="wrapper">
    <div class="sidebar">
        <div class="sidebar-wrapper">
     
        <?php include "admin_nav.php"; ?>
        
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <?php include "admin_top.php"; ?>
      <!-- End Navbar -->