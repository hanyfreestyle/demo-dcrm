<?php
if(!defined('WEB_ROOT')) {	exit;}
 


#################################################################################################################################
###################################################  CustomerAddMoreTiket 
#################################################################################################################################
function CustomerAddMoreTiket($db){
    global $DirURL ;
    $Cust_Id  = $_POST['cust_id'] ;
    $server_data = array (
    'id'=> NULL ,
    'cust_id'=> $_POST['cust_id'] ,
    'rel'=> Clean_Mypost($_POST['sub_rel']) ,
    'name'=> Clean_Mypost($_POST['sub_name']) ,
    'mobile'=> Clean_Mypost($_POST['sub_mobile']) ,
    'mobile_2'=> Clean_Mypost($_POST['sub_mobile_2']) ,
    'email'=> Clean_Mypost($_POST['sub_email']) ,
     );
     $add_server = $db->AutoExecute("customer_sub",$server_data,AUTO_INSERT); 
     $already = mysql_num_rows(mysql_query("SELECT id FROM customer_sub WHERE cust_id = '$Cust_Id'"));
     UpdateFildeForDell("customer","sub_count",$already,$Cust_Id) ; 
     UnsetAllSession('sub_rel,sub_name,sub_mobile,sub_mobile_2,sub_email');
     Redirect_Page_2('index.php?view='.$DirURL.'&id='.$_GET['id']);  
}














#################################################################################################################################
###################################################  Print Err FromSQL ForCust
#################################################################################################################################
function PrintErrFromSQL_ForCust($OldData,$Val,$ErrMass){
    global $db ;
    global $AdminLangFile ;
    global $AdminPathHome ;
    global $AdminConfig ;
     if(($_POST[$Val])){
      $Err =  in_multiarray_2($_POST[$Val], $OldData); 
      
      print_r3($Err);
      
      
      if($Err == '1'){
       $ThisKey = recursive_array_search($_POST[$Val],$OldData);
       $Link_Edit = $AdminPathHome."Customer/index.php?view=Edit&id=".$OldData[$ThisKey]['id'] ;
       $Link_View = $AdminPathHome."Customer/index.php?view=Profile&id=".$OldData[$ThisKey]['id'] ;
       $Target = "_blank" ;
       $SendMass = $ErrMass." ".$AdminLangFile['mainform_err_already_exists']." ";
       $SendMass .= $OldData[$ThisKey]['name']." ".$AdminLangFile['mainform_err_record_id']." ".$OldData[$ThisKey]['id'] ;
       if($AdminConfig['customer_edit'] == '1'){
       $SendMass .=   BR.'<a href='.$Link_Edit.'  target= '.$Target.' >'.$AdminLangFile['customer_edit_cust_err'].'</a>'." ".BR ;
       }
       if($AdminConfig['customer'] == '1'){
       $SendMass .=  '<a href='.$Link_View.'  target= '.$Target.' >'.$AdminLangFile['customer_view_cust_err'].'</a>'." " ;
       }    
       SendJavaErrMass_22 ($SendMass);
     }
       return $Err ;
    }   
}













#################################################################################################################################
###################################################   PrintTicketInformation
#################################################################################################################################






function New_PrintErrFromSQL_2($OldData,$Val){
    global $db ;
    global $AdminLangFile ;
     if(($Val)){
     $Err =  in_multiarray($Val, $OldData); 
     if($Err == '1'){
        $ThisKey = recursive_array_search($Val,$OldData);
       }else{
      $Err = '0'  ; 
     }
   }else{
     $Err = '0'  ; 
   }  
   $Hany =   array('Err'=> $Err , 'Id'=> $OldData[$ThisKey]['id'] ) ;
   return $Hany  ; 
}

#################################################################################################################################
###################################################   PrintTdLabel
#################################################################################################################################
function PrintTdLabel($Vall){
    $Line = '<div class="label label-danger">'.$Vall.'</div>'; 
     $Line .=  '<div style="clear: both!important;"></div>';
     return $Line ;
}



	
?>