
<?php include "lang/".$lang."/contact.php";  ?>
    <!--===BEGIN: CONTACT===-->


<section class="contact_page" style="background: url(uploads/weblink/contact.jpg);">                 
    <div class="wrapper">
        <div class="map-contact">
            <div class="contact_container">
               

                <div class="contact_info">
                     <h1><?php echo $contact_lang['feedback']; ?></h1>
                    
                    <div class="phone before">
                        <h3><?php echo $detail['phone']; ?></h3>
                    </div>
                    <div class="email before">
                        <h3><?php echo $detail['email']; ?></h3>
                    </div>
                    <div class="website before">
                        <h3><?php echo $detail['website']; ?></h3>
                    </div>
                    <div class="address">
                        <i class="fal fa-map-marker-alt"></i>
                        <h3><?php echo $detail['address']; ?></h3>
                    </div>
                </div>
            </div>
            <div class="clear"></div>
            <div class="map_content tab-content" id="viewmap">
                <div id="map1" class="tab-pane fade active in">
                    <?php echo $detail['map']; ?>
                </div>
            </div>
        </div>
    </div>                            
</section>
    <!--===BEGIN: CONTACT===-->