<?php
/**
 * @file
 * This display a map, 
 */
// Show [...]/sites/all/themes/book/views/regions.mustache
?>

<div>
   <h2 class="section section-name"><span class="indicator-name"></span></h2>
   <div id="map" class="map"></div>

   <!-- bar chart comparison -->
   <h2 class="section section-name"><span class="indicator-name"></span><span> </span><span><?php echo t('For countries in the region'); ?></span></h2>
   <div id="chart-region-bar-comparison" class="graph-medium"></div>

   <!-- timeline comparison -->
   <h2 class="section section-name"><span class="indicator-name"></span><span> </span><span><?php echo t('Across time in'); ?></span><span> </span><span class="region-name"></span></h2>
   <div class="row compare-bar">
     <div class="col-xs-4"><?php echo t('Compare with'); ?>:</div>
     <div class="col-xs-8">

<?php /* TODO: should be printed with regular processing for a region-select block like:
<?php print $selectors['regions']; ?>
 */ ?>
       <select id="region-comparing-select" class="form-control">
<?php foreach ($data['selectors']['regions'] as $r): ?>
         <option value="<?php echo $r['un_code']; ?>"><?php echo $r['name']; ?></option>
<?php endforeach; ?>
       </select>

     </div>
   </div>
   <div class="row compare-legend">
     <div class="col-xs-6"><div id="compare-legend-circle-1" class="circle"></div><span id="compare-legend-text-1"></span></div>
     <div class="col-xs-6"><div id="compare-legend-circle-2" class="circle"></div><span id="compare-legend-text-2"></span></div>
   </div>
   <div id="chart-timeline-comparison" class="graph-large"></div>
</div>
