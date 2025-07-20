<?php
if (!defined('WEB_ROOT')) {
    exit;
}


######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);


$GroupTabel = "project";
$ThisTabelName = "project";
$PERpage = $ConfigP['perpage_unit'];
$orderby = RterunOrder($ConfigP['order_by_unit']);

if ($ConfigP['but_name'] == '1') {
    $But_name_Sate = '1';
} else {
    $But_name_Sate = '2';
}

#################################################################################################################################
###################################################    List View
#################################################################################################################################
if ($view == 'List') {
    $ListCruntBut = "btn-success";
    $ListLast = "btn-success";
    if (isset($_GET['Area_Id'])) {
        $area_id = intval($_GET['Area_Id']);
        $THESQL = "SELECT * FROM $GroupTabel where area_id = '$area_id' $orderby";
        $THELINK = "view=List&Area_Id=" . $area_id;
    } elseif (isset($_GET['Crunt'])) {
        $Crunt = intval($_GET['Crunt']);
        $THESQL = "SELECT * FROM $GroupTabel where crunt = '$Crunt' $orderby";
        $THELINK = "view=List&$Crunt=" . $Crunt;
    } else {
        $THESQL = "SELECT * FROM $GroupTabel $orderby ";
        $THELINK = "view=List";

    }
} elseif ($view == 'ListCrunt') {
    $ListCruntBut = "btn-danger";
    $ListLast = "btn-success";
    if (isset($_GET['Area_Id'])) {
        $area_id = intval($_GET['Area_Id']);
        $THESQL = "SELECT * FROM $GroupTabel where crunt = '1' and area_id = '$area_id' $orderby";
        $THELINK = "view=List&Area_Id=" . $area_id;
    } else {
        $THESQL = "SELECT * FROM $GroupTabel where crunt = '1'  $orderby ";
        $THELINK = "view=ListCrunt";
    }
} elseif ($view == 'ListLast') {
    $ListLast = "btn-danger";
    $ListCruntBut = "btn-success";
    if (isset($_GET['Area_Id'])) {
        $area_id = intval($_GET['Area_Id']);
        $THESQL = "SELECT * FROM $GroupTabel where crunt = '0' and  area_id = '$area_id' $orderby";
        $THELINK = "view=List&Area_Id=" . $area_id;
    } else {
        $THESQL = "SELECT * FROM $GroupTabel where crunt = '0'  $orderby ";
        $THELINK = "view=ListCrunt";
    }
} elseif ($view == 'Search') {
    echo trim(Clean_Mypost($_POST['pro_name']));
    echo "Hany";
}


#################################################################################################################################
###################################################    Form 
#################################################################################################################################
echo '<form name="myform_cc" method="post">';
echo '<div class="row">
<div class="col-md-12 Row_Top Row_Top_link flitrco">';
echo NF_PrintBut_TD('1', $AdminLangFile['project_creunt_but'], "ListCrunt", $ListCruntBut, "fa-plus-circle");
echo NF_PrintBut_TD('1', $AdminLangFile['project_last_but'], "ListLast", $ListLast, "fa-plus-circle");

echo '<div class="flitrco_c">';
$Arr = array("Label" => 'off', "Active" => '1');
$Err[] = NF_PrintSelect_2018("Chosen", $AdminLangFile['project_area_name'], "col-md-4", "area", "project_area", "req_x", 0, $Arr);
echo '</div>';


echo '<div class="flitrco_c">';
echo '<input type="text"  name="pro_name" placeholder="' . $AdminLangFile['project_filtr_text'] . '" class="TypeText form-control" />';
echo '</div>';


echo '<div class="col-md-1 col-sm-12 col-xs-12 form-group">';
echo '<input type="submit" name="filtr" class="CloseForm_Ar btn btn-default" value="' . $AdminLangFile['project_filtr_but'] . '" />';
echo '</div>';

echo '</div>';
echo '</div>';
echo '</form>';


#################################################################################################################################
###################################################    filtr
#################################################################################################################################

if (isset($_POST['filtr'])) {
    if (trim(Clean_Mypost($_POST['pro_name'])) != "") {
        $Proname = trim(Clean_Mypost($_POST['pro_name']));
        $THESQL = "SELECT * FROM $GroupTabel where name  like '%$Proname%' $orderby ";
        $THELINK = "view=ListCrunt";
        $PERpage = '600';
    }
    if ($view == 'List' and intval($_POST['area']) != '0') {
        Redirect_Page_2("index.php?view=List&Area_Id=" . $_POST['area']);
    }
    if ($view == 'ListCrunt' and intval($_POST['area']) != '0') {
        Redirect_Page_2("index.php?view=ListCrunt&Area_Id=" . $_POST['area']);
    }
    if ($view == 'ListLast' and intval($_POST['area']) != '0') {
        Redirect_Page_2("index.php?view=ListLast&Area_Id=" . $_POST['area']);
    }
}


#################################################################################################################################
###################################################    Tabel
#################################################################################################################################
echo '<div style="clear: both!important;"></div>';


