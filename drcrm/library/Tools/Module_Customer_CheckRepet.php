<?php
if(!defined('WEB_ROOT')) {	exit;}

#################################################################################################################################
###################################################   Leads_Check_For_Customer_Type
#################################################################################################################################
/// مراجعة اذا كان العميل حالى ام سابقة 

function Leads_Check_For_Customer_Type($MyArr=array()){
    global $db ;
    $ThIsIsTest = '0';
    
    $MyChSql = "SELECT id,mobile,mobile_2,phone,email FROM c_leads WHERE ch = '0' " ;
    $already = $db->H_Total_Count($MyChSql);

    if($already > 0) {

        $Name = $db->SelArr($MyChSql);
         
        for($i = 0; $i < count($Name); $i++) {
            $Leads_ID = $Name[$i]['id'];

            $Mobile =  Find_If_Customer_Is_Existing($Name[$i]['mobile'],"phone");
            $Mobile_2 =  Find_If_Customer_Is_Existing($Name[$i]['mobile_2'],"phone");
            $Phone =  Find_If_Customer_Is_Existing($Name[$i]['phone'],"phone");
            $Email =  Find_If_Customer_Is_Existing($Name[$i]['email'],"email");
            
            $Sub_Mobile =  Find_If_Customer_Is_Existing($Name[$i]['mobile'],"sub_phone");
            $Sub_Mobile_2 =  Find_If_Customer_Is_Existing($Name[$i]['mobile_2'],"sub_phone");
            $Sub_Phone =  Find_If_Customer_Is_Existing($Name[$i]['phone'],"sub_phone");
            $Sub_Email =  Find_If_Customer_Is_Existing($Name[$i]['email'],"sub_email");
 
 
            if($Mobile['Err'] == '0' and $Mobile_2['Err'] == '0' and  $Phone['Err'] == '0' and $Email['Err'] == '0' 
            and $Sub_Mobile['Err'] == '0'  and $Sub_Mobile_2['Err'] == '0'   and $Sub_Phone['Err'] == '0'   and $Sub_Email['Err'] == '0' 
            
            ){
                $server_data = array (
                    'ch'=> "1"  ,
                    'cust'=> "0"  ,
                );
            }else{
                $server_data = array (
                    'ch'=> "1"  ,
                    'cust'=> "1"  ,
                    'id_1'=> intval($Mobile['Id'])  ,
                    'id_2'=> intval($Mobile_2['Id'] ) ,
                    'id_3'=> intval($Phone['Id'])  ,
                    'id_4'=> intval($Email['Id'])  ,
                    
                    'id_5'=> intval($Sub_Mobile['Id'])  ,
                    'id_6'=> intval($Sub_Mobile_2['Id'] ) ,
                    'id_7'=> intval($Sub_Phone['Id'])  ,
                    'id_8'=> intval($Sub_Email['Id'])  ,    
                    
                );
            }
           if($ThIsIsTest == '1'){
            print_r3($Mobile);
            print_r3($Mobile_2);
            print_r3($Phone);
            print_r3($Email);
            
            print_r3($Sub_Mobile);
            print_r3($Sub_Mobile_2);
            print_r3($Sub_Phone); 
            print_r3($Sub_Email); 
             
            print_r3($server_data);
           }else{
            $db->AutoExecute("c_leads",$server_data,AUTO_UPDATE,"id = $Leads_ID");
           }
        }
    }else{
      if($ThIsIsTest == '1'){
        echo "لا يوجد قيمة للمراجعة ";
      }  
    }
}
#################################################################################################################################
###################################################  Find_If_Customer_Is_Existing
#################################################################################################################################
function Find_If_Customer_Is_Existing($Val,$Type,$MyArr=array()){
    global $db ;
    if(($Val) ){
        $CheckVall = Clean_Mypost($Val);
      # echo "HI".$Type.BR;
        if($Type == 'email'){
            $SQL = "SELECT id,name FROM customer WHERE email = '$CheckVall'  ";
        }elseif( $Type  == 'id_no'){
            $SQL = "SELECT id,name FROM customer WHERE id_no = '$CheckVall'  ";
        }elseif( $Type  == 'phone'){
            $SQL = "SELECT id,name FROM customer WHERE ( mobile = '$CheckVall' or  mobile_2 = '$CheckVall' or phone = '$CheckVall') ";
        }elseif( $Type  == 'sub_phone'){
            $SQL = "SELECT id,cust_id FROM customer_sub WHERE ( mobile = '$CheckVall' or  mobile_2 = '$CheckVall' ) ";            
        }elseif( $Type  == 'sub_email'){
            $SQL = "SELECT id,cust_id FROM customer_sub WHERE  email = '$CheckVall'  ";            
        }
        
        
       
        $already = $db->H_Total_Count($SQL);
        if($already > 0) {
            $row = $db->H_SelectOneRow($SQL);
            if( $Type  == 'sub_phone' or $Type  == 'sub_email' ){
            $ErrSend =   array('Err'=> "1" , 'Id'=> $row['cust_id'] ) ;    
            }else{
            $ErrSend =   array('Err'=> "1" , 'Id'=> $row['id'] ) ;                
            }
            
            
        }else{
            $ErrSend =   array('Err'=> "0" , 'Id'=> "" ) ;
        }
    }else{
        $ErrSend =   array('Err'=> "0" , 'Id'=> "" ) ;
    }
    return $ErrSend  ;
}

