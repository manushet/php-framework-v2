<?php

use WFM\View;

/** @var View $this */

?>

<?php $this->getPart('parts/header'); ?>

<?= $this->content; ?>

<?php $this->getPart('parts/footer'); ?>
