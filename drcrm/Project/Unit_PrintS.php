<?php

require_once '../include/inc_reqfile.php';
$AdminConfig = checkUser();
$ThIsIsTest = '0';


 
$row_unit = $db->H_CheckTheGet("id","id","project_unit","2");
$UnitId = $row_unit['id'];


$PriceIdd = $row_unit['price_id'] ; 

if($row_unit['state'] == '1' or $row_unit['state'] == '2' ){

$ThisProJectCode = $row_unit['pro_id'] ;



$sql_project = "SELECT * FROM project where id = '$ThisProJectCode'";
$row_project = $db->H_SelectOneRow($sql_project);


 


$sql_price = "SELECT * FROM project_price where id = '$PriceIdd'";
$row_price = $db->H_SelectOneRow($sql_price);
 
if($row_price['reser_price']){
$Reser_price = number_format($row_price['reser_price'])." ".$AdminLangFile['pdf_eg_p'];  
}else{
$Reser_price = "-"   ; 
}

$PriceListT = unserialize($row_price['t_data']);
$GDate = unserialize($row_price['g_data']);

//<div class="logo_header"><img src="Pdf_Style/Logo.png" /></div>



$html = '';
$html .= '<p>'.$AdminLangFile['pdf_prject_name']." ".$row_project['name'].'</p>';
$html .= '

<table class="info_t">
<tr>
<td class="info_b_d al_r w_25">'.$AdminLangFile['pdf_u_code'].'</td>
<td class="al_c w_25 ff_info" >'.$row_project['pro_code'].$row_unit['p_code'].'</td>
<td class="info_b_d al_r w_25">'.$AdminLangFile['pdf_total_price'].'</td>
<td class="al_c w_25 ff_info" >'.number_format($row_price['total_price'])." ".$AdminLangFile['pdf_eg_p'].'</td>
</tr>

<tr>
<td class="info_b_d">'.$AdminLangFile['pdf_u_type'].'</td>
<td class="al_c w_25 ff_info" >'.$row_unit['type'].'</td>
<td class="info_b_d">'.$AdminLangFile['pdf_meter_price'].'</td>
<td class="al_c w_25 ff_info" >'.number_format($row_price['unit_m_price'])." ".$AdminLangFile['pdf_eg_p'].'</td>
</tr>

<tr>
<td class="info_b_d">'.$AdminLangFile['pdf_u_floor'].'</td>
<td class="al_c w_25 ff_info" >'.GetNameFromID("project_floor",$row_unit['floor_id'],"name").'</td>
<td class="info_b_d">'.$AdminLangFile['pdf_hakz_price'].'</td>
<td class="al_c w_25 ff_info" >'.$Reser_price.'</td>
</tr>
<tr>

<td class="info_b_d">'.$AdminLangFile['pdf_u_area'].'</td>
<td class="al_c w_25 ff_info" >'.$row_unit['u_area']." ".$AdminLangFile['pdf_mm'].'</td>
<td class="info_b_d">'.$AdminLangFile['pdf_taakod_price'].'</td>
<td class="al_c w_25 ff_info" >'.number_format($row_price['contract_price'])." ".$AdminLangFile['pdf_eg_p'].'</td>
</tr>';

if($row_unit['g_area'] != '0'){
$html .= '<tr>
<td class="info_b_d">'.$AdminLangFile['pdf_g_area'].'</td>
<td class="al_c w_25 ff_info" >'.$row_unit['g_area']." ".$AdminLangFile['pdf_mm'].'</td>
</tr>';
}
$html .= '</table><br/>';





if($PriceListT['t1'] == '' and $PriceListT['t2'] == '' and $PriceListT['t3'] == '' and  $PriceListT['t4'] == '' 
and $PriceListT['t5'] == '' and $PriceListT['t6'] == '' and $PriceListT['t7'] == '' ){
    
    
}else{

$html .= '
<table class="info_pricelist">
<tr><th colspan="3" class="info_t_h al_c">'.$AdminLangFile['pdf_payments'].'</th></tr>
<tr>
<td class="info_b_d al_c w_25">'.$AdminLangFile['pdf_value'].'</td>
<td class="info_b_d al_c w_50">'.$AdminLangFile['pdf_pay_des'].'</td>
<td class="info_b_d al_c w_25">'.$AdminLangFile['pdf_date_pay'].'</td>
</tr>';
for ($i = 1; $i <= 7; $i++) {  
if($PriceListT['t'.$i]){
$html .= '<tr>
    <td class="al_c " >'.number_format($PriceListT['t'.$i])." ".$AdminLangFile['pdf_eg_p'].'</td>
    <td>'.$PriceListT['tdes'.$i].'</td>
    <td class="al_c " >'.ConvertDateToCalender_4($PriceListT['td'.$i]).'</td>
  </tr>';    
}    
}
$html .= '</table><br/>';
} 




$html .= '<table class="info_pricelist">
<tr><th colspan="2" class="info_t_h al_c">'.$AdminLangFile['pdf_monthly_01'].'</th></tr>
<tr>
<td class="info_b_d al_c w_50">'.$AdminLangFile['pdf_monthly_02'].'</td>
<td class="info_b_d al_c w_50">'.$AdminLangFile['pdf_monthly_03'].'</td>
</tr>';
$html .= '<tr>
    <td class="al_c w_50 oneLine" >'.number_format($row_price['monthly_price'])." ".$AdminLangFile['pdf_eg_p'].'</td>
    <td class="al_c w_50 oneLine" >'.($row_price['monthly_des']).'</td>
    
  </tr>'; 
$html .= '</table><br/>';



if($GDate['g1'] == '' and  $GDate['g2'] == '' ){
    
}else{
    
   

$garage_total = $GDate['g1'] + $GDate['g2'] ;
$garage_total = number_format($garage_total)." ".$AdminLangFile['pdf_eg_p'] ;
$html .= '<table class="info_pricelist">
<tr><th class="info_t_h al_c">'.$AdminLangFile['pdf_garage_total'].'</th>
<th class="info_t_h al_c">'.$garage_total .'</th>
</tr>
<tr>
<td class="info_b_d al_c w_50">'.$AdminLangFile['pdf_value'].'</td>
<td class="info_b_d al_c w_50">'.$AdminLangFile['pdf_date_pay'].'</td>
</tr>';
if($GDate['g1']){
$html .= '
<tr>
<td class="al_c w_50" >'.number_format($GDate['g1'])." ".$AdminLangFile['pdf_eg_p'].'</td>
<td class="al_c w_50" >'.ConvertDateToCalender_4($GDate['gd1']).'</td>
</tr>
'; 
}

if($GDate['g2']){
$html .= '
<tr>
<td class="al_c w_50" >'.number_format($GDate['g2'])." ".$AdminLangFile['pdf_eg_p'].'</td>
<td class="al_c w_50" >'.ConvertDateToCalender_4($GDate['gd2']).'</td>
</tr>
';
}
$html .= '</table><br/>'; 
 
} 


   


if($GDate['g3'] == '' and  $GDate['g4'] == '' and $GDate['g5'] == '' and $GDate['g6'] == '' ){
    
}else{
$html .= '<table class="info_pricelist">
<tr><th colspan="3" class="info_t_h al_c">'.$AdminLangFile['pdf_other'].'</th></tr>
<tr>
<td class="info_b_d al_c w_25">'.$AdminLangFile['pdf_value'].'</td>
<td class="info_b_d al_c w_50">'.$AdminLangFile['pdf_pay_des'].'</td>
<td class="info_b_d al_c w_25">'.$AdminLangFile['pdf_date_pay'].'</td>
</tr>';
 
if($GDate['g3']){
$html .= '<tr>
    <td class="al_c " >'.number_format($GDate['g3'])." ".$AdminLangFile['pdf_eg_p'].'</td>
    <td>'.$AdminLangFile['pdf_store'].'</td>
    <td class="al_c " >'.ConvertDateToCalender_4($GDate['gd3']).'</td>
  </tr>';    
} 

if($GDate['g4']){
$html .= '<tr>
    <td class="al_c " >'.number_format($GDate['g4'])." ".$AdminLangFile['pdf_eg_p'].'</td>
    <td>'.$AdminLangFile['pdf_electricity'].'</td>
    <td class="al_c " >'.ConvertDateToCalender_4($GDate['gd4']).'</td>
  </tr>';    
}

if($GDate['g5']){
$html .= '<tr>
    <td class="al_c " >'.number_format($GDate['g5'])." ".$AdminLangFile['pdf_eg_p'].'</td>
    <td>'.$AdminLangFile['pdf_water'].'</td>
    <td class="al_c " >'.ConvertDateToCalender_4($GDate['gd5']).'</td>
  </tr>';    
}  

if($GDate['g6']){
$html .= '<tr>
    <td class="al_c " >'.number_format($GDate['g6'])." ".$AdminLangFile['pdf_eg_p'].'</td>
    <td>'.$AdminLangFile['pdf_deposit'].'</td>
    <td class="al_c " >'.ConvertDateToCalender_4($GDate['gd6']).'</td>
  </tr>';    
}


$html .= '</table><br/>';

}



$html .= '<table class="info_pricelist">
<tr>
<td class="info_b_d al_c w_50">'.$AdminLangFile['pdf_date_1'].'</td>
<td class="info_b_d al_c w_50">'.$AdminLangFile['pdf_date_2'].'</td>
</tr>';
$html .= '<tr>
    <td class="al_c w_50 oneLine" >'.ConvertDateToCalender_4($row_price['st_date']).'</td>
    <td class="al_c w_50 oneLine" >'.ConvertDateToCalender_4($row_price['end_date']).'</td>
    
  </tr>'; 
$html .= '</table><br/>';

$html .= '<p>'.$AdminLangFile['pdf_last_update_d']." ".ConvertDateToCalender_3($row_price['last_date']).'</p>';




//==============================================================
//==============================================================
//==============================================================

if($ThIsIsTest == '1'){
echo  $html ;
}else{
$PrintFileName = "UnitOffer_".date("M y",time());
//include("../library/Class/Pdf_Class/mpdf.php");
    require_once '../vendor/autoload.php';


    $defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
    $fontDirs = $defaultConfig['fontDir'];

    $defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
    $fontData = $defaultFontConfig['fontdata'];



    $mpdf = new \Mpdf\Mpdf([
        'margin_top' => 10,
        'margin_bottom' => 10,
        'margin_right' => 7,
        'margin_left' =>7,
        'mirrorMargins' => true,
        #'debug' => true,

        'fontDir' => array_merge($fontDirs, [__DIR__]),
        'fontdata' => $fontData +
            [
                'alexandria' => [
                    'R' => '../PDF_File/Pdf_Style/AlexandriaRegular.ttf',
                    'useOTL' => 0xFF,
                    'useKashida' => 75,
                ],

                'almarai' => [
                    'R' => '../PDF_File/Pdf_Style/AlmaraiRegular.ttf',
                    'useOTL' => 0xFF,
                    'useKashida' => 75,
                ],

                'tajawalregular' => [
                    'R' => '../PDF_File/Pdf_Style/TajawalRegular.ttf',
                    'useOTL' => 0xFF,
                    'useKashida' => 75,
                ],

            ],

    ]);


    $PrintFileName = "UnitOffer_".$row['id']."_".date("M y",time());

    $stylesheet = file_get_contents('Pdf_Style/style.css');
    $mpdf->SetDirectionality('rtl');
    $mpdf->autoLangToFont = true;
    # $mpdf->autoScriptToLang = true;

    $mpdf->SetWatermarkImage('Pdf_Style/Logo.png', 0.2, 'F');
    $mpdf->showWatermarkImage = true;

    $mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
    $mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);

    #$mpdf->Output($PrintFileName.'.pdf','D');

    $mpdf->Output();


//$mpdf=new mPDF('utf-8','A4','','',10,10,10,10,6,3);
//$mpdf->SetDisplayMode('fullpage');
//
//
//$stylesheet = file_get_contents('Pdf_Style/style.css');
//$mpdf->WriteHTML($stylesheet,1);
//$mpdf->SetWatermarkImage('Pdf_Style/Logo.png', 0.2, 'F');
//$mpdf->showWatermarkImage = true;
//$mpdf->WriteHTML($html);
//
//$mpdf->Output($PrintFileName.'.pdf','I');

exit;    
} 



 
//==============================================================
//==============================================================
//==============================================================

}else{
echo '<div class="alert alert-info alert-dismissable Arr_Mass">';
echo $AdminLangFile['pdf_err_print'];
echo '</div>';
}
?>