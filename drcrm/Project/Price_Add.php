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

 

Form_Open($ArrForm);

$Arr = array("Label" => 'on',"Active" => '0');      
$Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['project_pro_name'],"col-md-3","pro_id","project","req",0,$Arr);	


$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => 'required ','Dir'=> "Ar_Lang");
$Err[] = NF_PrintInput("Text",$AdminLangFile['pro_price_tabel_name'],"name","1","1","req",$MoreS);

$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => 'required', 'Dir'=> "En_Lang" );
$Err[] = NF_PrintInput("Number",$AdminLangFile['pro_price_total_price'],"total_price","1","0","req",$MoreS);

$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => 'required ', 'Dir'=> "En_Lang" );
$Err[] = NF_PrintInput("Number",$AdminLangFile['pro_price_price_for_m'],"unit_m_price","1","0","req",$MoreS);



echo '<div style="clear: both!important;"></div>';

$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => '', 'Dir'=> "En_Lang" );
$Err[] = NF_PrintInput("Number",$AdminLangFile['pro_price_reser_price'],"reser_price","0","0","optin",$MoreS);

$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => 'required', 'Dir'=> "En_Lang" );
$Err[] = NF_PrintInput("Number",$AdminLangFile['pro_price_contract_price'],"contract_price","1","0","req",$MoreS);


$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => 'required', 'Dir'=> "Ar_Lang" );
$Err[] = NF_PrintInput("Text",$AdminLangFile['pro_price_monthly_des'],"monthly_des","1","0","req",$MoreS);



$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => 'required', 'Dir'=> "En_Lang" );
$Err[] = NF_PrintInput("Number",$AdminLangFile['pro_price_monthly_price'],"monthly_price","1","0","req",$MoreS);

echo '<div style="clear: both!important;"></div>';

$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required');
$Err[] = NF_PrintInput("Date",$AdminLangFile['pro_price_primary_receipt'],"st_date","0","0","req",$MoreS);

$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required');
$Err[] = NF_PrintInput("Date",$AdminLangFile['pro_price_final_receipt'],"end_date","0","0","req",$MoreS);


echo '<div style="clear: both!important;"></div>';


echo '<div class="col-md-5 col-sm-12 col-xs-12 form-group DirRight">';
echo '<h3 class="H3_FontAr Sub_Titel">'.$AdminLangFile['pro_price_additional_services'].'</h3>';

for ($i = 1; $i <= 6 ; $i++) {
    
echo '<div style="clear: both!important;"></div>';
$MoreS = array('Col' => "col-md-5",'Placeholder'=> "",'required' => '', 'Dir'=> "En_Lang" );
$Err[] = NF_PrintInput("Number",$AdminLangFile["pro_price_g".$i],"g".$i,"0","0","option",$MoreS);

$MoreS = array('Col' => "col-md-7",'Placeholder'=> "",'required' => "" );

$Err[] = NF_PrintInput("Date2",$AdminLangFile['pro_price_date'],"gd".$i,"0","0","option",$MoreS);

}
echo '</div>'; 



echo '<div class="col-md-7 col-sm-12 col-xs-12 form-group DirRight">';
echo '<h3 class="H3_FontAr Sub_Titel">'.$AdminLangFile['pro_price_payments_table'].'</h3>';


for ($i = 1; $i <= 7; $i++) {
    

$MoreS = array('Col' => "col-md-3",'Placeholder'=> "",'required' => '', 'Dir'=> "En_Lang" );
$Err[] = NF_PrintInput("Number",$AdminLangFile['pro_price_value']." ".$i,"t".$i,"0","0","option",$MoreS);

$MoreS = array('Col' => "col-md-5",'Placeholder'=> "",'required' => '', 'Dir'=> "Ar_Lang" );
$Err[] = NF_PrintInput("Text",$AdminLangFile['pro_price_des'],"tdes".$i,"0","0","option",$MoreS);

$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => '');
$Err[] = NF_PrintInput("Date2",$AdminLangFile['pro_price_date'],"td".$i,"0","0","option",$MoreS);

echo '<div style="clear: both!important;"></div>';

}


echo '</div>'; 


echo '<div style="clear: both!important;"></div>';

Form_Close_New("1","Price_List");



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
        Vall($Err,"AddPrice_Tabel",$db,"1",$USER_PERMATION_Add);
    }
}


######/<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<-----------------------------------------------
Close_Page();
?>
 