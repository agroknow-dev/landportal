<div class="content main-content container">
  <div class="row data-sources">
<?php foreach ($data['data-sources'] as $d): ?>
    <div class="col-xs-6 col-sm-3 data-source-link">
      <a href="/book/sources/<?php echo $d['id']; ?>" title="<?php echo t("Go to"); ?> <?php echo $d['name']; ?>">
        <img alt="" src="/<?php echo drupal_get_path('theme', 'landportal'); ?>/images/sources/<?php echo $d['id']; ?>.png" />
        <?php echo $d['name']; ?>
      </a>
    </div>
<?php endforeach; ?>
  </div>
</div>

