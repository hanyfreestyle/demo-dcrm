<?php
if(!defined('WEB_ROOT')) {	exit;}
 
?>
<script>
function copyToClipboard(element) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  $temp.remove();
}
</script>

<style>
.NewNum{
width:100%;
text-align:center;
font-size:30px;
}
</style>
<?php
 
###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);



Form_Open($ArrForm);




$MoreS = array('Col' => "col-md-12",'Placeholder'=> "",'required' => 'required', 'Dir'=> "En_Lang" );
$Err[] = NF_PrintInput("Text",$AdminLangFile['customer_mobile']."1","mobile","1","0","",$MoreS);

echo BR;
echo '<div style="clear: both!important;"></div>';


Form_Close_New("1","List");

if(isset($_POST['B1'])){
$NewVall =  UpdateArNum($_POST['mobile']); 

?>
<p id="p1" class="NewNum"><?php echo $NewVall ?></p>
<button onclick="copyToClipboard('#p1')">Copy</button>

<?php
}            

###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();
?>
