<?php
$class = 'message';
if (!empty($params['class'])) {
    $class .= ' ' . $params['class'];
}
?>
<div id="<?php echo h($key) ?>Message" class="<?php echo h($class) ?>">
    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    <?php echo h($message) ?>
</div>
