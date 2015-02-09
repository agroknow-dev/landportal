<?php
/**
 * @file
 * Widget page main content template
 *
 * The Landportal landbook
 *
 * Original work by: WESO (http://www.weso.es/)
 * Drupal refactoring: Jules <jules@ker.bz>
 */
?>

<canvas id="canvas" class="hidden"></canvas>
<div class="content main-content container">
	<div class="row">
	  <div class="col-sm-9 graph-section">
		  <h2 class="section"><span><?php echo t("Create your own Land Portal data visualisation"); ?></span></h2>
		  <form role="form">
		  	<div class="row">
			  	<div class="col-sm-12">
					<label for="indicator"><?php echo t("Indicator"); ?></label>
					<select id="indicator-select" class="form-control">
<?php foreach ($data['selectors']['data-sources'] as $t): ?>
									<optgroup label="<?php echo $t['name']; ?>">
<?php foreach ($t['indicators'] as $i): ?>
										<option value="<?php echo $i['id']; ?>"><?php echo $i['name']; ?></option>
<?php endforeach; ?>
									</optgroup>
<?php endforeach; ?>
					</select>
				</div>
				<div class="col-sm-4 hidden">
					<label for="number_years"><?php echo t("Number of years"); ?></label>
					<select id="number_years" class="form-control">
						<option>1</option>
						<option>2</option>
						<option selected="selected">3</option>
						<option>4</option>
						<option>5</option>
					</select>
				</div>
		  	</div>
			<h2 class="section country-form-title"><span><?php echo t("Countries"); ?></span></h2>
		  	<div class="row">

					<div id="row-prototype" class="hidden">
						<div class="col-sm-2 delete-row">
							<label><?php echo t("Delete"); ?></label>
							<i class="fa fa-times fa-2x"></i>
						</div>
						<div class="col-sm-6 country-selection-row">
							<label for="country"><?php echo t("Select a country"); ?></label>
							<select class="form-control country-select">
<?php foreach ($data['selectors']['countries'] as $c): ?>
										<option value="<?php echo $c['iso3']; ?>"><?php echo $c['name']; ?></option>
