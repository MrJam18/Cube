<?php
declare(strict_types=1);

namespace app\controllers;

use app\controllers\Base\BaseController;
use app\Exceptions\ShowableException;
use app\models\Weather\PrecipitationType;
use app\models\Weather\Weather;
use app\models\Weather\WeatherForm;
use app\models\Weather\WindDirection;
use yii\data\ActiveDataProvider;
use yii\web\Response;

class WeatherController extends BaseController
{
    function actionList(): string|Response
    {
        $user = \Yii::$app->user;
        if($user->isGuest) {
            \Yii::$app->session->setFlash('info', 'Please register for show weather list');
            return $this->redirect('/auth/login');
        }
        $query = Weather::find()->with([
            'windDirection', 'precipitationType', 'settlement'
        ])->orderBy(['date' => SORT_DESC]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('list', ['provider' => $dataProvider]);
    }

    function actionCreate(): string|Response
    {
        if($response = $this->redirectIfNotAdmin()) return $response;
        $form = new WeatherForm();
        $request = $this->getRequest();
        if($form->load($request->post()) && $form->createWeather()) {
            $this->setAlert('weather was created');
            return $this->redirect('/weather/list');
        }
        $viewParams = $this->getFormData();
        $viewParams['model'] = $form;
        return $this->render('weather-form', $viewParams);
    }
    function actionUpdate(string $id): string|Response
    {
        if($response = $this->redirectIfNotAdmin()) return $response;
        $form = new WeatherForm();
        $request = $this->getRequest();
        if($form->load($request->post()) && $form->updateWeather($id)) {
            $this->setAlert('weather was updated');
            return $this->redirect('/weather/list');
        }
        /**
         * @var Weather $weather;
         */
        $weather = Weather::findOne($id);
        $form->precipitation_type_id = (string)$weather->precipitationType->id;
        $form->wind_direction_id = (string)$weather->windDirection->id;
        $form->settlement = $weather->settlement->name;
        $form->date = $weather->date;
        $form->rainfall = (string)$weather->rainfall;
        $form->wind_speed = (string)$weather->wind_speed;
        $form->max_air_temperature = (string)$weather->max_air_temperature;
        $form->min_air_temperature = (string)$weather->min_air_temperature;
        $viewParams = $this->getFormData();
        $viewParams['model'] = $form;
        return $this->render('weather-form', $viewParams);
    }

    function actionDelete(string $id): Response
    {
        if(!isAdmin()) throw new ShowableException("You don't have admin privileges");
        $weather = Weather::findOne($id);
        if(!$weather) throw new ShowableException('cant find weather entity');
        $weather->delete();
        $this->setAlert('weather was deleted');
        return $this->redirect('/weather/list');
    }
    function actionIndex(): Response
    {
        return $this->redirect('/weather/list');
    }

    private function getFormData(): array
    {
        $precipitationTypes = PrecipitationType::find()->all();
        $precTypes = [];
        foreach($precipitationTypes as $type)
        {
            $precTypes[$type->id] = $type->name;
        }
        $windDirections = WindDirection::find()->all();
        $directions = [];
        foreach ($windDirections as $direction) {
            $directions[$direction->id] = $direction->name;
        }
        return [
            'precipitationTypes' => $precTypes,
            'windDirections' => $directions,
        ];
    }
}