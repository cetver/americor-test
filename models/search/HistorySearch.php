<?php

namespace app\models\search;

use app\constants\HistoryEventConstant;
use app\models\History;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * HistorySearch represents the model behind the search form about `app\models\History`.
 *
 * @property array $objects
 */
class HistorySearch extends History
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[
                'customer_id',
                'objects',
                'user_id',
                'search',
                'department_ids',
                'date_from',
                'date_to',
                'denyObjects',
            ], 'safe'],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'user_id' => \Yii::t('app', 'Agents'),
            'objects' => \Yii::t('app', 'Types'),
            'search' => \Yii::t('app', 'Search'),
            'department_ids' => \Yii::t('app', 'Department'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = self::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'ins_ts' => SORT_DESC,
                    'id' => SORT_DESC,
                ],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->emulateExecution();

            return $dataProvider;
        }

        $query
            ->with([
                'customer',
                'user',
                'sms',
                'task',
                'call',
                'fax',
            ])
            ->andFilterWhere([
                'history.event' => [
                    HistoryEventConstant::TASK_CREATED,
                    HistoryEventConstant::TASK_UPDATED,
                    HistoryEventConstant::TASK_COMPLETED,

                    HistoryEventConstant::SMS_INCOMING,
                    HistoryEventConstant::SMS_OUTGOING,

                    HistoryEventConstant::FAX_INCOMING,
                    HistoryEventConstant::FAX_OUTGOING,
                ],
            ]);

        return $dataProvider;
    }

    public function eventText()
    {
        switch ($this->event) {
            default:
                $text = $this->eventText;
                break;

            case HistoryEventConstant::TASK_CREATED:
            case HistoryEventConstant::TASK_UPDATED:
            case HistoryEventConstant::TASK_COMPLETED:
                $task = $this->task;
                $text = $this->eventText . ': ';
                if ($task !== null) {
                    $text .= sprintf('(%s)', $task->title);
                } else {
                    $text .= \Yii::$app->formatter->nullDisplay;
                }
                break;

            case HistoryEventConstant::SMS_INCOMING:
            case HistoryEventConstant::SMS_OUTGOING:
                $text = $this->sms->message;
                break;
        }

        return $text;
    }
}
