
<div class="content main-content container">
	<div class="row countries-container">
		<div class="col-sm-12">
   <p><?php echo t("The Land Book indicators came from different <a href='/book/sources'>Data Sources</a>. If you know of any additional data source or can directly provide new data for any given country please <a href='mailto:hello@landportal.info'>keep in touch</a>."); ?></p>
   <p><?php echo t("Last update date of the data from a given indicator is provided"); ?></p>
        </div>
    </div>
    <div class="row countries-container">
        <div class="col-sm-6 col-lg-6">
   <label for="select-indicator"><?php echo t("Select an indicator"); ?>:</label>
            <select id="country-select" class="indicators-indicator-select" name="select-indicator">
   <option disabled="disabled" selected="true"><?php echo t("Select an indicator"); ?></option>
<?php foreach ($data['indicators'] as $r): ?>
   <option value="<?php echo $r['id']; ?>"><?php echo $r['name']; ?></option>
<?php endforeach; ?>
            </select>
        </div>
        <div class="col-sm-6 col-lg-6 text-right">
            <input id="expand" type="checkbox" name="expand-all" />
                                                                                                 <label for="expand-all"><?php echo t("Expand all"); ?></label>
        </div>
    </div>
    <div class="continents">
<?php foreach ($data['topics'] as $t): ?>
        <div class="row continent">
            <div class="col-sm-12 countries">
                <h1 class="country-name"><span><?php echo $t['translation_name']; ?></span><span class="down"><i class="fa fa-angle-down"></i></span></h1>
                <div class="continent-countries">
<?php foreach ($t['indicators'] as $i): ?>
	                <div class="col-sm-8 col-md-6 col-lg-4">
	                	<div class="marker"></div>
   <span class="indicator-year"><?php echo (isset($t['year']) ? $t['year'] : ''); ?></span>
	                	<a href="indicators/detail?indicator=<?php echo $i['id']; ?>">
	                       	<span class="name"><?php echo $i['name']; ?></span>
	                    </a>
	                </div>
<?php endforeach; ?>
                </div>
            </div>
        </div>
<?php endforeach; ?>
    </div>
</div>

