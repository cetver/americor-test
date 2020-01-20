<?php

namespace app\widgets;

use yii\widgets\ListView;

final class UlListView extends ListView
{
    /**
     * @inheritDoc
     */
    public $options = [
        'tag' => 'ul',
        'class' => 'list-group'
    ];

    /**
     * @inheritDoc
     */
    public $itemOptions = [
        'tag' => 'li',
        'class' => 'list-group-item'
    ];

    /**
     * @inheritDoc
     */
    public $emptyTextOptions = ['class' => 'empty p-20'];

    /**
     * @inheritDoc
     */
    public $layout = '{items}{pager}';
}