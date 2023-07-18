<?php


/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var \app\models\Weather\WeatherForm $model */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Weather form';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="reviews__form">
    <h1><?= Html::encode($this->title) ?></h1>
    <?php $form = ActiveForm::begin([
        'id' => 'weather-form',
        'fieldConfig' => [
            'template' => "{label}\n{input}\n{error}",
            'labelOptions' => ['class' => 'col-lg-2 col-form-label mr-lg-3 register__label'],
            'inputOptions' => ['class' => 'col-lg-3 form-control'],
            'errorOptions' => ['class' => 'col-lg-7 invalid-feedback'],
        ],
    ]); ?>
    <div class="small-inputs-block">
        <?= $form->field($model, 'min_air_temperature', [
                'options' => ['class' => 'small-input']])
            ->textInput(['autofocus' => true, 'type' => 'number'])->label('Min temp(C)') ?>
        <?= $form->field($model, 'max_air_temperature',[
            'options' => ['class' => 'small-input']])
            ->textInput(['type' => 'number'])->label('Max temp(C)') ?>
    </div>
    <?= $form->field($model, 'precipitation_type_id')->dropDownList($precipitationTypes)->label('Precipitation Type') ?>
    <?= $form->field($model, 'wind_direction_id')->dropDownList($windDirections)->label('Wind Direction') ?>
    <div class="small-inputs-block">
        <?= $form->field($model, 'rainfall', [
            'options' => ['class' => 'small-input']])
            ->textInput(['type' => 'number'])->label('Rainfall(mm)') ?>
        <?= $form->field($model, 'wind_speed', [
            'options' => ['class' => 'small-input']])
            ->textInput(['type' => 'number'])->label('Wind speed(m/s)') ?>
    </div>
    <div class="small-inputs-block">
        <?= $form->field($model, 'date', [
            'options' => ['class' => 'small-input']])
            ->textInput(['type' => 'date']) ?>
        <?= $form->field($model, 'settlement', [
            'options' => ['class' => 'small-input']])
            ->textInput()->label('Settlement name') ?>
    </div>

    <div class="form-group mt-3">
        <div>
            <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'submit-button']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>



