<?php
if(!defined('WEB_ROOT')) {	exit;}
 
?>
<h3 class="H3_FontAr"><?php echo $PageTitle ?></h3>
<div class="row PanelMin"><div class="col-md-12">

<?php
if(!isset($_POST['B1'])){
UnsetAllSession('name');
}



 

$row = $db->H_CheckTheGet("id","id",$Main_DataTabel,"2");
extract($row);

if($row['count'] == '0'){
$already = $db->H_Total_Count("SELECT id FROM $Fs_Count_tabel WHERE $Fs_Count_Filde = '$id'");
if($already > 0 ){
UpdateFildeForDell($Main_DataTabel,"count",$already,$id) ;     
$row = $db->H_CheckTheGet("id","id",$Main_DataTabel,"2");
extract($row);
}
}

Form_Open($ArrForm);



echo '<div style="clear: both!important;"></div>';

if($row['count'] == '0'){
$Arr = array("Label" => 'on',"Active" => '0','Order'=> "order by count desc" );
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['managedate_catname'],"col-md-3","cat_id",$Sub_DataTabel,"req",$cat_id,$Arr);

}else{
$user_id_n = GetNameFromID($Sub_DataTabel,$cat_id,$NamePrint) ;
PrintFildInformation("col-md-3" ,$AdminLangFile['managedate_catname'],$user_id_n);
echo '<input type="hidden" name="cat_id" value="'.$cat_id.'" />';
}




echo '<div style="clear: both!important;"></div>';

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required','Dir'=> "Ar_Lang");
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['managedate_data_name'],"name","1","1","req",$MoreS);

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required', 'Dir'=> "En_Lang");
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['managedate_data_name'].ENLANG,"name_en","1","1","req",$MoreS);




Form_Close_New("2",$Fs_ListUrl);


if(isset($_POST['B1'])){
Vall($Err,"CustSubEdit",$db,"1",$USER_PERMATION_Edit);
}            


	
?>




</div></div>