<h3 class="H3_FontAr"><?php echo $PageTitle ?></h3>
<div class="row PanelMin"><div class="col-md-12">
<?php
if(!defined('WEB_ROOT')) {	exit;}
 
Form_Open();

echo '<input type="hidden" name="charest"  value="UTF-8"/>';

$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required', 'Dir'=> "En_Lang" );
$Err[] = NF_PrintInput("Text",$AdminLangFile['webconfig_email_account_name'],"name","","","req",$MoreS);
echo '<div style="clear: both!important;"></div> ';
$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required data-parsley-type="email"', 'Dir'=> "En_Lang" );
$Err[] = NF_PrintInput("Text",$AdminLangFile['webconfig_email_email'],"sitemail","","","req",$MoreS);

$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required', 'Dir'=> "En_Lang" );
$Err[] = NF_PrintInput("Text",$AdminLangFile['webconfig_email_site_name'],"sitename","","","req",$MoreS);

$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required', 'Dir'=> "En_Lang" );
$Err[] = NF_PrintInput("Text",$AdminLangFile['webconfig_email_server_name'],"server","","","req",$MoreS);

echo '<div style="clear: both!important;"></div> ';
$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required data-parsley-type="digits" ', 'Dir'=> "En_Lang" );
$Err[] = NF_PrintInput("Text",$AdminLangFile['webconfig_email_port'],"port","","","req-num",$MoreS);



$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required', 'Dir'=> "En_Lang" );
$Err[] = NF_PrintInput("Text",$AdminLangFile['webconfig_email_username'],"user","","","req",$MoreS);


$MoreS = array('Col' => "col-md-4",'Placeholder'=> "",'required' => 'required', 'Dir'=> "En_Lang" );
$Err[] = NF_PrintInput("Text",$AdminLangFile['webconfig_email_password'],"pass","","","req",$MoreS);
echo '<div style="clear: both!important;"></div> ';


 

Form_Close('1');

if(isset($_POST['B1'])){
Vall($Err,"AddEmailConfig",$db,"1",$GroupPermation);
}
 

?>
</div></div>