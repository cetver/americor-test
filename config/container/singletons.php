<?php

use app\constants\HistoryEventConstant;
use app\controllers\SiteController;
use app\lists\factories\HistoryFactory;
use app\lists\history\FaxList;
use app\lists\history\HistoryList;
use app\lists\history\SmsList;
use app\lists\history\TaskList;
use app\models\search\HistorySearch;
use app\services\Url;
use yii\di\Container;
use yii\i18n\Formatter;
use yii\web\Request;

return [
    [
        'class'  => Url::class,
        'definition' => function (Container $container, $params, $config) {
            /** @var yii\web\Request $request */
            $request = $container->get(Request::class);

            return new Url($request);
        }
    ],
    [
        'class' => SiteController::class,
        'definition' => function (Container $container, $params, $config) {
            /** @var yii\web\Request $request */
            $request = $container->get(Request::class);
            /** @var Url $urlService */
            $urlService = $container->get(Url::class);

            return new SiteController(
                $params[0],
                $params[1],
                new HistorySearch(),
                $request,
                $urlService,
                $config
            );
        }
    ],
    [
        'class'  => HistoryFactory::class,
        'definition' => function (Container $container, $params, $config) {
            return new HistoryFactory(new HistoryEventConstant());
        }
    ],
    HistoryList::class,
    [
        'class'  => TaskList::class,
        'definition' => function (Container $container, $params, $config) {
            /** @var Formatter $formatter */
            $formatter = $container->get(Formatter::class);

            return new TaskList($formatter);
        }
    ],
    [
        'class'  => SmsList::class,
        'definition' => function (Container $container, $params, $config) {
            /** @var Formatter $formatter */
            $formatter = $container->get(Formatter::class);

            return new SmsList($formatter);
        }
    ],
    [
        'class'  => FaxList::class,
        'definition' => function (Container $container, $params, $config) {
            /** @var Formatter $formatter */
            $formatter = $container->get(Formatter::class);

            return new FaxList($formatter);
        }
    ],

];
