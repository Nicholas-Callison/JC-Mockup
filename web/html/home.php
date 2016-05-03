<?php
/* TODO: Fix some of the styling in this file, it's minor, but would be nice. */

html_header("");
?>

<div class="page-container">
  <div class="page-background-left"></div>
    <div class="row" data-equalizer="">
      <ul class="content-grid small-block-grid-1 medium-block-grid-2 large-block-grid-3">
        <li>
          <div class="content-item">
            <div class="image" style="background-image: url('https://www.jccmi.edu/wp-content/uploads/BusinessTechnologyPathway_thumb.jpg');"></div>
            <div class="overlay" style="background-color: #105864;"></div>
              <div class="text-container">
                <span class="icon fa fa-fa fa-briefcase"></span>
                <p class="text">Business &amp; Computer Technology</p>
              </div>
              <a href="<?= get_uri('/pathway/business-and-computer-technology', true) ?>" class="content-item-link"><span></span></a>
          </div>
        </li>
        <li>
          <div class="content-item">
            <div class="image" style="background-image: url('https://www.jccmi.edu/wp-content/uploads/EMSpathway_thumb.jpg');"></div>
            <div class="overlay" style="background-color: #aa002d;"></div>
              <div class="text-container">
                <span class="icon fa fa-fa fa-plus-square"></span>
                <p class="text">Health Sciences</p>
              </div>
            <a href="<?= get_uri('/pathway/health-sciences', true) ?>" class="content-item-link"><span></span></a>
          </div>
        </li>
        <li>
          <div class="content-item">
            <div class="image" style="background-image: url('https://www.jccmi.edu/wp-content/uploads/HumanServices.jpg');"></div>
            <div class="overlay" style="background-color: #528c10;"></div>
              <div class="text-container">
                <span class="icon fa fa-fa fa-users"></span>
                <p class="text">Human Services</p>
              </div>
            <a href="<?= get_uri('/pathway/human-services', true) ?>" class="content-item-link"><span></span></a>
          </div>
        </li>
        <li>
          <div class="content-item">
            <div class="image" style="background-image: url('https://www.jccmi.edu/wp-content/uploads/LiberalArtsPathway_thumb.jpg');"></div>
            <div class="overlay" style="background-color: #48143a;"></div>
              <div class="text-container">
                <span class="icon fa fa-fa fa-paint-brush"></span>
                <p class="text">Liberal Arts</p>
              </div>
            <a href="<?= get_uri('/pathway/liberal-arts', true) ?>" class="content-item-link"><span></span></a>
          </div>
        </li>
        <li>
          <div class="content-item">
            <div class="image" style="background-image: url('https://www.jccmi.edu/wp-content/uploads/ScienceEngineeringPathway_thumb.jpg');"></div>
            <div class="overlay" style="background-color: #d29008;"></div>
              <div class="text-container">
                <span class="icon fa fa-fa fa-flask"></span>
                <p class="text">Science, Engineering &amp; Mathematics</p>
              </div>
            <a href="<?= get_uri('/pathway/science_-engineering-and-mathematics', true) ?>" class="content-item-link"><span></span></a>
          </div>
        </li>
        <li>
          <div class="content-item">
            <div class="image" style="background-image: url('https://www.jccmi.edu/wp-content/uploads/SkilledTrades.jpg');"></div>
            <div class="overlay" style="background-color: #002250;"></div>
              <div class="text-container">
                <span class="icon fa fa-fa fa-wrench"></span>
                <p class="text">Skilled Trades &amp; Agriculture</p>
              </div>
            <a href="<?= get_uri('/pathway/skilled-trades-and-agriculture', true) ?>" class="content-item-link"><span></span></a>
          </div>
        </li>
      </ul>
    </div>
  </div>

<?php

html_footer();

?>
