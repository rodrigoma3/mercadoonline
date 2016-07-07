<?php if (empty($key)) {
    $key = 'danger';
} ?>
<div id="flash-<?php echo h($key); ?>" class="alert alert-danger">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <?php echo h($message); ?>
</div>
