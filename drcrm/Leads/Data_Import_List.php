<?php
if(!defined('WEB_ROOT')) {	exit;}
###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);


#################################################################################################################################
###################################################   List Page Config
#################################################################################################################################
$ConfigP['datatabel'] = '0';
$orderby = " Order By state  desc ";
$SectionName = "leads";
$PERpage = $ConfigP['perpage_facebook'] ;


$ThisTabel = "facebook_data";
$THESQL = "SELECT * FROM  $ThisTabel where state = '$DataState' $orderby " ;
$THELINK = "view=".$view;


$already = $db->H_Total_Count($THESQL);
if($already > 0) {
 
Print_ImportData_Report_Block($ThisTabel);


#################################################################################################################################
###################################################    
#################################################################################################################################  
    if(isset($_POST['DelUnit']) ) {
        if($USER_PERMATION_Dell == '1' ) {
            if( isset($_POST['id_id'])){
                DelUnit_New($ThisTabel);
                Redirect_Page_2(LASTREFFPAGE);
            }else{
                SendJavaErrMass($AdminLangFile['leads_err_sel_content']);
            }
        } else {
            SendMassgeforuser();
        }
    }
    if(isset($_POST['Transfer'])) {
        if($USER_PERMATION_Edit == '1') {
            if(isset($_POST['id_id'])){
                Transfer_Import_Data();
                Redirect_Page_2(LASTREFFPAGE);
            }else{
                SendJavaErrMass($AdminLangFile['leads_err_sel_content']);
            }
        }else{
            SendMassgeforuser();
        }
    }




 
#################################################################################################################################
###################################################    
#################################################################################################################################
echo '<div style="clear: both!important;"></div> ';
$VallOf = array('PageCount' => 'perpage_facebook');
PrintUpdatePageCount($VallOf);	
echo '<div style="clear: both!important;"></div> ';
#################################################################################################################################
###################################################    
#################################################################################################################################
 

    echo '<div id="ErrMass" class="ErrMass_Div"></div>';

    echo '<form name="myform" action="#" id="validate-form" data-parsley-validate method="post">';

    echo '<input type="hidden" name="user_id" value="'.$RowUsreInfo['user_id'].'" />';

    echo '<div class="row PanelMin TopButAction"><div class="col-md-12">';
    echo '<button type="submit"  name="DelUnit" class="mb-sm btn btn-danger">'.$AdminLangFile['mainform_delete'].'</button> ';
    
    if($DataState == '1'){
    echo '<button type="submit"  name="Transfer" class="mb-sm btn btn-primary">'.$AdminLangFile['lppage_transfer_data'].'</button> ';    
    }
    echo '</div> </div><div style="clear: both;"></div>';



#################################################################################################################################
###################################################    Start Table
#################################################################################################################################

    echo '<div class="panel panel-default"><div class="table-responsive">';
    echo '<table class="table table-striped table-bordered table-hover ArTabel">';
    echo '<thead><tr>';
    echo '<th class="TD_50">ID</th>';
    echo '<th class="TD_100">'.$AdminLangFile['customer_sub_name'].'</th>';
    echo '<th class="TD_100">'.$AdminLangFile['customer_mobile'].'</th>';
    echo '<th class="TD_100">'.$AdminLangFile['customer_mobile'].' 2 </th>';
    echo '<th class="TD_100">'.$AdminLangFile['customer_email'].'</th>';
    echo '<th class="TD_200">'.$AdminLangFile['lppage_lead_info'].'</th>';
    echo '<th class="TD_50"></th>';
    echo '<th class="TD_50"></th>';
    echo '<th class="TD_100"><input type="checkbox" name="Check_ctr" value="yes" onClick="Check(document.myform.Check_ctr)"></th>';
    echo '</tr></thead><tbody>';

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
            echo '<td>'.$Name[$i]['id'].'</td>';
            echo '<td>'.$Name[$i]['name'].'</td>';
            echo '<td>'.$Name[$i]['mobile'].'</td>';
            echo '<td>'.$Name[$i]['mobile_2'].'</td>';
            echo '<td>'.$Name[$i]['email'].'</td>';


            echo '<td>';
            echo PrintFildIf($Name[$i]['notes']);
            echo '</td>';

            Table_TD_Print_Option('1',CheckUnitState($Name[$i]['state']),"C");
            Table_TD_Print_Option('1',NF_PrintBut_TD('2',$AdminLangFile['mainform_edit_but'],"EditImportLead&id=".$id,"btn-info","fa-pencil"),"C");
            Table_TD_Print_Option('1',PrintCheckBox_New($id),"C");
            
            echo '</tr>';

        }
    }


    echo '</tbody></table></div></div>';
    echo '<div class="col-md-12 col-sm-12 col-xs-12">';
    echo $db->pager;
    echo '</div>';

    echo '</form>';

}else{ 
Alert_NO_Content();         
}


###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();


?>