<?php
if(!defined('WEB_ROOT')) {	exit;}
 


######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);
$TNAme = "project_floor";
$row = $db->H_CheckTheGet("FloorId","id",$TNAme,"2");
$FloorId = $row['id'];

$ThIsIsTest = '0';


if(isset($_GET['Confirm'])){
    if($row['state'] == '0'){
        $UnitCount = $row['unit'];
        $Floor_ID = $row['id'];
        $Project_Id = $row['pro_id'];
        for ($i = 1; $i <= $UnitCount ; $i++) {
            $Project_Id = $row['pro_id'];
            $ThisFloorCode =  $row['f_code'];
            $ThisUnitCode = $Project_Id."-".Rterun_UnitCodeArr($i).$ThisFloorCode;
            $Unit_Data = array ('id'=> NULL ,
                'pro_id'=> $Project_Id ,
                'floor_id'=> $Floor_ID ,
                'f_code'=> $ThisFloorCode ,
                'u_code'=> $ThisUnitCode ,
                'p_code'=> Rterun_UnitCodeArr($i).$ThisFloorCode ,
                'type'=> Rterun_UnitCodeArr($i) ,
            );

            if($ThIsIsTest == '1'){
                print_r3($Unit_Data);
            }else{
                $add_server = $db->AutoExecute("project_unit",$Unit_Data,AUTO_INSERT);
            }        }
        $server_data = array (
            'state'=> "1" ,
        );
        if($ThIsIsTest == '1'){
            print_r3($server_data);
        }else{
            $add_server = $db->AutoExecute("project_floor",$server_data,AUTO_UPDATE,"id = $Floor_ID");
            CountProjectInfo();
            Redirect_Page_2("index.php?view=Floor_List&id=".$Project_Id);
        }

    }else{
        New_Print_Alert("5",$AdminLangFile['project_errforactive']);
    }

}else{
    if($row['state'] == '0'){
        $ProjectName = GetNameFromID("project",$row['pro_id'],$NamePrint);
        echo '<div class="alert alert-info alert-dismissable Arr_Mass">';
        echo $AdminLangFile['project_active_mass_1']." ".$ProjectName.BR;
        echo $AdminLangFile['project_active_mass_2']." ".$row['name'].BR;
        echo $AdminLangFile['project_active_mass_3']." ".$row['unit'].BR;
        echo '</div>';

        echo '<a  class="ArButForm_Dell mb-sm btn btn-warning"
 href="index.php?view=Floor_List&id='.$row['pro_id'].'">'.$AdminLangFile['mainform_canceled_but'].'</a>';

        echo '<a  class="ArButForm_Dell mb-sm btn btn-success"
 href="index.php?view=UnitActive&FloorId='.$FloorId.'&Confirm">'.$AdminLangFile['project_active_unit'].'</a>';

    }else{
        New_Print_Alert("5",$AdminLangFile['project_errforactive']);
    }
}



######/<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<-----------------------------------------------
Close_Page();
?>
 