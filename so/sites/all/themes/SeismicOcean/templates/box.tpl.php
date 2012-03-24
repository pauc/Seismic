<?php

/**
 * @file box.tpl.php
 *
 * Theme implementation to display a box.
 *
 * Available variables:
 * - $title: Box title.
 * - $content: Box content.
 *
 * @see template_preprocess()
 */
?>
<div class="box">

<?php if ($title): ?>
  <?php if ($title != 'Search results'): ?>
    <h2><?php print $title ?></h2>
  <?php else: ?>
    <?php
      global $pager_total_items;
    ?>
    Your search returned <?php print format_plural($pager_total_items[0], '1 result', '@count results'); ?>.
  <?php endif; ?>
<?php endif; ?>

  <div class="content"><?php print $content ?></div>
</div>
