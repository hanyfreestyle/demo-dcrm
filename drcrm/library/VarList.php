<?php
if(!defined('WEB_ROOT')) {	exit;}

#################################################################################################################################
###################################################   religion
#################################################################################################################################
$Religion_Arr = array(
'1' =>  $AdminLangFile['customer_religion_muslim'],
'2' =>  $AdminLangFile['customer_religion_christian'],
'3' =>  $AdminLangFile['customer_religion_notset'],
);
  
  
$Religion_CahrtArr = array(
'0' =>  array('id'=> '1',"name"=>$AdminLangFile['customer_religion_muslim'],"name_en"=>$AdminLangFile['customer_religion_muslim'],),
'1' =>  array('id'=> '2',"name"=>$AdminLangFile['customer_religion_christian'],"name_en"=>$AdminLangFile['customer_religion_christian'],),
'2' =>  array('id'=> '3',"name"=>$AdminLangFile['customer_religion_notset'],"name_en"=>$AdminLangFile['customer_religion_notset'],),
) ; 

function RterunReligion($state) {
    global $AdminLangFile ;
   switch($state) {
     case "1":
       $order = $AdminLangFile['customer_religion_muslim'] ;
       break;
     case "2":
       $order = $AdminLangFile['customer_religion_christian'];
       break;
     case "3":
       $order = $AdminLangFile['customer_religion_notset'];
       break;
     default:
       $order = "";
   }
   return $order;
}




#################################################################################################################################
###################################################   RterunOrder
#################################################################################################################################
function RterunOrder($state) {
   switch($state) {
     case "1":
       $order = '  ORDER BY id DESC ';
       break;
     case "2":
       $order = ' ORDER BY id ASC ';
       break;
     default:
       $order = ' ORDER BY id DESC ';
   }
   return $order;
}
function RterunOrder_DataTabel($state) {
   switch($state) {
     case "1":
       $order = "NewTableOrder";
       break;
     case "2":
       $order = 'MyCustmer';
       break;
     default:
       $order = 'MyCustmer';
   }
   return $order;
}

$Order_ByList = array(
'1' =>  $AdminLangFile['mainform_newest_to_older'],
'2' =>  $AdminLangFile['mainform_older_to_newest'],
);

##############################################################################################################################################################
################################ LangAdd_Redirect
############################################################################################################################################################## 
$LangAdd_Redirect = array(
'1' => $AdminLangFile['mainform_lang_redirect_new'],
'2' => $AdminLangFile['mainform_lang_redirect_list'],
'3' => $AdminLangFile['mainform_lang_redirect_list_update'],
);

function LangAdd_Redirect($state) {
   switch($state) {
     case "1":
       $order = Redirect_Page_2("index.php?view=Add");
       break;
     case "2":
       $order = Redirect_Page_2("index.php?view=List");
       break;
     case "3":
       $order = Redirect_Page_2("index.php?view=UpdateLang");
       break;
     default:
       $order = Redirect_Page_2("index.php?view=Add");
   }
   return $order;
}

##############################################################################################################################################################
################################ LangEdit_Redirect
############################################################################################################################################################## 
$LangEdit_Redirect = array(
'1' => $AdminLangFile['mainform_lang_redirect_list'],
'2' => $AdminLangFile['mainform_lang_redirect_list_update'],
'3' =>  $AdminLangFile['mainform_lang_redirect_list_cat'],
); 

function LangEdit_Redirect($state,$Cat_Id) {
   switch($state) {
     case "1":
       $order = Redirect_Page_2("index.php?view=List");
       break;
     case "2":
        $order = Redirect_Page_2("index.php?view=UpdateLang");
       break;
     case "3":
       $order = Redirect_Page_2("index.php?view=List&Cat_Id=".$Cat_Id);
       break;
     default:
       $order = Redirect_Page_2(LASTREFFPAGE);
   }
   return $order;
 }  
 

function RterunOrderName($state) {
    global $AdminLangFile ;
  switch($state) {
     case "1":
       $order = $AdminLangFile['mainform_list_by_order'];
       break;
     case "2":
       $order = $AdminLangFile['mainform_newest_to_older'] ;
       break;
     case "3":
       $order = $AdminLangFile['mainform_older_to_newest'];
       break;
     case "4":
       $order = ' ORDER BY date DESC ';
       break;
     default:
       $order = 'Error ';
   }
   return $order;   
    
}  



function ReturnPERpage($PERpage){
    if(intval($PERpage)<= "0"){
        $PERpage = "1";
    }else{
        $PERpage = $PERpage ;
    }
    return $PERpage ;
}

