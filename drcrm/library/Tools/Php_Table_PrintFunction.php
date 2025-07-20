<?php
if(!defined('WEB_ROOT')) {	exit;}
 

#################################################################################################################################
###################################################    TableOpen_Header
#################################################################################################################################
function TableOpen_Header($Arr=array()){
    global $ConfigP ;
    global $USER_PERMATION_Edit;
    global $USER_PERMATION_Dell ;

    if(!isset($ConfigP['datatabel'])){
        $ConfigP['datatabel'] = "0"  ;
    }
    if(isset($Arr['Tabel'])){
        if(isset($_POST['UnActAllUnit'])) {
            if($USER_PERMATION_Edit == '1') {
                UnActAllUnit_New($Arr['Tabel']);
            } else {
                SendMassgeforuser();
            }
        }
        if(isset($_POST['ActAllUnit'])) {
            if($USER_PERMATION_Edit == '1') {
                ActAllUnit_New($Arr['Tabel']);
            } else {
                SendMassgeforuser();
            }
        }

        if(isset($_POST['DelUnit'])) {
            if($USER_PERMATION_Dell == '1') {
                DelUnit_New($Arr['Tabel']);
            } else {
                SendMassgeforuser();
            }
        }
    }

    if(isset($Arr['DataTabelID']) and  $Arr['DataTabelID'] != ''){
    $DataTabelID = $Arr['DataTabelID'] ;    
    }else{
    $DataTabelID = "MyCustmer" ;    
    }


    echo '<form name="myform" action="#" method="post">';
    if(isset($Arr['But']) and $Arr['But'] == '1'){
        if(isset($Arr['Del']) and $Arr['Del'] == '1'){$Del = '1';}else{$Del = '0';}
        if(isset($Arr['AddBut'])){$AddBut = $Arr['AddBut'] ;}else{$AddBut="";}
        FPrint_ADD_Submit_New($Del,$AddBut);
    }
    if(isset($Arr['OtherBut'])){
        echo $Arr['OtherBut'] ;
    }

    if($ConfigP['datatabel'] == '1' and DATATABELVIEW == '1'  ){
        echo '<table id="'.$DataTabelID.'" class="table table-striped table-bordered table-hover ArTabel ArTabel_55">';
        echo '<thead><tr>';
    }else{
        echo '<div class="panel panel-default"><div class="table-responsive">';
        echo '<table class="table table-striped table-bordered table-hover ArTabel">';
        echo '<thead><tr>';
    }
}
#################################################################################################################################
###################################################    
#################################################################################################################################
function TableClose_Header($Arr=""){
echo '</tr></thead><tbody>';    
}

#################################################################################################################################
###################################################    
#################################################################################################################################
function Table_TH_Print($View,$Name,$Width="50",$Arr=""){
   if($View == '1'){
   if($Width != '0' ){
   $TH_Class = "TD_".$Width." ";
   }    
   echo  $kk = '<th class="'.$TH_Class.'">'.$Name.'</th>'; 
   } 

}
#################################################################################################################################
###################################################    
#################################################################################################################################
function Table_TD_Print($View,$Val,$Align="C",$Arr=""){
   $Style = "";
   if($View == '1'){
   if($Align == 'C' ){$Align = "center";} if($Align == 'R' ){$Align = "right";}    if($Align == 'L' ){$Align = "left";}  
  // if(isset($Arr['OtherStyle'])){$Style = $Arr['OtherStyle']}     
   if(isset($Arr['OtherStyle'])){
    $Style = $Arr['OtherStyle'] ;
   }
   
   echo  $kk = '<td align="'.$Align.'" class="'.$Style.'" >'.$Val.'</td>'; 
   } 
}

function Table_TD_Print_Option($View,$Val,$Align="C",$Arr=""){
   if($View == '1'){
   if($Align == 'C' ){$Align = "center";} if($Align == 'R' ){$Align = "right";}    if($Align == 'L' ){$Align = "left";}       
     echo  $kk = '<td align="'.$Align.'" >'.$Val.'</td>'; 
   }else{
     echo  $kk = '<td></td>'; 
   } 
}


 
function Table_TD_Print_Photo($View,$Val,$Align="C",$Arr=array()){
    global $AdminNoPhoto ;

    if(!isset($Arr['NewStyle'])){
        $NewStyle = "" ;
    }else{
        $NewStyle = $Arr['NewStyle'] ;
    }

    if($View == '1'){
        if ( $Val ) {
            if(!isset($Arr['Path'])){
                $photo = F_PATH_V.$Val;
            }else{
                $photo = $Arr['Path'].$Val;
            }
        } else {
            $photo = $AdminNoPhoto;
        }

        if($Align == 'C' ){$Align = "center";} if($Align == 'R' ){$Align = "right";}    if($Align == 'L' ){$Align = "left";}
        echo  $kk = '<td align="'.$Align.'" ><img src="'.$photo.'" class="thumbCatview '.$NewStyle.'"/>'.'</td>';
    }else{
        echo  $kk = '<td></td>';
    }
}


