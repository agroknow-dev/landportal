      <h2 class="section"><span><?php echo t('Data sources'); ?></span></h2>
      <select id="source-select" multiple="multiple" class="data-sources">
<?php foreach ($data['selectors']['data-sources'] as $d): ?>
        <option <?php echo (!$d['with_data'] ? ' disabled="disabled"': ''); ?> title="<?php echo $d['name']; ?>"><?php echo $d['name']; ?></option>
<?php endforeach; ?>
      </select>


      <h2 class="section"><span><?php echo t('Indicators'); ?></span></h2>
      <div>
<?php foreach ($data['selectors']['data-sources'] as $d): ?>
        <select data-source="<?php echo $d['name']; ?>" class="form-control topic-indicator-select hidden">
<?php foreach ($d['indicators'] as $i): ?>
          <option <?php echo (!$i['with_data'] ? ' disabled="disabled"': ''); ?> value="<?php echo $i['id']; ?>" title="<?php echo $i['name']; ?>"><?php echo $i['name']; ?></option>
<?php endforeach; ?>
        </select>
<?php endforeach; ?>
      </div>
      <select id="indicator-select" class="form-control"></select>

      <a href="/book/countries/<?php echo $data['entity-id']; ?>/details"><button id="full-data-button" class="btn data-button"><?php echo t('Full data'); ?> <span class="country-name"><?php echo $data['info']['name']; ?></span></button></a>

      <a href="/book/indicators" class="more-info"><?php echo t('More about the indicators');?></a>
      <h2 class="section"><span><?php echo t('Specific country'); ?></span></h2>


      <select id="country-select" class="form-control">
        <option disabled="disabled" selected="true"><?php echo t('Select a country'); ?></option>
<?php foreach ($data['selectors']['countries'] as $i): ?>
        <option value="<?php echo $i['iso3']; ?>"><?php echo $i['name']; ?></option>
<?php endforeach; ?>
      </select>
      <a href="/book/countries" class="more-info"><?php echo t('More about areas and countries'); ?></a>
      <a href="http://legacy.landportal.info/area/<?php echo $data['info']['name']; ?>" target="_blank"><button class="btn data-button-dark"><?php echo t('Consult the landlibrary (new version coming soon)'); ?></button></a>

      <a href="/search/site/<?php echo $data['info']['name']; ?>"><button class="btn data-button-dark"><?php echo t('Debate with others'); ?></button></a>

