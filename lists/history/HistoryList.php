<?php

namespace app\lists\history;

use app\lists\factories\HistoryFactory;
use app\lists\ListInterface;

class HistoryList implements ListInterface
{
    /**
     * @inheritDoc
     */
    public function render($model, $key, $index, $widget)
    {
        /**
         * @var \app\models\search\HistorySearch $model
         * @var HistoryFactory $historyFactory
         */
        $historyFactory = \Yii::$container->get(HistoryFactory::class);
        $renderer = $historyFactory->createRenderer($model->event);

        return $renderer->render($model, $key, $index, $widget);
    }
}