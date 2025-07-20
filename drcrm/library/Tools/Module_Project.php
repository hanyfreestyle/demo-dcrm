<?php
if(!defined('WEB_ROOT')) {	exit;}
 


#################################################################################################################################
###################################################   PrintUnitBox
#################################################################################################################################
function PrintUnitBox($UnitCode){
    global $AdminLangFile ;
    if($UnitCode['avtive'] == '0'){
        $BackColor = 'bg-inverse'; 
        $TextPrint = $AdminLangFile['project_unit_state_unavtive']; 
        $Fa_Icon = "fa-exclamation-triangle";  
    }else{
        if($UnitCode['state'] == '0'){
            $BackColor = 'bg-default'; 
            $TextPrint = Rterun_UnitStateVall($UnitCode['state']); 
            $Fa_Icon = "fa-lock";    
            }elseif($UnitCode['state'] == '1'){
            $BackColor = 'bg-success'; 
            $TextPrint = Rterun_UnitStateVall($UnitCode['state']); 
            $Fa_Icon = "fa-thumbs-o-up";      
            }elseif($UnitCode['state'] == '2'){
            $BackColor = 'bg-warning';  
            $TextPrint = Rterun_UnitStateVall($UnitCode['state']); 
            $Fa_Icon = "fa-cogs";    
            }elseif($UnitCode['state'] == '3'){
            $BackColor = 'bg-danger';  
            $TextPrint = Rterun_UnitStateVall($UnitCode['state']); 
            $Fa_Icon = "fa-shopping-cart";      
        }
    }
    
    
    echo '<div class="panel widget widget_Units">';
    if($UnitCode['state'] == '1' or $UnitCode['state'] == '2' ){
    echo '<a href="Unit_PrintS.php?id='.$UnitCode['id'].'" target="_blank">';    
    }
    echo '<div class="panel-body '.$BackColor.' text-center">';
    echo '<div class="text-lg">'.$UnitCode['p_code']."-".$UnitCode['u_num'].'</div>';
    if($UnitCode['avtive'] != '0'){
     echo '<p class="AreaP">'.$UnitCode['u_area'].' M</p>';   
    }
   
    if($UnitCode['state'] == "3"){
    $CustName =  GetGustmerName($UnitCode) ;   
    echo '<p>'.$CustName.'</p>';        
    }else{
    echo '<p>'.$TextPrint.'</p>';   
    }
    
    echo '<em class="fa '.$Fa_Icon.' Fa_Style"></em>';
    echo '</div>';
    if($UnitCode['state'] == '1' or $UnitCode['state'] == '2' ){
    echo '</a>';    
    }
    echo '</div>';
    
    
}

#################################################################################################################################
###################################################   GetGustmerName 
#################################################################################################################################

function GetGustmerName($RowCome){
    global $db ;
    global $AdminPathHome ;
    
    $unit_id = $RowCome['id'];
    $pro_id = $RowCome['pro_id']; // 
    $CheSql = "select * from reservation where unit_id = '$unit_id' and  pro_id =  '$pro_id' and type = '2' and state != '1' " ;
    
    $already = $db->H_Total_Count($CheSql);
    if($already == '1'){
    
    $reservation = $db->H_SelectOneRow($CheSql);
    $CustIDD = $reservation['cust_id'];
    $CustRows = $db->H_SelectOneRow("select * from customer where id = '$CustIDD' ");
    
    
    $Full_Url = "Customer/index.php?view=Profile&id=" ;
    $Url =  $AdminPathHome.$Full_Url.$CustRows['id'] ;
    
    $CustName = '<div class="projectcustname"><a target="_blank"   href="'.$Url.'">'.$CustRows['name'].'</a></div>';   
    }else{
    $CustName = "Error".$already;    
    }
    
    return $CustName ;
}



#################################################################################################################################
################################################### PrintUnitBox_2  
#################################################################################################################################
function PrintUnitBox_2($UnitCode){
     global $AdminLangFile ;
    
    if($UnitCode['state'] == '0'){
        $BackColor = 'btn-default'; 
        $TextPrint = Rterun_UnitStateVall($UnitCode['state']); 
        $Fa_Icon = "fa-lock";    
    }elseif($UnitCode['state'] == '1'){
        $BackColor = 'btn-success'; 
        $TextPrint = Rterun_UnitStateVall($UnitCode['state']); 
        $Fa_Icon = "fa-thumbs-o-up";      
    }elseif($UnitCode['state'] == '2'){
        $BackColor = 'btn-warning';  
        $TextPrint = Rterun_UnitStateVall($UnitCode['state']); 
        $Fa_Icon = "fa-cogs";    
    }elseif($UnitCode['state'] == '3'){
        $BackColor = 'btn-danger';  
        $TextPrint = Rterun_UnitStateVall($UnitCode['state']); 
        $Fa_Icon = "fa-shopping-cart";      
    }
    
    $Time = NF_PrintBut_TD('4',$TextPrint,"#",$BackColor,$Fa_Icon);
    return $Time;
}

