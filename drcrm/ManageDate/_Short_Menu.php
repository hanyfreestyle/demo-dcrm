<?php
if(!defined('WEB_ROOT')) {	exit;}
 
?>
<div class="row ShortMenu"><div class="col-md-12">
<?php
 
 




if(UPDATE_REPORT_MENU == 1){
Update_Left_Menu("managedate");    
}

echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("CustSubList").'"  href="index.php?view=CustSubList">
<i class=""></i>'.$AdminLangFile['managedate_custsub_but'].'</a>';

if(F_LEAD_SOURS == 1){
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("ListLeadSours").'"  href="index.php?view=ListLeadSours">
<i class=""></i>'.$AdminLangFile['managedate_lead_sours_but'].'</a>';    
}

if(F_LEAD_TYPE == 1){
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("ListLeadType").'"  href="index.php?view=ListLeadType">
<i class=""></i>'.$AdminLangFile['managedate_lead_type_but'].'</a>';    
}

if(F_LEAD_CAT  == 1 ){
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("LeadCat").'"  href="index.php?view=LeadCat">
<i class=""></i>'.$AdminLangFile['managedate_leadcat_but'].'</a>';    
}


if(F_COUNTRY_ID == 1){
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("Country").'"  href="index.php?view=Country">
<i class=""></i>'.$AdminLangFile['managedate_country'].'</a>';    
}

if(F_CITY_ID == 1){
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("City").'"  href="index.php?view=City">
<i class=""></i>'.$AdminLangFile['managedate_city'].'</a>';
}


if(F_SOCIAL_ID == 1 ){
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("ListSocial").'"  href="index.php?view=ListSocial">
<i class=""></i>'.$AdminLangFile['managedate_social_but'].'</a>';    
} 

if(F_JOP_ID == 1){
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("ListJop").'"  href="index.php?view=ListJop">
<i class=""></i>'.$AdminLangFile['managedate_jop_but'].'</a>';    
}



if(F_CASH_ID == 1 ){
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("ListCash").'"  href="index.php?view=ListCash">
<i class=""></i>'.$AdminLangFile['managedate_cash_but'].'</a>';    
}


if(F_AREA_ID == 1 ){
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("ListArea").'"  href="index.php?view=ListArea">
<i class=""></i>'.$AdminLangFile['managedate_area_but'].'</a>';    
}

if(F_BEST_CALL_ID == 1 ){
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("ListBestcall").'"  href="index.php?view=ListBestcall">
<i class=""></i>'.$AdminLangFile['managedate_bestcall_but'].'</a>';    
}

if(F_CALL_TIME_ID == 1 ){
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("ListTime").'"  href="index.php?view=ListTime">
<i class=""></i>'.$AdminLangFile['managedate_time_but'].'</a>';   
}

if(F_DATE_RECEIPT_ID == 1 ){
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("ListDate").'"  href="index.php?view=ListDate">
<i class=""></i>'.$AdminLangFile['managedate_date_but'].'</a>';   
}

if(F_UNIT_TYPE_ID == 1 ){
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("ListUnit").'"  href="index.php?view=ListUnit">
<i class=""></i>'.$AdminLangFile['managedate_unit_but'].'</a>';   
}


if( F_REASON_T_ID == 1 ){
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("ListOpenReason").'"  href="index.php?view=ListOpenReason">
<i class=""></i>'.$AdminLangFile['managedate_reason_but'].'</a>';   
}

if( F_COURS == 1 ){
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("ListCours").'"  href="index.php?view=ListCours">
<i class=""></i>'.$AdminLangFile['managedate_cours_but'].'</a>';   
}






 
 
if($USER_PERMATION_Edit == '1'){
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("Config").'"  href="index.php?view=Config">
<i class="fa fa-cogs"></i>'.$AdminLangFile['mainform_config'].'</a>';

if(F_UPDATE_DATA == '1'){
echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("UpDate").'"  href="index.php?view=UpDate">
<i class="fa fa-refresh"></i>'.$AdminLangFile['managedate_update'].'</a>';
}

}


?>
</div></div>
<div style="clear: both!important;"></div>