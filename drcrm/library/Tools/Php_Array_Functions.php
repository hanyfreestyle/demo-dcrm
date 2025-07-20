<?php
if (!defined('WEB_ROOT')) {
    exit;
}


function _value_in_array($array, $find) {
    $exists = FALSE;
    if (!is_array($array)) {
        return;
    }
    foreach ($array as $key => $value) {
        if ($find == $value) {
            $exists = TRUE;
        }
    }
    return $exists;
}


function in_multiarray_2($elem, $array) {
    $top = sizeof($array) - 1;
    $bottom = 0;
    while ($bottom <= $top) {
        if ($array[$bottom] == $elem)
            return true;
        else
            if (is_array($array[$bottom]))
                if (in_multiarray($elem, ($array[$bottom])))
                    return true;

        $bottom++;
    }
    return false;
}

/*
function Merge_More_Array_To_One($OldArr,$Key){
$singleArray = array();
foreach ($OldArr as $key => $value){
    $singleArray[$key] = $value[$Key];
}
return $singleArray ;
}
*/

#################################################################################################################################
###################################################   recursive_array_search
#################################################################################################################################
function recursive_array_search($needle, $haystack) {
    foreach ($haystack as $key => $value) {
        $current_key = $key;
        if ($needle === $value or (is_array($value) && recursive_array_search($needle, $value) !== false)) {
            return $current_key;
        }
    }
    return false;
}

#################################################################################################################################
################################################### in_multiarray  
#################################################################################################################################
function in_multiarray($elem, $array) {
    while (current($array) !== false) {
        if (current($array) == $elem) {
            return true;
        } elseif (is_array(current($array))) {
            if (in_multiarray($elem, current($array))) {
                return true;
            }
        }
        next($array);
    }
    return false;
}

#################################################################################################################################
###################################################   findValue
#################################################################################################################################
function findValue(array $array, array $parameters, $multipleResoult = false) {
    $result = array();//used when $multipleResoult == true
    $suspicious = false;
    foreach ($array as $childArray) {
        foreach ($parameters as $k => $p) {
            if (array_key_exists($k, $childArray)) {
                if ($childArray[$k] == $p) {
                    $suspicious = $childArray;
                } else {
                    $suspicious = false;
                    continue 2;
                }
            } else {
                $suspicious = false;
                continue 2;
            }
        }
        if (is_array($suspicious)) {
            $result[] = $suspicious;
            if ($multipleResoult == true) {
                $suspicious = false;
            } else {
                break;
            }
        }

    }
    return $result;
}

/*
function findValue_FromArr($OldData,$Key,$Val,$SendName){
    if(count($OldData) > 0 ){
    $hany = findValue($OldData, array($Key => $Val ), "0"); 
    $SendVall = $hany['0'][$SendName];      
    }else{
     $SendVall  = "" ;  
    } 
 return $SendVall ;  
}
*/

function findValue_FromArr($OldData, $Key, $Val, $SendName) {
    if (is_array($OldData)){
        if (count($OldData) > 0 and intval($Val) > '0') {
            $hany = findValue($OldData, array($Key => $Val), "0");
            if (!empty($hany)) {
                $SendVall = $hany['0'][$SendName];
            } else {
                $SendVall = "";
            }

        } else {
            $SendVall = "";
        }
    }else{
        $SendVall = "";
    }


    return $SendVall;
}


function findValue_FromArr_Export($OldData, $Key, $Val, $SendName) {
    if (count($OldData) > 0 and intval($Val) > '0') {
        $hany = findValue($OldData, array($Key => $Val), "0");
        $SendVall = $hany['0'][$SendName];
    } else {
        $SendVall = "";
    }
    return $SendVall;
}


#################################################################################################################################
###################################################  replace_key
#################################################################################################################################
function replace_key($find, $replace, $array) {
    $arr = array();
    foreach ($array as $key => $value) {
        if ($key == $find) {
            $arr[$key] = $replace;
        } else {
            $arr[$key] = $value;
        }
    }
    return $arr;
}

#################################################################################################################################
###################################################   assc_array_count_values
#################################################################################################################################
function assc_array_count_values($array, $key) {
    $new_array = [];
    foreach ($array as $row) {
        $new_array[] = $row[$key];
    }
    return array_count_values($new_array);
}

#################################################################################################################################
###################################################   array_count
#################################################################################################################################
function array_count($array, $key, $value = NULL) {
    $c = 0;
    if (is_null($value)) {
        foreach ($array as $i => $subarray) {
            $c += ($subarray[$key] != '');
        }
    } else {
        foreach ($array as $i => $subarray) {
            $c += ($subarray[$key] == $value);
        }
    }
    return $c;
}

