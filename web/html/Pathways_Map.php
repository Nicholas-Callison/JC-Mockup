<?php 

	set_include_path(get_include_path() . PATH_SEPARATOR . '../lib');
	
	include("pathways.inc.php");
	html_header();
	
?>

<!---Program--->
<div class="container" Style="Padding-top: 54px;">
  <h3 class="header">Please choose your program of study</h3> 
  <div class="panel-group" Style="padding-top: 20px">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">	
			<!---Program list--->
			<ul class="path">
				<li class="program"><a Style="pointer-events: none; cursor: default; vertical-align: middle">Accounting</li>
				<li class="type"><a href=#Associates>Associates</li>
				<li class="type"><a href=#Account>Certificate</li>
			</ul>
		</h4>
      </div>
    </div>
  </div>
  
  <!---Program--->
  <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
		<!---Program list--->
          <ul class="path">
				<li class="program"><a Style="pointer-events: none; cursor: default;">Business Administration</li>
                <li class="type"><a href=#Bachelor's>Bachelor's</li>
				<li class="type"><a href=#Associates>Associates</li>
				<li class="type"><a href=#support>Certificate</li>
			</ul>
        </h4>
      </div>
    </div>
  </div>
  
  <!---Program--->
  <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
		<!---Program list--->
          <ul class="path">
				<li class="program"><a Style="pointer-events: none; cursor: default;">Computer Networking</li>
				<li class="type"><a href=#Associates>Associates</li>
				<li class="type"><a href=#support>Certificate</li>
                <li class="type"><a href=#Concentration>Concentration</li>
			</ul>
        </h4>
      </div>
    </div>
  </div>
  
  <!---Program--->
  <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
		<!---Program list--->
			<ul class="path">
				<li class="program"><a Style="pointer-events: none; cursor: default;">Computer Programming Specialist</li>
				<li class="type"><a href=#Associates>Associates</li>
				<li class="type"><a href=#Prgoamming>Certificate</li>
			</ul>
        </h4>
      </div>
    </div>
  </div>
  
  <!---Program--->
  <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
		<!---Program list--->
          <ul class="path">
				<li class="program"><a Style="pointer-events: none; cursor: default;">Computer Support Specialist</li>
				<li class="type"><a href=#Associates>Associates</li>
				<li class="type"><a href=#support>Certificate</li>
			</ul>
        </h4>
      </div>
    </div>
  </div>
  
  <!---Program--->
  <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
		<!---Program list--->
          <ul class="path">
				<li class="program"><a Style="pointer-events: none; cursor: default;">Culinary Arts</li>
				<li class="type"><a href=#Associates>Associates</li>
				<li class="type"><a href=#Certificate>Certificate</li>
				<li class="type"><a href=#Concentration>Concentration</li>
				<li class="type"><a href=#skillSet>Skill Set</li>
			</ul>
        </h4>
      </div>
    </div>
  </div>
  
  <!---Program--->
  <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
		<!---Program list--->
          <ul class="path">
				<li class="program"><a Style="pointer-events: none; cursor: default;">Cyber Security</li>
				<li class="type"><a href=#Associates>Associates</li>
			</ul>
        </h4>
      </div>
    </div>
  </div>
  
  <!---Program--->
  <div class="panel-group">
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
		<!---Program list--->
          <ul class="path">
				<li class="program"><a Style="pointer-events: none; cursor: default;">Digital Photography</li>
				<li class="type"><a href=#Certificate>Certificate</li>
			</ul>
        </h4>
      </div>
    </div>
  </div>
</div>

<?php html_footer(); ?>