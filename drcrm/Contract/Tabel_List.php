<?php
if(!defined('WEB_ROOT')) {	exit;}

######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);


$row = $db->H_CheckTheGet("Project_Id","id","project","2");
$id = $row['id'];
$ThisProjectId =  $row['id'] ;

echo '<div class="alert alert-warning alert-dismissable Arr_Mass">';
if($view == 'TabelCon'){
echo $AdminLangFile['contract_con_mass']." ".$row['name'];    
}elseif($view == 'TabelRev'){
echo $AdminLangFile['contract_rev_mass']." ".$row['name'];   
}elseif($view == 'TabelView'){
echo $AdminLangFile['contract_view_unit_tabel_mass']." ".$row['name'];    
}
echo '</div>';

	
?>
<form name="myform" action="#" method="post">
<div class="table-responsive ArTabel">
<table class="table table-striped">
<tbody>
<?php
$FloorList = $db->SelArr("SELECT * FROM project_floor where pro_id = $ThisProjectId and state = '1' ORDER BY f_code desc");
for($i = 0; $i < count($FloorList); $i++) {
$UnitCount = $FloorList[$i]['unit'];  
$List_FloorID = $FloorList[$i]['id'];  
echo '<tr>';
echo '<td class="Tfloor_name">'.$FloorList[$i]['name'].'</td>';
$UnitList = $db->SelArr("SELECT * FROM project_unit where floor_id = '$List_FloorID' ORDER BY u_code ASC");
for($x = 0; $x < count($UnitList); $x++) {
echo '<td>';
PrintUnitBox_Contract($UnitList[$x],$view);
echo '</td>';
} 
echo '</tr>';
} 
?>                                 
</tbody>
</table>
</div>
</form> 


<?php
echo '<a  class="ArButForm_Dell mb-sm btn btn-warning" href="index.php?view=List">'.$AdminLangFile['mainform_canceled_but'].'</a>';



######/<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<-----------------------------------------------
Close_Page();
?>   
 