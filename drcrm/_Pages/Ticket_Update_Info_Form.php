<?php

if( F_PROJECT_AREA == 1){
//$FildeForCor = TABEL_COURS ;
    $SQL_Line_Send =  "SELECT * FROM project_area  ";
    $Arr = array('required'=>'required','ActiveFilde'=>'state',"SQL_Line_Send"=>$SQL_Line_Send);
    Autocomplete_Input_2018("Add",$AdminLangFile['ticket_pro_area'],"col-md-12","pro_area","demo-input-facebook-theme","project_area",$Arr) ;
    echo '<div style="clear: both!important;"></div>';

}

if( F_COURS == 1){
    $FildeForCor = TABEL_COURS ;
    $SQL_Line_Send =  "SELECT * FROM config_data where cat_id = '$FildeForCor' ";
    $Arr = array('required'=>'required','ActiveFilde'=>'state',"SQL_Line_Send"=>$SQL_Line_Send);
    Autocomplete_Input_2018("Add",$AdminLangFile['managedate_cours_but'],"col-md-12","cours_id","demo-input-facebook-theme","config_data",$Arr) ;
    echo '<div style="clear: both!important;"></div>';
}


$Arr = array("Label" => 'on',"Active" => '0','Order'=> "order by count desc" , "Filter_Filde"=> "cat_id" , "Filter_Vall"=> "2");
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['ticket_cust_type'],"col-md-3","c_type_2","f_cust_subtype","req","0",$Arr);

if(F_CASH_ID == 1){
    $Arr = array("Label" => 'on',"Active" => '0','Order'=> "order by count desc" , "Filter_Filde"=> "cat_id" , "Filter_Vall"=> TABEL_CASH);
    $Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['ticket_cash_id'],"col-md-3","cash_id","config_data","req","0",$Arr);

}

if(F_UNIT_TYPE_ID == 1){
    $Arr = array("Label" => 'on',"Active" => '0','Order'=> "order by count desc" , "Filter_Filde"=> "cat_id" , "Filter_Vall"=> TABEL_UNIT_TYPE);
    $Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['ticket_unit_id'],"col-md-3","unit_id","config_data","req","0",$Arr);

}
if(F_AREA_ID == 1){
    $Arr = array("Label" => 'on',"Active" => '0','Order'=> "order by count desc" , "Filter_Filde"=> "cat_id" , "Filter_Vall"=> TABEL_AREA);
    $Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['ticket_area_id'],"col-md-3","area_id","config_data","req","0",$Arr);

}


if(F_DATE_RECEIPT_ID == 1){
    $Arr = array("Label" => 'on',"Active" => '0','Order'=> "order by count desc" , "Filter_Filde"=> "cat_id" , "Filter_Vall"=> TABEL_DATE_RECEIPT);
    $Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['ticket_date_id'],"col-md-3","date_id","config_data","req","0",$Arr);

}
if(F_CALL_TIME_ID == 1){
    $Arr = array("Label" => 'on',"Active" => '0','Order'=> "order by count desc" , "Filter_Filde"=> "cat_id" , "Filter_Vall"=> TABEL_CALL_TIME);
    $Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['ticket_time_id'],"col-md-3","time_id","config_data","req","0",$Arr);
    $RowCount = RowCountForLight_New($RowCount,"4");
}



if(F_BEST_CALL_ID == 1){
    $Arr = array("Label" => 'on',"Active" => '0','Order'=> "order by count desc" , "Filter_Filde"=> "cat_id" , "Filter_Vall"=> TABEL_BEST_CALL);
    $Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['ticket_bestcall_id'],"col-md-3","bestcall_id","config_data","req","0",$Arr);
    $RowCount = RowCountForLight_New($RowCount,"4");
}





echo '<div style="clear: both!important;"></div>';

?>