<?php if (empty($key)) {
    $key = 'info';
} ?>
<div id="flash-<?php echo h($key); ?>" class="alert alert-info">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <?php echo h($message); ?>
</div>
