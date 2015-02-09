<?php
/* Stuff */

?>

<div class="content main-content container">
	<div class="row countries-container">
		<div class="col-sm-12">
            <p>
   <?php echo t("The Land Book follows the classification made by the <a href='http://www.fao.org/countryprofiles/geoinfo/geopolitical/resource/'>Geopolitical Ontology from the Food and Agriculture Organization</a> of the United Nations."); ?>
            </p>
            <ul>
                <li><?php echo t("No data is currently available for the countries marked as"); ?> <i class="fa fa-ban"></i></li>
                <li><?php echo t("Extended data is available for the countries marked as"); ?> <i class="fa fa-star"></i></li>
            </ul>
        </div>
    </div>
    <div class="row countries-container">
        <div class="col-sm-6 col-lg-4">
            <label for="select-country"><?php echo t("Select a country"); ?>:</label>
            <select id="country-select" class="countries-country-select" name="select-country">
            	<option selected="true"><?php echo t("Select a country"); ?></option>
<?php foreach ($data['countries'] as $c): ?>
                <option value="<?php echo $c['iso3']; ?>" <?php if (!$c['data']) echo ' disabled="disabled"'; ?>><?php echo $c['name']; ?></option>
<?php endforeach; /* countries */ ?>

            </select>
        </div>
        <div class="col-sm-6 col-lg-4">
            <input id="expand" type="checkbox" name="expand-all" />
            <label for="expand-all"><?php echo t("Expand all"); ?></label>
        </div>
        <div class="col-sm-6 col-lg-4">
            <input id="no-data-countries" type="checkbox" name="show-only" />
            <label for="show-only"><?php echo t("Show only countries with available data"); ?></label>
        </div>
    </div>
    <div class="continents">
<?php foreach ($data['continents'] as $continents): ?>
        <div class="row continent">
            <div class="col-sm-12 countries">
                <h1 class="country-name"><span><?php echo $continents['name']; ?></span><span class="down"><i class="fa fa-angle-down"></i></span></h1>
                <div class="continent-countries">
<?php foreach ($continents['countries'] as $c): ?>
	                <div class="col-sm-8 col-md-6 col-lg-4">
<?php if ($c['data']): ?>
	                    <a href="countries/<?php echo $c['iso3']; ?>">
	                        <img class="flag flag-<?php echo $c['iso3']; ?>" alt="" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeAQMAAAAB/jzhAAAAA1BMVEX///+nxBvIAAAAAXRSTlMAQObYZgAAAAxJREFUeNpjYBiMAAAAlgABjcjBIQAAAABJRU5ErkJggg==">
	                        <span class="name"><?php echo $c['name']; ?></span>
	                    </a>
<?php else: ?>
	                    	<div class="no-data-country">
		                        <img class="flag flag-<?php echo $c['iso3']; ?>" alt="" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeAQMAAAAB/jzhAAAAA1BMVEX///+nxBvIAAAAAXRSTlMAQObYZgAAAAxJREFUeNpjYBiMAAAAlgABjcjBIQAAAABJRU5ErkJggg==">
		                        <span class="name"><?php echo $c['name']; ?></span>
		                        <span class="no-data"><i class="fa fa-ban"></i></span>
	                    	</div>
<?php endif; ?>	
   <?php if (isset($data['extended'])): ?>
	                        <span class="no-data"><i class="fa fa-star"></i></span>
<?php endif; ?>	

	                </div>
<?php endforeach; /* country */ ?>

                </div>
            </div>
        </div>
<?php endforeach; /* continent */ ?>
    </div>
</div>
