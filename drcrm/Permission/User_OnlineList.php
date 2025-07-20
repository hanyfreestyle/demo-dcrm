<script>
    $(document).ready(function(){
        fetch_user_login_data();
        setInterval(function(){
            fetch_user_login_data();
        }, 30000);
        function fetch_user_login_data()
        {
            var action = "fetch_data";
            $.ajax({
                url:"User_OnlineList_Ajex.php",
                method:"POST",
                data:{action:action},
                success:function(data)
                {
                    $('#user_login_status').html(data);
                }
            });
        }
    });
</script>

<?php
if(!defined('WEB_ROOT')) {	exit;}
 
 
###########################################################>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
OPen_Page($PageTitle);


 

echo '<div id="user_login_status"></div>';
 
###########################################################<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Close_Page();
 	
?>