<?php

use app\widgets\DateTime\DateTime;

/**
 * @var \yii\web\View $this
 * @var string $eventText
 * @var string $username
 * @var string $faxType
 * @var string $dateTime
 */

?>

<i class="glyphicon glyphicon-print text-success"></i>

<div class="bg-success">
    <?= $eventText ?> - тут может быть документ, которого нет
</div>

<div class="bg-info">
    <?= $username; ?>
</div>

<div class="bg-warning">
    <?php
    echo Yii::t('app', '{type} was sent to {group}', [
        'type' => $faxType,
        'group' => '[тут может быть ссылка на группу, которой нет]'
    ])
    ?>
    <br>
    <span><?= DateTime::widget(['dateTime' => $dateTime]) ?></span>
</div>