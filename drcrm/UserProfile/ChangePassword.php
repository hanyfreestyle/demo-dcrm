<h3 class="H3_FontAr"><?php echo $PageTitle ?></h3>
<div class="row PanelMin"><div class="col-md-12">
<script>
$(function() {
$("input[type='password']").val('');
});
</script>
<?php
if(!defined('WEB_ROOT')) {	exit;}
 

$userName = $RowUsreInfo['user_name'];

$sql = "SELECT * FROM tbl_user WHERE user_name = '$userName'";
$result = mysqli_query($con,$sql);
$row = mysqli_fetch_array($result);

Print_Change_Password_Form();

	
?>




</div></div>