$already = $db->H_Total_Count($THESQL);
if ($already > 0) {

    if (ArrIsset($ConfigP, "datatabel", 0) != '1') {
        $VallOf = array('PageCount' => 'perpage_unit', 'PageOrder' => "order_by_unit", 'OrderList' => $Order_ByList);
        UpdateConfigElement($VallOf);
    }


///// Open_Header
    $TaBelArr = array('Tabel' => $ThisTabelName, "But" => '1');
    TableOpen_Header($TaBelArr);


    Table_TH_Print('1', "ID", "50");
    Table_TH_Print('1', $ALang['project_pro_name'], "150");
    Table_TH_Print(ADMINCPANELLANG, $ALang['project_pro_name'] . ENLANG, "150");

    Table_TH_Print('1', $ALang['project_pro_area_n'], "150");
    Table_TH_Print('1', $ALang['project_crunt_s'], "150");
    Table_TH_Print('1', $ALang['project_pro_code'], "150");

    Table_TH_Print('1', "", "50");
    Table_TH_Print('1', "", "50");
    Table_TH_Print('1', "", "50");
    Table_TH_Print('1', "", "50");
    Table_TH_Print('1', "", "50");
    Table_TH_Print('1', "", "50");
    Table_TH_Print('1', "", "50");

    echo '<th width="50" ><input type="checkbox" name="Check_ctr" value="yes" onClick="Check(document.myform.Check_ctr)"></th>';

///// TableClose_Header
    TableClose_Header();


    $NOPAGE = GETTHEPAGE($THESQL, $PERpage);
    if ($NOPAGE != 1) {
        if ($ConfigP['datatabel'] == '1' and DATATABELVIEW == '1') {
            $Name = $db->SelArr($THESQL);
        } else {
            $Name = $db->SelArr($THESQL, true, $PERpage, PAGING_NEXT_PREV_NUM, $THELINK, 5);
        }

        $Areaname_Arr = $db->SelArr("select * from project_area ");

        for ($i = 0; $i < count($Name); $i++) {
            $id = $Name[$i]['id'];
            $ProjecCrunt = Rterun_ProjectCruntS($Name[$i]['crunt']);
            $Areaname = findValue_FromArr($Areaname_Arr, 'id', $Name[$i]['area_id'], $NamePrint);
            echo '<tr>';

            Table_TD_Print('1', $Name[$i]['id'], "C");
            Table_TD_Print('1', $Name[$i]['name'], "C");
            Table_TD_Print(ADMINCPANELLANG, $Name[$i]['name_en'], "C");

            if ($view == 'List') {
                Table_TD_Print('1', '<a href="index.php?view=List&Area_Id=' . $Name[$i]['area_id'] . '">' . $Areaname . '</a>', "C");
                Table_TD_Print('1', '<a href="index.php?view=List&Crunt=' . $Name[$i]['crunt'] . '">' . $ProjecCrunt . '</a>', "C");
            } else {
                Table_TD_Print('1', $Areaname, "C");
                Table_TD_Print('1', $ProjecCrunt, "C");
            }


            $ProPrintCode = $Name[$i]['pro_code'] . BR;
            $ProPrintCode .= $AdminLangFile['project_floor_count'] . " " . $Name[$i]['floor_count'] . BR;
            $ProPrintCode .= $AdminLangFile['project_unit_count'] . " " . $Name[$i]['unit_count'] . BR;
            Table_TD_Print('1', $ProPrintCode, "R");


            Table_TD_Print('1', NF_PrintBut_TD($But_name_Sate, $ALang['project_add_floor'], "Floor_Add&id=" . $id, "btn-primary", "fa-plus-circle"), "C");


            if ($Name[$i]['floor_count'] == '0') {
                echo '<td></td>';
            } else {
                Table_TD_Print('1', NF_PrintBut_TD($But_name_Sate, $ALang['project_floor_list'], "Floor_List&id=" . $id, "btn-primary", "fa-list"), "C");
            }


            if ($Name[$i]['unit_count'] == '0') {
                echo '<td></td>';
                echo '<td></td>';
            } else {
                Table_TD_Print('1', NF_PrintBut_TD($But_name_Sate, $ALang['project_list_unit'], "UnitList&Project_Id=" . $id, "btn-inverse", "fa-pencil"), "C");
                Table_TD_Print('1', NF_PrintBut_TD($But_name_Sate, $ALang['project_tabel_list'], "Tabel&Project_Id=" . $id, "btn-success", "fa-table"), "C");
            }

            Table_TD_Print('1', NF_PrintBut_TD('2', $ALang['mainform_edit'], "ProjectEdit&id=" . $id, "btn-info", "fa-pencil"), "C");


            if ($Name[$i]['floor_count'] == '0' or $AdminConfig['admin'] == '1') {
                Table_TD_Print('1', NF_PrintBut_TD('2', $AdminLangFile['mainform_delete'], "ProjectDell&id=" . $id, "btn-danger", "fa-window-close"), "C");
            } else {
                echo '<td align="center"></td>';
            }

            echo '<td align="center">' . CheckUnitState($Name[$i]['state']) . '</td>';
            echo '<td align="center">' . PrintCheckBox_New($id) . '</td>';

            echo '</tr>';
        }
    }

///// CloseTabel   
    CloseTabel();


} else {
    echo '<div class="alert alert-danger alert_danger_ar ">' . $AdminLangFile['mainform_alert_no_content'] . '</div>';
}


######/<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<-----------------------------------------------
Close_Page();

?>            
 