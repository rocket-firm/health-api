<?php
/**
 * @see \yii\web\ErrorAction
 *
 * @var string $name
 * @var string $message
 * @var \Exception $exception
 */
?>

<h1><?= $name ?></h1>
<p><?= $message ?></p>

<div class="well">
    <?php \yii\helpers\VarDumper::dump($exception->getTrace(), 10, true) ?>
</div>
