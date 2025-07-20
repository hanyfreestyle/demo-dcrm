<?php
if(!defined('WEB_ROOT')) {	exit;}
  
echo '<div id="ErrMass" class="ErrMass_Div"></div>';
echo '<div style="clear: both!important;"></div>';
echo '<form class="FilterForm" method="POST" name="Filter" id="validate-form" data-parsley-validate enctype="multipart/form-data">';


$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => '');
$Err[] = NF_PrintInput("DateEdit2",$AdminLangFile['leads_from_date'],"date_from","0","0","option",$MoreS);   

$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => '');
$Err[] = NF_PrintInput("DateEdit2",$AdminLangFile['leads_to_date'],"date_to","0","0","option",$MoreS);

/////// فلترو الموظفين
//Empl_ListBox_Filter();
ListBox_Sales_Employee_Filter();




if($Sction ==  'ClosedTicket'){
echo '<input type="hidden" name="close_type" value="'.$CloseType.'" />'; 
if($CloseType == '1'){
$CloseTypeFilter = '1';    
}elseif($CloseType == '2'){
$CloseTypeFilter = '3';
}elseif($CloseType == '3'){
$CloseTypeFilter = '4';    
}    
$Arr = array("Label" => 'on',"Active" => '1','Order'=> "order by count desc" , "Filter_Filde"=> "cat_id" , "Filter_Vall"=> $CloseTypeFilter);      
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['customer_c_type_sub'],"col-md-3","close_type_2","f_cust_subtype","optin","0",$Arr);	
}



echo '<div class="col-md-1 col-sm-12 col-xs-12 form-group">';
echo '<input type="submit" name="B1_Fliter" class="ArButForm btn btn-default" value="'.$AdminLangFile['salesdep_fiter_but'].'" />';
echo '</div>';  


echo '</form>';
 

echo '<div style="clear: both!important;"></div>';
 
 
?>