<?php

namespace app\lists\history;

use app\lists\ListInterface;
use yii\i18n\Formatter;

class FaxList implements ListInterface
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
        $fax = $model->fax;
        $nullDisplay = $this->formatter->nullDisplay;

        $eventText = $this->formatter->asText($model->eventText());
        $username = $this->formatter->asHtml($user->username ?? $nullDisplay);
        $faxType = $this->formatter->asText($fax->getTypeText());
        $dateTime = $this->formatter->asText($model->ins_ts);

        return $widget->render('@app/lists/history/views/fax', compact(
            'eventText',
            'username',
            'faxType',
            'dateTime'
        ));
    }

}