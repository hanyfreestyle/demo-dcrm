<?php
if(!defined('WEB_ROOT')) {	exit;}
 

######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);
 

$GroupTabel = "project";
$PERpage = $ConfigP['perpage_unit'] ;
$orderby = RterunOrder($ConfigP['order_by_unit']) ;


#################################################################################################################################
###################################################    List View
#################################################################################################################################
if($view == 'ListUnit'){
    $ListCruntBut =  "btn-success" ;
    $ListLast =  "btn-success" ;
    if(isset($_GET['Area_Id'])){
        $area_id = intval($_GET['Area_Id']);
        $THESQL = "SELECT * FROM $GroupTabel where area_id = '$area_id' $orderby";
        $THELINK = "view=ListUnit&Area_Id=".$area_id;
    }elseif(isset($_GET['Crunt'])){
        $Crunt = intval($_GET['Crunt']);
        $THESQL = "SELECT * FROM $GroupTabel where crunt = '$Crunt' $orderby";
        $THELINK = "view=ListUnit&$Crunt=".$Crunt;
    }else{
        $THESQL = "SELECT * FROM $GroupTabel $orderby ";
        $THELINK = "view=ListUnit";
    }
}elseif($view == 'ListCrunt_2'){
    $ListCruntBut =  "btn-danger" ;
    $ListLast =  "btn-success" ;
    if(isset($_GET['Area_Id'])){
        $area_id = intval($_GET['Area_Id']);
        $THESQL = "SELECT * FROM $GroupTabel where crunt = '1' and area_id = '$area_id' $orderby";
        $THELINK = "view=ListUnit&Area_Id=".$area_id;
    }else{
        $THESQL = "SELECT * FROM $GroupTabel where crunt = '1'  $orderby ";
        $THELINK = "view=ListCrunt_2";
    }
}elseif($view == 'ListLast_2'){
    $ListLast =  "btn-danger" ;
    $ListCruntBut =  "btn-success" ;
    if(isset($_GET['Area_Id'])){
        $area_id = intval($_GET['Area_Id']);
        $THESQL = "SELECT * FROM $GroupTabel where crunt = '0' and  area_id = '$area_id' $orderby";
        $THELINK = "view=ListUnit&Area_Id=".$area_id;
    }else{
        $THESQL = "SELECT * FROM $GroupTabel where crunt = '0'  $orderby ";
        $THELINK = "view=ListLast_2";
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
echo  NF_PrintBut_TD('1',$AdminLangFile['project_creunt_but'],"ListCrunt_2",$ListCruntBut,"fa-plus-circle");
echo  NF_PrintBut_TD('1',$AdminLangFile['project_last_but'],"ListLast_2",$ListLast,"fa-plus-circle");
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
###################################################    $_POST['filtr']
#################################################################################################################################
if(isset($_POST['filtr'])){
    if(trim(Clean_Mypost($_POST['pro_name'])) != ""){
        $Proname = trim(Clean_Mypost($_POST['pro_name'])) ;
        $THESQL = "SELECT * FROM $GroupTabel where name  like '%$Proname%' $orderby ";
        $THELINK = "view=ListCrunt";
        $PERpage = '30' ;
    }
    if($view == 'ListUnit' and intval( $_POST['area']) != '0'){
        Redirect_Page_2("index.php?view=ListUnit&Area_Id=".$_POST['area']) ;
    }
    if($view == 'ListCrunt_2' and intval( $_POST['area']) != '0'){
        Redirect_Page_2("index.php?view=ListCrunt_2&Area_Id=".$_POST['area']) ;
    }
    if($view == 'ListLast_2' and intval( $_POST['area']) != '0'){
        Redirect_Page_2("index.php?view=ListLast_2&Area_Id=".$_POST['area']) ;
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
Table_TH_Print('1',$AdminLangFile['project_pro_name'],"200");
Table_TH_Print('1',$AdminLangFile['project_pro_area_n'],"200");
Table_TH_Print('1',$AdminLangFile['project_crunt_s'],"200");
Table_TH_Print('1',$AdminLangFile['project_pro_code'],"200");
Table_TH_Print('1',"","100");
 
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
echo '<td align="center">'.NF_PrintBut_TD('1',$AdminLangFile['contract_view_unit_tabel'],"TabelView&Project_Id=".$id,"btn-success","fa-table").'</td>';
echo '</tr>';
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
 