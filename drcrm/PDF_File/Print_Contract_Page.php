<?php

$CustId = $row['cust_id'];
$unit_id = $row['unit_id'];

$ThisProId = $row['pro_id'];

 
$GetProName = $db->H_SelectOneRow("select * from project where id = '$ThisProId' "); 

$html = '';
 
 
$html .= '<div class="DivCont">';
$html .= '<div class="ContractNum">'.$row['contract_num'].'</div>';
$html .= '</div>';
    
    
     
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||| #  بيانات الوحدة #######
$html .= '<div class="Header_H1">'.$ALang['n_con_unit_info'].'</div>';
$row_unit = $db->H_SelectOneRow("select * from project_unit where id = '$unit_id' ");
$html .= PrintUnitInfo($row_unit);
    
    
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||| #  بيانات العميل  #######
$html .= '<div class="Header_H1">'.$ALang['contract_cust_info']." ".$ALang['customer_buyer'].'</div>';
$SqlCust = " select * from customer where id = '$CustId' ";
$row_Cust = $db->H_SelectOneRow($SqlCust);
$html .= PrintCustInfo($row_Cust,array('FullInfo'=>1));     
 


#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||| # تفاصيل التعاقد  #######
$html .= '<div class="Header_H1">'.$ALang['n_con_contract_info'].'</div>';
$html .= PrintContractInfo($row);
    

$html .= "<pagebreak />"; 
$html .= '<div class="Header_H1">'.$ALang['n_con_installments_table'].'</div>';
$html .= Print_installments_table_PDF($row);    



$footer = '<div class="PageFooter">';

$footer .= '<div class="Contract_Num">';
$footer .= 'Contract Number '.$row['contract_num']." ";
$footer .= '</div>';

$footer .= '<div class="Print_Contract">';
$footer .= date("Y-m-d h:i:s A",time()).' Print By #'.$RowUsreInfo['user_id'] ;
$footer .= '</div>';

$footer .= '</div>';

if($ThIsIsTest == '1'){
    echo  $html ;
}else{
  ob_clean();  
  
 
$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

 
 
$mpdf = new \Mpdf\Mpdf([
    'margin_top' => 10,
    'margin_right' => 7,
    'margin_left' =>7,
   	'mirrorMargins' => true,
    'debug' => true,
 
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


    $PrintFileName = $GetProName['pro_code'].'-'.$row_unit['u_num'].'_'.'Contract-Number-'.$row['contract_num'];
    #$PrintFileName = "UnitOffer_".$row['id']."_".date("M y",time());

    $stylesheet = file_get_contents('../PDF_File/Pdf_Style/style_invoice.css');
    $mpdf->SetDirectionality('rtl');
    $mpdf->autoLangToFont = true;
   # $mpdf->autoScriptToLang = true;
 
    $mpdf->SetFooter($footer);
    $mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
    $mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);    
    
    #$mpdf->Output($PrintFileName.'.pdf','D');
    $mpdf->Output($PrintFileName.'.pdf','I'); 
       
    $mpdf->Output();
    
}

?>