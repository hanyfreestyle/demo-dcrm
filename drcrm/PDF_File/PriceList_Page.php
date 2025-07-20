<?php
if(isset($_GET['Type']) and $_GET['Type'] == 'D'){
    $View_PDF = "Download" ;
}else{
    $View_PDF = "" ;
}

$html = '';
$html .= PrintBlock($row,"1");
$html .= PrintBlock($row,"2");




#################################################################################################################################
###################################################    Print File Config
#################################################################################################################################
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

    $stylesheet = file_get_contents('../PDF_File/Pdf_Style/style_invoice.css');
    $mpdf->SetDirectionality('rtl');
    $mpdf->autoLangToFont = true;
    # $mpdf->autoScriptToLang = true;

    $mpdf->WriteHTML($stylesheet,\Mpdf\HTMLParserMode::HEADER_CSS);
    $mpdf->WriteHTML($html,\Mpdf\HTMLParserMode::HTML_BODY);

    #$mpdf->Output($PrintFileName.'.pdf','D');
    $mpdf->Output();
}

?>