##############################################################################################################################################################
################################ UnitAdd_Redirect
############################################################################################################################################################## 
$UnitAdd_Redirect = array(
'1' => $AdminLangFile['mainform_u_redirect_new'],
'2' => $AdminLangFile['mainform_u_redirect_list'],
'3' => $AdminLangFile['mainform_u_redirect_config'],
);

function UnitAdd_Redirect($state) {
   switch($state) {
     case "1":
       $order = Redirect_Page_2("index.php?view=Add");
       break;
     case "2":
       $order = Redirect_Page_2("index.php?view=List");;
       break;
     case "3":
       $order = Redirect_Page_2("index.php?view=Config");;
       break;
     default:
       $order = Redirect_Page_2("index.php?view=Add");
   }
   return $order;
 }
 
 
##############################################################################################################################################################
################################ UnitEdit_Redirect
############################################################################################################################################################## 
$UnitEdit_Redirect = array(
'1' => $AdminLangFile['mainform_u_redirect_same'],
'2' => $AdminLangFile['mainform_u_redirect_list'],
'3' => $AdminLangFile['mainform_u_redirect_config'],
); 
function UnitEdit_Redirect($state) {
   switch($state) {
     case "1":
       $order = Redirect_Page_2(LASTREFFPAGE);
       break;
     case "2":
       $order = Redirect_Page_2("index.php?view=List");;
       break;
     case "3":
       $order = Redirect_Page_2("index.php?view=Config");;
       break;
     default:
       $order = Redirect_Page_2(LASTREFFPAGE);
   }
   return $order;
 } 




##############################################################################################################################################################
################################ CatAdd_Redirect
##############################################################################################################################################################
$CatAdd_Redirect = array(
'1' => $AdminLangFile['mainform_c_redirect_new'],
'2' => $AdminLangFile['mainform_c_redirect_list'],
'3' => $AdminLangFile['mainform_c_redirect_config'],
);

function CatAdd_Redirect($state) {
   switch($state) {
     case "1":
       $order = Redirect_Page_2("index.php?view=Cat_Add");
       break;
     case "2":
       $order = Redirect_Page_2("index.php?view=Cat_List");;
       break;
     case "3":
       $order = Redirect_Page_2("index.php?view=Config");;
       break;
     default:
       $order = Redirect_Page_2("index.php?view=Cat_Add");
   }
   return $order;
 }
 

##############################################################################################################################################################
################################ CatEdit_Redirect
############################################################################################################################################################## 
$CatEdit_Redirect = array(
//'1' => "عرض نفس المجموعة ",
'1' => $AdminLangFile['mainform_c_redirect_same'],
'2' => $AdminLangFile['mainform_c_redirect_list'],
'3' => $AdminLangFile['mainform_c_redirect_config'],
); 
function CatEdit_Redirect($state) {
   switch($state) {
     case "1":
       $order = Redirect_Page_2(LASTREFFPAGE);
       break;
     case "2":
       $order = Redirect_Page_2("index.php?view=Cat_List");;
       break;
     case "3":
       $order = Redirect_Page_2("index.php?view=Config");;
       break;
     default:
       $order = Redirect_Page_2(LASTREFFPAGE);
   }
   return $order;
 } 

