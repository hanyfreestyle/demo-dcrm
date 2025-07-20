<?php
if(!defined('WEB_ROOT')) {	exit;}

###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);


echo '<div id="ErrMass" class="ErrMass_Div"></div>';
echo '<div style="clear: both!important;"></div>';
echo '<form class="FilterForm FilterFormStyle" method="POST" name="Filter" id="validate-form" data-parsley-validate >';


$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required ','Dir'=> "Ar_Lang");
$Err[] = NF_PrintInput("Text","رقم التذكرة","ticket_id","1","1","req",$MoreS);

echo '<div style="clear: both!important;"></div>';

echo '<div style="clear: both!important;"></div>';
echo '<div class="col-md-12 col-sm-12 col-xs-12 form-group">';
echo '<input type="submit" name="B1" class="ArButForm btn btn-default" value="'.$AdminLangFile['customer_search_but'].'" />';
echo '</div>';


echo '</form>';


if(isset($_POST['B1'])){
    $ticket_id = Clean_Mypost(intval($_POST['ticket_id'])) ;
 
    $THESQL = "SELECT * FROM sales_ticket WHERE id = '$ticket_id' "; 
    $already = $db->H_Total_Count($THESQL);
    if($already == '1'){
     
    $row = $db->H_SelectOneRow($THESQL);
   
    Diar_Print_Ticket_Search_Tabel($row);
     
     
        
    }else{
    Alert_NO_Content();     
    }
    
    
   
   
 
}

###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();







function Diar_Print_Ticket_Search_Tabel($row,$MyArr=array()){
    global $db;
    global $NamePrint ;
    global $ALang ;
    global $Button_TicketView_Arr ;
    $T_Ticket_State = $db->SelArr("SELECT id,name,name_en FROM fs_ticket_state");
 
 
 
 
        echo '<div style="clear: both!important;"></div>';
        New_Print_Alert("2","نتيجة البحث");


        echo '<table id="MyCustmerx" class="table table-striped table-bordered table-hover ArTabel ArTabel_55">';
        echo '<thead><tr>';
        Table_TH_Print('1',"ID","30");
        Table_TH_Print('1',$ALang['salesdep_date_add'],"100");
        Table_TH_Print('1',$ALang['salesdep_customer_information'],"150");
        
        if($row['state'] == '5' or $row['state']== '4' ){
        Table_TH_Print('1',$ALang['ticket_closing_date'],"100");    
        Table_TH_Print('1',$ALang['ticket_reason_for_closure'],"100");
        }
        
        
        Table_TH_Print('1',$ALang['customer_c_type_sub'],"100");
        Table_TH_Print('1',$ALang['salesdep_user_name'],"100");
        Table_TH_Print('1',$ALang['ticket_crunt_t_state'],"100");
        Table_TH_Print('1',"","30");
        echo '</tr>';
        echo '</thead>';
        echo '<tbody> ';


 
            $id = $row['id'];
          
            $C_type =  GetNameFromID("f_cust_type",$row['c_type'],$NamePrint) ;
            $C_type_2 =  GetNameFromID("f_cust_subtype",$row['c_type_2'],$NamePrint) ;
            $EmpnName =  GetNameFromID_User("tbl_user",$row['user_id'],"name") ;
            $CloseType =  GetNameFromID("fs_ticket_closed",$row['close_type'],$NamePrint) ;
           

            echo '<tr>';
            echo '<td>'.$row['id'].'</td>';
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
            Button_ListPage_TicketView($id,$Button_TicketView_Arr);
            echo '</tr>';
      
        echo '</tbody>';
        echo '</table>';
        echo '<div style="clear: both!important;"></div>';


   
}


 


?>