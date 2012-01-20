<?php 
  $form['name']['#title'] = 'Name';
  $form['mail']['#title'] = 'E-Mail';
  $form['submit']['#value'] = 'Send';
  print drupal_render($form['contact_information']);
?>
<div class="contact-form-content clearfix">
  <p>SEND A MESSAGE</p>
  <?php print drupal_render($form); ?>
</div>
</form>
  