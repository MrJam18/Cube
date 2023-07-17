<?php
declare(strict_types=1);

namespace app\controllers;

use app\models\Weather\Weather;
use DateTime;
use Yii;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\web\Controller;
use yii\web\Response;

class WeatherController extends Controller
{
    function actionIndex(): string|Response
    {
        if(Yii::$app->user->isGuest) {
            Yii::$app->session->setFlash('info', 'Please register for show weather list');
            return $this->redirect('/auth/login');
        }
        $now = (new DateTime())->format(ISO_DATE_FORMAT);
        $query = Weather::find()->with([
            'windDirection', 'precipitationType', 'settlement'
        ])->where(['date' => $now]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);
        return $this->render('list', ['provider' => $dataProvider]);
    }
}