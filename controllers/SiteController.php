<?php

namespace app\controllers;

use app\models\search\HistorySearch;
use app\services\Url;
use kartik\export\ExportMenu;
use yii\web\Controller;
use yii\web\ErrorAction;
use yii\web\Request;

class SiteController extends Controller
{
    /**
     * @var HistorySearch
     */
    private $historySearch;
    /**
     * @var Request
     */
    private $request;
    /**
     * @var Url
     */
    private $urlService;

    public function __construct(
        $id,
        $module,
        HistorySearch $historySearch,
        Request $request,
        Url $urlService,
        $config = []
    )
    {
        $this->historySearch = $historySearch;
        $this->request = $request;
        $this->urlService = $urlService;
        parent::__construct($id, $module, $config);
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = $this->historySearch->search($this->request->queryParams);
        $exportRoute = $this->urlService->mergedRoute('site/export', [
            'exportType' => ExportMenu::FORMAT_CSV
        ]);

        return $this->render('index', compact(
            'dataProvider',
            'exportRoute'
        ));
    }

    /**
     * @param string $exportType
     *
     * @return string
     */
    public function actionExport($exportType)
    {
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '2048M');

        $dataProvider = $this->historySearch->search($this->request->queryParams);
        $fileName = 'History-Report-' . date('d-M-Y H-i-s');

        return $this->render('export', compact(
            'dataProvider',
            'fileName',
            'exportType'
        ));
    }
}
