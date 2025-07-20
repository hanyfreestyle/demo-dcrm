<?php
if(!defined('WEB_ROOT')) {	exit;}
require_once '../library/PHPExcel/PHPExcel.php';
define('FOLDER_NAME','Leads/Files/');
define('EXCEL_IMAGE_DIR' ,  SRV_ROOT.$AdminFolder.FOLDER_NAME);

#################################################################################################################################
###################################################  ImportDataForm
#################################################################################################################################
function ImportDataForm(){
    global $AdminLangFile ;

    Form_Open();
    if( F_LEAD_TYPE == 1){
        $Arr = array("Label" => 'on',"Active" => '0');
        $Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['customer_lead_type'],"col-md-3","lead_type","fs_lead_type","req","0",$Arr);
    }

    if( F_LEAD_SOURS == 1){
        $Arr = array("Label" => 'on',"Active" => '0');
        $Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['customer_lead_sours'],"col-md-3","lead_sours","fs_lead_sours","req","0",$Arr);
    }

    if(F_LEAD_CAT == 1){
        $Arr = array("Label" => 'on',"Active" => '0','Order'=> "order by count desc" , "Filter_Filde"=> "cat_id" , "Filter_Vall"=> TABEL_LEAD_CAT);
        $Err[] = NF_PrintSelect_2018("Chosen",$AdminLangFile['hotline_ad_campaign'],"col-md-3","lead_cat","config_data","req","0",$Arr);
    }

    echo '<div style="clear: both!important;"></div>';
    $Arr= array('Label'=> $AdminLangFile['leads_add_file_xlx'] ,"Col"=> "col-md-12" ,"name"=> "csv" ,'required' => 'required',"StopView"=>'1') ;
    New_PrintFilePhoto("Add",$Arr);
    Form_Close("1");
}

#################################################################################################################################
###################################################    ImportFaceData
#################################################################################################################################
function  Import_Leads_Data($db){
    $ThisTest = '0' ;


    $F_import_name = CheckLetterForImport("import_name");
    $F_import_mobile = CheckLetterForImport("import_mobile");
    $F_import_mobile_2 = CheckLetterForImport("import_mobile_2");
    $F_import_email = CheckLetterForImport("import_email");
    $F_import_jop = CheckLetterForImport("import_jop");
    $F_import_edu = CheckLetterForImport("import_edu");
    $F_import_area = CheckLetterForImport("import_area");
 
    
    $FileC = array (
    'size'=> "1024999",
    'Mimtype'=> array('application/vnd.ms-excel') ,
    'ViewErr' => "برجاء التاكد من صيغة الملف " 
    );
    $photoUp =  Upload_Excel_File("csv",EXCEL_IMAGE_DIR,$FileC); 
    if ($photoUp['photoErr'] != '1') {
      $file = EXCEL_IMAGE_DIR.$photoUp['photo'];
      
            $excelReader = PHPExcel_IOFactory::createReaderForFile($file);
            $excelObj = $excelReader->load($file);
            $worksheet = $excelObj->getSheet(0);
            $lastRow = $worksheet->getHighestRow();

            for ($row = 2; $row <= $lastRow; $row++) {

                if($F_import_name != '0'){
                    $Sours_Name = $worksheet->getCell($F_import_name.$row)->getValue();
                }else{
                    $Sours_Name = '';
                }

                if($F_import_mobile != '0'){
                    $Sours_Phone_1 = $worksheet->getCell($F_import_mobile.$row)->getValue();
                }else{
                    $Sours_Phone_1 = "";
                }

                if($F_import_mobile_2 != '0'){
                    $Sours_Phone_2 = $worksheet->getCell($F_import_mobile_2.$row)->getValue();
                }else{
                    $Sours_Phone_2 = "";
                }

                if($F_import_email != '0'){
                    $Sours_Email = $worksheet->getCell($F_import_email.$row)->getValue();
                }else{
                    $Sours_Email = "";
                }

                if($F_import_jop != '0'){
                    $Sours_Jop = $worksheet->getCell($F_import_jop.$row)->getValue();
                }else{
                    $Sours_Jop = "";
                }

                if($F_import_edu != '0'){
                    $Sours_Eud = $worksheet->getCell($F_import_edu.$row)->getValue();
                }else{
                    $Sours_Eud = "";
                }

                if($F_import_area != '0'){
                    $Sours_Area = $worksheet->getCell($F_import_area.$row)->getValue();
                }else{
                    $Sours_Area = "";
                }


                if($Sours_Name != '' and $Sours_Phone_1 != ''){
                    $Save_Phone_1 =  UpdateArNum_New($Sours_Phone_1) ;
                    $Save_Phone_2 =  UpdateArNum_New($Sours_Phone_2) ;
                    $Save_Email =  Update_Email($Sours_Email);

                    $Notes = "";
                    $Notes .= $Sours_Name;
                    $Notes .= GetNotes($Sours_Phone_1);
                    $Notes .= GetNotes($Sours_Phone_2);
                    $Notes .= GetNotes($Sours_Email);
                    $Notes .= GetNotes($Sours_Jop);
                    $Notes .= GetNotes($Sours_Eud);
                    $Notes .= GetNotes($Sours_Area);

                    $server_data = array ( 'id'=> NULL ,
                        'name'=> $Sours_Name,
                        'mobile'=>   $Save_Phone_1['Phone'] ,
                        'mobile_2'=>  $Save_Phone_2['Phone'] ,
                        'email'=> $Save_Email ,
                        'notes'=> $Notes,
                        'lead_sours'=> $_POST['lead_sours'],
                        'lead_type'=> $_POST['lead_type'],
                        'lead_cat'=> $_POST['lead_cat'],
                        'state'=> $Save_Phone_1['Err'],
                    );

                    if($ThisTest == '1'){
                        print_r3($server_data);
                    }else{
                        $db->AutoExecute("facebook_data",$server_data,AUTO_INSERT);
                    }
                }

            }
            if($ThisTest != '1'){
                @unlink($file);
                Redirect_Page_2("index.php?view=ListImportLeads");
            }
                  
      
      @unlink($file);  
    }    
}

