<?php
if(!defined('WEB_ROOT')) {	exit;}
 
######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

 
$GroupTabel = "project";
$PERpage = $ConfigP['perpage_unit'] ;
$orderby = RterunOrder($ConfigP['order_by_unit']) ;

#################################################################################################################################
###################################################   List View 
#################################################################################################################################
if($view == 'List'){
    $ListCruntBut =  "btn-success" ;
    $ListLast =  "btn-success" ;
    if(isset($_GET['Area_Id'])){
        $area_id = intval($_GET['Area_Id']);
        $THESQL = "SELECT * FROM $GroupTabel where area_id = '$area_id' $orderby";
        $THELINK = "view=List&Area_Id=".$area_id;
    }elseif(isset($_GET['Crunt'])){
        $Crunt = intval($_GET['Crunt']);
        $THESQL = "SELECT * FROM $GroupTabel where crunt = '$Crunt' $orderby";
        $THELINK = "view=List&$Crunt=".$Crunt;
    }else{
        $THESQL = "SELECT * FROM $GroupTabel $orderby ";
        $THELINK = "view=List";

    }
}elseif($view == 'ListCrunt'){
    $ListCruntBut =  "btn-danger" ;
    $ListLast =  "btn-success" ;
    if(isset($_GET['Area_Id'])){
        $area_id = intval($_GET['Area_Id']);
        $THESQL = "SELECT * FROM $GroupTabel where crunt = '1' and area_id = '$area_id' $orderby";
        $THELINK = "view=List&Area_Id=".$area_id;
    }else{
        $THESQL = "SELECT * FROM $GroupTabel where crunt = '1'  $orderby ";
        $THELINK = "view=ListCrunt";
    }
}elseif($view == 'ListLast'){
    $ListLast =  "btn-danger" ;
    $ListCruntBut =  "btn-success" ;
    if(isset($_GET['Area_Id'])){
        $area_id = intval($_GET['Area_Id']);
        $THESQL = "SELECT * FROM $GroupTabel where crunt = '0' and  area_id = '$area_id' $orderby";
        $THELINK = "view=List&Area_Id=".$area_id;
    }else{
        $THESQL = "SELECT * FROM $GroupTabel where crunt = '0'  $orderby ";
        $THELINK = "view=ListLast";
    }
}elseif($view == 'Search'){
    echo trim(Clean_Mypost($_POST['pro_name']));

}

#################################################################################################################################
###################################################   Filter Form 
#################################################################################################################################
echo '<form name="myform" method="post">';
echo '<div class="row">
<div class="col-md-12 Row_Top Row_Top_link flitrco">';
echo  NF_PrintBut_TD('1',$AdminLangFile['project_creunt_but'],"ListCrunt",$ListCruntBut,"fa-plus-circle");
echo  NF_PrintBut_TD('1',$AdminLangFile['project_last_but'],"ListLast",$ListLast,"fa-plus-circle");
echo '<div class="flitrco_c">';
$Arr = array("Label" => 'off',"Active" => '0');      
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['project_area_name'],"col-md-3","area","project_area","opt","",$Arr);	
echo '</div>'; 
echo '<div class="flitrco_c">';
echo '<input type="text"  name="pro_name" placeholder="'.$AdminLangFile['project_filtr_text'].'" class="TypeText form-control" />';
echo '</div>'; 
echo '<input type="submit" name="filtr" class="CloseForm_Ar btn btn-default" value="'.$AdminLangFile['project_filtr_but'].'" />';
echo '</div>';
echo '</div>'; 
echo '</form>';

#################################################################################################################################
###################################################   $_POST['filtr']
#################################################################################################################################
if(isset($_POST['filtr'])){
    if(trim(Clean_Mypost($_POST['pro_name'])) != ""){
        $Proname = trim(Clean_Mypost($_POST['pro_name'])) ;
        $THESQL = "SELECT * FROM $GroupTabel where name  like '%$Proname%' $orderby ";
        $THELINK = "view=ListCrunt";
        $PERpage = '30' ;
    }
    if($view == 'List' and intval( $_POST['area'])  != '0'){
        Redirect_Page_2("index.php?view=List&Area_Id=".$_POST['area']) ;
    }
    if($view == 'ListCrunt' and intval( $_POST['area'])  != '0'){
        Redirect_Page_2("index.php?view=ListCrunt&Area_Id=".$_POST['area']) ;
    }
    if($view == 'ListLast' and intval( $_POST['area'])  != '0'){
        Redirect_Page_2("index.php?view=ListLast&Area_Id=".$_POST['area']) ;
    }
}
echo '<div style="clear: both!important;"></div>';

