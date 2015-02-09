<h2 class="section"><span><?php echo t("Topic"); ?></span></h2>
<select id="topic-select" multiple="multiple" class="form-control data-sources">
  <?php foreach ($data['selectors']['topics'] as $t): ?>
  <option value="<?php echo $t['id']; ?>" title="<?php echo $t['translation_name']; ?>"><?php echo $t['translation_name']; ?></option>
  <?php endforeach; ?>

</select>
<h2 class="section"><span><?php echo t("Indicator"); ?></span></h2>
<!-- all indicator selects -->
<div>
  <?php foreach ($data['selectors']['topics'] as $t): ?>
  <select class="form-control topic-indicator-select data-sources hidden" multiple="multiple">
    <?php foreach ($t['indicators'] as $i): ?>
    <option value="<?php echo $i['id']; ?>" title="<?php echo $i['name']; ?>"><?php echo $i['name']; ?></option>
    <?php endforeach; ?>
  </select>
  <?php endforeach; ?>
</div>
<select id="indicator-select" multiple="multiple" class="form-control data-sources">
</select>
</select>
<h2 class="section"><span><?php echo t("All indicators"); ?></span></h2>
<select id="all-indicator-select" class="form-control">
  <?php foreach ($data['selectors']['topics'] as $t): ?>
  <optgroup label="<?php echo $t['translation_name']; ?>">
    <?php foreach ($t['indicators'] as $i): ?>
    <option value="<?php echo $i['id']; ?>"><?php echo $i['name']; ?></option>
    <?php endforeach; ?>
  </optgroup>
  <?php endforeach; ?>
</select>
<a href="/book/indicators" class="more-info"><?php echo t("More about the indicators"); ?></a>

<button class="btn data-button-coming">
  <?php echo t("Socio-economic Land Library"); ?>
</button>
<a id="debate-link">
  <button class="btn data-button-dark"><?php echo t("Debate with others"); ?></button>
</a>

