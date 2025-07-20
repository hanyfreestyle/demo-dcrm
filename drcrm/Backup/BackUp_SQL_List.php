<?php
if(!defined('WEB_ROOT')) {	exit;}
 
######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);



function DelFile_New($Tabel){
    global $db;
    if(isset($_POST['id_id'])){
    $EmailCount = count($_POST['id_id']);
    for ($i = 0; $i < $EmailCount; $i++){
        $id =  $_POST['id_id'][$i]  ;
        Image_Dell("1",$id,BACKUP_FOLDER_DIR,"x_back_up","path","");
        $db->H_DELETE_FromId($Tabel,$id);
    }
  }
}

if(isset($_POST['DelUnit'])) {
	if($AdminConfig['admin'] == '1') {
	   DelFile_New("x_back_up");	
	} else {
		SendMassgeforuser();
	}
}



$ConfigP['datatabel'] = '0';
$orderby = " order by id desc ";
$PERpage = "40" ;

$THESQL = "SELECT * FROM x_back_up where b_type = 'sql' $orderby";
$THELINK = "view=".$view;


echo '<a class="btn3d btn btn_3d-default btn-lg '.CheckSelBut("Add").'"  href="index.php?view=Add">
<i class="fa fa-plus-circle"> </i> '.$AdminLangFile['backup_add'].' </a>'.BR;


$already = $db->H_Total_Count($THESQL);
if ($already > 0){



    

$OtherBut = '<div class="row PanelMin TopButAction"><div class="col-md-12">  
<button type="submit"  name="DelUnit" class="mb-sm btn btn-danger">'.$AdminLangFile['mainform_delete'].'</button> 
</div> </div><div style="clear: both;"></div>';

///// Open_Header
$TaBelArr = array('OtherBut'=>$OtherBut);
TableOpen_Header($TaBelArr);





echo '<th width="30">ID</th>';
echo '<th width="100">'.$AdminLangFile['backup_add_date'].'</th>';
echo '<th width="150">'.$AdminLangFile['backup_file_name'].'</th>';
echo '<th width="150">'.$AdminLangFile['backup_method'].'</th>';
echo '<th width="150">'.$AdminLangFile['backup_file_size'].'</th>';
echo '<th width="100"></th>';
echo '<th width="100"></th>';
echo '<th width="150">'.$AdminLangFile['backup_transfer'].'</th>';  
echo '<th width="50" ><input type="checkbox" name="Check_ctr" value="yes" onClick="Check(document.myform.Check_ctr)"></th>';

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
@$FileSize = GetFileSize(BACKUP_FOLDER_DIR.$Name[$i]['path']);

echo '<tr>';
echo '<td>'.$Name[$i]['id'].'</td>';
echo '<td>'.ConvertDateToCalender_2($Name[$i]['date_add']).'</td>';

echo '<td>'.$Name[$i]['name'].'</td>';
echo '<td>'.FileTYpeName($Name[$i]['type']).'</td>';

echo '<td align="center">'.$FileSize.'</td>';
echo '<td align="center">'.NF_PrintBut_TD('1',$AdminLangFile['backup_download'],"DownLoad&id=".$id,"btn-success","fa-download").'</td>';
echo '<td align="center">'.NF_PrintBut_TD('1',$AdminLangFile['backup_dell'],"Dell&id=".$id,"btn-danger","fa-window-close").'</td>'; 



echo '<td align="center">'.CheckUnitState($Name[$i]['state']).'</td>';
echo '<td align="center">'.PrintCheckBox_New($id).'</td>'; 
echo '</tr>';
} 
}
	
    
///// CloseTabel   
CloseTabel();

echo '</form>';
}else{ 
Alert_NO_Content();   
}

######/<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<-----------------------------------------------
Close_Page();
 
?>