#################################################################################################################################
###################################################   array_sort
#################################################################################################################################
function array_sort($array, $on, $order = SORT_ASC) {
    $new_array = array();
    $sortable_array = array();
    if (count($array) > 0) {
        foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) {
                    if ($k2 == $on) {
                        $sortable_array[$k] = $v2;
                    }
                }
            } else {
                $sortable_array[$k] = $v;
            }
        }
        switch ($order) {
            case SORT_ASC:
                asort($sortable_array);
                break;
            case SORT_DESC:
                arsort($sortable_array);
                break;
        }
        foreach ($sortable_array as $k => $v) {
            array_push($new_array, $array[$k]);
        }
    }
    return $new_array;
}

#################################################################################################################################
###################################################   GetChartVallFromArr
#################################################################################################################################
function GetChartVallFromArr($OldArr, $KeyFilter, $NameTabel) {
    global $AdminLangFile;
    if (ADMIN_WEB_LANG == 'En') {
        $NamePrint = 'name_en';
    } else {
        $NamePrint = 'name';
    }

    if (array_key_exists($KeyFilter, $OldArr[0])) {
        $OldArrAfterFilter = assc_array_count_values($OldArr, $KeyFilter);

        $EndArr = array();

        foreach ($OldArrAfterFilter as $Item_ID => $Item_Count) {
            if ($Item_ID == '0') {
                $NewVall = array('name' => $AdminLangFile['report_arr_not_set_name'], 'count' => $Item_Count, 'id' => $Item_ID);
            } else {
                $NewVall = array('name' => GetNameFromID($NameTabel, $Item_ID, $NamePrint), 'count' => $Item_Count, 'id' => $Item_ID);
            }
            array_push($EndArr, $NewVall);
        }

    }
    $EndArr = array_sort($EndArr, 'count', SORT_DESC);
    return $EndArr;
}


function GetChartVallFromArr_2018($OldArr, $KeyFilter, $NameTabel_Arr) {
    global $AdminLangFile;
    if (ADMIN_WEB_LANG == 'En') {
        $NamePrint = 'name_en';
    } else {
        $NamePrint = 'name';
    }
    if (array_key_exists($KeyFilter, $OldArr[0])) {
        $OldArrAfterFilter = assc_array_count_values($OldArr, $KeyFilter);
        $EndArr = array();
        foreach ($OldArrAfterFilter as $Item_ID => $Item_Count) {
            if ($Item_ID == '0') {
                $NewVall = array('name' => $AdminLangFile['report_arr_not_set_name'], 'count' => $Item_Count, 'id' => $Item_ID);
            } else {
                // $NewVall =  array ('name'=> GetNameFromID("config_data",$Item_ID,$NamePrint) , 'count'=> $Item_Count,  'id'=> $Item_ID);
                $NewVall = array('name' => findValue_FromArr($NameTabel_Arr, "id", $Item_ID, $NamePrint), 'count' => $Item_Count, 'id' => $Item_ID);

            }
            array_push($EndArr, $NewVall);
        }
        $EndArr = array_sort($EndArr, 'count', SORT_DESC);
    }
    return $EndArr;
}


#################################################################################################################################
###################################################   GetChartVallFromArr_To_user
#################################################################################################################################
function GetChartVallFromArr_To_user($OldArr, $KeyFilter, $NameTabel) {
    global $AdminLangFile;
    if (ADMIN_WEB_LANG == 'En') {
        $NamePrint = 'name_en';
    } else {
        $NamePrint = 'name';
    }
    if (array_key_exists($KeyFilter, $OldArr[0])) {
        $OldArrAfterFilter = assc_array_count_values($OldArr, $KeyFilter);
        $EndArr = array();
        foreach ($OldArrAfterFilter as $Item_ID => $Item_Count) {
            if ($Item_ID == '0') {
                $NewVall = array('name' => $AdminLangFile['report_arr_not_set_name'], 'count' => $Item_Count, 'id' => $Item_ID);
            } else {
                $NewVall = array('name' => GetNameFromID_User("tbl_user", $Item_ID, "name"), 'count' => $Item_Count, 'id' => $Item_ID);
            }
            array_push($EndArr, $NewVall);
        }
        $EndArr = array_sort($EndArr, 'count', SORT_DESC);
    }
    return $EndArr;
}