#################################################################################################################################
###################################################    
#################################################################################################################################
function CloseTabel($Arr=array()){
    global $ConfigP ;
    global $db ;
    if(!isset($ConfigP['datatabel'])){
    $ConfigP['datatabel'] = "0"  ;  
    }
     
    if($ConfigP['datatabel'] == '1' and DATATABELVIEW == '1'  ){
    echo '</tbody></table>';  
    }else{
    echo '</tbody></table></div></div>';
    echo '<div class="col-md-12 col-sm-12 col-xs-12">';
    echo $db->pager;
    echo '</div>';
    }
    
    echo "</form>";
}


#####################################################################################################################################
########################################## FPrint_ADD_Submit_New
#####################################################################################################################################
function FPrint_ADD_Submit_New($Dell='0',$AddBut=""){
    global $AdminLangFile ;
echo '<div class="row PanelMin TopButAction"><div class="col-md-12">';    
    if($Dell == '1'){
echo '<button type="submit"  name="ActAllUnit" class="mb-sm btn btn-success">'.$AdminLangFile['mainform_activation'].'</button>
<button type="submit"  name="UnActAllUnit" class="mb-sm btn btn-warning">'.$AdminLangFile['mainform_disable'].'</button>
<button type="submit"  name="DelUnit" class="mb-sm btn btn-danger">'.$AdminLangFile['mainform_delete'].'</button> ';
    }else{
echo '<button type="submit"  name="ActAllUnit" class="mb-sm btn btn-success">'.$AdminLangFile['mainform_activation'].'</button>
      <button type="submit"  name="UnActAllUnit" class="mb-sm btn btn-warning">'.$AdminLangFile['mainform_disable'].'</button> ';
    }
    
   
if(isset($AddBut)){
 echo $AddBut ;   
}    
echo '</div> </div><div style="clear: both;"></div>';    
}

#################################################################################################################################
###################################################   PrintUpdateConfigElement
#################################################################################################################################
function UpdateConfigElement($VallOf){
global $AdminLangFile ;
global $db ;
global $ConfigP ;
global $ConfigTabel ;

if(isset($_POST['UpdatePageCount'])){
   if(intval($_POST['page_count']) > '0'){
   
    $Update = intval($_POST['page_count']);
    $sql = "SELECT * FROM  config_cat  where cat_id = '$ConfigTabel' ";
    $row = $db->H_SelectOneRow($sql);
    $des = $row['des'];
    $des =  unserialize($des);
    $des = replace_key($VallOf['PageCount'],$Update, $des);
    $Data = serialize($des);
    $server_data = array ('des'=> $Data , );
    $add_server = $db->AutoExecute("config_cat",$server_data,AUTO_UPDATE,"cat_id = '$ConfigTabel'");
    Redirect_Page_2(LASTREFFPAGE);
   }
}


echo '<div class="row">';

echo '<form method="post" action="" id="validate-form" data-parsley-validate>';
echo '<div class="col-md-3 col-sm-12 col-xs-12 UpDatePageCount"> ';
echo '<div class="col-md-12 col-sm-12 col-xs-12 "> ';
echo '<input type="text" name="page_count"  value="'.$ConfigP[$VallOf['PageCount']].'" class="unit_count form-control" > ';
echo '<input type="submit" class="btn btn-default " name="UpdatePageCount" value="'.$AdminLangFile['mainform_update'].'" />';
echo '</div>';
echo '</div>';
echo '</form>';

?>



<div class="col-md-4 col-sm-12 col-xs-12 form-group DirRightx">            
<div class="btn-group mb-sm">
<button type="button" class="btn btn-default"><?php echo RterunOrderName_New($ConfigP[$VallOf['PageOrder']])?></button>
<button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle"><span class="caret"></span></button>
<ul role="menu" class="dropdown-menu">
<?php
for ($i = 1; $i <= count($VallOf['OrderList']); $i++) {
echo '<li><a class="UpdateConfig" id="'.$i.'" type="'.$VallOf['PageOrder'].'" >'.$VallOf['OrderList'][$i].'</a></li><li class="divider"></li> ' ;  
}
if(isset($VallOf['FilterPath'])){
echo '<li><a href="index.php?view='.$VallOf['FilterPath'].'">'.$AdminLangFile[$VallOf['FilterName']].'</a> </li>';    
}
	

echo '</ul>';
echo '</div>';
echo '</div> ';
echo '</div>';



}

