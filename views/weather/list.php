
<div class="weather__list">
    <h3>US Weather</h3>
<?php

use app\models\Base\BaseModel;
use app\models\Weather\Weather;
use yii\grid\GridView;

echo GridView::widget([
    'tableOptions' => [
        'id' => 'theDatatable',
        'class'=>'table table-striped table-bordered'
    ],
    'dataProvider' => $provider,
    'columns' => [
        // Обычные поля определенные данными содержащимися в $dataProvider.
        // Будут использованы данные из полей модели.
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
        ]
    ]
]);
?>
</div>
