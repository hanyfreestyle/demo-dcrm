<?php
if(!defined('WEB_ROOT')) {	exit;}
###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

$SectionName = "regulations";
$ThisTabelName = "user_regulations";
$ConfigP['datatabel'] = $ConfigP['datatabel_'.$SectionName];
$PERpage = $ConfigP['perpage_'.$SectionName] ;
$orderby = " order by postion " ;
$DataTabelId = RterunOrder_DataTabel($ConfigP['order_'.$SectionName]) ;


$THESQL = "SELECT * FROM $ThisTabelName where cat_id = '$CatId_Type' $orderby ";
$THELINK = "view=".$view;
$already = $db->H_Total_Count($THESQL);

echo '<div class="row"><div class="col-md-12 Row_Top">';
echo  NF_PrintBut_TD('1',$AdminLangFile['mainform_but_addnew'],$AddBut,"btn-success","fa-plus-circle");
echo  NF_PrintBut_TD('1',"ترتيب ",$OrderBut,"btn-primary","fa-sort-alpha-asc");
echo '</div></div>';


if ($already > 0){


    if($already > $ConfigP['datamax_'.$SectionName]){
            $ConfigP['datatabel'] = '0';
    }

    

    if($ConfigP['datatabel'] != '1'){
        $VallOf_Arr = array('PageCount' => 'perpage_'.$SectionName, 'PageOrder' => "order_".$SectionName , 'OrderList' => $Order_ByList);
        ConfigElement_UpdateAjex($VallOf_Arr);
    }

    ///// Open_Header
    $TaBelArr = array('Tabel'=>$ThisTabelName,"But"=>'1', 'Del'=>'1',  'DataTabelID'=> $DataTabelId );

    TableOpen_Header($TaBelArr);    


    Table_TH_Print('1',"ID","30");
    Table_TH_Print('1',"العنوان","200");
    Table_TH_Print('1',"الوصف","200");
    
    Table_TH_Print('1',"","50");
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
$id = $Name[$i]['id'];
 

 

 
echo '<tr>';

Table_TD_Print('1',$Name[$i]['id'],"C");
Table_TD_Print('1',$Name[$i]['name'],"R");
Table_TD_Print('1',NiceTrim2013_Meta($Name[$i]['des'],"160"),"R");
Table_TD_Print_Option('1',NF_PrintBut_TD('2',$ALang['mainform_edit'],$EditBut."&id=".$id,"btn-info","fa-pencil"),"C");
Table_TD_Print('1',CheckUnitState($Name[$i]['state']),"C");
Table_TD_Print('1',PrintCheckBox_New($id),"C");    
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