#################################################################################################################################
################################################### CheckLetterForImport
#################################################################################################################################
function CheckLetterForImport($Filde){
    global $ConfigP ;
    if(isset($ConfigP[$Filde])){
        $TestLetter =  strtoupper($ConfigP[$Filde]);
        $Test =  Test_DataType($TestLetter,"/[^A-Z]/");
        if($Test == '1'){
            $Letter = $TestLetter ;
        }else{
            $Letter = "0";
        }
    }else{
        $Letter = "0";
    }
    return  $Letter  ;
}
#################################################################################################################################
###################################################   Test_DataType
#################################################################################################################################
function Test_DataType($input_value,$reg_exp){
    if(preg_match($reg_exp,$input_value))
    {
        return false;
    }
    return true;
}
##############################################################################################################################################################
################################ UploadOneFile_New
##############################################################################################################################################################


function Upload_Excel_File($photoFile,$DIR,$FileC) {
   $photoErr = 0;
   $photo = '';
   $FileC['size'] = $FileC['size'] * 1024;
   $dir_dest = ($DIR);
   $handle = new Upload($_FILES[$photoFile]);
   if($handle->uploaded) {
     $handle->mime_magic_check = true;

     $NameType_AR = preg_match("/\p{Arabic}/u", $handle->file_src_name_body);
     if($NameType_AR == "1" ){
     $handle->file_src_name_body = Rand_Name("10");   
     }
     $handle->file_new_name_body   = strtolower($handle->file_src_name_body);  
          
     $handle->allowed = $FileC['Mimtype'];
     $handle->file_max_size = $FileC['size'];
     $handle->Process($dir_dest);
     if($handle->processed) {
       $photo = $handle->file_dst_name;
     } else {
       PrintErrPhoto($handle->error,$FileC);
       $photoErr = 1;
     }
     $handle->Clean();
   } else {
     // one error occured
     PrintErrPhoto($handle->error,$FileC);
     $photoErr = 1;
   }
   return array('photo' => $photo,'photoErr' => $photoErr);
 }
#################################################################################################################################
################################################### UpdateArNum_New
#################################################################################################################################
function UpdateArNum_New($string) {
    $Err = '1' ;
    $string =  strtr($string, array('۰'=>'0', '۱'=>'1', '۲'=>'2', '۳'=>'3', '۴'=>'4', '۵'=>'5', '۶'=>'6', '۷'=>'7', '۸'=>'8', '۹'=>'9', '٠'=>'0', '١'=>'1', '٢'=>'2', '٣'=>'3', '٤'=>'4', '٥'=>'5', '٦'=>'6', '٧'=>'7', '٨'=>'8', '٩'=>'9'));
    $string = str_replace(" ","",$string);
    if(substr($string, 0, 1) == '+'){
        $string = str_replace("+","00",$string);
    }
    $Test =  Test_DataType($string,"/[^0-9]/");
    if($Test){
        $LenCount = strlen (trim($string)) ;
        $NetWork  = substr($string, 0, 2);
        if( $LenCount == 10  and ($NetWork == '10' or $NetWork == '11' or $NetWork == '12' or $NetWork == '15')  ) {
            $string = '0'.$string ;
        }
        if(strlen (trim($string)) < '11'){
            $string = "";
            $Err = '0';
        }
    }else{
        $string = "";
        $Err = '0';
    }
    return array('Phone'=> $string , 'Err'=> $Err )  ;
}

#################################################################################################################################
################################################### Update_Email
#################################################################################################################################
function Update_Email($string){
    $string =  strtr($string, array('۰'=>'0', '۱'=>'1', '۲'=>'2', '۳'=>'3', '۴'=>'4', '۵'=>'5', '۶'=>'6', '۷'=>'7', '۸'=>'8', '۹'=>'9', '٠'=>'0', '١'=>'1', '٢'=>'2', '٣'=>'3', '٤'=>'4', '٥'=>'5', '٦'=>'6', '٧'=>'7', '٨'=>'8', '٩'=>'9'));
    $string = str_replace(" ","",$string);
    $TestEmail = validate_email($string);
    if($TestEmail == '1'){
        $Email = $string ;
    }else{
        $Email = "" ;
    }
    return $Email ;
}
#################################################################################################################################
###################################################   GetNotes
#################################################################################################################################
function GetNotes($var){
    if(isset($var) and  $var != ""){
        $var ="\n". $var;
    }else{
        $var = "";
    }
    return $var;
}
#################################################################################################################################
###################################################  validate_email
#################################################################################################################################
function validate_email($email) {
    return preg_match("/^[_\.0-9a-zA-Z-]+@([0-9a-zA-Z][0-9a-zA-Z-]+\.)+[a-zA-Z]{2,6}$/i", $email);
}

 
?>