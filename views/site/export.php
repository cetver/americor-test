<?php

use app\models\search\HistorySearch;
use app\widgets\Export\Export;

/**
 * @var $this yii\web\View
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $fileName string
 * @var $exportType string
 */

echo Export::widget([
    'exportType' => $exportType,
    'batchSize' => 2000,
    'filename' => $fileName,
    'dataProvider' => $dataProvider,
    'columns' => [
        [
            'attribute' => 'ins_ts',
            'label' => Yii::t('app', 'Date'),
            'format' => 'datetime'
        ],
        [
            'label' => Yii::t('app', 'User'),
            'value' => function (HistorySearch $model) {
                // предпочитаю использовать колонки на основе yii\grid\DataColumn, но данный виджет их не поддерживает
                return $model->user->username ?? Yii::t('app', 'System');
            }
        ],
        [
            'label' => Yii::t('app', 'Type'), // $model->getAttributeLabel('object') ?
            'attribute' => 'object'
        ],
        [
            'label' => Yii::t('app', 'Event'),
            'attribute' => 'eventText'
        ],
        [
            'label' => Yii::t('app', 'Message'),
            'value' => function (HistorySearch $model) {
                // всесто strip_tags лучше использовать свой formatter на основе \yii\i18n\Formatter с методом asStripTags
                return strip_tags($model->eventText());
            }
        ]
    ],
]);