function RterunOrderName_New($state) {
    global $AdminLangFile ;
  switch($state) {
     case "1":
       $order = $AdminLangFile['mainform_newest_to_older'] ;
       break;
     case "2":
       $order = $AdminLangFile['mainform_older_to_newest'];
       break;
     default:
       $order = 'Error ';
   }
   return $order;   
    
}  



#####################################################################################################################################
########################################## OPen Page 
#####################################################################################################################################
function OPen_Page($Name,$Arr=""){
echo '<h3 class="H3_FontAr">'.$Name.'</h3>';
echo '<div class="row PanelMin Min_600"><div class="col-md-12">    ';
}
function Close_Page($Arr=""){
    echo '</div></div>';
}

#####################################################################################################################################
########################################## Alert_NO_Content
#####################################################################################################################################
function Alert_NO_Content($Name=""){
    global $AdminLangFile ;
    if($Name == ""){
        $Name = $AdminLangFile['mainform_alert_no_content'] ;
    }
    echo '<div style="clear: both!important;"></div>';
    echo '<div class="alert alert-danger alert_danger_ar ">'.$Name.'</div>';
}


#####################################################################################################################################
########################################## AddBut Temp
#####################################################################################################################################
function AddBut($Tabel){
    global $db;
    if(isset($_POST['id_id'])) {
        $EmailCount = count($_POST['id_id']);
        for ($i = 0; $i < $EmailCount; $i++) {
            $id = $_POST['id_id'][$i];
            /*
            $server_data = array('state' => "1");
            $db->AutoExecute($Tabel, $server_data, AUTO_UPDATE, "id = $id");
            */
            echo $id.BR;
        }
    }
}










#################################################################################################################################
###################################################   ConfigElement_UpdateAjex
#################################################################################################################################
function ConfigElement_UpdateAjex($VallOf){
    global $AdminLangFile ;
    global $db ;
    global $ConfigP ;
    global $ConfigTabel ;

    if(isset($_POST['UpdatePageCount'])){
        if(intval($_POST['page_count']) > '0'){
            $Update = intval($_POST['page_count']);
            $sql = "SELECT * FROM  config_cat  where cat_id = '$ConfigTabel' ";
            $row = $db->H_SelectOneRow($sql);
            $des = $row['des'];
            $des =  unserialize($des);
            $des = replace_key($VallOf['PageCount'],$Update, $des);
            $Data = serialize($des);
            $server_data = array ('des'=> $Data );
            $db->AutoExecute("config_cat",$server_data,AUTO_UPDATE,"cat_id = '$ConfigTabel'");
            Redirect_Page_2(LASTREFFPAGE);
        }
    }


    echo '<div class="row">';

    echo '<form method="post" action="" id="validate-form" data-parsley-validate>';
    echo '<div class="col-md-3 col-sm-12 col-xs-12 UpDatePageCount"> ';
    echo '<div class="col-md-12 col-sm-12 col-xs-12 "> ';
    echo '<input type="text" name="page_count"  value="'.$ConfigP[$VallOf['PageCount']].'" class="unit_count form-control" > ';
    echo '<input type="submit" class="btn btn-default " name="UpdatePageCount" value="'.$AdminLangFile['mainform_update'].'" />';
    echo '</div>';
    echo '</div>';
    echo '</form>';

    
    
    #################################################################################################################################
    ###################################################    
    #################################################################################################################################
    echo '<div class="col-md-4 col-sm-12 col-xs-12 form-group DirRightx">';
    echo '<div class="btn-group mb-sm">';
    echo '<button type="button" class="btn btn-default">'.RterunOrderName_New($ConfigP[$VallOf['PageOrder']]).'</button>';
    echo '<button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle"><span class="caret"></span></button>';
    echo '<ul role="menu" class="dropdown-menu">';
 
    for ($i = 1; $i <= count($VallOf['OrderList']); $i++) {
        echo '<li><a class="UpdateConfigAjex" id="'.$i.'" type="'.$VallOf['PageOrder'].'" >'.$VallOf['OrderList'][$i].'</a></li><li class="divider"></li> ' ;
    }
 
    echo '</ul>';
    echo '</div>';
    echo '</div> ';
    echo '</div>';
    
   // echo '<div id="Test">Hiiiii</div>';
    
}




?>

