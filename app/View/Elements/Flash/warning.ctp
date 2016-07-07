<?php if (empty($key)) {
    $key = 'warning';
} ?>
<div id="flash-<?php echo h($key); ?>" class="alert alert-warning">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <?php echo h($message); ?>
</div>
