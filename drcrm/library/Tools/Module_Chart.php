<?php
if(!defined('WEB_ROOT')) {	exit;}
 

#################################################################################################################################
###################################################   CustmerSqlFiterLine
#################################################################################################################################
function  CustmerSqlFiterLine(){
  $End_SQL_Line = " "  ;

  if(isset($_POST['date_from'])){
      $End_SQL_Line .= CustmerSqlFiterLineFromPost_Date($_POST['date_from'],"date_add","From");
  }

  if(isset($_POST['date_to'])){
      $End_SQL_Line .= CustmerSqlFiterLineFromPost_Date($_POST['date_to'],"date_add","To");
  }

  $End_SQL_Line .= CustmerSqlFiterLineFromPost_2018("user_id","user_id");
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_2018("ticket_state","state");
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_2018("ticket_cust","ticket_cust");
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_2018("lead_cat","lead_cat");
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_2018('cust_type',"c_type");
  if(isset($_POST['cust_type']) AND intval($_POST['cust_type'])!= '0'){
      $End_SQL_Line .= CustmerSqlFiterLineFromPost_2018("cust_type_2","c_type_2");
  }

  $End_SQL_Line .= CustmerSqlFiterLineFromPost_2018('lead_type',"lead_type");
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_2018("lead_sours","lead_sours");
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_2018('jop_id',"jop_id");
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_2018('kind_id',"kind_id");
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_2018('religion',"religion");
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_2018('social_id',"social_id");
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_2018('live_id',"live_id");
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_2018('country_id',"country_id");
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_2018('countrylive_id',"countrylive_id");
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_2018('city_id',"city_id");
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_2018('cash_id',"cash_id");
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_2018('date_id',"date_id");
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_2018('area_id',"area_id");
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_2018('unit_id',"unit_id");
  if(isset($_POST['pro_area'])){
      $End_SQL_Line .= CustmerSqlFiterLineFromPostAsLike($_POST['pro_area'],"pro_area");
  }


  return $End_SQL_Line ;
    
}


function  CustmerSqlFiterLine_ForVisits(){
  $End_SQL_Line = " "  ;
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_2018("user_id","user_id"); 
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_2018('ticket_state',"state");
  
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_2018('ticket_cust',"ticket_cust"); 
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_2018('lead_cat',"lead_cat"); 
  
  
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_2018("cust_type","c_type"); 
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_2018('cust_type_2',"c_type_2"); 
  
  
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_2018('lead_type',"lead_type");   
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_2018('lead_sours',"lead_sours");   
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_2018('jop_id',"jop_id");  
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_2018('kind_id',"kind_id");  
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_2018('social_id',"social_id");  
  
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_2018('live_id',"live_id");  
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_2018('country_id',"country_id");  
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_2018('countrylive_id',"countrylive_id");  
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_2018('city_id',"city_id");  

  $End_SQL_Line .= CustmerSqlFiterLineFromPost_2018('cash_id',"cash_id");  
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_2018('date_id',"date_id");  
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_2018('area_id',"area_id");  
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_2018('unit_id',"unit_id"); 

  if(isset($_POST['pro_area'])){
      $End_SQL_Line .= CustmerSqlFiterLineFromPostAsLike($_POST['pro_area'],"pro_area");
  }
  return $End_SQL_Line ;
    
}

#################################################################################################################################
###################################################   CountDayForLoop
#################################################################################################################################
function CountDayForLoop($start_date,$end_date){
    $Def = $end_date - $start_date  ;
    if($Def == '0'){
     $countday = '1' ;  
    }else{
      $countday = ($Def / 86400)+1 ;  
    }
   $countday =  round($countday);
    
return $countday ;
}


function CountDayForLoop_Confirm($start_date,$end_date){
    $start_date = strtotime($start_date); 
    $end_date =  strtotime($end_date); 

$Def = $end_date - $start_date  ;
    if($Def == '0'){
     $countday = '1' ;  
    }else{
      $countday = ($Def / 86400)+1 ;  
    }
return $countday ;
}




#################################################################################################################################
###################################################   OtherSqlFiterLine
#################################################################################################################################
function  OtherSqlFiterLine($Filed){
  $End_SQL_Line = " "  ;
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_Date($_POST['date_from'],$Filed,"From"); 
  $End_SQL_Line .= CustmerSqlFiterLineFromPost_Date($_POST['date_to'],$Filed,"To");  
  $End_SQL_Line .= CustmerSqlFiterLineFromPost($_POST['user_id'],"user_id"); 
  return $End_SQL_Line ;
}


