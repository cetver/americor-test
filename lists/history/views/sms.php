<?php

use app\widgets\DateTime\DateTime;

/**
 * @var \yii\web\View $this
 * @var string $eventText
 * @var string $username
 * @var string $footer
 * @var string $dateTime
 */

?>

<i class="glyphicon glyphicon-envelope text-primary"></i>

<div class="bg-success">
    <?= $eventText ?>
</div>

<div class="bg-info">
    <?= $username; ?>
</div>

<div class="bg-warning">
    <?= $footer ?>
    <br>
    <span><?= DateTime::widget(['dateTime' => $dateTime]) ?></span>
</div>