<?php
 require_once '../include/inc_reqfile.php';
 require_once 'Inc_Php/_index_config.php';

 
$Cat_Id =  $_GET['CloseId'];
 
if($Cat_Id == '1'){
 $SubCat = '3' ;  
 $CatName = $AdminLangFile['close_ticket_c_type_3'] ;
}elseif($Cat_Id == '2'){
   $SubCat = '4' ;  
   $CatName = $AdminLangFile['close_ticket_c_type_4'] ;
}else{
   $CatName =  $AdminLangFile['close_ticket_close_type_err'] ; 
   $SubCat = '40000' ;    
}

$Arr = array("Label" => 'on',"Active" => '0','Order'=> "order by count desc" , "Filter_Filde"=> "cat_id" , "Filter_Vall"=> $SubCat);      
$Err[] = NF_PrintSelect_2018("Chosen",$CatName,"col-md-3","c_type_2","f_cust_subtype","req",0,$Arr);	
 

?>