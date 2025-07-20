/**
 *************************** Check All 
 */

 
(function($, window, document){
  'use strict';
  $(function(){
    if ( ! $.fn.dataTable ) return;
      $('#NewTableOrder').dataTable({
	    'paging':   true,  // Table pagination
        'ordering': true,  // Column ordering 
        'info':     true,  // Bottom left status text
		"order": [[ 0, "desc" ]],
		"responsive": true,
 
        oLanguage: {
            sSearch:      '',
            sLengthMenu:  '_MENU_',
            info:         'Showing page _PAGE_ of _PAGES_',
            zeroRecords:  'Nothing found - sorry',
            infoEmpty:    'No records available',
			 sNext :      'Erste',
            infoFiltered: '(filtered from _MAX_ total records)'
        },
		 
    });
});
}(jQuery, window, document));
 
 
function check_all_in_document(doc)
{
    
  var c = new Array();
  c = doc.getElementsByTagName('input');
  for (var i = 0; i < c.length; i++)
  {
    if (c[i].type == 'checkbox')
    {
      c[i].checked = true;
    }
  }
}


function check_no_in_document(doc)
{
  var c = new Array();
  c = doc.getElementsByTagName('input');
  for (var i = 0; i < c.length; i++)
  {
    if (c[i].type == 'checkbox')
    {
      c[i].checked = false;
    }
  }
}

function Check(chk)
{
if(document.myform.Check_ctr.checked==true){
check_all_in_document(myform);
}else{
check_no_in_document(myform);
}
}



