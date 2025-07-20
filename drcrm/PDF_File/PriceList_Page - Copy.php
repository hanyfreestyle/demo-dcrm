<?php
header("Content-type: text/html; charset=utf-8");
if(isset($_GET['Type']) and $_GET['Type'] == 'D'){
$View_PDF = "Download" ;   
}else{
$View_PDF = "" ;    
}
$PlanConfig = GetPlanConfig();
#################################################################################################################################
###################################################    Sql Q
#################################################################################################################################
$ThisProJectCode = $row_unit['pro_id'] ;

$sql_project = "SELECT * FROM project where id = '$ThisProJectCode'";
$row_project = $db->H_SelectOneRow($sql_project);


$sql_price = "SELECT * FROM project_price where id = '$PriceIdd'";
$row_price = $db->H_SelectOneRow($sql_price);
$Service_Arr = unserialize($row_price['t_data']);
$Service =  Count_Data_Send($Service_Arr);

#print_r3($row_project);
 

#################################################################################################################################
###################################################    Logo
#################################################################################################################################
$html = '';

if($PlanConfig['plan_view'] == '1'){
    $PrintPhoto = Get_Unit_Photo($row_unit);
    if($PrintPhoto['Photo'] != ''){
        $html .= '<p><div class="Project_Plan"><img class="Project_Plan_img" src="'.$PrintPhoto['Photo'].'" /></div></p>';
        $html .= '<p>توقيع العميل </p>';
    }
}



if($row_project['photo'] != ""){
$html .= '<p><div class="ProjectLogo"><img class="ProjectLogo_img" src="'.PLAN_IMAGE_DIR_V.$row_project['photo'].'" /></div></p>';    
}



#################################################################################################################################
###################################################    الجدول الاساسى
#################################################################################################################################

$html .= '<table class="info_t">';

$html .= '<tr>';
$html .= '<td class="info_b_d al_r w_25">'.$ALang['pdf_u_code'].'</td>';
$html .= '<td class="al_c w_25 ff_info" >'.$row_project['pro_code'].$row_unit['p_code'].'</td>';
$html .= '<td class="info_b_d al_r w_25">'.$ALang['pdf_total_price'].'</td>';
$html .= '<td class="al_c w_25 ff_info" >'.number_format($row_price['total_price'])." ".$AdminLangFile['pdf_eg_p'].'</td>';
$html .= '</tr>';

$html .= '<tr>';
$html .= '<td class="info_b_d">'.$ALang['pdf_u_type'].'</td>';
$html .= '<td class="al_c w_25 ff_info" >'.$row_unit['u_num'].'</td>';
$html .= '<td class="info_b_d">'.$ALang['pdf_u_area'].'</td>';
$html .= '<td class="al_c w_25 ff_info" >'.$row_unit['u_area']." ".$AdminLangFile['pdf_mm'].'</td>';
$html .= '</tr>';

$html .= '<tr>';
$html .= '<td class="info_b_d">'.$ALang['pdf_u_floor'].'</td>';
$html .= '<td class="al_c w_25 ff_info" >'.GetNameFromID("project_floor",$row_unit['floor_id'],"name").'</td>';
$html .= '<td class="info_b_d">'.$ALang['pdf_meter_price'].'</td>';
if($row_unit['price_m'] != '0'){
$PriceM = number_format($row_unit['price_m'])." ".$AdminLangFile['pdf_eg_p'] ;   
}else{
$PriceM = "" ;    
}
$html .= '<td class="al_c w_25 ff_info" >'.$PriceM.'</td>';


$html .= '</tr>';

$html .= '<tr>';
$html .= '<td class="info_b_d">'.$ALang['pdf_prject_name'].'</td>';
$html .= '<td class="al_c w_25 ff_info" >'.$row_project['name'].'</td>';
$html .= '<td class="info_b_d">'.$ALang['pdf_hakz_price'].'</td>';
$html .= '<td class="al_c w_25 ff_info" >'.number_format($row_price['reser_price'])." ".$AdminLangFile['pdf_eg_p'].'</td>';
$html .= '</tr>';

$html .= '<tr>';
$html .= '<td class="info_b_d">'.$ALang['pdf_date_add'].'</td>';
$html .= '<td class="al_c w_25 ff_info" >'.ConvertDateToCalender_2(time()).'</td>';
$html .= '<td class="info_b_d">'.$ALang['project_unit_notes'].'</td>';
$html .= '<td class="al_c w_25 ff_info" >'.$row_unit['notes'].'</td> ';
$html .= '</tr>';

$html .= '</table><br/>'; 



