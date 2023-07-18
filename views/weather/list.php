<?php

use app\Enums\UserRoleEnum;
use app\models\Weather\Weather;
use yii\grid\GridView;
use yii\helpers\Html;

?>
<div class="weather__list">
    <h3>US Weather</h3>
    <?php if (\Yii::$app->user->getIdentity()?->role_id === UserRoleEnum::Admin->value): ?>
    <div class="toolbar mb-3">
        <div class="">
            <?=  Html::a('Add Weather', ['/weather/create'], ['class'=>'btn btn-primary']) ?>
        </div>
    </div>
    <?php endif; ?>
<?php

$columns = [
    [
        'header' => 'Date',
        'content' => function (Weather $model) {
            return (new DateTime($model->date))->format('d M Y');
        }
    ],
    [
        'header' => 'Wind(m/s)',
        'content' => function (Weather $model, $key, $index, $column) {
            return "{$model->windDirection->name}, $model->wind_speed";
        }
    ],
    [
        'header' => 'Min temp(C)',
        'content' => function(Weather $weather) {
            return $weather->min_air_temperature;
        }
    ],
    [
        'header' => 'Max temp(C)',
        'content' => function(Weather $weather) {
            return $weather->max_air_temperature;
        }
    ],
    [
        'header' =>'Precipitation(mm)',
        'content' => function(Weather $weather) {
            return "{$weather->precipitationType->name}, $weather->rainfall";
        }
    ],
    [
        'header' => 'Settlement',
        'content' => function(Weather $weather) {
            return $weather->settlement->name;
        }
    ],
];
if(isAdmin()) {
    $columns[] = [
        'header' => 'Actions',
        'class' => 'yii\grid\ActionColumn',
        'template' => '{update}<span class="mr-1"></span> {delete}'
    ];
}

echo GridView::widget([
    'tableOptions' => [
        'id' => 'theDatatable',
        'class'=>'table table-striped table-bordered'
    ],
    'dataProvider' => $provider,
    'columns' => $columns
]);
?>
</div>
