<?php
    set_include_path(get_include_path() . PATH_SEPARATOR . '../lib');
	
	include("pathways.inc.php");
	html_header();
	
	html_footer();
?>


<table align="center" style="width:100%;padding-top:500px;background-color:transparent;border-style:none;">
	<tr>
		<td><a href="Pathways_Fall.php"><button class="btn btn-primary btn-lg btn-block">Winter</button></a></td>
	</tr>
	<tr style="background-color:transparent;">
		<td><a href="Pathways_Spring.php"><button class="btn btn-primary btn-lg btn-block">Spring</button></a></td>
	</tr>
	<tr>
		<td><a href="Pathways_Winter.php"><button class="btn btn-primary btn-lg btn-block">Fall</button></a></td>
	</tr>
</table>

