<h3 class="H3_FontAr"><?php echo $PageTitle ?></h3>
<div class="row PanelMin"><div class="col-md-12">
<?php
if(!defined('WEB_ROOT')) {	exit;}
 


if(isset($_POST['DelUnit'])) {
	if($GroupPermation == '1') {
		DelUnit();
	} else {
		SendMassgeforuser();
	}
}




if(isset($_POST['Sel_list'])) {
Redirect_Page_2("index.php?view=List&Cat_Id=".$_POST['cat_id']);
}

if(isset($_POST['Search_Name'])) {
Redirect_Page_2("index.php?view=List&Search=".$_POST['search_name']."&Type=".$_POST['S_Type']);
}
 
$PERpage = $ConfigP['perpage_unit'] ;
$orderby = RterunOrder($ConfigP['order_by_unit']) ;

if(isset($_GET['Cat_Id'])){
  $cat_id = intval($_GET['Cat_Id']);
  $THESQL = "SELECT * FROM $GroupTabel where cat_id = '$cat_id' $orderby";
  $THELINK = "view=List&Cat_Id=".$cat_id;
  
}elseif(isset($_GET['Search'])){
    $PERpage = "100" ;
    $Search = $_GET['Search'];
    
    if(trim($_GET['Search']) == ""){
        Redirect_Page_2("index.php?view=Cat_List");
    }
 
    if($_GET['Type']== 'En'){
    $THESQL = "SELECT * FROM  $GroupTabel  where name_en LIKE '%$Search%'  $orderby ";    
    }else{
    $THESQL = "SELECT * FROM  $GroupTabel  where name LIKE '%$Search%'  $orderby ";      
    } 
    
    $THELINK = "view=U_List&Search=".$_GET['Search']."&Type=".$_GET['S_Type'];   
     
     
       
}else{
  $THESQL = "SELECT * FROM $GroupTabel $orderby ";
  $THELINK = "view=List";
}


$already = $db->H_Total_Count($THESQL);
if ($already > 0){
?>

<?php
$VallOf = array('PageCount' => 'perpage_unit', 'PageOrder' => "order_by_unit" , 'OrderList' => $Order_ByList ,
'FilterName' => "mainform_filter_con" , 'FilterPath' => 'ListSearch' );
PrintUpdateConfigElement($VallOf);	
?>

<form name="myform" action="#" method="post">
<?php 
if(FREESTYLE4U_EDIT == '1'){
FPrint_ADD_Submit("1"); 
}
?>

<div class="panel panel-default">
<div class="table-responsive">
<table class="table table-striped table-bordered table-hover ArTabel">
<thead>
<tr>
<?php

echo '<th width="50">ID</th>';
echo '<th width="200">'.$AdminLangFile['adminlang_cat_name'].'</th>';
echo '<th width="150">'.$AdminLangFile['adminlang_var_name'].'</th>';
echo '<th width="200">'.$AdminLangFile['adminlang_var_des'].'</th>';
if(ADMINCPANELLANG == "1"){
echo '<th width="200">'.$AdminLangFile['adminlang_var_des'].ENLANG.'</th>';
}
echo '<th width="50"></th>';
	
if(FREESTYLE4U_EDIT == '1'){
echo '<th width="50"></th>';
echo '<th width="50">';
echo '<input type="checkbox" name="Check_ctr" value="yes" onClick="Check(document.myform.Check_ctr)">';
echo '</th>';
}

?>


</tr>
</thead>
<tbody>

<?php



    
$NOPAGE = GETTHEPAGE ($THESQL ,$PERpage);
if ($NOPAGE != 1){
$Name = $db->SelArr($THESQL ,true,$PERpage,PAGING_NEXT_PREV_NUM,$THELINK,5); 
for($i = 0; $i < count($Name); $i++) {
$id = $Name[$i]['id'];  
$UnitState =  $Name[$i]['state']; 
if(ADMIN_WEB_LANG == 'En'){
$CatNamePrint = 'name_en' ;   
}else{
$CatNamePrint = 'name' ;      
}    
$catname = GetNameFromID($CatTabel,$Name[$i]['cat_id'],$CatNamePrint) ;

$catvar = GetNameFromID($CatTabel,$Name[$i]['cat_id'],"cat_id") ;
 
echo '<tr>';
echo '<td>'.$Name[$i]['id'].'</td>';
echo '<td><a href="index.php?view=List&Cat_Id='.$Name[$i]['cat_id'].'">'.$catname.'</a></td>';
echo '<td>'. $catvar."_".$Name[$i]['var'].'</td>'; 
echo '<td>'.nl2br(NiceTrim2011($Name[$i]['name'],"200")).'</td>';
if(ADMINCPANELLANG){echo '<td>'.nl2br(NiceTrim2011($Name[$i]['name_en'],"200")).'</td>';}



echo '<td align="center">'.NF_PrintBut_TD('2',$AdminLangFile['mainform_edit'],"Edit&id=".$id,"btn-info","fa-pencil").'</td>';


if(FREESTYLE4U_EDIT == '1'){
if($ConfigP['deletetype'] == '1'){    
echo '<td align="center">'.NF_PrintBut_TD('autodelete_2',$AdminLangFile['mainform_delete'],$id,"","").'</td>';    
}else{
echo '<td align="center">'.NF_PrintBut_TD('2',$AdminLangFile['mainform_delete'],"Dell&id=".$id,"btn-danger","fa-window-close").'</td>';
}    

echo '<td align="center">'.PrintCheckBox_New($id).'</td>';
}

} 
}
	
?>                          
</tbody>
</table>
</div>
</div>
</form>              

<div class="col-md-12 col-sm-12 col-xs-12">

<?php echo $db->pager; ?>
</div>

<?php
}else{
    
echo '<div class="alert alert-danger alert_danger_ar ">'.$AdminLangFile['mainform_alert_no_content'].'</div>';    
    
}
?>



</div></div>

              