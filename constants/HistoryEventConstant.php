<?php

namespace app\constants;

use Yii;

class HistoryEventConstant extends AbstractConstant
{
    const TASK_CREATED = 'created_task';
    const TASK_UPDATED = 'updated_task';
    const TASK_COMPLETED = 'completed_task';

    const SMS_INCOMING = 'incoming_sms';
    const SMS_OUTGOING = 'outgoing_sms';

    const CALL_INCOMING = 'incoming_call';
    const CALL_OUTGOING = 'outgoing_call';

    const FAX_INCOMING = 'incoming_fax';
    const FAX_OUTGOING = 'outgoing_fax';

    const CUSTOMER_CHANGE_TYPE = 'customer_change_type';
    const CUSTOMER_CHANGE_QUALITY = 'customer_change_quality';

    public function map()
    {
        return [
            self::TASK_CREATED => Yii::t('app', 'Task created'),
            self::TASK_UPDATED => Yii::t('app', 'Task updated'),
            self::TASK_COMPLETED => Yii::t('app', 'Task completed'),

            self::SMS_INCOMING => Yii::t('app', 'Incoming message'),
            self::SMS_OUTGOING => Yii::t('app', 'Outgoing message'),

            self::CALL_INCOMING => Yii::t('app', 'Type changed'),
            self::CALL_OUTGOING => Yii::t('app', 'Property changed'),

            self::FAX_INCOMING => Yii::t('app', 'Outgoing call'),
            self::FAX_OUTGOING => Yii::t('app', 'Incoming call'),

            self::CUSTOMER_CHANGE_TYPE => Yii::t('app', 'Incoming fax'),
            self::CUSTOMER_CHANGE_QUALITY => Yii::t('app', 'Outgoing fax'),
        ];
    }
}