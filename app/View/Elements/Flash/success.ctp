<?php if (empty($key)) {
    $key = 'success';
} ?>
<div id="flash-<?php echo h($key); ?>" class="alert alert-success">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <?php echo h($message); ?>
</div>
