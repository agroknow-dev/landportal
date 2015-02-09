<?php
/**
 * @file
 * Indicator page template
 *
 * The Landportal landbook
 *
 * Original work by: WESO (http://www.weso.es/)
 * Drupal refactoring: Jules <jules@ker.bz>
 */
?>

<div class="row">
  <div class="col-sm-9 graph-section">
    <p class="indicator-description" id="indicator-description"></p>
    <div id="map" class="map"></div>

    <h2 class="section"><span><?php echo t("Evolution of"); ?></span><span> </span><span class="indicator-name"></span></h2>
    <div class="row compare-container">
    <div class="col-xs-4"><?php echo t("Compare with"); ?>:</div>
    <div class="col-xs-8">
      <select id="indicator-comparing-select" class="form-control">
<?php foreach ($data['selectors']['topics'] as $t): ?>
        <optgroup label="<?php echo $t['translation_name']; ?>">
<?php foreach ($t['indicators'] as $i): ?>
          <option value="<?php echo $i['id']; ?>"><?php echo $i['name']; ?></option>
<?php endforeach; ?>
        </optgroup>
<?php endforeach; ?>
      </select>
    </div>
  </div>

  <div class="row compare-legend">
    <div class="col-xs-6">
      <div id="compare-legend-circle-1" class="circle"></div>
      <span id="compare-legend-text-1"></span>
    </div>
    <div class="col-xs-6">
      <div id="compare-legend-circle-2" class="circle"></div>
      <span id="compare-legend-text-2"></span>
    </div>
  </div>

  <div id="chart-timeline-comparison" class="graph-large"></div>
  <div class="row compare-container">
    <div class="col-xs-4"><?php echo t("Correlate with"); ?>:</div>
    <div class="col-xs-8">
      <select id="indicator-relating-select" class="form-control">
<?php foreach ($data['selectors']['topics'] as $t): ?>
        <optgroup label="<?php echo $t['translation_name']; ?>">
<?php foreach ($t['indicators'] as $i): ?>
          <option value="<?php echo $i['id']; ?>"><?php echo $i['name']; ?></option>
<?php endforeach; ?>
        </optgroup>
<?php endforeach; ?>
      </select>
    </div>
  </div>

  <div id="chart-correlation-comparison" class="graph-large"></div>
    <h2 class="section"><span class="indicator-name"></span><span> </span><span><?php echo t("at the different countries"); ?></span></h2>
    <div id="loading" class="loading-circles"></div>
    <div class="table-responsive">
      <table id="country-values" class="table table-striped sortable">
        <thead>
          <tr>
            <th data-sort-type="text"><?php echo t("Country"); ?></th>
            <th data-sort-type="number"><?php echo t("Time"); ?></th>
            <th data-sort-type="number"><?php echo t("Value"); ?></th>
            <th data-sort-type="number"><?php echo t("Last updated"); ?></th>
            <th data-sort-type="text"><?php echo t("Tendency"); ?></th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </div>
</div>
