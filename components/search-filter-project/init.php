<?php

$values = explode(',', $app->config['funarte.circuito_seals']);

// trim whitespace and convert to number if numeric
$numbers = array_map(function($v) {
    $v = trim($v);
    // convert to integer or float if numeric
    return is_numeric($v) ? $v + 0 : $v;
}, $values);

$this->jsObject['config']['funarteCircuitoSeals'] = $numbers;