#################################################################################################################################
###################################################   Transfer_Data_Check_For_Repet
#################################################################################################################################
function Transfer_Data_Check_For_Repet($row,$IDSend="0"){
    global $db ;

            $Mobile   =  Find_Repet_Data($row['mobile'],"phone",$IDSend);
            
            if(isset($row['mobile_2'])){
            $Mobile_2 =  Find_Repet_Data($row['mobile_2'],"phone",$IDSend);    
            }else{
            $Mobile_2['Err'] = '0' ; $Mobile_2['Id'] = '0';    
            }
            
            $Email =  Find_Repet_Data(isset($row['email']),"email",$IDSend);  
           
            
        if($Mobile['Err'] == '0' and $Mobile_2['Err'] == '0' and  $Email['Err'] == '0' ){
            $Send_Data = array (
                'ch_2'=> "1"  ,
                'id_1'=> intval($Mobile['Id'])  ,
                'id_2'=> intval($Mobile_2['Id'])  ,
                'id_3'=> intval($Email['Id'])  ,
            );
        }else{
            $Send_Data = array (
                'ch_2'=> "0"  ,
                'id_1'=> intval($Mobile['Id'])  ,
                'id_2'=> intval($Mobile_2['Id'])  ,
                'id_3'=> intval($Email['Id'])  ,
            );
        }
        
   return  $Send_Data  ;
}

#################################################################################################################################
###################################################   Find_Repet_Data
#################################################################################################################################
function Find_Repet_Data($Val,$Type,$IDSend){
    global $db ;
    if(($Val) ){

       $CheckVall = Clean_Mypost($Val);
       if(intval($IDSend)!= '0'){
        $ThisFilterForEdit = " and id != ".intval($IDSend);
       }else{
        $ThisFilterForEdit = "";
       } 


        if($Type == 'email'){
            $SQL = "SELECT id,name FROM c_leads WHERE email = '$CheckVall' $ThisFilterForEdit ";
        }elseif( $Type == "phone"){
            $SQL = "SELECT id,name FROM c_leads WHERE ( mobile = '$CheckVall' or  mobile_2 = '$CheckVall' or phone = '$CheckVall') $ThisFilterForEdit ";
        } 
        
        $already = $db->H_Total_Count($SQL);
        if($already > 0) {
            $row = $db->H_SelectOneRow($SQL);
            $SendErr =   array('Err'=> "1" , 'Id'=> $row['id'] ) ;
        }else{
            $SendErr =   array('Err'=> "0" , 'Id'=> "" ) ;
        }

    }else{
         $SendErr =   array('Err'=> "0" , 'Id'=> "" ) ;
    }
     return  $SendErr  ;
}













