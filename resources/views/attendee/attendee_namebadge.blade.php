<?php
$dashboardUrl = "http://dashboard.registro.asia/";
$user_id            = $viewParam->user_id;
$event_id           = $viewParam->event_id;
$qrCodeFinalData    = $viewParam->qrCodeFinalData;
$templatesDatas     = $viewParam->templatesDatas;
$nameBadgeConfData  = $viewParam->nameBadgeConfData;
$type_id            = $qrCodeFinalData['type_id'];
?>
<style>
    canvas {
        margin: 0 !important;
        padding: 0 !important;
    }
    #ename_badge_print_area_container_<?php echo $user_id; ?>{
        position: relative;
        width: <?php echo $templatesDatas->page_width; ?>mm;
        height: <?php echo $templatesDatas->page_height; ?>mm;
        left: 0;
        overflow: hidden;
        /*background-color: red !important;*/
        border: 1px solid red;
    }
    div.badgeContent{
        position: absolute;
    }          
</style>
<div id="ename_badge_print_area_container_<?php echo $user_id; ?>"> 
    <!--Header Area-->
    <?php if (isset($nameBadgeConfData->header_image)) { ?>
        <?php
        $textAlign = (isset($nameBadgeConfData->header_image->textAlign) && !empty($nameBadgeConfData->header_image->textAlign) ? $nameBadgeConfData->header_image->textAlign : "left");
        $fontsize = (isset($nameBadgeConfData->header_image->fontSize) && !empty($nameBadgeConfData->header_image->fontSize) ? $nameBadgeConfData->header_image->fontSize : 14);
        $fontweight = (isset($nameBadgeConfData->header_image->fontWeight) && !empty($nameBadgeConfData->header_image->fontWeight) ? $nameBadgeConfData->header_image->fontWeight : 'normal');
        ?>
        <div class="badgeContent" style="width:<?php echo $nameBadgeConfData->header_image->width; ?>px; height: <?php echo $nameBadgeConfData->header_image->height; ?>px; left: <?php echo $nameBadgeConfData->header_image->left; ?>px; top: <?php echo $nameBadgeConfData->header_image->top; ?>px; font-size:<?php echo $fontsize ?>px; font-weight: <?php echo $fontweight; ?>; text-align: <?php echo $textAlign; ?>">
            <img src="<?php echo $nameBadgeConfData->header_image->src; ?>" />
        </div>
    <?php } ?>
    <!--Salutation Area-->
    <?php if (isset($nameBadgeConfData->name) && !empty($nameBadgeConfData->name)) { ?>
        <?php
        $textAlign = (isset($nameBadgeConfData->name->textAlign) && !empty($nameBadgeConfData->name->textAlign) ? $nameBadgeConfData->name->textAlign : "left");
        $fontsize = (isset($nameBadgeConfData->name->fontSize) && !empty($nameBadgeConfData->name->fontSize) ? $nameBadgeConfData->name->fontSize : 14);
        $fontweight = (isset($nameBadgeConfData->name->fontWeight) && !empty($nameBadgeConfData->name->fontWeight) ? $nameBadgeConfData->name->fontWeight : 'normal');
        ?>
        <div class="badgeContent" style="width:<?php echo $nameBadgeConfData->name->width; ?>px; height: <?php echo $nameBadgeConfData->name->height; ?>px; left: <?php echo $nameBadgeConfData->name->left; ?>px; top: <?php echo $nameBadgeConfData->name->top; ?>px; font-size:<?php echo $fontsize ?>px; font-weight: <?php echo $fontweight; ?>; text-align: <?php echo $textAlign; ?>">
            <div id="nameBadgeVisitorName">
                <?php
                $nameContainer = [];
                (isset($qrCodeFinalData['salutation']) && !empty($qrCodeFinalData['salutation']) ? array_push($nameContainer, $qrCodeFinalData['salutation']) : "");
                (isset($qrCodeFinalData['first_name']) && !empty($qrCodeFinalData['first_name']) ? array_push($nameContainer, $qrCodeFinalData['first_name']) : "");
                (isset($qrCodeFinalData['last_name']) && !empty($qrCodeFinalData['last_name']) ? array_push($nameContainer, $qrCodeFinalData['last_name']) : "");
                echo implode(" ", $nameContainer);
                ?>
            </div>
        </div>
    <?php } ?>
    <!--Serialnumber Area-->
    <?php if ((isset($qrCodeFinalData['serial_digit']) && !empty($qrCodeFinalData['serial_digit'])) && isset($nameBadgeConfData->serial_digit)) { ?>
        <?php
        $textAlign = (isset($nameBadgeConfData->serial_digit->textAlign) && !empty($nameBadgeConfData->serial_digit->textAlign) ? $nameBadgeConfData->serial_digit->textAlign : "left");
        $fontsize = (isset($nameBadgeConfData->serial_digit->fontSize) && !empty($nameBadgeConfData->serial_digit->fontSize) ? $nameBadgeConfData->serial_digit->fontSize : 14);
        $fontweight = (isset($nameBadgeConfData->serial_digit->fontWeight) && !empty($nameBadgeConfData->serial_digit->fontWeight) ? $nameBadgeConfData->serial_digit->fontWeight : 'normal');
        ?>
        <div class="badgeContent" style="width:<?php echo $nameBadgeConfData->serial_digit->width; ?>px; height: <?php echo $nameBadgeConfData->serial_digit->height; ?>px; left: <?php echo $nameBadgeConfData->serial_digit->left; ?>px; top: <?php echo $nameBadgeConfData->serial_digit->top; ?>px; font-size:<?php echo $fontsize ?>px; font-weight: <?php echo $fontweight; ?>; text-align: <?php echo $textAlign; ?>">
            <?php echo $qrCodeFinalData['serial_digit']; ?>
        </div>
    <?php } ?>
    <!--Email Area-->
    <?php if ((isset($qrCodeFinalData['email']) && !empty($qrCodeFinalData['email'])) && isset($nameBadgeConfData->email)) { ?>
        <?php
        $textAlign = (isset($nameBadgeConfData->email->textAlign) && !empty($nameBadgeConfData->email->textAlign) ? $nameBadgeConfData->email->textAlign : "left");
        $fontsize = (isset($nameBadgeConfData->email->fontSize) && !empty($nameBadgeConfData->email->fontSize) ? $nameBadgeConfData->email->fontSize : 14);
        $fontweight = (isset($nameBadgeConfData->email->fontWeight) && !empty($nameBadgeConfData->email->fontWeight) ? $nameBadgeConfData->email->fontWeight : 'normal');
        ?>
        <div class="badgeContent" style="width:<?php echo $nameBadgeConfData->email->width; ?>px; height: <?php echo $nameBadgeConfData->email->height; ?>px; left: <?php echo $nameBadgeConfData->email->left; ?>px; top: <?php echo $nameBadgeConfData->email->top; ?>px; font-size:<?php echo $fontsize ?>px; font-weight: <?php echo $fontweight; ?>; text-align: <?php echo $textAlign; ?>">
            <?php echo $qrCodeFinalData['email']; ?>
        </div>
    <?php } ?>
    <!--User label Area-->
    <?php if ((isset($qrCodeFinalData['namebadge_user_label']) && !empty($qrCodeFinalData['namebadge_user_label'])) && isset($nameBadgeConfData->namebadge_user_label)) { ?>
        <?php
        $typeBackGcolor     =   getTypeBackgroundColor($type_id);
        $typeTextcolor      =   getTypeTextColor($type_id);
        $background_color = (isset($typeBackGcolor) && !empty($typeBackGcolor) ? $typeBackGcolor : "black");
        $text_clor = (isset($typeTextcolor) && !empty($typeTextcolor) ? $typeTextcolor : "white");
        $textAlign = (isset($nameBadgeConfData->namebadge_user_label->textAlign) && !empty($nameBadgeConfData->namebadge_user_label->textAlign) ? $nameBadgeConfData->namebadge_user_label->textAlign : "left");
        $fontsize = (isset($nameBadgeConfData->namebadge_user_label->fontSize) && !empty($nameBadgeConfData->namebadge_user_label->fontSize) ? $nameBadgeConfData->namebadge_user_label->fontSize : 14);
        $fontweight = (isset($nameBadgeConfData->namebadge_user_label->fontWeight) && !empty($nameBadgeConfData->namebadge_user_label->fontWeight) ? $nameBadgeConfData->namebadge_user_label->fontWeight : 'normal');
        ?>
        <div class="badgeContent" style="min-height: 33px; color: <?php echo $text_clor; ?>;background-color: <?php echo $background_color; ?>;width:<?php echo $nameBadgeConfData->namebadge_user_label->width; ?>px; height: <?php echo $nameBadgeConfData->namebadge_user_label->height; ?>px; left: <?php echo $nameBadgeConfData->namebadge_user_label->left; ?>px; top: <?php echo $nameBadgeConfData->namebadge_user_label->top; ?>px; font-size:<?php echo $fontsize ?>px; font-weight: <?php echo $fontweight; ?>; text-align: <?php echo $textAlign; ?>">
            <?php echo $qrCodeFinalData['namebadge_user_label']; ?>
        </div>
    <?php } ?>
    
    
    <!--Zone Area-->
    <?php if ((isset($qrCodeFinalData['zone']) && !empty($qrCodeFinalData['zone'])) && isset($nameBadgeConfData->zonetable)) { ?>
        <?php
        $typeBackGcolor     =   getTypeBackgroundColor($type_id);
        $typeTextcolor      =   getTypeTextColor($type_id);
        $background_color   =  (isset($qrCodeFinalData['zone_bg_color']) && !empty($qrCodeFinalData['zone_bg_color']) ? $qrCodeFinalData['zone_bg_color'] : "black");
        $text_clor = (isset($typeTextcolor) && !empty($typeTextcolor) ? $typeTextcolor : "white");
        $textAlign = (isset($nameBadgeConfData->zonetable->textAlign) && !empty($nameBadgeConfData->zonetable->textAlign) ? $nameBadgeConfData->zonetable->textAlign : "left");
        $fontsize = (isset($nameBadgeConfData->zonetable->fontSize) && !empty($nameBadgeConfData->zonetable->fontSize) ? $nameBadgeConfData->zonetable->fontSize : 14);
        $fontweight = (isset($nameBadgeConfData->zonetable->fontWeight) && !empty($nameBadgeConfData->zonetable->fontWeight) ? $nameBadgeConfData->zonetable->fontWeight : 'normal');
        ?>
        <div class="badgeContent" style="min-height: 33px; color: <?php echo $text_clor; ?>;background-color: <?php echo $background_color; ?>;width:<?php echo $nameBadgeConfData->zonetable->width; ?>px; height: <?php echo $nameBadgeConfData->zonetable->height; ?>px; left: <?php echo $nameBadgeConfData->zonetable->left; ?>px; top: <?php echo $nameBadgeConfData->zonetable->top; ?>px; font-size:<?php echo $fontsize ?>px; font-weight: <?php echo $fontweight; ?>; text-align: <?php echo $textAlign; ?>">
            <?php echo $qrCodeFinalData['zone'].'|'.$qrCodeFinalData['table_name']; ?>
        </div>
    <?php } ?>
    
    
    
    
    <!--Company Area-->
    <?php if ((isset($qrCodeFinalData['company_name']) && !empty($qrCodeFinalData['company_name'])) && isset($nameBadgeConfData->company_name)) { ?>
        <?php
        $textAlign = (isset($nameBadgeConfData->company_name->textAlign) && !empty($nameBadgeConfData->company_name->textAlign) ? $nameBadgeConfData->company_name->textAlign : "left");
        $fontsize = (isset($nameBadgeConfData->company_name->fontSize) && !empty($nameBadgeConfData->company_name->fontSize) ? $nameBadgeConfData->company_name->fontSize : 14);
        $fontweight = (isset($nameBadgeConfData->company_name->fontWeight) && !empty($nameBadgeConfData->company_name->fontWeight) ? $nameBadgeConfData->company_name->fontWeight : 'normal');
        ?>
        <div class="badgeContent" style="width:<?php echo $nameBadgeConfData->company_name->width; ?>px; height: <?php echo $nameBadgeConfData->company_name->height; ?>px; left: <?php echo $nameBadgeConfData->company_name->left; ?>px; top: <?php echo $nameBadgeConfData->company_name->top; ?>px; font-size:<?php echo $fontsize ?>px; font-weight: <?php echo $fontweight; ?>; text-align: <?php echo $textAlign; ?>">
            <div id="nameBadgeVisitorCompany">
                <?php echo $qrCodeFinalData['company_name']; ?>
            </div>
        </div>
    <?php } ?>
    
    
    <!-- Designation Area-->
    <?php if ((isset($qrCodeFinalData['designation']) && !empty($qrCodeFinalData['designation'])) && isset($nameBadgeConfData->designation_name)) { ?>
        <?php
        $textAlign = (isset($nameBadgeConfData->designation_name->textAlign) && !empty($nameBadgeConfData->designation_name->textAlign) ? $nameBadgeConfData->designation_name->textAlign : "left");
        $fontsize = (isset($nameBadgeConfData->designation_name->fontSize) && !empty($nameBadgeConfData->designation_name->fontSize) ? $nameBadgeConfData->designation_name->fontSize : 14);
        $fontweight = (isset($nameBadgeConfData->designation_name->fontWeight) && !empty($nameBadgeConfData->designation_name->fontWeight) ? $nameBadgeConfData->designation_name->fontWeight : 'normal');
        if(strlen($qrCodeFinalData['designation']) > 50){
            $fontsize   =   '16';
        }
        ?>
        <div class="badgeContent" style="width:<?php echo $nameBadgeConfData->designation_name->width; ?>px; height: <?php echo $nameBadgeConfData->designation_name->height; ?>px; left: <?php echo $nameBadgeConfData->designation_name->left; ?>px; top: <?php echo $nameBadgeConfData->designation_name->top; ?>px; font-size:<?php echo $fontsize ?>px; font-weight: <?php echo $fontweight; ?>; text-align: <?php echo $textAlign; ?>">
            <div id="nameBadgeVisitorCompany">
                <?php echo $qrCodeFinalData['designation']; ?>
            </div>
        </div>
    <?php } ?>
    
    
    <!--Country Area-->
    <?php if ((isset($qrCodeFinalData['country_id']) && !empty($qrCodeFinalData['country_id'])) && isset($nameBadgeConfData->country_id)) { ?>
        <?php
        $textAlign = (isset($nameBadgeConfData->country_id->textAlign) && !empty($nameBadgeConfData->country_id->textAlign) ? $nameBadgeConfData->country_id->textAlign : "left");
        $fontsize = (isset($nameBadgeConfData->country_id->fontSize) && !empty($nameBadgeConfData->country_id->fontSize) ? $nameBadgeConfData->country_id->fontSize : 14);
        $fontweight = (isset($nameBadgeConfData->country_id->fontWeight) && !empty($nameBadgeConfData->country_id->fontWeight) ? $nameBadgeConfData->country_id->fontWeight : 'normal');
        ?>
        <div class="badgeContent" style="width:<?php echo $nameBadgeConfData->country_id->width; ?>px; height: <?php echo $nameBadgeConfData->country_id->height; ?>px; left: <?php echo $nameBadgeConfData->country_id->left; ?>px; top: <?php echo $nameBadgeConfData->country_id->top; ?>px; font-size:<?php echo $fontsize ?>px; font-weight: <?php echo $fontweight; ?>; text-align: <?php echo $textAlign; ?>">
            <div id="nameBadgeVisitorCountry">
                <?php echo $qrCodeFinalData['country_id']; ?>
            </div>
        </div>
    <?php } ?>
    <!--Qrcode Area-->
    <?php if (isset($nameBadgeConfData->qrcode) && !empty($nameBadgeConfData->qrcode)) { ?>
        <?php
        $scaleX = $nameBadgeConfData->qrcode->scaleX;
        $scaleY = $nameBadgeConfData->qrcode->scaleY;
        $textAlign = (isset($nameBadgeConfData->qrcode->textAlign) && !empty($nameBadgeConfData->qrcode->textAlign) ? $nameBadgeConfData->qrcode->textAlign : "left");
        $fontsize = (isset($nameBadgeConfData->qrcode->fontSize) && !empty($nameBadgeConfData->qrcode->fontSize) ? $nameBadgeConfData->qrcode->fontSize : 14);
        $fontweight = (isset($nameBadgeConfData->qrcode->fontWeight) && !empty($nameBadgeConfData->qrcode->fontWeight) ? $nameBadgeConfData->qrcode->fontWeight : 'normal');
        ?>
        <div class="badgeContent" style="transform: scale(<?php echo $scaleX; ?>, <?php echo $scaleY; ?>);width:<?php echo $nameBadgeConfData->qrcode->width; ?>px; height: <?php echo $nameBadgeConfData->qrcode->height; ?>px; left: <?php echo $nameBadgeConfData->qrcode->left; ?>px; top: <?php echo $nameBadgeConfData->qrcode->top; ?>px; font-size:<?php echo $fontsize ?>px; font-weight: <?php echo $fontweight; ?>; text-align: <?php echo $textAlign; ?>">
            <?php
            if(isset($dashboardQrImage) && $dashboardQrImage==1){
                $qrcodePath = $dashboardUrl . 'pdf/' . $event_id . "/" . $event_id . $user_id . ".png";
                $path = $qrcodePath;
                $type = pathinfo($qrcodePath, PATHINFO_EXTENSION);
                $imageqrdata = file_get_contents($qrcodePath);
                $imageqrdatabase64 = 'data:image/' . $type . ';base64,' . base64_encode($imageqrdata);
            
            ?>
            <img id="reg_qrcode_image" src="<?php echo $imageqrdatabase64; ?>" width="<?php echo $nameBadgeConfData->qrcode->width; ?>" height="<?php echo $nameBadgeConfData->qrcode->height; ?>"/>
            <?php            
                }else{
                if(isset($qrCodeFinalData['vcard_path']) && !empty($qrCodeFinalData['vcard_path'])){
                    $vcardFullPath  =   public_path('vcards/'.$qrCodeFinalData['vcard_path']);
                    $vcardPath      =   asset('public/vcards/'.$qrCodeFinalData['vcard_path']); 
                    $qrcodeWidth    =   $nameBadgeConfData->qrcode->width;
                    $qrcodeHeight   =   $nameBadgeConfData->qrcode->width;
                    if (file_exists($vcardFullPath)) {
                        echo "<img id='reg_qrcode_image' src='$vcardPath' width='$qrcodeWidth' height='$qrcodeHeight'/>";
                    }else{
                        echo 'qrvcard not found';
                    }
                }
            ?>
            <?php } ?>
        </div>
    <?php } ?>
</div>
<div style="clear: both"></div>

