<nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle d-inline">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="javascript:void(0)">Dashboard</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse" id="navigation">

                            <?php 
function curPageURL() { 
 $pageURL = 'http'; 
if (array_key_exists('HTTPS', $_SERVER) && $_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 $pageURL .= "://"; 
 if ($_SERVER["SERVER_PORT"] != "80") { 
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"]; 
 } else { 
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]; 
 } 
 return $pageURL; 
} 
?> 

            <ul class="navbar-nav ml-auto">
                            <?php 
$curpage=curPageURL(); 
if (stripos($curpage,"?")===false){  // không tìm thấy 
     $link="$curpage?lang="; 
}else{ 
     $link="$curpage&lang=";    
} 
$active_lang = 'btn-primary';
if($lang=='vn'){
  
  echo '<li style="padding-top: 9px;" class="search-bar input-group '.$active_lang.'">
                <h4><a style="white-space: nowrap;" href="'.$link.'vn">Tiếng việt</a></h4>
              </li>'; 
echo '<li style="padding-top: 9px;" class="search-bar input-group ">
                <h4><a href="'.$link.'en">English</a></h4>
              </li>'; 
}
else{
  echo '<li style="padding-top: 9px;" class="search-bar input-group ">
                <h4><a style="white-space: nowrap;" href="'.$link.'vn">Tiếng việt</a></h4>
              </li>'; 
echo '<li style="padding-top: 9px;" class="search-bar input-group '.$active_lang.'">
                <h4><a href="'.$link.'en">English</a></h4>
              </li>';
}

?>
             <!--  <li style="padding-top: 15px;" class="search-bar input-group">
                <h4><a style="white-space: nowrap;" href="index.php?lang=vn">Tiếng việt</a></h4>
              </li>
              <li style="padding-top: 15px;" class="search-bar input-group">
                <h4><a href="index.php?lang=en">English</a></h4>
              </li> -->
              
              <li class="dropdown nav-item">
                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                  <div class="photo">
                    <img src="./assets/img/anime3.png" alt="Profile Photo">
                  </div>
                  <b class="caret d-none d-lg-block d-xl-block"></b>
                  <p class="d-lg-none">
                  
                  </p>
                </a>
                <ul class="dropdown-menu dropdown-navbar">
                  <li class="nav-link">
                    <a href="changepass.php" class="nav-item dropdown-item">Profile</a>
                  </li>
                  
                  <li class="dropdown-divider"></li>
                  <li class="nav-link">
                    <a href="./includes/logout.php" class="nav-item dropdown-item">Log out</a>
                  </li>
                </ul>
              </li>
              <li class="separator d-lg-none"></li>
            </ul>
          </div>
        </div>
      </nav>
      <div class="modal modal-search fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="SEARCH">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i class="tim-icons icon-simple-remove"></i>
              </button>
            </div>
          </div>
        </div>
      </div>