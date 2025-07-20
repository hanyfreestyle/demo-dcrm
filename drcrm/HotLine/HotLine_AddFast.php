<?php
if(!defined('WEB_ROOT')) {	exit;}

###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);


Form_Open($ArrForm);


echo '<input type="hidden" name="user_id" value="'.$RowUsreInfo['user_id'].'" />';
echo '<input type="hidden" name="sales_man" value="'.$AdminConfig['salesdep'].'" />';

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required ','Dir'=> "");
$Err[] = NF_PrintInput("Text",$AdminLangFile['customer_name'],"name","1","0","req",$MoreS);

$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => 'required data-parsley-type="digits" data-parsley-minlength="11"', 'Dir'=> "En_Lang" );
$Err[] = NF_PrintInput("Text",$AdminLangFile['customer_mobile']."1","mobile","1","0","req-num",$MoreS);

echo '<div style="clear: both!important;"></div>';


if( F_LEAD_TYPE == 1){
    $Arr = array("Label" => 'on',"Active" => '0');
    $Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['customer_lead_type'],"col-md-3","lead_type","fs_lead_type","req","0",$Arr);
    $RowCount = RowCountForLight_New($RowCount,"4");
}

if( F_LEAD_SOURS == 1){
    $Arr = array("Label" => 'on',"Active" => '0');
    $Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['customer_lead_sours'],"col-md-3","lead_sours","fs_lead_sours","req","0",$Arr);
    $RowCount = RowCountForLight_New($RowCount,"4");
}

if(F_LEAD_CAT == 1){
    $Arr = array("Label" => 'on',"Active" => '0','Order'=> "order by count desc" , "Filter_Filde"=> "cat_id" , "Filter_Vall"=> TABEL_LEAD_CAT);
    $Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['hotline_ad_campaign'],"col-md-3","lead_cat","config_data","req","0",$Arr);
    $RowCount = RowCountForLight_New($RowCount,"4");
}





echo '<div style="clear: both!important;"></div>';
$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => '' ,'Dir'=> "");
$Err[] = NF_PrintInput("TextArea",$AdminLangFile['customer_notes'],"notes","0","0","option",$MoreS);



Form_Close_New("1","List");

if(isset($_POST['B1'])){
    if($Err != '1'){
        Vall($Err,"CustomerFastAdd",$db,"1",$USER_PERMATION_Add);
    }
}


###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();
?>
