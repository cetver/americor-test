<?php

namespace app\lists;

interface ListInterface
{
    /**
     * @param \yii\db\ActiveRecord $model
     * @param mixed $key
     * @param int $index
     * @param \yii\widgets\ListView $widget
     *
     * @return string
     */
    public function render($model, $key, $index, $widget);
}