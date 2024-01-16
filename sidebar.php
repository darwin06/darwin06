<?php

?>
<?php if (is_active_sidebar('primary-sidebar')) { ?>
<aside class="col-12 col-md-4 sidebar">
  <ul class="list-unstyled widgets">
    <?php dynamic_sidebar('primary-sidebar'); ?>
  </ul>
</aside>
<?php } ?>
