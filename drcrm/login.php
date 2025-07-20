<?php
require_once '../library/db-config_crm.php';
if(GOOGLE_AUTH == '1'){
require_once './library/Class/GoogleAuthenticator.php';
}
require_once './library/CheckLogin.php';

if(isset($_SESSION['adminSusername'.$pfw_db])){
  header('Location: '.$AdminPathHome.'index.php');
}

$errorMessage = '&nbsp;';

if (isset($_POST['txtUserName'])) {
	$result = doLogin();
	if ($result != '') {
		$errorMessage = $result;
	}
}

require_once 'include/Inc_Header_Loign.php';
?>
<div class="row row-table page-wrapper">
<div class="col-lg-3 col-md-6 col-sm-8 col-xs-12 align-middle">
<div data-toggle="play-animation" data-play="fadeIn" data-offset="0" class="panel panel-dark panel-flat">
        
<div class="panel-heading text-center">
<img src="<?php echo $AdminPath ?>app/img/Logo-W.png" style="max-height: 100px" alt="Image" class="block-center
img-rounded">
</div>
        
<div class="panel-body">
<form role="form"  method="post" class="mb-lg"  id="validate-form" data-parsley-validate enctype="multipart/form-data" >

    <div class="ErrMass"><?php echo $errorMessage; ?></div>


    <div class="form-group has-feedback">
    <input name="txtUserName" placeholder="User Name" required="required" data-parsley-minlength="5" data-parsley-type="alphanum" class="form-control">
    <span class="fa fa-user form-control-feedback text-muted"></span>
    </div>
    
    <div class="form-group has-feedback">
    <input name="txtPassword" type="password" placeholder="Password"  required="required" data-parsley-minlength="6" class="form-control">
    <span  class="fa fa-lock form-control-feedback text-muted"></span>
    </div>

<?php
if(GOOGLE_AUTH == '1'){
echo '<div class="form-group has-feedback">';
echo '<input name="google_code" type="text" placeholder="Authentication Code"  required="required" data-parsley-type="number" data-parsley-minlength="6" class="form-control">';
echo '<span  class="fa fa-qrcode form-control-feedback text-muted"></span>';
echo '</div>';    
}
?>

<button type="submit" class="btn btn-block btn-success">Login</button>
</form>
</div>
        
</div></div></div>

<script src="<?php echo $AdminPath ?>vendor/jquery/jquery.min.js"></script>
<script src="<?php echo $AdminPath ?>vendor/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo $AdminPath ?>vendor/animo/animo.min.js"></script>
<script src="<?php echo $AdminPath ?>app/js/pages.js"></script>
<script src="<?php echo $AdminPath ?>vendor/parsley/parsley.min_En.js"></script>
</body>
</html>

