<?php
if(!defined('WEB_ROOT')) {	exit;}
######/----------------------------------------------->>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);

$row = $db->H_CheckTheGet("Project_Id","id","project","2");
$id = $row['id'];
$ThisProjectId =  $row['id'] ;
extract($row); 
?>
<style>
.projectcustname a:link { text-decoration:none ; color:#FFFFFF}
.projectcustname a:visited { text-decoration:none ; color:#FFFFFF }
.projectcustname a:hover { text-decoration:none ; color:#FFFFFF }
.projectcustname a:active { text-decoration:none ; color:#FFFFFF }
</style>
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
echo '<td class="Tfloor_name"><a href="index.php?view=UnitList&Floor_Id='.$FloorList[$i]['id'].'">'.$FloorList[$i]['name'].'</a></td>';
$UnitList = $db->SelArr("SELECT * FROM project_unit where floor_id = '$List_FloorID' ORDER BY u_code ASC");
for($x = 0; $x < count($UnitList); $x++) {
echo '<td>';
PrintUnitBox($UnitList[$x]);
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



######/<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<-----------------------------------------------
Close_Page();	
?>