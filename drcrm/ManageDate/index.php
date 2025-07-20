<?php
 
 require_once '../include/inc_reqfile.php';
 require_once '_index_config.php';
 require_once 'Process.php';
 
 
 $ConfigP = GetCatConfig($ConfigTabel);

 $AdminConfig = checkUser();
 $USER_PERMATION_List = $AdminConfig[USERPERMATION];
 $USER_PERMATION_Add = $AdminConfig[USERPERMATION_ADD];
 $USER_PERMATION_Edit = $AdminConfig[USERPERMATION_EDIT];
 $USER_PERMATION_Dell = $AdminConfig[USERPERMATION_DELL];
 
 
if($AdminConfig[USERPERMATION] == '1') {
$view = (isset($_GET['view']) && $_GET['view'] != '')?$_GET['view']:'';
switch($view) {

 




case 'UpDate':
$content =  UserPerMatianCont_2('UpDate.php',$USER_PERMATION_Edit,F_UPDATE_DATA);
$ThisMenuIs_li = $ThisMenuIs.'UpDate';
$PageTitle = $Module_H1.$AdminLangFile['managedate_update'] ;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = 'UpDate';
break; 


case 'Config':
$content =  UserPerMatianCont('Config.php',$USER_PERMATION_Edit);
$ThisMenuIs_li = $ThisMenuIs.'Config';
$PageTitle = $Module_H1.$AdminLangFile['mainform_tap_section_settings'] ;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = 'Config';
break; 


#################################################################################################################################
###################################################  Cust Sub List
#################################################################################################################################


case 'CustSubList':
$Fs_ListUrl = "CustSubList";
$content =  UserPerMatianCont('CustSub_List.php',$USER_PERMATION_List); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$PageTitle = $Module_H1.$AdminLangFile['managedate_custsub_but'] ;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl;
$Main_DataTabel = "f_cust_subtype";
$Sub_DataTabel = "f_cust_type";
$Fs_AddBut = "CustSubAdd";
$Fs_EditBut = "CustSubEdit";
$Fs_DellBut = "CustSubDell";
break; 


case 'CustSubAdd':
$Fs_ListUrl = "CustSubList";
$content =  UserPerMatianCont('CustSub_Add.php',$USER_PERMATION_Add); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$PageTitle = $Module_H1.$AdminLangFile['managedate_custsub_but'] ;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl;
$Main_DataTabel = "f_cust_subtype";
$Sub_DataTabel = "f_cust_type";
$Fs_AddBut = "CustSubAdd";
$Fs_EditBut = "CustSubEdit";
$Fs_DellBut = "CustSubDell";
break; 


case 'CustSubEdit':
$Fs_ListUrl = "CustSubList";
$content =   UserPerMatianCont('CustSub_Edit.php',$USER_PERMATION_Edit);
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$PageTitle = $Module_H1.$AdminLangFile['managedate_custsub_but'] ;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl;
$Main_DataTabel = "f_cust_subtype";
$Sub_DataTabel = "f_cust_type";
$Fs_AddBut = "CustSubAdd";
$Fs_EditBut = "CustSubEdit";
$Fs_DellBut = "CustSubDell";
$Fs_Count_tabel = "sales_ticket";
$Fs_Count_Filde = "c_type_2";
break; 


case 'CustSubDell':
$Fs_ListUrl = "CustSubList";
$content =  UserPerMatianCont('CustSub_Dell.php',$USER_PERMATION_Dell);
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$PageTitle = $Module_H1.$AdminLangFile['managedate_custsub_but'] ;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl;
$Main_DataTabel = "f_cust_subtype";
$Sub_DataTabel = "f_cust_type";
$Fs_AddBut = "CustSubAdd";
$Fs_EditBut = "CustSubEdit";
$Fs_DellBut = "CustSubDell";
$Fs_Count_tabel = "sales_ticket";
$Fs_Count_Filde = "c_type_2";
break; 


#################################################################################################################################
###################################################  Cust Sub List
#################################################################################################################################

/*
case 'CustSubList':
$content =  UserPerMatianCont('CustSub_List.php',$USER_PERMATION_List); 
$ThisMenuIs_li = $ThisMenuIs.'CustSubList';
$PageTitle = $Module_H1.$AdminLangFile['managedate_custsub_list'] ;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = 'CustSubList';
break; 


case 'CustSubAdd':
$content =  UserPerMatianCont('CustSub_Add.php',$USER_PERMATION_Add); 
$ThisMenuIs_li = $ThisMenuIs.'CustSubList';
$PageTitle = $Module_H1.$AdminLangFile['managedate_custsub_add'] ;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = 'CustSubList';
break; 


case 'CustSubEdit':
$content =   UserPerMatianCont('CustSub_Edit.php',$USER_PERMATION_Edit);
$ThisMenuIs_li = $ThisMenuIs.'CustSubList';
$PageTitle = $Module_H1.$AdminLangFile['managedate_custsub_edit'] ;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = 'CustSubList';
break; 


case 'CustSubDell':
$content =  UserPerMatianCont('CustSub_Dell.php',$USER_PERMATION_Dell);
$ThisMenuIs_li = $ThisMenuIs.'CustSubList';
$PageTitle = $Module_H1.$AdminLangFile['managedate_custsub_dell'] ;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = 'CustSubList';
break; 

*/

#################################################################################################################################
################################################### Lead Sours
#################################################################################################################################


case 'ListLeadSours':
$Fs_ListUrl = "ListLeadSours";
$content =  UserPerMatianCont_2('Data_List.php',$USER_PERMATION_List,F_LEAD_SOURS); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl ;
$PageTitle = $Module_H1.$AdminLangFile['managedate_lead_sours_list'] ;
$Fs_DataTabel = "fs_lead_sours";
$Fs_AddBut = "AddLeadSours";
$Fs_EditBut = "EditLeadSours";
$Fs_DellBut = "DellLeadSours";
break; 

case 'AddLeadSours':
$Fs_ListUrl = "ListLeadSours";
$content =  UserPerMatianCont_2('Data_Add.php',$USER_PERMATION_Add,F_LEAD_SOURS); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl;
$PageTitle = $Module_H1.$AdminLangFile['managedate_lead_sours_add'] ;
$Fs_DataTabel = "fs_lead_sours";
$Fs_AddBut = "AddLeadSours";
$Fs_EditBut = "EditLeadSours";
$Fs_DellBut = "DellLeadSours";
break; 


case 'EditLeadSours':
$Fs_ListUrl = "ListLeadSours";
$content =  UserPerMatianCont_2('Data_Edit.php',$USER_PERMATION_Edit,F_LEAD_SOURS); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl;
$PageTitle = $Module_H1.$AdminLangFile['managedate_lead_sours_edit'] ;
$Fs_DataTabel = "fs_lead_sours";
$Fs_AddBut = "AddLeadSours";
$Fs_EditBut = "EditLeadSours";
$Fs_DellBut = "DellLeadSours";
break; 


case 'DellLeadSours':
$Fs_ListUrl = "ListLeadSours";
$content =  UserPerMatianCont_2('Data_Dell.php',$USER_PERMATION_Dell,F_LEAD_SOURS); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl;
$PageTitle = $Module_H1.$AdminLangFile['managedate_lead_sours_dell'] ;
$Fs_DataTabel = "fs_lead_sours";
$Fs_AddBut = "AddLeadSours";
$Fs_EditBut = "EditLeadSours";
$Fs_DellBut = "DellLeadSours";
$Fs_Subtabel = "sales_ticket";
$Fs_Subtabel_Filde = "lead_sours";
break; 



#################################################################################################################################
################################################### Lead Type
#################################################################################################################################


case 'ListLeadType':
$Fs_ListUrl = "ListLeadType";
$content =  UserPerMatianCont_2('Data_List.php',$USER_PERMATION_List,F_LEAD_TYPE); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl ;
$PageTitle = $Module_H1.$AdminLangFile['managedate_lead_type_list'] ;
$Fs_DataTabel = "fs_lead_type";
$Fs_AddBut = "AddLeadType";
$Fs_EditBut = "EditLeadType";
$Fs_DellBut = "DellLeadType";
break; 

case 'AddLeadType':
$Fs_ListUrl = "ListLeadType";
$content =  UserPerMatianCont_2('Data_Add.php',$USER_PERMATION_Add,F_LEAD_TYPE); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl;
$PageTitle = $Module_H1.$AdminLangFile['managedate_lead_type_add'] ;
$Fs_DataTabel = "fs_lead_type";
$Fs_AddBut = "AddLeadType";
$Fs_EditBut = "EditLeadType";
$Fs_DellBut = "DellLeadType";
break; 


case 'EditLeadType':
$Fs_ListUrl = "ListLeadType";
$content =  UserPerMatianCont_2('Data_Edit.php',$USER_PERMATION_Edit,F_LEAD_TYPE); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl;
$PageTitle = $Module_H1.$AdminLangFile['managedate_lead_type_edit'] ;
$Fs_DataTabel = "fs_lead_type";
$Fs_AddBut = "AddLeadType";
$Fs_EditBut = "EditLeadType";
$Fs_DellBut = "DellLeadType";
break; 


case 'DellLeadType':
$Fs_ListUrl = "ListLeadType";
$content =  UserPerMatianCont_2('Data_Dell.php',$USER_PERMATION_Dell,F_LEAD_TYPE); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl;
$PageTitle = $Module_H1.$AdminLangFile['managedate_lead_type_dell'] ;
$Fs_DataTabel = "fs_lead_type";
$Fs_AddBut = "AddLeadType";
$Fs_EditBut = "EditLeadType";
$Fs_DellBut = "DellLeadType";
$Fs_Subtabel = "sales_ticket";
$Fs_Subtabel_Filde = "lead_type";
break; 

#################################################################################################################################
################################################### Country
#################################################################################################################################
case 'Country':
$Fs_ListUrl = "Country";
$content =  UserPerMatianCont_2('Data_List.php',$USER_PERMATION_List,F_COUNTRY_ID); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl ;
$PageTitle = $Module_H1.$AdminLangFile['managedate_country_list'] ;
$Fs_DataTabel = "fi_country";
$Fs_AddBut = "CountryAdd";
$Fs_EditBut = "CountryEdit";
$Fs_DellBut = "CountryDell";
break; 

case 'CountryAdd':
$Fs_ListUrl = "Country";
$content =  UserPerMatianCont_2('Data_Add.php',$USER_PERMATION_Add,F_COUNTRY_ID); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl;
$PageTitle = $Module_H1.$AdminLangFile['managedate_country_add'] ;
$Fs_DataTabel = "fi_country";
$Fs_AddBut = "CountryAdd";
$Fs_EditBut = "CountryEdit";
$Fs_DellBut = "CountryDell";
break; 


case 'CountryEdit':
$Fs_ListUrl = "Country";
$content =  UserPerMatianCont_2('Data_Edit.php',$USER_PERMATION_Edit,F_COUNTRY_ID); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl;
$PageTitle = $Module_H1.$AdminLangFile['managedate_country_edit'] ;
$Fs_DataTabel = "fi_country";
$Fs_AddBut = "CountryAdd";
$Fs_EditBut = "CountryEdit";
$Fs_DellBut = "CountryDell";
break; 


case 'CountryDell':
$Fs_ListUrl = "Country";
$content =  UserPerMatianCont_2('Data_Dell.php',$USER_PERMATION_Dell,F_COUNTRY_ID); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl;
$PageTitle = $Module_H1.$AdminLangFile['managedate_country_dell'] ;
$Fs_DataTabel = "fi_country";
$Fs_AddBut = "CountryAdd";
$Fs_EditBut = "CountryEdit";
$Fs_DellBut = "CountryDell";
$Fs_Subtabel = "customer";
$Fs_Subtabel_Filde = "country_id";
break; 

#################################################################################################################################
################################################### City
#################################################################################################################################


case 'City':
$Fs_ListUrl = "City";
$content =  UserPerMatianCont_2('Data_List.php',$USER_PERMATION_List,F_CITY_ID); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl ;
$PageTitle = $Module_H1.$AdminLangFile['managedate_city_list'] ;
$Fs_DataTabel = "fi_city";
$Fs_AddBut = "CityAdd";
$Fs_EditBut = "CityEdit";
$Fs_DellBut = "CityDell";
break; 

case 'CityAdd':
$Fs_ListUrl = "City";
$content =  UserPerMatianCont_2('Data_Add.php',$USER_PERMATION_Add,F_CITY_ID); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl;
$PageTitle = $Module_H1.$AdminLangFile['managedate_city_add'] ;
$Fs_DataTabel = "fi_city";
$Fs_AddBut = "CityAdd";
$Fs_EditBut = "CityEdit";
$Fs_DellBut = "CityDell";
break; 


case 'CityEdit':
$Fs_ListUrl = "City";
$content =  UserPerMatianCont_2('Data_Edit.php',$USER_PERMATION_Edit,F_CITY_ID); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl;
$PageTitle = $Module_H1.$AdminLangFile['managedate_city_edit'] ;
$Fs_DataTabel = "fi_city";
$Fs_AddBut = "CityAdd";
$Fs_EditBut = "CityEdit";
$Fs_DellBut = "CityDell";
break; 


case 'CityDell':
$Fs_ListUrl = "City";
$content =  UserPerMatianCont_2('Data_Dell.php',$USER_PERMATION_Dell,F_CITY_ID); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl;
$PageTitle = $Module_H1.$AdminLangFile['managedate_delete_city'] ;
$Fs_DataTabel = "fi_city";
$Fs_AddBut = "CityAdd";
$Fs_EditBut = "CityEdit";
$Fs_DellBut = "CityDell";
$Fs_Subtabel = "customer";
$Fs_Subtabel_Filde = "city_id";
break; 


#################################################################################################################################
################################################### List Social
#################################################################################################################################
case 'ListSocial':
$Fs_ListUrl = "ListSocial";
$content =  UserPerMatianCont_2('CatId_Data_List.php',$USER_PERMATION_List,F_SOCIAL_ID); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl ;
$PageTitle = $Module_H1.$AdminLangFile['managedate_social_list'] ;
$Fs_DataTabel = TABEL_SOCIAL ;
$Fs_AddBut = "AddSocial";
$Fs_EditBut = "EditSocial";
$Fs_DellBut = "DellSocial";
break; 

case 'AddSocial':
$Fs_ListUrl = "ListSocial";
$content =  UserPerMatianCont_2('CatId_Data_Add.php',$USER_PERMATION_Add,F_SOCIAL_ID); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl;
$PageTitle = $Module_H1.$AdminLangFile['managedate_social_add'] ;
$Fs_DataTabel = TABEL_SOCIAL ;
$Fs_AddBut = "AddSocial";
$Fs_EditBut = "EditSocial";
$Fs_DellBut = "DellSocial";
break; 


case 'EditSocial':
$Fs_ListUrl = "ListSocial";
$content =  UserPerMatianCont_2('CatId_Data_Edit.php',$USER_PERMATION_Edit,F_SOCIAL_ID); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl;
$PageTitle = $Module_H1.$AdminLangFile['managedate_social_edit'] ;
$Fs_DataTabel = TABEL_SOCIAL ;
$Fs_AddBut = "AddSocial";
$Fs_EditBut = "EditSocial";
$Fs_DellBut = "DellSocial";
break; 


case 'DellSocial':
$Fs_ListUrl = "ListSocial";
$content =  UserPerMatianCont_2('CatId_Data_Dell.php',$USER_PERMATION_Dell,F_SOCIAL_ID); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl;
$PageTitle = $Module_H1.$AdminLangFile['managedate_social_dell'] ;
$Fs_DataTabel = TABEL_SOCIAL;
$Fs_AddBut = "AddSocial";
$Fs_EditBut = "EditSocial";
$Fs_DellBut = "DellSocial";
$Fs_Subtabel = "customer";
$Fs_Subtabel_Filde = "social_id";
break; 


#################################################################################################################################
################################################### List Jop
#################################################################################################################################

case 'ListJop':
$Fs_ListUrl = "ListJop";
$content =  UserPerMatianCont_2('CatId_Data_List.php',$USER_PERMATION_List,F_JOP_ID);  
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl ;
$PageTitle = $Module_H1.$AdminLangFile['managedate_jop_list'] ;
$Fs_DataTabel = TABEL_JOP;
$Fs_AddBut = "AddJop";
$Fs_EditBut = "EditJop";
$Fs_DellBut = "DellJop";
break; 

case 'AddJop':
$Fs_ListUrl = "ListJop";
$content =  UserPerMatianCont_2('CatId_Data_Add.php',$USER_PERMATION_Add,F_JOP_ID);  
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl;
$PageTitle = $Module_H1.$AdminLangFile['managedate_jop_add'] ;
$Fs_DataTabel = TABEL_JOP ;
$Fs_AddBut = "AddJop";
$Fs_EditBut = "EditJop";
$Fs_DellBut = "DellJop";
break; 


case 'EditJop':
$Fs_ListUrl = "ListJop";
$content =  UserPerMatianCont_2('CatId_Data_Edit.php',$USER_PERMATION_Edit,F_JOP_ID);  
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl;
$PageTitle = $Module_H1.$AdminLangFile['managedate_jop_edit'] ;
$Fs_DataTabel = TABEL_JOP ;
$Fs_AddBut = "AddJop";
$Fs_EditBut = "EditJop";
$Fs_DellBut = "DellJop";
break; 


case 'DellJop':
$Fs_ListUrl = "ListJop";
$content =  UserPerMatianCont_2('CatId_Data_Dell.php',$USER_PERMATION_Dell,F_JOP_ID);  
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl;
$PageTitle = $Module_H1.$AdminLangFile['managedate_jop_dell'] ;
$Fs_DataTabel = TABEL_JOP ;
$Fs_AddBut = "AddJop";
$Fs_EditBut = "EditJop";
$Fs_DellBut = "DellJop";
$Fs_Subtabel = "customer";
$Fs_Subtabel_Filde = "jop_id";
break; 


#################################################################################################################################
################################################### LeadCat
#################################################################################################################################

case 'LeadCat':
$Fs_ListUrl = "LeadCat";
$content =  UserPerMatianCont_2('CatId_Data_List.php',$USER_PERMATION_List,F_LEAD_CAT);
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl ;
$PageTitle = $Module_H1.$AdminLangFile['managedate_leadcat_list'] ;
$Fs_DataTabel = TABEL_LEAD_CAT;
$Fs_AddBut = "LeadCatAdd";
$Fs_EditBut = "LeadCatEdit";
$Fs_DellBut = "LeadCatDell";
break; 

case 'LeadCatAdd':
$Fs_ListUrl = "LeadCat";
$content =  UserPerMatianCont_2('CatId_Data_Add.php',$USER_PERMATION_Add,F_LEAD_CAT);
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl;
$PageTitle = $Module_H1.$AdminLangFile['managedate_leadcat_add'] ;
$Fs_DataTabel = TABEL_LEAD_CAT ;
$Fs_AddBut = "LeadCatAdd";
$Fs_EditBut = "LeadCatEdit";
$Fs_DellBut = "LeadCatDell";
break; 


case 'LeadCatEdit':
$Fs_ListUrl = "LeadCat";
$content =  UserPerMatianCont_2('CatId_Data_Edit.php',$USER_PERMATION_Edit,F_LEAD_CAT);
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = TABEL_LEAD_CAT;
$PageTitle = $Module_H1.$AdminLangFile['managedate_leadcat_edit'] ;
$Fs_DataTabel = "fs_lead_cat";
$Fs_AddBut = "LeadCatAdd";
$Fs_EditBut = "LeadCatEdit";
$Fs_DellBut = "LeadCatDell";
break; 

case 'LeadCatDell':
$Fs_ListUrl = "LeadCat";
$content =  UserPerMatianCont_2('CatId_Data_Dell.php',$USER_PERMATION_Dell,F_LEAD_CAT); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl;
$PageTitle = $Module_H1.$AdminLangFile['managedate_leadcat_dell'] ;
$Fs_DataTabel = TABEL_LEAD_CAT;
$Fs_AddBut = "LeadCatAdd";
$Fs_EditBut = "LeadCatEdit";
$Fs_DellBut = "LeadCatDell";
$Fs_Subtabel = "sales_ticket";
$Fs_Subtabel_Filde = "lead_cat";
break; 


#################################################################################################################################
###################################################   ListCash
#################################################################################################################################


case 'ListCash':
$Fs_ListUrl = "ListCash";
$content =  UserPerMatianCont_2('CatId_Data_List.php',$USER_PERMATION_List,F_CASH_ID); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl ;
$PageTitle = $Module_H1.$AdminLangFile['managedate_cash_list'] ;
$Fs_DataTabel = TABEL_CASH ;
$Fs_AddBut = "AddCash";
$Fs_EditBut = "EditCash";
$Fs_DellBut = "DellCash";
break; 

case 'AddCash':
$Fs_ListUrl = "ListCash";
$content =  UserPerMatianCont_2('CatId_Data_Add.php',$USER_PERMATION_Add,F_CASH_ID); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl;
$PageTitle = $Module_H1.$AdminLangFile['managedate_cash_add'] ;
$Fs_DataTabel = TABEL_CASH ;
$Fs_AddBut = "AddCash";
$Fs_EditBut = "EditCash";
$Fs_DellBut = "DellCash";
break; 


case 'EditCash':
$Fs_ListUrl = "ListCash";
$content =  UserPerMatianCont_2('CatId_Data_Edit.php',$USER_PERMATION_Edit,F_CASH_ID); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl;
$PageTitle = $Module_H1.$AdminLangFile['managedate_cash_edit'] ;
$Fs_DataTabel = TABEL_CASH ;
$Fs_AddBut = "AddCash";
$Fs_EditBut = "EditCash";
$Fs_DellBut = "DellCash";
break; 


case 'DellCash':
$Fs_ListUrl = "ListCash";
$content =  UserPerMatianCont_2('CatId_Data_Dell.php',$USER_PERMATION_Dell,F_CASH_ID); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl;
$PageTitle = $Module_H1.$AdminLangFile['managedate_cash_dell'] ;
$Fs_DataTabel = TABEL_CASH ;
$Fs_AddBut = "AddCash";
$Fs_EditBut = "EditCash";
$Fs_DellBut = "DellCash";
$Fs_Subtabel = "sales_ticket";
$Fs_Subtabel_Filde = "cash_id";
break; 




#################################################################################################################################
################################################### ListArea
#################################################################################################################################

case 'ListArea':
$Fs_ListUrl = "ListArea";
$content =  UserPerMatianCont_2('CatId_Data_List.php',$USER_PERMATION_List,F_AREA_ID); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl ;
$PageTitle = $Module_H1.$AdminLangFile['managedate_area_list'] ;
$Fs_DataTabel = TABEL_AREA ;
$Fs_AddBut = "AddArea";
$Fs_EditBut = "EditArea";
$Fs_DellBut = "DellArea";
break; 

case 'AddArea':
$Fs_ListUrl = "ListArea";
$content =  UserPerMatianCont_2('CatId_Data_Add.php',$USER_PERMATION_Add,F_AREA_ID); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl;
$PageTitle = $Module_H1.$AdminLangFile['managedate_area_add'] ;
$Fs_DataTabel = TABEL_AREA ;
$Fs_AddBut = "AddArea";
$Fs_EditBut = "EditArea";
$Fs_DellBut = "DellArea";
break; 


case 'EditArea':
$Fs_ListUrl = "ListArea";
$content =  UserPerMatianCont_2('CatId_Data_Edit.php',$USER_PERMATION_Edit,F_AREA_ID); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl;
$PageTitle = $Module_H1.$AdminLangFile['managedate_area_edit'] ;
$Fs_DataTabel = TABEL_AREA ;
$Fs_AddBut = "AddArea";
$Fs_EditBut = "EditArea";
$Fs_DellBut = "DellArea";
break; 


case 'DellArea':
$Fs_ListUrl = "ListArea";
$content =  UserPerMatianCont_2('CatId_Data_Dell.php',$USER_PERMATION_Dell,F_AREA_ID); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl;
$PageTitle = $Module_H1.$AdminLangFile['managedate_area_dell'] ;
$Fs_DataTabel = TABEL_AREA ;
$Fs_AddBut = "AddArea";
$Fs_EditBut = "EditArea";
$Fs_DellBut = "DellArea";
$Fs_Subtabel = "sales_ticket";
$Fs_Subtabel_Filde = "area_id";
break; 


#################################################################################################################################
################################################### ListBestcall
#################################################################################################################################


case 'ListBestcall':
$Fs_ListUrl = "ListBestcall";
$content =  UserPerMatianCont_2('CatId_Data_List.php',$USER_PERMATION_List,F_BEST_CALL_ID); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl ;
$PageTitle = $Module_H1.$AdminLangFile['managedate_bestcall_list'] ;
$Fs_DataTabel = TABEL_BEST_CALL ;
$Fs_AddBut = "AddBestcall";
$Fs_EditBut = "EditBestcall";
$Fs_DellBut = "DellBestcall";
break; 

case 'AddBestcall':
$Fs_ListUrl = "ListBestcall";
$content =  UserPerMatianCont_2('CatId_Data_Add.php',$USER_PERMATION_Add,F_BEST_CALL_ID); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl;
$PageTitle = $Module_H1.$AdminLangFile['managedate_bestcall_add'] ;
$Fs_DataTabel = TABEL_BEST_CALL ;
$Fs_AddBut = "AddBestcall";
$Fs_EditBut = "EditBestcall";
$Fs_DellBut = "DellBestcall";
break; 


case 'EditBestcall':
$Fs_ListUrl = "ListBestcall";
$content =  UserPerMatianCont_2('CatId_Data_Edit.php',$USER_PERMATION_Edit,F_BEST_CALL_ID); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl;
$PageTitle = $Module_H1.$AdminLangFile['managedate_bestcall_edit'] ;
$Fs_DataTabel = TABEL_BEST_CALL ;
$Fs_AddBut = "AddBestcall";
$Fs_EditBut = "EditBestcall";
$Fs_DellBut = "DellBestcall";
break; 


case 'DellBestcall':
$Fs_ListUrl = "ListBestcall";
$content =  UserPerMatianCont_2('CatId_Data_Dell.php',$USER_PERMATION_Dell,F_BEST_CALL_ID); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl;
$PageTitle = $Module_H1.$AdminLangFile['managedate_bestcall_dell'] ;
$Fs_DataTabel = TABEL_BEST_CALL ;
$Fs_AddBut = "AddBestcall";
$Fs_EditBut = "EditBestcall";
$Fs_DellBut = "DellBestcall";
$Fs_Subtabel = "sales_ticket";
$Fs_Subtabel_Filde = "bestcall_id";
break; 



#################################################################################################################################
################################################### ListTime
#################################################################################################################################


case 'ListTime':
$Fs_ListUrl = "ListTime";
$content =  UserPerMatianCont_2('CatId_Data_List.php',$USER_PERMATION_List,F_CALL_TIME_ID); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl ;
$PageTitle = $Module_H1.$AdminLangFile['managedate_time_list'] ;
$Fs_DataTabel = TABEL_CALL_TIME ;
$Fs_AddBut = "AddTime";
$Fs_EditBut = "EditTime";
$Fs_DellBut = "DellTime";
break; 

case 'AddTime':
$Fs_ListUrl = "ListTime";
$content =  UserPerMatianCont_2('CatId_Data_Add.php',$USER_PERMATION_Add,F_CALL_TIME_ID); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl;
$PageTitle = $Module_H1.$AdminLangFile['managedate_time_add'] ;
$Fs_DataTabel = TABEL_CALL_TIME ;
$Fs_AddBut = "AddTime";
$Fs_EditBut = "EditTime";
$Fs_DellBut = "DellTime";
break; 


case 'EditTime':
$Fs_ListUrl = "ListTime";
$content =  UserPerMatianCont_2('CatId_Data_Edit.php',$USER_PERMATION_Edit,F_CALL_TIME_ID); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl;
$PageTitle = $Module_H1.$AdminLangFile['managedate_time_edit'] ;
$Fs_DataTabel = TABEL_CALL_TIME ;
$Fs_AddBut = "AddTime";
$Fs_EditBut = "EditTime";
$Fs_DellBut = "DellTime";
break; 


case 'DellTime':
$Fs_ListUrl = "ListTime";
$content =  UserPerMatianCont_2('CatId_Data_Dell.php',$USER_PERMATION_Dell,F_CALL_TIME_ID); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl;
$PageTitle = $Module_H1.$AdminLangFile['managedate_time_dell'] ;
$Fs_DataTabel = TABEL_CALL_TIME ;
$Fs_AddBut = "AddTime";
$Fs_EditBut = "EditTime";
$Fs_DellBut = "DellTime";
$Fs_Subtabel = "sales_ticket";
$Fs_Subtabel_Filde = "time_id";
break; 



#################################################################################################################################
################################################### ListDate
#################################################################################################################################
case 'ListDate':
$Fs_ListUrl = "ListDate";
$content =  UserPerMatianCont_2('CatId_Data_List.php',$USER_PERMATION_List,F_DATE_RECEIPT_ID); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl ;
$PageTitle = $Module_H1.$AdminLangFile['managedate_date_list'] ;
$Fs_DataTabel = TABEL_DATE_RECEIPT ;
$Fs_AddBut = "AddDate";
$Fs_EditBut = "EditDate";
$Fs_DellBut = "DellDate";
break; 

case 'AddDate':
$Fs_ListUrl = "ListDate";
$content =  UserPerMatianCont_2('CatId_Data_Add.php',$USER_PERMATION_Add,F_DATE_RECEIPT_ID); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl;
$PageTitle = $Module_H1.$AdminLangFile['managedate_date_add'] ;
$Fs_DataTabel = TABEL_DATE_RECEIPT ;
$Fs_AddBut = "AddDate";
$Fs_EditBut = "EditDate";
$Fs_DellBut = "DellDate";
break; 


case 'EditDate':
$Fs_ListUrl = "ListDate";
$content =  UserPerMatianCont_2('CatId_Data_Edit.php',$USER_PERMATION_Edit,F_DATE_RECEIPT_ID); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl;
$PageTitle = $Module_H1.$AdminLangFile['managedate_date_edit'] ;
$Fs_DataTabel = TABEL_DATE_RECEIPT ;
$Fs_AddBut = "AddDate";
$Fs_EditBut = "EditDate";
$Fs_DellBut = "DellDate";
break; 


case 'DellDate':
$Fs_ListUrl = "ListDate";
$content =  UserPerMatianCont_2('CatId_Data_Dell.php',$USER_PERMATION_Dell,F_DATE_RECEIPT_ID); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl;
$PageTitle = $Module_H1.$AdminLangFile['managedate_date_dell'] ;
$Fs_DataTabel = TABEL_DATE_RECEIPT ;
$Fs_AddBut = "AddDate";
$Fs_EditBut = "EditDate";
$Fs_DellBut = "DellDate";
$Fs_Subtabel = "sales_ticket";
$Fs_Subtabel_Filde = "date_id";
break; 


#################################################################################################################################
###################################################  ListUnit Type
#################################################################################################################################
case 'ListUnit':
$Fs_ListUrl = "ListUnit";
$content =  UserPerMatianCont_2('CatId_Data_List.php',$USER_PERMATION_List,F_UNIT_TYPE_ID); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl ;
$PageTitle = $Module_H1.$AdminLangFile['managedate_unit_list'] ;
$Fs_DataTabel = TABEL_UNIT_TYPE ;
$Fs_AddBut = "AddUnit";
$Fs_EditBut = "EditUnit";
$Fs_DellBut = "DellUnit";
break; 

case 'AddUnit':
$Fs_ListUrl = "ListUnit";
$content =  UserPerMatianCont_2('CatId_Data_Add.php',$USER_PERMATION_Add,F_UNIT_TYPE_ID); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl;
$PageTitle = $Module_H1.$AdminLangFile['managedate_unit_add'] ;
$Fs_DataTabel =  TABEL_UNIT_TYPE ;
$Fs_AddBut = "AddUnit";
$Fs_EditBut = "EditUnit";
$Fs_DellBut = "DellUnit";
break; 


case 'EditUnit':
$Fs_ListUrl = "ListUnit";
$content =  UserPerMatianCont_2('CatId_Data_Edit.php',$USER_PERMATION_Edit,F_UNIT_TYPE_ID); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl;
$PageTitle = $Module_H1.$AdminLangFile['managedate_unit_edit'] ;
$Fs_DataTabel =  TABEL_UNIT_TYPE ;
$Fs_AddBut = "AddUnit";
$Fs_EditBut = "EditUnit";
$Fs_DellBut = "DellUnit";
break; 


case 'DellUnit':
$Fs_ListUrl = "ListUnit";
$content =  UserPerMatianCont_2('CatId_Data_Dell.php',$USER_PERMATION_Dell,F_UNIT_TYPE_ID); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl;
$PageTitle = $Module_H1.$AdminLangFile['managedate_unit_dell'] ;
$Fs_DataTabel =  TABEL_UNIT_TYPE ;
$Fs_AddBut = "AddUnit";
$Fs_EditBut = "EditUnit";
$Fs_DellBut = "DellUnit";
$Fs_Subtabel = "sales_ticket";
$Fs_Subtabel_Filde = "unit_id";
break; 


#################################################################################################################################
###################################################   ListOpenReason
#################################################################################################################################
case 'ListOpenReason':
$Fs_ListUrl = "ListOpenReason";
$content =  UserPerMatianCont_2('CatId_Data_List.php',$USER_PERMATION_List,F_REASON_T_ID); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl ;
$PageTitle = $Module_H1.$AdminLangFile['managedate_reason_list'] ;
$Fs_DataTabel = TABEL_REASON_TICKET ;
$Fs_AddBut = "AddOpenReason";
$Fs_EditBut = "EditOpenReason";
$Fs_DellBut = "DellOpenReason";
break; 

case 'AddOpenReason':
$Fs_ListUrl = "ListOpenReason";
$content =  UserPerMatianCont_2('CatId_Data_Add.php',$USER_PERMATION_Add,F_REASON_T_ID); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl;
$PageTitle = $Module_H1.$AdminLangFile['managedate_reason_add'] ;
$Fs_DataTabel = TABEL_REASON_TICKET ;
$Fs_AddBut = "AddOpenReason";
$Fs_EditBut = "EditOpenReason";
$Fs_DellBut = "DellOpenReason";
break; 


case 'EditOpenReason':
$Fs_ListUrl = "ListOpenReason";
$content =  UserPerMatianCont_2('CatId_Data_Edit.php',$USER_PERMATION_Edit,F_REASON_T_ID); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl;
$PageTitle = $Module_H1.$AdminLangFile['managedate_reason_edit'] ;
$Fs_DataTabel = TABEL_REASON_TICKET ;
$Fs_AddBut = "AddOpenReason";
$Fs_EditBut = "EditOpenReason";
$Fs_DellBut = "DellOpenReason";
break; 


case 'DellOpenReason':
$Fs_ListUrl = "ListOpenReason";
$content =  UserPerMatianCont_2('CatId_Data_Dell.php',$USER_PERMATION_Dell,F_REASON_T_ID); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl;
$PageTitle = $Module_H1.$AdminLangFile['managedate_reason_dell'] ;
$Fs_DataTabel = TABEL_REASON_TICKET ;
$Fs_AddBut = "AddOpenReason";
$Fs_EditBut = "EditOpenReason";
$Fs_DellBut = "DellOpenReason";
$Fs_Subtabel = "cust_ticket";
$Fs_Subtabel_Filde = "reason_id";
break; 


#################################################################################################################################
###################################################   List COURS 
#################################################################################################################################
case 'ListCours':
$Fs_ListUrl = "ListCours";
$content =  UserPerMatianCont_2('CatId_Data_List.php',$USER_PERMATION_List,F_COURS); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl ;
$PageTitle = $Module_H1.$AdminLangFile['managedate_cours_but'] ;
$Fs_DataTabel = TABEL_COURS ;
$Fs_AddBut = "AddCours";
$Fs_EditBut = "EditCours";
$Fs_DellBut = "DellCours";
break; 

case 'AddCours':
$Fs_ListUrl = "ListCours";
$content =  UserPerMatianCont_2('CatId_Data_Add.php',$USER_PERMATION_Add,F_COURS); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl;
$PageTitle = $Module_H1.$AdminLangFile['managedate_cours_but'] ;
$Fs_DataTabel = TABEL_COURS ;
$Fs_AddBut = "AddCours";
$Fs_EditBut = "EditCours";
$Fs_DellBut = "DellCours";
break; 


case 'EditCours':
$Fs_ListUrl = "ListCours";
$content =  UserPerMatianCont_2('CatId_Data_Edit.php',$USER_PERMATION_Edit,F_COURS); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl;
$PageTitle = $Module_H1.$AdminLangFile['managedate_cours_but'] ;
$Fs_DataTabel = TABEL_COURS ;
$Fs_AddBut = "AddCours";
$Fs_EditBut = "EditCours";
$Fs_DellBut = "DellCours";
break; 


case 'DellCours':
$Fs_ListUrl = "ListCours";
$content =  UserPerMatianCont_2('CatId_Data_Dell.php',$USER_PERMATION_Dell,F_COURS); 
$ThisMenuIs_li = $ThisMenuIs.$Fs_ListUrl;
$Short_Menu = '_Short_Menu.php';
$Short_Menu_Sel = $Fs_ListUrl;
$PageTitle = $Module_H1.$AdminLangFile['managedate_cours_but'] ;
$Fs_DataTabel = TABEL_COURS ;
$Fs_AddBut = "AddCours";
$Fs_EditBut = "EditCours";
$Fs_DellBut = "DellCours";
$Fs_Subtabel = "sales_ticket";
$Fs_Subtabel_Filde = "cours_id";
break; 





default:
       $content =  '../include/Page_Empty.php';
       $PageTitle = $Module_H1.$AdminLangFile['mainform_emptypage'];
       $Short_Menu = '_Short_Menu.php';
   }
} else {
   SendMassgeforuser2();
}
require_once $TemplatePhth;

?>