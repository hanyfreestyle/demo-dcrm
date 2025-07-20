<script>
$(document).ready(function() {
        $(".RemovIconForCalander").on("click", function(event) {
            var myid = $(this).attr('myid');
             $("#"+myid).val("");
        });
});
</script>
<?php
if(!defined('WEB_ROOT')) {	exit;}
 

######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);
if(!isset($_POST['B1'])){
UnsetAllSession('pro_id,last_date,name,total_price,reser_price,contract_price,monthly_price,monthly_des,st_date,end_date');
UnsetAllSession('g1,gd1,g2,gd2,g3,gd3,g4,gd4,g5,gd5,g6,gd6,unit_m_price');
UnsetAllSession('t1,tdes1,td1,t2,tdes2,td2,t3,tdes3,td3,t4,tdes4,td4,t5,tdes5,td5,t6,tdes6,td6,t7,tdes7,td7');
}


 


$row = $db->H_CheckTheGet("id","id","project_price","2");
$ProUrlId = $row['pro_id'];
extract($row);

$row['st_date'] = ConvertDateToCalender_3($row['st_date']);
$row['end_date'] = ConvertDateToCalender_3($row['end_date']);

echo '<div class="alert alert-info alert-dismissable Arr_Mass">';
echo $AdminLangFile['pro_price_last_update_d']." ".ConvertDateToCalender_2($row['last_date']).BR;


 
echo '</div>';


Form_Open($ArrForm);

$ProjectName = GetNameFromID("project",$pro_id,"name");
PrintFildInformation("col-md-3",$AdminLangFile['project_pro_name'],$ProjectName);
echo '<input type="hidden"  name="pro_id" value="'.$pro_id.'"/>';

$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => 'required ','Dir'=> "Ar_Lang");
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['pro_price_tabel_name'],"name","1","1","req",$MoreS);

$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => 'required', 'Dir'=> "En_Lang" );
$Err[] = NF_PrintInput("NumberEdit",$AdminLangFile['pro_price_total_price'],"total_price","1","0","req",$MoreS);

$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => 'required ', 'Dir'=> "En_Lang" );
$Err[] = NF_PrintInput("NumberEdit",$AdminLangFile['pro_price_price_for_m'],"unit_m_price","1","0","req",$MoreS);


echo '<div style="clear: both!important;"></div>';

$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => '', 'Dir'=> "En_Lang" );
$Err[] = NF_PrintInput("NumberEdit",$AdminLangFile['pro_price_reser_price'],"reser_price","0","0","optin",$MoreS);


$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => 'required', 'Dir'=> "En_Lang" );
$Err[] = NF_PrintInput("NumberEdit",$AdminLangFile['pro_price_contract_price'],"contract_price","1","0","req",$MoreS);


$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => 'required', 'Dir'=> "Ar_Lang" );
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['pro_price_monthly_des'],"monthly_des","1","0","req",$MoreS);



$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => 'required ', 'Dir'=> "En_Lang" );
$Err[] = NF_PrintInput("NumberEdit",$AdminLangFile['pro_price_monthly_price'],"monthly_price","1","0","req",$MoreS);

echo '<div style="clear: both!important;"></div>';

$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required');
$Err[] = NF_PrintInput("DateEdit",$AdminLangFile['pro_price_primary_receipt'],"st_date","0","0","req",$MoreS);

$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required');
$Err[] = NF_PrintInput("DateEdit",$AdminLangFile['pro_price_final_receipt'],"end_date","0","0","req",$MoreS);


echo '<div style="clear: both!important;"></div>';


echo '<div class="col-md-5 col-sm-12 col-xs-12 form-group DirRight">';
echo '<h3 class="H3_FontAr Sub_Titel">'.$AdminLangFile['pro_price_additional_services'].'</h3>';

$GD_Arr = unserialize($row['g_data']);


for ($i = 1; $i <= 6 ; $i++) {
    
$row['g'.$i] = $GD_Arr['g'.$i];
$row['gd'.$i] = $GD_Arr['gd'.$i];

if($row['gd'.$i] != ""){
$row['gd'.$i] = ConvertDateToCalender_3($row['gd'.$i]);    
}else{
$row['gd'.$i] = "";    
}
    
echo '<div style="clear: both!important;"></div>';
$MoreS = array('Col' => "col-md-5",'Placeholder'=> "",'required' => '', 'Dir'=> "En" );
$Err[] = NF_PrintInput("NumberEdit",$AdminLangFile["pro_price_g".$i],"g".$i,"0","0","option",$MoreS);

$MoreS = array('Col' => "col-md-7",'Placeholder'=> "",'required' => "" );

$Err[] = NF_PrintInput("DateEdit2",$AdminLangFile['pro_price_date'],"gd".$i,"0","0","option",$MoreS);

}
echo '</div>'; 


