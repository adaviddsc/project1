<!DOCTYPE HTML>
<?php
session_start();
?>
<head>
	<link rel="stylesheet" type="text/css" href="stylesheets/helpinfo-dialog.css">
	<script type="text/javascript">
		$('.carousel-inner button').css('display', 'none');

	</script>
</head>
<div class="modal fade" id="myModal-helpinfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content" id="modal-content-helpinfo">
		    <div class="modal-header" id="modal-header-info">
		        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>		        
		    </div>
		    <div class="modal-body">
		      	<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
			      	<ol class="carousel-indicators" id="carousel-indicators-helpinfo"></ol>
			    	<div class="carousel-inner" id="carousel-inner-helpinfo"></div>
			      	<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
			        	<span class="glyphicon glyphicon-chevron-left"></span>
			      	</a>
			      	<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
			        	<span class="glyphicon glyphicon-chevron-right"></span>
			      	</a>
			    </div>	
		    </div>
			<div class="modal-footer" id="modal-footer-helpinfo"></div>
		</div>
	</div>
</div>

