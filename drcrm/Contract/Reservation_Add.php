<?php
if(!defined('WEB_ROOT')) {	exit;}
 

######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);


$row = $db->H_CheckTheGet("id","id","project_unit","2");
$id = $row['id'];
extract($row);
 
if($row['state'] == '1'){
    

Form_Open($ArrForm);

$Invoce_Ref = OredrCodeRef("reservation","ref","10","Ref_");

$ProjectName = GetNameFromID("project",$row['pro_id'],"name");
PrintFildInformation("col-md-3",$AdminLangFile['project_pro_name'],$ProjectName);
$FloorName = GetNameFromID("project_floor",$row['floor_id'],"name");
PrintFildInformation("col-md-3",$AdminLangFile['project_floor_name'],$FloorName);
PrintFildInformation("col-md-3",$AdminLangFile['project_unit_code'],$row['p_code']);
PrintFildInformation("col-md-3",$AdminLangFile['project_unit_area_sq'],$row['u_area']." M");


echo '<input type="hidden" name="type" value="'.$ThisFormType.'"/>';
echo '<input type="hidden" name="ref" value="'.$Invoce_Ref.'"/>';
echo '<input type="hidden" name="unit_id" value="'.$row['id'].'"/>';
echo '<input type="hidden" name="pro_id" value="'.$row['pro_id'].'"/>';
echo '<input type="hidden" name="floor_id" value="'.$row['floor_id'].'"/>';
echo '<input type="hidden" name="unit_name" value="'.$row['p_code'].'"/>';
echo '<input type="hidden" name="pro_name" value="'.$ProjectName.'"/>';
echo '<input type="hidden" name="floor_name" value="'.$FloorName.'"/>';
echo '<div style="clear: both!important;"></div>';


/* 
if($ThisFormType == '1'){
$Lsit_SQL_Line = "SELECT id,name,mobile FROM customer where c_type = '6' or c_type = '1' or c_type = '2' " ;
}else{
$Lsit_SQL_Line = "SELECT id,name,mobile FROM customer where c_type = '6' or c_type = '1'" ;    
}
*/
$Lsit_SQL_Line = "SELECT id,name,mobile FROM customer where c_type = '6' or c_type = '1' or c_type = '2' " ;

$Arr = array("Label" => 'on' ,'SQL_Line_Send'=> $Lsit_SQL_Line , "SubPrintFilde"=> "mobile" );      
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['contract_cust_id'],"col-md-4","cust_id","cust_id","req",0,$Arr);	
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['contract_cust_id']." 2","col-md-4","cust2_id","cust_id","optin",0,$Arr);	
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['contract_cust_id']." 3","col-md-4","cust3_id","cust_id","optin",0,$Arr);

echo '<div style="clear: both!important;"></div>';
$Arr = array("Label" => 'on'  ,"OtherIdd"=>"user_id", "Filter_Filde"=> "sales" , "Filter_Vall"=>"1" );      
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['contract_emp_id'],"col-md-3","emp_id","tbl_user","req",0,$Arr);
echo '<div style="clear: both!important;"></div>';



if($ThisFormType == '1'){
$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required');
$Err[] = NF_PrintInput("Date",$AdminLangFile['contract_rev_date'],"rev_date","0","0","req",$MoreS);

$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required');
$Err[] = NF_PrintInput("Date",$AdminLangFile['contract_cont_date'],"cont_date","0","0","req",$MoreS);

$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => '');
$Err[] = NF_PrintInput("Text",$AdminLangFile['contract_ref_num'],"ref_num","0","1","option",$MoreS);

echo '<div style="clear: both!important;"></div>';

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => '');
$Err[] = NF_PrintInput("TextArea",$AdminLangFile['contract_notes'],"notes","0","0","option",$MoreS);
   
}elseif($ThisFormType == '2'){
 
$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required');
$Err[] = NF_PrintInput("Date",$AdminLangFile['contract_cont_date'],"new_date","0","0","req",$MoreS);

$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required');
$Err[] = NF_PrintInput("Text",$AdminLangFile['contract_ref_num'],"ref_num_2","0","1","req",$MoreS);


echo '<div style="clear: both!important;"></div>';

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => '');
$Err[] = NF_PrintInput("TextArea",$AdminLangFile['contract_notes'],"notes_2","0","0","option",$MoreS);

    
}


Form_Close_New("1","List");


#################################################################################################################################
###################################################    $_POST['B1']
#################################################################################################################################
    if(isset($_POST['B1'])){
        if(intval($_POST['cust2_id']) != '0'){
            if($_POST['cust_id'] == $_POST['cust2_id']){
                SendJavaErrMass($AdminLangFile['customer_cust_2_err']) ;
                $ErrForm = '1';
            }
        }
        if(intval($_POST['cust3_id']) != '0'){
            if(intval($_POST['cust2_id']) == '0'){
                SendJavaErrMass($AdminLangFile['customer_cust_2_err_2']) ;
                $ErrForm = '1';
            }else{
                if($_POST['cust3_id'] == $_POST['cust_id'] or $_POST['cust3_id'] == $_POST['cust2_id']  ){
                    SendJavaErrMass($AdminLangFile['customer_cust_3_err']) ;
                    $ErrForm = '1';
                }
            }
        }
        if($ErrForm != '1'){
            Vall($Err,"Reservation_Add",$db,"1",$USER_PERMATION_Add);
        }
    }



}else{
echo '<div class="alert alert-danger alert-dismissable Arr_Mass">';
echo $AdminLangFile['contract_reservation_err_mass'];
echo '</div>';    
}



######/<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<-----------------------------------------------
Close_Page();
?>
 