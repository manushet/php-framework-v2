<?php

/**
 * @var $errno \WFM\ErrorHandler
 * @var $errstr \WFM\ErrorHandler
 * @var $errfile \WFM\ErrorHandler
 * @var $errline \WFM\ErrorHandler
 */

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Error</title>
</head>
<body>

<h1>An error occured</h1>
<p><b>Error code:</b> <?= $errno ?></p>
<p><b>Error message:</b> <?= $errstr ?></p>
<p><b>File an error occured in:</b> <?= $errfile ?></p>
<p><b>Line an error occured at:</b> <?= $errline ?></p>

</body>
</html>
