<?php


#################################################################################################################################
###################################################    Keep_My_SQL_FromFilter
#################################################################################################################################
function Keep_My_SQL_FromFilter($THESQL,$SessionName,$MyArr=array()){
    $PostName_But = ArrIsset($MyArr,"ButName","B1_Fliter");
    if(!isset($_GET['page'])){
        unset($_SESSION[$SessionName]);
    }
    if(isset($_POST[$PostName_But])){
        $_SESSION[$SessionName] = $THESQL ;
    }else{
        if(isset($_SESSION[$SessionName])){
            $THESQL = $_SESSION[$SessionName] ;
        }
    }
    return  $THESQL ;
}



#################################################################################################################################
###################################################    GetSqlFilterForTicket
#################################################################################################################################
function GetSqlFilterForTicket($End_SQL_Line){

    $SQlLineY = "SELECT t.id,t.notes,t.date_add,t.date_time,";

    if(F_LEAD_TYPE == 1){
        $SQlLineY .= "lt.name as 'lead_type_ar',lt.name_en as 'lead_type_en',";
    }
    if(F_LEAD_SOURS == 1){
        $SQlLineY .= "ls.name as 'leadsours_ar',ls.name_en as 'leadsours_en' ,";
    }


    $SQlLineY .= "ct1.name as 'ctype_1_ar',ct1.name_en as 'ctype_1_en',";
    $SQlLineY .= "ct2.name as 'ctype_2_ar',ct2.name_en as 'ctype_2_en',";
    $SQlLineY .= "cust.name as 'cust_name', cust.mobile as 'cust_mobile', ";
    $SQlLineY .= "emp.name as 'emp_name'";

    $SQlLineY .= "FROM sales_ticket as t ";

    if(F_LEAD_TYPE == 1){
        $SQlLineY .= "LEFT JOIN fs_lead_type as lt ON t.lead_type = lt.id ";
    }
    if(F_LEAD_SOURS == 1){
        $SQlLineY .= "LEFT JOIN fs_lead_sours as ls ON t.lead_sours = ls.id ";
    }

    $SQlLineY .= "LEFT JOIN f_cust_type as ct1 ON t.c_type = ct1.id ";
    $SQlLineY .= "LEFT JOIN f_cust_subtype as ct2 ON t.c_type_2 = ct2.id ";
    $SQlLineY .= "LEFT JOIN customer as cust ON t.cust_id = cust.id ";
    $SQlLineY .= "LEFT JOIN tbl_user as emp ON t.user_id = emp.user_id ";

    $SQlLineY .= "where t.id != 0 $End_SQL_Line " ;

    return $SQlLineY ;
}

	
?>