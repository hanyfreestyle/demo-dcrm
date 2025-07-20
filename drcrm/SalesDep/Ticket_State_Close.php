<script type="text/javascript">
var obj;
if(window.XMLHttpRequest)
{obj = new XMLHttpRequest();}
else if(window.ActiveXObject)
{obj = new ActiveXObject("MSXML2.XMLHTTP");}
function GetArchivesPhoto()
{
	document.getElementById('city').innerHTML = "<img src='../include/img/loading30.gif'>";
	var  close_ID = document.country_city.close_id.value;
	var url = 'Ticket_State_Close_Ajex.php?CloseId='+close_ID;
	if(obj) 
	{	
		obj.open("GET", url);
		obj.onreadystatechange = function()
		{
		if (obj.readyState == 4 && obj.status == 200) {
		document.getElementById('city').innerHTML = obj.responseText;
		}
		}
		obj.send(null);
	}
}
</script>
<?php
if(!defined('WEB_ROOT')) {	exit;}
 
###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);



 

$row = $db->H_CheckTheGet("id","id","sales_ticket","2");
$ThisTicketId = $row['id'];
$ThisCUstIDD =  $row['cust_id'];
 
 
if(($row['user_id'] == $RowUsreInfo['user_id'] or $AdminConfig['leads'] == '1' ) and $row['state'] == '2' ){ 

$Mass =  $AdminLangFile['close_ticket_mass_line_1']." ".$row['id'].BR; 
$Mass .= $AdminLangFile['close_ticket_mass_line_2']." ".GetNameFromID("customer",$row['cust_id'],"name").BR; 
$Mass .= $AdminLangFile['close_ticket_mass_line_3']; 

New_Print_Alert("4",$Mass);



$ArrForm = array('FormName'=> 'country_city');
Form_Open($ArrForm);
 
///hidden
echo '<input type="hidden" name="c_type" value="'.$row['c_type'].'" />';
echo '<input type="hidden" name="ticket_id" value="'.$ThisTicketId.'" />';
echo '<input type="hidden" name="cust_id" value="'.$ThisCUstIDD.'" />';
echo '<input type="hidden" name="follow_user_id" value="'.$RowUsreInfo['user_id'].'" />';
echo '<input type="hidden" name="follow_user_name" value="'.$RowUsreInfo['name'].'" />';
echo '<input type="hidden" name="ticket_date" value="'.$row['date_add'].'" />';
echo '<div style="clear: both!important;"></div>';


//$Err[] = NF_PrintSelect("FromArr_2",$AdminLangFile['close_ticket_close_type'],"col-md-4","close_id",$Close_Ticket_State_Arr,"req","0");

$Arr = array("StartFrom" => '1',"Label" => 'on' , 'Ajex_01'=> 'onchange="GetArchivesPhoto()"' );  
$Err[] = NF_PrintSelect_2018("ArrFrom",$AdminLangFile['close_ticket_close_type'],"col-md-4","close_id",$Close_Ticket_State_Arr,"req","0",$Arr);
 
 
 
if(isset($_POST['close_id'])){
echo '<div id="city">';   
$Cat_Id = $_POST['close_id'] ;
if($Cat_Id == '1'){
 $SubCat = '3' ;  
 $CatName = $AdminLangFile['close_ticket_c_type_3'] ;
}elseif($Cat_Id == '2'){
   $SubCat = '4' ;  
   $CatName = $AdminLangFile['close_ticket_c_type_4'] ;
}else{
   $CatName =  $AdminLangFile['close_ticket_close_type_err'] ;  
   $SubCat = '40000000' ;   
}

$Arr = array("Label" => 'on',"Active" => '0','Order'=> "order by count desc" , "Filter_Filde"=> "cat_id" , "Filter_Vall"=> $SubCat);      
$Err[] = NF_PrintSelect_2018("Chosen",$CatName,"col-md-3","c_type_2","f_cust_subtype","req",0,$Arr);

echo '</div>'  ; 
}else{
echo '<div id="city"></div>';    
}



echo '<div style="clear: both!important;"></div>';

$MoreS = array('Col' => "col-md-12",'Placeholder'=> "",'required' => 'required');
$Err[] = NF_PrintInput("TextArea",$AdminLangFile['close_ticket_close_des'],"des","1","0","req",$MoreS);




Form_Close_New("1","ViewTicket&id=".$row['id']);


if(isset($_POST['B1'])){
Vall($Err,"Close_Ticket",$db,"1",$USER_PERMATION_Edit);   
}            

}else{
echo '<div class="alert alert-danger alert-dismissable Arr_Mass">';
echo $AdminLangFile['mainform_no_user_per'];
echo '</div>';       
} 

###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();
?>

