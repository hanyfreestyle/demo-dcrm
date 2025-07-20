<script>
function findall() {
  var array = document.querySelectorAll('.cls');
  var total = 0;
  for (var i = 0; i < array.length; i++) {
    if (parseInt(array[i].value))
      total += parseInt(array[i].value);
  }
 // document.getElementById('TotalIvoice').value = total;
 $("#TotalIvoice").text(total.toFixed(2));
 var netprice = '0' ;
 var bla = $('.discount_val').val();
 netprice = total - bla ; 
 $("#NetIvoice").text(netprice.toFixed(2));
}

$(document).ready(function(){
    
    $(document).on('keyup', function(e){
    findall();
    });
    
});

$( document ).ready(function() {
    findall();
});
</script>

<style>
#TotalIvoice{
text-align:left;
font-size:40px;
}

#NetIvoice{
text-align:left;
font-size:40px;
color:#FF0000
}


.TotalList{
text-align:center!important;
font-size:30px;
}

.Total_pay{
color:#009900;
}

.Total_less{
color:#FF0000;
}





.ButHome{
padding-top:30px;
padding-bottom:30px;
text-decoration:none!important
}

.NoNO{
text-decoration:none!important
}

.NoNO .bg-info:hover{
background-color:#006699;
}
.xxx_uuu{
margin-bottom:10px;
}

.homename{
margin-top:10px;
font-size:12px;
}



.H_cityList{
text-align:right;

float:right;
}

/**/
.H_cityList .list-unstyled{
font-size:15px;

}

.list-unstyled span{
font-size:20px;
color:#FF0000
}

.xx_r{
float:right!important;
}

</style>
<?php

$Course_Info = $db->H_CheckTheGet("CourseID","id","course","2");
$Course_Id = $Course_Info['id'];


Print_CoursTInfo($Course_Info);


echo '<input type="hidden" value="'.$Course_Info['id'].'"  name="course_id"/>';
echo '<input type="hidden" value="'.$Course_Info['city_id'].'"  name="city_id"/>';
echo '<input type="hidden" value="'.$AdminLangFile['course_downpay'].'"  name="amount_des"/>';


echo '<div style="clear: both!important;"></div>'.BR.BR;
echo '<div class="col-md-6 col-sm-12 col-xs-12 form-group DirRight">';
$customer_name = GetNameFromID("customer",$row['cust_id'],"name");
PrintFildInformation("col-md-6",$AdminLangFile['customer_name'],$customer_name);


$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required');
$Err[] = NF_PrintInput("Date",$AdminLangFile['course_invoice_date'],"invoce_date","1","0","req",$MoreS); 
 
echo '<div style="clear: both!important;"></div>';



echo '<div class="col-md-8 col-sm-12 col-xs-12 form-group DirRight">';
echo '<label class="control-label"></label>';
echo '<input type="text" name="nodate" class="TypeText form-control Ar_Lang" value="'.$AdminLangFile['course_discount'].'" required readonly="" > ';
echo '</div>';

echo '<div class="col-md-4 col-sm-12 col-xs-12 form-group DirRight">';
echo '<label class="control-label"></label>';
echo '<input type="text" name="discount" class="TypeText form-control discount_val En_Lang" value="'.PostIsset('discount').'" required data-parsley-type="digits" data-parsley-minlength="1" > ';
echo '</div>';

echo '<div style="clear: both!important;"></div>';

echo '<h3 class="H3_FontAr NewH3">'.$AdminLangFile['course_net_price'].'</h3>';
echo '<div id="NetIvoice" class="col-md-12 col-sm-12 col-xs-12">';
echo $Course_Info['price'] ;
echo '</div>';


echo '<div style="clear: both!important;"></div>';


$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required data-parsley-type="digits" data-parsley-minlength="1"', 'Dir'=> "En_Lang" );
$ErrX[] = NF_PrintInput("Text",$AdminLangFile['course_downpay'],"amount","1","0","req-num",$MoreS);

$MoreS = array('Col' => "col-md-6",'Placeholder'=> "",'required' => 'required data-parsley-type="digits" data-parsley-minlength="1"', 'Dir'=> "En_Lang" );
$ErrX[] = NF_PrintInput("Text",$AdminLangFile['course_invo_payno'],"amount_no","1","0","req-num",$MoreS);




echo '</div>';




################################################################################################################################
################################ تفاصيل استمارة الحجز
################################################################################################################################


echo '<div class="col-md-6 col-sm-12 col-xs-12 form-group DirRight">';
echo '<h3 class="H3_FontAr NewH3">'.$AdminLangFile['course_invoce_des_h3'].'</h3>';

echo '<div class="col-md-8 col-sm-12 col-xs-12 form-group DirRight">';
echo '<label class="control-label"></label>';
echo '<input type="text" name="des[]" class="TypeText form-control Ar_Lang" value="'.$AdminLangFile['course_price_des'].'" required readonly="" > ';
echo '</div>';

if(isset($_POST['B1'])){
$Course_Info['price'] =  $_POST['val'][0]  ; 
}
echo '<div class="col-md-4 col-sm-12 col-xs-12 form-group DirRight">';
echo '<label class="control-label"></label>';
echo '<input type="text" name="val[]" class="TypeText form-control cls En_Lang" value="'.$Course_Info['price'].'" required data-parsley-type="digits" data-parsley-minlength="2" > ';
echo '</div>';



for ($i = 1; $i <= 3; $i++) {
if(isset($_POST['B1'])){
  $Dees =  $_POST['des'][$i] ;
 $Vall_XX = $_POST['val'][$i] ;
}else{
    $Dees =  "" ;
    $Vall_XX = "";
}
echo '<div class="col-md-8 col-sm-12 col-xs-12 form-group DirRight">';
echo '<label class="control-label"></label>';
///echo '<input type="text" name="des[]" class="TypeText form-control Ar_Lang" value="'.$_POST['des'][$i].'" > ';
echo '<input type="text" name="des[]" class="TypeText form-control Ar_Lang" value="'.$Dees.'" > ';
echo '</div>';

echo '<div class="col-md-4 col-sm-12 col-xs-12 form-group DirRight">';
echo '<label class="control-label"></label>';
//echo '<input type="text" name="val[]" class="TypeText cls form-control En_Lang" value="'.$_POST['val'][$i].'" data-parsley-type="digits" data-parsley-minlength="1" > ';
echo '<input type="text" name="val[]" class="TypeText cls form-control En_Lang" value="'.$Vall_XX.'" data-parsley-type="digits" data-parsley-minlength="1" > ';
echo '</div>'; 
}

echo '<h3 class="H3_FontAr NewH3">'.$AdminLangFile['course_total_invoce_h3'].'</h3>';
echo '<div id="TotalIvoice" class="col-md-12 col-sm-12 col-xs-12">';
echo $Course_Info['price'] ;
echo '</div>';


$MoreS = array('Col' => "col-md-12",'Placeholder'=> "",'required' => '');
$Err[] = NF_PrintInput("TextArea",$AdminLangFile['ticket_contract_des'],"notes","1","0","",$MoreS);

echo '</div>';




echo '<input type="hidden" name="follow_state" value="" />';
echo '<input type="hidden" name="follow_type" value="" />';
echo '<input type="hidden" name="follow_date" value="" />';    
echo '<input type="hidden" name="follow_time" value="" />';
    
    
    
    
?>