#################################################################################################################################
###################################################    انظمة السداد
#################################################################################################################################
$Method_Sql = "select * from project_price_des where price_id = '$PriceIdd' order by postion ";
$already = $db->H_Total_Count($Method_Sql);

if($already > '0'){

    $Name = $db->SelArr($Method_Sql);
    for($i = 0; $i < count($Name); $i++) {
        $Method_Arr =  unserialize($Name[$i]['t_data']);
        $Method =  Count_Data_Send($Method_Arr);

#################################################################################################################################
###################################################    اسم نظام السداد
#################################################################################################################################
        $html .= '<table class="Method_Tabel"><tr><td class="Method_Name al_c" >'.$Name[$i]['method_name'].'</td></tr></table>';

#################################################################################################################################
###################################################   فى حالة وجود خصم
#################################################################################################################################
        if($Name[$i]['percent'] != '0'){
            $html .= '<table class="Method_Tabel " ><tr>';
            $html .= '<td class="al_c Method_Percent w_25">'.$ALang['project_percent'].'</td>';
            $html .= '<td class="al_c w_25"> '.$Name[$i]['percent'].' % </td>';
            $html .= '<td class="al_c Method_Percent w_25">'.$ALang['project_total_percent'].'</td>';
            $html .= '<td class="al_c w_25">'.number_format($Name[$i]['total_percent'])." ".$ALang['pdf_eg_p'].'</td>';
            $html .= '</tr></table>';
        }
#################################################################################################################################
###################################################    تفاصيل نظام السداد
#################################################################################################################################
        $html .= '<table class="info_pricelist">';
        $html .= '<tr>';
        for ($x = 1; $x < 7 ; $x++) {
            if( trim($Method_Arr['t'.$x]) != '' ){
                $html .= '<td class="al_c w_20 w_amr "><div class="bamr" >'.$Method_Arr['tdes'.$x].'</div></td>';
            }
        }
        $html .= '</tr>';
        $html .= '<tr>';
        for ($x = 1; $x < 7 ; $x++) {
            if( trim($Method_Arr['t'.$x]) != '' ){
                $html .= '<td class="al_c">'.number_format($Method_Arr['t'.$x])." ".$AdminLangFile['pdf_eg_p'].'</td>';
            }
        }
        $html .= '</tr>';
        $html .= '</table>';
        $html .= Print_PriceList_Notes($Name[$i]);
    }
}

#################################################################################################################################
###################################################    الخدمات
#################################################################################################################################
if($Service['CountData'] != '0'){
    $html .= '<table class="info_pricelist">';
    $html .= '<tr><th colspan="3" class="info_t_h al_c">'.$ALang['pdf_other'].'</th></tr>';
    $html .= '<tr>';
    $html .= '<td class="info_b_d al_c w_35">'.$ALang['pdf_value'].'</td>';
    $html .= '<td class="info_b_d al_c w_65">'.$ALang['pdf_pay_des'].'</td>';
    $html .= '</tr>';

    for ($i = 1; $i <= 7 ; $i++) {
        if( trim($Service_Arr['t'.$i]) != '' ){
            $html .= '<tr>';
            $html .= '<td class="al_c">'.number_format($Service_Arr['t'.$i])." ".$ALang['pdf_eg_p'].'</td>';
            $html .= '<td class="al_c">'.$Service_Arr['tdes'.$i].'</td>';
            $html .= '</tr>';
        }
    }
    $html .= '</table><br/>';
}

#################################################################################################################################
###################################################    الفوتر
#################################################################################################################################
$html .= '<p>'.$AdminLangFile['pdf_last_update_d']." ".ConvertDateToCalender_2($row_price['last_date']).'</p>';



#################################################################################################################################
###################################################    Print File Config
#################################################################################################################################
if($ThIsIsTest == '1'){
    echo  $html ;
}else{
  
 
  $defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];


 
$mpdf = new \Mpdf\Mpdf([
    'margin_top' => 5,
   	'mirrorMargins' => true,

	'fontDir' => array_merge($fontDirs, [__DIR__]),
	'fontdata' => $fontData + 
		[
			'angerthas' => [
				'R' => '../assets/angerthas.ttf',
			],
			'inkfree' => [
				'R' => '../assets/Inkfree.ttf',
			],
            
			'tajawalregular' => [
				'R' => '../assets/TajawalRegular.ttf',
			],
            
		],
]);




    $PrintFileName = "UnitOffer_".$row_unit['u_code']."_".date("M y",time());

    $stylesheet = file_get_contents('../PDF_File/Pdf_Style/style9.css');
    #$mpdf->SetDirectionality('rtl');
 
    $mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
    $mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);    
    
    #$mpdf->Output($PrintFileName.'.pdf','D');    
    $mpdf->Output();
    
    

 
 
}

?>