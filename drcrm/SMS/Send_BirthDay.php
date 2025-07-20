<?php
if(!defined('WEB_ROOT')) {	exit;}
 
$BirthDay = FULLDate_ForToday();
$birth_month = $BirthDay['Month'];
$birth_day = $BirthDay['Day'];

 

if($sms_type == '1'){
$MaxLetter = Rterun_SMS_Ar_Letter($ConfigP['ar_count'])   ;
}elseif($sms_type == '2'){
$MaxLetter = Rterun_SMS_En_Letter($ConfigP['en_count'])   ;    
} 
 
 
?>
<h3 class="H3_FontAr"><?php echo $PageTitle ?></h3>
<div class="row PanelMin"><div class="col-md-12">
<script type="text/javascript">
$(function() {
$('#des').maxlength({max: <?php echo $MaxLetter ?>});
});
</script>

<?php

 


$THESQL = "SELECT * FROM  customer where birth_month = $birth_month and birth_day = $birth_day " ;

$already = $db->H_Total_Count($THESQL); 

if($already > 0){
    
ReportBlockPrint("col-md-3",$AdminLangFile['report_totalcount'],intval($already),"fa-users","alert-info");
echo '<div style="clear: both!important;"></div>';


$PrinTYpe = Rterun_SMS_Type($sms_type);
New_Print_Alert("5",$AdminLangFile['sms_h1_send']." ".$PrinTYpe); 

echo '<div style="clear: both!important;"></div>';

echo '<form name="myform" action="Send_Api.php" id="validate-form" data-parsley-validate method="post">';    
// hidden  UnsetAllSession("username,password,sendername");
echo '<input type="hidden" name="username" value="'.$ConfigP['username'].'" />';
echo '<input type="hidden" name="password" value="'.$ConfigP['password'].'" />';
echo '<input type="hidden" name="sendername" value="'.$ConfigP['sendername'].'" />';

echo '<input type="hidden" name="sql_line" value="'.$THESQL.'" />';
echo '<input type="hidden" name="count" value="'.$already.'" />';
echo '<input type="hidden" name="type" value="'.$sms_type.'" />';
echo '<div style="clear: both!important;"></div>';

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required' ,'Dir'=> "Ar_Lang");
$Err[] = NF_PrintInput("Text",$AdminLangFile['sms_sms_c_name'],"name","1","1","req",$MoreS);
echo '<div style="clear: both!important;"></div>';

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required' ,'Dir'=> "Ar_Lang");
$Err[] = NF_PrintInput("TextArea",$AdminLangFile['sms_mass'],"des","0","0","option",$MoreS);
echo '<div style="clear: both!important;"></div>';




echo '<div style="clear: both!important;"></div>';
echo '<button type="submit" name="SendSmS" class="mb-sm btn btn-danger">'.$AdminLangFile['sms_send_sms_but'].'</button> ';
echo '</form>';

} 

 
  



 


?>
</div></div>