#################################################################################################################################
################################################### GetChartVallFrom_Area_Arr  
#################################################################################################################################
function GetChartVallFrom_Area_Arr($OldArr, $KeyFilter, $NameTabel) {
    global $AdminLangFile;
    $EndArr = array();
    if (ADMIN_WEB_LANG == 'En') {
        $NamePrint = 'name_en';
    } else {
        $NamePrint = 'name';
    }
    $FiterArr = array();
    for ($i = 0; $i < count($OldArr); $i++) {
        if ($OldArr[$i]['pro_area'] != "") {
            //   echo "id :  ".$OldArr[$i]['id']." ".$OldArr[$i]['pro_area']. BR;
            $Hany = substr($OldArr[$i]['pro_area'], 1, -1);
            $Hany = explode("-", $Hany);
            foreach ($Hany as $Item_ID => $Item_Count) {
                $NewVall = array('count' => $Item_Count, 'id' => $Item_Count);
                array_push($FiterArr, $NewVall);
            }
        }
    }
    $TotalCout = "0";
    if (count($FiterArr) > 0) {
        $OldArrAfterFilter = assc_array_count_values($FiterArr, "count");
        $EndArr = array();
        $TotalCout = "0";
        foreach ($OldArrAfterFilter as $Item_ID => $Item_Count) {
            if ($Item_ID == '0') {
                $NewVall = array('name' => $AdminLangFile['report_arr_not_set_name'], 'count' => $Item_Count, 'id' => $Item_ID);
            } else {
                $NewVall = array('name' => GetNameFromID($NameTabel, $Item_ID, $NamePrint), 'count' => $Item_Count, 'id' => $Item_ID);
            }
            $TotalCout = $TotalCout + $Item_Count;
            array_push($EndArr, $NewVall);
        }
    }
    $EndArr = array_sort($EndArr, 'count', SORT_DESC);
    return array("Arr" => $EndArr, "count" => intval($TotalCout));
}


#################################################################################################################################
################################################### GetChartVallFrom_WhereIt_Like
#################################################################################################################################
function GetChartVallFrom_WhereIt_Like($OldArr, $KeyFilter, $ReturnTabel_Vall) {
    global $AdminLangFile;
    global $NamePrint;

    $FiterArr = array();

    for ($i = 0; $i < count($OldArr); $i++) {
        if ($OldArr[$i][$KeyFilter] != "") {
            $Hany = substr($OldArr[$i][$KeyFilter], 1, -1);
            $Hany = explode("-", $Hany);
            foreach ($Hany as $Item_ID => $Item_Count) {
                $NewVall = array('count' => $Item_Count, 'id' => $Item_Count);
                array_push($FiterArr, $NewVall);
            }
        }
    }
    if (count($FiterArr) > 0) {
        $OldArrAfterFilter = assc_array_count_values($FiterArr, "count");
        $EndArr = array();
        $TotalCout = "0";
        foreach ($OldArrAfterFilter as $Item_ID => $Item_Count) {
            if ($Item_ID == '0') {
                $NewVall = array('name' => $AdminLangFile['report_arr_not_set_name'], 'count' => $Item_Count, 'id' => $Item_ID);
            } else {
                $NewVall = array('name' => findValue_FromArr($ReturnTabel_Vall, "id", $Item_ID, $NamePrint), 'count' => $Item_Count, 'id' => $Item_ID);
            }
            $TotalCout = $TotalCout + $Item_Count;
            array_push($EndArr, $NewVall);
        }
    }
    $EndArr = array_sort($EndArr, 'count', SORT_DESC);
    return array("Arr" => $EndArr, "count" => $TotalCout);

}

#################################################################################################################################
###################################################   
#################################################################################################################################

/*
function findValue(array $array, array $parameters, $multipleResoult = false){
    $result = array();//used when $multipleResoult == true
    $suspicious = false;
    foreach($array as $childArray){
        foreach($parameters as $k => $p){
            if(array_key_exists($k,$childArray)){
                if($childArray[$k] == $p){
                    $suspicious = $childArray;
                } else {
                    $suspicious = false;
                    continue 2;
                }
            } else {
                $suspicious = false;
                continue 2;
            }
        }
        if(is_array($suspicious)){
            $result[] = $suspicious;
            if($multipleResoult == true){
                $suspicious = false;
            } else {            
                break;
            }
        }

    }
    return $result;
}
$arr =     Array
    ( 
        0 => Array
        (
            "id" => 1,
            "id_shop" => 1,
            "id_lang" => 1,
            "id_product" => 1,
            "id_field" => 3,
            "field_value" => "zxczxc"
        ),

    // find if single and multiple
    1 => Array
    (
            "id" => 2,
            "id_shop" => 1,
            "id_lang" => 2,
            "id_product" => 1,
            "id_field" => 3,
            "field_value" => "sdfsdfsdf"
        ),

    2 => Array
    (
            "id" => 3,
            "id_shop" => 1,
            "id_lang" => 2,
            "id_product" => 2,
            "id_field" => 3,
            "field_value" => "sdfsdfsdf"
        ),
    // find if multiple
    3 => Array
    (
            "id" => 3,
            "id_shop" => 1,
            "id_lang" => 2,
            "id_product" => 1,
            "id_field" => 3,
            "field_value" => "sdfsdfsdf"
        )

);
echo '-----------------SINGLE----------------------';echo "\n";echo '<pre>';
print_r(findValue($arr, array(
    'id_shop' => 1,
    'id_field' => 3,
    'id_lang'=> 2,
    'id_product' => 1)
                 ));
echo '-----------------MULTIPLE----------------------';echo "\n";echo '<pre>';
print_r(findValue($arr, array(
    'id_shop' => 1,
    'id_field' => 3,
    'id_lang'=> 2,
    'id_product' => 1)
                 ,true));
                 
                 
*/


?>