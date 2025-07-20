<?php
if(!defined('WEB_ROOT')) {	exit;}
###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

if($USER_PERMATION_Edit == '1'){

    $LeadId = intval($_GET['LeadId']);
    $UserId = intval($_GET['UserId']);

    AddNewLead($LeadId , $UserId);

    Redirect_Page_2("index.php?view=List");

}else{
    ErrMassPer();
}

###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();

?>