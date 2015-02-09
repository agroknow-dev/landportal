<?php
/**
 * @file field--debate.tpl.php
 * Display name & value(s) of a field
 *
 * For the landdebate, field_name isn't followed by a column (:)
 * but enclose in a span element. This is to allow the 'visual effet'
 * to have a centered line going on each sides of the field name.
 *
 * @see field.tpl.php
 * @see template_preprocess_field()
 * @see theme_field()
 *
 * @ingroup themeable
 */
?>
<div class="<?php print $classes; ?>"<?php print $attributes; ?>>
  <?php if (!$label_hidden): ?>
    <div class="field-label"<?php print $title_attributes; ?>><span><?php print $label ?></span></div>
  <?php endif; ?>
  <div class="field-items"<?php print $content_attributes; ?>>
    <?php foreach ($items as $delta => $item): ?>
      <div class="field-item <?php print $delta % 2 ? 'odd' : 'even'; ?>"<?php print $item_attributes[$delta]; ?>><?php print render($item); ?></div>
    <?php endforeach; ?>
  </div>
</div>