/*
##############################################################################################################################################################
################################ UnitAdd_Redirect
############################################################################################################################################################## 
$UnitAdd_Redirect = array(
'1' => $AdminLangFile['mainform_u_redirect_new'],
'2' => $AdminLangFile['mainform_u_redirect_list'],
'3' => $AdminLangFile['mainform_u_redirect_config'],
);

function UnitAdd_Redirect($state) {
   switch($state) {
     case "1":
       $order = Redirect_Page_2("index.php?view=Add");
       break;
     case "2":
       $order = Redirect_Page_2("index.php?view=List");;
       break;
     case "3":
       $order = Redirect_Page_2("index.php?view=Config");;
       break;
     default:
       $order = Redirect_Page_2("index.php?view=Add");
   }
   return $order;
 }
 
 

##############################################################################################################################################################
################################ UnitEdit_Redirect
############################################################################################################################################################## 
$UnitEdit_Redirect = array(
'1' => $AdminLangFile['mainform_u_redirect_same'],
'2' => $AdminLangFile['mainform_u_redirect_list'],
'3' => $AdminLangFile['mainform_u_redirect_config'],
); 
function UnitEdit_Redirect($state) {
   switch($state) {
     case "1":
       $order = Redirect_Page_2(LASTREFFPAGE);
       break;
     case "2":
       $order = Redirect_Page_2("index.php?view=List");;
       break;
     case "3":
       $order = Redirect_Page_2("index.php?view=Config");;
       break;
     default:
       $order = Redirect_Page_2(LASTREFFPAGE);
   }
   return $order;
 } 







 
 
 
 


#################################################################################################################  
################################################################################################################# 


$Order_ByList_Art = array(
'1' =>  $AdminLangFile['mainform_list_by_order'],
'2' =>  $AdminLangFile['mainform_newest_to_older'],
'3' =>  $AdminLangFile['mainform_older_to_newest'],
'4' =>  $AdminLangFile['mainform_order_by_date'],
);

function RterunOrderName($state) {
    global $AdminLangFile ;
  switch($state) {
     case "1":
       $order = $AdminLangFile['mainform_list_by_order'];
       break;
     case "2":
       $order = $AdminLangFile['mainform_newest_to_older'] ;
       break;
     case "3":
       $order = $AdminLangFile['mainform_older_to_newest'];
       break;
     case "4":
       $order = ' ORDER BY date DESC ';
       break;
     default:
       $order = 'Error ';
   }
   return $order;   
    
}    




 



$Order_Trademarks = array('1' => "وفقا لعدد المنتجات",'2' => "الترتيب الاحدث الى الاقدم",'3' => "الترتيب الاقدم الى الاحدث",); 
 function RterunOrder_Trademarks($state) {
   switch($state) {
     case "1":
       $order = ' Order By count DESC';
       break;
     case "2":
       $order = '  ORDER BY id DESC ';
       break;
     case "3":
       $order = ' ORDER BY id ASC ';
       break;
     case "4":
       $order = ' ORDER BY date DESC ';
       break;
     default:
       $order = ' ORDER BY id DESC ';
   }
   return $order;
 }
 




################################################################################################################# 
############################################# Order_Country
################################################################################################################# 
$Order_Country = array (
    '1'=> "ترتيب بالــ  ID" ,
    '2'=> "ترتيب وفقا للاسم العربى تصاعديا" ,
    '3'=> "ترتيب وفقا للاسم العربى تنازليا ",
    '4'=> "ترتيب وفقا للاسم الغربى تصاعديا" ,
    '5'=> 'ترتيب وفقا للاسم الغربى تنازليا',
    );

$Order_Country = array (
    '1'=> "ترتيب بالــ  ID" ,
    '2'=> "ترتيب وفقا للاسم العربى تصاعديا" ,
    '3'=> "ترتيب وفقا للاسم العربى تنازليا ",
    );

 function RterunOrder_C($state) {
   switch($state) {
     case "1":
       $order = ' Order By id ';
       break;
     case "2":
       $order = ' ORDER BY name DESC ';
       break;
     case "3":
       $order = ' ORDER BY name ASC ';
       break;
     case "4":
       $order = ' ORDER BY name_en DESC ';
       break;
     case "5":
       $order = ' ORDER BY name_en ASC ';
       break;

       break;
     default:
       $order = ' ORDER BY id DESC ';
   }
   return $order;
 }  




#################################################################################################################  
################################################################################################################# 

$Order_City = array (
    '1'=> "ترتيب بالــ  ID" ,
    '2'=> "ترتيب وفقا للاسم العربى تصاعديا" ,
    '3'=> "ترتيب وفقا للاسم العربى تنازليا ",
    '4'=> "ترتيب وفقا للاسم الغربى تصاعديا" ,
    '5'=> 'ترتيب وفقا للاسم الغربى تنازليا',
    '6'=> 'وفقا للدولة',
    );    
  
 function RterunOrder_City($state) {
   switch($state) {
     case "1":
       $order = ' Order By id ';
       break;
     case "2":
       $order = ' ORDER BY name DESC ';
       break;
     case "3":
       $order = ' ORDER BY name ASC ';
       break;
     case "4":
       $order = ' ORDER BY name_en DESC ';
       break;
     case "5":
       $order = ' ORDER BY name_en ASC ';
       break;
     case "6":
       $order = ' ORDER BY cat_code ';
       break;
     default:
       $order = ' ORDER BY id DESC ';
   }
   return $order;
 } 



 

$Changefreq_var = array (
    '1'=> "always" ,
    '2'=> "hourly" ,
    '3'=> "daily",
    '4'=> "weekly" ,
    '5'=> 'monthly',
    '6'=> 'yearly',
    '7'=> 'never',
   );    

 function RterunOrder_Changefreq($state) {
   switch($state) {
     case "1":
       $order = 'always';
       break;
     case "2":
       $order = 'hourly';
       break;
     case "3":
       $order = 'daily';
       break;
     case "4":
       $order = 'weekly';
       break;
     case "5":
       $order = 'monthly';
       break;
     case "6":
       $order = 'yearly';
       break;
     case "7":
       $order = 'never';
       break;
     default:
       $order = 'always';
   }
   return $order;
 } 
   

$Priority_var = array (
    '1'=> "0.1" ,
    '2'=> "0.2" ,
    '3'=> "0.3",
    '4'=> "0.4" ,
    '5'=> '0.5',
    '6'=> '0.6',
    '7'=> '0.7',
    '8'=> '0.8',
    '9'=> '0.9',
    '10'=> '1.0',
   );  

function RterunOrder_Priority($state) {
   switch($state) {
     case "1":
       $order = '0.1';
       break;
     case "2":
       $order = '0.2';
       break;
     case "3":
       $order = '0.3';
       break;
     case "4":
       $order = '0.4';
       break;
     case "5":
       $order = '0.5';
       break;
     case "6":
       $order = '0.6';
       break;
     case "7":
       $order = '0.7';
       break;
     case "8":
       $order = '0.8';
       break;
     case "9":
       $order = '0.9';
       break;
     case "10":
       $order = '1.0';
       break;
     default:
       $order = '.0.5';
   }
   return $order;
 } 


 function RterunOrder_PhotoType($state) {
   switch($state) {
     case "1":
       $order = 'GIF';
       break;
     case "2":
       $order = 'JPG';
       break;
     case "3":
       $order = 'PNG';
       break;
     case "4":
       $order = 'SWF';
       break;
     case "5":
       $order = 'PSD';
       break;
     case "6":
       $order = 'BMP';
       break;
     case "7":
       $order = 'TIFF';
       break;
     default:
       $order = 'JPG';
   }
   return $order;
 } 
 


$TimeHour = array (
    '1'=> "12:00 AM" ,
    '2'=> "01:00 AM" ,
    '3'=> "02:00 AM" ,
    '4'=> "03:00 AM" ,
    '5'=> "04:00 AM" ,
    '6'=> "05:00 AM" ,
    '7'=> "06:00 AM" ,
    '8'=> "07:00 AM" ,
    '9'=> "08:00 AM" ,
    '10'=> "09:00 AM" ,
    '11'=> "10:00 AM" ,
    '12'=> "11:00 AM" ,
    '13'=> "12:00 PM" ,
    '14'=> "01:00 PM" ,
    '15'=> "02:00 PM" ,
    '16'=> "03:00 PM" ,
    '17'=> "04:00 PM" ,
    '18'=> "05:00 PM" ,
    '19'=> "06:00 PM" ,
    '20'=> "07:00 PM" ,
    '21'=> "08:00 PM" ,
    '22'=> "09:00 PM" ,
    '23'=> "10:00 PM" ,
    '24'=> "11:00 PM" ,
    
    );       


 function RterunTimeHour_ADD($state) {
     switch($state) {
       case "1":
         $Time =  "12:00 AM";
         break;
       case "2":
         $Time =  "01:00 AM";
         break;
       case "3":
         $Time =  "02:00 AM";
         break;
       case "4":
         $Time =  "03:00 AM";
         break;
       case "5":
         $Time =  "04:00 AM";
         break;
       case "6":
         $Time =  "05:00 AM";
         break;
       case "7":
         $Time =  "06:00 AM";
         break;
       case "8":
         $Time =  "07:00 AM";
         break;
 
       case "9":
         $Time =  "08:00 AM";
         break;
       case "10":
         $Time =  "09:00 AM";
         break;
       case "11":
         $Time =  "10:00 AM";
         break;
       case "12":
         $Time = "11:00 AM";
         break;
       case "13":
         $Time =  "12:00 PM";
         break;
       case "14":
         $Time =  "01:00 PM" ;
         break;
       case "15":
         $Time =  "02:00 PM";
         break;
       case "16":
         $Time =  "03:00 PM";
         break;
                    
       case "17":
         $Time =  "04:00 PM";
         break;
       case "18":
         $Time =  "05:00 PM";
         break;
       case "19":
         $Time =  "06:00 PM";
         break;
       case "20":
         $Time =  "07:00 PM";
         break;
       case "21":
         $Time =  "08:00 PM";
         break;
       case "22":
         $Time =  "09:00 PM";
         break;
       case "23":
         $Time =  "10:00 PM";
         break;
       case "24":
         $Time =  "11:00 PM";
         break;
        
       default:
         $Time = "00";
     }
   
   return $Time;
 } 
 
 function RterunTimeHour_Edit($state) {
     switch($state) {
       case "12:00 AM":
         $Time =  "1";
         break;
          
       case "01:00 AM":
         $Time =  "2";
         break;
       case "02:00 AM":
         $Time =  "3";
         break;
       case "03:00 AM":
         $Time =  "4";
         break;
       case "04:00 AM":
         $Time =  "5";
         break;
       case "05:00 AM":
         $Time =  "6";
         break;
       case "06:00 AM":
         $Time =  "7";
         break;
       case "07:00 AM":
         $Time =  "8";
         break;
       case "08:00 AM":
         $Time =  "9";
         break;
       case "09:00 AM":
         $Time =  "10";
         break;
       case "10:00 AM":
         $Time =  "11";
         break;
         
       case "11:00 AM":
         $Time =  "12";
         break;
       case "12:00 PM":
         $Time =  "13";
         break;
       case "01:00 PM":
         $Time =  "14";
         break;
       case "02:00 PM":
         $Time =  "15";
         break;
       case "03:00 PM":
         $Time =  "16";
         break;

       case "04:00 PM":
         $Time =  "17";
         break;
       case "05:00 PM":
         $Time =  "18";
         break;
       case "06:00 PM":
         $Time =  "19";
         break;
       case "07:00 PM":
         $Time =  "20";
         break;
       case "08:00 PM":
         $Time =  "21";
         break;
  
       case "09:00 PM":
         $Time =  "22";
         break;
       case "10:00 PM":
         $Time =  "23";
         break;
       case "11:00 PM":
         $Time =  "24";
         break;
       default:
         $Time = "00";
     }
   
   return $Time;
 }         


################################################################################################################# 
############################################# Subject_Type
################################################################################################################# 
$Subject_Type = array(
'1' =>  $AdminLangFile['class_subject_type_theory'],
'2' =>  $AdminLangFile['class_subject_type_practical'],
'3' =>  $AdminLangFile['class_subject_type_optional'],
'4' =>  $AdminLangFile['class_subject_type_mandatory'],
);

function RterunSubject_Type($state) {
    global $AdminLangFile ;
  switch($state) {
     case "1":
       $order = $AdminLangFile['class_subject_type_theory'];
       break;
     case "2":
       $order = $AdminLangFile['class_subject_type_practical'] ;
       break;
     case "3":
       $order = $AdminLangFile['class_subject_type_optional'];
       break;
     case "4":
       $order =  $AdminLangFile['class_subject_type_mandatory'];
       break;
     default:
       $order = 'Error ';
   }
   return $order;   
}    

     

################################################################################################################# 
############################################# Subject_Type
################################################################################################################# 


$TimeLineDay = array(
'1' => $AdminLangFile['timeline_sunday'],
'2' => $AdminLangFile['timeline_monday'],
'3' => $AdminLangFile['timeline_tuesday'],
'4' => $AdminLangFile['timeline_wednesday'],
'5' => $AdminLangFile['timeline_thursday'],
);



$BedroomsVall = array(
'0' => $AdminLangFile['ajex_studio'],
'1' => "1",
'2' => "2",
'3' => "3",
'4' => "4",
'5' => "5",
'6' => "6",
'7' => "7",
'8' => "7+",
'9' => $AdminLangFile['ajex_na'],
);

$BathroomsVall = array(
'0' => $AdminLangFile['ajex_na'],
'1' => "1",
'2' => "2",
'3' => "3",
'4' => "4",
'5' => "5",
'6' => "6",
'7' => "7",
'8' => "7+",
);

$FurnishedVall = array(
'0' => $AdminLangFile['ajex_no'],
'1' => $AdminLangFile['ajex_yes'],
'2' => $AdminLangFile['ajex_partly'],
);


$ParkingVall = array(
'0' =>$AdminLangFile['ajex_no'],
'1' => "1",
'2' => "2",
'3' => "3",
'4' => "4",
'5' => "5",
'6' => "6",
'7' => "7",
'8' => "8",
'9' => "9",
'10' => "10",
'11' => "10+",
);


$AreaArrList = array(
'1' => "100",
'2' => "200",
'3' => "300",
'4' => "400",
'5' => "500",
'6' => "600",
'7' => "700",
'8' => "800",
'9' => "900",
'10' => "10000",
'11' => "10000+",
);


       
      */ 
?>