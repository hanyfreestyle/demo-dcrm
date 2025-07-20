<?php
if(!defined('WEB_ROOT')) {	exit;}

###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);


$SectionName = "cust";
$ThisTabelName = "customer";
$ConfigP['datatabel'] = $ConfigP['datatabel_'.$SectionName];
$PERpage = $ConfigP['perpage_'.$SectionName] ;
$orderby = RterunOrder($ConfigP['order_'.$SectionName]) ;
$DataTabelId = RterunOrder_DataTabel($ConfigP['order_'.$SectionName]) ;



$Search_type = array(
    '1' => $AdminLangFile['customer_search_by_name'],
    '2' => $AdminLangFile['customer_search_by_mobile'],
    '3' => $AdminLangFile['customer_search_by_email'],
    '4' => $AdminLangFile['customer_search_by_id'],
    '5' => $AdminLangFile['customer_search_by_code'],
);

if(F_ID_NO != 1 ){
    unset($Search_type['4']);
}


echo '<div id="ErrMass" class="ErrMass_Div"></div>';
echo '<div style="clear: both!important;"></div>';
echo '<form class="FilterForm FilterFormStyle" method="POST" name="Filter" id="validate-form" data-parsley-validate >';


$Arr = array("StartFrom" => '1',"Label" => 'on' ,'StopListStyle'=> '1' );
$Err[] = NF_PrintSelect_2018("ArrFrom",$AdminLangFile['customer_search_by'],"col-md-4","search_type",$Search_type,"req","",$Arr);


$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required ','Dir'=> "Ar_Lang");
$Err[] = NF_PrintInput("Text",$AdminLangFile['customer_search_name'],"name","1","1","req",$MoreS);

echo '<div style="clear: both!important;"></div>';

echo '<div style="clear: both!important;"></div>';
echo '<div class="col-md-12 col-sm-12 col-xs-12 form-group">';
echo '<input type="submit" name="B1_Fliter" class="ArButForm btn btn-default" value="'.$AdminLangFile['customer_search_but'].'" />';
echo '</div>';


echo '</form>';


if(isset($_POST['B1_Fliter'])){
    $Name = Clean_Mypost($_POST['name']) ;

    if($_POST['search_type'] == '1'){

        $THESQL = "SELECT * FROM $ThisTabelName WHERE name like '%$Name%' ";
    }elseif($_POST['search_type'] == '2'){
        $THESQL = "SELECT * FROM $ThisTabelName WHERE ( mobile = '$Name' or  mobile_2 = '$Name' or phone = '$Name')";
    }elseif($_POST['search_type'] == '3'){
        $THESQL = "SELECT * FROM $ThisTabelName WHERE email = '$Name' ";
    }elseif($_POST['search_type'] == '4'){
        $THESQL = "SELECT * FROM $ThisTabelName WHERE id_no = '$Name' ";
    }elseif($_POST['search_type'] == '5'){
        $Name = intval($Name);
        $THESQL = "SELECT * FROM $ThisTabelName WHERE id = '$Name' ";
    }
    
    $ConfigP['datatabel'] = "1";
    $ConfigP['datamax_cust'] = "1000";
    $ThisIsFilterPage = '1';
    $THELINK = "view=".$view ;  
 
    require_once 'Customer_List_inc.php';

}

###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();

?>