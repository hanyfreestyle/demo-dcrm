<?php
require_once('../library/Tools/Php_HtmlExcel.php');
require_once '../include/inc_reqfile.php';
echo '<meta http-equiv="content-type" content="text/html; charset=utf-8" />';
$AdminConfig = checkUser();


if($AdminConfig['admin']=='1'){
    $ThIsIsTest = '0';

    if($ThIsIsTest == '1'){
        $_POST['Export_File'] = "Done";
        $_POST['sql_line'] = "SELECT * FROM customer where id = '1' " ;
        $tastyle = "border = '1'";
    }else{
        $tastyle ="";
    }



    if(isset($_POST['Export_File'])){


        $T_ARRAY_CUST_TYPE = $db->SelArr("SELECT id,name,name_en FROM f_cust_type");
        $T_ARRAY_CUST_TYPESUB = $db->SelArr("SELECT id,name,name_en FROM f_cust_subtype");
        $T_ARRAY_CONFIG_DATA  =  LoadTabelData_To_Arr("1" ,"config_data");
        $T_ARRAY_Country = $db->SelArr("SELECT id,name,name_en FROM fi_country");
        $T_ARRAY_City = $db->SelArr("SELECT id,name,name_en FROM fi_city");
        $T_ARRAY_Flive = $db->SelArr("SELECT id,name,name_en FROM f_live");


    $names = '<table '.$tastyle.' ><tr>';
    $names .= '<th>ID</th>';
    $names .= '<th>'.$ALang['customer_date_add'].'</th>';
    $names .= '<th>'.$ALang['customer_name'].'</th>';
    $names .= '<th>'.$ALang['customer_mobile'].'</th>';
    $names .= '<th>'.$ALang['customer_mobile'].' 2</th>';
    $names .= '<th>'.$ALang['customer_phone'].'</th>';
    $names .= '<th>'.$ALang['customer_email'].'</th>';
    $names .= '<th>'.$ALang['customer_c_type'].'</th>';
    $names .= '<th>'.$ALang['customer_c_type_sub'].'</th>';
    $names .= '<th>'.$ALang['customer_jop'].'</th>';
    $names .= '<th>'.$ALang['customer_live_type'].'</th>';
    $names .= '<th>'.$ALang['customer_nationality'].'</th>';
    $names .= '<th>'.$ALang['customer_country_live'].'</th>';
    $names .= '<th>'.$ALang['customer_city'].'</th>';   
    $names .= '</tr>';
    
 

   $SQL_Get = $db->SelArr($_POST['sql_line']);
   for($i = 0; $i < count($SQL_Get); $i++) {

    $names .= '<tr>';
    $names .= '<td>'.$SQL_Get[$i]['id'].'</td>';
    $names .= '<td>'.date("Y-m-d",$SQL_Get[$i]['date_add']).'</td>';
    $names .= '<td>'.$SQL_Get[$i]['name'].'</td>';
    $names .= '<td>'.$SQL_Get[$i]['mobile'].'</td>';
    $names .= '<td>'.$SQL_Get[$i]['mobile_2'].'</td>';
    $names .= '<td>'.$SQL_Get[$i]['phone'].'</td>';
    $names .= '<td>'.$SQL_Get[$i]['email'].'</td>';
    $names .= '<td>'.findValue_FromArr_Export($T_ARRAY_CUST_TYPE,"id",$SQL_Get[$i]['c_type'],"name").'</td>';
    $names .= '<td>'.findValue_FromArr_Export($T_ARRAY_CUST_TYPESUB,"id",$SQL_Get[$i]['c_type_2'],"name").'</td>';
    $names .= '<td>'.findValue_FromArr_Export($T_ARRAY_CONFIG_DATA,"id",$SQL_Get[$i]['jop_id'],"name").'</td>';
    $names .= '<td>'.findValue_FromArr_Export($T_ARRAY_Flive,"id",$SQL_Get[$i]['live_id'],"name").'</td>';
    $names .= '<td>'.findValue_FromArr_Export($T_ARRAY_Country,"id",$SQL_Get[$i]['country_id'],"name").'</td>';
    $names .= '<td>'.findValue_FromArr_Export($T_ARRAY_Country,"id",$SQL_Get[$i]['countrylive_id'],"name").'</td>';   
    $names .= '<td>'.findValue_FromArr_Export($T_ARRAY_City,"id",$SQL_Get[$i]['city_id'],"name").'</td>';      
    $names .= '</tr>';
    
    }




        $names .= '</table>';

        echo  $names ;

         if($ThIsIsTest != '1'){
            $css = '
            .red {	color: red;}
            .text    { mso-number-format: "\@"; width:80pt;}
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