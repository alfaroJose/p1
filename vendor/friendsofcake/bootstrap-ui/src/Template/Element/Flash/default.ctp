<?php
$class = array_unique((array)$params['class']);
$custom="alert alert-warning";
$message = (isset($params['escape']) && $params['escape'] === false) ? $message : h($message);

if (in_array('alert-dismissible', $class)) {
    $button = <<<BUTTON
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
BUTTON;
    $message = $button . $message;
}

echo $this->Html->div($custom, $message, $params['attributes']);
?>
