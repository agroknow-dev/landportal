

   <div id="world-map" class="world-map"></div>
   <h2 class="section"><span><?php echo t('Country map'); ?></span></h2>
   <div id="country-map" class="country-map"></div>
   <h2 class="section"><span><?php echo t('Main Index rankings'); ?></span></h2>
   <div id="main-index-rankings" class="graph">
<?php if ($data['charts']['spider']): ?>
   <div class="source-graph chart-content">
   <?php echo landbook_table_render($data['charts']['spider']); ?>
   </div>
<?php else: ?>
   <div class="text-center text-muted"><?php echo t('No data available'); ?></div>
<?php endif; /* charts */ ?>



<ul class="spider-legend">
   <?php foreach ($data['charts']['spider']['observations'] as $o): ?>
   <li>
   <span class="spider-legen-id"><?php echo $o['indicator']['id']; ?></span>: <?php echo $o['indicator']['name']; ?>
   </li>
   </ul>
 <?php endforeach; /* charts/spider/observations */ ?>
   </div>

   <h2 class="section"><span><?php echo t('Gender issues'); ?></span></h2>
   <table class="traffic">
   <?php foreach ($data['charts']['trafficLights'] as $c): ?>
   <tr class="<?php echo ($c['light'] ? 'text-muted' : ''); ?>">
   <td class="issue"><?php echo $c['indicator']; ?></td>
   <td><div class="circle"><div class="<?php echo $c['light']; ?>"></div></div></td>
   </tr>
   <?php endforeach; /* charts/trafficLights */ ?>
   </table>


   <div class="row traffic-legend">
   <div class="col-xs-6">
   <div class="circle"><div class="none"></div></div>
   <span><?php echo t('No data'); ?></span>
   </div>
   <div class="col-xs-6">
   <div class="circle"><div class="bad"></div></div>
   <span><?php echo t('High inequality'); ?></span>
   </div>
   <div class="col-xs-6">
   <div class="circle"><div class="same"></div></div>
   <span><?php echo t('Mid inequality'); ?></span>
   </div>
   <div class="col-xs-6">
   <div class="circle"><div class="good"></div></div>
   <span><?php echo t('Low inequality'); ?></span>
   </div>
   </div>

   <h2 class="section"><span><?php t('Rural development'); ?></span></h2>
   <div class="row">
   <?php foreach ($data['charts']['gaugeIndicators'] as $c): ?>
   <div class="col-xs-4">
   <div id="rural-development-<?php echo $c['index']; ?>" class="graph-small text-center no-signature">
    <div class="source-graph chart-content">
      <?php echo landbook_table_render($c); ?>
    </div>
</div>
<p class="percentage"><?php echo $c['value']; ?>%</p>
<p class="indicator-name"><?php echo $c['indicator']; ?></p>
</div>
 <?php endforeach; /* charts/gaugeIndicators */ ?>
</div>


  <div class="row">
    <div class="col-xs-12">
      <p class="chart-source text-right"><?php echo t('Source'); ?>: <a href="/book/sources/fao">FAO</a></p>
    </div>
  </div>



