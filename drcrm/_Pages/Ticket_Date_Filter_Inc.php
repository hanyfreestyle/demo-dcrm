<?php
if(!defined('WEB_ROOT')) {	exit;}
 
   
echo '<div id="ErrMass" class="ErrMass_Div"></div>';
echo '<div style="clear: both!important;"></div>';
echo '<form class="FilterForm" method="POST" name="Filter" id="validate-form" data-parsley-validate enctype="multipart/form-data">';
 

if($view == 'ListNew' or $view == 'ListBack' or $view == 'ListNext' or $view == 'ListFollow'  or $view == 'ContractWait' 
or $view == 'CloseReview' or $view == 'CloseTicket' or $view == 'ListAllCust'
or $view == 'VisitsList'  or $view == 'ReservationsList'
){
$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => '');
$Err[] = NF_PrintInput("DateEdit2",$AdminLangFile['leads_from_date'],"date_from","0","0","option",$MoreS);    
}


if($view == 'ListNew' or $view == 'ListNext' or $view == 'ListFollow'or $view == 'ContractWait' 
or $view == 'CloseReview' or $view == 'CloseTicket' or $view == 'ListAllCust'
or $view == 'VisitsList'  or $view == 'ReservationsList'
){
$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => '');
$Err[] = NF_PrintInput("DateEdit2",$AdminLangFile['leads_to_date'],"date_to","0","0","option",$MoreS);
}


/////// فلترو الموظفين
Empl_ListBox_Filter();

if($view == 'ListNew' or $view == 'ListBack' or $view == 'ListNext' or $view == 'ListFollow'  
or $view == 'ContractWait' or $view == 'CloseReview' or $view == 'CloseTicket' or $view == 'ListAllCust'
or $view == 'VisitsList'  or $view == 'ReservationsList'
){
echo '<div class="col-md-1 col-sm-12 col-xs-12 form-group">';
echo '<input type="submit" name="B1_Fliter" class="ArButForm btn btn-default" value="'.$AdminLangFile['salesdep_fiter_but'].'" />';
echo '</div>';
}elseif($view == 'ListToday' and $AdminConfig['leads'] == '1' ){
echo '<div class="col-md-1 col-sm-12 col-xs-12 form-group">';
echo '<input type="submit" name="B1_Fliter" class="ArButForm btn btn-default" value="'.$AdminLangFile['salesdep_fiter_but'].'" />';
echo '</div>';    
}


echo '</form>';
 

echo '<div style="clear: both!important;"></div>';
 
?>