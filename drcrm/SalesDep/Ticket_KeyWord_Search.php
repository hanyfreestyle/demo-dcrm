<?php
if(!defined('WEB_ROOT')) {	exit;}

###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

/*
$sql= "select * from sales_ticket where id  = '19084' ";
$row_test = $db->H_SelectOneRow($sql);
print_r3($row_test);
*/



echo '<div id="ErrMass" class="ErrMass_Div"></div>';
echo '<div style="clear: both!important;"></div>';
echo '<form class="FilterForm FilterFormStyle" method="POST" name="Filter" id="validate-form" data-parsley-validate >';


$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required  data-parsley-minlength="4"','Dir'=> "Ar_Lang");
$Err[] = NF_PrintInput("Text","كلمة البحث","keyword","1","1","req",$MoreS);

echo '<div style="clear: both!important;"></div>';

echo '<div style="clear: both!important;"></div>';
echo '<div class="col-md-12 col-sm-12 col-xs-12 form-group">';
echo '<input type="submit" name="B1" class="ArButForm btn btn-default" value="'.$AdminLangFile['customer_search_but'].'" />';
echo '</div>';


echo '</form>';


if(isset($_POST['B1'])){
    $keyword = Clean_Mypost(trim($_POST['keyword'])) ;
 
    $THESQL = "SELECT id,des,cat_id FROM sales_ticket_des WHERE des like '%$keyword%' ORDER BY id DESC "; 
    $already = $db->H_Total_Count($THESQL);
    if($already > '0'){
        
echo '<div style="clear: both!important;"></div>'; 
ReportBlockPrint("col-md-3","عدد النتائج",intval($already),"fa-file-text","alert-info");
echo '<div style="clear: both!important;"></div>';

        
    Diar_Print_Ticket_Search_Tabel($THESQL);
    }else{
    Alert_NO_Content();     
    }
    
    
   
   
 
}

###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();







function Diar_Print_Ticket_Search_Tabel($THESQL,$MyArr=array()){
    global $db;
    global $Button_TicketView_Arr ;
    $Name = $db->SelArr($THESQL);  
    $keyword = $_POST['keyword'];
    $keyword_New = '<span style="color: red;">'.$_POST['keyword'].'</span>';
     
    
    
     
    /*
    global $NamePrint ;
    global $ALang ;
   
    $T_Ticket_State = $db->SelArr($THESQL);
 */
 

 
 
        echo '<div style="clear: both!important;"></div>';
        New_Print_Alert("2","نتيجة البحث");


        echo '<table id="MyCustmerx" class="table table-striped table-bordered table-hover ArTabel ArTabel_55">';
        echo '<thead><tr>';
        Table_TH_Print('1',"ID","30");
        Table_TH_Print('1',"نص المحادثة","200");
        /*
        
        
        Table_TH_Print('1',$ALang['salesdep_customer_information'],"150");
        
        if($row['state'] == '5' or $row['state']== '4' ){
        Table_TH_Print('1',$ALang['ticket_closing_date'],"100");    
        Table_TH_Print('1',$ALang['ticket_reason_for_closure'],"100");
        }
        
        
        Table_TH_Print('1',$ALang['customer_c_type_sub'],"100");
        Table_TH_Print('1',$ALang['salesdep_user_name'],"100");
        Table_TH_Print('1',$ALang['ticket_crunt_t_state'],"100");
        */
        Table_TH_Print('1',"","30");
        echo '</tr>';
        echo '</thead>';
        echo '<tbody> ';


 
 
           
for($i = 0; $i < count($Name); $i++) {
  
 $Name[$i]['des'] = str_replace($keyword,$keyword_New,$Name[$i]['des']);
        echo '<tr>';
            echo '<td>'.$Name[$i]['cat_id'].'</td>';
            echo '<td>'.$Name[$i]['des'].'</td>';
            /*
            echo '<td>'.ConvertDateToCalender_2($row['date_add']).'</td>';
                        
            echo '<td>';
            echo  PrintCustomerInformation($row['cust_id']);
            echo'</td>'; 
           
           
           if($row['state'] == '5' or $row['state']== '4'){
            echo '<td>'.ConvertDateToCalender_2($row['close_date']).'</td>';
            echo '<td>'.$CloseType.'</td>';
            }
            
            
            echo '<td>'.$C_type_2.'</td>';
            echo '<td>'.$EmpnName.'</td>';
            
     
           
            
            echo '<td>'.findValue_FromArr($T_Ticket_State,"id",$row['state'],$NamePrint).'</td>';
            */
            
             Button_ListPage_TicketView($Name[$i]['cat_id'],$Button_TicketView_Arr);
              
}            
            echo '</tr>';
     
        echo '</tbody>';
        echo '</table>';
        echo '<div style="clear: both!important;"></div>';


   
}


 


?>