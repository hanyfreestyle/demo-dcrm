<?php
if(!defined('WEB_ROOT')) {	exit;}
###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

$THELINK = "view=TimeLine";
$Empty = '0'; 
#################################################################################################################################
###################################################    متابعات محدده بتوقيت
#################################################################################################################################
$THESQL = "SELECT * FROM sales_ticket where state = '2' and follow_time != '' and  follow_date =  $TodayIss  $UserPerm order by follow_time ASC"; 
$already = $db->H_Total_Count($THESQL);
if ($already > 0){
New_Print_Alert("5","متابعات محدده بتوقيت"); 
echo '<ul class="timeline">';
$Name = $db->SelArr($THESQL);
for($i = 0; $i < count($Name); $i++) {
PrintTimeLineBlock($i,$Name[$i]);
}
echo '</ul>'; 
$Empty = "1";  
}
 
 
echo '<div style="clear: both!important;"></div>';
#################################################################################################################################
###################################################   متابعات غير محدده بتوقيت
#################################################################################################################################
$THESQL = "SELECT * FROM sales_ticket where state = '2' and follow_time = '' and  follow_date =  $TodayIss  $UserPerm order by follow_time ASC";
$already = $db->H_Total_Count($THESQL);     
      
if ($already > 0){    
New_Print_Alert("5","متابعات غير محدده بتوقيت");     
echo '<ul class="timeline">';
$Name = $db->SelArr($THESQL);
for($i = 0; $i < count($Name); $i++) {
PrintTimeLineBlock($i,$Name[$i]);
}
echo '</ul>';
$Empty = "1";  
}


if($Empty == "0" ){
Alert_NO_Content();    
}


###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();	




function PrintTimeLineBlock($val,$row){
    global $db ;
    global $AdminLangFile ;
    $CustId = $row['cust_id'] ;
    
 
$CusyInfo = $db->H_SelectOneRow("select * from customer where id = '$CustId' ");
$BlockDir =  Check_Right_Left($val) ;
//warning
if($row['follow_time']!= ''){
$TimeS = date("h:i:s A", $row['follow_time']) ;
$IconColor =  Check_Bust_Co($row['follow_time']);
}else{
$Today =  strtotime('today 00:00:00');   
$TimeS = ConvertDateToCalender_2($Today); 
$IconColor = "warning";    
}

  
$EmpnName =  GetNameFromID_User('tbl_user',$row['user_id'],"name");    

echo '<li class="'.$BlockDir['Dir'].'">';
echo '<div class="timeline-badge '.$IconColor.'"><em class="fa fa-phone"></em></div>';   

echo '<div class="timeline-panel">';
echo '<div class="popover '.$BlockDir['Arr'].'">';
echo '<div class="arrow"></div>';


echo '<div class="popover-content">';
echo '<div class="CallTime DufDiv">';

echo '<div class="TimeTamp">'.$TimeS.'</div>';    
 
echo '<div class="EmpName">'.$EmpnName.'</div>';
echo '</div>';

echo '<div class="TCustinfo DufDiv">';
echo  $CusyInfo['name'].BR;
echo  $CusyInfo['mobile'].BR;
if(isset($CusyInfo['mobile_2']) and $CusyInfo['mobile_2'] != "" ){
 echo  $CusyInfo['mobile_2'].BR;   
}
echo '</div>';    

echo '<div class="TNotes">';
echo $row['notes'];
echo '</div>';

echo '<div class="TView_but">';
echo  NF_PrintBut_TD('1',$AdminLangFile['salesdep_view_but'],"ViewTicket&id=".$row['id'],"btn-info XTT","fa-search");
echo '</div>';
   
echo '</div></div></div></li>';

}



function Check_Right_Left($val){
    if( $val % 2 == 0 ){
        $Dir = "  ";
        $Arr = " left ";
    }else{
        $Dir = " timeline-inverted ";
        $Arr = " right ";
    }
    return array("Dir"=>$Dir ,"Arr"=>$Arr) ;
}


function Check_Bust_Co($val){
   $co = "";
   
   $SNow = time();
   if($SNow > $val ){
    $co = "danger";
   }else{
    $co = "success";
   }
   
   return $co ; 
}   

 

?>