#################################################################################################################################
###################################################   Rterun_UnitStateVall
#################################################################################################################################
function Rterun_UnitStateVall($state) {
    global $AdminLangFile ;
     switch($state) {
       case "0":
         $Time =  $AdminLangFile['project_unit_state_0'];
         break;
       case "1":
         $Time =  $AdminLangFile['project_unit_state_1'];
         break;
       case "2":
         $Time =   $AdminLangFile['project_unit_state_2']; 
         break;
       case "3":
         $Time =  $AdminLangFile['project_unit_state_3'];
         break;
       default:
         $Time = "Errrr";
     }
   return $Time;
}


#################################################################################################################################
################################################### UpdateReservation  
#################################################################################################################################
function  UpdateReservation(){
    global $db ;
    $Today = strtotime(date("d-m-Y"));
    $Name = $db->SelArr("SELECT * FROM reservation where state = '0'");
    for($i = 0; $i < count($Name); $i++) {
    $Filde_Id = $Name[$i]['id'];
    if($Today >= $Name[$i]['end_date'] ){
    $server_data = array ('state' => '1' ); 
    $add_server = $db->AutoExecute("reservation",$server_data,AUTO_UPDATE,"id = '$Filde_Id' ");  
    } 
    } 
}

#################################################################################################################################
###################################################   CountDayes
#################################################################################################################################
function CountDayes($your_date){
$Today = strtotime(date("d-m-Y"));
$datediff = $Today - $your_date;
$Dayesss =  floor($datediff / (60 * 60 * 24));
if($Dayesss == '0'){
  $Dayesss = "التعاقد اليوم" ;  
}else{
 $Dayesss = $Dayesss . " يوم " ;   
}
 return $Dayesss;
}

#################################################################################################################################
###################################################   Reservation_State
#################################################################################################################################
function Reservation_State($state,$your_date) {
   switch($state) {
     case "0":
       $StatePrint = "الحجوزات المعلقة";
       break;
     case "1":
       $CountDayes = CountDayes($your_date);
       $StatePrint = "الحجوزات المتاخرة"." ".$CountDayes ;
       break;
     case "2":
      $StatePrint =  "الحجوزات المباعة";
       break;
     case "3":
      $StatePrint =  "الحجوزات الملغاة";
       break;
     default:
       $StatePrint = "";
   }
   return $StatePrint;
}

#################################################################################################################################
###################################################   Floor_State
#################################################################################################################################
function Floor_State($state) {
   switch($state) {
     case "0":
       $StatePrint = "الدور الارضى";
       break;
     case "1":
       $StatePrint = "الدور الاول" ;
       break;
     case "2":
      $StatePrint =  "الدور الثانى";
       break;
     case "3":
      $StatePrint =  "الدور الثالث";
       break;
     case "4":
      $StatePrint =  "الدور الرابع";
       break;
     case "5":
      $StatePrint =  "الدور الخامس";
       break;              
     default:
       $StatePrint = "";
   }
   return $StatePrint;
}
 
#################################################################################################################################
###################################################   Floor_State
#################################################################################################################################
 
$UnitCodeArr = array(
'1' => "A",
'2' => "B",
'3' => "C",
'4' => "D",
'5' => "E",
'6' => "F",
'7' => "G",
'8' => "H",
'9' => "J",
'10' => "K",
) ;

function Rterun_UnitCodeArr($state) {
     switch($state) {
       case "1":
         $Time =  "A";
         break;
       case "2":
         $Time =   "B" ;
         break;
       case "3":
         $Time =  "C";
         break;
       case "4":
         $Time =  "D";
         break;
       case "5":
         $Time =  "E";
         break;
       case "6":
         $Time =  "F";
         break;
       case "7":
         $Time =  "G";
         break;
       case "8":
         $Time =  "H" ;
         break;
       case "9":
         $Time = "J";
         break;
       case "10":
         $Time =  "K";
         break;

       default:
         $Time = "Errrr";
     }
   
   return $Time;
}  

$FloorCodeArr = array(
'1' => "1",
'2' => "2",
'3' => "3",
'4' => "4",
'5' => "5",
'6' => "6",
'7' => "7",
'8' => "8",
'9' => "9",
'10' => "10",
);


function Rterun_ProjectCruntS($state) {
    global $AdminLangFile ;
   switch($state) {
     case "0":
       $order = $AdminLangFile['project_crunt_0'];
       break;
     case "1":
       $order =  $AdminLangFile['project_crunt_1'];
       break;
     default:
       $order = "Err";
   }
   return $order;
 }
 $Close_Ticket_State_Arr = array(
//'1' => $AdminLangFile['close_ticket_close_type_1'],
'1' => $AdminLangFile['close_ticket_close_type_2'],
'2' => $AdminLangFile['close_ticket_close_type_3'],
) ; 

 
 
 

function Rterun_Ticket_State($state) {
    global $AdminLangFile ;
   switch($state) {
     case "0":
       $order = $AdminLangFile['report_ticket_state_0'];
       break;
     case "1":
       $order = $AdminLangFile['report_ticket_state_1'];
       break;
     default:
       $order = "Err";
   }
   return $order;
 }
 
 
 
$ReportPeriodArr = array(
'1' => $AdminLangFile['reportconfig_current_week'],
'2' => $AdminLangFile['reportconfig_current_month'],
); 
?>