#################################################################################################################################
###################################################    PrintErrFromSQL_ForCust_2019
#################################################################################################################################
function PrintErrFromSQL_ForCust_2019($Type,$PostName,$SendArr=array()){
    global $db ;
    global $AdminPathHome ;
    global $ALang ;
    global $AdminConfig ;
    $Err = "" ;
    
    $EditId = ArrIsset($SendArr,"EditId",'0');
    $FilterFilde = ArrIsset($SendArr,"FilterFilde",'id');
    $SendErr = ArrIsset($SendArr,"SendErr",'');
    
    if(intval($EditId) != '0'){
        $FilterForEditLine = " and $FilterFilde != ".intval($EditId);
    }else{
        $FilterForEditLine = '';
    }
    
    if(($_POST[$PostName]) ){
        $CheckVall = Clean_Mypost($_POST[$PostName]);
        if($Type == 'email'){
            $SQL = "SELECT id,name FROM customer WHERE email = '$CheckVall' $FilterForEditLine ";
        }elseif( $Type  == 'id_no'){
            $SQL = "SELECT id,name FROM customer WHERE id_no = '$CheckVall' $FilterForEditLine ";
        }elseif( $Type  == 'phone'){
            $SQL = "SELECT id,name FROM customer WHERE ( mobile = '$CheckVall' or  mobile_2 = '$CheckVall' or phone = '$CheckVall') $FilterForEditLine ";
        }elseif( $Type  == 'sub_phone'){
            $SQL = "SELECT id,cust_id FROM customer_sub WHERE ( mobile = '$CheckVall' or  mobile_2 = '$CheckVall' ) ";
        }elseif($Type == 'sub_email'){
           $SQL = "SELECT id,cust_id FROM customer_sub WHERE email = '$CheckVall' ";   
        }elseif($Type == 'onlyphone'){
           $SQL = "SELECT id,name FROM customer WHERE (  mobile_2 = '$CheckVall' or phone = '$CheckVall')    ";  
        }
        
        
        
        $already = $db->H_Total_Count($SQL);
        if($already > 0) {
            $Err = '1';
            $SendMass = "";
            $Name = $db->SelArr($SQL);
            
            for($i = 0; $i < count($Name); $i++) {
                if($Type == 'sub_phone' or $Type == 'sub_email' ){
                    $CustomerIDDD = $Name[$i]['cust_id'];
                    $Row_Cust = $db->H_SelectOneRow("select * from customer where id = '$CustomerIDDD' ");
                    $Customer_Name = $Row_Cust['name'];
                }else{
                    $CustomerIDDD = $Name[$i]['id'];
                    $Customer_Name = $Name[$i]['name'];
                }
                $Link_View = $AdminPathHome."Customer/index.php?view=Profile&id=".$CustomerIDDD ;
                $Target = "_blank" ;
                $ErrMass = $SendErr." ".$CheckVall ;
                $SendMass .= $ErrMass." ".$ALang['mainform_err_already_exists']." ";
                $SendMass .= $Customer_Name." ".$ALang['mainform_err_record_id']." ".$CustomerIDDD ;
                if($AdminConfig['customer'] == '1'){
                    $SendMass .=   BR.'<a href='.$Link_View.'  target= '.$Target.' >'.$ALang['customer_view_cust_err'].'</a>'." " ;
                }
            }
            SendJavaErrMass_22 ($SendMass);
        }
    }
    
    return $Err ;
}


#################################################################################################################################
###################################################  CustomerAddContactNew 
#################################################################################################################################
function CustomerAddContactNew($db){
    global $ALang;
    $ThIsIsTest = '0';
    $Cust_Id  = $_POST['Customer_AddMoreID'] ;
    
    $server_data_2 = array (
        'mobile'=> Clean_Mypost($_POST['sub_mobile']) ,
        'mobile_2'=> Clean_Mypost($_POST['sub_mobile_2']) ,
    );
    
    $Err =  CheckDuplicatesEntry($server_data_2);
    
    $server_data = array (
        'id'=> NULL ,
        'cust_id'=> $_POST['Customer_AddMoreID'] ,
        'rel'=> Clean_Mypost($_POST['sub_rel']) ,
        'name'=> Clean_Mypost($_POST['sub_name']) ,
        'mobile'=> Clean_Mypost($_POST['sub_mobile']) ,
        'mobile_2'=> Clean_Mypost($_POST['sub_mobile_2']) ,
        'email'=> Clean_Mypost($_POST['sub_email']) ,
    );
    
    if($Err == '1'){
        SendJavaErrMass($ALang['mainform_duplicated_data']);
    }else{
        
        $Err_2 = PrintErrFromSQL_ForCust_2019("phone","sub_mobile",array('SendErr'=>$ALang['customer_mobile']));
        
        if($Err_2 != "1"){
            $Err_2 = PrintErrFromSQL_ForCust_2019("phone","sub_mobile_2",array('SendErr'=>$ALang['customer_mobile']));
        }
        
        if($Err_2 != "1"){
            $Err_2 = PrintErrFromSQL_ForCust_2019("email","sub_email",array('SendErr'=>$ALang['customer_email']));
        }
        
        if($Err_2 != "1"){
            $Err_2 = PrintErrFromSQL_ForCust_2019("sub_phone","sub_mobile",array('SendErr'=>$ALang['customer_mobile']));
        }
        
        if($Err_2 != "1"){
            $Err_2 = PrintErrFromSQL_ForCust_2019("sub_phone","sub_mobile_2",array('SendErr'=>$ALang['customer_mobile']));
        }
        
        if($Err_2 != "1"){
            $Err_2 = PrintErrFromSQL_ForCust_2019("sub_email","sub_email",array('SendErr'=>$ALang['customer_email']));
        }
    }
    
    if($ThIsIsTest == '1'){
        print_r3($server_data);
    }else{
        if($Err != "1" and $Err_2 != '1' ){
            $db->AutoExecute("customer_sub",$server_data,AUTO_INSERT);
            $already = $db->H_Total_Count("SELECT id FROM customer_sub WHERE cust_id = '$Cust_Id'");
            UpdateFildeForDell("customer","sub_count",$already,$Cust_Id) ;
            Redirect_Page_2(LASTREFFPAGE);
        }
    }
}

