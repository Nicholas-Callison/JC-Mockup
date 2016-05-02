<?php 

	set_include_path(get_include_path() . PATH_SEPARATOR . '../lib');
	
	include("pathways.inc.php");
	html_header();
	
?>

  <link rel='stylesheet' id='jc-css'  href='css/jc-css.css' type='text/css' media='all' />

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


 <!--------Program---------->  
<div class="page-container">
	<div class="page-background-left"></div>
		<div class="row" data-equalizer="">
		
		<!----List----->
		<ul class="content-grid small-block-grid-1 medium-block-grid-2 large-block-grid-3">
		<li>
			<div class="content-item">
				<div class="image" style="background-image: url('https://www.jccmi.edu/wp-content/uploads/BusinessTechnologyPathway_thumb.jpg');"></div>
					<div class="overlay" style="background-color: #105864;"></div>
						<div class="text-container">
							<p class="text">Business &amp; Computer Technology</p>
						</div>
					</div>
		</li>
		<li>
			<div class="content-item">
				<div class="image" style="background-image: url('https://www.jccmi.edu/wp-content/uploads/EMSpathway_thumb.jpg');"></div>
					<div class="overlay" style="background-color: #aa002d;"></div>
						<div class="text-container">
							<p class="text">Health Sciences</p>
						</div>
					</div>
		</li>
		<li>
			<div class="content-item">
				<div class="image" style="background-image: url('https://www.jccmi.edu/wp-content/uploads/HumanServices.jpg');"></div>
					<div class="overlay" style="background-color: #528c10;"></div>
						<div class="text-container">
							<p class="text">Human Services</p>
						</div>
					</div>
		</li>
		<li>
			<div class="content-item">
				<div class="image" style="background-image: url('https://www.jccmi.edu/wp-content/uploads/LiberalArtsPathway_thumb.jpg');"></div>
					<div class="overlay" style="background-color: #48143a;"></div>
						<div class="text-container">
							<p class="text">Liberal Arts</p>
						</div>
					</div>
		</li>
		<li>
			<div class="content-item">
				<div class="image" style="background-image: url('https://www.jccmi.edu/wp-content/uploads/ScienceEngineeringPathway_thumb.jpg');"></div>
					<div class="overlay" style="background-color: #d29008;"></div>
						<div class="text-container">
							<p class="text">Science, Engineering &amp; Mathematics</p>
						</div>
					</div>
		</li>
		<li>
			<div class="content-item">
				<div class="image" style="background-image: url('https://www.jccmi.edu/wp-content/uploads/SkilledTrades.jpg');"></div>
					<div class="overlay" style="background-color: #002250;"></div>
						<div class="text-container">
							<p class="text">Skilled Trades &amp; Agriculture</p>
						</div>
					</div>
		<!----End List---->
		</li>
		</ul>
	</div>
<!---End Program--->
</div>
</div>
<?php html_footer(); ?>