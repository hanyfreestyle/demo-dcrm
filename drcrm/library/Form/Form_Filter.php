<?php   
if(!defined('WEB_ROOT')) {	exit;}
 
/*
#################################################################################################################################
###################################################   Filter_Employee_From_POST
#################################################################################################################################
function Filter_Employee_From_POST($Val){
    global $AdminConfig ;
    if(intval($Val) == '0'){
        if($AdminConfig['leads']== '1'){
            $UserPerm = "" ;
        }else{
            $UserPerm = Filter_Employee_By_Permission();
        }
    }else{

        $UserPerm = " and user_id =". intval($Val)  ;
    }
    return  $UserPerm ;
}


#################################################################################################################################
###################################################   Filter_Employee_By_Permission
#################################################################################################################################
function Filter_Employee_By_Permission(){
    global $AdminConfig ;
    global $RowUsreInfo  ;

    if($AdminConfig['leads']== '1'){
        $UserPerm = " " ;
    }elseif( isset($AdminConfig['teamleader']) and  $AdminConfig['teamleader']== '1'){

        if($RowUsreInfo['user_follow'] != '' and $RowUsreInfo['user_follow'] != '0'){
            $ThisAccountFollow = unserialize($RowUsreInfo['user_follow']);
        }
        $UserPerm = GeThisAccountFollow_X($ThisAccountFollow);

    }else{
        $UserPerm = " and user_id = ". intval($RowUsreInfo['user_id'])  ;
    }
    return  $UserPerm ;
}

#################################################################################################################################
###################################################   GeThisAccountFollow_X
#################################################################################################################################
function GeThisAccountFollow_X($ThisAccountFollow){
    if(count($ThisAccountFollow) >= '1' ){
        $UserPer = " and ( ";
        for ($i = 0; $i < count($ThisAccountFollow); $i++) {
            if($i == '0'){
                $UserPer .= " user_id = ".$ThisAccountFollow[$i];
            }else{
                $UserPer .= " or user_id = ".$ThisAccountFollow[$i];
            }
        }
        $UserPer .= " )";
    }else{
        $UserPer = " and user_id = '0' ";
    }
    return  $UserPer ;
}
*/






?>