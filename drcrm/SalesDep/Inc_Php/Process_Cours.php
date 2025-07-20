<?php




function Print_CoursTInfo($Course_Info){
    global $AdminLangFile ;
    echo '<div class="table-responsive"><table class="table table-striped table-bordered table-hover ArTabel">';
    echo '<thead><tr>';
    echo '<th>'.$AdminLangFile['course_name'].'</th>';
    echo '<th>'.$AdminLangFile['course_date'].'</th>';
    echo '<th>'.$AdminLangFile['course_city'].'</th>';
    echo '<th>'.$AdminLangFile['course_price'].'</th>';
    echo '</tr></thead>';
    echo '<tbody><tr>';
    echo '<td>'.$Course_Info['name'].'</td>';
    echo '<td>'.ConvertDateToCalender_3($Course_Info['c_date']).'</td>';
    echo '<td>'.GetNameFromID('fi_city',$Course_Info['city_id'],"name").'</td>';
    echo '<td>'.$Course_Info['price'].'</td>';
    echo '</tr></tbody>';
    echo '</table></div>';
}




function  Add_Invoce($db){
    global $AdminLangFile ;
    $ThIsIsTest = '0';
    $ErrAmount_No =""; $ErrCustomer="";
    
    $Invoce_Date = strtotime( $_POST['invoce_date']);
    $Invoce_Ref = OredrCodeRef("invoice_pay","ref","10","Ref_");
    $Total_INV = '0';
    for ($i = 0; $i <= count($_POST['val']); $i++) {
        if(isset($_POST['val'][$i])){
        $Total_INV = $Total_INV + $_POST['val'][$i];    
        }
    }
    $Net_Price = $Total_INV - Clean_Mypost($_POST['discount']) ;
    $Total_LESS = $Net_Price - Clean_Mypost($_POST['amount'])  ;
    $Amount_No = Clean_Mypost($_POST['amount_no']);
    $already = $db->H_Total_Count("SELECT * FROM invoice_pay WHERE amount_no = '$Amount_No' ");
    if($already > 0) {
        SendJavaErrMass($AdminLangFile['course_err_mass_amount_no']);
        $ErrAmount_No = '1' ;
    }
    
    $ThisCourse = Clean_Mypost($_POST['course_id']);
    $ThisCustomer = Clean_Mypost($_POST['cust_id']);
    $SS_SQL = "SELECT * FROM invoice WHERE course_id = '$ThisCourse'  and customer_id  = $ThisCustomer " ;
    $already = $db->H_Total_Count($SS_SQL);
    if($already > 0) {
        SendJavaErrMass($AdminLangFile['course_err_mass_cust']);
        $ErrAmount_No = '1' ;
    }
    
    
   

    
    if($ErrAmount_No != '1' and $ErrCustomer != '1'){
        
      
        $Invoce_Data = array ('id'=> NULL ,
            'ref'=> $Invoce_Ref ,
            'invoce_date'=> $Invoce_Date ,
            'date_d'=> date("d",$Invoce_Date),
            'date_m'=> date("m",$Invoce_Date),
            'date_y'=> date("Y",$Invoce_Date),
            'city_id'=> Clean_Mypost($_POST['city_id']) ,
            'course_id'=> Clean_Mypost($_POST['course_id']) ,
            'customer_id'=> Clean_Mypost($_POST['cust_id']) ,
            'employee_id'=> Clean_Mypost($_POST['user_id']) ,
            'price'=> Clean_Mypost($_POST['val'][0]) ,
            'total'=> $Total_INV ,
            'discount'=> Clean_Mypost($_POST['discount']) ,
            'net_price'=> $Net_Price ,
            'total_pay'=> Clean_Mypost($_POST['amount']) ,
            'total_less'=> $Total_LESS ,
        );
        if($ThIsIsTest == '1'){
            print_r3($Invoce_Data);
        }else{
            $add_server = $db->AutoExecute("invoice",$Invoce_Data,AUTO_INSERT);
        }
        

        for ($i = 0; $i < count($_POST['val']); $i++) {
            if(intval($_POST['val'][$i]) > '0'){
                $Invoce_Des_Data = array ('id'=> NULL ,
                    'ref'=> $Invoce_Ref ,
                    'course_id'=> Clean_Mypost($_POST['course_id']) ,
                    'customer_id'=> Clean_Mypost($_POST['cust_id']) ,
                    'employee_id'=> Clean_Mypost($_POST['user_id']) ,
                    'des'=> Clean_Mypost($_POST['des'][$i]) ,
                    'amount'=> Clean_Mypost($_POST['val'][$i]) ,
                );
                if($ThIsIsTest == '1'){
                    print_r3($Invoce_Des_Data);
                }else{
                    $add_server = $db->AutoExecute("invoice_des",$Invoce_Des_Data,AUTO_INSERT);
                }
            }
        }
        

        $Invoce_Paid_Data = array ('id'=> NULL ,
            'ref'=> $Invoce_Ref ,
            'invoce_date'=> $Invoce_Date ,
            'date_d'=> date("d",$Invoce_Date),
            'date_m'=> date("m",$Invoce_Date),
            'date_y'=> date("Y",$Invoce_Date),
            'course_id'=> Clean_Mypost($_POST['course_id']) ,
            'customer_id'=> Clean_Mypost($_POST['cust_id']) ,
            'employee_id'=> Clean_Mypost($_POST['user_id']) ,
            'des'=> Clean_Mypost($_POST['amount_des']) ,
            'amount'=> Clean_Mypost($_POST['amount']) ,
            'amount_no'=> Clean_Mypost($_POST['amount_no']) ,
        );
        if($ThIsIsTest == '1'){
            print_r3($Invoce_Paid_Data);
        }else{
            $add_server = $db->AutoExecute("invoice_pay",$Invoce_Paid_Data,AUTO_INSERT);
        }
        
        
           /*
           CountCourse();
           EmployeeReport();
           CountCourseTotal();
           Redirect_Page_2('index.php?view=List');
      */ 

       AddContract_New($ThIsIsTest,$Invoce_Ref);
    }
 
}


function AddContract_New($ThisIsTest,$Invoce_Ref){
    global  $db ;
   // $ThisIsTest = '1' ;
    $ticket_id = $_POST['ticket_id'];
    $Contract_Date = FULLDate($_POST['invoce_date']);
    $Err =  CheckdateForLastdate($Contract_Date['Stamp']) ;  
    $_POST['des'] = $_POST['notes'];
   if($Err != '1'){
    $Ticket_Update = array ( 
    'state' =>  "3" ,
    'contract_s' =>  "1" ,
    'contract_date'=>  $Contract_Date['Stamp'] ,
    'contract_month'=> $Contract_Date['Month']."-".$Contract_Date['Year'],  
    'notes' =>  Clean_Mypost($_POST['des']) ,
    'date_time' =>  time(),
    'ref'=> $Invoce_Ref
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
?>