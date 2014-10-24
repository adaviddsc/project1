<?php
session_start();
?>
<head>
	<link rel="stylesheet" type="text/css" href="stylesheets/donateinfo-dialog.css">
	<link rel="stylesheet" href="external/bootstrap-theme.min.css">
	<link rel="stylesheet" href="external/bootstrap.min.css">
</head>
<div class="modal fade" id="myModal-donateinfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content" id="modal-content-donateinfo">
		    <div class="modal-header" id="modal-header-info-donate">
		        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>		        
		    </div>
		    <div class="modal-body">
		      	<div id="carousel-example-generic-donate" class="carousel slide" data-ride="carousel">
			      	<ol class="carousel-indicators" id="carousel-indicators-donateinfo"></ol>
			    	<div class="carousel-inner" id="carousel-inner-donateinfo"></div>
			      	<a class="left carousel-control" href="#carousel-example-generic-donate" role="button" data-slide="prev">
			        	<span class="glyphicon glyphicon-chevron-left"></span>
			      	</a>
			      	<a class="right carousel-control" href="#carousel-example-generic-donate" role="button" data-slide="next">
			        	<span class="glyphicon glyphicon-chevron-right"></span>
			      	</a>
			    </div>	
		    </div>
			<div class="modal-footer" id="modal-footer-donateinfo"></div>
		</div>
	</div>
</div>

