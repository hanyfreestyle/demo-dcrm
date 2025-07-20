<?php
if(!defined('WEB_ROOT')) {	exit;}



#################################################################################################################################
###################################################   LandpageSqlFiterLine
#################################################################################################################################
 function  LandpageSqlFiterLine(){
  $End_SQL_Line = " "  ;
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_Date($_POST['date_from'],"date_add","From"); 
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_Date($_POST['date_to'],"date_add","To");  
  $End_SQL_Line .= CustmerSqlFiterLineFromPost($_POST['lead_cat'],"lead_cat"); 
  return $End_SQL_Line ;
}

#################################################################################################################################
###################################################   Transfer_Leads_Google
#################################################################################################################################
function Transfer_Leads_Google(){
    global $db ;
    $ThisISTest = "0" ;
    $EmailCount = count($_POST['id_id']);
    for ($i = 0; $i < $EmailCount; $i++){
       
        $id =  $_POST['id_id'][$i]  ;
        $row = $db->H_SelectOneRow("SELECT * FROM landpage_data  where id = '$id'");

    $server_data = array ( 'id'=> NULL ,
    'date_add'=> TimeForToday() ,
    'date_time'=> time() ,
    'user_id'=>  $_POST['user_id'] ,
    'name'=> $row['name'],
    'mobile'=>  $row['mobile'],
    'email'=> $row['email'],
    'notes'=> $row['notes'],
    'lead_type'=> $row['lead_type'],
    'lead_sours'=> $row['lead_sours'],
    'lead_cat'=> intval($row['lead_cat']), 
    'c_type'=> "5",
    'c_type_2'=> "1",
    'state'=> "1",
    ); 

        if($ThisISTest == '1'){
            print_r3($server_data);
        }else{
           $add_server = $db->AutoExecute("c_leads",$server_data,AUTO_INSERT);
           $db->H_DELETE_FromId("landpage_data",$id);
           Redirect_Page_2("index.php?view=LandingPage"); 
        }    
  }
}
 
?>