$(document).ready(function() {
    // delete the entry once we have confirmed that it should be deleted
    $('.Delete_Unit').click(function() {
		var parent = $(this).closest('tr');
		$.ajax({
			type: 'get',
			url: 'Unit_Dell_Ajex.php', // <- replace this with your url here
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






$(document).ready(function() {
    $('.UpdateFildeState').click(function() {
		// alert('id='+$(this).attr('id')+'&fstate='+$(this).attr('fstate'));									  
		var parent = $(this).closest('tr');
		$.ajax({
			type: 'get',
		  	url: 'Cat_Permission_Ajex.php', // <- replace this with your url here
			data: 'id='+$(this).attr('id')+'&fstate='+$(this).attr('fstate') ,
			success: function(html) {
			/// $('#city').html(html);
			}
		});	        
    });
});








$(document).ready(function() {
    $('.UpdateConfig').click(function() {
	//	alert('newvall='+$(this).attr('id')+'&fild=' + $(this).attr('type'));									  
		var parent = $(this).closest('tr');
		$.ajax({
			type: 'get',
		 	url: 'Config_Ajex.php', // <- replace this with your url here
			data: 'newvall='+$(this).attr('id')+'&fild=' + $(this).attr('type') ,
			success: function() {
			location.reload();
			}
		});	        
    });
});



/*
$(document).ready(function() {
    $('.UpdateConfigAjex').click(function() {
	   //alert('newvall='+$(this).attr('id')+'&fild=' + $(this).attr('type'));									  
		var parent = $(this).closest('tr');
		$.ajax({
			type: 'get',
		 	url: 'Inc_Php/Config_Ajex.php', // <- replace this with your url here
			data: 'newvall='+$(this).attr('id')+'&fild=' + $(this).attr('type') ,
			success: function() {
			location.reload();
			}
		});	        
    });
});
*/

$(document).ready(function(){
     $('.UpdateConfigAjex').click(function() {
      // alert('newvall='+$(this).attr('id')+'&fild=' + $(this).attr('type'));		
            $.ajax({
                type:'get',
                url: '_Config_Ajex.php',
                data: 'newvall='+$(this).attr('id')+'&fild=' + $(this).attr('type') ,
                success:function(html){
                     // $('#Test').html(html);
					  location.reload();
                 }
            }); 
    });
});




$("#showr" ).click(function() {
  $("#showr_d" ).show( "slow" );
});
		




$(document).ready(function() {
    $('.UpdateFildeState').click(function() {
		//alert( 'id='+$(this).attr('id')+'&fstate='+$(this).attr('fstate')+'&ftype='+$(this).attr('ftype') );									  
		var parent = $(this).closest('tr');
		$.ajax({
			type: 'get',
		  	url: 'PropertyType_List_Fildes_Ajex.php', // <- replace this with your url here
			data: 'id='+$(this).attr('id')+'&fstate='+$(this).attr('fstate')+'&ftype='+$(this).attr('ftype') ,
			success: function() {
			//location.reload();
			}
		});	        
    });
});




$(document).ready(function() {
    $('.UpdateFildeState').click(function() {
		//alert('id='+$(this).attr('id')+'&fstate='+$(this).attr('fstate'));									  
		var parent = $(this).closest('tr');
		$.ajax({
			type: 'get',
		  	url: 'UpdateUnitState_Ajex.php', // <- replace this with your url here
			data: 'id='+$(this).attr('id')+'&fstate='+$(this).attr('fstate') ,
			success: function() {
			//location.reload();
			}
		});	        
    });
});

		
$(document).ready(function () {
         $("#hide_butS").click(function () {
             $(".target_SearchDiv").slideUp();
             $('#show_butS').show();
             $('#hide_butS').hide();
         });
         $("#show_butS").click(function () {
             $(".target_SearchDiv").slideDown();
             $('#show_butS').hide();
             $('#hide_butS').show();
         });
});


$(function() {
$('#g_name').maxlength({max: 70});
$('#g_name_en').maxlength({max: 70});
$('#g_des').maxlength({max: 160});
$('#g_des_en').maxlength({max: 160});
$('#g_key_en').maxlength({max: 265});
$('#g_key').maxlength({max: 265});

});



//POTENZA var
var POTENZA = {};
 
 (function($){
  "use strict";

/*************************
      Predefined Variables
*************************/ 
var $window = $(window),
	$document = $(document),
	$body = $('body'),
	$countdownTimer = $('.countdown'),
	$counter = $('.counter-main');

//Check if function exists
$.fn.exists = function () {
	return this.length > 0;
};


/*************************
      Predefined Variables
*************************/ 
   var $window = $(window),
        $document = $(document),
        $body = $('body'),
        $countdownTimer = $('.countdown'),
        $bar = $('.bar'),
		$progressBar = $('.progress-bar'),
        $counter = $('.counter');

    //Check if function exists
     $.fn.exists = function () {
        return this.length > 0;
    };
	

 /*************************
        Preloader
*************************/  
  POTENZA.preloader = function () {
       $("#load").fadeOut();
       $('#preloader').delay(0).fadeOut('slow');
   };
	




/*************************
     Back to top
*************************/
 POTENZA.goToTop = function () {
  var $goToTop = $('#back-to-top');
      $goToTop.hide();
    	$window.scroll(function(){
  		  if ($window.scrollTop()>100) $goToTop.fadeIn();
  		  else $goToTop.fadeOut();
  	  });
  	$goToTop.on("click", function () {
  		$('body,html').animate({scrollTop:0},1000);
  		return false;
    });
  }

/****************************************************
     POTENZA Window load and functions
****************************************************/

  //Window load functions
    $window.load(function () {
          POTENZA.preloader(),
          POTENZA.Isotope(),
		  POTENZA.masonry(),
		  POTENZA.progressBar();
    });

 //Document ready functions
    $document.ready(function () {
        POTENZA.megaMenu(),
        POTENZA.counters(),
        POTENZA.accordion(),
        POTENZA.carousel(),
		POTENZA.Parallax(),
		POTENZA.Contactform(),
		POTENZA.countdownTimer(),
		POTENZA.goToTop(),
        POTENZA.mediaPopups(),
        POTENZA.countdownTimer();
    });


})(jQuery);
 
 
 
