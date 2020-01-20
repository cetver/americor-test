<?php

use app\lists\history\HistoryList;
use app\widgets\UlListView;
use yii\helpers\Html;
use yii\widgets\Pjax;

/**
 * @var $this yii\web\View
 * @var $dataProvider yii\data\ActiveDataProvider
 * @var $exportRoute array
 */

$this->title = 'Americor Test Task';
?>

<div class="panel panel-primary panel-small m-b-0">
    <div class="panel-body panel-body-selected">

        <div class="pull-sm-right">
            <?php
            echo Html::a(Yii::t('app', 'CSV'), $exportRoute, ['class' => 'btn btn-success',]);
            ?>
        </div>

    </div>
</div>

<?php
Pjax::begin(['formSelector' => false]);
echo UlListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => [HistoryList::class, 'render'],
]);
Pjax::end();
?>

