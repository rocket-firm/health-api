<?php

$localParams = [];
if (file_exists(__DIR__ . 'params-local.php')) {
    $localParams = require __DIR__ . 'params-local.php';
}

return \yii\helpers\ArrayHelper::merge([
    'adminEmail' => 'admin@example.com',
], $localParams);