#################################################################################################################################
###################################################    Diar_Print_AddMoreContact_Form
#################################################################################################################################
function Diar_Print_AddMoreContact_NewForm($MyArr){
    global $ALang ;
   
    $Custmer_ID = ArrIsset($MyArr,"Custmer_ID","0");
     
    if(intval($Custmer_ID) != '0' ){

        Form_Open();

        echo '<input type="hidden" name="Customer_AddMoreID" value="'.$Custmer_ID.'" />';

        $MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required','Dir'=> "Ar_Lang");
        $Err[] = NF_PrintInput("Text",$ALang['customer_sub_name'],"sub_name","1","1","req",$MoreS);

        $MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required','Dir'=> "Ar_Lang");
        $Err[] = NF_PrintInput("Text",$ALang['customer_sub_re'],"sub_rel","1","1","req",$MoreS);

        echo '<div style="clear: both!important;"></div>';
        $MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required data-parsley-type="digits" data-parsley-minlength="11"', 'Dir'=> "En_Lang" );
        $Err[] = NF_PrintInput("Text",$ALang['customer_sub_mobile']."1","sub_mobile","1","0","req-num",$MoreS);

        $MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'data-parsley-type="digits" data-parsley-minlength="11"', 'Dir'=> "En_Lang" );
        $Err[] = NF_PrintInput("Text",$ALang['customer_sub_mobile']."2","sub_mobile_2","400","0","optin-num",$MoreS);

        echo '<div style="clear: both!important;"></div>';

        $MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'data-parsley-type="email"', 'Dir'=> "En_Lang" );
        $Err[] = NF_PrintInput("Text",$ALang['customer_sub_email'],"sub_email","400","0","optin-email",$MoreS);

        Form_Close_3('1',"Customer_AddMore");

 
    }
}


#################################################################################################################################
###################################################    
#################################################################################################################################
function CheckForAllEntry($MyCustMerIdd){
        global $ALang ;
        $Err_2 = PrintErrFromSQL_ForCust_2019("phone","mobile",array('SendErr'=>$ALang['customer_mobile'],'EditId'=> $MyCustMerIdd ));
        
        if($Err_2 != "1"){
            $Err_2 = PrintErrFromSQL_ForCust_2019("phone","mobile_2",array('SendErr'=>$ALang['customer_mobile'],'EditId'=> $MyCustMerIdd));
        }
        
        if($Err_2 != "1"){
            $Err_2 = PrintErrFromSQL_ForCust_2019("phone","phone",array('SendErr'=>$ALang['customer_phone'],'EditId'=> $MyCustMerIdd));
        }

        if($Err_2 != "1"){
            $Err_2 = PrintErrFromSQL_ForCust_2019("email","email",array('SendErr'=>$ALang['customer_email'],'EditId'=> $MyCustMerIdd));
        }
        
        if($Err_2 != "1"){
            $Err_2 = PrintErrFromSQL_ForCust_2019("sub_phone","mobile",array('SendErr'=>$ALang['customer_mobile']));
        }
        
        if($Err_2 != "1"){
            $Err_2 = PrintErrFromSQL_ForCust_2019("sub_phone","mobile_2",array('SendErr'=>$ALang['customer_mobile']));
        }
        
        if($Err_2 != "1"){
            $Err_2 = PrintErrFromSQL_ForCust_2019("sub_phone","phone",array('SendErr'=>$ALang['customer_phone']));
        }
        
        if($Err_2 != "1"){
            $Err_2 = PrintErrFromSQL_ForCust_2019("sub_email","email",array('SendErr'=>$ALang['customer_email']));
        }
        
       return $Err_2 ;
   
}

	
?>