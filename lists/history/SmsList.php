<?php

namespace app\lists\history;

use app\lists\ListInterface;
use yii\i18n\Formatter;

class SmsList implements ListInterface
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
        $sms = $model->sms;
        $user = $model->user;
        $nullDisplay = $this->formatter->nullDisplay;

        $eventText = $this->formatter->asText($model->eventText());
        $username = $this->formatter->asHtml($user->username ?? $nullDisplay);
        $footer = ($sms->direction === $sms::DIRECTION_INCOMING)
            ? \Yii::t('app', 'Incoming message from {number}', ['number' => $sms->phone_from ?? $nullDisplay])
            : \Yii::t('app', 'Sent message to {number}', ['number' => $sms->phone_to ?? $nullDisplay]);
        $footer = $this->formatter->asText($footer);
        $dateTime = $this->formatter->asText($model->ins_ts);

        return $widget->render('@app/lists/history/views/sms', compact(
            'eventText',
            'username',
            'footer',
            'dateTime'
        ));
    }
}