<?php

namespace app\lists\factories;

use app\constants\HistoryEventConstant;
use app\lists\history\FaxList;
use app\lists\history\SmsList;
use app\lists\history\TaskList;

class HistoryFactory
{
    /**
     * @var HistoryEventConstant
     */
    private $historyEventConstant;

    public function __construct(HistoryEventConstant $historyEventConstant)
    {
        $this->historyEventConstant = $historyEventConstant;
    }

    private function strategy($event)
    {
        $map = [
            $this->historyEventConstant::TASK_CREATED => TaskList::class,
            $this->historyEventConstant::TASK_UPDATED => TaskList::class,
            $this->historyEventConstant::TASK_COMPLETED => TaskList::class,

            $this->historyEventConstant::SMS_INCOMING => SmsList::class,
            $this->historyEventConstant::SMS_OUTGOING => SmsList::class,

            $this->historyEventConstant::FAX_INCOMING => FaxList::class,
            $this->historyEventConstant::FAX_OUTGOING => FaxList::class,

//            $this->historyEventConstant::CALL_INCOMING => TaskList::class,
//            $this->historyEventConstant::CALL_OUTGOING => TaskList::class,

//            $this->historyEventConstant::CUSTOMER_CHANGE_TYPE => TaskList::class,
//            $this->historyEventConstant::CUSTOMER_CHANGE_QUALITY => TaskList::class,
        ];

        if (!isset($map[$event])) {
            $message = sprintf(
                'Unknown event "%s", possible values: %s',
                $event,
                implode(', ', $this->historyEventConstant->all())
            );
            throw new \InvalidArgumentException($message);
        }

        return $map[$event];
    }

    /**
     * @param $event
     *
     * @return object|\app\lists\ListInterface
     * @throws \yii\base\InvalidConfigException
     * @throws \yii\di\NotInstantiableException
     */
    public function createRenderer($event)
    {
        $strategy = $this->strategy($event);

        return \Yii::$container->get($strategy);
    }
}