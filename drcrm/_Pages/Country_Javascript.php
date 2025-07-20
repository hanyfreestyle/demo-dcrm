<script type="text/javascript">
$(document).ready(function(){
    $('#live_id').on('change',function(){
        var live_idID = $(this).val();
       // alert(live_idID);
        if(live_idID){
            $.ajax({
                type:'POST',
                url:'../_Pages/Country_Ajax.php',
                data:'live_id='+live_idID,
                success:function(html){
                      $('#country_id').html(html);
                      $('#country_id').trigger("chosen:updated");
                 }
            }); 
 
                $.ajax({
                type:'POST',
                url:'../_Pages/Country_Ajax.php',
                data:'live_id2='+live_idID,
                success:function(html){
                    $('#countrylive_id').html(html);
                    $('#countrylive_id').trigger("chosen:updated");
                }
            }); 
            
          
        }else{    
            $('#country_id').html('<option value=""><?php echo $AdminLangFile['customer_live_op'] ?></option>');
            $('#country_id').trigger("chosen:updated");
            $('#countrylive_id').html('<option value=""><?php echo $AdminLangFile['customer_live_op'] ?></option>');
            $('#countrylive_id').trigger("chosen:updated");
        }
    });

});
</script>
