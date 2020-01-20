<?php

namespace app\lists\history;

use app\lists\ListInterface;
use yii\i18n\Formatter;

class TaskList implements ListInterface
{
    /**
     * @var Formatter
     */
    private $formatter;

    public function __construct(Formatter $formatter)
    {
        $this->formatter = $formatter;
    }

    /**
     * @inheritDoc
     */
    public function render($model, $key, $index, $widget)
    {
        /** @var \app\models\search\HistorySearch $model */
        $user = $model->user;

        $eventText = $this->formatter->asHtml($model->eventText());
        $username = $this->formatter->asText($user->username);
        $dateTime = $this->formatter->asText($model->ins_ts);

        return $widget->render('@app/lists/history/views/task', compact(
            'eventText',
            'username',
            'dateTime'
        ));
    }
}