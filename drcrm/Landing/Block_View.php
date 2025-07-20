<?php
if(!defined('WEB_ROOT')) {	exit;}
 
######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);



 
$row = $db->H_CheckTheGet("id","id",$GroupTabel,"2");
$id = $row['id'];
extract($row);

PageEditBut($id);
 
 
Form_Open($ArrForm);

$Arr = array("StartFrom" => '1',"Label" => 'on' );  
$Err[] = NF_PrintSelect_2018("ArrFrom",$AdminLangFile['lppage_block_type'],"col-md-3","type",$LandingPageBlock,"req","0",$Arr);
// hidden
echo '<input type="hidden" name="cat_id" value="'.$id.'" />';

Form_Close("1");

if(isset($_POST['B1'])){
    Redirect_Page_2("index.php?view=AddBlock&id=".$_POST['cat_id']."&type=".$_POST['type']);
}            




 
#################################################################################################################################
###################################################   
#################################################################################################################################
echo '<div style="clear: both!important;"></div>';
PrintFildInformation("col-md-4",$AdminLangFile['lppage_page_name'],$row['name']);
PrintFildInformation("col-md-4",$AdminLangFile['lppage_page_name'].ENLANG,$row['name_en']);

echo '<div style="clear: both!important;"></div>';


echo '<div style="clear: both!important;"></div>'.BR.BR;

if(isset($_POST['UnActAllUnit'])) {
	if($USER_PERMATION_Edit == '1') {
       UnActAllUnit_New("landpage_block");
	} else {
		SendMassgeforuser();
	}
}
if(isset($_POST['ActAllUnit'])) {
	if($USER_PERMATION_Edit == '1') {
		ActAllUnit_New("landpage_block");
	} else {
		SendMassgeforuser();
	}
}

if(isset($_POST['DelUnit'])) {
	if($USER_PERMATION_Dell == '1') {
        DeleteBlock_New();
	} else {
		SendMassgeforuser();
	}
}


echo '<div style="clear: both!important;"></div>';

$ASql = "SELECT * FROM landpage_block where cat_id = '$id' ORDER BY postion" ;
$already = $db->H_Total_Count($ASql);
if($already > 0) {

echo '<form name="myform" action="#" method="post">';
FPrint_ADD_Submit("1");
echo '<div class="panel panel-default"><div class="table-responsive">';
echo '<table class="table table-striped table-bordered table-hover ArTabel">';
echo '<thead><tr>';


 
echo '<th width="30">ID</th>';
echo '<th width="200">'.$AdminLangFile['lppage_content_title'].'</th>';
echo '<th width="200">'.$AdminLangFile['lppage_content_title'].ENLANG.'</th>';
echo '<th width="200">'.$AdminLangFile['lppage_block_type'].'</th>';

echo '<th width="50"></th>';
echo '<th width="50"></th>';
echo '<th width="50">Menu Status</th>';
echo '<th width="50"></th>';
echo '<th width="50" ><input type="checkbox" name="Check_ctr" value="yes" onClick="Check(document.myform.Check_ctr)"></th>';
echo '</tr></thead><tbody>'; 
   
 

$Name = $db->SelArr($ASql);

for($i = 0; $i < count($Name); $i++) {
$id = $Name[$i]['id'];  
$type = LandingPageBlock($Name[$i]['type']);
 
echo '<tr>';
echo '<td>'.$Name[$i]['id'].'</td>';
echo '<td>'.$Name[$i]['name'].'</td>';
echo '<td>'.$Name[$i]['name_en'].'</td>';
echo '<td>'.$type.'</td>';

echo '<td align="center">'.NF_PrintBut_TD('2',$AdminLangFile['mainform_edit'],"BlockEdit&id=".$id,"btn-info","fa-pencil").'</td>';
/*
echo '<td align="center">'.NF_PrintBut_TD('2',$AdminLangFile['lppage_view_content'],"ViewBlock&id=".$id,"btn-info","fa-search").'</td>';*/
echo '<td align="center">'.NF_PrintBut_TD('2',$AdminLangFile['lppage_order_block'],"OrderBlock&id=".$row['id'],"btn-info","fa-sort-amount-desc").'</td>';
echo '<td align="center">'.CheckUnitState($Name[$i]['menu_s']).'</td>';
echo '<td align="center">'.CheckUnitState($Name[$i]['state']).'</td>';
echo '<td align="center">'.PrintCheckBox_New($id).'</td>'; 


echo '</tr>';
} 
 

///// Close    
 
 
echo '</tbody></table></div></div></form>  ';
 
 

}else{ 
echo '<div class="alert alert-danger alert_danger_ar ">'.$AdminLangFile['mainform_alert_no_content'].'</div>';        
}    
    

######/<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<-----------------------------------------------
Close_Page();  
?>
 