echo '<div class="col-md-7 col-sm-12 col-xs-12 form-group DirRight">';
echo '<h3 class="H3_FontAr Sub_Titel">'.$AdminLangFile['pro_price_payments_table'].'</h3>';

$TD_Arr = unserialize($row['t_data']);

for ($i = 1; $i <= 7; $i++) {

$row['t'.$i] = $TD_Arr['t'.$i];
$row['tdes'.$i] = $TD_Arr['tdes'.$i];
$row['td'.$i] = $TD_Arr['td'.$i];

if($row['td'.$i] != ""){
$row['td'.$i] = ConvertDateToCalender_3($row['td'.$i]);    
}else{
$row['td'.$i] = "";    
}
    

$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => '', 'Dir'=> "En_Lang" );
$Err[] = NF_PrintInput("NumberEdit",$AdminLangFile['pro_price_value']." ".$i,"t".$i,"0","0","option",$MoreS);

$MoreS = array('Col' => "col-md-5",'Placeholder'=> "",'required' => '', 'Dir'=> "Ar_Lang" );
$Err[] = NF_PrintInput("TextEdit",$AdminLangFile['pro_price_des'],"tdes".$i,"0","0","option",$MoreS);

$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => '');
$Err[] = NF_PrintInput("DateEdit2",$AdminLangFile['pro_price_date'],"td".$i,"0","0","option",$MoreS);

echo '<div style="clear: both!important;"></div>';

}


echo '</div>'; 
 
Form_Close_New("2","Price_List&Project_Id=".$ProUrlId);

   
if(isset($_POST['B1'])){

    
$ErrPost =  CheckF_FileReq("g1","gd1",$AdminLangFile['pro_price_g1']) ;
if($ErrPost['Err'] != '1'){ $ErrPost =  CheckF_FileReq("g2","gd2",$AdminLangFile['pro_price_g2']) ; }
if($ErrPost['Err'] != '1'){ $ErrPost =  CheckF_FileReq("g3","gd3",$AdminLangFile['pro_price_g3']) ; }
if($ErrPost['Err'] != '1'){ $ErrPost =  CheckF_FileReq("g4","gd4",$AdminLangFile['pro_price_g4']) ; }
if($ErrPost['Err'] != '1'){ $ErrPost =  CheckF_FileReq("g5","gd5",$AdminLangFile['pro_price_g5']) ; }
if($ErrPost['Err'] != '1'){ $ErrPost =  CheckF_FileReq("g6","gd6",$AdminLangFile['pro_price_g6']) ; }

if($ErrPost['Err'] != '1'){ $ErrPost =  CheckF_FileReq_2("t1","tdes1","td1",$AdminLangFile['pro_price_value']."1") ; }
if($ErrPost['Err'] != '1'){ $ErrPost =  CheckF_FileReq_2("t2","tdes2","td2",$AdminLangFile['pro_price_value']."2") ; }
if($ErrPost['Err'] != '1'){ $ErrPost =  CheckF_FileReq_2("t3","tdes3","td3",$AdminLangFile['pro_price_value']."3") ; }
if($ErrPost['Err'] != '1'){ $ErrPost =  CheckF_FileReq_2("t4","tdes4","td4",$AdminLangFile['pro_price_value']."4") ; }
if($ErrPost['Err'] != '1'){ $ErrPost =  CheckF_FileReq_2("t5","tdes5","td5",$AdminLangFile['pro_price_value']."5") ; }
if($ErrPost['Err'] != '1'){ $ErrPost =  CheckF_FileReq_2("t6","tdes6","td6",$AdminLangFile['pro_price_value']."6") ; }
if($ErrPost['Err'] != '1'){ $ErrPost =  CheckF_FileReq_2("t7","tdes7","td7",$AdminLangFile['pro_price_value']."7") ; }



if($ErrPost['Err'] == '1'){
SendJavaErrMass($ErrPost['Mass']);    
}else{
Vall($Err,"EditPrice_Tabel",$db,"1",$USER_PERMATION_Edit); 
}
 
    

  
}


######/<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<-----------------------------------------------
Close_Page();	
?>




 