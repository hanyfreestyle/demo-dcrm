<?php
require_once('../library/Tools/Php_HtmlExcel.php');
require_once '../include/inc_reqfile.php';
echo '<meta http-equiv="content-type" content="text/html; charset=utf-8" />';

$AdminConfig = checkUser();

if($AdminConfig['admin']=='1'){
    $ThIsIsTest = '0';

    if($ThIsIsTest == '1'){
        $_POST['Export_File'] = "Done";
        $_POST['sql_line'] = "SELECT * FROM customer where id != '1'   LIMIT 5" ;
        $tastyle = "border = '1'";
    }else{
        $tastyle ="";
    }

 


    if(isset($_POST['Export_File'])){

       
        
        $names = '<table '.$tastyle.' ><tr>';
        $names .= '<th>'.$AdminLangFile['customer_name'].'</th>';
        $names .= '<th>'.$AdminLangFile['customer_mobile'].'</th>';
        $names .= '<th>'.$AdminLangFile['customer_mobile'].'</th>';
        $names .= '<th>'.$AdminLangFile['customer_email'].'</th>';
 
        $names .= '</th>';
        $names .= '</tr>';
        
 
        $CustList = $db->SelArr($_POST['sql_line']);

        for($i = 0; $i < count($CustList); $i++) {
          

             
            $names .='<td>'.$CustList[$i]['name'].'</td>';
            $names .='<td>'.$CustList[$i]['mobile'].'</td>';
            $names .='<td>'.$CustList[$i]['mobile_2'].'</td>';
            $names .='<td>'.$CustList[$i]['email'].'</td>';
            $names .= '</tr>';
        }



        $names .= '</table>';

        echo  $names ;


       if($ThIsIsTest != '1'){

       $css = '
        .red {	color: red;}
        .text    { mso-number-format: "\@"; }
        ';

        $rep1 = array('<td>');
        $rep2 = array('<td class="text">');
        $names = str_replace($rep1,$rep2,$names);



        $xls = new HtmlExcel();
        $xls->setCss($css);
        $xls->addSheet("Names", $names);
        $FileName = date("Y-m-d_h-i-s");
        $xls->headers("Data_".$FileName.".xls");
        echo $xls->buildFile();
       }

    }
}


?>