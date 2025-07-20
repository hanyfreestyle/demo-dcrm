<script type="text/javascript">
var obj;
if(window.XMLHttpRequest)
{obj = new XMLHttpRequest();}
else if(window.ActiveXObject)
{obj = new ActiveXObject("MSXML2.XMLHTTP");}
function GetArchivesPhoto()
{
	document.getElementById('city').innerHTML = "<img src='../include/img/loading30.gif'>";
	var Cat_Id = document.country_city.pro_id.value;
	var url = 'Unit_List_Ajex.php?Cat_Id='+Cat_Id;
	if(obj) 
	{	
		obj.open("GET", url);
		obj.onreadystatechange = function()
		{
		if (obj.readyState == 4 && obj.status == 200) {
		document.getElementById('city').innerHTML = obj.responseText;
		}
		}
		obj.send(null);
	}
}
</script>
<?php
if(!defined('WEB_ROOT')) {	exit;}


######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

$ThisTabelName = "project_unit";

if(isset($_GET['Project_Id']) or isset($_GET['Floor_Id'])){
$PERpage = "30";
$orderby = "";
if(isset($_GET['Project_Id'])){
  $Pro_ID = CheckTheGet("Project_Id","id","project","خطأ","خطأ");  
  $ThisHanyProId = $Pro_ID ;  
  $THESQL = "SELECT * FROM project_unit where pro_id = '$Pro_ID' $orderby";
  $THELINK = "view=UnitList&Project_Id=".$Pro_ID;
  }elseif(isset($_GET['Floor_Id'])){
  $Flooor_ID = CheckTheGet("Floor_Id","id","project_floor","خطأ","خطأ");    
  $Pro_ID = GetNameFromID("project_floor",$Flooor_ID,"pro_id");
  $ThisHanyProId = $Pro_ID ;
  $THESQL = "SELECT * FROM project_unit where floor_id = '$Flooor_ID' $orderby";
  $THELINK = "view=UnitList&Floor_Id=".$Flooor_ID;
}else{
  $THESQL = "SELECT * FROM project_unit $orderby ";
  $THELINK = "view=List";
}

#################################################################################################################################
###################################################    
################################################################################################################################# 
$already = $db->H_Total_Count($THESQL);
if ($already > 0){

    
    
echo '<div class="row"><div class="col-md-12 Row_Top Row_Top_link">';
echo  NF_PrintBut_TD('1',$AdminLangFile['project_tabel_list'],"Tabel&Project_Id=".$Pro_ID,"btn-success","fa-table");
echo  NF_PrintBut_TD('1',$AdminLangFile['project_list_all_unit'],"UnitList&Project_Id=".$Pro_ID,"btn-success","fa-search");
$ButLinkforfloor = $db->SelArr("SELECT * FROM project_floor where pro_id = '$Pro_ID' ORDER BY f_code  ");
for($x = 0; $x < count($ButLinkforfloor); $x++) {
echo  NF_PrintBut_TD('1',$ButLinkforfloor[$x]['name'],"UnitList&Floor_Id=".$ButLinkforfloor[$x]['id'],"btn-success","fa-search");
} 
echo '</div></div>';

///////
$row_proInfo = $db->H_SelectOneRow("SELECT * FROM project where id = '$ThisHanyProId'");

$PrintMass = $AdminLangFile['project_unit_list_proname_1']." ".$row_proInfo['name'].BR;
$PrintMass .= $AdminLangFile['project_unit_list_proname_2']." ".GetNameFromID("project_area",$row_proInfo['area_id'],"name");
New_Print_Alert("2",$PrintMass);    
echo '<div style="clear: both!important;"></div>';   

#################################################################################################################################
###################################################    
#################################################################################################################################



///// Open_Header
TableOpen_Header();


Table_TH_Print('1',"ID","50");
Table_TH_Print('1',$ALang['project_floor_name'],"150");
Table_TH_Print('1',$ALang['project_new_unit_code'],"100");
Table_TH_Print('1',$ALang['project_new_unit_num'],"100");
Table_TH_Print('1',$ALang['project_unit_area_sq'],"100");
Table_TH_Print('1',$ALang['pro_price_tabel_name'],"100");
Table_TH_Print('1',$ALang['project_unit_state_t'],"100");
Table_TH_Print('1',"","50");
Table_TH_Print('1',"","50");
 
 


///// TableClose_Header
TableClose_Header();
 

$NOPAGE = GETTHEPAGE ($THESQL ,$PERpage);
if ($NOPAGE != 1){
if($ConfigP['datatabel'] == '1' and DATATABELVIEW == '1'  ){
$Name = $db->SelArr($THESQL);
}else{
$Name = $db->SelArr($THESQL ,true,$PERpage,PAGING_NEXT_PREV_NUM,$THELINK,5); 
}



for($i = 0; $i < count($Name); $i++) {
$id = $Name[$i]['id']; 
$FloorName = findValue_FromArr($FloorName_Arr,'id',$Name[$i]['floor_id'],$NamePrint);
$PriceName = findValue_FromArr($PriceName_Arr,'id',$Name[$i]['price_id'],$NamePrint); 


echo '<tr>';

Table_TD_Print('1',$Name[$i]['id'],"C");
Table_TD_Print('1',$FloorName,"C");
 
Table_TD_Print("1",$row_proInfo['pro_code'].$Name[$i]['p_code'],"C",array('OtherStyle'=>"Td_Count"));
Table_TD_Print("1",$Name[$i]['u_num'],"C",array('OtherStyle'=>"Td_Count"));

if($Name[$i]['u_area']){
Table_TD_Print("1",$Name[$i]['u_area']." M","C",array('OtherStyle'=>"Td_Count")); 
}else{
echo '<td class="UnitCode"></td>';    
}

Table_TD_Print('1',$PriceName,"C");

if($Name[$i]['avtive'] == '0'){
Table_TD_Print('1',NF_PrintBut_TD('1',$ALang['project_unit_state_unavtive'],"Unit_Edit&id=".$id,"btn-danger","fa-exclamation-triangle"),"C");    
}else{
Table_TD_Print("1",PrintUnitBox_2($Name[$i]),"C"); 
}



if($Name[$i]['state'] == '1' or $Name[$i]['state'] == '2' ){
echo '<td align="center"><a href="Unit_PrintS.php?id='.$id.'" class="btn btn-xs TdBut btn-info" target="_blank" >
<i class="fa fa-print"></i> '.$ALang['pro_price_print_but'].'</a></td>';
}else{
echo '<td align="center"></td>';     
}


Table_TD_Print("1",NF_PrintBut_TD('2',$ALang['mainform_edit'],"Unit_Edit&id=".$id,"btn-info","fa-pencil"),"C"); 

 
 
echo '</tr>';
} 
}
	
///// CloseTabel   
CloseTabel();


}else{
Alert_NO_Content();       
}



#################################################################################################################################
###################################################    
#################################################################################################################################
echo '<div style="clear: both!important;"></div>';
}else{
echo '<div class="AddRoutineCatIDD">';    
$ArrForm = array('FormName'=> 'country_city');
Form_Open($ArrForm);
 

$Arr = array("Label" => 'on' , "Ajex_01"=>'onchange="GetArchivesPhoto()"');
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['project_pro_name'],"col-md-4","pro_id","project","req",0,$Arr);	
echo '<div id="city"></div>';
Form_Close('4');


if(isset($_POST['B1'])){
  if(intval($_POST['floor_id']) != '0'){
  Redirect_Page_2('index.php?view=UnitList&Floor_Id='.$_POST['floor_id']);    
  }else{
  Redirect_Page_2('index.php?view=UnitList&Project_Id='.$_POST['pro_id']);   
  }
}
echo '</div>';
}





######/<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<-----------------------------------------------
Close_Page();
?>
