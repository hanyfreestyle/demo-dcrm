<?php
if(!defined('WEB_ROOT')) {	exit;}

###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);
UpdatePassState();


$SectionName = "userconfig";
$ThisTabelName = "tbl_user";
$ConfigP['datatabel'] = $ConfigP['datatabel_'.$SectionName];
$PERpage = $ConfigP['perpage_'.$SectionName] ;
$DataTabelId = RterunOrder_DataTabel($ConfigP['order_'.$SectionName]) ;
$orderby = RterunOrder_ForUser($ConfigP['order_'.$SectionName]) ;
$ActiveMode =  Rterun_ActiveMode_For_User($ConfigP['activemode_'.$SectionName])  ;
$SqlCat_ID = Get_Filter_If_Isset("CatId","group_id");
$ProfilePhoto = $ConfigP['userphoto_view'] ;



$THESQL = "SELECT * FROM $ThisTabelName where user_id != '0' $SqlCat_ID $ActiveMode $orderby ";
$THELINK = "view=".$view;


if(isset($_POST['ForceChange'])) {
	if($AdminConfig['admin'] == '1') {
       ForceChange("tbl_user");
	} else {
		SendMassgeforuser();
	}
}

 
 
 

$already = $db->H_Total_Count($THESQL);
if ($already > 0){

    if($already > $ConfigP['datamax_'.$SectionName]){
            $ConfigP['datatabel'] = '0';
    }

    if($ConfigP['datatabel'] != '1'){
        $VallOf_Arr = array('PageCount' => 'perpage_'.$SectionName, 'PageOrder' => "order_".$SectionName , 'OrderList' => $Order_ByList);
        ConfigElement_UpdateAjex($VallOf_Arr);
    }

    

    
    $OtherBut  = '<div class="row PanelMin TopButAction"><div class="col-md-12">';
    $OtherBut .='<button type="submit"  name="ForceChange" class="mb-sm btn btn-warning">'.$ALang['users_force_change_password'].'</button>';
    $OtherBut .='</div> </div><div style="clear: both;"></div>';
 

    ///// Open_Header
    $TaBelArr = array('Tabel'=>$ThisTabelName,"But"=>'0', 'DataTabelID'=> $DataTabelId , 'OtherBut'=> $OtherBut );

    TableOpen_Header($TaBelArr);    
    Table_TH_Print('1',"ID","30");
    Table_TH_Print('1',$ALang['users_cat_name'],"100");
    Table_TH_Print('1',$ALang['users_name'],"100");
    Table_TH_Print('1',$ALang['users_last_login'],"120");
    Table_TH_Print('1',"","50");
    Table_TH_Print('1',$ALang['users_pass_last_change'],"50"); 
    Table_TH_Print('1',"","100");
    Table_TH_Print('1','<input type="checkbox" name="Check_ctr" value="yes" onClick="Check(document.myform.Check_ctr)">',"50");  
     
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
             $id = $Name[$i]['user_id'];
             $GroupName = GetNameFromID("user_group",$Name[$i]['group_id'],"name") ;
             echo '<tr>';
             
             
             Table_TD_Print('1',$Name[$i]['user_id'],"C");
             Table_TD_Print('1','<a href="index.php?view=LoginInfo&CatId='.$Name[$i]['group_id'].'">'.$GroupName.'</a>',"R");  
             Table_TD_Print('1',$Name[$i]['name'],"R");
           
              
             if($Name[$i]['last_login']){
                 echo '<td>'.date("Y/m/d H:i:s",$Name[$i]['last_login']).'</td>';
                 echo '<td  align="center">';
                 echo  PrintUserTimeAgo($Name[$i]['last_login']);
                 echo '</td>';
             }else{
                 echo '<td></td>';
                 echo '<td></td>';
             }

             if($id == '1'){
                 echo '<td align="center"></td>';
                 echo '<td align="center"></td>';
                 echo '<td align="center"></td>';
             }else{
                 echo '<td  align="center">';
                 echo ConvertDateToCalender_2($Name[$i]['pass_date']);
                 echo '</td>';

                 echo '<td  align="center">';
                 echo  PrintUserPassTime($Name[$i]);
                 echo '</td>';
                 echo '<td align="center">'.PrintCheckBox_New($id).'</td>';

             }


             echo '</tr>';
         }
     }
    ///// CloseTabel
    CloseTabel();	
 
}else{ 
 Alert_NO_Content();          
}


###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();
?>
