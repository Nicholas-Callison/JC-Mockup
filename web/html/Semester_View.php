<?php
    set_include_path(get_include_path() . PATH_SEPARATOR . '../lib');
	
	include("pathways.inc.php");
	html_header();
	
?>
  
<style>
  .td16bold{
	width:16%;
	text-align:center;
	font-weight:bold;
	border:inherit;
  }
  .td8bold{
	width:8%;
	text-align:center;
	font-weight:bold;
	border:inherit;
  }
  .td12bold{
	width:12%;
	text-align:center;
	font-weight:bold;
	border:inherit;
  }
  .td14bold{
	width:14%;
	text-align:center;
	font-weight:bold;
	border:inherit;
  }
  .td18bold{
	width:18%;
	text-align:center;
	font-weight:bold;
	border:inherit;
  }
  td.content{
	border:inherit;
  }
  
  
  ul{
	background-color:inherit;
	list-style-type: circle;
  }
  li{
	list-style-type: inherit;
  }
  li:hover{
	background-color: inherit;
	color: inherit;
  }
  
  
  table{
	border: 1px solid black;
  }
  tr{
	border: 1px solid black;
  }
</style>




<div class="container-fluid">

<div class="row">
<div class="col-md-2">
	<a href="iGoNowhereYet.html">Click here to start over</a>
</div><!--collumn-->
</div><!--row-->

<!--Main loop start-->
<div class="row">
<div class="col-md-12">
<table style="width:100%; border: 1px solid black;">							<!--Table-->
	<tr><th colspan="4">Computer Programming Specialist</th><th colspan="3" style="text-align:right">Year 1 - Fall</th></tr>
	<tr><td class="td16bold">Course</td>					<td class="td8bold"># Credits</td>					<td class="td16bold">Milestones and Activities</td>	<td class="td12bold">Prerequisites</td>			<td class="td16bold">This is a Prerequisite for what courses?</td>	<td class="td18bold">Type of Course for this degree</td>	<td class="td14bold">Applicable for what awards?</td></tr>
	<tr><td class="content">CIS 158: Programming Logic</td>	<td class="content">3</td>							<td class="content">2.5 or higher</td>				<td class="content">CIS 095</td>				<td class="content">CIS 244</td>									<td class="content"><ul><li>Core Requirement</li></ul></td>	<td class="content"><ul><li>Certificate</li><li>Associates</li></ul></td></tr>
	<tr><td class="content">CIS 160: VB</td>				<td class="content">3</td>							<td class="content"></td>							<td class="content">CIS 095 and MAT 020</td>	<td class="content"></td>											<td class="content"><ul><li>Core Requirement</li></ul></td>	<td class="content"><ul><li>Certificate</li><li>Associates</li></ul></td></tr>
</table>
</div><!--collumn-->
</div><!--row-->

<div style="height:75px;"></div>												<!--Divider-->

<div class="row">
<div class="col-md-12">
<table style="width:100%; border: 1px solid black;">							<!--Table-->
	<tr><th colspan="4">Computer Programming Specialist</th><th colspan="3" style="text-align:right">Year 1 - Winter</th></tr>
	<tr><td class="td16bold">Course</td>					<td class="td8bold"># Credits</td>					<td class="td16bold">Milestones and Activities</td>	<td class="td12bold">Prerequisites</td>			<td class="td16bold">This is a Prerequisite for what courses?</td>	<td class="td18bold">Type of Course for this degree</td>	<td class="td14bold">Applicable for what awards?</td></tr>
	<tr><td class="content">CIS 158: Programming Logic</td>	<td class="content">3</td>							<td class="content">2.5 or higher</td>				<td class="content">CIS 095</td>				<td class="content">CIS 244</td>									<td class="content"><ul><li>Core Requirement</li></ul></td>	<td class="content"><ul><li>Certificate</li><li>Associates</li></ul></td></tr>
	<tr><td class="content">CIS 160: VB</td>				<td class="content">3</td>							<td class="content"></td>							<td class="content">CIS 095 and MAT 020</td>	<td class="content"></td>											<td class="content"><ul><li>Core Requirement</li></ul></td>	<td class="content"><ul><li>Certificate</li><li>Associates</li></ul></td></tr>
</table>
</div><!--collumn-->
</div><!--row-->


</div><!--container-->
	
<?php html_footer(); ?>