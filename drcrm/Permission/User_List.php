<?php
if(!defined('WEB_ROOT')) {	exit;}
 
######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

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


if(isset($_POST['UnActAll_User'])) {
	if($AdminConfig['admin'] == '1') {
       UnActAllUnit_NewUser("tbl_user");
	} else {
		SendMassgeforuser();
	}
}

if(isset($_POST['ActAll_User'])) {
	if($AdminConfig['admin'] == '1') {
		ActAllUnit_NewUser("tbl_user");
	} else {
		SendMassgeforuser();
	}
}

if(isset($_POST['AuthenticationCode'])) {
	if($AdminConfig['admin'] == '1') {
		Change_Authentication_Code("tbl_user");
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
    $OtherBut .='<button type="submit"  name="AuthenticationCode" class="mb-sm btn btn-danger">'.$AdminLangFile['users_change_code'].'</button> ';
    $OtherBut .='<button type="submit"  name="ActAll_User" class="mb-sm btn btn-success">'.$AdminLangFile['mainform_activation'].'</button> ';
    $OtherBut .='<button type="submit"  name="UnActAll_User" class="mb-sm btn btn-warning">'.$AdminLangFile['mainform_disable'].'</button>';
    $OtherBut .='</div> </div><div style="clear: both;"></div>';
 

    ///// Open_Header
    $TaBelArr = array('Tabel'=>$ThisTabelName,"But"=>'0', 'DataTabelID'=> $DataTabelId , 'OtherBut'=> $OtherBut );

    TableOpen_Header($TaBelArr);    


    Table_TH_Print('1',"ID","30");
    Table_TH_Print($ProfilePhoto,$ALang['users_profile_photo'],"70");
    Table_TH_Print('1',$ALang['users_user_name'],"100");
    Table_TH_Print('1',$ALang['users_name'],"100");
    Table_TH_Print('1',$ALang['users_cat_name'],"120");
    Table_TH_Print('1',$ALang['users_sales_group'],"50");
    Table_TH_Print($AdminGroup['custserv'],$ALang['users_custserv_group'],"50");
    Table_TH_Print('1',$ALang['users_user_state'],"50");
    Table_TH_Print('1',$ALang['users_cat_state'],"50");
    Table_TH_Print('1',"","50");
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
            $PhotoUrl = GetDefaultUserProfile($Name[$i]['photo']);
            $GroupName = GetNameFromID("user_group",$Name[$i]['group_id'],"name") ;
          
            echo '<tr>';
            Table_TD_Print('1',$Name[$i]['user_id'],"C");
            $UserListPhoto = '<img src="'.$PhotoUrl.'" class="img-circle UserListPhoto" />';
            Table_TD_Print($ProfilePhoto,$UserListPhoto,"C");
 
            Table_TD_Print('1',$Name[$i]['user_name'],"R");
            Table_TD_Print('1',$Name[$i]['name'],"R");
 
            Table_TD_Print('1','<a href="index.php?view=List&CatId='.$Name[$i]['group_id'].'">'.$GroupName.'</a>',"R");
 
      
            Table_TD_Print('1',GroupStatePrint($Name[$i]['sales']),"C");
            Table_TD_Print($AdminGroup['custserv'],GroupStatePrint($Name[$i]['custserv']),"C");
            
            
            Table_TD_Print('1',GroupStatePrint($Name[$i]['state']),"C");
            Table_TD_Print('1',GroupStatePrint($Name[$i]['group_state']),"C");
            
  
            Table_TD_Print('1',NF_PrintBut_TD('2',$AdminLangFile['mainform_edit'],"Edit&id=".$id,"btn-info","fa-pencil"),"C");

            if($id == '1'){
                echo '<td align="center"></td>';
            }else{
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


######/<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<-----------------------------------------------
Close_Page();


?>
 