<?php endforeach; ?>
							</select>
						</div>
						<div class="col-sm-4 country-selection-row">
							<label><?php echo t("Pick a colour"); ?></label>
							<div class="row palette-empty" row="1">
							</div>
						</div>
					</div>
					<div id="countries">
					</div>

					<div class="col-sm-12 text-right">
						<button id="add-country" type="button" class="btn btn-primary">
							<?php echo t("Add a country"); ?>
						</button>
					</div>
		  	</div>
		  </form>
		  <h2 class="section country-form-title"><span><?php echo t("Preview"); ?></span></h2>
		  <p id="chart-title" class="chart-title"><?php echo t("Title"); ?></p>
		  <p id="chart-description"><?php echo t("Description"); ?></p>
		  <div id="mapDiv" class="graph graph-huge"></div>
		  <div class="row">
		  	<div class="col-sm-6">
			  <h2 class="section country-form-title"><span><?php echo t("Share"); ?></span></h2>
			  <div class="row">
			  	<div class="col-xs-6 col-sm-3 text-center share-widget">
				  	<a id="mail-link" href="" target="_blank">
				  		<i class="fa fa-envelope fa-3x"></i>
				  	</a>
			  	</div>
			  	<div class="col-xs-6 col-sm-3 text-center share-widget">
			  		<a id="twitter-link" href="" target="_blank">
			  			<i class="fa fa-twitter fa-3x"></i>
			  		</a>
			  	</div>
			  	<div class="col-xs-6 col-sm-3 text-center share-widget">
				  	<a id="facebook-link" href="" target="_blank">
					  	<i class="fa fa-facebook fa-3x"></i>
 					</a>
			  	</div>
			  	<div class="col-xs-6 col-sm-3 text-center share-widget">
				  	<a id="linkedin-link" href="" target="_blank">
				  		<i class="fa fa-linkedin fa-3x"></i>
				  	</a>
			  	</div>
			  </div>
		  	</div>
		  	<div class="col-sm-6">
			  <h2 class="section country-form-title"><span><?php echo t("Download"); ?></span></h2>
			  <div class="row image-links">
			  	<div class="col-sm-3 text-center image-format">
				  	<a id="png-link" target="_blank" href="data:image/png;" download="chart.png">PNG</a>
			  	</div>
			  	<div class="col-sm-3 text-center image-format">
				  	<a id="jpg-link" target="_blank" href="data:image/jpg;" download="chart.jpg">JPG</a>
			  	</div>
			  	<div class="col-sm-3 text-center image-format">
				  	<a id="gif-link" target="_blank" href="data:image/gif;" download="chart.gif">GIF</a>
			  	</div>
			  	<div class="col-sm-3 text-center image-format">
				  	<a id="svg-link" target="_blank" href="data:image/svg;" download="chart.svg">SVG</a>
			  	</div>
			  </div>
		  	</div>
		  </div>
		  <h2 class="section country-form-title"><span><?php echo t("Permalink"); ?></span></h2>
		  <p class="text-center permalink">
			  <a href="" id="permalink"></a>
		  </p>
		  <h2 class="section country-form-title"><span><?php echo t("Include in your website"); ?></span></h2>
		  <label for="copy_code"><?php echo t("Copy and paste the following code into the HTML of your website to include the chart"); ?></label>
		  <textarea class="form-control" id="copy_code" rows="8"></textarea>
      </div>
	  <div class="col-sm-3">
	  	  <h2 class="section"><span><?php echo t("Graph type"); ?></span></h2>
	  	  <div class="row chart-type-texts">
	  	  	<div class="col-sm-4 text-center widget-chart-button widget-button-selected" chart-type="barchart">
	  	  		<div>
		  	  		<img src="/<?php echo drupal_get_path('theme', 'landportal'); ?>/images/widgets/bar-selected.png" alt="<?php echo t("Bar chart"); ?>" />
	  	  		</div>
	  	  		<span><?php echo t("Bar chart"); ?></span>
	  	  	</div>
	  	  	<div class="col-sm-4 text-center widget-chart-button" chart-type="linechart">
	  	  		<div>
		  	  		<img src="/<?php echo drupal_get_path('theme', 'landportal'); ?>/images/widgets/line.png" alt="<?php echo t("Line chart"); ?>" />
	  	  		</div>
	  	  		<span><?php echo t("Line chart"); ?></span>
	  	  	</div>
	  	  	<div class="col-sm-4 text-center widget-chart-button" chart-type="piechart">
	  	  		<div>
		  	  		<img src="/<?php echo drupal_get_path('theme', 'landportal'); ?>/images/widgets/pie.png" alt="<?php echo t("Pie chart"); ?>" />
	  	  		</div>
	  	  		<span><?php echo t("Pie chart"); ?></span>
	  	  	</div>
	  	  </div>
	  	  <div class="row chart-type-texts">
	  	  	<div class="col-sm-4 text-center widget-chart-button" chart-type="map">
	  	  		<div>
		  	  		<img src="/<?php echo drupal_get_path('theme', 'landportal'); ?>/images/widgets/map.png" alt="<?php echo t("Map chart"); ?>" />
	  	  		</div>
	  	  		<span><?php echo t("Map chart"); ?></span>
	  	  	</div>
	  	  	<div class="col-sm-4 text-center widget-chart-button" chart-type="areachart">
	  	  		<div>
		  	  		<img src="/<?php echo drupal_get_path('theme', 'landportal'); ?>/images/widgets/area.png" alt="<?php echo t("Area chart"); ?>" />
	  	  		</div>
	  	  		<span><?php echo t("Area chart"); ?></span>
	  	  	</div>
	  	  	<div class="col-sm-4 text-center widget-chart-button" chart-type="table">
	  	  		<div>
		  	  		<img src="/<?php echo drupal_get_path('theme', 'landportal'); ?>/images/widgets/table.png" alt="<?php echo t("Data table"); ?>" />
	  	  		</div>
	  	  		<span><?php echo t("Data table"); ?></span>
	  	  	</div>
	  	  </div>
	  	  <div class="row chart-type-texts">
					<div class="col-sm-4"></div>
	  	  	<div class="col-sm-4 text-center widget-chart-button" chart-type="polarchart">
	  	  		<div>
		  	  		<img src="/<?php echo drupal_get_path('theme', 'landportal'); ?>/images/widgets/polar.png" alt="<?php echo t("Polar chart"); ?>" />
	  	  		</div>
	  	  		<span><?php echo t("Polar chart"); ?></span>
	  	  	</div>
	  	  	<div class="col-sm-4 text-center widget-chart-button disabled hidden" chart-type="scatterchart">
	  	  		<div>
		  	  		<img src="/<?php echo drupal_get_path('theme', 'landportal'); ?>/images/widgets/scatter.png" alt="<?php echo t("Scatter chart"); ?>" />
	  	  		</div>
	  	  		<span><?php echo t("Scatter chart"); ?></span>
	  	  	</div>
	  	  	<div class="col-sm-4 text-center">

	  	  	</div>
	  	  </div>
	  	  <h2 class="section"><span><?php echo t("Tell the story"); ?></span></h2>
	  	  <form role="form" class="widget-description">
			  <div class="form-group">
			    <label for="title"><?php echo t("Title"); ?></label>
			    <input type="text" class="form-control" id="title" value="<?php echo t("Title"); ?>" placeholder="<?php echo t("Title"); ?>">
			    <label for="description"><?php echo t("Description"); ?></label>
			    <textarea class="form-control" id="description" rows="3"><?php echo t("Description"); ?></textarea>
			    <label for="label_x"><?php echo t("label_x"); ?></label>
			    <input type="text" class="form-control" id="label_x" value="<?php echo t("Years"); ?>" placeholder="<?php echo t("Label_x"); ?>">
			    <label for="label_y"><?php echo t("label_y"); ?></label>
			    <input type="text" class="form-control" id="label_y" value="<?php echo t("Values"); ?>" placeholder="<?php echo t("label_y"); ?>">
			  </div>
	  	  </form>
	  </div>
	</div>
</div>
