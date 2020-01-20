<?php

namespace app\services;

use yii\web\Request;

class Url
{
    /**
     * @var Request
     */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function mergedRoute($route, $params = [])
    {
        $newQueryParams = array_merge($this->request->queryParams, $params);

        return array_merge([$route], $newQueryParams);
    }
}