<?php
if(!defined('WEB_ROOT')) {	exit;}




#################################################################################################################################
###################################################    Get_Sales_Follow
#################################################################################################################################
function Get_Sales_Follow($Row){
    global $db ;
    global $RowUsreInfo ;
    global $AdminConfig;
    $Credentials_Add = "0";
    $Credentials_View = "0";
    if($AdminConfig['subercustserv'] == '1'){
        $Credentials_Add = "1"; $Credentials_View = "1";
    }elseif($AdminConfig['custservleader']== '1'){
        if($RowUsreInfo['user_follow'] != '' and $RowUsreInfo['user_follow'] != '0'){
            $ThisAccountFollow = unserialize($RowUsreInfo['user_follow']);
            //print_r3($ThisAccountFollow);
            $ThisAccountFollow_New = array();
            $Name = $db->SelArr("SELECT * FROM tbl_user where custserv = '1' ");
            for($i = 0; $i < count($Name); $i++) {
                $NewFolowUserIDD = $Name[$i]['user_id'] ;
                if (in_array($NewFolowUserIDD, $ThisAccountFollow)) {
                    $row_NewUSer = $db->H_SelectOneRow("select * from tbl_user where user_id = '$NewFolowUserIDD' ");
                    if($row_NewUSer['user_follow'] != '' and $row_NewUSer['user_follow'] != '0'){
                        $ThisAccountFollow_New_Add = unserialize($row_NewUSer['user_follow']);
                        // $ThisAccountFollow_New = $ThisAccountFollow_New + $ThisAccountFollow_New_Add ;
                        $ThisAccountFollow_New = array_merge($ThisAccountFollow_New,$ThisAccountFollow_New_Add);
                    }
                }
            }
            $ThisAccountFollow_New = array_merge($ThisAccountFollow_New,$ThisAccountFollow);
            $ThisAccountFollow_New = (array_unique($ThisAccountFollow_New));
            //print_r3($ThisAccountFollow_New);
            if (in_array($Row['user_id'], $ThisAccountFollow_New)) {
                $Credentials_Add = "1"; $Credentials_View = "1";
            }
        }
    }else{
        if($RowUsreInfo['user_follow'] != '' and $RowUsreInfo['user_follow'] != '0'){
            $ThisAccountFollow = unserialize($RowUsreInfo['user_follow']);
            if (in_array($Row['user_id'], $ThisAccountFollow)) {
                $Credentials_Add = "1"; $Credentials_View = "1";
            }
        }
    }
    return   $Credentials  = array('View'=> $Credentials_View ,'Add'=> $Credentials_Add );
}












#################################################################################################################################
###################################################   FormListBox_CustService
#################################################################################################################################
function FormListBox_CustService($Arr){
    global $AdminLangFile ;
    $Arr = array("Label" => 'on'  ,"OtherIdd"=>"user_id", "Filter_Filde"=> "group_id" , "Filter_Vall"=>$Arr['GroupCat'] );
    $Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['report_employee_name'],"col-md-3","emp_id","tbl_user","option",0,$Arr);
}







	
?>