#################################################################################################################################
###################################################    List Tabel
#################################################################################################################################

$already = $db->H_Total_Count($THESQL);
if ($already > 0){

///// Open_Header
TableOpen_Header();
   
Table_TH_Print('1',"ID","50");
Table_TH_Print('1',$AdminLangFile['project_pro_name'],"150"); 
Table_TH_Print('1',$AdminLangFile['project_pro_area_n'],"150");
Table_TH_Print('1',$AdminLangFile['project_crunt_s'],"100");  
Table_TH_Print('1',$AdminLangFile['project_pro_code'],"150");
Table_TH_Print('1',$AdminLangFile['contract_t_rev'],"100");
Table_TH_Print('1',$AdminLangFile['contract_t_rev_c'],"100");
Table_TH_Print('1',$AdminLangFile['contract_t_con'],"100");
Table_TH_Print('1',$AdminLangFile['contract_t_con_c'],"100");
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
$UnitState =  $Name[$i]['state']; 
$Areaname = GetNameFromID("project_area",$Name[$i]['area_id'],"name") ;
$ProjecCrunt = Rterun_ProjectCruntS($Name[$i]['crunt']); 
 
 
echo '<tr>';
echo '<td>'.$Name[$i]['id'].'</td>';
echo '<td>'.$Name[$i]['name'].'</td>';
echo '<td>'.$Areaname.'</td>';
echo '<td>'.$ProjecCrunt.'</td>';    
echo '<td>';
echo $Name[$i]['pro_code'].BR;
echo $AdminLangFile['project_floor_count']." ".$Name[$i]['floor_count'].BR;
echo $AdminLangFile['project_unit_count']." ".$Name[$i]['unit_count'].BR;
echo '</td>';

if($Name[$i]['rev'] == '0'){
echo '<td align="center">'.$AdminLangFile['contract_form_no'].'</td>';     
}else{
echo '<td align="center" ><a href="index.php?view=Reservation_List&Pro_Id='.$id.'">'.$Name[$i]['rev']." ".$AdminLangFile['contract_form'].'</a></td>';    
} 


if($Name[$i]['rev_c'] == '0'){
echo '<td align="center">'.$AdminLangFile['contract_form_no'].'</td>';     
}else{
echo '<td align="center" ><a href="index.php?view=Canceled&Pro_Id='.$id.'">'.$Name[$i]['rev_c']." ".$AdminLangFile['contract_form'].'</a></td>';    
} 

if($Name[$i]['con'] == '0'){
echo '<td align="center">'.$AdminLangFile['contract_form_no'].'</td>';     
}else{
echo '<td align="center" ><a href="index.php?view=Contract&Pro_Id='.$id.'">'.$Name[$i]['con']." ".$AdminLangFile['contract_form'].'</a></td>';    
} 
 
 
if($Name[$i]['con_c'] == '0'){
echo '<td align="center">'.$AdminLangFile['contract_form_no'].'</td>';     
}else{
echo '<td align="center" ><a href="index.php?view=ContractD&Pro_Id='.$id.'">'.$Name[$i]['con_c']." ".$AdminLangFile['contract_form'].'</a></td>';    
}


echo '<td align="center">'.NF_PrintBut_TD('1',$AdminLangFile['contract_cont_but'],"TabelCon&Project_Id=".$id,"btn-success","fa-table").'</td>';
echo '<td align="center">'.NF_PrintBut_TD('1',$AdminLangFile['contract_rev_but'],"TabelRev&Project_Id=".$id,"btn-success","fa-table").'</td>';
} 
}
	
///// CloseTabel   
CloseTabel();

 
}else{ 
Alert_NO_Content();           
}




######/<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<-----------------------------------------------
Close_Page();
?>            
 