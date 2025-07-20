
<!-- Plugins-->
<script src="<?php echo $AdminPath ?>vendor/chosen/chosen.jquery.min.js"></script>
<script src="<?php echo $AdminPath ?>vendor/slider/js/bootstrap-slider.js"></script>
<script src="<?php echo $AdminPath ?>vendor/filestyle/bootstrap-filestyle.min.js"></script>

<!-- Animo-->
<script src="<?php echo $AdminPath ?>vendor/animo/animo.min.js"></script>
<!-- Sparklines-->
<script src="<?php echo $AdminPath ?>vendor/sparklines/jquery.sparkline.min.js"></script>
<!-- Slimscroll-->
<script src="<?php echo $AdminPath ?>vendor/slimscroll/jquery.slimscroll.min.js"></script>
<!-- Store + JSON-->
<script src="<?php echo $AdminPath ?>vendor/store/store+json2.min.js"></script>
<!-- Classyloader-->
<script src="<?php echo $AdminPath ?>vendor/classyloader/js/jquery.classyloader.min.js"></script>


<!-- START Page Custom Script--------------------------------------------------------------------------------->

<!-- START Page Custom Script  Form Wizard-->
<script src="<?php echo $AdminPath ?>vendor/wizard/js/bwizard.min.js"></script>

<!-- Form Validation-->
<script src="<?php echo $AdminPath ?>vendor/parsley/parsley.min_<?php echo ADMIN_WEB_LANG ?>.js"></script>

<!-- Markdown Area Codemirror and dependencies -->
<script src="<?php echo $AdminPath ?>vendor/codemirror/lib/codemirror.js"></script>
<script src="<?php echo $AdminPath ?>vendor/codemirror/addon/mode/overlay.js"></script>
<script src="<?php echo $AdminPath ?>vendor/codemirror/mode/markdown/markdown.js"></script>
<script src="<?php echo $AdminPath ?>vendor/codemirror/mode/xml/xml.js"></script>
<script src="<?php echo $AdminPath ?>vendor/codemirror/mode/gfm/gfm.js"></script>
<script src="<?php echo $AdminPath ?>vendor/marked/marked.js"></script>

<!-- MomentJs and Datepicker-->
<script src="<?php echo $AdminPath ?>vendor/moment/min/moment-with-langs.min.js"></script>
<script src="<?php echo $AdminPath ?>vendor/datetimepicker/js/bootstrap-datetimepicker.min.js"></script>


<!-- Tags input-->
<script src="<?php echo $AdminPath ?>vendor/tagsinput/bootstrap-tagsinput.min.js"></script>

<!-- Input Mask-->
<script src="<?php echo $AdminPath ?>vendor/inputmask/jquery.inputmask.bundle.min.js"></script>


<!-- Gmap
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script src="<?php echo $AdminPath ?>vendor/gmap/jquery.gmap.min.js"></script>
-->

<!-- Data Table Scripts -->
<script src="<?php echo $AdminPath ?>vendor/datatable/media/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $AdminPath ?>vendor/datatable/extensions/datatable-bootstrap/js/dataTables.bootstrap.js"></script>
<script src="<?php echo $AdminPath ?>vendor/datatable/extensions/datatable-bootstrap/js/dataTables.bootstrapPagination.js"></script>
<script src="<?php echo $AdminPath ?>vendor/datatable/extensions/ColVis/js/dataTables.colVis.min.js"></script>

<!--
<script src="<?php echo $AdminPath ?>vendor/datatable/new/jquery.dataTables.min.js"></script>
<script src="<?php echo $AdminPath ?>vendor/datatable/new/dataTables.buttons.min.js"></script>
<script src="<?php echo $AdminPath ?>vendor/datatable/new/buttons.flash.min.js"></script>
<script src="<?php echo $AdminPath ?>vendor/datatable/new/jszip.min.js"></script>
<script src="<?php echo $AdminPath ?>vendor/datatable/new/pdfmake.min.js"></script>
<script src="<?php echo $AdminPath ?>vendor/datatable/new/vfs_fonts.jsX"></script>
<script src="<?php echo $AdminPath ?>vendor/datatable/new/buttons.html5.min.js"></script>
<script src="<?php echo $AdminPath ?>vendor/datatable/new/buttons.print.min.js"></script>
   -->



<link rel="stylesheet" type="text/css" href="<?php echo $AdminPath ?>WebCss/NewTabel/css/component.css" />
<script src="<?php echo $AdminPath ?>WebCss/NewTabel/js/jquery.ba-throttle-debounce.min.js"></script>
<script src="<?php echo $AdminPath ?>WebCss/NewTabel/js/jquery.stickyheader.js"></script>



<!-- Color Picker --------------------------------------------------------------------------------------------------------------->
<script type="text/javascript">
	var imageUrl="<?php echo $AdminPath ?>inc/Color2/color.png"; // optionally, you can change path for images.
</script>
<script  src="<?php echo $AdminPath ?>inc/Color2/izzyColor.js" type="text/javascript"></script>
<script  src="<?php echo $AdminPath ?>inc/jquery.number.js" type="text/javascript"></script>


<?php
if($ThisPageForReport != '1'){
?>
<script src="<?php echo $AdminPath ?>vendor/flot/jquery.flot.min.js"></script>
<script src="<?php echo $AdminPath ?>vendor/flot/jquery.flot.tooltip.min.js"></script>
<script src="<?php echo $AdminPath ?>vendor/flot/jquery.flot.resize.min.js"></script>
<script src="<?php echo $AdminPath ?>vendor/flot/jquery.flot.pie.min.js"></script>
<script src="<?php echo $AdminPath ?>vendor/flot/jquery.flot.time.min.js"></script>
<script src="<?php echo $AdminPath ?>vendor/flot/jquery.flot.categories.min.js"></script>
<?php
}  
?>



<!-- App Main-->
<script src="<?php echo $AdminPath ?>app/js/app.js"></script>
<script src="<?php echo $AdminPath ?>WebCss/js/NewJs.js"></script>
<!-- END Scripts-->





<!--- ForMobile
<script src="<?php echo $AdminPath ?>inc/jquery.dataTables.min.js"></script>
<script src="<?php echo $AdminPath ?>inc/dataTables.responsive.js"></script>

-->


