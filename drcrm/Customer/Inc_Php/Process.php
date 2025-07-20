<?php
if(!defined('WEB_ROOT')) {	exit;}
 

#################################################################################################################################
###################################################    Customer_AddNew_Notes
#################################################################################################################################
function Customer_AddNew_Notes($db){
    $ThIsIsTest = '0';
    global $AdminLangFile ;
    $TabelName = 'customer_notes';
    $TAddDate = FULLDate_ForToday();
    $Cust_id = PostIsset("cust_id");
    
    $server_data = array ('id'=> NULL ,
        'date_add'=> $TAddDate['Stamp'] ,
        'date_time'=>  time() ,  
        'cust_id'=> PostIsset("cust_id"),
        'user_id'=> PostIsset("user_id"),
        'user_name'=> PostIsset("user_name"),
        'notes'=> PostIsset("des"),
    );
 
    if($ThIsIsTest == '1'){
        print_r3($server_data);
    }else{
        $add_server = $db->AutoExecute($TabelName,$server_data,AUTO_INSERT);
        Redirect_Page_2("index.php?view=Profile&id=".$Cust_id);
    }
}
#################################################################################################################################
###################################################   Print_Customer_Notes
#################################################################################################################################
function Print_Customer_Notes($Cust_Id){
    global $db;
    global $AdminLangFile ;
    global $USER_PERMATION_Dell ;
    
 
    $THESQL = "SELECT * FROM  customer_notes where cust_id = '$Cust_Id' order by id desc" ;
 
    $already = $db->H_Total_Count($THESQL);
    echo '<div style="clear: both!important;"></div>'.BR;   
    New_Print_Alert("2",$AdminLangFile['customer_tab_notes']);
    
    if($already > 0) {
        echo '<div style="clear: both!important;"></div>';

        echo '<table id="MyCustmerx" class="table table-striped table-bordered table-hover ArTabel ArTabel_55">';
        echo '<thead><tr>';
        Table_TH_Print('1',$AdminLangFile['salesdep_date_add'],"100");
        Table_TH_Print('1',$AdminLangFile['salesdep_user_name'],"100");
        Table_TH_Print('1',$AdminLangFile['customer_notes_des'],"300");
        Table_TH_Print($USER_PERMATION_Dell,"","30");
        echo '</tr>';
        echo '</thead>';
        echo '<tbody> ';
        $Name = $db->SelArr($THESQL);
        for($i = 0; $i < count($Name); $i++) {
            
        $id = $Name[$i]['id'];
        echo '<tr>';  
        echo '<td>'.PrintFullTime($Name[$i]['date_time']).'</td>';
        echo '<td>'.$Name[$i]['user_name'].'</td>';
        echo '<td>'.nl2br($Name[$i]['notes']).'</td>';
        Table_TD_Print_Option($USER_PERMATION_Dell,NF_PrintBut_TD('2',$AdminLangFile['mainform_delete'],"NotesDelete&id=".$id,"btn-danger","fa-window-close"),"C");
               
        echo '</tr>';
        }
        
        echo '</tbody>';
        echo '</table>';
        echo '<div style="clear: both!important;"></div>';
 
    }else{
     Alert_NO_Content();
      echo '<div style="clear: both!important;"></div>'.BR.BR.BR;   
    }
}








#################################################################################################################################
###################################################    Report_Block_Resulte
#################################################################################################################################
function Report_Block_Resulte($TotalCount){
    global $ALang ;
    global $db ;
    echo '<div style="clear: both!important;"></div>';
    $CountCustomer = $db-> H_Total_Count("SELECT id FROM customer ");
    ReportBlockPrint("col-md-3","اجمالى عدد العملاء",intval($CountCustomer),"fa-file-text","alert-info");
    ReportBlockPrint("col-md-3",$ALang['report_totalcount'],intval($TotalCount),"fa-filter","alert-warning");
    $Persent = intval(($TotalCount / $CountCustomer)*100);
    ReportBlockPrint("col-md-3","النسبة","% ".$Persent,"fa-eye","alert-success");
    echo '<div style="clear: both!important;"></div>';
}




?>