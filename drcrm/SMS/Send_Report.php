<?php
if(!defined('WEB_ROOT')) {	exit;}
 
?>
<h3 class="H3_FontAr"><?php echo $PageTitle ?></h3>
<div class="row PanelMin"><div class="col-md-12">

<?php

$PERpage = $ConfigP['perpage_unit'] ;
$orderby = RterunOrder($ConfigP['order_by_unit']) ;

 
$THESQL = "SELECT * FROM sms_report $orderby ";
$THELINK = "view=".$view;

$already = $db->H_Total_Count($THESQL);
if ($already > 0){

if($ConfigP['datatabel'] == '1' and DATATABELVIEW == '1'  ){
echo '<table id="MyCustmer" class="table table-striped table-bordered table-hover ArTabel ArTabel_55">';
echo '<thead><tr>';  
}else{
echo '<div class="panel panel-default"><div class="table-responsive">';
echo '<table class="table table-striped table-bordered table-hover ArTabel">';
echo '<thead><tr>';
}


echo '<th width="30">ID</th>';
echo '<th width="60">'.$AdminLangFile['sms_send_date'].'</th>';
echo '<th width="100">'.$AdminLangFile['sms_send_type'].'</th>';    
echo '<th width="100">'.$AdminLangFile['sms_sms_c_name'].'</th>';    
echo '<th width="100">'.$AdminLangFile['sms_mass'].'</th>';    
echo '<th width="150">'.$AdminLangFile['sms_count'].'</th>';
echo '<th width="100">'.$AdminLangFile['sms_total'].'</th>';
echo '<th width="50"></th>';  
echo '</tr></thead><tbody>';


   



$NOPAGE = GETTHEPAGE ($THESQL ,$PERpage);
if ($NOPAGE != 1){

if($ConfigP['datatabel'] == '1' and DATATABELVIEW == '1'  ){
$Name = $db->SelArr($THESQL);
}else{
$Name = $db->SelArr($THESQL ,true,$PERpage,PAGING_NEXT_PREV_NUM,$THELINK,5); 
}



for($i = 0; $i < count($Name); $i++) {
$id = $Name[$i]['id']; 
 
echo '<tr>';
echo '<td>'.$Name[$i]['id'].'</td>';
echo '<td>'.PrintFullTime($Name[$i]['date_time']).'</td>';
echo '<td>'.Rterun_SMS_Type($Name[$i]['type']).'</td>';
echo '<td>'.$Name[$i]['name'].'</td>';
echo '<td>'.nl2br($Name[$i]['des']).'</td>'; 
echo '<td>'.$Name[$i]['count'].'</td>'; 
echo '<td>'.$Name[$i]['total'].'</td>'; 
  
echo '<td align="center">'.NF_PrintBut_TD('2',$AdminLangFile['mainform_delete'],"Dell&id=".$id,"btn-danger","fa-window-close").'</td>'; 
echo '</tr>';
} 
}
	
///// Close    
if($ConfigP['datatabel'] == '1' and DATATABELVIEW == '1'  ){
echo '</tbody></table>';  
}else{
echo '</tbody></table></div></div>';
echo '<div class="col-md-12 col-sm-12 col-xs-12">';
echo $db->pager;
echo '</div>';
}


}else{ 
echo '<div style="clear: both!important;"></div>';       
echo '<div class="alert alert-danger alert_danger_ar ">'.$AdminLangFile['mainform_alert_no_content'].'</div>';        
}
?>
</div></div>