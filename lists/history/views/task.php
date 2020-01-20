<?php

use app\widgets\DateTime\DateTime;

/**
 * @var \yii\web\View $this
 * @var string $nullDisplay
 * @var string $eventText
 * @var string $taskTitle
 * @var string $username
 * @var string $dateTime
 */

?>
<i class="glyphicon glyphicon-ok text-warning"></i>

<div class="bg-success">
    <?= $eventText ?>
</div>

<div class="bg-info">
    <?= $username; ?>
</div>

<div class="bg-warning">
    <span><?= DateTime::widget(['dateTime' => $dateTime]) ?></span>
</div>