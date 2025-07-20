$(document).ready(function() {
    // delete the entry once we have confirmed that it should be deleted
    $('.DellLead').click(function() {
		var parent = $(this).closest('tr');
		$.ajax({
			type: 'get',
			url: 'Leads_Delete_Ajex.php', // <- replace this with your url here
			data: 'ajax=1&delete=' + $(this).attr('id'),
			beforeSend: function() {
				parent.animate({'backgroundColor':'#FF0000'},300);
			},
			success: function() {
				parent.fadeOut(300,function() {
					parent.remove();
				});
			}
		});	        
    });
});