#################################################################################################################################
###################################################   ReportBlockPrint
#################################################################################################################################
function ReportBlockPrint($Col,$Titel,$Vall,$Icon="",$Color="bg-danger"){
echo '<div class="'.$Col.' report_widget">';
echo '<div class="panel widget">';
echo '<div class="row row-table row-flush">';
if($Icon){
echo '<div class="col-xs-4 '.$Color.' text-center">';
echo '<em class="fa '.$Icon.' fa-2x"></em>';
echo '</div>';  
$textCol = 'col-xs-8';  
}else{
$textCol = 'col-xs-12';      
}
echo '<div class="'.$textCol.'">';
echo '<div class="panel-body text-center">';
echo '<h4 class="mt0">'.$Vall.'</h4>';
echo '<p class="mb0 text-muted">'.$Titel.'</p>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';
echo '</div>';
}


#################################################################################################################################
###################################################   GetSendArrToChart
#################################################################################################################################
function GetSendArrToChart($SellTabel,$SellFiled,$MasterT,$MasterTFilterFiled,$MasterTFilterFiledValue,$MasterTSellFiled  ){
    global $db ;
    $Name = $db->SelArr("SELECT * FROM $SellTabel where $SellFiled  != '0' ");
    $EndArr = array();
    for($i = 0; $i < count($Name); $i++) {
    $ThisId = $Name[$i]['id'] ;
    $SubCount = mysql_num_rows(mysql_query("SELECT id FROM $MasterT where $MasterTFilterFiled = $MasterTFilterFiledValue
      and  $MasterTSellFiled = $ThisId "));
        if($SubCount != '0') {
              $NewVall =  array ('name'=> $Name[$i]['name'] , 'count'=> $SubCount);
            array_push($EndArr,$NewVall);
        }
    }
    $EndArr = array_sort($EndArr, 'count', SORT_DESC);
    return $EndArr ;
}


#################################################################################################################################
###################################################   CharPrintArr
#################################################################################################################################
function CharPrintArr($Col,$ItamID,$Titel,$Arr,$Collapse="1"){
            global $db ;
            global $AdminLangFile ;
echo '<div class="'.$Col.' col-sm-12 col-xs-12 ChartRight">';
if($Collapse == '1'){
echo '<div class="panel panel-default"><div class="panel-heading">';
echo '<a href="#" data-perform="panel-collapse" data-toggle="tooltip" title="Collapse Panel" class="pull-right"><em class="fa fa-minus"></em></a>';
echo '<div class="panel-title">'.$Titel.'</div>';
echo '</div>';
echo '<div class="panel-collapse">';
echo '<div class="panel-body">';    
}else{
echo '<div class="ChartTitle">'.$Titel.'</div>';    
}
////////////
echo '<div class="My_Chart_Container ">';
echo '<div id="'.$ItamID.'" class="placeholder"></div>';
echo '</div>';
echo '<div class="My_Chart_Legend '. $ItamID .'" ></div>';
///////////
if($Collapse == '1'){ 
echo '</div>';
echo '</div>';
echo '</div> ';
}
echo '</div>';
?>  
<script type="text/javascript">
$(function() {
        var data = [
<?php
//$Arr = array("Tabel"=>"f_cust_type","Filde"=>"count","LIMIT"=>"5",  );
$Tabel = $Arr['Tabel'];
$Name =  $Tabel ;
if(isset($Arr['Filde'])){ $Filde = $Arr['Filde'];}
if(isset($Arr['MasterTabel'])){ $MasterTabel = $Arr['MasterTabel'];}
if(isset($Arr['MasterFilde'])){ $MasterFilde = $Arr['MasterFilde'];}

$LIMIT = $Arr['LIMIT'];


$TotalCount = $Arr['TotalCount'];
if(count($Name) < $LIMIT){
 $LIMIT = count($Name)  ;   
} 
$EndCount = "0" ;
for($i = 0; $i < $LIMIT ; $i++) {
$Percent_V = ($Name[$i]['count']/$TotalCount)*100 ;  
$EndCount = $EndCount+$Name[$i]['count'];  
$Percent_V = round($Percent_V, 0);
$Percent = '('. $Percent_V .'%)'; 
$LabelPrint = $Name[$i]['name']." ".$Name[$i]['count']." ".$Percent;
if($Name[$i]['id'] == '0'){
echo '{ label: "'.$LabelPrint.'", color:"#ff0000", data: '.$Percent_V.'},' ;     
}else{
echo '{ label: "'.$LabelPrint.'",   data: '.$Percent_V.'},' ;     
}
} 
$OtherVall = $TotalCount-($EndCount) ;
if($OtherVall != '0' ){
$Percent_V = ($OtherVall/$TotalCount)*100 ;    
$Percent_V = round($Percent_V, 0);
$Percent = '('. $Percent_V .'%)'; 
$LabelPrint = $AdminLangFile['report_other_vall']." ".$OtherVall." ".$Percent;
echo '{ label: "'.$LabelPrint.'", color:"#303dd5",  data: '.$Percent_V.'},' ;       
}
?>       
];
var placeholder = $("#<?php echo $ItamID ?>");
    $.plot(placeholder, data, {
        colors: ["#b2d766", "#ff8154", "#878bb8",  "#ffe989", "#4ac9b4"],
        series: {
            pie: {
                    show: true,
                    radius: 1,
                    innerRadius: 0.5,
                label: {
                    show: true,
                    radius: 3/4,
                    formatter: labelFormatter,
                    background: {
                    opacity: 0.8,
                    color: '#000'
                    }
                }
            }
        },
        legend: {
            show: true,
            container: ".<?php echo $ItamID ?>",
        }
    });
});
function labelFormatter(label, series) {
return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>" + Math.round(series.percent) + "%</div>";
}
</script>
<?php 
}


#################################################################################################################################
###################################################   ChartNewPrint
#################################################################################################################################
function ChartNewPrint($Col,$ItamID,$Titel,$Arr,$Collapse="1"){
            global $db ;
            global $AdminLangFile ;
echo '<div class="'.$Col.' col-sm-12 col-xs-12 ChartRight">';
if($Collapse == '1'){
echo '<div class="panel panel-default"><div class="panel-heading">';
echo '<a href="#" data-perform="panel-collapse" data-toggle="tooltip" title="Collapse Panel" class="pull-right"><em class="fa fa-minus"></em></a>';
echo '<div class="panel-title">'.$Titel.'</div>';
echo '</div>';
echo '<div class="panel-collapse">';
echo '<div class="panel-body">';    
}else{
echo '<div class="ChartTitle">'.$Titel.'</div>';    
}
////////////
echo '<div class="My_Chart_Container ">';
echo '<div id="'.$ItamID.'" class="placeholder"></div>';
echo '</div>';
echo '<div class="My_Chart_Legend '. $ItamID .'" ></div>';
///////////
if($Collapse == '1'){ 
echo '</div>';
echo '</div>';
echo '</div> ';
}
echo '</div>';
?>  
<script type="text/javascript">
$(function() {
        var data = [
<?php
//$Arr = array("Tabel"=>"f_cust_type","Filde"=>"count","LIMIT"=>"5",  );
$Tabel = $Arr['Tabel'];
$Filde = $Arr['Filde'];
$LIMIT = $Arr['LIMIT'];
$MasterTabel = $Arr['MasterTabel'];
$MasterFilde = $Arr['MasterFilde'];
$TotalCount = $Arr['TotalCount'];
if($Arr['Type'] == 'TabelList'){
$Name = $db->SelArr("SELECT * FROM $Tabel order by $Filde desc LIMIT $LIMIT ");	    
}elseif($Arr['Type'] == 'SendArr'){
$Name =  $Tabel ; 
}
if(count($Name) < $LIMIT){
 $LIMIT = count($Name)  ;   
} 
$EndCount = "0" ;
for($i = 0; $i < $LIMIT ; $i++) {
$Percent_V = ($Name[$i][$Filde]/$TotalCount)*100 ;  
$EndCount = $EndCount+$Name[$i][$Filde ];  
$Percent_V = round($Percent_V, 0);
$Percent = '('. $Percent_V .'%)'; 
$LabelPrint = $Name[$i]['name']." ".$Name[$i][$Filde]." ".$Percent;
echo '{ label: "'.$LabelPrint.'",  data: '.$Percent_V.'},' ;   
} 
if($MasterTabel){
if($Arr['Type'] == 'TabelList'){    
$already = mysql_num_rows(mysql_query("SELECT id FROM $MasterTabel WHERE $MasterFilde = '0'"));
}elseif($Arr['Type'] == 'SendArr'){
$MasterTabelFilter = $Arr['MasterTabelFilter']; 
$MasterTabelFilterVall = $Arr['MasterTabelFilterVall'];         
$already = mysql_num_rows(mysql_query("SELECT id FROM $MasterTabel WHERE $MasterFilde = '0' and $MasterTabelFilter = $MasterTabelFilterVall "));    
}    
if($already > '0'){
$Percent_V = ($already/$TotalCount)*100 ;    
$Percent_V = round($Percent_V, 0);
$Percent = '('. $Percent_V .'%)'; 
$LabelPrint = $AdminLangFile['customer_unknow_vall']." ".$already." ".$Percent;
echo '{ label: "'.$LabelPrint.'", color:"#ff0000",  data: '.$Percent_V.'},' ;     
}    
}
$OtherVall = $TotalCount-($EndCount+$already) ;
if($OtherVall != '0' ){
$Percent_V = ($OtherVall/$TotalCount)*100 ;    
$Percent_V = round($Percent_V, 0);
$Percent = '('. $Percent_V .'%)'; 
$LabelPrint = $AdminLangFile['customer_other_vall']." ".$OtherVall." ".$Percent;
echo '{ label: "'.$LabelPrint.'", color:"#303dd5",  data: '.$Percent_V.'},' ;       
}
?>       
];
var placeholder = $("#<?php echo $ItamID ?>");
    $.plot(placeholder, data, {
        colors: ["#b2d766", "#ff8154", "#878bb8",  "#ffe989", "#4ac9b4"],
        series: {
            pie: {
                    show: true,
                    radius: 1,
                    innerRadius: 0.5,
                label: {
                    show: true,
                    radius: 3/4,
                    formatter: labelFormatter,
                    background: {
                    opacity: 0.8,
                    color: '#000'
                    }
                }
            }
        },
        legend: {
            show: true,
            container: ".<?php echo $ItamID ?>",
        }
    });
});
function labelFormatter(label, series) {
return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>" + Math.round(series.percent) + "%</div>";
}
</script>
<?php 
}

#################################################################################################################################
###################################################   
#################################################################################################################################


#################################################################################################################################
###################################################    Chart30_One_Arr
#################################################################################################################################
function Chart30_One_Arr($Arr){
  global $RowUsreInfo ; 
  $ThSisUser = "user_".$RowUsreInfo['user_id'] ;     
   $Arr_NewTickets = array();
   $Count_Ticket =  array(
     'label' => $Arr['Label']." ". $Arr['Total'],
     'color' => $Arr['Color'] ,
     'data' => $Arr['M_Send'],
    );
    array_push($Arr_NewTickets,$Count_Ticket);  
    $jsonFile = 'json/'.$ThSisUser.'_'.$Arr['F_Name'].'.json' ; 
    $fp = fopen($jsonFile, 'w');
    fwrite($fp, json_encode($Arr_NewTickets));
    fclose($fp);  
    
    return array('jsonFile'=> $jsonFile,'Total'=> $Arr['Total'],'Data'=> $Count_Ticket );  
}

#################################################################################################################################
###################################################    Chart30_View
#################################################################################################################################
function Chart30_View($JsonFile){
echo '<div class="row">';
echo '<div class="col-lg-12">';
echo '<div data-source="'.$JsonFile.'" class="chart-line flot-chart"></div>';
//echo '<div data-source="json/'.$ThSisUser.'_new_tickets.json" class="chart-line flot-chart"></div>';
echo '</div>';
echo '</div>';
echo '<div style="clear: both!important;"></div>'.BR.BR; 
    
}
#################################################################################################################################
###################################################    Chart30_View_All
#################################################################################################################################
function Chart30_View_All($GetArr,$Name){
  global $RowUsreInfo ; 
  $ThSisUser = "user_".$RowUsreInfo['user_id'] ;  
    
    $jsonFile = 'json/'.$ThSisUser.'_'.$Name.'.json' ; 
    $fp = fopen($jsonFile, 'w');
    fwrite($fp, json_encode($GetArr));
    fclose($fp);       
      
echo '<div class="row">';
echo '<div class="col-lg-12">';
echo '<div data-source="'.$jsonFile.'" class="chart-line flot-chart"></div>';
//echo '<div data-source="json/'.$ThSisUser.'_new_tickets.json" class="chart-line flot-chart"></div>';
echo '</div>';
echo '</div>';
echo '<div style="clear: both!important;"></div>'.BR.BR; 
    
}



	
?>