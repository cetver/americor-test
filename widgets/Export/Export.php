<?php
namespace app\widgets\Export;

use kartik\export\ExportMenu;

class Export extends ExportMenu
{
    public $exportType = self::FORMAT_CSV;

    public function init()
    {
        // наверное это можно как-то улучшить, но лень копать родительский класс
        if (empty($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }
        if (empty($this->exportRequestParam)) {
            $this->exportRequestParam = 'exportFull_' . $this->options['id'];
        }

        $_POST[\Yii::$app->request->methodParam] = 'POST';
        $_POST[$this->exportRequestParam] = true;
        $_POST[$this->exportTypeParam] = $this->exportType;
        $_POST[$this->colSelFlagParam] = false;

        parent::init();
    }
}