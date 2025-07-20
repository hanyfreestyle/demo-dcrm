<?php
if(!defined('WEB_ROOT')) {	exit;}
#################################################################################################################################
###################################################  OPen_Ticket_To_Customer
#################################################################################################################################
function OPen_Ticket_To_Customer($MyArr=array()){
    $ThisIsTest = '0' ;
    global $db ;
    $TAddDate = FULLDate_ForToday();
    $C_leads_Id  = $_POST['c_leads'] ;
    $Customer_Id = $_POST['cust_id'];
    //// leads or customer
    $From_Where =  $_POST['from_where'] ;
    $CustInfo = $db->H_SelectOneRow("SELECT * FROM customer where id = '$Customer_Id' ");
    $New_ticket = array ('id'=> NULL ,
        'date_add'=> $TAddDate['Stamp'] ,
        'date_time'=>  time() ,
        'date_month'=> $TAddDate['Month']."-".$TAddDate['Year'],
        'ticket_cust'=> $_POST['ticket_cust'] ,
        'admin_id'=> $_POST['admin_id'] ,
        'lead_sours'=> $_POST['lead_sours'] ,
        'lead_type'=> $_POST['lead_type'] ,
        'lead_cat'=> $_POST['lead_cat'] ,
        'user_id'=>  $_POST['user_id'] ,
        'notes'=> Clean_Mypost($_POST['notes']) ,
        'cust_id'=>  $Customer_Id ,
        'country_id'=> Clean_Mypost($CustInfo['country_id']) ,
        'countrylive_id'=> Clean_Mypost($CustInfo['countrylive_id']) ,
        'city_id'=> Clean_Mypost($CustInfo['city_id']) ,
        'jop_id'=> Clean_Mypost($CustInfo['jop_id']) ,
        'social_id'=> $CustInfo['social_id'] ,
        'kind_id'=> $CustInfo['kind_id'] ,
        'live_id'=> $CustInfo['live_id'] ,
        'c_type'=> "5" ,
        'c_type_2'=> '1' ,
        'state'=> "1" ,
    );
    $New_ticket =  RemoveFildeFromArrWhenAdd($New_ticket);
    if($ThisIsTest == '1'){
        echo $MyArr["BackUrl"].BR;
        if($From_Where == "Leads" ){
            echo "DELETE FROM c_leads WHERE id ='$C_leads_Id'".BR;
        }
        print_r3($New_ticket);
    }else{
        $db->AutoExecute("sales_ticket",$New_ticket,AUTO_INSERT);
        if($From_Where == "Leads" ){
            $db->H_DELETE_FromId("c_leads",$C_leads_Id);
        }
        Redirect_Page_2('index.php?view='.$MyArr["BackUrl"]);
    }
}
#################################################################################################################################
###################################################   NewTicketForOldCust
#################################################################################################################################
function NewTicketForOldCust($db) {
    $ThisIsTest = '0';
    $MyCustMerIdd = $_POST['cust_id'];
    $ticket_id =  $_POST['ticket_id'];
    $FollowDateVall = FollowDateConfirm();
    $Old_Cust_Data = $db->H_SelectOneRow("SELECT * FROM customer where id = '$MyCustMerIdd' ");
###@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  اضافة التذاكر 
    if(  $FollowDateVall['FollowDateErr']  != '1'  ){
        Add_Admin_Ticket($ThisIsTest);
        Add_New_Ticket($ThisIsTest);
        $Ticket_Update_Full = array (
            'c_type'=> "2" ,
            'c_type_2'=> PostIsset("c_type_2"),
            'cash_id'=>  PostIsset("cash_id"),
            'unit_id'=> PostIsset("unit_id"),
            'area_id'=> PostIsset("area_id"),
            'date_id'=> PostIsset("date_id"),
            'time_id'=> PostIsset("time_id"),
            'bestcall_id'=> PostIsset("bestcall_id") ,
            'pro_area'=> "-".PostIsset("pro_area")."-" ,
            'cours_id'=> "-".PostIsset("cours_id")."-" ,
            'state'=> "2" ,
    'country_id'=> Clean_Mypost($Old_Cust_Data['country_id']) ,
    'countrylive_id'=> Clean_Mypost($Old_Cust_Data['countrylive_id']) ,
    'city_id'=> Clean_Mypost($Old_Cust_Data['city_id']) ,
    'jop_id'=> Clean_Mypost($Old_Cust_Data['jop_id']) ,
    'social_id'=> $Old_Cust_Data['social_id'] ,
    'kind_id'=> $Old_Cust_Data['kind_id'] ,
    'live_id'=> $Old_Cust_Data['live_id'] ,
    'contact_review'=> "1" ,
        );
    $Ticket_Update_Full =  RemoveFildeFromArrWhenAdd($Ticket_Update_Full);        
    if($ThisIsTest == '1'){
        print_r3($Ticket_Update_Full);
        }else{
        $add_server = $db->AutoExecute("sales_ticket",$Ticket_Update_Full,AUTO_UPDATE,"id = $ticket_id");
        UnsetAllSession('name,mobile,mobile_2,phone,email,id_no,birth_date,notes');
        Redirect_Page_2('index.php?view=ViewTicket&id='.$ticket_id);
        }
    }
}
#################################################################################################################################
###################################################   NewTicketAdd
#################################################################################################################################
function NewTicketAdd($db) {
    $ThisIsTest = '0';
    $MyCustMerIdd = $_POST['cust_id'];
    $ticket_id =  $_POST['ticket_id'];
    if(F_FULL_COUNTRY == '1'){
    $Err_Country = CheckCountryState();    
    }else{
    $Err_Country = "";   
    }
    $FollowDateVall = FollowDateConfirm();
###@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@   مراجعة العميل      
   $Customer_Data_Update =  Customer_Data_Update() ;
   $Customer_Data =  $Customer_Data_Update['Data'];
   $Err =  $Customer_Data_Update['Err']; 
   $Err_2 =  $Customer_Data_Update['Err_2'];
###@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  اضافة التذاكر 
    if($Err != "1" and $Err_2 != '1' and $Err_Country !=  '1' and $FollowDateVall['FollowDateErr']  != '1'  ){
        Add_Admin_Ticket($ThisIsTest);
        Add_New_Ticket($ThisIsTest);
        $Ticket_Update_Full = array (
            'c_type'=> "2" ,
            'c_type_2'=> PostIsset_Intval('c_type_2') ,
            'cash_id'=> PostIsset_Intval("cash_id") ,
            'unit_id'=> PostIsset_Intval("unit_id") , 
            'area_id'=> PostIsset_Intval("area_id") ,
            'date_id'=> PostIsset("date_id") ,
            'time_id'=> PostIsset("time_id") ,
            'bestcall_id'=> PostIsset_Intval("bestcall_id") ,
            'pro_area'=> "-".PostIsset_Intval("pro_area")."-" ,
            'cours_id'=> "-".PostIsset_Intval("cours_id")."-" ,
            'state'=> "2" ,
    'country_id'=>PostIsset_Intval("country_id") ,
    'countrylive_id'=> PostIsset_Intval("countrylive_id") ,
    'city_id'=> PostIsset_Intval("city_id") ,
    'jop_id'=> PostIsset_Intval("jop_id") ,
    'social_id'=> PostIsset_Intval("social_id") ,
    'kind_id'=> PostIsset_Intval("kind_id") ,
    'live_id'=> PostIsset_Intval("live_id") ,
    'contact_review'=> "1" ,
        );
     $Ticket_Update_Full = RemoveFildeFromArrWhenAdd($Ticket_Update_Full);        
    if($ThisIsTest == '1'){
        print_r3($Ticket_Update_Full);
        print_r3($Customer_Data);
        }else{
        $add_server = $db->AutoExecute("sales_ticket",$Ticket_Update_Full,AUTO_UPDATE,"id = $ticket_id");
        $add_server = $db->AutoExecute("customer",$Customer_Data,AUTO_UPDATE,"id = $MyCustMerIdd");
        UnsetAllSession('name,mobile,mobile_2,phone,email,id_no,birth_date,notes');
        Redirect_Page_2('index.php?view=ViewTicket&id='.$ticket_id);
        }
    }
}
#################################################################################################################################
###################################################   NewTicketAddFast
#################################################################################################################################
function NewTicketAddFast($db) {
    $ThisIsTest = '0';
    global  $AdminLangFile ;
    global  $ALang ;
    $MyCustMerIdd = $_POST['cust_id'];
    $ticket_id =  $_POST['ticket_id'];
    $FollowDateVall = FollowDateConfirm();
###@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@   مراجعة العميل  
    $Customer_Data = array (
    'name'=> Clean_Mypost($_POST['name']) ,
    'mobile'=> Clean_Mypost($_POST['mobile']) ,
    );
    $Err_2 = PrintErrFromSQL_ForCust_2019("phone","mobile",array('SendErr'=>$ALang['customer_mobile'],'EditId'=> $MyCustMerIdd ));
    if($Err_2 != "1"){
    $Err_2 = PrintErrFromSQL_ForCust_2019("onlyphone","mobile",array('SendErr'=>$ALang['customer_mobile'] ));
    }
    if($Err_2 != "1"){
     $Err_2 = PrintErrFromSQL_ForCust_2019("sub_phone","mobile",array('SendErr'=>$ALang['customer_mobile']));
    }
###@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  اضافة التذاكر 
    if( $Err_2 != '1' and $FollowDateVall['FollowDateErr']  != '1'  ){
    Add_Admin_Ticket($ThisIsTest);
    Add_New_Ticket($ThisIsTest);
    $Ticket_Update = array (
    'state'=> "2" ,
    );
    if($ThisIsTest == '1'){
        print_r3($Ticket_Update);
        print_r3($Customer_Data);
        }else{
        $add_server = $db->AutoExecute("sales_ticket",$Ticket_Update,AUTO_UPDATE,"id = $ticket_id");
        $add_server = $db->AutoExecute("customer",$Customer_Data,AUTO_UPDATE,"id = $MyCustMerIdd");
        UnsetAllSession('name,mobile,mobile_2,phone,email,id_no,birth_date,notes');
        Redirect_Page_2('index.php?view=ViewTicket&id='.$ticket_id);
        }
    } 
}
#################################################################################################################################
###################################################   Add_Admin_Ticket
#################################################################################################################################
function Add_Admin_Ticket($ThisIsTest){
    global $db ;
    $TAddDate =  FULLDate_ForToday_PerAdmin($_POST['old_date']);
    $Admin_Ticket = array ('id'=> NULL ,
        'cat_id'=> $_POST['ticket_id'] ,
        'cust_id'=> $_POST['cust_id'],
        'date_add'=> $_POST['old_date'] ,
        'date_time'=> $_POST['old_date'] ,
        'ticket_date'=> $_POST['ticket_date'] ,
        'date_month'=> $TAddDate['Month']."-".$TAddDate['Year'],
        'follow_type'=> "0" ,
        'follow_state'=>"2",
        'follow_date'=> ""  ,
        'des'=>  Clean_Mypost($_POST['old_des'])  ,
        'user_id'=> Clean_Mypost($_POST['old_user_id']) ,
        'user_name'=> GetNameFromID_User("tbl_user",$_POST['old_user_id'],"name") ,
        'count_type'=> '1'  ,
    ); 
    if($ThisIsTest == '1'){
            print_r3($Admin_Ticket);
        }else{
            $add_server = $db->AutoExecute("sales_ticket_des",$Admin_Ticket,AUTO_INSERT);
        }
}
#################################################################################################################################
###################################################   Add_New_Ticket
#################################################################################################################################
function Add_New_Ticket($ThisIsTest){
    global $db ;
    $ticket_id =  $_POST['ticket_id'];
    $FollowDateVall = FollowDateConfirm();
    $TAddDate = FULLDate_ForToday();
    $Ticket_Info = array ('id'=> NULL ,
        'cat_id'=> $_POST['ticket_id'] ,
        'cust_id'=>  $_POST['cust_id'],
        'date_add'=> $TAddDate['Stamp'] ,
        'date_time'=>  time() ,  
        'ticket_date'=> $_POST['ticket_date'] ,
        'date_month'=> $TAddDate['Month']."-".$TAddDate['Year'],
        'follow_type'=> Clean_Mypost($_POST['follow_type']) ,
        'follow_state'=> Clean_Mypost($_POST['follow_state']) ,
        'follow_date'=> $FollowDateVall['FollowDate']  ,
        'follow_time'=> $FollowDateVall['FollowTime']  ,
        'priority_id'=> intval($_POST['priority_id'])  ,        
        'des'=>  Clean_Mypost($_POST['des'])  ,
        'user_id'=> Clean_Mypost($_POST['follow_user_id']) ,
        'user_name'=> Clean_Mypost($_POST['follow_user_name']) ,
        'count_type'=> '2'  ,
    );
    $Ticket_Update = array (
        'date_time' =>  time(),
        'follow_state'=> Clean_Mypost($_POST['follow_state']) ,
        'follow_date'=> $FollowDateVall['FollowDate']  ,
        'follow_time'=> $FollowDateVall['FollowTime']  ,
        'priority_id'=> intval($_POST['priority_id'])  ,
        'notes' =>  Clean_Mypost($_POST['des']) ,
    );
    if($FollowDateVall['FollowDateErr']  != '1'  ){
        if($ThisIsTest == '1'){
            print_r3($Ticket_Info);
            print_r3($Ticket_Update);
        }else{
            $add_server = $db->AutoExecute("sales_ticket_des",$Ticket_Info,AUTO_INSERT);
            $add_server = $db->AutoExecute("sales_ticket",$Ticket_Update,AUTO_UPDATE,"id = $ticket_id");
        }
    }
}
#################################################################################################################################
###################################################  UpdateTicket 
#################################################################################################################################
function UpdateTicket($db){
    $ThisIsTest = '0';
    $MyCustMerIdd = $_POST['cust_id'];
    $ticket_id =  $_POST['ticket_id'];
    $FollowDateVall = FollowDateConfirm();
    $Un_Follow_Count = Un_Follow_Count();
        if( $FollowDateVall['FollowDateErr']  != '1'  and $Un_Follow_Count != '1' ){
        Add_New_Ticket($ThisIsTest);
        if($ThisIsTest != '1'){
        Redirect_Page_2('index.php?view=ViewTicket&id='.$ticket_id);
        }
    }
}
#################################################################################################################################
###################################################    Un_Follow_Count
#################################################################################################################################
function Un_Follow_Count(){
    global $db;
    global $ALang ;
    $ALang['salesdep_follow_add_err'] = "لا يمكن اضافة المتابعة حيث ان المستخدم تجاوز الحد المسموح بيه";
    $Err = '';
    $ticket_id =  $_POST['ticket_id'];
    $UserPerm = GetNameFromID("sales_ticket",$ticket_id,"user_id");
    $CountUnFollow = $db->H_Total_Count("SELECT id FROM sales_ticket WHERE state = '2' and follow_state = '2' and user_id = $UserPerm");
    if($CountUnFollow >= '20'){
    SendJavaErrMass($ALang['salesdep_follow_add_err']);
    $Err = "1" ;    
    }
    return  $Err ;
}
#################################################################################################################################
###################################################   UpdateCust
#################################################################################################################################
function UpdateCust($db) {
    $ThisIsTest = '0';
    global $AdminLangFile ;
    if(F_FULL_COUNTRY == '1'){
    $Err_Country = CheckCountryState();    
    }else{
    $Err_Country ="";
    }
    $MyCustMerIdd = $_POST['cust_id'];
    $ticket_id =  $_POST['ticket_id'];
###@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@   مراجعة العميل      
   $Customer_Data_Update =  Customer_Data_Update() ;
   $Customer_Data =  $Customer_Data_Update['Data'];
   $Err =  $Customer_Data_Update['Err']; 
   $Err_2 =  $Customer_Data_Update['Err_2'];
###@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@   مراجعة العميل    
    $Ticket_Update = array ( 
    'c_type'=> "2" ,
    'c_type_2'=> PostIsset_Intval("c_type_2"),
    'cash_id'=> PostIsset_Intval("cash_id"),
    'unit_id'=> PostIsset_Intval("unit_id"),
    'area_id'=>  PostIsset_Intval("area_id"),
    'date_id'=>  PostIsset_Intval("date_id"),
    'time_id'=>  PostIsset_Intval("time_id"),
    'bestcall_id'=> PostIsset_Intval("bestcall_id"),
    'cours_id'=> "-".PostIsset_Intval("cours_id")."-" , 
    'pro_area'=> "-".PostIsset_Intval("pro_area")."-" ,
    'country_id'=> PostIsset_Intval("country_id"),
    'countrylive_id'=> PostIsset_Intval("countrylive_id"),
    'city_id'=> PostIsset_Intval("city_id"),
    'jop_id'=> PostIsset_Intval("jop_id"),
    'social_id'=> PostIsset_Intval("social_id"),
    'kind_id'=> PostIsset_Intval("kind_id"),
    'live_id'=> PostIsset_Intval("live_id"),
    'contact_review'=> "1" ,
       );
    $Ticket_Update = RemoveFildeFromArrWhenAdd($Ticket_Update);
   if($Err != "1" and $Err_2 != '1' and $Err_Country !=  '1'   ){
      Add_Sub_Ticket($ThisIsTest,"5");
      if($ThisIsTest == '1'){
        print_r3($Customer_Data);
        print_r3($Ticket_Update); 
       }else{
       $add_server = $db->AutoExecute("sales_ticket",$Ticket_Update,AUTO_UPDATE,"id = $ticket_id");
       $add_server = $db->AutoExecute("customer",$Customer_Data,AUTO_UPDATE,"id = $MyCustMerIdd");
       Redirect_Page_2('index.php?view=ViewTicket&id='.$ticket_id); 
       } 
   }
}
#################################################################################################################################
###################################################   UpdateCustForOldCust
#################################################################################################################################
function UpdateCustForOldCust($db) {
    $ThisIsTest = '0';
    global $AdminLangFile ;
    $MyCustMerIdd = $_POST['cust_id'];
    $ticket_id =  $_POST['ticket_id'];
    $Old_Cust_Data = $db->H_SelectOneRow("SELECT * FROM customer where id = '$MyCustMerIdd' ");
    $Ticket_Update = array ( 
    'c_type'=> "2" ,
    'c_type_2'=> PostIsset("c_type_2"),
    'cash_id'=> PostIsset("cash_id"),
    'unit_id'=> PostIsset("unit_id"),
    'area_id'=> PostIsset("area_id"),  
    'date_id'=> PostIsset("date_id"),
    'time_id'=> PostIsset("time_id"),
    'bestcall_id'=>  PostIsset("bestcall_id") , 
    'pro_area'=> "-".PostIsset("pro_area")."-" ,
    'cours_id'=> "-".PostIsset("cours_id")."-" ,  
    'country_id'=> Clean_Mypost($Old_Cust_Data['country_id']) ,
    'countrylive_id'=> Clean_Mypost($Old_Cust_Data['countrylive_id']) ,
    'city_id'=> Clean_Mypost($Old_Cust_Data['city_id']) ,
    'jop_id'=> Clean_Mypost($Old_Cust_Data['jop_id']) ,
    'social_id'=> $Old_Cust_Data['social_id'] ,
    'kind_id'=> $Old_Cust_Data['kind_id'] ,
    'live_id'=> $Old_Cust_Data['live_id'] ,
    'contact_review'=> "1" ,
       );
    $Ticket_Update = RemoveFildeFromArrWhenAdd($Ticket_Update);
      Add_Sub_Ticket($ThisIsTest,"5");
      if($ThisIsTest == '1'){
        print_r3($Ticket_Update); 
       }else{
       $add_server = $db->AutoExecute("sales_ticket",$Ticket_Update,AUTO_UPDATE,"id = $ticket_id");
       Redirect_Page_2('index.php?view=ViewTicket&id='.$ticket_id); 
       } 
}
#################################################################################################################################
###################################################   Add_Sub_Ticket
#################################################################################################################################
function Add_Sub_Ticket($ThisIsTest,$Add_Type){
    global $db ;
    $ticket_id =  $_POST['ticket_id'];
    $FollowDateVall = FollowDateConfirm();
    $TAddDate = FULLDate_ForToday();
    $Ticket_Info = array ('id'=> NULL ,
        'cat_id'=> $_POST['ticket_id'] ,
        'cust_id'=>  $_POST['cust_id'],
        'date_add'=> $TAddDate['Stamp'] ,
        'ticket_date'=> $_POST['ticket_date'] ,
        'date_time'=>  time() ,  
        'date_month'=> $TAddDate['Month']."-".$TAddDate['Year'],       
        'follow_type'=> PostIsset_Intval("follow_type"),
        'follow_state'=> PostIsset_Intval("follow_state") ,
        'follow_date'=> $FollowDateVall['FollowDate']  ,
        'des'=>  Clean_Mypost($_POST['des'])  ,
        'user_id'=> Clean_Mypost($_POST['follow_user_id']) ,
        'user_name'=> Clean_Mypost($_POST['follow_user_name']) ,
        'add_type'=> $Add_Type ,
        'count_type'=> '2'  ,
    );
        if($ThisIsTest == '1'){
            print_r3($Ticket_Info);
          }else{
            $add_server = $db->AutoExecute("sales_ticket_des",$Ticket_Info,AUTO_INSERT);
         }
}
#################################################################################################################################
###################################################  UpdateTicket 
#################################################################################################################################
function AskForHelp($db){
    $ThisIsTest = '0';
    $ticket_id =  $_POST['ticket_id'];
    $TAddDate = FULLDate_ForToday();
    $Ticket_Info = array ('id'=> NULL ,
        'cat_id'=> $_POST['ticket_id'] ,
        'cust_id'=>  $_POST['cust_id'],
        'date_add'=> $TAddDate['Stamp'] ,
        'ticket_date'=>  $_POST['ticket_date'],
        'date_time'=>  time() ,  
        'date_month'=> $TAddDate['Month']."-".$TAddDate['Year'],
        'des'=>  Clean_Mypost($_POST['des'])  ,
        'user_id'=> Clean_Mypost($_POST['follow_user_id']) ,
        'user_name'=> Clean_Mypost($_POST['follow_user_name']) ,
        'count_type'=> '4'  ,
    );
    $Ticket_Update = array (
        'date_time' =>  time(),
        'support_review' =>  "1",
        'notes' =>  Clean_Mypost($_POST['des']) ,
    ); 
          if($ThisIsTest == '1'){
            print_r3($Ticket_Info);
            print_r3($Ticket_Update);
        }else{
            $add_server = $db->AutoExecute("sales_ticket_des",$Ticket_Info,AUTO_INSERT);
            $add_server = $db->AutoExecute("sales_ticket",$Ticket_Update,AUTO_UPDATE,"id = $ticket_id");
            Redirect_Page_2('index.php?view=ViewTicket&id='.$ticket_id);
        }  
}
#################################################################################################################################
###################################################   AddVisit
#################################################################################################################################
function AddVisit($db){
    global $AdminLangFile ;
    $ThisIsTest = '0' ;
    $ticket_id = $_POST['ticket_id'];
    $Visit_Date = FULLDate($_POST['visit_date']);
    $Err =  CheckdateForLastdate($Visit_Date['Stamp']) ;
   ##@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  تحديث حالة التذكرة   
   if($Err != '1'){
    $Ticket_Update = array ( 
    'visit_date'=>  $Visit_Date['Stamp'] ,
    'visit_month'=> $Visit_Date['Month']."-".$Visit_Date['Year'],
    'visit_s' =>  "1" ,
    'notes' =>  Clean_Mypost($_POST['des']) ,
    'date_time' =>  time(),
    );
    Add_Sub_Ticket($ThisIsTest,"1");
    if($ThisIsTest == '1'){
     print_r3($Ticket_Update) ;     
    }else{
    $add_server = $db->AutoExecute("sales_ticket",$Ticket_Update,AUTO_UPDATE,"id = $ticket_id");
    Redirect_Page_2('index.php?view=ViewTicket&id='.$ticket_id);    
    }  
   }
}
#################################################################################################################################
###################################################  AddReservation
#################################################################################################################################
function AddReservation($db){
    $ThisIsTest = '0' ;
    $ticket_id = $_POST['ticket_id'];
    $Res_Date = FULLDate($_POST['rev_date']);
    $Res_Date_2 = FULLDate($_POST['rev_date_2']);
    $Err =  CheckdateForLastdate($Res_Date['Stamp']) ;
    ###@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  تحديث حالة التذكرة     
    if($Err != '1'){
    $Ticket_Update = array ( 
    'rev_s' =>  "1" ,
    'rev_date'=>  $Res_Date['Stamp'] ,
    'rev_month'=>  $Res_Date['Month']."-".$Res_Date['Year'],  
    'rev_date_2'=>  $Res_Date_2['Stamp'] ,
    'notes' =>  Clean_Mypost($_POST['des']) ,
    'date_time' =>  time(),
    );
    Add_Sub_Ticket($ThisIsTest,"2");
    if($ThisIsTest == '1'){
     print_r3($Ticket_Update) ;     
    }else{
    $add_server = $db->AutoExecute("sales_ticket",$Ticket_Update,AUTO_UPDATE,"id = $ticket_id");
    Redirect_Page_2('index.php?view=ViewTicket&id='.$ticket_id);    
    }
    }
}
#################################################################################################################################
###################################################  CancelReservation
#################################################################################################################################
function CancelReservation($db){
    $ThisIsTest = '0' ;
    $ticket_id = $_POST['ticket_id'];
    $Res_Date = FULLDate($_POST['cancel_date']);
    $Err =  CheckdateForLastdate($Res_Date['Stamp']) ;
    if($Err != '1'){
   ///// تحديث حالة التذكرة 
    $Ticket_Update = array ( 
    'cancel_s' =>  "1" ,
    'cancel_date'=>  $Res_Date['Stamp'] ,
    'cancel_month'=> $Res_Date['Month']."-".$Res_Date['Year'],  
    'notes' =>  Clean_Mypost($_POST['des']) ,
    'date_time' =>  time(),
    );
    Add_Sub_Ticket($ThisIsTest,"3");
    if($ThisIsTest == '1'){
     print_r3($Ticket_Update) ;     
    }else{
    $add_server = $db->AutoExecute("sales_ticket",$Ticket_Update,AUTO_UPDATE,"id = $ticket_id");
    Redirect_Page_2('index.php?view=ViewTicket&id='.$ticket_id);    
    }
 }
}
#################################################################################################################################
###################################################  AddContract
#################################################################################################################################
function AddContract($db){
    $ThisIsTest = '0' ;
    $ticket_id = $_POST['ticket_id'];
    $Contract_Date = FULLDate($_POST['contract_date']);
    $Err =  CheckdateForLastdate($Contract_Date['Stamp']) ;
   if($Err != '1'){
   ///// تحديث حالة التذكرة 
    $Ticket_Update = array ( 
    'state' =>  "3" ,
    'contract_s' =>  "1" ,
    'contract_date'=>  $Contract_Date['Stamp'] ,
    'contract_month'=> $Contract_Date['Month']."-".$Contract_Date['Year'],  
    'notes' =>  Clean_Mypost($_POST['des']) ,
    'date_time' =>  time(),
    );
    Add_Sub_Ticket($ThisIsTest,"4");
    if($ThisIsTest == '1'){
     print_r3($Ticket_Update) ;     
    }else{
    $add_server = $db->AutoExecute("sales_ticket",$Ticket_Update,AUTO_UPDATE,"id = $ticket_id");
    Redirect_Page_2('index.php?view=Report');    
    }
 }
}
#################################################################################################################################
###################################################   ConfirmContract
#################################################################################################################################
function ConfirmContract($db){
    $ThisIsTest = '0';
    $ticket_id =  $_POST['ticket_id'];
    $TAddDate = FULLDate_ForToday();
    $sql = "SELECT * FROM sales_ticket where id = '$ticket_id'";
    $row = $db->H_SelectOneRow($sql);
    $MyCustMerIdd =  $_POST['cust_id'];
    $TDDateAdd =   FULLDate_ForToday_PerAdmin($row['contract_date']);
    $Ticket_Update = array (
    'c_type'=> $_POST['c_type'] ,
    'c_type_2'=> $_POST['c_type_2'] ,
    'state'=> $_POST['close_state'] ,
    'close_type'=> "1" ,
    'close_date'=> $row['contract_date'] ,
    'close_month'=>  $TDDateAdd['Month']."-".$TDDateAdd['Year'],
    'close_date_2'=> $TAddDate['Stamp'] ,  
    'close_month_2'=> $TAddDate['Month']."-".$TAddDate['Year'], 
    ); 
    $Customer_Data = array (
    'c_type'=> $_POST['c_type'] ,
    'c_type_2'=> $_POST['c_type_2'] ,
    ); 
    if($ThisIsTest == '1'){
        print_r3($Ticket_Update);
        print_r3($Customer_Data);
        }else{
        $add_server = $db->AutoExecute("sales_ticket",$Ticket_Update,AUTO_UPDATE,"id = $ticket_id");
        $add_server = $db->AutoExecute("customer",$Customer_Data,AUTO_UPDATE,"id = $MyCustMerIdd");
        Redirect_Page_2('index.php?view=ContractWait');
    }
} 
#################################################################################################################################
###################################################   Close_Ticket
#################################################################################################################################
function Close_Ticket($db){
  $ThisIsTest = '0' ;  
  $cust_id = $_POST['cust_id'];  
  $ticket_id =  $_POST['ticket_id'] ; 
    $TAddDate = FULLDate_ForToday();
  ///  print_r3($_POST);
    if($_POST['close_id'] == '1'){
    $CType =  "3"   ;
    $CloseTYpe = "2" ;
    }elseif($_POST['close_id'] == '2'){
    $CType =  "4"   ;
    $CloseTYpe = "3" ;    
    }
    $Ticket_Info = array ('id'=> NULL ,
        'cat_id'=> $_POST['ticket_id'] ,
        'cust_id'=>  $_POST['cust_id'],
        'date_add'=> $TAddDate['Stamp'] ,
        'ticket_date'=> $_POST['ticket_date'] ,
        'date_time'=>  time() ,  
        'date_month'=> $TAddDate['Month']."-".$TAddDate['Year'],
        'des'=>  Clean_Mypost($_POST['des'])  ,
        'user_id'=> Clean_Mypost($_POST['follow_user_id']) ,
        'user_name'=> Clean_Mypost($_POST['follow_user_name']) ,
        'count_type'=> '2'  ,
    );
    $Ticket_Update = array (
        'date_time' =>  time(),
        'notes' =>  Clean_Mypost($_POST['des']) ,
        'state' => "4" ,
        'c_type' => $CType ,
        'c_type_2' => Clean_Mypost($_POST['c_type_2']) ,
        'close_type' => $CloseTYpe ,
        'close_date'=> $TAddDate['Stamp'] ,
        'close_month'=> $TAddDate['Month']."-".$TAddDate['Year'],
    );
////////
        GetCruntCustState($ThisIsTest,$cust_id,$CType);
        if($ThisIsTest == '1'){
            print_r3($Ticket_Info);
            print_r3($Ticket_Update);
        }else{
            $add_server = $db->AutoExecute("sales_ticket_des",$Ticket_Info,AUTO_INSERT);
            $add_server = $db->AutoExecute("sales_ticket",$Ticket_Update,AUTO_UPDATE,"id = $ticket_id");
            Redirect_Page_2('index.php?view=Report');
        }
}
#################################################################################################################################
###################################################   GetCruntCustState
#################################################################################################################################
function GetCruntCustState($ThisIsTest,$cust_id,$CType){
    global $db ;
    $sql = "SELECT * FROM customer where id = '$cust_id'";
    $row = $db->H_SelectOneRow($sql);
    if($row['c_type'] != '1'){
       $Custmer_Update = array (
        'c_type' => $CType ,
        'c_type_2' => Clean_Mypost($_POST['c_type_2']) ,
       );  
         if($ThisIsTest == '1'){
            print_r3($Custmer_Update);
        }else{
           $add_server = $db->AutoExecute("customer",$Custmer_Update,AUTO_UPDATE,"id = $cust_id");
        }
    }	
}
?>