<?php /* Right hand side columns - TODO: port to sidebar / block elements */ ?>
<?php /* SAME SNIPET IN country & regions.tpl.php */ ?>

    <h2 class="section"><span><?php echo t('World region'); ?></span></h2>
    <select id="region-select" multiple="multiple" class="form-control data-sources">
<?php foreach ($data['selectors']['regions'] as $r): ?>
      <option value="<?php echo $r['un_code']; ?>"><?php echo $r['name']; ?></option>
<?php endforeach; ?>
    </select>

    <h2 class="section"><span><?php echo t('Data sources'); ?></span></h2>
    <select id="source-select" multiple="multiple" class="data-sources">
<?php foreach ($data['selectors']['data-sources'] as $d): ?>
      <option value="<?php echo $d['id']; ?>" title="<?php echo $d['name']; ?>"><?php echo $d['name']; ?></option>
<?php endforeach; ?>
    </select>

    <h2 class="section"><span><?php echo t('Indicators'); ?></span></h2>
<?php foreach ($data['selectors']['data-sources'] as $d): ?>
    <select data-source="<?php echo $d['id']; ?>" class="form-control topic-indicator-select data-sources hidden" multiple="multiple">
<?php foreach ($d['indicators'] as $i): ?>
      <option value="<?php echo $i['id']; ?>"><?php echo $i['name']; ?></option>
<?php endforeach; ?>
    </select>
<?php endforeach; ?>
    <select id="indicator-select" multiple="multiple" class="form-control data-sources"></select>
    <a href="/book/indicators" class="more-info"><?php echo t('More about the indicators'); ?></a>


    <h2 class="section"><span><?php echo t('Specific country'); ?></span></h2>
    <select id="country-select" class="form-control">
      <option disabled="disabled" selected="true"><?php echo t('Select a country'); ?></option>
<?php foreach ($data['selectors']['countries'] as $i): ?>
      <option value="<?php echo $i['iso3']; ?>"><?php echo $i['name']; ?></option>
<?php endforeach; ?>
    </select>
    <a href="/book/countries" class="more-info"><?php echo t('More about areas and countries'); ?></a>
